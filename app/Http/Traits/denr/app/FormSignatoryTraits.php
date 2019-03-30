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
use App\Models\denr\Form_Signatory as FormSignatoryModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;


trait FormSignatoryTraits
{

	public function ShowFormSignatoryFormFunction()
	{
		$user = Auth::user();
        $signatory_record = FormSignatoryModel::all();
        $division_record = DivisionModel::all();
        $signatory_count = FormSignatoryModel::count();
        $user_record = UserModel::all();
        return view('denr.app.form_signatory')
             ->with('signatory', $signatory_record)
             ->with('signatory_count', $signatory_count)
             ->with('users', $user_record)
             ->with('division', $division_record);
	}

	public function AddFormSignatoryFunction(Request $request)
	{

		$user = Auth::user();

            $record_count = FormSignatoryModel::count();

            //CHECK RECORD

           

                //MULTIPLE INSERT----------------------------------------------------------------

                $signatory = $request->input('signatory_name');

                if($request->has('signatory_name')) {

                    $delete_signatory = FormSignatoryModel::truncate();

                    foreach($signatory as $index => $value) {

                        $insert_signatory = [

                        'signatory' => $request->input('signatory_name')[$index],
                        'signatory_type' => $request->input('signatory_type')[$index],
                        'signatory_division' => $request->input('signatory_division')[$index],
                        'created_by' => $user->id,

                        ];

                        FormSignatoryModel::insert($insert_signatory);

                        //AUDIT TRAIL LOG
                        $window_page = 'Travel Order Signatory';
                        $module_code = 'PIS';
                        $window_type = 'AM';
                        $action_type = 'ADD';
                        $remarks = 'Added Travel Order Signatory '.$signatory[$index];
                                    
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                    }

                }


                Session::flash('success', ' Form Signatory successfully saved.');

                return back();

	}

}