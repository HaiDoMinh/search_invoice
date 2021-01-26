<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaServiceController;
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

Route::get('/tra-cuu', 'FrontEnd\SearchlnvoiceController@index')->name('SearchlnvoiceController.index');
//Route::post('/tra-cuu-hd', 'SearchlnvoiceController@searchInvoice')->name('SearchlnvoiceController.searchInvoice');
Route::get('/tra-cuu-hd', 'FrontEnd\SearchlnvoiceController@searchInvoice')->name('SearchlnvoiceController.searchInvoice');
Route::get('/huong-dan', 'FrontEnd\SearchlnvoiceController@tutorial')->name('SearchlnvoiceController.tutorial');
Route::get('/thong-tu', 'FrontEnd\SearchlnvoiceController@rules')->name('SearchlnvoiceController.rules');
Route::get('/cau-hoi-thuong-gap', 'FrontEnd\SearchlnvoiceController@frequently_asked_questions')
       ->name('SearchlnvoiceController.frequently_asked_questions');
Route::get('/test-tra-cuu','FrontEnd\SearchlnvoiceController@show')->name('SearchlnvoiceController.show');

Route::get('/reload-captcha-code', 'CaptchaServiceController@reloadCaptchaCode')->name('CaptchaServiceController.reloadCaptchaCode');

Auth::routes();

Route::resource('post', 'Admin\PostController');
Route::resource('account', 'Admin\AccountController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout');
