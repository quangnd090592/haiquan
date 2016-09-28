@extends('layouts.app')
@section('title')
	Quyền
@stop
@section('content')
	<div class="row wrap-content hidden" ng-controller="rolesController">
		<div>
			<button class="btn btn-default" ng-click="addRole()">Thêm</button>
		</div>
		<div>
			<table ng-table="tableParams" class="table table-condensed table-bordered table-striped">
		        <tr ng-repeat="role in $data">
		          	<td data-title="'Tên'" sortable="'name'">@{{role.name}}</td>
		          	<td data-title="'Tên đại diện'" sortable="'name'">@{{role.slug}}</td>
		          	<td data-title="'Mô Tả'" sortable="'description'">@{{role.description}}</td>
		          	<td>
		          		<a ng-click="addRole(role.id)" class="pointer">
                        	<i class="fa fa-pencil action"></i>
                    	</a>

                    	<a ng-click="removeRole(role.id)" class="pointer">
                        	<i class="fa fa-trash action"></i>
                    	</a>
		          	</td>
		        </tr>
		    </table>			
		</div>
	</div>
@stop
<script>
	window.roles = {!!json_encode($roles)!!};
</script>
@section('module-scripts')
	{!! Html::script('/app/components/roles/rolesService.js')!!}
	{!! Html::script('/app/components/roles/rolesController.js')!!}
@stop