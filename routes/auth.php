<?php

/**
 * --------------------------------------------------------------------------
 * Auth Routes
 * --------------------------------------------------------------------------
 *
 * Here is where you can register web routes for your authencation. These
 * routes are loaded by the RouteServiceProvider within a group which
 * contains the "web" middleware group.
 */

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('password/reset', 'Auth\ForgotpasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
