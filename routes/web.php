<?php


Route::get('/', 'ImagesController@index');

Route::get('/upload', 'UploadController@index');
Route::post('/upload', 'UploadController@store');



Route::post('/users2222', 'MyUsersController@store');





Route::get('/create', 'ImagesController@create')->middleware('user');

Route::post('/store', 'ImagesController@store')->middleware('user');

Route::get('/show/{id}', 'ImagesController@show');



Route::post('/update/{id}', 'ImagesController@update');

Route::get('/category/{id}', 'ImagesController@categoryShow');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

 Route::get('/myprofile/info', 'UsersController@info');
 Route::get('/myprofile/images', 'UsersController@images');
 Route::get('/myprofile/images/edit/{id}', 'ImagesController@edit')->middleware('userImage');
 Route::put('/myprofile/images/update/{id}', 'ImagesController@update')->middleware('userImage');
 Route::get('myprofile/images/delete/{id}', 'ImagesController@delete')->middleware('userImage');



///////////////////////////////////////
Route::group(['as' => 'admin.', 'namespace'=>'Admin', 'prefix' => 'admin', 'middleware' => ['admin']], function() {
	Route::get('/', 'HomeController@index');
        Route::get('/posts', 'PostsController@index')->name('posts');
        Route::delete('/posts/{d}', 'PostsController@destroy');
        
        Route::get('/posts/create', 'PostsController@create')->name('posts.create');
        Route::get('/posts/edit/{d}', 'PostsController@edit')->name('posts.edit');
        Route::post('/posts/store', 'PostsController@store');
        Route::put('/posts/update/{d}', 'PostsController@update')->name('posts.update');
        
        Route::get('users/', 'UsersController@index')->name('users');
        Route::get('users/create', 'UsersController@create')->name('users.create');
        Route::post('users/store', 'UsersController@store');
        Route::get('users/edit/{d}', 'UsersController@edit')->name('users.edit');
        Route::put('users/update/{d}', 'UsersController@update')->name('users.update');
        Route::delete('users/destroy/{d}', 'UsersController@destroy')->name('users.destroy');
        
        Route::get('categories/', 'CategoriesController@index')->name('categories');
        Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
        Route::post('categories/store', 'CategoriesController@store')->name('categories.store');
        Route::get('categories/edit/{d}', 'CategoriesController@edit')->name('categories.edit');
        Route::put('categories/update/{d}', 'CategoriesController@update')->name('categories.update');
        Route::delete('categories/destroy/{d}', 'CategoriesController@destroy')->name('categories.destroy');
});


