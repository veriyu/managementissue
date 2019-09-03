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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('issue')->group(function(){
	Route::get('/','IssueController@index')->name('issue.index');       
	Route::get('create','IssueController@create')->name('issue.create');    
	Route::post('/','IssueController@store')->name('issue.store');  
	Route::delete('remove/{issue}','IssueController@remove')->name('issue.remove');      
	Route::get('trash','IssueController@trash')->name('issue.trash');       
	Route::put('{issue}','IssueController@update')->name('issue.update');      
	Route::get('{issue}','IssueController@show ')->name('issue.show');       
	Route::delete('{issue}','IssueController@destroy')->name('issue.destroy');     
	Route::get('{issue}/edit','IssueController@edit')->name('issue.edit');
	Route::post('restore/{issue}','IssueController@restore')->name('issue.restore');
	
});
