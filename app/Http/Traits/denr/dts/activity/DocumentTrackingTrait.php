<?php

namespace App\Http\Traits\denr\dts\activity;

use Crypt;
use Auth;
use Session;
use Response;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;

use App\Models\denr\DTS_DocTypesModel as DocTypeModel;
use App\Models\denr\DTS_DocRecordModel as DocRecordModel;
use App\Models\denr\DTS_DocReceiverModel as DocReceiverModel;
use App\Models\denr\DTS_DocSenderModel as DocSenderModel;
use App\Models\denr\DTS_DocLogsModel as DocLogsModel;
use App\Models\denr\DTS_DocAttachmentsModel as DocAttachmentsModel;
use App\Models\denr\DTS_DocActionModel as DocActionModel;

use App\Models\denr\User as UserModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\Form_No as FormNoModel;

trait DocumentTrackingTrait
{
    public function getDocNo($category)
    {
        $user = Auth::user();
        if($category == 'IN') {
            if($user->user_role == '1' || $user->user_role == '3') {
                $valid_doc1 = DocRecordModel::select('DOC_NO')->where('CREATED_BY', '=', $user->id)->where('DOC_CATEGORY', '=', $category)->distinct('DOC_NO');
                $valid_doc2 = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $category)->distinct('DOC_NO');
                $valid_doc = $valid_doc1->union($valid_doc2)->get();
            } else if($user->user_role == '2' || $user->user_role == '4') {
                $valid_doc = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $category)->distinct('DOC_NO')->get();
            }
        } else if($category == 'OUT') {
            if($user->user_role == '2' || $user->user_role == '3') {
                $valid_doc1 = DocRecordModel::select('DOC_NO')->where('CREATED_BY', '=', $user->id)->where('DOC_CATEGORY', '=', $category)->distinct('DOC_NO');
                $valid_doc2 = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $category)->distinct('DOC_NO');
                $valid_doc = $valid_doc1->union($valid_doc2)->get();
            } else if($user->user_role == '1' || $user->user_role == '4') {
                $valid_doc = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $category)->distinct('DOC_NO')->get();
            }
        }
        return $valid_doc;
    }

    public function getDocuments($valid_doc,$category)
    {
        $model = new DocRecordModel;
        $data = $model->join('dts_document_types','dts_document_record.DOC_TYPE','=','dts_document_types.ID')
                      ->whereIn('dts_document_record.DOC_NO', $valid_doc)
                      ->where('dts_document_record.DOC_CATEGORY','=', $category)
                      ->orderBy('dts_document_record.DOC_DATE', 'DESC')
                      ->orderBy('dts_document_record.DOC_NO', 'DESC')
                      ->paginate(50);
        return $data;
    }

    function getCategory($category)
    {
        if($category == 'IN') { $cat_desc = 'Incoming Documents'; } 
        else if($category == 'OUT') { $cat_desc = 'Outgoing Documents'; }
        return $cat_desc;
    }

    public function toIndex($id){

        $category = strtoupper($id);
        $valid_doc = $this->getDocNo($category);
        $documents = $this->getDocuments($valid_doc,$category);
        $doc_count = count($documents);
        $cat_desc = $this->getCategory($category);
        return view('denr.dts.activity.documents', compact(['valid_doc','documents','doc_count','cat_desc','category']));
    }

    public function toPage($request)
    {
        $id = $request->input('category');
        $category = strtoupper($id);
        $valid_doc = $this->getDocNo($category);
        $documents = $this->getDocuments($valid_doc,$category);
        $doc_count = count($documents);
        return view('denr.dts.activity.documentPage', compact(['documents','doc_count']));
    }

    public function toSearch(){

        $doc_cat = Input::get('doc_cat');
        $search_doc = Input::get('search_doc');
        $valid_doc = $this->getDocNo($doc_cat);

        $query = DocRecordModel::query();
        $query = $query->join('dts_document_types','dts_document_record.DOC_TYPE','=','dts_document_types.ID');
        $query = $query->whereIn('dts_document_record.DOC_NO', $valid_doc);
        $query = $query->where('dts_document_record.DOC_CATEGORY', '=', $doc_cat);

        if($search_doc != '' && $search_doc != '*') {
            $documents = $query->where('dts_document_record.DOC_CATEGORY', '=', $doc_cat)
                               ->where(function($subquery) use ($search_doc) {
                                    $subquery->where('dts_document_record.DOC_NO', 'LIKE', '%'.$search_doc.'%')
                                             ->orWhere('dts_document_record.CONTROL_CODE', 'LIKE', '%'.$search_doc.'%')
                                             ->orWhere('dts_document_record.ORIGIN_OFFICE', 'LIKE', '%'.$search_doc.'%')
                                             ->orWhere('dts_document_record.DOC_ADDRESS', 'LIKE', '%'.$search_doc.'%')
                                             ->orWhere('dts_document_record.DOC_SUBJ', 'LIKE', '%'.$search_doc.'%')
                                             ->orWhere('dts_document_record.REMARKS', 'LIKE', '%'.$search_doc.'%'); 
                                })->orderBy('dts_document_record.DOC_DATE', 'DESC')
                                  ->orderBy('dts_document_record.DOC_NO', 'DESC')
                                  ->paginate(50);
        } else if($search_doc == '*' || $search_doc == '') {
            $documents = $query->where('dts_document_record.DOC_CATEGORY', '=', $doc_cat) 
                               ->orderBy('dts_document_record.DOC_DATE', 'DESC')
                               ->orderBy('dts_document_record.DOC_NO', 'DESC')
                               ->paginate(50);
        } 

        $doc_count = count($documents);
        return view('denr.dts.activity.documentPageSearch', compact(['documents','doc_count']));

    }

    public function toFilter(){

        $doc_cat = Input::get('doc_cat');
        $doc_from = Input::get('doc_from');
        $doc_to = Input::get('doc_to');
        $doc_type = Input::get('doc_type');
        $doc_class = Input::get('doc_class');
        $doc_urgent = Input::get('doc_urgent');
        $doc_status = Input::get('doc_status');
        $doc_signed = Input::get('doc_signed');

        $valid_doc = $this->getDocNo($doc_cat);

        $query = DocRecordModel::query();
        $query = $query->join('dts_document_types','dts_document_record.DOC_TYPE','=','dts_document_types.ID');
        $query = $query->whereIn('dts_document_record.DOC_NO', $valid_doc);

        if (Input::has('doc_from')) { $query = $query->where('dts_document_record.DOC_DATE', '>=', $doc_from); }
        if (Input::has('doc_to')) { $query = $query->where('dts_document_record.DOC_DATE', '<=', $doc_to); }
        if (Input::has('doc_type')) { $query = $query->where('dts_document_record.DOC_TYPE', '=', $doc_type); }
        if (Input::has('doc_class')) { $query = $query->where('dts_document_record.DOC_CLASSIFICATION', '=', $doc_class); }
        if (Input::has('doc_urgent')) { $query = $query->where('dts_document_record.DOC_URGENT', '=', $doc_urgent); }
        if (Input::has('doc_signed')) { $query = $query->where('dts_document_record.SIGNED', '=', $doc_signed); }
        if (Input::has('doc_status')) { $query = $query->where('dts_document_record.STATUS', '=', $doc_status); }

        $query = $query->where('dts_document_record.DOC_CATEGORY', '=', $doc_cat);
        $documents = $query->orderBy('dts_document_record.DOC_DATE', 'DESC')
                           ->orderBy('dts_document_record.DOC_NO', 'DESC')
                           ->paginate(50);

        $doc_count = count($documents);
        return view('denr.dts.activity.documentPageFilter', compact(['documents','doc_count']));
    }

    public function toCreate(){

        $form = FormNoModel::where('id','=','2')->first();
        $doc_action = DocActionModel::where('ID','!=','14')->orderBy('ID','ASC')->get();

        $str = $form->form_no;
        $no = strlen($str);
        $new_no = str_pad($form->form_no+1, $no, "0", STR_PAD_LEFT);
        $cur_no = str_pad($form->form_no, $no, "0", STR_PAD_LEFT); 
        return view('denr.dts.activity.adddocuments')
             ->with('formno', $form)
             ->with('new_no', $new_no)
             ->with('cur_no', $cur_no)
             ->with('doc_action', $doc_action);
    }

    public function toInsert(Request $request)
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

    public function toView($id, $id2){

        $user = Auth::user();
        $doc_no = decrypt($id);
        $type = $id2;

        $this->viewSeenLogs($doc_no);
        
        $document_details = DocRecordModel::where('DOC_NO', '=', $doc_no)->first();
        $document_attachments = DocAttachmentsModel::where('DOC_NO', '=', $doc_no)->where('ATTACH_CLASS', '=', 'RC')->get();
        $document_senders1 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->first();
        $document_senders2 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->skip(1)->take(100)->get();
        $document_senders3 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->get();
        $document_receivers = DocReceiverModel::where('DOC_NO', '=', $doc_no)->get();

        $return_to = DocLogsModel::where('DOC_NO', '=', $doc_no)->where('DOC_TO', '=', $user->id)->first();
        $form = FormNoModel::where('id','=','2')->first();
        $str = $form->form_no;
        $no = strlen($str);
        $new_no = str_pad($form->form_no+1, $no, "0", STR_PAD_LEFT);
        $cur_no = str_pad($form->form_no, $no, "0", STR_PAD_LEFT);

        $document_logs = DocRecordModel::select('dts_document_logs.*', 'dts_document_record.*', 'dts_action_to_be_taken.ACTION', 'user_from.fname as from_fname', 'user_from.lname as from_lname', 'user_to.fname as to_fname', 'user_to.lname as to_lname')
                                       ->leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                                       ->join('users as user_from','dts_document_logs.DOC_FROM','=','user_from.id')
                                       ->join('users as user_to','dts_document_logs.DOC_TO','=','user_to.id')
                                       ->join('dts_action_to_be_taken','dts_document_logs.ACTION_TO_BE_TAKEN','=','dts_action_to_be_taken.ID')
                                       ->where('dts_document_logs.DOC_NO','=', $doc_no)
                                       ->orderBy('dts_document_logs.ID', 'ASC')
                                       ->get();

        $for_end = DocLogsModel::where('DOC_NO','=', $doc_no)->orderBy('REL_DATE_TIME','DESC')->first();

        $lastLog = DocLogsModel::select('DOC_FROM')->where('DOC_NO', '=', $doc_no)->orderBy('FW_NO','DESC')->first();
        
        return view('denr.dts.activity.viewdocuments')
                ->with('documents', $document_details)
                ->with('attachments', $document_attachments)
                ->with('senders1', $document_senders1)
                ->with('senders2', $document_senders2)
                ->with('senders3', $document_senders3)
                ->with('receivers', $document_receivers)
                ->with('formno', $form)
                ->with('new_no', $new_no)
                ->with('cur_no', $cur_no)
                ->with('id', $id)
                ->with('for_end', $for_end)
                ->with('history_logs', $document_logs)
                ->with('end_user', $lastLog['DOC_FROM']);
    }

    public function viewSeenLogs($doc_no){

        $doc_to = Auth::user()->id;
        $checkStatus = $this->viewSeenStatus($doc_no,$doc_to);

        if($checkStatus == 'N') {
            $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
            DocLogsModel::where('DOC_TO', '=', $doc_to)
                        ->where('DOC_NO', '=', $doc_no)
                        ->update($seen_log);
        }
    }

    public function viewSeenStatus($doc_no,$doc_to)
    {
        $model = new DocLogsModel;
        $data = $model->select('SEEN')->where('DOC_NO','=',$doc_no)->where('DOC_TO','=',$doc_to)->orderBy('DOC_DT_LOG','DESC')->first();
        return $data['SEEN'];
    }

    public function toForward(Request $request)
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
                'REC_DATE_TIME' => $forward->SEEN_DATE_TIME,
                'REL_DATE_TIME' => date('Y-m-d H:i:s'),
                'DOC_REMARKS' => $doc_remarks,
                'DOC_CATEGORY' => $doc_cat,
                'ACTION_TO_BE_TAKEN' => $request->input('doc_action')[$index],
                'SEEN' => 'N',
                'SEND_TYPE' => $send_type,
            ];

            DocLogsModel::insert($document_log);
        }

        $doc_action = ['ACTION_STATUS' => 1];
        DocLogsModel::where('ID','=', $forward->ID)->update($doc_action);

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

        $document_rec_stat_update = ['STATUS' => 'F'];
        DocRecordModel::where('DOC_NO', '=', $doc_no)->update($document_rec_stat_update);
        return back();
    }

    public function toComplete(Request $request)
    {
        $user = Auth::user();
        $com_id = $request->input('com_id');
        $doc_cat = $request->input('doc_cat');
        $remarks = $request->input('end_remarks');
        $date2day = date('Y-m-d');
        $encode = Crypt::encrypt($com_id);

        $forward = DocLogsModel::where('DOC_NO', '=', $com_id)->orderBy('FW_NO', 'DESC')->first();
        $released = DocLogsModel::where('DOC_NO', '=', $com_id)->orderBy('ID', 'DESC')->first();

        $document_log = [
            'FW_NO' => $forward->FW_NO + 1,
            'DOC_FROM' => $forward->DOC_TO,
            'DOC_TO' => $forward->DOC_TO,
            'DOC_NO' => $com_id,
            'DOC_DT_LOG' => date('Y-m-d H:i:s'),
            'REC_DATE_TIME' => $forward->SEEN_DATE_TIME,
            'REL_DATE_TIME' => date('Y-m-d H:i:s'),
            'DOC_REMARKS' => $remarks,
            'DOC_CATEGORY' => $doc_cat,
            'ACTION_TO_BE_TAKEN' => 14,
            'ACTION_STATUS' => 1,
            'SEEN' => 'Y',
            'SEEN_DATE_TIME' => date('Y-m-d H:i:s'),
            'SEND_TYPE' => 'FW',
        ];

        DocLogsModel::insert($document_log);

        $doc_action = ['ACTION_STATUS' => 1];
        DocLogsModel::where('ID','=', $forward->ID)->update($doc_action);

        $complete = ['STATUS' => 'C', 'COMPLETED_BY' => $user->id, 'DATE_COMPLETED' => date('Y-m-d H:i:s')];
        DocRecordModel::where('DOC_NO', '=', $com_id)->update($complete);
                    
        $window_page = 'Document';
        $module_code = 'DTS';
        $window_type = 'ACT';
        $action_type = 'APPROVE';
        $remarks = 'Ended Document '.$com_id;
                                            
        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
        Session::flash('success', ' Document ('.$com_id.') successfully ended.');
        return back();

    }

    public function checkSeenStatus($id)
    {
        $model = new DocLogsModel;
        $data = $model->select('SEEN')->where('ID','=',$id)->first();
        return $data['SEEN'];
    }

    public function toSeen(Request $request) {

        $log_id = $request->log_id;
        $checkStatus = $this->checkSeenStatus($log_id);

        if($checkStatus == 'N') {
            $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
            DocLogsModel::where('ID', '=', $log_id)->update($seen_log);
            Session::flash('success', 'Marked as Seen.');
            return back();
        }
    }

    public function toDownload($id, $id2, $id3){

        if(Auth::user()->id == $id3) {
            $checkStatus = $this->checkSeenStatus($id2);
            if($checkStatus == 'N') {
                $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
                DocLogsModel::where('ID', '=', $id2)->update($seen_log);
            }
        }
        $filename = $id;
        $filepath = public_path('DTS_UPLOADS/').$filename;
        return Response::download($filepath);
    }

    public function toPreview($id, $id2, $id3, $id4){

        if(Auth::user()->id == $id4) {
            $checkStatus = $this->checkSeenStatus($id2);
            if($checkStatus == 'N') {
                $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
                DocLogsModel::where('ID', '=', $id2)->update($seen_log);
            }
        }

        $attach = DocAttachmentsModel::where('ID', '=', $id)->first();
        $filename = $attach->FILE_ATTACHMENT;
        $path = public_path('DTS_UPLOADS/'.$filename);

        if($id3 == 'Pdf File') {
            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        } else if($id3 == 'Video File') {
            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => 'video/mp4',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        } else if($id3 == 'Image File') {
            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => 'image/jpeg',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        }
    }

    public function toPrintSlip($id) {

        $user = Auth::user();
        $doc_no = decrypt($id);
        $document_details = DocRecordModel::where('DOC_NO', '=', $doc_no)->first();
        $document_type = DocTypeModel::where('ID', '=', $document_details->DOC_TYPE)->first();
        $document_user = UserModel::where('id', '=', $document_details->CREATED_BY)->first();
        $document_attachments = DocAttachmentsModel::where('DOC_NO', '=', $doc_no)->where('ATTACH_CLASS', '=', 'RC')->get();
        $document_senders1 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->first();
        $document_senders2 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->get();
        $document_receivers = DocReceiverModel::where('DOC_NO', '=', $doc_no)->get();
        
        $return_to = DocLogsModel::where('DOC_NO', '=', $doc_no)->where('DOC_TO', '=', $user->id)->first();
        $form = FormNoModel::where('id','=','2')->first();
        $str = $form->form_no;
        $no = strlen($str);
        $new_no = str_pad($form->form_no+1, $no, "0", STR_PAD_LEFT);
        $cur_no = str_pad($form->form_no, $no, "0", STR_PAD_LEFT);

        $document_logs = DocRecordModel::select('dts_document_logs.*', 'dts_document_record.*' , 'dts_action_to_be_taken.ACTION', 'user_from.fname as from_fname', 'user_from.lname as from_lname', 'user_to.fname as to_fname', 'user_to.lname as to_lname')
                                       ->leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                                       ->join('users as user_from','dts_document_logs.DOC_FROM','=','user_from.id')
                                       ->join('users as user_to','dts_document_logs.DOC_TO','=','user_to.id')
                                       ->join('dts_action_to_be_taken','dts_document_logs.ACTION_TO_BE_TAKEN','=','dts_action_to_be_taken.ID')
                                       ->where('dts_document_logs.DOC_NO','=', $doc_no)
                                       ->orderBy('dts_document_logs.ID', 'ASC')
                                       ->get();

        return view('denr.dts.activity.printslip')
                ->with('documents', $document_details)
                ->with('doc_type', $document_type)
                ->with('doc_user', $document_user)
                ->with('attachments', $document_attachments)
                ->with('senders1', $document_senders1)
                ->with('senders2', $document_senders2)
                ->with('receivers', $document_receivers)
                ->with('formno', $form)
                ->with('new_no', $new_no)
                ->with('cur_no', $cur_no)
                ->with('id', $id)
                ->with('history_logs', $document_logs);
    }

    public function toPrintManual($id) {

        $user = Auth::user();
        $doc_no = decrypt($id);
        $document_details = DocRecordModel::where('DOC_NO', '=', $doc_no)->first();
        $document_type = DocTypeModel::where('ID', '=', $document_details->DOC_TYPE)->first();
        $document_user = UserModel::where('id', '=', $document_details->CREATED_BY)->first();
        $document_attachments = DocAttachmentsModel::where('DOC_NO', '=', $doc_no)->where('ATTACH_CLASS', '=', 'RC')->get();
        $document_senders1 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->first();
        $document_senders2 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->get();
        $document_receivers = DocReceiverModel::where('DOC_NO', '=', $doc_no)->get();
        
        $return_to = DocLogsModel::where('DOC_NO', '=', $doc_no)->where('DOC_TO', '=', $user->id)->first();
        $form = FormNoModel::where('id','=','2')->first();
        $str = $form->form_no;
        $no = strlen($str);
        $new_no = str_pad($form->form_no+1, $no, "0", STR_PAD_LEFT);
        $cur_no = str_pad($form->form_no, $no, "0", STR_PAD_LEFT);

        $document_logs = DocRecordModel::select('dts_document_logs.*', 'dts_document_record.*' , 'dts_action_to_be_taken.ACTION', 'user_from.fname as from_fname', 'user_from.lname as from_lname', 'user_to.fname as to_fname', 'user_to.lname as to_lname')
                                       ->leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                                       ->join('users as user_from','dts_document_logs.DOC_FROM','=','user_from.id')
                                       ->join('users as user_to','dts_document_logs.DOC_TO','=','user_to.id')
                                       ->join('dts_action_to_be_taken','dts_document_logs.ACTION_TO_BE_TAKEN','=','dts_action_to_be_taken.ID')
                                       ->where('dts_document_logs.DOC_NO','=', $doc_no)
                                       ->orderBy('dts_document_logs.ID', 'ASC')
                                       ->limit(1)
                                       ->get();

        return view('denr.dts.activity.manualslip')
                ->with('documents', $document_details)
                ->with('doc_type', $document_type)
                ->with('doc_user', $document_user)
                ->with('attachments', $document_attachments)
                ->with('senders1', $document_senders1)
                ->with('senders2', $document_senders2)
                ->with('receivers', $document_receivers)
                ->with('formno', $form)
                ->with('new_no', $new_no)
                ->with('cur_no', $cur_no)
                ->with('id', $id)
                ->with('history_logs', $document_logs);
    }

    public function ajaxDocNoFunction(Request $request) {

        $cat = $request->input('category');

        if($cat == 'IN') {  $id = '2'; } 
        else if($cat == 'OUT') { $id = '3'; }

        $form = FormNoModel::where('id','=', $id)->first();
        $str = $form->form_no;
        $no = strlen($str);
        $new_no = str_pad($form->form_no+1, $no, "0", STR_PAD_LEFT);
        $cur_no = str_pad($form->form_no, $no, "0", STR_PAD_LEFT); 

        $doc['doc_no'] = $form->form_text.$cur_no;
        $doc['form_id'] = $form->id;
        $doc['new_no'] = $new_no;
        return response($doc);
    }

    

    public function AjaxHistoryLogsDocumentFunction(Request $request){

        $id = $request->input('doc_no');
        
        $doc_sender1 = DocSenderModel::select('users.fname as fname', 'users.lname as lname', 'dts_document_sender.DOC_NO as DOC_NO' , 'dts_document_sender.SENDER_TYPE as SENDER_TYPE')
                                     ->join('users','dts_document_sender.DOC_SENDER','=', 'users.id')
                                     ->where('dts_document_sender.DOC_NO','=',$id)
                                     ->where('dts_document_sender.SENDER_TYPE','=','IN');

        $doc_sender2 = DocSenderModel::select('dts_document_sender.DOC_SENDER as fname', 'dts_document_sender.DOC_SENDER as lname', 'dts_document_sender.DOC_NO as DOC_NO' , 'dts_document_sender.SENDER_TYPE as SENDER_TYPE')
                                     ->where('DOC_NO','=',$id)
                                     ->where('SENDER_TYPE','=','OUT');

        $doc_sender = $doc_sender1->union($doc_sender2)->get();

        $document_logs = DocRecordModel::select('dts_document_logs.*', 'dts_document_record.*', 'dts_action_to_be_taken.ACTION', 'user_from.fname as from_fname', 'user_from.lname as from_lname', 'user_to.fname as to_fname', 'user_to.lname as to_lname')
                                       ->leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                                       ->join('users as user_from','dts_document_logs.DOC_FROM','=','user_from.id')
                                       ->join('users as user_to','dts_document_logs.DOC_TO','=','user_to.id')
                                       ->join('dts_action_to_be_taken','dts_document_logs.ACTION_TO_BE_TAKEN','=','dts_action_to_be_taken.ID')
                                       ->where('dts_document_logs.DOC_NO','=', $id)
                                       ->orderBy('dts_document_logs.ID', 'ASC')
                                       ->get();

        $response['history'] = $document_logs;
        $response['doc_sender'] = $doc_sender;
        return json_encode($response);
    }

    public function AjaxAttachmentFunction(Request $request){

        $id = $request->input('doc_no');
        $attach_class = $request->input('send_type');
        $attachments = DocAttachmentsModel::where('DOC_NO','=', $id)
                                          ->where('ATTACH_CLASS','=', $attach_class)
                                          ->get();

        $response['attachments'] = $attachments;
        return json_encode($response);
    }

    public function LogAttachmentAjaxFunction(Request $request){

        $log_id = $request->input('log_id');
        $fw_no = $request->input('forward_no');
        $doc_no = $request->input('doc_no');
        $doc_to = $request->input('doc_to');
       
        $attachments = DocAttachmentsModel::where('DOC_NO','=', $doc_no)
                                          ->where('FW_NO','=', $fw_no)
                                          ->get();

        $response['attachments'] = $attachments;
        $response['log_id'] = $log_id;
        $response['doc_to'] = $doc_to;
        return json_encode($response);
    }

    public function toSign(Request $request)
    {
        $user = Auth::user();
        $com_id = $request->input('com_id');
        $date2day = date('Y-m-d');
        $encode = Crypt::encrypt($com_id);

        $signed = ['SIGNED' => 'Y', 'SIGNED_BY' => $user->id, 'DATE_SIGNED' => date('Y-m-d H:i:s')];
        DocRecordModel::where('DOC_NO', '=', $com_id)->update($signed);
                    
        $window_page = 'Document';
        $module_code = 'DTS';
        $window_type = 'ACT';
        $action_type = 'APPROVE';
        $remarks = 'Signed Document '.$com_id;
                                            
        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
        Session::flash('success', ' Document ('.$com_id.') successfully Signed.');
        return back();
    }
}