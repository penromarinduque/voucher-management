<?php

/*
|--------------------------------------------------------------------------
| PIS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'],function() {

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

});