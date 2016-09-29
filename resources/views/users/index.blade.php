@extends('layouts.app')
@section('title')
	Tài Khoản
@stop
@section('content')
	<div class="row wrap-content hidden" ng-controller="usersController">
		<div>
			<button class="btn btn-default" ng-click="addUser()">Thêm</button>
		</div>
		<div>
			<table ng-table="tableParams" class="table table-condensed table-bordered table-striped">
		        <tr ng-repeat="user in $data">
		          	<td data-title="'Tên'" sortable="'name'">@{{user.name}}</td>
		          	<td data-title="'Email'" sortable="'name'">@{{user.email}}</td>
		          	<td>
		          		<a ng-click="addUser(user.id)" class="pointer">
                        	<i class="fa fa-pencil action"></i>
                    	</a>

                    	<a ng-click="removeUser(user.id)" class="pointer">
                        	<i class="fa fa-trash action"></i>
                    	</a>
		          	</td>
		        </tr>
		    </table>			
		</div>
	</div>
@stop
<script>
	window.users = {!!json_encode($users)!!};
</script>
@section('module-scripts')
	{!! Html::script('/app/components/users/usersService.js')!!}
	{!! Html::script('/app/components/users/usersController.js')!!}
@stop