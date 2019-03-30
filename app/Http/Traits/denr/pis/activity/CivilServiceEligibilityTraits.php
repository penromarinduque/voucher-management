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
use App\Models\denr\Civil_Service_Eligibility as CivilServiceEligibilityModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait CivilServiceEligibilityTraits
{

	public function ShowCivilServiceEligibilityFormFunction()
    {
    	$user = Auth::user();
        $civil_record = CivilServiceEligibilityModel::where('user_id', '=', $user->id)->get();
        $civil_count = CivilServiceEligibilityModel::where('user_id', '=', $user->id)->count();
        return view('denr.pis.activity.civil_service_eligibility')->with('civil', $civil_record)->with('civil_count', $civil_count);
    }

    public function AddCivilServiceEligibilityFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = CivilServiceEligibilityModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                //MULTIPLE INSERT----------------------------------------------------------------

                $career_service = $request->input('career_service');

                if($request->has('career_service')) {

                    foreach($career_service as $index => $value) {

                        $insert_career_service = [

                        'user_id' => $user->id,
                        'career_service' => $request->input('career_service')[$index],
                        'rating' => $request->input('rating')[$index],
                        'examination_date' => $request->input('exam_date')[$index],
                        'examination_place' => $request->input('exam_place')[$index],
                        'license_number' => $request->input('license_number')[$index],
                        'license_date_validity' => $request->input('license_date')[$index],
                        'created_by' => $user->id,

                        ];

                        CivilServiceEligibilityModel::insert($insert_career_service);

                        //AUDIT TRAIL LOG
                        $window_page = 'Civil Service Eligibility';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Civil Service Eligibility '.$career_service[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $civil_id = $request->input('civil_id');
                $career_service = $request->input('career_service2');

                if($request->has('civil_id')) {

                    foreach($civil_id as $index2 => $value) {

                        $update_career_service = [

                        'career_service' => $request->input('career_service2')[$index2],
                        'rating' => $request->input('rating2')[$index2],
                        'examination_date' => $request->input('exam_date2')[$index2],
                        'examination_place' => $request->input('exam_place2')[$index2],
                        'license_number' => $request->input('license_number2')[$index2],
                        'license_date_validity' => $request->input('license_date2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        CivilServiceEligibilityModel::where('id','=', $civil_id[$index2])->update($update_career_service);

                        //AUDIT TRAIL LOG
                        $window_page = 'Civil Service Eligibility';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Civil Service Eligibility '.$career_service[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Civil Service Eligibility successfully saved.');

                return back();


            } else if($record_count > 0) {
            
                //MULTIPLE INSERT----------------------------------------------------------------

                $career_service = $request->input('career_service');

                if($request->has('career_service')) {

                    foreach($career_service as $index => $value) {

                        $insert_career_service = [

                        'user_id' => $user->id,
                        'career_service' => $request->input('career_service')[$index],
                        'rating' => $request->input('rating')[$index],
                        'examination_date' => $request->input('exam_date')[$index],
                        'examination_place' => $request->input('exam_place')[$index],
                        'license_number' => $request->input('license_number')[$index],
                        'license_date_validity' => $request->input('license_date')[$index],
                        'created_by' => $user->id,

                        ];

                        CivilServiceEligibilityModel::insert($insert_career_service);

                        //AUDIT TRAIL LOG
                        $window_page = 'Civil Service Eligibility';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Civil Service Eligibility '.$career_service[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $civil_id = $request->input('civil_id');
                $career_service = $request->input('career_service2');

                if($request->has('civil_id')) {

                    foreach($civil_id as $index2 => $value) {

                        $update_career_service = [

                        'career_service' => $request->input('career_service2')[$index2],
                        'rating' => $request->input('rating2')[$index2],
                        'examination_date' => $request->input('exam_date2')[$index2],
                        'examination_place' => $request->input('exam_place2')[$index2],
                        'license_number' => $request->input('license_number2')[$index2],
                        'license_date_validity' => $request->input('license_date2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        CivilServiceEligibilityModel::where('id','=', $civil_id[$index2])->update($update_career_service);

                        //AUDIT TRAIL LOG
                        $window_page = 'Civil Service Eligibility';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Civil Service Eligibility '.$career_service[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Civil Service Eligibility successfully saved.');

                return back();        

            }
    }


}