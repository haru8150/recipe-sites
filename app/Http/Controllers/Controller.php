<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/*
enum Days {
    Mon = 1,
    Tue = 2,
    Wed = 4,
    Thu,
    Fri,
    Sat,
    Sun
  }
*/


//APPの下に別フォルダつくり、そこに材料クラス創る　define（）使える
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //定数関係のコンストラクタ
    // public $cooking_time = [
    //       5 => '5分',  
    //       10 => '10分',  
    //       15 => '15分',  
    //       20 => '20分',  
    //       25 => '25分',  
    //       30 => '30分',  
    //       99 => '30分以上',  
    // ];
    
    // function __construct($cooking_time) {
    //     $this->$cooking_time = $cooking_time;
    // }
    
    
    //投稿されたrecipeの数のカウントする
    public function counts($recipes)
    {
        $count_recipes = $recipes->count();

        return [
            'count_recipes' => $count_recipes,
        ];
    }
    
    //ユーザーにお気に入り・いいねされた数のカウント
    public function UserOfCounts($recipes)
    {
        //Userモデルのfavorites()メソッドから一覧数をカウント
        $count_favorites = $recipes->favorite_users()->count();
        $count_goods = $recipes->good_users()->count();
        // dd($count_favorites);

        return [
            'count_favorites' => $count_favorites,
            'count_goods' => $count_goods,
        ];
    }
}
