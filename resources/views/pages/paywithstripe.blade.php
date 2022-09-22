@extends("app")

@section('head_title', trans('words.pay_with_stripe').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

<style type="text/css">
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
      <h1>{{trans('words.pay_with_stripe')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.pay_with_stripe')}}</a></li>
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
      @if(Session::has('error_flash_message'))
                  <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('error_flash_message') }}
                  </div>
      @endif

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="table-responsive properties_min">
          
          <p class="h4 section-label text-uppercase black-border text-bold center mb20" align="center">{{trans('words.pay_with')}} <img class="payment-logo paypal" src="{{ URL::asset('upload/stripe-logo.png')}}" alt="" width="60"></p>
          <br/>

        {!! Form::open(array('url' => 'stripe','class'=>'','id'=>'payment-form','role'=>'form')) !!}
             
              <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label>{{trans('words.card_no')}}:</label>
                <input placeholder="xxxxxxxxxxxxxxx" name="card_no" value="{{ old('card_no') }}" class="border" type="text">     
              </div>
              <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label>{{trans('words.expiry_month')}}:</label>
                <input placeholder="09" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" class="border" type="text">  
              </div>
              <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label>{{trans('words.expiry_year')}}:</label>
                <input placeholder="2021" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" class="border" type="text">  
              </div>
              <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label>{{trans('words.cvv_number')}}:</label>
                <input placeholder="999" name="cvvNumber" value="{{ old('cvvNumber') }}" class="border" type="text">  
              </div>
              <div class="form-group col-md-12">
                <div class="center mb20" align="center">
                    <input class="payment-button" type="submit" value="{{trans('words.pay_now')}}">
                </div>
              </div> 
               
            {!! Form::close() !!} 

      </div>        
        
    
    </div><!-- end col -->
  </div>
  </div>
  
  </div>
</div>

  @endsection