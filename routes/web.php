<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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
    if(auth()->user()){
        auth()->user()->assignRole('admin');
    }
    return view('welcome');
});

Auth::routes();
Route::resource('home', HomeController::class);

Route::get('/tests/{id}',
[
    'as' => 'tests.get',
    'uses' => 'App\Http\Controllers\HomeController@getQuestion'
]);
Route::get('/session',
[
    'as' => 'session.get',
    'uses' => 'App\Http\Controllers\HomeController@getResult'
]);

Route::get('/result{id}',
[
    'as' => 'result',
    'uses'=> 'App\Http\Controllers\HomeController@sessionResult'
]);

Route::get('/userResult{id}',
[
    'as' => 'userResult',
    'uses'=> 'App\Http\Controllers\HomeController@userResult'
]);
Route::get('/session{id}',
[
    'as' => 'results.get',
    'uses'=> 'App\Http\Controllers\HomeController@result'
]);

Route::get('/addTests', 'App\Http\Controllers\HomeController@addTests')->name('addTests');

Route::get('/storeTest',
[
    'as' => 'storeTest',
    'uses' => 'App\Http\Controllers\HomeController@storeTest'
]);

Route::get('/sResult/sub_id{subjectId}/user_id{userId}',
[
    'as' =>'sResult',
    'uses' => 'App\Http\Controllers\HomeController@sResult'
]
);


