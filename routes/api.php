<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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
// List all Users
Route::get('users', [UserController::class, 'listUser']);
// List all Users
// Route::get('user/list/{user}', [UserController::class, 'oneUser']);
// Create User and Register User
Route::post('user/create', [UserController::class, 'register']);
Route::post('register', [UserController::class, 'register']);
// Login User
Route::post('login', [UserController::class, 'login']);
// Update User
Route::put('user/update/{user}', [UserController::class, 'updateUser']);
// Delete User
Route::delete('user/delete/{user}', [UserController::class, 'deleteUser']);

// List all Admins
Route::get('admins', [UserController::class, 'listAdmin']);
// List one Admin
Route::get('admin/{admin}', [UserController::class, 'oneAdmin']);
// Create Admin
Route::post('admin/create', [UserController::class, 'createAdmin']);
// Update Admin
Route::put('admin/update/{admin}', [UserController::class, 'updateAdmin']);
// Delete Admin
Route::delete('admin/{admin}', [UserController::class, 'updateAdmin']);
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
