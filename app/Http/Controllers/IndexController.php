<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Properties;
use App\Testimonials;
use App\Subscriber;
use App\Partners;

use Mail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str; 

 
class IndexController extends Controller
{
	public function __construct()
    {
         
    }     
    
    public function index()
    {   
       if(!$this->alreadyInstalled()) {
            // return redirect('public/install');
        }

        // check_property_exp(); 

		$propertieslist = Properties::where('status','1')->orderBy('id', 'desc')->take(6)->get();

        $featured_properties = Properties::where('status','1')->where('featured_property','1')->orderBy('id', 'desc')->take(6)->get();		
 		
		$partners = Partners::orderBy('id', 'desc')->get();
							   
        return view('pages.index',compact('propertieslist','featured_properties','partners'));
    }
 
    public function testimonialslist()
    {  
        $alltestimonials = Testimonials::orderBy('id','desc')->paginate(10);
          
        return view('pages.testimonials',compact('alltestimonials'));
    }

    public function alreadyInstalled()
    {    
        return file_exists(base_path('/public/.lic'));
    }
    
    public function subscribe(Request $request)
    {
    	
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    $rule=array(
		        'email' => 'required|email|max:75' 
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                 \Session::flash('error_flash_message', 'The email field is required.
');
                return redirect('/#top-footer');

        } 
    	
    	$subscriber = new Subscriber;
    	 
    	$subscriber->email = $inputs['email'];
    	$subscriber->ip = $_SERVER['REMOTE_ADDR'];
		  
		 
	    $subscriber->save();

       \Session::flash('flash_message_subscribe', trans('words.successfully_subscribe'));

        return redirect('/#top-footer');	     
    	 
    }
	 
	public function aboutus_page()
    {   				   
        return view('pages.about');
    }

    public function pricing_plan()
    {                      
        return view('pages.pricing_plan');
    }
     
    public function contact_us_page()
    {   				   	
        return view('pages.contact');
    }
    
    public function contact_us_sendemail(Request $request)
    {   
    	
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    $rule=array(
		        'name' => 'required',
				'email' => 'required|email',
		        'your_message' => 'required' 
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages())->withInput();
        } 
        
        
        $data_email = array(
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
                'website' => $inputs['website'],
                'your_message' => $inputs['your_message']
                );    
        if(getenv("MAIL_USERNAME"))
        {
            \Mail::send('emails.contact', $data_email, function($message) use ($inputs){
                    $message->to(getcong('contact_us_email'), getcong('site_name'))
                    ->from(getcong('site_email'), getcong('site_name'))
                    ->subject(getcong('site_name').' Contact');
            });
        }

         \Session::flash('flash_message_contact', trans('words.thanks_for_contacting_us'));

 		 return \Redirect::back();
    }
    
    
    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {   
    	if (Auth::check()) {
                        
            return redirect('dashboard'); 
        }
 
        return view('pages.login');
    } 
     
	 
    public function postLogin(Request $request)
    {
    	
    //echo bcrypt('123456');
    //exit;	
    if(getcong('recaptcha')==1)
    {  	
      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required','g-recaptcha-response' => 'required|captcha' 
        ]);
    }
    else
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required'
        ]);
    }

        $credentials = $request->only('email', 'password');

		 
		
         if (Auth::attempt($credentials, $request->has('remember'))) {

            if(Auth::user()->status=='0'){
                \Auth::logout();   

                \Session::flash('login_error_flash_msg', 'Required');               
                return redirect('/login')->withErrors(trans('words.account_not_activated_msg'));
            }

            return $this->handleUserWasAuthenticated($request);
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');

       \Session::flash('login_error_flash_msg', 'Required'); 
       return redirect('/login')->withErrors(trans('words.email_password_invalid'));
        
    }
    
     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/dashboard'); 
    }
    
    public function register()
    {   
    	if (Auth::check()) {
                        
            return redirect('admin/dashboard'); 
        }
        
        return view('pages.register');
    }
    
    public function postRegister(Request $request)
    { 
    	
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
       if(getcong('recaptcha')==1)
       { 

	        $rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:75|unique:users',
		        'password' => 'required|min:3|confirmed',
                'g-recaptcha-response' => 'required|captcha' 
		   		 );	      

        }
        else
        {

            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users',
                'password' => 'required|min:3|confirmed'  
                 );

        }


	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		  
        $user = new User;
  
		$string = Str::random(15); 
		$user_name= $inputs['name'];
		$user_email= $inputs['email'];
		 
		$user->usertype = 'User';
		$user->name = $user_name;		 
		$user->email = $user_email;		 
		$user->password= bcrypt($inputs['password']); 
 		 
		$user->confirmation_code= $string;
		 
	    $user->save();
		
		 
        //Verify user
        $user_name=$inputs['name'];

        $data_email = array(
        'name' => $user_name,      
        'confirmation_code' => $string
        );    

        if(getenv("MAIL_USERNAME"))
        {
            \Mail::send('emails.verify', $data_email, function($message) use ($inputs){
                $message->to($inputs['email'], $inputs['name'])
                ->from(getcong('site_email'), getcong('site_name'))
                ->subject('Welcome to'.getcong('site_name'));
            });
        }
		 

            \Session::flash('flash_message', trans('words.verify_account_msg'));

            return \Redirect::back(); 
         
    }
    
    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        //return redirect('admin/');
        return redirect('/');
    }
    
    public function confirm($code)
    {   
    	 
        $user = User::where('confirmation_code',$code)->first();
 		
 		$user->status = '1'; 	
 		
 		$user->save();
 		
 		\Session::flash('flash_message', trans('words.confirmation_msg'));
 		
        return redirect('login/');
        //return view('pages.login');
    }

    public function sitemap()
    {
        $site_url=\URL::to('/'); 

        $properties = Properties::where(['status'=>'1'])->orderBy('id', 'desc')->get();

        return response()->view('pages.sitemap',compact('site_url','properties'))->header('Content-Type', 'text/xml');
    }
    
}