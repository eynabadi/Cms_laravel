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
// login admin and writer
Route::get('login',[\App\Http\Controllers\PanelController::class,'loginwriter']);
//create login and check login admin , user
Route::post('logincreate',[\App\Http\Controllers\PanelController::class,'logincreate'])->name('logincreate');
Route::get('logincheck',[\App\Http\Controllers\PanelController::class,'logincheck']);
//check email and password send email code validation
Route::post('logincheckpost',[\App\Http\Controllers\PanelController::class,'logincheckpost'])->name('logincheckpost');
//view check code email
Route::get('checkcode',[\App\Http\Controllers\PanelController::class,'checkcode']);

Route::post('checkcodepost',[\App\Http\Controllers\PanelController::class,'checkcodepost'])->name('checkcodepost');

Route::get('panel',[\App\Http\Controllers\PanelController::class,'panel']);
//logout panel
Route::delete('logoutpanel',[\App\Http\Controllers\PanelController::class,'logoutpanel'])->name('logoutpanel');

//update password and email panel
Route::post('updatepanelpassword/{id}',[\App\Http\Controllers\PanelController::class,'updatepanelpassword'])->name('updatepanelpassword');
// send file
Route::post('postspanel',[\App\Http\Controllers\PanelController::class,'postspanel'])->name('postspanel');
//delete posts panel
Route::delete('deletepostpanel/{id}',[\App\Http\Controllers\PanelController::class,'deletepostpanel'])->name('deletepostpanel');
//update view
Route::get('updateposts/{id}',[\App\Http\Controllers\PanelController::class,'updateposts']);
//update
Route::put('updatepostsput/{id}',[\App\Http\Controllers\PanelController::class,'updatepostsput'])->name('updatepostsput');


