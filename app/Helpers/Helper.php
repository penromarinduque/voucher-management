<?php namespace App\Helpers;

use Auth;
use Carbon;
use Illuminate\Support\Facades\Cache;

use App\Models\denr\APP_UserAccess as UserAccessModel;
use App\Models\denr\APP_UserModuleAccess as UserModuleAccessModel;
use App\Models\denr\APP_Window as WindowModel;
use App\Models\denr\APP_Module as ModuleModel;
use App\Models\denr\DTS_DocRecordModel as DocumentModel;
use App\Models\denr\DTS_DocLogsModel as DocumentLogsModel;

class Helper
{
	public static function mod_path()
    {
        $url = url()->current();
        list($http, $http2, $domain, $path) = explode('/', $url);
        return $path;
    }

    public static function window_type()
    {
        $url = url()->current();
        list($http, $http2, $domain, $path, $window_type) = explode('/', $url);
        return $window_type;
    }

    public static function window()
    {
        $url = url()->current();
        list($http, $http2, $domain, $path, $window_type, $window) = explode('/', $url);
        return $window;
    }

    public static function subwindow()
    {
        $url = url()->current();
        list($http, $http2, $domain, $path, $window_type, $window, $subwindow) = explode('/', $url);
        return $subwindow;
    }

    public static function doc_class()
    {
        $user = Auth::user();

        if($user->user_role == '1') {

            $doc_class = 'Incoming';

        } else if($user->user_role == '2') {

            $doc_class = 'Outgoing';

        } else if($user->user_role == '3') {

            $doc_class = 'Incoming & Outgoing';

        } else if($user->user_role == '4') {

            $doc_class = '';

        } else if($user->user_role == '0') {

            $doc_class = '';

        }
        
        return $doc_class;
    }

    public static function icon_class()
    {
        $user = Auth::user();

        /*if($user->user_role == 'RC') {

            $icon_class = 'fa fa-sign-in';

        } else if($user->user_role == 'RL') {

            $icon_class = 'fa fa-sign-out';

        } else if($user->user_role == 'NN') {

            $icon_class = '';

        }
        
        return $icon_class;*/
    }


    public static function window_desc($window)
    {
        $window_desc = WindowModel::where('window_name','=',$window)->first();
        return $window_desc->window_desc;
    }

    public static function access($window, $subwindow)
    {
        $user = Auth::user();

        $window = WindowModel::where('window_name','=',$window)->first();

        if($subwindow == 'add') {

            $access = UserAccessModel::where('user','=',$user->id)
                                     ->where('window_id','=', $window->window_id)
                                     ->where('add_access','=', '1')
                                     ->count();

        } else if($subwindow == 'view') {

            $access = UserAccessModel::where('user','=',$user->id)
                                     ->where('window_id','=', $window->window_id)
                                     ->where('view_access','=', '1')
                                     ->count();

        } else if($subwindow == 'edit') {

            $access = UserAccessModel::where('user','=',$user->id)
                                     ->where('window_id','=', $window->window_id)
                                     ->where('edit_access','=', '1')
                                     ->count();

        } else if($subwindow == 'delete') {

            $access = UserAccessModel::where('user','=',$user->id)
                                     ->where('window_id','=', $window->window_id)
                                     ->where('delete_access','=', '1')
                                     ->count();

        } else if($subwindow == 'print') {

            $access = UserAccessModel::where('user','=',$user->id)
                                     ->where('window_id','=', $window->window_id)
                                     ->where('print_access','=', '1')
                                     ->count();

        } 

        return $access;
    }

    public static function in_notification()
    {
        $user = Auth::user();

        $seen_log = DocumentLogsModel::where('DOC_TO','=', $user->id)->where('DOC_CATEGORY','=', 'IN')->where('SEEN','=', 'N')->count();
        return $seen_log;
    }

    public static function out_notification()
    {
        $user = Auth::user();

        $seen_log = DocumentLogsModel::where('DOC_TO','=', $user->id)->where('DOC_CATEGORY','=', 'OUT')->where('SEEN','=', 'N')->count();
        return $seen_log;
    }

    public static function pis_access()
    {
        $user = Auth::user();
        $access = UserModuleAccessModel::where('user','=', $user->id)->where('module_code','=', 'PIS')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function toa_access()
    {
        $user = Auth::user();
        $access = UserModuleAccessModel::where('user','=', $user->id)->where('module_code','=', 'TOA')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function dts_access()
    {
        $user = Auth::user();
        $access = UserModuleAccessModel::where('user','=', $user->id)->where('module_code','=', 'DTS')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function lms_access()
    {
        $user = Auth::user();
        $access = UserModuleAccessModel::where('user','=', $user->id)->where('module_code','=', 'LMS')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function fsa_access()
    {
        $user = Auth::user();
        $access = UserModuleAccessModel::where('user','=', $user->id)->where('module_code','=', 'FSA')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function app_access()
    {
        $user = Auth::user();
        $access = UserModuleAccessModel::where('user','=', $user->id)->where('module_code','=', 'APP')->where('module_access','=', '1')->count();
        return $access;
    }


    public static function user_access($process, $type)
    {
        $user = Auth::user();
        $access = UserAccessModel::where('user','=', $user->id)->where('window_id','=', $process)->where($type,'=', '1')->count();
        return $access;
    }
}