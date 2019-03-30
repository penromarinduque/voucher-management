<?php

namespace App\Http\Controllers\denr;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\denr\Travel_Order as TravelOrdeModel;
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\User as UserModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;

use App\Http\Traits\denr\HomeTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class HomeController extends Controller
{
    use HomeTraits, UserAccessTraits;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->indexFunction();
    }

    public function PersonalInformation()
    {
        if($this->user_module_access()){

            return $this->PersonalInformationFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->module_desc());
            return back();

        }
    }

    public function TravelOrderApplication()
    {
        if($this->user_module_access()){

            return $this->TravelOrderApplicationFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->module_desc());
            return back();

        }
    }

    public function DocumentTrackingSystem()
    {
        if($this->user_module_access()){

            return $this->DocumentTrackingSystemFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->module_desc());
            return back();

        }
    }

    public function LeaveMonitoring()
    {
        if($this->user_module_access()){

            return $this->LeaveMonitoringFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->module_desc());
            return back();

        }
    }

    public function FrontlineServices()
    {
        if($this->user_module_access()){

            return $this->FrontlineServicesFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->module_desc());
            return back();

        }
    }

    public function SystemUtilities()
    {
        $user = Auth::user();
        
        if($this->user_module_access()){

            return $this->SystemUtilitiesFunction();

        } else {

            if($user->user_type == '1'){

                return $this->SystemUtilitiesFunction();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->module_desc());
                return back();

            }

        }
    }


}
