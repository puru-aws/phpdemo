<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Pages;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 

use Session;

class PagesController extends Controller
{
	public function __construct()
    {
         check_property_exp(); 
    }
      
    public function get_page($slug)
    {   
    	   
       $page_info = Pages::where('page_slug',$slug)->first();         
       
       return view('pages.pages',compact('page_info'));
        
    }     
}
