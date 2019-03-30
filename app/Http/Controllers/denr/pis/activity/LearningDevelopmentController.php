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
use App\Models\denr\Learning_Development as LearningDevelopmentModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\pis\activity\LearningDevelopmentTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class LearningDevelopmentController extends Controller
{
    use LearningDevelopmentTraits, UserAccessTraits;

    public function ShowLearningDevelopmentForm()
    {
    	if($this->user_access()){

        	return $this->ShowLearningDevelopmentFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AddLearningDevelopment(Request $request) 
    {
    	if($this->user_access()){

        	return $this->AddLearningDevelopmentFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
