@extends("app")

@section('head_title', trans('words.sign_up').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
  <section class="property-listing boxed-view clearfix">
     <div class="inner-container container">
       
       <div id="login-form" class="login-form">
        <h2 class="hsq-heading type-1">{{trans('words.sign_up')}}</h2>

            @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
 </button>
                        {{ Session::get('flash_message') }}
                    </div>
            @endif

             
            {!! Form::open(array('url' => 'register','class'=>'search-form','id'=>'registerform','role'=>'form')) !!}
              <div class="search-fields">
                  <input type="text" placeholder="{{trans('words.name')}}" name="name" id="name" style="margin-bottom: 5px;" /> 
                  @if ($errors->has('name'))
                    <span style="color:#fb0303">
                        {{ $errors->first('name') }}
                    </span>
                @endif 
              </div>
              <div class="search-fields">
                  <input type="email" placeholder="{{trans('words.email')}}" name="email" id="email" style="margin-bottom: 5px;"/> 
                  @if ($errors->has('email'))
                    <span style="color:#fb0303">
                        {{ $errors->first('email') }}
                    </span>
                @endif 
              </div>               
              <div class="search-fields">
                  <input placeholder="{{trans('words.password')}}" type="password" name="password" id="password" style="margin-bottom: 5px;"/>
                  @if ($errors->has('password'))
                    <span style="color:#fb0303">
                        {{ $errors->first('password') }}
                    </span>
                @endif 
              </div>
              <div class="search-fields">
                  <input type="password" placeholder="{{trans('words.confirm_password')}}" name="password_confirmation" id="password_confirmation" style="margin-bottom: 5px;"/>
                  @if ($errors->has('password_confirmation'))
                    <span style="color:#fb0303">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                  @endif 
              </div>
              @if(getcong('recaptcha')==1)
              <div class="search-fields" align="center">

                {!! NoCaptcha::display() !!}

                @if ($errors->has('g-recaptcha-response'))
                    <span style="color:#fb0303">
                        {{ $errors->first('g-recaptcha-response') }}
                    </span>
                @endif
                 
              </div> 
              @endif 
               
              <div class="search-button-container button-box">
              <button class="btn">{{trans('words.sign_up')}}</button>
            </div>
            <br/>&nbsp;
            <div class="search-fields" style="font-size: 15px;">                            
                    <p>{{trans('words.do_you_have_account')}} <a href="{{ url('login') }}">{{trans('words.login_here')}}</a> 
                    </p>
              </div>

          {!! Form::close() !!}  
      </div>
    
    </div>
     
  </section>
@endsection
