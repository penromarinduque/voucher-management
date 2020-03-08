<?php

/*
|--------------------------------------------------------------------------
| TOA Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'],function() {

	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	// TOA - ACTIVITY
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW TRAVEL ORDER LIST
	Route::get('/toa/activity/travelorder/view', 'denr\toa\activity\TravelOrderController@ShowTravelOrderList')->name('travel.order.list');

	// VIEW TRAVEL ORDER ADD FORM
	Route::get('/toa/activity/travelorder/add', 'denr\toa\activity\TravelOrderController@ShowTravelOrderForm')->name('travel.order.form');

	// POST TRAVEL ORDER ADD FORM 
	Route::post('/toa/activity/travelorder/add', 'denr\toa\activity\TravelOrderController@AddTravelOrder')->name('travel.order.submit');

	// VIEW TRAVEL ORDER EDIT FORM 
	Route::get('/toa/activity/travelorder/edit/{id}', 'denr\toa\activity\TravelOrderController@ViewTravelOrder')->name('view.travel.order');

	// POST TRAVEL ORDER EDIT FORM 
	Route::post('/toa/activity/travelorder/edit', 'denr\toa\activity\TravelOrderController@EditTravelOrder')->name('edit.travel.order.submit');

	// VIEW TRAVEL ORDER PRINT FORM 
	Route::get('/toa/activity/travelorder/print/1/{id}', 'denr\toa\activity\TravelOrderController@PrintTravelOrder')->name('print.travel.order');

	// VIEW ITINERARY PRINT FORM 
	Route::get('/toa/activity/travelorder/print/2/{id}', 'denr\toa\activity\TravelOrderController@PrintItinerary')->name('print.itinerary');

	// POST TRAVEL ORDER DELTE FORM 
	Route::post('/toa/activity/travelorder/delete', 'denr\toa\activity\TravelOrderController@DeleteTravelOrder')->name('delete.travel.order.submit');

	// POST TRAVEL ORDER CANCEL FORM 
	Route::post('/toa/activity/travelorder/cancel', 'denr\toa\activity\TravelOrderController@CancelTravelOrder')->name('cancel.travel.order.submit');

	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	// TOA - APPROVAL
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW PENDING TRAVEL ORDER LIST
	Route::get('/toa/approval/pendingtravelorder/view', 'denr\toa\approval\PendingTravelOrderController@ShowPendingTravelOrderList')->name('pending.travel.order.list');

	// VIEW APPROVED TRAVEL ORDER LIST
	Route::get('/toa/approval/approvedtravelorder/view', 'denr\toa\approval\PendingTravelOrderController@ShowApprovedTravelOrderList')->name('approved.travel.order.list');

	// VIEW DISAPPROVED TRAVEL ORDER LIST
	Route::get('/toa/approval/disapprovedtravelorder/view', 'denr\toa\approval\PendingTravelOrderController@ShowDisapprovedTravelOrderList')->name('disapproved.travel.order.list');

	// VIEW CANCELLED TRAVEL ORDER LIST
	Route::get('/toa/approval/cancelledtravelorder/view', 'denr\toa\approval\PendingTravelOrderController@ShowCancelledTravelOrderList')->name('cancelled.travel.order.list');

	// VIEW PENDING TRAVEL ORDER APPROVE FORM 
	//Route::get('/toa/approval/viewpendingtravelorder/{id}', 'denr\toa\approval\PendingTravelOrderController@ViewPendingTravelOrder')->name('view.pending.travel.order');

	// VIEW TRAVEL ORDER PRINT FORM 
	Route::get('/toa/approval/pendingtravelorder/edit/{id}', 'denr\toa\approval\PendingTravelOrderController@ViewPendingTravelOrder')->name('view.pending.travel.order');

	// POST PENDING TRAVEL ORDER APPROVE FORM 
	Route::post('/toa/approval/pendingtravelorder/edit/1', 'denr\toa\approval\PendingTravelOrderController@ApprovePendingTravelOrder')->name('approve.pending.travel.order.submit');

	// POST PENDING TRAVEL ORDER APPROVE FORM 
	Route::post('/toa/approval/pendingtravelorder/edit/2', 'denr\toa\approval\PendingTravelOrderController@RecommendPendingTravelOrder')->name('recom.pending.travel.order.submit');

	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	// TOA - REPORTS
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW TRAVEL ORDER REPORT FORM
	Route::get('/toa/report/travelorderreport/print', 'denr\toa\report\TravelOrderReportController@TravelOrderFilterForm')->name('travel.order.filter.form');

	// AJAX GET SECTION
	Route::get('/ajax-get-div-section', 'denr\toa\report\TravelOrderReportController@AjaxGetDivSection')->name('ajax.get.div.section');
	
	// AJAX GET SECTION
	Route::get('/ajax-get-div-unit', 'denr\toa\report\TravelOrderReportController@AjaxGetDivUnit')->name('ajax.get.div.unit');
	
	// AJAX GET UNIT
	Route::get('/ajax-get-sec-unit', 'denr\toa\report\TravelOrderReportController@AjaxGetSecUnit')->name('ajax.get.sec.unit');

	// AJAX GET POSITION EMPLOYEE
	Route::get('/ajax-get-employee', 'denr\toa\report\TravelOrderReportController@AjaxGetEmployee')->name('ajax.get.employee');
	
	// AJAX GET POSITION EMPLOYEE
	Route::get('/ajax-get-employee-order', 'denr\toa\report\TravelOrderReportController@AjaxGetEmployeeOrder')->name('ajax.get.employee.order');
		
	// POST TRAVEL ORDER REPORT FORM
	Route::post('/toa/report/travelorderreport/print', 'denr\toa\report\TravelOrderReportController@TravelOrderFilterResult')->name('travel.order.filter.result');

	// VIEW EMPLOYEE REPORT FORM
	Route::get('/toa/report/employeereport/print', 'denr\toa\report\EmployeeReportController@EmployeeFilterForm')->name('employee.filter.form');

	// POST EMPLOYEE REPORT FORM
	Route::post('/toa/report/employeereport/print', 'denr\toa\report\EmployeeReportController@EmployeeFilterResult')->name('employee.filter.result');

});