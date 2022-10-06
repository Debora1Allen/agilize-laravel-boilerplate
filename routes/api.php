<?php

use App\Packages\Aluno\Controller\AlunoController;
use App\Packages\Prova\Controller\ProvaController;
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


Route::get('/healthcheck', function () {
    return json_encode(['status' => true]);
});

Route::get('/aluno', [AlunoController::class, 'index']);
Route::post('/aluno', [AlunoController::class, 'store']);
Route::get('/prova', [ProvaController::class, 'show']);
Route::post('/prova', [ProvaController::class, 'store']);