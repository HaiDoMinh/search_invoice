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
    return redirect()->route('loginGuest');
});
Route::get('/reload-captcha-code', 'CaptchaServiceController@captcha')->name('CaptchaServiceController.reloadCaptchaCode');
Route::get('/tra-cuu', 'FrontEnd\SearchlnvoiceController@index')->name('SearchlnvoiceController.index');
Route::get('/tra-cuu-hd', 'FrontEnd\SearchlnvoiceController@searchInvoice')->name('SearchlnvoiceController.searchInvoice');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function ()
{
    Route::resource('pages', 'Admin\PagesController');
    Route::resource('account', 'Admin\AccountController');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login-guest', 'Auth\LoginController@loginGuest')->name('loginGuest');
Route::post('/login-guest', 'Auth\LoginController@loginGuestPost')->name('loginGuestPost');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/404-page', 'FrontEnd\SearchlnvoiceController@page404')->name('SearchlnvoiceController.404');

Route::get('{url}', 'FrontEnd\SearchlnvoiceController@page')->name('SearchlnvoiceController.page');
