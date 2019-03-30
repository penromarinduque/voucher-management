<?php

namespace App\Http\Traits\denr\my_account;

use Auth;
use Response;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;
use App\Models\denr\User as UserModel;

trait MyAuditTrailTraits
{

	public function showMyAuditFormFunction()
	{
		$user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1' || $user->user_type == '2' || $user->user_type == '3') {

            $user_record = UserModel::all();
            return view('denr.my_account.my_audit_trail_log')->with('user', $user_record);

        } else {

            return back();
        }    
	}

	public function filterMyAuditFunction(Request $request)
	{
		$user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1' || $user->user_type == '2' || $user->user_type == '3') {

                $user_id = $request->input('user_id');
                $date_from = $request->input('date_from');
                $date_to = $request->input('date_to');
                $action_type = $request->input('action_type');
                $module_code = $request->input('module_code');
                $window = $request->input('window_page');

                $query = AuditTrailLogModel::query();

                if (Input::has('user_id')) {
                    $query = $query->where('user_id', '=', Input::get('user_id'));
                }
                if (Input::has('date_from')) {
                    $query = $query->whereDate('date_action', '>=', Input::get('date_from'));
                }
                if (Input::has('date_to')) {
                    $query = $query->whereDate('date_action', '<=', Input::get('date_to'));
                }
                if (Input::has('action_type')) {
                    $query = $query->where('action_type', '=', Input::get('action_type'));
                }
                if (Input::has('module_code')) {
                    $query = $query->where('module_code', '=', Input::get('module_code'));
                }
                if (Input::has('window_page')) {
                    $query = $query->where('window_page', '=', Input::get('window_page'));
                }

                $trn_record = $query->get();

                $trn_count = $query->count();

                return view('denr.my_account.filter_my_audit_trail_Log')->with('audit', $trn_record)->with('fcount', $trn_count);
             
        } else {

            return back();
        }     
	}

}