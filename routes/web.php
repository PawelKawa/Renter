<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RealtorListingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;
use Inertia\Middleware;

Route::get('/', [IndexController::class, 'index']);
Route::get('/test', [IndexController::class, 'test'])->name('test');

Route::resource('listing', ListingController::class)
->only(['create', 'store'])
->middleware('auth');
//only those above need authenticated user.
// you don't have to be login to use any of pages except below one it could be: ->only(['index', 'show']) only those are allowed
Route::resource('listing', ListingController::class)
->only(['index', 'show']);

Route::get('login', [AuthController::class, 'create'])
  ->name('login');
Route::post('login', [AuthController::class, 'store'])
  ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
  ->name('logout');

  Route::resource('user-account', UserAccountController::class)
  ->only(['create', 'store']);

  Route::prefix('realtor')
  ->name('realtor.')
  ->middleware('auth')
  ->group(function(){
    Route::name('listing.restore')
    ->put(
      'listing/{listing}/restore',
      [RealtorListingController::class, 'restore']
    )->withTrashed();
    Route::resource('listing', RealtorListingController::class)
    ->only(['index', 'destroy', 'edit', 'update', 'create', 'store'])
    ->withTrashed();
  });