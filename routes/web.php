<?php

/**
 * --------------------------------------------------------------------------
 * Web Routes
 * --------------------------------------------------------------------------
 *
 * Here is where you can register web routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * contains the "web" middleware group. Now create something great!
 */

// Index routes
Route::get('/', 'IndexController@index')->name('/');        // Frontend
Route::get('/home', 'HomeController@index')->name('home');  // Backend

// Disclaimer routes
Route::get('/disclaimer', 'DisclaimerController@index')->name('disclaimer.index');

// Contact routes
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::post('/contact', 'ContactController@store')->name('contact.store');

// Account setting routes
Route::get('/settings/{type?}', 'AccountSettingsController@index')->name('account.settings');
Route::post('/settings/update/information', 'AccountSettingsController@updateInformation')->name('account.settings.info');
Route::post('/settings/update/security', 'AccountSettingsController@updateSecurity')->name('account.settings.sec');
