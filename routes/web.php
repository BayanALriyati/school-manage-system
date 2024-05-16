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

	// routes/web.php
	Auth::routes();
	Route::get('/', function()
	{
		return view('auth.login');
	});

	//refresh the website save the language
	Route::group(
		[
			'prefix' => LaravelLocalization::setLocale(),
			'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
		], function(){ 
	                /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	                // Route::get('/', function()
	                // {
                    //     return view('dashboard');
	                // });
               
		
					Route::resource('grade', 'GradeController');
		}); 

			
	

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

// Route::get('/', function () {
//     return view('dashboard');
// });




Route::get('/home', 'HomeController@index')->name('home');
