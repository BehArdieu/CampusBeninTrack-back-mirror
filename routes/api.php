<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AnnoncesController;
use App\Http\Controllers\API\PositionnementsController;
use App\Http\Controllers\API\ReponsesController;
use App\Http\Controllers\API\VillesController;

// Route::middleware('api')->group(function () {
    Route::post('/auth/google', [AuthController::class, 'googleAuth']);
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);

        Route::get('/villes', [VillesController::class, 'index']);
        Route::get('/villes/search', [VillesController::class, 'search']);

        Route::apiResource('annonces', AnnoncesController::class);

        Route::apiResource('positionnements', PositionnementsController::class);
        Route::post('/positionnements/{positionnement}/accepter', [PositionnementsController::class, 'accepter']);
        Route::post('/positionnements/{positionnement}/refuser',  [PositionnementsController::class, 'refuser']);

        Route::apiResource('reponses', ReponsesController::class);
        Route::post('/reponses/{reponse}/statut', [ReponsesController::class, 'updateStatut']);
    });
// });
