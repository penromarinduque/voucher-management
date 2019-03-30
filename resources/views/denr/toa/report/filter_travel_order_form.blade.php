@extends('denr.layouts.app')

@section('page-css')

@endsection

@section('page-content')


            <div class="row">

                @include('denr.layouts.blocks.pageloc')

            </div>

            <div class="row">
                
                <div class="col-lg-12">
                    
                    <div class="panel panel-default" style="padding-top: 12px;">
                        
                        <ul class="nav nav-tabs" style="font-size: 11px; text-transform: uppercase;">

                            <li class="active" style="margin-left: 12px;">
                                <a href="{{ route('travel.order.filter.form') }}"><i class="fa fa-file-o fa-fw"></i> TRAVEL ORDER REPORTS</a>
                            </li>
                            <li>
                                <a href="{{ route('employee.filter.form') }}"><i class="fa fa-file-o fa-fw"></i> EMPLOYEE LIST REPORT</a>
                            </li>

                        </ul>

                        <div class="panel-body">

                            {{Form::open(array('action'=>'denr\toa\report\TravelOrderReportController@TravelOrderFilterResult', 'target'=>'_blank'))}}

                            <div class="panel panel-default">
                                <table class="table table-striped table-bordered table-hover tooltip-demo">
                                    <tr>
                                         <td colspan="8" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-search-plus fa-fw"></i> FILTER TRAVEL ORDER<a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                    </tr>

                                    <tr>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Division</td>
                                        <td style="padding: 0px;">
                                            <select name="division" id="division" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Division</option>
                                                @foreach($division as $id => $col)
                                                <option value="{{ $col['id'] }}" @if(old('division') == $col['id']) selected @endif >{{ $col['division'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Section</td>
                                        <td style="padding: 0px;">
                                            <select name="section" id="section" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Section</option>
                                                @foreach($section as $id => $col)
                                                <option value="{{ $col['id'] }}" @if(old('section') == $col['id']) selected @endif >{{ $col['section'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Unit</td>
                                        <td style="padding: 0px;">
                                            <select name="unit" id="unit" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Unit</option>
                                                @foreach($unit as $id => $col)
                                                <option value="{{ $col['id'] }}" @if(old('unit') == $col['id']) selected @endif >{{ $col['unit'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Position</td>
                                        <td style="padding: 0px;">
                                            <select name="position" id="position" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Position</option>
                                                @foreach($position as $id => $col)
                                                <option value="{{ $col['id'] }}" @if(old('position') == $col['id']) selected @endif >{{ $col['position_title'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Employee</td>
                                        <td style="padding: 0px;">
                                            <select name="employee" id="employee" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Employee</option>
                                                @foreach($users as $id => $col)
                                                <option value="{{ $col['id'] }}" @if(old('employee') == $col['id']) selected @endif >{{ $col['fname'] }} {{ $col['mname'] }} {{ $col['lname'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Status</td>
                                        <td style="padding: 0px;">
                                            <select name="status" id="status" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Status</option>
                                                <option value="0" @if(old('status') == '0') selected @endif >Pending</option>
                                                <option value="1" @if(old('status') == '1') selected @endif >Recommended</option>
                                                <option value="2" @if(old('status') == '2') selected @endif >Approved</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Order No. From</td>
                                        <td style="padding: 0px;">
                                            <select name="order_from" id="order_from" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Travel Order</option>
                                                @foreach($travel as $id => $col)
                                                <option value="{{ $col['order_no'] }}" @if(old('order_from') == $col['order_no']) selected @endif >{{ $col['order_no'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Order No. To</td>
                                        <td style="padding: 0px;">
                                            <select name="order_to" id="order_to" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select All Travel Order</option>
                                                @foreach($travel as $id => $col)
                                                <option value="{{ $col['order_no'] }}" @if(old('order_to') == $col['order_no']) selected @endif >{{ $col['order_no'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Date From</td>
                                        <td style="padding: 0px;" ><input type="date" name="date_from" value="{{ old('date_from') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " ></td>
                                        <td style="width: 120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Date To</td>
                                        <td style="padding: 0px;" ><input type="date" name="date_to" value="{{ old('date_to') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " ></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td ></td>
                                        <td colspan="5">
                                            <input type="submit" name="filter" value="Filter" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Filter Data">
                                            <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="right" title="Clear Input Fields">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            {{Form::close()}}
                            
                        </div>

                    </div>

                </div>

            </div>

            @include('denr.ajax.ajaxGetSection')
            @include('denr.ajax.ajaxGetUnit')
            @include('denr.ajax.ajaxGetEmployee')
            @include('denr.ajax.ajaxGetPositionEmployee')
            @include('denr.ajax.ajaxGetEmployeeOrder')

@endsection