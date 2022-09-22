@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ isset($user->name) ? trans('words.edit').': '. $user->name : trans('words.add').' '.trans('words.user') }}</h2>
		
		<a href="{{ URL::to('admin/users') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
	  
	</div>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	 @if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif
   
   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/users/adduser'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">
                  
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="{{ isset($user->name) ? $user->name : null }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.phone')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" value="{{ isset($user->phone) ? $user->phone : null }}" class="form-control" value="">
                    </div>
                </div>
				 
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.about')}}</label>
                    <div class="col-sm-9">
                         
						<textarea name="about" cols="50" rows="5" class="form-control">{{ isset($user->about) ? $user->about : null }}</textarea>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" name="facebook" value="{{ isset($user->facebook) ? $user->facebook : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" name="twitter" value="{{ isset($user->twitter) ? $user->twitter : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Instagram</label>
                    <div class="col-sm-9">
                        <input type="text" name="instagram" value="{{ isset($user->instagram) ? $user->instagram : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin</label>
                    <div class="col-sm-9">
                        <input type="text" name="linkedin" value="{{ isset($user->linkedin) ? $user->linkedin : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">{{trans('words.profile_picture')}}</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($user->image_icon))
                                 
									<img src="{{ URL::asset('upload/members/'.$user->image_icon.'-s.jpg') }}" width="80" alt="person">
								@endif
								                                
                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="image_icon" class="filestyle"> 
                            </div>
                        </div>
	
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.user_type')}}</label>
                    <div class="col-sm-4"> 
                        <select name="usertype" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
								@if(isset($user->usertype))
								
								<option value="Agents" @if($user->usertype=='Agents') selected @endif>{{trans('words.agent')}}</option>
 								<option value="User" @if($user->usertype=='User') selected @endif>{{trans('words.user')}}</option>
 
								
								@else
									    
 										<option value="Agents">{{trans('words.agent')}}</option>
										<option value="User">{{trans('words.user')}}</option> 
									 
								@endif
								 
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.status')}}</label>
                    <div class="col-sm-4"> 
                        <select name="status" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                @if(isset($user->status))
                                
                                <option value="1" @if($user->status=='1') selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if($user->status=='0') selected @endif>{{trans('words.inactive')}}</option>
 
                                
                                @else
                                        
                                        <option value="1">{{trans('words.active')}}</option>
                                        <option value="0">{{trans('words.inactive')}}</option> 
                                     
                                @endif
                                 
                        </select>
                    </div>
                </div>
				<hr />
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.email')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" value="{{ isset($user->email) ? $user->email : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" value="" class="form-control">
                    </div>
                </div>
                 
                
                 
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ isset($user->name) ? trans('words.save_changes') : trans('words.submit') }}</button>
                         
                    </div>
                </div>
                
                {!! Form::close() !!} 
            </div>
        </div>
   
    
</div>

@endsection