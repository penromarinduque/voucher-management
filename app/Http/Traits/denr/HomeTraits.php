<?php

namespace App\Http\Traits\denr;

use Auth;
use Illuminate\Http\Request;

use App\Models\denr\Travel_Order as TravelOrdeModel;
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\User as UserModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;

trait HomeTraits
{

	public function indexFunction()
    {
        $user = Auth::user();
        return view('denr.index');       
    }

    public function PersonalInformationFunction()
    {
        $user = Auth::user();
        return view('denr.pis.dashboard_pis');
    }

    public function TravelOrderApplicationFunction()
    {
        $user = Auth::user();
        return view('denr.toa.dashboard_toa');
    }

    public function DocumentTrackingSystemFunction()
    {
        $user = Auth::user();
        return view('denr.dts.dashboard_dts');
    }

    public function LeaveMonitoringFunction()
    {
        $user = Auth::user();
        return view('denr.index');
    }

    public function FrontlineServicesFunction()
    {
        $user = Auth::user();
        return view('denr.index');
    }

    public function SystemUtilitiesFunction()
    {
        $user = Auth::user();
        return view('denr.app.dashboard_app');
    }

}