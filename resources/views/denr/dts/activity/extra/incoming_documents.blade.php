<?php 

use App\Helpers\Helper;

$window = helper::window();
$subwindow = helper::subwindow();
$access = helper::access($window, $subwindow);

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
                            
                            <li class="active" style="margin-left: 12px;">
                                <a href="{{ route('view.documents', ['id' => 'in']) }}"><i class="fa fa-sign-in fa-fw"></i> Incoming Document</a>
                            </li>

                            <li>
                                <a href="{{ route('view.documents', ['id' => 'out']) }}"><i class="fa fa-sign-out fa-fw"></i> Outgoing Document</a>
                            </li>

                            @if($user_role != '4')
                            
                            <li>
                                <a href="{{ route('add.documents') }}"><i class="fa fa-plus fa-fw"></i> New Document</a>
                            </li>

                            @endif

                            <!-- <li>
                                <a href="{{ route('received.documents') }}"><i class="fa fa-arrow-down fa-fw"></i> Received Document</a>
                            </li>

                            <li>
                                <a href="{{ route('forwarded.documents') }}"><i class="fa fa-arrow-up fa-fw"></i> Forwarded Document</a>
                            </li> -->

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
                                                    <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase; "><i class="fa fa-navicon fa-fw"></i> INCOMING DOCUMENT LISTING <a href="javascript:void(0)" class="btn-filter" data-id="Incoming Document" data-id2="IN" style="float: right; "><i class="fa fa-search"></i> Filter</a></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <!-- @foreach($valid_doc as $id => $col)

                                            {{$col->DOC_NO}}

                                        @endforeach -->

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">

                                                <thead>
                                                    <tr>
                                                        <td style="width:4%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>
                                                        <td style="width:3%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"><i class="fa fa-bell "></i></td>
                                                        <td style="width:3%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"><i class="fa fa-star "></i></td>
                                                        <td style="width:10%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left;">Doc. No.</td>
                                                        <td style="width:8%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Doc. Date</td>
                                                        <td style="width:5%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Type</td>
                                                        <td style="width:15%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Originating Office</td>
                                                        <td style="width:15%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Subject</td>
                                                        <td style="width:13%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Remarks</td>
                                                        <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Encoded By</td>
                                                        <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Action</td>
                                                    </tr>
                                                </thead>
                                               
                                                <tbody id="doc_records">

                                                    @if($doc_count > 0)

                                                        @foreach($documents as $id => $record)

                                                            @php $code = Crypt::encrypt($record->DOC_NO); @endphp

                                                            @php 

                                                                $my_log = DB::table('dts_document_logs')->where('DOC_NO','=', $record->DOC_NO)->where('DOC_TO','=', $user->id)->count();
                                                                $seen_log = DB::table('dts_document_logs')->where('DOC_NO','=', $record->DOC_NO)->where('DOC_TO','=', $user->id)->where('SEEN','=', 'N')->count();
                                                                $encoded = DB::table('users')->where('id','=', $record->CREATED_BY)->first();
                                                                
                                                            @endphp

                                                            @if($my_log  > 0)

                                                                @if($seen_log == 0)
                                                                    @php 
                                                                        $bg = '#00CD00';
                                                                        $title = 'Seen'; 
                                                                    @endphp
                                                                @elseif($seen_log > 0)
                                                                    @php 
                                                                        $bg = '#F00';
                                                                        $title = 'Unseen'; 
                                                                    @endphp
                                                                @endif

                                                            @elseif($my_log  == 0)
                                                                @php 
                                                                    $bg = '#F00';
                                                                    $title = 'Unseen'; 
                                                                @endphp
                                                            @endif

                                                            <tr>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: right; ">{{$id+1}}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: center; padding-top: 10px; ">
                                                                    <div style="width: 10px; height: 10px; border-radius:20px; background: {{$bg}}; margin: auto;" data-toggle="tooltip" data-placement="left" title="{{$title}}"></div> 
                                                                </td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: center; padding: 0px; ">
                                                                    <div style="width: 20px; padding: 2px; margin:auto; margin-top: 5px; border-radius: 50px; color: #FFF; @if($record->STATUS == 'C') background-color: #00CD66; @elseif($record->STATUS == 'F') background-color: #33A1C9; @endif" data-toggle="tooltip" data-placement="left" title="@if($record->STATUS == 'S') Signed @elseif($record->STATUS == 'F') Forwarded @elseif($record->STATUS == 'R') Returned @endif">
                                                                        @if($record->STATUS == 'C') C @elseif($record->STATUS == 'F') F @endif
                                                                    </div>
                                                                </td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$record->DOC_NO}}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{date('m/d/Y', strtotime($record->DOC_DATE))}}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$record->TYPE_NAME}}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$record->ORIGIN_OFFICE}}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$record->DOC_SUBJ}}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$record->REMARKS}}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{ $encoded->fname }} {{ $encoded->lname }}</td>
                                                                <td style="font-size: 11px; color: #5B5B5B; text-align: left; vertical-align: middle; padding: 0px;" >
                                                                    <a href='{{url("/dts/activity/document/view/".$code."/A")}}' class="btn btn-default" data-toggle="tooltip" data-placement="top" title="View Document" style="font-size: 12px; color: green; border-radius: 2px; width: 25%; float: left; "><i class="fa fa-edit"></i></a>
                                                                    <a href="javascript:void(0)" class="btn-history btn btn-default" data-id="{{$record->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="History Logs" style="font-size: 12px; color: #F00; border-radius: 2px; width: 25%; float: left;"><i class="fa fa-history"></i></a>
                                                                    <a href="javascript:void(0)" class="btn-forward btn btn-default" data-id="{{$record->DOC_NO}}" data-id2="{{$record->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="Forward" style="font-size: 12px; color: #09C; border-radius: 2px; width: 25%; float: left; "><i class="fa fa-send"></i></a>
                                                                    <a onClick=MM_openBrWindow("{{ url('dts/activity/document/print/'.$code) }}",'') class="btn-print btn btn-default" data-id="{{$record->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="Print Slip" style="cursor:pointer; font-size: 12px; color: gold; border-radius: 2px; width: 25%; float: left;"><i class="glyphicon glyphicon-print"></i></a>
                                                                </td>
                                                            </tr>

                                                        @endforeach

                                                    @elseif($doc_count == 0)

                                                        <tr>
                                                            <td colspan='11' style="width:150px; font-size: 11px; color: #5B5B5B; text-align: left; padding-left: 20px; ">NO RESULTS FOUND.</td>
                                                        </tr>

                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            @include('denr.dts.activity.documentFilterModal')
            @include('denr.dts.activity.forwardModal')
            @include('denr.dts.activity.historyModal')
            @include('denr.dts.activity.attachmentModal')

@endsection