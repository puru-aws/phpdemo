 

<!--Top Footer-->
  <section id="top-footer">
    <div class="inner-container container">
      <div class="widget-box col-md-2">
        
      </div>
      <div class="widget-box col-md-8">
        <h4>{{trans('words.get_newsletter')}}</h4> 
  
        @if(Session::has('error_flash_message'))
                  <div class="alert alert-danger">                  
                      {{ Session::get('error_flash_message') }}
                  </div>
        @endif
        @if(Session::has('flash_message_subscribe'))
                <div class="alert alert-success">                 
                    {{ Session::get('flash_message_subscribe') }}
                </div>
        @endif

        {!! Form::open(array('url' => array('subscribe'),'name'=>'search_form','id'=>'newsletter-form','role'=>'form')) !!}   
        <meta name="_token" content="{!! csrf_token() !!}"/>
          <div class="input-container">
            <input type="text" name="email" id="email_id" placeholder="{{trans('words.email')}}" required>
          </div>
          <button class="btn">{{trans('words.submit')}}</button>
        {!! Form::close() !!} 
      </div>
      <div class="widget-box col-md-2">
        
      </div>
    </div>
  </section>
  <!--End of Top Footer-->

  <footer id="main-footer">
    <div class="inner-container container">
      <div id="go-up" class="fa fa-angle-double-up"></div>
      <div class="top-section clearfix">
        <div class="col-md-4 widgets">
          <h4 class="title">{{getcong('footer_widget1_title')}}</h4> 
           
            {!! stripslashes(getcong('footer_widget1')) !!}
           
        </div>
        <div class="col-md-4 widgets">
          <h4 class="title">{{getcong('footer_widget2_title')}}</h4>
        
          {!! stripslashes(getcong('footer_widget2')) !!}
        
        </div>
        <div class="col-md-4 widgets">
          <h4 class="title">{{getcong('footer_widget3_title')}}</h4>
        
          {!! stripslashes(getcong('footer_widget3')) !!}
        
        </div>
      </div>
      <div class="bott-section .clearfix">
        <div class="col-md-6 copy-right">

          {{getcong('site_copyright')}}

         </div>
        <div class="col-md-6 social-icons">
          <ul class="list-inline">
            @foreach(\App\Pages::where('status','1')->orderBy('id')->get() as $page_data)
            <li><a href="{{ URL::to('page/'.$page_data->page_slug) }}" class="">{{$page_data->page_title}}</a></li>
            @endforeach            
            <li></li> 
            <li><a href="{{getcong('social_facebook')}}" class="fa fa-facebook" target="_blank"></a></li>
            <li><a href="{{getcong('social_twitter')}}" class="fa fa-twitter" target="_blank"></a></li>
            <li><a href="{{getcong('social_linkedin')}}" class="fa fa-linkedin" target="_blank"></a></li>
            <li><a href="{{getcong('social_instagram')}}" class="fa fa-instagram" target="_blank"></a></li>
           </ul>
        </div>
      </div>
    </div>
  </footer>