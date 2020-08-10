<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::group([], function () {
    Route::get('/', 'IndexController@execute')->name('home');
    Route::post('/send', 'IndexController@sendmail')->name('send');
    Route::get('/page/{alias}', 'PageController@execute')->name('pages');
});


//admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {

        if (view()->exists('admin.index')) {
            $data = ['title' => 'Admin Panel'];

            return view('admin.index', $data);
        }

    });
    Route::any('/logout', [
        'uses' => 'HomeController@logout',
        'as' => 'logout',
    ]); function(){
        return view('home');
    };
    //admin/pages
    Route::group(['prefix' => 'pages'], function () {
        //admin/pages
        Route::get('/', ['uses' => 'PagesController@execute', 'as' => 'pagesAll']);
        //admin/pages/add
        Route::match(['get', 'post'], '/add', 'PagesAddController@execute')->name('pagesAdd');
        //admin/edit/2
        Route::match(['get', 'post', 'delete'], '/edit/{page}', ['uses' => 'PagesEditController@execute', 'as' => 'pagesEdit']);
    });

    Route::resource('portfolios', 'AdminPortfolioController')->names('portfolios');
    Route::resource('services', 'AdminServiceController')->names('services');
    Route::resource('galleries', 'AdminGalleryController')->names('galleries');
    Route::resource('employees', 'AdminEmployeeController')->names('employees');

});

