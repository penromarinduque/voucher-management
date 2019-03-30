<?php

namespace App\Http\Traits\denr\dts\report;

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


trait DocumentReportTrait
{

    public function DocumentReportFunction(){

        $user = Auth::user();

        return view('denr.dts.report.documentreport');

    }

    public function DocumentReportResultFunction(Request $request){

        $doc_cat = $request->doc_cat;
        $doc_from = $request->doc_from;
        $doc_to = $request->doc_to;
        $doc_type = $request->doc_type;
        $doc_class = $request->doc_class;
        $doc_urgent = $request->doc_urgent;
        $doc_status = $request->doc_status;
        $doc_signed = $request->doc_signed;
        $doc_trail = $request->doc_trail;
        $doc_history = $request->doc_history;

        if($doc_cat == 'IN') {

            $doc_category = 'Incoming Documents';

        } else if($doc_cat == 'OUT') {

            $doc_category = 'Outgoing Documents';

        } else {

            $doc_category = 'All Documents';
        }

        $query = DocRecordModel::query();

        $query = $query->join('dts_document_types','dts_document_record.DOC_TYPE','=','dts_document_types.ID');

        if (Input::has('doc_cat')) {
            $query = $query->where('dts_document_record.DOC_CATEGORY', '=', $doc_cat);
        }

        if (Input::has('doc_from')) {

            $query = $query->where('dts_document_record.DOC_DATE', '>=', $doc_from);
        }

        if (Input::has('doc_to')) {
            $query = $query->where('dts_document_record.DOC_DATE', '<=', $doc_to);
        }

        if (Input::has('doc_type')) {
            $query = $query->where('dts_document_record.DOC_TYPE', '=', $doc_type);
        }

        if (Input::has('doc_class')) {
            $query = $query->where('dts_document_record.DOC_CLASSIFICATION', '=', $doc_class);
        }

        if (Input::has('doc_urgent')) {
            $query = $query->where('dts_document_record.DOC_URGENT', '=', $doc_urgent);
        }

        if (Input::has('doc_signed')) {
            $query = $query->where('dts_document_record.SIGNED', '=', $doc_signed);
        }

        if (Input::has('doc_status')) {
            $query = $query->where('dts_document_record.STATUS', '=', $doc_status);
        }

        $doc_record = $query->orderBy('dts_document_record.DOC_NO', 'ASC')->get();

        $doc_count = count($doc_record);

        return view('denr.dts.report.documentreportresult')
             ->with('documents', $doc_record)
             ->with('doc_count', $doc_count)
             ->with('doc_category', $doc_category)
             ->with('doc_trail', $doc_trail)
             ->with('doc_history', $doc_history);

    }

}