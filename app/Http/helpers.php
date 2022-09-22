<?php
use App\Settings;
use App\User;
use App\Properties;
use App\Types;
use App\Transactions;

if (! function_exists('putPermanentEnv')) {

 function putPermanentEnv($key, $value)
{
    $path = app()->environmentFilePath();

    $escaped = preg_quote('='.env($key), '/');

    file_put_contents($path, preg_replace(
        "/^{$key}{$escaped}/m",
        "{$key}={$value}",
        file_get_contents($path)
    ));
}

}
 
if (! function_exists('check_property_exp')) {

    function check_property_exp()
    {
        $today_date=strtotime(date('m/d/Y'));

        $proeprty_list = Properties::where('status',1)->where('property_exp_date','<=',$today_date)->get(); 

        //dd($proeprty_list);
        //exit;

        foreach($proeprty_list as $i => $property_info)
        { 
            $property_id =$property_info->id;
            $property_obj = Properties::findOrFail($property_id);
            $property_obj->status = 0;
            $property_obj->save();


            //Email Notification
            if(getenv("MAIL_USERNAME"))
            {
                $user = User::findOrFail($property_info->user_id);
                $user_name=$user->name;
                $user_email=$user->email;

                $data_email = array(
                    'name' => $user_name,
                    'property_name' => $property_info->property_name
                     );    
                 
                \Mail::send('emails.expiry_notice', $data_email, function($message) use ($user_name,$user_email){
                    $message->to($user_email, $user_name)
                    ->from(getcong('site_email'), getcong('site_name'))
                    ->subject(getcong('site_name').' Property expired notice');
                });

            }

        }

        return true;
    }
}

if (! function_exists('getcong')) {

    function getcong($key)
    {
    	 
        $settings = Settings::findOrFail('1'); 

        return $settings->$key;
    }
}
 
if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if (!function_exists('classActivePathPublic')) {
    function classActivePathPublic($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' current';
    }
}

if (!function_exists('classActiveUserMenu')) {
    function classActiveUserMenu($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return 'active';
    }
}

if (! function_exists('getUserInfo')) {
	function getUserInfo($id) 
	{ 
		return User::find($id);
	}
}

if (! function_exists('countPropertyType')) {
	function countPropertyType($type_id) 
	{ 
		return Properties::where(['status'=>1,'property_type'=>$type_id])->count();
	}
}

if (! function_exists('PropertyTypeName')) {
	function getPropertyTypeName($id) 
	{ 
		return Types::find($id);
	}
}

function format_price($price, $post = 1)
{
    if ($post === 1)
    {
        $formatted_price = number_format($price, 0, ',', ',');
    } else {
        $formatted_price = number_format($price, 0);
    }

    return $formatted_price;
}

if (!function_exists('generate_timezone_list')) {
function generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );

    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    ksort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
    }

    return $timezone_list;
}

} 

if (!function_exists('plan_count_by_month')) {
    function plan_count_by_month($plan_id,$month_name)
    {       
            //echo $month_name;

             $start_month = date('Y-m-d', strtotime('first day of '.$month_name.''));
             $finish_month = date('Y-m-d', strtotime('last day of '.$month_name.''));
             
            $monthly_plan_purchase = Transactions::where('plan_id',$plan_id)->whereBetween('date', array(strtotime($start_month), strtotime($finish_month)))->count();

            return $monthly_plan_purchase;
    }
}
