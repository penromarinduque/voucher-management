<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'],function() {








	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  INDEXES
	//
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW DASHBOARD
	Route::get('/home', 'denr\HomeController@index')->name('home');

	//DTS INDEX
	Route::get('/dts', 'denr\HomeController@DocumentTrackingSystem')->name('dts');
	
	//TOA INDEX
	Route::get('/toa', 'denr\HomeController@TravelOrderApplication')->name('toa');

	//PIS INDEX
	Route::get('/pis', 'denr\HomeController@PersonalInformation')->name('pis');

	//APP INDEX
	Route::get('/app', 'denr\HomeController@SystemUtilities')->name('app');

	//LMS INDEX
	Route::get('/lms', 'denr\HomeController@LeaveMonitoring')->name('lms');

	//LMS INDEX
	Route::get('/fsa', 'denr\HomeController@FrontlineServices')->name('fsa');








	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  MY ACCOUNT
	//
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW MY ACCOUNT
	Route::get('/{path}/my_account/myaccount', 'denr\my_account\AccountController@ViewAccount')->name('user.account');

	// POST MY ACCOUNT FORM 
	Route::post('/{path}/my_account/editmyaccount', 'denr\my_account\AccountController@EditAccount')->name('user.account.submit');

	// VIEW CHANGE PASSWORD FORM
	Route::get('/{path}/my_account/changepassword', 'denr\my_account\PasswordController@ViewPassword')->name('change.password');

	// POST CHANGE PASSWORD FORM 
	Route::post('/{path}/my_account/changepassword', 'denr\my_account\PasswordController@ChangePassword')->name('change.password.submit');

	// VIEW MY AUDIT LOG FORM
	Route::get('/{path}/my_account/myaudittraillog', 'denr\my_account\MyAuditTrailController@ShowMyAuditForm')->name('my.audit.trail.log.form');

	// POST MY AUDIT LOG FORM
	Route::post('/{path}/my_account/filtermyaudittraillog', 'denr\my_account\MyAuditTrailController@FilterMyAudit')->name('my.audit.trail.log.filter');








	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  PIS
	//
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW PERSONAL INFORMATION ADD FORM
	Route::get('/pis/pds/personlinformation/add', 'denr\pis\activity\PersonalInformationController@ShowPersonalInfoForm')->name('personal.information');

	// POST PERSONAL INFORMATION ADD FORM 
	Route::post('/pis/pds/personlinformation/add', 'denr\pis\activity\PersonalInformationController@AddPersonalInfo')->name('personal.information.submit');


	// VIEW FAMILY BACKGROUND ADD FORM
	Route::get('/pis/pds/familybackground/add', 'denr\pis\activity\FamilyBackgroundController@ShowFamilyBackgroundForm')->name('family.background');

	// POST FAMILY BACKGROUND ADD FORM 
	Route::post('/pis/pds/familybackground/add', 'denr\pis\activity\FamilyBackgroundController@AddFamilyBackground')->name('family.background.submit');


	// VIEW EDUCATIONAL BACKGROUND ADD FORM
	Route::get('/pis/pds/educationalbackground/add', 'denr\pis\activity\EducationalBackgroundController@ShowEducationalBackgroundForm')->name('educational.background');

	// POST EDUCATIONAL BACKGROUND ADD FORM 
	Route::post('/pis/pds/educationalbackground/add', 'denr\pis\activity\EducationalBackgroundController@AddEducationalBackground')->name('educational.background.submit');


	// VIEW CIVIL SERVICE ELIGIBILITY ADD FORM
	Route::get('/pis/pds/civilserviceeligibility/add', 'denr\pis\activity\CivilServiceEligibilityController@ShowCivilServiceEligibilityForm')->name('civil.service.eligibility');

	// POST CIVIL SERVICE ELIGIBILITY ADD FORM 
	Route::post('/pis/pds/civilserviceeligibility/add', 'denr\pis\activity\CivilServiceEligibilityController@AddCivilServiceEligibility')->name('civil.service.eligibility.submit');


	// VIEW WORK_EXPERIENCE ADD FORM
	Route::get('/pis/pds/workexperience/add', 'denr\pis\activity\WorkExperienceController@ShowWorkExperienceForm')->name('work.experience');

	// POST WORK_EXPERIENCE ADD FORM 
	Route::post('/pis/pds/workexperience/add', 'denr\pis\activity\WorkExperienceController@AddWorkExperience')->name('work.experience.submit');


	// VIEW VOLUNTARY WORK ADD FORM
	Route::get('/pis/pds/voluntarywork/add', 'denr\pis\activity\VoluntaryWorkController@ShowVoluntaryWorkForm')->name('voluntary.work');

	// POST VOLUNTARY WORK ADD FORM 
	Route::post('/pis/pds/voluntarywork/add', 'denr\pis\activity\VoluntaryWorkController@AddVoluntaryWork')->name('voluntary.work.submit');


	// VIEW LEARNING & DEVELOPMENT ADD FORM
	Route::get('/pis/pds/learningdevelopment/add', 'denr\pis\activity\LearningDevelopmentController@ShowLearningDevelopmentForm')->name('learning.development');

	// POST LEARNING & DEVELOPMENT ADD FORM 
	Route::post('/pis/pds/learningdevelopment/add', 'denr\pis\activity\LearningDevelopmentController@AddLearningDevelopment')->name('learning.development.submit');


	// VIEW OTHER INFORMAION ADD FORM
	Route::get('/pis/pds/otherinformation/add', 'denr\pis\activity\OtherInformationController@ShowOtherInformationForm')->name('other.information');

	// POST OTHER INFORMAION ADD FORM 
	Route::post('/pis/pds/otherinformation/add', 'denr\pis\activity\OtherInformationController@AddOtherInformation')->name('other.information.submit');








	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  TOA - ACTIVITY
	//
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
	//
	//  TOA - APPROVAL
	//
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
	//
	//  TOA - REPORTS
	//
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








	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  APP 
	//
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW USER LIST
	Route::get('/app/maintenance/user/view', 'denr\app\UserController@ShowUserList')->name('employee.user.list');

	// VIEW USER ADD FORM
	Route::get('/app/maintenance/user/add', 'denr\app\UserController@ShowUserForm')->name('employee.user.form');

	// POST USER ADD FORM 
	Route::post('/app/maintenance/user/add', 'denr\app\UserController@AddUser')->name('employee.user.submit');

	// AJAX DIVISION-SECTION
	Route::get('/ajax-user-div-sec', 'denr\app\UserController@ShowAjaxSec');

	// AJAX DIVISION-SECTION
	Route::get('/ajax-user-sec-unit', 'denr\app\UserController@ShowAjaxUnit');

	// VIEW USER EDIT FORM 
	Route::get('/app/maintenance/user/edit/{id}', 'denr\app\UserController@ViewUser')->name('view.employee.user');

	// POST USER EDIT FORM 
	Route::post('/app/maintenance/user/edit', 'denr\app\UserController@EditUser')->name('edit.employee.user.submit');

	// POST USER DELTE FORM 
	Route::post('/app/maintenance/user/delete', 'denr\app\UserController@DeleteUser')->name('delete.employee.user.submit');

	// VIEW EMPLOYEE POSITION LIST
	Route::get('/app/maintenance/position/view', 'denr\app\PositionController@ShowPositionList')->name('employee.position.list');

	// VIEW EMPLOYEE POSITION ADD FORM
	Route::get('/app/maintenance/position/add', 'denr\app\PositionController@ShowPositionForm')->name('employee.position.form');

	// POST EMPLOYEE POSITION ADD FORM 
	Route::post('/app/maintenance/position/add', 'denr\app\PositionController@AddPosition')->name('employee.position.submit');

	// VIEW EMPLOYEE POSITION EDIT FORM 
	Route::get('/app/maintenance/position/edit/{id}', 'denr\app\PositionController@ViewPosition')->name('view.employee.position');

	// POST EMPLOYEE POSITION EDIT FORM 
	Route::post('/app/maintenance/position/edit', 'denr\app\PositionController@EditPosition')->name('edit.employee.position.submit');

	// POST EMPLOYEE POSITION DELTE FORM 
	Route::post('/app/maintenance/position/delete', 'denr\app\PositionController@DeletePosition')->name('delete.employee.position.submit');


	// VIEW EMPLOYEE DIVISION LIST
	Route::get('/app/maintenance/division/view', 'denr\app\DivisionController@ShowDivisionList')->name('employee.division.list');

	// VIEW EMPLOYEE DIVISION ADD FORM
	Route::get('/app/maintenance/division/add', 'denr\app\DivisionController@ShowDivisionForm')->name('employee.division.form');

	// POST EMPLOYEE DIVISION ADD FORM 
	Route::post('/app/maintenance/division/add', 'denr\app\DivisionController@AddDivision')->name('employee.division.submit');

	// VIEW EMPLOYEE DIVISION FORM 
	Route::get('/app/maintenance/division/edit/{id}', 'denr\app\DivisionController@ViewDivision')->name('view.employee.division');

	// POST EMPLOYEE DIVISION EDIT FORM 
	Route::post('/app/maintenance/division/edit', 'denr\app\DivisionController@EditDivision')->name('edit.employee.division.submit');

	// POST EMPLOYEE DIVISION DELTE FORM 
	Route::post('/app/maintenance/division/delete', 'denr\app\DivisionController@DeleteDivision')->name('delete.employee.division.submit');


	// VIEW EMPLOYEE SECTION LIST
	Route::get('/app/maintenance/section/view', 'denr\app\SectionController@ShowSectionList')->name('employee.section.list');

	// VIEW EMPLOYEE SECTION ADD FORM
	Route::get('/app/maintenance/section/add', 'denr\app\SectionController@ShowSectionForm')->name('employee.section.form');

	// POST EMPLOYEE SECTION ADD FORM 
	Route::post('/app/maintenance/section/add', 'denr\app\SectionController@AddSection')->name('employee.section.submit');

	// VIEW EMPLOYEE SECTION FORM 
	Route::get('/app/maintenance/section/edit/{id}', 'denr\app\SectionController@ViewSection')->name('view.employee.section');

	// POST EMPLOYEE SECTION EDIT FORM 
	Route::post('/app/maintenance/section/edit', 'denr\app\SectionController@EditSection')->name('edit.employee.section.submit');

	// POST EMPLOYEE SECTION DELTE FORM 
	Route::post('/app/maintenance/section/delete', 'denr\app\SectionController@DeleteSection')->name('delete.employee.section.submit');


	// VIEW EMPLOYEE UNIT LIST
	Route::get('/app/maintenance/unit/view', 'denr\app\UnitController@ShowUnitList')->name('employee.unit.list');

	// AJAX DIVISION-SECTION
	Route::get('/ajax-div-sec', 'denr\app\UnitController@showAjax');

	// VIEW EMPLOYEE UNIT ADD FORM
	Route::get('/app/maintenance/unit/add', 'denr\app\UnitController@ShowUnitForm')->name('employee.unit.form');

	// POST EMPLOYEE UNIT ADD FORM 
	Route::post('/app/maintenance/unit/add', 'denr\app\UnitController@AddUnit')->name('employee.unit.submit');

	// VIEW EMPLOYEE UNIT FORM 
	Route::get('/app/maintenance/unit/edit/{id}', 'denr\app\UnitController@ViewUnit')->name('view.employee.unit');

	// POST EMPLOYEE UNIT EDIT FORM 
	Route::post('/app/maintenance/unit/edit', 'denr\app\UnitController@EditUnit')->name('edit.employee.unit.submit');

	// POST EMPLOYEE UNIT DELTE FORM 
	Route::post('/app/maintenance/unit/delete', 'denr\app\UnitController@DeleteUnit')->name('delete.employee.unit.submit');


	// VIEW AUDIT LOG FORM
	Route::get('/app/maintenance/audittraillog/view', 'denr\app\AuditTrailController@ShowAuditForm')->name('audit.trail.log.form');

	// POST AUDIT LOG FORM
	Route::post('/app/maintenance/audittraillog/print', 'denr\app\AuditTrailController@FilterAudit')->name('audit.trail.log.filter');


	// VIEW FORM NO GENERARTION ADD FORM
	Route::get('/app/maintenance/formnogeneration/view', 'denr\app\FormNoController@ShowFormNoForm')->name('no.generation.form');

	// POST FORM NO GENERARTION ADD FORM 
	Route::post('/app/maintenance/formnogeneration/add', 'denr\app\FormNoController@AddFormNo')->name('no.generation.submit');


	// VIEW FORM SIGNATORY ADD FORM
	Route::get('/app/maintenance/travelordersignatories/view', 'denr\app\FormSignatoryController@ShowFormSignatoryForm')->name('form.signatory.form');

	// POST FORM SIGNATORY ADD FORM 
	Route::post('/app/maintenance/travelordersignatories/add', 'denr\app\FormSignatoryController@AddFormSignatory')->name('form.signatory.submit');


	// VIEW USER MODULE ACCESS FORM
	Route::get('/app/maintenance/usermoduleaccess/view', 'denr\app\UserModuleAccessController@ShowUserModuleAccess')->name('user.module.access');

	// AJAX USER MODULE ACCESS
	Route::get('/ajax-user-module-access', 'denr\app\UserModuleAccessController@showAjaxUserModuleAccess')->name('ajax.user.module.access');;

	// POST USER MOPDULE ACCESS ADD FORM
	Route::post('/app/maintenance/usermoduleaccess/add', 'denr\app\UserModuleAccessController@AddUserModuleAccess')->name('post.user.module.access');


	// VIEW USER ACCESS FORM
	Route::get('/app/maintenance/useraccess/view', 'denr\app\UserAccessController@ShowUserAccess')->name('user.access');

	// AJAX USER ACCESS
	Route::get('/ajax-user-access', 'denr\app\UserAccessController@showAjaxUserAccess')->name('ajax.user.access');

	// POST USER ACCESS ADD FORM
	Route::post('/app/maintenance/useraccess/add', 'denr\app\UserAccessController@AddUserAccess')->name('post.user.access');

	// AJAX USER MODULE
	Route::get('/ajax-user-module', 'denr\app\UserAccessController@showAjaxUserModule')->name('ajax.user.module');








	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  DTS - ACTIVITY
	//
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	//VIEW INCOMING DOCUMENTS
	Route::get('/dts/activity/document/view/{id}', 'denr\dts\activity\DocumentTrackingController@Documents')->name('view.documents');

	//FILTER DOCUMENTS
	Route::get('/dts/activity/document/filter', 'denr\dts\activity\DocumentTrackingController@FilterDocuments')->name('filter.documents');

	//VIEW ADD DOCUMENTS
	Route::get('/dts/activity/document/add', 'denr\dts\activity\DocumentTrackingController@AddDocuments')->name('add.documents');

	//POST ADD DOCUMENTS
	Route::post('/dts/activity/document/add', 'denr\dts\activity\DocumentTrackingController@AddDocumentsPost')->name('post.add.documents');
	
	//VIEW EDIT DOCUMENT
	Route::get('/dts/activity/document/view/{id}/{id2}', 'denr\dts\activity\DocumentTrackingController@ViewDocuments')->name('view.edit.documents');

	//FORWARD TAB DOCUMENT
	Route::post('/dts/activity/document/forward', 'denr\dts\activity\DocumentTrackingController@viewTheForward')->name('forward.document');

	//FORWARDED DOCUMENTS
	Route::get('/dts/activity/forwarddocument/view', 'denr\dts\activity\DocumentTrackingController@ForwardedDocuments')->name('forwarded.documents');

	//RECEIVED DOCUMENTS
	Route::get('/dts/activity/receivedocument/view', 'denr\dts\activity\DocumentTrackingController@ReceivedDocuments')->name('received.documents');

	//GET DOC NO
	Route::get('/ajax-get-doc-no', 'denr\dts\activity\DocumentTrackingController@ajaxDocNo')->name('ajax.get.doc.no');

	//VIEW HISTORY MODAL
	Route::get('/ajax-history', 'denr\dts\activity\DocumentTrackingController@HistoryLogsAjax')->name('ajax.history.logs');

	//VIEW FORWRDED ATTACHMENT MODAL
	Route::get('/ajax-forwarded-attachment', 'denr\dts\activity\DocumentTrackingController@AttachmentAjax')->name('ajax.forwarded.attachment');

	//VIEW LOG ATTACHMENT MODAL
	Route::get('/ajax-log-attachment', 'denr\dts\activity\DocumentTrackingController@LogAttachmentAjax')->name('ajax.log.attachment');

	//DOWNLOAD ATTACHEMENT
	Route::get('/dts/activity/document/download/{id}/{id2}/{id3}', 'denr\dts\activity\DocumentTrackingController@DownloadAttachment')->name('download.attachment');
	
	//PREVIEW ATTACHEMENT
	Route::get('/dts/activity/document/preview/{id}/{id2}/{id3}/{id4}', 'denr\dts\activity\DocumentTrackingController@PreviewAttachment')->name('preview.attachment');
	
	//SEEN LOG
	Route::post('/dts/activity/document/seen', 'denr\dts\activity\DocumentTrackingController@SeenLog')->name('seen.log');
	
	//VIEW PRINT DOCUMENT SLIP
	Route::get('/dts/activity/document/print/{id}', 'denr\dts\activity\DocumentTrackingController@PrintDocumentSlip')->name('print.document.slip');

	//POST COMPLETE DOCUMENT
	Route::post('/dts/activity/document/complete', 'denr\dts\activity\DocumentTrackingController@DocumentComplete')->name('post.complete.document');
	
	//POST SIGN DOCUMENT
	Route::post('/dts/activity/document/sign', 'denr\dts\activity\DocumentTrackingController@DocumentSign')->name('post.sign.document');
	
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  DTS - MAINTENANCE
	//
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW DOC TYPE LIST
	Route::get('/dts/maintenance/documenttype/view', 'denr\dts\maintenance\DocumentTypeController@ShowDocTypeList')->name('doc.type.list');

	// VIEW DOC TYPE ADD FORM
	Route::get('/dts/maintenance/documenttype/add', 'denr\dts\maintenance\DocumentTypeController@ShowDocTypeForm')->name('doc.type.form');

	// POST DOC TYPE ADD FORM 
	Route::post('/dts/maintenance/documenttype/add', 'denr\dts\maintenance\DocumentTypeController@AddDocType')->name('add.doc.type.submit');

	// VIEW DOC TYPE FORM 
	Route::get('/dts/maintenance/documenttype/edit/{id}', 'denr\dts\maintenance\DocumentTypeController@ViewDocType')->name('view.doc.type');

	// POST DOC TYPE EDIT FORM 
	Route::post('/dts/maintenance/documenttype/edit', 'denr\dts\maintenance\DocumentTypeController@EditDocType')->name('edit.doc.type.submit');

	// POST DOC TYPE DELTE FORM 
	Route::post('/dts/maintenance/documenttype/delete', 'denr\dts\maintenance\DocumentTypeController@DeleteDocType')->name('delete.doc.type.submit');

	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//
	//  DTS - REPORT
	//
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	//VIEW DOCUMENT REPORT 
	Route::get('/dts/report/document/print', 'denr\dts\report\DocumentReportController@DocumentReport')->name('document.report');

	//POST DOCUMENT REPORT 
	Route::post('/dts/report/document/print', 'denr\dts\report\DocumentReportController@DocumentReportResult')->name('document.report.result');

});