<div id="recall_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
        <div class="modal-content">
            {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@recall', 'name'=>'form_recall', 'id'=>'form_recall'))}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #a30000;"><i class="fa fa-reply"></i> Confirm Recall</h4>
                </div>
                <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                    Are you sure you want to recall this Document ( <b id="com_name"></b> ) ?
                    <textarea name="recall_remarks" id="recall_remarks" class="form-control" placeholder="Remarks" style="background-color: #FFF; height: 100px; font-size: 12px; border-radius: 0px; margin-top: 20px;" required></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="com_id" name="com_id" value="" />
                    <input type="hidden" id="doc_cat" name="doc_cat" value="" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>No</button>
                    <button type="submit" name="recall" id="btn_recall" class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'>Yes</button>
                    <!-- <input type='submit' name='recall' value='Yes' class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'/> -->
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>

<div id="recall_modal2" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
        <div class="modal-content">
            {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@recallSingle', 'name'=>'form_recall1', 'id'=>'form_recall1'))}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #a30000;"><i class="fa fa-reply"></i> Confirm Recall</h4>
                </div>
                <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                    Are you sure you want to recall this Document ( <b id="doc_no"></b> ) from <b id="receiver"></b> ?
                    <textarea name="recall_remarks" id="recall_remarks" class="form-control" placeholder="Remarks" style="background-color: #FFF; height: 100px; font-size: 12px; border-radius: 0px; margin-top: 20px;" required></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="doc_log_id" name="doc_log_id" value="" />
                    <input type="hidden" id="doc_no" name="doc_no" value="" />
                    <input type="hidden" id="doc_cat" name="doc_cat" value="" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>No</button>
                    <button type="submit" name="recall1" id="btn_recall1" class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'>Yes</button>
                    <!-- <input type='submit' name='recall' value='Yes' class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'/> -->
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>
