<?php 

use App\Helpers\Helper;
$doc_class = helper::doc_class();
$icon_class = helper::icon_class();

$user = Auth::user();
$user_type = $user->user_type;
$user_role = $user->user_role;

?>

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
                                <a href="{{ route('dts.document.index', ['id' => 'in']) }}"><i class="fa fa-sign-in fa-fw"></i> Incoming Document</a>
                            </li>

                            <li>
                                <a href="{{ route('dts.document.index', ['id' => 'out']) }}"><i class="fa fa-sign-out fa-fw"></i> Outgoing Document</a>
                            </li>
                            <li>
                                <a href="{{ route('dts.document.index', ['id' => 'acted']) }}"><i class="fa fa-paper-plane fa-fw"></i> Acted</a>
                            </li>
                            <li >
                                <a href="{{ route('dts.document.index', ['id' => 'completed']) }}"><i class="fa fa-check-square fa-fw"></i> Completed</a>
                            </li>
                            
                            <li class="active">
                                <a href="{{ route('dts.document.create') }}"><i class="fa fa-plus fa-fw"></i> New Document</a>
                            </li>

                        </ul>

                        <div class="panel-body">

                            <div class="row"> 

                                <div class="col-lg-12">

                                    @include('denr.layouts.blocks.msgconfirmation')
                                    
                                </div>

                                <div class="col-lg-12">

                                    <div class="panel panel-default">
                                        <table class="table table-striped table-bordered table-hover tooltip-demo">
                                            <tr>
                                                <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase;"><i class="fa fa-pencil-square fa-fw"></i> DOCUMENT INFORMATION <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                            </tr>
                                        </table>
                                    </div>

                                    {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@insert', 'files'=>'true', 'name'=>'form', 'id'=>'form_add' ))}}
                                        <!-- , 'onsubmit'=>"return confirm('DO YOU REALLY WANT TO SUBMIT THE FORM? PLEASE MAKE SURE ALL OF THE DOCUMENT DETAILS ARE CORRECT BEFORE SUBMITTING.');" -->
                                        <div class="panel panel-default">

                                            <input type="hidden" name="date_time_start" value="{{date('Y-m-d H:i:s')}}">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width:15%; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DOC. CATEGORY</td>
                                                    <td style="width:35%; padding: 0px;">
                                    <!-- DOC CAT -->    <select class="form-control" name='doc_cat' id='doc_cat' style="height: 33px; font-size: 12px; text-transform: uppercase; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet Category">
                                                            @if($user_role == '1')
                                                            <option value="IN">Incoming Document</option>
                                                            @elseif($user_role == '2')
                                                            <option value="OUT">Outgoing Document</option>
                                                            @elseif($user_role == '3')
                                                            <option value="IN">Incoming Document</option>
                                                            <option value="OUT">Outgoing Document</option>
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td style="width:15%; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Document Type :</td>
                                                    
                                                    @php $doc_type_list = DB::table('dts_document_types')->orderBy('TYPE_NAME', 'ASC')->get(); @endphp
                                                    
                                                    <td style="width:35%; padding: 0px;">
                                    <!-- DOC TYPE -->   <select class="form-control" name="doc_type" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet Type" required>
                                                            <option value=''> Select Document Type </option>
                                                            @foreach($doc_type_list as $doc_type_item)
                                                                <option value="{{$doc_type_item->ID}}">{{$doc_type_item->TYPE_NAME}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DOCUMENT NO. :</td>
                                                    <td style="padding: 0px;">
                                                        <input type="hidden" name="formid" id="formid" value="{{ $formno->id }}">
                                                        <input type="hidden" name="neworder_no" id="neworder_no" value="{{ $new_no }}">
                                    <!-- DOC NO -->     <input id="doc_no" class="form-control" type="text" name='doc_no' value="{{ $formno->form_text }}{{ $cur_no }}" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet No." readonly="readonly" >
                                                    </td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> CONTROL CODE :</td>
                                                    <td style="padding: 0px;">
                                    <!-- DOC NO -->    <input id="control_code" class="form-control" type="text" name='control_code' style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Control Code" >
                                                    </td>
                                                </tr>

                                                @php $user_details = DB::table('employee_position')->where('id', '=', Auth::user()->user_position)->first(); @endphp

                                                <tr class='btn-panel-sender add_sender_rows_here'>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Sender :</td>
                                                    
                                                    @php $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->where('users.user_status',1)->orderby('users.fname')->get(); @endphp

                                                    <td style="padding: 0px;" class="SenderGroup1 sender_type_2">
                                    <!-- SENDER-->      <select id="sender_type_2_input" class="form-control" name='doc_from[]' style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="top" title="Sender" required>
                                                            <option value=''> Select Insider </option>
                                                            @foreach($addresee_list as $addresee_item)
                                                                @php
                                                                $sender_sel = ($addresee_item->id==$user->id) ? 'selected' : '';
                                                                @endphp
                                                                <option value='{{$addresee_item->id}}' {{$sender_sel}}>{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="form-control" name="doc_from[]" id="sender_type_1_input" placeholder="Input Outsider" style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px;display: none;" data-toggle="tooltip" data-placement="top" title="Sender" required  disabled>
                                                        <input type="hidden" name="sender_type[]" value="IN" id="sender_type_1_hidden" >
                                    <!-- INSIDER -->    <button class='btn btn-default btn-sm pull-left' type='button' id='btn-others-sender1' data-toggle="tooltip" data-placement="top" title="Insider" style="font-size: 16px; width: 8%; height: 33px; float: left; color: blue; border-radius: 0px;"><i class="fa fa-sign-in"></i></button>
                                    <!-- OUTSIDER -->   <button class='btn btn-default btn-sm pull-left' type='button' id='btn-outsider-sender1' data-toggle="tooltip" data-placement="top" title="Outsider" style="font-size: 16px; width: 8%; height: 33px; float: left; color: green; border-radius: 0px;"><i class="fa fa-sign-out"></i></button> 
                                    <!-- ADD SENDER --> <button class='btn btn-default btn-sm pull-left' type='button' id='btn-add-sender' data-toggle="tooltip" data-placement="top" title="Add Sender" style="font-size: 16px; width:8%; height: 33px; float: left; color: #09C; border-radius: 0px;"><i class="fa fa-plus "></i></button> 
                                                    </td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase;"><font style="color: #F00;">*</font> Doc Date & Time :</td> 
                                                    <td style="padding: 0px;">
                                    <!-- DOC DATE -->   <input type="date" name='doc_date' value="{{date('Y-m-d')}}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; width: 50%; float: left;" data-toggle="tooltip" data-placement="left" title="Documet Date" required>
                                    <!-- DOC TIME -->   <input type="time" name='doc_time' value="{{date('H:i:s')}}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; width: 50%; float: left;" data-toggle="tooltip" data-placement="left" title="Documet Time" required>
                                                        <input type="hidden" name="doc_date_org" value="{{date('Y-m-d')}}">
                                                        <input type="hidden" name="doc_time_org" value="{{date('H:i:s')}}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Originating Office :</td>
                                                    <td style="padding: 0px;" colspan="3">
                                <!-- ORG OFFICE -->    <input class="form-control" name='doc_origin_office' type="text" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Originating Office"  >
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Address :</td>
                                                    <td style="padding: 0px;" colspan="3">
                                <!-- ADDRESS -->        <input class="form-control" name='doc_address' type="text" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Address"  >
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Subject :</td>
                                                    <td style="padding: 0px;" colspan="3">
                                <!-- SUBJECT -->       <input class="form-control" name='doc_subject' type="text" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Subject"  required>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Classification :</td>
                                                    <td style="padding: 0px;">
                                <!-- CLASSIFICATION --> <select class="form-control" type="text" name='doc_classification' style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Classification" required>
                                                            <option value=""> Select Classification</option>
                                                            <option value="S"> Simple </option>
                                                            <option value="C"> Complex </option>
                                                            <option value="HT"> Highly Technical </option>
                                                            <option value="HT(MSP)"> Highly Technical (Multi-Stage Processing) </option>
                                                        </select>
                                                    </td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Is this Urgent ?</td>
                                                    <td style="padding: 0px;">
                                <!-- URGENT -->         <select class="form-control" type="text" name='doc_urgent' style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Urgent?">
                                                            <option value="Y"> Yes </option>
                                                            <option value="N"> No </option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr class='btn-panel-addresee add_receiver_rows_here'> 
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address to :</td>
                                                    <td style="padding: 0px;">
                                <!-- ADDRESS TO -->     <input type="hidden" name="send_type" value="FW">
                                                        <div style="display: flex;">
                                                            <div>
                                                                <select class="form-control" name='doc_to[]' style="height: 33px; float: left; width: 50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Address To" required="required">
                                                                    <option value=''> Select Addressee</option>
                                                                    @php
                                                                    $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->where('users.id','<>', $user_id)->where('users.user_status', 1)->orderby('users.lname')->get();
                                                                    @endphp
                                                                    @foreach($addresee_list as $addresee_item)
                                                                        <option value='{{$addresee_item->id}}' @if($user->user_role != '4')@if($addresee_item->user_class == '1') selected @endif @endif>{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class="form-control" name='doc_action[]' style="height: 33px; float: left; width: 50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Action to be taken?" required="required">
                                                                    <option value=""> Select Action to be taken</option>
                                                                    @foreach($doc_action as $id => $col)
                                                                        <option value='{{$col->ID}}'>{{$col->ACTION}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input class="form-control" name='doc_remarks[]' type="text" style="height: 33px; float: left; width: 100%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Remarks" placeholder="Remarks">
                                                            </div>
                                                            <div>
                                                                <button class='btn btn-default btn-sm pull-left' type="button" id='btn-add-addresee' style="font-size: 16px; width: 35px; height: 66px; float: left; color: #09C; border-radius: 0px;"><i class="fa fa-plus "></i></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Remarks :</td>
                                                    <td style="padding: 0px;" colspan="3">
                                                        <textarea class="form-control" name='doc_particulars' style="height: 100px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Action to be taken"></textarea>
                                                    </td>
                                                </tr> --}}

                                                <tr> 
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Attachment :</td>
                                                    <td style="padding: 0px;" colspan="3">
                                <!-- ATTACHMENT -->      <input type="file" name="attached_files[]" multiple class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Attachment">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td colspan="4">
                                                        <p style="font-size: 11px;"><i>Important: <b class="text-danger">Please make sure all of the document details are correct before submitting.</b></i></p>
                                                        <!-- SUBMIT BUTTON -->  
                                                        <!-- <input type="submit" name="add" id="btn_add" value="Submit" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Submit"> -->
                                                        <button type="submit" name="add" id="btn_add" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left">Submit</button>
                                                        <input type="reset" value="Clear" class="btn btn-danger btn-sm">
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

            @include('denr.dts.activity.modal.ajaxSender')

            <script type="text/javascript">
                $('#form_add').submit(function (event) {
                    if (confirm('DO YOU REALLY WANT TO SUBMIT THE FORM? PLEASE MAKE SURE ALL OF THE DOCUMENT DETAILS ARE CORRECT BEFORE SUBMITTING.')) {
                        $('#btn_add').prop('disabled',true).html('Submitting...');
                        $('input[type=reset]').prop('disabled',true);
                        $('input[type=text], input[type=button], input[type=date], input[type=time], input[type=file]').prop('readonly',true);
                        $('select').attr('readonly','readonly');
                        $('button').attr('disabled','disabled');
                        return true;
                    } else {
                        event.preventDefault();
                    }
                });

                $("#btn-add-addresee").click(function(){

                    var numRowReceiver = $('.btn-panel-addresee').length + 1;

                    var newReceiverRow = '<tr class="btn-panel-addresee">'
                                            +'<td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; ">'
                                                +'<font style="color: #F00;"></font>'
                                            +'</td>'
                                            +'<td style="padding: 0px;" id="ReceiverGroup1">'
                                                +'<div style="display: flex;">'
                                                    +'<div>'
                                                        +'<select class="form-control" name="doc_to[]" style="height: 33px; float: left; width: 50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Address To" required="required">'
                                                            +'<option value=""> Select Addressee</option>'
                                                            @foreach($addresee_list as $addresee_item)
                                                                +'<option value="{{$addresee_item->id}}">{{$addresee_item->fname}} {{$addresee_item->lname}}</option>'
                                                            @endforeach
                                                        +'</select>'
                                                        +'<select class="form-control" name="doc_action[]" style="height: 33px; float: left; width: 50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Action to be taken?" required="required">'
                                                            +'<option value=""> Select Action to be taken</option>'
                                                            @foreach($doc_action as $id => $col)
                                                                +'<option value="{{$col->ID}}">{{$col->ACTION}}</option>'
                                                            @endforeach
                                                        +'</select>'
                                                        +'<input class="form-control" name="doc_remarks[]" type="text" style="height: 33px; float: left; width: 100%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Remarks" placeholder="Remarks">'
                                                    +'</div>'
                                                    +'<div>'
                                                        +'<button class="btn btn-default btn-sm pull-right" type="button" id="btn-remove-addresee" onclick="removeReceiverRow(this)" style="font-size: 16px; width:35px; height: 66px; float: left; color: #F00; border-radius: 0px;"><i class="fa fa-times "></i></button>'
                                                    +'</div>'
                                                +'</div>'
                                            +'</td>'
                                        +'</tr>';

                    $(newReceiverRow).insertAfter('.add_receiver_rows_here');

                });

                function removeReceiverRow(btn){

                    btn.parentNode.parentNode.parentNode.parentNode.remove();
                    // var row = btn.parentNode.parentNode;
                    // row.parentNode.removeChild(row);
                }

            </script>

@endsection