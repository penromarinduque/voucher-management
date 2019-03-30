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
use App\Models\denr\Personal_Information as PersonalInfoModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait PersonalInformationTraits
{
	public function ShowPersonalInfoFormFunction()
    {
    	$user = Auth::user();
        $user_record = UserModel::where('id', '=', $user->id)->get()->first();
        $info_record = PersonalInfoModel::where('user_id', '=', $user->id)->get()->first();
        return view('denr.pis.activity.personal_info')->with('user', $user_record)->with('info', $info_record);
    }

    public function AddPersonalInfoFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = PersonalInfoModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                    //ADD PERSONAL INFORMATION

                    $this->validate(request(), [
                    'lname'=>'required',
                    'fname'=>'required',
                    'mname'=>'required',
                    'bdate'=>'required',
                    'bplace'=>'required',
                    'sex'=>'required',
                    'civil_status'=>'required',
                    'height_m'=>'required',
                    'weight_kg'=>'required',
                    'blood_type'=>'required',
                    'gsis_no'=>'required',
                    'pagibig_no'=>'required',
                    'philhealth_no'=>'required',
                    'sss_no'=>'required',
                    'tin_no'=>'required',
                    'agency_emp_no'=>'required',
                    'res_barangay'=>'required',
                    'res_municipality'=>'required',
                    'res_province'=>'required',
                    'res_zip_code'=>'required',
                    'per_barangay'=>'required',
                    'per_municipality'=>'required',
                    'per_province'=>'required',
                    'per_zip_code'=>'required',
                    'mobile_no'=>'required',
                    'email'=>'required'
                    ]);

            
                    $email = $request->input('email');
                    $email_count = UserModel::where('email', '=', $email)
                                            ->where('email', '!=', $user->email)
                                            ->count();

                    if($email_count == 0) {

                        $user_account = [

                            'lname' => $request->input('lname'),
                            'fname' => $request->input('fname'),
                            'mname' => $request->input('mname'),
                            'xname' => $request->input('xname'),
                            'email' => $request->input('email')
                            
                        ];

                        $update_account = UserModel::where('id','=', $user->id)->update($user_account); 

                        if(!$update_account) {

                            //App::abort(500, 'Error');
                        
                        } else { 

                            $personal_info = [

                                'user_id' => $user->id,
                                'birth_date' => $request->input('bdate'),
                                'birth_place' => $request->input('bplace'),
                                'sex' => $request->input('sex'),
                                'civil_status' => $request->input('civil_status'),
                                'height' => $request->input('height_m'),
                                'weight' => $request->input('weight_kg'),
                                'blood_type' => $request->input('blood_type'),
                                'gsis_no' => $request->input('gsis_no'),
                                'pagibig_no' => $request->input('pagibig_no'),
                                'philhealth_no' => $request->input('philhealth_no'),
                                'sss_no' => $request->input('sss_no'),
                                'tin_no' => $request->input('tin_no'),
                                'agency_emp_no' => $request->input('agency_emp_no'),
                                'citizenship_filipino' => $request->input('citizenship_filipino'),
                                'citizenship_dual' => $request->input('citizenship_dual'),
                                'by_birth' => $request->input('by_birth'),
                                'by_naturalization' => $request->input('by_naturalization'),
                                'indicated_country' => $request->input('indicated_country'),
                                'res_house_block_lot' => $request->input('res_house_block_lot'),
                                'res_street' => $request->input('res_street'),
                                'res_subdivision' => $request->input('res_subdivision'),
                                'res_barangay' => $request->input('res_barangay'),
                                'res_municipality' => $request->input('res_municipality'),
                                'res_province' => $request->input('res_province'),
                                'res_zip_code' => $request->input('res_zip_code'),
                                'per_house_block_lot' => $request->input('per_house_block_lot'),
                                'per_street' => $request->input('per_street'),
                                'per_subdivision' => $request->input('per_subdivision'),
                                'per_barangay' => $request->input('per_barangay'),
                                'per_municipality' => $request->input('per_municipality'),
                                'per_province' => $request->input('per_province'),
                                'per_zip_code' => $request->input('per_zip_code'),
                                'tel_no' => $request->input('tel_no'),
                                'mobile_no' => $request->input('mobile_no'),
                                'created_by' => $user->id,
                                
                            ];

                            $insert_info = PersonalInfoModel::insert($personal_info);

                            if(!$insert_info) {

                                //App::abort(500, 'Error');
                            
                            } else {

                                //AUDIT TRAIL TRANSACTION
                                $window_page = 'Personal Information';
                                $module_code = 'PIS';
                                $window_type = 'PDS';
                                $action_type = 'ADD';
                                $remarks = 'Added Personal Information';
                                
                                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                            }

                        }

                        Session::flash('success', 'Personal Information successfully saved.');

            	    	 return back();

            	    } else {

                        Session::flash('failed', 'Email Address ('.$email.') already exist.');

                      	return back();
                    }


            } else if($record_count > 0) {
            
                    //EDIT PERSONAL INFORMATION

                    $this->validate(request(), [
                    'lname'=>'required',
                    'fname'=>'required',
                    'mname'=>'required',
                    'bdate'=>'required',
                    'bplace'=>'required',
                    'sex'=>'required',
                    'civil_status'=>'required',
                    'height_m'=>'required',
                    'weight_kg'=>'required',
                    'blood_type'=>'required',
                    'gsis_no'=>'required',
                    'pagibig_no'=>'required',
                    'philhealth_no'=>'required',
                    'sss_no'=>'required',
                    'tin_no'=>'required',
                    'agency_emp_no'=>'required',
                    'res_barangay'=>'required',
                    'res_municipality'=>'required',
                    'res_province'=>'required',
                    'res_zip_code'=>'required',
                    'per_barangay'=>'required',
                    'per_municipality'=>'required',
                    'per_province'=>'required',
                    'per_zip_code'=>'required',
                    'mobile_no'=>'required',
                    'email'=>'required'
                    ]);

            
                    $email = $request->input('email');
                    $email_count = UserModel::where('email', '=', $email)
                                            ->where('email', '!=', $user->email)
                                            ->count();

                    if($email_count == 0) {

                        $user_account = [

                            'lname' => $request->input('lname'),
                            'fname' => $request->input('fname'),
                            'mname' => $request->input('mname'),
                            'xname' => $request->input('xname'),
                            'email' => $request->input('email')
                            
                        ];

                        $update_account = UserModel::where('id','=', $user->id)->update($user_account); 

                        if(!$update_account) {

                            //App::abort(500, 'Error');
                        
                        } else { 

                            $personal_info = [

                                'birth_date' => $request->input('bdate'),
                                'birth_place' => $request->input('bplace'),
                                'sex' => $request->input('sex'),
                                'civil_status' => $request->input('civil_status'),
                                'height' => $request->input('height_m'),
                                'weight' => $request->input('weight_kg'),
                                'blood_type' => $request->input('blood_type'),
                                'gsis_no' => $request->input('gsis_no'),
                                'pagibig_no' => $request->input('pagibig_no'),
                                'philhealth_no' => $request->input('philhealth_no'),
                                'sss_no' => $request->input('sss_no'),
                                'tin_no' => $request->input('tin_no'),
                                'agency_emp_no' => $request->input('agency_emp_no'),
                                'citizenship_filipino' => $request->input('citizenship_filipino'),
                                'citizenship_dual' => $request->input('citizenship_dual'),
                                'by_birth' => $request->input('by_birth'),
                                'by_naturalization' => $request->input('by_naturalization'),
                                'indicated_country' => $request->input('indicated_country'),
                                'res_house_block_lot' => $request->input('res_house_block_lot'),
                                'res_street' => $request->input('res_street'),
                                'res_subdivision' => $request->input('res_subdivision'),
                                'res_barangay' => $request->input('res_barangay'),
                                'res_municipality' => $request->input('res_municipality'),
                                'res_province' => $request->input('res_province'),
                                'res_zip_code' => $request->input('res_zip_code'),
                                'per_house_block_lot' => $request->input('per_house_block_lot'),
                                'per_street' => $request->input('per_street'),
                                'per_subdivision' => $request->input('per_subdivision'),
                                'per_barangay' => $request->input('per_barangay'),
                                'per_municipality' => $request->input('per_municipality'),
                                'per_province' => $request->input('per_province'),
                                'per_zip_code' => $request->input('per_zip_code'),
                                'tel_no' => $request->input('tel_no'),
                                'mobile_no' => $request->input('mobile_no'),
                                'updated_by' => $user->id,
                                
                            ];

                            $update_info = PersonalInfoModel::where('user_id','=', $user->id)->update($personal_info); 

                            //AUDIT TRAIL LOG
                            $window_page = 'Personal Information';
                            $module_code = 'PIS';
                            $window_type = 'PDS';
                            $action_type = 'EDIT';
                            $remarks = 'Modified Personal Information';
                                
                            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');            

                        }

                        Session::flash('success', 'Personal Information successfully updated.');

                         return back();

                    } else {

                        Session::flash('failed', 'Email Address ('.$email.') already exist.');

                        return back();
                    }
            }
    }
}