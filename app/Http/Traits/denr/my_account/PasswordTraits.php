<?php

namespace App\Http\Traits\denr\my_account;

use Crypt;
use Auth;
use Session;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\denr\User as UserModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait PasswordTraits
{

	public function ViewPasswordFunction()
	{
		$record = UserModel::where('id', '=', Auth::user()->id)->get()->first();
        return view('denr.my_account.change_password', array('record' => $record)); 
	}

	public function ChangePasswordFunction(Request $request)
	{
		$user = Auth::user();

        $this->validate(request(), [
            'current_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required'
        ]);

        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');
        
        if (!Hash::check($current_password, $user->password)) {
            
            Session::flash('failed', 'Current Password did not match!');

            return redirect()->route('change.password');
        
        } else {

            if($new_password == $confirm_password) {
                
                $userPassword = [

                    'password' => Hash::make($request->new_password)
                ];

                UserModel::where('id','=', $user->id)->update($userPassword);

                //AUDIT TRAIL LOG
                $window_page = 'Change Password';
                $module_code = 'PIS';
                $window_type = 'MA';
                $action_type = 'EDIT';
                $remarks = 'User/Employee '.$user->username.' changed his/her password';
                                    
                include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

                Session::flash('success', 'Password successfully changed.');

                return redirect()->route('change.password');

            } else {

                Session::flash('failed', 'Confirm Password did not match!');

                return redirect()->route('change.password');
            }
        
        }
	}

}