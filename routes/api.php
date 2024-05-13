<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElectionController;

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

Route::post('/register', [AuthController::class, 'store']);
Route::post('/resetPin', [AuthController::class, 'reset']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/Adminlogin', [ElectionController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/party', [ElectionController::class, 'load']);
    Route::get('/user', [AuthController::class, 'load']);
    Route::post('/update-user', [AuthController::class, 'updateUser']);
    Route::post('/cast-vote', [ElectionController::class, 'castVote']);
    Route::post('/votes', [ElectionController::class, 'votes']);
    Route::post('/FAQ', [ElectionController::class, 'question']);
    Route::get('/FAQ', [ElectionController::class, 'myQuestions']);
});

Route::group(['middleware' => 'auth:sanctum','prefix'=>'admin'], function () {
    Route::post('/party', [ElectionController::class, 'addParty']);
    Route::post('/FAQ', [ElectionController::class, 'answer']);
    Route::post('/delete-party', [ElectionController::class, 'delParty']);
    Route::post('/delete-user', [ElectionController::class, 'delUser']);
    Route::get('/users', [ElectionController::class, 'users']);
});
