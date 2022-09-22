@extends("app")

@section('head_title', trans('words.change_password').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.change_password')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.change_password')}}</a></li>
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
   @if(Session::has('flash_message'))
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif
    <div class="form_min">
      {!! Form::open(array('url' => 'update_password','class'=>'','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
        
        <div class="row">        
          <div class="col-lg-6 soi_t">
            <h4>{{trans('words.change_password')}}</h4>
            <div class="divider"></div>
              
            <div class="form-block">
              <label>{{trans('words.new_password')}}</label>
              <input class="border" type="password" name="password" required>
            </div>
            
            <div class="form-block">
              <label>{{trans('words.confirm_new_password')}}</label>
              <input class="border" type="password" name="password_confirmation" required>
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
