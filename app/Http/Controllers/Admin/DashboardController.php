<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Properties;
use App\Enquire;
use App\Partners;
use App\Subscriber;
use App\Testimonials;
use App\SubscriptionPlan;
use App\Transactions;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
         
    }
    public function index()
    { 
    	 	if(Auth::User()->usertype!="Admin"){

	            \Session::flash('flash_message', trans('words.access_denied'));

	            return redirect('dashboard');
	            
	        }
 
			$properties_count = Properties::count();
			$pending_properties_count = Properties::where('status', '0')->count();
	    	
	    	$featured_properties = Properties::where('featured_property', '1')->count(); 
	    	$inquiries = Enquire::count();
	    	
	    	$users = User::where('usertype', 'User')->count();
	    	
	    	$testimonials = Testimonials::count();
	    	
	    	$subscriber = Subscriber::count();
	    	
	    	$transactions = Transactions::count();

	    	$plan_list = SubscriptionPlan::orderBy('id')->get();

	    	//Revenue
            $start_day = date('Y-m-d 00:00:00');
            $finish_day = date('Y-m-d 23:59:59');
            $daily_amount= Transactions::whereBetween('date', array(strtotime($start_day), strtotime($finish_day)))->sum('payment_amount');

            $start_week = (date('D') != 'Mon') ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d');
            $finish_week = (date('D') != 'Sat') ? date('Y-m-d', strtotime('next Saturday')) : date('Y-m-d');
            $weekly_amount= Transactions::whereBetween('date', array(strtotime($start_week), strtotime($finish_week)))->sum('payment_amount');

            $start_month = date('Y-m-d', strtotime('first day of this month'));
            $finish_month = date('Y-m-d', strtotime('last day of this month'));             
            $monthly_amount = Transactions::whereBetween('date', array(strtotime($start_month), strtotime($finish_month)))->sum('payment_amount');

            $current_year = date('Y'); 
            $start_day_year = "January 1st, {$current_year}";
            $end_day_year = "December 31st, {$current_year}";
            $yearly_amount = Transactions::whereBetween('date', array(strtotime($start_day_year), strtotime($end_day_year)))->sum('payment_amount');
		 
    	
        return view('admin.pages.dashboard',compact('properties_count','pending_properties_count','featured_properties','inquiries','users','testimonials','subscriber','transactions','plan_list','daily_amount','weekly_amount','monthly_amount','yearly_amount'));
    }
	
	 
    	
}
