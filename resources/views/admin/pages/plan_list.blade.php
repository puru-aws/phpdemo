@extends("admin.admin_app")

@section("content")
<div id="main">
  <div class="page-header">
    
    <div class="pull-right">
      <a href="{{URL::to('admin/subscription_plan/add_plan')}}" class="btn btn-primary">{{trans('words.add').' '.trans('words.plan')}} <i class="fa fa-plus"></i></a>
    </div>
    <h2>{{trans('words.subscription_plan')}}</h2>
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
                  <th>{{trans('words.plan_name')}}</th>
                  <th>{{trans('words.duration')}}</th>
                  <th>{{trans('words.price')}}</th>
                  <th>{{trans('words.status')}}</th>

                  <th class="text-center width-100">{{trans('words.action')}}</th>
              </tr>
            </thead>

            <tbody>
            @foreach($plan_list as $i => $plan_data)
             <tr>
               
                <td>{{ $plan_data->plan_name }}</td>
                <td>{{ App\SubscriptionPlan::getPlanDuration($plan_data->id) }}</td>
                <td>{{ $plan_data->plan_price }}</td>
                <td>
                
                  @if($plan_data->status==1) 
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
                 <a href="{{ url('admin/subscription_plan/edit_plan/'.$plan_data->id) }}" class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5" data-toggle="tooltip" title="{{trans('words.edit')}}"> <i class="fa fa-edit"></i> </a>
                 <a href="{{ url('admin/subscription_plan/delete/'.$plan_data->id) }}" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm('{{trans('words.dlt_warning_text')}}')" data-toggle="tooltip" title="{{trans('words.remove')}}"> <i class="fa fa-remove"></i> </a>
                
                </td>
                
            </tr>
           @endforeach
             
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

</div>



@endsection