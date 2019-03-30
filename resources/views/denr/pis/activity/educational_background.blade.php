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
                            
                            <li>
                                <a href="{{ route('family.background') }}"><i class="fa fa-navicon fa-fw"></i> Family Background</a>
                            </li>

                            <li class="active">
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
                                    
                                    {{Form::open(array('action'=>'denr\pis\activity\EducationalBackgroundController@AddEducationalBackground'))}}

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="9" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> EDUCATIONAL BACKGROUND <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                            </table>

                                        </div>

                                        
                                        <div class="panel panel-default" style="overflow: auto; padding-bottom: 20px;">

                                            <table id="tbl1" style="width: 1700px;" class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr id="tr1">
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">LEVEL</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">NAME OF SCHOOL <br> (Write in full)</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">BASIC EDUCATION / DEGREE / COURSE <br> (Write in full)</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" colspan="2">PERIOD OF ATTENDANCE</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">HIGHEST LEVEL / UNITS EARNED <br> (if not graduated)</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">YEAR GRADUATED </td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">SCHOLARSHIP / ACADEMIC HONORS RECEIVED</td>
                                                    <td style="font-size: 14px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2"> <i class="fa fa-times"></i></td>
                                                </tr>
                                                <tr id="tr1"> 
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;">FROM</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;">TO</td>
                                                </tr>
                                                
                                                @if($educ_count == 0)

                                                    <tr class="item-row" id="tr1">
                                                        <td style="padding: 0px;"><input type="text" name="level[]" value="ELEMENTARY" class="form-control" style="width: 210px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                        <td style="padding: 0px;"><input type="text" name="school_name[]" value="" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="basic_educ[]" value="" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_from[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_to[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="highest_level[]" value="" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="year_graduated[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="scholarship[]" value="" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>  
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>

                                                    <tr class="item-row" id="tr1">
                                                        <td style="padding: 0px;"><input type="text" name="level[]" value="SECONDARY" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                        <td style="padding: 0px;"><input type="text" name="school_name[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="basic_educ[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_from[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_to[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="highest_level[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="year_graduated[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="scholarship[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>  
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>

                                                    <tr class="item-row" id="tr1">
                                                        <td style="padding: 0px;"><input type="text" name="level[]" value="VOCATIONAL / TRADE COURSE" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                        <td style="padding: 0px;"><input type="text" name="school_name[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="basic_educ[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_from[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_to[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="highest_level[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="year_graduated[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="scholarship[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>  
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>

                                                    <tr class="item-row" id="tr1">
                                                        <td style="padding: 0px;"><input type="text" name="level[]" value="COLLEGE" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                        <td style="padding: 0px;"><input type="text" name="school_name[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="basic_educ[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_from[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_to[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="highest_level[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="year_graduated[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="scholarship[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>  
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>

                                                    <tr class="item-row" id="tr1">
                                                        <td style="padding: 0px;"><input type="text" name="level[]" value="GRADUATE STUDIES" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                        <td style="padding: 0px;"><input type="text" name="school_name[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="basic_educ[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_from[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_to[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="highest_level[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="year_graduated[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="scholarship[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>  
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>

                                                @elseif($educ_count > 0)                                                
                                                
                                                    @foreach($educ as $id => $col)
                                                    <tr class="item-row" id="tr1">
                                                        <input type="hidden" name="level_id[]" value="{{ $col['id'] }}">
                                                        <td style="padding: 0px;"><input type="text" name="level2[]" value="{{ $col['level'] }}" class="form-control" style="width: 210px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                        <td style="padding: 0px;"><input type="text" name="school_name2[]" value="{{ $col['school_name'] }}" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="basic_educ2[]" value="{{ $col['basic_education_degree_course'] }}" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_from2[]" value="{{ $col['poa_from'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="period_to2[]" value="{{ $col['poa_to'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="highest_level2[]" value="{{ $col['highest_level_units_earned'] }}" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="year_graduated2[]" value="{{ $col['year_graduated'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="scholarship2[]" value="{{ $col['scholarship_academic_honors_received'] }}" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>  
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>
                                                    @endforeach

                                                @endif

                                            </table>

                                        </div>

                                        
                                        <div class="panel panel-default">
                                            
                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="9">
                                                        <button type="button" id='addRow' class="btn btn-primary btn-xs" style="height: 25px; width: 90px;" data-toggle="tooltip" data-placement="left" title="Add Details">Add Details</button>
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
                                    +'<td style="padding: 0px;"><input type="text" name="level[]" value="" class="form-control" style="width:210px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="school_name[]" value="" class="form-control" style="width:250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="basic_educ[]" value="" class="form-control" style="width:250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="period_from[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="period_to[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="highest_level[]" value="" class="form-control" style="width:250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="year_graduated[]" value="" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="scholarship[]" value="" class="form-control" style="width:250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'  
                                    +'<td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>'
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