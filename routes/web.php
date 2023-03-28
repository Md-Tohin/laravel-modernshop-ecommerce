<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubAdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\UserController;

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

Auth::routes();

//  Admin Routes
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' =>['admin', 'auth', 'permission']], function(){
    //  dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //  user routes    
    Route::get('users', [AdminController::class, 'allUsers'])->name('admin.allUsers');
    Route::get('user/banned/{id}', [AdminController::class, 'userBanned'])->name('admin.user.banned');
    Route::get('user/unbanned/{id}', [AdminController::class, 'userUnbanned'])->name('admin.user.unbanned');

    //  role routes
    Route::get('role/status-update', [RoleController::class, 'updateStatus'])->name('role.status');
    Route::post('role/edit-update/', [RoleController::class, 'update'])->name('role.edit-update');
    Route::resource('role', RoleController::class);

    //  sub-admin routes
    Route::post('sub-admin/edit-update/', [SubAdminController::class, 'update'])->name('sub-admin.edit-update');
    Route::resource('sub-admin', SubAdminController::class);

    //  permission routes
    Route::post('permission/edit-update/', [PermissionController::class, 'update'])->name('permission.edit-update');
    Route::resource('permission', PermissionController::class);

    //  profile routes
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile.view');
    Route::post('profile', [ProfileController::class, 'updateDetail'])->name('profile.update.detail');
    Route::post('profile/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

    //  role routes
    Route::get('role/status-update', [RoleController::class, 'updateStatus'])->name('role.status');
    Route::post('role/edit-update/', [RoleController::class, 'update'])->name('role.edit-update');
    Route::resource('role', RoleController::class);
});

//  User Routes
Route::group(['prefix' => 'user', 'middleware' =>['user', 'auth']], function(){
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

//  google login
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

//  facebook login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');