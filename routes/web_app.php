<?php

/*
|--------------------------------------------------------------------------
| APP Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'],function() {

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

});