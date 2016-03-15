<?php

Route::get('/', function () {
    return redirect('/system/UserRegister');
});

Route::get('/home', function () {
    return redirect('/system/UserRegister');
});

Route::get('/getstoken', function () {
	return csrf_token();
});

Route::get('/admin/EditUserPribadi/{nrp}', function ($nrp) {
	return $nrp;
});

Route::get('/system/UserRegister', 'System\SystemController@GetUserRegister');
Route::post('/system/UserRegister', 'System\SystemController@postUserRegister');
Route::post('/system/UserRegisterFile', 'System\SystemController@postUserRegisterFile');

Route::get('/system/UserFamily', 'System\SystemController@GetUserFamily');
Route::post('/system/UserFamily', 'System\SystemController@PostUserFamily');
Route::post('/system/UserFamilyFile', 'System\SystemController@PostUserFamilyFile');

Route::post('/system/UserFamilyCheck', 'System\SystemController@GetUserFamilyCheck');

Route::get('/system/UserRegisterCheck/{code}', 'System\SystemController@GetUserRegisterCheck');
Route::post('/system/test', 'System\SystemController@TEST');

Route::get('/resources/csv/{code}', 'System\ResourceController@GetCSV');


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'System\AuthenticationController@PostAccountRegister');

Route::get('auth/password', 'System\AuthenticationController@GetPassword');
Route::post('auth/password', 'System\AuthenticationController@PostPassword');

Route::get('auth/confirm/{token}', 'System\AuthenticationController@GetConfirm');
Route::post('auth/confirm', 'System\AuthenticationController@PostConfirm');

Route::get('admin/UserDetail/{nip}', 'Admin\AdminController@GetUserDetail');
Route::post('admin/UserDetail', 'Admin\AdminController@PostUserDetail');
Route::post('admin/UserDetailFamily', 'Admin\AdminController@PostUserDetailFamily');
Route::get('admin/UserErase/{nip}', 'Admin\AdminController@GetUserErase');
Route::post('admin/UserErase', 'Admin\AdminController@PostUserErase');

Route::get('ajax/ContentDivision/{kode_jabatan}', 'System\SystemController@GetContentDivision');
Route::get('ajax/ContentCity/{kode_provinsi}', 'System\SystemController@GetContentCity');

Route::get('admin/UserList', 'Admin\AdminController@GetUserlist');

//New routes
Route::get('admin/ReportIncident', 'Admin\AdminController@GetReportIncident');
Route::post('admin/ReportIncident', 'Admin\AdminController@PostReportIncident');
route::get('admin/ReportIncidentUser/{nip}', 'Admin\AdminController@GetReportIncidentUser');
