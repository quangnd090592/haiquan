@extends('layouts.app')
@section('title')
	Loại Tài Sản
@stop
@section('content')
	<div class="row wrap-content hidden" ng-controller="assetTypesController">
		<div>
			<button class="btn btn-default" ng-click="addAssetType()">Thêm</button>
		</div>
		<div>
			<table ng-table="tableParams" class="table table-condensed table-bordered table-striped">
		        <tr ng-repeat="assetType in $data">
		          	<td data-title="'Tên'" sortable="'name'">@{{assetType.name}}</td>
		          	<td data-title="'Mô tả'" sortable="'name'">@{{assetType.description}}</td>
		          	<td>
		          		<a ng-click="addAssetType(assetType.id)" class="pointer">
                        	<i class="fa fa-pencil action"></i>
                    	</a>

                    	<a ng-click="removeAssetType(assetType.id)" class="pointer">
                        	<i class="fa fa-trash action"></i>
                    	</a>
		          	</td>
		        </tr>
		    </table>			
		</div>
	</div>
@stop
<script>
	window.assetTypes = {!!json_encode($assetTypes)!!};
</script>
@section('module-scripts')
	{!! Html::script('/app/components/assetTypes/assetTypesService.js')!!}
	{!! Html::script('/app/components/assetTypes/assetTypesController.js')!!}
@stop