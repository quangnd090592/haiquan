var rolesModule = angular.module('Roles', ['ui.bootstrap', 'ngResource', 'ngTable']);

rolesModule.factory('rolesResource',['$resource', function ($resource){
    return $resource('/api/roles/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('rolesService', ['rolesResource', '$q', function (rolesResource, $q) {
    var that = this;
    this.createRole = function(data) {
    	if(typeof data['id'] != 'undefined') {
            return that.editRole(data);
        }
		var defer = $q.defer(); 
        var temp  = new rolesResource(data);
        temp.$save({}, function success(data) {
            defer.resolve(data);
            if(data.status) {
                roles.push(data.role);
            }
        },
        function error(reponse) {
        	defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

    this.editRole = function(data){
        var defer = $q.defer(); 
        var temp  = new rolesResource(data);
        temp.$update({id: data['id']}, function success(data) {
            if(data.status != 0){
                for (var key in roles) {
                    if (roles[key].id == data.role.id){
                        roles[key] = data.role;
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

    this.removeRole = function(id) {
        var defer = $q.defer(); 
        var temp  = new rolesResource();
        temp.$delete({id: id}, function success(data) {
            for (var key in roles) {
                if (roles[key].id == id){
                    roles.splice(key, 1);
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

    this.setRoles = function(data) {
        roles = data;
        return roles;
    }
    
    this.getRoles = function() {
        return roles;
    }

}]);
