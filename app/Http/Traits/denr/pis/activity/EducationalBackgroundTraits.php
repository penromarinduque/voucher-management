<?php

namespace App\Http\Traits\denr\pis\activity;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Educational_Background as EducationalBackgroundModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait EducationalBackgroundTraits
{

	public function ShowEducationalBackgroundFormFunction()
    {
    	$user = Auth::user();
        $educ_record = EducationalBackgroundModel::where('user_id', '=', $user->id)->get();
        $educ_count = EducationalBackgroundModel::where('user_id', '=', $user->id)->count();
        return view('denr.pis.activity.educational_background')->with('educ', $educ_record)->with('educ_count', $educ_count);
    }

    public function AddEducationalBackgroundFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = EducationalBackgroundModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                //MULTIPLE INSERT----------------------------------------------------------------

                $level = $request->input('level');

                if($request->has('level')) {

                    foreach($level as $index => $value) {

                        $insert_educ = [

                        'user_id' => $user->id,
                        'level' => $request->input('level')[$index],
                        'school_name' => $request->input('school_name')[$index],
                        'basic_education_degree_course' => $request->input('basic_educ')[$index],
                        'poa_from' => $request->input('period_from')[$index],
                        'poa_to' => $request->input('period_to')[$index],
                        'highest_level_units_earned' => $request->input('highest_level')[$index],
                        'year_graduated' => $request->input('year_graduated')[$index],
                        'scholarship_academic_honors_received' => $request->input('scholarship')[$index],
                        'created_by' => $user->id,

                        ];

                        EducationalBackgroundModel::insert($insert_educ);

                        //AUDIT TRAIL LOG
                        $window_page = 'Educational Background';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Educational Background '.$level[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $level_id = $request->input('level_id');
                $level = $request->input('level2');

                if($request->has('level_id')) {

                    foreach($level_id as $index2 => $value) {

                        $update_educ = [

                        'level' => $request->input('level2')[$index2],
                        'school_name' => $request->input('school_name2')[$index2],
                        'basic_education_degree_course' => $request->input('basic_educ2')[$index2],
                        'poa_from' => $request->input('period_from2')[$index2],
                        'poa_to' => $request->input('period_to2')[$index2],
                        'highest_level_units_earned' => $request->input('highest_level2')[$index2],
                        'year_graduated' => $request->input('year_graduated2')[$index2],
                        'scholarship_academic_honors_received' => $request->input('scholarship2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        EducationalBackgroundModel::where('id','=', $level_id[$index2])->update($update_educ);

                        //AUDIT TRAIL LOG
                        $window_page = 'Educational Background';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Educational Background '.$level[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                } 

                Session::flash('success', 'Educational Background successfully saved.');

                return back();


            } else if($record_count > 0) {
            
                //MULTIPLE INSERT----------------------------------------------------------------

                $level = $request->input('level');

                if($request->has('level')) {

                    foreach($level as $index => $value) {

                        $insert_educ = [

                        'user_id' => $user->id,
                        'level' => $request->input('level')[$index],
                        'school_name' => $request->input('school_name')[$index],
                        'basic_education_degree_course' => $request->input('basic_educ')[$index],
                        'poa_from' => $request->input('period_from')[$index],
                        'poa_to' => $request->input('period_to')[$index],
                        'highest_level_units_earned' => $request->input('highest_level')[$index],
                        'year_graduated' => $request->input('year_graduated')[$index],
                        'scholarship_academic_honors_received' => $request->input('scholarship')[$index],
                        'created_by' => $user->id,

                        ];

                        EducationalBackgroundModel::insert($insert_educ);

                        //AUDIT TRAIL LOG
                        $window_page = 'Educational Background';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Educational Background '.$level[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $level_id = $request->input('level_id');
                $level = $request->input('level2');

                if($request->has('level_id')) {

                    foreach($level_id as $index2 => $value) {

                        $update_educ = [

                        'level' => $request->input('level2')[$index2],
                        'school_name' => $request->input('school_name2')[$index2],
                        'basic_education_degree_course' => $request->input('basic_educ2')[$index2],
                        'poa_from' => $request->input('period_from2')[$index2],
                        'poa_to' => $request->input('period_to2')[$index2],
                        'highest_level_units_earned' => $request->input('highest_level2')[$index2],
                        'year_graduated' => $request->input('year_graduated2')[$index2],
                        'scholarship_academic_honors_received' => $request->input('scholarship2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        EducationalBackgroundModel::where('id','=', $level_id[$index2])->update($update_educ);

                        //AUDIT TRAIL LOG
                        $window_page = 'Educational Background';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Educational Background '.$level[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                } 

                Session::flash('success', 'Educational Background successfully updated.');

                return back();        

            }
    }
}