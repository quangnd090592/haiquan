@extends('layouts.app')
@section('title')
	Phòng ban
@stop
@section('content')
	<div class="row wrap-content hidden" ng-controller="departmentsController">
		<div>
			<button class="btn btn-default" ng-click="addDepartment()">Thêm</button>
		</div>
		<div>
			<table ng-table="tableParams" class="table table-condensed table-bordered table-striped">
		        <tr ng-repeat="department in $data">
		          	<td data-title="'Tên'" sortable="'name'">@{{department.name}}</td>
		          	<td data-title="'Mô tả'" sortable="'name'">@{{department.description}}</td>
		          	<td>
		          		<a ng-click="addDepartment(department.id)" class="pointer">
                        	<i class="fa fa-pencil action"></i>
                    	</a>

                    	<a ng-click="removeDepartment(department.id)" class="pointer">
                        	<i class="fa fa-trash action"></i>
                    	</a>
		          	</td>
		        </tr>
		    </table>			
		</div>
	</div>
@stop
<script>
	window.departments = {!!json_encode($departments)!!};
</script>
@section('module-scripts')
	{!! Html::script('/app/components/departments/departmentsService.js')!!}
	{!! Html::script('/app/components/departments/departmentsController.js')!!}
@stop