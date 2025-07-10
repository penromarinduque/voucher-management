@extends('denr.layouts.window')

@section('page-css')

@endsection

@section('page-content')

            <div class="row">
                
                <div class="col-lg-12">
                    
                        <div class="panel-body">

                            <a onClick="window.close();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Close"><i class="fa fa-times"></i> CLOSE</button></a>
                            <a onclick="window.print();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Print Travel Order"><i class="fa fa-print"></i> PRINT</button></a>
                                        

                            <!-- <div style="width: 1000px; margin-bottom: 10px; font-family: Times New Roman;"> -->
                                {{--<img src="{{URL::asset('/img/denr_logo.png')}}" width="120" height="120"  style="margin-bottom:-100px; margin-left: 0px;" />--}}
                                <!-- <div style="width: 1000px; padding-left: 130px; font-size:20px; line-height: 23px; font-weight: bold;"> -->
                                    <!-- <font style="color: #000;"> Republic of the Philippines </font><br/> -->
                                    <!-- <font style="color: green;"> Department of Environment and Natural Resources </font><br/> -->
                                    <!-- <font style="color: green;"> Provincial Environment and Natural Resources Office </font><br/> -->
                                    <!-- <font style="color: #09C;"> Boac, Marinduque </font> -->
                                <!-- </div> -->
                            <!-- </div> -->

                            <!-- <hr style="height: 5px; background-color: #993366;"/> -->
                            <center><img src="{{URL::asset('/img/header2.png')}}" width="50%" /></center>
                            <div style="border: 2px solid #993366; height: 5;"></div><br>
                            <font style="font-weight: bold; font-size: 16px;">DOCUMENT REPORT</font><br/>
                            <font style="font-weight: 100; font-size: 14px;">{{$doc_category}} </font>
                            
                            <table class="table table-striped table-bordered table-hover tooltip-demo" style="background-color: #FFF; margin-top: 15px;">
                                
                                <thead>

                                    <tr style="font-size: 11px; text-transform: uppercase; ">
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">DOC. NO.</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">DATE</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">TIME</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">TYPE</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">CONTROL CODE</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">ORIGINATING OFFICE</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">ADDRESS</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">SUBJECT</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">CLASSIFICATION</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">URGENT?</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">SIGNED?</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">REMARKS</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">STATUS</th>
                                        @if($doc_trail == 'Y')
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">ENCODED BY</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">SIGNED BY</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">DATE SIGNED</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">COMPLETED BY</th>
                                        <th style="padding: 5px 10px 5px 10px; vertical-align: middle;">DATE COMPLETED</th>
                                        @endif
                                    </tr>

                                </thead>

                                <tbody>
                                
                                @if($doc_count > 0)

                                    @foreach($documents as $id => $col)

                                        @php

                                        $encoded = DB::table('users')->where('id','=', $col->CREATED_BY)->first();
                                        $signed = DB::table('users')->where('id','=', $col->SIGNED_BY)->first();
                                        $completed = DB::table('users')->where('id','=', $col->COMPLETED_BY)->first();

                                        @endphp

                                        <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                            <td style="padding: 3px 10px 3px 10px; ">{{$col['DOC_NO']}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{date('m/d/Y', strtotime($col->DOC_DATE))}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{date('H:i A', strtotime($col->DOC_TIME))}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{$col['TYPE_NAME']}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{$col['CONTROL_CODE']}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{$col['ORIGIN_OFFICE']}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{$col['DOC_ADDRESS']}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{$col['DOC_SUBJ']}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col['DOC_CLASSIFICATION'] == 'S') Simple @elseif($col['DOC_CLASSIFICATION'] == 'C') Complex @endif</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col['DOC_URGENT'] == 'Y') Yes @elseif($col['DOC_URGENT'] == 'N') No @endif</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col['SIGNED'] == 'Y') Yes @elseif($col['SIGNED'] == 'N') No @endif</td>
                                            <td style="padding: 3px 10px 3px 10px; ">{{$col['REMARKS']}}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col['STATUS'] == 'F') Forwarded @elseif($col['STATUS'] == 'C') Completed @endif</td>
                                            @if($doc_trail == 'Y')
                                            <td style="padding: 3px 10px 3px 10px; ">{{ $encoded->fname }} {{ $encoded->lname }}</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col->SIGNED_BY != NULL) {{ $signed->fname }} {{ $signed->lname }} @endif</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col->DATE_SIGNED != NULL) {{date('m/d/Y', strtotime($col->DATE_SIGNED))}} @endif</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col->COMPLETED_BY != NULL) {{ $completed->fname }} {{ $completed->lname }} @endif</td>
                                            <td style="padding: 3px 10px 3px 10px; ">@if($col->DATE_COMPLETED != NULL) {{date('m/d/Y', strtotime($col->DATE_COMPLETED))}} @endif</td>
                                            @endif
                                        </tr>

                                        @if($doc_history == 'Y')

                                            <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                                <th></th>
                                                <th style="padding: 5px 10px 5px 10px; vertical-align: middle;" colspan="2">DOCUMENT FROM</th>
                                                <th style="padding: 5px 10px 5px 10px; vertical-align: middle;" colspan="2">DOCUMENT TO</th>
                                                <th style="padding: 5px 10px 5px 10px; vertical-align: middle;" >DATE & TIME RECEIVED</th>
                                                <th style="padding: 5px 10px 5px 10px; vertical-align: middle;" >DATE & TIME RELEASED</th>
                                                <th style="padding: 5px 10px 5px 10px; vertical-align: middle;" >DOCUMENT RUN TIME</th>
                                                <th style="padding: 5px 10px 5px 10px; vertical-align: middle;" colspan="2">ACTION TO BE TAKEN</th>
                                                <th style="padding: 5px 10px 5px 10px; vertical-align: middle;" colspan="3">ATTACHMENT</th>
                                            </tr>

                                            @php

                                            $doc_details = DB::table('dts_document_record')
                                                       ->select('dts_document_logs.*', 'dts_document_record.*', 'user_from.fname as from_fname', 'user_from.lname as from_lname', 'user_to.fname as to_fname', 'user_to.lname as to_lname')
                                                       ->leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                                                       ->join('users as user_from','dts_document_logs.DOC_FROM','=','user_from.id')
                                                       ->join('users as user_to','dts_document_logs.DOC_TO','=','user_to.id')
                                                       ->where('dts_document_logs.DOC_NO','=', $col['DOC_NO'])
                                                       ->orderBy('dts_document_logs.ID', 'ASC')
                                                       ->get();

                                            $senders3 = DB::table('dts_document_sender')->where('DOC_NO', '=', $col['DOC_NO'])->orderBy('DOC_SENDER', 'ASC')->get();

                                            @endphp

                                            @foreach($doc_details as $id => $col2)

                                                @php

                                                    $datetime1 = new DateTime($col2->REC_DATE_TIME);
                                                    $datetime2 = new DateTime($col2->REL_DATE_TIME);
                                                    $interval = $datetime1->diff($datetime2);

                                                    $days = $interval->format('%d');
                                                    $hours = $interval->format('%h');
                                                    $minutes = $interval->format('%i');


                                                    if($days > 0) {
                                                        if($days > 1) {
                                                            $con_days = $days.' days, ';
                                                        } else if($days == 1) {
                                                            $con_days = $days.' day, ';
                                                        }
                                                    } else if($days == 0) {
                                                        $con_days = '';
                                                    }

                                                    if($hours > 0) {
                                                        if($hours > 1) {
                                                            $con_hours = $hours.' hrs. ';
                                                        } else if($hours == 1) {
                                                            $con_hours = $hours.' hr. ';
                                                        }
                                                    } else if($hours == 0) {
                                                        $con_hours = '';
                                                    }

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
                                                            } else if($hours == 0) { 
                                                                $con_minutes = $minutes.' min. ';
                                                            }
                                                        }
                                                    } else if($minutes == 0) {
                                                        $con_minutes = '';
                                                    }

                                                    $time_consumed = $con_days.' '.$con_hours.' '.$con_minutes;

                                                    $log_attachment = DB::table('dts_document_attachments')->where('FW_NO', '=', $col2->FW_NO)->where('DOC_NO', '=', $col2->DOC_NO)->get();

                                                @endphp

                                                <tr class="odd gradeX" style="font-size: 11px;">
                                                    <td></td>
                                                    <td style="padding: 3px 10px 3px 10px; vertical-align: middle; " colspan="2">
                                                        @if($col2->FW_NO == 1)  
                                                            <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                            @foreach($senders3 as $id => $col3)
                                                                @if($col3->SENDER_TYPE == 'IN')
                                                                    @php $userinfo = DB::table('users')->where('id','=', $col3->DOC_SENDER)->first(); @endphp
                                                                    <li>{{ $userinfo->fname }} {{ $userinfo->lname }}</li>
                                                                @elseif($col3->SENDER_TYPE == 'OUT')
                                                                    <li>{{ $col3->DOC_SENDER }}</li>
                                                                @endif
                                                            @endforeach
                                                            </ul>
                                                        @else
                                                            <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                                <li>{{$col2->from_fname}} {{$col2->from_lname}}</li>
                                                            </ul>
                                                        @endif
                                                    </td>
                                                    <td style="padding: 3px 10px 3px 10px; vertical-align: middle;" colspan="2">
                                                        <ul style="padding-left: 20px; margin-bottom: 0px;">
                                                            <li>{{$col2->to_fname}} {{$col2->to_lname}}</li>
                                                        </ul>
                                                    </td>
                                                    <td style="padding: 3px 10px 3px 10px; vertical-align: middle;">{{ date('m/d/Y H:i A', strtotime($col2->REC_DATE_TIME)) }}</td>
                                                    <td style="padding: 3px 10px 3px 10px; vertical-align: middle;">{{ date('m/d/Y H:i A', strtotime($col2->REL_DATE_TIME)) }}</td>
                                                    <td style="padding: 3px 10px 3px 10px; vertical-align: middle;" >{{ $time_consumed }}</td>
                                                    <td style="padding: 3px 10px 3px 10px; vertical-align: middle;" colspan="2">{{$col2->DOC_REMARKS}}</td>
                                                    <td style="padding: 3px 10px 3px 10px; vertical-align: middle;" colspan="3">
                                                        <ul style="padding: 0px 0px 0px 15px;">
                                                            @foreach($log_attachment as $id => $att)
                                                                <li>{{ $att->FILE_ATTACHMENT }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>

                                            @endforeach

                                        @endif
                                    
                                    @endforeach

                                @elseif($doc_count == 0)
                                    
                                    <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                        <td style="padding: 20px; text-align: center; font-size: 12px; background-color: #FFF;" colspan="12">NO RESULT FOUND !</td>
                                    </tr>
                                    
                                @endif

                                </tbody>

                            </table>

                            <p style="font-weight: bold;">{{ $doc_count }} total document/s</p>

                        </div>

                </div>

            </div>

@endsection