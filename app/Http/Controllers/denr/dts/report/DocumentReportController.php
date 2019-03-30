<?php

namespace App\Http\Controllers\denr\dts\report;

use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Traits\denr\dts\report\DocumentReportTrait;
use App\Http\Traits\denr\app\UserAccessTraits;

class DocumentReportController extends Controller
{
	use DocumentReportTrait, UserAccessTraits;

    public function DocumentReport()
    {
        if($this->user_access()){

            return $this->DocumentReportFunction();

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    } 


    public function DocumentReportResult(Request $request)
    {
        if($this->user_access()){

            return $this->DocumentReportResultFunction($request);

        } else {

            Session::flash('failed', 'You have no rights to access '.$this->window_desc());
            return back();

        }
    } 

}