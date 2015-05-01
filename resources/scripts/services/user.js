(function(){
	'user strict';

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
		}

		return {

			getUsers: getUsers
		}
	}

})();