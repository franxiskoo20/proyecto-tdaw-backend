<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerroController;

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

Route::group(['prefix' => 'perros'], function () {
    Route::get('/random', [PerroController::class, 'perroRandom']);
    Route::get('/getAll', [PerroController::class, 'index']);
    Route::get('/{id}', [PerroController::class, 'show']);
    Route::post('/create', [PerroController::class, 'store']);
    Route::post('/update/{id}', [PerroController::class, 'update']);
    Route::delete('/delete/{id}', [PerroController::class, 'destroy']);
    Route::get('/candidatos/{perroInteresadoId}', [PerroController::class, 'perrosCandidatos']);
});