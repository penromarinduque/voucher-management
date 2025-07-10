<?php

namespace App\Http\Controllers\denr\dts\activity;

use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Traits\denr\dts\activity\DocumentTrackingTrait;
use App\Http\Traits\denr\dts\activity\ReleasedDcoumentsTrait;
use App\Http\Traits\denr\app\UserAccessTraits;

class DocumentTrackingController extends Controller
{
    use DocumentTrackingTrait, UserAccessTraits;

    public function index($id)
    {
        if($this->user_access()){
            return $this->toIndex($id);
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function page(Request $request)
    {
        return $this->toPage($request);
    }

    public function search(Request $request)
    {
        return $this->toSearch($request);
    }

    public function filter(Request $request)
    {
        return $this->toFilter($request);
    }

    public function create()
    {
        if($this->user_access()){
            return $this->toCreate();
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function insert(Request $request)
    {
            // return $request;
        if($this->user_access()){
            return $this->toInsert($request);
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function view($id, $id2)
    {
        if($this->user_access()){
            return $this->toView($id, $id2);
        } else {
            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function forward(Request $request)
    {
        return $this->toForward($request);
    }

    public function complete(Request $request)
    {
        return $this->toComplete($request);
    }

    public function recall(Request $request)
    {
        return $this->toRecall($request);
    }

    public function followup(Request $request)
    {
        return $this->toFollowup($request);
    }

    public function recallSingle(Request $request)
    {
        return $this->toRecall2($request);
    }

    public function updateDetails(Request $request)
    {
        return $this->toUpdate($request);
    }

    public function seen(Request $request)
    {
        return $this->toSeen($request);
    }

    public function download($id, $id2, $id3)
    {
        return $this->toDownload($id, $id2, $id3);
    }

    public function preview($id, $id2, $id3, $id4)
    {
        return $this->toPreview($id, $id2, $id3, $id4);
    }

    public function printSlip($id)
    {
        return $this->toPrintSlip($id);
    }

    public function printManual($id)
    {
        return $this->toPrintManual($id);
    }

    public function ajaxDocNo(Request $request)
    {
        return $this->ajaxDocNoFunction($request);
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

    public function sign(Request $request)
    {
        return $this->toSign($request);
    }

    public function acted(Request $request)
    {
        return $this->toActed($request);
    }

    public function completed(Request $request)
    {
        return $this->toCompleted($request);
    }

    public function ajaxRemoveAttachment($id)
    {
        return $this->ajaxToRemoveAttachment($id);
    }
}