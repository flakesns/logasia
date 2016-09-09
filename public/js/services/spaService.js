angular.module('spaService', [])

.factory('Spa', function($http) {

    return {
    	
    	getVehicleLists : function() {
    		return $http.get('/api/getVehicleLists');
    	},
    	
    	
        // get all the data
        get : function() {
            return $http.get('/api/spa');
        },
        
        // save input data
        save : function(inputData) {
            return $http({
                method: 'POST',
                url: '/api/saveData',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(inputData)
            });
        },
        
        // save mass input data
        saveMass : function(inputDataMass) {
            return $http({
                method: 'POST',
                url: '/api/saveDataMass',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(inputDataMass)
            });
        },
        
        nextDate : function($lastDate) {
            return $http.get('/api/nextDate/' + $lastDate);
        	/*return $http({
                method: 'GET',
                url: '/api/nextDate',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param($lastDate)
            });*/
        },

        

        // destroy a comment
        destroy : function(id) {
            return $http.delete('/api/comments/' + id);
        }
    }

});
