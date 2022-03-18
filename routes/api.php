<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Http\Controllers\Api\UserController;

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
Route::group(['prefix' => 'user'], function (Router $router) {
    // 注册
    $router->post('register', [UserController::class, 'register']);
    // 登录
    $router->get('login', [UserController::class, 'login']);
    // 退出
    $router->get('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
    // 信息
    $router->get('info', [UserController::class, 'info'])->middleware('auth:sanctum');
});

