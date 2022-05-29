<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\MatchController;
use \App\Http\Controllers\API\TeamController;

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

Route::prefix('v1')->group(function() {
    Route::post('matches/populate', [MatchController::class, 'populate'])->name('match.populate');
    Route::post('matches/play/week/{week}', [MatchController::class, 'play'])->name('play.week');
    Route::post('matches/play/all', [MatchController::class, 'play'])->name('play.all');
    Route::get('teams', [TeamController::class, 'index'])->name('team.index');
});
