<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokuController;
use App\Http\Controllers\V1\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('index');

// Routes for Mitra Magersari
Route::prefix('magersari')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\MitraController::class, 'magersari'])->name('magersari');
    Route::get('/contact-us', [App\Http\Controllers\Frontend\MitraController::class, 'contactMagersari'])->name('magersari.contact');
    Route::get('{slug}', [App\Http\Controllers\Frontend\MitraController::class, 'magersariDetail'])->name('magersari.detail');
});

// Routes for Mitra Sekarsari
Route::prefix('sekarsari')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\MitraController::class, 'sekarsari'])->name('sekarsari');
    Route::get('/contact-us', [App\Http\Controllers\Frontend\MitraController::class, 'contactSekarsari'])->name('sekarsari.contact');
    Route::get('{slug}', [App\Http\Controllers\Frontend\MitraController::class, 'sekarsariDetail'])->name('sekarsari.detail');
});

// Cart and Payment Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\CartController::class, 'keranjang'])->name('addtocart');
    Route::post('/', [App\Http\Controllers\Frontend\CartController::class, 'bayar'])->name('payment');
});

// Confirmation Routes
Route::prefix('konfirmasi')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\KonfirmasiController::class, 'index'])->name('konfirmasi');
    Route::post('/', [App\Http\Controllers\Frontend\KonfirmasiController::class, 'store'])->name('konfirmasi.store');
});

// Ongkir Routes
Route::prefix('ongkir')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\OngkirController::class, 'index'])->name('ongkir');
    Route::get('/kota', [App\Http\Controllers\Frontend\OngkirController::class, 'kota'])->name('ongkir.kota');
    Route::post('/', [App\Http\Controllers\Frontend\OngkirController::class, 'store'])->name('ongkir.store');
});

// Tracking Routes
Route::prefix('lacak')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\LacakController::class, 'index'])->name('lacak');
    Route::post('/', [App\Http\Controllers\Frontend\LacakController::class, 'store'])->name('lacak.store');
});

// Custom Authentication Routes
Auth::routes([
    'reset'    => false,  // for resetting passwords
    'confirm'  => false,  // for additional password confirmations
    'verify'   => false,  // for email verification
    'register' => false,
    'login'    => false
]);

// Custom Auth Routes
Route::get('/masuk', [App\Http\Controllers\Auth\MasukControlller::class, 'index'])->name('masuk');
Route::post('/masuk', [App\Http\Controllers\Auth\MasukControlller::class, 'store'])->name('masuk.store');

// Doku Callback Route
//Route::match(['GET', 'POST'], '/doku/callback', [App\Http\Controllers\DokuController::class, 'handleCallback'])->name('doku.callback');
//Route::get('/doku/callback', [App\Http\Controllers\DokuController::class, 'handleCallback'])->name('doku.callback');

// Rute untuk riwayat pesanan
Route::prefix('history')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\HistoryController::class, 'index'])->name('history');
    Route::post('/', [App\Http\Controllers\Frontend\HistoryController::class, 'index'])->name('history.index');
});






// Authenticated Routes with Middleware
Route::prefix('v1')->middleware(['auth', 'dontback'])->group(function () {

    Route::get('', [App\Http\Controllers\V1\DahboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        // Tani Routes
        Route::resource('tani', App\Http\Controllers\V1\TaniController::class, [
            'as' => 'admin',
            'only' => ['index', 'edit', 'store', 'destroy', 'show', 'update']
        ]);

        // User Routes
        Route::resource('user', App\Http\Controllers\V1\UserController::class, [
            'as' => 'admin',
            'only' => ['index', 'edit', 'store', 'destroy', 'show', 'update']
        ]);

        // Stock Routes
        Route::prefix('stock')->group(function () {
            Route::get('', [App\Http\Controllers\V1\StockController::class, 'index'])->name('admin.stock');
            Route::get('{id}', [App\Http\Controllers\V1\StockController::class, 'show'])->name('admin.stock.show');
            Route::post('{id}', [App\Http\Controllers\V1\StockController::class, 'store'])->name('admin.stock.store');
        });

        // Ekspedisi Routes
        Route::resource('ekspedisi', App\Http\Controllers\V1\EkspedisiController::class, [
            'as' => 'admin',
            'only' => ['index', 'edit', 'store', 'destroy', 'update', 'create']
        ]);

        // Gallery Routes
        Route::prefix('galery')->group(function () {
            Route::get('', [App\Http\Controllers\V1\GaleryController::class, 'index'])->name('admin.galery.index');
            Route::post('', [App\Http\Controllers\V1\GaleryController::class, 'store'])->name('admin.galery.store');
            Route::delete('{id}', [App\Http\Controllers\V1\GaleryController::class, 'destroy'])->name('admin.galery.destroy');
        });

        // Banner Routes
        Route::prefix('banner')->group(function () {
            Route::get('', [App\Http\Controllers\V1\BannerController::class, 'index'])->name('admin.banner.index');
            Route::post('', [App\Http\Controllers\V1\BannerController::class, 'store'])->name('admin.banner.store');
            Route::delete('{id}', [App\Http\Controllers\V1\BannerController::class, 'destroy'])->name('admin.banner.destroy');
        });
    });

    Route::middleware('role:admin,tani')->group(function () {
        // Order Masuk Routes
        Route::get('/order-masuk', [App\Http\Controllers\V1\OrdermasukController::class, 'index'])->name('admin.order-masuk');
        Route::get('/order-masuk/{inv}', [App\Http\Controllers\V1\OrdermasukController::class, 'detail'])->name('admin.order-masuk.detail');
        Route::post('/order-masuk/{inv}', [App\Http\Controllers\V1\OrdermasukController::class, 'update'])->name('admin.order-masuk.update');
        Route::delete('/order-masuk/{inv}', [App\Http\Controllers\V1\OrdermasukController::class, 'destroy'])->name('admin.order-masuk.destroy');

        // Product Routes
        Route::resource('product', App\Http\Controllers\V1\ProductController::class, [
            'as' => 'admin',
            'only' => ['index', 'edit', 'store', 'destroy', 'update', 'create']
        ]);

        // Order Selesai Routes
        Route::get('/order-selesai', [App\Http\Controllers\V1\OrderselesaiController::class, 'index'])->name('admin.order-selesai');
        Route::get('/order-selesai/{inv}', [App\Http\Controllers\V1\OrderselesaiController::class, 'detail'])->name('admin.order-selesai.detail');

        // Profile Routes
        Route::prefix('profile')->group(function () {
            Route::get('', [App\Http\Controllers\V1\ProfileController::class, 'index'])->name('admin.profile');
        });
    });
});
