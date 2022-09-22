@extends("app")

@section('head_title', trans('words.update_property').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

<style type="text/css">
 @media (max-width: 991px) {
    .mobile-only {
        display:block !important;
    }
 
    .desktop-only {
        display:none !important;
    }
} 

</style>

<script type="text/javascript" src="{{ URL::asset('site_assets/ckeditor/ckeditor.js') }}"></script>
 
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.update_property')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">Home</a></li>
          <li><a href="{{ URL::to('dashboard/') }}">Dashboard</a></li>
          <li>{{trans('words.update_property')}}</li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->
<!-- begin:content -->
    <section class="main-container container">
    <div class="descriptive-section">
      <h2 class="hsq-heading type-1">{{trans('words.update_property')}}</h2>
 
         @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('flash_message') }}
                  </div>
        @endif
 
    </div>
    <div class="submit-main-box clearfix">
         {!! Form::open(array('url' => 'submit-property','class'=>'','id'=>'submit-property-main-form','role'=>'form','enctype' => 'multipart/form-data')) !!}

         <input type="hidden" name="id" value="{{ Crypt::encryptString($property->id) }}">

        <div class="row t-sec">
          <div class="col-md-6 l-sec">
            <div class="information-box">
              <h3>{{trans('words.basic_details')}}</h3>

              <div class="box-content">
                <div class="field-row">
                  <input type="text" placeholder="{{trans('words.property_name')}}" name="property_name" id="p-title" value="{{stripslashes($property->property_name)}}">
                  @if ($errors->has('property_name'))
                    <span style="color:#fb0303">
                        {{ $errors->first('property_name') }}
                    </span>
                 @endif
                 </div>
                <div class="field-row clearfix">
                  <div class="col-xs-6">
                    <select id="p-status" name="property_purpose">
                      <option value="">{{trans('words.property_purpose')}}</option>
                      <option value="{{trans('words.purpose_sale')}}" @if($property->property_purpose==trans('words.purpose_sale')) selected @endif>{{trans('words.for_sale')}}</option>
                      <option value="{{trans('words.purpose_rent')}}" @if($property->property_purpose==trans('words.purpose_rent')) selected @endif>{{trans('words.for_rent')}}</option>
                    </select>
                    @if ($errors->has('property_purpose'))
                    <span style="color:#fb0303">
                        {{ $errors->first('property_purpose') }}
                    </span>
                 @endif
                  </div>
                  <div class="col-xs-6">
                    <select id="p-type" name="property_type">
                      <option value="">{{trans('words.property_type')}}</option>
                      @foreach($types as $type)  
                        <option value="{{$type->id}}" @if($property->property_type==$type->id) selected @endif>{{$type->types}}</option>
                    
                    @endforeach
                    </select>
                    @if ($errors->has('property_type'))
                    <span style="color:#fb0303">
                        {{ $errors->first('property_type') }}
                    </span>
                 @endif
                  </div>
                </div>
                <div class="field-row clearfix">
                  <div class="col-xs-6">
                    <div class="input-group l-icon">
                      <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                      <input type="text" name="price" class="form-control number-field" id="p-price"
                           placeholder="{{trans('words.price')}}" value="{{ $property->price }}">  
                    </div>
                    @if ($errors->has('price'))
                    <span style="color:#fb0303">
                        {{ $errors->first('price') }}
                    </span>
                 @endif
                  </div>
                  <div class="col-xs-6">
                    <select id="p-bedroom" name="bedrooms">
                      <option value="">{{trans('words.bedroom')}}</option>
                      <option value="1" @if($property->bedrooms=='1') selected @endif>1</option>
                      <option value="2" @if($property->bedrooms=='2') selected @endif>2</option>
                      <option value="3" @if($property->bedrooms=='3') selected @endif>3</option>
                      <option value="4" @if($property->bedrooms=='4') selected @endif>4</option>
                      <option value="5" @if($property->bedrooms=='5') selected @endif>5</option>
                      <option value="+5" @if($property->bedrooms=='+5') selected @endif>+5</option>
                    </select>
                  </div>
                </div>
                <div class="field-row clearfix">
                  <div class="col-xs-6">
                    <select id="bathroom" name="bathrooms">
                      <option value="">{{trans('words.bathrooms')}}</option>
                      <option value="1" @if($property->bathrooms=='1') selected @endif>1</option>
                      <option value="2" @if($property->bathrooms=='2') selected @endif>2</option>
                      <option value="3" @if($property->bathrooms=='3') selected @endif>3</option>
                      <option value="4" @if($property->bathrooms=='4') selected @endif>4</option>
                      <option value="5" @if($property->bathrooms=='5') selected @endif>5</option>
                      <option value="+5" @if($property->bathrooms=='+5') selected @endif>+5</option>
                    </select>
                  </div>
                  <div class="col-xs-6">
                    <select id="garage" name="garage">
                      <option value="">{{trans('words.garages')}}</option>
                      <option value="1" @if($property->garage=='1') selected @endif>1</option>
                      <option value="2" @if($property->garage=='2') selected @endif>2</option>
                      <option value="3" @if($property->garage=='3') selected @endif>3</option>
                      <option value="4" @if($property->garage=='4') selected @endif>4</option>
                      <option value="5" @if($property->garage=='5') selected @endif>5</option>
                      <option value="+5" @if($property->garage=='+5') selected @endif>+5</option>
                    </select>
                  </div>
                </div>
                <div class="field-row clearfix">
                  <div class="col-xs-6">
                    <div class="input-group r-icon">
                      <input type="text" name="land_area" class="form-control number-field" id="p-land"
                           placeholder="{{trans('words.land_area')}}" value="{{ $property->land_area }}">
                      <span class="input-group-addon">m2</span>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="input-group r-icon">
                      <input type="text" name="build_area" class="form-control number-field" id="p-build"
                           placeholder="{{trans('words.build_area')}}" value="{{ $property->build_area }}">
                      <span class="input-group-addon">m2</span>
                    </div>
                  </div>
                </div>
                 
              </div>
            </div>

            <div class="information-box">
                <h3>{{trans('words.description')}}</h3>
                <div class="box-content">
                    <div class="field-row">
                      <textarea name="description" id="p-desc" placeholder="{{trans('words.description')}}">{{ stripslashes($property->description) }}</textarea>
                      @if ($errors->has('description'))
                        <span style="color:#fb0303">
                            {{ $errors->first('description') }}
                        </span>
                     @endif
                     <script>CKEDITOR.replace( 'p-desc' );</script>
                    </div>
                </div>  
            </div>

            <div class="information-box">
              <h3>{{trans('words.amenities')}}</h3>`
                
                <div class="box-content">
                  <div class="field-row">
                     <input type="text" name="property_features" value="{{$property->property_features}}" data-role="tagsinput">
                  </div>
                </div>  
            </div>
                        <div class="information-box">
              <h3>{{trans('words.nearest_palces')}}</h3>
                
                <div class="box-content">
                  <div class="col-xs-12">
                    <div class="field-row col-md-6">
                       <h4>{{trans('words.school')}}</h4>
                       <input type="text" name="nearest_school_km" value="{{$property->nearest_school_km}}" placeholder="0.5 KM">
                    </div>
                    
                    <div class="field-row col-md-6">
                       <h4>{{trans('words.hospital')}}</h4>
                       <input type="text" name="nearest_hospital_km" value="{{$property->nearest_hospital_km}}" placeholder="1 KM">
                    </div>
                  </div>
                  <div class="col-xs-12">
                     <div class="field-row col-md-6">
                       <h4>{{trans('words.mall')}}</h4>
                       <input type="text" name="nearest_mall_km" value="{{$property->nearest_mall_km}}" placeholder="1.5 KM">
                    </div>
                    <div class="field-row col-md-6">
                        <h4>{{trans('words.bus_station')}}</h4>
                         <input type="text" name="nearest_bus_stand_km" value="{{$property->nearest_bus_stand_km}}" placeholder="1.3 KM">
                     </div>
                  </div>  
                  <div class="col-xs-12">                     
                     <div class="field-row col-md-6">
                       <h4>{{trans('words.airport')}}</h4>
                       <input type="text" name="nearest_airport_km" value="{{$property->nearest_airport_km}}" placeholder="3 KM">
                    </div>                    
                     
                      <div class="field-row col-md-6">
                        <h4>{{trans('words.railway')}}</h4>
                         <input type="text" name="nearest_railway_km" value="{{$property->nearest_railway_km}}" placeholder="2.1 KM">
                      </div>
                  </div>
                   

                </div>  
            </div>

          </div>
          <div class="col-md-6 r-sec">
          <div class="information-box">
            <h3>{{trans('words.location')}}</h3>

            <div class="box-content">
              <div class="field-row">
                <input type="text" placeholder="{{trans('words.address')}}" name="address" id="address" value="{{$property->address}}">
                @if ($errors->has('address'))
                    <span style="color:#fb0303">
                        {{ $errors->first('address') }}
                    </span>
                 @endif
              </div>
              <div class="field-row">
                <input type="text" placeholder="{{trans('words.find_lat_long')}}" name="lag_long_address" id="p-address" value="" onkeydown="if (event.keyCode == 13) return false;">                
              </div> 
              <div class="field-row">
                <div id="p-map"></div>
              </div>
              <div class="field-row clearfix">
                <div class="col-xs-6">
                  <input type="text" name="map_longitude" placeholder="{{trans('words.longitude')}}" id="p-long" value="{{ $property->map_longitude }}" readonly>
                </div>
                <div class="col-xs-6">
                  <input type="text" name="map_latitude" placeholder="{{trans('words.latitude')}}" id="p-lat" value="{{ $property->map_latitude }}" readonly>
                </div>
              </div>

            </div>
          </div>           
          <div class="information-box">
            <h3>{{ trans('words.video_presentation') }}</h3>

            <div class="box-content">
              <div class="field-row">
                <textarea id="p-video" name="video_code" placeholder="{{ old('past_embed_code') }}">{{ stripslashes($property->video_code) }}</textarea>
              </div>
            </div>
          </div>
          <div class="information-box">
              <h3>{{ trans('words.floor_plan') }}</h3>
                <div class="box-content">
                   
                    <input type="file" name="floor_plan" id="floor_plan" style="color: green;padding: 5px;border: 1px dashed #123456;background-color: #f9ffe5;" />

                    <div class="media-left">
                         @if(isset($property->floor_plan))
                                 
                          <img src="{{ URL::asset('upload/floorplan/'.$property->floor_plan.'-s.jpg') }}" width="150" alt="Floor Plan Image">
                
                         @endif                                                
                    </div>
                   
                </div>    
            </div>
            <div class="information-box">
              <h3>{{ trans('words.featured_image') }}</h3>
                <div class="box-content">
                   
                    <input type="file" name="featured_image" id="featured_image" style="color: green;padding: 5px;border: 1px dashed #123456;background-color: #f9ffe5;"/><br/>
                   @if ($errors->has('featured_image'))
                    <span style="color:#fb0303">
                        {{ $errors->first('featured_image') }}
                    </span>
                    @endif

                    <div class="media-left">
                         @if(isset($property->featured_image))
                                 
                          <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" width="150" alt="Featured Image">
                
                         @endif                                                
                    </div>
                </div>    
            </div>
        </div>
        </div>
        <div class="row b-sec desktop-only">

          <link rel="stylesheet" href="{{ URL::asset('site_assets/css/gallery_style.css') }}">
          <div class="information-box">
            <h3>{{ trans('words.gallery') }}</h3>

                <div class="media">
                            <div class="med_list media-left">
                                @if(isset($property->id))
                                    @foreach($property_gallery_images as $i => $gallery_img)

                                        <div id="abcd_1" class="abcd">
                                         <img src="{{ URL::asset('upload/gallery/'.$gallery_img->image_name) }}" width="100" alt="image">
                                         <a href="{{ url('gallery_image_delete/'.Crypt::encryptString($gallery_img->id)) }}"><img id="img" src="{{ URL::asset('site_assets/img/x.png') }}" alt="delete"></a>
                                        </div>
                                    @endforeach
                                @endif   

                                                             
                            </div>
                             
                        </div>

                <div id="formdiv"> 
                     
                     <div id="filediv"></div>
                     
                     <div style="margin-top:5px;">
                        <input name="gallery_file[]" type="file" id="file"/>
                        <input type="button" id="add_more" class="upload" value="{{trans('words.add_more_images')}}"/>
                    </div>
        
                </div>
          </div>
        </div>
      <div class="row b-sec" align="center">
          <button type="submit" class="btn btn-lg submit">{{trans('words.save_changes')}}</button>
        </div>
        
      {!! Form::close() !!}
    </div>
  </section>
    <!-- end:content -->
 
@endsection
