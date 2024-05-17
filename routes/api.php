<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Diagnostic\CreateDiagnosticController;
use App\Http\Controllers\Api\V1\Diagnostic\DestroyDiagnosticController;
use App\Http\Controllers\Api\V1\Diagnostic\PaginateDiagnosticController;
use App\Http\Controllers\Api\V1\Diagnostic\UpdateDiagnosticController;
use Illuminate\Routing\Router;
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

Route::prefix('v1')->group(function (Router $router) {
    $router->post('login', LoginController::class);
    $router->post('register', RegisterController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(callback: function (Router $router) {
    $router->post('logout', LogoutController::class);

    //Diagnostics
    $router->get('diagnostics', PaginateDiagnosticController::class);
   // $router->get('diagnostics/{challenge}', ShowChallengeController::class);
    $router->post('diagnostics', CreateDiagnosticController::class);
    $router->put('diagnostics/{diagnostic}', UpdateDiagnosticController::class);
    $router->delete('diagnostics/{diagnostic}', DestroyDiagnosticController::class);
});
