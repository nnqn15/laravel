<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::get('/about',[HomeController::class,'about'])->name('about');


Route::get('/shop',[ProductsController::class,'index'])->name('product.shop');
Route::post('/search',[ProductsController::class,'search'])->name('product.search');
Route::get('/product/detail/{id}',[ProductsController::class,'detail'])->name('product.detail');
Route::get('/cart',[ProductsController::class,'cart'])->name('product.cart');
Route::get('/checkout',[ProductsController::class,'checkout'])->name('product.checkout')->middleware('checkcart');
Route::post('/order',[ProductsController::class,'order'])->name('product.order');
Route::get('/clearCart',[ProductsController::class,'clearCart'])->name('product.clearCart');
Route::post('/cart/add', [ProductsController::class, 'addcart'])->name('product.addcart');
Route::post('/cart/update', [ProductsController::class, 'updatecart'])->name('product.updatecart');
Route::post('/cart/remove', [ProductsController::class, 'removecart'])->name('product.removecart');
Route::get('/add/wish',[ProductsController::class,'addwish'])->name('product.addwish');



Route::get('user/wishlist',[UsersController::class,'wishlist'])->name('user.wishlist');
Route::get('/order/detail/{id}',[UsersController::class,'orderdetail'])->name('product.orderdetail');

Route::get('/categories/{id}',[CategoryController::class,'categories'])->name('product.categories');



Route::view('/user/dashboard','auth.admin')->name('user.dashboard')->middleware('login.check');
Route::get('/user/login', function (){ return view('auth.login');})->name('user.login');
Route::get('/user/register', function (){ return view('auth.register');})->name('user.register');
Route::get('/user/update', function (){ return view('auth.update');})->name('user.update');
Route::post('/user/logincheck',[UserLoginController::class,'login'])->name('dangnhap');
Route::post('/user/registercheck',[UserLoginController::class,'register'])->name('dangky');
Route::post('/user/logout',[UserLoginController::class,'logout'])->name('dangxuat');
Route::post('/user/update/post',[UserLoginController::class,'update'])->middleware('auth')->name('suataikhoan');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('user.forgot');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('user.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('user.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth', 'checkAdminRole', 'nocache'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/orders',[OrderController::class,'orders'])->name('admin.orders');
    Route::get('/edit/order/{id}',[OrderController::class,'editorder'])->name('admin.editorder');
    Route::put('/update/order/{id}',[OrderController::class,'updateorder'])->name('admin.updateorder');
    Route::get('/admin/products',[ProductsController::class,'products'])->name('admin.products');
    Route::post('/admin/products/add',[ProductsController::class,'addproduct'])->name('admin.addpro');
    Route::get('/edit/product/{id}',[ProductsController::class,'editproduct'])->name('admin.editpro');
    Route::put('/product/update/{id}',[ProductsController::class,'updateproduct'])->name('admin.updatepro');
    Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('admin.prodelete');
    Route::get('/admin/categories',[CategoryController::class,'admincategories'])->name('admin.categories');
    Route::post('/admin/categories/add',[CategoryController::class,'addcate'])->name('admin.addcate');
    Route::get('/edit/category/{id}',[CategoryController::class,'editcate'])->name('admin.editcate');
    Route::put('/category/update/{id}',[CategoryController::class,'updatecate'])->name('admin.updatecate');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.delete');
    Route::post('/categories/search', [CategoryController::class, 'search'])->name('admin.catesearch');
    Route::get('/admin/users',[UsersController::class,'users'])->name('admin.users');
    Route::get('/edit/user/{id}',[UsersController::class,'edituser'])->name('admin.edituser');
    Route::put('/update/user/{id}',[UsersController::class,'updateuser'])->name('admin.updateuser');
    Route::delete('/delete/user/{id}',[UsersController::class,'destroy'])->name('admin.deleteuser');
    Route::post('/user/search', [UsersController::class, 'search'])->name('admin.searchuser');
});