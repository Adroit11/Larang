(function(){

	'use strict';

	angular
	    .module('timeTracker')
		.config(['$routeProvider', router]);

		function router($routeProvider){
			$routeProvider
				.when('/', {
					templateUrl: 'partials/time-entries.html',
	        		controller: 'TimeEntry',
	        		controllerAs: 'vm',
	        		title: 'Time entries'
				})
				.when('/users', {
					templateUrl: 'partials/users.html',
	        		controller: 'User',
	        		controllerAs: 'usr',
	        		title: 'Users'
	     		})
				.otherwise({
					redirectTo: '/'
				});
		}//end router

})();