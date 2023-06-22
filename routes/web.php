<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\LoginController;
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

//Main page
Route::view('/', 'Index')->name('index');
Route::view('/index', 'Index');
Route::view('/Index', 'Index');

//Info page 
Route::view('/Info', 'Info');
Route::view('/info', 'Info');

//Register
Route::view('/Register', 'Register');
Route::post('/Register', [UserController::class, 'register']);

//Login
Route::view('/Login', 'Login');
Route::view('/login', 'Login');
Route::post('/Login', [LoginController::class, 'login']);

//Logout
Route::get('/Logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);

//Exam 
Route::get('/ExamStart', [ExamController::class, 'start'])->middleware('auth');
Route::post('/ExamEnd', [ExamController::class, 'end'])->middleware('auth');
Route::get('/PDFResult/{result_id}/{user_id}', [ExamController::class, 'PDFResult'])
    ->whereNumber('result_id', 'user_id');

//Excel export
Route::get('/ExcelExport', [ResultController::class, 'excelExport'])->can('admin');

//Change language
Route::get('/Language/{locale}', function (string $locale) {
    App::setLocale($locale);
    Session::put('locale', $locale);
    Cookie::queue(Cookie::forever('locale', $locale));

    return redirect()->back();
})->whereIn('locale', ['ru', 'kk']);
