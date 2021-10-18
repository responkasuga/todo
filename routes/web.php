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
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Routing\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('todos', 'TodosController');
// Route::resource の一部使用・未使用分削除
// Route::resource('hoge', 'HogeController', ['only' => ['index', 'create', 'edit', 'store', 'destroy']]);

// Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
