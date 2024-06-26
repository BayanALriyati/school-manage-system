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
   //==============================Translate all pages============================
    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

   //==============================Grades============================
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });
	Route::post('Grades/destroyAll', [GradeController::class, 'destroyAll'])->name('Grades.destroyAll');
    //==============================Classrooms============================
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
    });

    //==============================Sections============================

    Route::group(['namespace' => 'Sections'], function () {

        Route::resource('Sections', 'SectionController');

        Route::get('/classes/{id}', 'SectionController@getclasses');

    });

    //==============================parents============================

    Route::view('add_parent','livewire.show_Form');




});




