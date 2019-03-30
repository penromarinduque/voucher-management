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
                                <a href="{{ route('personal.information') }}"><i class="fa fa-navicon fa-fw"></i> Personal Information</a>
                            </li>
                            
                            <li class="active">
                                <a href="{{ route('family.background') }}"><i class="fa fa-navicon fa-fw"></i> Family Background</a>
                            </li>

                            <li>
                                <a href="{{ route('educational.background') }}"><i class="fa fa-navicon fa-fw"></i> Educational Background</a>
                            </li>

                            <li>
                                <a href="{{ route('civil.service.eligibility') }}"><i class="fa fa-navicon fa-fw"></i> Civil Service Eligibility</a>
                            </li>

                            <li>
                                <a href="{{ route('work.experience') }}"><i class="fa fa-navicon fa-fw"></i> Work Experience</a>
                            </li>

                            <li style="float: right; margin-right: 12px;">
                                <a href="{{ route('voluntary.work') }}"><i class="fa fa-angle-double-right fa-fw"></i> Next</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                    {{Form::open(array('action'=>'denr\pis\activity\FamilyBackgroundController@AddFamilyBackground'))}}

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> FAMILY BACKGROUND <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width:180px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: right; "><i class="fa fa-angle-double-down fa-fw"></i> SPOUSE INFORMATION</td>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: left; " colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "> SURNAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="spouse_lname" value="{{ $family['spouse_lname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Surname"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> FIRST NAME</td>
                                                    <td style="padding: 0px;"><input type="text" name="spouse_fname" value="{{ $family['spouse_fname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="First Name"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> EXT. NAME (Jr.,Sr.)</td>
                                                    <td style="padding: 0px;" ><input type="text" name="spouse_xname" value="{{ $family['spouse_xname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Extension Name"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> MIDDLE NAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="spouse_mname" value="{{ $family['spouse_mname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Middle Name"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> OCCUPATION</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="spouse_occupation" value="{{ $family['spouse_occupation'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Occupation"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> BUSINESS NAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="spouse_business_name" value="{{ $family['spouse_business_name'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Employer/Business Name"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> BUSINESS ADDRESS</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="spouse_business_address" value="{{ $family['spouse_business_address'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Employer/Business Address"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> TELEPHONE NO.</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="spouse_phone_no" value="{{ $family['spouse_phone_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Telephone No."></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table id="tbl1" class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr id="tr1">
                                                    <td style="width:180px;  font-size: 11px; color: #5B5B5B; text-align: right; font-weight: bold;"> <i class="fa fa-angle-double-down fa-fw"></i> CHILDREN INFORMATION</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: left; font-weight: bold;">FULL NAME</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: left; font-weight: bold;">BIRTH DATE</td>
                                                    <td style="width:50px; font-size: 11px; color: #5B5B5B; text-align: left; font-weight: bold;"> REMOVE</td>
                                                </tr>
                                                
                                                @foreach($children as $id => $col)
                                                <tr class="item-row" id="tr1">
                                                    <td style="width:150px;  font-size: 12px; color: #5B5B5B; text-align: right; "><input type="hidden" name="child_id[]" value="{{ $col['id'] }}">{{$id+1}}</td>
                                                    <td style="padding: 0px;"><input type="text" name="child_name2[]" value="{{ $col['child_name'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Child Full Name"></td>
                                                    <td style="padding: 0px;"><input type="date" name="child_bdate2[]" value="{{ $col['child_bdate'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Child Birth Date"></td>
                                                    <td style="padding: 0px; vertical-align: middle; text-align: left; padding-left: 10px;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                </tr>
                                                @endforeach
                                            </table>

                                        </div>

                                        <div class="panel panel-default">
                                            
                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width: 180px;"></td>
                                                    <td colspan="5">
                                                        <button type="button" id='addRow' class="btn btn-primary btn-xs" style="height: 25px; width: 90px;" data-toggle="tooltip" data-placement="left" title="Add Skill Details">Add Children</button>
                                                    </td>
                                                </tr>
                                            </table>
                                           
                                        </div>

                                        <div class="panel panel-default">
                                            
                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width:180px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: right; "><i class="fa fa-angle-double-down fa-fw"></i> FATHER INFORMATION</td>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: left; " colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "> SURNAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="father_lname" value="{{ $family['father_lname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Surname"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> FIRST NAME</td>
                                                    <td style="padding: 0px;"><input type="text" name="father_fname" value="{{ $family['father_fname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="First Name"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> EXT. NAME (Jr.,Sr.)</td>
                                                    <td style="padding: 0px;" ><input type="text" name="father_xname" value="{{ $family['father_xname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Extension Name"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> MIDDLE NAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="father_mname" value="{{ $family['father_mname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Middle Name"></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">
                                            
                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width:180px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: right; "><i class="fa fa-angle-double-down fa-fw"></i> MOTHER INFORMATION</td>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: left; " colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "> MAIDEN NAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="mother_maiden_name" value="{{ $family['mother_maiden_name'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Maiden Name"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "> SURNAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="mother_lname" value="{{ $family['mother_lname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Surname"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> FIRST NAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="mother_fname" value="{{ $family['mother_fname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="First Name"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> MIDDLE NAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="mother_mname" value="{{ $family['mother_mname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " placeholder="Middle Name"></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">
                                            
                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width: 180px;"></td>
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

            @include('denr.layouts.blocks.msgconfirmation')

            <script>

                $(function(){
                // window.alert(numRows);

                  $('#addRow').click(function() {  
                    
                    numRows = $("#tbl1 #tr1").length;
                    
                    var str = "" + numRows
                    var pad = "000000"
                    var ans = pad.substring(0, pad.length - str.length) + str
                    if($('#itemCode-'+(numRows-1)).val()!=='')
                    {
                        $row = $('<tr class="item-row" id="tr1">'
                                    +'<td style="width:120px;  font-size: 12px; color: #5B5B5B; text-align: right; ">' + numRows + '</td>'
                                    +'<td style="padding: 0px;" ><input type="text" name="child_name[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Child Full Name"></td>'
                                    +'<td style="padding: 0px;" ><input type="date" name="child_bdate[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Child Birth Date"></td>'
                                    +'<td style="padding: 0px; vertical-align: middle; text-align: left; padding-left: 10px;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times"></i></button></td>'
                                +'</tr>');
                        
                        $('#tbl1').append($row);
                    }

                  });

                });
                
                function deleteRow(btn) {
                  var row = btn.parentNode.parentNode;
                  row.parentNode.removeChild(row);
                }

            </script>

@endsection