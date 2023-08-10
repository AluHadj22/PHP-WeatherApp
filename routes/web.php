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
Route::post('/weather', 'WeatherController@getWeather'); // это у меня маршрут к контроллеру 

Route::view('/weather', 'weather'); // это у меня маршрут к файлу с html страницей
//Это основной путь - надо прописать в адресной строке путь weather, который указал выше со слешем
Route::get('/', function () {
    return view('welcome');
});
