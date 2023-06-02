<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CollectionsController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('all-collections', [
            CollectionsController::class,
            'index',
        ])->name('all-collections.index');
        Route::post('all-collections', [
            CollectionsController::class,
            'store',
        ])->name('all-collections.store');
        Route::get('all-collections/create', [
            CollectionsController::class,
            'create',
        ])->name('all-collections.create');
        Route::get('all-collections/{collections}', [
            CollectionsController::class,
            'show',
        ])->name('all-collections.show');
        Route::get('all-collections/{collections}/edit', [
            CollectionsController::class,
            'edit',
        ])->name('all-collections.edit');
        Route::put('all-collections/{collections}', [
            CollectionsController::class,
            'update',
        ])->name('all-collections.update');
        Route::delete('all-collections/{collections}', [
            CollectionsController::class,
            'destroy',
        ])->name('all-collections.destroy');

        Route::get('all-rentals', [RentalsController::class, 'index'])->name(
            'all-rentals.index'
        );
        Route::post('all-rentals', [RentalsController::class, 'store'])->name(
            'all-rentals.store'
        );
        Route::get('all-rentals/create', [
            RentalsController::class,
            'create',
        ])->name('all-rentals.create');
        Route::get('all-rentals/{rentals}', [
            RentalsController::class,
            'show',
        ])->name('all-rentals.show');
        Route::get('all-rentals/{rentals}/edit', [
            RentalsController::class,
            'edit',
        ])->name('all-rentals.edit');
        Route::put('all-rentals/{rentals}', [
            RentalsController::class,
            'update',
        ])->name('all-rentals.update');
        Route::delete('all-rentals/{rentals}', [
            RentalsController::class,
            'destroy',
        ])->name('all-rentals.destroy');

        Route::get('all-series', [SeriesController::class, 'index'])->name(
            'all-series.index'
        );
        Route::post('all-series', [SeriesController::class, 'store'])->name(
            'all-series.store'
        );
        Route::get('all-series/create', [
            SeriesController::class,
            'create',
        ])->name('all-series.create');
        Route::get('all-series/{series}', [
            SeriesController::class,
            'show',
        ])->name('all-series.show');
        Route::get('all-series/{series}/edit', [
            SeriesController::class,
            'edit',
        ])->name('all-series.edit');
        Route::put('all-series/{series}', [
            SeriesController::class,
            'update',
        ])->name('all-series.update');
        Route::delete('all-series/{series}', [
            SeriesController::class,
            'destroy',
        ])->name('all-series.destroy');

        Route::resource('users', UserController::class);
        Route::resource('videos', VideoController::class);
    });
