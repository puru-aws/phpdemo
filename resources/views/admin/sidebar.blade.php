<!-- Sidebar Left -->
  <div class="sidebar left-side" id="sidebar-left">
	 <div class="sidebar-user">
		<div class="media sidebar-padding">
			<div class="media-left media-middle">
				 
				@if(Auth::user()->image_icon)
                                 
									<img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="60" alt="person" class="img-circle">
							
							@else
								
							<img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle" width="60"/>
							
							@endif
			</div>
			<div class="media-body media-middle">
				 
				<a href="{{ URL::to('admin/profile') }}" class="h4 margin-none">{{ Auth::user()->name }}</a>
				<ul class="list-unstyled list-inline margin-none">
					<li><a href="{{ URL::to('admin/profile') }}"><i class="md-person-outline"></i></a></li>
					@if(Auth::User()->usertype=="Admin")
					<li><a href="{{ URL::to('admin/settings') }}"><i class="md-settings"></i></a></li>
					@endif
					<li><a href="{{ URL::to('admin/logout') }}"><i class="md-exit-to-app"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Wrapper Reqired by Nicescroll (start scroll from here) -->
	<div class="nicescroll">
		<div class="wrapper" style="margin-bottom:90px">
			<ul class="nav nav-sidebar" id="sidebar-menu">
               
               @if(Auth::user()->usertype=='Admin')
               
               		<li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> {{trans('words.dashboard_text')}}</a></li>
                
	                <li class="{{classActivePath('types')}}"><a href="{{ URL::to('admin/types') }}"><i class="fa fa-tags"></i>{{trans('words.property_type')}}</a></li>
	                
	                <li class="{{classActivePath('properties')}}"><a href="{{ URL::to('admin/properties') }}"><i class="md md-pin-drop"></i>{{trans('words.properties')}}</a></li>
					
					<li class="{{classActivePath('featuredproperties')}}"><a href="{{ URL::to('admin/featuredproperties') }}"><i class="md md-star"></i>{{trans('words.featured')}}</a></li>
					 
					<li class="{{classActivePath('inquiries')}}"><a href="{{ URL::to('admin/inquiries') }}"><i class="fa fa-send"></i>{{trans('words.inquiries')}}</a></li> 
					 
	                <li class="{{classActivePath('slider')}}"><a href="{{ URL::to('admin/slider') }}"><i class="fa fa-sliders"></i>{{trans('words.home_slider')}}</a></li>

	                <li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}"><i class="fa fa-users"></i>{{trans('words.users')}}</a></li>
	                
					<li class="{{classActivePath('subscription_plan')}}"><a href="{{ URL::to('admin/subscription_plan') }}"><i class="fa fa-dollar"></i> <span>{{trans('words.subscription_plan')}}</span></a></li>
             

	                <li class="{{classActivePath('transactions')}}"><a href="{{ URL::to('admin/transactions') }}"><i class="fa fa-list"></i>{{trans('words.transactions')}}</a></li>
	                 
					<li class="{{classActivePath('partners')}}"><a href="{{ URL::to('admin/partners') }}"><i class="fa fa-bookmark-o"></i>{{trans('words.partners')}}</a></li>
					
					<li class="{{classActivePath('testimonials')}}"><a href="{{ URL::to('admin/testimonials') }}"><i class="fa fa-list"></i>{{trans('words.testimonials')}}</a></li>
					
					<li class="{{classActivePath('subscriber')}}"><a href="{{ URL::to('admin/subscriber') }}"><i class="md md-email"></i>{{trans('words.subscribers')}}</a></li>
					  
	                 
	                <li class="{{classActivePath('settings')}}"><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i>{{trans('words.settings')}}</a></li>

	                 <li class="submenu {{classActivePath('about_page')}}">
                    <a href="#" @if(classActivePath('about_page') OR classActivePath('terms_page') OR classActivePath('privacy_policy_page') OR classActivePath('faq_page')) class="open" @endif>
                    <i class="md md-description"></i> {{trans('words.pages')}} <span class="pull-right label label-primary">4</span>
                    </a>
	                    <ul @if(classActivePath('about_page') OR classActivePath('terms_page') OR classActivePath('privacy_policy_page') OR classActivePath('faq_page')) style="display: block" class="collapse in" @endif>
	                        <li class="{{classActivePath('about_page')}}"><a href="{{ URL::to('admin/about_page') }}">{{trans('words.about_us')}}</a></li>
	                        <li class="{{classActivePath('terms_page')}}"><a href="{{ URL::to('admin/terms_page') }}">{{trans('words.terms_of_us')}}</a></li>
	                        <li class="{{classActivePath('privacy_policy_page')}}"><a href="{{ URL::to('admin/privacy_policy_page') }}">{{trans('words.privacy_policy')}}</a></li>
	                        <li class="{{classActivePath('faq_page')}}"><a href="{{ URL::to('admin/faq_page') }}">{{trans('words.faq')}}</a></li>
	                         
	                    </ul>
                    </li>
               
               		   
               @else
               		 <li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> {{trans('words.dashboard_text')}}</a></li>
               		 
               		 <li class="{{classActivePath('properties')}}"><a href="{{ URL::to('admin/properties') }}"><i class="md md-pin-drop"></i>{{trans('words.properties')}}</a></li>
               		 
               		 <li class="{{classActivePath('inquiries')}}"><a href="{{ URL::to('admin/inquiries') }}"><i class="md md-send"></i>{{trans('words.inquiries')}}</a></li>
               		 
               		 <li class="{{classActivePath('admin')}}"><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> {{trans('words.account')}}</a></li>				  
               @endif
                  
 
			</ul>

			 
		</div>
	</div>
</div>
  <!-- // Sidebar -->

  <!-- Sidebar Right -->
  <div class="sidebar right-side" id="sidebar-right">
	<!-- Wrapper Reqired by Nicescroll -->
	<div class="nicescroll">
		<div class="wrapper">
			<div class="block-primary">
				<div class="media">
					<div class="media-left media-middle">
						<a href="#">
							 @if(Auth::user()->image_icon)
                                 
									<img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="60" alt="person" class="img-circle border-white">
							
							@else
								
							<img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle border-white" width="60"/>
							
							@endif
						</a>
					</div>
					<div class="media-body media-middle">
						<a href="{{ URL::to('admin/profile') }}" class="h4">{{ Auth::user()->name }}</a>
						<a href="{{ URL::to('admin/logout') }}" class="logout pull-right"><i class="md md-exit-to-app"></i></a>
					</div>
				</div>
			</div>
			<ul class="nav nav-sidebar" id="sidebar-menu">
				<li><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> {{trans('words.account')}}</a></li>				 
				
				@if(Auth::user()->usertype=='Admin')
				
				<li><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i> {{trans('words.settings')}}</a></li>
				
				@endif
				
				<li><a href="{{ URL::to('admin/logout') }}"><i class="md md-exit-to-app"></i> {{trans('words.logout')}}</a></li>
			</ul>
		</div>
	</div>
</div>
  <!-- // Sidebar -->
