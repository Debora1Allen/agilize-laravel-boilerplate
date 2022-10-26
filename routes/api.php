<?php

use App\Packages\Aluno\Controller\AlunoController;
use App\Packages\Prova\Controller\ProvaController;
use App\Packages\Prova\Controller\QuestaoController;
use App\Packages\Prova\Controller\RespostaController;
use App\Packages\Prova\Controller\TemaController;
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
Route::get('alunos/{id_aluno}/provas',[AlunoController::class, 'listalunoProvas']);
Route::get('/prova', [ProvaController::class, 'show']);
Route::post('/prova', [ProvaController::class, 'store']);
Route::get('/prova', [ProvaController::class, 'index']);
Route::put('/prova/{id_prova}', [ProvaController::class, 'enviarRepostas']);
Route::get('/questoes', [QuestaoController::class, 'index']);
Route::get('/questoes/{id_questao}', [QuestaoController::class, 'show']);
Route::post('/questoes', [QuestaoController::class, 'store']);
Route::put('/questoes', [QuestaoController::class, 'createRespostas']);
Route::get('/questoes', [TemaController::class, 'index']);
Route::get('/tema', [TemaController::class, 'store']);










