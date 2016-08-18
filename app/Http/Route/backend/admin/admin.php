<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {

    Route::get('dashboard', array('as' => 'admin-dashboard', 'uses' => 'DashboardController@index'));
    Route::get('profile', array('as' => 'admin-profile', 'uses' => 'ProfileController@index'));
    Route::put('profile/{type}', array('as' => 'admin-profile-update', 'uses' => 'ProfileController@update'));


    Route::group(['prefix' => 'user-trustees','namespace' => 'UserTrustee'], function () {

        // Menu Management...
        Route::resource('menus', 'MenuController', ['except' => 'show']);
        Route::delete('menus/{id}/delete', 'MenuController@destroy');

        // Role Management...
        Route::resource('roles', 'RoleController', ['except' => 'show']);
        Route::delete('roles/{id}/delete', 'RoleController@delete');

        // User Trustee Management...
        Route::resource('users', 'UserController', ['except' => 'show']);
        Route::delete('users/{id}/delete', 'UserController@delete');

    });

    Route::group(['prefix' => 'master'], function () {

        //route Country
        Route::get('country', array('as' => 'admin-index-country', 'uses' => 'CountriesController@index'));
        Route::get('country/create', array('as' => 'admin-create-country', 'uses' => 'CountriesController@create'));
        Route::post('country/store', array('as' => 'admin-post-country', 'uses' => 'CountriesController@store'));
        Route::get('country/{id}/edit', array('as' => 'admin-edit-country', 'uses' => 'CountriesController@edit'));
        Route::post('country/{id}/update', array('as' => 'admin-update-country', 'uses' => 'CountriesController@update'));
        Route::delete('country/{id}/delete', array('as' => 'admin-delete-country', 'uses' => 'CountriesController@destroy'));

        //route Province
        Route::get('province', array('as' => 'admin-index-province', 'uses' => 'ProvincesController@index'));
        Route::get('province/create', array('as' => 'admin-create-province', 'uses' => 'ProvincesController@create'));
        Route::post('province/store', array('as' => 'admin-post-province', 'uses' => 'ProvincesController@store'));
        Route::get('province/{id}/edit', array('as' => 'admin-edit-province', 'uses' => 'ProvincesController@edit'));
        Route::post('province/{id}/update', array('as' => 'admin-update-province', 'uses' => 'ProvincesController@update'));
        Route::delete('province/{id}/delete', array('as' => 'admin-delete-province', 'uses' => 'ProvincesController@destroy'));

        //route City
        Route::get('city', array('as' => 'admin-index-city', 'uses' => 'CitiesController@index'));
        Route::get('city/create', array('as' => 'admin-create-city', 'uses' => 'CitiesController@create'));
        Route::post('city/store', array('as' => 'admin-post-city', 'uses' => 'CitiesController@store'));
        Route::get('city/{id}/edit', array('as' => 'admin-edit-city', 'uses' => 'CitiesController@edit'));
        Route::post('city/{id}/update', array('as' => 'admin-update-city', 'uses' => 'CitiesController@update'));
        Route::delete('city/{id}/delete', array('as' => 'admin-delete-city', 'uses' => 'CitiesController@destroy'));

        //route Category
        // Route::get('category', array('as' => 'admin-index-category', 'uses' => 'CategoriesController@index'));
        // Route::get('category/create', array('as' => 'admin-create-category', 'uses' => 'CategoriesController@create'));
        // Route::post('category/store', array('as' => 'admin-post-category', 'uses' => 'CategoriesController@store'));
        // Route::get('category/{id}/edit', array('as' => 'admin-edit-category', 'uses' => 'CategoriesController@edit'));
        // Route::post('category/{id}/update', array('as' => 'admin-update-category', 'uses' => 'CategoriesController@update'));
        // Route::delete('category/{id}/delete', array('as' => 'admin-delete-category', 'uses' => 'CategoriesController@destroy'));
        // Route::post('category/parent-combo', array('as' => 'list-parent-category', 'uses' => 'CategoriesController@listParentCategory'));

        //route Hastags
        Route::get('hastag', array('as' => 'admin-index-hastag', 'uses' => 'HastagsController@index'));
        Route::post('hastag/store', array('as' => 'admin-post-hastag', 'uses' => 'HastagsController@store'));
        Route::get('hastag/{id}/edit', array('as' => 'admin-edit-hastag', 'uses' => 'HastagsController@edit'));
        Route::post('hastag/{id}/update', array('as' => 'admin-update-hastag', 'uses' => 'HastagsController@update'));
        Route::delete('hastag/{id}/delete', array('as' => 'admin-delete-hastag', 'uses' => 'HastagsController@destroy'));

    });

    Route::group(['prefix' => 'management'], function () {
        //route Users
        Route::get('users', array('as' => 'admin-index-users', 'uses' => 'UsersController@index'));
        Route::get('users/create', array('as' => 'admin-create-users', 'uses' => 'UsersController@create'));
        Route::post('users/store', array('as' => 'admin-post-users', 'uses' => 'UsersController@store'));
        Route::get('users/{id}/edit', array('as' => 'admin-edit-users', 'uses' => 'UsersController@edit'));
        Route::post('users/{id}/update', array('as' => 'admin-update-users', 'uses' => 'UsersController@update'));
        Route::get('users/{id}/delete', array('as' => 'admin-delete-users', 'uses' => 'UsersController@destroy'));
        Route::post('users/{id}/restore', array('as' => 'admin-restore-users', 'uses' => 'UsersController@restore'));
        Route::get('users/{id}/show', array('as' => 'admin-show-users', 'uses' => 'UsersController@show'));

    });

    Route::group(['prefix' => 'event'], function () {
        Route::get('', array('as' => 'admin-index-event', 'uses' => 'EventsController@index'));
        Route::get('create', array('as' => 'admin-create-event', 'uses' => 'EventsController@create'));
        Route::post('store', array('as' => 'admin-post-event', 'uses' => 'EventsController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-event', 'uses' => 'EventsController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-event', 'uses' => 'EventsController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-event', 'uses' => 'EventsController@destroy'));
        Route::post('{id}/avaibility-edit', array('as' => 'admin-update-event-avaibility', 'uses' => 'EventsController@avaibilityUpdate'));
        Route::post('draft', array('as' => 'admin-draft-event', 'uses' => 'EventsController@draft'));
        Route::get('combo', array('as' => 'list-combo-event', 'uses' => 'EventsController@comboEvent'));
        Route::get('category', array('as' => 'admin-index-event-category', 'uses' => 'CategoriesController@index'));
        Route::get('category/create', array('as' => 'admin-create-event-category', 'uses' => 'CategoriesController@create'));
        Route::post('category/store', array('as' => 'admin-post-event-category', 'uses' => 'CategoriesController@store'));
        Route::get('category/{id}/edit', array('as' => 'admin-edit-event-category', 'uses' => 'CategoriesController@edit'));
        Route::post('category/{id}/update', array('as' => 'admin-update-event-category', 'uses' => 'CategoriesController@update'));
        Route::delete('category/{id}/delete', array('as' => 'admin-delete-event-category', 'uses' => 'CategoriesController@destroy'));
        Route::get('category/combo', array('as' => 'list-combo-event-category', 'uses' => 'CategoriesController@comboCategory'));

        
    });

    Route::group(['prefix' => 'event-schedule'], function () {
        Route::post('store', array('as' => 'admin-post-event-schedule', 'uses' => 'EventSchedulesController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-event-schedule', 'uses' => 'EventSchedulesController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-event-schedule', 'uses' => 'EventSchedulesController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-event-schedule', 'uses' => 'EventSchedulesController@destroy'));
        Route::get('{id}/count', array('as' => 'admin-count-event-schedule', 'uses' => 'EventSchedulesController@countSchedule'));

        
    });

    Route::group(['prefix' => 'event-schedule-category'], function () {
        Route::post('store', array('as' => 'admin-post-event-schedule-category', 'uses' => 'EventScheduleCategoriesController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-event-schedule-category', 'uses' => 'EventScheduleCategoriesController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-event-schedule-category', 'uses' => 'EventScheduleCategoriesController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-event-schedule-category', 'uses' => 'EventScheduleCategoriesController@destroy'));
        Route::get('{id}/count', array('as' => 'admin-count-event-schedule-category', 'uses' => 'EventScheduleCategoriesController@countScheduleCategory'));

        
    });

    // Route::group(['prefix' => 'promotion'], function () {
    //     Route::get('index', array('as' => 'admin-index-promorion', 'uses' => 'PromotionsController@index'));
    //     Route::get('create', array('as' => 'admin-create-promorion', 'uses' => 'PromotionsController@create'));
    //     Route::post('store', array('as' => 'admin-post-promorion', 'uses' => 'PromotionsController@store'));
    //     Route::get('{id}/edit', array('as' => 'admin-edit-promorion', 'uses' => 'PromotionsController@edit'));
    //     Route::post('{id}/update', array('as' => 'admin-update-promorion', 'uses' => 'PromotionsController@update'));
    //     Route::delete('{id}/delete', array('as' => 'admin-delete-promorion', 'uses' => 'PromotionsController@destroy'));
    // });

    Route::group(['prefix' => 'venue'], function () {
        Route::get('', array('as' => 'admin-index-venue', 'uses' => 'VenuesController@index'));
        Route::get('create', array('as' => 'admin-create-venue', 'uses' => 'VenuesController@create'));
        Route::post('store', array('as' => 'admin-post-venue', 'uses' => 'VenuesController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-venue', 'uses' => 'VenuesController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-venue', 'uses' => 'VenuesController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-venue', 'uses' => 'VenuesController@destroy'));
        Route::post('{id}/avaibility-edit', array('as' => 'admin-update-venue-avaibility', 'uses' => 'VenuesController@avaibilityUpdate'));
    });

    // Route::group(['prefix' => 'setting'], function () {
    //     Route::get('', array('as' => 'admin-index-setting', 'uses' => 'SettingsController@index'));
    //     Route::get('create', array('as' => 'admin-create-setting', 'uses' => 'SettingsController@create'));
    //     Route::post('store', array('as' => 'admin-post-setting', 'uses' => 'SettingsController@store'));
    //     Route::get('{id}/edit', array('as' => 'admin-edit-setting', 'uses' => 'SettingsController@edit'));
    //     Route::post('{id}/update', array('as' => 'admin-update-setting', 'uses' => 'SettingsController@update'));
    //     Route::delete('{id}/delete', array('as' => 'admin-delete-setting', 'uses' => 'SettingsController@destroy'));
    // });

    // Route::group(['prefix' => 'trail'], function () {
    //     Route::get('', array('as' => 'admin-index-trail', 'uses' => 'TrailsController@index'));
    //     Route::get('create', array('as' => 'admin-create-trail', 'uses' => 'TrailsController@create'));
    //     Route::post('store', array('as' => 'admin-post-trail', 'uses' => 'TrailsController@store'));
    //     Route::get('{id}/edit', array('as' => 'admin-edit-trail', 'uses' => 'TrailsController@edit'));
    //     Route::post('{id}/update', array('as' => 'admin-update-trail', 'uses' => 'TrailsController@update'));
    //     Route::delete('{id}/delete', array('as' => 'admin-delete-trail', 'uses' => 'TrailsController@destroy'));
    // });

    // Route::group(['prefix' => 'system-log'], function () {
    //     Route::get('', array('as' => 'admin-index-system-log', 'uses' => 'SystemlogsController@index'));
    //     Route::get('create', array('as' => 'admin-create-system-log', 'uses' => 'SystemlogsController@create'));
    //     Route::post('store', array('as' => 'admin-post-system-log', 'uses' => 'SystemlogsController@store'));
    //     Route::get('{id}/edit', array('as' => 'admin-edit-system-log', 'uses' => 'SystemlogsController@edit'));
    //     Route::post('{id}/update', array('as' => 'admin-update-system-log', 'uses' => 'SystemlogsController@update'));
    //     Route::delete('{id}/delete', array('as' => 'admin-delete-system-log', 'uses' => 'SystemlogsController@destroy'));
    // });

    // Route::group(['prefix' => 'customer-report'], function () {
    //     Route::get('', array('as' => 'admin-index-customer-report', 'uses' => 'CustomerReportsController@index'));
    //     Route::get('create', array('as' => 'admin-create-customer-report', 'uses' => 'CustomerReportsController@create'));
    //     Route::post('store', array('as' => 'admin-post-customer-report', 'uses' => 'CustomerReportsController@store'));
    //     Route::get('{id}/edit', array('as' => 'admin-edit-customer-report', 'uses' => 'CustomerReportsController@edit'));
    //     Route::post('{id}/update', array('as' => 'admin-update-customer-report', 'uses' => 'CustomerReportsController@update'));
    //     Route::delete('{id}/delete', array('as' => 'admin-delete-customer-report', 'uses' => 'CustomerReportsController@destroy'));
    // });

    Route::group(['prefix' => 'manage-pages'], function () {
        Route::get('contact-us', array('as' => 'admin-contact-us', 'uses' => 'ManagePagesController@createEditContactUs'));
        Route::post('contact-us/store-update', array('as' => 'admin-post-update-contact-us', 'uses' => 'ManagePagesController@storeUpdateContactUs'));
        Route::get('terms-and-conditions', array('as' => 'admin-terms-and-conditions', 'uses' => 'ManagePagesController@createEditTermsAndConditions'));
        Route::post('terms-and-conditions/store-update', array('as' => 'admin-post-update-terms-and-conditions', 'uses' => 'ManagePagesController@storeUpdateTermsAndConditions'));
        Route::get('faq', array('as' => 'admin-faq', 'uses' => 'ManagePagesController@createEditFaq'));
        Route::post('faq/store-update', array('as' => 'admin-post-update-faq', 'uses' => 'ManagePagesController@storeUpdateFaq'));
        Route::get('careers', array('as' => 'admin-career', 'uses' => 'ManagePagesController@createEditCareer'));
        Route::post('careers/store-update', array('as' => 'admin-post-update-career', 'uses' => 'ManagePagesController@storeUpdateCareer'));
        Route::get('privacy-policy', array('as' => 'admin-privacy-policy', 'uses' => 'ManagePagesController@createEditPrivacyPolicy'));
        Route::post('privacy-policy/store-update', array('as' => 'admin-post-update-privacy-policy', 'uses' => 'ManagePagesController@storeUpdatePrivacyPolicy'));
        Route::get('about-us', array('as' => 'admin-about-us', 'uses' => 'ManagePagesController@createEditAboutUs'));
        Route::post('about-us/store-update', array('as' => 'admin-post-update-about-us', 'uses' => 'ManagePagesController@storeUpdateAboutUs'));
    });

    Route::group(['prefix' => 'homepage'], function () {
        Route::get('', array('as' => 'admin-index-homepage', 'uses' => 'HomepagesController@index'));
        Route::get('create', array('as' => 'admin-create-homepage', 'uses' => 'HomepagesController@create'));
        Route::post('store', array('as' => 'admin-post-homepage', 'uses' => 'HomepagesController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-homepage', 'uses' => 'HomepagesController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-homepage', 'uses' => 'HomepagesController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-homepage', 'uses' => 'HomepagesController@destroy'));
        Route::get('{category}/count-category', array('as' => 'admin-count-category-homepage', 'uses' => 'HomepagesController@countByCategory'));

        
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {
    Route::post('country/combo', array('as' => 'list-combo-country', 'uses' => 'CountriesController@comboCountry'));
    Route::get('region/combo', array('as' => 'list-combo-region', 'uses' => 'RegionsController@comboRegion'));
});
