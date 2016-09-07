<?php

$router->get('/', function () {
    return redirect('login');
});

Auth::routes();

$router->get('/dashboard', 'DashboardController@index')->name('dashboard');

$router->group(['as' => 'patients.'], function ($router) {
    $router->get('reports/download/{report}', 'ReportsController@download')->name('reports.download');
    $router->get('reports/email/{report}', 'ReportsController@email')->name('reports.email');
    $router->resource('reports', 'ReportsController', ['only' => [
        'index', 'show',
    ]]);
});

$router->group(['namespace' => 'Operator', 'prefix' => 'operator', 'middleware' => ['auth', 'CheckRole']], function ($router) {
    $router->get('/dashboard', 'DashboardController@index')->name('operator.dashboard');
    $router->get('patients/send-passcode/{patient}', 'PatientsController@sendPasscode')->name('patients.sendpasscode');
    $router->resource('patients', 'PatientsController', ['except' => [
        'edit',
    ]]);
    $router->resource('tests', 'TestsController', ['only' => [
        'update', 'destroy', 'store'
    ]]);
    $router->resource('reports', 'ReportsController');
});
