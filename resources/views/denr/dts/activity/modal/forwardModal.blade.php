<div id="forward_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="mod_id" style="margin-top: 50px; width: 50%;">
        <div class="modal-content">

            {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@viewTheForward', 'files'=>'true', 'name'=>'form' ))}}
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title" style="color: #09C;"><i class="fa fa-send"></i> Forward Document no. (<font id="doc_no_title"></font>)</h5>
                </div>
                <div class="modal-body" style="padding: 0px; text-align: center; background-color: #EEE; overflow: auto; height: 550px;"> 
                    <div class="panel-heading" style="padding:20px;">
                        <div class="panel panel-default">
                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                <input type="hidden" name="doc_no" id="doc_no" value="">
                                <input type="hidden" name="doc_category" id="doc_category" value="">
                                <tbody>

                                    @php
                                        $user = Auth::user();
                                        $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get();
                                        $doc_action = DB::table('dts_action_to_be_taken')->where('ID','!=','14')->orderBy('ID','ASC')->get();
                                    @endphp

                                    <tr class='btn-panel-addresee add_receiver_rows_here'>
                                        <td style="width:20%; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address To :</td>
                                        <td style="width:74%; padding: 0px;" colspan="4" id="ReceiverGroup1">
                                            <input type="hidden" name="send_type" value="FW">
                                            <select class="form-control" name='doc_to[]' style="height: 33px; float: left; width: 50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Address To">
                                                <option value=''>Select Addressee</option>
                                                @foreach($addresee_list as $addresee_item)
                                                    <option value='{{$addresee_item->id}}' @if($user->user_role != '4')@if($addresee_item->user_class == '1') selected @endif @endif>{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                                                @endforeach
                                            </select>
                                            <select class="form-control" name='doc_action[]' style="height: 33px; float: left; width: 50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Action to be taken">
                                                <option value=''>Select Action to be Taken</option>
                                                @foreach($doc_action as $doc)
                                                    <option value='{{$doc->ID}}' >{{$doc->ACTION}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width:6%; padding: 0; text-align: center;" colspan='2'>
                                            <button class='btn btn-default' type="button" id='btn-add-addresee' style="font-size: 12px; width: 100%; height: 33px; color: #09C;"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>

                                    @include('denr.dts.activity.script.jScriptAddressee')

                                    <tr>
                                        <td style=" font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Remarks :</td>
                                        <td style="padding: 0px;" colspan="6">
                                            <textarea class="form-control" style="min-height: 8em; font-size: 12px; border-radius: 0px; " name='doc_remarks' data-toggle="tooltip" data-placement="left" title="Action to be taken"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style=" font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "> Attachment :</td>
                                        <td style="padding: 0px;" colspan="6">
                                            <input type="file" name="attached_files[]" multiple class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Attachment">
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

@include('denr.dts.activity.script.jScriptForward')

