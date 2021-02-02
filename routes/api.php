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

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::get('getQuestionaires','api\QuestionairesController@index')->middleware('auth:api');
Route::post('setQuestionaire','Api\QuestionairesController@store')->middleware('auth:api');
Route::patch('updateQuestionaire','Api\QuestionairesController@update')->middleware('auth:api');
Route::delete('deleteQuestionaire','Api\QuestionairesController@destroy')->middleware('auth:api');
Route::get('getQuestionaire','Api\QuestionairesController@show')->middleware('auth:api');

Route::get('getQuestions','Api\QuestionsController@index')->middleware('auth:api');
Route::post('setQuestion','Api\QuestionsController@store')->middleware('auth:api');
Route::patch('updateQuestion','Api\QuestionsController@update')->middleware('auth:api');
Route::get('getQuestion','Api\QuestionsController@show')->middleware('auth:api');
Route::delete('deleteQuestion','Api\QuestionsController@destroy')->middleware('auth:api');

Route::get('getAnswers','Api\AnswersController@index')->middleware('auth:api');
Route::post('setAnswer','Api\AnswersController@store')->middleware('auth:api');
Route::get('getAnswer','Api\AnswersController@show')->middleware('auth:api');
Route::patch('updateAnswer','Api\AnswersController@update')->middleware('auth:api');
Route::delete('deleteAnswer','Api\AnswersController@destroy')->middleware('auth:api');

Route::patch('connect','Api\PivotQuestionaireController@update')->middleware('auth:api');

Route::get('getStatuses','Api\StatusController@index')->middleware('auth:api');
Route::post('setStatus','Api\StatusController@store')->middleware('auth:api');
Route::get('getStatus','Api\StatusController@show')->middleware('auth:api');
Route::patch('updateStatus','Api\StatusController@update')->middleware('auth:api');
Route::delete('deleteStatus','Api\StatusController@destroy')->middleware('auth:api');

Route::get('getRoles','Api\RolesController@index')->middleware('auth:api');
Route::post('setRole','Api\RolesController@store')->middleware('auth:api');
Route::get('getRole','Api\RolesController@show')->middleware('auth:api');
Route::patch('updateRole','Api\RolesController@update')->middleware('auth:api');
Route::delete('deleteRole','Api\RolesController@destroy')->middleware('auth:api');

Route::get('getFieldTypes','Api\FieldTypeController@index')->middleware('auth:api');
Route::post('setFieldType','Api\FieldTypeController@store')->middleware('auth:api');
Route::get('getFieldType','Api\FieldTypeController@show')->middleware('auth:api');
Route::patch('updateFieldType','Api\FieldTypeController@update')->middleware('auth:api');
Route::delete('deleteFieldType','Api\FieldTypeController@destroy')->middleware('auth:api');

Route::get('getRightAnswers','Api\RightAnswersController@index')->middleware('auth:api');
Route::post('setRightAnswer','Api\RightAnswersController@store')->middleware('auth:api');
Route::get('getRightAnswer','Api\RightAnswersController@show')->middleware('auth:api');
Route::patch('updateRightAnswer','Api\RightAnswersController@update')->middleware('auth:api');
Route::delete('deleteRightAnswer','Api\RightAnswersController@destroy')->middleware('auth:api');