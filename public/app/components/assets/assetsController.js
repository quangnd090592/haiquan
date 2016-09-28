assetsModule.controller('assetsController', ['$scope', '$modal', '$filter', 'ngTableParams', 'assetsService', function ($scope, $modal, $filter, ngTableParams, assetsService) {
	console.log('assetscontroller js');
	$scope.assets = window.assets;
	console.log($scope.assets,'$scope.assets');
    
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
        total: $scope.assets.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.assets, params.filter()) : $scope.assets;
        	orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
            $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        }
    })

}]);