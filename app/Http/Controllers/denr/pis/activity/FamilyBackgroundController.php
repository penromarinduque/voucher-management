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
use App\Models\denr\Family_Background as FamilyBackgroundModel;
use App\Models\denr\Family_Background_Children as FamilyBackgroundChildrenModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\pis\activity\FamilyBackgroundTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class FamilyBackgroundController extends Controller
{
    use FamilyBackgroundTraits, UserAccessTraits;

    public function ShowFamilyBackgroundForm()
    {
    	if($this->user_access()){

        	return $this->ShowFamilyBackgroundFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AddFamilyBackground(Request $request) 
    {
    	if($this->user_access()){

        	return $this->AddFamilyBackgroundFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
