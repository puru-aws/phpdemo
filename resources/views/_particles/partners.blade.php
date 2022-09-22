@if(count($partners)>0)
<section id="our-partners">
    <div class="inner-container container">
      <h2 class="hsq-heading type-1">{{trans('words.our_partners')}}</h2>
      <div class="logo-container owl-carousel">
        @foreach($partners as $i => $partner)
        <div class="client-logo">
          <a href="{{$partner->url}}" target="_blank"><img src="{{ URL::asset('upload/partners/'.$partner->partner_image.'.jpg') }}" alt="{{$partner->name}}"></a>
        </div>
        @endforeach
   
      </div>
    </div>
  </section>
  @endif