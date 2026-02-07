<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ForumController::class, 'home'])->name('home');
Route::get('/thread/{thread:slug}', [ForumController::class, 'showThread'])->name('thread.show');
Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::post('/threads', [ForumController::class, 'storeThread'])->name('thread.store');
    Route::post('/thread/{thread}/posts', [ForumController::class, 'storePost'])->name('post.store');
    Route::post('/subscriptions/checkout', [PaymentController::class, 'checkout'])->name('subscription.checkout');
});

Route::controller(SocialAuthController::class)->group(function (): void {
    Route::get('/auth/{provider}/redirect', 'redirect')->name('auth.social.redirect');
    Route::get('/auth/{provider}/callback', 'callback')->name('auth.social.callback');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'mfa', 'role:Super Admin|Admin|Moderator'])->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('moderation', ModerationController::class)->only(['index', 'update']);
});

Route::get('/install', [InstallController::class, 'index'])->name('install.index');
Route::post('/install', [InstallController::class, 'store'])->name('install.store');
