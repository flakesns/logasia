@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Bulk Operations</div>

                <div class="panel-body">
                    
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                    
                        <div class="row">
                              <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label for="task-name" class="col-sm-10 control-label">Select vehicle:</label>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <select name="vehicle_id" class="form-control">
                                            
                                            </select>    
                                        
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
                                                <div class="col-sm-8">
                                                    <input type="text" name="from_date" id="from_date" class="form-control" value="">
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <label for="task-name" class="col-sm-3 control-label">To:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="from_date" id="from_date" class="form-control" value="">
                                                </div>
                                            </div>
                                                                                        
                                        </div>
                                                                                
                                        <div class="col-sm-8">
                                            <label for="task-name" class="col-sm-2 control-label">Refine days:</label>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="chk_day[]" value="all"> All Days<br>
                                                    <input type="checkbox" name="chk_day[]" value="weekdays"> Weekdays<br>
                                                    <input type="checkbox" name="chk_day[]" value="weekends"> Weekends
                                                </div>
                                            
                                                <div class="col-sm-3">
                                                    <input type="checkbox" name="chk_day[]" value="monday"> Mondays<br>
                                                    <input type="checkbox" name="chk_day[]" value="tuesday"> Tuesdays<br>
                                                    <input type="checkbox" name="chk_day[]" value="wednesday"> Wednesdays
                                                </div>
                                                
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="chk_day[]" value="thurday"> Thursdays<br>
                                                    <input type="checkbox" name="chk_day[]" value="friday"> Fridays<br>
                                                    <input type="checkbox" name="chk_day[]" value="saturday"> Saturdays
                                                </div>
                                                
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="chk_day[]" value="sunday"> Sundays
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
                                            <input type="text" name="change_price_to" id="change_price_to" class="form-control" value="">
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
                                            <input type="text" name="change_avail_to" id="change_avail_to" class="form-control" value="">
                                        </div>
                                    </div>
                              </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-12">
                                <div class="form-group">
                                
                                    <button type="button" class="btn btn-default">
                                        Cancel
                                    </button>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    
                                </div>
                            </div>
                        
                        </div>
                    
                    </form>
                    
                    
                    <calendar selected="day"></calendar>
                    {{--
                    <div class="header">
                        <i class="fa fa-angle-left" ng-click="previous()"></i>
                        <span>{{month.format("MMMM, YYYY")}}</span>
                        <i class="fa fa-angle-right" ng-click="next()"></i>
                    </div>
                    <div class="week names">
                        <span class="day">Sun</span>
                        <span class="day">Mon</span>
                        <span class="day">Tue</span>
                        <span class="day">Wed</span>
                        <span class="day">Thu</span>
                        <span class="day">Fri</span>
                        <span class="day">Sat</span>
                    </div>
                    <div class="week" ng-repeat="week in weeks">
                        <span class="day" ng-class="{ today: day.isToday, 'different-month': !day.isCurrentMonth, selected: day.date.isSame(selected) }" ng-click="select(day)" ng-repeat="day in week.days">{{day.number}}</span>
                    </div>
                    --}}
                    
                    
                </div><!-- //.panel-body -->
            </div>
        </div>
    </div>
</div>
@endsection
