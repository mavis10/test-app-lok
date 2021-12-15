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

Route::get('/', '\App\Http\Controllers\LanguageController@index')->name('languageIndex');
Route::get('/languages', '\App\Http\Controllers\LanguageController@index')->name('languageIndex');

Route::post('/language/store', '\App\Http\Controllers\LanguageController@store');
Route::get('/language/show/{id}', '\App\Http\Controllers\LanguageController@show')->name('languageShow');
Route::post('/language/destroy', '\App\Http\Controllers\LanguageController@destroy');
Route::post('/language/update', '\App\Http\Controllers\LanguageController@update');

Route::get('/translationKeys', '\App\Http\Controllers\TranslationKeyController@index')->name('translationKeyIndex');
Route::post('/translationKey/store', '\App\Http\Controllers\TranslationKeyController@store');
Route::get('/translationKey/show/{id}', '\App\Http\Controllers\TranslationKeyController@show')->name('translationKeyShow');
Route::post('/translationKey/destroy', '\App\Http\Controllers\TranslationKeyController@destroy');
Route::post('/translationKey/update', '\App\Http\Controllers\TranslationKeyController@update');

Route::get('/translations', '\App\Http\Controllers\TranslationController@index')->name('translationIndex');
Route::post('/translation/store', '\App\Http\Controllers\TranslationController@store');
Route::get('/translation/show/{id}', '\App\Http\Controllers\TranslationController@show')->name('translationShow');
Route::post('/translation/destroy', '\App\Http\Controllers\TranslationController@destroy');
Route::post('/translation/update', '\App\Http\Controllers\TranslationController@update');

Route::get('/translation/export', '\App\Http\Controllers\TranslationController@export')->name('translationExport');
