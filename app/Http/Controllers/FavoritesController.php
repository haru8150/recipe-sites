<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    //お気に入り登録する機能
    public function store(Request $request,$id)
    {
        //Userモデルのfavoriteメソッドを呼び出す
        \Auth::user()->favorite($id);
        //直前のページに戻る
        return back();
    }
    
    //お気に入りから削除する機能
    public function destroy($id)
    {
        //Userモデルのunfavoriteメソッドを呼び出す
        \Auth::user()->unfavorite($id);
        return back();
    }
}
