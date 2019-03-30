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
use App\Models\denr\Form_No as FormNoModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait FormNoTraits
{

	public function ShowFormNoFormFunction(){

		$user = Auth::user();
        $form_record = FormNoModel::all();
        return view('denr.app.form_no_generation')->with('record', $form_record);

	}


	public function AddFormNoFunction(Request $request)
	{

		$user = Auth::user();

        $form_no = $request->input('form_text');
        $form_id = $request->input('form_id');

        if($request->has('form_text')) {

            foreach($form_no as $index => $value) {

                $count_form = FormNoModel::where('id','=', $request->input('form_id')[$index])->count();

                $insert_form_no = [

                'form_text' => $request->input('form_text')[$index],
                'form_no' => $request->input('form_no')[$index],
                'created_by' => $user->id,

                ];

                if($count_form == 0) {
                    FormNoModel::insert($insert_form_no);
                } else if($count_form > 0) {
                    FormNoModel::where('id','=', $request->input('form_id')[$index])->update($insert_form_no);
                }

                

                //AUDIT TRAIL LOG
                $window_page = 'Form No Generation';
                $module_code = 'APP';
                $window_type = 'AM';
                $action_type = 'ADD';
                $remarks = 'Added & Modified Form No. Generation '.$form_no[$index];
                            
                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
            }

        }


        Session::flash('success', ' Form No. Generation successfully saved & updated.');

        return back();

        /*$record_count = FormNoModel::count();

        if($record_count == 0) {

            $form_data = [

                'form_text' => $request->input('form_text'),
                'form_no' => $request->input('form_no'),
                'created_by' => $user->id,
                            
            ];

            $insert_data = FormNoModel::insert($form_data);

            $window_page = 'Form No Generation';
            $module_code = 'PIS';
            $window_type = 'AM';
            $action_type = 'ADD';
            $remarks = 'Added Form No Generation';
                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Form No. successfully saved.');

            return back();


        } else if($record_count > 0) {

            $form_id = $request->input('form_id');

            $form_data = [

                'form_text' => $request->input('form_text'),
                'form_no' => $request->input('form_no'),
                'updated_by' => $user->id,
                            
            ];

            $update_data = FormNoModel::where('id','=', $form_id)->update($form_data);
        
            $window_page = 'Form No. generation';
            $module_code = 'PIS';
            $window_type = 'AM';
            $action_type = 'EDIT';
            $remarks = 'Modified Form No. Generation';
                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Form No. successfully updated.');

            return back();        

        }*/

	}





}