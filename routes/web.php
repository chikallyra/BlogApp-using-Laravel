<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostingController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);

Route::get('/', function () {
    return view('welcome', [
        "title" => 'Welcome',
    ]);
});

Auth::routes();

Route::middleware(['2fa'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/2fa', function () {
        return redirect(route('home'));
    })->name('2fa');

    //bagian main
    Route::get('/main', [MainController::class, 'index'])->name('main');

    // bagian post
    Route::get('/posts', [PostingController::class, 'index'])->name('post');
    Route::get('/posts/create', [PostingController::class, 'create'])->name('post.create');
    Route::post('/posts/create', [PostingController::class, 'store'])->name('post.store');
    Route::delete('/posts/{posting}/destroy', [PostingController::class, 'destroy'])->name('post.destroy');
    Route::get('/posts/{posting}/edit', [PostingController::class, 'edit'])->name('post.edit');
    Route::put('/post/{posting}/update', [PostingController::class, 'update'])->name('post.update');
    Route::get('/posts/{posting}/show', [PostingController::class, 'show'])->name('post.show');

    // bagian category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/categories/{category}/show', [CategoryController::class, 'show'])->name('category.show');

    //bagian comment
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
});

Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');
