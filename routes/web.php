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
use App\Http\Controllers\Book;
use App\Http\Controllers\Inventory;
use App\Http\Controllers\NewStock;
use App\Http\Controllers\Requisition;
use App\Http\Controllers\BookReturn;
use App\Http\Controllers\School;
use App\Http\Controllers\Bookshop;



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

Route::group(['prefix' => 'book', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Book\BookController::class, 'index'])->name('books.index');
    Route::get('/create', [Book\BookController::class, 'create'])->name('books.create');
    Route::get('/show/{book}', [Book\BookController::class, 'show'])->name('books.show');
    Route::get('/edit/{book}', [Book\BookController::class, 'edit'])->name('books.edit');
    Route::post('/create', [Book\BookController::class, 'store'])->name('books.store');
    Route::post('/update/{book}', [Book\BookController::class, 'update'])->name('books.update');
    Route::get('/new/stock/{book}', [Book\BookController::class, 'new_stock'])->name('books.new_stock');
    Route::post('/new/stock/{book}', [Book\BookController::class, 'save_new_stock'])->name('books.save_new_stock');
});

Route::group(['prefix' => 'inventory', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Inventory\InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/create', [Inventory\InventoryController::class, 'create'])->name('inventories.create');
    Route::get('/show/{inventory}', [Inventory\InventoryController::class, 'show'])->name('inventories.show');
    Route::get('/edit/{inventory}', [Inventory\InventoryController::class, 'edit'])->name('inventories.edit');
    Route::post('/create', [Inventory\InventoryController::class, 'store'])->name('inventories.store');
    Route::post('/update/{inventory}', [Inventory\InventoryController::class, 'update'])->name('inventories.update');
});

Route::group(['prefix' => 'new-stock', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [NewStock\NewStockController::class, 'index'])->name('new-stocks.index');
    Route::get('/create', [NewStock\NewStockController::class, 'create'])->name('new-stocks.create');
    Route::get('/show/{newStock}', [NewStock\NewStockController::class, 'show'])->name('new-stocks.show');
    Route::get('/edit/{newStock}', [NewStock\NewStockController::class, 'edit'])->name('new-stocks.edit');
    Route::post('/create', [NewStock\NewStockController::class, 'store'])->name('new-stocks.store');
    Route::post('/update/{newStock}', [NewStock\NewStockController::class, 'update'])->name('new-stocks.update');
});

Route::group(['prefix' => 'requisition', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Requisition\RequisitionController::class, 'index'])->name('requisitions.index');
    Route::get('/create/{book}', [Requisition\RequisitionController::class, 'create'])->name('requisitions.create');
    Route::get('/show/{requisition}', [Requisition\RequisitionController::class, 'show'])->name('requisitions.show');
    Route::get('/edit/{requisition}', [Requisition\RequisitionController::class, 'edit'])->name('requisitions.edit');
    Route::post('/create', [Requisition\RequisitionController::class, 'store'])->name('requisitions.store');
    Route::post('/update/{requisition}', [Requisition\RequisitionController::class, 'update'])->name('requisitions.update');
    Route::get('/book', [Requisition\RequisitionController::class, 'index_book'])->name('requisitions.index-book');
    Route::get('/approve/{requisition}', [Requisition\RequisitionController::class, 'approve'])->name('requisitions.approve');
    Route::post('/approve/{requisition}', [Requisition\RequisitionController::class, 'approveData'])->name('requisitions.approveData');
    Route::get('/pickup/{requisition}', [Requisition\RequisitionController::class, 'pickup'])->name('requisitions.pickup');
    Route::post('/pickup/{requisition}', [Requisition\RequisitionController::class, 'pickupData'])->name('requisitions.pickupData');
});

Route::group(['prefix' => 'book-return', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BookReturn\BookReturnController::class, 'index'])->name('book-returns.index');
    Route::get('/create/{requisition}', [BookReturn\BookReturnController::class, 'create'])->name('book-returns.create');
    Route::get('/show/{bookReturn}', [BookReturn\BookReturnController::class, 'show'])->name('book-returns.show');
    Route::get('/edit/{bookReturn}', [BookReturn\BookReturnController::class, 'edit'])->name('book-returns.edit');
    Route::post('/create', [BookReturn\BookReturnController::class, 'store'])->name('book-returns.store');
    Route::post('/update/{bookReturn}', [BookReturn\BookReturnController::class, 'update'])->name('book-returns.update');
});

Route::group(['prefix' => 'school', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [School\SchoolController::class, 'index'])->name('schools.index');
    Route::get('/create', [School\SchoolController::class, 'create'])->name('schools.create');
    Route::post('/create', [School\SchoolController::class, 'store'])->name('schools.store');
    Route::get('/show/{school}', [School\SchoolController::class, 'show'])->name('schools.show');
    Route::get('/edit/{school}', [School\SchoolController::class, 'edit'])->name('schools.edit');
    Route::post('/update/{school}', [School\SchoolController::class, 'update'])->name('schools.update');
});

Route::group(['prefix' => 'bookshop', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Bookshop\BookshopController::class, 'index'])->name('bookshops.index');
    Route::get('/create', [Bookshop\BookshopController::class, 'create'])->name('bookshops.create');
    Route::post('/create', [Bookshop\BookshopController::class, 'store'])->name('bookshops.store');
    Route::get('/show/{bookshop}', [Bookshop\BookshopController::class, 'show'])->name('bookshops.show');
    Route::get('/edit/{bookshop}', [Bookshop\BookshopController::class, 'edit'])->name('bookshops.edit');
    Route::post('/update/{bookshop}', [Bookshop\BookshopController::class, 'update'])->name('bookshops.update');
});
