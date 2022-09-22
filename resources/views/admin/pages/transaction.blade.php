@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		 
		<h2>{{trans('words.transactions')}}</h2>
	</div>
	@if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif

<div class="panel panel-shadow">
        
        <div class="panel-body"> 
        <div class="col-sm-3">
            <select class="form-control" name="gateway_select" id="gateway_select">
                  <option value="">{{trans('words.filter_by_gateway')}}</option>                 
                  <option value="?gateway=Paypal" @if(isset($_GET['gateway']) && $_GET['gateway']=='Paypal' ) selected @endif>Paypal</option>
                  <option value="?gateway=Stripe" @if(isset($_GET['gateway']) && $_GET['gateway']=='Stripe' ) selected @endif>Stripe</option>
                  <option value="?gateway=Razorpay" @if(isset($_GET['gateway']) && $_GET['gateway']=='Razorpay' ) selected @endif>Razorpay</option>
                  <option value="?gateway=Paystack" @if(isset($_GET['gateway']) && $_GET['gateway']=='Paystack' ) selected @endif>Paystack</option>                
            </select>
        </div>
        <div class="col-sm-5">          
         {!! Form::open(array('url' => 'admin/transactions','class'=>'form-inline filter','id'=>'search','role'=>'form','method'=>'get')) !!}	
            <span class="bold text-muted">{{trans('words.search')}}</span>
            <div class="form-group">
                <input type="text" class="form-control" id="" name="s" placeholder="{{trans('words.search_by_email_trans')}}">
            </div>             
            <div class="form-group">              
                <button type="submit" class="btn btn-default-dark  pull-right">{{trans('words.search')}}</button>
            </div>
        {!! Form::close() !!}
        </div>
        <a href="{{URL::to('admin/transactions/export')}}" class="btn btn-info btn-md waves-effect waves-light pull-right" data-toggle="tooltip" title="{{trans('words.export_transactions')}}"><i class="fa fa-file-excel-o"></i> {{trans('words.export_transactions')}}</a>
    	</div>
	</div>
     
<div class="panel panel-default panel-shadow">
    <div class="panel-body table-responsive">
         
        <table class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
	            <tr>
	                <th>{{trans('words.property_id')}}</th>
                    <th>{{trans('words.name')}}</th>
                    <th>{{trans('words.email')}}</th>
                    <th>{{trans('words.gateway')}}</th>
                    <th>{{trans('words.transaction_id')}}</th>
                    <th>{{trans('words.amount')}}</th>
                    <th>{{trans('words.tax_amount')}}</th>
                    <th>{{trans('words.total_amount')}}</th>	                
                    <th>{{trans('words.date')}}</th>
                    <th>{{trans('words.invoice')}}</th>
	                 
	            </tr>
            </thead>

            <tbody>
            @foreach($transactions_list as $i => $trans)
         	   <tr>
            	<td>{{ $trans->property_id}}</td>
                <td>{{ getUserInfo($trans->user_id)->name }}</td>           	 
                <td>{{ $trans->email}}</td>
                <td>{{ $trans->gateway}}</td>
                <td>{{ $trans->payment_id}}</td>
                <td>{{getcong('currency_sign').''.$trans->payment_amount}}</td>
                <td>{{getcong('currency_sign').''.$trans->tax_amount}}</td>
                <td>{{getcong('currency_sign').''.$trans->total_payment_amount}}</td>
                <td>{{ date('M,  jS, Y',$trans->date) }}</td>
                <td><a href="{{ url('admin/transactions/user_invoice/'. Crypt::encryptString($trans->id)) }}" class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5" data-toggle="tooltip" title="{{trans('words.view_invoice')}}" target="_blank"> <i class="fa fa-file-text"></i> </a></td>  
            </tr>
           @endforeach
             
            </tbody>
            <tfoot>
		        <tr>
		            <td colspan="8" class="text-center">
		            	@include('admin.pagination', ['paginator' => $transactions_list]) 
		                 
		            </td>
		        </tr>
        	</tfoot>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

</div>



@endsection