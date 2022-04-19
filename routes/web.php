<?php

use App\Http\Controllers\ProdController;
use App\Http\Controllers\CateController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DetailPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;


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

Route::get('/', [PostController::class, 'indexUser'])->name('home-user');
Route::get('/slug/{slug}', [DetailPostController::class, 'index'])->name('detail');
Route::get('/getInfo', [PostController::class, 'getInfoPost'])->name('infoPost');
Route::get('/getDetailPost', [DetailPostController::class, 'getDetailPost'])->name('detailPost');

// Chức năng dành cho user
Route::middleware(['auth', 'role:User'])->name('User.')->prefix("User")->group(function () {

    Route::get('/', [PostController::class, 'indexUser'])->name('home-user');
    Route::post('/comment', [CommentController::class, 'comment'])->name('comment');
});


// Chức năng dành cho admin
Route::middleware(['auth', 'role:Admin'])->name('Admin.')->prefix("Admin")->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('post');
    Route::get('/add-post', [PostController::class, 'create'])->name('create');
    Route::post('/add-post/store', [PostController::class, 'store'])->name('store');
    Route::post('/add-post/image-upload', [PostController::class, 'upload'])->name('upload');
    Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('edit');
    Route::put('/update-post/{id}', [PostController::class, 'update'])->name('update');
    Route::post('/delete-post/{id}', [PostController::class, 'delete'])->name('delete-post');
});


// Chức năng dành cho super admin
Route::middleware(['auth', 'role:Super Admin'])->name('Super-Admin.')->prefix("Super-Admin")->group(function () {
    Route::get('/list-admin', [AdminController::class, 'index'])->name('list');
    Route::get('/createAd', [AdminController::class, 'create'])->name('createAd');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/editAd/{id}', [AdminController::class, 'edit'])->name('editAd');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('delete');
});


//thao tác với sản phẩm
// Route::resource('/product', ProdController::class);
// Route::prefix("product")->name('product.')->group(function () {
//     Route::get('/hide/{id}', [ProdController::class, 'hide'])->name('hide');
// });

//thao tác với thể loại
// Route::resource('/cate', CateController::class);
// Route::prefix("cate")->name('cate.')->group(function () {
//     Route::get('/hide/{id}', [CateController::class, 'hide'])->name('hide');
// });

// Tạo biểu đồ thống kê
// Route::get('/dashboard', [ChartJSController::class, 'index'])->name('dashboard');

// Route::get('/chat', [ChatController::class, 'index'])->name('chat');
// Route::get('/chat/show/{id}', [ChatController::class, 'show'])->name('chat-show');
// Route::get('/chat/getInfo/{id}', [ChatController::class, 'getInfo'])->name('getInfo');
// Route::post('/chat/store', [ChatController::class, 'store'])->name('chat-store');


// Route::get('/javascript', [ChartJSController::class, 'studyJS'])->name('stdJS');




require __DIR__ . '/auth.php';