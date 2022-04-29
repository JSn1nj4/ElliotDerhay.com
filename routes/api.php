<?php

use App\Http\Controllers\GithubEventController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TweetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Retrieve list of tweets
Route::get('/tweets', [TweetController::class, 'index']);
Route::get('/tweets/{count}', [TweetController::class, 'index']);
Route::get('/tweets/{count}/demo', [TweetController::class, 'index']);

// Retrieve GitHub events
Route::get('/github/events', [GithubEventController::class, 'index']);
Route::get('/github/events/{count}', [GithubEventController::class, 'index']);
