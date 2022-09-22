@extends("admin.admin_app")

@section("content")

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ["Months", @foreach($plan_list as $plan_data) '{{$plan_data->plan_name}}', @endforeach],
          
          <?php for ($i = 1; $i <= 12; $i++)
            {
                //$month_name =date("M", strtotime("$i/12/10"));
                $month_name_full =date("F", strtotime("$i/12/10"));
                ?>
            
            ['<?php echo $month_name_full;?>', @foreach($plan_list as $plan_data_obj) <?php echo plan_count_by_month($plan_data_obj->id,$month_name_full);?>,@endforeach],
            
            <?php  }?>
                     
        ]);

        var options = {
          chart: {
            title: "{{trans('words.properties_plan_statistics')}}",
            subtitle: "{{trans('words.current_year')}}",
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<style type="text/css">
    .card-box {
    padding: 20px;
    box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.06), 0 1px 0px 0 rgba(0, 0, 0, 0.02);
    border-radius: 5px;
    margin-bottom: 20px;
    background-color: #ffffff;
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
</style>

<div id="main">
	<div class="page-header">
		<h2>{{trans('words.overview')}}</h2>
	</div>
    
 

    
  	@if(Auth::user()->usertype=='Admin')
    <div class="row">	
    	<a href="{{ URL::to('admin/properties') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow" style="background-color: #188ae2 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.properties')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$properties_count}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/properties') }}" style="text-decoration: none;">
        <div class="col-sm-6 col-md-3">
        <div class="panel panel-grey panel-shadow" style="background-color: #71b6f9 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.pending')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$pending_properties_count}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/featuredproperties') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-green panel-shadow" style="background-color: #ff5b5b !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.featured')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$featured_properties}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-star fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    
    <a href="{{ URL::to('admin/inquiries') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-primary panel-shadow" style="background-color: #343a40 !important;border-color:#343a40;">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.inquiries')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$inquiries}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-send fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    
    <a href="{{ URL::to('admin/users') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-pink panel-shadow" style="background: #ff71c1 !important;
  color: #fff;">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.users')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$users}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-users fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    
    <a href="{{ URL::to('admin/testimonials') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-shadow" style="background: #545b62!important;
  color: #fff;">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.testimonials')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$testimonials}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-list fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    
    <a href="{{ URL::to('admin/subscriber') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-default panel-shadow" style="background: #1bce7b !important;
  color: #fff; border-color: #1bce7b;">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.subscribers')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$subscriber}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-envelope fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    
    <a href="{{ URL::to('admin/transactions') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow" style="background: #21afda !important;
  color: #fff;">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.transactions')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$transactions}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-list fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/transactions') }}" style="text-decoration: none;">
        <div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow" style="background-color: #ff2828 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-150">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.daily_revenue')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$daily_amount}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-100">
                        <i class="fa fa-dollar fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/transactions') }}" style="text-decoration: none;">
        <div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow" style="background-color: #4a59b4 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-150">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.weekly_revenue')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$weekly_amount}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-100">
                        <i class="fa fa-dollar fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/transactions') }}" style="text-decoration: none;">
        <div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow" style="background-color: #f8c038 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-150">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.monthly_revenue')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$monthly_amount}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-100">
                        <i class="fa fa-dollar fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/transactions') }}" style="text-decoration: none;">
        <div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow" style="background-color: #0eac5c !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-150">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.yearly_revenue')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$yearly_amount}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-100">
                        <i class="fa fa-dollar fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    </div>

    <div class="card-box table-responsive">
        <div class="row">
             <div class="col-xl-9" id="columnchart_material" style="height: 400px;"></div>
         
        </div> 
    </div>

    @else
    <div class="row">
    <a href="{{ URL::to('admin/properties') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow" style="background-color: #188ae2 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.properties')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$properties_count}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
     
    
    <a href="{{ URL::to('admin/inquiries') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-primary panel-shadow" style="background-color: #343a40 !important;border-color:#343a40;">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.inquiries')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$inquiries}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-send fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    </div>
    @endif

 
  
</div>

@endsection