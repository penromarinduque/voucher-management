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
use App\Models\denr\Personal_Information as PersonalInfoModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\pis\activity\PersonalInformationTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class PersonalInformationController extends Controller
{
    use PersonalInformationTraits, UserAccessTraits;

    public function ShowPersonalInfoForm()
    {
    	if($this->user_access()){

        	return $this->ShowPersonalInfoFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AddPersonalInfo(Request $request) 
    {
    	if($this->user_access()){

        	return $this->AddPersonalInfoFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
