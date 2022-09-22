<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Slider;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class SliderController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
         
    }
    public function sliderlist()
    {  
    	$allslider = Slider::orderBy('id')->get();
		  
        return view('admin.pages.slider',compact('allslider'));
    } 
	
	 public function addeditSlide()    { 
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
          
        return view('admin.pages.addeditslider');
    }
    
    public function addnew(Request $request)
    { 
    	
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    $rule=array(
		        'slider_title' => 'required',
		        'image_name' => 'mimes:jpg,jpeg,gif,png' 
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $slide = Slider::findOrFail($inputs['id']);

        }else{

            $slide = new Slider;

        }
		
		 
		//Slide image
		$slide_image = $request->file('image_name');
		 
        if($slide_image){
            
            \File::delete(public_path() .'/upload/slides/'.$slide->image_name.'.jpg');
		   
             
            $tmpFilePath = public_path('upload/slides/');

            $hardPath =  Str::slug($inputs['slider_title'], '-').'-'.md5(time());
			
            $img = Image::make($slide_image);

            $img->fit(1600, 1024)->save($tmpFilePath.$hardPath.'.jpg');
             
            $slide->image_name = $hardPath;
             
        }
		 
		 
		$slide->slider_title = $inputs['slider_title'];
        $slide->slider_text1 = $inputs['slider_text1'];
        $slide->slider_text2 = $inputs['slider_text2'];		 
		  
		 
	    $slide->save();
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function editSlide($id)    
    {     
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }		
    	  $decrypted_id = Crypt::decryptString($id);  

          $slide = Slider::findOrFail($decrypted_id);
           
          return view('admin.pages.addeditslider',compact('slide'));
        
    }	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
    	
        $decrypted_id = Crypt::decryptString($id);

        $slide = Slider::findOrFail($decrypted_id);
        
		\File::delete(public_path() .'/upload/slides/'.$slide->image_name.'.jpg');
		 
		$slide->delete();
		
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }
      
    	
}
