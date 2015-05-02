/* scripts/controllers/TimeEntry.js */

(function(){
    
	'use strict';

	angular
		.module('timeTracker')
		.controller('TimeEntry', TimeEntry);

		function TimeEntry(time, user, $scope)
		{
			var vm = this;

			vm.timeEntries = [];

			vm.totalTime = {};

            vm.users = [];
			// Initialize the clockIn and clockOut times to the current time.
            vm.clockIn = moment();

            vm.clockOut = moment();
            //Get all the entries stored in the database
            getTimeEntries();
            //Get all users fro the database so we can  select
            //who the time entry belongs to
            getUsers();


            function getUsers(){
                user.getUsers().then(function(result){
                    vm.users = result;
                }, function(error){
                        console.log(error);
                });
            }//end getUsers


            function getTimeEntries(){                
                // Fetches the time entries from the static JSON file
                // and puts the results on the vm.timeEntries array
                time.getTime().then(function(results)
                {
                    vm.timeEntries = results;

                    updateTotalTime(vm.timeEntries);

                }, function(error){
                    console.log(error);
                });   
            }//end getTimeEntries


            vm.updateTimeEntry = function(timeEntry){
                var updatedTimeEntry = {
                    "id":timeEntry.id,
                    "user_id":timeEntry.user.id,
                    "start_time":timeEntry.start_time,
                    "end_time":timeEntry.end_time,
                    "comment":timeEntry.comment
                }

                time.updateTime(updatedTimeEntry).then(function(success){
                    getTimeEntries();
                    $scope.showEditDialog = false;
                    console.log(sucess);
                }, function(error){
                    console.log(error);
                });//end time.updateTime

            }//end updateTimeEntry      


            vm.deleteTimeEntry = function(timeEntry){
                var id = timeEntry.id;
                time.deleteTime(id).then(function(success){
                getTimeEntries();
                }, function(error){
                    console.log(error);
                });
            }//end deleteTimeEntry


			 // Updates the values in the total time box by calling the
            // getTotalTime method on the time service
			function updateTotalTime(timeEntries){
				vm.totalTime = time.getTotalTime(timeEntries);
			}//end updateTotalTime


			// Submits the time entry that will be called 
            // when we click the "Log Time" button
            vm.logNewTime = function(){
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

                time.saveTime({
                    "user_id": vm.timeEntryUser.id,
                    "start_time": vm.clockIn,
                    "end_time": vm.clockOut,
                    "comment": vm.comment
                }).then(function(success){
                    getTimeEntries();
                    console.log(success);
                }, function(error){
                    console.log(error);
                });//endsaveTime

                getTimeEntries();

                //reset clock and out in time picker
                vm.clockIn = moment();
                vm.clockOut=moment();

                // Deselect the user
                vm.timeEntryUser = "";

                //Clear out the comment field
                vm.comment = "";
            }//end vm.logNewTime

		}//End TimeEntry
})();