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

Route::get('/tra-cuu', 'SearchlnvoiceController@index')->name('SearchlnvoiceController.index');
//Route::post('/tra-cuu-hd', 'SearchlnvoiceController@searchInvoice')->name('SearchlnvoiceController.searchInvoice');
Route::get('/tra-cuu-hd', 'SearchlnvoiceController@searchInvoice')->name('SearchlnvoiceController.searchInvoice');
Route::get('/huong-dan', 'SearchlnvoiceController@tutorial')->name('SearchlnvoiceController.tutorial');
Route::get('/thong-tu', 'SearchlnvoiceController@rules')->name('SearchlnvoiceController.rules');
Route::get('/cau-hoi-thuong-gap', 'SearchlnvoiceController@frequently_asked_questions')
       ->name('SearchlnvoiceController.frequently_asked_questions');
Route::get('/test-tra-cuu','SearchlnvoiceController@show')->name('SearchlnvoiceController.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact-form', [CaptchaServiceController::class, 'index']);
Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
Route::get('/reload-captcha-code', [CaptchaServiceController::class, 'reloadCaptchaCode']);

Route::get('/logout', 'Auth\LoginController@logout');
