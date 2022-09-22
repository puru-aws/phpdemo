<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
	
	Route::get('/', 'IndexController@index');
	Route::post('login', 'IndexController@postLogin');	
	Route::get('logout', 'IndexController@logout');
	
	
	Route::get('dashboard', 'DashboardController@index');	
	Route::get('profile', 'AdminController@profile');	
	Route::post('profile', 'AdminController@updateProfile');	
	Route::post('profile_pass', 'AdminController@updatePassword');
	
	Route::get('settings', 'SettingsController@settings');
	
	Route::post('settings', 'SettingsController@settingsUpdates');
	Route::post('smtp_email', 'SettingsController@smtp_email_update');
	Route::post('payment_info', 'SettingsController@payment_info_update');
	Route::post('layout_settings', 'SettingsController@layout_settings_update');	
	Route::post('social_links', 'SettingsController@social_links_update');
	Route::post('addthisdisqus', 'SettingsController@addthisdisqus');	
	Route::post('about_us', 'SettingsController@about_us_page');
	Route::post('contact_us', 'SettingsController@contact_us_page');	 
	Route::post('headfootupdate', 'SettingsController@headfootupdate');
	 
	Route::get('slider', 'SliderController@sliderlist');	
	Route::get('slider/addslide', 'SliderController@addeditSlide');	
	Route::post('slider/addslide', 'SliderController@addnew');	
	Route::get('slider/addslide/{id}', 'SliderController@editSlide');	
	Route::get('slider/delete/{id}', 'SliderController@delete');
	
	
	Route::get('testimonials', 'TestimonialsController@testimonialslist');	
	Route::get('testimonials/addtestimonial', 'TestimonialsController@addeditestimonials');	
	Route::post('testimonials/addtestimonial', 'TestimonialsController@addnew');	
	Route::get('testimonials/addtestimonial/{id}', 'TestimonialsController@edittestimonial');	
	Route::get('testimonials/delete/{id}', 'TestimonialsController@delete');
	

	Route::get('properties', 'PropertiesController@propertieslist');	
	Route::get('properties/addproperty', 'PropertiesController@addeditproperty');	
	Route::post('properties/addproperty', 'PropertiesController@addnew');	
	Route::get('properties/addproperty/{id}', 'PropertiesController@editproperty');	
	Route::get('properties/status/{id}', 'PropertiesController@status');	
	Route::get('properties/featuredproperty/{id}', 'PropertiesController@featuredproperty');	
	Route::get('properties/delete/{id}', 'PropertiesController@delete');	
	Route::get('featuredproperties', 'FeaturedPropertiesController@propertieslist');
	Route::get('properties/export', 'PropertiesController@property_export');
	Route::post('properties/plan_update', 'PropertiesController@plan_update');
	 
	Route::get('users', 'UsersController@userslist');	
	Route::get('users/adduser', 'UsersController@addeditUser');	
	Route::post('users/adduser', 'UsersController@addnew');	
	Route::get('users/adduser/{id}', 'UsersController@editUser');	
	Route::get('users/delete/{id}', 'UsersController@delete');	
	Route::get('users/export', 'UsersController@user_export');
	 
	
	Route::get('subscriber', 'SubscriberController@subscriberlist'); 
	Route::get('subscriber/delete/{id}', 'SubscriberController@delete');
	
	
	Route::get('partners', 'PartnersController@partnerslist'); 
	Route::get('partners/addpartners', 'PartnersController@addpartners');	
	Route::post('partners/addpartners', 'PartnersController@addnew');	
	Route::get('partners/addpartners/{id}', 'PartnersController@editpartners');	
	Route::get('partners/delete/{id}', 'PartnersController@delete');
	
	Route::get('inquiries', 'InquiriesController@inquirieslist');  	
	Route::get('inquiries/delete/{id}', 'InquiriesController@delete');	
	
	
	Route::get('types', 'TypesController@typeslist');	
	Route::get('types/addtypes', 'TypesController@addedittypes');	
	Route::post('types/addtypes', 'TypesController@addnew');	
	Route::get('types/addtypes/{id}', 'TypesController@edittypes');		
	Route::get('types/delete/{id}', 'TypesController@delete');
	
	Route::get('subscription_plan', 'SubscriptionPlanController@subscription_plan_list');	
	Route::get('subscription_plan/add_plan', 'SubscriptionPlanController@addSubscriptionPlan'); 
	Route::get('subscription_plan/edit_plan/{id}', 'SubscriptionPlanController@editSubscriptionPlan');	
	Route::post('subscription_plan/add_edit_plan', 'SubscriptionPlanController@addnew');	
	Route::get('subscription_plan/delete/{id}', 'SubscriptionPlanController@delete');

	Route::get('transactions', 'TransactionsController@transactions_list');
	Route::get('transactions/export', 'TransactionsController@transactions_export');
	Route::get('transactions/user_invoice/{id}', 'TransactionsController@user_invoice');

	Route::get('about_page', 'PagesController@about_page');
	Route::post('about_page', 'PagesController@update_about_page');
	Route::get('terms_page', 'PagesController@terms_page');
	Route::post('terms_page', 'PagesController@update_terms_page');
	Route::get('privacy_policy_page', 'PagesController@privacy_policy_page');
	Route::post('privacy_policy_page', 'PagesController@update_privacy_policy_page');
	Route::get('faq_page', 'PagesController@faq_page');
	Route::post('faq_page', 'PagesController@update_faq_page');

});


Route::get('/', 'IndexController@index');

Route::get('page/{slug}', 'PagesController@get_page');
 
Route::get('contact-us', 'IndexController@contact_us_page');
Route::post('contact-us', 'IndexController@contact_us_sendemail');
 
Route::post('subscribe', 'IndexController@subscribe');

Route::get('agents', 'AgentsController@index');
Route::get('user/details/{id}', 'AgentsController@agent_details');

Route::get('properties', 'PropertiesController@index');
Route::get('featured', 'PropertiesController@featuredproperties');
Route::get('sale', 'PropertiesController@saleproperties');
Route::get('rent', 'PropertiesController@rentproperties');
Route::get('properties/{slug}/{id}', 'PropertiesController@single_properties');

Route::get('map/{id}', 'PropertiesController@map_property_urlset');

Route::get('testimonials', 'IndexController@testimonialslist');


Route::get('inquiries', 'UserController@inquirieslist');  
Route::get('inquiries/delete/{id}', 'UserController@delete');


Route::get('type/{slug}', 'PropertiesController@propertiesbytype');

Route::post('agentscontact', 'PropertiesController@agentscontact');

Route::post('searchproperties', 'PropertiesController@searchproperties');

 

Route::get('login', [ 'as' => 'login', 'uses' => 'IndexController@login']);
Route::post('login', 'IndexController@postLogin');

Route::get('register', 'IndexController@register');
Route::post('register', 'IndexController@postRegister');

Route::get('logout', 'IndexController@logout');

Route::get('dashboard', 'UserController@dashboard');
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@profile_update');
Route::get('change_pass', 'UserController@change_pass');
Route::post('update_password', 'UserController@updatePassword');

Route::get('my_properties', 'PropertiesController@my_properties');

Route::get('submit-property', 'PropertiesController@add_property_form');
Route::post('submit-property', 'PropertiesController@addnew');
Route::get('update-property/{id}', 'PropertiesController@editproperty');
Route::get('delete/{id}', 'PropertiesController@delete');
Route::get('gallery_image_delete/{id}', 'PropertiesController@gallery_image_delete');

Route::get('invoice', 'TransactionController@transaction_list');
Route::get('user_invoice/{id}', 'TransactionController@user_invoice');

Route::get('plan/{id}', 'UserController@plan_list');
Route::post('plan_send', 'UserController@plan_send');
Route::get('plan_summary', 'UserController@plan_summary');
Route::post('payment_send', 'UserController@payment_send');


//Route::get('paypal_payment', 'PaypalController@payWithPaypal');
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'payment.status','uses' => 'PaypalController@getPaymentStatus',));

Route::get('stripe', 'StripeController@payWithStripe');
Route::post('stripe', 'StripeController@postPaymentWithStripe');
//Route::post('stripe/charge', 'StripeController@paymentWithStripe');

Route::post('razorpay-success', 'RazorpayController@payment_success');

Route::post('pay', 'PaystackController@redirectToGateway')->name('pay');
Route::get('payment/callback', 'PaystackController@handleGatewayCallback');
 
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('password.reset');;

Route::get('auth/confirm/{code}', 'IndexController@confirm');


Route::get('/sitemap.xml', 'IndexController@sitemap');

/*Route::get('/', function () {
    return view('welcome');
});*/
