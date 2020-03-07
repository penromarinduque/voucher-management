<?php $user = Auth::user(); ?>

@extends('denr.layouts.window')

@section('page-css')

@endsection

@section('page-content')

    <div class="row">
        
        <div class="col-lg-12">
            
            <div class="panel panel-default" style="padding-top: 12px;">

                <div class="panel-body">

                    <div class="row"> 

                        <div class="col-lg-12">

                            <a href="" onClick="window.close();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Close"><i class="fa fa-times"></i> CLOSE</button></a>
                            <a href="" onclick="window.print();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Print Travel Order"><i class="fa fa-print"></i> PRINT</button></a>
                            
                            <div style="width:1000px; margin:auto; padding:20px; font-family: Times New Roman;">

                                <div style="width: 1000px; margin-bottom: 10px; margin-top: -30px;">
                                    <img src="{{URL::asset('/img/denr_logo.png')}}" width="120" height="120"  style="margin-bottom:-100px;" />
                                    <div style="width: 1000px; padding-left: 130px; font-size:20px; line-height: 23px; font-weight: bold;">
                                        <font style="color: #000;"> Republic of the Philippines </font><br/>
                                        <font style="color: green;"> Department of Environment and Natural Resources </font><br/>
                                        <font style="color: green;"> Provincial Environment and Natural Resources Office </font><br/>
                                        <font style="color: #09C;"> Boac, Marinduque </font>
                                    </div>
                                </div>

                                <hr style="height: 5px; background-color: purple;"/>

                                <table style="line-height: 30px; font-size: 16px; width: 100%; font-family: arial;">
                                    <tr>
                                        <td colspan="2" style="text-align: center; font-weight: bold; font-size: 20px"> PENRO DOCUMENT ACTION AND TRACKING SLIP</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center; font-weight: bold;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding:20px 0px 20px 0px; font-weight: bold; font-size: 14px; text-transform: uppercase;">Document Information</td>
                                    </tr>
                                    <tr>
                                        <td ></td>
                                        <td style="width: 350px;">Encoded By: &nbsp; <font style="font-weight: bold; width: 300px;">{{ $doc_user->fname }} {{ $doc_user->lname }}</font></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 430px;">Document Category: &nbsp; <font style="width: 300px; font-weight: bold;">@if($documents['DOC_CATEGORY'] == 'IN') Incoming @elseif($documents['DOC_CATEGORY'] == 'OUT') Outgoing @endif</font></td>
                                        <td>Document Type: &nbsp; <font style="font-weight: bold; width: 300px;"> {{ $doc_type->TYPE_NAME }}</font></td>
                                    </tr>
                                    <tr>
                                        <td>Document No.: &nbsp; <font style="font-weight: bold; width: 300px;"> {{ $documents['DOC_NO'] }} </font></td>
                                        <td>Control Code: &nbsp; <font style="font-weight: bold; width: 300px;">{{ $documents['CONTROL_CODE'] }}</font></td>
                                    </tr>
                                    <tr>
                                        <td>Sender/s: &nbsp; 
                                            <font style="font-weight: bold; width: 300px;">
                                                <ul>
                                                    @foreach($senders2 as $id => $col)
                                                        @if($col->SENDER_TYPE == 'IN')
                                                            @php $userinfo = DB::table('users')->where('id','=', $col->DOC_SENDER)->first(); @endphp
                                                            <li>{{ $userinfo->fname }} {{ $userinfo->lname }}</li>
                                                        @elseif($col->SENDER_TYPE == 'OUT')
                                                            <li>{{ $col->DOC_SENDER }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </font>
                                        </td>
                                        <td style="vertical-align: top;"> Date & Time Received: &nbsp; <font style="font-weight: bold; width: 300px;">{{ date('m/d/Y', strtotime($documents['DOC_DATE'])) }} {{ date('h:i A', strtotime($documents['DOC_TIME'])) }}</font></td>
                                    </tr>
                                    <tr>
                                        <td> Originating Office: &nbsp; <font style="font-weight: bold; width: 300px;">{{ $documents['ORIGIN_OFFICE'] }}</font></td>
                                        <td> Address: &nbsp; <font style="font-weight: bold; width: 300px;">{{ $documents['DOC_ADDRESS'] }}</font></td>
                                    </tr>
                                    <tr>
                                        <td> Classification: &nbsp; <font style="font-weight: bold; width: 300px;">@if($documents['DOC_CLASSIFICATION'] == 'S') Simple @elseif($documents['DOC_CLASSIFICATION'] == 'C') Complex @endif</font></td>
                                        <td> Is This Urgent?: &nbsp; <font style="font-weight: bold; width: 300px;">@if($documents['DOC_URGENT'] == 'Y') Yes @elseif($documents['DOC_URGENT'] == 'N') No @endif</font></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> Subject: &nbsp; <font style="font-weight: bold; width: 300px;">{{ $documents['DOC_SUBJ'] }}</font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="padding:20px 0px 20px 0px; font-weight: bold; font-size: 14px; text-transform: uppercase;">History Logs</td>
                                    </tr>
                                    
                                </table>


                                <table border="1" style="font-size: 16px; width: 100%; font-family: arial; margin-top: -10px;">

                                    <tr style="background-color:#EBEBEB;">
                                        <td style="width:13%; padding: 5px;vertical-align: middle; font-size: 12px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;">Doc. From</td>
                                        <td style="width:13%; padding: 5px;vertical-align: middle; font-size: 12px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;">Doc. To</td>
                                        <td style="width:10%; padding: 5px;vertical-align: middle;font-size: 12px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: center;">Received</td>
                                        <td style="width:10%; padding: 5px;vertical-align: middle;font-size: 12px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"> Released</td>
                                        <td style="width:12%; padding: 5px;vertical-align: middle; font-size: 12px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;">Runtime</td>
                                        <td style="width:42%; padding: 5px;vertical-align: middle; font-size: 12px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;">Action to be taken / Remarks</td>
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
                                            <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px;">
                                                @if($col->FW_NO == 1)  
                                                    <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                    @foreach($senders2 as $id => $col2)
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
                                            <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px;">
                                                <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                    <li>{{$col->to_fname}} {{$col->to_lname}}</li>
                                                </ul>
                                            </td>
                                            <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px;">{{ date('m/d/Y', strtotime($col->REC_DATE_TIME)) }} <br/> {{ date('h:i A', strtotime($col->REC_DATE_TIME)) }}</td>
                                            <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px;">{{ date('m/d/Y', strtotime($col->REL_DATE_TIME)) }} <br/> {{ date('h:i A', strtotime($col->REL_DATE_TIME)) }}</td>
                                            <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:14px;">{{ $time_consumed }}</td>
                                            <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:14px;">@if($col->ACTION != 13){{$col->ACTION}}@endif {{$col->DOC_REMARKS}}</td>
                                        </tr>

                                        <tr class="log-history">
                                            <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px; height: 650px;"></td>
                                            <td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px;"></td>
                                            <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px;"></td>
                                            <td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:14px;"></td>
                                            <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:14px;"></td>
                                            <td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:14px;"></td>
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