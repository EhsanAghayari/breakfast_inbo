<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Event;
use App\Http\Controllers\logout;
use App\Http\Controllers\Rate;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [LoginController::class, 'loggedIn'])->name('loggedIn');

Route::get('login', function (){
    return view('auth/login');
})->name('login');

//Route::get('dashboard',[Auth::class,'login'])->name('dashboard');

Route::get('dashboard', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('dashboard');


Route::get('logout',[\App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');

//Route::post('successRate/{rate}/{criticism}/{eventId}', [LoginController::class, 'successRate'])->name('successRate');


Route::get('signUser', [\App\Http\Controllers\UserController::class, 'showUser'])->name('signUser')->middleware(middleware: 'admin');

Route::post('signUser/{username:?}/{password:?}', [\App\Http\Controllers\UserController::class, 'signUser'])->name('signUser1')->middleware(middleware: 'admin');

Route::post('editUser/{id:?}', [\App\Http\Controllers\UserController::class, 'editUser'])->name('editUser')->middleware(middleware: 'admin');
Route::get('editUser/{id:?}', [\App\Http\Controllers\UserController::class, 'editUser'])->name('editUserGet')->middleware(middleware: 'admin');

Route::put('editTheUser/{current:?}/{username:?}/{password:?}', [\App\Http\Controllers\UserController::class, 'updateUser'])->name('editTheUser')->middleware(middleware: 'admin');

Route::delete('deleteUser/{id:?}', [\App\Http\Controllers\UserController::class, 'deleteUser'])->name('deleteUser')->middleware(middleware: 'admin');

Route::get('usersList', [\App\Http\Controllers\UserController::class, 'usersList'])->name('usersList');

Route::get('addEvent', [\App\Http\Controllers\EventController::class, 'showEvent'])->name('addEvent')->middleware(middleware: 'admin');

Route::post('addTheEvent/{userId:?}/{description:?}', [\App\Http\Controllers\EventController::class, 'addTheEvent'])->name('addTheEvent')->middleware(middleware: 'admin');

Route::post('editEvent/{id:?}', [\App\Http\Controllers\EventController::class, 'editEvent'])->name('editEvent')->middleware(middleware: 'admin');

Route::put('editTheEvent/{current:?}/{description:?}/{userId:?}', [\App\Http\Controllers\EventController::class, 'updateEvent'])->name('editTheEvent')->middleware(middleware: 'admin');

Route::delete('deleteEvent/{id:?}', [\App\Http\Controllers\EventController::class, 'deleteEvent'])->name('deleteEvent')->middleware(middleware: 'admin');

Route::get('rates/{eventId:?}/{userInfo:?}', [\App\Http\Controllers\RateController::class, 'showComments'])->name('rates');

Route::post('addTheRate/{eventId:?}', [\App\Http\Controllers\RateController::class, 'addTheRate'])->name('addTheRate');

