@extends("admin.admin_app")

@section("content")

<div id="main">
  <div class="page-header">
    <h2> {{ isset($plan_info->id) ? trans('words.edit').': '. $plan_info->plan_name : trans('words.add').' '.trans('words.plan') }}</h2>
    
    <a href="{{ URL::to('admin/subscription_plan') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
    
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
                {!! Form::open(array('url' => array('admin/subscription_plan/add_edit_plan'),'class'=>'form-horizontal padding-15','name'=>'plan_form','id'=>'plan_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                <input type="hidden" name="id" value="{{ isset($plan_info->id) ? $plan_info->id : null }}">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.plan_name')}}*</label>
                      <div class="col-sm-9">
                        <input type="text" name="plan_name" value="{{ isset($plan_info->plan_name) ? $plan_info->plan_name : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">{{trans('words.duration')}}*</label>
                    <div class="col-sm-5">
                      <input type="number" name="plan_duration" value="{{ isset($plan_info->plan_duration) ? $plan_info->plan_duration : null }}" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <select name="plan_duration_type" class="form-control">
                         <option value="1" @if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='1') selected @endif>{{trans('words.days')}}</option>

                         <option value="30" @if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='30') selected @endif>{{trans('words.months')}}</option>

                         <option value="365" @if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='365') selected @endif>{{trans('words.years')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">{{trans('words.price')}}*</label>
                    <div class="col-sm-9">
                      <input type="text" name="plan_price" value="{{ isset($plan_info->plan_price) ? $plan_info->plan_price : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">{{trans('words.status')}}</label>
                      <div class="col-sm-9">
                            <select class="form-control" name="status">                               
                                <option value="1" @if(isset($plan_info->status) AND $plan_info->status==1) selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if(isset($plan_info->status) AND $plan_info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
                            </select>
                      </div>
                </div>  
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                      <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                         
                    </div>
                </div>
                
                {!! Form::close() !!} 
            </div>
        </div>
   
    
</div>

@endsection