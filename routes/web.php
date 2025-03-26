<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewOrderDetails;
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

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'show'])->name('cart.show');
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    });

    // Checkout & Payment
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');
    Route::post('/payment/clear', [CheckoutController::class, 'clearSession'])->name('payment.clear');
    Route::get('/payment', [CheckoutController::class, 'showPaymentPage'])->name('payment');
    Route::post('/payment/process', [CheckoutController::class, 'processPayment'])->name('payment.process');
    Route::get('/order/success', [CheckoutController::class, 'orderSuccess'])->name('order.success');

    // Add this in your authenticated routes
    Route::get('/my-orders/{order}', [OrderController::class, 'showCustomerOrder'])
        ->name('customer.orders.show')
        ->middleware('auth');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{product}/update', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/{product}/json', [ProductController::class, 'getProductJson'])->name('admin.products.json');
        Route::delete('/{product}/destroy', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });

    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.users');
        Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}/update', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    });



    // View Order Details
    // Route::get('/orders/{order}/details', [ViewOrderDetails::class, 'view'])->name('admin.view.details');

    // Make sure you have this route (either in admin or regular routes)
    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show') // Changed from 'admin.orders.show' to match your view
        ->middleware('auth');
         // Add 'admin' middleware if needed
});

require __DIR__ . '/auth.php';
