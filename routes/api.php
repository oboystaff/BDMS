<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Zone;
use App\Http\Controllers\Region;
use App\Http\Controllers\Territory;
use App\Http\Controllers\SalesAgent;
use App\Http\Controllers\RegistrationType;
use App\Http\Controllers\Registration;
use App\Http\Controllers\User;
use App\Http\Controllers\Auth;


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

Route::post('/login', [Auth\LoginController::class, 'index']);

Route::get('/zones', [Zone\ZoneController::class, 'index']);
Route::get('/zone/show/{id}', [Zone\ZoneController::class, 'show']);
Route::post('/zone/create', [Zone\ZoneController::class, 'store']);
Route::post('/zone/update/{id}', [Zone\ZoneController::class, 'update']);

Route::get('/regions', [Region\RegionController::class, 'index']);
Route::get('/region/show/{id}', [Region\RegionController::class, 'show']);
Route::post('/region/create', [Region\RegionController::class, 'store']);
Route::post('/region/update/{id}', [Region\RegionController::class, 'update']);

Route::get('/territories', [Territory\TerritoryController::class, 'index']);
Route::get('/territory/show/{id}', [Territory\TerritoryController::class, 'show']);
Route::post('/territory/create', [Territory\TerritoryController::class, 'store']);
Route::post('/territory/update/{id}', [Territory\TerritoryController::class, 'update']);

Route::get('/sales-agents', [SalesAgent\SalesAgentController::class, 'index']);
Route::get('/sales-agent/show/{id}', [SalesAgent\SalesAgentController::class, 'show']);
Route::post('/sales-agent/create', [SalesAgent\SalesAgentController::class, 'store']);
Route::post('/sales-agent/update/{id}', [SalesAgent\SalesAgentController::class, 'update']);

Route::get('/registration-types', [RegistrationType\RegistrationTypeController::class, 'index']);
Route::get('/registration-type/show/{id}', [RegistrationType\RegistrationTypeController::class, 'show']);
Route::post('/registration-type/create', [RegistrationType\RegistrationTypeController::class, 'store']);
Route::post('/registration-type/update/{id}', [RegistrationType\RegistrationTypeController::class, 'update']);

Route::get('/registrations', [Registration\RegistrationController::class, 'index']);
Route::get('/registration/show/{id}', [Registration\RegistrationController::class, 'show']);
Route::post('/registration/create/school', [Registration\RegistrationController::class, 'storeSchool']);
Route::post('/registration/create/bookshop', [Registration\RegistrationController::class, 'storeBookshop']);
Route::post('/registration/create/wholesale', [Registration\RegistrationController::class, 'storeWholesale']);
Route::post('/registration/update/school/{id}', [Registration\RegistrationController::class, 'updateSchool']);
Route::post('/registration/update/bookshop/{id}', [Registration\RegistrationController::class, 'updateBookshop']);
Route::post('/registration/update/wholesale/{id}', [Registration\RegistrationController::class, 'updateWholesale']);

Route::get('/users', [User\UserController::class, 'index']);
Route::get('/user/show/{id}', [User\UserController::class, 'show']);
Route::post('/user/create', [User\UserController::class, 'store']);
Route::post('/user/update/{id}', [User\UserController::class, 'update']);
