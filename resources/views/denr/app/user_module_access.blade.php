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
                                <a href="{{ route('user.module.access') }}"><i class="fa fa-navicon fa-fw"></i> User Module Access</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">

                                    
                                    {{Form::open(array('action'=>'denr\app\UserModuleAccessController@AddUserModuleAccess'))}}
                                   
                                        @include('denr.layouts.blocks.msgconfirmation')

                                        @php $userlog = Auth::user(); @endphp
                                        
                                            <div class="panel panel-default" style="overflow: auto; height: 620px;">

                                                <table id="tblA" class="table table-striped table-bordered table-hover tooltip-demo">
                                                
                                                    <tr>
                                                        <td colspan="13" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; ">
                                                            <i class="fa fa-pencil-square fa-fw"></i> USER MODULE ACCESS FORM 
                                                            <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; ">
                                                                <i class="fa fa-question-circle"></i> Help
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="font-weight: bold; text-transform: uppercase;">
                                                        <td style="width:20px; font-size: 14px; color: #09C; text-align: center; vertical-align: middle; "><i class="fa fa-user"></i></td>
                                                        <!-- <td style="padding: 0px;">
                                                            <input type="text" name="com_code2" id="com_code2" value="" class="form-control" style="height: 41px; width: 38%; float: left; color:#09C; font-size: 14px; text-transform: uppercase; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Company Code" readonly="readonly">
                                                            <input type="text" name="lvl" id="lvl" value="" class="form-control" style="height: 41px; width: 62%; float: left; color:#09C; font-size: 12px; text-transform: uppercase; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="User Level" readonly="readonly">
                                                            <input type="hidden" name="com_code" id="com_code" value="">
                                                        </td> -->
                                                        <td style="padding: 0px;" colspan="2">
                                                            <select name="user" id="user" class="form-control" style="height: 41px; color:#09C; font-size: 12px; text-transform: uppercase; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="@if($userlog->USER_LEVEL == '0') Super Admin  @elseif($userlog->USER_LEVEL == '1') Admin Users @elseif($userlog->USER_LEVEL == '2') Ordinary Users @endif">
                                                                <option value=""> -- Select User -- </option>
                                                                @foreach($user as $id => $col)
                                                                <option value="{{ $col['id'] }}" @if(old('user') == $col['id']) selected @endif >{{ $col['fname'] }} {{ $col['mname'] }} {{ $col['lname'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td colspan="2">
                                                            <button id='btn_checkall' name="CheckAll" type="button" onclick="checkAll()" class="btn btn-warning btn-xs" style="height: 25px; margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Check All"><i class="fa fa-check fa-fw"></i></button>
                                                            <button id='btn_uncheckall' name="UnCheckAll" type="button" onclick="uncheckAll()"  class="btn btn-info btn-xs" style="height: 25px; margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Uncheck All"><i class="fa fa-times fa-fw"></i></button>
                                                            <button type="submit" name="add" class="btn btn-success btn-xs" style="height: 25px; margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Save"><i class="fa fa-save fa-fw"></i></button>
                                                            <button type="reset" class="btn btn-danger btn-xs" style="height: 25px; margin-right: 3px; " data-toggle="tooltip" data-placement="top" title="Clear"><i class="fa fa-times-circle fa-fw"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr style="font-weight: bold; text-transform: uppercase;">
                                                        <td style="width:50px; font-size: 11px; color: #5B5B5B; text-align: center; "><i class="fa fa-check"></i></td>
                                                        <td style="width:220px; font-size: 11px; color: #5B5B5B; text-align: left; ">Module Code</td>
                                                        <td style="width:400px; font-size: 11px; color: #5B5B5B; text-align: left; ">Module Name</td>
                                                        <td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Access</td>
                                                        <td></td>
                                                    </tr>

                                                    <tbody id="access">
                                                        <tr>
                                                            <td colspan="3" style="padding: 0px;">
                                                                    
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                           
                                            </div>

                                    
                                    {{Form::close()}}

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <script type="text/javascript">
                
                function toggleRowCbs(cb) {
                  var cbs = document.getElementById(cb.dataset.rowid).querySelectorAll('[type="checkbox"]');
                  [].forEach.call(cbs, function(x) {
                    x.checked = cb.checked;
                  });
                }

            </script>


            <script>

                function checkAll() {

                    //ADD ACCESS

                    var checks = document.getElementsByName("module_access[]");
                    for (var i=0; i < checks.length; i++) {
                        checks[i].checked = true;
                    }
                                        
                }

                function uncheckAll() {

                    //ADD ACCESS

                    var checks = document.getElementsByName("module_access[]");
                    for (var i=0; i < checks.length; i++) {
                        checks[i].checked = false;
                    }
                     
                }

            </script>

            @include('denr.app.scripts.ajaxUserModuleAccess')

@endsection