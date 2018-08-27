<?php

Route::group(array('prefix' => 'analyst', 'middleware' => 'analyst'), function() {
    // Project Controller routes
   Route::group(['prefix' => 'project'], function() {
    Route::get('/list', 'analyst\ProjectController@lists');   
    Route::post('/project-datatable', 'analyst\ProjectController@projectDatatable');
    
  });


    //Session Controller routes
    Route::group(array('prefix' => 'session'), function () {
        Route::get('/list', 'analyst\SessionController@index');
        Route::post('/datatable', 'analyst\SessionController@datatable');
        Route::match(['get', 'post'], '/participants/{session}', 'analyst\SessionController@participants');
        Route::get('/define-devices', 'analyst\SessionController@defineDevices');
        Route::get('/recording-monitor', 'analyst\SessionController@recordingMonitor');
        Route::get('/set-parameter-device', 'analyst\SessionController@setParameterDevice');
      
        //Lists routes
        Route::group(['prefix' => 'list'], function () {
            Route::get('/participants/{session?}', 'analyst\ListController@sessionList');
            Route::get('/participant/{list}/{session}', 'analyst\ListController@participants');
           
        });
    });
});
