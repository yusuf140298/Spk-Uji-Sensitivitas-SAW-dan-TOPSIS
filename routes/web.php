<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\SawController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\SensitivController;
use App\Http\Controllers\PasswordController;
use Illuminate\Routing\RouteUri;

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

Route::get('/', [MainController::class, 'index'])->name('login');

Route::middleware('guest')->group(function(){
	Route::get('/LoginPage', [LoginController::class, 'index']);
	Route::post('/Login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function(){
	Route::post('/Logout', [LoginController::class, 'logout']);
	Route::get('/ResultPage', [ResultController::class, 'index']);
	Route::post('/UpdatePassword', [PasswordController::class, 'update']);
	
	Route::middleware('UserRole')->group(function(){
		Route::get('/RegisterPage', [UserController::class, 'index']);
		Route::get('/SawPage', [SawController::class, 'index']);
		Route::get('/TopsisPage', [TopsisController::class, 'index']);
		Route::get('/SensitivPage', [SensitivController::class, 'index']);
		
		Route::post('/store', [MainController::class, 'store']);
		Route::post('/updateData/{id}', [MainController::class, 'update']);
		Route::post('/updateData/{id}', [MainController::class, 'update']);
		Route::post('/deleteData/{id}', [MainController::class, 'destroy']);
		
		Route::get('/CriteriaPage', [CriteriaController::class, 'index'])	;
		Route::post('/criteriastore', [CriteriaController::class, 'store']);
		Route::post('/updateCriteria/{id}', [CriteriaController::class, 'update']);
		Route::post('delete/{id}', [CriteriaController::class, 'destroy']);
		
		Route::get('/SubCriteriaPage', [SubCriteriaController::class, 'index']);
		Route::post('/storesub', [SubCriteriaController::class, 'store']);
		Route::post('/updateSub/{id}', [SubCriteriaController::class, 'update']);
		Route::post('deletesub/{id}', [SubCriteriaController::class, 'destroy']);
		
		Route::post('/UserStore', [UserController::class, 'store']);
		Route::post('UpdateUser/{id}', [UserController::class, 'update']);
		Route::post('DeleteUser/{id}', [UserController::class, 'destroy']);
	});
});
