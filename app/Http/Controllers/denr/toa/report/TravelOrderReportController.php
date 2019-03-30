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
use App\Models\denr\Travel_Order as TravelOrderModel;

use App\Http\Traits\denr\toa\report\TravelOrderReportTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class TravelOrderReportController extends Controller
{
    use TravelOrderReportTraits, UserAccessTraits;

    public function TravelOrderFilterForm()
    {
        if($this->user_access()){

            return $this->TravelOrderFilterFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function AjaxGetDivSection()
    {
        return $this->AjaxGetDivSectionFunction();
    }

    public function AjaxGetDivUnit()
    {
        return $this->AjaxGetDivUnitFunction();
    }

    public function AjaxGetSecUnit()
    {
        return $this->AjaxGetSecUnitFunction();
    }

    public function AjaxGetEmployee()
    {
        return $this->AjaxGetEmployeeFunction();
    }

    public function AjaxGetEmployeeOrder()
    {
        return $this->AjaxGetEmployeeOrderFunction();
    }

    public function TravelOrderFilterResult()
    {
        if($this->user_access()){

            return $this->TravelOrderFilterResultFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    

}
