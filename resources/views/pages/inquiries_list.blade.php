@extends("app")

@section('head_title', trans('words.inquiries').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.inquiries')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.inquiries')}}</a></li>
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
              <th style="width: 10%;">{{trans('words.property_id')}}</th>
              <th>{{trans('words.name')}}</th>
              <th>{{trans('words.email')}}</th>
              <th>{{trans('words.phone')}}</th>
              <th>{{trans('words.message')}}</th>
              <th>{{trans('words.action')}}</th>
            </tr>
          @foreach($inquiries_list as $i => $inquiries)
          <tr>
              <td style="text-align: center;">{{ $inquiries->property_id }}</td>
              <td class="property-post-status">{{ $inquiries->name }}</td>
              <td>{{ $inquiries->email }}</td>
              <td class="property-post-status">{{ $inquiries->phone }}</td>
              <td class="property-title"><p class="desc">{{ $inquiries->message }}</p></td>
               
              <td class="property-actions">                
                <a href="{{ url('inquiries/delete/'.Crypt::encryptString($inquiries->id)) }}" onclick="return confirm('{{trans('words.dlt_warning_text')}}')"><i class="fa fa-close icon"></i>{{trans('words.remove')}}</a>
              </td>
          </tr>
          @endforeach
           
        </tbody></table>
        @include('_particles.pagination', ['paginator' => $inquiries_list])
      </div>
        
        
    
    </div><!-- end col -->
  </div>
  </div>
  
  </div>


  @endsection