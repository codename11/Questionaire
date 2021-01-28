<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getQuestionaires','QuestionairesController@index');
Route::post('setQuestionaire','QuestionairesController@store');
Route::patch('updateQuestionaire','QuestionairesController@update');

Route::get('getQuestions','QuestionsController@index');
Route::post('setQuestion','QuestionsController@store');

Route::get('getAnswers','AnswersController@index');
Route::post('setAnswer','AnswersController@store');