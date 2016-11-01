<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {

    Route::group(['prefix' => 'datatables'], function () {
        //Route::get('directories', 'DirectoryController@datatables');
        //Route::get('hashtags/{type}', 'HashtagController@datatables');
        Route::get('roles', 'UserTrustee\RoleController@datatables');
        Route::get('user-trustees', array('as' => 'datatables-user-trustees', 'uses' =>'UserTrustee\UserController@datatables'));
        Route::get('menu', 'UserTrustee\MenuController@datatables');
        Route::get('promoter', array('as' => 'datatables-promoter', 'uses' => 'UserTrustee\PromotersController@datatables'));
        Route::get('tixtrack-account', array('as' => 'datatables-tixtrack-account', 'uses' => 'TixTrack\AccountsController@datatables'));
        Route::get('country', array('as' => 'datatables-country', 'uses' => 'CountriesController@datatables'));
        Route::get('province', array('as' => 'datatables-province', 'uses' => 'ProvincesController@datatables'));
        Route::get('city', array('as' => 'datatables-city', 'uses' => 'CitiesController@datatables'));
        //Route::get('category', array('as' => 'datatables-category', 'uses' => 'CategoriesController@datatables'));
        //Route::get('user', array('as' => 'datatables-user', 'uses' => 'UsersController@datatables'));
        Route::get('hastag', array('as' => 'datatables-hastag', 'uses' => 'HastagsController@datatables'));

        /**
         *  Get view page apllication data.
         *  url:  '/admin/datatables/application'
         *  Code By : Nova (Smooets)
        */
        //Route::get('application', array('as' => 'datatables-application', 'uses' => 'ApplicationController@datatables'));

        /**
         *  Get view page district data.
         *  url:  '/admin/datatables/district'
         *  Code By : Nova (Smooets)
        */
        //Route::get('district', array('as' => 'datatables-district', 'uses' => 'DistrictsController@datatables'));

        /**
         *  Get view page village data.
         *  url:  '/admin/datatables/village'
         *  Code By : Nova (Smooets)
        */
        //Route::get('village', array('as' => 'datatables-village', 'uses' => 'VillagesController@datatables'));

        /**
         *  Get view page branch data.
         *  url:  '/admin/datatables/branch'
         *  Code By : Nova (Smooets)
        */
        //Route::get('branch', array('as' => 'datatables-branch', 'uses' => 'BranchController@datatables'));

        Route::get('venue', array('as' => 'datatables-venue', 'uses' => 'VenuesController@datatables'));
        Route::get('event', array('as' => 'datatables-event', 'uses' => 'EventsController@datatables'));
        Route::get('event-schedule', array('as' => 'datatables-event-schedule', 'uses' => 'EventSchedulesController@datatables'));
        Route::get('event-schedule-category', array('as' => 'datatables-event-schedule-category', 'uses' => 'EventScheduleCategoriesController@datatables'));
        Route::get('homepage', array('as' => 'datatables-homepage', 'uses' => 'HomepagesController@datatables'));
        Route::get('event-category', array('as' => 'datatables-event-category', 'uses' => 'CategoriesController@datatables'));
        Route::get('promotion', array('as' => 'datatables-promotion', 'uses' => 'PromotionsController@datatables'));
        Route::get('event-promotion', array('as' => 'datatables-event-promotion', 'uses' => 'PromotionsController@datatablesByEvent'));
        Route::get('activity-log', array('as' => 'datatables-activity-log', 'uses' => 'ActivityLogController@datatables'));
        Route::get('trail', array('as' => 'datatables-trail', 'uses' => 'TrailsController@datatables'));
        Route::get('department', array('as' => 'datatables-department', 'uses' => 'DepartmentsController@datatables'));
        Route::get('career', array('as' => 'datatables-career', 'uses' => 'CareersController@datatables'));
        Route::get('message', array('as' => 'datatables-message', 'uses' => 'MessagesController@datatables'));
        Route::get('currency', array('as' => 'datatables-currency', 'uses' => 'CurrenciesController@datatables'));
        Route::get('subscription', array('as' => 'datatables-subscription', 'uses' => 'SubscriptionsController@datatables'));
        Route::get('subscription-event', array('as' => 'datatables-subscription-event', 'uses' => 'SubscriptionsController@eventDatatables'));
        Route::get('tixtrack-member', array('as' => 'datatables-tixtrack-member', 'uses' => 'TixTrack\ReportsController@datatablesMember'));
        Route::get('tixtrack-transaction', array('as' => 'datatables-tixtrack-transaction', 'uses' => 'TixTrack\ReportsController@datatablesTransaction'));
        

    });

});
