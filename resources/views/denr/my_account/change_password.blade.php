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

                            <li style="margin-left: 12px;">
                                <a href="{{ route('user.account', ['path' => $path]) }}"><i class="fa fa-user fa-fw"></i> My Account</a>
                            </li>
                            <li class="active">
                                <a href="{{ route('change.password', ['path' => $path]) }}"><i class="fa fa-key fa-fw"></i> Change Password</a>
                            </li>
                            <li>
                                <a href="{{ route('my.audit.trail.log.form', ['path' => $path]) }}"><i class="fa fa-navicon fa-fw"></i> My Activity Log</a>
                            </li>
                            

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                   {{ Form::open(array('route' => array('change.password.submit', 'path' => $path))) }}

                                        

                                         <div class="panel panel-default">
                                           <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="2" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> CHANGE PASSWORD FORM <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Current Password</td>
                                                    <td style="padding: 0px;" ><input type="password" name="current_password" value="{{ old('current_password') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('current_password')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('current_password'))Current Password is required @else Current Password @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> New Password</td>
                                                    <td style="padding: 0px;" ><input type="password" name="new_password" value="{{ old('new_password') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('new_password')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('new_password'))New Password is required @else New Password @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Confirm Password</td>
                                                    <td style="padding: 0px;" ><input type="password" name="confirm_password" value="{{ old('confirm_password') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('confirm_password')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('confirm_password'))Confirm Password is required @else Confirm Password @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td ></td>
                                                    <td>
                                                        <input type="submit" name="add" value="Submit" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Are you sure you filled-up all required fields?">
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

            @include('denr.layouts.blocks.msgconfirmation')


@endsection