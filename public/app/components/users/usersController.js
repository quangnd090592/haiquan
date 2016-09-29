usersModule.controller('usersController', ['$scope', '$modal', '$filter', 'ngTableParams', 'usersService', function ($scope, $modal, $filter, ngTableParams, usersService) {
	$('.wrap-content').removeClass('hidden');
	$scope.users = usersService.setUsers(angular.copy(window.users));
    
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
        total: $scope.users.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.users, params.filter()) : $scope.users;
        	orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
            $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        }
    });

    /**
     * create and update users
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    $scope.addUser = function(id) {
        var teamplate = '/users/create?v='+ new Date().getTime();
        if(typeof id != 'undefined'){
            teamplate = '/users/'+ id + '/edit' + '?' + new Date().getTime();
        }
        var modalInstance = $modal.open({
            animation: true,
            templateUrl: teamplate,
            controller: 'ModalUserCtrl',
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

    $scope.removeUser = function(id) {
        if(!confirm('Bạn có muốn xóa tài khoản này?')) {
            return;
        } else {
            usersService.removeUser(id).then(function (data) {
                if(data.status){
                    $scope.tableParams.reload();
                }
            });
        }
        
    };

}]);

usersModule.controller('ModalUserCtrl', ['$scope', '$modal', '$filter', '$modalInstance', 'ngTableParams', 'usersService', function ($scope, $modal, $filter, $modalInstance, ngTableParams, usersService) {
    
    $scope.submit = function (validate) {
        $scope.submitted  = true;
        if(validate){
            return;
        }

        usersService.createUser($scope.user).then(function (data){
            if(data.status) {
                $modalInstance.close(data.user);                
            } else {
                $scope.errors = data.errors;
            }
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

}]);