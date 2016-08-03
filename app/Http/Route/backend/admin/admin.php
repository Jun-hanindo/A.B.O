<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {

    Route::get('dashboard', array('as' => 'admin-dashboard', 'uses' => 'DashboardController@index'));
    Route::get('profile', array('as' => 'admin-profile', 'uses' => 'ProfileController@index'));
    Route::put('profile/{type}', array('as' => 'admin-profile-update', 'uses' => 'ProfileController@update'));


    Route::group(['prefix' => 'user-trustees','namespace' => 'UserTrustee'], function () {

        // Menu Management...
        Route::resource('menus', 'MenuController', ['except' => 'show']);

        // Role Management...
        Route::resource('roles', 'RoleController', ['except' => 'show']);

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
        Route::get('category', array('as' => 'admin-index-category', 'uses' => 'CategoriesController@index'));
        Route::get('category/create', array('as' => 'admin-create-category', 'uses' => 'CategoriesController@create'));
        Route::post('category/store', array('as' => 'admin-post-category', 'uses' => 'CategoriesController@store'));
        Route::get('category/{id}/edit', array('as' => 'admin-edit-category', 'uses' => 'CategoriesController@edit'));
        Route::post('category/{id}/update', array('as' => 'admin-update-category', 'uses' => 'CategoriesController@update'));
        Route::delete('category/{id}/delete', array('as' => 'admin-delete-category', 'uses' => 'CategoriesController@destroy'));
        Route::post('category/parent-combo', array('as' => 'list-parent-category', 'uses' => 'CategoriesController@listParentCategory'));

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
        Route::get('index', array('as' => 'admin-event-index', 'uses' => 'EventsController@index'));
        Route::get('create', array('as' => 'admin-create-event', 'uses' => 'EventsController@create'));
        Route::post('store', array('as' => 'admin-post-event', 'uses' => 'EventsController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-event', 'uses' => 'EventsController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-event', 'uses' => 'EventsController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-event', 'uses' => 'EventsController@destroy'));
    });

    Route::group(['prefix' => 'price-plan'], function () {
        Route::get('index', array('as' => 'admin-price-plan-index', 'uses' => 'PricePlansController@index'));
        Route::get('create', array('as' => 'admin-create-price-plan', 'uses' => 'PricePlansController@create'));
        Route::post('store', array('as' => 'admin-post-price-plan', 'uses' => 'PricePlansController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-price-plan', 'uses' => 'PricePlansController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-price-plan', 'uses' => 'PricePlansController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-price-plan', 'uses' => 'PricePlansController@destroy'));
    });

    Route::group(['prefix' => 'venue'], function () {
        Route::get('index', array('as' => 'admin-venue-index', 'uses' => 'VenuesController@index'));
        Route::get('create', array('as' => 'admin-create-venue', 'uses' => 'VenuesController@create'));
        Route::post('store', array('as' => 'admin-post-venue', 'uses' => 'VenuesController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-venue', 'uses' => 'VenuesController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-venue', 'uses' => 'VenuesController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-venue', 'uses' => 'VenuesController@destroy'));
    });

    Route::group(['prefix' => 'setting'], function () {
        Route::get('index', array('as' => 'admin-setting-index', 'uses' => 'SettingsController@index'));
        Route::get('create', array('as' => 'admin-create-setting', 'uses' => 'SettingsController@create'));
        Route::post('store', array('as' => 'admin-post-setting', 'uses' => 'SettingsController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-setting', 'uses' => 'SettingsController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-setting', 'uses' => 'SettingsController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-setting', 'uses' => 'SettingsController@destroy'));
    });

    Route::group(['prefix' => 'trail'], function () {
        Route::get('index', array('as' => 'admin-trail-index', 'uses' => 'TrailsController@index'));
        Route::get('create', array('as' => 'admin-create-trail', 'uses' => 'TrailsController@create'));
        Route::post('store', array('as' => 'admin-post-trail', 'uses' => 'TrailsController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-trail', 'uses' => 'TrailsController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-trail', 'uses' => 'TrailsController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-trail', 'uses' => 'TrailsController@destroy'));
    });

    Route::group(['prefix' => 'system-log'], function () {
        Route::get('index', array('as' => 'admin-system-log-index', 'uses' => 'SystemlogsController@index'));
        Route::get('create', array('as' => 'admin-create-system-log', 'uses' => 'SystemlogsController@create'));
        Route::post('store', array('as' => 'admin-post-system-log', 'uses' => 'SystemlogsController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-system-log', 'uses' => 'SystemlogsController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-system-log', 'uses' => 'SystemlogsController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-system-log', 'uses' => 'SystemlogsController@destroy'));
    });

    Route::group(['prefix' => 'customer-report'], function () {
        Route::get('index', array('as' => 'admin-customer-report-index', 'uses' => 'CustomerReportsController@index'));
        Route::get('create', array('as' => 'admin-create-customer-report', 'uses' => 'CustomerReportsController@create'));
        Route::post('store', array('as' => 'admin-post-customer-report', 'uses' => 'CustomerReportsController@store'));
        Route::get('{id}/edit', array('as' => 'admin-edit-customer-report', 'uses' => 'CustomerReportsController@edit'));
        Route::post('{id}/update', array('as' => 'admin-update-customer-report', 'uses' => 'CustomerReportsController@update'));
        Route::delete('{id}/delete', array('as' => 'admin-delete-customer-report', 'uses' => 'CustomerReportsController@destroy'));
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {
    Route::post('country/combo', array('as' => 'list-combo-country', 'uses' => 'CountriesController@comboCountry'));
    Route::get('region/combo', array('as' => 'list-combo-region', 'uses' => 'RegionsController@comboRegion'));
});
