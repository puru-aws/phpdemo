@extends("app")

@section('head_title', trans('words.dashboard_text').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.dashboard_text')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.dashboard_text')}}</a></li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->
 <div class="container">
  <div class="min_profile">
  <div class="row">
    @include("_particles.sidebar_user")

    <div class="col-lg-9 col-md-9">

        <h3 align="left">{{trans('words.welcome_back')}}, {{Auth::user()->name}}</h3>
        <div class="clearfix"></div>
        @if(Session::has('error'))
                  <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('error') }}
                      {{Session::flash('error',Session::get('error'))}}
                  </div>
        @endif
        @if(Session::has('success'))
                  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('success') }}
                      {{Session::flash('success',Session::get('success'))}}
                  </div>
        @endif
        @if(Session::has('error_flash_message'))
                  <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('error_flash_message') }}
                      {{Session::flash('error_flash_message',Session::get('error_flash_message'))}}
                  </div>
        @endif
        <div class="contact-info clearfix">

            <div class="contact-info-box col-md-6 col-lg-4">
              <a href="{{ URL::to('my_properties') }}">
                <div class="inner-container">
                  <i class="fa fa-home icon"></i>
                  <div class="value" style="font-size: 48px;">{{$properties_count}}
                    <div class="clearfix"></div>
                    <div class="text" style="font-size: 20px; margin-top: 10px;">{{trans('words.properties')}}</div>
                  </div>
                </div>
              </a>  
            </div>
            <div class="contact-info-box col-md-6 col-lg-4">
              <a href="{{ URL::to('my_properties') }}">
                <div class="inner-container">
                  <i class="fa fa-clock-o icon"></i>
                  <div class="value" style="font-size: 48px;">{{$pending_properties_count}}
                    <div class="clearfix"></div>
                    <div class="text" style="font-size: 20px; margin-top: 10px;">{{trans('words.pending')}}</div>
                  </div>
                </div>
              </a>  
            </div>
                
            <div class="contact-info-box col-md-6 col-lg-4">
              <a href="{{ URL::to('inquiries') }}">
              <div class="inner-container">
                <i class="fa fa-envelope"></i>
                <div class="value" style="font-size: 48px;">{{$inquiries}}
                  <div class="clearfix"></div>
                    <div class="text" style="font-size: 20px; margin-top: 10px;">{{trans('words.inquiries')}}</div>
                </div>
              </div>
            </a>
            </div>
              
        </div>
       @if(Auth::User()->usertype!='Agents')    
         @if(getcong('bank_payment_details')) 
         <div class="contact-info clearfix" style="border: 1px solid rgba(0, 0, 0, 0.1);padding: 15px;background-color: #fafafa;">
          {!! stripslashes(getcong('bank_payment_details'))!!}      
        </div>
        @endif
      @endif
            
    </div><!-- end col -->
  </div>
  </div>
  
  </div>


  @endsection