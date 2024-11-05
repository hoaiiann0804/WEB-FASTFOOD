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
// Trong Laravel (routes/web.php)
// Route::get('/api/img/{filename}', function ($filename) {
//     $path = storage_path("app/public/img/{$filename}");
//     if (!File::exists($path)) {
//         abort(404);
//     }
//     return response()->file($path);
// });
