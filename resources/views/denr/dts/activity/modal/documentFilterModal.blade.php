<div id="doc_filter_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="mod_id" style="margin-top: 100px; width: 35%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" style="color: #09C;"><i class="fa fa-search"></i> Filter <font id="doc_title"></font></h5>
            </div>
            <div class="modal-body" style="padding: 0px; text-align: center; background-color: #EEE; "> 
                <div class="panel-heading" style="padding: 5px;">
                    <table class="table table-striped table-bordered table-hover tooltip-demo">
                        <tr>
                            <td style="width:30%; font-size: 11px; color: #5B5B5B; text-align: right; "> DATE RANGE</td>
                            <td style="width:70%; padding: 0px;">
                                <input type="hidden" name="doc_cat" id="doc_cat" value="">
                                <input type="date" name='doc_from' id='doc_from' value="{{date('Y-m-01')}}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; float: left; width: 50%;" data-toggle="tooltip" data-placement="left" title="Document From">
                                <input type="date" name='doc_to' id='doc_to' value="{{date('Y-m-d')}}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; float: left; width: 50%;" data-toggle="tooltip" data-placement="left" title="Document To">
                            </td>
                        </tr>

                        @php $doc_type_list = DB::table('dts_document_types')->get(); @endphp

                        <tr>
                            <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> TYPE</td>
                            <td style="padding: 0px;">
                                <select name="doc_type" id="doc_type" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Document Type">
                                    <option value="">All</option>
                                    @foreach($doc_type_list as $doc_type_item)
                                        <option value="{{$doc_type_item->ID}}">{{$doc_type_item->TYPE_NAME}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> CLASSIFICATION</td>
                            <td style="padding: 0px;">
                               <select name='doc_class' id='doc_class' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Document Classification">
                                    <option value="">All</option>
                                    <option value="S">Simple</option>
                                    <option value="C"> Complex</option>
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
                        </tr>
                        <tr>
                            <td style="font-size: 11px; color: #5B5B5B; text-align: right; "> SIGNED?</td>
                            <td style="padding: 0px;">
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
                        </tr>
                    </table>
                </div>   
            </div>
            <div class="modal-footer">
                <input type='button' id="btn-submit" value='Submit' class='btn btn-success' onclick="filterData(1)" style='width:70px; height:30px; padding:2px 2px 2px 2px; float:right;'/>
            </div>
        </div>
    </div>
</div>

@include('denr.dts.activity.script.jScriptFilterDocument')

