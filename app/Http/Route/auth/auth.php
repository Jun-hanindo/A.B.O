<?php

Route::group(['prefix' => 'auth','namespace' => 'Auth'], function () {
    Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@userSignUp'));
    Route::post('signup', array('as' => 'post-signup', 'uses' => 'AuthController@PostUserSignUp'));
    Route::post('login', array('as' => 'post-login', 'uses' => 'AuthController@PostUserLogin'));
    Route::get('activation-user/{id}/{code}', array('as' => 'activation-user', 'uses' => 'AuthController@activationUser'));
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@logoutUser'));
    Route::post('auth-social-media', array('as' => 'auth-social-media', 'uses' => 'AuthController@authSocialMedia'));
    Route::get('redirect/{provider}', array('as' => 'redirect-socialmedia', 'uses' => 'AuthController@redirectSocialMedia'));
    Route::get('callback-twitter', array('as' => 'callback-twitter', 'uses' => 'AuthController@callbackTwitter'));
    Route::post('submit-email', array('as' => 'submit-email', 'uses' => 'AuthController@submitEmail'));
    Route::post('reset-password', array('as' => 'reset-password', 'uses' => 'AuthController@resetPasswordUser'));
    Route::get('reset-password/{id}/{code}', array('as' => 'link-reset-password', 'uses' => 'AuthController@verifyResetPassword'));
    Route::post('change-password', array('as' => 'change-password', 'uses' => 'AuthController@changePasswordUser'));
});

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    Route::get('login', array('as' => 'admin-login', 'uses' => 'AuthController@getLogin'));
    Route::post('login', array('as' => 'admin-login', 'uses' => 'AuthController@postLogin'));
    Route::get('logout', array('as' => 'admin-logout', 'uses' => 'AuthController@getLogout'));

    Route::get('reset-password', array('as' => 'admin-reset-password', 'uses' => 'AuthController@getResetPassword'));
    Route::post('reset-password', array('as' => 'post-admin-reset-password', 'uses' => 'AuthController@postResetPassword'));
    Route::get('change-password', array('as' => 'admin-change-password', 'uses' => 'AuthController@getChangePassword'));
    Route::post('change-password', array('as' => 'post-admin-change-password', 'uses' => 'AuthController@postChangePassword'));
});
