<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Logasia: Hafiz</title>

     <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
    
    <style>
        body        { padding-top:30px; }
        form        { padding-bottom:20px; }
        .comment    { padding-bottom:20px; }
        .Sat { color: red; }
        .Sun { color: red; }
    </style>

   <style type="text/css">
   .table {
       margin-bottom: 0;
       border: 0;
   }
   .table th, .table td {
       text-align: center;
   }
   
   .table-mod > tbody > tr > td.tblLeftMenu {
        border:0;
        text-align: left;
        padding: 2px;
   }
   
   .vehicle {
        font-weight: bold;
   }
   .truckSemi {
       background-color:  #ffdb4d;
   }
   .truckFoot {
       background-color:   #b3d9ff;
   }
   .truckPup {
       background-color: #99ff66;
   }
   
  a {
      border-bottom: dotted 1px;
  }
   
   </style>

</head>
<body class="container" ng-app="spaApp" ng-controller="mainController" ng-cloak>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Bulk Operations</div>
                
                <div class="panel-body">

                    <form ng-submit="submitDataMass()" class="form-horizontal">

                         <div ng-view></div>

                        <div class="row">
                              <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label for="task-name" class="col-sm-10 control-label">Select vehicle:</label>
                                        </div>

                                        <div class="col-sm-3">
                                            <select ng-model="inputMass.vehicle_id" ng-options="key as value for (key, value) in datas.vehicle_lists track by key" ng-required="true"><option></option></select>
                                        </div>
                                    </div>
                              </div>
                        </div>

                        <div class="row">
                              <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label for="task-name" class="col-sm-10 control-label">Select days:</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="row">
                                                <label for="task-name" class="col-sm-3 control-label">From:</label>
                                                <div class="col-sm-12">
                                                    <p class="input-group">
                                                      <input type="text" class="form-control" uib-datepicker-popup="dd-MM-yyyy" ng-model="inputMass.from_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" />
                                                      <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
                                                      </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label for="task-name" class="col-sm-3 control-label">To:</label>
                                                <div class="col-sm-12">
                                                    <p class="input-group">
                                                      <input type="text" class="form-control" uib-datepicker-popup="dd-MM-yyyy" ng-model="inputMass.to_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" />
                                                      <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="open2()"><i class="glyphicon glyphicon-calendar"></i></button>
                                                      </span>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-8">
                                            <label for="task-name" class="col-sm-2 control-label">Refine days:</label>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input type="checkbox" ng-model="inputMass.chk_day['all']" ng-true-value="'all'" > All Days<br>
                                                    <input type="checkbox" ng-model="inputMass.chk_day['weekdays']" ng-true-value="'weekdays'"> Weekdays<br>
                                                    <input type="checkbox" ng-model="inputMass.chk_day['weekends']" ng-true-value="'weekends'"> Weekends
                                                </div>

                                                <div class="col-sm-3">
                                                    <input type="checkbox" ng-model="inputMass.chk_day['monday']" ng-true-value="'monday'"> Mondays<br>
                                                    <input type="checkbox" ng-model="inputMass.chk_day['tuesday']" ng-true-value="'tuesday'"> Tuesdays<br>
                                                    <input type="checkbox" ng-model="inputMass.chk_day['wednesday']" ng-true-value="'wednesday'"> Wednesdays
                                                </div>

                                                <div class="col-sm-2">
                                                    <input type="checkbox" ng-model="inputMass.chk_day['thurday']" ng-true-value="'thurday'"> Thursdays<br>
                                                    <input type="checkbox" ng-model="inputMass.chk_day['friday']" ng-true-value="'friday'"> Fridays<br>
                                                    <input type="checkbox" ng-model="inputMass.chk_day['saturday']" ng-true-value="'saturday'"> Saturdays
                                                </div>

                                                <div class="col-sm-2">
                                                    <input type="checkbox" ng-model="inputMass.chk_day['sunday']" ng-true-value="'sunday'"> Sundays
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                              </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label for="change_price_to" class="col-sm-10 control-label">Change Price To:</label>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="text" name="change_price_to" id="change_price_to" class="form-control" ng-model="inputMass.price" ng-required="true" only-digits>
                                        </div>
                                    </div>
                              </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label for="change_avail_to" class="col-sm-10 control-label">Change Availability To:</label>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="text" name="change_avail_to" id="change_avail_to" class="form-control" ng-model="inputMass.numb_avail" ng-required="true" only-digits>
                                        </div>
                                    </div>
                              </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-12">
                                <div class="form-group">

                                    <button type="button" class="btn btn-default" ng-click="reset()">
                                        Cancel
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>

                                </div>
                            </div>

                        </div>

                    </form>

                </div><!-- //.panel-body -->
            </div> <!-- //.panel panel-default -->
        </div><!-- //.col-md-12 -->
    </div><!-- //.row -->
    
    <div class="row">
         <div class="col-sm-12">
             <p class="text-center" ng-show="loadingmain"><i class="fa fa-spinner fa-spin"></i> Please wait..processing request...</p>
             </p>
         </div>
     </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="spa row">
     
                                <p class="text-center">
                                    <strong>{{ datas.current_month }}</strong>&nbsp;
                                    <a href="javascript:;" ng-click="nextDate()"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                </p>
                            
                     </div>
   
                     <div class="row">
                        <div class="col-sm-12">
                             <div class="table-responsive">
       
                                <table class="table table-bordered table-mod">
                                    <tbody>
                                        <tr>
                                            <td rowspan="1" class="tblLeftMenu">Price and availability</td>
                                            <th ng-repeat="d in datas.dates" ng-class="d.day">{{ d.day }}</th>
                                        </tr>
                                        <tr>
                                            <td class="tblLeftMenu"></td>
                                            <th ng-repeat="d in datas.dates">{{ d.date }}</th>
                                        </tr>
                                        <tr>
                                            <td colspan='12' class="tblLeftMenu vehicle truckSemi">
                                                Semi-trailer truck</td>
                                        </tr>
                                       
                                        <tr>
                                            <td class="tblLeftMenu">Vehicles available</td>
                                            <td ng-repeat="(mydate, obj) in datas.available[1]">
                                                <a popover-avail popover-label="numb_avail" popover-html="{{ mydate }}" ng-click="godata(1, mydate, 'numb_avail', obj)">{{ obj.avail }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tblLeftMenu">Price (USD)</td>
                                            <td ng-repeat="(mydate, obj) in datas.available[1]">
                                                
                                                <a popover-avail popover-label="price" popover-html="{{ mydate }}" ng-click="godata(1, mydate, 'price', obj)">{{ obj.price }}</a>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='12' class="tblLeftMenu vehicle truckFoot" style="text-align: left; padding:0;">
                                                20 foot swap-body truck</td>
                                        </tr>
                                        <tr>
                                            <td class="tblLeftMenu">Vehicles available</td>
                                            <td ng-repeat="(mydate, obj) in datas.available[2]">
                                                <a popover-avail popover-label="numb_avail" popover-html="{{ mydate }}" ng-click="godata(2, mydate, 'numb_avail', obj)">{{ obj.avail }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tblLeftMenu">Price (USD)</td>
                                            <td ng-repeat="(mydate, obj) in datas.available[2]">
                                                  <a popover-avail popover-label="price" popover-html="{{ mydate }}" ng-click="godata(2, mydate, 'price', obj)">{{ obj.price }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='12' class="tblLeftMenu vehicle truckPup" style="text-align: left; padding:0;">
                                                28.5 foot pup trailer</td>
                                        </tr>
                                        <tr>
                                            <td class="tblLeftMenu">Vehicles available</td>
                                            <td ng-repeat="(mydate, obj) in datas.available[3]">
                                                <a popover-avail popover-label="numb_avail" popover-html="{{ mydate }}" ng-click="godata(3, mydate, 'numb_avail', obj)">{{ obj.avail }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tblLeftMenu">Price (USD)</td>
                                            <td ng-repeat="(mydate, obj) in datas.available[3]">
                                                <a popover-avail popover-label="price" popover-html="{{ mydate }}" ng-click="godata(3, mydate, 'price', obj)">{{ obj.price }}</a>
                                            </td>
                                        </tr>
                                      </tbody>
                               </table>
                               
                              </div><!-- //.table-responsive -->
                          </div>
                     </div>
                
                </div><!-- //.panel-body -->
            </div> <!-- //.panel panel-default -->
        </div><!-- //.col-md-12 -->
    </div><!-- //.row -->
               
</div><!-- //.container -->

<!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-sanitize.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
   <script src="//ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
   <script src="js/ui-bootstrap-tpls-2.1.3.min.js"></script>

    <script src="js/controllers/mainCtrl.js"></script>
    <script src="js/services/spaService.js"></script>
    <script src="js/app.js"></script>
   
</html>
