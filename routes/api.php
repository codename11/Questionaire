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
Route::delete('deleteQuestionaire','QuestionairesController@destroy');
Route::get('getQuestionaire','QuestionairesController@show');

Route::get('getQuestions','QuestionsController@index');
Route::post('setQuestion','QuestionsController@store');
Route::patch('updateQuestion','QuestionsController@update');
Route::get('getQuestion','QuestionsController@show');
Route::delete('deleteQuestion','QuestionsController@destroy');

Route::get('getAnswers','AnswersController@index');
Route::post('setAnswer','AnswersController@store');
Route::get('getAnswer','AnswersController@show');
Route::patch('updateAnswer','AnswersController@update');
Route::delete('deleteAnswer','AnswersController@destroy');
