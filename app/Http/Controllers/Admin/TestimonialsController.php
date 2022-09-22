<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Testimonials;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str; 

class TestimonialsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
         
    }
    public function testimonialslist()
    {  
        if(Auth::User()->usertype!="Admin"){

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
            }
        
    	$alltestimonials = Testimonials::orderBy('id','desc')->get();
		  
        return view('admin.pages.testimonials',compact('alltestimonials'));
    } 
	
	 public function addeditestimonials()    { 
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
          
        return view('admin.pages.addedittestimonial');
    }
    
    public function addnew(Request $request)
    { 
    	
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    $rule=array(
		        'name' => 'required',
				'testimonial' => 'required',
		        'image_name' => 'mimes:jpg,jpeg,gif,png' 
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $testimonial = Testimonials::findOrFail($inputs['id']);

        }else{

            $testimonial = new Testimonials;

        }
		
		 
		//Slide image
		$t_user_image = $request->file('t_user_image');
		 
        if($t_user_image){
            
            \File::delete(public_path() .'/upload/testimonial/'.$testimonial->t_user_image.'.jpg');
		   
            
            $tmpFilePath = public_path('upload/testimonial/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());
			
            $img = Image::make($t_user_image);

            $img->fit(200, 200)->save($tmpFilePath.$hardPath.'.jpg');
             
            $testimonial->t_user_image = $hardPath;
             
        }
		 
		 
		$testimonial->name = $inputs['name'];
        $testimonial->designation = $inputs['designation'];
		$testimonial->testimonial = addslashes($inputs['testimonial']);		 
		  
		 
	    $testimonial->save();
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function edittestimonial($id)    
    {     
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }		
    	  $decrypted_id = Crypt::decryptString($id);	

          $testimonial = Testimonials::findOrFail($decrypted_id);
           
          return view('admin.pages.addedittestimonial',compact('testimonial'));
        
    }	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
    	
        $decrypted_id = Crypt::decryptString($id);

        $testimonial = Testimonials::findOrFail($decrypted_id);
        
		\File::delete(public_path() .'/upload/testimonial/'.$testimonial->t_user_image.'.jpg');
		 
		$testimonial->delete();
		
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }
      
    	
}
