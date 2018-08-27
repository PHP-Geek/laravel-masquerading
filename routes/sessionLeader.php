<?php

Route::group(array('prefix' => 'sessionLeader', 'middleware' => 'sessionLeader'), function() {
    Route::get('/show-session', 'sessionLeader\SessionController@showSession');
    Route::get('/create-session', 'sessionLeader\SessionController@createSession');
     Route::get('/copy-session', 'sessionLeader\SessionController@copySession');
     Route::get('/edit-session', 'sessionLeader\SessionController@editSession');
     Route::get('/participant-list', 'sessionLeader\SessionController@participantList');
     Route::get('/add-participant-list', 'sessionLeader\SessionController@addParticipant');
     Route::get('/define-device', 'sessionLeader\SessionController@defineDevice');
     Route::get('/set-parameter-device', 'sessionLeader\SessionController@setParameterDevice');
     Route::get('/create-phone-kit-participant', 'sessionLeader\SessionController@createPhoneKitParticipant');
});