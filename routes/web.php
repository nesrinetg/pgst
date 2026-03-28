<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});


// Login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (protégé par auth)
Route::get('/dashboard', function () {
    return view('dashbord');
})->middleware('auth');


// Autres pages protégées
Route::get('/sous-traitants', function () {
    return view('sous_traitants');
})->middleware('auth')->name('sous-traitants.index');

Route::get('/zones', function () {
    return view('zones');
})->middleware('auth')->name('zones.index');

Route::get('/tickets', function () {
    return view('tickets');
})->middleware('auth')->name('tickets.index');

Route::get('/kpi-rapports', function () {
    return view('kpi_rapports');
})->middleware('auth')->name('kpi-rapports.index');

Route::get('/parametres', function () {
    return view('parametres');
})->middleware('auth')->name('parametres.index');

Route::get('/gestion_utilisateurs', function () {
    return view('gestion_utilisateurs');
})->middleware('auth')->name('gestion_utilisateurs.index');