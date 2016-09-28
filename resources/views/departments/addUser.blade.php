
<div class="modal-header">
    <h4 class="modal-title">
        Thêm người dùng vào phòng ban
    </h4>
</div>
<div class="modal-body" ng-init="usersOfDepartment = {{json_encode($usersOfDepartment)}}; usersNotInDepartment = {{json_encode($usersNotInDepartment)}}; department = {{json_encode($department)}}">
    <div class="alert alert-danger" ng-show="errors">
        @{{errors}}
    </div>
	<div>
        <select class="form-control" ng-init="intiSelect2('#user-department')" id='user-department'>
            <option value="">Select User</option>
            <option ng-repeat="user in usersNotInDepartment" value="@{{user.id}}">@{{user.name}}</option>
        </select>   
    </div>
    <div class="clearfix"></div>
    <div>
        <ul class="list-group">
            <li class="list-group-item" ng-repeat="value in usersOfDepartment">
                @{{value.name}} <a href="#" ng-click="removeUser(value.id)" class="fa fa-times pull-right"></a>
            </li>
        </ul>
    </div>
</div>
