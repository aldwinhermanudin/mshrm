<?php

Route::get('/', function () {
    return redirect('/admin/EmployeeList');
});

Route::get('/home', function () {
    return redirect('/admin/EmployeeList');
});

Route::get('/getstoken', function () {
	return csrf_token();
});

Route::get('/admin/EditUserPribadi/{nrp}', function ($nrp) {
	return $nrp;
});

//deprecated
Route::get('/resources/csv/{code}', 'System\ResourceController@GetCSV');
//deprecated

//new registration routes
Route::get('/system/EmployeeRegister', 'System\SystemController@GetEmployeeRegister');
Route::post('/system/EmployeeRegister', 'System\SystemController@PostEmployeeRegister');
Route::post('/system/EmployeeRegisterFile', 'System\SystemController@PostEmployeeRegisterFile');
Route::post('/system/EmployeeCheck', 'System\SystemController@PostEmployeeCheck');
//new registration routes

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
Route::get('admin/UserDetailEdit/{nip}', 'Admin\AdminController@GetUserDetailEdit');
Route::post('admin/UserDetail', 'Admin\AdminController@PostUserDetail');
Route::get('admin/UserErase/{nip}', 'Admin\AdminController@GetUserErase');
Route::post('admin/UserErase', 'Admin\AdminController@PostUserErase');

Route::get('admin/IncidentDetail/{id}', 'Admin\AdminController@GetIncidentDetail');
Route::get('admin/PerformanceDetail/{id}', 'Admin\AdminController@GetPerformanceDetail');
Route::get('admin/ExportDetail', 'Admin\AdminController@GetExportDetail');

Route::get('ajax/ContentDivision/{kode_jabatan}', 'System\SystemController@GetContentDivision');
Route::get('ajax/ContentCity/{kode_provinsi}', 'System\SystemController@GetContentCity');

Route::get('admin/EmployeeList', 'Admin\AdminController@GetEmployeeList');

//New routes
Route::get('admin/ReportIncident', 'Admin\AdminController@GetReportIncident');
Route::post('admin/ReportIncident', 'Admin\AdminController@PostReportIncident');
Route::get('admin/ReportIncidentUser/{nip}', 'Admin\AdminController@GetReportIncidentUser');

//Super new routes
Route::get('admin/ReportPerformance', 'Admin\AdminController@GetReportPerformance');
Route::post('admin/ReportPerformance', 'Admin\AdminController@PostReportPerformance');

//Export routes
Route::get('resources/export/xlsx/EmployeeList', 'System\ResourceController@GetEmployeeListXLSX');
Route::get('resources/export/pdf/EmployeeList', 'System\ResourceController@GetEmployeeListPDF');
