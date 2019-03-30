<?php

namespace App\Http\Controllers\denr\toa\report;

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

use App\Http\Traits\denr\toa\report\EmployeeReportTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class EmployeeReportController extends Controller
{   
    use EmployeeReportTraits, UserAccessTraits;

    public function EmployeeFilterForm()
    {
    	if($this->user_access()){

        	return $this->EmployeeFilterFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function EmployeeFilterResult()
    {
    	if($this->user_access()){

        	return $this->EmployeeFilterResultFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    

}
