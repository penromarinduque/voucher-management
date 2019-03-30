<?php

namespace App\Http\Traits\denr\dts\activity;

use Auth;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\User as UserModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\DTS_DocRecordModel as DocRecordModel;
use App\Models\denr\DTS_DocReceiverModel as DocReceiverModel;
use App\Models\denr\DTS_DocSenderModel as DocSenderModel;
use App\Models\denr\DTS_DocLogsModel as DocLogsModel;
use App\Models\denr\DTS_DocAttachmentsModel as DocAttachmentsModel;
use App\Models\denr\Form_No as FormNoModel;

trait DocumentAddTrait
{

	public function viewTheForwardFunction(Request $request)
	{

		$doc_to =  $request->doc_to; 
		$doc_action =  $request->doc_action; 
		$doc_no = $request->doc_no;
		$doc_remarks = $request->doc_remarks;
		$doc_cat = $request->doc_category;
		$send_type = $request->send_type;

		$forward = DocLogsModel::where('DOC_NO', '=', $doc_no)->orderBy('FW_NO', 'DESC')->first();
		$released = DocLogsModel::where('DOC_NO', '=', $doc_no)->orderBy('ID', 'DESC')->first();

		foreach($doc_to as $index => $col){

			$document_log = [
				'FW_NO' => $forward->FW_NO + 1,
				'DOC_FROM' => Auth::user()->id,
				'DOC_TO' => $request->input('doc_to')[$index],
				'DOC_NO' => $doc_no,
				'DOC_DT_LOG' => date('Y-m-d H:i:s'),
				'REC_DATE_TIME' => $released->REL_DATE_TIME,
				'REL_DATE_TIME' => date('Y-m-d H:i:s'),
				'DOC_REMARKS' => $doc_remarks,
				'DOC_CATEGORY' => $doc_cat,
				'ACTION_TO_BE_TAKEN' => $request->input('doc_action')[$index],
				'SEEN' => 'N',
				'SEND_TYPE' => $send_type,
			];

			DocLogsModel::insert($document_log);

		}


		//UPDATE ACTION STATUS
		$doc_action = ['ACTION_STATUS' => 1];
		DocLogsModel::where('ID','=', $forward->ID)->update($doc_action);


		//HANDLES FILE ATTACHMENTS
		if($request->hasFile('attached_files')){

			$FILE_ATTACHMENTS = $request->attached_files;

			foreach($FILE_ATTACHMENTS AS $FILE){

				$EXTENSION = $FILE->getClientOriginalExtension();
				$DESCRIPTION = $FILE->getClientOriginalName();
				$SIZE = $FILE->getClientSize();
				$FILE_NAME = rand(11111111, 99999999). '.' . $EXTENSION;

				$FILE->move('DTS_UPLOADS/', $FILE_NAME);

				echo $FILE_NAME.' '.$FILE->getClientSize().'<br>';

				$FILE_RECORD = [
					'FW_NO' => $forward->FW_NO + 1,
					'DOC_NO' => $doc_no,
					'ATTACHMENT_DESC' => $DESCRIPTION,
					'FILE_ATTACHMENT' => $FILE_NAME,
					'FILE_TYPE' => $EXTENSION,
					'ATTACH_CLASS' => $send_type,
				];

				DocAttachmentsModel::insert($FILE_RECORD);
			}

		}

		$document_rec_stat_update = [
				
			'STATUS' => 'F',
		];

		DocRecordModel::where('DOC_NO', '=', $doc_no)->update($document_rec_stat_update);

		return back();
	}

	public function AddDocumentFunction(Request $request)
	{
		$user = Auth::user();
		$doc_no = $request->doc_no;
		$control_code = $request->control_code;
		$doc_date = $request->doc_date;
		$doc_time = $request->doc_time;
		$date_time_start = $request->date_time_start;
		$doc_type = $request->doc_type;
		$doc_cat = $request->doc_cat;
		$doc_from =  $request->doc_from;
		$sender_type =  $request->sender_type;
		$doc_origin_office = $request->doc_origin_office;
		$doc_address = $request->doc_address;
		$doc_subj = $request->doc_subject;
		$doc_classification = $request->doc_classification;
		$doc_urgent = $request->doc_urgent;
		$doc_remarks = $request->doc_remarks;
		$doc_processor = $user->id;

		$doc_to =  $request->doc_to; 
		$doc_action = $request->doc_action;
		$send_type = $request->send_type;

		$count_doc = DocRecordModel::where('DOC_NO','=', $doc_no)->count();

		$DocumentRecord = [
			'DOC_NO' => $doc_no,
			'CONTROL_CODE' => $control_code,
			'DOC_CATEGORY' => $doc_cat,
			'DOC_TYPE' => $doc_type,
			'DOC_DATE' => $doc_date,
			'DOC_TIME' => $doc_time,
			'ORIGIN_OFFICE' => $doc_origin_office,
			'DOC_ADDRESS' => $doc_address,
			'DOC_SUBJ' => $doc_subj,
			'DOC_CLASSIFICATION' => $doc_classification,
			'DOC_URGENT' => $doc_urgent,
			'REMARKS' => $doc_remarks,
			'STATUS' => 'F',
			'SIGNED' => 'N',
			'CREATED_BY' => $doc_processor
		];

		if($count_doc == 0) {

			DocRecordModel::insert($DocumentRecord);

		} else if($count_doc > 0) {

			DocRecordModel::where('DOC_NO','=', $doc_no)->update($DocumentRecord);

		}

		$data = [];

		foreach($doc_from as $id => $sender) {

			$count_sender = DocSenderModel::where('DOC_NO','=', $doc_no)
						  				  ->where('DOC_SENDER','=', $sender)
						  				  ->count();
			if($sender != '') {

				$sender_info = [
					'DOC_NO' => $doc_no,
					'DOC_SENDER' => $sender,
					'SENDER_TYPE' => $request->input('sender_type')[$id],
				];

				if($count_sender == 0) {

					DocSenderModel::insert($sender_info);

				} else if($count_sender > 0) {

					DocSenderModel::where('DOC_NO','=', $doc_no)
								  ->where('DOC_SENDER','=', $sender)
								  ->update($sender_info);
				}
			}

			$data[] = $sender;
		}

		DocSenderModel::where('DOC_NO','=', $doc_no)
					  ->whereNotIn('DOC_SENDER', $data)
					  ->delete();

		foreach($doc_to as $index => $col){

			$document_log = [
				'FW_NO' => 1,
				'DOC_FROM' => Auth::user()->id,
				'DOC_TO' => $request->input('doc_to')[$index],
				'DOC_NO' => $doc_no,
				'DOC_DT_LOG' => date('Y-m-d H:i:s'),
				'REC_DATE_TIME' => $date_time_start,
				'REL_DATE_TIME' => date('Y-m-d H:i:s'),
				'DOC_REMARKS' => $doc_remarks,
				'DOC_CATEGORY' => $doc_cat,
				'ACTION_TO_BE_TAKEN' => $request->input('doc_action')[$index],
				'SEEN' => 'N',
				'SEND_TYPE' => $send_type,
			];

			DocLogsModel::insert($document_log);

		}

		//HANDLES FILE ATTACHMENTS
		if($request->hasFile('attached_files')){

			$FILE_ATTACHMENTS = $request->attached_files;

			foreach($FILE_ATTACHMENTS AS $FILE){

				$EXTENSION = $FILE->getClientOriginalExtension();
				$DESCRIPTION = $FILE->getClientOriginalName();
				$SIZE = $FILE->getClientSize();
				$FILE_NAME = rand(11111111, 99999999). '.' . $EXTENSION;

				$FILE->move('DTS_UPLOADS/', $FILE_NAME);

				echo $FILE_NAME.' '.$FILE->getClientSize().'<br>';

				$FILE_RECORD = [
					'FW_NO' => 1,
					'DOC_NO' => $doc_no,
					'ATTACHMENT_DESC' => $DESCRIPTION,
					'FILE_ATTACHMENT' => $FILE_NAME,
					'FILE_TYPE' => $EXTENSION,
					'ATTACH_CLASS' => 'RC'
				];

				DocAttachmentsModel::insert($FILE_RECORD);
			}

		}

		$formid = $request->input('formid');

        $form_no = [

            'form_no' => $request->input('neworder_no'),
            'updated_by' => $user->id
                        
        ];

        if($count_doc == 0) {

        	FormNoModel::where('id', '=', $formid)->update($form_no); 

    	}

		Session::flash('success', 'Document ('.$doc_no.') successfully saved.');
		
		return back();

	}

}