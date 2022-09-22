<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Properties;
use App\PropertyGallery;
use App\Enquire;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
         
    }
    public function userslist()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }

        if(isset($_GET['keyword']))
        {
             
            $type=$_GET['type'];        
            $keyword=$_GET['keyword'];
        
            
            $allusers = User::SearchUserByKeyword($keyword,$type)->paginate(10);
 
            $allusers->appends($_GET)->links();  
        }
        else
        { 
          
            $allusers = User::where('usertype', '!=', 'Admin')->orderBy('id','desc')->paginate(10);
        }
       
         
        return view('admin.pages.users',compact('allusers'));
    } 
     
    public function addeditUser()    { 
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
          
        return view('admin.pages.addeditUser');
    }
    
    public function addnew(Request $request)
    { 
    	
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
        if(!empty($inputs['id']))
        {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users,id',
                'image_icon' => 'mimes:jpg,jpeg,gif,png' 
                 );
        }
        else
        {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users,id',
                'password' => 'min:6|max:15',
                'image_icon' => 'mimes:jpg,jpeg,gif,png' 
                 );
        }
	    
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);

        }else{

            $user = new User;

        }
		
		 
		//User image
		$user_image = $request->file('image_icon');
		 
        if($user_image){
            
            \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
		    \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');
            
             
            $tmpFilePath = public_path('upload/members/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());
			
            $img = Image::make($user_image);

            $img->fit(450, 450)->save($tmpFilePath.$hardPath.'-b.jpg');
            $img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->image_icon = $hardPath;
             
        }
		 
		$user->usertype = $inputs['usertype'];
		$user->name = $inputs['name'];		 
		$user->email = $inputs['email'];
		$user->phone = $inputs['phone'];
  		$user->about = $inputs['about'];
		$user->facebook = $inputs['facebook'];
		$user->twitter = $inputs['twitter'];
		$user->instagram = $inputs['instagram'];
		$user->linkedin = $inputs['linkedin'];
        $user->status = $inputs['status'];
		
		if($inputs['password'])
		{
			$user->password= bcrypt($inputs['password']); 
		}
		
		
		 
	    $user->save();
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function editUser($id)    
    {     
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }		
    	  $decrypted_id = Crypt::decryptString($id);

          $user = User::findOrFail($decrypted_id);
           
          return view('admin.pages.addeditUser',compact('user'));
        
    }	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
    	
        $decrypted_id = Crypt::decryptString($id);	
        
        if($decrypted_id!=1)
        {

            $property_list = Properties::where('user_id',$decrypted_id)->get();

            foreach ($property_list as $property_data)
            {

                $property_gallery_images = PropertyGallery::where('property_id',$property_data->id)->get();

                foreach ($property_gallery_images as $gallery_images) {

                    \File::delete(public_path() .'/upload/gallery/'.$gallery_images->image_name);

                    $property_gallery_obj = PropertyGallery::findOrFail($gallery_images->id);
                    $property_gallery_obj->delete();
                }

                $property = Properties::findOrFail($property_data->id);
        
                \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
                \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');

                 \File::delete(public_path() .'/upload/floorplan/'.$property->floor_plan.'-b.jpg');
                 \File::delete(public_path() .'/upload/floorplan/'.$property->floor_plan.'-s.jpg');
                 
                $property->delete();
            }    

            $user = User::findOrFail($decrypted_id);
        
            \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
            \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');
                
            $user->delete();
        }
        else
        {
            \Session::flash('flash_message', trans('words.access_denied'));

             return redirect()->back();
        }
 
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }
    
  public function user_export()    
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }

          return Excel::download(new UsersExport, 'users.xlsx');

    }   
   
    	
}
