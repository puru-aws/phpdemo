@extends("app")

@section('head_title', trans('words.my_invoice').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.my_invoice')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">Home</a></li>
          <li><a href="#">{{trans('words.my_invoice')}}</a></li>
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
              <th align="center">{{trans('words.property')}}</th>
              <th align="center">{{trans('words.transaction_id')}}</th>
              <th align="center">{{trans('words.amount')}}</th>
              <th align="center">{{trans('words.tax')}}</th>
              <th align="center">{{trans('words.total_amount')}}</th>                 
              <th align="center">{{trans('words.date')}}</th>
              <th align="center">{{trans('words.invoice')}}</th>
            </tr>
          
              
              @foreach($transaction as $i => $trans)
             <tr>               
                <td align="center">{{ \App\Properties::getPropertyInfo($trans->property_id)->property_name }} For {{ \App\Properties::getPropertyInfo($trans->property_id)->property_purpose }}</td>          
                 <td align="center">{{ $trans->payment_id}}</td>
                 <td align="center">{!!getcong('currency_sign')!!} {{$trans->payment_amount}}</td>
                 <td align="center">{!!getcong('currency_sign')!!}{{$trans->tax_amount}}</td>                  
                <td align="center">{!!getcong('currency_sign')!!}{{$trans->total_payment_amount}}</td>
                <td align="center">{{ date('M,  jS, Y',$trans->date) }}</td>
                <td align="center"><a href="{{ url('user_invoice/'. Crypt::encryptString($trans->id)) }}" target="_blank" class="btn btn-default btn-rounded"><i class="fa fa-eye"></i></a></td>  
            </tr>
           @endforeach

               
           
        </tbody></table>
        @include('_particles.pagination', ['paginator' => $transaction])
      </div>
        
        
    
    </div><!-- end col -->
  </div>
  </div>
  
  </div>


  @endsection