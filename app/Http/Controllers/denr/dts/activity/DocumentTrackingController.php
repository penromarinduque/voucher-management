<?php

namespace App\Http\Controllers\denr\dts\activity;

use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\denr\Travel_Order as TravelOrdeModel;
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\User as UserModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;

use App\Http\Traits\denr\dts\activity\DocumentTrackingTrait;
use App\Http\Traits\denr\dts\activity\DocumentAddTrait;
use App\Http\Traits\denr\dts\activity\ReleasedDcoumentsTrait;
use App\Http\Traits\denr\app\UserAccessTraits;

class DocumentTrackingController extends Controller
{
	use DocumentTrackingTrait, DocumentAddTrait, UserAccessTraits;

    public function Documents($id)
    {
        if($this->user_access()){
            return $this->DocumentsFunction($id);
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function documentPage(Request $request)
    {
        return $this->toDocumentPage($request);
    }

    public function documentSearch(Request $request)
    {
        return $this->toDocumentSearch($request);
    }

    public function FilterDocuments(Request $request)
    {
        return $this->FilterDocumentsFunction($request);
    }

    public function DownloadAttachment($id, $id2, $id3)
    {
        return $this->DownloadAttachmentFunction($id, $id2, $id3);
    }

    public function PreviewAttachment($id, $id2, $id3, $id4)
    {
        return $this->PreviewAttachmentFunction($id, $id2, $id3, $id4);
    }

    public function SeenLog(Request $request)
    {
        return $this->SeenLogFunction($request);
    }

    public function PrintDocumentSlip($id)
    {
        return $this->PrintDocumentSlipFunction($id);
    }

    public function PrintManualSlip($id)
    {
        return $this->PrintManualSlipFunction($id);
    }
    
    public function AddDocuments()
    {
        if($this->user_access()){
            return $this->AddDocumentsFunction();
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function ForwardedDocuments()
    {
        if($this->user_access()){
            return $this->ForwardedDocumentsFunction();
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function ReceivedDocuments()
    {
        if($this->user_access()){
            return $this->ReceivedDocumentsFunction();
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function AddDocumentsPost(Request $request)
    {
        if($this->user_access()){
            return $this->AddDocumentFunction($request);
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function viewTheForward(Request $request)
    {
        if($this->user_access()){
            return $this->viewTheForwardFunction($request);
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function ajaxDocNo(Request $request)
    {
        return $this->ajaxDocNoFunction($request);
    }

    public function ViewDocuments($id, $id2)
    {
        if($this->user_access()){
            return $this->ViewDocumentsFunction($id, $id2);
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function HistoryLogsAjax(Request $request)
    {
        return $this->AjaxHistoryLogsDocumentFunction($request);
    }

    public function AttachmentAjax(Request $request)
    {
        return $this->AjaxAttachmentFunction($request);
    }

    public function LogAttachmentAjax(Request $request)
    {
        return $this->LogAttachmentAjaxFunction($request);
    }

    public function DocumentComplete(Request $request)
    {
        return $this->DocumentCompleteFunction($request);
    }

    public function DocumentSign(Request $request)
    {
        return $this->DocumentSignFunction($request);
    }
}