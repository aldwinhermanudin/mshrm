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

//exceptional
Route::post('/system/EmployeeCheck', 'System\SystemController@PostEmployeeCheck');

//Account operations inside the application
Route::get('/system/AccountRegister', 'System\SystemController@GetAccountRegister');
Route::post('/system/AccountRegister', 'System\SystemController@PostAccountRegister');
Route::get('/system/AccountEdit', 'System\SystemController@GetAccountEdit');
Route::post('/system/AccountEdit', 'System\SystemController@PostAccountEdit');
Route::get('/system/AccountDetail/{nip}', 'System\SystemController@GetAccountDetail');
Route::post('/system/AccountDelete', 'System\SystemController@PostAccountDelete');
//Route::post('/system/AccountDetail', 'System\SystemController@PostAccountDetail');

Route::get('/system/SystemNotification', 'System\SystemController@GetSystemNotification');

//new registration routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'System\AuthenticationController@GetRegister');
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
Route::get('admin/RequestBreak/{id}', 'Admin\AdminController@GetRequestBreakDetail');
Route::get('admin/ExportDetail', 'Admin\AdminController@GetExportDetail');

Route::get('ajax/ContentDivision/{kode_jabatan}', 'System\SystemController@GetContentDivision');
Route::get('ajax/ContentCity/{kode_provinsi}', 'System\SystemController@GetContentCity');

Route::get('admin/EmployeeList', 'Admin\AdminController@GetEmployeeList');

//New routes
Route::get('admin/ReportIncident', 'Admin\AdminController@GetReportIncident');
Route::post('admin/ReportIncident', 'Admin\AdminController@PostReportIncident');
Route::get('admin/ReportIncidentUser/{nip}', 'Admin\AdminController@GetReportIncidentUser');

//Report performance
Route::get('admin/ReportPerformance', 'Admin\AdminController@GetReportPerformance');
Route::post('admin/ReportPerformance', 'Admin\AdminController@PostReportPerformance');

//Request break
Route::get('admin/RequestBreak', 'Admin\AdminController@GetRequestBreak');
Route::post('admin/RequestBreak', 'Admin\AdminController@PostRequestBreak');
Route::post('admin/ProcessBreak', 'Admin\AdminController@PostProcessBreak');

//Item delete
Route::post('admin/ItemDelete', 'Admin\AdminController@PostItemDelete');

//attendance routes
Route::get('admin/EmployeeAttendance', 'Admin\AdminController@GetEmployeeAttendance');
Route::post('admin/EmployeeAttendance', 'Admin\AdminController@PostEmployeeAttendance');

//Export routes
Route::get('resources/export/xlsx/EmployeeList', 'System\ResourceController@GetEmployeeListXLSX');
Route::get('resources/export/pdf/EmployeeList', 'System\ResourceController@GetEmployeeListPDF');

Route::get('resources/export/xlsx/AccountList', 'System\ResourceController@GetAccountListXLSX');
Route::get('resources/export/pdf/AccountList', 'System\ResourceController@GetAccountListPDF');

Route::get('resources/export/xlsx/IncidentList', 'System\ResourceController@GetIncidentListXLSX');
Route::get('resources/export/pdf/IncidentList', 'System\ResourceController@GetIncidentListPDF');

Route::get('resources/export/xlsx/BreakList', 'System\ResourceController@GetBreakListXLSX');
Route::get('resources/export/pdf/BreakList', 'System\ResourceController@GetBreakListPDF');

//APP ROUTES
Route::post('app/setting/lang', 'General\AppController@PostSettingLang');
