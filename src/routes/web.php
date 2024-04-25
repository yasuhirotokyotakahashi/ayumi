<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StoreRepresentativeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// 誰でも入れます
Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item:id}', [ItemController::class, 'detail'])->name('item.detail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 上記はデフォルトで入っていました。

    Route::post('/item/like/{item:id}', [LikeController::class, 'create'])->name('like.create');
    Route::post('/item/unlike/{item:id}', [LikeController::class, 'destroy'])->name('like.destroy');
    Route::get('/purchase/{item:id}', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::post('/purchase/{item:id}', [PurchaseController::class, 'purchase'])->name('purchase.purchase');
    Route::get('/address', [PurchaseController::class, 'address'])->name('purchase.address');
    Route::post('/address/ok', [PurchaseController::class, 'updateAddress'])->name('purchase.updateAddress');

    Route::get('/mypage', [UserController::class, 'mypage'])->name('user.mypage');
    Route::get('/mypage/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/mypage/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/mail', [MailController::class, 'index'])->name('mail.index');
    Route::post('/mail/confirm', [MailController::class, 'confirm'])->name('mail.confirm');
    Route::post('/mail', [MailController::class, 'create'])->name('mail.create');

    // 管理者権限のルート
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.user')->middleware(['role:admin']);
    Route::delete('/admin/{user:id}', [AdminController::class, 'delete'])->name('user.delete')->middleware(['role:admin']);
    Route::get('/admin/comment', [AdminController::class, 'confirm'])->name('comment.confirm')->middleware(['role:admin']);

    // 店舗代表者のルート
    Route::get('/shop', [StoreRepresentativeController::class, 'inviteStaff'])->name('shop.index')->middleware(['role:shop_owner']);
    Route::post('/shop', [StoreRepresentativeController::class, 'assignRole'])->name('shop.assign')->middleware(['role:shop_owner']);
    Route::post('/shop/remove', [StoreRepresentativeController::class, 'removeRole'])->name('shop.remove')->middleware(['role:shop_owner']);

    // 認証ユーザーのルート
    Route::get('/comment/{item:id}', [CommentController::class, 'index'])->name('comment.index')->middleware(['role:user']);
    Route::post('/comment/{item:id}', [CommentController::class, 'create'])->name('comment.create')->middleware(['role:user']);
    Route::delete('/comment/{commentId}', [CommentController::class, 'delete'])->name('comment.delete')->middleware(['role:user']);
    Route::get('/sell', [ItemController::class, 'sellView'])->name('item.sellView')->middleware(['role:user']);
    Route::post('/sell/create', [ItemController::class, 'sellCreate'])->name('item.sellCreate')->middleware(['role:user']);
});





require __DIR__ . '/auth.php';
