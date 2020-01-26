<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    protected $fillable = ['content', 'user_id' ,'recipe_id'];
    
    //コメントは唯一のRecipe情報に紐づく
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
    
    //コメントは唯一のUser情報に紐づく
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
