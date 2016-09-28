var assetsModule = angular.module('Assets', ['ui.bootstrap', 'ngResource', 'ngTable']);

assetsModule.factory('assetsResource',['$resource', function ($resource){
    return $resource('/api/assets/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('assetsService', ['assetsResource', '$q', function (assetsResource, $q) {
    var that = this;
}]);
