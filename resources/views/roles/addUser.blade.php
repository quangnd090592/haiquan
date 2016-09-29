
<div class="modal-header">
    <h4 class="modal-title">
        Thêm quyền cho người dùng
    </h4>
</div>
<div class="modal-body" ng-init="usersInRole = {{json_encode($usersInRole)}}; usersNotInRole = {{json_encode($usersNotInRole)}}; role = {{json_encode($role)}}">
    <div class="alert alert-danger" ng-show="errors">
        @{{errors}}
    </div>
	<div>
        <select class="form-control" ng-init="intiSelect2('#user-role')" id='user-role'>
            <option value="">Select User</option>
            <option ng-repeat="user in usersNotInRole" value="@{{user.id}}">@{{user.name}}</option>
        </select>   
    </div>
    <div class="clearfix"></div>
    <div>
        <ul class="list-group">
            <li class="list-group-item" ng-repeat="value in usersInRole">
                @{{value.name}} <a href="#" ng-click="removeUser(value.id)" class="fa fa-times pull-right"></a>
            </li>
        </ul>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-default" ng-click="cancel()"> <i class="fa fa-times"></i>Thoát</button>
</div>