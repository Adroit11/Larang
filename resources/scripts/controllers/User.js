(function(){

	'use strict';

	angular
		.module('timeTracker')
		.controller('User', User);

		function User(user, $scope, $modal, _){

			var usr = this;

			usr.users = [];

			getUsers();

			// var selectedUser = _.where(usr.users, {id: 2});

			function getUsers(){
				user.getUsers().then(function(result){
					usr.users = result;
				}, function(error){
					console.log(error);
				})
			}//end getUsers

			usr.openEditUserModal = function(size, userToUpdate){				

				var editUserModalInstance = $modal.open({
					animation: true,
					templateUrl: 'partials/edit-user-modal.html',
					controller: 'EditUserModalInstance',
					size: size,
					resolve: {
						item: function(){
							return userToUpdate;
						}
					}
				});

				editUserModalInstance.result.then(function(updatedUser){
					updateUser(updatedUser);					
				}, function(){
					console.log('Modal dismissed at: ' + new Date());
				});		

			}//end openEdituserModal

			function updateUser(userToUpdate){
				var updatedUser = {
					"id":userToUpdate.id,
					"firstname":userToUpdate.firstname,
					"lastname":userToUpdate.lastname,
					"email":userToUpdate.email
				}

				user.updateUser(updatedUser).then(function(success){
					getUsers();
					console.log(success);
					}, function(error){
					console.log(error);
				});//end user.updateUser

			}//end updateUser						

		}//end User
})();