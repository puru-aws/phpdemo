@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{trans('words.settings')}}</h2>
		<a href="{{ URL::to('admin/dashboard') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
	  
	</div>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="padding-bottom: 10px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            <li style="list-style: none;"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button></li>
        </ul>

    </div>
@endif
	 @if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
				@endif
    <div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#account" aria-controls="account" role="tab" data-toggle="tab">{{trans('words.general_settings')}}</a>
        </li>
        <li role="presentation">
            <a href="#smtp_email" aria-controls="smtp_email" role="tab" data-toggle="tab">{{trans('words.smtp_email')}}</a>
        </li>
        <li role="presentation">
            <a href="#payment_info" aria-controls="payment_info" role="tab" data-toggle="tab">{{trans('words.payment_info')}}</a>
        </li>
        <li role="presentation">
            <a href="#layout_settings" aria-controls="layout_settings" role="tab" data-toggle="tab">{{trans('words.layout')}}</a>
        </li>        
        <li role="presentation">
            <a href="#social_links" aria-controls="social_links" role="tab" data-toggle="tab">{{trans('words.social')}}</a>
        </li>
        <li role="presentation">
            <a href="#share_comments" aria-controls="share_comments" role="tab" data-toggle="tab">AddThis & Disqus</a>
        </li>         
        <li role="presentation">
            <a href="#contact_us" aria-controls="contact_us" role="tab" data-toggle="tab">{{trans('words.contact_us')}}</a>
        </li>         
        
        <li role="presentation">
            <a href="#other_Settings" aria-controls="other_Settings" role="tab" data-toggle="tab">{{trans('words.other_settings')}}</a>
        </li>        
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content tab-content-default">
        <div role="tabpanel" class="tab-pane active" id="account">             
            {!! Form::open(array('url' => 'admin/settings','class'=>'form-horizontal padding-15','name'=>'account_form','id'=>'account_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                

                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">{{trans('words.logo')}}</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if($settings->site_logo)
                                 
									<img src="{{ URL::asset('upload/'.$settings->site_logo) }}" width="150" alt="person">
								@endif
								                                
                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="site_logo" class="filestyle">
                                <small class="text-muted bold">Size 200x75px</small>
                            </div>
                        </div>
	
                    </div>
                </div>
				<div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">{{trans('words.favicon')}}</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if($settings->site_favicon)
                                 
									<img src="{{ URL::asset('upload/'.$settings->site_favicon) }}" alt="person">
								@endif
								                                
                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="site_favicon" class="filestyle">
                                <small class="text-muted bold">Size 16x16px</small>
                            </div>
                        </div>
	
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.site_name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.site_email')}}</label>
                    <div class="col-sm-9">
                        <input type="email" name="site_email" value="{{ $settings->site_email }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.currency_sign')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="currency_sign" value="{{ $settings->currency_sign }}" class="form-control" value="" placeholder="$">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.google_map_key')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="google_map_key" value="{{ $settings->google_map_key }}" class="form-control" value="" placeholder="xxxx">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.default_timezone')}}</label>
                    <div class="col-sm-4"> 
                        <select class="selectpicker show-tick form-control" name="time_zone" data-live-search="true">                               
                                @foreach(generate_timezone_list() as $key=>$tz_data)
                                <option value="{{$key}}" @if($settings->time_zone==$key) selected @endif>{{$tz_data}}</option>
                                @endforeach                            
                            </select>
                        
                    </div>
                </div>
                <hr>                 
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.recaptcha')}}</label>
                    <div class="col-sm-4"> 
                        <select name="recaptcha" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                 
                                <option value="1" @if($settings->recaptcha== 1) selected @endif> On</option>
                                <option value="0" @if($settings->recaptcha== 0) selected @endif> Off</option>
  
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.recaptcha_secret_key')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="recaptcha_secret_key" value="{{ $settings->recaptcha_secret_key }}" class="form-control" value="" placeholder="xxxx">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.recaptcha_site_key')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="recaptcha_site_key" value="{{ $settings->recaptcha_site_key }}" class="form-control" value="" placeholder="xxxx">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.site_description')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="site_description" class="form-control" rows="5" placeholder="A few words about site">{{ $settings->site_description }}</textarea>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.site_keywords')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="site_keywords" class="form-control" rows="5" placeholder="Seo keywords">{{ $settings->site_keywords }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.footer_widget1_title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="footer_widget1_title" value="{{ stripslashes($settings->footer_widget1_title) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.footer_widget1')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="footer_widget1" class="form-control" rows="5" placeholder="">{{ stripslashes($settings->footer_widget1) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.footer_widget2_title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="footer_widget2_title" value="{{ stripslashes($settings->footer_widget2_title) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.footer_widget2')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="footer_widget2" class="form-control" rows="5" placeholder="">{{ stripslashes($settings->footer_widget2) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.footer_widget3_title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="footer_widget3_title" value="{{ stripslashes($settings->footer_widget3_title) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.footer_widget3')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="footer_widget3" class="form-control" rows="5" placeholder="">{{ stripslashes($settings->footer_widget3) }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.copyright_text')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="site_copyright" class="form-control" rows="5">{{ $settings->site_copyright }}</textarea>
                    </div>
                </div>
                <hr/>
                  <div class="form-group"> 
                   <label class="col-sm-3 control-label"><b style="font-size: 18px;">{{trans('words.gdpr_cookie_consent')}}</b></label>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.gdpr_cookie_title')}}</label>
                    <div class="col-sm-9">
                      <input type="text" name="gdpr_cookie_title" value="{{ isset($settings->gdpr_cookie_title) ? stripslashes($settings->gdpr_cookie_title) : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.gdpr_cookie_text')}}</label>
                    <div class="col-sm-9">
                      <input type="text" name="gdpr_cookie_text" value="{{ isset($settings->gdpr_cookie_text) ? stripslashes($settings->gdpr_cookie_text) : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.gdpr_cookie_url')}}</label>
                    <div class="col-sm-9">
                      <input type="text" name="gdpr_cookie_url" value="{{ isset($settings->gdpr_cookie_url) ? stripslashes($settings->gdpr_cookie_url) : null }}" class="form-control">
                    </div>
                  </div>
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                         
                    </div>
                </div>

            {!! Form::close() !!} 
        </div>
        <div role="tabpanel" class="tab-pane" id="smtp_email">
            
            {!! Form::open(array('url' => 'admin/smtp_email','class'=>'form-horizontal padding-15','name'=>'social_links_form','id'=>'social_links_form','role'=>'form')) !!}
                 
                 
                <h5 class="m-b-5"><i class="fa fa-envelope"></i> <b>{{trans('words.smtp_settings')}}</b></h5>
                 
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.smtp_host')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="smtp_host" value="{{ isset($settings->smtp_host) ? $settings->smtp_host : null }}" class="form-control" placeholder="mail.example.com">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.smtp_port')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="smtp_port" value="{{ isset($settings->smtp_port) ? $settings->smtp_port : null }}" class="form-control" placeholder="587">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.email')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="smtp_email" value="{{ isset($settings->smtp_email) ? $settings->smtp_email : null }}" class="form-control" placeholder="info@example.com">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.password')}}*</label>
                    <div class="col-sm-8">
                      <input type="password" name="smtp_password" value="{{ isset($settings->smtp_password) ? $settings->smtp_password : null }}" class="form-control" placeholder="****">
                    </div>
                  </div>   
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.encryption')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="smtp_encryption">                               
                                 
                                <option value="TLS" @if($settings->smtp_encryption=="TLS") selected @endif>TLS</option>
                                <option value="SSL" @if($settings->smtp_encryption=="SSL") selected @endif>SSL</option>
                                  
                            </select>
                      </div>
                  </div>
                 
                <hr>
                 <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                    </div>
                </div>

            {!! Form::close() !!} 
        </div>
        <div role="tabpanel" class="tab-pane" id="payment_info">
            
            {!! Form::open(array('url' => 'admin/payment_info','class'=>'form-horizontal padding-15','name'=>'social_links_form','id'=>'social_links_form','role'=>'form')) !!}
                 
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.currency_code')}}*<br><small class="form-text text-muted">If you don't know <a href="https://developer.paypal.com/docs/api/reference/currency-codes/" target="_blank">click here</a></small></label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="currency_code" value="{{ $settings->currency_code }}" class="form-control" value="" placeholder="USD">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.tax_percentage')}}</label>
                    
                    <div class="col-sm-9">                         
                        <input id="touch-spin-1" data-toggle="touch-spin" data-min="0" data-max="100" data-postfix="%" data-step="0.01" data-decimals="2" type="text" value="{{ $settings->tax_percentage }}" name="tax_percentage"/>
                    </div>
                </div>
                <hr>  
                <h5 class="m-b-5"><i class="fa fa-cc-paypal"></i> <b>Paypal Settings</b></h5>
                <small id="emailHelp" class="form-text text-muted">For more info <a href="https://developer.paypal.com/docs/integration/admin/manage-apps/#create-or-edit-sandbox-and-live-apps" target="_blank">click here</a></small>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.paypal_payment')}}</label>
                    
                    <div class="col-sm-9">
                        <select name="paypal_payment_on_off" id="basic" class="form-control" data-live-search="true">
                                 
                                <option value="1" @if($settings->paypal_payment_on_off== 1) selected @endif> ON</option>
                                <option value="0" @if($settings->paypal_payment_on_off== 0) selected @endif> OFF</option>
  
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.payment_mode')}}</label>
                    
                    <div class="col-sm-9">
                        <select class="form-control" name="paypal_mode">                               
                                <option value="sandbox" @if($settings->paypal_mode=="sandbox") selected @endif>Sandbox</option>
                                <option value="live" @if($settings->paypal_mode=="live") selected @endif>Live</option>                            
                            </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.paypal_client_id')}}</label>
                    <div class="col-sm-9">
                      <input type="text" name="paypal_client_id" value="{{ isset($settings->paypal_client_id) ? $settings->paypal_client_id : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.paypal_secret')}}</label>
                    <div class="col-sm-9">
                      <input type="text" name="paypal_secret" value="{{ isset($settings->paypal_secret) ? $settings->paypal_secret : null }}" class="form-control">
                    </div>
                </div>
                <hr>  
                <h5 class="m-b-5"><i class="fa fa-cc-stripe"></i> <b>Stripe Settings</b></h5>
                 <small id="emailHelp" class="form-text text-muted">For more info <a href="https://support.stripe.com/questions/locate-api-keys" target="_blank">click here</a></small>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.stripe_payment')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="stripe_payment_on_off">                               
                                 
                                <option value="1" @if($settings->stripe_payment_on_off=="1") selected @endif>ON</option>
                                <option value="0" @if($settings->stripe_payment_on_off=="0") selected @endif>OFF</option>
                                              
                            </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">{{trans('words.stripe_secret')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="stripe_secret_key" value="{{ isset($settings->stripe_secret_key) ? $settings->stripe_secret_key : null }}" class="form-control">
                    </div>
                  </div>
                <hr>  
                <h5 class="m-b-5"><i class="fa fa-rupee"></i> <b>Razorpay Settings</b></h5>
                 <small id="emailHelp" class="form-text text-muted">For more info <a href="https://razorpay.com/docs/payment-gateway/dashboard-guide/settings/#api-keys" target="_blank">click here</a></small>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.razorpay_payment')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="razorpay_payment_on_off">                               
                                 
                                <option value="1" @if($settings->razorpay_payment_on_off=="1") selected @endif>ON</option>
                                <option value="0" @if($settings->razorpay_payment_on_off=="0") selected @endif>OFF</option>
                                              
                            </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">{{trans('words.razorpay_key_id')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="razorpay_key" value="{{ isset($settings->razorpay_key) ? $settings->razorpay_key : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">{{trans('words.razorpay_key_secret')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="razorpay_secret" value="{{ isset($settings->razorpay_secret) ? $settings->razorpay_secret : null }}" class="form-control">
                    </div>
                  </div>
                <hr>  
                <h5 class="m-b-5">₦ <b>Paystack Settings</b></h5>
                 <small id="emailHelp" class="form-text text-muted">For more info <a href="https://support.paystack.com/hc/en-us/articles/360009881600-Paystack-Test-Keys-Live-Keys-and-Webhooks" target="_blank">click here</a></small>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('words.paystack_payment')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="paystack_payment_on_off">                               
                                 
                                <option value="1" @if($settings->paystack_payment_on_off=="1") selected @endif>ON</option>
                                <option value="0" @if($settings->paystack_payment_on_off=="0") selected @endif>OFF</option>
                                              
                            </select>
                      </div>
                  </div>
                   
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">{{trans('words.paystack_secret_key')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="paystack_secret_key" value="{{ isset($settings->paystack_secret_key) ? $settings->paystack_secret_key : null }}" class="form-control">
                    </div>
                  </div>  
                <hr>                  
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.bank_payment')}}                         
                    </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="bank_payment_details" class="form-control summernote" rows="5">{{ stripslashes($settings->bank_payment_details) }}</textarea>
                    </div>
                </div>
                <hr>                  
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.invoice_company')}}                             
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="invoice_company" value="{{ isset($settings->invoice_company) ? $settings->invoice_company : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.invoice_address')}}                        
                    </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="invoice_address" class="form-control" rows="5">{{ isset($settings->invoice_address) ? $settings->invoice_address : null }}</textarea>
                    </div>
                </div>
                <hr>
                 <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                    </div>
                </div>

            {!! Form::close() !!} 
        </div>

        <div role="tabpanel" class="tab-pane" id="layout_settings">
            
            {!! Form::open(array('url' => 'admin/layout_settings','class'=>'form-horizontal padding-15','name'=>'social_links_form','id'=>'social_links_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                 
                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">{{trans('words.title_bg_image')}}</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if($settings->title_bg)                                 
                                    <img src="{{ URL::asset('upload/'.$settings->title_bg) }}" width="150" alt="person">
                                @endif
                                                                
                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="title_bg" class="filestyle">                                 
                            </div>
                        </div>
    
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.default_map_lat')}}</label>
                    
                    <div class="col-sm-3">
                        <input type="text" name="map_latitude" value="{{ $settings->map_latitude }}" class="form-control" value="">
                    </div>
                    <label for="" class="col-sm-3 control-label">{{trans('words.default_map_long')}}</label>
                    
                    <div class="col-sm-3">
                        <input type="text" name="map_longitude" value="{{ $settings->map_longitude }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.home_page')}}</label>                    
                    <div class="col-sm-6">
                        <select name="home_properties_layout" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                 <option value="slider" @if($settings->home_properties_layout=='slider') selected @endif>Slider</option>
                                <option value="map" @if($settings->home_properties_layout=='map') selected @endif>Map</option>
                                 
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.properties_page')}}</label>                    
                    <div class="col-sm-6">
                        <select name="all_properties_layout" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                 <option value="grid" @if($settings->all_properties_layout=='grid') selected @endif>Property Listing - Grid</option>
                                <option value="grid_side" @if($settings->all_properties_layout=='grid_side') selected @endif>Property Listing - Grid with Sidebar</option>
                                                                
  
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.featured_properties_page')}}</label>                    
                    <div class="col-sm-6">
                        <select name="featured_properties_layout" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                 <option value="grid" @if($settings->featured_properties_layout=='grid') selected @endif>Property Listing - Grid</option>
                                <option value="grid_side" @if($settings->featured_properties_layout=='grid_side') selected @endif>Property Listing - Grid with Sidebar</option>
                                                                
  
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.sale_properties')}}</label>                    
                    <div class="col-sm-6">
                        <select name="sale_properties_layout" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                 <option value="grid" @if($settings->sale_properties_layout=='grid') selected @endif>Property Listing - Grid</option>
                                <option value="grid_side" @if($settings->sale_properties_layout=='grid_side') selected @endif>Property Listing - Grid with Sidebar</option>
                                                                
  
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.rent_properties')}}</label>                    
                    <div class="col-sm-6">
                        <select name="rent_properties_layout" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                 <option value="grid" @if($settings->rent_properties_layout=='grid') selected @endif>Property Listing - Grid</option>
                                <option value="grid_side" @if($settings->rent_properties_layout=='grid_side') selected @endif>Property Listing - Grid with Sidebar</option>
                                                                
  
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.pagination_limit')}} <br/><small class="text-muted bold">({{trans('words.per_page_properties')}})</small></label>
                    
                    <div class="col-sm-6">
                        <input type="number" name="pagination_limit" value="{{ $settings->pagination_limit }}" class="form-control" value="">
                    </div>
                     
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                         
                    </div>
                </div>
            {!! Form::close() !!} 
        </div>
 

        <div role="tabpanel" class="tab-pane" id="social_links">
            
            {!! Form::open(array('url' => 'admin/social_links','class'=>'form-horizontal padding-15','name'=>'social_links_form','id'=>'social_links_form','role'=>'form')) !!}
                 
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Facebook URL</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="social_facebook" value="{{ $settings->social_facebook }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Twitter URL</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="social_twitter" value="{{ $settings->social_twitter }}" class="form-control" value="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin URL</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="social_linkedin" value="{{ $settings->social_linkedin }}" class="form-control" value="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Instagram URL</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="social_instagram" value="{{ $settings->social_instagram }}" class="form-control" value="">
                    </div>
                </div>
                 
                <hr>
                 <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                    </div>
                </div>

            {!! Form::close() !!} 
        </div>
        
        <div role="tabpanel" class="tab-pane" id="share_comments">
            
            {!! Form::open(array('url' => 'admin/addthisdisqus','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                
                 
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">AddThis Code
                     <br><small class="text-muted bold">Get code <a href="https://www.addthis.com" target="_blank">here!</a></small>   
                    </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="addthis_share_code" class="form-control" rows="5">{{ $settings->addthis_share_code }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Disqus Code
                    <br><small class="text-muted bold">Get code <a href="https://disqus.com" target="_blank">here!</a></small>
                   </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="disqus_comment_code" class="form-control" rows="5">{{ $settings->disqus_comment_code }}</textarea>
                    </div>
                </div>
                 
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                    </div>
                </div>

            {!! Form::close() !!} 
        </div>        
         
        <div role="tabpanel" class="tab-pane" id="contact_us">
            
            {!! Form::open(array('url' => 'admin/contact_us','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                
                 
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.contact_us_title')}}</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="contact_us_title" value="{{ $settings->contact_us_title }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.contact_lat')}}</label>
                    
                    <div class="col-sm-3">
                        <input type="text" name="contact_lat" value="{{ $settings->contact_lat }}" class="form-control" value="">
                    </div>
                    <label for="" class="col-sm-3 control-label">{{trans('words.contact_long')}}</label>
                    
                    <div class="col-sm-3">
                        <input type="text" name="contact_long" value="{{ $settings->contact_long }}" class="form-control" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.contact_us_email')}}</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="contact_us_email" value="{{ $settings->contact_us_email }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.contact_us_phone')}}</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="contact_us_phone" value="{{ $settings->contact_us_phone }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.contact_us_address')}}</label>
                    
                    <div class="col-sm-9">
                        <input type="text" name="contact_us_address" value="{{ $settings->contact_us_address }}" class="form-control" value="">
                    </div>
                </div> 
                 
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                    </div>
                </div>

            {!! Form::close() !!} 
        </div>
         
        <div role="tabpanel" class="tab-pane" id="other_Settings">
            
            {!! Form::open(array('url' => 'admin/headfootupdate','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                
                 
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.header_code')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="site_header_code" class="form-control" rows="5" placeholder="You may want to add some css/js code to header. ">{{ $settings->site_header_code }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.footer_code')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="site_footer_code" class="form-control" rows="5" placeholder="You may want to add some css/js code to footer. ">{{ $settings->site_footer_code }}</textarea>
                    </div>
                </div>
                 
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                    </div>
                </div>

            {!! Form::close() !!} 
        </div>
         
    </div>
</div>
</div>

@endsection