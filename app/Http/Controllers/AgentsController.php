<?php

namespace App\Http\Controllers;

use App\User;
use App\Properties; 
 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Str;

class AgentsController extends Controller
{
	public function __construct()
    {
         check_property_exp(); 
    } 

    public function index()
    {  
		$agents = User::where('usertype','Agents')->orderBy('id', 'desc')->paginate(getcong('pagination_limit'));
		 		   
        return view('pages.agents',compact('agents'));
    }


    public function agent_details($id)
    {  
        //$decrypted_id = Crypt::decryptString($id);   

        $agent = User::findOrFail($id);

        $properties = Properties::where(['status'=>'1','user_id'=>$id])->orderBy('id', 'desc')->paginate(getcong('pagination_limit')); 
                   
        return view('pages.agent_details',compact('agent','properties'));
    }
    
     
}
