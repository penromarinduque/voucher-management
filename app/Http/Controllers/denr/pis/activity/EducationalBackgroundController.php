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
use App\Models\denr\Educational_Background as EducationalBackgroundModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\pis\activity\EducationalBackgroundTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class EducationalBackgroundController extends Controller
{
    use EducationalBackgroundTraits, UserAccessTraits;

    public function ShowEducationalBackgroundForm()
    {
    	if($this->user_access()){

        	return $this->ShowEducationalBackgroundFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AddEducationalBackground(Request $request) 
    {
    	if($this->user_access()){

        	return $this->AddEducationalBackgroundFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
