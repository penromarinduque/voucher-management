<?php

namespace App\Http\Traits\denr\app;

use Crypt;
use Auth;
use Session;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;
use App\Models\denr\User as UserModel;

trait AuditTrailTraits
{

	public function showAuditFormFunction()
	{
		$user = Auth::user();

		$user_record = UserModel::all();
        return view('denr.app.audit_trail_log')->with('user', $user_record);

	}

	public function filterAuditFunction(Request $request)
	{

		$user = Auth::user();

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

        return view('denr.app.filter_audit_trail_Log')->with('audit', $trn_record)->with('fcount', $trn_count);
     

	}

}