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
                                <a href="{{ route('voluntary.work') }}"><i class="fa fa-navicon fa-fw"></i> Voluntary Work</a>
                            </li>
                            
                            <li class="active">
                                <a href="{{ route('learning.development') }}"><i class="fa fa-navicon fa-fw"></i> Learning & Development</a>
                            </li>

                            <li>
                                <a href="{{ route('other.information') }}"><i class="fa fa-navicon fa-fw"></i> Other Information</a>
                            </li>

                            <li style="float: right; margin-right: 12px;">
                                <a href="{{ route('work.experience') }}"><i class="fa fa-angle-double-left fa-fw"></i> Previous</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                    {{Form::open(array('action'=>'denr\pis\activity\LearningDevelopmentController@AddLearningDevelopment'))}}

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="9" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> LEARNING & DEVELOPMENT <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                            </table>

                                        </div>

                                        
                                        <div class="panel panel-default" style="overflow: auto; padding-bottom: 20px;">

                                            <table id="tbl1" style="width: 1300px;" class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr id="tr1">
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS <br/>(Write in full)</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" colspan="2">INCLUSIVE DATES OF ATTENDANCE <br/>(mm/dd/yyyy)</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">NUMBER OF HOURS</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">TYPE OF ID <br/>(Manegerial/Supervisory/Technical/Etc.)</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2">CONDUCTED/SUPERVISORY BY <br/>(Write in full)</td>
                                                    <td style="font-size: 14px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;" rowspan="2"> <i class="fa fa-times"></i></td>
                                                </tr>
                                                <tr id="tr1"> 
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;">FROM</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: center; vertical-align:middle; font-weight: bold;">TO</td>
                                                </tr>
                                                
                                                @if($learning_count == 0)

                                                    <tr class="item-row" id="tr1">
                                                        <td style="padding: 0px;"><input type="text" name="title[]" value="" class="form-control" style="width: 500px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="date" name="date_form[]" value="" class="form-control" style="width: 140px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="date" name="date_to[]" value="" class="form-control" style="width: 140px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="number_hours[]" value="" class="form-control" style="width: 100px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="type_id[]" value="" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="conducted[]" value="" class="form-control" style="width: 300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color: #F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>

                                                @elseif($learning_count > 0)                                                
                                                
                                                    @foreach($learning as $id => $col)
                                                    <tr class="item-row" id="tr1">
                                                        <input type="hidden" name="learning_id[]" value="{{ $col['id'] }}">
                                                        <td style="padding: 0px;"><input type="text" name="title2[]" value="{{ $col['learning_title'] }}" class="form-control" style="width: 500px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="date" name="date_form2[]" value="{{ $col['inclusive_date_from'] }}" class="form-control" style="width: 140px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="date" name="date_to2[]" value="{{ $col['inclusive_date_to'] }}" class="form-control" style="width: 140px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="number_hours2[]" value="{{ $col['number_of_hours'] }}" class="form-control" style="width: 100px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="type_id2[]" value="{{ $col['type_id'] }}" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
                                                        <td style="padding: 0px;"><input type="text" name="conducted2[]" value="{{ $col['conducted_by'] }}" class="form-control" style="width: 300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>
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
                                    +'<td style="padding: 0px;"><input type="text" name="title[]" value="" class="form-control" style="width: 500px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="date" name="date_form[]" value="" class="form-control" style="width: 140px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="date" name="date_to[]" value="" class="form-control" style="width: 140px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="number_hours[]" value="" class="form-control" style="width: 100px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="type_id[]" value="" class="form-control" style="width: 250px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
                                    +'<td style="padding: 0px;"><input type="text" name="conducted[]" value="" class="form-control" style="width: 300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder=""></td>'
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