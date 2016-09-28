@extends('layouts.app')
@section('title')
	{{trans('assets/index.assets')}}
@stop
@section('content')
	<div class="row" ng-controller="assetsController">
		<table ng-table="tableParams" class="table table-condensed table-bordered table-striped">
	        <tr ng-repeat="asset in $data">
	          <td data-title="'Name'" sortable="'name'">@{{asset.name}}</td>
	        </tr>
	    </table>
	</div>
@stop
<script>
	window.assets = {{json_encode($assets)}};
</script>
@section('module-scripts')
	{!! Html::script('/app/components/assets/assetsService.js')!!}
	{!! Html::script('/app/components/assets/assetsController.js')!!}
@stop