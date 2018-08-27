<?php

Route::group(array('prefix' => 'reviewer', 'middleware' => 'reviewer'), function() {
    Route::get('/monitor-session', 'reviewer\SessionController@monitorSession');
    Route::get('/show-session', 'reviewer\SessionController@showSession');
     Route::get('/set-device-parameter', 'reviewer\SessionController@setDeviceParameter');
});