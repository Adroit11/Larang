(function(){
	'use strict';

	angular
		.module('timeTracker')
		.factory('_', returnUnderscore);

		function returnUnderscore(){
			return window._;
		}//end returnUnderscore

})();