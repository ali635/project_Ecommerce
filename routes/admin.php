<?php




Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
    Config::set('auth.defines', 'admin');
    Route::get('login','AdminAuth@login9')->name('login9');
    Route::post('login','AdminAuth@dologin')->name('dologin');
    Route::get('forgot/password','AdminAuth@forgot_password');
    Route::post ('forgot/password','AdminAuth@forgot_password_post');
    Route::get('reset/password/{token}','AdminAuth@reset_password');
    Route::post('reset/password/{token}','AdminAuth@reset_password_final');
   
    
    Route::group(['middleware' => 'admin:admin'], function () {
        Route::resource('admin','AdminController');
        Route::delete('admin/destory/all', 'AdminController@multi_delete');
       
        Route::resource('users','UsersController');
        Route::delete('users/destory/all', 'UsersController@multi_delete');
        

        Route::resource('countries','CountriesController');
        Route::delete('countries/destory/all', 'CountriesController@multi_delete');
        
        Route::resource('cities','CitiesController');
        Route::delete('cities/destory/all', 'CitiesController@multi_delete');

        Route::resource('states','StatesController');
        Route::delete('states/destory/all', 'StatesController@multi_delete');

        Route::resource('trademarks','TradeMarksController');
        Route::delete('trademarks/destory/all', 'TradeMarksController@multi_delete');
        
        Route::resource('manufacturers','ManufacturersController');
        Route::delete('manufacturers/destory/all', 'ManufacturersController@multi_delete');

        Route::resource('shipping','ShippingController');
        Route::delete('shipping/destory/all', 'ShippingController@multi_delete');

        Route::resource('malls','MallsController');
        Route::delete('malls/destory/all', 'MallsController@multi_delete');
        
        Route::resource('colors','ColorsController');
        Route::delete('colors/destory/all', 'ColorsController@multi_delete');
       
        Route::resource('sizes','SizesController');
        Route::delete('sizes/destory/all', 'SizesController@multi_delete');
        
        Route::resource('products','ProductesController');
        Route::delete('products/destory/all', 'ProductesController@multi_delete');
        Route::post('products/copy/{id}','ProductesController@copy_product');

        Route::post('products/search','ProductesController@product_search');
        
        Route::post('upload/image/{id}','ProductesController@upload_file');
        Route::post('delete/image','ProductesController@delete_file');
        
        Route::post('update/image/{id}','ProductesController@update_product_image');
        Route::post('delete/product/image/{id}','ProductesController@delete_main_image');
        
        Route::resource('weights','WeightsController');
        Route::delete('weights/destory/all', 'WeightsController@multi_delete');
        Route::post('load/wight/size','ProductesController@repare_weight_size');
        Route::resource('departments','DepartmentsController');

        Route::resource('bids', 'BidsController');
        Route::delete('bids/destory/all', 'BidsController@multi_delete');
        Route::post('bid/{id}', 'BidsController@place');

        Route::resource('auctions', 'AuctionsController');
        Route::delete('auctions/destory/all', 'AuctionsController@multi_delete');

        Route::resource('carts', 'CartsController');
        Route::delete('carts/destory/all', 'CartsController@multi_delete');

        

        Route::get('/', function () {
            return view('admin.home');
        });
        Route::get('settings', 'Settings@setting');
		Route::post('settings', 'Settings@setting_save');
        Route::any('logout', 'AdminAuth@logout');
    });
    Route::get('lang/{lang}',function($lang){
        session()->has('lang')?session()->forget('lang'):'';
        $lang == 'ar'?session()->put('lang','ar') : session()->put('lang','en');
        return back();
    });
});