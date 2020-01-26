<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Comment;
use App\User;

class CommentsController extends Controller
{
    
    // コメントの一覧表示処理
    // public function index()
    // {
        
    //      $recipes = Recipe::query()
    //         ->with(['comments', 'createdBy'])
    //         ->paginate();
    //     return view('recipes.index', compact('recipes'));

    // }
    
    //コメントの投稿処理
    public function store(Request $request, Recipe $recipe)
    {
        $this->validate($request, [
            'content' => 'required|max:191',    
        ]);
        
        //うまくいかずコメントアウトしました
        // $recipe->comments()->save(new UserComment([
        //     'content' => $request->get('content'),
        //     'user_id' => Auth::id(),
        //     'recipe_id' => $recipe->id,
        // ]));
        
        //これで値は取れました！
        // dd($request->get('recipe_id'));
        $recipe_id = $request->get('recipe_id');
        
        //新しいコメントを新規作成
        $request->user()->comments()->create([
            'content' => $request->get('content'),//コメントの中身
            'user_id' => \Auth::id(),//コメントしたユーザーID
            'recipe_id' => $recipe_id,//コメントされたレシピID
        ]);
        
        //DBからrecipeの再取得をする
        $recipe_comments = Recipe::find($recipe_id);
        // return view('recipes.show', compact('recipe'));
        return view('recipes.show', ['recipe' => $recipe_comments]);
    }
    
    //コメントの削除処理
    public function destroy($id)
    {
    //     $comment = App\Comment::find($id);
        
    //     if(\Auth::id() === $comment->user_id){
    //         $comment->delete();
    //     }
        
    //     return back();
    }
}
