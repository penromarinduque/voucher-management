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
use App\Models\denr\Voluntary_Work as VoluntaryWorkModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait VoluntaryWorkTraits
{
	public function ShowVoluntaryWorkFormFunction()
    {
    	$user = Auth::user();
        $voluntary_record = VoluntaryWorkModel::where('user_id', '=', $user->id)->get();
        $voluntary_count = VoluntaryWorkModel::where('user_id', '=', $user->id)->count();
        return view('denr.pis.activity.voluntary_work')->with('voluntary', $voluntary_record)->with('voluntary_count', $voluntary_count);
    }

    public function AddVoluntaryWorkFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = VoluntaryWorkModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                //MULTIPLE INSERT----------------------------------------------------------------

                $voluntary = $request->input('name_address_org');

                if($request->has('name_address_org')) {

                    foreach($voluntary as $index => $value) {

                        $insert_voluntary = [

                        'user_id' => $user->id,
                        'name_address_org' => $request->input('name_address_org')[$index],
                        'inclusive_date_from' => $request->input('date_from')[$index],
                        'inclusive_date_to' => $request->input('date_to')[$index],
                        'number_of_hours' => $request->input('number_hours')[$index],
                        'position_nature_work' => $request->input('position_nature')[$index],
                        'created_by' => $user->id,

                        ];

                        VoluntaryWorkModel::insert($insert_voluntary);

                        //AUDIT TRAIL LOG
                        $window_page = 'Voluntary Work';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Voluntary Work '.$voluntary[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $voluntary_id = $request->input('voluntary_id');
                $voluntary = $request->input('name_address_org2');

                if($request->has('voluntary_id')) {

                    foreach($voluntary_id as $index2 => $value) {

                        $update_voluntary = [

                        'name_address_org' => $request->input('name_address_org2')[$index2],
                        'inclusive_date_from' => $request->input('date_from2')[$index2],
                        'inclusive_date_to' => $request->input('date_to2')[$index2],
                        'number_of_hours' => $request->input('number_hours2')[$index2],
                        'position_nature_work' => $request->input('position_nature2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        VoluntaryWorkModel::where('id','=', $voluntary_id[$index2])->update($update_voluntary);

                        //AUDIT TRAIL LOG
                        $window_page = 'Voluntary Work';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Voluntary Work '.$voluntary[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Voluntary Work successfully saved.');

                return back();


            } else if($record_count > 0) {
            
                //MULTIPLE INSERT----------------------------------------------------------------

                $voluntary = $request->input('name_address_org');

                if($request->has('name_address_org')) {

                    foreach($voluntary as $index => $value) {

                        $insert_voluntary = [

                        'user_id' => $user->id,
                        'name_address_org' => $request->input('name_address_org')[$index],
                        'inclusive_date_from' => $request->input('date_from')[$index],
                        'inclusive_date_to' => $request->input('date_to')[$index],
                        'number_of_hours' => $request->input('number_hours')[$index],
                        'position_nature_work' => $request->input('position_nature')[$index],
                        'created_by' => $user->id,

                        ];

                        VoluntaryWorkModel::insert($insert_voluntary);

                        //AUDIT TRAIL LOG
                        $window_page = 'Voluntary Work';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Voluntary Work '.$voluntary[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $voluntary_id = $request->input('voluntary_id');
                $voluntary = $request->input('name_address_org2');

                if($request->has('voluntary_id')) {

                    foreach($voluntary_id as $index2 => $value) {

                        $update_voluntary = [

                        'name_address_org' => $request->input('name_address_org2')[$index2],
                        'inclusive_date_from' => $request->input('date_from2')[$index2],
                        'inclusive_date_to' => $request->input('date_to2')[$index2],
                        'number_of_hours' => $request->input('number_hours2')[$index2],
                        'position_nature_work' => $request->input('position_nature2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        VoluntaryWorkModel::where('id','=', $voluntary_id[$index2])->update($update_voluntary);

                        //AUDIT TRAIL LOG
                        $window_page = 'Voluntary Work';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Voluntary Work '.$voluntary[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Voluntary Work successfully saved.');

                return back();    

            }
    }
}