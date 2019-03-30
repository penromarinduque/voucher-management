<?php

namespace App\Http\Controllers\denr\my_account;

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

use App\Http\Traits\denr\my_account\AccountTraits;

class AccountController extends Controller
{

    use AccountTraits;
    
    public function ViewAccount() 
    {
        return $this->ViewAccountFunction();

    }

    public function EditAccount(Request $request) 
    {
        return $this->EditAccountFunction($request);
    }
    
}



               