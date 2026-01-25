<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\User;
use App\Http\Controllers\ZonalSalesOfficer;
use App\Http\Controllers\Zone;
use App\Http\Controllers\Territories;
use App\Http\Controllers\Subject;
use App\Http\Controllers\Level;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [Auth\LoginController::class, 'index'])->name('auth.index');
Route::post('/login', [Auth\LoginController::class, 'login'])->name('auth.login');
Route::get('/logout', [Auth\LoginController::class, 'logout'])->name('auth.logout');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/operational', [Dashboard\DashboardController::class, 'operational'])->name('dashboard.operational');
    Route::get('/financial', [Dashboard\DashboardController::class, 'financial'])->name('dashboard.financial');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [User\UserController::class, 'index'])->name('users.index');
    Route::get('/create', [User\UserController::class, 'create'])->name('users.create');
    Route::get('/show/{user}', [User\UserController::class, 'show'])->name('users.show');
    Route::get('/edit/{user}', [User\UserController::class, 'edit'])->name('users.edit');
    Route::post('/create', [User\UserController::class, 'store'])->name('users.store');
    Route::post('/update/{user}', [User\UserController::class, 'update'])->name('users.update');
});

Route::group(['prefix' => 'zonal-sales-officer', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ZonalSalesOfficer\ZonalSalesOfficerController::class, 'index'])->name('zonal-sales-officers.index');
    Route::get('/create', [ZonalSalesOfficer\ZonalSalesOfficerController::class, 'create'])->name('zonal-sales-officers.create');
    Route::get('/show/{zonalSalesOfficer}', [ZonalSalesOfficer\ZonalSalesOfficerController::class, 'show'])->name('zonal-sales-officers.show');
    Route::get('/edit/{zonalSalesOfficer}', [ZonalSalesOfficer\ZonalSalesOfficerController::class, 'edit'])->name('zonal-sales-officers.edit');
    Route::post('/create', [ZonalSalesOfficer\ZonalSalesOfficerController::class, 'store'])->name('zonal-sales-officers.store');
    Route::post('/update/{zonalSalesOfficer}', [ZonalSalesOfficer\ZonalSalesOfficerController::class, 'update'])->name('zonal-sales-officers.update');
});

Route::group(['prefix' => 'zones', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Zone\ZoneController::class, 'index'])->name('zones.index');
    Route::get('/create', [Zone\ZoneController::class, 'create'])->name('zones.create');
    Route::get('/show/{zone}', [Zone\ZoneController::class, 'show'])->name('zones.show');
    Route::get('/edit/{zone}', [Zone\ZoneController::class, 'edit'])->name('zones.edit');
    Route::post('/create', [Zone\ZoneController::class, 'store'])->name('zones.store');
    Route::post('/update/{zone}', [Zone\ZoneController::class, 'update'])->name('zones.update');
});

Route::group(['prefix' => 'territory', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Territories\TerritoriesController::class, 'index'])->name('territories.index');
    Route::get('/create', [Territories\TerritoriesController::class, 'create'])->name('territories.create');
    Route::get('/show/{territory}', [Territories\TerritoriesController::class, 'show'])->name('territories.show');
    Route::get('/edit/{territory}', [Territories\TerritoriesController::class, 'edit'])->name('territories.edit');
    Route::post('/create', [Territories\TerritoriesController::class, 'store'])->name('territories.store');
    Route::post('/update/{territory}', [Territories\TerritoriesController::class, 'update'])->name('territories.update');
});

Route::group(['prefix' => 'subject', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Subject\SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/create', [Subject\SubjectController::class, 'create'])->name('subjects.create');
    Route::get('/show/{subject}', [Subject\SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/edit/{subject}', [Subject\SubjectController::class, 'edit'])->name('subjects.edit');
    Route::post('/create', [Subject\SubjectController::class, 'store'])->name('subjects.store');
    Route::post('/update/{subject}', [Subject\SubjectController::class, 'update'])->name('subjects.update');
});

Route::group(['prefix' => 'level', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Level\LevelController::class, 'index'])->name('levels.index');
    Route::get('/create', [Level\LevelController::class, 'create'])->name('levels.create');
    Route::get('/show/{level}', [Level\LevelController::class, 'show'])->name('levels.show');
    Route::get('/edit/{level}', [Level\LevelController::class, 'edit'])->name('levels.edit');
    Route::post('/create', [Level\LevelController::class, 'store'])->name('levels.store');
    Route::post('/update/{level}', [Level\LevelController::class, 'update'])->name('levels.update');
});
