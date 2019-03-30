<?php

namespace App\Http\Traits\denr\my_account;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;


trait AccountTraits{

	public function ViewAccountFunction()
	{

		$user = Auth::user();
        $account = UserModel::where('id', '=', $user->id)->get()->first();
        $position = PositionModel::where('id', '=', $account->user_position)->get()->first();
        $division = DivisionModel::where('id', '=', $account->user_division)->get()->first();
        $section = SectionModel::where('id', '=', $account->user_section)->get()->first();
        $unit = UnitModel::where('id', '=', $account->user_unit)->get()->first();
        
        return view('denr.my_account.my_account')
             ->with('record', $account)
             ->with('position', $position)
             ->with('division', $division)
             ->with('section', $section)
             ->with('unit', $unit);       
	}

	public function EditAccountFunction(Request $request)
	{
		$user = Auth::user();

        $this->validate(request(), [
            'fname'=>'required',
            'mname'=>'required',
            'lname'=>'required',
            'email'=>'required'
        ]);

        $get_username = $request->input('get_username');
        $get_email = $request->input('get_email');
        $email = $request->input('email');

        $email_count = UserModel::where('email', '=', $email)
                                ->where('email', '!=', $get_email)
                                ->count();

            if($email_count == 0) {

                $userAccount = [

                    'FNAME' => $request->input('fname'),
                    'MNAME' => $request->input('mname'),
                    'LNAME' => $request->input('lname'),
                    'EMAIL' => $request->input('email'),
                    
                ];

                UserModel::where('id','=', $user->id)->update($userAccount);

                //AUDIT TRAIL LOG
                $window_page = 'My Account';
                $module_code = 'PIS';
                $window_type = 'MA';
                $action_type = 'EDIT';
                $remarks = 'User/Employee '.$user->username.' modified his/her account';
                                    
                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                Session::flash('success', 'Your Account ('.$get_username.') successfully updated.');

                return back();

            } else {

                Session::flash('failed', 'Email Address ('.$email.') already exist.');

                 return back();
            }

	}

}