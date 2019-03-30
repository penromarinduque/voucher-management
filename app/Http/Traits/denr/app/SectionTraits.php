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
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait SectionTraits
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowSectionListFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $sec_record = SectionModel::all();
            return view('denr.app.employee_section', array('record' => $sec_record));

        } else {

            return back();
        }  
    }

    public function ShowSectionFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $div_record = DivisionModel::all();
            return view('denr.app.add_employee_section', array('division' => $div_record));

        } else {

            return back();
        } 
    }

    public function AddSectionFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'division'=>'required',
                'section'=>'required',
            ]);

            $section = [

                'division_id' => $request->input('division'),
                'section' => $request->input('section'),
                'created_by' => $user->id
                            
            ];

            $insert_section = SectionModel::insert($section); 

            //AUDIT TRAIL LOG
            $new_section = $request->input('section');

            $window_page = 'Section';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'ADD';
            $remarks = 'Added Section '.$new_section;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Employee Section successfully saved.');

            return back();

        } else {

            return back();
        } 

    }

    public function ViewSectionFunction(Request $request, $id)
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $decode = Crypt::decrypt($id);
            $encode = Crypt::encrypt($id);
            $sec_record = SectionModel::where('id', '=', $decode)->get()->first();
            $div_record = DivisionModel::all();
            return view('denr.app.edit_employee_section')->with('record', $sec_record)->with('division', $div_record);

        } else {

            return back();
        }  
    }

    public function editSectionFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'division'=>'required',
                'section'=>'required',
            ]);

            $get_id = $request->input('get_id');
            $encode = Crypt::encrypt($get_id);

            $section = [

                'division_id' => $request->input('division'),
                'section' => $request->input('section'),
                'updated_by' => $user->id
                            
            ];

            SectionModel::where('id', '=', $get_id)->update($section);

            //AUDIT TRAIL LOG
            $new_section = $request->input('section');

            $window_page = 'Section';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'EDIT';
            $remarks = 'Modified Section '.$new_section;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php'); 

            Session::flash('success', 'Employee Section successfully updated.');

            return back();

        } else {

            return back();
        }

    }

    public function DeleteSectionFunction(Request $request)
    {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $del_id = $request->input('del_id');
            $del_id2 = $request->input('del_id2');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($del_id);

            SectionModel::where('id', '=', $del_id)->delete();
                        
            $window_page = 'Section';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'DEL';
            $remarks = 'Deleted Section '.$del_id2;
                                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
            
            Session::flash('success', ' Section ('.$del_id2.') successfully deleted.');

            return back();

        }
    }

}