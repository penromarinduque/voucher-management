<?php

use App\Helpers\Helper;
$user = Auth::user();
$user_type = $user->user_type;
$user_role = $user->user_role;
$user_id = $user->id;
$path = helper::mod_path();
$doc_class = helper::doc_class();
$icon_class = helper::icon_class();

$in_notification = helper::in_notification();
$out_notification = helper::out_notification();
$acted_notification = helper::acted_notification();
$completed_notification = helper::completed_notification();

if($path == 'dts') { $module = 'Document Tracking System'; $icon = 'fa fa-truck'; }
else if($path == 'toa') { $module = 'Travel Order Application'; $icon = 'fa fa-globe'; }
else if($path == 'pis') { $module = 'Personal Information System'; $icon = 'fa fa-list'; }
else if($path == 'app') { $module = 'Application Manager'; $icon = 'fa fa-cog'; }
else if($path == 'lms') { $module = 'Leave Monitoring System'; $icon = 'fa fa-calendar'; }
else if($path == 'fsa') { $module = 'Frontline Services Application'; $icon = 'fa fa-th'; }
else if($path == 'home') { $module = 'Home'; $icon = 'fa fa-home'; }

$pis_access = helper::pis_access();
$toa_access = helper::toa_access();
$dts_access = helper::dts_access();
$lms_access = helper::lms_access();
$fsa_access = helper::fsa_access();
$app_access = helper::app_access();

$pis_access1 = helper::user_access('PIS Personal Information','view_access');
$pis_access2 = helper::user_access('PIS Family Background','view_access');
$pis_access3 = helper::user_access('PIS Educational Background','view_access');
$pis_access4 = helper::user_access('PIS Civil Service Eligibility','view_access');
$pis_access5 = helper::user_access('PIS Work Experience','view_access');
$pis_access6 = helper::user_access('PIS Voluntary Work','view_access');
$pis_access7 = helper::user_access('PIS Learning & Development','view_access');
$pis_access8 = helper::user_access('PIS Other Information','view_access');

$toa_access1 = helper::user_access('TOA Travel Order','view_access');
$toa_access2 = helper::user_access('TOA Travel Order','add_access');
$toa_access3 = helper::user_access('TOA Travel Order Report','print_access');
$toa_access4 = helper::user_access('TOA Employee Report','print_access');
$toa_access5 = helper::user_access('TOA Pending Travel Order','view_access');
$toa_access6 = helper::user_access('TOA Approved Travel Order','view_access');
$toa_access7 = helper::user_access('TOA Disapproved Travel Order','view_access');
$toa_access8 = helper::user_access('TOA Cancelled Travel Order','view_access');

$dts_access1 = helper::user_access('DTS Documents','view_access');
$dts_access2 = helper::user_access('DTS Documents','add_access');
$dts_access3 = helper::user_access('DTS Document Type','view_access');
$dts_access4 = helper::user_access('DTS Document Report','print_access');
$dts_access5 = helper::user_access('DTS Document Type','add_access');

?>