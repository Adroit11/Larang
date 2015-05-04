(function(){

	'use strict';

	angular
		.module('timeTracker')
		.controller('EditUserModalInstance', EditUserModalInstance);

		function EditUserModalInstance($scope, $modalInstance, item){

			$scope.user = item;

			$scope.user.first_name = item.first_name;

			$scope.user.last_name = item.last_name;

			$scope.user.email = item.email;


			$scope.close = function(user){
				$modalInstance.close(user);
			}

			$scope.cancel = function(){
				$modalInstance.dismiss('cancel');
			}

		}//end EditUserModalInstance

})();