<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Display
Route::get('/products', [ProductPageController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// Address System
Route::get('/regions', [AddressController::class, 'getRegions'])->name('regions');
Route::get('/provinces', [AddressController::class, 'getProvinces'])->name('provinces');
Route::get('/cities', [AddressController::class, 'getCities'])->name('cities');
Route::get('/barangays', [AddressController::class, 'getBarangays'])->name('barangays');

// Cart Routes (public)
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('avatar.destroy');

    // Cart Management
    Route::prefix('cart')->group(function () {
        Route::post('/update/{product}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    });

    // Orders
    Route::get('/my-orders', [OrderController::class, 'customerOrders'])->name('orders.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'showCustomerOrder'])->name('orders.show');

    // Checkout & Payment
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');
    Route::get('/payment', [CheckoutController::class, 'showPaymentPage'])->name('payment');
    Route::post('/payment/process', [CheckoutController::class, 'processPayment'])->name('payment.process');
    Route::post('/payment/clear', [CheckoutController::class, 'clearSession'])->name('payment.clear');

    // Order Success
    Route::get('/orders/success/{order}', [CheckoutController::class, 'orderSuccess'])
        ->name('orders.success');

    // Product Ratings
    Route::post('/products/{product}/rate', [ProductPageController::class, 'rate'])
        ->name('products.rate');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Products Management
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{product}/update', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/{product}/json', [ProductController::class, 'getProductJson'])->name('admin.products.json');
        Route::delete('/{product}/destroy', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });

    // Users Management
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.users');
        Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}/update', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Orders Management
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    });

    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

    // Static Assets
    Route::get('/images/default-product.png', function () {
        return response()->file(public_path('images/default-product.png'));
    })->name('default-product-image');
});

require __DIR__ . '/auth.php';
