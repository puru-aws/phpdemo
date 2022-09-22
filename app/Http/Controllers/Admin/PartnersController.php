<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Partners;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class PartnersController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
         
    }
    public function partnerslist()
    {   
        if(Auth::User()->usertype!="Admin"){

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
            }
        
    	$partnerslist = Partners::orderBy('id')->get();
		  
        return view('admin.pages.partnerslist',compact('partnerslist'));
    } 
	
	 public function addpartners()    { 
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
          
        return view('admin.pages.addpartners');
    }
    
    public function addnew(Request $request)
    { 
    	
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    $rule=array(
		        'name' => 'required',
				'url' => 'required',
		        'partner_image' => 'mimes:jpg,jpeg,gif,png' 
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $partners = Partners::findOrFail($inputs['id']);

        }else{

            $partners = new Partners;

        }
		
		 
		//Slide image
		$partner_image = $request->file('partner_image');
		 
        if($partner_image){
            
            \File::delete(public_path() .'/upload/partners/'.$partners->partner_image.'.jpg');
		   
             
            $tmpFilePath = public_path('upload/partners/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());
			
            $img = Image::make($partner_image);

            //$img->fit(345, 230)->save($tmpFilePath.$hardPath.'.jpg');
            $img->save($tmpFilePath.$hardPath.'.jpg');
             
            $partners->partner_image = $hardPath;
             
        }
		 
		 
		$partners->name = $inputs['name'];
		$partners->url = $inputs['url'];		 
		  
		 
	    $partners->save();
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function editpartners($id)    
    {     
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }		
    	  $decrypted_id = Crypt::decryptString($id);

          $partners = Partners::findOrFail($decrypted_id);
           
          return view('admin.pages.addpartners',compact('partners'));
        
    }	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
    	
        $decrypted_id = Crypt::decryptString($id);

        $partners = Partners::findOrFail($decrypted_id);
        
		\File::delete(public_path() .'/upload/partners/'.$partners->partner_image.'.jpg');
		 
		$partners->delete();
		
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }
      
    	
}
