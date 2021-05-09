<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students','App\Http\Controllers\StudentsController@index');
Route::get('/students/create','App\Http\Controllers\StudentsController@create');
Route::post('/students','App\Http\Controllers\StudentsController@store');
Route::get('/students/{student}','App\Http\Controllers\StudentsController@show');
Route::get('/students/{student}/edit','App\Http\Controllers\StudentsController@edit');
Route::put('/students/{student}','App\Http\Controllers\StudentsController@update');
Route::delete('/students/{student}','App\Http\Controllers\StudentsController@destroy');


Route::get('/studentmarks','App\Http\Controllers\StudentMarksController@index');
Route::get('/studentmarks/create','App\Http\Controllers\StudentMarksController@create');
Route::post('/studentmarks','App\Http\Controllers\StudentMarksController@store');
Route::get('/studentmarks/{studentmarks}','App\Http\Controllers\StudentMarksController@show');
Route::get('/studentmarks/{studentmarks}/edit','App\Http\Controllers\StudentMarksController@edit');
Route::put('/studentmarks/{studentmarks}','App\Http\Controllers\StudentMarksController@update');
Route::delete('/studentmarks/{studentmarks}','App\Http\Controllers\StudentMarksController@destroy');
