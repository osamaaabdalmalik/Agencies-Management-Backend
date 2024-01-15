<?php

use App\Http\Controllers\Admin\AgentsController;
use App\Http\Controllers\Admin\AuthAdminController;
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

Route::prefix('admin')->group(function () {
    Route::controller(AuthAdminController::class)
        ->prefix('auth')
        ->group(function () {
            Route::post('send_code', 'sendCode');
            Route::post('login', 'verifyCodeAndLogin');
            Route::get('logout', 'logout');
            Route::post('reset_password', 'resetPassword');
        });
});
Route::get('get-agent-tree', [AgentsController::class, 'getAgents']);
Route::post('add-agent', [AgentsController::class, 'addAgent']);
