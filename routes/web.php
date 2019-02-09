<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'QuestionsController@index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('email/verify/{token}',['as'=>'email.verify','uses'=>'EmailController@verify']);
Route::resource('questions','QuestionsController',['names'=>[
    'create'=>'questions.create',
    'show'=>'questions.show',
]]);
Route::post('questions/{question}/answer','AnswerController@store');
Route::get('questions/{question}/follow','QuestionFollowController@follow');
Route::get('notifications','NotificationController@index');
Route::get('inbox','InboxController@index');
Route::get('inbox/{userId}','InboxController@show');

