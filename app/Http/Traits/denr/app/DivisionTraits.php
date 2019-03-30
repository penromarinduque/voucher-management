<?php

namespace App\Http\Traits\denr\app;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait DivisionTraits
{
	public function ShowDivisionListFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $div_record = DivisionModel::all();
            return view('denr.app.employee_division', array('record' => $div_record));

        } else {

            return back();
        }  
    }

    public function ShowDivisionFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            return view('denr.app.add_employee_division');

        } else {

            return back();
        } 
    }

    public function AddDivisionFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'division'=>'required',
            ]);

            $division = [

                'division' => $request->input('division'),
                'created_by' => $user->id
                            
            ];

            $insert_division = DivisionModel::insert($division); 

            //AUDIT TRAIL LOG
            $new_division = $request->input('division');

            $window_page = 'Division';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'ADD';
            $remarks = 'Added Division '.$new_division;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Employee Division successfully saved.');

            return back();

        } else {

            return back();
        } 

    }

    public function ViewDivisionFunction(Request $request, $id)
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $decode = Crypt::decrypt($id);
            $encode = Crypt::encrypt($id);
            $div_record = DivisionModel::where('id', '=', $decode)->get()->first();
            return view('denr.app.edit_employee_division', array('record' => $div_record));

        } else {

            return back();
        }  
    }

    public function editDivisionFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'division'=>'required',
            ]);

            $get_id = $request->input('get_id');
            $encode = Crypt::encrypt($get_id);

            $division = [

                'division' => $request->input('division'),
                'updated_by' => $user->id
                            
            ];

            DivisionModel::where('id', '=', $get_id)->update($division);

            //AUDIT TRAIL LOG
            $new_division = $request->input('division');

            $window_page = 'Division';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'EDIT';
            $remarks = 'Modified Division '.$new_division;

            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php'); 

            Session::flash('success', 'Employee Division successfully updated.');

            return back();

            //return redirect()->back()->withInput(Input::except('_token'))->withErrors($errors);

        } else {

            return back();
        }

    }

    public function DeleteDivisionFunction(Request $request)
    {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $del_id = $request->input('del_id');
            $del_id2 = $request->input('del_id2');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($del_id);

            DivisionModel::where('id', '=', $del_id)->delete();
                        
            $window_page = 'Division';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'DEL';
            $remarks = 'Deleted Division '.$del_id2;
                                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
            
            Session::flash('success', ' Division ('.$del_id2.') successfully deleted.');

            return back();

        }
    }
}