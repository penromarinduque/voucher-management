<?php include(resource_path() . '/views/denr/layouts/helpers_data.php'); ?>

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
                                <a href="{{ route('user.account',['path' => $path]) }}"><i class="fa fa-user fa-fw"></i> My Account</a>
                            </li>
                            <li>
                                <a href="{{ route('change.password',['path' => $path]) }}"><i class="fa fa-key fa-fw"></i> Change Password</a>
                            </li>
                            <li>
                                <a href="{{ route('my.audit.trail.log.form',['path' => $path]) }}"><i class="fa fa-navicon fa-fw"></i> My Activity Log</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                   {{ Form::open(array('route' => array('user.account.submit', 'path' => $path))) }}

                                        <div class="panel panel-default">
                                            
                                            <input type="hidden" name="get_id" value="{{$record['id']}}">
                                            <input type="hidden" name="get_username" value="{{$record['username']}}">
                                            <input type="hidden" name="get_password" value="{{$record['password']}}">
                                            <input type="hidden" name="get_status" value="{{$record['user_status']}}">
                                            <input type="hidden" name="get_fname" value="{{$record['fname']}}">
                                            <input type="hidden" name="get_mname" value="{{$record['mname']}}">
                                            <input type="hidden" name="get_lname" value="{{$record['lname']}}">
                                            <input type="hidden" name="get_email" value="{{$record['email']}}">
                                            <input type="hidden" name="get_type" value="{{$record['user_type']}}">

                                                @php
                                                    
                                                    if($record['user_type']=='1') {
                                                        $user_type = 'Super Administrator';
                                                    } else if($record['user_type']=='2') {
                                                        $user_type = 'System Administrator';
                                                    } else if($record['user_type']=='3') {
                                                        $user_type = 'User / Employee';
                                                    }


                                                @endphp
                                                

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="6" style="width:120px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> MY ACCOUNT FORM <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px; font-size: 12px; color: #5B5B5B; text-align: right; "> Username</td>
                                                    <td style="padding: 0px;" ><input type="text" name="username" value="{{ $record['username'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly"></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Password</td>
                                                    <td style="padding: 0px;"><input type="password" name="password" value="{{ $record['password'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly"></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> User Status</td>
                                                    <td style="padding: 0px;" ><input type="hidden" name="user_status" value="0"><input type="checkbox" name="user_status" value="1" @if($record['user_status'] == '1') checked  @endif  onClick="return false" style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> First Name</td>
                                                    <td style="padding: 0px;"><input type="text" name="fname" value="@if($errors->has('fname'))@else{{$record['fname']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('fname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('fname'))First Name is required @else First Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Middle Name</td>
                                                    <td style="padding: 0px;"><input type="text" name="mname" value="@if($errors->has('mname'))@else{{$record['mname']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('mname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('mname'))Middle Name is required @else Middle Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Last Name</td>
                                                    <td style="padding: 0px;"><input type="text" name="lname" value="@if($errors->has('lname'))@else{{$record['lname']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('lname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('lname'))Last Name is required @else Last Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Email Address</td>
                                                    <td style="padding: 0px;" ><input type="email" name="email" value="@if($errors->has('email'))@else{{$record['email']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('email')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('email'))Email Address is required @else Email Address @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Position</td>
                                                    <td style="padding: 0px;"><input type="text" name="position" value="{{ $position['position_title'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " readonly="readonly"></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; ">User Type</td>
                                                    <td style="padding: 0px;"><input type="text" name="user_type" value="{{ $user_type }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Division</td>
                                                    <td style="padding: 0px;"><input type="text" name="division" value="{{ $division['division'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " readonly="readonly"></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Section</td>
                                                    <td style="padding: 0px;"><input type="text" name="section" value="{{ $section['section'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " readonly="readonly"></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Unit</td>
                                                    <td style="padding: 0px;"><input type="text" name="unit" value="{{ $unit['unit'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td ></td>
                                                    <td colspan="5">
                                                        <input type="submit" name="add" value="Save" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Are you sure you filled-up all required fields?">
                                                        <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                    
                                    {{Form::close()}}

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            @include('denr.app.scripts.ajax-user-div-sec')
            @include('denr.app.scripts.ajax-user-sec-unit')
            @include('denr.layouts.blocks.msgconfirmation')

@endsection