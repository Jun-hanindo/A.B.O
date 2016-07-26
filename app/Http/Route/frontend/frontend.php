<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
    Route::get('discover', array('as' => 'discover', 'uses' => 'HomeController@discover'));
    Route::get('event', array('as' => 'event', 'uses' => 'HomeController@event'));
    Route::get('promotion', array('as' => 'promotion', 'uses' => 'HomeController@promotion'));
    Route::get('event-seated', array('as' => 'event-seated', 'uses' => 'HomeController@eventSeated'));
    // Route::get('application', array('as' => 'front-form-application', 'uses' => 'ApplicationController@applicationForm'));
});
