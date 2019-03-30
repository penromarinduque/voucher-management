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
use App\Models\denr\Civil_Service_Eligibility as CivilServiceEligibilityModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\pis\activity\CivilServiceEligibilityTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class CivilServiceEligibilityController extends Controller
{

    use CivilServiceEligibilityTraits, UserAccessTraits;

    public function ShowCivilServiceEligibilityForm()
    {
    	if($this->user_access()){

        	return $this->ShowCivilServiceEligibilityFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AddCivilServiceEligibility(Request $request) 
    {
    	if($this->user_access()){

        	return $this->AddCivilServiceEligibilityFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
