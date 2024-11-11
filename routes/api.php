<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController_api;
use App\Http\Middleware\ValidateToken;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register/user', [AuthController::class, 'registerClient']);
Route::post('register/admin', [AuthController::class, 'registerAdmin']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'groups'], function () {
        Route::post('/create', [GroupController::class, 'store'])->name('groups.store');
        Route::delete('/delete/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');
        Route::get('/show/{id}', [GroupController::class, 'show'])->name('groups.show');
        Route::get('/all', [GroupController::class, 'index'])->name('groups.index');
    });
});

// // Auth routes
// Route::controller(AuthController_api::class)->group(function () {
//     Route::post('/login', 'login')->name('api.login');
//     Route::post('/register/user', 'register_user')->name('api.register.user');
//     Route::post('/register/admin', 'register_admin')->name('api.register.admin');


//     Route::post('/logout', 'logout')->middleware(ValidateToken::class,'auth:api')->name('api.logout');
// });

// Route::middleware('auth:api')->group(function () {
//     Route::group(['prefix' => 'groups'], function () {
//         Route::post('/create', [GroupController::class, 'store'])->name('groups.store');
//         Route::delete('/delete/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');
//         Route::get('/show/{id}', [GroupController::class, 'show'])->name('groups.show');
//         Route::get('/all', [GroupController::class, 'index'])->name('groups.index');
//     });
// });