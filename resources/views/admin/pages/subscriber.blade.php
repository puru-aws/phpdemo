@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		 
		<h2>{{trans('words.subscribers')}}</h2>
	</div>
	@if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif
     
<div class="panel panel-default panel-shadow">
    <div class="panel-body">
         
        <table class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
	            <tr>
	                <th>{{trans('words.email')}}</th>
	                <th>{{trans('words.ip')}}</th>
	                 
	                <th class="text-center width-100">{{trans('words.action')}}</th>
	            </tr>
            </thead>

            <tbody>
            @foreach($subscriberlist as $i => $subscriber)
         	   <tr>
            	
                <td>{{ $subscriber->email }}</td>
                <td>{{ $subscriber->ip }}</td>
                <td class="text-center">
                	 
                    <a href="{{ url('admin/subscriber/delete/'.Crypt::encryptString($subscriber->id)) }}" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm('{{trans('words.dlt_warning_text')}}')" data-toggle="tooltip" title="{{trans('words.remove')}}"> <i class="fa fa-remove"></i> </a>
                
            </td>
                
            </tr>
           @endforeach
             
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="text-center">
                        @include('admin.pagination', ['paginator' => $subscriberlist])
                         
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

</div>



@endsection