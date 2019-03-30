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
use App\Models\denr\Form_No as FormNoModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\FormNoTraits;
use App\Http\Traits\denr\app\UserAccessTraits;


class FormNoController extends Controller
{
    use FormNoTraits, UserAccessTraits;

    public function ShowFormNoForm()
    {
        $user = Auth::user();

    	if($this->user_access()){

        	return $this->ShowFormNoFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowFormNoFormFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function AddFormNo(Request $request) 
    {
        $user = Auth::user();

    	if($this->user_access()){

        	return $this->AddFormNoFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddFormNoFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }

    
    }

}
