<?php

namespace App\Http\Traits\denr\toa\report;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;

trait PDSReportTraits
{
	public function PDSFilterFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $users = UserModel::all();
            $position = PositionModel::all();
            $division = DivisionModel::all();
            $section = SectionModel::all();
            $unit = UnitModel::all();
            return view('denr.toa.report.filter_pds_form')
                 ->with('position', $position)
                 ->with('division', $division)
                 ->with('section', $section)
                 ->with('unit', $unit)
                 ->with('users', $users);

        } else {

            return back();
        }
    }

    public function PDSFilterResultFunction()
    {
        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1' || $user->user_type == '2') {

                $query = UserModel::query();

                if (Input::has('employee')) {
                    $query = $query->where('user_id', '=', Input::get('employee'));
                }
                if (Input::has('position')) {
                    $query = $query->where('position_id', '=', Input::get('position'));
                }
                if (Input::has('date_from')) {
                    $query = $query->whereDate('date_filling', '>=', Input::get('date_from'));
                }
                if (Input::has('date_to')) {
                    $query = $query->whereDate('date_filling', '<=', Input::get('date_to'));
                }
                if (Input::has('order_from')) {
                    $query = $query->where('order_no', '>=', Input::get('order_from'));
                }
                if (Input::has('order_to')) {
                    $query = $query->where('order_no', '<=', Input::get('order_to'));
                }
                if (Input::has('division')) {
                    $query = $query->where('division', '=', Input::get('division'));
                }
                if (Input::has('section')) {
                    $query = $query->where('section', '=', Input::get('section'));
                }
                if (Input::has('unit')) {
                    $query = $query->where('unit', '=', Input::get('unit'));
                }

                $report_record = $query->get();

                $report_count = $query->count();

                return view('denr.toa.report.filter_pds_result')->with('report', $report_record)->with('rcount', $report_count);
             
        } else {

            return back();
        }     

    }
}