<div id="complete_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
        <div class="modal-content">
            {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@complete'))}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #3D9140;"><i class="fa fa-check-circle"></i> End Confirmation</h4>
                </div>
                <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                    Are you sure you want to end the process of Document ( <b id="com_name"></b> ) ?
                    <textarea name="end_remarks" id="end_remarks" class="form-control" placeholder="Remarks" style="background-color: #FFF; height: 100px; font-size: 12px; border-radius: 0px; margin-top: 20px;"></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="com_id" name="com_id" value="" />
                    <input type="hidden" id="doc_cat" name="doc_cat" value="" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>No</button>
                    <input type='submit' name='complete' value='Yes' class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'/>
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>


