@extends("app")

@section('head_title', trans('words.properties_for_rent').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
 
    <!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.properties_for_rent')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.properties_for_rent')}}</a></li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->

  <section class="main-container container">
    <div class="content-box col-sm-8">
      <!-- Properties -->
      <section class="property-listing boxed-view clearfix" style="margin-top: 0px;padding: 0px;">
        <div class="inner-container clearfix">
          @foreach($properties as $i => $property)
          <div class="property-box col-xs-12 col-sm-6 wow fadeInUp">
            <div class="inner-box">
          <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" class="img-container">
            @if($property->featured_property==1)<span class="tag-label hot-offer">{{trans('words.featured')}}</span>@endif 
            <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="Image of Property">
            <span class="price">{{getcong('currency_sign').' '.$property->price}}</span>
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
          <div class="bottom-sec">
            <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" class="title">{{ Str::limit(stripslashes($property->property_name),35) }}</a>
            <div class="location">{{ Str::limit(stripslashes($property->address),40) }}</div>
            <div class="desc">
              {!! Str::limit(stripslashes($property->description),100) !!}
            </div>
            <div class="extra-info clearfix">
              <div class="area col-xs-4">
                <div class="value">{{$property->land_area}}</div>
                m2
              </div>
              <div class="bedroom col-xs-4">
                <div class="value">{{$property->bedrooms}}</div>
                bed
              </div>
              <div class="bathroom col-xs-4">
                <div class="value">{{$property->bathrooms}}</div>
                bath
              </div>
            </div>
          </div>
          <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" class="btn more-link">{{trans('words.more_info')}}</a>
        </div>
          </div>
          @endforeach
        </div>
        <!-- Pagination -->
        @include('_particles.pagination', ['paginator' => $properties]) 
        <!-- End of Pagination -->
      </section>
      <!-- End of Properties -->
    </div>
    <aside class="col-sm-4">
     @include("_particles.sidebar") 
    </aside>
  </section>

 
 
@endsection
