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

                @if($user_role != '4')
                
                <li>
                    <a href="{{ route('dts.document.create') }}"><i class="fa fa-plus fa-fw"></i> New Document</a>
                </li>

                @endif

                <li class="active">
                    <a href="{{ route('dts.document.view', ['id' => $id, 'id2' => 'B']) }}"><i class="fa fa-edit fa-fw"></i> View Document</a>
                </li>

            </ul>

            <div class="panel-body">
                <div class="row"> 

                    <div class="col-lg-12">

                        @include('denr.layouts.blocks.msgconfirmation')

                        @php $code = Crypt::encrypt($documents->DOC_NO); @endphp

                    </div>

                    <div class="col-lg-12">

                        <div class="panel panel-default">

                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                
                                <tr>

                                    <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 0px 0px 0px 10px; text-transform: uppercase;">
                                        
                                        <font style="float: left; margin-top: 8px;"><i class="fa fa-pencil-square fa-fw"></i> DOCUMENT INFORMATION </font>
                                        
                                        <a onClick=MM_openBrWindow("{{ url('dts/activity/document/manual/'.$code) }}",'') class="btn-print btn btn-default" data-id="{{$documents->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="Print Manual Slip" style="cursor:pointer; font-size: 12px; color: #FF4500; border-radius: 2px; width: 37px; float: right; margin-left: 2px;"><i class="glyphicon glyphicon-print"></i></a>
                                        <a onClick=MM_openBrWindow("{{ url('dts/activity/document/print/'.$code) }}",'') class="btn-print btn btn-default" data-id="{{$documents->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="Print Slip" style="cursor:pointer; font-size: 12px; color: gold; border-radius: 2px; width: 37px; float: right; margin-left: 2px;"><i class="glyphicon glyphicon-print"></i></a>
                                        
                                        @if($documents->STATUS != 'C')
                                            @if($end_user != $user->id)
                                            <a href="javascript:void(0)" class="btn-complete btn btn-default" data-id="{{$documents->DOC_NO}}" data-id2="{{$documents->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="End" style="font-size: 12px; color: #3D9140; border-radius: 2px; width: 37px; float: right; margin-left: 2px; "><i class="glyphicon glyphicon-saved"></i> </a>
                                            @endif
                                            <a href="javascript:void(0)" class="btn-forward btn btn-default" data-id="{{$documents->DOC_NO}}" data-id2="{{$documents->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="Forward" style="font-size: 12px; color: #09C; border-radius: 2px; width: 37px; float: right; margin-left: 2px; "><i class="fa fa-send"></i> </a>
                                        @endif
                                        
                                    </td>

                                </tr>

                            </table>

                        </div>

                        <div class="panel panel-default">

                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                
                                <tr>
                                    <td style="width:15%; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DOC. CATEGORY :</td>
                                    <td style="width:35%; padding: 0px;">
                                        <select disabled class="form-control" name='doc_cat' id='doc_cat' style="background-color: #FFF; height: 33px; font-size: 12px; text-transform: uppercase; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet Category">
                                            <option value="IN" @if($documents['DOC_CATEGORY'] == 'IN') selected @endif>Incoming Document</option>
                                            <option value="OUT" @if($documents['DOC_CATEGORY'] == 'OUT') selected @endif>Outgoing Document</option>
                                        </select>
                                    </td>
                                    <td style="width:15%; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Document Type :</td>
                                    
                                    @php $doc_type_list = DB::table('dts_document_types')->get(); @endphp
                                    
                                    <td style="width:35%; padding: 0px;">
                                        <select disabled class="form-control" name="doc_type" style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet Type" required>
                                            <option value=''> Select Document Type </option>
                                            @foreach($doc_type_list as $doc_type_item)
                                                <option value="{{$doc_type_item->ID}}" @if($documents['DOC_TYPE'] == $doc_type_item->ID) selected @endif >{{$doc_type_item->TYPE_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DOCUMENT NO. :</td>
                                    <td style="padding: 0px;">
                                        <input type="hidden" name="formid" id="formid" value="{{ $formno->id }}">
                                        <input type="hidden" name="neworder_no" id="neworder_no" value="{{ $new_no }}">
                                        <input disabled id="doc_no" class="form-control" type="text" name='doc_no' value="{{ $documents['DOC_NO'] }}" style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Documet No." readonly="readonly" >
                                    </td>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> CONTROL CODE :</td>
                                    <td style="padding: 0px;">
                                        <input disabled id="control_code" class="form-control" type="text" value="{{ $documents['CONTROL_CODE'] }}" name='control_code' style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Control Code" >
                                    </td>
                                </tr>

                                @php $user_details = DB::table('employee_position')->where('id', '=', Auth::user()->user_position)->first(); @endphp

                                <tr class='btn-panel-sender add_sender_rows_here'>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Sender 1 :</td>
                                    
                                    @php $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get(); @endphp

                                    <td style="padding: 0px;" class="SenderGroup1 sender_type_2">
                                        <select id="sender_type_2_input" class="form-control" name='doc_from[]' style="background-color: #FFF; height: 33px; width: 100%; float: left; font-size: 12px; border-radius: 0px; @if($senders1['SENDER_TYPE'] == 'OUT') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" disabled>
                                            <option value=''> Select Insider </option>
                                            @foreach($addresee_list as $addresee_item)
                                                <option value='{{$addresee_item->id}}' @if($senders1['DOC_SENDER'] == $addresee_item->id) selected @endif>{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="doc_from[]" id="sender_type_1_input" value="{{$senders1['DOC_SENDER']}}" placeholder="Input Outsider" style="background-color: #FFF; height: 33px; width: 100%; float: left; font-size: 12px; border-radius: 0px; @if($senders1['SENDER_TYPE'] == 'IN') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" required  disabled>
                                        <input type="hidden" name="sender_type[]" value="{{$senders1['SENDER_TYPE']}}" id="sender_type_1_hidden">
                                    </td>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase;"><font style="color: #F00;">*</font> Doc Date & Time :</td>
                                    <td style="padding: 0px;">
                                        <input disabled type="date" name='doc_date' value="{{ $documents['DOC_DATE'] }}" class="form-control" style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px; width: 50%; float: left;" data-toggle="tooltip" data-placement="left" title="Documet Date" required>
                                        <input disabled type="time" name='doc_time' value="{{ $documents['DOC_TIME'] }}" class="form-control" style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px; width: 50%; float: left;" data-toggle="tooltip" data-placement="left" title="Documet Time" required>
                                    </td>
                                </tr>

                                @foreach($senders2 as $id => $col)

                                    <tr class="btn-panel-sender">
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Sender {{$id+2}} :</td>
                                        <td style="padding: 0px; ">
                                            <select id="sender_type_2{{$id+1}}_input" class="form-control" name="doc_from[]" style="background-color: #FFF; height: 33px; width: 100%; float: left; font-size: 12px; border-radius: 0px; @if($col->SENDER_TYPE == 'OUT') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" disabled>
                                                <option value=""> Select Insider </option>
                                                @foreach($addresee_list as $addresee_item)
                                                <option value="{{$addresee_item->id}}" @if($col->DOC_SENDER == $addresee_item->id) selected @endif >{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="doc_from[]" class="form-control"  id="sender_type_1{{$id+1}}_input" value="{{$col->DOC_SENDER}}" placeholder="Input Outsider" style="background-color: #FFF; height: 33px; width: 100%; float: left; font-size: 12px; border-radius: 0px; @if($col->SENDER_TYPE == 'IN') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" required disabled>
                                            <input type="hidden" name="sender_type[]" value="{{$col->SENDER_TYPE}}" id="sender_type_1{{$id+1}}_hidden">
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>

                                @endforeach

                                <tr>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Originating Office :</td>
                                    <td style="padding: 0px;" colspan="4">
                                        <input disabled class="form-control" name='doc_origin_office' type="text" value="{{ $documents['ORIGIN_OFFICE'] }}" style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Originating Office"  required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address :</td>
                                    <td style="padding: 0px;" colspan="4">
                                        <input disabled class="form-control" name='doc_address' type="text" value="{{ $documents['DOC_ADDRESS'] }}" style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Address"  required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Subject :</td>
                                    <td style="padding: 0px;" colspan="4">
                                        <input disabled class="form-control" name='doc_subject' type="text" value="{{ $documents['DOC_SUBJ'] }}" style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Subject"  required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Classification :</td>                                                    
                                    <td style="padding: 0px;">
                                         <select disabled class="form-control" type="text" name='doc_classification' style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Classification">
                                            <option value="S" @if($documents['DOC_CLASSIFICATION'] == 'S') selected @endif>Simple </option>
                                            <option value="C" @if($documents['DOC_CLASSIFICATION'] == 'C') selected @endif> Complex </option>
                                        </select>
                                    </td>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Is this Urgent ?</td> 
                                    <td style="padding: 0px;">
                                        <select disabled class="form-control" type="text" name='doc_urgent' style="background-color: #FFF; height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Urgent?">
                                            <option value="N" @if($documents['DOC_URGENT'] == 'N') selected @endif> NO </option>
                                            <option value="Y" @if($documents['DOC_URGENT'] == 'Y') selected @endif> YES </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Particulars / Remarks :</td>
                                    <td style="padding: 0px;" colspan="4">
                                        <textarea disabled class="form-control" name='doc_remarks' style="background-color: #FFF; height: 100px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Remarks">{{ $documents['REMARKS'] }}</textarea>
                                    </td>
                                </tr>

                            </table>

                        </div>

                        <div class="panel panel-default">
                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                <tr>
                                    <td style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase;"><i class="fa fa-history fa-fw"></i> HISTORY LOGS </td>
                                </tr>
                            </table>
                        </div>

                        <div class="panel panel-default">

                            <table class="table table-striped table-bordered table-hover tooltip-demo">

                                <tr style="background-color:#F0FFF0;">
                                    <td style="width:3%; vertical-align: middle; font-size: 14px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"><i class="fa fa-bell"></i></td>
                                    <td style="width:12%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left; padding-left: 15px;">Document From</td>
                                    <td style="width:12%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left; padding-left: 15px;">Document To</td>
                                    <td style="width:7%; vertical-align: middle;font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: center;">Received</td>
                                    <td style="width:7%; vertical-align: middle;font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;">Released</td>
                                    <td style="width:10%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left; padding-left: 15px;">Runtime</td>
                                    <td style="width:40%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left; padding-left: 15px;">Action to be Taken / Remarks</td>
                                    <td style="width:7%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: center;">Action</td>
                                </tr>

                                @foreach($history_logs as $id => $col)

                                    @php

                                        $datetime1 = new DateTime($col->REC_DATE_TIME);
                                        $datetime2 = new DateTime($col->REL_DATE_TIME);
                                        $interval = $datetime1->diff($datetime2);

                                        $days = $interval->format('%d');
                                        $hours = $interval->format('%h');
                                        $minutes = $interval->format('%i');

                                        if($days > 0) {
                                            if($days > 1) { $con_days = $days.' days, '; } 
                                            else if($days == 1) { $con_days = $days.' day, '; }
                                        } else if($days == 0) { $con_days = ''; }

                                        if($hours > 0) {
                                            if($hours > 1) { $con_hours = $hours.' hrs. '; } 
                                            else if($hours == 1) { $con_hours = $hours.' hr. '; }
                                        } else if($hours == 0) { $con_hours = ''; }

                                        if($minutes > 0) {
                                            if($minutes > 1) {
                                                if($hours > 0) { $con_minutes = ' & '.$minutes.' mins. '; } 
                                                else if($hours == 0) { $con_minutes = $minutes.' mins. '; }
                                            } else if($minutes == 1) {
                                                if($hours > 0) { $con_minutes = ' & '.$minutes.' min. '; } 
                                                else if($hours == 0) { $con_minutes = $minutes.' min. '; }
                                            }
                                        } else if($minutes == 0) { $con_minutes = ''; }

                                        $time_consumed = $con_days.' '.$con_hours.' '.$con_minutes;

                                    @endphp

                                    <tr class="log-history">
                                        <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">
                                            @if($col->SEEN == 'Y')  
                                                <div style="width: 10px; height: 10px; border-radius:20px; background: #00CD00; margin: auto;" data-toggle="tooltip" data-placement="left" title="Seen ({{date('m/d/Y H:i A', strtotime($col->SEEN_DATE_TIME))}})"></div> 
                                            @elseif($col->SEEN == 'N') 
                                                <div style="width: 10px; height: 10px; border-radius:20px; background: #F00; margin: auto;" data-toggle="tooltip" data-placement="left" title="Unseen"></div> 
                                            @endif
                                        </td>
                                        <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">
                                            @if($col->FW_NO == 1)  
                                                <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                @foreach($senders3 as $id => $col2)
                                                    @if($col2->SENDER_TYPE == 'IN')
                                                        @php $userinfo = DB::table('users')->where('id','=', $col2->DOC_SENDER)->first(); @endphp
                                                        <li>{{ $userinfo->fname }} {{ $userinfo->lname }}</li>
                                                    @elseif($col2->SENDER_TYPE == 'OUT')
                                                        <li>{{ $col2->DOC_SENDER }}</li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            @else
                                                <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                    <li>{{$col->from_fname}} {{$col->from_lname}}</li>
                                                </ul>
                                            @endif
                                        </td>
                                        <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">
                                            <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                <li>{{$col->to_fname}} {{$col->to_lname}}</li>
                                            </ul>
                                        </td>
                                        <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">{{ date('m/d/Y', strtotime($col->REC_DATE_TIME)) }} <br/> {{ date('h:i A', strtotime($col->REC_DATE_TIME)) }}</td>
                                        <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">{{ date('m/d/Y', strtotime($col->REL_DATE_TIME)) }} <br/> {{ date('h:i A', strtotime($col->REL_DATE_TIME)) }}</td>
                                        <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">{{ $time_consumed }}</td>
                                        <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">@if($col->ACTION != 13){{$col->ACTION}}@endif {{$col->DOC_REMARKS}}</td>
                                        <td style="padding: 0px; text-align: center; vertical-align: middle;">
                                            <a href="javascript:void(0)" class="btn-log-attachment btn btn-default" data-id="{{$col->ID}}" data-id2="{{$col->FW_NO}}" data-id3="{{$col->DOC_NO}}" data-id4="{{$col->DOC_TO}}" data-toggle="tooltip" data-placement="top" title="Attachments" style="font-size: 12px; color: #09C; border-radius: 2px; width: 50%;"><i class="glyphicon glyphicon-paperclip"></i></a>
                                        </td>
                                    </tr>

                                    @if($col->ACTION_STATUS == 0)

                                        @php

                                            $new_datetime1 = new DateTime($col->SEEN_DATE_TIME);
                                            $new_datetime2 = new DateTime(date('Y-m-d H:i:s'));
                                            $new_interval = $new_datetime1->diff($new_datetime2);

                                            $new_days = $new_interval->format('%d');
                                            $new_hours = $new_interval->format('%h');
                                            $new_minutes = $new_interval->format('%i');

                                            if($new_days > 0) {
                                                if($new_days > 1) { $new_con_days = $new_days.' days, '; } 
                                                else if($new_days == 1) { $new_con_days = $new_days.' day, '; }
                                            } else if($new_days == 0) { $new_con_days = ''; }

                                            if($new_hours > 0) {
                                                if($new_hours > 1) { $new_con_hours = $new_hours.' hrs. '; } 
                                                else if($new_hours == 1) { $new_con_hours = $new_hours.' hr. '; }
                                            } else if($new_hours == 0) { $new_con_hours = ''; }

                                            if($new_minutes > 0) {
                                                if($new_minutes > 1) {
                                                    if($new_hours > 0) { $new_con_minutes = ' & '.$new_minutes.' mins. '; } 
                                                    else if($new_hours == 0) { $new_con_minutes = $new_minutes.' mins. '; }
                                                } else if($new_minutes == 1) {
                                                    if($new_hours > 0) { $new_con_minutes = ' & '.$new_minutes.' min. '; } 
                                                    else if($new_hours == 0) { $new_con_minutes = $new_minutes.' min. '; }
                                                }
                                            } else if($new_minutes == 0) { $new_con_minutes = ''; }
                                            $new_time_consumed = $new_con_days.' '.$new_con_hours.' '.$new_con_minutes;

                                        @endphp

                                        @if($col->SEEN_DATE_TIME != NULL)
                                            @php
                                            $rec_date = date('m/d/Y', strtotime($col->SEEN_DATE_TIME));
                                            $rec_time = date('h:i A', strtotime($col->SEEN_DATE_TIME));
                                            $run_time = $new_time_consumed;
                                            @endphp
                                        @else
                                            @php
                                            $rec_date = '';
                                            $rec_time = '';
                                            $run_time = '';
                                            @endphp
                                        @endif

                                        <tr class="log-history">
                                            <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;"></td>
                                            <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">
                                                <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                    <li>{{$col->to_fname}} {{$col->to_lname}}</li>
                                                </ul>
                                            </td>
                                            <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;"></td>
                                            <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">{{$rec_date}}<br/>{{$rec_time}}</td>
                                            <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;"></td>
                                            <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">{{$run_time}}</td>
                                            <td style="text-align:left;padding:7px 7px 7px 15px;vertical-align:middle;font-size:12px;">Pending / No Action Taken</td>
                                            <td style="text-align:left;padding:7px 7px 7px 7px; vertical-align: middle;"></td>
                                        </tr>

                                    @endif

                                @endforeach

                            </table>

                        </div>

                        

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('denr.dts.activity.modal.attachmentModal')
@include('denr.dts.activity.modal.forwardModal')
@include('denr.dts.activity.modal.completeModal')

@include('denr.dts.activity.script.jScriptAttachment')
@include('denr.dts.activity.script.jScriptForward')
@include('denr.dts.activity.script.jScriptComplete')

@endsection