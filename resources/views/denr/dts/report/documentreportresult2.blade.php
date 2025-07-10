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

                            <!-- <hr style="height: 5px; background-color: purple;"/> -->
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
                                    
                                    @endforeach

                                @elseif($doc_count == 0)
                                    
                                    <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                        <td style="padding: 20px; text-align: center; font-size: 12px; background-color: #FFF;" colspan="12">NO RESULT FOUND !</td>
                                    </tr>
                                    
                                @endif

                                </tbody>

                            </table>

                        </div>

                </div>

            </div>

@endsection