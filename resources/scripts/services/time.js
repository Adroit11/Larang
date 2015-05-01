/* scripts/services/time.js */
    
(function() {
    
    'use strict';

    angular
        .module('timeTracker')
        .factory('time', time);

        function time($resource) {

            // ngResource call to our static data
            var Time = $resource('api/v1/time/:id', {}, {
                update: {
                    method: 'PUT'
                }
            });

            function getTime() {
                // $promise.then allows us to intercept the results
                // which we will use later
                return Time.query().$promise.then(function(results) {

                    angular.forEach(results, function(result){
                        // Add the loggedTime property which calls 
                        // getTimeDiff to give us a duration object
                        result.loggedTime = getTimeDiff(result.start_time, result.end_time);

                    });

                    return results;

                }, function(error) { // Check for errors
                    console.log(error);
                });
            }
            // Use Moment.js to get the duration of the time entry
            function getTimeDiff(start, end){
                var diff = moment(end).diff(moment(start));
                var duration = moment.duration(diff);
                return {
                    duration: duration
                }

            }
            // Add up the total time for all of our time entries
            function getTotalTime(timeEntries){
                var totalMilliseconds = 0;

                angular.forEach(timeEntries, function(key){
                    totalMilliseconds += key.loggedTime.duration._milliseconds;
                });

                return {
                    hours: Math.floor(moment.duration(totalMilliseconds).asHours()),
                    minutes: moment.duration(totalMilliseconds).minutes()
                }
            }


            return {
                getTime: getTime,
                getTimeDiff: getTimeDiff,
                getTotalTime: getTotalTime
            }
        }
            
})();