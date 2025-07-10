<?php 

use App\Helpers\Helper;
$doc_class = helper::doc_class();
$icon_class = helper::icon_class();

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
                                <a href="{{ route('view.incoming.documents') }}"><i class="fa fa-sign-in fa-fw"></i> Incoming Document</a>
                            </li>

                            <li>
                                <a href="{{ route('view.outgoing.documents') }}"><i class="fa fa-sign-out fa-fw"></i> Outgoing Document</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('add.documents') }}"><i class="fa fa-plus fa-fw"></i> Add Document</a>
                            </li>

                            <li class="active">
                                <a href="{{ route('view.edit.documents', ['id' => $id, 'id2' => 'A']) }}"><i class="fa fa-edit fa-fw"></i> View Document</a>
                            </li>

                            <li>
                                <a href="{{ route('received.documents') }}"><i class="fa fa-arrow-down fa-fw"></i> Received Document</a>
                            </li>

                            <li>
                                <a href="{{ route('forwarded.documents') }}"><i class="fa fa-arrow-up fa-fw"></i> Forwarded Document</a>
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

                                   <!--  <div class="panel panel-default">
                                        <table class="table table-striped table-bordered table-hover tooltip-demo">
                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; ">ACTION</td>
                                                <td colspan="4">
                                                    <input type="submit" name="add" value="Save" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Save">
                                                    <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;">
                                                    <a href="javascript:void(0)" class="btn-forward btn btn-sm btn-primary" data-id="{{$documents['DOC_NO']}}" style="height: 25px; width: 60px; padding: 2px 0px 0px 0px; "> Forward </a>
                                                    <a href="javascript:void(0)" class="btn-history btn btn-sm btn-warning" data-id="{{$documents['DOC_NO']}}" style="height: 25px; width: 60px; padding: 2px 0px 0px 0px;"> History </a>
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                    </div> -->

                                    {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@AddDocumentsPost', 'files'=>'true', 'name'=>'form' ))}}

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DOC. CATEGORY :</td>
                                                    <td style="padding: 0px;">
                                    <!-- DOC CAT -->    <select class="form-control" name='doc_cat' id='doc_cat' style="height: 33px; font-size: 12px; text-transform: uppercase; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet Category">
                                                            <option value="2" @if($documents['DOC_CATEGORY'] == '2') selected @endif>Incoming Document</option>
                                                            <option value="3" @if($documents['DOC_CATEGORY'] == '3') selected @endif>Outgoing Document</option>
                                                        </select>
                                                    </td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Document Type :</td>
                                                    
                                                    @php $doc_type_list = DB::table('dts_document_types')->get(); @endphp
                                                    
                                                    <td style="padding: 0px;">
                                    <!-- DOC TYPE -->   <select class="form-control" name="doc_type" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet Type" required>
                                                            <option value=''> Select Document Type </option>
                                                            @foreach($doc_type_list as $doc_type_item)
                                                                <option value="{{$doc_type_item->ID}}" @if($documents['DOC_TYPE'] == $doc_type_item->ID) selected @endif >{{$doc_type_item->TYPE_NAME}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DOCUMENT NO. :</td>
                                                    <td style="padding: 0px;">
                                                        <input type="hidden" name="formid" id="formid" value="{{ $formno->id }}">
                                                        <input type="hidden" name="neworder_no" id="neworder_no" value="{{ $new_no }}">
                                    <!-- DOC NO -->     <input id="doc_no" class="form-control" type="text" name='doc_no' value="{{ $documents['DOC_NO'] }}" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet No." readonly="readonly" >
                                                    </td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> CONTROL CODE :</td>
                                                    <td style="padding: 0px;">
                                    <!-- DOC NO -->    <input id="control_code" class="form-control" type="text" value="{{ $documents['CONTROL_CODE'] }}" name='control_code' style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Control Code" >
                                                    </td>
                                                </tr>

                                                @php $user_details = DB::table('employee_position')->where('id', '=', Auth::user()->user_position)->first(); @endphp

                                                <tr class='btn-panel-sender add_sender_rows_here'>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Sender :</td>
                                                    
                                                    @php $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get(); @endphp

                                                    <td style="padding: 0px;" class="SenderGroup1 sender_type_2">
                                    <!-- SENDER-->      <select id="sender_type_2_input" class="form-control" name='doc_from[]' style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px; @if($senders1['SENDER_TYPE'] == 'OUT') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" @if($senders1['SENDER_TYPE'] == 'OUT') disabled @endif>
                                                            <option value=''> Select Insider </option>
                                                            @foreach($addresee_list as $addresee_item)
                                                                <option value='{{$addresee_item->id}}' @if($senders1['DOC_SENDER'] == $addresee_item->id) selected @endif>{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="form-control" name="doc_from[]" id="sender_type_1_input" value="{{$senders1['DOC_SENDER']}}" placeholder="Input Outsider" style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px; @if($senders1['SENDER_TYPE'] == 'IN') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" required  @if($senders1['SENDER_TYPE'] == 'IN') disabled @endif>
                                                        <input type="hidden" name="sender_type[]" value="{{$senders1['SENDER_TYPE']}}" id="sender_type_1_hidden">
                                    <!-- INSIDER -->    <button class='btn btn-default btn-sm pull-left' type='button' id='btn-others-sender1' data-toggle="tooltip" data-placement="left" title="Insider" style="font-size: 16px; width: 8%; height: 33px; float: left; color: blue; border-radius: 0px;"><i class="fa fa-sign-in"></i></button>
                                    <!-- OUTSIDER -->   <button class='btn btn-default btn-sm pull-left' type='button' id='btn-outsider-sender1' data-toggle="tooltip" data-placement="left" title="Outsider" style="font-size: 16px; width: 8%; height: 33px; float: left; color: green; border-radius: 0px;"><i class="fa fa-sign-out"></i></button> 
                                    <!-- ADD SENDER --> <button class='btn btn-default btn-sm pull-left' type='button' id='btn-add-sender' data-toggle="tooltip" data-placement="left" title="Add Sender" style="font-size: 16px; width:8%; height: 33px; float: left; color: #09C; border-radius: 0px;"><i class="fa fa-plus "></i></button> 
                                                    </td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase;"><font style="color: #F00;">*</font> Doc Date & Time :</td>
                                                    <td style="padding: 0px;">
                                    <!-- DOC DATE -->   <input type="date" name='doc_date' value="{{ $documents['DOC_DATE'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; width: 50%; float: left;" data-toggle="tooltip" data-placement="left" title="Documet Date" required>
                                    <!-- DOC TIME -->   <input type="time" name='doc_time' value="{{ $documents['DOC_TIME'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; width: 50%; float: left;" data-toggle="tooltip" data-placement="left" title="Documet Time" required>
                                                    </td>
                                                </tr>

                                                @foreach($senders2 as $id => $col)

                                                    <tr class="btn-panel-sender">
                                                        <td></td>
                                                        <td style="padding: 0px; ">
                                                            <select id="sender_type_2{{$id+1}}_input" class="form-control" name="doc_from[]" style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px; @if($col->SENDER_TYPE == 'OUT') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" @if($col->SENDER_TYPE == 'OUT') disabled @endif>
                                                                <option value=""> Select Insider </option>
                                                                @foreach($addresee_list as $addresee_item)
                                                                <option value="{{$addresee_item->id}}" @if($col->DOC_SENDER == $addresee_item->id) selected @endif >{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="text" name="doc_from[]" class="form-control"  id="sender_type_1{{$id+1}}_input" value="{{$col->DOC_SENDER}}" placeholder="Input Outsider" style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px; @if($col->SENDER_TYPE == 'IN') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" required @if($col->SENDER_TYPE == 'IN') disabled @endif>
                                                            <input type="hidden" name="sender_type[]" value="{{$col->SENDER_TYPE}}" id="sender_type_1{{$id+1}}_hidden">
                                                            <button class="btn btn-default btn-sm pull-left" type="button" id="btn-others-sender{{$id+1}}" data-toggle="tooltip" data-placement="left" title="Insider" style="font-size: 16px; width: 8%;  height:33px; float: left; color:blue; border-radius:0px;"  onclick="OthersBtn('{{$id+1}}')"><i class="fa fa-sign-in"></i></button>
                                                            <button class="btn btn-default btn-sm pull-left" type="button" id="btn-outsider-sender{{$id+1}}" data-toggle="tooltip" data-placement="left" title="Outsider" style="font-size: 16px; width: 8%; float: left; height:33px; color:green; border-radius:0px;" onclick="outSiderBtn('{{$id+1}}')" ><i class="fa fa-sign-out"></i></button>
                                                            <button class="btn btn-default btn-sm pull-left" type="button" id="btn-remove-sender{{$id+1}}" data-toggle="tooltip" data-placement="left" title="Remove Sender" style=" font-size: 16px; width: 8%; height:33px; float: left; color:#F00; border-radius:0px;" onclick="removeSenderRow(this)"><i class="fa fa-times "></i> </button>
                                                        </td>
                                                        <td colspan="2"></td>
                                                    </tr>

                                                @endforeach

                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Originating Office :</td>
                                                    <td style="padding: 0px;" colspan="4">
                                <!-- ORG OFFICE -->    <input class="form-control" name='doc_origin_office' type="text" value="{{ $documents['ORIGIN_OFFICE'] }}" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Originating Office"  required>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address :</td>
                                                    <td style="padding: 0px;" colspan="4">
                                <!-- ADDRESS -->        <input class="form-control" name='doc_address' type="text" value="{{ $documents['DOC_ADDRESS'] }}" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Address"  required>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Subject :</td>
                                                    <td style="padding: 0px;" colspan="4">
                                <!-- SUBJECT -->        <input class="form-control" name='doc_subject' type="text" value="{{ $documents['DOC_SUBJ'] }}" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Subject"  required>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Classification :</td>                                                    
                                                    <td style="padding: 0px;">
                                <!-- CLASSIFICATION --> <select class="form-control" type="text" name='doc_classification' style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Classification">
                                                            <option value="S" @if($documents['DOC_CLASSIFICATION'] == 'S') selected @endif>Simple </option>
                                                            <option value="C" @if($documents['DOC_CLASSIFICATION'] == 'C') selected @endif> Complex </option>
                                                        </select>
                                                    </td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Is this Urgent ?</td> 
                                                    <td style="padding: 0px;">
                                <!-- URGENT -->         <select class="form-control" type="text" name='doc_urgent' style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Urgent?">
                                                            <option value="N" @if($documents['DOC_URGENT'] == 'N') selected @endif> NO </option>
                                                            <option value="Y" @if($documents['DOC_URGENT'] == 'Y') selected @endif> YES </option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Particulars / Remarks :</td>
                                                    <td style="padding: 0px;" colspan="4">
                                <!-- REMARKS -->        <textarea class="form-control" name='doc_remarks' style="height: 100px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Remarks">{{ $documents['REMARKS'] }}</textarea>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Attachment :</td>
                                                    <td style="padding: 0px;" colspan="4">
                                <!-- ATTACHMENT -->      <input type="file" name="attached_files[]" multiple class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Attachment">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td colspan="4">
                                                        <input type="submit" name="add" value="Save" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Save">
                                                        <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;">
                                                        <a href="javascript:void(0)" class="btn-forward btn btn-sm btn-primary" data-id="{{$documents['DOC_NO']}}" style="height: 25px; width: 60px; padding: 2px 0px 0px 0px; "> Forward </a>
                                                        <a href="javascript:void(0)" class="btn-history btn btn-sm btn-warning" data-id="{{$documents['DOC_NO']}}" style="height: 25px; width: 60px; padding: 2px 0px 0px 0px;"> History </a>
                                                        
                                                    </td>

                                                </tr>

                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">

                                                <tr style="background-color:#FFF;">
                                                    <td style="width:13%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>
                                                    <td style="width:25%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left;">Attachment</td>
                                                    <td style="width:52%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Description</td>
                                                    <td style="width:10%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left;">Action</td>
                                                </tr>

                                                @foreach($attachments as $id => $col)

                                                    <tr>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; ">{{$id+1}}</td>
                                                        <td style="padding: 0px;">
                                                            <input type="text" value="{{ $col['FILE_ATTACHMENT'] }}"  class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Attachment" readonly>
                                                        </td>
                                                        <td style="padding: 0px;">
                                                            <input type="text" value="{{ $col['ATTACHMENT_DESC'] }}"  class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Description" readonly>
                                                        </td>
                                                        <td style="padding: 0px; text-align: center; vertical-align: middle;">
                                                            <a href="javascript:void(0)" class="btn-attachment btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="View Attachment" style="font-size: 12px; color: #09C; border-radius: 2px; width: 30%; "><i class="fa fa-file-text-o"></i></a>
                                                            <a href="javascript:void(0)" class="btn-download btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="Download Attachment" style="font-size: 12px; color: green; border-radius: 2px; width: 30%; "><i class="fa fa-download"></i></a>
                                                            <a href="javascript:void(0)" class="btn-remove btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="Remove Attachment" style="font-size: 12px; color: #F00; border-radius: 2px; width: 30%; "><i class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>


                                                @endforeach

                                            </table>

                                        </div>

                                    {{Form::close()}}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @include('denr.dts.activity.forwardModal')
            @include('denr.dts.activity.historyModal')
            @include('denr.dts.activity.ajaxSender')

@endsection