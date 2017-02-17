<?php

Route::group(
    [
        'as' => 'links::',
        'prefix' => config('links.prefix'),
        'namespace' => 'Laratracker\Links\Controllers',
    ], function () {
        Route::get('/{slug}', 'LinksController@redirect')->name('redirect');
    }
);
