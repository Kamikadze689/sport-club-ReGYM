<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\YookassaController;
use App\Http\Controllers\Auth\ForgotPasswordController;




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/prices', [HomeController::class, 'prices'])->name('prices');
Route::get('/trainers', [HomeController::class, 'trainers'])->name('trainers');
Route::get('/trainers/{id}', [HomeController::class, 'trainer'])->name('trainer.show');
Route::get('/gym-layout', [HomeController::class, 'gymLayout'])->name('gym.layout');


Route::post('/request', [HomeController::class, 'storeRequest'])->name('request.store');


Route::middleware('guest')->group(function () {
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
    
    
    Route::prefix('cabinet')->group(function () {
        Route::get('/', [UserAuthController::class, 'dashboard'])->name('user.dashboard');
        
        
        Route::prefix('subscriptions')->group(function () {
            Route::get('/plans', function() {
                return redirect()->route('prices');
            })->name('subscription.plans');
            
            Route::get('/{subscriptionId}/qr', [PaymentController::class, 'showQrCode'])->name('user.subscription.qr');
        });
        
        
        Route::prefix('payment')->group(function () {
            
            Route::post('/create', [PaymentController::class, 'createPayment'])->name('payment.create');
            
            
            Route::get('/process/{subscriptionId}', [PaymentController::class, 'processPayment'])->name('payment.process');
            
            
            Route::post('/success/{subscriptionId}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
            
            
            Route::get('/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
        });
        
        
        Route::prefix('profile')->group(function () {
            Route::get('/', [UserAuthController::class, 'profile'])->name('user.profile');
            Route::put('/', [UserAuthController::class, 'updateProfile'])->name('user.profile.update');
            Route::put('/password', [UserAuthController::class, 'updatePassword'])->name('user.password.update');
        });
    });
});


Route::get(
    '/email/verify/{id}',
    [UserAuthController::class, 'verifyEmail']
)->name('verification.verify');

Route::get(
    '/forgot-password',
    [ForgotPasswordController::class, 'showForgotForm']
)->name('password.request');

Route::post(
    '/forgot-password',
    [ForgotPasswordController::class, 'sendResetLink']
)->name('password.email');

Route::get(
    '/reset-password',
    [ForgotPasswordController::class, 'showResetForm']
)->name('password.reset.form');

Route::post(
    '/reset-password',
    [ForgotPasswordController::class, 'resetPassword']
)->name('password.update');


Route::middleware('auth')->post('/yookassa/create', [YookassaController::class, 'createPayment'])->name('yookassa.payment');
Route::middleware('auth')->get('/yookassa/callback', [YookassaController::class, 'callback'])->name('yookassa.callback');


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    
    Route::prefix('trainers')->group(function () {
        Route::get('/', [AdminController::class, 'trainers'])->name('admin.trainers');
        Route::get('/create', [AdminController::class, 'createTrainer'])->name('admin.trainers.create');
        Route::post('/', [AdminController::class, 'storeTrainer'])->name('admin.trainers.store');
        Route::get('/{id}/edit', [AdminController::class, 'editTrainer'])->name('admin.trainers.edit');
        Route::put('/{id}', [AdminController::class, 'updateTrainer'])->name('admin.trainers.update');
        Route::delete('/{id}', [AdminController::class, 'deleteTrainer'])->name('admin.trainers.delete');
    });
    
    
    Route::prefix('prices')->group(function () {
        Route::get('/', [AdminController::class, 'priceItems'])->name('admin.prices');
        Route::get('/management', [AdminController::class, 'pricesManagement'])->name('admin.prices.management');
        Route::post('/management/save', [AdminController::class, 'savePriceManagement'])->name('admin.prices.management.save');
        Route::delete('/items/{id}', [AdminController::class, 'deletePriceItem'])->name('admin.prices.items.delete');
        Route::delete('/properties/{id}', [AdminController::class, 'deletePriceProperty'])->name('admin.prices.properties.delete');
        Route::delete('/categories/{id}', [AdminController::class, 'deletePriceCategory'])->name('admin.prices.categories.delete');
        
        Route::prefix('categories')->group(function () {
            Route::get('/', [AdminController::class, 'priceCategories'])->name('admin.prices.categories');
            Route::get('/create', [AdminController::class, 'createPriceCategory'])->name('admin.prices.categories.create');
            Route::post('/', [AdminController::class, 'storePriceCategory'])->name('admin.prices.categories.store');
            Route::get('/{id}/edit', [AdminController::class, 'editPriceCategory'])->name('admin.prices.categories.edit');
            Route::put('/{id}', [AdminController::class, 'updatePriceCategory'])->name('admin.prices.categories.update');
            Route::delete('/{id}', [AdminController::class, 'deletePriceCategory'])->name('admin.prices.categories.delete');
        });
        
        Route::prefix('properties')->group(function () {
            Route::get('/{categoryId}', [AdminController::class, 'categoryProperties'])->name('admin.prices.properties');
            Route::get('/{categoryId}/create', [AdminController::class, 'createCategoryProperty'])->name('admin.prices.properties.create');
            Route::post('/{categoryId}', [AdminController::class, 'storeCategoryProperty'])->name('admin.prices.properties.store');
            Route::get('/{id}/edit', [AdminController::class, 'editCategoryProperty'])->name('admin.prices.properties.edit');
            Route::put('/{id}', [AdminController::class, 'updateCategoryProperty'])->name('admin.prices.properties.update');
            Route::delete('/{id}', [AdminController::class, 'deletePriceProperty'])->name('admin.prices.properties.delete');
        });
        
        Route::prefix('items')->group(function () {
            Route::get('/', [AdminController::class, 'priceItems'])->name('admin.prices.items');
            Route::get('/category/{categoryId?}', [AdminController::class, 'priceItems'])->name('admin.prices.items.category');
            Route::get('/create/{categoryId?}', [AdminController::class, 'createPriceItem'])->name('admin.prices.items.create');
            Route::post('/', [AdminController::class, 'storePriceItem'])->name('admin.prices.items.store');
            Route::get('/{id}/edit', [AdminController::class, 'editPriceItem'])->name('admin.prices.items.edit');
            Route::put('/{id}', [AdminController::class, 'updatePriceItem'])->name('admin.prices.items.update');
            Route::delete('/{id}', [AdminController::class, 'deletePriceItem'])->name('admin.prices.items.delete');
        });
    });
    
    
    Route::prefix('requests')->group(function () {
        Route::get('/', [AdminController::class, 'requests'])->name('admin.requests');
        Route::post('/{id}/process', [AdminController::class, 'processRequest'])->name('admin.requests.process');
    });
    
    
    Route::prefix('settings')->group(function () {
        Route::get('/', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    });
    
    
    Route::prefix('layout')->group(function () {
        Route::get('/', [AdminController::class, 'gymLayout'])->name('admin.layout');
        Route::get('/create', [AdminController::class, 'createZone'])->name('admin.layout.create');
        Route::post('/', [AdminController::class, 'storeZone'])->name('admin.layout.store');
        Route::get('/{id}/edit', [AdminController::class, 'editZone'])->name('admin.layout.edit');
        Route::put('/{id}', [AdminController::class, 'updateZone'])->name('admin.layout.update');
        Route::delete('/{id}', [AdminController::class, 'deleteZone'])->name('admin.layout.delete');
        Route::post('/save-positions', [AdminController::class, 'saveLayoutPositions'])->name('admin.layout.save-positions');
    });
    
    
    Route::prefix('subscriptions')->group(function () {
        Route::get('/', [AdminController::class, 'subscriptions'])->name('admin.subscriptions');
        Route::get('/{id}', [AdminController::class, 'showSubscription'])->name('admin.subscription.show');
        Route::post('/{id}/cancel', [AdminController::class, 'cancelSubscription'])->name('admin.subscription.cancel');
    });
    
    
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/{id}', [AdminController::class, 'showUser'])->name('admin.user.show');
        Route::delete('/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    });
});