<!-- Main Slider -->
  <section id="main-slider">
    
    @foreach(\App\Slider::orderBy('slider_title')->get() as $slide)
    <div class="items">
      <div class="img-container" data-bg-img="{{ URL::asset('upload/slides/'.$slide->image_name.'.jpg') }}"></div>
      <!-- Change the URL section based on your image\'s name -->
      <div class="slide-caption">
        <div class="inner-container clearfix">
          <div class="first-sec">{{ $slide->slider_text1 }}</div>
          <div class="sec-sec">{{ $slide->slider_text2 }}</div> 
        </div>
      </div>
    </div>
    @endforeach
   
  </section>
  <!-- End of Main Slider -->
  <!-- Property Search Box -->
    <section id="property-search-container" class="container" style="margin-bottom: 0px;">
        <div class="property-search-form horizontal">
            {!! Form::open(array('url' => array('searchproperties'),'class'=>'','name'=>'search_form','id'=>'search_form','role'=>'form')) !!}
            <div class="main-search-sec">
                <div class="col-xs-6 col-sm-3 search-field">
                    <input type="text" placeholder="{{trans('words.search_placeholder')}}" name="keyword" id="keyword" style="border:1px solid #d4d4d4;border-bottom-color: #50AEE6;" class="slider_search_placeholder">
                </div>
                <div class="col-xs-6 col-sm-3 search-field">
                    <select id="proeprty-status" name="purpose">
                       <option value="">{{trans('words.property_purpose')}}</option>
                       <option value="{{trans('words.purpose_sale')}}">{{trans('words.for_sale')}}</option>
                       <option value="{{trans('words.purpose_rent')}}">{{trans('words.for_rent')}}</option>
                    </select>
                </div>
                <div class="col-xs-6 col-sm-3 search-field">
                    <select id="proeprty-type" name="type">
                      <option value="">{{trans('words.property_type')}}</option>
                      @foreach(\App\Types::orderBy('types')->get() as $type)
                            <option value="{{$type->id}}">{{$type->types}}</option>
                      @endforeach
                    </select>
                </div>
                 
              
                <div class="col-xs-6 col-sm-3 search-field">
                    <button class="btn" type="submit" name="submit">{{trans('words.search')}}</button>
                </div>
            </div>
            {!! Form::close() !!} 
             
        </div>
    </section>
    <!-- End of Property Search Box -->