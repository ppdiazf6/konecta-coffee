<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;

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



#Route::group(['middleware' => 'auth'], function(){
	//Route::group(['prefix' => 'admin'], function(){
		#Route::get('/students', [StudentsController::class, 'index']);
		
		Route::group(['prefix' => 'products'], function(){
			Route::get('/', [ProductsController::class, 'index']);
			Route::get('/create', [ProductsController::class, 'create']);
			Route::post('/create', [ProductsController::class, 'store']);
			Route::get('/show/{id}', [ProductsController::class, 'show']);
			Route::post('/edit', [ProductsController::class, 'update']);
			Route::get('/delete/{id}', [ProductsController::class, 'delete']);
		});
		
		Route::group(['prefix' => 'sales'], function(){
			Route::get('/', [SalesController::class, 'index']);
			Route::post('/process', [SalesController::class, 'process']);
		});
			
		Route::group(['prefix' => 'categories'], function(){
			Route::get('/', [CategoriesController::class, 'index']);
			#Route::get('/create', [CategoriesController::class, 'create']);
			Route::post('/create', [CategoriesController::class, 'store']);
			Route::get('/delete/{id}', [CategoriesController::class, 'delete']);
		});
	//});
#});

