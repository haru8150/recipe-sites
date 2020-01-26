<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //いいね登録する機能
    public function store(Request $request,$id)
    {
        //Userモデルのgoodメソッドを呼び出す
        \Auth::user()->good($id);
        return back();
    }
    
    //いいねを削除する機能
    public function destroy($id)
    {
        //Userモデルのungoodメソッドを呼び出す
        \Auth::user()->ungood($id);
        return back();
    }
}
