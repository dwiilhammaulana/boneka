<?php

use App\Http\Controllers\contact_usController;
use App\Http\Controllers\productsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\customersController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\shopController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Public\PublicPembayaranController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::resource('login', loginController::class)->only(['index', 'store']);
Route::resource('login', LoginController::class)
    ->only(['index', 'store'])
    ->names([
        'index' => 'login',
    ]);
    Route::get('/register/admin', [AuthController::class, 'createAdmin'])->name('register.admin');
    Route::post('/register/admin', [AuthController::class, 'storeAdmin'])->name('register.admin.store');
    
    Route::get('/register/customer', [AuthController::class, 'createCustomer'])->name('register.customer');
    Route::post('/register/customer', [AuthController::class, 'storeCustomer'])->name('register.customer.store');
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('admin', adminController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('customers', CustomersController::class);
    Route::resource('dashboard', AdminDashboardController::class);
    Route::resource('contact_us', contact_usController::class);
    Route::resource('pembayaran', pembayaranController::class);
    // Route::resource('laporan', laporanController::class);
    Route::get('/laporan/penjualan', [LaporanController::class, 'index'])->name('laporan.penjualan');
    Route::get('/laporan/mobil_customer', [LaporanController::class, 'mobilDariCustomer'])->name('laporan.mobil_customer');


});


Route::middleware(['auth:customer'])->group(function () {

// Route::get('/pembayaran/createcustomer', [PembayaranController::class, 'create'])
//     ->name('pembayaran.createcustomer');

    //percobaan
    // Route::get('/pembayaran/{order_id}', [PembayaranController::class, 'createForOrder'])->name('pembayaran.createForOrder');
    // Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    

Route::prefix('public')->name('public.')->middleware('auth:customer')->group(function () {
    Route::get('pembayaran/create', [PublicPembayaranController::class, 'create'])->name('PublicPembayaran.create');
    Route::post('pembayaran/store', [PublicPembayaranController::class, 'store'])->name('PublicPembayaran.store');
    
});
// Route::get('/public/pembayaran/create', [PublicPembayaranController::class, 'create'])
//     ->name('PublicPembayaran.create');

// Route::post('/public/pembayaran', [PublicPembayaranController::class, 'store'])
//     ->name('PublicPembayaran.store');





    // Route untuk logout customer
    Route::post('/customer/logout', [customersController::class, 'logout'])->name('customer.logout');

    Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('public.profile');
    Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('public.profile');

    // Rute untuk menambahkan produk ke keranjang
    Route::post('/cart', [CartController::class, 'addToCart'])->name('public.cart')->middleware('auth');

    // Rute untuk melihat halaman keranjang
    Route::get('/cart', [CartController::class, 'viewCart'])->name('public.cart.view');
 

    // Rute untuk menghapus produk dari keranjang menggunakan POST
    Route::post('/cart/remove', [CartController::class, 'removeFromCart']);

    // Rute untuk melihat detail produk
    Route::get('/product/{id}', [productsController::class, 'detail'])->name('product.detail');

    // Rute untuk melihat profil customer
    Route::get('/profile', [customersController::class, 'profile'])->name('customer.profile');

    // Rute untuk melihat pesanan customer
    Route::get('/orders', [orderController::class, 'index'])->name('customer.orders');
    Route::get('/checkout', [orderController::class, 'create'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/customers/{id}/update', [customersController::class, 'update'])->name('customers.update');

    Route::get('/pesanan', [orderController::class, 'history'])->name('public.pesanan');
    Route::get('/cetak-struk/{orderId}', [orderController::class, 'cetakStruk'])->name('cetak-struk');
    Route::get('/pembayaran/{orderId}', [pembayaranController::class, 'pembayaran'])->name('pembayaran');
    Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);

    // web.php
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
Route::post('/orders/{id}/logistik', [OrderController::class, 'updateLogistik']);


});

Route::get('/home', [homeController::class, 'index'])->name('public.home');

Route::get('/shop', [shopController::class, 'index'])->name('public.shop');

Route::get('/contact', [contactController::class, 'index'])->name('public.contact');
Route::post('/contact', [contactController::class, 'store'])->name('public.contact.store');
Route::delete('/contact/{id}', [contactController::class, 'destroy'])->name('public.contact.destroy');


Route::put('/customers/{id}', [customersController::class, 'update'])->name('customers.update');
Route::post('/orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
