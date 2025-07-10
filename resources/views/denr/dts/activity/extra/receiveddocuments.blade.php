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

                @php

                $user = Auth::user();
                $user_type = $user->user_type;

                @endphp

            </div>

            <div class="row">
                
                <div class="col-lg-12">
                    
                    <div class="panel panel-default" style="padding-top: 12px;">
                        
                        <ul class="nav nav-tabs" style="font-size: 11px; text-transform: uppercase;">

                            @if($user_type != '3')

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
                                <a href="{{ route('received.documents') }}"><i class="fa fa-arrow-down fa-fw"></i> Received Document</a>
                            </li>

                            <li>
                                <a href="{{ route('forwarded.documents') }}"><i class="fa fa-arrow-up fa-fw"></i> Forwarded Document</a>
                            </li>

                            @elseif($user_type == '3')
                            
                            <li class="active" style="margin-left: 12px;">
                                <a href="{{ route('received.documents') }}"><i class="fa fa-arrow-down fa-fw"></i> Received Document</a>
                            </li>

                            <li>
                                <a href="{{ route('forwarded.documents') }}"><i class="fa fa-arrow-up fa-fw"></i> Forwarded Document</a>
                            </li>

                            @endif

                            

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">

                                    <div class="panel panel-default">

                                        <table class="table table-striped table-bordered table-hover tooltip-demo">
                                            <tr>
                                                <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase;"><i class="fa fa-arrow-down fa-fw"></i> RECEIVED DOCUMENT <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                            </tr>
                                        </table>

                                    </div>

                                    <div class="panel panel-default">

                                        <table class="table table-striped table-bordered table-hover tooltip-demo">

                                            <tr>
                                                <td style="width:4%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>
                                                <td style="width:8%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold;">Doc. No.</td>
                                                <td style="width:7%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Status</td>
                                                <td style="width:7%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Doc. Date</td>
                                                <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Subject</td>
                                                <td style="width:7%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Urgent?</td>
                                                <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold;">From</td>
                                                <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold;">Date Received</td>
                                                <td style="width:15%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Remarks</td>
                                                <td style="width:15%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Action</td>
                                            </tr>

                                            @if($doc_count > 0)

                                                @foreach($doc_received as $id => $record)

                                                    @php

                                                        $code = Crypt::encrypt($record->DOC_NO);

                                                        $from = DB::table('users')->where('id', '=', $record->DOC_FROM)->first();

                                                    @endphp

                                                    <tr>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; ">{{$id+1}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{$record->DOC_NO}}</td>
                                                        <td style="font-size: 11px; color: @if($record->STATUS == 'N') green @elseif($record->STATUS == 'F') blue @endif; text-align: left; ">@if($record->STATUS == 'N') New @elseif($record->STATUS == 'F') Forwarded @endif</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{date('m/d/Y', strtotime($record->DOC_DATE))}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{$record->DOC_SUBJ}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">@if($record->DOC_URGENT == 'Y') Yes @elseif($record->DOC_URGENT == 'N') No @endif</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{$from->fname}} {{$from->lname}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{date('m/d/Y H:i A', strtotime($record->DOC_DT_LOG))}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{$record->DOC_REMARKS}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; vertical-align: middle; padding: 0px;" >
                                                            <a href='{{url("/dts/activity/incomingdocument/edit/".$code."/B")}}' class="btn btn-default" data-toggle="tooltip" data-placement="top" title="View" style="font-size: 12px; color: green; border-radius: 2px; width: 23%; "><i class="fa fa-edit"></i></a>
                                                            <a href="javascript:void(0)" class="btn-history btn btn-default" data-id="{{$record->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="History Logs" style="font-size: 12px; color: #F00; border-radius: 2px; width: 23%;"><i class="fa fa-undo"></i></a>
                                                            @if($record->STATUS == 'N')<a href="javascript:void(0)" class="btn-forward btn btn-default" data-id="{{$record->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="Forward" class="btn btn-default" style="font-size: 12px; color: #09C; border-radius: 2px; width: 23%; "><i class="fa fa-send"></i></a>@endif
                                                            <a href="javascript:void(0)" class="btn-attachment btn btn-default" data-id="{{$record->DOC_NO}}" data-id2="{{$record->SEND_TYPE}}" data-toggle="tooltip" data-placement="top" title="Forwarded Attchment" style="font-size: 12px; color: #000; border-radius: 2px; width: 23%;"><i class="fa fa-file-text-o"></i></a>
                                                        </td>
                                                    </tr>

                                                @endforeach

                                            @elseif($doc_count == 0)

                                                <tr>
                                                    <td colspan='10' style="width:150px; font-size: 11px; color: #5B5B5B; text-align: left; padding-left: 20px; ">NO RESULTS FOUND</td>
                                                </tr>

                                            @endif


                                               
                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @include('denr.dts.activity.forwardModal')
            @include('denr.dts.activity.historyModal')
            @include('denr.dts.activity.forwardedAttachmentModal')

@endsection