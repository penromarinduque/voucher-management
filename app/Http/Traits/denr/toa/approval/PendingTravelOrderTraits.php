<?php

namespace App\Http\Traits\denr\toa\approval;

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

trait PendingTravelOrderTraits
{

	public function ShowPendingTravelOrderListFunction1()
	{
		$user = Auth::user();
		$order_record = TravelOrderModel::where('approval_status','!=','2')->where('approval_status','!=','3')->where('approval_status','!=','4')->get();
            return view('denr.toa.approval.pending_travel_order')->with('order', $order_record);
	}

	public function ShowPendingTravelOrderListFunction2()
	{	
		$user = Auth::user();
		$order_record = TravelOrderModel::where('approval_status','!=','2')
                                            ->where('approval_status','!=','3')
                                            ->where('approval_status','!=','4')
                                            ->where('approver','=',$user->id)
                                            ->orWhere('approval_status','=','0')
                                            ->where('recommender','=',$user->id)
                                            ->get();
        
        return view('denr.toa.approval.pending_travel_order')->with('order', $order_record);
	}


	public function ShowApprovedTravelOrderListFunction1()
	{
		$user = Auth::user();
		$order_record = TravelOrderModel::where('approval_status','=','2')->get();
        return view('denr.toa.approval.approved_travel_order')->with('order', $order_record);
	}

	public function ShowApprovedTravelOrderListFunction2()
	{
		$user = Auth::user();
		$order_record = TravelOrderModel::where('approval_status','=','2')
                                        ->where('approver','=',$user->id)
                                        ->get();
        
        return view('denr.toa.approval.approved_travel_order')->with('order', $order_record);
	}

	public function ShowDisapprovedTravelOrderListFunction1()
	{
		$user = Auth::user();
		$order_record = TravelOrderModel::where('approval_status','=','3')->get();
        return view('denr.toa.approval.disapproved_travel_order')->with('order', $order_record);
	}

	public function ShowDisapprovedTravelOrderListFunction2()
	{
		$user = Auth::user();
		$order_record = TravelOrderModel::where('approval_status','=','3')
	                                    ->where('approver','=',$user->id)
	                                    ->get();
	    
	    return view('denr.toa.approval.disapproved_travel_order')->with('order', $order_record);
	}

	public function ShowCancelledTravelOrderListFunction()
	{

		$user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $order_record = TravelOrderModel::where('approval_status','=','4')->get();
            return view('denr.toa.approval.cancelled_travel_order')->with('order', $order_record);

        } else if($user->user_type == '3') {

            $order_record = TravelOrderModel::where('approval_status','=','4')
                                            ->where('approver','=',$user->id)
                                            ->get();
            
            return view('denr.toa.approval.cancelled_travel_order')->with('order', $order_record);

        } else {

            return back();
        }  

	}

	public function ViewPendingTravelOrderFunction(Request $request, $id)
	{

		$user = Auth::user();

        $decode = Crypt::decrypt($id);
        $encode = Crypt::encrypt($id);

        $signatory = TravelOrderModel::where('id','=', $decode)->get()->first();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2' || $signatory->recommender == $user->id || $signatory->approver == $user->id) {

            $orders = TravelOrderModel::where('id', '=', $decode)->get()->first();
            $employee = UserModel::where('id', '=', $orders->user_id)->get()->first();
            $position = PositionModel::where('id', '=', $orders->position_id)->get()->first();
            $division = DivisionModel::where('id', '=', $orders->division)->get()->first();
            $section = SectionModel::where('id', '=', $orders->section)->get()->first();
            $unit = UnitModel::where('id', '=', $orders->unit)->get()->first();
            
            return view('denr.toa.approval.view_pending_travel_order')
                 ->with('order', $orders)
                 ->with('employee', $employee)
                 ->with('position', $position)
                 ->with('division', $division)
                 ->with('section', $section)
                 ->with('unit', $unit);

        } else {

            return back();
        }

	}

	public function ApprovePendingTravelOrderFunction(Request $request){

		$user = Auth::user();

        $decode = $request->input('order_id');

        $signatory = TravelOrderModel::where('id','=', $decode)->get()->first();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2' || $signatory->approver == $user->id) {

            $order_id = $request->input('order_id');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($order_id);

            $travel_order = [

                'approval_status' => '2',
                'approved_by' => $user->id,
                'approved_at' => $date2day,
                            
            ];

            TravelOrderModel::where('id', '=', $order_id)->update($travel_order);

            $window_page = 'Travel Order Approval';
            $module_code = 'PIS';
            $window_type = 'ACT';
            $action_type = 'APPROVE';
            $remarks = 'Approved Travel Order '.$order_id;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');


            Session::flash('success', 'Travel Order Successfully Approved.');

            return back();

        } else {

            return back();
        }

	}

	public function RecommendPendingTravelOrderFunctino(Request $request)
	{
		$user = Auth::user();

        $decode = $request->input('order_id');

        $signatory = TravelOrderModel::where('id','=', $decode)->get()->first();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2' || $signatory->recommender == $user->id) {

            $order_id = $request->input('order_id');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($order_id);

            $travel_order = [

                'approval_status' => '1',
                'recommended_by' => $user->id,
                'recommended_at' => $date2day,
                            
            ];

            TravelOrderModel::where('id', '=', $order_id)->update($travel_order);

            $window_page = 'Travel Order Approval';
            $module_code = 'PIS';
            $window_type = 'ACT';
            $action_type = 'RECOMMEND';
            $remarks = 'Recommended Travel Order '.$order_id;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Travel Order Successfully Recommended.');

            return back();

        } else {

            return back();
        }
	}

}