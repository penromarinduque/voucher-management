<?php $user = Auth::user(); ?>

<div class="panel panel-default">

    <table class="table table-striped table-bordered table-hover tooltip-demo" style="table-layout: fixed;">
        
        <thead>
            <tr>
                <td style="width:4%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>
                <td style="width:3%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"><i class="fa fa-bell "></i></td>
                <td style="width:3%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"><i class="fa fa-star "></i></td>
                <td style="width:10%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left;">Doc. No.</td>
                <td style="width:8%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Doc. Date</td>
                <td style="width:5%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Type</td>
                <td style="width:15%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Originating Office</td>
                <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Subject</td>
                <td style="width:16%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Remarks</td>
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

                        $for_end = DB::table('dts_document_logs')->where('DOC_NO','=', $record->DOC_NO)->orderBy('REL_DATE_TIME','DESC')->first();
                        
                        if($my_log  > 0) {
                            if($seen_log == 0) {
                                $bg = '#00CD00';
                                $title = 'Seen'; 
                            } else if($seen_log > 0) {
                                $bg = '#F00';
                                $title = 'Unseen'; 
                            }
                        } else if($my_log  == 0) {
                            $bg = 'transparent';
                            $title = ''; 
                        }

                    @endphp

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
                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; ">{{$record->DOC_SUBJ}}</td>
                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">{{$record->REMARKS}}</td>
                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{ $encoded->fname }} {{ $encoded->lname }}</td>
                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; vertical-align: middle; padding: 0px;" >
                            <a href='{{url("/dts/activity/document/view/".$code."/A")}}' class="btn btn-default" data-toggle="tooltip" data-placement="top" title="View Document" style="font-size: 12px; color: green; border-radius: 2px; width: 25%; float: left; "><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" class="btn-history btn btn-default" data-id="{{$record->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="History Logs" style="font-size: 12px; color: #F00; border-radius: 2px; width: 25%; float: left;"><i class="fa fa-history"></i></a>
                            <!-- @if($record->STATUS != 'C')
                                @if($for_end->ACTION_TO_BE_TAKEN == '12')
                                <a href="javascript:void(0)" class="btn-complete btn btn-default" data-id="{{$record->DOC_NO}}" data-id2="{{$record->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="End" style="font-size: 12px; color: green; border-radius: 2px; width: 20%; float: left; "><i class="glyphicon glyphicon-saved"></i></a>
                                @else
                                <a href="javascript:void(0)" class="btn-forward btn btn-default" data-id="{{$record->DOC_NO}}" data-id2="{{$record->DOC_CATEGORY}}" data-toggle="tooltip" data-placement="top" title="Forward" style="font-size: 12px; color: #09C; border-radius: 2px; width: 20%; float: left; "><i class="fa fa-send"></i></a>
                                @endif
                            @endif -->
                            <a onClick=MM_openBrWindow("{{ url('dts/activity/document/print/'.$code) }}",'') class="btn-print btn btn-default" data-id="{{$record->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="Print Slip" style="cursor:pointer; font-size: 12px; color: gold; border-radius: 2px; width: 25%; float: left;"><i class="glyphicon glyphicon-print"></i></a>
                            <a onClick=MM_openBrWindow("{{ url('dts/activity/document/manual/'.$code) }}",'') class="btn-print btn btn-default" data-id="{{$record->DOC_NO}}" data-toggle="tooltip" data-placement="top" title="Print Manual Slip" style="cursor:pointer; font-size: 12px; color: #FF4500; border-radius: 2px; width: 25%; float: left;"><i class="glyphicon glyphicon-print"></i></a>
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

<div style="float: right; bottom: 0; margin-right: 3px;" class="search-link">{!! $documents->links(); !!}</div>

@include('denr.dts.activity.script.jScriptHistoryLog')
@include('denr.dts.activity.script.jScriptAttachment')
@include('denr.dts.activity.script.jScriptForward')
@include('denr.dts.activity.script.jScriptComplete')

