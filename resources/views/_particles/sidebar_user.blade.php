<div class="col-lg-3 col-md-3 sidebar-left">
      <div class="widget member-card">
        <div class="member-card-header">
          <a href="Javascript::void();" class="member-card-avatar">
            @if(Auth::user()->image_icon AND file_exists(public_path('upload/members/'.Auth::user()->image_icon.'-s.jpg')))          

            <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" alt="">

            @else
              <img src="{{ URL::asset('site_assets/img/user_demo.png') }}" alt="">
            @endif
            

          </a>
          <h3>{{ Auth::user()->name }}</h3>
          <p><i class="fa fa-envelope icon"></i>{{ Auth::user()->email }}</p>
        </div>
        <div class="member-card-content">
          
          <ul>
            <li class="{{classActiveUserMenu('dashboard')}}"><a href="{{ URL::to('dashboard') }}"><i class="fa fa-dashboard icon"></i>{{trans('words.dashboard_text')}}</a></li>            
            <li class="{{classActiveUserMenu('my_properties')}}"><a href="{{ URL::to('my_properties') }}"><i class="fa fa-home icon"></i>{{trans('words.my_properties')}}</a></li>
            <li class="{{classActiveUserMenu('inquiries')}}"><a href="{{ URL::to('inquiries') }}"><i class="fa fa-envelope icon"></i>{{trans('words.inquiries')}}</a></li>
            <li class="{{classActiveUserMenu('invoice')}}"><a href="{{ URL::to('invoice') }}"><i class="fa fa-file icon"></i>{{trans('words.my_invoice')}}</a></li>
            <li class="{{classActiveUserMenu('profile')}}"><a href="{{ URL::to('profile') }}"><i class="fa fa-user icon"></i>{{trans('words.profile')}}</a></li>
            <li class="{{classActiveUserMenu('change_pass')}}"><a href="{{ URL::to('change_pass') }}"><i class="fa fa-lock icon"></i>{{trans('words.change_password')}}</a></li>
            <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out icon"></i>{{trans('words.logout')}}</a></li>
            
          </ul>
        </div>
      </div>
    </div>