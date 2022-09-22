@extends("app")

@section('head_title', trans('words.my_properties').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.my_properties')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.my_properties')}}</a></li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->
 <div class="container">
  <div class="min_profile">
  <div class="row">
    @include("_particles.sidebar_user")

    <div class="col-lg-9 col-md-9 min_form">

        @if(Session::has('error'))
                  <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('error') }}
                      {{Session::flash('error',Session::get('error'))}}
                  </div>
        @endif
        @if(Session::has('success'))
                  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('success') }}
                      {{Session::flash('success',Session::get('success'))}}
                  </div>
        @endif
        @if(Session::has('error_flash_message'))
                  <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('error_flash_message') }}
                      {{Session::flash('error_flash_message',Session::get('error_flash_message'))}}
                  </div>
        @endif

      @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      {{ Session::get('flash_message') }}
                  </div>
      @endif
      <div class="table-responsive properties_min">
        <table class="my-properties-list">
          <tbody>
            <tr>
              <th>{{trans('words.image')}}</th>
              <th>{{trans('words.property')}}</th>
              <th>{{trans('words.status')}}</th>
              <th>{{trans('words.expiry_date')}}</th>
              <th>{{trans('words.action')}}</th>
            </tr>
          @foreach($propertieslist as $i => $property)
          <tr>
              <td class="property-img"><a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}"><img src="{{ url('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt=""></a></td>
              <td class="property-title">
                <a href="{{ url('properties/'.$property->property_slug.'/'.Crypt::encryptString($property->id)) }}">{{ stripslashes($property->property_name) }}</a><br>
                <p class="property-address"><i class="fa fa-map-marker icon"></i>{{ stripslashes($property->address) }}</p>
                <p><strong>${{ $property->price }}</strong></p>
              </td>
              <td class="property-post-status">
                  @if($property->status==1)
                    <span class="button small alt">{{trans('words.published')}}</span>
                  @else
                    <span class="button small grey">{{trans('words.pending')}}</span>
                    <span class="icon-circle bg-orange">
                      <i class="md md-close"></i>
                    </span>
                  @endif                  

              </td>
              <td class="property-date">
                @if($property->active_plan_id == 0 OR $property->property_exp_date < strtotime(date('d-m-Y')))
                  <a href="{{ url('plan/'.Crypt::encryptString($property->id)) }}"><span class="button small alt">{{trans('words.pay_now')}}</span></a>
                 @else
                <p class="property-address">{{date('M,  jS, Y',$property->property_exp_date)}}</p>
                @endif                                
              </td>
              <td class="property-actions">                 
                <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" target="_blank"><i class="fa fa-eye icon"></i>{{trans('words.view')}}</a>
                <a href="{{ url('update-property/'.Crypt::encryptString($property->id)) }}"><i class="fa fa-pencil icon"></i>{{trans('words.edit')}}</a>
                <a href="{{ url('delete/'.Crypt::encryptString($property->id)) }}" onclick="return confirm('{{trans('words.dlt_warning_text')}}')"><i class="fa fa-close icon"></i>{{trans('words.remove')}}</a>
              </td>
          </tr>
          @endforeach
           
        </tbody></table>
        @include('_particles.pagination', ['paginator' => $propertieslist])
      </div>
        
        
    
    </div><!-- end col -->
  </div>
  </div>
  
  </div>


  @endsection