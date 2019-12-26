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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/page', 'HomepageController@services');

// Route::get('/test', function() {
// 	return view('layouts.home');
// });

Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', function() {
		return view('admin.home');
	});
    Route::get('image', 'HomeController@index');
    Route::resource('bill', 'AdminBillController');
    Route::resource('services', 'AdminServicesController');
    Route::resource('concept', 'AdminConceptController');
    Route::resource('conceptpromotion', 'AdminConceptRegisterPromotionController');
    Route::resource('conceptpromotionfree', 'AdminConceptPromotionFreeController');
    Route::resource('conceptpromotionother', 'AdminConceptPromotionOtherController');
    Route::resource('category', 'AdminCategoryController');
    Route::post('uploadImg', 'AdminUploadController@postImages');
    Route::post('uploadConceptImg', 'AdminUploadConceptController@postImages');
    Route::post('deleteImg', 'AdminUploadController@fileDestroy');
    Route::post('deleteConceptImg', 'AdminUploadConceptController@fileDestroy');
    Route::resource('free', 'AdminTestajax');
    Route::resource('other', 'AdminTestajax2');
    Route::resource('registerpromotion', 'AdminTestajax3');
    Route::resource('conceptregister', 'AdminConceptRegisterController');
});

Route::get('/admin', function () {
    return view('admin.home');
});

Route::get('/admin/login', function () {
    return view('admin.login');
});
Route::get('admin/login', ['as' => 'getLogin', 'uses' => 'Admin\AdminLoginController@getLogin']);
Route::post('admin/login', ['as' => 'postLogin', 'uses' => 'Admin\AdminLoginController@postLogin']);
Route::get('admin/logout', ['as' => 'getLogout', 'uses' => 'Admin\AdminLoginController@getLogout']);

Route::get('testck', function() {
    return view('layouts.testck');
});

Route::get('testconcept', function() {
    return view('layouts.testconcept');
});

Route::get('concept', function() {
    return view('layouts.concept.home');
});

Route::get('baogia', function() {
    return view('layouts.baogia.home');
});

Route::get('/search/name', 'SearchController@searchByName');

Route::post('/search', 'HomeSearchController@searchFullText')->name('search');

Route::post('/searchconcept', 'HomeSearchConceptController@searchFullText')->name('search');

Route::post('/searchpromotion', 'HomeSearchPromotionController@searchFullText')->name('search');
Route::post('/searchfree', 'HomeSearchConceptFreeController@searchFullText')->name('search');
