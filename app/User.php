<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_image_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //ユーザー画像の呼び出し
    public function userImageUrl()
    {
        return \Storage::disk('s3')->url($this->user_image_url);
    }
    
    //1対多：UserのRecipeを取得する
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
    
    // 1対多：UserのCommentを取得する
    public function comments()
    {
        // return $this->belongsToMany(Comment::class, 'user_comments', 'user_id', 'recipe_id')->withTimestamps();
        return $this->hasMany(UserComment::class);
    }
    
    //多対多：お気に入りの一覧の取得
    public function favorites()
    {
        return $this->belongsToMany(Recipe::class, 'user_favorites', 'user_id', 'recipe_id')->withTimestamps();
    }
    
    //多対多：いいねの一覧の取得
    public function goods()
    {
        return $this->belongsToMany(Recipe::class, 'user_goods', 'user_id', 'recipe_id')->withTimestamps();
    }
    
    //中間テーブルへの登録（user()->good()で呼び出せる）
    public function good($recipeId)
    {
        //すでにいいねしているかの確認
        $exist = $this->is_good($recipeId);
        
        if($exist){
            //いいね済であれば何もしない
            return false;
        }else{
            //いいねしてなければ中間テーブルに登録
            $this->goods()->attach($recipeId);
            return true;
        }
    }
    //中間テーブルから削除
    public function ungood($recipeId)
    {
        //すでにいいねしているかの確認
        $exist = $this->is_good($recipeId);
        
        //いいね済みであれば
        if($exist){
            //いいねを外す
            $this->goods()->detach($recipeId);
            return true;
        }else{
            //何もしない
            return false;
        }
    }
    
    //中間テーブルへの登録(user()->favorite()で呼び出せる)
    public function favorite($recipeId)
    {
        //すでにお気に入りしているかの確認
        $exist = $this->is_favoriting($recipeId);
        
        if($exist){
            //お気に入りしていれば、何もしない
            return false;
        }else{
            //まだお気に入り登録していれば中間レコードに登録
            $this->favorites()->attach($recipeId);
            return true;
        }
    }
    
    //中間テーブルから削除
    public function unfavorite($recipeId)
    {
        //すでにお気に入り登録しているか
        $exist = $this->is_favoriting($recipeId);
        
        if($exist){
            //すでにお気に入りしていたらはずす
            $this->favorites()->detach($recipeId);
            return true;
        }else{
            //お気に入りしていなければ何もしない
            return false;
        }
    }
    
    //すでにお気に入り登録しているかの確認処理
    public function is_favoriting($recipeId)
    {
        //Userモデルのfavoritesメソッドから、お気に入り一覧をレシピＩＤで抽出、存在すればtrue
        return $this->favorites()->where('recipe_id', $recipeId)->exists();
    }
    
    //すでにいいねしているかの確認処理
    public function is_good($recipeId)
    {
        //Userモデルのgoodsメソッドから、いいね一覧をレシピIDで抽出、存在すればtrueを返す
        return $this->goods()->where('recipe_id', $recipeId)->exists();
    }
}
