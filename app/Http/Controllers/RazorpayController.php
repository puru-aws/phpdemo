<?php

namespace App\Http\Controllers;

use Auth;
use App\User; 
use App\Transactions;
use App\SubscriptionPlan;
use App\Properties;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 

use Session;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController extends Controller
{
	 

    public function payment_success(Request $request)
    {
        $razor_key = getcong('razorpay_key');
        $razor_secret = getcong('razorpay_secret');   

    	$plan_id = Session::get('plan_id');

        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();
        $plan_name=$plan_info->plan_name;
        $plan_days=$plan_info->plan_days;
        $plan_amount=$plan_info->plan_price;

        $tax_amount=($plan_amount*getcong('tax_percentage'))/100;
        $total_amount=$plan_amount+$tax_amount;
        
        $input = $request->all();

        $razorpay_payment_id=$input['razorpay_payment_id'];

        //Capture a Payment
        $api = new Api($razor_key, $razor_secret);

        $payment = $api->payment->fetch($razorpay_payment_id);
		$payment->capture(array('amount' => $total_amount*100, 'currency' => 'INR'));

        $user_id=Auth::user()->id;           
        $user = User::findOrFail($user_id);
 

        $payment_property_id = Session::get('payment_property_id');
        $property_obj = Properties::findOrFail($payment_property_id);

        $property_obj->active_plan_id = $plan_id;
        $property_obj->property_exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));
        $property_obj->status = 1;
        $property_obj->save();

         
        $payment_trans = new Transactions;

        $payment_trans->property_id = $payment_property_id;
        $payment_trans->user_id = Auth::user()->id;
        $payment_trans->email = $user->email;
        $payment_trans->plan_id = $plan_id;
        $payment_trans->gateway = 'Razorpay';
        $payment_trans->payment_amount = $plan_amount;
        $payment_trans->tax_amount = $tax_amount;
        $payment_trans->total_payment_amount = $total_amount;
        $payment_trans->payment_id = $razorpay_payment_id;
        $payment_trans->date = strtotime(date('m/d/Y H:i:s'));
        
        $payment_trans->save();

        Session::forget('payment_property_id');
        Session::forget('plan_id');
        Session::forget('plan_name');
        Session::forget('plan_price');
        Session::forget('plan_days');
        Session::forget('razorpay_order_id');
        
         //Subscription Payment Email
        $user_full_name=$user->name;

        $data_email = array(
            'name' => $user_full_name
             );    
        
        if(getenv("MAIL_USERNAME"))
        {
            \Mail::send('emails.payment_success', $data_email, function($message) use ($user,$user_full_name){
                $message->to($user->email, $user_full_name)
                    ->from(getcong('site_email'), getcong('site_name')) 
                    ->subject(trans('words.property_payment_done'));
            });
        }


        \Session::flash('success',trans('words.payment_success'));
        return redirect('my_properties'); 
 

    }
             
    
}
