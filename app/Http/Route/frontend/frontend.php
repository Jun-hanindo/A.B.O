<?php

Route::group(['namespace' => 'Frontend'], function () {

    Route::get('admin', function () {
        return redirect('admin/login');
    });
    // Route::get('index', array('as' => 'home', 'uses' => 'HomeController@index'));
    //Route::get('event', array('as' => 'event', 'uses' => 'HomeController@event'));
    //Route::get('event-seated', array('as' => 'event-seated', 'uses' => 'HomeController@eventSeated'));
    //Route::get('faq', array('as' => 'support-faq', 'uses' => 'HomeController@supportFaq'));
    //Route::get('search-result', array('as' => 'search-result', 'uses' => 'HomeController@searchResult'));
    // Route::get('application', array('as' => 'front-form-application', 'uses' => 'ApplicationController@applicationForm'));
    //Route::get('event-discover', array('as' => 'event-discover', 'uses' => 'EventsController@eventDiscover'));
    //
    /*Static*/    
    //Route::get('index', array('as' => 'home', 'uses' => 'HomeController@index'));
    // Route::get('/', array('as' => 'landing', 'uses' => 'HomeController@landing'));
    // Route::get('bryan-adams', array('as' => 'bryan-adams', 'uses' => 'HomeController@bryamAdams'));
    // Route::get('/', array('as' => 'home', 'uses' => 'HomeController@landing'));
    // Route::get('index', array('as' => 'index', 'uses' => 'HomeController@index'));
    
    //comment 161013
    // Route::get('static', array('as' => 'static', 'uses' => 'HomeController@indexStatic'));
    // Route::get('static/bryan-adams', array('as' => 'bryan-adams', 'uses' => 'HomeController@bryanAdams'));
    // Route::get('static/jessica-jung-singapore', array('as' => 'jessica-jung-singapore', 'uses' => 'HomeController@jessicaJungSingapore'));
    // Route::get('static/jessica-jung-hochiminh', array('as' => 'jessica-jung-hochiminh', 'uses' => 'HomeController@jessicaJungHochiminh'));
    // Route::get('static/jessica-jung-manila', array('as' => 'jessica-jung-manila', 'uses' => 'HomeController@jessicaJungManila'));
    //
    
    Route::get('support', array('as' => 'support', 'uses' => 'HomeController@supportStatic'));
    Route::get('faq', array('as' => 'faq', 'uses' => 'HomeController@supportFaqStatic'));
    Route::get('faq/{category}', array('as' => 'faq-category', 'uses' => 'HomeController@supportFaqCategoryStatic'));
    Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'HomeController@contactUsStatic'));
    Route::get('terms-of-ticket-sales', array('as' => 'terms-ticket-sales', 'uses' => 'HomeController@supportTermsTicketSalesStatic'));
    Route::get('terms-of-website-use', array('as' => 'terms-website-use', 'uses' => 'HomeController@supportTermsWebsiteUseStatic'));
    Route::get('privacy-policy', array('as' => 'privacy-policy', 'uses' => 'HomeController@supportPrivacyPolicyStatic'));
    
    /*Dynamic*/
    //comment 161013
    //Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
    //

    Route::get('discover', array('as' => 'discover', 'uses' => 'HomeController@discover'));
    Route::get('promotion', array('as' => 'promotion', 'uses' => 'HomeController@promotion'));
    Route::get('our-company/careers', array('as' => 'our-company-careers', 'uses' => 'HomeController@ourCompanyCareers'));
    Route::get('our-company/contact-us', array('as' => 'our-company-contact-us', 'uses' => 'HomeController@ourCompanyContactUs'));
    Route::get('our-company/about-us', array('as' => 'our-company-about-us', 'uses' => 'HomeController@ourCompanyAboutUs'));
    Route::get('support/ways-to-buy-tickets', array('as' => 'support-way-to-buy-tickets', 'uses' => 'HomeController@supportWaysToBuyTickets'));
    Route::get('support/faq', array('as' => 'support-faq', 'uses' => 'HomeController@supportFaq'));
    Route::get('support/contact-us', array('as' => 'support-contact-us', 'uses' => 'HomeController@ourCompanyContactUs'));
    Route::get('support/terms-and-conditions', array('as' => 'support-terms-and-conditions', 'uses' => 'HomeController@supportTermsAndConditions'));
    Route::get('support/privacy-policy', array('as' => 'support-privacy-policy', 'uses' => 'HomeController@supportPrivacyPolicy'));
    Route::get('supports', array('as' => 'supports', 'uses' => 'HomeController@supports'));
    Route::get('subscribe', array('as' => 'subscribe', 'uses' => 'HomeController@subscribeUs'));
    Route::post('subscribe-store', array('as' => 'subscribe-store', 'uses' => 'HomeController@subscribeUsStore'));
    Route::post('subscribe-event-store', array('as' => 'subscribe-event-store', 'uses' => 'EventsController@subscribeEventStore'));
    Route::get('category/{slug}', array('as' => 'category-detail', 'uses' => 'CategoriesController@index'));
    Route::get('promotion/{slug}', array('as' => 'promotion-detail', 'uses' => 'PromotionsController@index'));
    Route::get('search/result', array('as' => 'event-search-get', 'uses' => 'EventsController@searchResult'));
    Route::get('search', array('as' => 'event-search', 'uses' => 'EventsController@search'));
    Route::post('send-message', array('as' => 'send-message', 'uses' => 'HomeController@sendMessage'));
    Route::post('send-feedback', array('as' => 'send-feedback', 'uses' => 'HomeController@feedBack'));
    Route::get('language', array('as' => 'language', 'uses' => 'LanguagesController@setLanguage'));
    
    Route::get('preview', array('as' => 'preview-event', 'uses' => 'EventsController@preview'));
    Route::post('getpost', array('as' => 'getpost-event', 'uses' => 'EventsController@getPost'));

    //comment 161013
    //Route::get('{slug}', array('as' => 'event-detail', 'uses' => 'EventsController@index'));
    //
    

    //uncomment 161013
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@indexStatic'));
    Route::get('bryan-adams', array('as' => 'bryan-adams', 'uses' => 'HomeController@bryanAdams'));
    Route::get('jessica-jung-singapore', array('as' => 'jessica-jung-singapore', 'uses' => 'HomeController@jessicaJungSingapore'));
    Route::get('jessica-jung-hochiminh', array('as' => 'jessica-jung-hochiminh', 'uses' => 'HomeController@jessicaJungHochiminh'));
    Route::get('jessica-jung-manila', array('as' => 'jessica-jung-manila', 'uses' => 'HomeController@jessicaJungManila'));
    Route::get('dynamic', array('as' => 'dynamic', 'uses' => 'HomeController@index'));
    Route::get('event/{slug}', array('as' => 'event-detail', 'uses' => 'EventsController@index'));
    //

    
});
