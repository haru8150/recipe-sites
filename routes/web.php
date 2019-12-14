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

//ログイン後のトップページ（レシピ一覧）
Route::get('/', 'RecipesController@index');
Route::resource('recipes', 'RecipesController');

//ユーザー登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');//ユーザー登録画面へ遷移
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');//ユーザー登録処理

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//レシピのルーティング 一覧表示(index)と詳細(show)は未ログインでも可能
// Route::resource('recipes', 'RecipesController',['only' => ['index','show']]);

//６、レシピのルーティング（レシピの投稿や編集、削除はログインユーザーのみ可能）
// Route::resource('recipes', 'RecipesController',['only' => ['store','create','edit','destroy','update']]);


//ログイン認証を必要とするルーティンググループ
Route::group( ['middleware' => ['auth']], function(){
    
    //１、ユーザーごとのお気に入り一覧のルーティング
    Route::group(['prefix' => 'users/{id}'], function(){
        Route::get('favorites','UsersController@favorites')->name('users.favorites');//ユーザーのお気に入り情報
    });
    
    //２、お気に入り処理のルーティング(登録、削除)view不要
    Route::group(['prefix' => 'recipes/{id}'], function(){
       Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite'); 
       Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite'); 
    });
    
    //３、「いいね」処理のルーティング(登録、削除)view不要
    Route::group(['prefix' => 'recipes/{id}'], function(){
       Route::post('good', 'GoodsController@store')->name('goods.good'); 
       Route::delete('ungood', 'GoodsController@destroy')->name('goods.ungood'); 
    });
    
    //４、ランキング表示のルーティング（一覧表示のみ）
    Route::resource('goodsranking', 'GoodsrankingController',['only' => ['index']]);

    //５、コメント投稿のルーティング（投稿処理のみ）
    Route::resource('comments','CommentsController',['only' => ['store']]);
});

