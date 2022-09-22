<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Properties;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeaturedPropertiesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
         
    }
    public function propertieslist()
    {  
        if(Auth::User()->usertype!="Admin"){

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
            }
        
    	$propertieslist = Properties::where('featured_property','1')->orderBy('id')->get();
		  
        return view('admin.pages.featuredproperty',compact('propertieslist'));
    } 
	 
}
