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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/profile/{id}','ProfileController@index')->name('profile');
// لا ينصح بوضع الـ id ضمن route الـ profile حتى لا يتسلل المخترقين لهذا الموقع ويتم تغيير الـ id الخاص بهذا الـ profile
// بل هناك طريقة يتم من خلال الـ controller بتحديد الـ id للـ user وذلك بمساعدة المكتبة Auth
Route::get('/profile','ProfileController@index')->name('profile');
Route::put('/profile/update','ProfileController@update')->
       name('profile.update');
Route::get('/more/info','ProfileController@show')
->name('show');


// Routes for posts
// يمكننا أن نضع :
//  Route::resources('/posts','PostController');
// ويمكننا أن نتبع التشكيل التالي :
Route::get('/posts','PostController@index')->name('posts');
Route::get('/posts/trashed','PostController@postsTrashed')->name('posts.trashed');
Route::get('/post/create','PostController@create')->name('post.create');
Route::post('/post/store','PostController@store')->name('post.store');
Route::get('/post/show/{slug}','PostController@show')->name('post.show');
Route::get('/post/edit/{id}','PostController@edit')->name('post.edit');
Route::post('/post/update/{id}','PostController@update')->name('post.update');
Route::get('/post/destroy/{id}','PostController@destroy')->name('post.destroy');
Route::get('/post/hdelete/{id}','PostController@hdelete')->name('post.hdelete');
Route::get('/post/restore/{id}','PostController@restore')->name('post.restore');
