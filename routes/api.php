<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CidadeController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cidades', [CidadeController::class, 'index']);
Route::post('cidades', [CidadeController::class,'store']);
Route::get('cidades/{nomeEstado}', [CidadeController::class,'show']);
Route::get('cidades/{id}/edit', [CidadeController::class,'edit']);
Route::put('cidades/{id}/edit', [CidadeController::class,'update']);
Route::delete('cidades/{id}/delete', [CidadeController::class,'destroy']);

