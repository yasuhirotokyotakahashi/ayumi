<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 追加

Route::get('/item', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item:id}', [ItemController::class, 'detail'])->name('item.detail');
Route::post('/item/comment/{item:id}', [CommentController::class, 'create'])->name('comment.create');
Route::post('/item/like/{item:id}', [LikeController::class, 'create'])->name('like.create');
Route::post('/item/unlike/{item:id}', [LikeController::class, 'destroy'])->name('like.destroy');
Route::get('/purchase/{item:id}', [PurchaseController::class, 'index'])->name('purchase.index');
Route::post('/purchase/{item:id}', [PurchaseController::class, 'purchase'])->name('purchase.purchase');
Route::get('/purchase/address/{item:id}', [PurchaseController::class, 'address'])->name('purchase.address');
Route::post('/purchase/address/{item:id}', [PurchaseController::class, 'updateAddress'])->name('purchase.updateAddress');
Route::get('/sell', [ItemController::class, 'sellView'])->name('item.sellView');
Route::post('/sell/create', [ItemController::class, 'sellCreate'])->name('item.sellCreate');
Route::get('/mypage', [UserController::class, 'mypage'])->name('user.mypage');
Route::get('/mypage/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/mypage/profile', [UserController::class, 'uodateProfile'])->name('user.updateProfile');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

require __DIR__ . '/auth.php';
