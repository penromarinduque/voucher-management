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
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait PositionTraits
{
	public function ShowPositionListFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $pos_record = PositionModel::all();
            return view('denr.app.employee_position', array('record' => $pos_record));

        } else {

            return back();
        }  
    }

    public function ShowPositionFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            return view('denr.app.add_employee_position');

        } else {

            return back();
        } 
    }

    public function AddPositionFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'title'=>'required',
                'description'=>'required',
                'position_type'=>'required',
            ]);

            $position = [

                'position_title' => $request->input('title'),
                'position_description' => $request->input('description'),
                'position_type' => $request->input('position_type'),
                'created_by' => $user->id
                            
            ];

            $insert_position = PositionModel::insert($position); 

            //AUDIT TRAIL LOG
            $new_position = $request->input('title');

            $window_page = 'Position';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'ADD';
            $remarks = 'Added Position '.$new_position;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');


            Session::flash('success', 'Employee Position successfully saved.');

            return back();

        } else {

            return back();
        } 

    }

    public function ViewPositionFunction(Request $request, $id)
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $decode = Crypt::decrypt($id);
            $encode = Crypt::encrypt($id);
            $pos_record = PositionModel::where('id', '=', $decode)->get()->first();
            return view('denr.app.edit_employee_position', array('record' => $pos_record));

        } else {

            return back();
        }  
    }

    public function editPositionFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'title'=>'required',
                'description'=>'required',
                'position_type'=>'required',
            ]);

            $get_id = $request->input('get_id');
            $encode = Crypt::encrypt($get_id);

            $position = [

                'position_title' => $request->input('title'),
                'position_description' => $request->input('description'),
                'position_type' => $request->input('position_type'),
                'updated_by' => $user->id
                            
            ];

            PositionModel::where('id', '=', $get_id)->update($position);

            //AUDIT TRAIL LOG
            $new_position = $request->input('title');

            $window_page = 'Position';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'EDIT';
            $remarks = 'Modified Position '.$new_position;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php'); 

            Session::flash('success', 'Employee Position successfully updated.');

            return back();

        } else {

            return back();
        }

    }

    public function DeletePositionFunction(Request $request)
    {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $del_id = $request->input('del_id');
            $del_id2 = $request->input('del_id2');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($del_id);

            PositionModel::where('id', '=', $del_id)->delete();
                        
            $window_page = 'Position';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'DEL';
            $remarks = 'Deleted Position '.$del_id2;
                                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
            
            Session::flash('success', ' Position ('.$del_id2.') successfully deleted.');

            return back();

        }
    }
}