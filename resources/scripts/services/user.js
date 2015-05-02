(function(){
	'use strict';

	angular
	.module('timeTracker')
	.factory('user', user);

	function user($resource){

		var User = $resource('api/v1/user');

		function getUsers(){
			return User.query().$promise.then(function(results){
				return results;
			}, function(error){
				console.log(error);

			});
		}//end getUsers

		return {

			getUsers: getUsers
		}
	}//end user

})();