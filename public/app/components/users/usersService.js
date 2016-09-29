var usersModule = angular.module('Users', ['ui.bootstrap', 'ngResource', 'ngTable']);

usersModule.factory('usersResource',['$resource', function ($resource){
    return $resource('/api/users/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('usersService', ['usersResource', '$q', function (usersResource, $q) {
    var that = this;
    this.createUser = function(data) {
    	if(typeof data['id'] != 'undefined') {
            return that.editUser(data);
        }
		var defer = $q.defer(); 
        var temp  = new usersResource(data);
        temp.$save({}, function success(data) {
            defer.resolve(data);
            if(data.status) {
                users.push(data.user);
            }
        },
        function error(reponse) {
        	defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

    this.editUser = function(data){
        var defer = $q.defer(); 
        var temp  = new usersResource(data);
        temp.$update({id: data['id']}, function success(data) {
            if(data.status != 0){
                for (var key in users) {
                    if (users[key].id == data.user.id){
                        users[key] = data.user;
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

    this.removeUser = function(id) {
        var defer = $q.defer(); 
        var temp  = new usersResource();
        temp.$delete({id: id}, function success(data) {
            for (var key in users) {
                if (users[key].id == id){
                    users.splice(key, 1);
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

    this.setUsers = function(data) {
        users = data;
        return users;
    }
    
    this.getUsers = function() {
        return users;
    }

}]);
