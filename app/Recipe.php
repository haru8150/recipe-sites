<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['user_id','recipe_name','recipe_image1_url', 'recipe_image2_url', 'genre', 'cooking_time', 'ingredients', 'summary', 'procedure',];
    
    //材料の配列定数
    const INGREDIENTS = [
          1 => 'たまねぎ',  
          2 => 'にんじん',  
          4 => 'たまご',  
          8 => 'きゃべつ',
    ];
    
    //調理時間の配列定数
    const COOKING_TIME = [
          5 => '5分',  
          10 => '10分',  
          15 => '15分',  
          20 => '20分',  
          25 => '25分',  
          30 => '30分',  
          99 => '30分以上',  
    ];
    // dd(COOKING_TIME[5]);
    
    //ジャンルの配列定数
    const GENRE = [
          1 => '鍋',  
          2 => '麺類',  
          3 => '中華',  
          4 => 'ご飯',  
          5 => '一品料理',  
          6 => 'その他',  
    ];
    
    //1対多（Recipeのインスタンスが属している唯一のUser情報を取得）
    public function user()
    {
        return $this->belongsTo(User::class,user_id);
    }
    
    //1対多(Recipeは複数のCommentをもつ モデル名修正
    public function comments()
    {
        return $this->hasMany(UserComment::class);
    }
    
    //多対多　あるレシピがどのユーザーからお気に入りされているか
    public function favorite_users()
    {
        return $this->belongsToMany(User::class,'user_favorites', 'recipe_id', 'user_id')->withTimestamps();
    }
    
    //多対多　あるレシピがどのユーザーからいいねされているか
    public function good_users()
    {
        return $this->belongsToMany(User::class, 'user_goods', 'recipe_id', 'user_id')->withTimestamps();
    }
    
    //リレーションの追加
    // public function userComments(){
    //     return $this->belongsToMany(User::class, user_comments, user_id, recipe_id);
    // }
    
    //料理画像1の呼び出し
    public function recipeImage1Url() {
    
        return \Storage::disk('s3')->url($this->recipe_image1_url);
    }
    
    //料理画像2の呼び出し
    public function recipeImage2Url() {
    
        return \Storage::disk('s3')->url($this->recipe_image2_url);
    }
    //PHPの論理積　ビット演算　DBの値 & 人参の値 == trueであれば　"にんじん、"を付与　材料の定義文だけ条件文を作る
    //材料の表示処理
    public function recipe_ingredients(){
        

        switch($this->ingredients){
            case 1:
                return self::INGREDIENTS[1];
                break;
            case 2:
                return self::INGREDIENTS[2];
                break;
            case 3:
                return self::INGREDIENTS[1] . "," .self::INGREDIENTS[2];
                break;
            case 4:
                return self::INGREDIENTS[4];
                break;
            case 5:
                return self::INGREDIENTS[4] . "," .self::INGREDIENTS[4];
                break;
            case 6:
                return self::INGREDIENTS[2] . "," .self::INGREDIENTS[4];
                break;
            case 7:
                return self::INGREDIENTS[1] . "," .self::INGREDIENTS[2] . "," .self::INGREDIENTS[4];
                break;
            case 8:
                return self::INGREDIENTS[8];
                break;
            case 9:
                return self::INGREDIENTS[1] . "," .self::INGREDIENTS[8];
                break;
            case 10:
                return self::INGREDIENTS[2] . "," .self::INGREDIENTS[8];
                break;
            case 11:
                return self::INGREDIENTS[1] . "," .self::INGREDIENTS[2] . "," .self::INGREDIENTS[8];
                break;
            case 12:
                return self::INGREDIENTS[4] . "," .self::INGREDIENTS[8];
                break;
            case 13:
                return self::INGREDIENTS[1] . "," .self::INGREDIENTS[4] . "," .self::INGREDIENTS[8];
                break;
            case 14:
                return self::INGREDIENTS[2] . "," .self::INGREDIENTS[4] . "," .self::INGREDIENTS[8];
                break;
            case 15:
                return self::INGREDIENTS[1] . "," . self::INGREDIENTS[2] . "," .self::INGREDIENTS[4] . "," .self::INGREDIENTS[8];
                break;
            default:
                return $this->ingredients;
        }
    }
    
    //調理時間の表示処理
    public function recipe_cooking_time(){
        

        switch($this->cooking_time){
            case 5:
                return self::COOKING_TIME[5];
                break;
            case 10:
                return self::COOKING_TIME[10];
                break;
            case 15:
                return self::COOKING_TIME[15];
                break;
            case 20:
                return self::COOKING_TIME[20];
                break;
            case 25:
                return self::COOKING_TIME[25];
                break;
            case 30:
                return self::COOKING_TIME[30];
                break;
            case 99:
                return self::COOKING_TIME[99];
                break;
            default:
                return $this->ingredients;
        }
    }
    
    //ジャンルの表示処理
    public function recipe_genre(){
        
        switch($this->genre){
            case 1:
                return self::GENRE[1];
                break;
            case 2:
                return self::GENRE[2];
                break;
            case 3:
                return self::GENRE[3];
                break;
            case 4:
                return self::GENRE[4];
                break;
            case 5:
                return self::GENRE[5];
                break;
            case 6:
                return self::GENRE[6];
                break;
            default:
                return $this->ingredients;
        }
    }
}
