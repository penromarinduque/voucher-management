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
use App\Models\denr\Other_Information as OtherInfoModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\pis\activity\OtherInformationTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class OtherInformationController extends Controller
{
    use OtherInformationTraits, UserAccessTraits;

    public function ShowOtherInformationForm()
    {
    	if($this->user_access()){

        	return $this->ShowOtherInformationFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AddOtherInformation(Request $request) 
    {
    	if($this->user_access()){

        	return $this->AddOtherInformationFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
