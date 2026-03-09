<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


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
    return view('welcome');
});
<<<<<<< HEAD
Route::get('/login', function () {
    return view('authentification/login.php');
});

Route::get('/', function () {
    return view('dashbord');
})->name('dashbord');

Route::get('/sous-traitants', function () {
    return view('sous_traitants');
})->name('sous-traitants.index');

Route::get('/zones', function () {
    return view('zones');
})->name('zones.index');

Route::get('/tickets', function () {
    return view('tickets');
})->name('tickets.index');

Route::get('/kpi-rapports', function () {
    return view('kpi_rapports');
})->name('kpi-rapports.index');

Route::get('/parametres', function () {
    return view('parametres');
})->name('parametres.index');

Route::get('/gestion_utilisateurs', function () {
    return view('gestion_utilisateurs');
})->name('gestion_utilisateurs.index');

=======

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashbord');
})->middleware('auth');
>>>>>>> de51f18613b11fd4075884ef68597ca3e04d0191
