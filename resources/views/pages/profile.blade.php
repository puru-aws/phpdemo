@extends("app")

@section('head_title', trans('words.profile').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.profile')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.profile')}}</a></li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->
<!-- begin:content -->
    <div class="container">
  <div class="min_profile">
  <div class="row">
    @include("_particles.sidebar_user")

    <div class="col-lg-9 col-md-9 min_form">
      @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      @if(Session::has('flash_message_profile'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
 </button>
                        {{ Session::get('flash_message_profile') }}
                    </div>
            @endif
    <div class="form_min">
      {!! Form::open(array('url' => 'profile','class'=>'','name'=>'profile_form','id'=>'profile_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
        <div class="row">
          <div class="col-lg-3">
            <div class="edit-avatar">
               
              @if(Auth::user()->image_icon)          

            <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-b.jpg') }}" alt="" class="profile-avatar">

            @else
              <img src="{{ URL::asset('site_assets/img/agent-img3.jpg') }}" alt="" class="profile-avatar">
            @endif
               <input type="file" name="user_icon" class="">

            </div>
          </div>
          <div class="col-lg-9">
            
            <div class="form-block">
              <label>{{trans('words.name')}}</label>
              <input class="border" type="text" name="name" value="{{ Auth::user()->name }}" required>
            </div>
            <div class="form-block">
              <label>{{trans('words.email')}}</label>
              <input class="border" type="text" name="email" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="form-block">
              <label>{{trans('words.phone')}}</label>
              <input class="border" type="text" name="phone" value="{{ Auth::user()->phone }}">
            </div>
          </div>
        </div><!-- end row -->
              
        <div class="form-block">
          <label>{{trans('words.about')}}</label>
          <textarea class="border" name="about">{{ Auth::user()->about }}</textarea>
        </div>  
        
        <div class="row">
          <div class="col-lg-6 soi_t">
            <h4>{{trans('words.social_profiles')}}</h4>
            <div class="divider"></div>
            <div class="form-block">
              <label>Facebook</label>
              <input class="border" type="text" name="facebook" value="{{ Auth::user()->facebook }}">
            </div>
            
            <div class="form-block">
              <label>Twitter</label>
              <input class="border" type="text" name="twitter" value="{{ Auth::user()->twitter }}">
            </div>
            
            
          </div>
          <div class="col-lg-6 soi_t">
            <h4>&nbsp;</h4>
            <div class="divider"></div>
             <div class="form-block">
              <label>Instagram</label>
              <input class="border" type="text" name="instagram" value="{{ Auth::user()->instagram }}">
            </div>
            <div class="form-block">
              <label>Linkedin</label>
              <input class="border" type="text" name="linkedin" value="{{ Auth::user()->linkedin }}">
            </div>
          </div>
        </div><!-- end row -->
        
        <div class="form-block">
          <button type="submit" class="button button-icon"><i class="fa fa-check"></i>{{trans('words.save_changes')}}</button>
        </div>
        
      {!! Form::close() !!} 
      
    </div>
    
    </div><!-- end col -->
  </div>
  </div>
  
  </div>
    <!-- end:content -->
 
@endsection
