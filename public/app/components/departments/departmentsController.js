departmentsModule.controller('departmentsController', ['$scope', '$modal', '$filter', 'ngTableParams', 'departmentsService', function ($scope, $modal, $filter, ngTableParams, departmentsService) {
	$('.wrap-content').removeClass('hidden');
	$scope.departments = departmentsService.setDepartments(angular.copy(window.departments));
    
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
        total: $scope.departments.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.departments, params.filter()) : $scope.departments;
        	orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
            $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        }
    });

    /**
     * create and update departments
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    $scope.addDepartment = function(id) {
        var teamplate = '/departments/create';
        if(typeof id != 'undefined'){
            teamplate = '/departments/'+ id + '/edit' + '?' + new Date().getTime();
        }
        var modalInstance = $modal.open({
            animation: true,
            templateUrl: teamplate,
            controller: 'ModalDepartmentCtrl',
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

    $scope.addUserToDepartment = function(id) {
        var teamplate = '/departments/'+id+'/add-user?v=' + new Date().getTime();
        var modalInstance = $modal.open({
            animation: true,
            templateUrl: teamplate,
            controller: 'ModalDepartmentCtrl',
            size: null,
            resolve: {
            }
            
        });
    }

    /**
     * remove department
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    $scope.removeDepartment = function(id) {
        if(!confirm('Bạn có muốn xóa Phòng ban này?')) {
            return;
        } else {
            departmentsService.removeDepartment(id).then(function (data) {
                if(data.status){
                    $scope.tableParams.reload();
                }
            });
        }
        
    };

}]);

departmentsModule.controller('ModalDepartmentCtrl', ['$scope', '$modal', '$filter', '$timeout', '$modalInstance', 'ngTableParams', 'departmentsService', function ($scope, $modal, $filter, $timeout, $modalInstance, ngTableParams, departmentsService) {
    
    $scope.intiSelect2 = function(element) {
        $timeout(function(){
            $(element).select2();
        },300);

        $(element).on("change", function (e) {
            var userSelected = $(element).select2("val");

            departmentsService.addUser($scope.department.id, userSelected).then(function (data){
                if(data.status) {
                    angular.forEach($scope.usersNotInDepartment, function(value,key){
                        if(value.id == parseInt(userSelected)) {
                            //remove list user in dropdown
                            $scope.usersNotInDepartment.splice(key,1);
                            //push to list user
                            $scope.usersOfDepartment.push(value);
                        }
                    })
                } else {
                    $scope.errors = 'Lỗi! Không thể thêm tài khoản này.';
                }
            });
        });
    }

    $scope.submit = function (validate) {
        $scope.submitted  = true;
        if(validate){
            return;
        }

        departmentsService.createDepartment($scope.department).then(function (data){
            if(data.status) {
                $modalInstance.close(data.department);                
            } else {
                $scope.errors = data.errors;
            }
        });
    };

    $scope.removeUser = function(userId) {
        departmentsService.removeUser($scope.department.id, userId).then(function (data){
            if(data.status) {
                angular.forEach($scope.usersOfDepartment, function(value,key){
                    if(value.id == userId) {
                        //remove list user in dropdown
                        $scope.usersOfDepartment.splice(key,1);
                        //push to list user
                        $scope.usersNotInDepartment.push(value);
                    }
                })
            } else {
                $scope.errors = 'Lỗi! Không thể xóa tài khoản này.';
            }
        });
    }

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

}]);