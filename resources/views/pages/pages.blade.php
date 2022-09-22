@extends("app")

@section('head_title', $page_info->page_title.' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
 <!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{$page_info->page_title}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li>{{$page_info->page_title}}</li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->
<!-- begin:content -->
    <section class="main-container container" id="video-tour-section">
    <h2 class="hsq-heading type-1">{{$page_info->page_title}}</h2>
    <div class="content clearfix"> 
      <div class="desc" style="text-align: justify;color: #333333;">
        {!!stripslashes($page_info->page_content)!!}
      </div>
    </div>
  </section>
    <!-- end:content -->
 
@endsection
