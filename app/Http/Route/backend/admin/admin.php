<?php

Route::group(['prefix' => 'admin', 'middleware' => 'sentinel_auth', 'namespace' => 'Backend\Admin'], function () {

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
        Route::post('users/email-exist', array('as' => 'admin-email-exist-user', 'uses' => 'UserController@checkEmailExist'));
        Route::post('users/reactivate', array('as' => 'admin-reactivate-user', 'uses' => 'UserController@reactivate'));

        Route::get('users/promotor-id', array('as' => 'admin-promotor-id-user', 'uses' => 'UserController@getPromotorID'));
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
        Route::get('combo-promotion', array('as' => 'list-combo-event-promotion', 'uses' => 'EventsController@comboEventByPromotion'));
        Route::get('category', array('as' => 'admin-index-event-category', 'uses' => 'CategoriesController@index'));
        Route::get('category/create', array('as' => 'admin-create-event-category', 'uses' => 'CategoriesController@create'));
        Route::post('category/store', array('as' => 'admin-post-event-category', 'uses' => 'CategoriesController@store'));
        Route::get('category/{id}/edit', array('as' => 'admin-edit-event-category', 'uses' => 'CategoriesController@edit'));
        Route::post('category/{id}/update', array('as' => 'admin-update-event-category', 'uses' => 'CategoriesController@update'));
        Route::delete('category/{id}/delete', array('as' => 'admin-delete-event-category', 'uses' => 'CategoriesController@destroy'));
        Route::get('category/combo', array('as' => 'list-combo-event-category', 'uses' => 'CategoriesController@comboCategory'));
        Route::post('category/{id}/avaibility-edit', array('as' => 'admin-update-category-avaibility', 'uses' => 'CategoriesController@avaibilityUpdate'));
        Route::post('category/{id}/status-edit', array('as' => 'admin-update-category-status', 'uses' => 'CategoriesController@statusUpdate'));
        //Route::get('preview', array('as' => 'admin-preview-event', 'uses' => 'EventsController@preview'));

        
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
        Route::get('{id}/min-price', array('as' => 'admin-min-price-event', 'uses' => 'EventScheduleCategoriesController@getMinPriceByEvent'));

        
    });

    Route::group(['prefix' => 'promotion'], function () {
        Route::get('', array('as' => 'admin-index-promotion', 'uses' => 'PromotionsController@index'));
        Route::get('create', array('as' => 'admin-create-promotion', 'uses' => 'PromotionsController@create'));
        Route::post('store', array('as' => 'admin-post-promotion', 'uses' => 'PromotionsController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-promotion', 'uses' => 'PromotionsController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-promotion', 'uses' => 'PromotionsController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-promotion', 'uses' => 'PromotionsController@destroy'));
        Route::post('{id}/avaibility-edit', array('as' => 'admin-update-promotion-avaibility', 'uses' => 'PromotionsController@avaibilityUpdate'));
    });

    Route::group(['prefix' => 'venue'], function () {
        Route::get('', array('as' => 'admin-index-venue', 'uses' => 'VenuesController@index'));
        Route::get('create', array('as' => 'admin-create-venue', 'uses' => 'VenuesController@create'));
        Route::post('store', array('as' => 'admin-post-venue', 'uses' => 'VenuesController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-venue', 'uses' => 'VenuesController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-venue', 'uses' => 'VenuesController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-venue', 'uses' => 'VenuesController@destroy'));
        Route::post('{id}/avaibility-edit', array('as' => 'admin-update-venue-avaibility', 'uses' => 'VenuesController@avaibilityUpdate'));
    });

    Route::group(['prefix' => 'setting'], function () {
        //Route::get('', array('as' => 'admin-index-setting', 'uses' => 'SettingsController@index'));
        Route::get('general', array('as' => 'admin-index-setting', 'uses' => 'SettingsController@general'));
        Route::post('update', array('as' => 'admin-update-setting', 'uses' => 'SettingsController@storeUpdate'));
        Route::get('mail', array('as' => 'admin-mail-setting', 'uses' => 'SettingsController@mail'));
        
        Route::get('currency', array('as' => 'admin-index-currency', 'uses' => 'CurrenciesController@index'));
        Route::get('currency/create', array('as' => 'admin-create-currency', 'uses' => 'CurrenciesController@create'));
        Route::post('currency/store', array('as' => 'admin-post-currency', 'uses' => 'CurrenciesController@store'));
        Route::get('currency/{id}/edit', array('as' => 'admin-edit-currency', 'uses' => 'CurrenciesController@edit'));
        Route::post('currency/{id}/update', array('as' => 'admin-update-currency', 'uses' => 'CurrenciesController@update'));
        Route::delete('currency/{id}/delete', array('as' => 'admin-delete-currency', 'uses' => 'CurrenciesController@destroy'));
    });

    Route::group(['prefix' => 'subscription'], function () {
        Route::get('', array('as' => 'admin-index-subscription', 'uses' => 'SubscriptionsController@index'));
        Route::get('{id}/show', array('as' => 'admin-show-subscription', 'uses' => 'SubscriptionsController@show'));
        // Route::get('{id}/edit', array('as' => 'admin-edit-subscription', 'uses' => 'SubscriptionsController@edit'));
        // Route::post('{id}/update', array('as' => 'admin-update-subscription', 'uses' => 'SubscriptionsController@update'));
        // Route::delete('{id}/delete', array('as' => 'admin-delete-subscription', 'uses' => 'SubscriptionsController@destroy'));
    });

    Route::group(['prefix' => 'trail'], function () {
        Route::get('', array('as' => 'admin-trail-index', 'uses' => 'TrailsController@index'));
        Route::post('save-trail-modal', array('as' => 'admin-trail-post-modal', 'uses' => 'TrailsController@saveTrailModal'));
    });

    Route::group(['prefix' => 'system-log'], function () {
        Route::get('', array('as' => 'admin-activity-log-index', 'uses' => 'ActivityLogController@index'));
        Route::post('create', array('as' => 'admin-activity-log-post-ajax', 'uses' => 'ActivityLogController@postAjaxLog'));
    });

    // Route::group(['prefix' => 'customer-report'], function () {
    //     Route::get('', array('as' => 'admin-index-customer-report', 'uses' => 'CustomerReportsController@index'));
    //     Route::get('create', array('as' => 'admin-create-customer-report', 'uses' => 'CustomerReportsController@create'));
    //     Route::post('store', array('as' => 'admin-post-customer-report', 'uses' => 'CustomerReportsController@store'));
    //     Route::get('{id}/edit', array('as' => 'admin-edit-customer-report', 'uses' => 'CustomerReportsController@edit'));
    //     Route::post('{id}/update', array('as' => 'admin-update-customer-report', 'uses' => 'CustomerReportsController@update'));
    //     Route::delete('{id}/delete', array('as' => 'admin-delete-customer-report', 'uses' => 'CustomerReportsController@destroy'));
    // });

    Route::group(['prefix' => 'manage-pages'], function () {
        Route::get('/{slug}', array('as' => 'admin-manage-page', 'uses' => 'ManagePagesController@index'));
        Route::post('{slug}/store-update', array('as' => 'admin-post-update-manage-page', 'uses' => 'ManagePagesController@storeUpdate'));
    });

    Route::group(['prefix' => 'homepage'], function () {
        Route::get('', array('as' => 'admin-index-homepage', 'uses' => 'HomepagesController@index'));
        Route::get('create', array('as' => 'admin-create-homepage', 'uses' => 'HomepagesController@create'));
        Route::post('store', array('as' => 'admin-post-homepage', 'uses' => 'HomepagesController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-homepage', 'uses' => 'HomepagesController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-homepage', 'uses' => 'HomepagesController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-homepage', 'uses' => 'HomepagesController@destroy'));
        Route::get('{category}/count-category', array('as' => 'admin-count-category-homepage', 'uses' => 'HomepagesController@countByCategory'));
        Route::post('update-sort', array('as' => 'admin-update-sort-order', 'uses' => 'HomepagesController@updateSortOrder'));

        
    });

    Route::group(['prefix' => 'career'], function () {
        Route::get('', array('as' => 'admin-index-career', 'uses' => 'CareersController@index'));
        Route::get('create', array('as' => 'admin-create-career', 'uses' => 'CareersController@create'));
        Route::post('store', array('as' => 'admin-post-career', 'uses' => 'CareersController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-career', 'uses' => 'CareersController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-career', 'uses' => 'CareersController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-career', 'uses' => 'CareersController@destroy'));
        Route::post('{id}/avaibility-edit', array('as' => 'admin-update-career-avaibility', 'uses' => 'CareersController@avaibilityUpdate'));
        Route::get('department', array('as' => 'admin-index-department', 'uses' => 'DepartmentsController@index'));
        Route::get('department/create', array('as' => 'admin-create-department', 'uses' => 'DepartmentsController@create'));
        Route::post('department/store', array('as' => 'admin-post-department', 'uses' => 'DepartmentsController@store'));
        Route::get('department/{id}/edit', array('as' => 'admin-edit-department', 'uses' => 'DepartmentsController@edit'));
        Route::post('department/{id}/update', array('as' => 'admin-update-department', 'uses' => 'DepartmentsController@update'));
        Route::delete('department/{id}/delete', array('as' => 'admin-delete-department', 'uses' => 'DepartmentsController@destroy'));
        Route::post('department/{id}/avaibility-edit', array('as' => 'admin-update-department-avaibility', 'uses' => 'DepartmentsController@avaibilityUpdate'));

        
    });

    Route::group(['prefix' => 'inbox'], function () {
        //route Users
        Route::get('', array('as' => 'admin-index-message', 'uses' => 'MessagesController@index'));
        Route::get('{id}/show', array('as' => 'admin-show-message', 'uses' => 'MessagesController@show'));
        Route::get('count-unread', array('as' => 'admin-count-unread-message', 'uses' => 'MessagesController@countUnread'));
        Route::post('reply-store', array('as' => 'admin-post-reply-message', 'uses' => 'MessageRepliesController@store'));

    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {
    Route::post('country/combo', array('as' => 'list-combo-country', 'uses' => 'CountriesController@comboCountry'));
    Route::get('region/combo', array('as' => 'list-combo-region', 'uses' => 'RegionsController@comboRegion'));
});
