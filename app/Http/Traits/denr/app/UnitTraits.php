<?php

namespace App\Http\Traits\denr\app;

use Crypt;
use Auth;
use Session;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait UnitTraits
{
	public function ShowUnitListFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $unit_record = UnitModel::all();
            return view('denr.app.employee_unit')->with('record', $unit_record);

        } else {

            return back();
        }  
    }

    public function ShowUnitFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $div_record = DivisionModel::all();
            $sec_record = SectionModel::all();
            return view('denr.app.add_employee_unit')->with('section', $sec_record)->with('division', $div_record);

        } else {

            return back();
        } 
    }

    public function showAjaxFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $division = Input::get('division');
            $sec_record = SectionModel::where('division_id', '=', $division)->get();
            return Response::json($sec_record);

        } else {

            return back();
        }     

    }

    public function AddUnitFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'unit'=>'required',
                'division'=>'required',
                'section'=>'required',
            ]);

            $unit = [

                'unit' => $request->input('unit'),
                'division_id' => $request->input('division'),
                'section_id' => $request->input('section'),
                'created_by' => $user->id
                            
            ];

            $insert_unit = UnitModel::insert($unit); 

            //AUDIT TRAIL LOG
            $new_unit = $request->input('unit');

            $window_page = 'Unit';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'ADD';
            $remarks = 'Added Unit '.$new_unit;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Employee Unit successfully saved.');

            return back();

        } else {

            return back();
        } 

    }

    public function ViewUnitFunction(Request $request, $id)
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $decode = Crypt::decrypt($id);
            $encode = Crypt::encrypt($id);
            $unit_record = UnitModel::where('id', '=', $decode)->get()->first();
            $div_record = DivisionModel::all();
            $sec_record = SectionModel::all();
            return view('denr.app.edit_employee_unit')->with('record', $unit_record)->with('division', $div_record)->with('section', $sec_record);

        } else {

            return back();
        }  
    }

    public function editUnitFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'unit'=>'required',
                'division'=>'required',
                'section'=>'required',
            ]);

            $get_id = $request->input('get_id');
            $encode = Crypt::encrypt($get_id);

            $unit = [

                'unit' => $request->input('unit'),
                'division_id' => $request->input('division'),
                'section_id' => $request->input('section'),
                'updated_by' => $user->id
                            
            ];

            $update_unit = UnitModel::where('id', '=', $get_id)->update($unit);

            //AUDIT TRAIL LOG
            $new_unit = $request->input('unit');

            $window_page = 'Unit';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'EDIT';
            $remarks = 'Modified Unit '.$new_unit;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Employee Unit successfully updated.');

            return back();

        } else {

            return back();
        }

    }

    public function DeleteUnitFunction(Request $request)
    {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $del_id = $request->input('del_id');
            $del_id2 = $request->input('del_id2');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($del_id);

            UnitModel::where('id', '=', $del_id)->delete();
                        
            $window_page = 'Unit';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'DEL';
            $remarks = 'Deleted Unit '.$del_id2;
                                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
            
            Session::flash('success', ' Unit ('.$del_id2.') successfully deleted.');

            return back();

        }
    }
}