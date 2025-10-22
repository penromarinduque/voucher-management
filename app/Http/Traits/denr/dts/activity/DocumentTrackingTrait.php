<?php

namespace App\Http\Traits\denr\dts\activity;

use Crypt;
use Auth;
use Session;
use Response;
use DB;
use Illuminate\Http\Request;


use App\Models\denr\DTS_DocTypesModel as DocTypeModel;
use App\Models\denr\DTS_DocRecordModel as DocRecordModel;
use App\Models\denr\DTS_DocReceiverModel as DocReceiverModel;
use App\Models\denr\DTS_DocSenderModel as DocSenderModel;
use App\Models\denr\DTS_DocLogsModel as DocLogsModel;
use App\Models\denr\DTS_DocAttachmentsModel as DocAttachmentsModel;
use App\Models\denr\DTS_DocActionModel as DocActionModel;

use App\Models\denr\User as UserModel;
use App\Models\denr\Form_No as FormNoModel;
use App\Notifications\VoucherPaidNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

trait DocumentTrackingTrait
{
    public function getDocNo($category)
    {
        $user = Auth::user();

        $ongoing_doc_ids = DocLogsModel::select('DOC_NO')
            ->where([
                'ACTION_STATUS' => 0,
                'DOC_TO' => $user->id,
                'DOC_CATEGORY' => $category
            ])
            ->distinct()
            ->get();

        $incoming_doc_ids = $ongoing_doc_ids; // No need to repeat the query

        $completed_doc_ids = DocLogsModel::select('DOC_NO')
            ->where([
                'ACTION_TO_BE_TAKEN' => 14,
                'DOC_TO' => $user->id
            ])
            ->orWhere([
                'ACTION_TO_BE_TAKEN' => 14,
                'DOC_FROM' => $user->id
            ])
            ->whereNotIn('DOC_NO', array_merge($ongoing_doc_ids->pluck('DOC_NO')->toArray(), $incoming_doc_ids->pluck('DOC_NO')->toArray()))
            ->distinct()
            ->get()
            ->pluck('DOC_NO')
            ->toArray();

        $acted_doc_ids = DocLogsModel::select('DOC_NO')
            ->where([
                'ACTION_STATUS' => 1,
                'DOC_TO' => $user->id
            ])
            ->orWhere([
                'ACTION_STATUS' => 1,
                'DOC_FROM' => $user->id
            ])
            ->orWhere([
                'ACTION_STATUS' => 0,
                'DOC_FROM' => $user->id
            ])
            ->whereNotIn('DOC_NO', array_merge($completed_doc_ids, $ongoing_doc_ids->pluck('DOC_NO')->toArray(), $incoming_doc_ids->pluck('DOC_NO')->toArray()))
            ->distinct()
            ->get()
            ->pluck('DOC_NO')
            ->toArray();

        // Determine the valid documents based on the category
        if ($category == 'IN') {
            $valid_doc = $incoming_doc_ids;
        } elseif ($category == 'OUT') {
            $valid_doc = $ongoing_doc_ids;
        } elseif ($category == 'ACTED') {
            $valid_doc = collect($acted_doc_ids);
        } elseif ($category == 'COMPLETED') {
            $valid_doc = collect($completed_doc_ids);
        }

        return $valid_doc;
    }

    public function getDocuments(Request $request, $category)
    {
        $user = Auth::user();
        $model = new DocRecordModel;

        // params
        $search_doc = $request->get('search_doc');

        $query = $model->query();
        $query->with(['doc_logs', 'created_by']);
        $query->leftJoin('dts_document_logs', 'dts_document_record.DOC_NO', '=', 'dts_document_logs.DOC_NO');
        $query->leftJoin('dts_document_types', 'dts_document_record.DOC_TYPE', '=', 'dts_document_types.ID');
        $query->select('dts_document_record.*', 'dts_document_types.TYPE_NAME');

        $this->filterDocuments($request, $query);
        $this->getDocumentsByCategory($category, $query, $user);

        if($search_doc) {
            Log::info('search_doc: '.$search_doc);
            $query->where(function($subquery) use ($search_doc) {
                $subquery->where('dts_document_record.DOC_NO', 'LIKE', '%'.$search_doc.'%')
                    ->orWhere('dts_document_record.CONTROL_CODE', 'LIKE', '%'.$search_doc.'%')
                    ->orWhere('dts_document_record.ORIGIN_OFFICE', 'LIKE', '%'.$search_doc.'%')
                    ->orWhere('dts_document_record.DOC_ADDRESS', 'LIKE', '%'.$search_doc.'%')
                    ->orWhere('dts_document_record.DOC_SUBJ', 'LIKE', '%'.$search_doc.'%')
                    ->orWhere('dts_document_record.REMARKS', 'LIKE', '%'.$search_doc.'%');
            });
        }

        $data = $query
            ->orderBy('dts_document_record.DOC_NO', 'DESC')
            ->groupBy('dts_document_record.DOC_NO')
            ->paginate(20);

        return $data;
    }

    function filterDocuments($request, $query) {
        $doc_from = $request->get('doc_from');
        $doc_to = $request->get('doc_to');
        $doc_type = $request->get('doc_type');
        $doc_class = $request->get('doc_class');
        $doc_urgent = $request->get('doc_urgent');
        $doc_status = $request->get('doc_status');
        $doc_signed = $request->get('doc_signed');

        if ($request->has('doc_from') && $doc_from!=null) { $query = $query->where('dts_document_record.DOC_DATE', '>=', $doc_from); }
        if ($request->has('doc_to') && $doc_to!=null) { $query = $query->where('dts_document_record.DOC_DATE', '<=', $doc_to); }
        if ($request->has('doc_type') && $doc_type!=null) { $query = $query->where('dts_document_record.DOC_TYPE', '=', $doc_type); }
        if ($request->has('doc_class') && $doc_class!=null) { $query = $query->where('dts_document_record.DOC_CLASSIFICATION', '=', $doc_class); }
        if ($request->has('doc_urgent') && $doc_urgent!=null) { $query = $query->where('dts_document_record.DOC_URGENT', '=', $doc_urgent); }
        if ($request->has('doc_signed') && $doc_signed!=null) { $query = $query->where('dts_document_record.SIGNED', '=', $doc_signed); }
        if ($request->has('doc_status') && $doc_status!=null) { $query = $query->where('dts_document_record.STATUS', '=', $doc_status); }
    }

    function getDocumentsByCategory($category, $query, $user)
    {
        if ($category == "PENDING") {
            $query->where([
                'dts_document_logs.ACTION_STATUS' => 0,
                'dts_document_logs.DOC_TO' => $user->id
            ]);
        }
        if($category == 'ACTED') {
            $query->where(function ($q) use ($user) {
                $q->where(function($q) use ($user) {
                    $q->where('dts_document_logs.ACTION_STATUS', 1)
                    ->where(function ($q) use ($user) {
                        $q->where('dts_document_logs.DOC_TO', $user->id)
                            ->orWhere('dts_document_logs.DOC_FROM', $user->id);
                    });
                })
                ->orWhere(function ($q) use ($user) {
                    $q->where('dts_document_logs.ACTION_STATUS', 0)
                    ->where('dts_document_logs.DOC_FROM', $user->id);
                });
            })
            ->whereNotIn('dts_document_logs.DOC_NO', function ($query) use ($user) {
                $query->select('dts_document_logs.DOC_NO')
                    ->from(with(new DocLogsModel)->getTable())
                    ->where(function ($q) use ($user) {
                        $q->where(function ($q) use ($user) {
                            $q->where('dts_document_logs.ACTION_TO_BE_TAKEN', 14)
                                ->where(function ($q) use ($user) {
                                    $q->where('dts_document_logs.DOC_TO', $user->id)
                                    ->orWhere('dts_document_logs.DOC_FROM', $user->id);
                                });
                        })->orWhere(function ($q) use ($user) {
                            $q->where('dts_document_logs.ACTION_STATUS', 0)
                                ->where('dts_document_logs.DOC_TO', $user->id);
                        });
                    });
            });
            Log::info('Query : '.$query->toSql());
        }
        if($category == 'COMPLETED') {
            $query->where(function ($q) use ($user) {
                $q->where('dts_document_logs.ACTION_TO_BE_TAKEN', 14)
                    ->where(function ($q) use ($user) {
                        $q->where('dts_document_logs.DOC_TO', $user->id)
                            ->orWhere('dts_document_logs.DOC_FROM', $user->id);
                    });
            })
            ->whereNotIn('dts_document_logs.DOC_NO', function ($query) use ($user) {
                $query->select('dts_document_logs.DOC_NO')
                ->from(with(new DocLogsModel())->getTable())
                ->where(function ($q) use ($user) {
                    $q
                    ->orWhere(function ($q) use ($user) {
                        $q->where('dts_document_logs.ACTION_STATUS', 0)
                            ->where('dts_document_logs.DOC_TO', $user->id);
                    });
                });
            });
        }
    }

    function getCategory($category)
    {
        if($category == 'IN') { $cat_desc = 'Incoming Documents'; } 
        else if($category == 'OUT') { $cat_desc = 'Outgoing Documents'; } 
        else if($category == 'COMPLETED') { $cat_desc = 'Completed Documents'; } 
        else if($category == 'ACTED') { $cat_desc = 'Acted Documents'; } 
        else if($category == 'PENDING') { $cat_desc = 'Documents'; }
        return $cat_desc;
    }

    public function toIndex(Request $request, $id){
        
        $category = strtoupper($id);
        $documents = $this->getDocuments($request, $category);
        $doc_count = count($documents);
        $cat_desc = $this->getCategory($category);
        return view('denr.dts.activity.documents', compact(['valid_doc','documents','doc_count', 'category', 'cat_desc']));
    }

    public function toPage($request)
    {
        $id = $request->input('category');
        $category = strtoupper($id);
        $documents = $this->getDocuments($request, $category);
        $doc_count = count($documents);
        return view('denr.dts.activity.documentPage', compact(['documents','doc_count']));
    }

    public function toSearch($request)
    {
        $doc_cat = $request->get('doc_cat');
        $search_doc = $request->get('search_doc');
        $documents =  $this->getDocuments($request, $doc_cat);
        $doc_count = count($documents);
        return view('denr.dts.activity.documentPageSearch', compact(['documents','doc_count']));

    }

    public function toFilter($request)
    {
        $doc_cat = $request->get('doc_cat');
        $documents = $this->getDocuments($request, $doc_cat);
        $doc_count = count($documents);
        return view('denr.dts.activity.documentPageFilter', compact(['documents','doc_count']));
    }

    public function toCreate()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $form = FormNoModel::where('id','=','4')->first();
        $doc_action = DocActionModel::where('ID','!=','14')->where('ID','!=','35')->where('STATUS', 1)->orderBy('ACTION','ASC')->get();
        $str = $form->form_no;
        $no = strlen($str);
        $new_no = str_pad($form->form_no + 1, $no, "0", STR_PAD_LEFT);
        $cur_no = str_pad($form->form_no + 1, $no, "0", STR_PAD_LEFT); 
        return view('denr.dts.activity.adddocuments')
             ->with('user_id', $user_id)
             ->with('formno', $form)
             ->with('new_no', $new_no)
             ->with('cur_no', $cur_no)
             ->with('doc_action', $doc_action);
    }

    public function toInsert(Request $request)
    {
        $user = Auth::user();
        $control_code = $request->control_code;
        $doc_date = $request->doc_date;
        $doc_time = $request->doc_time;
        $doc_type = $request->doc_type;
        $doc_from =  $request->doc_from;
        $doc_origin_office = $request->doc_origin_office;
        $doc_address = $request->doc_address;
        $doc_subj = $request->doc_subject;
        $doc_classification = $request->doc_classification;
        $doc_urgent = $request->doc_urgent;
        $doc_remarks = $request->doc_particulars;
        $doc_processor = $user->id;
        $doc_to =  $request->doc_to; 
        $send_type = $request->send_type;

        $count_doc = DocRecordModel::where('DOC_NO','=', $request->doc_no)->count();

        if($count_doc == 0) {
            $doc_no = $request->doc_no;
        } else {
            $form = FormNoModel::where('id','=',$request->formid)->first();
            $cur_no = str_pad($form->form_no + 1, strlen($form->form_no), "0", STR_PAD_LEFT);
            
            $doc_no = $form->form_text . $cur_no;
            FormNoModel::where('id', '=', $request->formid)->update([
                'form_no' => $cur_no,
                'updated_by' => $user->id
            ]); 
        }
        $DocumentRecord = [
            'DOC_NO' => $doc_no,
            'CONTROL_CODE' => $control_code,
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
        DocRecordModel::insert($DocumentRecord);
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
                'DOC_DT_LOG' => $request->doc_date . ' ' . $request->doc_time,
                'REL_DATE_TIME' => date('Y-m-d H:i:s'),
                'REC_DATE_TIME' => $request->doc_date_org . ' ' . $request->doc_time_org,
                'DOC_REMARKS' => $request->input('doc_remarks')[$index],
                'ACTION_TO_BE_TAKEN' => $request->input('doc_action')[$index],
                'SEEN' => 'N',
                'SEND_TYPE' => $send_type,
                'ACTION_STATUS' => $request->input('doc_action')[$index] == 39 ? 1 : 0
            ];
            DocLogsModel::insert($document_log);
        }
        if(!empty($request->attached_files)) {
            $FILE_ATTACHMENTS = $request->attached_files;
            foreach($FILE_ATTACHMENTS AS $FILE){
                $EXTENSION = $FILE->getClientOriginalExtension();
                $DESCRIPTION = $FILE->getClientOriginalName();
                $SIZE = $FILE->getClientSize();
                $FILE_NAME = rand(11111111, 99999999). '.' . $EXTENSION;
                $FILE->move('DTS_UPLOADS/', $FILE_NAME);
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
        $form_no = [
            'form_no' => $request->neworder_no,
            'updated_by' => $user->id
        ];
        if($count_doc == 0) {
            FormNoModel::where('id', '=', $request->formid)->update($form_no); 
        }
        Session::flash('success', 'Document ('.$doc_no.') successfully saved.');
        return back();
    }

    public function toView($id, $id2){
        $user = Auth::user();
        $doc_no = decrypt($id);
        $this->viewSeenLogs($doc_no);
        $document_details = DocRecordModel::where('DOC_NO', '=', $doc_no)->first();
        $document_attachments = DocAttachmentsModel::where('DOC_NO', '=', $doc_no)->where('ATTACH_CLASS', '=', 'RC')->get();
        $document_senders1 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->first();
        $document_senders2 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->skip(1)->take(100)->get();
        $document_senders3 = DocSenderModel::where('DOC_NO', '=', $doc_no)->orderBy('DOC_SENDER', 'ASC')->get();
        $document_receivers = DocReceiverModel::where('DOC_NO', '=', $doc_no)->get();
        $first_log = DocLogsModel::where('DOC_NO', '=', $doc_no)->orderBy('ID', 'ASC')->first();
        $first_log_id = (!empty($first_log)) ? $first_log->ID : 0;
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
        // CHEKER
        $created = DocLogsModel::where('DOC_NO', '=', $doc_no)->orderBy('ID','ASC')->first();
        $can_end = DocLogsModel::where('DOC_NO', '=', $doc_no)
                        ->where('DOC_FROM', $user->id)
                        ->where('DOC_TO', $user->id)
                        ->where('SEEN', 'Y')
                        ->where('ACTION_STATUS', 1)
                        ->orderBy('FW_NO','DESC')
                        ->orderBy('ID','DESC')
                        ->first();

        $can_forward = DocLogsModel::where('DOC_NO', '=', $doc_no)->where('ACTION_STATUS', 0)->count();
        $doc_receivers = DocLogsModel::where('DOC_NO', '=', $doc_no)->where('FW_NO',1)->where('DOC_FROM', $user->id)->get();
        $docloglast = DocLogsModel::where('DOC_NO', '=', $doc_no)->orderBy('ID', 'DESC')->first();
        $doc_last_log = DocLogsModel::select('ID', 'FW_NO', 'DOC_FROM', 'DOC_TO', 'ACTION_STATUS', 'ACTION_TO_BE_TAKEN')->where('DOC_NO', '=', $doc_no)
            ->where(function ($qry) use ($user) {
                $qry->where('DOC_FROM', $user->id)->orWhere('DOC_TO', $user->id);
            })
            ->orderBy('ID','DESC')
            ->first();
        $created_by = (!empty($document_details) && ($document_details->CREATED_BY==$user->id)) ? true : false;
        $receiver_ctr = 0;
        $forwarded_ctr = 0;
        if (!empty($doc_receivers)) {
            foreach ($doc_receivers as $receiver) {
                $receiver_ctr++;
                if ($receiver->FOR_DATE_TIME!=null && $receiver->ACTION_STATUS==1) {
                    $forwarded_ctr++;
                }
            }
        }

        $recalled_ctr = 0;
        $doc_from = 0;
        foreach ($document_logs as $doc_log) {
            if ($doc_log->ACTION_TO_BE_TAKEN==35 && $doc_log->ACTION_STATUS==1) {
                $recalled_ctr++;
                $doc_from = $doc_log->DOC_FROM;
            }
        }

        $can_end2 = false;
        $can_forward2 = false;
        $can_forward4 = true;
        $doc_category = (!empty($document_details)) ? strtolower($document_details->DOC_CATEGORY) : 'in';
        if (!empty($doc_last_log)) {
            if ($doc_last_log->DOC_TO==$user->id && $doc_last_log->ACTION_STATUS==0) {
                $can_end2 = true;
            }
            if ($doc_last_log->ACTION_TO_BE_TAKEN!=14 || $doc_last_log->ACTION_TO_BE_TAKEN!=35) {
                $can_forward2 = true;
            }
            if ($doc_last_log->ACTION_TO_BE_TAKEN==35 && $doc_last_log->DOC_FROM==$user->id) {
                $can_forward4 = false;
            }
            // if ($doc_last_log->DOC_FROM==$user->id && $doc_last_log->ACTION_TO_BE_TAKEN==35) {
            //     Session::flash('failed', 'Selected Document ('.$doc_no.') has been recalled from you. No preview available.');
            //     return redirect('/dts/activity/document/index/'.$doc_category);
            // }
        }
        $can_forward3 = false;
        if($docloglast->ACTION_TO_BE_TAKEN==35){
            $can_forward3 = true;
        }
        $can_forward_new = false;
        $can_end_new = false;
        $can_recall_new = false;
        $can_edit_new = false;
        if ($created_by) {
            if ($forwarded_ctr == 0 && $recalled_ctr==0) {
                $can_recall_new = true;
            }
            if ($recalled_ctr==$receiver_ctr) {
                $can_edit_new = true;
            }
            if (!empty($doc_last_log)) {
                if ($doc_last_log->FW_NO==1 && $doc_last_log->ACTION_STATUS==0 && ($doc_last_log->ACTION_TO_BE_TAKEN!=14 && $doc_last_log->ACTION_TO_BE_TAKEN!=35)) {
                    $can_forward_new = true;
                    if ($doc_last_log->DOC_TO==$user->id) {
                        $can_end_new = true;
                    } else {
                        $can_end_new = false;
                    }
                } elseif (($doc_last_log->ACTION_STATUS==0 || $doc_last_log->ACTION_STATUS==1) && $doc_last_log->ACTION_TO_BE_TAKEN!=14) {
                    $can_forward_new = true;
                    if ($doc_last_log->DOC_TO==$user->id) {
                        $can_end_new = true;
                    } else {
                        $can_end_new = false;
                    }
                } elseif (($doc_last_log->ACTION_STATUS==0 || $doc_last_log->ACTION_STATUS==1) && $doc_last_log->ACTION_TO_BE_TAKEN!=35) {
                    if ($doc_last_log->ACTION_TO_BE_TAKEN==14) {
                        $can_forward_new = false;
                        $can_end_new = false;
                    } else {
                        $can_forward_new = true;
                        $can_end_new = true;  
                    }
                }
            }
        } else {
            if (!empty($doc_last_log)) {
                if ($doc_last_log->DOC_TO==$user->id && $doc_last_log->FW_NO==1 && $doc_last_log->ACTION_STATUS==0 && ($doc_last_log->ACTION_TO_BE_TAKEN!=14 && $doc_last_log->ACTION_TO_BE_TAKEN!=35)) {
                    $can_forward_new = true;
                    $can_end_new = true;
                } elseif ($doc_last_log->DOC_FROM==$user->id && $doc_last_log->FW_NO==1 && $doc_last_log->ACTION_STATUS==0 && ($doc_last_log->ACTION_TO_BE_TAKEN!=14 && $doc_last_log->ACTION_TO_BE_TAKEN!=35)) {
                    $can_forward_new = true;
                    $can_end_new = true;
                } elseif (($doc_last_log->DOC_TO==$user->id || $doc_last_log->DOC_FROM==$user->id) && $doc_last_log->FW_NO>1 && $doc_last_log->ACTION_STATUS==0 && ($doc_last_log->ACTION_TO_BE_TAKEN!=14 && $doc_last_log->ACTION_TO_BE_TAKEN!=35)) {
                    $can_forward_new = true;
                    $can_end_new = true;
                } elseif (($doc_last_log->DOC_TO==$user->id || $doc_last_log->DOC_FROM==$user->id) && $doc_last_log->FW_NO>1 && $doc_last_log->ACTION_STATUS==1 && ($doc_last_log->ACTION_TO_BE_TAKEN!=14 && $doc_last_log->ACTION_TO_BE_TAKEN!=35)) {
                    $can_forward_new = true;
                    $can_end_new = true;
                } elseif ($doc_last_log->DOC_TO==$user->id && $doc_last_log->FW_NO>1 && $doc_last_log->ACTION_TO_BE_TAKEN==35) {
                    $can_forward_new = true;
                    $can_end_new = true;
                }
            }
        }
        return view('denr.dts.activity.viewdocuments')
                ->with('user_id', $user->id)
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
                ->with('first_log', $first_log)
                ->with('first_log_id', $first_log_id)
                ->with('history_logs', $document_logs)
                ->with('end_user', $lastLog['DOC_FROM'])
                ->with('can_forward', $can_forward)
                ->with('created', $created->DOC_FROM == $user->id)
                ->with('can_end', (collect($can_end)->count() == 0) )
                ->with('created_by', $created_by )
                ->with('can_end2', $can_end2 )
                ->with('can_forward2', $can_forward2 )
                ->with('can_forward3', $can_forward3 )
                ->with('can_forward4', $can_forward4 )
                ->with('receiver_ctr', $receiver_ctr )
                ->with('forwarded_ctr', $forwarded_ctr )
                ->with('recalled_ctr', $recalled_ctr )
                ->with('can_forward_new', $can_forward_new )
                ->with('can_end_new', $can_end_new )
                ->with('can_recall_new', $can_recall_new )
                ->with('can_edit_new', $can_edit_new );
    }

    public function viewSeenLogs($doc_no){
        $doc_to = Auth::user()->id;
        $checkStatus = $this->viewSeenStatus($doc_no,$doc_to);
        if($checkStatus == 'N') {
            $seen_log = [
                'SEEN' => 'Y', 
                'SEEN_DATE_TIME' => date('Y-m-d H:i:s'),
            ];
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
        $receiver = Auth::user()->id;
        $doc_to =  $request->doc_to; 
        $doc_log_id =  $request->doc_log_id; 
        $doc_no = $request->doc_no;
        $send_type = $request->send_type;
        $origins = DocLogsModel::where('DOC_NO', '=', $doc_no)
            ->orderBy('FW_NO', 'DESC')
            ->orderBy('ID', 'DESC')
            ->firstOrFail();
        $forward = $doc_log_id ? DocLogsModel::find($doc_log_id) : DocLogsModel::where('DOC_NO', '=', $doc_no)
                ->where('SEEN', 'Y')
                ->where('ACTION_STATUS', 0)
                ->where('DOC_TO', $receiver)
                ->orderBy('ID', 'DESC')
                ->first();
        foreach($doc_to as $index => $col){
            $forwarder = $forward ? $forward->FW_NO + 1 : 1 ;
            $forwarder_seen = $forward ? $forward->SEEN_DATE_TIME : $origins->REC_DATE_TIME ;
            $document_log = [
                'FW_NO' => $forwarder,
                'DOC_FROM' => Auth::user()->id,
                'DOC_TO' => $request->input('doc_to')[$index],
                'DOC_NO' => $doc_no,
                'DOC_DT_LOG' => date('Y-m-d H:i:s'),
                'REC_DATE_TIME' => $forwarder_seen,
                'REL_DATE_TIME' => date('Y-m-d H:i:s'),
                'DOC_REMARKS' => $request->input('doc_remarks')[$index],
                'ACTION_TO_BE_TAKEN' => $request->input('doc_action')[$index],
                'SEEN' => 'N',
                'SEND_TYPE' => $send_type,
            ];
            DocLogsModel::insert($document_log);
        }
        if(collect($forward)->count() > 0) {
            DocLogsModel::where('ID', '=', $forward->ID)->update([
                'ACTION_STATUS' => 1,
                'FOR_DATE_TIME' => date('Y-m-d H:i:s'),
            ]);
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
                    'FW_NO' => $forward ? $forward->FW_NO + 1 : 1 ,
                    'DOC_NO' => $doc_no,
                    'ATTACHMENT_DESC' => $DESCRIPTION,
                    'FILE_ATTACHMENT' => $FILE_NAME,
                    'FILE_TYPE' => $EXTENSION,
                    'ATTACH_CLASS' => $send_type,
                ];
                DocAttachmentsModel::insert($FILE_RECORD);
            }
        }

        DocRecordModel::where('DOC_NO', $doc_no)->update([
            'STATUS' => 'F'
        ]);
        if($forward->ACTION_TO_BE_TAKEN == 40){
            DocRecordModel::where('DOC_NO', $doc_no)->update([
                'VOUCHER_NO' => $request->input('voucher_no')
            ]);
        }
        if($forward->ACTION_TO_BE_TAKEN == 41){
            DocRecordModel::where('DOC_NO', $doc_no)->update([
                'DV_NO' => $request->input('dv_no')
            ]);
        }
        if($forward->ACTION_TO_BE_TAKEN == 41){
            DocRecordModel::where('DOC_NO', $doc_no)->update([
                'ADA' => $request->input('ada')
            ]);
        }
        Session::flash('success', 'Document ('.$doc_no.') successfully forwarded!');
        return back();
    }

    public function toComplete(Request $request)
    {
        $user = Auth::user();
        $com_id = $request->input('com_id');
        $doc_cat = $request->input('doc_cat');
        $remarks = $request->input('end_remarks');
        $doc_log_id = $request->input('doc_log_id');

        $forward = $doc_log_id ? DocLogsModel::find($doc_log_id) : DocLogsModel::where('DOC_NO', '=', $com_id)->where('DOC_TO', $user->id)->orderBy('FW_NO', 'DESC')->orderBy('ID', 'DESC')->first();
        $document_log = [
            'FW_NO' => $forward->FW_NO + 1,
            'DOC_FROM' => $forward->DOC_TO,
            'DOC_TO' => $forward->DOC_TO,
            'DOC_NO' => $com_id,
            'DOC_DT_LOG' => date('Y-m-d H:i:s'),
            'REC_DATE_TIME' => $forward->SEEN_DATE_TIME,
            'REL_DATE_TIME' => date('Y-m-d H:i:s'),
            'FOR_DATE_TIME' => date('Y-m-d H:i:s'),
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
        // CHECK IF ALL USER IS COMPLETE
        $checker = DocLogsModel::where('DOC_NO', '=', $com_id)->where('ACTION_STATUS', 0)->count();
        if($checker == 0) {
            $complete = ['STATUS' => 'C', 'COMPLETED_BY' => $user->id, 'DATE_COMPLETED' => date('Y-m-d H:i:s')];
            DocRecordModel::where('DOC_NO', '=', $com_id)->update($complete);
            $remarks = 'Ended Document '.$com_id;
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
        }
        Session::flash('success', ' Document ('.$com_id.') successfully ended.');
        return back();
    }

    public function toRecall(Request $request)
    {
        $user = Auth::user();
        $com_id = $request->input('com_id');
        $doc_cat = $request->input('doc_cat');
        $remarks = $request->input('recall_remarks');
        $forwards = DocLogsModel::where('DOC_NO', '=', $com_id)->where('DOC_FROM', $user->id)->orderBy('ID', 'DESC')->get();
        $forwarders = [];
        if (!empty($forwards)) {
            foreach ($forwards as $forward) {
                $forwarder = $forward ? $forward->FW_NO + 1 : 1 ;
                $forwarders[] = $forwarder;
                $date = date('Y-m-d H:i:s');
                $document_log = [
                    'FW_NO' => $forwarder,
                    'DOC_FROM' => $forward->DOC_TO,
                    'DOC_TO' => $user->id,
                    'DOC_NO' => $com_id,
                    'DOC_DT_LOG' => $date,
                    'REC_DATE_TIME' => $date,
                    'REL_DATE_TIME' => $date,
                    'FOR_DATE_TIME' => $date,
                    'DOC_REMARKS' => $remarks,
                    'DOC_CATEGORY' => $doc_cat,
                    'ACTION_TO_BE_TAKEN' => 35,
                    'ACTION_STATUS' => 1,
                    'SEEN' => 'Y',
                    'SEEN_DATE_TIME' => $date,
                    'SEND_TYPE' => 'FW',
                ];
                DocLogsModel::insert($document_log);
                DocLogsModel::where('ID','=', $forward->ID)->update([
                    'ACTION_STATUS' => 1,
                    'FOR_DATE_TIME' => $date
                ]);
            }
            Session::flash('success', ' Document ('.$com_id.') successfully recalled.');
        } else {
            Session::flash('error', ' Request cannot be process. Please try again.');
        }
        return back();
    }

    public function toFollowup(Request $request)
    {
        $user = Auth::user();
        $doc_log_id = $request->input('doc_log_id');
        $doc_no = $request->input('doc_no');
        $doc_cat = $request->input('doc_cat');
        $remarks = $request->input('followup_remarks');

        return DB::transaction(function () use ($user, $doc_log_id, $doc_no, $doc_cat, $remarks) {
            
            $forward = DocLogsModel::where('ID', '=', $doc_log_id)->where('DOC_FROM', $user->id)->orderBy('FW_NO', 'DESC')->orderBy('ID', 'DESC')->first();
    
            if (!empty($forward)) {
                $date = date('Y-m-d H:i:s');
                $document_log = [
                    'FW_NO' => $forward->FW_NO + 1,
                    'DOC_FROM' => $forward->DOC_TO,
                    'DOC_TO' => $user->id,
                    'DOC_NO' => $doc_no,
                    'DOC_DT_LOG' => $date,
                    'REC_DATE_TIME' => $date,
                    'REL_DATE_TIME' => $date,
                    'FOR_DATE_TIME' => $date,
                    'DOC_REMARKS' => $remarks,
                    'DOC_CATEGORY' => $doc_cat,
                    'ACTION_TO_BE_TAKEN' => 38,
                    'ACTION_STATUS' => 1,
                    'SEEN' => 'Y',
                    'SEEN_DATE_TIME' => $date,
                    'SEND_TYPE' => 'FW',
                ];
    
                DocLogsModel::insert($document_log);
    
                DocLogsModel::where('ID','=', $forward->ID)->update([
                    'ACTION_STATUS' => 1,
                    'FOR_DATE_TIME' => $date
                ]);
                
                $document_log2 = [
                    'FW_NO' => $forward->FW_NO + 2,
                    'DOC_FROM' => $forward->DOC_FROM,
                    'DOC_TO' => $forward->DOC_TO,
                    'DOC_NO' => $forward->DOC_NO,
                    'DOC_DT_LOG' => date('Y-m-d H:i:s'),
                    'REC_DATE_TIME' => date('Y-m-d H:i:s'),
                    'REL_DATE_TIME' => date('Y-m-d H:i:s'),
                    'DOC_REMARKS' => $forward->DOC_REMARKS,
                    'DOC_CATEGORY' => $forward->DOC_CATEGORY,
                    'ACTION_TO_BE_TAKEN' => $forward->ACTION_TO_BE_TAKEN,
                    'ACTION_STATUS' => 0,
                    'SEEN' => 'N',
                    'SEEN_DATE_TIME' => null,
                    'SEND_TYPE' => 'FW',
                ];

                DocLogsModel::insert($document_log2);
    
                Session::flash('success', ' Document ('.$doc_no.') successfully recalled.');
            } else {
                Session::flash('error', ' Request cannot be process. Please try again.');
            }
    
            return back();
        });
    }

    public function toRecall2(Request $request)
    {
        $user = Auth::user();
        $doc_log_id = $request->input('doc_log_id');
        $doc_no = $request->input('doc_no');
        $remarks = $request->input('recall_remarks');
        $forward = DocLogsModel::where('ID', '=', $doc_log_id)->where('DOC_FROM', $user->id)->orderBy('FW_NO', 'DESC')->orderBy('ID', 'DESC')->first();
        if (!empty($forward)) {
            $document_log = [
                'FW_NO' => $forward->FW_NO + 1,
                'DOC_FROM' => $forward->DOC_TO,
                'DOC_TO' => $user->id,
                'DOC_NO' => $doc_no,
                'DOC_DT_LOG' => date('Y-m-d H:i:s'),
                'REC_DATE_TIME' => date('Y-m-d H:i:s'),
                'REL_DATE_TIME' => date('Y-m-d H:i:s'),
                'FOR_DATE_TIME' => date('Y-m-d H:i:s'),
                'DOC_REMARKS' => $remarks,
                'ACTION_TO_BE_TAKEN' => 35,
                'ACTION_STATUS' => 1,
                'SEEN' => 'Y',
                'SEEN_DATE_TIME' => date('Y-m-d H:i:s'),
                'SEND_TYPE' => 'FW',
            ];
            DocLogsModel::insert($document_log);
            DocLogsModel::where('ID','=', $forward->ID)->update(['ACTION_STATUS' => 1]);
            Session::flash('success', ' Document ('.$doc_no.') successfully recalled.');
        } else {
            Session::flash('error', ' Request cannot be process. Please try again.');
        }
        return back();
    }

    public function toUpdate(Request $request)
    {
        $doc_no = $request->input('doc_no');
        $doc_from = $request->input('doc_from');
        $control_code = $request->input('control_code_edit');
        $doc_type = $request->input('doc_type_edit');
        $doc_origin_office = $request->input('doc_origin_office_edit');
        $doc_address = $request->input('doc_address_edit');
        $doc_subject = $request->input('doc_subject_edit');
        $doc_classification = $request->input('doc_classification_edit');
        $doc_urgent = $request->input('doc_urgent_edit');
        $update = DocRecordModel::where('DOC_NO', $doc_no)->update([
            'CONTROL_CODE' => $control_code,
            'DOC_TYPE' => $doc_type,
            'ORIGIN_OFFICE' => $doc_origin_office,
            'DOC_ADDRESS' => $doc_address,
            'DOC_SUBJ' => $doc_subject,
            'DOC_CLASSIFICATION' => $doc_classification,
            'DOC_URGENT' => $doc_urgent,
        ]);
        $data = [];
        foreach($doc_from as $id => $sender) {
            $count_sender = DocSenderModel::where('DOC_NO','=', $doc_no)
                                ->where('DOC_SENDER','=', $sender)
                                ->count();
            if($request->input('doc_from')[$id]!=null) {
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
        if(!empty($request->attached_files)) {
            $FILE_ATTACHMENTS = $request->attached_files;
            foreach($FILE_ATTACHMENTS AS $FILE){
                $EXTENSION = $FILE->getClientOriginalExtension();
                $DESCRIPTION = $FILE->getClientOriginalName();
                $FILE_NAME = rand(11111111, 99999999). '.' . $EXTENSION;
                $FILE->move('DTS_UPLOADS/', $FILE_NAME);
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
        if ($update) {
            Session::flash('success', ' Document ('.$doc_no.') successfully updated!');
        } else {
            Session::flash('error', ' Request cannot be process. Please try again.');
        }
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
        if (file_exists($path)) {
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
        } else {
            return "File not found!";
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
        $first_log = DocLogsModel::where('DOC_NO', '=', $doc_no)->orderBy('ID', 'ASC')->first();
        $first_log_id = (!empty($first_log)) ? $first_log->ID : 0;
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
                ->with('first_log_id', $first_log_id)
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
        $first_log = DocLogsModel::where('DOC_NO', '=', $doc_no)->orderBy('ID', 'ASC')->first();
        $first_log_id = (!empty($first_log)) ? $first_log->ID : 0;
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
                ->with('first_log_id', $first_log_id)
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
        $first_log = DocLogsModel::where('DOC_NO', '=', $id)->orderBy('ID', 'ASC')->first();
        $first_log_id = (!empty($first_log)) ? $first_log->ID : 0;
        $document_logs = DocRecordModel::select('dts_document_logs.*', 'dts_document_record.*', 'dts_action_to_be_taken.ACTION', 'user_from.fname as from_fname', 'user_from.lname as from_lname', 'user_to.fname as to_fname', 'user_to.lname as to_lname')
                            ->leftJoin('dts_document_logs','dts_document_record.DOC_NO','=','dts_document_logs.DOC_NO')
                            ->join('users as user_from','dts_document_logs.DOC_FROM','=','user_from.id')
                            ->join('users as user_to','dts_document_logs.DOC_TO','=','user_to.id')
                            ->join('dts_action_to_be_taken','dts_document_logs.ACTION_TO_BE_TAKEN','=','dts_action_to_be_taken.ID')
                            ->where('dts_document_logs.DOC_NO','=', $id)
                            ->orderBy('dts_document_logs.ID', 'ASC')
                            ->get();
        $response['first_log_id'] = $first_log_id;
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
        $signed = ['SIGNED' => 'Y', 'SIGNED_BY' => $user->id, 'DATE_SIGNED' => date('Y-m-d H:i:s')];
        DocRecordModel::where('DOC_NO', '=', $com_id)->update($signed);                          
        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
        Session::flash('success', ' Document ('.$com_id.') successfully Signed.');
        return back();
    }

    public function toActed($request)
    {
        $user = Auth::user();
        $documents = DocLogsModel::select('dts_document_logs.DOC_NO', 'dts_document_record.DOC_TYPE', 'dts_document_record.DOC_CATEGORY', 'dts_document_record.DOC_DATE', 'dts_document_record.ORIGIN_OFFICE', 'dts_document_record.DOC_SUBJ')
            ->join('dts_document_record', 'dts_document_record.DOC_NO', 'dts_document_logs.DOC_NO')
            ->where('ACTION_STATUS',1)
            ->where('DOC_TO', $user->id)
            ->where(function ($qry){
                $qry->where('ACTION_TO_BE_TAKEN', '<>', 14)
                    ->where('ACTION_TO_BE_TAKEN', '<>', 35);
            })
            ->orderBy('DOC_NO', 'DESC')
            ->distinct()
            ->paginate();
        return view('denr.dts.activity.documentActed')
            ->with('documents', $documents);
    }

    public function toCompleted($request)
    {
        $user = Auth::user();
        $documents = DocLogsModel::select('dts_document_logs.DOC_NO', 'dts_document_record.DOC_TYPE', 'dts_document_record.DOC_CATEGORY', 'dts_document_record.DOC_DATE', 'dts_document_record.ORIGIN_OFFICE', 'dts_document_record.DOC_SUBJ')
            ->join('dts_document_record', 'dts_document_record.DOC_NO', 'dts_document_logs.DOC_NO')
            ->where('ACTION_STATUS',1)
            ->where('DOC_TO', $user->id)
            ->where('ACTION_TO_BE_TAKEN', '<>', 14)
            ->orderBy('DOC_NO', 'DESC')
            ->distinct()
            ->paginate();
        return view('denr.dts.activity.documentCompleted')
            ->with('documents', $documents);
    }

    public function ajaxToRemoveAttachment($id)
    {
        $att_id = $id;
        $attachment = DocAttachmentsModel::where('ID',$att_id);
        try {
            if (!empty($attachment)) {
                $delete = DocAttachmentsModel::where('ID', $att_id)->delete();
                if ($delete) {
                    return json_encode(['success'=>'Successfully removed!']);
                } else {
                    return json_encode(['failed'=>'Opps! Something went wrong. Please try again.']);
                }
            }
        } catch (\Exception $e) {
            return $e;
        }
        
    }

    public function toPaid(Request $request)
    {
        $user = Auth::user();
        $com_id = $request->input('doc_no');
        $remarks = $request->input('end_remarks');
        $doc_log_id = $request->input('doc_log_id');
        $forward = $doc_log_id ? DocLogsModel::find($doc_log_id) : DocLogsModel::where('DOC_NO', '=', $com_id)->where('DOC_TO', $user->id)->orderBy('FW_NO', 'DESC')->orderBy('ID', 'DESC')->first();
        $document_log = [
            'FW_NO' => $forward->FW_NO + 1,
            'DOC_FROM' => $forward->DOC_TO,
            'DOC_TO' => $forward->DOC_TO,
            'DOC_NO' => $com_id,
            'DOC_DT_LOG' => date('Y-m-d H:i:s'),
            'REC_DATE_TIME' => $forward->SEEN_DATE_TIME,
            'REL_DATE_TIME' => date('Y-m-d H:i:s'),
            'FOR_DATE_TIME' => date('Y-m-d H:i:s'),
            'DOC_REMARKS' => $remarks,
            'ACTION_TO_BE_TAKEN' => 14,
            'ACTION_STATUS' => 1,
            'SEEN' => 'Y',
            'SEEN_DATE_TIME' => date('Y-m-d H:i:s'),
            'SEND_TYPE' => 'FW',
        ];
        DocLogsModel::insert($document_log);
        $doc_action = ['ACTION_STATUS' => 1];
        DocLogsModel::where('ID','=', $forward->ID)->update($doc_action);
        DocRecordModel::where('DOC_NO', '=', $com_id)->update([
            'STATUS' => 'C', 
            'COMPLETED_BY' => $user->id, 
            'DATE_COMPLETED' => date('Y-m-d H:i:s'),
            'ADA' => $request->input('ada')
        ]);
        $record = DocRecordModel::where('DOC_NO', '=', $com_id)->first();
        $docFrom = DocLogsModel::where('DOC_NO', $com_id)->pluck('DOC_FROM')->toArray();
        $docTo   = DocLogsModel::where('DOC_NO', $com_id)->pluck('DOC_TO')->toArray();
        $users = UserModel::whereIn('id', array_merge($docFrom, $docTo))->get();
        Notification::send($users, new VoucherPaidNotification($record));
        Session::flash('success', ' Document ('.$com_id.') successfully ended.');
        return back();
    }
}