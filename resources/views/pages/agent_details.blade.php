@extends("app")

@section('head_title', $agent->name.' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>@if($agent->usertype=='Agents' or $agent->usertype=='Admin') {{trans('words.agent')}} @else {{trans('words.owner')}} @endif {{trans('words.details')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          @if($agent->usertype=='Agents')<li><a href="{{ URL::to('agents/') }}">{{trans('words.agents')}}</a></li>@endif
          <li> {{$agent->name}}</li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->

  <section class="main-container agent-box-container container" style="padding-top: 40px;">
    <div class="agent-container clearfix">
      <div class="agent-box">
        <div class="inner-container clearfix" style="min-height: 280px;">
          <div class="img-container col-xs-5 col-sm-3">
          @if($agent->image_icon)
                          
            <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{ $agent->name }}">
          
          @else
          
          <img src="{{ URL::asset('site_assets/img/agent_default.jpg') }}" alt="{{ $agent->name }}">
          
          @endif
          </div>
          <div class="bott-sec col-xs-7 col-sm-9">
            <div class="name">{{$agent->name}}</div>
             <div class="desc">
              {{$agent->about}}
            </div>
            <div class="social-icons">
             <a href="{{$agent->facebook}}" class="fa fa-facebook" target="_blank"></a>
            <a href="{{$agent->twitter}}" class="fa fa-twitter" target="_blank"></a>
            <a href="{{$agent->gplus}}" class="fa fa-google-plus" target="_blank"></a>
            <a href="{{$agent->linkedin}}" class="fa fa-linkedin" target="_blank"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="property-listing-container clearfix">
      <div class="title-box clearfix">
        <h2 class="hsq-heading type-1">@if($agent->usertype=='Agents' or $agent->usertype=='Admin') {{trans('words.agents_properties')}} @else {{trans('words.owner_properties')}} @endif </h2>
        <div class="subtitle">&nbsp;</div>
      </div>
      <div class="property-container clearfix">

        @foreach($properties as $i => $property)
        <div class="propertybox-featured col-md-6">
          <div class="inner-container clearfix">
            <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" class="img-container col-xs-6">
               @if($property->featured_property==1)<span class="tag-label hot-offer">{{trans('words.featured')}}</span>@endif
               <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="Image of Property">
              <span class="price-box">{{getcong('currency_sign').' '.$property->price}}</span>
              @if($property->property_purpose==trans('words.purpose_sale'))
              <div class="property-status-sale">
                    <span>{{trans('words.for_sale')}}</span>
              </div>
              @endif
              @if($property->property_purpose==trans('words.purpose_rent'))
              <div class="property-status-rent">
                    <span>{{trans('words.for_rent')}}</span>
              </div>
              @endif
            </a>
            <div class="col-xs-6 main-info">
              <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" class="title">{{ Str::limit($property->property_name,35) }}</a>

              <div class="location">{{ Str::limit($property->address,40) }}</div>
              <div class="desc">
                {!! Str::limit($property->description,100) !!}
              </div>
              <div class="bottom-sec clearfix">
                <div class="extra-info">
                  <div class="bedroom">
                    <div class="value">{{$property->bedrooms}}</div>
                    bedroom
                  </div>
                  <div class="bathroom">
                    <div class="value">{{$property->bathrooms}}</div>
                    bathroom
                  </div>
                </div>
                <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" class="btn more-link">{{trans('words.more_info')}}</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        
      </div>
      <!-- begin:pagination -->
            @include('_particles.pagination', ['paginator' => $properties])             
    <!-- end:pagination -->
    </div>
  </section>
   
  @endsection