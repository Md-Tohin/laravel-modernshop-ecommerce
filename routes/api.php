<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//  get api for fetch user 
Route::get('users/{id?}', [AdminController::class, 'getUsers']);
//  post api for add user 
Route::post('add-user', [AdminController::class, 'addUser']);
//  post api for add multi user 
Route::post('add-multi-user', [AdminController::class, 'addMultiUser']);
//  put api for update user 
Route::put('update-user/{id}', [AdminController::class, 'updateUser']);
//  patch api for update single record 
Route::patch('update-single-record/{id}', [AdminController::class, 'updateSingleRecord']);
//  delete api for delete user
Route::delete('delete-user/{id}', [AdminController::class, 'deleteUser']);
//  delete api for delete user with json
Route::delete('delete-user-with-json', [AdminController::class, 'deleteUserWithJson']);
//  delete api for delete multi user
Route::delete('delete-multi-user/{ids}', [AdminController::class, 'deleteMultiUser']);
//  delete api for delete multi user with json
Route::delete('delete-multi-user-with-json', [AdminController::class, 'deleteMultiUserWithJson']);