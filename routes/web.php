<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear','Auth/ArtisanController@clear')->name('clear-cache');

Route::view('/','themes.new-theme.home')->name("home");
Route::view('/login-mobile','themes.new-theme.user.login_mobile')->name("mobile.login");
Route::view('/register-mobile','themes.new-theme.user.registration_mobile')->name("mobile.register");

Auth::routes();
Route::view('/login','themes.new-theme.home')->name("login");

Route::view('/register','themes.new-theme.home')->name('register');

Route::get('user/dashboard', 'UserController@index')->name('user.dashboard');
Route::get('user/{slug}','Theme\HomeController@getProfile')->where('slug','[\w\d\-\_]+')->name('user.profile');
Route::get('top-hackers', 'UserController@top_hackers')->name('user.top.hackers');
Route::get('search-user', 'UserController@search_user')->name('user.search.index');
Route::post('search-user-ajax', 'UserController@search_users_ajax')->name('user.search_users_ajax');
Route::post('store_recent_search', 'UserController@store_recent_search')->name('user.store_recent_search');
Route::post('/ajax_upload/action', 'Theme\HomeController@picUpload')->name('ajaxupload.action');
Route::post('/ajax_hackathon_img', 'Theme\HomeController@picUploadHackon')->name('ajaxuploadhackon.action');
Route::post('user-update', 'UserController@profileUpdate')->name('user-update');
Route::post('add-hackonton', 'UserController@addHackonton')->name('add-hackonton');
Route::get('edit-hackonton', 'UserController@edit_hackathon')->name('edit-hackonton');
Route::post('edit-hackonton', 'UserController@update_hackathon')->name('edit-hackonton');
Route::post('update-hackonton', 'UserController@updateHackonton')->name('update-hackonton');
Route::post('update-performance', 'UserController@updatePerformance')->name('update-performance');
//Route::get('get-pound', 'Theme\HomeController@GetPoundEuro')->name('get-pound');
//Route::get('/hackonthon-delete/{id}', 'UserController@destroy')->name('hackonthon-delete');
Route::get('hackonthon-delete/delete/{id}', 'UserController@destroy')->name('admin-hackonthon-delete-delete');
Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name("github-login");
Route::get('login/linkedin', 'Auth\LoginController@redirectToLinkedinProvider')->name("linkedin-login");
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider')->name("facebook-login");
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('login/linkedin/callback', 'Auth\LoginController@handleProviderLinkedinCallback');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
Route::get('user/select_theme/{theme}', 'UserController@select_theme')->name('user.select_theme');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile/{id}', 'AdminController@edit')->name('admin-profile');
    Route::patch('/update/{id}', 'AdminController@update')->name('admin-update');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');



});
Route::group([
    'middleware'    => ['auth:admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{

    //User Routes
    Route::resource('users','UsersController');
    Route::get('users/edit/{id}', 'UsersController@edit')->name('company-edit');
    Route::post('get-users', 'UsersController@getUsers')->name('admin.getUsers');
    Route::get('users/delete/{id}', 'UsersController@destroy')->name('user-delete');
    Route::post('delete-selected-users', 'UsersController@DeleteSelectedUsers')->name('delete-selected-users');
    Route::get('edit-profile/{id}', 'UsersController@show')->name('edit-profile');


    //Badge Routes
    Route::resource('badges','BadgesController');
    Route::get('badges/edit/{id}', 'BadgesController@edit')->name('admin-badges-edit');
    Route::post('get-badges', 'BadgesController@getBadges')->name('admin-getAddedBadges');
    Route::get('badges/delete/{id}', 'BadgesController@destroy')->name('admin-badges-delete');
    Route::post('delete-selected-badges', 'BadgesController@DeleteSelectedBadges')->name('delete-selected-badges');
    Route::post('badges/detail', 'BadgesController@getBadgeDetail')->name('admin-getBadges');//Badge Routes

    //MasterBadge Routes
    Route::resource('master-badges','MasterBadgesController');
    Route::get('master-badges/edit/{id}', 'MasterBadgesController@edit')->name('admin-master-badges-edit');
    Route::post('get-master-badges', 'MasterBadgesController@getMasterBadges')->name('admin-getAddedMasterBadges');
    Route::get('master-badges/delete/{id}', 'MasterBadgesController@destroy')->name('admin-master-badges-delete');
    Route::post('delete-selected-master-badges', 'MasterBadgesController@DeleteSelectedMasterBadges')->name('delete-selected-master-badges');
    Route::post('master-badges/detail', 'MasterBadgesController@getMasterBadgeDetail')->name('admin-getMasterBadges');//Badge Routes

    Route::resource('works','WorksController');
    Route::get('works/edit/{id}', 'WorksController@edit')->name('admin-works-edit');
    Route::post('get-works', 'WorksController@getWorks')->name('admin-getAddedWorks');
    Route::get('works/delete/{id}', 'WorksController@destroy')->name('admin-works-delete');
    Route::post('delete-selected-works', 'WorksController@DeleteSelectedWorks')->name('delete-selected-works');
    Route::post('works/detail', 'WorksController@getWorkDetail')->name('admin-getWorks');


    //Setting Routes
    Route::resource('settings','SettingsController');
});
