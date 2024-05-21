<?php
use App\Http\Controllers\Grades\GradeController;

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
	
	Route::group(['middleware' => ['guest']],function(){
        Route::get('/', function()
	{
		return view('auth.login');
	});

	});

	//refresh the website save the language
	Route::group(
		[
			'prefix' => LaravelLocalization::setLocale(),
			'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
		], function(){ 
	                /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	                // Route::get('/', function()
	                // {
                    //     return view('dashboard');
	                // });
               
					Route::get('/dashboard', 'HomeController@index')->name('dashboard');
					Route::group(['namespace' => 'Grades'], function () { //file in Controller (Grades)
					Route::resource('Grades', 'GradeController');
					});		
					Route::post('Grades/destroyAll', [GradeController::class, 'destroyAll'])->name('Grades.destroyAll');
					// Route::resource('Grades', GradeController::class);

				}); 

			
	

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

// Route::get('/', function () {
//     return view('dashboard');
// });




