<?php

namespace App\Http\Controllers\denr\toa\activity;

use Crypt;
use Auth;
use Session;
use Response;
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
use App\Models\denr\Form_No as FormNoModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;
use App\Models\denr\Itinerary as ItineraryModel;

use App\Http\Traits\denr\toa\activity\TravelOrderTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class TravelOrderController extends Controller
{
    use TravelOrderTraits, UserAccessTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function ShowTravelOrderList()
    {
        if($this->user_access()){

            return $this->ShowTravelOrderListFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }  
    }


    public function ShowTravelOrderForm()
    {
        if($this->user_access()){

            return $this->ShowTravelOrderFormFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function AddTravelOrder(Request $request) 
    {

        if($this->user_access()){

            return $this->AddTravelOrderFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }

    }

    public function ViewTravelOrder(Request $request, $id)
    {
        if($this->user_access()){

            return $this->ViewTravelOrderFunction($request, $id);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function EditTravelOrder(Request $request) 
    {

        if($this->user_access()){

            return $this->EditTravelOrderFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }

    }

    public function PrintTravelOrder(Request $request, $id)
    {
        if($this->user_access()){

           return $this->PrintTravelOrderFunction($request, $id);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function PrintItinerary(Request $request, $id)
    {
        if($this->user_access()){

             return $this->PrintItineraryFunction($request, $id);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }

    public function DeleteTravelOrder(Request $request)
    {

        if($this->user_access()){

            return $this->DeleteTravelOrderFunction($request);
            
        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
    }


    public function CancelTravelOrder(Request $request)
    {
        
        if($this->user_access()){

            return $this->CancelTravelOrderFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        }
        
    }

}
