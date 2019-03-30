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
use App\Models\denr\Other_Information as OtherInfoModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait OtherInformationTraits
{
	public function ShowOtherInformationFormFunction()
    {
    	$user = Auth::user();
        $other_record = OtherInfoModel::where('user_id', '=', $user->id)->get();
        $other_count = OtherInfoModel::where('user_id', '=', $user->id)->count();
        return view('denr.pis.activity.other_information')->with('other', $other_record)->with('other_count', $other_count);
    }

    public function AddOtherInformationFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = OtherInfoModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                //MULTIPLE INSERT----------------------------------------------------------------

                $skills_hobbies = $request->input('skills_hobbies');

                if($request->has('skills_hobbies')) {

                    foreach($skills_hobbies as $index => $value) {

                        $insert_skills = [

                        'user_id' => $user->id,
                        'special_skills_hobbies' => $request->input('skills_hobbies')[$index],
                        'non_academic_distinction' => $request->input('distinction')[$index],
                        'membership' => $request->input('membership')[$index],
                        'created_by' => $user->id,

                        ];

                        OtherInfoModel::insert($insert_skills);

                        //AUDIT TRAIL LOG
                        $window_page = 'Other Information';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Other Information '.$skills_hobbies[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $skill_id = $request->input('skill_id');
                $skills_hobbies = $request->input('skills_hobbies2');

                if($request->has('skill_id')) {

                    foreach($skill_id as $index2 => $value) {

                        $update_skills = [

                        'special_skills_hobbies' => $request->input('skills_hobbies2')[$index2],
                        'non_academic_distinction' => $request->input('distinction2')[$index2],
                        'membership' => $request->input('membership2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        OtherInfoModel::where('id','=', $skill_id[$index2])->update($update_skills);

                        //AUDIT TRAIL LOG
                        $window_page = 'Other Information';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Other Information '.$skills_hobbies[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Other Information successfully saved.');

                return back();


            } else if($record_count > 0) {
            
                 //MULTIPLE INSERT----------------------------------------------------------------

                $skills_hobbies = $request->input('skills_hobbies');

                if($request->has('skills_hobbies')) {

                    foreach($skills_hobbies as $index => $value) {

                        $insert_skills = [

                        'user_id' => $user->id,
                        'special_skills_hobbies' => $request->input('skills_hobbies')[$index],
                        'non_academic_distinction' => $request->input('distinction')[$index],
                        'membership' => $request->input('membership')[$index],
                        'created_by' => $user->id,

                        ];

                        OtherInfoModel::insert($insert_skills);

                        //AUDIT TRAIL LOG
                        $window_page = 'Other Information';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Other Information '.$skills_hobbies[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $skill_id = $request->input('skill_id');
                $skills_hobbies = $request->input('skills_hobbies2');

                if($request->has('skill_id')) {

                    foreach($skill_id as $index2 => $value) {

                        $update_skills = [

                        'special_skills_hobbies' => $request->input('skills_hobbies2')[$index2],
                        'non_academic_distinction' => $request->input('distinction2')[$index2],
                        'membership' => $request->input('membership2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        OtherInfoModel::where('id','=', $skill_id[$index2])->update($update_skills);

                        //AUDIT TRAIL LOG
                        $window_page = 'Other Information';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Other Information '.$skills_hobbies[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Other Information successfully saved.');

                return back();

            }
    }

}