<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZonesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//////////////////////////
// AUTH
//////////////////////////

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//////////////////////////
// PAGES (PROTÉGÉES)
//////////////////////////

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('dashbord');
    })->name('dashbord');

    // Sous-traitants
    Route::get('/sous-traitants', function () {
        return view('sous_traitants');
    })->name('sous_traitants.index');

    // Tickets
    Route::get('/tickets', function () {
        return view('tickets');
    })->name('tickets.index');

    // KPI
    Route::get('/kpi-rapports', function () {
        return view('kpi_rapports');
    })->name('kpi_rapports.index');

    // Paramètres
    Route::get('/parametres', function () {
        return view('parametres');
    })->name('parametres.index');

    // Utilisateurs (vue simple)
    Route::get('/gestion-utilisateurs', function () {
        return view('gestion_utilisateurs');
    })->name('gestion_utilisateurs.index');

});


//////////////////////////
// USERS (CRUD)
//////////////////////////

Route::prefix('users')->name('users.')->middleware('auth')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    Route::patch('/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');

});


//////////////////////////
// ZONES (CRUD)
//////////////////////////

Route::prefix('zones')->name('zones.')->middleware('auth')->group(function () {

    Route::get('/', [ZonesController::class, 'index'])->name('index');
    Route::post('/', [ZonesController::class, 'store'])->name('store');
    Route::put('/{id}', [ZonesController::class, 'update'])->name('update');
    Route::delete('/{id}', [ZonesController::class, 'destroy'])->name('destroy');

});
