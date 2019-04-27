<?php

use Illuminate\Http\Request;

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

// Route Group for: Non-Versioned API
Route::middleware(['auth:api'])
    ->namespace('Api')
    ->as('api.')
    ->group(function () {

    // Show the authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('users.show');

	// CRUD for articles
    Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show', 'store']]);
});
