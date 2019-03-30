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


trait UserModuleAccessTraits
{
	public function ShowUserModuleAccessFunction()
    {
        $user_record = UserModel::all();
        $module_record = ModuleModel::where('module_flag','=', 'Y')
                                    ->orderBy('MODULE_ORDER', 'ASC')
                                    ->get();

        return view('denr.app.user_module_access')
                   ->with('user', $user_record)
                   ->with('module', $module_record);
	}

    public function ShowAjaxUserModuleAccessFunction(Request $request)
    { 

        $user_code = $request->input('user');
        $userinfo = UserModel::where('id', '=', $user_code)->first();

        if($userinfo->user_type == '1') {

          $modules = ModuleModel::select('module_code')->where('module_flag','=','Y')->get();

        } else if($userinfo->user_type != '1') {
          
          $modules = ModuleModel::select('module_code')->where('module_flag','=','Y')->where('module_code','!=','APP')->get();

        }

        $record_count = ModuleModel::leftJoin('app_user_module_access', 'app_module.module_code', '=', 'app_user_module_access.module_code')
                                      ->where('app_user_module_access.user', '=', $user_code)
                                      ->count();

        if($record_count == 0) {

          if($userinfo->user_type == '1') {

          $module_record = ModuleModel::where('module_flag','=','Y')
                                      ->orderBy('module_order', 'ASC')
                                      ->get();

          } else if($userinfo->user_type != '1') {

          $module_record = ModuleModel::where('module_flag','=','Y')
                                      ->where('module_code','!=','APP')
                                      ->orderBy('module_order', 'ASC')
                                      ->get();
          }

        } else if($record_count > 0) {

            if($userinfo->user_type == '1') {

            $module_exist = UserModuleAccessModel::select('module_code')
                                                 ->where('user', '=', $user_code)
                                                 ->get();

            } else if($userinfo->user_type != '1') {

            $module_exist = UserModuleAccessModel::select('module_code')
                                                 ->where('user', '=', $user_code)
                                                 ->where('module_code','!=','APP')
                                                 ->get();


            }

            $module_record1 = ModuleModel::select(\DB::raw("app_user_module_access.user, app_user_module_access.module_code, app_module.module_desc, app_user_module_access.module_access, app_module.module_order"))
                                            ->leftJoin('app_user_module_access', 'app_module.module_code', '=', 'app_user_module_access.module_code')
                                            ->where('app_user_module_access.user', '=', $user_code)
                                            ->whereIn('app_user_module_access.module_code', $modules);

            $module_record2 = ModuleModel::select(\DB::raw("'' AS 'user', module_code AS 'module_code', module_desc AS 'module_desc', '' AS 'module_access', module_order AS 'module_order'"))
                                            ->whereNotIn('module_code', $module_exist)
                                            ->whereIn('module_code', $modules);

            $module_record = $module_record1->union($module_record2)->orderBy('module_order','ASC')->get();


        }

        if($user_code != '') {

            $record['record'] = $module_record;


            return Response::json($record);

        }
    }

	public function AddUserModuleAccessFunction(Request $request)
	{
          $module_code = $request->input('module_code');
          $user_code = $request->input('user');
          $encode = Crypt::encrypt($user_code);

          $record_count = ModuleModel::leftJoin('app_user_module_access', 'app_module.module_code', '=', 'app_user_module_access.module_code')
                              ->where('app_user_module_access.user', '=', $user_code)
                              ->count();

          if($record_count == 0) {

              //ADD

              if($request->has('module_code')) {

                  foreach($module_code as $index => $value) {

                      $userModuleAccess = [

                      'user' => $request->input('user'),
                      'module_code' => $request->input('module_code')[$index],
                      'module_access' => $this->getAllChkboxValues($request->input('module_access'))[$index]

                      ];

                      UserModuleAccessModel::insert($userModuleAccess);
                  }

              }

              Session::flash('success', 'User Module Access of ('.$user_code.') successfully added.');

              return back();

          } else if($record_count > 0) {

              //UPDATE

              if($request->has('module_code')) {

                  //$delete_access = SysUserModuleAccessModel::where('USER_ID', '=', $user_code)->where('COMPANY_CODE', '=', $com_code)->delete();
                  
                  foreach($module_code as $index => $value) {

                      $mod_count = UserModuleAccessModel::where('user', '=', $user_code)
                                                        ->where('module_code', '=', $request->input('module_code')[$index])
                                                        ->count();

                      $userModuleAccess = [

                      'user' => $request->input('user'),
                      'module_code' => $request->input('module_code')[$index],
                      'module_access' => $this->getAllChkboxValues($request->input('module_access'))[$index]

                      ];

                      if($mod_count > 0) {

                      UserModuleAccessModel::where('user','=', $user_code)
                                           ->where('module_code', '=', $module_code[$index])
                                           ->update($userModuleAccess);

                      } else if($mod_count == 0) {

                      UserModuleAccessModel::insert($userModuleAccess);

                      }
                  }

                  
              }

              Session::flash('success', 'User Module Access of ('.$user_code.') successfully updated.');

              return back();

          }
	}

}