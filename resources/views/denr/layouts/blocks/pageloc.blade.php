<?php

use App\Helpers\Helper;
$user = Auth::user();
$path = helper::mod_path();
$window_type = helper::window_type();

if($path == 'dts') { $module = 'Voucher Management System'; }
else if($path == 'toa') { $module = 'Travel Order Application'; }
else if($path == 'pis') { $module = 'Personal Information System'; }
else if($path == 'app') { $module = 'Application Manager'; }
else if($path == 'lms') { $module = 'Leave Monitoring System'; }
else if($path == 'fsa') { $module = 'Frontline Services Application'; }
else if($path == 'home') { $module = 'Home'; }

?>

<div class="col-lg-12" style="margin-top: 0px;">

    <h5 class="page-header" style="color: #09C;">

    	@if($path != 'my_account')

	    	<i class="fa fa-cube fa-fw"></i> {{$module}} &nbsp;&nbsp; 
	    	<font style="color: #000;"> &nbsp;&nbsp; 
	    		@if($window_type == 'maintenance')
	    			<i class="fa fa-angle-double-right fa-fw"></i> &nbsp;&nbsp; <i class="fa fa-folder-open fa-fw"></i>  Maintenance
	    		@elseif($window_type == 'activity')
	    			<i class="fa fa-angle-double-right fa-fw"></i> &nbsp;&nbsp; <i class="fa fa-folder-open fa-fw"></i>  Activity
	    		@elseif($window_type == 'report')
	    			<i class="fa fa-angle-double-right fa-fw"></i> &nbsp;&nbsp; <i class="fa fa-folder-open fa-fw"></i>  Reports
	    		@elseif($window_type == 'approval')
	    			<i class="fa fa-angle-double-right fa-fw"></i> &nbsp;&nbsp; <i class="fa fa-folder-open fa-fw"></i>  Approval Manager
	    		@elseif($window_type == 'myaccount')
	    			<i class="fa fa-angle-double-right fa-fw"></i> &nbsp;&nbsp; <i class="fa fa-folder-open fa-fw"></i>  Manage Account
	    		@endif
	    	</font>

    	@elseif($path == 'my_account')

    		<i class="fa fa-cube fa-fw"></i> My Account

    	@endif


    </h5>
               
</div>
