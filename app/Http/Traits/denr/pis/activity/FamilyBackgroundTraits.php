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
use App\Models\denr\Family_Background as FamilyBackgroundModel;
use App\Models\denr\Family_Background_Children as FamilyBackgroundChildrenModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait FamilyBackgroundTraits
{

	public function ShowFamilyBackgroundFormFunction()
    {
    	$user = Auth::user();
        $family_record = FamilyBackgroundModel::where('user_id', '=', $user->id)->get()->first();
        $children_record = FamilyBackgroundChildrenModel::where('user_id', '=', $user->id)->get();
        return view('denr.pis.activity.family_background')->with('family', $family_record)->with('children', $children_record);
    }

    public function AddFamilyBackgroundFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = FamilyBackgroundModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                //ADD FAMILY BACKGROUND

                $family_data = [

                    'user_id' => $user->id,
                    'spouse_lname' => $request->input('spouse_lname'),
                    'spouse_fname' => $request->input('spouse_fname'),
                    'spouse_mname' => $request->input('spouse_mname'),
                    'spouse_xname' => $request->input('spouse_xname'),
                    'spouse_occupation' => $request->input('spouse_occupation'),
                    'spouse_business_name' => $request->input('spouse_business_name'),
                    'spouse_business_address' => $request->input('spouse_business_address'),
                    'spouse_phone_no' => $request->input('spouse_phone_no'),
                    'father_lname' => $request->input('father_lname'),
                    'father_fname' => $request->input('father_fname'),
                    'father_mname' => $request->input('father_mname'),
                    'father_xname' => $request->input('father_xname'),
                    'mother_maiden_name' => $request->input('mother_maiden_name'),
                    'mother_lname' => $request->input('mother_lname'),
                    'mother_fname' => $request->input('mother_fname'),
                    'mother_mname' => $request->input('mother_mname'),
                    'created_by' => $user->id,
                                
                ];

                $insert_data = FamilyBackgroundModel::insert($family_data);

                //MULTIPLE INSERT----------------------------------------------------------------

                $child_name = $request->input('child_name');

                if($request->has('child_name')) {

                    foreach($child_name as $index => $value) {

                        $insert_children = [

                        'user_id' => $user->id,
                        'child_name' => $request->input('child_name')[$index],
                        'child_bdate' => $request->input('child_bdate')[$index],

                        ];

                        FamilyBackgroundChildrenModel::insert($insert_children);
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $child_id = $request->input('child_id');

                if($request->has('child_id')) {

                    foreach($child_id as $index2 => $value) {

                        $update_children = [

                        'child_name' => $request->input('child_name2')[$index2],
                        'child_bdate' => $request->input('child_bdate2')[$index2],

                        ];

                        FamilyBackgroundChildrenModel::where('id','=', $child_id[$index2])->update($update_children);
                    }

                } 

                //AUDIT TRAIL LOG
                $window_page = 'Family Background';
                $module_code = 'PIS';
                $window_type = 'PDS';
                $action_type = 'ADD';
                $remarks = 'Added Family Background';
                                    
                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                Session::flash('success', 'Family Background successfully saved.');

                return back();


            } else if($record_count > 0) {
            
                //EDIT FAMILY BACKGROUND

                $family_data = [

                    'spouse_lname' => $request->input('spouse_lname'),
                    'spouse_fname' => $request->input('spouse_fname'),
                    'spouse_mname' => $request->input('spouse_mname'),
                    'spouse_xname' => $request->input('spouse_xname'),
                    'spouse_occupation' => $request->input('spouse_occupation'),
                    'spouse_business_name' => $request->input('spouse_business_name'),
                    'spouse_business_address' => $request->input('spouse_business_address'),
                    'spouse_phone_no' => $request->input('spouse_phone_no'),
                    'father_lname' => $request->input('father_lname'),
                    'father_fname' => $request->input('father_fname'),
                    'father_mname' => $request->input('father_mname'),
                    'father_xname' => $request->input('father_xname'),
                    'mother_maiden_name' => $request->input('mother_maiden_name'),
                    'mother_lname' => $request->input('mother_lname'),
                    'mother_fname' => $request->input('mother_fname'),
                    'mother_mname' => $request->input('mother_mname'),
                    'updated_by' => $user->id,
                                
                ];

                $update_data = FamilyBackgroundModel::where('user_id','=', $user->id)->update($family_data);

                //MULTIPLE INSERT----------------------------------------------------------------

                $child_name = $request->input('child_name');

                if($request->has('child_name')) {

                    foreach($child_name as $index => $value) {

                        $insert_children = [

                        'user_id' => $user->id,
                        'child_name' => $request->input('child_name')[$index],
                        'child_bdate' => $request->input('child_bdate')[$index],

                        ];

                        FamilyBackgroundChildrenModel::insert($insert_children);
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $child_id = $request->input('child_id');

                if($request->has('child_id')) {

                    foreach($child_id as $index2 => $value) {

                        $update_children = [

                        'child_name' => $request->input('child_name2')[$index2],
                        'child_bdate' => $request->input('child_bdate2')[$index2],

                        ];

                        FamilyBackgroundChildrenModel::where('id','=', $child_id[$index2])->update($update_children);
                    }

                }  

                //AUDIT TRAIL LOG
                $window_page = 'Family Background';
                $module_code = 'PIS';
                $window_type = 'PDS';
                $action_type = 'EDIT';
                $remarks = 'Modified Family Background';
                                    
                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                Session::flash('success', 'Family Background successfully updated.');

                return back();        

            }
    }
}