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
    Route::get('support-way-to-buy-tickets', array('as' => 'support-way-to-buy-tickets', 'uses' => 'HomeController@supportWayToBuyTickets'));
    Route::get('search-result', array('as' => 'search-result', 'uses' => 'HomeController@searchResult'));
    // Route::get('application', array('as' => 'front-form-application', 'uses' => 'ApplicationController@applicationForm'));
    // 
    Route::get('event/{slug}', array('as' => 'event-detail', 'uses' => 'EventsController@index'));
    //Route::get('event-discover', array('as' => 'event-discover', 'uses' => 'EventsController@eventDiscover'));
    Route::get('category/{slug}', array('as' => 'category-detail', 'uses' => 'CategoriesController@index'));
    Route::get('promotion/{slug}', array('as' => 'promotion-detail', 'uses' => 'PromotionsController@index'));
    Route::get('search/result', array('as' => 'event-search-get', 'uses' => 'EventsController@searchResult'));
    Route::get('search', array('as' => 'event-search', 'uses' => 'EventsController@search'));
});
