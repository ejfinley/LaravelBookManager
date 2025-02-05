<?php

use Illuminate\Http\Request;

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
// Auth is curently not required 
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', function () {
    return redirect()->action('BookController@index');;
});
Route::get('/books/exportoptions', 'BookController@exportPage') -> name('books.exportpage'); 
Route::get('/books/export', 'BookController@export') -> name('books.export'); 
Route::get('/books/query', 'BookController@query') -> name('books.query'); 
Route::resource('books', 'BookController');


