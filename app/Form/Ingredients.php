<?php

namespace App;

    // define('INGREDIENTS', [
    //           1 => 'たまねぎ',  
    //           2 => 'にんじん',  
    //           4 => 'たまご',  
    //           8 => 'きゃべつ',  
    
    // ]);


class Ingredients
{
    public $id = '';
    public $user_id = '';
    public $recipe_name = '';
    public $recipe_image1_url = '';
    public $recipe_image2_url = '';
    public $genre = '';
    public $cooking_time = '';
    public $ingredients = '';
    public $summary = '';
    public $procedure = '';
    
    //要は全部
    //ingredientsのみ変換対象
    //材料文字列配列[];
    
    //コンストラクタ
    function __construct($recipes)
    {
        foreach($recipes as $recipe){
            //$this->id = $recipies;
            //こんな風にingredients以外は全部格納する
            $this->id = $recipe->$id;
            $this->user_id = $recipe->$user_id;
            $this->recipe_name = $recipe->$recipe_name;
            $this->recipe_image1_url = $recipe->$recipe_image1_url;
            $this->recipe_image2_url = $recipe->$recipe_image2_url;
            $this->genre = $recipe->$genre;
            $this->summary = $recipe->$summary;
            $this->procedure = $recipe->$procedure;
        }
        
        //$材料文字列配列=材料変換メソッド($recipies->ingredients);  文字列配列
        function toStringIngredients($ingredients){
            dd($recipe->$ingredients);
        }
            
        
    }
    
    function getAllRecipes()//コントローラーに渡すために必要
    {
        //dd(INGREDIENTS[1]);
        return $this->$recipes;
        
    }
    
//クラス変数としてrecipesテーブルと同じプロパティを持たせる

    //DBから受け取ったコレクションをもらって、材料値を名前に変換してコレクションで返す関数
    // 材料値7だったら玉ねぎ,にんじん,たまごがある
    //材料値のメンバ変数が7を文字列配列に変換し、同じ中身をbladeに表示させる

    
}

//↑メモ：7=玉ねぎ,にんじん,たまごの文字列配列に直す（controller側の処理）
//
    // define('COOKING_TIME', array(
    //           5 => '5分',  
    //           10 => '10分',  
    //           15 => '15分',  
    //           20 => '20分',  
    //           25 => '25分',  
    //           30 => '30分',  
    //           99 => '30分以上',  
    
    // ));
    
    // define('GENRE', array(
    //           1 => '鍋',  
    //           2 => '麺類',  
    //           3 => '中華',  
    //           4 => 'ご飯',  
    //           5 => '一品料理',  
    //           6 => 'その他',  
    
    // ));
    
    // define('INGREDIENTS', array(
    //           1 => 'たまねぎ',  
    //           2 => 'にんじん',  
    //           4 => 'たまご',  
    //           8 => 'きゃべつ',  
    
    // ));