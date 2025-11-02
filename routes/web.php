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
    return view('test');
    //return view('welcome');
    
});
