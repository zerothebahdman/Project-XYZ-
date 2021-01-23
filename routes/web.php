<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
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

Route::get('/', [BlogController::class, 'index'])->name('welcome.page');

// Route::get('/blog/post/{show}', function (Post $post) {
//     return $post->slug;
// });

Route::get('/blog/post/{slug}', [BlogController::class, 'show'])->name('show.blog.post');

Route::get('/blog/post/category/{category}', [BlogController::class, 'category'])->name('category');

Route::get('/blog/post/author/{user}', [BlogController::class, 'author'])->name('author');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');