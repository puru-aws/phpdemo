@extends("app")

@section('head_title', stripslashes($property->property_name) .' | '.getcong('site_name') )
@section('head_description', substr(strip_tags($property->description),0,200))
@section('head_image', asset('/upload/properties/'.$property->featured_image.'-b.jpg'))
@section('head_url', Request::url())

@section("content")

@if(Session::has('flash_message_agent'))
<script type="text/javascript">
   
  alert('{{ Session::get('flash_message_agent') }}');

</script>
@endif
<section id="property-slider-section" @if(count($property_gallery_images)==0) style="margin-bottom: 0px;" @endif>
    <div class="title-box container">
      <h1>{{stripslashes($property->property_name)}}</h1>
      <div class="location">{{stripslashes($property->address)}}</div>
    </div>
    <!-- Main Slider -->
    <div id="property-main-slider">
      <div class="items">
        <div class="img-container" data-bg-img="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}"></div><!-- Change the URL section based on your image\'s name -->
      </div>

      @foreach($property_gallery_images as $key=>$gallery_img)
      <div class="items">
        <div class="img-container" data-bg-img="{{ URL::asset('upload/gallery/'.$gallery_img->image_name) }}"></div> 
      </div>
      @endforeach
   
    </div>
    <!-- End of Main Slider -->
    @if(count($property_gallery_images)>0)
    <div id="property-thumb-slider" class="container">
      <div class="items">
        <div class="img-container" data-bg-img="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}"></div>
      </div>
      @foreach($property_gallery_images as $key=>$gallery_img)
      <div class="items">
        <div class="img-container" data-bg-img="{{ URL::asset('upload/gallery/'.$gallery_img->image_name) }}"></div> 
      </div>
      @endforeach
    
    </div>
    @endif
  </section>

  <section class="main-container container">
    <div class="content-box col-sm-8">
      <div class="t-sec clearfix">
        <div class="col-md-4 left-sec">
          <!--Highlight Section-->
          <div class="highlight-container">
            
            @if($property->land_area!=null)
            <div class="highlight-details-box">
              <div class="value">{{$property->land_area}}</div>
              <div class="text">{{trans('words.land_area')}}</div>
              <div class="unit">m2</div>
            </div>
           @endif

           @if($property->build_area!=null)
            <div class="highlight-details-box">
              <div class="value">{{$property->build_area}}</div>
              <div class="text">{{trans('words.build_area')}}</div>
              <div class="unit">m2</div>
            </div>
           @endif

           @if($property->bedrooms!=null)
            <div class="highlight-details-box">
              <div class="value">{{$property->bedrooms}}</div>
              <div class="text">{{trans('words.bedroom')}}</div>
            </div>
          @endif

          @if($property->bathrooms!=null)
            <div class="highlight-details-box">
              <div class="value">{{$property->bathrooms}}</div>
              <div class="text">{{trans('words.bathroom')}}</div>
            </div>
          @endif

          @if($property->garage!=null)
          <div class="highlight-details-box">
              <div class="value">{{$property->garage}}</div>
              <div class="text">{{trans('words.garages')}}</div>
            </div>          
          @endif
          </div>

          @if($property->map_latitude!=null AND $property->map_longitude!=null)
          <!-- Property Map -->
          <div class="property-details-map-container">
            <div id="property-details-map"></div>
          </div>
          @endif
 
        </div>
        <div class="col-md-8 right-sec">
          <div class="information-box">
            <div class="box-content main-info-box">
              <div class="t-sec clearfix">
                <div class="left-sec col-md-7">
                  <ul class="main-info-li">
                    <li>
                      <div class="title">{{trans('words.property_id')}} :</div>
                      <div class="value">#{{$property->id}}</div>
                    </li>
                    <li>
                      <div class="title">{{trans('words.property_purpose')}} :</div>
                      @if($property->property_purpose==trans('words.purpose_sale'))
                        <div class="value">{{trans('words.for_sale')}}</div>
                      @endif
                      @if($property->property_purpose==trans('words.purpose_rent'))
                        <div class="value">{{trans('words.for_rent')}}</div>
                      @endif  
                    </li>
                    <li>
                      <div class="title">{{trans('words.property_type')}} :</div>
                      <div class="value">{{ getPropertyTypeName($property->property_type)->types }}</div>
                    </li>
                  </ul>
                </div>
                <div class="right-sec col-md-5">
                  <div href="#" class="price">{{getcong('currency_sign').' '.$property->price}}</div>
                  <div class="price-type">{{trans('words.price')}}</div>
                </div>
              </div>
              <div class="b-sec">
                {!! stripslashes($property->description) !!}
              </div>
            </div>
          </div>

          <div class="information-box">
            <h3>{{trans('words.amenities')}} </h3>
            <div class="box-content">
              <ul class="features-box clearfix">
                
                @foreach(explode(',',$property->property_features) as $features)
                <li class="col-sm-6 col-lg-4 active">{{$features}}</li>
                @endforeach
                 
              </ul>
            </div>
          </div>
          
          <div class="information-box">
            <h3>{{trans('words.nearest_palces_single')}}</h3>
            <div class="box-content">
              <div class="attachment-container">
                <div class="row">
                  @if($property->nearest_school_km)
                  <div class="col-sm-6">
                  <a href="javascript:void();" class="attachment-box" style="margin-bottom: 10px;">
                    <div class="size"><img src="{{ URL::asset('site_assets/img/education.png') }}" width="32px;"></div>
                    <div class="title">{{trans('words.school')}}</div>
                    <div class="dl-times" style="font-size: 0.9em;"><i class="fa fa-road"></i>{{$property->nearest_school_km}}</div>
                  </a>
                  </div>
                  @endif
                  @if($property->nearest_hospital_km)
                  <div class="col-md-6">
                  <a href="javascript:void();" class="attachment-box" style="margin-bottom: 10px;">
                    <div class="size"><img src="{{ URL::asset('site_assets/img/hospital.png') }}" width="32px;" style="margin-top: 3px;"></div>
                    <div class="title">{{trans('words.hospital')}}</div>
                    <div class="dl-times" style="font-size: 0.9em;"><i class="fa fa-road"></i>{{$property->nearest_hospital_km}}</div>
                  </a>
                  </div> 
                  @endif
                  @if($property->nearest_mall_km)
                  <div class="col-md-6" style="margin-bottom: 10px;">
                  <a href="javascript:void();" class="attachment-box">
                    <div class="size"><img src="{{ URL::asset('site_assets/img/mall.png') }}" width="36px;"></div>
                    <div class="title">{{trans('words.mall')}}</div>
                    <div class="dl-times" style="font-size: 0.9em;"><i class="fa fa-road"></i>{{$property->nearest_mall_km}}</div>
                  </a>
                  </div>
                  @endif
                  @if($property->nearest_bus_stand_km)
                  <div class="col-md-6" style="margin-bottom: 10px;">
                  <a href="javascript:void();" class="attachment-box">
                    <div class="size"><img src="{{ URL::asset('site_assets/img/bus.png') }}" width="40px;" style="margin-top: 3px;"></div>
                    <div class="title">{{trans('words.bus_station')}}</div>
                    <div class="dl-times" style="font-size: 0.9em;"><i class="fa fa-road"></i>{{$property->nearest_bus_stand_km}}</div>
                  </a>
                  </div>
                  @endif
                  @if($property->nearest_railway_km)
                  <div class="col-md-6" style="margin-bottom: 10px;">
                  <a href="javascript:void();" class="attachment-box">
                    <div class="size"><img src="{{ URL::asset('site_assets/img/railway.png') }}" width="40px;" style="margin-top: 3px;"></div>
                    <div class="title">{{trans('words.railway')}}</div>
                    <div class="dl-times" style="font-size: 0.9em;"><i class="fa fa-road"></i>{{$property->nearest_railway_km}}</div>
                  </a>
                  </div>
                  @endif
                  @if($property->nearest_airport_km)
                  <div class="col-md-6" style="margin-bottom: 10px;">
                  <a href="javascript:void();" class="attachment-box">
                    <div class="size"><img src="{{ URL::asset('site_assets/img/airport.png') }}" width="40px;" style="margin-top: 3px;"></div>
                    <div class="title">{{trans('words.airport')}}</div>
                    <div class="dl-times" style="font-size: 0.9em;"><i class="fa fa-road"></i>{{$property->nearest_airport_km}}</div>
                  </a>
                  </div>
                  @endif
                </div>

                
              </div>
            </div>
          </div>

          @if($property->floor_plan!=null)
          <div class="information-box">
            <h3>{{trans('words.floor_plan')}}</h3>
            <div class="box-content" align="center">
              <ul class="image-main-box clearfix">
                <li class="item col-xs-12">
                  <figure>
                    <img src="{{ URL::asset('upload/floorplan/'.$property->floor_plan.'-s.jpg') }}" alt="Floor Plan"/>
                    <a href="{{ URL::asset('upload/floorplan/'.$property->floor_plan.'-b.jpg') }}" class="more-details" style="border:none;border-bottom:0px;">Enlarge</a>
                  </figure>
                </li>
              
              </ul>
            </div>
          </div>
          @endif

          @if($property->video_code!=null)
          <div class="information-box">
            <h3>{{trans('words.video_presentation')}}</h3>
            <div class="box-content">
              <div class="video-box">
                {!! stripslashes($property->video_code) !!}
              </div>
            </div>
          </div>
          @endif

        </div>
        
      </div>      
      <div class="b-sec">
        <div class="information-box property-agent-container">
          <h3>@if($agent->usertype=='Agents') {{trans('words.contact_agent')}} @else {{trans('words.contact_owner')}} @endif</h3>
          <div class="box-content clearfix">
            <div class="col-md-5 agent-container">
              <div class="agent-box">
                <div class="inner-container">
                  <a href="{{URL::to('user/details/'.$agent->id)}}" class="img-container">
                     @if($agent->image_icon)
                    <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{$agent->name}}">
                    @else
                    <img src="{{ URL::asset('site_assets/img/agent_default.jpg') }}" alt="{{$agent->name}}">
                    @endif
                  </a>
                  <div class="bott-sec">
                    <div class="name"><a href="{{URL::to('user/details/'.$agent->id)}}">{{$agent->name}}</a></div>
                     <div class="desc">
                      {{$agent->about}}
                    </div>
                    <a href="{{URL::to('user/details/'.$agent->id)}}" class="view-listing">{{trans('words.view_listing')}}</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7 contact-form-container" id="agentscontact_sec">
              {!! Form::open(array('url'=>'agentscontact','method'=>'POST', 'id'=>'agent_contact_form')) !!}

              <input type="hidden" name="property_id" value="{{$property->id}}">
                         
              <input type="hidden" name="agent_id" value="{{$agent->id}}">

              <div class="contact-form">
                <div class="field-box">
                  <input type="text" placeholder="{{trans('words.name')}} *" name="name">
                  @if ($errors->has('name'))
                    <span style="color:#fb0303">
                        {{ $errors->first('name') }}
                    </span>
                 @endif
                </div>
                <div class="field-box">
                  <input type="email" placeholder="{{trans('words.email')}} *" name="email">
                  @if ($errors->has('email'))
                    <span style="color:#fb0303">
                        {{ $errors->first('email') }}
                    </span>
                 @endif
                </div>
                <div class="field-box">
                  <input type="text" placeholder="{{trans('words.phone')}}" name="phone">
                </div>
                <textarea id="message" name="message" placeholder="{{trans('words.message')}} *"></textarea>
                @if ($errors->has('message'))
                    <span style="color:#fb0303">
                        {{ $errors->first('message') }}
                    </span>
                    <br><br>
                 @endif
                <button type="submit" class="btn btn-lg submit" name="submit">{{trans('words.submit')}}</button>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>         
      </div>

      <div class="information-box related-properties">
          <h3>{{trans('words.comments')}}</h3>
          {!! stripslashes(getcong('disqus_comment_code')) !!}
      </div>
    </div>
    <aside class="col-sm-4">
      <!--Sidebar Box-->
      {!! stripslashes(getcong('addthis_share_code')) !!}
      &nbsp;
      <div class="clearfix"></div>
      
       @include("_particles.sidebar") 
       
    </aside>
  </section>
 
@endsection
