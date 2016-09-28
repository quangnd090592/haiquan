var assetTypesModule = angular.module('AssetTypes', ['ui.bootstrap', 'ngResource', 'ngTable']);

assetTypesModule.factory('assetTypesResource',['$resource', function ($resource){
    return $resource('/api/asset-types/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('assetTypesService', ['assetTypesResource', '$q', function (assetTypesResource, $q) {
    var that = this;
    this.createAssetType = function(data) {
    	if(typeof data['id'] != 'undefined') {
            return that.editAssetType(data);
        }
		var defer = $q.defer(); 
        var temp  = new assetTypesResource(data);
        temp.$save({}, function success(data) {
            defer.resolve(data);
            if(data.status) {
                assetTypes.push(data.assetType);
            }
        },
        function error(reponse) {
        	defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

    this.editAssetType = function(data){
        var defer = $q.defer(); 
        var temp  = new assetTypesResource(data);
        temp.$update({id: data['id']}, function success(data) {
            if(data.status != 0){
                for (var key in assetTypes) {
                    if (assetTypes[key].id == data.assetType.id){
                        assetTypes[key] = data.assetType;
                        break;
                    }
                }
            }
            defer.resolve(data);
        },
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        return defer.promise;  
    };

    this.removeAssetType = function(id) {
        var defer = $q.defer(); 
        var temp  = new assetTypesResource();
        temp.$delete({id: id}, function success(data) {
            for (var key in assetTypes) {
                if (assetTypes[key].id == id){
                    assetTypes.splice(key, 1);
                    break;
                }
            }
            defer.resolve(data);
        },
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        return defer.promise;
    }

    this.setAssetTypes = function(data) {
        assetTypes = data;
        return assetTypes;
    }
    
    this.getAssetTypes = function() {
        return assetTypes;
    }

}]);
