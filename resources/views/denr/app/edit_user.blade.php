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
                                <a href="{{ route('employee.user.list') }}"><i class="fa fa-navicon fa-fw"></i> User / Employee</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('employee.user.form') }}"><i class="fa fa-plus fa-fw"></i> Register New User</a>
                            </li>

                            <li class="active" >
                                <a href="{!! url('denr/app/viewuser/'.Crypt::encrypt($record['id'])); !!}"><i class="fa fa-edit fa-fw"></i> View User / Employee</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                   {{Form::open(array('action'=>'denr\app\UserController@EditUser'))}}

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
                                                

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="8" style="width:120px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> REGISTRATION FORM <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px; font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Username</td>
                                                    <td style="padding: 0px;" ><input type="text" name="username" value="@if($errors->has('username'))@else{{$record['username']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('username')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('username'))Username is required @else Username @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Password</td>
                                                    <td style="padding: 0px;"><input type="password" name="password" value="@if($errors->has('password'))@else{{$record['password']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('password')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('password'))Password is required @else Password @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> User Status</td>
                                                    <td style="padding: 0px;" ><input type="hidden" name="user_status" value="0"><input type="checkbox" name="user_status" value="1" @if($record['user_status'] == '1') checked  @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px; margin-right: 10px;"></td>
                                                    <td style="width:200px;  font-size: 12px; color: #5B5B5B; text-align: right; "> With Recommending Approval</td>
                                                    <td style="padding: 0px;" ><input type="hidden" name="with_recom" value="0"><input type="checkbox" name="with_recom" value="1" @if($record['with_recom'] == '1') checked  @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px; margin-right: 10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> First Name</td>
                                                    <td style="padding: 0px;"><input type="text" name="fname" value="@if($errors->has('fname'))@else{{$record['fname']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('fname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('fname'))First Name is required @else First Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Middle Name</td>
                                                    <td style="padding: 0px;"><input type="text" name="mname" value="@if($errors->has('mname'))@else{{$record['mname']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('mname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('mname'))Middle Name is required @else Middle Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Last Name</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="lname" value="@if($errors->has('lname'))@else{{$record['lname']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('lname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('lname'))Last Name is required @else Last Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> User Level</td>
                                                    <td style="padding: 0px;">
                                                        <select name="user_type" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_type')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required" >
                                                            <option value=""> @if($errors->has('user_type')) Please Select User Type @else Select User type @endif </option>
                                                            <option value="1"  @if($record['user_type'] == '1')  selected  @endif> Super Administrator </option>
                                                            <option value="2"  @if($record['user_type'] == '2')  selected  @endif> System Administrator </option>
                                                            <option value="3"  @if($record['user_type'] == '3') selected  @endif> User / Employee </option>
                                                        </select>
                                                    </td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> User Class</td>
                                                    <td style="padding: 0px;">
                                                        <select name="user_class" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_class')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required" >
                                                            <option value=""> @if($errors->has('user_class')) Please Select User Class @else Select User Class @endif </option>
                                                            <option value="1"  @if($record['user_class'] == '1') selected  @endif> Penro Officer </option>
                                                            <option value="2"  @if($record['user_class'] == '2') selected  @endif> Division Chief </option>
                                                            <option value="3"  @if($record['user_class'] == '3') selected  @endif> Others </option>
                                                        </select>
                                                    </td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> User Role</td>
                                                    <td colspan="3" style="padding: 0px; font-size: 12px;" >
                                                        <select name="user_role" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_role')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required" >
                                                            <option value=""> @if($errors->has('user_role')) Please Select User Role @else Select User Role @endif </option>
                                                            <option value="1"  @if($record['user_role'] == '1') selected  @endif> Receiving Only </option>
                                                            <option value="2"  @if($record['user_role'] == '2') selected  @endif> Releasing Only </option>
                                                            <option value="3"  @if($record['user_role'] == '3') selected  @endif> Both Receiving & Releasing </option>
                                                            <option value="4"  @if($record['user_role'] == '4') selected  @endif> None </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Email Address</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="email" name="email" value="@if($errors->has('email'))@else{{$record['email']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('email')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('email'))Email Address is required @else Email Address @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> Position</td>
                                                    <td style="padding: 0px;" colspan="3">
                                                        <select name="user_position" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_position')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required" >
                                                            <option value=""> @if($errors->has('user_position')) Please Select Position @else Select Position @endif </option>
                                                            @foreach($position as $id => $col)
                                                            <option value="{{ $col['id'] }}"  @if($record['user_position'] == $col['id']) selected  @endif> {{ $col['position_title'] }} </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Division</td>
                                                    <td style="padding: 0px;">
                                                        <select name="division" id="division" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                            <option value=""> Select Division </option>
                                                            @foreach($division as $id => $col)
                                                                <option value="{{ $col['id'] }}" @if( $record['user_division'] == $col['id']) selected @endif>{{ $col['division'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Section</td>
                                                    <td style="padding: 0px;">
                                                        <select name="section" id="section" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                            <option value=""> Select Section </option>
                                                            @foreach($section as $id => $col)
                                                                <option value="{{ $col['id'] }}" @if( $record['user_section'] == $col['id']) selected @endif>{{ $col['section'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; "> Unit</td>
                                                    <td style="padding: 0px;" colspan="3">
                                                        <select name="unit" id="unit" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                            <option value=""> Select Unit </option>
                                                            @foreach($unit as $id => $col)
                                                                <option value="{{ $col['id'] }}" @if( $record['user_unit'] == $col['id']) selected @endif>{{ $col['unit'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td ></td>
                                                    <td colspan="7">
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

            @include('denr.app.scripts.ajax-user-div-sec')
            @include('denr.app.scripts.ajax-user-sec-unit')
            @include('denr.layouts.blocks.msgconfirmation')

@endsection