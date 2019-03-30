<?php

namespace App\Http\Controllers\denr\dts\maintenance;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\DTS_DocTypesModel as DocTypeModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\dts\maintenance\DocumentTypeTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class DocumentTypeController extends Controller
{
    use DocumentTypeTraits, UserAccessTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowDocTypeList()
    {
        if($this->user_access()){

            return $this->ShowDocTypeListFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    }

    public function ShowDocTypeForm()
    {
        if($this->user_access()){
            
            return $this->ShowDocTypeFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    }

    public function AddDocType(Request $request) 
    {
        if($this->user_access()){
            
            return $this->AddDocTypeFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    }

    public function ViewDocType(Request $request, $id)
    {
        if($this->user_access()){
            
            return $this->ViewDocTypeFunction($request, $id);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    }

    public function editDocType(Request $request) 
    {
        if($this->user_access()){

            return $this->editDocTypeFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    }

    public function DeleteDocType(Request $request)
    {
        if($this->user_access()){

            return $this->DeleteDocTypeFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    }

}
