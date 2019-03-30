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
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\DivisionTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class DivisionController extends Controller
{
    use DivisionTraits, UserAccessTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowDivisionList()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowDivisionListFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowDivisionListFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ShowDivisionForm()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowDivisionFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowDivisionFormFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function AddDivision(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->AddDivisionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddDivisionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ViewDivision(Request $request, $id)
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ViewDivisionFunction($request, $id);

        } else {

            if($user->user_type == '1'){

                return $this->ViewDivisionFunction($request, $id);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function editDivision(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->editDivisionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->editDivisionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function DeleteDivision(Request $request)
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->DeleteDivisionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->DeleteDivisionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

}
