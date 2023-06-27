<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\BlogMController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;



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

// Route::get('/', function () {
//     return view('admin.user.dashboard');
// });


Route::get('/login', [DemoController::class, 'GetLogin']);
Route::post('/login', [DemoController::class, 'PostLogin']);

// Route::get('/',function(){
//     return view('index');
// });
Route::get('demo1', function(){
    return view('demo1');
});
Route::get('demo2', function(){
    return view('demo2');
});


Route::get('/infor', [DemoController::class, 'GetInfor']);

Route::get('/add', function(){
    return view('player_table.add');
});
Route::post('/add', [DemoController::class, 'AddInfor']);

// Route::get('/edit/{id}', function($id){
//     return view('player_table.edit');
// });

// Route::get('/delete/{id}', function(){
//     return view('player_table.delete');
// });

// Route::get('/edit/{id}', [DemoController::class, 'EditInfor']);
// Route::post('/edit/{id}', [DemoController::class, 'UpdateInfor']);

// Route::get('/delete/{id}',[DemoController::class, 'DeleteInfor']);

//admin//
//dashboard
Route::prefix('admin')->group(function(){


Route::get('/dashboard', [DashboardController::class, 'ShowDashboard']);

//profile
Route::get('/pages-profile.html', [UserController::class, 'ShowProfile']);
Route::get('/pages-profile.html', [UserController::class, 'ShowCountry']);
Route::post('/pages-profile.html', [UserController::class, 'UpdateProfile']);

//country
Route::get('country.html', [CountryController::class, 'ShowCountry']);

Route::get('country/add', [CountryController::class, 'ShowAddForm']);
Route::post('country/add', [CountryController::class, 'AddCountry']);

Route::get('country/edit/{id}', [CountryController::class, 'ShowEditForm']);
Route::post('country/edit/{id}', [CountryController::class, 'EditCountry']);

Route::get('country/delete/{id}', [CountryController::class, 'DeleteCountry']);

//brand
Route::get('brand.html', [BrandController::class, 'ShowBrand']);

Route::get('brand/add', [BrandController::class, 'ShowAddForm']);
Route::post('brand/add', [BrandController::class, 'AddBrand']);

Route::get('brand/edit/{id}', [BrandController::class, 'ShowEditForm']);
Route::post('brand/edit/{id}', [BrandController::class, 'EditBrand']);

Route::get('brand/delete/{id}', [BrandController::class, 'DeleteBrand']);

//category
Route::get('category.html', [CategoryController::class, 'ShowCategory']);

Route::get('category/add', [CategoryController::class, 'ShowAddForm']);
Route::post('category/add', [CategoryController::class, 'AddCategory']);

Route::get('category/edit/{id}', [CategoryController::class, 'ShowEditForm']);
Route::post('category/edit/{id}', [CategoryController::class, 'EditCategory']);

Route::get('category/delete/{id}', [CategoryController::class, 'DeleteCategory']);

//Blog
Route::prefix('blog.html')->group(function(){
    Route::get('/', [BlogController::class, 'ShowBlog']);

    Route::get('add', [BlogController::class, 'ShowAddForm']);
    Route::post('add', [BlogController::class, 'AddBlog']);

    Route::get('edit/{id}', [BlogController::class, 'ShowEditForm']);
    Route::post('edit/{id}', [BlogController::class, 'EditBlog']);

    Route::get('delete/{id}', [BlogController::class, 'DeleteBlog']);
});

});

//frontend//

//landing page
Route::get('/', [HomeController::class, 'ShowLandingPage']);
//product-detail
Route::get('/product-details/{id}', [ProductController::class, 'ShowProductDetail']);
//member//
Route::get('sign-up', [MemberController::class, 'ShowRegisterForm']);
Route::post('sign-up', [MemberController::class, 'MemberRegister']);

Route::get('login.html', [MemberController::class, 'ShowLoginForm']);
Route::post('login.html', [MemberController::class, 'MemberLogin']);

//blog
Route::get('blog.html', [BlogMController::class, 'ShowBlog']);
Route::get('blog-single.html/{id}', [BlogMController::class, 'ShowBlogSingle']);
Route::post('/blog/ajaxRate', [BlogMController::class, 'RateBlog']);
Route::post('/blog/comment', [BlogMController::class, 'CommentBlog']);

//account
Route::prefix('account')->group(function(){
    Route::get('/', [AccountController::class, 'ShowAccount']);
    Route::post('/', [AccountController::class, 'UpdateAccount']);

    //product
    Route::prefix('product')->group(function(){
        Route::get('/', [ProductController::class, 'ShowProductList']);

        Route::get('/add', [ProductController::class, 'ShowAddForm']);
        Route::post('/add', [ProductController::class, 'AddProduct']);

        Route::get('/edit/{id}', [ProductController::class, 'ShowEditForm']);
        Route::post('/edit/{id}', [ProductController::class, 'EditProduct']);

        Route::get('/delete/{id}', [ProductController::class, 'DeleteProduct']);
    });
});

//cart
Route::prefix('cart')->group(function(){
    Route::get('/', [CartController::class, 'ShowCart']);
    
    Route::post('/ajaxBuy', [CartController::class, 'BuyProduct']);
    Route::post('/ajaxIncrease', [CartController::class, 'IncreaseProduct']);
    Route::post('/ajaxDecrease', [CartController::class, 'DecreaseProduct']);
    Route::post('/ajaxDelete', [CartController::class, 'DeleteProduct']);

});

//logout
Route::get('/logout', function(){
    Auth::logout();
    session()->forget('cart');
    session()->forget('totalQty.qty');
    return redirect('login.html');
});














//loginvao
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/demo', [DemoController::class, 'helloWorld']);
