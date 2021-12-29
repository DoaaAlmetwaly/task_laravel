<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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
//Route::get('Users/Create',[StudentController::class,'create']);
//Route::post('Users/Store',[StudentController::class,'store']);
//Route::post('/uploadFile', [StudentController::class, 'uploadFile'])->name('uploadFile');

Route::get('Users/Create',[StudentController::class,'create']);
Route::post('Users/Store',[StudentController::class,'store']);
Route::get('Users', [StudentController::class, 'index']);
Route::get('Users/remove/{id}',[StudentController::class, 'destroy']);
Route::get('Users/edit/{id}', [StudentController::class, 'edit']);
Route::post('Users/update', [StudentController::class, 'update']);

#Auth ....
Route::get('Login', [StudentController::class, 'Login']);
Route::post('DoLogin', [StudentController::class, 'DoLogin']);
Route::get('logout', [StudentControllerr::class, 'logout']);


