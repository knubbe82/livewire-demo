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

Route::get('/queue', function () {
    $batch = [
        new \App\Jobs\SendWelcomeEmail('knubbe'),
        new \App\Jobs\SendWelcomeEmail('nikola'),
        new \App\Jobs\SendWelcomeEmail('nenad'),
        new \App\Jobs\SendWelcomeEmail('vedran'),
        new \App\Jobs\SendWelcomeEmail('aleksandar'),
        new \App\Jobs\SendWelcomeEmail('ivan'),
        new \App\Jobs\SendWelcomeEmail('vlada'),
        new \App\Jobs\SendWelcomeEmail('milovan'),
        new \App\Jobs\SendWelcomeEmail('iva'),
        new \App\Jobs\ProcessPayment(),
    ];

    \Illuminate\Support\Facades\Bus::batch($batch)->dispatch();
});
