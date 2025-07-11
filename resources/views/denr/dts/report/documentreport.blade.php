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
                                <a href="{{ route('document.report') }}"><i class="fa fa-file-o fa-fw"></i> DOCUMENT REPORT</a>
                            </li>
                            
                        </ul>

                        <div class="panel-body">

                            {{Form::open(array('action'=>'denr\dts\report\DocumentReportController@DocumentReportResult', 'target'=>'_blank'))}}

                            <div class="panel panel-default">
                                <table class="table table-striped table-bordered table-hover tooltip-demo">
                                    <tr>
                                         <td colspan="8" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-search-plus fa-fw"></i> FILTER DOCUMENT<a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                    </tr>

                                    <tr>
                                        <td style="width:13%; font-size: 11px; color: #5B5B5B; text-align: right; "> DATE RANGE</td>
                                        <td style="width:37%; padding: 0px;">
                                            <input type="hidden" name="doc_cat" id="doc_cat" value="">
                                            <input type="date" name='doc_from' id='doc_from' value="{{date('Y-m-01')}}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; float: left; width: 50%;" data-toggle="tooltip" data-placement="left" title="Document From">
                                            <input type="date" name='doc_to' id='doc_to' value="{{date('Y-m-d')}}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; float: left; width: 50%;" data-toggle="tooltip" data-placement="left" title="Document To">
                                        </td>
                                        <td style="width:13%; font-size: 11px; color: #5B5B5B; text-align: right; "> CATEGORY</td>
                                        <td style="width:37%; padding: 0px;" colspan="3">
                                           <select name='doc_cat' id='doc_cat' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Document Category">
                                                <option value="">All</option>
                                                <option value="IN">Incoming Document</option>
                                                <option value="OUT">Outgoing Document</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        @php $doc_type_list = DB::table('dts_document_types')->get(); @endphp
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> TYPE</td>
                                        <td style="padding: 0px;">
                                            <select name="doc_type" id="doc_type" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Document Type">
                                                <option value="">All</option>
                                                @foreach($doc_type_list as $doc_type_item)
                                                    <option value="{{$doc_type_item->ID}}">{{$doc_type_item->TYPE_NAME}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> CLASSIFICATION</td>
                                        <td style="padding: 0px;" colspan="3">
                                           <select name='doc_class' id='doc_class' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Document Classification">
                                                <option value="">All</option>
                                                <option value="S">Simple</option>
                                                <option value="C"> Complex</option>
                                                <option value="HT"> Highly Technical </option>
                                                <option value="HT(MSP)"> Highly Technical (Multi-Stage Processing) </option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> URGENT?</td>
                                        <td style="padding: 0px;">
                                           <select name='doc_urgent' id='doc_urgent' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Is This Urgent?">
                                                <option value="">All</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> SIGNED?</td>
                                        <td style="padding: 0px;" colspan="3">
                                           <select name='doc_signed' id='doc_signed' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Signed?">
                                                <option value="">All</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> STATUS</td>
                                        <td style="padding: 0px;">
                                           <select name='doc_status' id='doc_status' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Status">
                                                <option value="">All</option>
                                                <option value="F">Forwarded</option>
                                                <option value="C">Completed</option>
                                            </select>
                                        </td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> INCLUDE AUDIT TRAIL</td>
                                        <td style="padding: 5px 0px 4px 15px;">
                                            <input type="hidden" name="doc_trail" value="N">
                                            <input type="checkbox" name="doc_trail" value="Y" style="width: 15px; height: 15px;">
                                        </td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> INCLUDE HISTORY LOGS</td>
                                        <td style="padding: 5px 0px 4px 15px;">
                                            <input type="hidden" name="doc_history" value="N">
                                            <input type="checkbox" name="doc_history" value="Y" style="width: 15px; height: 15px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ></td>
                                        <td colspan="5">
                                            <input type="submit" name="filter" value="Filter" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Filter Data">
                                            <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="right" title="Clear Input Fields">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            {{Form::close()}}
                            
                        </div>

                    </div>

                </div>

            </div>


@endsection