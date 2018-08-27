<?php

Route::group(array('prefix' => 'group-manager', 'middleware' => 'groupManager'), function() {

    //DemographicController routes
    // traits 
    Route::get('/get-session-by-project/{project}', 'AjaxController@getSessionByProject');

    Route::get('/get-company-participants', 'AjaxController@getCompanyParticipants');

    Route::group(array('prefix' => 'trait'), function () {
        Route::get('/templates', 'groupManager\DemographicController@templates');
        Route::match(['get', 'post'], '/template/create', 'groupManager\DemographicController@createTemplate');
        Route::get('', 'groupManager\DemographicController@index');
        Route::post('/makeSessionTemplateGrid', 'groupManager\DemographicController@makeSessionTemplateGrid');
        Route::post('/save', 'groupManager\DemographicController@save');
    });

    // UserManagementController routes
    // groups routes
    Route::post('/change-group-status', 'AjaxController@changeGroupStatus');
    Route::group(['prefix' => 'group'], function() {
        Route::match(['get', 'post'], '/add', 'groupManager\UserManagementController@addGroup');
        Route::match(['get', 'post'], '/edit/{group}', 'groupManager\UserManagementController@addGroup');
        Route::get('/list', 'groupManager\UserManagementController@groups');
        Route::post('/datatable', 'groupManager\UserManagementController@groupDatatable');
        Route::get('/hierarchy/{group}', 'groupManager\UserManagementController@groupHierarchy');
        Route::get('/get-group-users/{group}', 'groupManager\UserManagementController@getGroupUser');
    });


    //Project controller routes
    //project
    Route::group(['prefix' => 'project'], function() {

        Route::get('/project-types', 'groupManager\ProjectController@Types');
        Route::post('/project-type-datatable', 'groupManager\ProjectController@typeDatatables');
        Route::match(['get', 'post'], '/project-type/add', 'groupManager\ProjectController@addType');
        Route::match(['get', 'post'], '/project-type/edit/{projectTypeData}', 'groupManager\ProjectController@addType');
         Route::post('/change-project-type-status', 'groupManager\ProjectController@changeProjectTypeStatus');
        Route::get('/list', 'groupManager\ProjectController@lists');
        Route::match(['get', 'post'], '/add', 'groupManager\ProjectController@add');
        Route::match(['get', 'post'], '/edit/{project}', 'groupManager\ProjectController@add');
        Route::post('/project-datatable', 'groupManager\ProjectController@projectDatatable');
        Route::match(['get', 'post'], '/copy/{project}', 'groupManager\ProjectController@copy');
        Route::get('/templates', 'groupManager\ProjectController@templates');
        Route::post('/templates/datatable', 'groupManager\ProjectController@templateDatatable');
        Route::match(['get', 'post'], '/template/create', 'groupManager\ProjectController@createTemplate');
        Route::match(['get', 'post'], '/template/edit/{projectTemplate}', 'groupManager\ProjectController@createTemplate');
        Route::match(['get', 'post'], '/template/use/{projectTemplate}/{type}', 'groupManager\ProjectController@createTemplate');
        Route::post('/delete-template/{projectTemplate}', 'groupManager\ProjectController@deleteTemplate');
        Route::get('/request-deliverable', 'groupManager\ProjectController@requestDeliverables');
        Route::get('/audit-trail', 'groupManager\ProjectController@auditTrail');
    });


    //Session Controller routes
    Route::group(array('prefix' => 'session'), function() {
        Route::get('/list', 'groupManager\SessionController@index');
        Route::post('/datatable', 'groupManager\SessionController@datatable');
        Route::match(['get', 'post'], '/create', 'groupManager\SessionController@create');
        Route::match(['get', 'post'], '/edit/{session}', 'groupManager\SessionController@create');
        Route::match(['get', 'post'], '/participants/{session}', 'groupManager\SessionController@participants');
        Route::match(['get', 'post'], '/copy/{session}/{type}', 'groupManager\SessionController@create');
        Route::get('/show-session', 'groupManager\SessionController@showSession');
        Route::get('/define-devices', 'groupManager\SessionController@defineDevices');
        Route::get('/create-quick-session', 'groupManager\SessionController@createQuickSession');
        Route::get('/recording-monitor', 'groupManager\SessionController@recordingMonitor');
        Route::get('/participant-list', 'groupManager\SessionController@ParticipantList');
        Route::get('/set-parameter-device', 'groupManager\SessionController@setParameterDevice');
        //Lists routes
        Route::post('/change-session-list', 'AjaxController@changeSessionList');
        Route::group(['prefix' => 'list'], function () {
            Route::get('/participants/{session?}', 'groupManager\ListController@sessionList');
            Route::get('/participant/{list}/{session}', 'groupManager\ListController@participants');
            Route::post('/save', 'AjaxController@saveList');
            Route::post('/add-list-participant', 'AjaxController@addListParticipant');
            Route::post('/add-exiting-participant', 'AjaxController@addExistingUserToList');
            Route::get('/get-list/{list}', 'AjaxController@getList');
            Route::post('/delete-list-user', 'AjaxController@deleteListParticipant');
	    Route::post('/import', 'AjaxController@import');
	    Route::post('/save-participant-data', 'AjaxController@saveParticipantData');                                                                                                 
        });
    });
    //assets routes
    Route::group(['prefix' => 'asset'], function() {
        Route::get('/import', 'groupManager\AssetController@import');
        Route::post('/save', 'AjaxController@saveProjectAsset');
    });



    //Product Controller
    //product

    Route::get('/products', 'groupManager\ProductController@manageProduct');
    Route::match(['get', 'post'], '/product/add', 'groupManager\ProductController@add');
    Route::match(['get', 'post'], '/product/edit/{product}', 'groupManager\ProductController@add');
    Route::post('/product-datatable', 'groupManager\ProductController@productDtatable');
    Route::post('/change-product-status', 'AjaxController@changeProductStatus');
    Route::match(['get', 'post'], '/product/import', 'groupManager\ProductController@import');

    //Asset Controlleroller
    Route::match(['get', 'match'], '/framing-guide', 'groupManager\AssetController@framingGuide');
    Route::post('/upload-file', 'groupManager\AssetController@uploadAsset');
    Route::post('/framing-guide-datatable', 'groupManager\AssetController@framinGuideDtatable');
    Route::post('/change-framing-guide-status', 'AjaxController@changeframingGuideStatus');
});
