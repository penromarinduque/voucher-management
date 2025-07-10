<div id="followup_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
        <div class="modal-content">
            {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@followup', 'name'=>'form_followup', 'id'=>'form_followup'))}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-warning"><i class="fa fa-reply text-warning"></i> Confirm Follow Up</h4>
                </div>
                <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                    <input type="hidden" id="doc_log_id" name="doc_log_id" value="" />
                    Are you sure you want to follow up this Document ( <b id="com_name"></b> ) ?
                    <textarea name="followup_remarks" id="followup_remarks" class="form-control" placeholder="Remarks" style="background-color: #FFF; height: 100px; font-size: 12px; border-radius: 0px; margin-top: 20px;" required></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="com_id" name="com_id" value="" />
                    <input type="hidden" id="doc_cat" name="doc_cat" value="" />
                    <input type="hidden" id="doc_no" name="doc_no" value="" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>No</button>
                    <button type="submit" name="followup" id="btn_followup" class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'>Yes</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>