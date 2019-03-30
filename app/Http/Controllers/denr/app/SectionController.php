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
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\SectionTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class SectionController extends Controller
{
    use SectionTraits, UserAccessTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowSectionList()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowSectionListFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowSectionListFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            } 
        }
    }

    public function ShowSectionForm()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowSectionFormFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowSectionFormFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }

    }

    public function AddSection(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->AddSectionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddSectionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function ViewSection(Request $request, $id)
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ViewSectionFunction($request, $id);

        } else {

            if($user->user_type == '1'){

                return $this->ViewSectionFunction($request, $id);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function editSection(Request $request) 
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->editSectionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->editSectionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

    public function DeleteSection(Request $request)
    {
        $user = Auth::user();
        
        if($this->user_access()){

            return $this->DeleteSectionFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->DeleteSectionFunction($request);

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }
        }
    }

}
