<?php

Route::group(['prefix' => 'API/v1','namespace' => 'API\v1'], function () {
    
    Route::post('register', array('as' => 'register', 'uses' => 'AuthController@ApiUserSignUp'));
    Route::post('login', array('as' => 'login', 'uses' => 'AuthController@ApiLogin'));
    Route::get('reset/{email}', array('as' => 'reset-password-api', 'uses' => 'AuthController@ApiResetPassword'));

    

});