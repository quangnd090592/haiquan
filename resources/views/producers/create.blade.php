
<div class="modal-header">
    <h4 class="modal-title">
        @if(empty($producer->id))
        	Thêm
        @else
            Sửa
        @endif
    </h4>
</div>
<div class="modal-body">
    <div class="alert alert-danger" ng-show="errors">
        <span ng-repeat="error in errors">@{{error[0]}}<br></span>
    </div>
	<form role="form" name="createProducer" ng-init="producer={{json_encode($producer)}}" novalidate>
        <div class="form-group">
            <label for="">Tên<span class="text-require"> *</span></label>
            <input type="text" class="form-control" name="name" placeholder="Tên" ng-model="producer.name" ng-required="true" />
            <div class="clearfix"></div>
            <div class="show-error pull-left">
                <small class="help-inline" ng-show="submitted && createProducer.name.$error.required">Tên không được bỏ trống.</small>
            </div>
        </div>
        <div class="clearfix"></div>
   </form>
</div>
<div class="modal-footer">
    <button class="btn btn-default" ng-click="cancel()"> <i class="fa fa-times"></i>Thoát</button>
    <button class="btn btn-primary" ng-click="submit(createProducer.$invalid)">
        <i class="fa fa-plus"></i>
        <span>
            @if(empty($producer->id))
                Thêm
            @else
                Sửa
            @endif
        </span>
	</button>
</div>
