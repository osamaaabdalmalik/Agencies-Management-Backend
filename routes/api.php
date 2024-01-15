<?php

use App\Http\Controllers\Admin\AuthAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthAdminController::class)
    ->prefix('admin')
    ->group(function () {
    Route::post('send_code', 'sendCode');
    Route::post('login', 'verifyCodeAndLogin');
    Route::get('logout', 'logout');
    Route::post('reset_password', 'resetPassword');
});
