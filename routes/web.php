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

Auth::routes();

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
        Route::group(['middleware'=> ['admin']], function() {
            Route::post('{productId}/update', 'ProductController@update')->where('productId', '\d+')->name('update_product');
            Route::post('/store', 'ProductController@store')->name('store_product');
            Route::get('/{productId}/delete', 'ProductController@destroy')->where('productId', '\d+')->middleware('confirm')->name('delete_product');
        });
    });

    Route::group(['prefix'=> '/stocks'], function() {
        Route::get('/', 'StockController@index')->name('stocks_index');
        Route::get('/{productId}/edit', 'StockController@edit')->where('productId', '\d+')->name('edit_stock');
        Route::group(['middleware'=> ['admin']], function() {
            Route::post('/{productId}/update', 'StockController@update')->where('productId', '\d+')->name('update_stock');
            Route::get('/print', 'StockController@publish')->name('print_stocks');
        });
    });

    Route::group(['prefix'=> '/categories'], function() {
        Route::get('/create', 'CategoryController@create')->name('create_category');
        Route::group(['middleware'=> ['admin']], function() {
            Route::post('/store', 'CategoryController@store')->name('store_category');
        });
    });

    Route::group(['prefix'=> '/sales'], function() {
        Route::get('/', 'SaleController@index')->name('sales_index');
        Route::post('/history', 'SaleController@history')->name('sales_history');
        Route::get('/print', 'SaleController@publish')->name('print_sales');
    });
    Route::group(['prefix'=> '/cart'], function() {
        Route::get('/add', 'CartController@add')->name('add_to_cart');
        Route::get('/show', 'CartController@show')->name('show_cart');
        Route::get('/{itemId}/remove', 'CartController@remove')->where('itemId', '\w+')->name('remove_from_cart');
        Route::post('/{itemId}/update', 'CartController@update')->where('itemId', '\w+')->name('update_item');
        Route::post('/save', 'CartController@save')->name('save_cart');
        Route::get('{cartId}/restore', 'CartController@restore')->name('restore_cart');
        Route::get('/checkout', 'CartController@checkout')->name('checkout');
        Route::get('/print', 'CartController@publish')->name('print_receipt');
        Route::get('/empty', 'CartController@destroy')->name('empty_cart');
    });

    Route::group(['prefix'=> '/manage', 'middleware'=>'admin',], function() {
        Route::get('/', 'ManagementController@index')->name('manage');
        Route::get('/users/{userId}', 'ManagementController@user')->where('userId', '\d+')->name('user_profile');
    });
});



Route::get('/test', function() {
    $timestamp = date('Y-m-d H:i:s');
    return PDF::loadView('pdf.cart_pdf', compact('timestamp'))->stream();
});

Route::get('/test2', function() {
    Notification::success('Hello World');
    $timestamp = date('Y-m-d H:i:s');
    return view('pdf.cart_pdf')->with(compact('timestamp'));
});
