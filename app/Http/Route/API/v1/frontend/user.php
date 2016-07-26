<?php

Route::group(['prefix' => 'API/v1/user','namespace' => 'API\v1','middleware'=>'JwtCheck'], function () {
    
    Route::get('{user_id}', array('as' => 'get-user-api', 'uses' => 'UsersController@getUserData'));
    Route::post('{user_id}/update', array('as' => 'update-user-api', 'uses' => 'UsersController@updateProfile'));
    Route::get('list/follow', array('as' => 'user-list-follow-api', 'uses' => 'UsersController@listFollow'));
    Route::post('change/password', array('as' => 'change-password-user-api', 'uses' => 'UsersController@changePassword'));
    Route::post('change/picture', array('as' => 'update-picture-user-api', 'uses' => 'UsersController@updatePicture'));

    Route::post('follow/user', array('as' => 'follow-user-api', 'uses' => 'UsersController@apiPostFollowers'));
    Route::post('countries/combo', array('as' => 'combo-countries-api', 'uses' => 'UsersController@apiComboCountry'));

    

});