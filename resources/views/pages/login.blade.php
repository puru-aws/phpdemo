@extends("app")

@section('head_title', trans('words.sign_in').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
   <section class="property-listing boxed-view clearfix">
     <div class="inner-container container">
       
       <div id="login-form" class="login-form">
        <h2 class="hsq-heading type-1">{{trans('words.sign_in')}}</h2>
            
            @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                        {{ Session::get('flash_message') }}
                    </div>
            @endif

            @if(Session::has('login_error_flash_msg'))
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @endif

           {!! Form::open(array('url' => 'login','class'=>'search-form','id'=>'loginform','role'=>'form')) !!} 
              <div class="search-fields">
                  <input type="email" placeholder="{{trans('words.email')}}" name="email" id="email" style="margin-bottom: 5px;"//>
                  @if ($errors->has('email'))
                    <span style="color:#fb0303">
                        {{ $errors->first('email') }}
                    </span>
                @endif
              </div>
              <div class="search-fields">
                  <input placeholder="{{trans('words.password')}}" type="password" name="password" id="password" style="margin-bottom: 5px;"//>
                  @if ($errors->has('password'))
                    <span style="color:#fb0303">
                        {{ $errors->first('password') }}
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
              <button class="btn">{{trans('words.login_text')}}</button>
              <br/>&nbsp;

              <div class="search-fields" style="font-size: 15px;">                            
                    <p>{{trans('words.dont_have_account')}} <a href="{{ url('register') }}">{{trans('words.register_here')}}</a>                <br>  
                   <a href="{{ url('password/email') }}">{{trans('words.forgot_pass_text')}}</a></p>
              </div>

            </div>

          {!! Form::close() !!}  
      </div>
    
    </div>
     
  </section>
  
 
@endsection
