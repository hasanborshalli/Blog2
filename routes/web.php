<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Web\AuthorController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\SearchController;
use App\Http\Controllers\Web\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Web\CommentController as WebCommentController;
use App\Http\Controllers\Author\ProfileController as AuthorProfileController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Web\ContactController;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');
Route::get('/authors/{username}', [AuthorController::class, 'show'])->name('authors.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('/comments', [WebCommentController::class, 'store'])->name('comments.store');
});

/*
|--------------------------------------------------------------------------
| Author Routes
|--------------------------------------------------------------------------
*/

Route::prefix('author')
    ->name('author.')
    ->middleware(['auth', 'active', 'author'])
    ->group(function () {
        Route::get('/dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');

        Route::resource('posts', \App\Http\Controllers\Author\PostController::class);
        Route::get('/profile', [AuthorProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [AuthorProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [AuthorProfileController::class, 'updatePassword'])->name('profile.password.update');

    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'active', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
        Route::resource('tags', \App\Http\Controllers\Admin\TagController::class)->except(['show']);

        Route::get('/posts', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('posts.index');
        Route::get('/posts/{post}', [\App\Http\Controllers\Admin\PostController::class, 'show'])->name('posts.show');
        Route::post('/posts/{post}/approve', [\App\Http\Controllers\Admin\PostController::class, 'approve'])->name('posts.approve');
        Route::post('/posts/{post}/reject', [\App\Http\Controllers\Admin\PostController::class, 'reject'])->name('posts.reject');
        Route::delete('/posts/{post}', [\App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
        Route::post('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
        Route::post('/comments/{comment}/reject', [AdminCommentController::class, 'reject'])->name('comments.reject');
        Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
        Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/read', [AdminContactMessageController::class, 'markRead'])->name('messages.read');
        Route::post('/messages/{message}/unread', [AdminContactMessageController::class, 'markUnread'])->name('messages.unread');
        Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::post('/users/{user}/disable', [AdminUserController::class, 'disable'])->name('users.disable');
        Route::post('/users/{user}/enable', [AdminUserController::class, 'enable'])->name('users.enable');
        });