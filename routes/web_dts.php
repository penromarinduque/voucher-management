<?php

/*
|--------------------------------------------------------------------------
| DTS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'],function() {

	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//  DTS - ACTIVITY
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	//INDEX
	Route::get('/dts/activity/document/index/{id}', 'denr\dts\activity\DocumentTrackingController@index')->name('dts.document.index');

	//PAGE
    Route::get('/dts/activity/document/page', 'denr\dts\activity\DocumentTrackingController@page')->name('dts.document.page');

    //SEARCH
    Route::get('/dts/activity/document/search', 'denr\dts\activity\DocumentTrackingController@search')->name('dts.document.search');

    //FILTER
	Route::get('/dts/activity/document/filter', 'denr\dts\activity\DocumentTrackingController@filter')->name('dts.document.filter');

	//CREATE-FORM
	Route::get('/dts/activity/document/create', 'denr\dts\activity\DocumentTrackingController@create')->name('dts.document.create');

	//CREATE-INSERT
	Route::post('/dts/activity/document/insert', 'denr\dts\activity\DocumentTrackingController@insert')->name('dts.document.insert');
	
	//UPDATE-FORM
	Route::get('/dts/activity/document/view/{id}/{id2}', 'denr\dts\activity\DocumentTrackingController@view')->name('dts.document.view');

	//FORWARD
	Route::post('/dts/activity/document/forward', 'denr\dts\activity\DocumentTrackingController@forward')->name('dts.document.forward');

	//COMPLETE
	Route::post('/dts/activity/document/complete', 'denr\dts\activity\DocumentTrackingController@complete')->name('dts.document.complete');

	//SEEN
	Route::post('/dts/activity/document/seen', 'denr\dts\activity\DocumentTrackingController@seen')->name('dts.document.seen');
	
	//DOWNLOAD ATTACHEMENT
	Route::get('/dts/activity/document/download/{id}/{id2}/{id3}', 'denr\dts\activity\DocumentTrackingController@download')->name('dts.document.download');
	
	//PREVIEW ATTACHEMENT
	Route::get('/dts/activity/document/preview/{id}/{id2}/{id3}/{id4}', 'denr\dts\activity\DocumentTrackingController@preview')->name('dts.document.preview');
	
	//PRINT SLIP
	Route::get('/dts/activity/document/print/{id}', 'denr\dts\activity\DocumentTrackingController@printSlip')->name('dts.document.print.slip');

	//PRINT SLIP-MANUAL
	Route::get('/dts/activity/document/manual/{id}', 'denr\dts\activity\DocumentTrackingController@printManual')->name('dts.document.print.manual');

	//SIGN
	Route::post('/dts/activity/document/sign', 'denr\dts\activity\DocumentTrackingController@sign')->name('dts.document.sign');
	

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// AJAX
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//GET DOC NO
	Route::get('/ajax-get-doc-no', 'denr\dts\activity\DocumentTrackingController@ajaxDocNo')->name('ajax.get.doc.no');

	//VIEW HISTORY MODAL
	Route::get('/ajax-history', 'denr\dts\activity\DocumentTrackingController@HistoryLogsAjax')->name('ajax.history.logs');

	//VIEW FORWRDED ATTACHMENT MODAL
	Route::get('/ajax-forwarded-attachment', 'denr\dts\activity\DocumentTrackingController@AttachmentAjax')->name('ajax.forwarded.attachment');

	//VIEW LOG ATTACHMENT MODAL
	Route::get('/ajax-log-attachment', 'denr\dts\activity\DocumentTrackingController@LogAttachmentAjax')->name('ajax.log.attachment');

	
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	// DTS - MAINTENANCE
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
	// DTS - REPORT
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	//VIEW DOCUMENT REPORT 
	Route::get('/dts/report/document/print', 'denr\dts\report\DocumentReportController@DocumentReport')->name('document.report');

	//POST DOCUMENT REPORT 
	Route::post('/dts/report/document/print', 'denr\dts\report\DocumentReportController@DocumentReportResult')->name('document.report.result');

});