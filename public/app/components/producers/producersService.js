var producersModule = angular.module('Producers', ['ui.bootstrap', 'ngResource', 'ngTable']);

producersModule.factory('producersResource',['$resource', function ($resource){
    return $resource('/api/producers/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('producersService', ['producersResource', '$q', function (producersResource, $q) {
    var that = this;
    this.createProducer = function(data) {
    	if(typeof data['id'] != 'undefined') {
            return that.editProducer(data);
        }
		var defer = $q.defer(); 
        var temp  = new producersResource(data);
        temp.$save({}, function success(data) {
            defer.resolve(data);
            if(data.status) {
                producers.push(data.producer);
            }
        },
        function error(reponse) {
        	defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

    this.editProducer = function(data){
        var defer = $q.defer(); 
        var temp  = new producersResource(data);
        temp.$update({id: data['id']}, function success(data) {
            if(data.status != 0){
                for (var key in producers) {
                    if (producers[key].id == data.producer.id){
                        producers[key] = data.producer;
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

    this.removeProducer = function(id) {
        var defer = $q.defer(); 
        var temp  = new producersResource();
        temp.$delete({id: id}, function success(data) {
            for (var key in producers) {
                if (producers[key].id == id){
                    producers.splice(key, 1);
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

    this.setProducers = function(data) {
        producers = data;
        return producers;
    }
    
    this.getProducers = function() {
        return producers;
    }

}]);
