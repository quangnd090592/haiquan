
<div class="modal-header">
    <h4 class="modal-title">
        @if(empty($department->id))
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
	<form role="form" name="createDepartment" ng-init="department={{json_encode($department)}}" novalidate>
        <div class="form-group">
            <label for="">Tên<span class="text-require"> *</span></label>
            <input type="text" class="form-control" name="name" placeholder="Tên" ng-model="department.name" ng-required="true" />
            <div class="clearfix"></div>
            <div class="show-error pull-left">
                <small class="help-inline" ng-show="submitted && createDepartment.name.$error.required">Tên không được bỏ trống.</small>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
            <label for="">Mô tả</label>
            <input type="text" class="form-control" name="description" placeholder="Mô tả" ng-model="department.description"/>
        </div>
        <div class="clearfix"></div>

   </form>
</div>
<div class="modal-footer">
    <button class="btn btn-default" ng-click="cancel()"> <i class="fa fa-times"></i>Thoát</button>
    <button class="btn btn-primary" ng-click="submit(createDepartment.$invalid)">
        <i class="fa fa-plus"></i>
        <span>
            @if(empty($department->id))
                Thêm
            @else
                Sửa
            @endif
        </span>
	</button>
</div>
