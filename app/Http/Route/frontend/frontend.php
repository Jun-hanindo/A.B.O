<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
    Route::get('discover', array('as' => 'discover', 'uses' => 'HomeController@discover'));
    Route::get('event', array('as' => 'event', 'uses' => 'HomeController@event'));
    Route::get('promotion', array('as' => 'promotion', 'uses' => 'HomeController@promotion'));
    Route::get('event-seated', array('as' => 'event-seated', 'uses' => 'HomeController@eventSeated'));
    Route::get('careers', array('as' => 'careers', 'uses' => 'HomeController@careers'));
    Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'HomeController@contactUs'));
    Route::get('our-company', array('as' => 'our-company', 'uses' => 'HomeController@ourCompany'));
    Route::get('support-faq', array('as' => 'support-faq', 'uses' => 'HomeController@supportFaq'));
    Route::get('search-result', array('as' => 'search-result', 'uses' => 'HomeController@searchResult'));
    // Route::get('application', array('as' => 'front-form-application', 'uses' => 'ApplicationController@applicationForm'));
});
