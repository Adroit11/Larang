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
    <nav ng-controller="NavController" class="navbar navbar-inverse navbar-fixed-top">
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
            <li ng-class="{active: isActive('/time')}"><a href="#/time">Activity Tracker</a></li>
            <li ng-class="{active: isActive('/users')}"><a href="#/users">Users</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!--[if lt IE 10]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div ng-view class="container starter-template">


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
