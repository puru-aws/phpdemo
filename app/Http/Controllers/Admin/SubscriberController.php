<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Subscriber;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str; 

class SubscriberController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();

         
    }
    public function subscriberlist()
    {  
        
         if(Auth::User()->usertype!="Admin"){

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
            }
        
    	$subscriberlist = Subscriber::orderBy('id','desc')->paginate(10);
		  
        return view('admin.pages.subscriber',compact('subscriberlist'));
    } 
	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
    	
        $decrypted_id = Crypt::decryptString($id); 

        $subscriber = Subscriber::findOrFail($decrypted_id);
         
		 
		$subscriber->delete();
		
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }
      
    	
}
