<?php

namespace App\Http\Controllers\denr\app;

use Crypt;
use Auth;
use Session;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\UserTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class UserController extends Controller
{
    use UserTraits, UserAccessTraits;

    public function ShowUserList()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowUserListFunction();    

        } else {

            if($user->user_type == '1'){

                return $this->ShowUserListFunction(); 

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ShowUserForm()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowUserFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowUserFormFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }


    public function AddUser(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->AddUserFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddUserFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }

            
        }
    }


    public function ShowAjaxSec()
    {
        return $this->ShowAjaxSecFunction();
    }

    public function ShowAjaxUnit()
    {
        return $this->ShowAjaxUnitFunction();
    }

    public function ViewUser(Request $request, $id) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ViewUserFunction($request, $id); 

        } else {

            if($user->user_type == '1'){

                return $this->ViewUserFunction($request, $id); 

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }           
    }


    public function EditUser(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->EditUserFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->EditUserFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }


    public function DeleteUser(Request $request)
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->DeleteUserFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->DeleteUserFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }
    
}
