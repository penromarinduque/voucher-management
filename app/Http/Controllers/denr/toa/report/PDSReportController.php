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

use App\Http\Traits\denr\toa\report\PDSReportTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class PDSReportController extends Controller
{
    use PDSReportTraits, UserAccessTraits;

    public function PDSFilterForm()
    {
    	if($this->user_access()){

        	return $this->PDSFilterFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function PDSFilterResult()
    { 
    	if($this->user_access()){

        	return $this->PDSFilterResultFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    

}
