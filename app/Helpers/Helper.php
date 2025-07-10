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
        $user = Auth::user();

        // $seen_log = DocumentLogsModel::where('DOC_TO','=', $user->id)->where('DOC_CATEGORY','=', 'IN')->where('SEEN','=', 'N')->count();
        // $seen_log = DocumentLogsModel::select('DOC_NO')
        // ->where('DOC_TO', $user->id)
        // ->where('DOC_CATEGORY', 'IN')
        // ->where('ACTION_STATUS', 0)
        // ->count();
        // return $seen_log;

        // $completed_doc_ids = DocumentLogsModel::select('DOC_NO')
        // ->where([
        //         'ACTION_TO_BE_TAKEN' => 14,
        //         'DOC_TO' => $user->id
        //     ])
        // ->distinct('DOC_NO')->get();

        // $acted_doc_ids = DocumentLogsModel::select('DOC_NO')
        // ->where([
        //         'ACTION_STATUS' => 1,
        //         'DOC_TO' => $user->id
        // ])
        // ->whereNotIn('DOC_NO', $completed_doc_ids->pluck('DOC_NO')->toArray())
        // ->distinct('DOC_NO')->get();

        $incoming_doc_ids = DocumentLogsModel::select('DOC_NO')
        ->where([
                'ACTION_STATUS' => 0,
                'DOC_TO' => $user->id,
                'DOC_CATEGORY' => "IN"
        ])
        // ->whereNotIn('DOC_NO', array_merge($acted_doc_ids->pluck('DOC_NO')->toArray(), $completed_doc_ids->pluck('DOC_NO')->toArray()))
        ->distinct('DOC_NO')->get();

        return $incoming_doc_ids->count();
    }

    public static function out_notification()
    {
        $user = Auth::user();

        // $seen_log = DocumentLogsModel::where('DOC_TO','=', $user->id)->where('DOC_CATEGORY','=', 'OUT')->where('SEEN','=', 'N')->count();
        // $valid_doc1 = DTS_DocRecordModel::select('DOC_NO')
        //         ->where('CREATED_BY', '=', $user->id)
        //         ->where('DOC_CATEGORY', '=', "OUT")
        //         ->distinct('DOC_NO')
        //         ->pluck(`DOC_NO`);
        
        // $valid_doc2 = DocumentLogsModel::select('DOC_NO')
        //         ->where('DOC_TO', '=', $user->id)
        //         ->where('DOC_CATEGORY', '=', "OUT")
        //         ->where('ACTION_STATUS', 0)
        //         ->distinct();
        // return $valid_doc2->count();
        // return $valid_doc1->union($valid_doc2)->pluck(`DOC_NO`)->unique()->count();

        // $completed_doc_ids = DocumentLogsModel::select('DOC_NO')
        // ->where([
        //         'ACTION_TO_BE_TAKEN' => 14,
        //         'DOC_TO' => $user->id
        //     ])
        // ->distinct('DOC_NO')->get();

        // $acted_doc_ids = DocumentLogsModel::select('DOC_NO')
        // ->where([
        //         'ACTION_STATUS' => 1,
        //         'DOC_TO' => $user->id
        // ])
        // ->whereNotIn('DOC_NO', $completed_doc_ids->pluck('DOC_NO')->toArray())
        // ->distinct('DOC_NO')->get();

        $outgoing_doc_ids = DocumentLogsModel::select('DOC_NO')
        ->where([
                'ACTION_STATUS' => 0,
                'DOC_TO' => $user->id,
                'DOC_CATEGORY' => 'OUT'
        ])
        // ->whereNotIn('DOC_NO', array_merge($acted_doc_ids->pluck('DOC_NO')->toArray(), $completed_doc_ids->pluck('DOC_NO')->toArray()))
        ->distinct('DOC_NO')->get();

        return $outgoing_doc_ids->count();
    }


    public static function acted_notification()
    {
        $user = Auth::user();

        // logs or docs that has action status of 1
        // complete logs or docs

        // acted
        // return count

        // $seen_log = DocumentLogsModel::select('DOC_NO')
        // ->where('DOC_TO', $user->id)
        // ->where('ACTION_STATUS', 1)
        // ->where('ACTION_TO_BE_TAKEN', 14)
        // ->groupBy('DOC_NO')
        // ->distinct()
        // ->get();

        $ongoing_doc_ids = DocumentLogsModel::select('DOC_NO')
            ->where([
                'ACTION_STATUS' => 0,
                'DOC_TO' => $user->id,
                'DOC_CATEGORY' => "OUT"
            ])
            // ->whereNotIn('DOC_NO', $excluded_doc_ids)
            ->distinct()
            ->get();

        $incoming_doc_ids = DocumentLogsModel::select('DOC_NO')
            ->where([
                'ACTION_STATUS' => 0,
                'DOC_TO' => $user->id,
                'DOC_CATEGORY' => "IN"
            ])
            // ->whereNotIn('DOC_NO', $excluded_doc_ids)
            ->distinct()
            ->get();

        $completed_doc_ids = DocumentLogsModel::select('DOC_NO')
        ->where([
                'ACTION_TO_BE_TAKEN' => 14,
                'DOC_TO' => $user->id
            ])
        ->orWhere([
                'ACTION_TO_BE_TAKEN' => 14,
                'DOC_FROM' => $user->id
            ])
        ->whereNotIn('DOC_NO', array_merge($incoming_doc_ids->pluck('DOC_NO')->toArray(), $ongoing_doc_ids->pluck('DOC_NO')->toArray()))
        ->distinct('DOC_NO')->get();

        $acted_doc_ids = DocumentLogsModel::select('DOC_NO')
        ->where([
                'ACTION_STATUS' => 1,
                'DOC_TO' => $user->id
        ])
        ->orWhere([
                'ACTION_STATUS' => 1,
                'DOC_FROM' => $user->id
        ])
        ->orWhere([
            'ACTION_STATUS' => 0,
            'DOC_FROM' => $user->id
        ])
        ->whereNotIn('DOC_NO', array_merge($completed_doc_ids->pluck('DOC_NO')->toArray(), $ongoing_doc_ids->pluck('DOC_NO')->toArray(), $incoming_doc_ids->pluck('DOC_NO')->toArray()))
        ->distinct('DOC_NO')->get();

        return $acted_doc_ids->count();
    }

    public static function completed_notification()
    {
        $user = Auth::user();

        // $valid_doc1 = DTS_DocRecordModel::select('DOC_NO')
        // ->where('CREATED_BY', '=', $user->id)
        // ->where('STATUS', '=', "C")
        // ->distinct('DOC_NO')
        // ->get()
        // ->pluck("DOC_NO");
        // $valid_doc2 = DocumentLogsModel::select('DOC_NO')
        // ->whereNotIn('DOC_NO', $valid_doc1)
        // ->where('ACTION_STATUS', 1)
        // ->where('DOC_TO', $user->id)
        // ->where('ACTION_TO_BE_TAKEN', 14)
        // ->distinct('DOC_NO')
        // ->get()
        // ->pluck("DOC_NO");
        // return $valid_doc2->count() + $valid_doc1->count();
        // return $valid_doc1->union($valid_doc2)->get()->count();

        $ongoing_doc_ids = DocumentLogsModel::select('DOC_NO')
            ->where([
                'ACTION_STATUS' => 0,
                'DOC_TO' => $user->id,
                'DOC_CATEGORY' => "OUT"
            ])
            // ->whereNotIn('DOC_NO', $excluded_doc_ids)
            ->distinct()
            ->get();

        $incoming_doc_ids = DocumentLogsModel::select('DOC_NO')
        ->where([
            'ACTION_STATUS' => 0,
            'DOC_TO' => $user->id,
            'DOC_CATEGORY' => "IN"
        ])
        // ->whereNotIn('DOC_NO', $excluded_doc_ids)
        ->distinct()
        ->get(); // No need to repeat the query

        $completed_doc_ids = DocumentLogsModel::select('DOC_NO')
        ->where([
                'ACTION_TO_BE_TAKEN' => 14,
                'DOC_TO' => $user->id
            ])
        ->orWhere([
                'ACTION_TO_BE_TAKEN' => 14,
                'DOC_FROM' => $user->id
            ])
        ->whereNotIn('DOC_NO', array_merge($incoming_doc_ids->pluck('DOC_NO')->toArray(), $ongoing_doc_ids->pluck('DOC_NO')->toArray()))
        ->distinct('DOC_NO')->get();

        return $completed_doc_ids->count();
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