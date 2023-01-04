<?php

use App\Http\Controllers\Auth\Login18Controller;
use App\Http\Controllers\Auth\Register18Controller;
use App\Http\Controllers\Client\ClientLogin18Controller;
use App\Http\Controllers\Client\ClientRegister18Controller;
use App\Http\Controllers\Admin18Controller;
use App\Http\Controllers\Agama18Controller;
use App\Http\Controllers\DetailData18Controller;
use App\Http\Controllers\User18Controller;
use App\Http\Controllers\Client\Admin18Controller as ClientAdmin;
use App\Http\Controllers\Client\Agama18Controller as ClientAgama;
use App\Http\Controllers\Client\DetailData18Controller as ClientDetail;
use App\Http\Controllers\Client\User18Controller as ClientUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect('/client/login18');
});
Route::get('/login18', [Login18Controller::class, 'showLoginForm'])->name('login');
Route::post('/login18', [Login18Controller::class, 'login']);
Route::get('/register18', [Register18Controller::class, 'showRegistrationForm'])->name('register');
Route::post('/register18', [Register18Controller::class, 'register']);
Route::get('/logout18', [Login18Controller::class, 'logout'])->name('logout');

Route::get('/client/login18', [ClientLogin18Controller::class, 'showLoginForm'])->name('loginClient');
Route::post('/client/login18', [ClientLogin18Controller::class, 'login']);
Route::get('/client/register18', [ClientRegister18Controller::class, 'showRegistrationForm'])->name('registerClient');
Route::post('/client/register18', [ClientRegister18Controller::class, 'register']);
Route::get('/client/logout18', [ClientLogin18Controller::class, 'logout'])->name('logoutClient');

Auth::routes(['login' => false, 'register' => false]);
Route::middleware('auth', 'isAdmin')->group(function () {
    Route::get('/admin18', function () {
        return redirect('/admin18/dashboard18');
    });
    Route::get('/admin18/dashboard18', [Admin18Controller::class, 'index18']);
    Route::post('/admin18/dashboard18/update-foto-profil18', [Admin18Controller::class, 'update_foto18']);
    Route::get('/admin18/approve18/{id}', [User18Controller::class, 'approve18']);
    Route::get('/admin18/data-agama18', [Agama18Controller::class, 'index18']);
    Route::post('/admin18/data-agama18/create18', [Agama18Controller::class, 'create18']);
    Route::get('/admin18/data-agama18/edit18-{id}', [Agama18Controller::class, 'edit18']);
    Route::post('/admin18/data-agama18/update18', [Agama18Controller::class, 'update18']);
    Route::get('/admin18/data-agama18/delete18/{id}', [Agama18Controller::class, 'delete18']);
    Route::get('/admin18/dashboard18/detail18/{id}', [DetailData18Controller::class, 'index18']);

    //Client API
    Route::get('/client/admin18', function () {
        return redirect('/client/admin18/dashboard18');
    });
    Route::get('/client/admin18/dashboard18', [ClientAdmin::class, 'index18']);
    Route::post('/client/admin18/dashboard18/update-foto-profil18', [ClientAdmin::class, 'update_foto18']);
    Route::get('/client/admin18/approve18/{id}', [ClientUser::class, 'approve18']);
    Route::get('/client/admin18/data-agama18', [ClientAgama::class, 'index18']);
    Route::post('/client/admin18/data-agama18/create18', [ClientAgama::class, 'create18']);
    Route::get('/client/admin18/data-agama18/edit18-{id}', [ClientAgama::class, 'edit18']);
    Route::put('/client/admin18/data-agama18/update18', [ClientAgama::class, 'update18']);
    Route::get('/client/admin18/data-agama18/delete18-{id}', [ClientAgama::class, 'delete18']);
    Route::get('/client/admin18/dashboard18/detail18-{id}', [ClientDetail::class, 'index18']);
});
Route::middleware('auth', 'isUser')->group(function () {
    // Route::get('/dashboard18', [User18Controller::class, 'index18'])->name('home');
    Route::get('/dashboard18', function () {
        return redirect('client/dashboard18');
    });
    Route::get('/dashboard18/edit-data18', [User18Controller::class, 'edit18']);
    Route::get('/dashboard18/ganti-password18', [User18Controller::class, 'gantipass18']);
    Route::post('/dashboard18/update-password18', [User18Controller::class, 'updatepass18']);
    Route::post('/dashboard18/update-data18', [User18Controller::class, 'update18']);
    Route::post('/dashboard18/update-foto-profil18', [Admin18Controller::class, 'update_foto18']);

    //Client API
    Route::get('/client/dashboard18', [ClientUser::class, 'index18'])->name('home');
    Route::get('/client/dashboard18/edit-data18', [ClientUser::class, 'edit18']);
    Route::get('/client/dashboard18/ganti-password18', [ClientUser::class, 'gantipass18']);
    Route::post('/client/dashboard18/update-password18', [ClientUser::class, 'updatepass18']);
    Route::put('/client/dashboard18/update-data18', [ClientUser::class, 'update18']);
    Route::put('/client/dashboard18/update-foto-profil18', [ClientAdmin::class, 'update_foto18']);
});