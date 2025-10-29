<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\TeamMembersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware('can:create-short-url')->group(function () {
        Route::get('/generate', [GenerateController::class, 'index'])->name('generate');
        Route::post('/generate', [GenerateController::class, 'create']);
    });
    Route::get('/short-urls', [ShortUrlController::class, 'index'])->name('shorturl.index');
    Route::middleware('can:invite-user')->group(function () {
        Route::get('/invite', [InviteController::class, 'index'])->name('invite');
        Route::post('/invite', [InviteController::class, 'invite']);
    });
    Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
    Route::get('/team-members', [TeamMembersController::class, 'index'])->name('team_members');
    Route::get('/download', [DownloadController::class, 'process'])->name('download');
    Route::get('/logout', [LogoutController::class, 'process'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'process']);
});

Route::get('/s/{shorturl:shortcode}', [ShortUrlController::class, 'show'])->name('shorturl');
