producersModule.controller('producersController', ['$scope', '$modal', '$filter', 'ngTableParams', 'producersService', function ($scope, $modal, $filter, ngTableParams, producersService) {
	$('.wrap-content').removeClass('hidden');
	$scope.producers = producersService.setProducers(angular.copy(window.producers));
    
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
        total: $scope.producers.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.producers, params.filter()) : $scope.producers;
        	orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
            $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        }
    });

    /**
     * create and update producers
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    $scope.addProducer = function(id) {
        var teamplate = '/producers/create';
        if(typeof id != 'undefined'){
            teamplate = '/producers/'+ id + '/edit' + '?' + new Date().getTime();
        }
        var modalInstance = $modal.open({
            animation: true,
            templateUrl: teamplate,
            controller: 'ModalProducerCtrl',
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

    $scope.removeProducer = function(id) {
        if(!confirm('Bạn có muốn xóa xuất xứ này?')) {
            return;
        } else {
            producersService.removeProducer(id).then(function (data) {
                if(data.status){
                    $scope.tableParams.reload();
                }
            });
        }
        
    };

}]);

producersModule.controller('ModalProducerCtrl', ['$scope', '$modal', '$filter', '$modalInstance', 'ngTableParams', 'producersService', function ($scope, $modal, $filter, $modalInstance, ngTableParams, producersService) {
    $scope.submit = function (validate) {
        $scope.submitted  = true;
        if(validate){
            return;
        }

        producersService.createProducer($scope.producer).then(function (data){
            if(data.status) {
                $modalInstance.close(data.producer);                
            } else {
                $scope.errors = data.errors;
            }
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

}]);