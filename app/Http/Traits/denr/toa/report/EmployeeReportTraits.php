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

trait EmployeeReportTraits
{
	public function EmployeeFilterFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $users = UserModel::all();
            $position = PositionModel::all();
            $division = DivisionModel::all();
            $section = SectionModel::all();
            $unit = UnitModel::all();
            return view('denr.toa.report.filter_employee_form')
                 ->with('position', $position)
                 ->with('division', $division)
                 ->with('section', $section)
                 ->with('unit', $unit)
                 ->with('users', $users);

        } else {

            return back();
        }
    }

    public function EmployeeFilterResultFunction()
    {
        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1' || $user->user_type == '2') {

                $query = UserModel::query();

                if (Input::has('employee_from')) {
                    $query = $query->where('id', '>=', Input::get('employee_from'));
                }
                if (Input::has('employee_to')) {
                    $query = $query->where('id', '<=', Input::get('employee_to'));
                }
                if (Input::has('position')) {
                    $query = $query->where('user_position', '=', Input::get('position'));
                }
                if (Input::has('division')) {
                    $query = $query->where('user_division', '=', Input::get('division'));
                }
                if (Input::has('section')) {
                    $query = $query->where('user_section', '=', Input::get('section'));
                }
                if (Input::has('unit')) {
                    $query = $query->where('user_unit', '=', Input::get('unit'));
                }
                if (Input::has('status')) {
                    $query = $query->where('user_status', '=', Input::get('status'));
                }

                $report_record = $query->get();

                $report_count = $query->count();

                $post_employee_from = UserModel::where('id','=', Input::get('employee_from'))->get()->first();
                $post_employee_to = UserModel::where('id','=', Input::get('employee_to'))->get()->first();
                $post_position = PositionModel::where('id','=', Input::get('position'))->get()->first();
                $post_division = DivisionModel::where('id','=', Input::get('division'))->get()->first();
                $post_section = SectionModel::where('id','=', Input::get('section'))->get()->first();
                $post_unit = UnitModel::where('id','=', Input::get('unit'))->get()->first();
                
                if (Input::get('employee_from') != '') {

                    $filter_employee_from = $post_employee_from->fname.' '.$post_employee_from->mname.' '.$post_employee_from->lname;
                
                } else {

                    $filter_employee_from = 'All';
                }

                if (Input::get('employee_to') != '') {

                    $filter_employee_to = $post_employee_to->fname.' '.$post_employee_to->mname.' '.$post_employee_to->lname;
                
                } else {

                    $filter_employee_to = 'All';
                }

                if (Input::get('position') != '') {

                    $filter_position = $post_position->position_title;
                
                } else {

                    $filter_position = 'All';
                }

                if (Input::get('division') != '') {

                    $filter_division = $post_division->division;
                
                } else {

                    $filter_division = 'All';
                }

                if (Input::get('section') != '') {

                    $filter_section = $post_section->section;
                
                } else {

                    $filter_section = 'All';
                }

                if (Input::get('unit') != '') {

                    $filter_unit = $post_unit->unit;
                
                } else {

                    $filter_unit = 'All';
                }

                
                if (Input::get('status') != '') {

                    if(Input::get('status')=='0'){

                        $status = 'Inactivr';

                    } else if(Input::get('status')=='1'){

                        $status = 'Active';

                    } 

                    $filter_status = $status;
                
                } else {

                    $filter_status = 'All';
                }

                return view('denr.toa.report.filter_employee_result')
                     ->with('report', $report_record)
                     ->with('rcount', $report_count)
                     ->with('employee_from', $filter_employee_from)
                     ->with('employee_to', $filter_employee_to)
                     ->with('position', $filter_position)
                     ->with('division', $filter_division)
                     ->with('section', $filter_section)
                     ->with('unit', $filter_unit)
                     ->with('status', $filter_status);
             
        } else {

            return back();
        }     

    }
}