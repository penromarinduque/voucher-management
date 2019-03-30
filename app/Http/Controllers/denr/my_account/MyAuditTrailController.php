<?php

namespace App\Http\Controllers\denr\my_account;

use Auth;
use Response;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;
use App\Models\denr\User as UserModel;

use App\Http\Traits\denr\my_account\MyAuditTrailTraits;

class MyAuditTrailController extends Controller
{
    use MyAuditTrailTraits;

    public function showMyAuditForm()
    {
        return $this->showMyAuditFormFunction(); 
    }


    public function filterMyAudit(Request $request)
    {
        return $this->filterMyAuditFunction($request); 
    }

}


