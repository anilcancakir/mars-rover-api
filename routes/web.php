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
    $t = \App\MemoryModels\Plateau::find('Anılcan ın güzel platüsü');
    dd($t);

    $plateau = new \App\MemoryModels\Plateau('Anılcan ın güzel platüsü', new \App\Coordinate(10, 20));
    dd($plateau->save());
});
