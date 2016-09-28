@extends('layouts.app')
@section('title')
	Xuất Xứ
@stop
@section('content')
	<div class="row wrap-content hidden" ng-controller="producersController">
		<div>
			<button class="btn btn-default" ng-click="addProducer()">Thêm</button>
		</div>
		<div>
			<table ng-table="tableParams" class="table table-condensed table-bordered table-striped">
		        <tr ng-repeat="producer in $data">
		          	<td data-title="'Tên'" sortable="'name'">@{{producer.name}}</td>
		          	<td>
		          		<a ng-click="addProducer(producer.id)" class="pointer">
                        	<i class="fa fa-pencil action"></i>
                    	</a>

                    	<a ng-click="removeProducer(producer.id)" class="pointer">
                        	<i class="fa fa-trash action"></i>
                    	</a>
		          	</td>
		        </tr>
		    </table>			
		</div>
	</div>
@stop
<script>
	window.producers = {!!json_encode($producers)!!};
</script>
@section('module-scripts')
	{!! Html::script('/app/components/producers/producersService.js')!!}
	{!! Html::script('/app/components/producers/producersController.js')!!}
@stop