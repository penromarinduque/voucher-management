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
use App\Models\denr\User as UserModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\Form_No as FormNoModel;
use App\Models\denr\DTS_DocRecordModel as DocRecordModel;
use App\Models\denr\DTS_DocReceiverModel as DocReceiverModel;
use App\Models\denr\DTS_DocSenderModel as DocSenderModel;
use App\Models\denr\DTS_DocLogsModel as DocLogsModel;
use App\Models\denr\DTS_DocAttachmentsModel as DocAttachmentsModel;
use App\Models\denr\DTS_DocActionModel as DocActionModel;


trait DocumentTrackingTrait
{

    public function DocumentsFunction($id){

        $user = Auth::user();

        $category = strtoupper($id);

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
        

        $documents = DocRecordModel::join('dts_document_types','dts_document_record.DOC_TYPE','=','dts_document_types.ID')
                                   ->whereIn('dts_document_record.DOC_NO', $valid_doc)
                                   ->where('dts_document_record.DOC_CATEGORY','=', $category)
                                   ->where('dts_document_record.DOC_DATE', '>=', date('Y-m-01'))
                                   ->where('dts_document_record.DOC_DATE', '<=', date('Y-m-d'))
                                   ->orderBy('dts_document_record.DOC_DATE', 'DESC')
                                   ->orderBy('dts_document_record.DOC_NO', 'DESC')
                                   ->get();

        if($category == 'IN') {
            $cat_desc = 'Incoming Documents';
        } else if($category == 'OUT') {
            $cat_desc = 'Outgoing Documents';
        }

        $doc_count = count($documents);
        return view('denr.dts.activity.documents')
             ->with('valid_doc', $valid_doc)
             ->with('documents', $documents)
             ->with('doc_count', $doc_count)
             ->with('cat_desc', $cat_desc)
             ->with('category', $category);

    }

    /*public function OutgoingDocumentsFunction(){

        $user = Auth::user();

        if($user->user_type == '3') {

            if($user->user_role == '4') {

                $valid_doc = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', 'OUT')->distinct('DOC_NO')->get();
            
            } else {

                $valid_doc = DocRecordModel::select('DOC_NO')->where('CREATED_BY', '=', $user->id)->where('DOC_CATEGORY', '=', 'OUT')->distinct('DOC_NO')->get();

            }

        } else if($user->user_type != '3') {

            if($user->user_role == '2' || $user->user_role == '3') {
            
                $valid_doc = DocRecordModel::select('DOC_NO')->where('CREATED_BY', '=', $user->id)->where('DOC_CATEGORY', '=', 'OUT')->distinct('DOC_NO')->get();

            } else if($user->user_role == '1' || $user->user_role == '4') {

                $valid_doc = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', 'OUT')->distinct('DOC_NO')->get();
            }
        }

        $documents = DocRecordModel::join('dts_document_types','dts_document_record.DOC_TYPE','=','dts_document_types.ID')
                                   ->whereIn('dts_document_record.DOC_NO', $valid_doc)
                                   ->where('dts_document_record.DOC_CATEGORY','=', 'OUT')
                                   ->where('dts_document_record.DOC_DATE', '>=', date('Y-m-01'))
                                   ->where('dts_document_record.DOC_DATE', '<=', date('Y-m-d'))
                                   ->orderBy('dts_document_record.DOC_NO', 'ASC')
                                   ->get();

        $doc_count = count($documents);
        return view('denr.dts.activity.outgoing_documents')
             ->with('documents', $documents)
             ->with('doc_count', $doc_count);

    }*/

    public function FilterDocumentsFunction(){

        $doc_cat = Input::get('doc_cat');
        $doc_from = Input::get('doc_from');
        $doc_to = Input::get('doc_to');
        $doc_type = Input::get('doc_type');
        $doc_class = Input::get('doc_class');
        $doc_urgent = Input::get('doc_urgent');
        $doc_status = Input::get('doc_status');
        $doc_signed = Input::get('doc_signed');

        $user = Auth::user();

        if($doc_cat == 'IN') {

            if($user->user_role == '1' || $user->user_role == '3') {
            
                $valid_doc1 = DocRecordModel::select('DOC_NO')->where('CREATED_BY', '=', $user->id)->where('DOC_CATEGORY', '=', $doc_cat)->distinct('DOC_NO');

                $valid_doc2 = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $doc_cat)->distinct('DOC_NO');

                $valid_doc = $valid_doc1->union($valid_doc2)->get();

            } else if($user->user_role == '2' || $user->user_role == '4') {

                $valid_doc = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $doc_cat)->distinct('DOC_NO')->get();
            }

        } else if($doc_cat == 'OUT') {

            if($user->user_role == '2' || $user->user_role == '3') {
            
                $valid_doc1 = DocRecordModel::select('DOC_NO')->where('CREATED_BY', '=', $user->id)->where('DOC_CATEGORY', '=', $doc_cat)->distinct('DOC_NO');

                $valid_doc2 = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $doc_cat)->distinct('DOC_NO');

                $valid_doc = $valid_doc1->union($valid_doc2)->get();

            } else if($user->user_role == '1' || $user->user_role == '4') {

                $valid_doc = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->where('DOC_CATEGORY', '=', $doc_cat)->distinct('DOC_NO')->get();
            }

        }

        $query = DocRecordModel::query();

        $query = $query->join('dts_document_types','dts_document_record.DOC_TYPE','=','dts_document_types.ID');

        $query = $query->whereIn('dts_document_record.DOC_NO', $valid_doc);

        if (Input::has('doc_from')) {

            $query = $query->where('dts_document_record.DOC_DATE', '>=', Input::get('doc_from'));
        }

        if (Input::has('doc_to')) {
            $query = $query->where('dts_document_record.DOC_DATE', '<=', Input::get('doc_to'));
        }

        if (Input::has('doc_type')) {
            $query = $query->where('dts_document_record.DOC_TYPE', '=', Input::get('doc_type'));
        }

        if (Input::has('doc_class')) {
            $query = $query->where('dts_document_record.DOC_CLASSIFICATION', '=', Input::get('doc_class'));
        }

        if (Input::has('doc_urgent')) {
            $query = $query->where('dts_document_record.DOC_URGENT', '=', Input::get('doc_urgent'));
        }

        if (Input::has('doc_signed')) {
            $query = $query->where('dts_document_record.SIGNED', '=', Input::get('doc_signed'));
        }

        if (Input::has('doc_status')) {
            $query = $query->where('dts_document_record.STATUS', '=', Input::get('doc_status'));
        }

        $query = $query->where('dts_document_record.DOC_CATEGORY', '=', Input::get('doc_cat'));

        $doc_record = $query->orderBy('dts_document_record.DOC_DATE', 'DESC') ->orderBy('dts_document_record.DOC_NO', 'DESC')->get();

        $doc_count = count($doc_record);

        return view('denr.dts.activity.documentdata')->with('documents', $doc_record)->with('doc_count', $doc_count);

    }


    public function DownloadAttachmentFunction($id, $id2, $id3){

        if(Auth::user()->id == $id3) {

            $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
            DocLogsModel::where('ID', '=', $id2)->update($seen_log);

        }

        $filename = $id;
        $filepath = public_path('DTS_UPLOADS/').$filename;
        return Response::download($filepath);

    }

    public function PreviewAttachmentFunction($id, $id2, $id3, $id4){

        if(Auth::user()->id == $id4) {

            $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
            DocLogsModel::where('ID', '=', $id2)->update($seen_log);

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

    public function SeenLogFunction(Request $request){

        $log_id = $request->log_id;
        $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
        DocLogsModel::where('ID', '=', $log_id)->update($seen_log);

        Session::flash('success', 'Marked as Seen.');
        return back();

    }

    public function ViewSeenLogFunction($doc_no){

        $seen_log = ['SEEN' => 'Y', 'SEEN_DATE_TIME' => date('Y-m-d H:i:s')];
        DocLogsModel::where('DOC_TO', '=', Auth::user()->id)
                    ->where('DOC_NO', '=', $doc_no)
                    ->update($seen_log);

    }

    public function PrintDocumentSlipFunction($id) {

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


    public function AddDocumentsFunction(){

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

    public function ForwardedDocumentsFunction(){

        $user = Auth::user();
        //$doc_no = DocLogsModel::select('DOC_NO')->where('DOC_FROM', '=', $user->id)->get();
        $doc_forwarded = DocRecordModel::leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                                        ->where('dts_document_logs.DOC_FROM','=', $user->id)
                                        ->orderBy('dts_document_logs.DOC_DT_LOG', 'DESC')
                                        ->get();

        $doc_count = count($doc_forwarded);

    	return view('denr.dts.activity.forwardeddocuments')
             ->with('doc_forwarded', $doc_forwarded)
             ->with('doc_count', $doc_count);

    }

    public function ReceivedDocumentsFunction(){

        $user = Auth::user();
        //$doc_no = DocLogsModel::select('DOC_NO')->where('DOC_TO', '=', $user->id)->get();
        $doc_received = DocRecordModel::leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                                        ->where('dts_document_logs.DOC_TO','=', $user->id)
                                        ->orderBy('dts_document_logs.DOC_DT_LOG', 'DESC')
                                        ->get();
                                        
        $doc_count = count($doc_received);
        //$doc_received = DocLogsModel::where('DOC_TO', '=', $user->id)->get();
    	return view('denr.dts.activity.receiveddocuments')
             ->with('doc_received', $doc_received)
             ->with('doc_count', $doc_count);
    	
    }

    public function ajaxDocNoFunction(Request $request) {

        $cat = $request->input('category');

        if($cat == 'IN') {

            $id = '2';

        } else if($cat == 'OUT') {

            $id = '3';
        }

        $form = FormNoModel::where('id','=', $id)->first();

        $str = $form->form_no;
        $no = strlen($str);
        $new_no = str_pad($form->form_no+1, $no, "0", STR_PAD_LEFT);
        $cur_no = str_pad($form->form_no, $no, "0", STR_PAD_LEFT); 

        $doc['doc_no'] = $form->form_text.$cur_no;
        $doc['form_id'] = $form->id;
        $doc['new_no'] = $new_no;

        return response($doc);

        /*$id = $request->id;

        $auto_gen_doc_no_query = FormNoModel::select('form_no')->where('DOC_TYPE', '=', $id)->first();

        $auto_gen_doc_no = $auto_gen_doc_no_query['form_no'];
        $gen_no_len = ltrim($auto_gen_doc_no, '0');

        $gen_no_val = (int)$gen_no_len + 1;

        if(strlen($gen_no_val) == 1){
            $gen_no_val = '00000'.$gen_no_val;
        }elseif(strlen($gen_no_val) == 2){
            $gen_no_val = '0000'.$gen_no_val;
        }elseif(strlen($gen_no_val) == 3){
            $gen_no_val = '000'.$gen_no_val;
        }elseif(strlen($gen_no_val) == 4){
            $gen_no_val = '00'.$gen_no_val;
        }elseif(strlen($gen_no_val) == 5){
            $gen_no_val = '0'.$gen_no_val;
        }elseif(strlen($gen_no_val) == 6){
            $gen_no_val = $gen_no_val;
        }

        $prefix = FormNoModel::select('form_text')->where('DOC_TYPE', '=', $id)->first();
        $gen_no_val = $prefix['form_text'].''.$gen_no_val;

        return response($gen_no_val);*/
    }

    public function ViewDocumentsFunction($id, $id2){

        $user = Auth::user();
        $doc_no = decrypt($id);
        $type = $id2;
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

        $this->ViewSeenLogFunction($doc_no);
        
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
                ->with('history_logs', $document_logs);

        
    }

    /*public function ViewHistoryLogsDocumentFunction($id){

        $id = decrypt($id);
        $document_logs = DocLogsModel::where('DOC_NO', '=', $id)->get();
        return view('denr.dts.activity.historydocuments')
                ->with('doc_logs', $document_logs);
    }*/

    public function AjaxHistoryLogsDocumentFunction(Request $request){

        $id = $request->input('doc_no');
        //$document_logs = DocLogsModel::where('DOC_NO', '=', $id)->get();

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
        //$document_logs = DocLogsModel::where('DOC_NO', '=', $id)->get();

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
                                          ->orWhere('DOC_NO','=', $doc_no)
                                          ->where('FW_NO','=', 1)
                                          ->where('ATTACH_CLASS','=', 'RC')
                                          ->get();

        $response['attachments'] = $attachments;
        $response['log_id'] = $log_id;
        $response['doc_to'] = $doc_to;

        return json_encode($response);
    }


    public function DocumentCompleteFunction(Request $request)
    {

        $user = Auth::user();

        $com_id = $request->input('com_id');
        $doc_cat = $request->input('doc_cat');
        $date2day = date('Y-m-d');
        $encode = Crypt::encrypt($com_id);

        $complete = ['STATUS' => 'C', 'COMPLETED_BY' => $user->id, 'DATE_COMPLETED' => date('Y-m-d H:i:s')];

        DocRecordModel::where('DOC_NO', '=', $com_id)->update($complete);


        $forward = DocLogsModel::where('DOC_NO', '=', $com_id)->orderBy('FW_NO', 'DESC')->first();
        $released = DocLogsModel::where('DOC_NO', '=', $com_id)->orderBy('ID', 'DESC')->first();

        $document_log = [

            'FW_NO' => $forward->FW_NO + 1,
            'DOC_FROM' => $released->DOC_FROM,
            'DOC_TO' => $released->DOC_TO,
            'DOC_NO' => $com_id,
            'DOC_DT_LOG' => date('Y-m-d H:i:s'),
            'REC_DATE_TIME' => $released->REL_DATE_TIME,
            'REL_DATE_TIME' => date('Y-m-d H:i:s'),
            'DOC_REMARKS' => 'Released/Completed',
            'DOC_CATEGORY' => $doc_cat,
            'ACTION_TO_BE_TAKEN' => 14,
            'ACTION_STATUS' => 1,
            'SEEN' => 'Y',
            'SEEN_DATE_TIME' => date('Y-m-d H:i:s'),
            'SEND_TYPE' => 'FW',

        ];

        DocLogsModel::insert($document_log);

        //UPDATE ACTION STATUS
        $doc_action = ['ACTION_STATUS' => 1];
        DocLogsModel::where('ID','=', $forward->ID)->update($doc_action);
                    
        $window_page = 'Document';
        $module_code = 'DTS';
        $window_type = 'ACT';
        $action_type = 'APPROVE';
        $remarks = 'Ended Document '.$com_id;
                                            
        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
        
        Session::flash('success', ' Document ('.$com_id.') successfully ended.');

        return back();

    }

    public function DocumentSignFunction(Request $request)
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