<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{trans('words.invoice')}} - {{getcong('site_name')}}</title>

     <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />

    <!------ Include the above in your HEAD tag ---------->
    <style type="text/css">
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }

    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }   

    </style>

</head>
<body onload="window.print()">
 
<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>{{trans('words.invoice')}}</h2><h3 class="pull-right">{{trans('words.order')}} # {{$transaction_info->id}}</h3>
    		</div>
    		<hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                    <strong>{{getcong('site_name')}}</strong><br>
                         
                    </address>
                </div>
                
            </div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>{{trans('words.customer_details')}}:</strong><br>
    					{{ getUserInfo($transaction_info->user_id)->name }}<br>
                        {{ \App\Properties::getPropertyInfo($transaction_info->property_id)->address }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>{{trans('words.business_details')}}:</strong><br>
    					{{getcong('invoice_company')}}<br>
                        {{getcong('invoice_address')}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>{{trans('words.payment_method')}}:</strong><br>
    					{{$transaction_info->gateway}}<br>
    					{{$transaction_info->email}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>{{trans('words.order_date')}}:</strong><br>
    					{{date('d F, Y',$transaction_info->date)}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>{{trans('words.order_summary')}}</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>{{trans('words.description')}}</strong></td>
        							<td class="text-center"><strong>{{trans('words.price')}}</strong></td>
        							<td class="text-center"><strong>{{trans('words.quantity')}}</strong></td>
        							<td class="text-right"><strong>{{trans('words.total')}}</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td>{{ \App\Properties::getPropertyInfo($transaction_info->property_id)->property_name }}</td>
    								<td class="text-center">{!!getcong('currency_sign')!!}{{$transaction_info->payment_amount}}</td>
    								<td class="text-center">1</td>
    								<td class="text-right">{!!getcong('currency_sign')!!}{{$transaction_info->payment_amount}}</td>
    							</tr>
                                 
                                 
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>{{trans('words.subtotal')}}</strong></td>
    								<td class="thick-line text-right">{!!getcong('currency_sign')!!}{{$transaction_info->payment_amount}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>{{trans('words.tax')}}</strong></td>
    								<td class="no-line text-right">{!!getcong('currency_sign')!!}{{$transaction_info->tax_amount}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>{{trans('words.total')}}</strong></td>
    								<td class="no-line text-right">{!!getcong('currency_sign')!!}{{$transaction_info->total_payment_amount}}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

</body>