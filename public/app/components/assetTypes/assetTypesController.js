assetTypesModule.controller('assetTypesController', ['$scope', '$modal', '$filter', 'ngTableParams', 'assetTypesService', function ($scope, $modal, $filter, ngTableParams, assetTypesService) {
	$('.wrap-content').removeClass('hidden');
	$scope.assetTypes = assetTypesService.setAssetTypes(angular.copy(window.assetTypes));
    
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
        total: $scope.assetTypes.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.assetTypes, params.filter()) : $scope.assetTypes;
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
    $scope.addAssetType = function(id) {
        var teamplate = '/asset-types/create';
        if(typeof id != 'undefined'){
            teamplate = '/asset-types/'+ id + '/edit' + '?' + new Date().getTime();
        }
        var modalInstance = $modal.open({
            animation: true,
            templateUrl: teamplate,
            controller: 'ModalAssetTypesCtrl',
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

    $scope.removeAssetType = function(id) {
        if(!confirm('Bạn có muốn xóa loại tài sản này?')) {
            return;
        } else {
            assetTypesService.removeAssetType(id).then(function (data) {
                if(data.status){
                    $scope.tableParams.reload();
                }
            });
        }
        
    };

}]);

assetTypesModule.controller('ModalAssetTypesCtrl', ['$scope', '$modal', '$filter', '$modalInstance', 'ngTableParams', 'assetTypesService', function ($scope, $modal, $filter, $modalInstance, ngTableParams, assetTypesService) {
    $scope.submit = function (validate) {
        $scope.submitted  = true;
        if(validate){
            return;
        }

        assetTypesService.createAssetType($scope.assetType).then(function (data){
            if(data.status) {
                $modalInstance.close(data.assetType);                
            } else {
                $scope.errors = data.errors;
            }
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

}]);