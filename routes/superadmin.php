
<?php

Route::group(array('middleware' => ['web', 'superadmin']), function() {
//Superadmin customer controller routes
    Route::match(['get', 'post'], '/customer/add', 'superadmin\CustomerController@add');
    Route::get('/customers', 'superadmin\CustomerController@customerListing');
    Route::post('/approved-customer-datatable', 'superadmin\CustomerController@customerDatatable');
    Route::match(['get', 'post'], '/customer/change-password/{id}', 'superadmin\CustomerController@changePassword');
    Route::get('/customer/view/{id}', 'superadmin\CustomerController@viewCustomer');
    Route::match(['get', 'post'], '/customer/edit/{id}', 'superadmin\CustomerController@editCustomer');
    Route::get('/deactivate-customer', 'superadmin\CustomerController@deactivateCustomer');

//Superadmin add superadmin controller routes
    Route::match(['get', 'post'], '/vadi-admin/add', 'superadmin\SettingController@addSuperadmin');
    Route::match(['get', 'post'], '/vadi-admin/edit/{id}', 'superadmin\SettingController@addSuperadmin');
    Route::get('/vadi-admin/view', 'superadmin\SettingController@superadminListing');
    Route::post('/superadminDatatables', 'superadmin\SettingController@superadminDatatable');
    Route::post('/change-status', 'AjaxController@changeUserStatus');
//Superadmin add plan pricing controller routes
    Route::match(['get', 'post'], 'package/add', 'superadmin\PricingController@add');
    Route::get('packages', 'superadmin\PricingController@packages');
    Route::match(['get', 'post'], 'package/edit/{id}/{slug}', 'superadmin\PricingController@add');
//account requests
    Route::get('account-request', 'superadmin\CustomerController@accountRequest');
    Route::post('account-request-datatable', 'superadmin\CustomerController@accountRequestDatatable');
    //approve customer
    Route::post('approve-customer', 'superadmin\CustomerController@approveCustomer');
    Route::post('delete-customer', 'superadmin\CustomerController@deleteCustomer');
    //masquerade the customer by superadmin
    Route::post('masquerade-customer', 'CommonController@masqueradeCustomer');
});

