@extends("app")

@section('head_title', trans('words.plan').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

<style type="text/css">
 
 .payment-option .well {
  background: #f9f9f9;
  border: none;
  margin-top: 20px
}
.payment-option .btn-submit {
  margin-top: 60px
}
.payment-option .well p {
  margin: 0
}
.payment-option label {
  padding-right: 10px
}
.paypal-icon {
  padding-left: 10px
}
.payment {
  border: 2px solid #f2f2f2;
  border-radius: 4px;
  overflow: hidden;
  padding: 20px;
}
.payment-tab {
  background: #f9f9f9;
  border-radius: 4px;
  margin-bottom: 10px;
  box-sizing: border-box;
  padding: 10px 20px;
  overflow: hidden;
  position: relative;
  transition: all .3s 0s ease-in-out;
  width: 100%;
} 

.payment-button
  {
    text-align: center;
    background: #48a0dc;
    padding: 6px 20px;
    line-height: 24px;
    font-size: 14px;
    font-weight: 500;
    border: 0px solid transparent;
    border-radius: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    color: #ffffff;
    -webkit-transition: all .5s ease 0;
    transition: all .5s ease 0;
    transition: all 0.5s ease 0s;
}
</style>

<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.plan')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.plan')}}</a></li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->
 <div class="container">
  <div class="min_profile">
  <div class="row">
    @include("_particles.sidebar_user")

    <div class="col-lg-9 col-md-9 min_form">
      @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('flash_message') }}
                  </div>
      @endif
      <div class="table-responsive properties_min">
        
        {!! Form::open(array('url' => 'plan_send','class'=>'','id'=>'myProfile','role'=>'form')) !!} 
                
                <input type="hidden" name="property_id" value="{{$property_id}}">
                
                <div class="form-group col-md-12">

                  <label for="payment" class="control-label"><h4>{{trans('words.select_plan_for')}} <span style="color: #0aa216;">{{Session::get('payment_property_name')}}</span></h4></label>

                  <div class="payment">
                       <div class="payment-tab">
                     
                    <select id="plan_id" name="plan_id" required>
                          @foreach($subscription_plan as $i => $plan_obj) 
                             
                            <option value="{{$plan_obj->id}}">{{$plan_obj->plan_name.' - '}} {!!getcong('currency_sign')!!} {{$plan_obj->plan_price}} For {{ App\SubscriptionPlan::getPlanDuration($plan_obj->id) }}</option> 
                                               
                          @endforeach
                    </select>
                   </div>
                   </div> 
                </div>
                <div class="form-group col-md-12">
                  <label for="payment" class="control-label"><h4>{{trans('words.payment_method')}}</h4></label>
                   
                      <div class="payment">
                       
                       @if(getcong('paypal_payment_on_off')) 
                       <div class="payment-tab">
                          <div class="payment-tab-trigger">
                              <input name="payment_method" checked="" class="payment_method_id" id="paypal" type="radio" value="paypal" data-name="paypal">
                              <label for="paypal">Paypal &nbsp;<img class="payment-logo paypal" src="{{ URL::asset('upload/paypal-logo.png')}}" alt="" width="70"></label> 
                              
                          </div>
                           
                      </div>
                      @endif

                      @if(getcong('stripe_payment_on_off')) 
                      <div class="payment-tab">
                          <div class="payment-tab-trigger">
                              <input name="payment_method" class="payment_method_id" id="stripe" type="radio" value="stripe" data-name="stripe" @if(getcong('paypal_payment_on_off')==0) checked="" @endif>
                              <label for="stripe">Stripe &nbsp;<img class="payment-logo stripe" src="{{ URL::asset('upload/stripe-logo.png')}}" alt="" width="60"></label> 
                          </div>
     
                      </div>
                      @endif

                      @if(getcong('razorpay_payment_on_off')) 
                      <div class="payment-tab">
                          <div class="payment-tab-trigger">
                              <input name="payment_method" class="payment_method_id" id="razorpay" type="radio" value="razorpay" data-name="razorpay" @if(getcong('paypal_payment_on_off')==0) checked="" @endif>
                              <label for="razorpay">Razorpay &nbsp;<img class="payment-logo razorpay" src="{{ URL::asset('upload/razorpay_logo.png')}}" alt=""></label> 
                          </div>
     
                      </div>
                      @endif

                      @if(getcong('paystack_payment_on_off')) 
                      <div class="payment-tab">
                          <div class="payment-tab-trigger">
                              <input name="payment_method" class="payment_method_id" id="paystack" type="radio" value="paystack" data-name="paystack" @if(getcong('paypal_payment_on_off')==0) checked="" @endif>
                              <label for="paystack">Paystack &nbsp;<img class="payment-logo paystack" src="{{ URL::asset('upload/paystack_logo.png')}}" alt=""></label> 
                          </div>
     
                      </div>
                      @endif
                        {{getcong('paypal_payment_on_off')}}
                       @if(getcong('paypal_payment_on_off')==0 AND getcong('stripe_payment_on_off') == 0 AND getcong('razorpay_payment_on_off') == 0 AND getcong('paystack_payment_on_off') == 0)
                          {{trans('words.no_active_payment_method')}}
                        }
                      @endif

                      </div> 

                </div>
               @if(getcong('paypal_payment_on_off') OR getcong('stripe_payment_on_off') OR getcong('razorpay_payment_on_off') OR getcong('paystack_payment_on_off'))  
               <div class="form-group col-md-12">
                <div class="center mb20" align="center">
                    <input class="payment-button" type="submit" value="{{trans('words.select_plan')}}">
                </div>
               </div>  
               @endif            
            
            

            {!! Form::close() !!} 

      </div>
        
        
    
    </div><!-- end col -->
  </div>
  </div>
  
  </div>


  @endsection