<?php

namespace App\Http\Traits\denr\app;

use Crypt;
use Auth;
use Session;
use Response;
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


trait UserAccessTraits
{

  public function current_module()
  {
      $url = url()->current();
        list($http, $http2, $domain, $path) = explode('/', $url);
        return $path;
  }

  public function current_window()
  {
      $url = url()->current();
      list($http, $http2, $domain, $path, $window_type, $window) = explode('/', $url);
      return $window;
  }

  public function current_subwindow()
  {
      $url = url()->current();
      list($http, $http2, $domain, $path, $window_type, $window, $subwindow) = explode('/', $url);
      return $subwindow;
  }

  public function window_desc()
  {
      $window_desc = WindowModel::where('window_name','=', $this->current_window())->first();
      return $window_desc->window_desc;
  }

  public function user_access()
  {
      $user = Auth::user();

      $window = WindowModel::where('window_name','=', $this->current_window())->first();
      $subwindow = $this->current_subwindow();

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

      } else if($subwindow == 'forward') {

          $access = UserAccessModel::where('user','=',$user->id)
                                   ->where('window_id','=', $window->window_id)
                                   ->where('view_access','=', '1')
                                   ->count();

      } 

      if($access == 0) {

        $return = false;

      } else if($access == 1) {

        $return = true;
        
      }

      return $return;
  }


  public function module_desc()
  {
      $module = ModuleModel::where('module_path','=', $this->current_module())->first();
      return $module->module_desc;
  }


  public function user_module_access()
  {
      $user = Auth::user();

      $module = ModuleModel::where('module_path','=', $this->current_module())->first();

      $access = UserModuleAccessModel::where('user','=',$user->id)
                                     ->where('module_code','=', $module->module_code)
                                     ->where('module_access','=', '1')
                                     ->count();

      if($access == 0) {

        $return = false;

      } else if($access == 1) {

        $return = true;
        
      }

      return $return;
  }






	public function ShowUserAccessFunction()
  {
      $user_record = UserModel::all();
      $module_record = ModuleModel::where('module_flag','=', 'Y')
                                  ->orderBy('MODULE_ORDER', 'ASC')
                                  ->get();

      return view('denr.app.user_access')
                 ->with('user', $user_record)
                 ->with('module', $module_record);
	}

  public function ShowAjaxUserAccessFunction(Request $request)
  { 
      $user_code = $request->input('user');
      $module_code = $request->input('module');
      $userinfo = UserModel::where('id','=',$user_code)->first();
      $window_access = UserAccessModel::where('user','=',$user_code)->get();
      $user_module = UserModuleAccessModel::select('module_code')->where('user', '=', $user_code)->where('module_access', '=', '1')->get();

      if($module_code == 'ALL') {

          $record_count = WindowModel::leftJoin('app_user_access', 'app_window.window_id', '=', 'app_user_access.window_id')
                                        ->where('app_user_access.user', '=', $user_code)
                                        ->count();

          if($record_count == 0) {

              $window_record = WindowModel::whereIn('module_code', $user_module)
                                             ->where('window_flag','=','Y')
                                             ->orderBy('window_order', 'ASC')
                                             ->get();

          } else if($record_count > 0) {

            $window_exist = UserAccessModel::select('window_id')->where('user', '=', $user_code)->get();

            $window_record1 = WindowModel::select(\DB::raw("app_user_access.user, app_user_access.window_id, app_user_access.view_access, app_user_access.add_access, app_user_access.edit_access, app_user_access.delete_access, app_user_access.print_access, app_window.window_type, app_window.window_desc, app_window.module_code, app_window.window_order"))
                                            ->leftJoin('app_user_access', 'app_window.window_id', '=', 'app_user_access.window_id')
                                            ->where('app_user_access.user', '=', $user_code)
                                            ->where('app_window.window_flag','=','Y')
                                            ->whereIn('app_window.module_code', $user_module);

            $window_record2 = WindowModel::select(\DB::raw("'' AS 'user', window_id AS 'window_id', '0' AS 'view_access', '0' AS 'add_access', '0' AS 'edit_access', '0' AS 'delete_access', '0' AS 'print_access', window_type AS 'window_type', window_desc AS 'window_desc', module_code AS 'module_code', window_order AS 'window_order'"))
                                              ->where('window_flag','=','Y')
                                              ->whereIn('module_code', $user_module)
                                              ->whereNotIn('window_id', $window_exist);;

            $window_record = $window_record1->union($window_record2)->orderBy('window_order','ASC')->get();

          }

      } else {

          $record_count = WindowModel::leftJoin('app_user_access', 'app_window.window_id', '=', 'app_user_access.window_id')
                                        ->where('app_window.module_code', '=', $module_code)
                                        ->where('app_window.window_flag','=','Y')
                                        ->where('app_user_access.user', '=', $user_code)
                                        ->count();

          if($record_count == 0) {

              $window_record = WindowModel::where('module_code', '=', $module_code)
                                             ->where('window_flag','=','Y')
                                             ->orderBy('window_order', 'ASC')
                                             ->get();
            
          } else if($record_count > 0) {

            $window_exist = UserAccessModel::select('window_id')->where('user', '=', $user_code)->get();

            $window_record1 = WindowModel::select(\DB::raw("app_user_access.user, app_user_access.window_id, app_user_access.view_access, app_user_access.add_access, app_user_access.edit_access, app_user_access.delete_access, app_user_access.print_access, app_window.window_type, app_window.window_desc, app_window.module_code, app_window.window_order"))
                                            ->leftJoin('app_user_access', 'app_window.window_id', '=', 'app_user_access.window_id')
                                            ->where('app_user_access.user', '=', $user_code)
                                            ->where('app_window.window_flag','=','Y')
                                            ->where('app_window.module_code', '=', $module_code);

            $window_record2 = WindowModel::select(\DB::raw("'' AS 'user', window_id AS 'window_id', '0' AS 'view_access', '0' AS 'add_access', '0' AS 'edit_access', '0' AS 'delete_access', '0' AS 'print_access', window_type AS 'window_type', window_desc AS 'window_desc', module_code AS 'module_code', window_order AS 'window_order'"))
                                            ->where('window_flag','=','Y')
                                            ->where('module_code', '=', $module_code)
                                            ->whereNotIn('window_id', $window_exist);

            $window_record = $window_record1->union($window_record2)->orderBy('window_order','ASC')->get();

          }

      }

      if($user_code != '') {

        $record['record'] = $window_record;

        return Response::json($record);

      }
  }

  public function showAjaxUserModuleFunction(Request $request)
  {
      $user_code = $request->input('user');
      $userinfo = UserModel::where('id','=',$user_code)->first();
      $user_module = UserModuleAccessModel::select('module_code')->where('user', '=', $user_code)->where('module_access', '=', '1')->get();

      $module_record = ModuleModel::whereIn('module_code', $user_module)
                                     ->orderBy('module_order', 'ASC')
                                     ->get();

      $record['record'] = $module_record;                              

      return Response::json($record);       
  }

	public function AddUserAccessFunction(Request $request)
	{
      $window_id = $request->input('window_id');
      $user_code = $request->input('user');
      $module_code = $request->input('module');

      if($module_code == 'ALL') {

          $record_count = WindowModel::leftJoin('app_user_access', 'app_window.window_id', '=', 'app_user_access.window_id')
                                        ->where('app_user_access.user', '=', $user_code)
                                        ->count();

          if($record_count == 0) {

              //ADD

              if($request->has('window_id')) {

                  foreach($window_id as $index => $value) {

                      $userAccess = [

                      'user' => $request->input('user'),
                      'window_id' => $request->input('window_id')[$index],
                      'view_access' => $this->getAllChkboxValues($request->input('view_access'))[$index],
                      'add_access' => $this->getAllChkboxValues($request->input('add_access'))[$index],
                      'edit_access' => $this->getAllChkboxValues($request->input('edit_access'))[$index],
                      'delete_access' => $this->getAllChkboxValues($request->input('delete_access'))[$index],
                      'print_access' => $this->getAllChkboxValues($request->input('print_access'))[$index],

                      ];

                      UserAccessModel::insert($userAccess);
                  }

              }

              Session::flash('success', 'User Access of ('.$user_code.') successfully added.');

              return back();

          } else if($record_count > 0) {

              //UPDATE

              if($request->has('window_id')) {

                  foreach($window_id as $index => $value) {

                      $access_count = UserAccessModel::where('window_id', '=', $request->input('window_id')[$index])
                                                        ->where('user', '=', $request->input('user'))
                                                        ->count();

                      $userAccess = [

                      'user' => $request->input('user'),
                      'window_id' => $request->input('window_id')[$index],
                      'view_access' => $this->getAllChkboxValues($request->input('view_access'))[$index],
                      'add_access' => $this->getAllChkboxValues($request->input('add_access'))[$index],
                      'edit_access' => $this->getAllChkboxValues($request->input('edit_access'))[$index],
                      'delete_access' => $this->getAllChkboxValues($request->input('delete_access'))[$index],
                      'print_access' => $this->getAllChkboxValues($request->input('print_access'))[$index],

                      ];

                      if($access_count > 0) {

                      UserAccessModel::where('user','=', $user_code)
                                     ->where('window_id', '=', $window_id[$index])
                                     ->update($userAccess);

                      } else if($access_count == 0) {

                      UserAccessModel::insert($userAccess);

                      }
                  }

                 
              }

              Session::flash('success', 'User Access of ('.$user_code.') successfully updated.');

              return back();

          }

      } else {

          $record_count = WindowModel::leftJoin('app_user_access', 'app_window.window_id', '=', 'app_user_access.window_id')
                                        ->where('app_window.module_code', '=', $module_code)
                                        ->where('app_user_access.user', '=', $user_code)
                                        ->count();

          if($record_count == 0) {

              //ADD

             if($request->has('window_id')) {

                  foreach($window_id as $index => $value) {

                      $userAccess = [

                      'user' => $request->input('user'),
                      'window_id' => $request->input('window_id')[$index],
                      'view_access' => $this->getAllChkboxValues($request->input('view_access'))[$index],
                      'add_access' => $this->getAllChkboxValues($request->input('add_access'))[$index],
                      'edit_access' => $this->getAllChkboxValues($request->input('edit_access'))[$index],
                      'delete_access' => $this->getAllChkboxValues($request->input('delete_access'))[$index],
                      'print_access' => $this->getAllChkboxValues($request->input('print_access'))[$index],

                      ];

                      UserAccessModel::insert($userAccess);
                  }

                 
              }

              Session::flash('success', 'User Access of ('.$user_code.') successfully added.');

              return back();

          } else if($record_count > 0) {

              //UPDATE

              if($request->has('window_id')) {

                  foreach($window_id as $index => $value) {

                      $access_count = UserAccessModel::where('window_id', '=', $request->input('window_id')[$index])
                                                        ->where('user', '=', $request->input('user'))
                                                        ->count();

                      $userAccess = [

                      'user' => $request->input('user'),
                      'window_id' => $request->input('window_id')[$index],
                      'view_access' => $this->getAllChkboxValues($request->input('view_access'))[$index],
                      'add_access' => $this->getAllChkboxValues($request->input('add_access'))[$index],
                      'edit_access' => $this->getAllChkboxValues($request->input('edit_access'))[$index],
                      'delete_access' => $this->getAllChkboxValues($request->input('delete_access'))[$index],
                      'print_access' => $this->getAllChkboxValues($request->input('print_access'))[$index],

                      ];

                      if($access_count > 0) {

                      UserAccessModel::where('user','=', $user_code)
                                        ->where('window_id', '=', $window_id[$index])
                                        ->update($userAccess);

                      } else if($access_count == 0) {

                      UserAccessModel::insert($userAccess);

                      }
                  }
 
              }

              Session::flash('success', 'User Access of ('.$user_code.') successfully updated.');

              return back();

          }

          
      }


	}

}