<?php

//use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
//use App\Models\Plan;
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
    //$maker =  Plan::factory()->count(3)->make();
    //dd($maker);
    return view('home');
})->name('home');

// Rutas de autenticación
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Rutas de administración
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
