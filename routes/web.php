<?php
use App\Models\Category;

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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware'=> ['auth']], function() {
    Route::get('/', function(){
        return redirect()->route('products_index');
    });

    Route::group(['prefix'=> '/products'], function() {
        Route::get('/', 'ProductController@index')->name('products_index');
        Route::get('/categories/{categoryId}', 'ProductController@filter')->where('categoryId', '\d+')->name('filter_products');
        Route::get('/create', 'ProductController@create')->name('create_product');
        Route::get('/{productId}/show', 'ProductController@show')->where('productId', '\d+')->name('show_product');
        Route::get('/{productId}/edit', 'ProductController@edit')->where('productId', '\d+')->name('edit_product');
        Route::post('{productId}/update', 'ProductController@update')->where('productId', '\d+')->middleware('permission:modify')->name('update_product');
        Route::post('/store', 'ProductController@store')->middleware('permission:create')->name('store_product');
        Route::get('/{productId}/delete', 'ProductController@destroy')->where('productId', '\d+')->middleware(['permission:delete', 'confirm:delete',])->name('delete_product');
    });

    Route::group(['prefix'=> '/stocks'], function() {
        Route::get('/', 'StockController@index')->name('stocks_index');
        Route::get('/{productId}/edit', 'StockController@edit')->where('productId', '\d+')->name('edit_stock');
        Route::post('/{productId}/update', 'StockController@update')->where('productId', '\d+')->middleware('permission:modify')->name('update_stock');
        Route::get('/print', 'StockController@publish')->middleware('permission:publish')->name('print_stocks');
    });

    Route::group(['prefix'=> '/categories'], function() {
        Route::get('/create', 'CategoryController@create')->name('create_category');
        Route::post('/store', 'CategoryController@store')->middleware('permission:create')->name('store_category');
    });

    Route::group(['prefix'=> '/sales'], function() {
        Route::get('/', 'SaleController@index')->name('sales_index');
        Route::post('/history', 'SaleController@history')->name('sales_history');
        Route::get('/print', 'SaleController@publish')->middleware('permission:publish')->name('print_sales');
    });

    Route::group(['prefix'=> '/cart'], function() {
        Route::get('/', 'CartController@index')->name('show_cart');
        Route::get('/add', 'CartController@add')->name('add_to_cart');
        Route::get('/{itemId}/remove', 'CartController@remove')->where('itemId', '\w+')->name('remove_from_cart');
        Route::post('/{itemId}/update', 'CartController@update')->where('itemId', '\w+')->name('update_item');
        Route::post('/save', 'CartController@save')->name('save_cart');
        Route::get('{cartId}/restore', 'CartController@restore')->name('restore_cart');
        Route::get('/checkout', 'CartController@checkout')->name('checkout');
        Route::get('/empty', 'CartController@destroy')->name('empty_cart');
    });

    Route::group(['prefix'=> '/manage', 'middleware'=> 'permission:admin'], function() {
        Route::get('/', 'UserController@index')->name('manage');
        Route::get('/users/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('/users/register', 'Auth\RegisterController@register');
        Route::get('/users/{userId}/permissions', 'UserController@getPermissions')->where('userId', '\d+')->name('change_permissions');
        Route::post('/users/{userId}/apply-permissions', 'UserController@applyPermissions')->where('userId', '\d+')->name('apply_permissions');
        Route::get('/users/{userId}/delete', 'UserController@destroy')->where('userId', '\d+')->name('delete_user');
    });

    Route::get('/users/{userId}/profile', 'UserController@edit')->where('userId', '\d+')->name('user_profile');
    Route::get('/users/{userId}/update', 'UserController@update')->where('userId', '\d+')->name('update_profile');
});



Route::get('/test', function() {
    return view('test');
});

Route::get('/test2', function() {
    $user = \App\User::first();
    // dd($user);
    return redirect('/test')->with(compact('user'));
});
