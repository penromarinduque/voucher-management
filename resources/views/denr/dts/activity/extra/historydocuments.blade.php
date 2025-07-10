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

                            <li class="active">
                                <a href="{{ route('received.documents') }}"><i class="fa fa-undo fa-fw"></i> Document History Logs</a>
                            </li>

                            <li>
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
                                                    <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase;"><i class="fa fa-navicon fa-fw"></i> DOCUMENT HISTORY LOGS<a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">

                                              
                                                <tr>
                                                    <td style="width:50px; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold;">Date & Time Log</td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">From</td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">To</td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Remarks</td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Seen</td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Time Duration</td>
                                                </tr>

                                            
                                                @foreach($doc_logs as $id => $record)

                                                    @php 

                                                    $code = Crypt::encrypt($record->DOC_NO);

                                                    $from = DB::table('users')->where('id', '=', $record->DOC_FROM)->first();
                                                    $to = DB::table('users')->where('id', '=', $record->DOC_TO)->first();

                                                    @endphp

                                                    <tr>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; ">{{$id+1}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{date('m/d/Y H:i A', strtotime($record->DOC_DT_LOG))}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{$from->fname}} {{$from->lname}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{$to->fname}} {{$to->lname}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">{{$record->DOC_REMARKS}}</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; ">@if($record->SEEN=='N') No @elseif($record->SEEN=='Y') Yes @endif</td>
                                                        <td style="font-size: 11px; color: #5B5B5B; text-align: middle; "></td>
                                                    </tr>

                                                @endforeach

                                            </table>

                                        </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

@endsection