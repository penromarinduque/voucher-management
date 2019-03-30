<?php

namespace App\Http\Controllers\denr\my_account;

use Crypt;
use Auth;
use Session;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\denr\User as UserModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

use App\Http\Traits\denr\my_account\PasswordTraits;

class PasswordController extends Controller
{
    use PasswordTraits;

    public function ViewPassword() 
    {
       return $this->ViewPasswordFunction();          
    }


    public function ChangePassword(Request $request) 
    {
        return $this->ChangePasswordFunction($request);   
    }
 
}
