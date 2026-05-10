<?php

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Models\Barang;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard');
    }

    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('dashboard', [ShopController::class, 'home'])->name('dashboard');
    Route::redirect('home', 'dashboard');
    Route::get('produk', [ShopController::class, 'index'])->name('products.index');
    Route::redirect('products', 'produk');
    Route::post('cart/add/{barang}', [CartController::class, 'add'])->name('cart.add');
    Route::get('keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::redirect('cart', 'keranjang');
    Route::put('cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/receipt', [OrderController::class, 'receipt'])->name('orders.receipt');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        $barangCount = Barang::count();
        $orderCount = Order::count();
        $userCount = User::count();

        return view('admin.dashboard', compact('barangCount', 'orderCount', 'userCount'));
    })->name('dashboard');

    Route::redirect('barang', '/admin/barangs');
    Route::redirect('transaksi', '/admin/orders');

    Route::resource('barangs', BarangController::class)->except(['show']);
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);

    Route::get('reports', function () {
        $barangCount = Barang::count();
        $orderCount = Order::count();
        $userCount = User::count();

        return view('admin.reports', compact('barangCount', 'orderCount', 'userCount'));
    })->name('reports');
});
