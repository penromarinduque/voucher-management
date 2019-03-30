<?php

namespace App\Http\Controllers\denr\app;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\FormSignatoryTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class FormSignatoryController extends Controller
{
    use FormSignatoryTraits, UserAccessTraits;

    public function ShowFormSignatoryForm()
    {	
        $user = Auth::user();

    	if($this->user_access()){

        	return $this->ShowFormSignatoryFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowFormSignatoryFormFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function AddFormSignatory(Request $request) 
    {
        $user = Auth::user();
        
    	if($this->user_access()){

        	return $this->AddFormSignatoryFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddFormSignatoryFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

}
