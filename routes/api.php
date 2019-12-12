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

Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function ($router) {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');


    Route::group(['prefix' => 'materias'], function () {
        Route::get('/listMaterias', 'MateriasController@listMaterias');
    });
    Route::group(['prefix' => 'professores'], function () {
        Route::post('/tornarProfessor', 'ProfessoresController@tornarProfessor');
    });
    Route::group(['prefix' => 'alunos'], function () {
        Route::post('/createAlunoWithResponsavel', 'AlunosController@createAlunoWithResponsavel');
        Route::get('/listAlunosTurma/{turmaId}', 'AlunosController@listAlunosTurma');
        Route::put('/editAluno/{id}', 'AlunosController@editAluno');
        Route::delete('/destroyAluno/{id}', 'AlunosController@destroyAluno');
    });
    Route::group(['prefix' => 'turmas'], function () {
        Route::get('/listTurmas', 'TurmasController@listTurmas');
        Route::post('/createTurma', 'TurmasController@createTurma');
        Route::put('/editTurma/{id}', 'TurmasController@editTurma');
        Route::delete("/destroyTurma/{id}", 'TurmasController@destroyTurma');
    });
    Route::group(['prefix' => 'presencas'], function () {
        Route::post('/storePresencas', 'PresencasController@storePresencas');
    });
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
