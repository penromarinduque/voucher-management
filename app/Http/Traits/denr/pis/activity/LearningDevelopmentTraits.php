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
use App\Models\denr\Learning_Development as LearningDevelopmentModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait LearningDevelopmentTraits
{
	public function ShowLearningDevelopmentFormFunction()
    {
    	$user = Auth::user();
        $learning_record = LearningDevelopmentModel::where('user_id', '=', $user->id)->get();
        $learning_count = LearningDevelopmentModel::where('user_id', '=', $user->id)->count();
        return view('denr.pis.activity.learning_development')->with('learning', $learning_record)->with('learning_count', $learning_count);
    }

    public function AddLearningDevelopmentFunction(Request $request) 
    {
    	$user = Auth::user();

            $record_count = LearningDevelopmentModel::where('user_id', '=', $user->id)->count();

            //CHECK RECORD

            if($record_count == 0) {

                //MULTIPLE INSERT----------------------------------------------------------------

                $title = $request->input('title');

                if($request->has('title')) {

                    foreach($title as $index => $value) {

                        $insert_learning = [

                        'user_id' => $user->id,
                        'learning_title' => $request->input('title')[$index],
                        'inclusive_date_from' => $request->input('date_from')[$index],
                        'inclusive_date_to' => $request->input('date_to')[$index],
                        'number_of_hours' => $request->input('number_hours')[$index],
                        'type_id' => $request->input('type_id')[$index],
                        'conducted_by' => $request->input('conducted')[$index],
                        'created_by' => $user->id,

                        ];

                        LearningDevelopmentModel::insert($insert_learning);

                        //AUDIT TRAIL LOG
                        $window_page = 'Learning & Development';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Learning & Development '.$title[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $learning_id = $request->input('learning_id');
                $title = $request->input('title2');

                if($request->has('learning_id')) {

                    foreach($learning_id as $index2 => $value) {

                        $update_learning = [

                        'learning_title' => $request->input('title2')[$index2],
                        'inclusive_date_from' => $request->input('date_from2')[$index2],
                        'inclusive_date_to' => $request->input('date_to2')[$index2],
                        'number_of_hours' => $request->input('number_hours2')[$index2],
                        'type_id' => $request->input('type_id2')[$index2],
                        'conducted_by' => $request->input('conducted2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        LearningDevelopmentModel::where('id','=', $learning_id[$index2])->update($update_learning);

                        //AUDIT TRAIL LOG
                        $window_page = 'Learning & Development';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Learning & Development '.$title[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Learning & Development successfully saved.');

                return back();


            } else if($record_count > 0) {
            
                //MULTIPLE INSERT----------------------------------------------------------------

                $title = $request->input('title');

                if($request->has('title')) {

                    foreach($title as $index => $value) {

                        $insert_learning = [

                        'user_id' => $user->id,
                        'learning_title' => $request->input('title')[$index],
                        'inclusive_date_from' => $request->input('date_from')[$index],
                        'inclusive_date_to' => $request->input('date_to')[$index],
                        'number_of_hours' => $request->input('number_hours')[$index],
                        'type_id' => $request->input('type_id')[$index],
                        'conducted_by' => $request->input('conducted')[$index],
                        'created_by' => $user->id,

                        ];

                        LearningDevelopmentModel::insert($insert_learning);

                        //AUDIT TRAIL LOG
                        $window_page = 'Learning & Development';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'ADD';
                        $remarks = 'Added Learning & Development '.$title[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                    }

                }

                //-------------------------------------------------------------------------------

                //MULTIPLE UPDATE----------------------------------------------------------------

                $learning_id = $request->input('learning_id');
                $title = $request->input('title2');

                if($request->has('learning_id')) {

                    foreach($learning_id as $index2 => $value) {

                        $update_learning = [

                        'learning_title' => $request->input('title2')[$index2],
                        'inclusive_date_from' => $request->input('date_from2')[$index2],
                        'inclusive_date_to' => $request->input('date_to2')[$index2],
                        'number_of_hours' => $request->input('number_hours2')[$index2],
                        'type_id' => $request->input('type_id2')[$index2],
                        'conducted_by' => $request->input('conducted2')[$index2],
                        'updated_by' => $user->id,

                        ];

                        LearningDevelopmentModel::where('id','=', $learning_id[$index2])->update($update_learning);

                        //AUDIT TRAIL LOG
                        $window_page = 'Learning & Development';
                        $module_code = 'PIS';
                        $window_type = 'PDS';
                        $action_type = 'EDIT';
                        $remarks = 'Modified Learning & Development '.$title[$index2];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                } 

                Session::flash('success', 'Learning & Development successfully saved.');

                return back();    

            }
    }


}