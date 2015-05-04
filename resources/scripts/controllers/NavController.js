(function(){
	'use strict';

	angular
		.module('timeTracker')
		.controller('NavController', ['$scope', '$location', function($scope, $location){

			$scope.isActive = function(destination){
				
				return destination === $location.path();
			}

		}]);

})();