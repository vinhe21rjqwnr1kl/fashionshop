<?php

use Illuminate\Support\Facades\App;
use App\Http\Services\UploadService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\WishController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\paymentController;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\MenuControllerScreen;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\ProductControllerScreen;
use App\Http\Controllers\Admin\CartAdminController;
use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Users\RegisterController;

#Login
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

#logout
Route::post('admin/users/logout', [LoginController::class, 'logout'])->name('logout');

#Register
Route::get('admin/users/register', [RegisterController::class, 'index'])->name('register');
Route::post('admin/users/register/store', [RegisterController::class, 'store']);
#Role
Route::post('/admin/users/toggle-role/{id}', [UserController::class, 'toggleRole']);





// Route hiển thị form quên mật khẩu
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password');

// Route xử lý gửi email reset mật khẩu
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.password.send');

// Route hiển thị form reset mật khẩu
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// Route xử lý reset mật khẩu
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');


#Admin
Route::middleware(['auth', 'role:1,2'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [MainAdminController::class, 'index'])->name('admin');
        Route::get('main', [MainAdminController::class, 'index'])->name('admin');



        // Các route dành cho cả role 1 và role 2 (chỉ truy cập menu, sản phẩm, slider)
        Route::middleware('role:1,2')->group(function () {

            #Blogs
            Route::prefix('blogs')->group(function () {
                Route::get('/list', [BlogController::class, 'index'])->name('admin.blogs.index');
                Route::get('/create', [BlogController::class, 'create'])->name('admin.blogs.create');
                Route::post('/store', [BlogController::class, 'store'])->name('admin.blogs.store');
                Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
                Route::put('/update/{id}', [BlogController::class, 'update'])->name('admin.blogs.update');
                Route::delete('/delete/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
                Route::post('/upload/services', [BlogController::class, 'upload'])->name('admin.upload.services');
            });
            #News
            Route::prefix('news')->group(function () {
                Route::get('/list', [NewsController::class, 'index'])->name('admin.news.index');
                Route::get('/create', [NewsController::class, 'create'])->name('admin.news.create');
                Route::post('/store', [NewsController::class, 'store'])->name('admin.news.store');
                Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
                Route::put('/update/{id}', [NewsController::class, 'update'])->name('admin.news.update');
                Route::delete('/delete/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
                Route::post('/upload/services', [NewsController::class, 'upload'])->name('admin.upload.services');
            });
            #Product
            Route::prefix('products')->group(function () {
                Route::get('add', [ProductController::class, 'create']);
                Route::post('add', [ProductController::class, 'store']);
                Route::get('list', [ProductController::class, 'index']);
                Route::get('edit/{product}', [ProductController::class, 'show']);
                Route::post('edit/{product}', [ProductController::class, 'update']);
                Route::get('detail/{product}', [ProductController::class, 'showDetail']);
                Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');

                Route::get('/search', [ProductController::class, 'search'])->name('admin.products.search');

                Route::DELETE('destroy', [ProductController::class, 'destroy']);
            });

            #Slider
            Route::prefix('sliders')->group(function () {
                Route::get('add', [SliderController::class, 'create']);
                Route::post('add', [SliderController::class, 'store']);
                Route::get('list', [SliderController::class, 'index']);
                Route::get('edit/{slider}', [SliderController::class, 'show']);
                Route::post('edit/{slider}', [SliderController::class, 'update']);
                Route::DELETE('destroy', [SliderController::class, 'destroy']);
            });
        });

        // Các route chỉ dành cho role 2 (truy cập được tất cả các route)
        Route::middleware('role:2')->group(function () {


            #Menu
            Route::prefix('menus')->group(function () {
                Route::get('add', [MenuController::class, 'create']);
                Route::post('add', [MenuController::class, 'store']);
                Route::get('list', [MenuController::class, 'index']);
                Route::get('edit/{menu}', [MenuController::class, 'show']);
                Route::post('edit/{menu}', [MenuController::class, 'update']);
                Route::get('detail/{menu}', [MenuController::class, 'showDetail']);

                Route::DELETE('destroy', [MenuController::class, 'destroy']);
            });

            #User
            Route::prefix('users')->group(function () {

                Route::get('list', [UserController::class, 'index']);
                Route::get('search', [UserController::class, 'search'])->name('admin.users.search'); // Route tìm kiếm
                Route::DELETE('destroy', [UserController::class, 'destroy']);
            });
        });
        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);

        #Cart
        Route::get('customers', [CartAdminController::class, 'index']);

        Route::get('customers/view/{customer}', [CartAdminController::class, 'show']);

        Route::get('/payments', [paymentController::class, 'index']);
        #Role

    });
});


#Trang chủ
Route::get('/', [MainController::class, 'index'])->name('home');

Route::post('/services/load-product', [MainController::class, 'loadProduct']);

Route::get('/san-pham/{id}-{slug}.html', [MainController::class, 'show'])->name('show');


Route::get('/danh-muc/{id}-{slug}.html', [MenuControllerScreen::class, 'index']);
Route::get('/san-pham/{id}-{slug}.html', [ProductControllerScreen::class, 'index']);
Route::get('/products/popularity', [ProductControllerScreen::class, 'getFeaturedProducts'])->name('products.popularity');
Route::get('/products/newest', [ProductControllerScreen::class, 'getNewestProducts'])->name('products.newest');
Route::get('/search', [ProductControllerScreen::class, 'search'])->name('search');

// Route::post('/san-pham/{id}-{slug}.html', [ProductControllerScreen::class, 'indexQuickView']);



Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);

#Đăng nhập gmail 
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


#Đăng nhập facebook

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);


Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'editProfile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.update');
    Route::post('wish-list', [WishlistController::class, 'index'])->name('wishlist.add');
    Route::get('wishlists', [WishlistController::class, 'show'])->name('wishlist.show');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');



Route::get('language/{language}', [LanguageController::class, 'index'])->name('language.index');

Route::get('/tintuc', [NewsController::class, 'list'])->name('news.index');
Route::get('/tintuc/{id}', [NewsController::class, 'detail'])->name('news.detail');

Route::get('/baidang', [BlogController::class, 'list'])->name('blogs.index');
Route::get('/baidang/{id}', [BlogController::class, 'detail'])->name('blogs.detail');
#Cổng thanh toán
Route::post('/vnpay_create_payment', [paymentController::class, 'createPayment'])->name('createPayment');

Route::post('/payment', [paymentController::class, 'payment']);
Route::post('/saveInForPay', [paymentController::class, 'save']);
Route::get('/vnpay_return', [paymentController::class, 'vnpay_return']);

Route::post('/comment', [CommentController::class, 'sendComment']);
Route::get('/list_comment/{id}', [CommentController::class, 'getCommentByBlogID']);
