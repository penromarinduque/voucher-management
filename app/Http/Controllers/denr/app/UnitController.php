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
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\UnitTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class UnitController extends Controller
{
    use UnitTraits, UserAccessTraits;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowUnitList()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowUnitListFunction(); 

        } else {

            if($user->user_type == '1'){

                return $this->ShowUnitListFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ShowUnitForm()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowUnitFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowUnitFormFunction(); 

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function showAjax()
    {
        return $this->showAjaxFunction();
    }

    public function AddUnit(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->AddUnitFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddUnitFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ViewUnit(Request $request, $id)
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ViewUnitFunction($request, $id);

        } else {

            if($user->user_type == '1'){

                return $this->ViewUnitFunction($request, $id); 

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function editUnit(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->editUnitFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->editUnitFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function DeleteUnit(Request $request)
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->DeleteUnitFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->DeleteUnitFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

}
