<div id="return_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="mod_id" style="margin-top: 50px; width: 50%;">
        <div class="modal-content">

            {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@viewTheForward', 'files'=>'true', 'name'=>'form' ))}}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title" style="color: #09C;"><i class="fa fa-arrow-left"></i> Return Document no. (<font id="doc_no_title"></font>)</h5>
                </div>
                <div class="modal-body" style="padding: 0px; text-align: center; background-color: #EEE; overflow: auto; height: 550px;"> 
                    <div class="panel-heading" style="padding:20px;">
                        <div class="panel panel-default">
                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                <input type="hidden" value="" name="doc_no" id="doc_no">
                                <tbody>

                                    @php
                                    $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get();
                                    @endphp

                                    <tr class='btn-panel-addresee add_receiver_rows_here'>
                                        <td style="width:20%; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address To :</td>
                                        <td style="width:80%; padding: 0px;" colspan="4" id="ReceiverGroup1">
                                            <input type="hidden" name="send_type" value="RN">
                                            <select class="form-control" name='doc_to[]' style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Required" disabled="">
                                                <option value=''>- - SELECT - -</option>
                                                @foreach($addresee_list as $addresee_item)
                                                    <option value='{{$addresee_item->id}}' @if($addresee_item->id == $return_to->DOC_FROM) selected @endif>{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="doc_to[]" value="{{$return_to->DOC_FROM}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Particulars / Remarks :</td>
                                        <td style="padding: 0px;" colspan="6">
                                            <textarea class="form-control" style="min-height: 8em; font-size: 12px; border-radius: 0px; " name='doc_remarks' required="required"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Attachment :</td>
                                        <td style="padding: 0px;" colspan="6">
                                            <input type="file" name="attached_files[]" multiple class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="6">
                                            <input type="submit" name="add" value="Send" class="btn btn-success btn-xs pull-left" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer"></div>

            {{Form::close()}} 

        </div>
    </div>
</div>

@include('denr.dts.activity.script.jScriptReturn')

