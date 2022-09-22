      <div class="sidebar-box">
        <h3>{{trans('words.property_search')}}</h3>
        {!! Form::open(array('url' => array('searchproperties'),'class'=>'','name'=>'search_form','id'=>'search_form','role'=>'form')) !!}
        <div class="box-content">
          <div class="property-search-form vertical">
            <div class="main-search-sec">
              <div class="search-field">
                <input type="text" placeholder="{{trans('words.search_placeholder')}}" name="keyword" id="keyword" style="margin-bottom: 0px;border:1px solid #d4d4d4;border-bottom-color: #50AEE6;">
              </div>
              <div class="search-field">
                <select id="proeprty-status" name="purpose">
                   <option value="">{{trans('words.property_purpose')}}</option>
                   <option value="{{trans('words.purpose_sale')}}">{{trans('words.for_sale')}}</option>
                   <option value="{{trans('words.purpose_rent')}}">{{trans('words.for_rent')}}</option>
                </select>
              </div>
              <div class="search-field">
                <select id="proeprty-type" name="type">
                  <option value="">{{trans('words.property_type')}}</option>
                  @foreach(\App\Types::orderBy('types')->get() as $type)
                        <option value="{{$type->id}}">{{$type->types}}</option>
                  @endforeach
                </select>
              </div>
               
              <div class="search-field">
                <button class="btn" type="submit" name="submit">{{trans('words.search')}}</button>                 
              </div>
            </div>
             
          </div>
        </div>
        {!! Form::close() !!}
      </div>

      <div class="sidebar-box">
        <h3>{{trans('words.mortgage_calculator')}}</h3>
        <div class="box-content">
          <div class="property-search-form vertical">
            <div class="main-search-sec">
            <form action="javascript:void(0);" autocomplete="off" class="mortgageCalc" data-calc-currency="{{getcong('currency_sign')}}">
              
              <div class="search-field">
                <input type="text" id="amount" name="amount" placeholder="{{trans('words.sale_price')}}" class="number-field" style="margin-bottom: 0px;border:1px solid #d4d4d4;border-bottom-color: #50AEE6;" required>

              </div>
              <div class="search-field">
                <input type="text" id="downpayment" placeholder="{{trans('words.down_payment')}}" class="number-field" style="margin-bottom: 0px;border:1px solid #d4d4d4;border-bottom-color: #50AEE6;" required>

              </div>
              <div class="search-field">
                <input type="text" id="years" placeholder="{{trans('words.loan_term_years')}}" class="number-field" style="margin-bottom: 0px;border:1px solid #d4d4d4;border-bottom-color: #50AEE6;" required>

              </div>
              <div class="search-field">
                <input type="text" id="interest" placeholder="{{trans('words.interest_rate')}}" class="number-field" style="margin-bottom: 0px;border:1px solid #d4d4d4;border-bottom-color: #50AEE6;" required>

              </div>
               <div class="search-field">
                <button class="btn calc-button" formvalidate>{{trans('words.calculate')}}</button>        
              </div>
              <div class="calc-output-container" style="opacity: 0;    max-height: 0;"><div class="alert alert-success">{{trans('words.monthly_payment')}}: <strong class="calc-output"></strong></div></div>
            </form>
            </div>
           </div>   
        </div>
      </div>


      <div class="sidebar-box">
        <h3>{{trans('words.property_type')}}</h3>
        <div class="box-content">
          <ul>
            @foreach(\App\Types::orderBy('types')->get() as $type)
            <li><a href="{{URL::to('type/'.$type->slug.'')}}" style="color: #333333;">{{$type->types}}</a>&nbsp;({{countPropertyType($type->id)}})</li>
            @endforeach
             
          </ul>
        </div>
      </div>
 
      <div class="sidebar-box">
        <h3>{{trans('words.featured_properties')}}</h3>
        <div class="box-content">
          <div class="featured-properties">
            <div class="property-box">
              
              @foreach(\App\Properties::where('featured_property',1)->orderBy('id','desc')->take(3)->get() as $property)
              <a href="{{ url('properties/'.$property->property_slug.'/'.$property->id) }}" class="clearfix">
                <span class="img-container col-xs-4">
                  <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="Image of Property">
                </span>
                <span class="details col-xs-8">
                  <span class="title">{{ Str::limit($property->property_name,35) }}</span>
                  <span class="location">{{ Str::limit($property->address,40) }}</span>
                  <span class="price">{{getcong('currency_sign').' '.$property->price}}</span>
                </span>
              </a>
              @endforeach
           
            </div>
          </div>
        </div>
      </div>
 
      <!--End of Sidebar Box-->