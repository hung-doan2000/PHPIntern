<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('authenticate');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::prefix('users')->name('users.')->group(function (){
        Route::get('',[UserController::class,'index'])->name('index');
        Route::get('/show/{id}',[UserController::class,'show'])->name('show');
        Route::get('/create',[UserController::class,'create'])->name('create');
        Route::post('/create',[UserController::class,'store'])->name('store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[UserController::class,'update'])->name('edit.update');
        Route::delete('/delete',[UserController::class,'delete'])->name('delete');
    });
    Route::prefix('roles')->name('roles.')->group(function (){
        Route::get('',[RoleController::class,'index'])->name('index');
        Route::get('/create',[RoleController::class,'create'])->name('create');
        Route::post('/create',[RoleController::class,'store'])->name('store');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[RoleController::class,'update'])->name('edit.update');
        Route::delete('/delete',[RoleController::class,'delete'])->name('delete');
    });
    Route::prefix('permissions')->name('permissions.')->group(function (){
        Route::get('',[PermissionController::class,'index'])->name('index');
        Route::get('/create',[PermissionController::class,'create'])->name('create');
        Route::post('/create',[PermissionController::class,'store'])->name('store');
        Route::get('/edit/{id}',[PermissionController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[PermissionController::class,'update'])->name('edit.update');
        Route::delete('/delete',[PermissionController::class,'delete'])->name('delete');
    });
    Route::prefix('products')->name('products.')->group(function (){
        Route::get('',[ProductController::class,'index'])->name('index');
        Route::get('/create',[ProductController::class,'create'])->name('create');
        Route::post('/create',[ProductController::class,'store'])->name('store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[ProductController::class,'update'])->name('edit.update');
        Route::delete('/delete',[ProductController::class,'delete'])->name('delete');
    });
});
