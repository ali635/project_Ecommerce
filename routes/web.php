<?php


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

use App\Http\Controllers\Images;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/shop', 'ShopController@index')->name('shop.index');

Route::get('/product/{id}', 'ProductController@show')->name('product.show');

Route::get('/cart', function(){
    return view('cart');
});

Route::get('/checkout', function(){
    return view('checkout');
});

Route::get('/blog', 'BlogController@index')->name('blog.index');

Route::get('/contact-us', function(){
    return view('contact-us');
});

Route::get('/404', function(){
    return view('404');
});

// Route::group(['middleware' => 'Maintenance'], function () {
//     Route::get('/', function () {
//         return view('style.home');
//     });
// });

// Route::get('test', function () {
//     return view('auth.login')->name('mohamed');
// });

// Route::get('maintenance', function () {
//     if(setting()->status == 'open')
//     {
//         return redirect('/');
//     }
//     return view('style.maintenance');
// });

// Auth::routes();

