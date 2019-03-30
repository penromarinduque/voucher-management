<?php

namespace App\Http\Controllers\denr\toa\approval;

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
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\Form_No as FormNoModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\toa\approval\PendingTravelOrderTraits;
use App\Http\Traits\denr\app\UserAccessTraits;

class PendingTravelOrderController extends Controller
{
    use PendingTravelOrderTraits, UserAccessTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowPendingTravelOrderList()
    {

        if($this->user_access()){

            $user = Auth::user();
            //CHECK USER TYPE
            if($user->user_type == '1') {

                return $this->ShowPendingTravelOrderListFunction1();

            } else if($user->user_type != '1') {

                return $this->ShowPendingTravelOrderListFunction2();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();

            }  

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }



    public function ShowApprovedTravelOrderList()
    {
        if($this->user_access()){

            $user = Auth::user();
            //CHECK USER TYPE
            if($user->user_type == '1' || $user->user_type == '2') {

                return $this->ShowApprovedTravelOrderListFunction1();

            } else if($user->user_type == '3') {

                return $this->ShowApprovedTravelOrderListFunction2();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();
            }  

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function ShowDisapprovedTravelOrderList()
    {

        if($this->user_access()){

            $user = Auth::user();

            //CHECK USER TYPE
            if($user->user_type == '1' || $user->user_type == '2') {

                return $this->ShowDisapprovedTravelOrderListFunction2();

            } else if($user->user_type == '3') {

                return $this->ShowDisapprovedTravelOrderListFunction2();

            } else {

                Session::flash('failed', 'You have no rights to access '.$this->window_desc());
                return back();
            }  

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function ShowCancelledTravelOrderList()
    {
        if($this->user_access()){

            return $this->ShowCancelledTravelOrderListFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    
    public function ViewPendingTravelOrder(Request $request, $id)
    {
        if($this->user_access()){

            return $this->ViewPendingTravelOrderFunction($request, $id);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

    public function ApprovePendingTravelOrder(Request $request) 
    {
        if($this->user_access()){

            return $this->ViewPendingTravelOrderFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }


    public function RecommendPendingTravelOrder(Request $request) 
    {
        if($this->user_access()){

            return $this->RecommendPendingTravelOrderFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();
        } 
    }

}
