<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
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

Route::get('/catalog', [PageController::class, 'catalogPage'])->name('catalogPage');

Route::get('/cart', [PageController::class, 'cartPage'])->name('cartPage');

Route::get('/myOrders', [PageController::class, 'userOrdersPage'])->name('userOrdersPage');

Route::get('/product/{product?}', [PageController::class, 'productPage'])->name('productPage');

Route::get('/contacts', [PageController::class, 'contactsPage'])->name('contactsPage');

Route::get('/editUser', [PageController::class, 'editUser'])->name('editUser');

Route::post('/editUser/save', [UserController::class, 'editUserSave'])->name('editUserSave');

//--Функции

Route::post('/registration/save', [\App\Http\Controllers\UserController::class, 'register'])->name('register');

Route::post('/login', [\App\Http\Controllers\UserController::class, 'auth'])->name('auth');

Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/products/get', [ProductController::class, 'getProducts'])->name('getProducts');

Route::get('/categories/get', [\App\Http\Controllers\CategryController::class, 'getCategories'])->name('getCategories');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('addToCart');

Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('removeFromCart');

Route::get('/carts/get', [CartController::class, 'getCarts'])->name('getCarts');

Route::post('/cart/delete', [CartController::class, 'deleteFromCart'])->name('deleteFromCart');

Route::post('/cart/order', [\App\Http\Controllers\OrderController::class, 'makeAnOrder'])->name('makeAnOrder');

Route::get('/orders/get', [\App\Http\Controllers\OrderController::class, 'getOrders'])->name('getOrders');

Route::get('/deleteOrder/{order?}', [OrderController::class, 'destroy'])->name('deleteOrder');

//--Мидлвар

Route::group(['middleware'=>['auth', 'admin'], 'prefix'=>'admin'], function (){

    //--Страницы

    Route::get('/categories', [\App\Http\Controllers\PageController::class, 'categoriesPage'])->name('categoriesPage');

    Route::get('/editCategory/{category?}', [\App\Http\Controllers\PageController::class, 'editCategoryPage'])->name('editCategoryPage');

    Route::get('/products', [\App\Http\Controllers\PageController::class, 'productsPage'])->name('productsPage');

    Route::get('/editProduct/{product?}', [\App\Http\Controllers\PageController::class, 'editProductPage'])->name('editProductPage');

    Route::get('/orders', [PageController::class, 'adminOrdersPage'])->name('adminOrdersPage');

    //--Функции

    Route::post('/addCategory', [\App\Http\Controllers\CategryController::class, 'addCategory'])->name('addCategory');

    Route::post('/updateCategory', [\App\Http\Controllers\CategryController::class, 'update'])->name('updateCategory');

    Route::post('/deleteCategory', [CategryController::class, 'destroy'])->name('deleteCategory');

    Route::post('/product/save', [ProductController::class, 'addProduct'])->name('addProduct');

    Route::post('/product/update', [\App\Http\Controllers\ProductController::class, 'updateProduct'])->name('updateProduct');

    Route::post('/deleteProduct', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

    Route::post('/orders/confirm', [\App\Http\Controllers\OrderController::class, 'confirmOrder'])->name('confirmOrder');

    Route::post('/orders/reject', [\App\Http\Controllers\OrderController::class, 'rejectOrder'])->name('rejectOrder');

});
