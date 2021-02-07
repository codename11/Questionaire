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

Route::get('getQuestionaires','api\QuestionairesController@index')->name('getQuestionaires')->middleware('auth:api');
Route::post('setQuestionaire','Api\QuestionairesController@store')->name('setQuestionaire')->middleware('auth:api');
Route::patch('updateQuestionaire','Api\QuestionairesController@update')->name('updateQuestionaire')->middleware('auth:api');
Route::delete('deleteQuestionaire','Api\QuestionairesController@destroy')->name('profdeleteQuestionaireile')->middleware('auth:api');
Route::get('getQuestionaire','Api\QuestionairesController@show')->name('getQuestionaire')->middleware('auth:api');

Route::get('getQuestions','Api\QuestionsController@index')->name('getQuestions')->middleware('auth:api');
Route::post('setQuestion','Api\QuestionsController@store')->name('setQuestion')->middleware('auth:api');
Route::patch('updateQuestion','Api\QuestionsController@update')->name('updateQuestion')->middleware('auth:api');
Route::get('getQuestion','Api\QuestionsController@show')->name('getQuestion')->middleware('auth:api');
Route::delete('deleteQuestion','Api\QuestionsController@destroy')->name('deleteQuestion')->middleware('auth:api');

Route::get('getAnswers','Api\AnswersController@index')->name('getAnswers')->middleware('auth:api');
Route::post('setAnswer','Api\AnswersController@store')->name('setAnswer')->middleware('auth:api');
Route::get('getAnswer','Api\AnswersController@show')->name('getAnswer')->middleware('auth:api');
Route::patch('updateAnswer','Api\AnswersController@update')->name('updateAnswer')->middleware('auth:api');
Route::delete('deleteAnswer','Api\AnswersController@destroy')->name('deleteAnswer')->middleware('auth:api');

Route::patch('connect','Api\PivotQuestionaireController@update')->name('connect')->middleware('auth:api');

Route::get('getStatuses','Api\StatusController@index')->name('getStatuses')->middleware('auth:api');
Route::post('setStatus','Api\StatusController@store')->name('setStatus')->middleware('auth:api');
Route::get('getStatus','Api\StatusController@show')->name('getStatus')->middleware('auth:api');
Route::patch('updateStatus','Api\StatusController@update')->name('updateStatus')->middleware('auth:api');
Route::delete('deleteStatus','Api\StatusController@destroy')->name('deleteStatus')->middleware('auth:api');

Route::get('getRoles','Api\RolesController@index')->name('getRoles')->middleware('auth:api');
Route::post('setRole','Api\RolesController@store')->name('setRole')->middleware('auth:api');
Route::get('getRole','Api\RolesController@show')->name('getRole')->middleware('auth:api');
Route::patch('updateRole','Api\RolesController@update')->name('updateRole')->middleware('auth:api');
Route::delete('deleteRole','Api\RolesController@destroy')->name('deleteRole')->middleware('auth:api');

Route::get('getFieldTypes','Api\FieldTypeController@index')->name('getFieldTypes')->middleware('auth:api');
Route::post('setFieldType','Api\FieldTypeController@store')->name('setFieldType')->middleware('auth:api');
Route::get('getFieldType','Api\FieldTypeController@show')->name('getFieldType')->middleware('auth:api');
Route::patch('updateFieldType','Api\FieldTypeController@update')->name('updateFieldType')->middleware('auth:api');
Route::delete('deleteFieldType','Api\FieldTypeController@destroy')->name('deleteFieldType')->middleware('auth:api');

Route::get('getRightAnswers','Api\RightAnswersController@index')->name('getRightAnswers')->middleware('auth:api');
Route::post('setRightAnswer','Api\RightAnswersController@store')->name('setRightAnswer')->middleware('auth:api');
Route::get('getRightAnswer','Api\RightAnswersController@show')->name('getRightAnswer')->middleware('auth:api');
Route::patch('updateRightAnswer','Api\RightAnswersController@update')->name('updateRightAnswer')->middleware('auth:api');
Route::delete('deleteRightAnswer','Api\RightAnswersController@destroy')->name('deleteRightAnswer')->middleware('auth:api');