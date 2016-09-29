rolesModule.controller('rolesController', ['$scope', '$modal', '$filter','$timeout', 'ngTableParams', 'rolesService', function ($scope, $modal, $filter, $timeout, ngTableParams, rolesService) {
	$('.wrap-content').removeClass('hidden');
	$scope.roles = rolesService.setRoles(angular.copy(window.roles));
    
	$scope.tableParams = new ngTableParams({
        page: 1,
        count: 10,
        filter: {
            name: ''
        },
        sorting: {
            name: 'asc'
        }

    }, {
        total: $scope.roles.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.roles, params.filter()) : $scope.roles;
        	orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
            $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        }
    });

    /**
     * create and update roles
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    $scope.addRole = function(id) {
        var teamplate = '/roles/create';
        if(typeof id != 'undefined'){
            teamplate = '/roles/'+ id + '/edit' + '?' + new Date().getTime();
        }
        var modalInstance = $modal.open({
            animation: true,
            templateUrl: teamplate,
            controller: 'ModalRoleCtrl',
            size: null,
            resolve: {
            }
            
        });

        modalInstance.result.then(function (data) {
            // $scope.data = LanguageService.getLanguages();
            $scope.tableParams.reload();            
        }, function () {

        });
    }

    /**
     * remove role
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    $scope.removeRole = function(id) {
        if(!confirm('Bạn có muốn xóa quyền này?')) {
            return;
        } else {
            rolesService.removeRole(id).then(function (data) {
                if(data.status){
                    $scope.tableParams.reload();
                }
            });
        }
        
    };

    /**
     * open modal add user to role
     *
     *@author Quang <quangnd.92@gmail.com>
     * 
     * @param {[type]} id [description]
     */
    $scope.addUserToRole = function(id) {
        var teamplate = '/roles/'+id+'/add-user?v=' + new Date().getTime();
        
        var modalInstance = $modal.open({
            animation: true,
            templateUrl: teamplate,
            controller: 'ModalRoleCtrl',
            size: null,
            resolve: {
            }
            
        });
    }

}]);

rolesModule.controller('ModalRoleCtrl', ['$scope', '$modal', '$filter','$timeout', '$modalInstance', 'ngTableParams', 'rolesService', function ($scope, $modal, $filter, $timeout, $modalInstance, ngTableParams, rolesService) {
    function change_alias( alias ) {
        var str = alias;
        str= str.toLowerCase();
        str= str.trim(); 
        str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ  |ặ|ẳ|ẵ/g,"a"); 
        str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
        str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
        str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ  |ợ|ở|ỡ/g,"o"); 
        str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
        str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
        str= str.replace(/đ/g,"d"); 
        str= str.replace(/\s{1,}/g,"_");
        return str;
    }

    $scope.intiSelect2 = function(element) {
        $timeout(function(){
            $(element).select2();
        },300);

        $(element).on("change", function (e) {
            var userSelected = $(element).select2("val");

            rolesService.addUser($scope.role.id, userSelected).then(function (data){
                if(data.status) {
                    angular.forEach($scope.usersNotInRole, function(value,key){
                        if(value.id == parseInt(userSelected)) {
                            //remove list user in dropdown
                            $scope.usersNotInRole.splice(key,1);
                            //push to list user
                            $scope.usersInRole.push(value);
                        }
                    })
                } else {
                    $scope.errors = 'Lỗi! Không thể thêm tài khoản này.';
                }
            });
        });
    }

    /**
     * remove user from role
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  {[type]} userId [description]
     * @return {[type]}        [description]
     */
    $scope.removeUser = function(userId) {
        rolesService.removeUser($scope.role.id, userId).then(function (data){
            if(data.status) {
                angular.forEach($scope.usersInRole, function(value,key){
                    if(value.id == userId) {
                        //remove list user in dropdown
                        $scope.usersInRole.splice(key,1);
                        //push to list user
                        $scope.usersNotInRole.push(value);
                    }
                })
            } else {
                $scope.errors = 'Lỗi! Không thể xóa tài khoản này.';
            }
        });
    }

    $scope.submit = function (validate) {
        $scope.submitted  = true;
        if(validate){
            return;
        }
        
        if(typeof $scope.role.id == 'undefined') {
            $scope.role.slug = change_alias($scope.role.name);
        }

        rolesService.createRole($scope.role).then(function (data){
            if(data.status) {
                $modalInstance.close(data.role);                
            } else {
                $scope.errors = data.errors;
            }
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

}]);