
<div class="modal-header">
    <h4 class="modal-title">
        @if(empty($user->id))
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
	<form role="form" name="createUser" ng-init="user={{json_encode($user)}}" novalidate>
        <!-- name -->
        <div class="form-group">
            <label for="">Tên<span class="text-require"> *</span></label>
            <input type="text" class="form-control" name="name" placeholder="Tên" ng-model="user.name" ng-required="true" />
            <div class="clearfix"></div>
            <div class="show-error pull-left">
                <small class="help-inline" ng-show="submitted && createUser.name.$error.required">Tên không được bỏ trống.</small>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- email -->
        <div class="form-group">
            <label for="">Email<span class="text-require"> *</span></label>
            <input type="text" class="form-control" name="email" placeholder="Email" ng-model="user.email" ng-required="true" />
            <div class="clearfix"></div>
            <div class="show-error pull-left">
                <small class="help-inline" ng-show="submitted && createUser.email.$error.required">Tên không được bỏ trống.</small>
                <small class="help-inline" ng-show="submitted && createUser.email.$error.email">Email không hợp lệ</small>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <!-- password -->
        <div class="form-group">
            <label for="">Mật Khẩu<span class="text-require"> *</span></label>
            <input type="password" class="form-control" name="password" placeholder="Password" ng-model="user.password" ng-required="true" />
            <div class="clearfix"></div>
            <div class="show-error pull-left">
                <small class="help-inline" ng-show="submitted && createUser.password.$error.required">Mật khẩu không được bỏ trống.</small>
            </div>
        </div>
        
        <div class="clearfix"></div>
   </form>
</div>
<div class="modal-footer">
    <button class="btn btn-default" ng-click="cancel()"> <i class="fa fa-times"></i>Thoát</button>
    <button class="btn btn-primary" ng-click="submit(createUser.$invalid)">
        <i class="fa fa-plus"></i>
        <span>
            @if(empty($user->id))
                Thêm
            @else
                Sửa
            @endif
        </span>
	</button>
</div>
