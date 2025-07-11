<?php 

use App\Helpers\Helper;
$doc_class = helper::doc_class();
$icon_class = helper::icon_class();

$user = Auth::user();
$user_type = $user->user_type;
$user_role = $user->user_role;

?>
@inject('helper', 'App\Helpers\Helper')

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

                {{-- SIR JORDAN CODE --}}
                {{-- <li>
                    <a href="{{ route('dts.document.acted') }}"><i class="fa fa-paper-plane fa-fw"></i> Acted</a>
                </li>
                <li>
                    <a href="{{ route('dts.document.completed') }}"><i class="fa fa-check-square fa-fw"></i> Completed</a>
                </li> --}}
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
                                        
                                        @if($can_end_new)
                                        <a href="javascript:void(0)" class="btn-complete btn btn-default" data-id="{{$documents->DOC_NO}}" data-id2="{{$documents->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="End" style="font-size: 12px; color: #3D9140; border-radius: 2px; width: 37px; float: right; margin-left: 2px; "><i class="glyphicon glyphicon-saved"></i> </a>
                                        @endif
                                        @if($can_forward_new)
                                        <a href="javascript:void(0)" class="btn-forward btn btn-default" data-id="{{$documents->DOC_NO}}" data-id2="{{$documents->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="Forward" alt="Forward" style="font-size: 12px; color: #09C; border-radius: 2px; width: 37px; float: right; margin-left: 2px; "><i class="fa fa-send"></i> </a>
                                        @endif
                                        @if($can_recall_new)
                                        <a href="javascript:void(0)" class="btn-recall btn btn-default" data-id="{{$documents->DOC_NO}}" data-id3="{{$documents->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="RECALL" alt="RECALL" style="font-size: 12px; color: #a30000; border-radius: 2px; width: 37px; float: right; margin-left: 2px; "><i class="fa fa-reply"></i></a>
                                        @endif
                                        @if($can_edit_new)
                                        <a href="javascript:void(0)" class="btn-edit btn btn-default" data-id="{{$documents->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="EDIT DETAILS" alt="EDIT DETAILS" style="font-size: 12px; color: #03769d; border-radius: 2px; width: 37px; float: right; margin-left: 2px; "><i class="fa fa-edit fa-lg"></i> </a>
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
                                            <option value="HT" @if($documents['DOC_CLASSIFICATION'] == 'HT') selected @endif> Highly Technical </option>
                                            <option value="HT(MSP)" @if($documents['DOC_CLASSIFICATION'] == 'HT(MSP)') selected @endif> Highly Technical (Multi-Stage Processing) </option>
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

                                {{-- <tr>
                                    <td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Particulars / Remarks :</td>
                                    <td style="padding: 0px;" colspan="4">
                                        <textarea disabled class="form-control" name='doc_remarks' style="background-color: #FFF; height: 100px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Remarks">{{ $documents['REMARKS'] }}</textarea>
                                    </td>
                                </tr> --}}

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
                                    <td style="width:20%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left; padding-left: 15px;">Action to be Taken</td>
                                    <td style="width:20%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left; padding-left: 15px;">Remarks</td>
                                    <td style="width:7%; vertical-align: middle; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: center;">Action</td>
                                </tr>


                                {{-- @php 
                                    $logs = $history_logs->sortBy('FW_NO')->values()->toArray();
                                    $sorted_logs = [];
                                    $starting_points = collect($logs)->where('FW_NO', 1)->values();

                                    foreach ($starting_points as $start) {
                                        $current_doc_to = $start['DOC_TO'];
                                        $fw_no = 2;
                                        $sorted_logs[] = $start;
                                        $logs = collect($logs)->reject(function($item, $key) use ($start){
                                            return $item['ID'] == $start['ID'];
                                        })->toArray();
                                        while (true) {
                                            $next_entry = collect($logs)
                                                ->where('FW_NO', $fw_no)
                                                ->where('DOC_FROM', $current_doc_to)
                                                ->first();

                                            if (!$next_entry) {
                                                break; // Stop if no matching next step is found
                                            }
                                            
                                            $sorted_logs[] = $next_entry;
                                            $current_doc_to = $next_entry['DOC_TO'];
                                            $fw_no++; // Move to the next FW_NO
                                            $logs = collect($logs)->filter(function($item) use ($next_entry){
                                                return $item['ID'] != $next_entry['ID'];
                                            })->toArray();
                                        }
                                    }
                                    
                                    // Step 6: Append any remaining entries that didn't fit into the sequence
                                    $remaining_logs = collect($logs)->reject(function ($item) use ($sorted_logs) {
                                        return in_array($item, $sorted_logs);
                                    });

                                    $sorted_logs = array_merge($sorted_logs, $remaining_logs->toArray());

                                    $_tmp_logs = collect($sorted_logs)->map(function($item) use ($history_logs){
                                        return $history_logs->where('ID', $item['ID'])->first();
                                    });
                                @endphp --}}
                                
                                {{-- 4-15-2025 --}}
                                @php 
                                    $logs = $history_logs->sortBy('FW_NO')->values()->toArray();
                                    $sorted_logs = [];
                                    $starting_points = collect($logs)->where('FW_NO', 1)->values();

                                    for ($i = 1; $i < collect($logs)->max('FW_NO'); $i++) {
                                        foreach(collect($logs)->where('FW_NO', $i)->values() as $start){
                                            $curr = $start;
                                            $current_doc_to = $curr['DOC_TO'];
                                            $fw_no = $i + 1;
                                            $sorted_logs[] = $curr;
                                            $logs = collect($logs)->reject(function($item, $key) use ($start){
                                                return $item['ID'] == $start['ID'];
                                            })->toArray();
                                            while (true) {
                                                $next_entry = collect($logs)
                                                    ->where('FW_NO', $fw_no)
                                                    ->where('DOC_FROM', $current_doc_to)
                                                    // ->where('DOC_DT_LOG', $curr['FOR_DATE_TIME'])
                                                    ->first();
    
                                                if (!$next_entry) {
                                                    break; // Stop if no matching next step is found
                                                }
                                                
                                                $sorted_logs[] = $next_entry;
                                                $curr = $next_entry;
                                                $current_doc_to = $next_entry['DOC_TO'];
                                                $fw_no++; // Move to the next FW_NO
                                                $logs = collect($logs)->filter(function($item) use ($next_entry){
                                                    return $item['ID'] != $next_entry['ID'];
                                                })->toArray();
                                            }
                                        }
                                    }
                                    
                                    // Step 6: Append any remaining entries that didn't fit into the sequence
                                    $remaining_logs = collect($logs)->reject(function ($item) use ($sorted_logs) {
                                        return in_array($item, $sorted_logs);
                                    });

                                    $sorted_logs = array_merge($sorted_logs, $remaining_logs->toArray());

                                    $_tmp_logs = collect($sorted_logs)->map(function($item) use ($history_logs){
                                        return $history_logs->where('ID', $item['ID'])->first();
                                    });
                                @endphp

                                {{-- @php

                                    $datetime1 = new DateTime($col->REC_DATE_TIME);
                                    $datetime2 = new DateTime($col->REL_DATE_TIME);
                                    $interval = $datetime1->diff($datetime2);

                                    $days = $interval->format('%d');
                                    $hours = $interval->format('%h');
                                    $minutes = $interval->format('%i');

                                    $checker = $datetime1->format('%h %i') != $datetime2->format('%h %i');

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
                                            if($hours > 0) { 
                                                $con_minutes = ' & '.$minutes.' mins. '; 
                                            } else if($hours == 0) { 
                                                $con_minutes = $minutes.' mins. '; 
                                            }
                                        } else if($minutes == 1) {
                                            if($hours > 0) { 
                                                $con_minutes = ' & '.$minutes.' min. '; 
                                            }  else if($hours == 0) { 
                                                $con_minutes = $minutes.' min. '; 
                                            }
                                        }
                                    } else if($minutes == 0) { $con_minutes = ($checker && $interval->format('%s') > 0) ? 1 . ' min' : ""; }

                                    $time_consumed = $con_days.' '.$con_hours.' '. $con_minutes;

                                @endphp --}}


                                @foreach($history_logs as $id => $col)
                                {{-- @foreach($_tmp_logs as $id => $col) --}}

                                    @php
                                        $time_consumed = $helper->computeRunTime($col->REC_DATE_TIME, $col->REL_DATE_TIME);

                                    @endphp

                                    <tr class="log-history" >
                                        <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">{{--{{ $col->ID }} {{ $col->FW_NO }}--}}
                                            @if($col->SEEN == 'Y')  
                                                {{--<div style="width: 10px; height: 10px; border-radius:20px; background: #00CD00; margin: auto;" data-toggle="tooltip" data-placement="left" title="Seen ({{date('m/d/Y H:i A', strtotime($col->SEEN_DATE_TIME))}})"></div> --}}
                                                <i class="fa fa-check-circle" style="color: #00CD00;" data-toggle="tooltip" data-placement="left" title="Seen ({{date('m/d/Y H:i A', strtotime($col->SEEN_DATE_TIME))}})" alt="Seen ({{date('m/d/Y H:i A', strtotime($col->SEEN_DATE_TIME))}})"></i>
                                            @elseif($col->SEEN == 'N') 
                                                <div style="width: 10px; height: 10px; border-radius:20px; background: #F00; margin: auto;" data-toggle="tooltip" data-placement="left" title="Unseen"></div> 
                                            @endif
                                        </td>
                                        <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">
                                            {{--{{$col->ID}} - {{ $first_log_id }}--}}
                                            {{--{{$col->DOC_FROM}}--}} 
                                            @if($col->FW_NO == 1)
                                                <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                @foreach($senders3 as $id => $col2)
                                                    @if($col2->SENDER_TYPE == 'IN')
                                                        @php $user_id = ($first_log_id==$col->ID) ? $col2->DOC_SENDER : $col->DOC_FROM; @endphp
                                                        @php $userinfo = DB::table('users')->where('id','=', $user_id)->first(); @endphp
                                                        <li>{{ $userinfo->fname }} {{ $userinfo->lname }}</li>
                                                    @elseif($col2->SENDER_TYPE == 'OUT')
                                                        @if($first_log_id==$col->ID)
                                                        <li>{{ $col2->DOC_SENDER }}</li>
                                                        @else
                                                        @php $userinfo = DB::table('users')->where('id','=', $col->DOC_FROM)->first(); @endphp
                                                        <li>{{ $userinfo->fname }} {{ $userinfo->lname }}</li>
                                                        @endif
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
                                                <li>{{--{{$col->DOC_TO}}--}} {{$col->to_fname}} {{$col->to_lname}}</li>
                                            </ul>
                                        </td>
                                        <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">
                                            {{ ($col->REC_DATE_TIME) ? date('m/d/Y', strtotime($col->REC_DATE_TIME)) : "" }} <br/> 
                                            {{ ($col->REC_DATE_TIME) ? date('h:i A', strtotime($col->REC_DATE_TIME)) : "" }}
                                        </td>
                                        <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">
                                            {{ date('m/d/Y', strtotime($col->REL_DATE_TIME)) }} <br/> {{ date('h:i A', strtotime($col->REL_DATE_TIME)) }}
                                        </td>
                                        <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">{{ ($col->REC_DATE_TIME) ? $time_consumed : "" }}</td>
                                        <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">@if($col->ACTION != 13){{$col->ACTION}}@endif</td>
                                        <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">{{$col->DOC_REMARKS}}</td>
                                        <td style="padding: 0px; text-align: center; vertical-align: middle;">
                                            @if($col->ACTION_STATUS==0 && $col->DOC_FROM==$user->id && $col->ACTION_TO_BE_TAKEN!=35)
                                            <a href="javascript:void(0)" class="btn-recall2 btn btn-default" data-id="{{$col->ID}}" data-id2="{{$col->DOC_NO}}" data-id3="{{$col->DOC_CATEGORY}}" data-id4="{{$col->to_fname}} {{$col->to_lname}}" data-toggle="tooltip" data-placement="top" title="RECALL" style="font-size: 12px; color: #a30000; border-radius: 2px;"><i class="fa fa-reply"></i></a>
                                            @endif
                                            <a href="javascript:void(0)" class="btn-log-attachment btn btn-default" data-id="{{$col->ID}}" data-id2="{{$col->FW_NO}}" data-id3="{{$col->DOC_NO}}" data-id4="{{$col->DOC_TO}}" data-toggle="tooltip" data-placement="top" title="Attachments" style="font-size: 12px; color: #09C; border-radius: 2px; width: 50%;"><i class="glyphicon glyphicon-paperclip"></i></a>
                                        </td>
                                    </tr>

                                    @if($col->ACTION_STATUS == 0)

                                        @php
                                            $now = date('m/d/Y H:i:s');
                                            $rcvd_dt = $col->REL_DATE_TIME;
                                            $rcvd_d = date('m/d/Y', strtotime($rcvd_dt));
                                            $rcvd_t = date('h:i A', strtotime($rcvd_dt));
                                            $rcvd_runtime = $helper->computeRunTime($rcvd_dt, $now);

                                            $new_time_consumed = $helper->computeRunTime($col->SEEN_DATE_TIME, $col->FOR_DATE_TIME);
                                        @endphp

                                        @if($col->SEEN_DATE_TIME != NULL)
                                            @php

                                            $rec_date = date('m/d/Y', strtotime($col->SEEN_DATE_TIME));
                                            $rec_time = date('h:i A', strtotime($col->SEEN_DATE_TIME));

                                            $rel_date = ($col->FOR_DATE_TIME) ? date('m/d/Y', strtotime($col->FOR_DATE_TIME)) : "";
                                            $rel_time = ($col->FOR_DATE_TIME) ? date('h:i A', strtotime($col->FOR_DATE_TIME)) : "";

                                            $run_time = $new_time_consumed;
                                            @endphp
                                        @else
                                            @php

                                            $rec_date = '';
                                            $rec_time = '';

                                            $rel_date = '';
                                            $rel_time = '';

                                            $run_time = '';
                                            @endphp
                                        @endif

                                        <tr class="log-history">
                                            <td rowspan="2" style="text-align:center;padding:2px 7px 2px 7px;vertical-align:middle;font-size:12px;">{{--{{ $col->ID }}--}}</td>
                                            <td rowspan="2" style="text-align:left;padding:2px 7px 2px 7px;vertical-align:middle;font-size:12px;">
                                                <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                    <li>{{$col->to_fname}} {{$col->to_lname}}</li>
                                                </ul>
                                            </td>
                                            <td rowspan="2" style="text-align:left;padding:2px 7px 2px 7px;vertical-align:middle;font-size:12px;"></td>
                                            <td style="text-align:center;padding:2px 7px 2px 7px;vertical-align:middle;font-size:12px;">{{$rcvd_d}}<br/>{{$rcvd_t}}</td>
                                            <td style="text-align:center;padding:2px 7px 2px 7px;vertical-align:middle;font-size:12px;">{{$rel_date}}<br/>{{$rel_time}}</td>
                                            <td style="text-align:left;padding:2px 7px 2px 15px;vertical-align:middle;font-size:12px;">{{$rcvd_runtime}}</td>
                                            <td rowspan="2" style="text-align:left;padding:2px 7px 2px 15px;vertical-align:middle;font-size:12px;"></td>
                                            <td rowspan="2" style="text-align:left;padding:2px 7px 2px 15px;vertical-align:middle;font-size:12px;"></td>
                                            <td rowspan="2" style="padding: 0px; text-align: center; vertical-align: middle;">
                                                @if($col->DOC_TO == $user->id && $history_logs->where("ACTION_TO_BE_TAKEN", "<>", 14)->where("DOC_TO", $user->id)->count() > 1)
                                                    <a href="javascript:void(0)" class="btn-forward btn btn-default" data-id="{{$col->DOC_NO}}" data-id2="{{$col->DOC_CATEGORY}}" data-log-id="{{$col->ID}}"  data-toggle="tooltip" data-placement="top" title="FORWARD" style="font-size: 12px; color: #09C; border-radius: 2px;"><i class="fa fa-paper-plane"></i></a>
                                                    <a href="javascript:void(0)" class="btn-complete btn btn-default" data-id="{{$documents->DOC_NO}}" data-id2="{{$documents->DOC_CATEGORY}}" data-log-id="{{$col->ID}}" data-toggle="tooltip" data-placement="top" title="END" style="font-size: 12px; color: #00CD00; border-radius: 2px;"><i class="fa fa-check"></i></a>
                                                @endif
                                                @if ($col->ACTION_STATUS==0 && $col->DOC_FROM==$user->id)
                                                <a href="javascript:void(0)" class="btn-followup btn btn-default" data-log-id="{{$col->ID}}" data-id="{{$col->ID}}" data-id2="{{$col->DOC_NO}}" data-id3="{{$col->DOC_CATEGORY}}" data-id4="{{$col->to_fname}} {{$col->to_lname}}" data-toggle="tooltip" data-placement="top" title="FOLLOW UP" style="font-size: 12px; color: #e7b511; border-radius: 2px;"><i class="fa fa-bell"></i></a>
                                                @endif
                                                {{-- {{$col}} --}}
                                            </td>
                                        </tr>
                                        <tr class="log-history">
                                            <td style="text-align:center;padding:2px 7px 2px 7px;vertical-align:middle;font-size:12px;"><b>Viewed on:</b><br>{{$rec_date}}<br/>{{$rec_time}}</td>
                                            <td style="text-align:center;padding:2px 7px 2px 7px;vertical-align:middle;font-size:12px;"></td>
                                            <td style="text-align:left;padding:2px 7px 2px 15px;vertical-align:middle;font-size:12px;border-right: 1px solid #ddd!important;">{{$run_time}}</td>
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
@include('denr.dts.activity.modal.recallModal')
@include('denr.dts.activity.modal.followupModal')
@include('denr.dts.activity.modal.editModal')

@include('denr.dts.activity.script.jScriptAttachment')
@include('denr.dts.activity.script.jScriptForward')
@include('denr.dts.activity.script.jScriptComplete')
@include('denr.dts.activity.script.jScriptRecall')
@include('denr.dts.activity.script.jScriptFollowup')
@include('denr.dts.activity.script.jScriptEdit')

@endsection