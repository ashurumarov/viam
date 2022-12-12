<?php

use App\Http\Controllers\APIv1\AdminPicsumController;
use App\Http\Middleware\CheckAdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIv1\PicsumController;

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


Route::get('/', [PicsumController::class, 'index']);
Route::get('/decline/{id}/{height?}/{width?}', [PicsumController::class, 'decline']);
Route::get('/approve/{id}/{height?}/{width?}', [PicsumController::class, 'approve']);

Route::get('/admin/{token}', [AdminPicsumController::class, 'index'])->middleware(CheckAdminMiddleware::class);
Route::get('/admin/revert/{id}', [AdminPicsumController::class, 'revert']);
