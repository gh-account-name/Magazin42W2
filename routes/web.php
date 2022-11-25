<?php

use App\Http\Controllers\UserController;
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


//--Страницы
Route::get('/', function () {
    return view('welcome');
})->name('welcomePage');

Route::get('/registration', [\App\Http\Controllers\PageController::class, 'registrationPage'])->name('registrationPage');

Route::get('/auth', [\App\Http\Controllers\PageController::class, 'authPage'])->name('authPage');

Route::get('/userCabinet', [\App\Http\Controllers\PageController::class, 'cabinetPage'])->name('cabinetPage');

//--Функции

Route::post('/registration/save', [\App\Http\Controllers\UserController::class, 'register'])->name('register');

Route::post('/login', [\App\Http\Controllers\UserController::class, 'auth'])->name('auth');

Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');

//--Мидлвар

Route::group(['middleware'=>['auth', 'admin'], 'prefix'=>'admin'], function (){

    Route::post('/addCategory', [\App\Http\Controllers\CategryController::class, 'addCategory'])->name('addCategory');

    Route::get('/', [\App\Http\Controllers\PageController::class, 'categoriesPage'])->name('categoriesPage');

    Route::get('/editCategory/{category}', [\App\Http\Controllers\PageController::class, 'editCategoryPage'])->name('editCategoryPage');

    Route::put('/updateCategory/{category}', [\App\Http\Controllers\CategryController::class, 'update'])->name('updateCategory');

    Route::get('/categories/get', [\App\Http\Controllers\CategryController::class, 'getCategories'])->name('getCategories');

});
