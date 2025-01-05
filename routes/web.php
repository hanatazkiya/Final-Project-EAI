<?php

use App\Models\Payments\Doku;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TrafficController;

// get handler
Route::get('/', [TrafficController::class, 'index']);
Route::get('/login', [TrafficController::class, 'loginPage']);
Route::get('/register', [TrafficController::class, 'registerPage']);

// post handler
Route::post('/login', [UserController::class, 'loginHandler']);
Route::post('/register', [UserController::class, 'registerHandler']);
Route::post('/find', [TrafficController::class, 'findPlace']);
Route::post('/get', [TrafficController::class, 'getLastFind']);

// admin
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'redirect']);
    Route::get('/dashboard', [AdminController::class, 'dashboardPage']);
    Route::get('/login', [AdminController::class, 'loginPage']);
    Route::get('/logout', [AdminController::class, 'logoutHandler']);
    Route::get('/add', [AdminController::class, 'addPage']);
    Route::get('/preview', [AdminController::class, 'findPage']);
    
    // admin main feature
    Route::get('/preview/{slug}', [AdminController::class, 'previewPlace']);
    Route::post('/login', [AdminController::class, 'loginHandler']);
    Route::post('/add', [AdminController::class, 'addHandler']);
    
    // admin update feature
    Route::get('/update', [AdminController::class, 'findUpdatePage']);
    Route::get('/update/{slug}', [AdminController::class, 'updatePage']);
    Route::post('/update/request', [AdminController::class, 'updateRequest']);

    // refund
    Route::get('/refund/accept/{invoice_number}', [AdminController::class, 'acceptRefund']);
    Route::get('/refund/decline/{invoice_number}', [AdminController::class, 'declineRefund']);
    Route::get('/refund/detail/{invoice_number}', [AdminController::class, 'getRefundPreview']);
});

// added page
Route::get('/find', [TrafficController::class, 'findLastPlace']);
Route::get('/detail/{place}', [PlaceController::class, 'getPlace']);
Route::get('/cart', [UserController::class, 'getCart']);
Route::get('/profile', [UserController::class, 'getProfile']);
Route::post('/profile', [UserController::class, 'updateHandler']);
Route::get('/history', [UserController::class, 'getHistory']);
Route::get('/logout', [UserController::class, 'logoutHandler']);
Route::get('/booking/{slug}', [UserController::class, 'bookingPlace']);

// Booking Request
Route::post('/request-booking', [UserController::class, 'sendBookingRequest']);

// Payment Gateway
Route::post('/checkout', [Doku::class, 'createPayment']);
Route::post('/checkout/signature', [Doku::class, 'generateSignature']);
Route::get('/checkout/status', [Doku::class, 'getPaymentStatus']);
Route::get('/cart/{invoice_number}', [UserController::class, 'validatePayment']);

// Refund Request
Route::get('/refund', [UserController::class, 'getRefund']);
Route::get('/refund/{invoice_number}', [UserController::class, 'getRefundDetail']);
Route::post('/refund/send-message', [UserController::class, 'postRefundRequest']);