<?php namespace App\Helpers;

use Auth;
use Carbon;
use DateTime;
use Illuminate\Support\Facades\Cache;

use App\Models\denr\APP_UserAccess as UserAccessModel;
use App\Models\denr\APP_UserModuleAccess as UserModuleAccessModel;
use App\Models\denr\APP_Window as WindowModel;
use App\Models\denr\APP_Module as ModuleModel;
use App\Models\denr\DTS_DocRecordModel as DocumentModel;
use App\Models\denr\DTS_DocLogsModel as DocumentLogsModel;
use App\Models\denr\DTS_DocRecordModel;

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

        if($subwindow == 'index') {

          $access = UserAccessModel::where('user','=',$user->id)
                                   ->where('window_id','=', $window->window_id)
                                   ->where('view_access','=', '1')
                                   ->count();

      } else if($subwindow == 'create') {

          $access = UserAccessModel::where('user','=',$user->id)
                                   ->where('window_id','=', $window->window_id)
                                   ->where('add_access','=', '1')
                                   ->count();

      } else if($subwindow == 'insert') {

          $access = UserAccessModel::where('user','=',$user->id)
                                   ->where('window_id','=', $window->window_id)
                                   ->where('add_access','=', '1')
                                   ->count();

      } else if($subwindow == 'view') {

          $access = UserAccessModel::where('user','=',$user->id)
                                   ->where('window_id','=', $window->window_id)
                                   ->where('view_access','=', '1')
                                   ->count();

      } else if($subwindow == 'forward') {

          $access = UserAccessModel::where('user','=',$user->id)
                                   ->where('window_id','=', $window->window_id)
                                   ->where('add_access','=', '1')
                                   ->count();

      } else if($subwindow == 'add') {

          $access = UserAccessModel::where('user','=',$user->id)
                                   ->where('window_id','=', $window->window_id)
                                   ->where('add_access','=', '1')
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
        return 0;
        // $user = Auth::user();

        // return DocumentModel::query()
        // ->leftJoin('dts_document_logs', 'dts_document_record.DOC_NO', '=', 'dts_document_logs.DOC_NO')
        // ->where([
        //         'dts_document_logs.ACTION_STATUS' => 0,
        //         'dts_document_logs.DOC_TO' => $user->id,
        //         'dts_document_logs.DOC_CATEGORY' => "IN"
        // ])
        // ->count();
    }

    public static function out_notification()
    {
        return 0;
        // $user = Auth::user();

        // return DocumentModel::query()
        // ->leftJoin('dts_document_logs', 'dts_document_record.DOC_NO', '=', 'dts_document_logs.DOC_NO')
        // ->where([
        //         'dts_document_logs.ACTION_STATUS' => 0,
        //         'dts_document_logs.DOC_TO' => $user->id,
        //         'dts_document_logs.DOC_CATEGORY' => "OUT"
        // ])
        // ->count();
    }


    public static function acted_notification()
    {
        return 0;
        // $user = Auth::user();

        // return DocumentModel::query()
        // ->select('dts_document_record.DOC_NO')
        // ->leftJoin('dts_document_logs', 'dts_document_record.DOC_NO', '=', 'dts_document_logs.DOC_NO')
        // ->where(function ($q) use ($user) {
        //     $q->where('dts_document_logs.ACTION_STATUS', 1)
        //     ->where(function ($q) use ($user) {
        //         $q->where('dts_document_logs.DOC_TO', $user->id)
        //             ->orWhere('dts_document_logs.DOC_FROM', $user->id);
        //     });
        // })
        // ->orWhere(function ($q) use ($user) {
        //     $q->where('dts_document_logs.ACTION_STATUS', 0)
        //     ->where('dts_document_logs.DOC_FROM', $user->id);
        // })
        // ->whereNotIn('dts_document_logs.DOC_NO', function ($query) use ($user) {
        //     $query->select('dts_document_logs.DOC_NO')
        //         ->from(with(new DocumentLogsModel)->getTable())
        //         ->where(function ($q) use ($user) {
        //             $q->where(function ($q) use ($user) {
        //                 $q->where('dts_document_logs.ACTION_TO_BE_TAKEN', 14)
        //                     ->where(function ($q) use ($user) {
        //                         $q->where('dts_document_logs.DOC_TO', $user->id)
        //                         ->orWhere('dts_document_logs.DOC_FROM', $user->id);
        //                     });
        //             })->orWhere(function ($q) use ($user) {
        //                 $q->where('dts_document_logs.ACTION_STATUS', 0)
        //                     ->where('dts_document_logs.DOC_TO', $user->id)
        //                     ->whereIn('dts_document_logs.DOC_CATEGORY', ['OUT', 'IN']);
        //             });
        //         });
        // })
        // ->distinct()
        // ->count('dts_document_record.DOC_NO');
    }


    public static function completed_notification()
    {
        return 0;
        // $user = Auth::user();

        // $completed_doc_ids_count = DocumentLogsModel::select('DOC_NO')
        //     ->where(function ($q) use ($user) {
        //         $q->where('ACTION_TO_BE_TAKEN', 14)
        //         ->where(function ($q) use ($user) {
        //             $q->where('DOC_TO', $user->id)
        //                 ->orWhere('DOC_FROM', $user->id);
        //         });
        //     })
        //     ->whereNotIn('DOC_NO', function ($sub) use ($user) {
        //         $sub->select('DOC_NO')
        //             ->from((new DocumentLogsModel)->getTable())
        //             ->where('ACTION_STATUS', 0)
        //             ->where('DOC_TO', $user->id)
        //             ->whereIn('DOC_CATEGORY', ['OUT', 'IN']);
        //     })
        //     ->distinct()
        //     ->count('DOC_NO');

        // return $completed_doc_ids_count;
    }

    public static function pis_access($user_module_accesses)
    {
        $user = Auth::user();
        $access = $user_module_accesses->where('module_code','=', 'PIS')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function toa_access($user_module_accesses)
    {
        $user = Auth::user();
        $access = $user_module_accesses->where('module_code','=', 'TOA')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function dts_access($user_module_accesses)
    {
        $user = Auth::user();
        $access = $user_module_accesses->where('module_code','=', 'DTS')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function lms_access($user_module_accesses)
    {
        $user = Auth::user();
        $access = $user_module_accesses->where('module_code','=', 'LMS')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function fsa_access($user_module_accesses)
    {
        $user = Auth::user();
        $access = $user_module_accesses->where('module_code','=', 'FSA')->where('module_access','=', '1')->count();
        return $access;
    }

    public static function app_access($user_module_accesses)
    {
        $user = Auth::user();
        $access = $user_module_accesses->where('module_code','=', 'APP')->where('module_access','=', '1')->count();
        return $access;
    }


    public static function user_access($process, $type, $userAccess)
    {
        $user = Auth::user();
        $access = $userAccess->where('window_id','=', $process)->where($type,'=', '1')->count();
        return $access;
    }

    public function computeRunTime($datetime1, $datetime2)
    {
        $new_datetime1 = new DateTime($datetime1);
        $new_datetime2 = new DateTime($datetime2);
        $new_interval = $new_datetime1->diff($new_datetime2);

        $new_months = $new_interval->format('%m');
        $new_days = $new_interval->format('%d');
        $new_hours = $new_interval->format('%h');
        $new_minutes = $new_interval->format('%i');

        $new_con_months="";
        $new_con_days="";
        $new_con_hours="";
        $new_con_minutes="";
        $checker = $new_datetime1->format('%h %i') != $new_datetime2->format('%h %i');

        if($new_months > 0) {
            if($new_months > 1) { $new_con_months = $new_months.' months, '; } 
            else if($new_months == 1) { $new_con_months = $new_months.' month, '; }
        } 

        if($new_days > 0) {
            if($new_days > 1) { $new_con_days = $new_days.' days, '; } 
            else if($new_days == 1) { $new_con_days = $new_days.' day, '; }
        } else if($new_days == 0) { $new_con_days = ''; }

        if($new_hours > 0) {
            if($new_hours > 1) { $new_con_hours = $new_hours.' hrs. '; } 
            else if($new_hours == 1) { $new_con_hours = $new_hours.' hr. '; }
        } else if($new_hours == 0) { $new_con_hours = ''; }

        if($new_minutes > 0) {
            if($new_minutes > 1) {
                if($new_hours > 0) { $new_con_minutes = ' & '.$new_minutes.' mins. '; } 
                else if($new_hours == 0) { $new_con_minutes = $new_minutes.' mins. '; }
            } else if($new_minutes == 1) {
                if($new_hours > 0) { $new_con_minutes = ' & '.$new_minutes.' min. '; } 
                else if($new_hours == 0) { $new_con_minutes = $new_minutes.' min. '; }
            }
        } else if($new_minutes == 0) { $new_con_minutes = ($checker && $new_interval->format('%s') > 0) ? 1 . ' min' : ''; }

        $new_time_consumed = $new_con_months.$new_con_days.$new_con_hours.$new_con_minutes;
        return $new_time_consumed;
    }

    public function getFileType($filename){
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file_type = 'Pdf File';
        if ($extension == 'jpg' || $extension == 'JPEG' || $extension == 'png' || $extension == 'PNG' || $extension == 'gif' || $extension == 'GIF' || $extension == 'io') {
            $file_type = 'Image File';
        } else if($extension == 'pdf') {
            $file_type = 'Pdf File';
        } else if($extension == 'docx') {
            $file_type = 'Word File';
        } else if($extension == 'xlsx' || $extension == 'csv') {
            $file_type = 'Excel File';
        } else if($extension == 'csv') {
            $file_type = 'Csv File';
        } else if($extension == 'pptx') {
            $file_type = 'Powerpoint File';
        } else if($extension == 'mp4') {
            $file_type = 'Video File';
        } else if($extension == 'txt') {
            $file_type = 'Text File';
        } else {
            $file_type = 'Other File';
        }
        return $file_type;
    }
}