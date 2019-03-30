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
use App\Models\denr\Work_Experience as WorkExperienceModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait WorkExperienceTraits
{
	public function ShowWorkExperienceFormFunction()
    {
    	$user = Auth::user();
        $work_record = WorkExperienceModel::where('user_id', '=', $user->id)->get();
        $work_count = WorkExperienceModel::where('user_id', '=', $user->id)->count();
        return view('denr.pis.activity.work_experience')->with('work', $work_record)->with('work_count', $work_count);
    }

    public function AddWorkExperienceFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = WorkExperienceModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                //MULTIPLE INSERT----------------------------------------------------------------

                $work = $request->input('position');

                if($request->has('position')) {

                    foreach($work as $index => $value) {

                        $insert_work = [

                        'user_id' => $user->id,
                        'inclusive_date_from' => $request->input('date_form')[$index],
                        'inclusive_date_to' => $request->input('date_to')[$index],
                        'position_title' => $request->input('position')[$index],
                        'department_agency_office_company' => $request->input('department')[$index],
                        'monthly_salary' => $request->input('monthly_salary')[$index],
                        'salary_job_pay_grade' => $request->input('salary_job')[$index],
                        'appointment_status' => $request->input('status_app')[$index],
                        'government_service' => $request->input('gov_service')[$index],
                        'created_by' => $user->id,

                        ];

                        WorkExperienceModel::insert($insert_work);

                        //AUDIT TRAIL LOG
                        $window_page = 'Work Experience';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Work Experience '.$work[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $work_id = $request->input('work_id');
                $work = $request->input('position2');

                if($request->has('work_id')) {

                    foreach($work_id as $index2 => $value) {

                        $update_work = [

                        'inclusive_date_from' => $request->input('date_form2')[$index2],
                        'inclusive_date_to' => $request->input('date_to2')[$index2],
                        'position_title' => $request->input('position2')[$index2],
                        'department_agency_office_company' => $request->input('department2')[$index2],
                        'monthly_salary' => $request->input('monthly_salary2')[$index2],
                        'salary_job_pay_grade' => $request->input('salary_job2')[$index2],
                        'appointment_status' => $request->input('status_app2')[$index2],
                        'government_service' => $request->input('gov_service2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        WorkExperienceModel::where('id','=', $work_id[$index2])->update($update_work);

                        //AUDIT TRAIL LOG
                        $window_page = 'Work Experience';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Work Experience '.$work[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Work Experience successfully saved.');

                return back();


            } else if($record_count > 0) {
            
                //MULTIPLE INSERT----------------------------------------------------------------

                $work = $request->input('position');

                if($request->has('position')) {

                    foreach($work as $index => $value) {

                        $insert_work = [

                        'user_id' => $user->id,
                        'inclusive_date_from' => $request->input('date_form')[$index],
                        'inclusive_date_to' => $request->input('date_to')[$index],
                        'position_title' => $request->input('position')[$index],
                        'department_agency_office_company' => $request->input('department')[$index],
                        'monthly_salary' => $request->input('monthly_salary')[$index],
                        'salary_job_pay_grade' => $request->input('salary_job')[$index],
                        'appointment_status' => $request->input('status_app')[$index],
                        'government_service' => $request->input('gov_service')[$index],
                        'created_by' => $user->id,

                        ];

                        WorkExperienceModel::insert($insert_work);

                        //AUDIT TRAIL LOG
                        $window_page = 'Work Experience';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Work Experience '.$work[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $work_id = $request->input('work_id');
                $work = $request->input('position2');

                if($request->has('work_id')) {

                    foreach($work_id as $index2 => $value) {

                        $update_work = [

                        'inclusive_date_from' => $request->input('date_form2')[$index2],
                        'inclusive_date_to' => $request->input('date_to2')[$index2],
                        'position_title' => $request->input('position2')[$index2],
                        'department_agency_office_company' => $request->input('department2')[$index2],
                        'monthly_salary' => $request->input('monthly_salary2')[$index2],
                        'salary_job_pay_grade' => $request->input('salary_job2')[$index2],
                        'appointment_status' => $request->input('status_app2')[$index2],
                        'government_service' => $request->input('gov_service2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        WorkExperienceModel::where('id','=', $work_id[$index2])->update($update_work);

                        //AUDIT TRAIL LOG
                        $window_page = 'Work Experience';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Work Experience '.$work[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Work Experience successfully saved.');

                return back();     

            }
    }

}