(function(){
	'use strict';

	angular
	.module('timeTracker')
	.factory('user', user);

	function user($resource){
		 // ngResource call to our static data
		var User = $resource('api/v1/user/:id', {}, {
			update: {
				method: 'PUT'
			}
		});//end User

		function updateUser(data){
			return User.update({id:data.id}, data).$promise.then(function(success){
				console.log(success);
			}, function(error){
				console.log(error);
			});
		}//end updateUser

		function getUsers(){
			return User.query().$promise.then(function(results){
				return results;
			}, function(error){
				console.log(error);

			});
		}//end getUsers

		return {

			getUsers: getUsers,
			updateUser: updateUser
		}
	}//end user

})();