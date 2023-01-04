<?php

use App\Http\Controllers\Api\Agama18Controller;
use App\Http\Controllers\Api\User18Controller;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/data-agama18', [Agama18Controller::class, 'index18']);
Route::post('/create-agama18', [Agama18Controller::class, 'create18']);
Route::get('/approve-user18/{id}', [User18Controller::class, 'approve18']);
Route::get('/show-agama18/{id}', [Agama18Controller::class, 'show18']);
Route::post('/update-agama18', [Agama18Controller::class, 'update18']);
Route::get('/delete-agama18/{id}', [Agama18Controller::class, 'delete18']);

Route::get('/data-user18', [User18Controller::class, 'index18']);
Route::get('/show-user18/{id}', [User18Controller::class, 'show18']);
Route::post('/update-password18', [User18Controller::class, 'updatepass18']);
Route::post('/update-user18', [User18Controller::class, 'update18']);
Route::post('/update-foto-profil18', [User18Controller::class, 'updatefoto18']);