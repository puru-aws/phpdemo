@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		
		<div class="pull-right">
			<a href="{{URL::to('submit-property')}}" class="btn btn-primary" target="_blank">{{trans('words.add_property')}} <i class="fa fa-plus"></i></a>
		</div>
		<h2>{{trans('words.properties')}}</h2>
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
    	<div class="col-sm-10">          
         {!! Form::open(array('url' => 'admin/properties','class'=>'form-inline filter','id'=>'search','role'=>'form','method'=>'get')) !!}	
            <span class="bold text-muted">{{trans('words.search')}}</span>
            <div class="form-group">
                <input type="text" class="form-control" id="" name="keyword" placeholder="{{trans('words.search_placeholder')}}">
            </div>             
            <div class="form-group">
                <select name="purpose" id="basic" class="selectpicker show-tick form-control" data-live-search="false">
                   <option value="">{{trans('words.property_purpose')}}</option>
                   <option value="{{trans('words.purpose_sale')}}">{{trans('words.for_sale')}}</option>
                   <option value="{{trans('words.purpose_rent')}}">{{trans('words.for_rent')}}</option>
                </select>
            </div>
            <div class="form-group">
                <select id="proeprty-type" name="type" class="selectpicker show-tick form-control" data-live-search="false">
                  <option value="">{{trans('words.property_type')}}</option>
                  @foreach(\App\Types::orderBy('types')->get() as $type)
                        <option value="{{$type->id}}">{{$type->types}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-default-dark  pull-right">{{trans('words.search')}}</button>
            </div>
        {!! Form::close() !!}
    	</div>
    	<div class="col-sm-2">   
        	<a href="{{URL::to('admin/properties/export')}}" class="btn btn-info btn-md waves-effect waves-light" data-toggle="tooltip" title="{{trans('words.export_property')}}"><i class="fa fa-file-excel-o"></i> {{trans('words.export_property')}}</a>
        </div>	
    	</div>
	</div>
     
<div class="panel panel-default panel-shadow">
 
    <div class="panel-body table-responsive">         
        <table class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
	            <tr>
	                <th>{{trans('words.property_id')}}</th>
	                <th>{{trans('words.user_name')}}</th>
	                <th>{{trans('words.property_name')}}</th>
					<th>{{trans('words.type')}}</th>
					<th>{{trans('words.purpose')}}</th>
					<th>{{trans('words.plan')}}</th>
					<th>{{trans('words.expiry_date')}}</th>
	                <th class="text-center">{{trans('words.status')}}</th> 
	                <th class="text-center width-100">{{trans('words.action')}}</th>
	            </tr>
            </thead>

            <tbody>
            @foreach($propertieslist as $i => $property)
         	   <tr>
            	
				<td>{{ $property->id }}</td>
				<td>{{ getUserInfo($property->user_id)->name }}</td> 
                <td>{{ $property->property_name }}</td>
				<td>{{ getPropertyTypeName($property->property_type)->types }}</td>
				<td>{{ $property->property_purpose }}</td>
				<td>{{ \App\SubscriptionPlan::getSubscriptionPlanInfo($property->active_plan_id,'plan_name') }}</td>
				<td>
				@if($property->property_exp_date!='' AND $property->property_exp_date!=0)
                {{date('M,  jS, Y',$property->property_exp_date)}}   
                @endif

				</td>
				<td class="text-center">
						@if($property->status==1)
							<span class="icon-circle bg-green">
								<i class="md md-check"></i>
							</span>
						@else
							<span class="icon-circle bg-orange">
								<i class="md md-close"></i>
							</span>
						@endif
            	</td>  
                <td class="text-center">
                <div class="btn-group">
								<button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									{{trans('words.action')}} <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right" role="menu"> 
									<li><a href="Javascript::void();" data-toggle="modal" data-target="#PropertyPlanModal{{ $property->id }}"><i class="fa fa-dollar"></i> {{trans('words.change_plan')}}</a></li>
									<li><a href="{{ url('update-property/'.Crypt::encryptString($property->id)) }}" target="_blank"><i class="md md-edit"></i> {{trans('words.edit')}}</a></li>
									
									 
									<li>
										@if($property->featured_property==0)                	
					                	<a href="{{ url('admin/properties/featuredproperty/'.Crypt::encryptString($property->id)) }}"><i class="md md-star"></i> {{trans('words.set_as_featured')}}</a>
					                	@else
					                	<a href="{{ url('admin/properties/featuredproperty/'.Crypt::encryptString($property->id)) }}"><i class="md md-check"></i> {{trans('words.unset_as_featured')}}</a>
					                	@endif
									</li>
									 
									
									<li>
										@if($property->status==1)                	
					                	<a href="{{ url('admin/properties/status/'.Crypt::encryptString($property->id)) }}"><i class="md md-close"></i> {{trans('words.unpublish')}}</a>
					                	@else
					                	<a href="{{ url('admin/properties/status/'.Crypt::encryptString($property->id)) }}"><i class="md md-check"></i> {{trans('words.publish')}}</a>
					                	@endif
									</li>
									<li><a href="{{ url('admin/properties/delete/'.Crypt::encryptString($property->id)) }}" onclick="return confirm('{{trans('words.dlt_warning_text')}}')"><i class="md md-delete"></i> {{trans('words.remove')}}</a></li>
								</ul>
							</div> 
                
            </td>
                
            </tr>

            <div class="modal fade" id="PropertyPlanModal{{ $property->id }}" role="dialog" style="top: 100px;">
			    <div class="modal-dialog">
			       <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">{{ $property->property_name }} {{trans('words.property_plan')}}</h4>
			        </div>
			        <div class="modal-body">
			        	<div class="panel-body">
			        {!! Form::open(array('url' => array('admin/properties/plan_update'),'class'=>'','name'=>'plan_form','id'=>'plan_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 	

			        	<input type="hidden" name="property_id" value="{{ $property->id }}">

			        	<div class="form-group">
                    		<label class="col-sm-4 control-label">{{trans('words.subscription_plan')}}</label>
	                      <div class="col-sm-8">
	                            <select class="form-control" name="plan_id">                               
	                                @foreach(\App\SubscriptionPlan::orderBy('id')->get() as $plan_data)
	                                  <option value="{{$plan_data->id}}" @if(isset($property->active_plan_id) AND $property->active_plan_id==$plan_data->id) selected @endif>{{$plan_data->plan_name}}</option>
	                                @endforeach                            
	                            </select>
	                      </div>
                  		</div><br/><br/>
                  		<div class="form-group">
		                    <label class="col-sm-4 control-label">{{trans('words.expiry_date')}}</label>
		                    <div class="col-sm-8">
		                      <div class="input-group"> 
		                        <input type="text" name="property_exp_date" value="{{ $property->property_exp_date ? date('m/d/Y',$property->property_exp_date) : null }}" class="datepicker form-control" placeholder="mm/dd/yyyy">
		                        <div class="input-group-append">
		                            <span class="input-group-text"><i class="ti-calendar"></i></span>
		                        </div>
		                      </div>
		                    </div>
		                 </div><br/><br/>
		                 <div class="form-group">
		                    <label class="col-sm-4 col-form-label">{{trans('words.status')}}</label>
		                      <div class="col-sm-8">
		                            <select class="form-control" name="status">                               
		                                <option value="1" @if(isset($property->status) AND $property->status==1) selected @endif>{{trans('words.active')}}</option>
		                                <option value="0" @if(isset($property->status) AND $property->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
		                            </select>
		                      </div>
                		</div>
			          
			          </div>
			        </div>
			        <div class="modal-footer">
			          <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>	
			          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('words.close')}}</button>
			        </div>
			        {!! Form::close() !!} 
			      </div>      
			    </div>
			  </div>

           @endforeach
             
            </tbody>
            <tfoot>
		        <tr>
		            <td colspan="8" class="text-center">
		            	@include('admin.pagination', ['paginator' => $propertieslist])
		                 
		            </td>
		        </tr>
        	</tfoot>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

</div>



@endsection