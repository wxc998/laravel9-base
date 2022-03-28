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
Route::controller(UserController::class)->prefix('user')->group(function (Router $router) {
    // 注册
    $router->post('register', 'register');
    // 登录
    $router->get('login', 'login');
    // 退出
    $router->get('logout', 'logout')->middleware('auth:sanctum');
    // 信息
    $router->get('info', 'info')->middleware(['auth:sanctum']);
});
