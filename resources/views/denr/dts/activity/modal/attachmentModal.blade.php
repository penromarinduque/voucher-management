<div id="log_attachment_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="mod_id" style="margin-top: 50px; width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" style="color: #09C;"><i class="glyphicon glyphicon-paperclip"></i> Attachment - Document no. (<font id="attach_title"></font>)</h5>
            </div>
            <div class="modal-body" style="padding: 0px; text-align: center; background-color: #EEE; overflow: auto; height: 550px;"> 
                <div class="panel-heading" style="padding: 5px;">
                    <table id="table1" class="table table-striped table-bordered table-hover tooltip-demo">
                        <thead id="attach_header"></thead>
                        <tbody id="attach_content"></tbody>
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>

@include('denr.dts.activity.script.jScriptAttachment')

