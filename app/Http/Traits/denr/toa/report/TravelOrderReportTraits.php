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
use App\Models\denr\Travel_Order as TravelOrderModel;

trait TravelOrderReportTraits
{
	public function TravelOrderFilterFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $users = UserModel::all();
            $travel_order = TravelOrderModel::all();
            $position = PositionModel::all();
            $division = DivisionModel::all();
            $section = SectionModel::all();
            $unit = UnitModel::all();
            return view('denr.toa.report.filter_travel_order_form')
                 ->with('position', $position)
                 ->with('division', $division)
                 ->with('section', $section)
                 ->with('unit', $unit)
                 ->with('users', $users)
                 ->with('travel', $travel_order);

        } else {

            return back();
        }
    }

    public function AjaxGetDivSectionFunction()
    {
        $user = Auth::user();

        $section = SectionModel::where('division_id', '=', Input::get('division'))->get();

        return view('denr.ajax.sectiondata')->with('section', $section);

    }

    public function AjaxGetDivUnitFunction()
    {
        $user = Auth::user();

        $unit = UnitModel::where('division_id', '=', Input::get('division'))->get();

        return view('denr.ajax.unitdata')->with('unit', $unit);

    }

    public function AjaxGetSecUnitFunction()
    {
        $user = Auth::user();

        $unit = UnitModel::where('section_id', '=', Input::get('section'))->get();

        return view('denr.ajax.unitdata')->with('unit', $unit);

    }

    public function AjaxGetEmployeeFunction()
    {
        $user = Auth::user();

        $query = UserModel::query();

        if (Input::has('division')) {
            $query = $query->where('user_division', '=', Input::get('division'));
        }

        if (Input::has('section')) {
            $query = $query->where('user_section', '=', Input::get('section'));
        }

        if (Input::has('unit')) {
            $query = $query->where('user_unit', '=', Input::get('unit'));
        }

        if (Input::has('position')) {
            $query = $query->where('user_position', '=', Input::get('position'));
        }

        $employee = $query->get();

        return view('denr.ajax.employeedata')->with('employee', $employee);

    }

    public function AjaxGetEmployeeOrderFunction()
    {
        $user = Auth::user();

        $query = TravelOrderModel::query();

        if (Input::has('division')) {
            $query = $query->where('division', '=', Input::get('division'));
        }

        if (Input::has('section')) {
            $query = $query->where('section', '=', Input::get('section'));
        }

        if (Input::has('unit')) {
            $query = $query->where('unit', '=', Input::get('unit'));
        }

        if (Input::has('position')) {
            $query = $query->where('position_id', '=', Input::get('position'));
        }

        if (Input::has('employee')) {
            $query = $query->where('user_id', '=', Input::get('employee'));
        }

        $order = $query->get();

        return view('denr.ajax.orderdata')->with('order', $order);

    }

    public function TravelOrderFilterResultFunction()
    {
        $user = Auth::user();

        

                $query = TravelOrderModel::query();

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
                if (Input::has('status')) {
                    $query = $query->where('approval_status', '=', Input::get('status'));
                }

                $report_record = $query->get();

                $report_count = $query->count();

                $post_employee = UserModel::where('id','=', Input::get('employee'))->get()->first();
                $post_position = PositionModel::where('id','=', Input::get('position'))->get()->first();
                $post_division = DivisionModel::where('id','=', Input::get('division'))->get()->first();
                $post_section = SectionModel::where('id','=', Input::get('section'))->get()->first();
                $post_unit = UnitModel::where('id','=', Input::get('unit'))->get()->first();
                
                if (Input::get('employee') != '') {

                    $filter_employee = $post_employee->fname.' '.$post_employee->mname.' '.$post_employee->lname;
                
                } else {

                    $filter_employee = 'All';
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

                if (Input::get('order_from') != '') {

                    $filter_order_from = Input::get('order_from');
                
                } else {

                    $filter_order_from = 'All';
                }

                if (Input::get('order_to') != '') {

                    $filter_order_to = Input::get('order_to');
                
                } else {

                    $filter_order_to = 'All';
                }

                if (Input::get('status') != '') {

                    if(Input::get('status')=='0'){

                        $status = 'Pending';

                    } else if(Input::get('status')=='1'){

                        $status = 'Recommended';

                    } else if(Input::get('status')=='2'){

                        $status = 'Approved';
                    }

                    $filter_status = $status;
                
                } else {

                    $filter_status = 'All';
                }

                if (Input::get('date_from') != '') {

                    $filter_date_from = Input::get('date_from');
                
                } else {

                    $filter_date_from = 'All';
                }

                if (Input::get('date_to') != '') {

                    $filter_date_to = Input::get('date_to');
                
                } else {

                    $filter_date_to = 'All';
                }

                return view('denr.toa.report.filter_travel_order_result')
                     ->with('report', $report_record)
                     ->with('rcount', $report_count)
                     ->with('employee', $filter_employee)
                     ->with('position', $filter_position)
                     ->with('division', $filter_division)
                     ->with('section', $filter_section)
                     ->with('unit', $filter_unit)
                     ->with('order_from', $filter_order_from)
                     ->with('order_to', $filter_order_to)
                     ->with('date_from', $filter_date_from)
                     ->with('date_to', $filter_date_to)
                     ->with('status', $filter_status);


             
           

    }


}
