@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		
		<div class="pull-right">
			<a href="{{URL::to('admin/users/adduser')}}" class="btn btn-primary">{{trans('words.add').' '.trans('words.user')}} <i class="fa fa-plus"></i></a>
		</div>
		<h2>Users</h2>
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
            
            <div class="col-sm-8">          
             {!! Form::open(array('url' => 'admin/users','class'=>'form-inline filter','id'=>'search','role'=>'form','method'=>'get')) !!}	
                <span class="bold text-muted">{{trans('words.search')}}</span>
                <div class="form-group">
                    <input type="text" class="form-control" id="" name="keyword" placeholder="{{trans('words.search_by_name_email')}}">
                </div>             
                <div class="form-group">
                    <select name="type" id="basic" class="selectpicker show-tick form-control" data-live-search="false">
                       <option value="">{{trans('words.user_type')}}</option>
                       <option value="Agent">{{trans('words.agent')}}</option>
                       <option value="User">{{trans('words.user')}}</option>
                    </select>
                </div>
                <div class="form-group"> 
                <button type="submit" class="btn btn-default-dark  pull-right">{{trans('words.search')}}</button>
                </div>
            {!! Form::close() !!}
            </div>
            <div class="col-sm-4">
            <a href="{{URL::to('admin/users/export')}}" class="btn btn-info btn-md waves-effect waves-light pull-right" data-toggle="tooltip" title="{{trans('words.export_users')}}"><i class="fa fa-file-excel-o"></i> {{trans('words.export_users')}}</a>
            </div>
    	</div>
	</div>
     
<div class="panel panel-default panel-shadow">
    <div class="panel-body table-responsive">
         
        <table class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
	            <tr>
	                <th>{{trans('words.user_type')}}</th>
	                <th>{{trans('words.image')}}</th>
	                <th>{{trans('words.name')}}</th>
	                <th>{{trans('words.email')}}</th>
					<th>{{trans('words.phone')}}</th> 
	                <th class="text-center width-100">{{trans('words.action')}}</th>
	            </tr>
            </thead>

            <tbody>
            @foreach($allusers as $i => $users)
         	   <tr>
            	<td>{{ $users->usertype }}</td>
            	<td> @if($users->image_icon)
                                 
									<img src="{{ URL::asset('upload/members/'.$users->image_icon.'-s.jpg') }}" width="80" alt="person">
								@endif</td>
                <td>{{ $users->name }}</td>
                <td>{{ $users->email}}</td>
                <td>{{ $users->phone}}</td>
                <td class="text-center">

                    <a href="{{ url('admin/users/adduser/'.Crypt::encryptString($users->id)) }}" class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5" data-toggle="tooltip" title="{{trans('words.edit')}}"> <i class="fa fa-edit"></i> </a>
                 <a href="{{ url('admin/users/delete/'.Crypt::encryptString($users->id)) }}" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm('{{trans('words.dlt_warning_text')}}')" data-toggle="tooltip" title="{{trans('words.remove')}}"> <i class="fa fa-remove"></i> </a>

               
                
            </td>
                
            </tr>
           @endforeach
             
            </tbody>
            <tfoot>
		        <tr>
		            <td colspan="8" class="text-center">
		            	@include('admin.pagination', ['paginator' => $allusers])
		                 
		            </td>
		        </tr>
        	</tfoot>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

</div>



@endsection