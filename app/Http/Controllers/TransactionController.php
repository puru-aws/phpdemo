<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Properties;
use App\Transactions;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
	 

    public function transaction_list()    
    { 
        if(!Auth::user())
         {
            \Session::flash('flash_message', 'Login required!');

            return redirect('login');
         } 

        $user_id=Auth::user()->id;  
          
        $transaction = DB::table('transaction')
                           ->where('user_id',$user_id)                              
                           ->orderBy('id','DESC')
                           ->paginate(8);
         
        return view('pages.invoice_list',compact('transaction'));
    }
 

    public function user_invoice($id)    
    { 
        if(!Auth::user())
         {
            \Session::flash('flash_message', 'Login required!');

            return redirect('login');
         } 

        $decrypted_id = Crypt::decryptString($id);

        $transaction_info = Transactions::findOrFail($decrypted_id);

        $user_info = User::findOrFail($transaction_info->user_id);        
         
        return view('pages.invoice',compact('transaction_info','user_info'));
    } 
    	
}
