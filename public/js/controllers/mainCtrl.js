
angular.module('mainCtrl', ['ngMaterial', 'ui.bootstrap', 'customDirectives'])

// inject the Comment service into our controller
.controller('mainController', function($scope, $http, $mdDialog, $sce, Spa) {
	
	$scope.inputData = {};
	$scope.inputMass = {};
	$scope.loading = false;
	$scope.loadingmain = false;
		
	// Load initial data =======================
	Spa.get()
	    .success(function(data) {
	        $scope.datas = data;
	        $scope.loading = false;
    });
	
	// Assign value to popover form after click link =====================
	$scope.godata = function(vehicle_id, mydate, type, obj) {
		$scope.inputData.type = type;
		$scope.inputData.vehicle_id = vehicle_id;
		$scope.inputData.date_avail = mydate;
		
		$scope.inputData.numb_avail = obj.avail;
        $scope.inputData.price = obj.price;
	};
	
	// Save popover form data =======================
	$scope.submitData = function() {
		$scope.loading = true;

		Spa.save($scope.inputData)
	        .success(function(data) {
	        	Spa.nextDate($scope.datas.current_date)
		            .success(function(data) {
		            	$scope.datas = data;
		        });
	        	$scope.loading = false;	
	        })
	        .error(function(data) {
	            console.log(data);
	        });
	};
	
	// Save form mass data ======================
	$scope.submitDataMass = function() {
		$scope.loadingmain = true;

		Spa.saveMass($scope.inputMass)
	        .success(function(data) {
	            Spa.get()
	                .success(function(getData) {
	                    $scope.datas = getData;
	                    $scope.loadingmain = false;
	                });
	
	        })
	        .error(function(data) {
	            console.log(data);
	        });
	};
	
	// Generate next date
	$scope.nextDate = function(id) {
		$scope.loadingmain = true;
        Spa.nextDate($scope.datas.last_date)
            .success(function(data) {
            	$scope.datas = data;
            	$scope.loadingmain = false;
	        });
    };  
    
    $scope.reset = function() {
        $scope.inputMass = '';
    };    
    
    // Calendar ================================
    $scope.open1 = function() {
        $scope.popup1.opened = true;
	  };
	
	  $scope.open2 = function() {
	    $scope.popup2.opened = true;
	  };
	  
	  $scope.popup1 = {
	    opened: false
	  };
	
	  $scope.popup2 = {
	    opened: false
	  };
			  
	  $scope.dateOptions = {
	    maxDate: new Date(2020, 5, 22),
	    minDate: new Date(),
	    startingDay: 1
	  };

	  
	  $scope.filterValue = function($event){
	        if(isNaN(String.fromCharCode($event.keyCode))){
	            $event.preventDefault();
	        }
	};
});


customDirectives = angular.module('customDirectives', []);
customDirectives.directive('popoverAvail', ['$compile', function ($compile) {
    return {
        restrict: 'A',
        link: function (scope, el, attrs) {
            
            var type = attrs.popoverLabel;
                    
            if (type == 'numb_avail') {
            	scope.inputData.numb_avail = attrs.popoverHtml;
            	var input = '<input type="text" class="form-control" ng-model="inputData.numb_avail" only-digits>';
            } else if (type == 'price') {
            	scope.inputData.price = attrs.popoverHtml;
            	var input = '<input type="text" class="form-control" ng-model="inputData.price" only-digits>';
            }

            data = '<p ng-show="loading"><i class="fa fa-spinner fa-spin"></i> Saving data...</p><form ng-submit="submitData()" ng-hide="loading">' + 
            		'<input type="hidden" ng-model="inputData.type">' +
            		'<input type="hidden" ng-model="inputData.vehicle_id">' +
            		'<input type="hidden" ng-model="inputData.date_avail">' +
            		'<div class="input-group">' + 
            		input + 
				    '<span class="input-group-btn">' + 
				  		'<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok"></i></button>' + 
				    '</span>' + 
				  '</div></form>';
            
            $(el).popover({
                trigger: 'click',
                html: true,                		  
                content: $compile(data)(scope),
                placement: 'top',                
            });
        },
    };
}]);
