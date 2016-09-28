var departmentsModule = angular.module('Departments', ['ui.bootstrap', 'ngResource', 'ngTable']);

departmentsModule.factory('departmentsResource',['$resource', function ($resource){
    return $resource('/api/departments/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('departmentsService', ['departmentsResource', '$q', function (departmentsResource, $q) {
    var that = this;
    this.createDepartment = function(data) {
    	if(typeof data['id'] != 'undefined') {
            return that.editDepartment(data);
        }
		var defer = $q.defer(); 
        var temp  = new departmentsResource(data);
        temp.$save({}, function success(data) {
            defer.resolve(data);
            if(data.status) {
                departments.push(data.department);
            }
        },
        function error(reponse) {
        	defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

    this.editDepartment = function(data){
        var defer = $q.defer(); 
        var temp  = new departmentsResource(data);
        temp.$update({id: data['id']}, function success(data) {
            if(data.status != 0){
                for (var key in departments) {
                    if (departments[key].id == data.department.id){
                        departments[key] = data.department;
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

    this.removeDepartment = function(id) {
        var defer = $q.defer(); 
        var temp  = new departmentsResource();
        temp.$delete({id: id}, function success(data) {
            for (var key in departments) {
                if (departments[key].id == id){
                    departments.splice(key, 1);
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

    this.setDepartments = function(data) {
        departments = data;
        return departments;
    }
    
    this.getDepartments = function() {
        return departments;
    }

}]);
