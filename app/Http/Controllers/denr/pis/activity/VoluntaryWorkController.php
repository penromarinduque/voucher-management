<?php

namespace App\Http\Controllers\denr\pis\activity;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Voluntary_Work as VoluntaryWorkModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\pis\activity\VoluntaryWorkTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class VoluntaryWorkController extends Controller
{  
    use VoluntaryWorkTraits, UserAccessTraits;

    public function ShowVoluntaryWorkForm()
    {
    	if($this->user_access()){

        	return $this->ShowVoluntaryWorkFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AddVoluntaryWork(Request $request) 
    {
    	if($this->user_access()){

        	return $this->AddVoluntaryWorkFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
