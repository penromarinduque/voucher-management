<?php

namespace App\Http\Controllers\denr\app;

use Auth;
use Response;
use Session;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;
use App\Models\denr\User as UserModel;

use App\Http\Traits\denr\app\AuditTrailTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class AuditTrailController extends Controller
{
    use AuditTrailTraits, UserAccessTraits;

    public function showAuditForm()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->showAuditFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->showAuditFormFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }   

    }


    public function showAjax()
    {
       
    }


    public function filterAudit(Request $request)
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->filterAuditFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->filterAuditFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }   

    }

}


