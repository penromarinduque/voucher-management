<?php

namespace App\Http\Traits\denr\toa\activity;


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
use App\Models\denr\Form_No as FormNoModel;
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;
use App\Models\denr\Itinerary as ItineraryModel;


trait TravelOrderTraits
{
	public function ShowTravelOrderListFunction()
	{
		$user = Auth::user();

		$order_record = TravelOrderModel::where('user_id','=',$user->id)->orderBy('order_no','DESC')->get();
		return view('denr.toa.activity.travel_order', array('order' => $order_record));
	}
	
	public function ShowTravelOrderFormFunction()
	{
		$user = Auth::user();

		$newno = FormNoModel::where('id','=','1')->first();
        $position = PositionModel::where('id','=',$user->user_position)->get()->first();
        $division = DivisionModel::where('id','=',$user->user_division)->get()->first();
        $section = SectionModel::where('id','=',$user->user_section)->get()->first();
        $unit = UnitModel::where('id','=',$user->user_unit)->get()->first();

        $recommender = FormSignatoryModel::select('signatory')->where('signatory_type','=','R')->where('signatory_division','=',$user->user_division)->get();
        $recommender_count = FormSignatoryModel::where('signatory_type','=','R')->where('signatory_division','=',$user->user_division)->where('signatory','=',$user->id)->count();
        
        $approver = FormSignatoryModel::select('signatory')->where('signatory_type','=','A')->get();
        $approver_count = FormSignatoryModel::where('signatory_type','=','A')->where('signatory_division','=',$user->user_division)->where('signatory','=',$user->id)->count();

        $user_recommender = UserModel::whereIn('id', $recommender)->get();
        $user_approver = UserModel::whereIn('id', $approver)->get();
        
        $def_recommender = PositionModel::select('id')->where('position_type','=','2')->get();
        $def_approver = PositionModel::select('id')->where('position_type','=','1')->get();
        $default_recommender = UserModel::whereIn('user_position', $def_recommender)->where('user_division','=',$division->id)->get();
        $default_approver = UserModel::whereIn('user_position', $def_approver)->get();

        return view('denr.toa.activity.add_travel_order')
             ->with('formno', $newno)
             ->with('position', $position)
             ->with('division', $division)
             ->with('section', $section)
             ->with('unit', $unit)
             ->with('recommender', $user_recommender)
             ->with('approver', $user_approver)
             ->with('count_recommender', count($user_recommender))
             ->with('count_approver', count($user_approver))
             ->with('default_approver', $default_approver)
             ->with('default_recommender', $default_recommender)
             ->with('recommender_count', $recommender_count)
             ->with('approver_count', $approver_count);

	}


	public function AddTravelOrderFunction(Request $request)
	{
		$recommender = $request->input('recommended_by');
        $order_no = $request->input('order_no');
        $user = Auth::user();

        $this->validate(request(), [
                'order_no'=>'required',
                'user_id'=>'required',
                'user_position'=>'required',
                'sign'=>'required',
                'user_division'=>'required',
                //'user_section'=>'required',
                //'user_unit'=>'required',
                //'date_filling'=>'required',
                'departure'=>'required',
                'arrival'=>'required',
                'station'=>'required',
                'destination'=>'required',
                'purpose'=>'required',
                //'recommended_by'=>'required',
                'approved_by'=>'required',
            ]);

            if($recommender == $user->id) {

                $approval_status = 1;

            } else if($recommender != $user->id){

                $approval_status = 0;

            }

            $no_exist = TravelOrderModel::where('order_no', '=', $order_no)->count();

            if($no_exist == 0) {

                $travel_order = [

                    'order_no' => $request->input('order_no'),
                    'user_id' => $request->input('user_id'),
                    'position_id' => $request->input('user_position'),
                    'signature' => $request->input('sign'),
                    'approval_status' => $approval_status,
                    'date_filling' => $request->input('date_filling'),
                    'station' => $request->input('station'),
                    'salary' => $request->input('salary'),
                    'division' => $request->input('user_division'),
                    'section' => $request->input('user_section'),
                    'unit' => $request->input('user_unit'),
                    'departure_date' => $request->input('departure'),
                    'arrival_date' => $request->input('arrival'),
                    'destination' => $request->input('destination'),
                    'purpose_of_travel' => $request->input('purpose'),
                    'per_diems_allowed' => $request->input('perdiems'),
                    'assistantor_allowed' => $request->input('assistantor'),
                    'appropriation' => $request->input('appropriation'),
                    'remarks' => $request->input('remarks'),
                    'recommender' => $request->input('recommended_by'),
                    'recommended_by' => $request->input('recommended_by'),
                    'recommended_at' => $request->input('recommended_at'),
                    'approver' => $request->input('approved_by'),
                    'created_by' => $user->id
                                
                ];

                $insert_travel = TravelOrderModel::insert($travel_order);

                $it_date = $request->input('it_date');

                if($request->has('it_date')) {

                    foreach($it_date as $index => $value) {

                        $itinerary = [

                            'order_no' => $request->input('order_no'),
                            'user_id' => $request->input('user_id'),
                            'it_date' => $request->input('it_date')[$index],
                            'it_place' => $request->input('it_place')[$index],
                            'it_departure' => $request->input('it_departure')[$index],
                            'it_arrival' => $request->input('it_arrival')[$index],
                            'it_means_of_trn' => $request->input('it_means')[$index],
                            'it_fare' => $request->input('it_fare')[$index],
                            'it_per_diems' => $request->input('it_per_diems')[$index],
                            'it_allowance' => $request->input('it_allowance')[$index]

                        ];

                        ItineraryModel::insert($itinerary);                          
                    }
                }


                $formid = $request->input('formid');
                $form_no = [

                    'form_no' => $request->input('neworder_no'),
                    'updated_by' => $user->id
                                
                ];

                FormNoModel::where('id', '=', $formid)->update($form_no); 

                //AUDIT TRAIL LOG
                $new_order = $request->input('order_no');

                $window_page = 'Travel Order';
                $module_code = 'PIS';
                $window_type = 'ACT';
                $action_type = 'ADD';
                $remarks = 'Added Travel Order '.$new_order;
                                        
                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                Session::flash('success', 'Travel Order successfully saved.');

                return back();

            } else {

                Session::flash('failed', 'Travel Order No. already exist. Please Change.');

                return back();
            }


	}

	public function ViewTravelOrderFunction(Request $request, $id)
	{
		$user = Auth::user();

		$decode = Crypt::decrypt($id);
        $encode = Crypt::encrypt($id);
        $orders = TravelOrderModel::where('id', '=', $decode)->first();
        $itinerary = ItineraryModel::where('order_no', '=', $orders->order_no)->get();
        $position = PositionModel::where('id', '=', $orders->position_id)->first();
        $division = DivisionModel::where('id', '=', $orders->division)->first();
        $section = SectionModel::where('id', '=', $orders->section)->first();
        $unit = UnitModel::where('id', '=', $orders->unit)->first();

        $recommender = FormSignatoryModel::select('signatory')->where('signatory_type','=','R')->where('signatory_division','=',$division->id)->get();
        $recommender_count = FormSignatoryModel::where('signatory_type','=','R')->where('signatory_division','=',$division->id)->where('signatory','=',$user->id)->count();
        
        $approver = FormSignatoryModel::select('signatory')->where('signatory_type','=','A')->get();
        $approver_count = FormSignatoryModel::where('signatory_type','=','A')->where('signatory_division','=',$division->id)->where('signatory','=',$user->id)->count();
        
        $user_recommender = UserModel::whereIn('id', $recommender)->get();
        $user_approver = UserModel::whereIn('id', $approver)->get();
        
        $def_recommender = PositionModel::select('id')->where('position_type','=','2')->get();
        $def_approver = PositionModel::select('id')->where('position_type','=','1')->get();
        $default_recommender = UserModel::whereIn('user_position', $def_recommender)->where('user_division','=',$division->id)->get();
        $default_approver = UserModel::whereIn('user_position', $def_approver)->get();
        
        return view('denr.toa.activity.edit_travel_order')
             ->with('order', $orders)
             ->with('itinerary', $itinerary)
             ->with('position', $position)
             ->with('division', $division)
             ->with('section', $section)
             ->with('unit', $unit)
             ->with('recommender', $user_recommender)
             ->with('approver', $user_approver)
             ->with('count_recommender', count($user_recommender))
             ->with('count_approver', count($user_approver))
             ->with('default_approver', $default_approver)
             ->with('default_recommender', $default_recommender)
             ->with('recommender_count', $recommender_count)
             ->with('approver_count', $approver_count);

	}

	public function EditTravelOrderFunction(Request $request)
	{
		$user = Auth::user();
        $recommender = $request->input('recommended_by');
        $order_no = $request->input('order_no');
        $get_id = $request->input('get_id');
        $order_no = $request->input('order_no');
        $encode = Crypt::encrypt($get_id);

        $this->validate(request(), [
                'order_no'=>'required',
                'user_id'=>'required',
                'sign'=>'required',
                'user_position'=>'required',
                'user_division'=>'required',
                //'user_section'=>'required',
                //'user_unit'=>'required',
                //'date_filling'=>'required',
                'departure'=>'required',
                'arrival'=>'required',
                'station'=>'required',
                'destination'=>'required',
                'purpose'=>'required',
                //'recommended_by'=>'required',
                'approved_by'=>'required',
            ]);

            if($recommender == $user->id) {

                $approval_status = 1;

            } else if($recommender != $user->id){

                $approval_status = 0;

            }

            $no_exist = TravelOrderModel::where('id', '!=', $get_id)->where('order_no', '=', $order_no)->count();

            if($no_exist == 0) {

                $travel_order = [

                    'order_no' => $request->input('order_no'),
                    'user_id' => $request->input('user_id'),
                    'position_id' => $request->input('user_position'),
                    'signature' => $request->input('sign'),
                    'approval_status' => $approval_status,
                    'date_filling' => $request->input('date_filling'),
                    'station' => $request->input('station'),
                    'salary' => $request->input('salary'),
                    'division' => $request->input('user_division'),
                    'section' => $request->input('user_section'),
                    'unit' => $request->input('user_unit'),
                    'departure_date' => $request->input('departure'),
                    'arrival_date' => $request->input('arrival'),
                    'destination' => $request->input('destination'),
                    'purpose_of_travel' => $request->input('purpose'),
                    'per_diems_allowed' => $request->input('perdiems'),
                    'assistantor_allowed' => $request->input('assistantor'),
                    'appropriation' => $request->input('appropriation'),
                    'remarks' => $request->input('remarks'),
                    'recommender' => $request->input('recommended_by'),
                    'recommended_by' => $request->input('recommended_by'),
                    'recommended_at' => $request->input('recommended_at'),
                    'approver' => $request->input('approved_by'),
                    'updated_by' => $user->id
                                
                ];

                TravelOrderModel::where('id', '=', $get_id)->update($travel_order);

                $it_date = $request->input('it_date');

                if($request->has('it_date')) {

                    $delete_it = ItineraryModel::where('order_no', '=', $order_no)->delete();
                                
                    foreach($it_date as $index => $value) {

                        $itinerary = [

                            'order_no' => $request->input('order_no'),
                            'user_id' => $request->input('user_id'),
                            'it_date' => $request->input('it_date')[$index],
                            'it_place' => $request->input('it_place')[$index],
                            'it_departure' => $request->input('it_departure')[$index],
                            'it_arrival' => $request->input('it_arrival')[$index],
                            'it_means_of_trn' => $request->input('it_means')[$index],
                            'it_fare' => $request->input('it_fare')[$index],
                            'it_per_diems' => $request->input('it_per_diems')[$index],
                            'it_allowance' => $request->input('it_allowance')[$index]

                        ];

                        ItineraryModel::insert($itinerary);                          
                    }
                }

                //AUDIT TRAIL LOG
                $new_order = $request->input('order_no');

                $window_page = 'Travel Order';
                $module_code = 'PIS';
                $window_type = 'ACT';
                $action_type = 'EDIT';
                $remarks = 'Modified Travel Order '.$new_order;

                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php'); 

                Session::flash('success', 'Travel Order successfully updated.');

                //return redirect('denr/toa/activity/viewtravelorder/' .$encode);

                return back();

                //return redirect()->back()->withInput(Input::except('_token'))->withErrors($errors);

            } else {

                Session::flash('failed', 'Travel Order No. already exist. Please Change.');

                return back();
            }
	}

	public function PrintTravelOrderFunction(Request $request, $id)
	{

		$user = Auth::user();

		$decode = Crypt::decrypt($id);
        $encode = Crypt::encrypt($id);
        $orders = TravelOrderModel::where('id', '=', $decode)->first();
        $employee = UserModel::where('id', '=', $orders->user_id)->first();
        $position = PositionModel::where('id', '=', $orders->position_id)->first();
        $division = DivisionModel::where('id', '=', $orders->division)->first();
        $section = SectionModel::where('id', '=', $orders->section)->first();
        $unit = UnitModel::where('id', '=', $orders->unit)->first();
        return view('denr.toa.activity.print_travel_order')
             ->with('order', $orders)
             ->with('employee', $employee)
             ->with('position', $position)
             ->with('division', $division)
             ->with('section', $section)
             ->with('unit', $unit);

	}

	public function PrintItineraryFunction(Request $request, $id)
	{

		$user = Auth::user();

		$decode = Crypt::decrypt($id);
        $encode = Crypt::encrypt($id);
        $orders = TravelOrderModel::where('id', '=', $decode)->first();
        $itinerary = ItineraryModel::where('order_no', '=', $orders->order_no)->get();
        $employee = UserModel::where('id', '=', $orders->user_id)->first();
        $position = PositionModel::where('id', '=', $orders->position_id)->first();
        $division = DivisionModel::where('id', '=', $orders->division)->first();
        $section = SectionModel::where('id', '=', $orders->section)->first();
        $unit = UnitModel::where('id', '=', $orders->unit)->first();
        return view('denr.toa.activity.print_itinerary')
             ->with('order', $orders)
             ->with('itinerary', $itinerary)
             ->with('employee', $employee)
             ->with('position', $position)
             ->with('division', $division)
             ->with('section', $section)
             ->with('unit', $unit);

	}

	public function DeleteTravelOrderFunction(Request $request)
	{
		$user = Auth::user();

		$del_id = $request->input('del_id');
	    $del_id2 = $request->input('del_id2');
	    $date2day = date('Y-m-d');
	    $encode = Crypt::encrypt($del_id);

	    TravelOrderModel::where('id', '=', $del_id)->delete();
	    ItineraryModel::where('order_no', '=', $del_id2)->delete();
	                
	    $window_page = 'Travel Order';
	    $module_code = 'PIS';
	    $window_type = 'ACT';
	    $action_type = 'DEL';
	    $remarks = 'Deleted Travel Order '.$del_id2;
	                                        
	    include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
	    
	    Session::flash('success', ' Travel Order ('.$del_id2.') successfully deleted.');

	    return back();

	}

	public function CancelTravelOrderFunction(Request $request)
	{

		$user = Auth::user();

        $del_id = $request->input('del_id');
        $del_id2 = $request->input('del_id2');
        $date2day = date('Y-m-d');
        $encode = Crypt::encrypt($del_id);

        $travel_order = [

            'approval_status' => '4',
                        
        ];

        TravelOrderModel::where('id', '=', $del_id)->update($travel_order);
                    
        $window_page = 'Travel Order';
        $module_code = 'PIS';
        $window_type = 'ACT';
        $action_type = 'CAN';
        $remarks = 'Cancelled Travel Order '.$del_id2;
                                            
        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
        
        Session::flash('success', ' Travel Order ('.$del_id2.') successfully cancelled.');

        return back();

	}

}