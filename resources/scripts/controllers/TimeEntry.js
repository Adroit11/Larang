/* scripts/controllers/TimeEntry.js */

(function(){
	'use strict';

	angular
		.module('timeTracker')
		.controller('TimeEntry', TimeEntry);

		function TimeEntry(time)
		{
			var vm = this;

			vm.timeEntries = [];

			vm.totalTime = {};

			// Initialize the clockIn and clockOut times to the current time.
            vm.clockIn = new Date();
            vm.clockOut = new Date();


			// Fetches the time entries from the static JSON file
            // and puts the results on the vm.timeEntries array
			time.getTime().then(function(results)
			{
				vm.timeEntries = results;
				updateTotalTime(vm.timeEntries);

			}, function(error){
				console.log(error);
			});

			 // Updates the values in the total time box by calling the
            // getTotalTime method on the time service
			function updateTotalTime(timeEntries){
				vm.totalTime = time.getTotalTime(timeEntries);
			}

			// Submits the time entry that will be called 
            // when we click the "Log Time" button
            vm.logNewTime = function() {

                // Make sure that the clock-in time isn't after
                // the clock-out time!
                if(vm.clockOut < vm.clockIn) {
                    alert("You can't clock out before you clock in!");
                    return;                 
                }

                // Make sure the time entry is greater than zero
                if(vm.clockOut - vm.clockIn === 0) {
                    alert("Your time entry has to be greater than zero!");
                    return;
                }

                vm.timeEntries.push({
                    "user_id":1,
                    "user_firstname":"Ryan",
                    "user_lastname":"Chenkie",
                    "start_time":vm.clockIn,
                    "end_time":vm.clockOut,
                    "loggedTime": time.getTimeDiff(vm.clockIn, vm.clockOut),
                    "comment":vm.comment
                });

                updateTotalTime(vm.timeEntries);

                vm.comment = "";
            }
		}

})();