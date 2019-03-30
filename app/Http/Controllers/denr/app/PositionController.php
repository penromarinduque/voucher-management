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
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\PositionTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class PositionController extends Controller
{
    use PositionTraits, UserAccessTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowPositionList()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowPositionListFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowPositionListFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ShowPositionForm()
    {
        $user = Auth::user();

        if($this->user_access()){

           return $this->ShowPositionFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowPositionFormFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function AddPosition(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->AddPositionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddPositionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ViewPosition(Request $request, $id)
    {
        $user = Auth::user();

        if($this->user_access()){

           return $this->ViewPositionFunction($request, $id);

        } else {

            if($user->user_type == '1'){

                return $this->ViewPositionFunction($request, $id);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function editPosition(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->editPositionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->editPositionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function DeletePosition(Request $request)
    {
        $user = Auth::user();
        
        if($this->user_access()){

            return $this->DeletePositionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->DeletePositionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

}
