<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LoginController@toLogin');

Route::get('/', 'LoginController@toLogin');
Route::get('/exit', 'LoginController@toExit');
Route::post('/service/login', 'LoginController@login');

Route::group(['prefix' => 'manager'], function () {
    Route::group(['middleware' => 'check.Manager.login'], function () {
        Route::get('/welcome', 'Manager\IndexController@toWelcome');
        Route::get('/index', 'Manager\IndexController@toIndex');
        Route::get('/account_manage', 'Manager\AccountController@toList');
        Route::get('/update_password', 'Manager\AccountController@toUpdate');
        Route::get('/account_add', 'Manager\AccountController@toAdd');
        Route::post('/account_add', 'Manager\AccountController@add');
        Route::post('/account/edit', 'Manager\AccountController@edit');
        Route::get('/delete_account', 'Manager\AccountController@delete');
        Route::get('/statistics_crm', 'Manager\StatisticsController@toCRM');
        Route::get('/statistics_project', 'Manager\StatisticsController@toProject');
        Route::get('/statistics', 'Manager\StatisticsController@toIndex');
        Route::post('/delete_customer_log', 'Manager\CustomerController@deleteLog');
        Route::post('/delete_project_log', 'Manager\ProjectController@deleteLog');
    });

    Route::group(['middleware' => 'check.Admin.login'], function () {
        Route::get('/customer_list', 'Manager\CustomerController@toList');
        Route::get('/customer_content', 'Manager\CustomerController@toItemContent');
        Route::get('/project_list', 'Manager\ProjectController@toList');
        Route::get('/project_edit', 'Manager\ProjectController@toEdit');
        Route::get('/project/add', 'Manager\ProjectController@toAdd');
        Route::get('/customer_add_log', 'Manager\CustomerController@toAddLog');
        Route::post('/customer_log_add', 'Manager\CustomerController@addLog');
        Route::post('/customer_add', 'Manager\CustomerController@addCustomer');
        Route::post('/project/add', 'Manager\ProjectController@addProject');
        Route::post('/project/edit', 'Manager\ProjectController@edit');
        Route::post('/customer/edit', 'Manager\CustomerController@edit');
        Route::post('/project_log_add', 'Manager\ProjectController@addLog');
        Route::post('/project_stage_edit', 'Manager\ProjectController@projectStageEdit');
        Route::post('/project_quote_edit', 'Manager\ProjectController@porjectQuoteEdit');
        Route::post('/project_ownclound_edit','Manager\ProjectController@projectOwncloundEdit');
        Route::post('/project_log_quote_add', 'Manager\ProjectController@addQuoteLog');
        Route::get('/customers_query', 'Manager\CustomerController@query');
        Route::get('/customer_add', 'Manager\CustomerController@toAdd');
        Route::get('/project_stage', 'Manager\ProjectController@toStage');
        Route::get('/project_add_log', 'Manager\ProjectController@toAddLog');
        Route::get('/project_add_quote_log', 'Manager\ProjectController@toAddQuoteLog');
        Route::get('/project_daily_report_log','Manager\ProjectController@toAddDailyLog');
        Route::get('/project_stage_pic_log','Manager\ProjectController@toAddStagePicLog');
        Route::get('/project_add_designer_log', 'Manager\ProjectController@toAddDesignerLog');
        Route::get('/export_excel_all_customers', 'Manager\CustomerController@exportAllCustomers');
        Route::get('/export_excel_all_projects', 'Manager\ProjectController@exportAllProjects');
        Route::get('/export_excel_projects_statistics', 'Manager\ProjectController@exportProjectSta');
        Route::get('/export_excel_customer_statistics', 'Manager\CustomerController@exportCustomerSta');
        Route::get('/project_quote', 'Manager\ProjectController@toQuote');
        Route::get('/project_designer', 'Manager\ProjectController@toDesigner');
        Route::get('/project_construction','Manager\ProjectController@toConstruction');
        Route::get('/project_detail', 'Manager\ProjectController@toEdit');
        Route::get('/edit_project_log', 'Manager\ProjectController@toLogEdit');
        Route::get('/edit_customer_log', 'Manager\CustomerController@toLogEdit');
        Route::post('/edit_project_log', 'Manager\ProjectController@logEdit');
        Route::post('/edit_customer_log','Manager\CustomerController@logEdit');

    });
});

Route::group(['prefix' => 'pm'], function () {
    Route::group(['middleware' => 'check.Admin.login'], function () {
        Route::get('/index', 'PM\IndexController@toIndex');
        Route::get('/project_list', 'PM\ProjectController@toList');
        Route::get('/welcome', 'Manager\IndexController@toWelcome');
        Route::get('/account_manage', 'PM\AccountController@manage');
    });
});

Route::group(['prefix' => 'saler'], function () {
    Route::group(['middleware' => 'check.Admin.login'], function () {
        Route::get('/welcome', 'Manager\IndexController@toWelcome');
        Route::get('/index', 'Saler\IndexController@toIndex');
        Route::get('/customer_list', 'Saler\CustomerController@toList');
        Route::get('/project_list', 'Saler\ProjectController@toList');
        Route::get('/account_manage', 'Saler\AccountController@toIndex');
        Route::post('/account/edit', 'Saler\AccountController@edit');

    });
});

Route::group(['prefix' => 'designer'], function () {
    Route::group(['middleware' => 'check.Admin.login'], function () {
        Route::get('/welcome', 'Manager\IndexController@toWelcome');
        Route::get('/index', 'Designer\IndexController@toIndex');
        Route::get('/project_list', 'Designer\ProjectController@toList');
//        project_list
    });
});

Route::get('excel/export', 'ExcelController@export');