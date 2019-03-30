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
use App\Models\denr\APP_UserModuleAccess as UserModuleAccessModel;
use App\Models\denr\APP_UserAccess as UserAccessModel;
use App\Models\denr\APP_Module as  ModuleModel;
use App\Models\denr\APP_Window as  WindowModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\app\UserAccessTraits;
use App\Http\Traits\denr\app\CheckboxTraits;


class UserAccessController extends Controller
{
    use UserAccessTraits, CheckboxTraits;

    public function ShowUserAccess()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowUserAccessFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowUserAccessFunction();
                
            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            } 
        }
    }

    public function showAjaxUserAccess(Request $request) 
    {
        return $this->ShowAjaxUserAccessFunction($request);
    }

    public function showAjaxUserModule(Request $request) 
    {
        return $this->showAjaxUserModuleFunction($request);
    }

    public function AddUserAccess(Request $request) 
    {
        $user = Auth::user();
        
        if($this->user_access()){

            return $this->AddUserAccessFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddUserAccessFunction($request);
                
            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            } 
        }
    }

}
