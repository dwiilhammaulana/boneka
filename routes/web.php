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

// Authentication Routes
Route::resource('login', loginController::class)->only(['index', 'store']);
Route::resource('login', LoginController::class)
    ->only(['index', 'store'])
    ->names([
        'index' => 'login',
    ]);

// Registration Routes
Route::get('/register/admin', [AuthController::class, 'createAdmin'])->name('register.admin');
Route::post('/register/admin', [AuthController::class, 'storeAdmin'])->name('register.admin.store');
Route::get('/register/customer', [AuthController::class, 'createCustomer'])->name('register.customer');
Route::post('/register/customer', [AuthController::class, 'storeCustomer'])->name('register.customer.store');

// Public Routes (No Authentication Required)
Route::get('/home', [homeController::class, 'index'])->name('public.home');
Route::get('/shop', [shopController::class, 'index'])->name('public.shop');
Route::get('/contact', [contactController::class, 'index'])->name('public.contact');
Route::post('/contact', [contactController::class, 'store'])->name('public.contact.store');

// Admin Routes
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    Route::resource('admin', adminController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('customers', CustomersController::class);
    Route::resource('dashboard', AdminDashboardController::class);
    Route::resource('contact_us', contact_usController::class);
    Route::resource('pembayaran', pembayaranController::class);
    
    // Laporan Routes
    Route::get('/laporan/penjualan', [LaporanController::class, 'index'])->name('laporan.penjualan');
    Route::get('/laporan/mobil_customer', [LaporanController::class, 'mobilDariCustomer'])->name('laporan.mobil_customer');
    
    // Contact Management
    Route::delete('/contact/{id}', [contactController::class, 'destroy'])->name('admin.contact.destroy');
    
    // Order Status Update
    Route::post('/orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('/orders/{id}/logistik', [OrderController::class, 'updateLogistik']);
});

// Customer Routes
Route::middleware(['auth:customer'])->group(function () {
    // Pembayaran Routes
    Route::get('/public/pembayaran/create', [pembayaranController::class, 'create'])->name('public.pembayaran.create');
    Route::post('/public/pembayaran', [pembayaranController::class, 'store'])->name('public.pembayaran.store');
    
    // Customer Profile
    Route::post('/customer/logout', [customersController::class, 'logout'])->name('customer.logout');
    Route::get('/customers/{id}/edit', [customersController::class, 'edit'])->name('public.profile');
    Route::put('/customers/{id}', [customersController::class, 'update'])->name('customers.update');
    Route::get('/profile', [customersController::class, 'profile'])->name('customer.profile');
    
    // Cart Routes
    Route::post('/cart', [CartController::class, 'addToCart'])->name('public.cart');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('public.cart.view');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
    
    // Product Details
    Route::get('/product/{id}', [productsController::class, 'detail'])->name('product.detail');
    
    // Order Routes
    Route::get('/orders', [orderController::class, 'index'])->name('customer.orders');
    Route::get('/checkout', [orderController::class, 'create'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/pesanan', [orderController::class, 'history'])->name('public.pesanan');
    Route::get('/cetak-struk/{orderId}', [orderController::class, 'cetakStruk'])->name('cetak-struk');
    
    // Order Actions
    Route::post('/orders/{order}/cancel', [orderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{id}/complete', [orderController::class, 'complete'])->name('orders.complete');
    
    // Pembayaran API
    Route::get('/pembayaran/{orderId}', [pembayaranController::class, 'pembayaran'])->name('pembayaran');
    
    // PDF
    Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);
});

Route::post('/payment/snap', [PembayaranController::class, 'getSnapToken'])
    ->name('payment.snap');
