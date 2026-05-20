<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateVerifyController;
use App\Http\Controllers\CertificateViewController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

Route::get('/certificates/{certificate}/verify', [CertificateVerifyController::class, 'show'])
    ->name('certificates.verify');

Route::get('/certificates/{certificate}/view', [CertificateViewController::class, 'show'])
    ->name('certificates.view');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/certificates', [AdminCertificateController::class, 'index'])->name('certificates.index');
        Route::post('/certificates', [AdminCertificateController::class, 'store'])->name('certificates.store');
        Route::get('/certificates/{certificate}/edit', [AdminCertificateController::class, 'edit'])->name('certificates.edit');
        Route::put('/certificates/{certificate}', [AdminCertificateController::class, 'update'])->name('certificates.update');
        Route::delete('/certificates/{certificate}', [AdminCertificateController::class, 'destroy'])->name('certificates.destroy');

        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/read', [AdminMessageController::class, 'markRead'])->name('messages.read');
        Route::post('/messages/{message}/unread', [AdminMessageController::class, 'markUnread'])->name('messages.unread');
    });
});
