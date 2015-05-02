<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LarangTracking</title>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- build:css styles/main.css -->    
    <link rel="stylesheet" href="css/libs.css">
    <link rel="stylesheet" href="css/app.css">
   
  </head>
  <body ng-app="timeTracker" ng-controller="TimeEntry as vm">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">LarangTracking</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Schedule</a></li>
            <li><a href="#">Employees</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!--[if lt IE 10]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div class="container starter-template">
      <div class="panel panel-default">
        <div class="panel-body">
            <!-- Time picker area -->
           <div class="col-lg-6 time-entry">
              <div class="timepicker">
                <span class="timepicker-title label label-primary">Clock In</span>
                <timepicker ng-model="vm.clockIn" hour-step="1" minute-step="1" show-meridian="true">
                </timepicker>
              </div>
              <div class="timepicker">
              <span class="timepicker-title label label-primary">Clock Out</span>
              <timepicker ng-model="vm.clockOut" hour-step="1" minute-step="1" show-meridian="true">
              </timepicker>
              </div>           
          </div>
           <!-- end Time picker area -->
         
          <!-- Top form area -->
          <div class="col-lg-6">
            <div class="time-entry-comment">
              <form>
                <div class="form-group">
                  <select name="user" class="form-control" ng-model="vm.timeEntryUser" ng-options="user.first_name + ' ' + user.last_name for user in vm.users">
                      <option value="">-- Select a user --</option>
                  </select>
                </div>
                 <div class="form-group">
                <textarea class="form-control" ng-model="vm.comment" rows="4" placeholder="Enter comment"></textarea>
                </div>
                <button class="btn btn-default" ng-click="vm.logNewTime()">Log Time</button>
              </form> 
            </div>            
          </div>
          <!-- end Top form area -->
          
        </div>
      </div>      

      <div class="row">
        <div class="col-lg-8">
          <!-- Time entry section -->
          <div class="panel panel-default" ng-repeat="time in vm.timeEntries">
            <div class="panel-body">
      
              <div class="col-lg-8">
                <h4><i class="glyphicon glyphicon-user"></i>{{ time.user.first_name}} {{ time.user.last_name }}</h4>
                  <p><i class="glyphicon glyphicon-pencil"></i>{{ time.comment }}</p>
              </div>
             
              <div class="row">
                <div class="col-lg-4">
                  <h4><i class="glyphicon glyphicon-calendar"></i> 
                      {{time.end_time | date:'mediumDate'}}</h4>
                      <h2>
                          <span class="label label-primary" 
                                ng-show="time.loggedTime.duration._data.hours > 0">
                                {{time.loggedTime.duration._data.hours}} hour<span ng-show="time.loggedTime.duration._data.hours > 1">s</span>
                          </span>
                      </h2>
                  <h4><span class="label label-default">{{time.loggedTime.duration._data.minutes}} minutes</span></h4>
                </div>
              </div>
                  <div class="row">
                      <div class="col-sm-3">
                          <button class="btn btn-primary btn-xs" ng-click="showEditDialog = true">Edit</button>
                          <button class="btn btn-danger btn-xs" ng-click="vm.deleteTimeEntry(time)">Delete</button>
                      </div>
                  </div>

                  <!-- Editing section -->
                  <div class="row edit-time-entry" ng-show="showEditDialog === true">
                    <h4>Edit Time Entry</h4>
                    <div class="time-entry">
                        <div class="timepicker">
                            <span class="timepicker-title label label-primary">Clock In</span>
                            <timepicker ng-model="time.start_time" hour-step="1" minute-step="1" show-meridian="true"></timepicker> 
                        </div>
                        <div class="timepicker">
                            <span class="timepicker-title label label-primary">Clock Out</span>
                            <timepicker ng-model="time.end_time" hour-step="1" minute-step="1" show-meridian="true"></timepicker>
                        </div>
                   </div>
                   <div class="col-sm-6">
                        <h5>User</h5>
                        <select name="user" class="form-control" ng-model="time.user" ng-options="user.first_name + ' ' + user.last_name for user in vm.users track by user.id">
                            <option value="user.id"></option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <h5>Comment</h5>
                        <textarea rows="3" ng-model="time.comment" class="form-control">{{time.comment}}</textarea>
                    </div>
                    <div class="edit-controls">
                        <button class="btn btn-primary btn-sm" ng-click="vm.updateTimeEntry(time)">Save</button>
                        <button class="btn btn-danger btn-sm" ng-click="showEditDialog = false">Close</button>
                    </div>                            
                </div>
                <!-- End editing section -->
            </div>
          </div>
          <!-- Time entry section -->
        </div>


        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-body">
              
                <h1><i class="glyphicon glyphicon-time"></i> Total Time</h1>
                <h1><span class="label label-primary">{{vm.totalTime.hours}} hours</span></h1>
                <h3><span class="label label-default">{{vm.totalTime.minutes}} minutes</span></h3>
            
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="container">
        <p>Larang Time Tracker</p>
      </div>
        
      </div>
  
    </body>
        <script src="js/libs.js"></script>
        <script src='js/app.js'></script>
</html>
