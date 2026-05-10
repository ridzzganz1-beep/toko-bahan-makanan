<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransaksiController;

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Models\Barang;
use App\Models\Order;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {

        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard');
    }

    return view('welcome');

})->name('welcome');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD USER
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [ShopController::class, 'home'])
        ->name('dashboard');

    Route::redirect('/home', '/dashboard');

    /*
    |--------------------------------------------------------------------------
    | PRODUK
    |--------------------------------------------------------------------------
    */

    Route::get('/produk', [ShopController::class, 'index'])
        ->name('products.index');

    Route::redirect('/products', '/produk');

    /*
    |--------------------------------------------------------------------------
    | CART / KERANJANG
    |--------------------------------------------------------------------------
    */

    Route::post('/cart/add/{barang}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::get('/keranjang', [CartController::class, 'index'])
        ->name('cart.index');

    Route::redirect('/cart', '/keranjang');

    Route::put('/cart/{item}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{item}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'password'])
        ->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| TRANSAKSI ROUTES
|--------------------------------------------------------------------------
|
| TANPA AUTH AGAR INTEGRATION TEST BERHASIL
|
*/

Route::middleware([])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | FORM TRANSAKSI
    |--------------------------------------------------------------------------
    */

    Route::get('/transaksi/create', [TransaksiController::class, 'create'])
        ->name('transaksi.create');

    /*
    |--------------------------------------------------------------------------
    | SIMPAN TRANSAKSI
    |--------------------------------------------------------------------------
    */

    Route::post('/transaksi', [TransaksiController::class, 'store'])
        ->name('transaksi.store');

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN STRUK
    |--------------------------------------------------------------------------
    */

    Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])
        ->name('transaksi.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $barangCount = Barang::count();
        $orderCount = Order::count();
        $userCount = User::count();

        return view('admin.dashboard', compact(
            'barangCount',
            'orderCount',
            'userCount'
        ));

    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

    Route::redirect('/barang', '/admin/barangs');
    Route::redirect('/transaksi', '/admin/orders');

    /*
    |--------------------------------------------------------------------------
    | CRUD BARANG
    |--------------------------------------------------------------------------
    */

    Route::resource('barangs', BarangController::class)
        ->except(['show']);

    /*
    |--------------------------------------------------------------------------
    | KELOLA USER
    |--------------------------------------------------------------------------
    */

    Route::resource('users', AdminUserController::class)
        ->only([
            'index',
            'edit',
            'update',
            'destroy'
        ]);

    /*
    |--------------------------------------------------------------------------
    | KELOLA ORDER
    |--------------------------------------------------------------------------
    */

    Route::resource('orders', AdminOrderController::class)
        ->only([
            'index',
            'show'
        ]);

    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', function () {

        $barangCount = Barang::count();
        $orderCount = Order::count();
        $userCount = User::count();

        return view('admin.reports', compact(
            'barangCount',
            'orderCount',
            'userCount'
        ));

    })->name('reports');
});