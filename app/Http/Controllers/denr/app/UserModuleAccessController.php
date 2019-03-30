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

use App\Http\Traits\denr\app\UserModuleAccessTraits;
use App\Http\Traits\denr\app\CheckboxTraits;
use App\Http\Traits\denr\app\UserAccessTraits;


class UserModuleAccessController extends Controller
{
    use UserModuleAccessTraits, CheckboxTraits, UserAccessTraits;

    public function ShowUserModuleAccess()
    {
        $user = Auth::user();

        if($this->user_access()){

            return $this->ShowUserModuleAccessFunction();

        } else {

            if($user->user_type == '1'){

                return $this->ShowUserModuleAccessFunction();
                
            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }            
        }
    }

    public function ShowAjaxUserModuleAccess(Request $request) 
    {
        return $this->ShowAjaxUserModuleAccessFunction($request);
    }

    public function AddUserModuleAccess(Request $request) 
    {
        $user = Auth::user();
        
        if($this->user_access()){

            return $this->AddUserModuleAccessFunction($request);

        } else {

            if($user->user_type == '1'){

                return $this->AddUserModuleAccessFunction($request);
                
            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }   
        }
    }

}
