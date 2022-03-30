<?php

/* Admin login routes */
Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.post');
Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('forgot-password', 'Auth\Admin\ForgotPasswordController@index')->name('admin.reset-password');
Route::post('password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.sent.reset-link');
Route::get('password/reset/{token}', 'Auth\Admin\ForgotPasswordController@showResetForm')->name('admin.verify.mail');
Route::post('password/reset', 'Auth\Admin\ForgotPasswordController@resetPassword')->name('admin.reset.password');

Route::group(['middleware' => ['admin', 'auth:admin'], 'namespace' => 'Admin'], function () {
    /** Dashboard route */
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    /** Profile routes **/
    Route::group(['prefix'=> 'profile'],function(){
        Route::get('/','ProfileController@index')->name('admin.profile');
        Route::match(['post', 'PUT'],'/store','ProfileController@store')->name('admin.profile.store');
    });

    /** Profile routes **/
    Route::group(['prefix'=> 'user'],function(){
        Route::get('/','UserController@index')->name('admin.user.index');
        Route::get('/create/{uuid?}','UserController@create')->name('admin.user.create');
        Route::get('/data-table','UserController@getData')->name('admin.user.data-table');
        Route::match(['post', 'PUT'],'/store/{uuid?}','UserController@store')->name('admin.user.store');
        Route::delete('/delete/{uuid?}','UserController@delete')->name('admin.user.delete');
    });

    /** Setting routes **/
    Route::group(['prefix'=> 'setting'],function(){
        Route::get('/','SettingController@index')->name('admin.setting');
        Route::match(['POST', 'PUT'],'/store/{uuid?}','SettingController@store')->name('admin.setting.store');
    });
});