<div id="edit_modal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="margin-top: 100px;">
		<div class="modal-content">
			{{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@updateDetails', 'files'=>'true', 'id'=>'form_edit'))}}
            <!-- , 'onsubmit'=>"return confirm('DO YOU REALLY WANT TO SUBMIT THE FORM? PLEASE MAKE SURE ALL OF THE DOCUMENT DETAILS ARE CORRECT BEFORE SUBMITTING.');" -->
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info"><i class="fa fa-edit"></i> Edit Details of <b><span id="doc_no"></span></b></h4>
            </div>
            @if(!empty($documents))
            <div class="modal-body">
                <h5>All fields with asterisk (<font style="color: #F00;">*</font>) are required.</h5>
                @php
                $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get();
                @endphp
            	<div class="form-group">
                    <label for="sender_edit">SENDER <font style="color: #F00;">*</font></label>
                    @if($senders1['SENDER_TYPE'] == 'IN')
                    <select id="sender_type_2_input" class="form-control" name='doc_from[]' style="@if($senders1['SENDER_TYPE'] == 'OUT') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender">
                        <option value=''> Select Insider </option>
                        @foreach($addresee_list as $addresee_item)
                            <option value='{{$addresee_item->id}}' @if($senders1['DOC_SENDER'] == $addresee_item->id) selected @endif>{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
                        @endforeach
                    </select>
                    @else
                    <input type="hidden" name="doc_from_id[]" value="{{ $senders1['ID'] }}">
                    <input type="text" class="form-control" name="doc_from[]" id="sender_type_1_input" value="{{$senders1['DOC_SENDER']}}" placeholder="Input Outsider" style="@if($senders1['SENDER_TYPE'] == 'IN') display:none; @endif" data-toggle="tooltip" data-placement="left" title="Sender" required >
                    @endif
                    <input type="hidden" name="sender_type[]" value="{{$senders1['SENDER_TYPE']}}" id="sender_type_1_hidden">
                </div>
                <div class="form-group">
                    <label for="doc_subject_edit">SUBJECT <font style="color: #F00;">*</font></label>
                    <input type="text" name="doc_subject_edit" id="doc_subject_edit" class="form-control" required value="{{ $documents->DOC_SUBJ }}">
                </div>
                <div class="form-group">
                    <label for="doc_origin_office_edit">ORIGINATING OFFICE</label>
                    <input type="text" name="doc_origin_office_edit" id="doc_origin_office_edit" class="form-control" value="{{ $documents->ORIGIN_OFFICE }}">
                </div>
                <div class="form-group">
                    <label for="doc_address_edit">ADDRESS</label>
                    <input type="text" name="doc_address_edit" id="doc_address_edit" class="form-control" value="{{ $documents->DOC_ADDRESS }}">
                </div>
                <div class="form-group">
                    <label for="doc_classification_edit">CLASSIFICATION <font style="color: #F00;">*</font></label>
                    <select name="doc_classification_edit" id="doc_classification_edit" class="form-control" required>
                        <option value="">Select Classification</option>
                        <option value="S" @if($documents->DOC_CLASSIFICATION == 'S') selected @endif>Simple </option>
                        <option value="C" @if($documents->DOC_CLASSIFICATION == 'C') selected @endif> Complex </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="doc_type_edit">DOCUMENT TYPE <font style="color: #F00;">*</font></label>
                    <select name="doc_type_edit" id="doc_type_edit" class="form-control" required>
                        <option value=''> Select Document Type </option>
                        @foreach($doc_type_list as $doc_type_item)
                            <option value="{{$doc_type_item->ID}}" @if($documents['DOC_TYPE'] == $doc_type_item->ID) selected @endif >{{$doc_type_item->TYPE_NAME}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="control_code_edit">CONTROL CODE</label>
                    <input type="text" name="control_code_edit" id="control_code_edit" class="form-control" value="{{ $documents->CONTROL_CODE }}">
                </div>
                <div class="form-group">
                    <label for="doc_urgent_edit">IS URGENT? <font style="color: #F00;">*</font></label>
                    <select name="doc_urgent_edit" id="doc_urgent_edit" class="form-control" required>
                        <option value=''> Select Document Type </option>
                        <option value="N" @if($documents['DOC_URGENT'] == 'N') selected @endif> NO </option>
                        <option value="Y" @if($documents['DOC_URGENT'] == 'Y') selected @endif> YES </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="doc_urgent_edit">REPLACE EXISTING/ADD ATTACHMENT? UPLOAD HERE</label>
                    <input type="file" name="attached_files[]" multiple >
                    
                    @if(count($attachments) > 0)
                    <h5>Existing Attachement(s)</h5>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>File Attachment</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attachments as $attachment)
                            @php
                            $extension = pathinfo($attachment->FILE_ATTACHMENT, PATHINFO_EXTENSION);
                            $filetype = $helper->getFileType($attachment->FILE_ATTACHMENT);
                            $log_id = (!empty($first_log)) ? $first_log->ID : 0;
                            $fw_no = (!empty($first_log)) ? $first_log->FW_NO : 0;
                            $doc_to = (!empty($first_log)) ? $first_log->DOC_TO : 0;
                            @endphp
                            <tr id="att_{{$attachment->ID}}">
                                <td><a href="{{ url('/dts/activity/document/preview/'.$attachment->ID.'/'.$log_id.'/'.$filetype.'/'.$doc_to) }}" target="_blank">{{$attachment->ATTACHMENT_DESC}}</a></td>
                                <td><button type="button" id="btn_remove_attachment" class="btn btn-danger btn-sm" style="float: right;" value="{{$attachment->ID}}">Remove</button></td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
            	<input type="hidden" id="doc_no" name="doc_no" value="" />
                <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:60px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>Cancel</button>
                <button type='submit' name='update' id='btn_update' class='btn btn-success' style='width:120px; height:30px; padding:2px 2px 2px 2px; float:right;'>Save Changes</button>
            </div>
            @else
            <div class="modal-body">
                <h3>No record found. Please refresh the page and try again.</h3>
            </div>
            @endif
            {{Form::close()}}
		</div>
	</div>
</div>