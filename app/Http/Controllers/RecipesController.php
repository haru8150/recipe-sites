<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Recipe;//追加
use Storage;//追記

class RecipesController extends Controller
{
    //ControllerにENUMかけば、ほかのコントローラーからも観れる
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    //↓

     //getでrecipes/にアクセスされた場合の「一覧表示処理」
    public function index(Request $request)
    {
    
    //レシピのインスタンス作成
    // $recipes = Recipe::paginate(5);
    // $data = [
    //     'recipes' => $recipes,
    //     ];
    
    //レシピの投稿数をカウント   
    // $data += $this->counts($recipes);
    
    $keyWord = $request->get('keywords');
    $selfPosts = $request->get('self-posts');
    
    //検索処理の関数をよびだす
    // $searchResult =  $this->getSearch($request);
    $searchResult =  $this->getSearch($keyWord, $selfPosts);
    
        // $ingredients = new Ingredients($recipes);
        
        //材料クラスのインスタンス生成　$recipesを渡す
        //$材料 = new 材料クラス($recipes);
        // foreach($recipes as $recipe){
        //      dd($recipe->recipe_ingredients());     
        // }
        
        
        //レシピのインスタンスと投稿数をindexに渡す
        // return view('recipes.index', $data);
        
        //
        
        $data = [
            // 'recipes' => $recipes,
            'recipes' => $searchResult,
            'keywords' => $request->input('keywords'),
        ];

        //レシピの投稿数をカウント    
        $data += $this->counts($searchResult);

        //$dataの中身を返す
        // return $data;
        return view('recipes.index', $data);

        // return view('recipes.index', $searchResult);
        
        
        
        // return view('recipes.index',
        // [
        //     'recipes' => $recipes, compact($data)   
        //     // 'ingredients' => $ingredients,    //材料クラスのインスタンスを渡す
        // ]);
    }
    
    ###検索機能 indexにおく、index内でseaerchメソッドかく###　結合度（呼び出し元、呼び出し先）が少ないほど良い
    public function getSearch($keyWord, $isSelf)
    // public function getSearch(Request $request)
    // public function getSearch($data)
    {
            //検索フォームに入力 かつ　「自分が投稿したレシピを含む」にチェック無し
            // if($request->has('keywords') && empty($request->get('self-posts'))){
            //     //レシピ名であいまい検索した結果、自己投稿を含まないレシピをインスタンスに格納
            //     // $recipes = Recipe::where('recipe_name', 'LIKE', '%' .$request->get('keywords').'%')->whereNotIn('user_id', \Auth::id())->paginate(5);
            // }
            
            // dd($request->has('keywords'));->初回はfalse
            //検索フォームに入力あり
            if($keyWord != null)
            {
                // dd($keyWord);
                //かつ　「自分が投稿したレシピも含む」にチェックなし
                if($isSelf === null)
                {
                    
                //レシピ名であいまい検索した結果、自己投稿を含まないレシピをインスタンスに格納
                $recipes = Recipe::where('recipe_name', 'LIKE', '%' .$keyWord.'%')
                ->whereNotIn('user_id', [\Auth::id()])//カッコつき（配列）にして修正
                ->orderBy('created_at', 'desc')
                ->paginate(6);
                // dd($recipes);
                }
                else
                {
                //レシピ名であいまい検索した結果を格納
                $recipes = Recipe::where('recipe_name', 'LIKE', '%' .$keyWord.'%')
                ->orderBy('created_at', 'desc')
                ->paginate(6);
                //↑これだけreturnで返す、ほかの処理はindexでやる
                }
            }
            else
            {
                //検索フォーム未入力であれば、すべてのレシピを格納
                $recipes = Recipe::orderBy('created_at', 'desc')
                ->paginate(6);

            }

            /*
            //検索フォームに入力あり&チェックボックス無
            if($request->has('keywords') && $request->get('self-posts') === null){
                // dd("あああ");
                //レシピ名であいまい検索した結果、自己投稿を含まないレシピをインスタンスに格納
                $recipes = Recipe::where('recipe_name', 'LIKE', '%' .$request->get('keywords').'%')
                ->whereNotIn('user_id', \Auth::id())
                ->paginate(5);
            }
            elseif($request->has('keywords')){
                //レシピ名であいまい検索した結果を格納
                $recipes = Recipe::where('recipe_name', 'LIKE', '%' .$request->get('keywords').'%')->paginate(5);
            }
            else{
                //検索フォーム未入力であれば、すべてのレシピを格納
                $recipes = Recipe::paginate(5);
            }
            */
            //日付の変換処理
            // foreach($recipes as $recipe){
            //     // $date = date_create($recipe->created_at);
            //     // $date = date_format($date, 'Y-m-d');
            //     $recipe->created_at->format('Y-m-d');
            //     // $recipe->created_at = $date;
            // }
            // dd($recipe->created_at);
            //検索結果までをindex()に返す
            return $recipes;
            
        // $data = [
        //     'recipes' => $recipes,
        //     'keywords' => $request->input('keywords'),
        // ];

        //レシピの投稿数をカウント    
        // $data += $this->counts($recipes);

        //$dataの中身を返す
        // return $data;
        // return view('recipes.index', $data);
        // return view('recipes.index', [
        //     'recipes' => $recipes,
        //     'keywords' => $request->input('keywords'),
        // ]);
        
    }
    //クラス変数　これを一か所に書いてコンストラクタに入れて参照する　Controller内のクラス内に書く
        // $cooking_time = COOKING_TIME;これだとエラーになる
        
        // $cooking_time = [
        //   5 => '5分',  
        //   10 => '10分',  
        //   15 => '15分',  
        //   20 => '20分',  
        //   25 => '25分',  
        //   30 => '30分',  
        //   99 => '30分以上',  
        // ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //getでrecipes/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        //controllerクラスのコンストラクタから材料を参照するとしたらこんな感じ？
        // $recipe = new Recipe($request->get('ingredients'));
        
        $recipe = new Recipe();
        
        //これエラーになる！！！
        // $cooking_time = COOKING_TIME;
        // dd($cooking_time);
        
        $cooking_time = [
          5 => '5分',  
          10 => '10分',  
          15 => '15分',  
          20 => '20分',  
          25 => '25分',  
          30 => '30分',  
          99 => '30分以上',  
        ];
        
        $genre = [
          1 => '鍋',  
          2 => '麺類',  
          3 => '中華',  
          4 => 'ご飯',  
          5 => '一品料理',  
          6 => 'その他',  
        ];
        
        $ingredients = [
          1 => 'たまねぎ',  
          2 => 'にんじん',  
          4 => 'たまご',  
          8 => 'きゃべつ',  
        ];
        
        return view('recipes.create',compact('ingredients','genre','cooking_time'),[
            'recipe' => $recipe,
        ]);
        
    }

    private function getRecipeImagePath($recipe_image_url)
    {
        return Storage::disk('s3')->putfile('recipe-sites',$recipe_image_url, 'public');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //postでrecipes/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $this->validate($request,[
            'recipe_image1_url' => 'required|file|image',
            'recipe_image2_url' => 'required|file|image',
        ]);

        /*
            S3への画像アップロード処理
        */

        //フォームからの入力内容を受け取る　関数にする
        $recipe_image1_url = $request->recipe_image1_url;
        $recipe_image2_url = $request->recipe_image2_url;

        // バケットへアップロード （*ここの値をcreateに投げると画像表示しない）$recipe_image1_urlを引数
        //$recipe_image1_path = Storage::disk('s3')->putfile('recipe-sites',$recipe_image1_url, 'public');
        $recipe_image1_path = $this->getRecipeImagePath($recipe_image1_url);
        $recipe_image2_path = $this->getRecipeImagePath($recipe_image2_url);
        //$recipe_image2_path = Storage::disk('s3')->putfile('recipe-sites',$recipe_image2_url, 'public');

        // アップロードした画像のフルパスを取得（*ここの値をcreateに投げると画像表示する）
        //$recipe_image1_fullurl = Storage::disk('s3')->url($recipe_image1_path);
        //$recipe_image2_fullurl = Storage::disk('s3')->url($recipe_image2_path);

        /*
            材料のチェックボックス取り出し処理　関数にする
        */
        $ingredients = $request->get('ingredients');//フォームからの入力
        $ingredients_total = 0;//材料のvalue値の合計値
         // チェックした配列のvalueを取り出し加算
          foreach($ingredients as $ingredient){
            $ingredients_total += $ingredient;
          }
          
        /*
            ジャンルの取り出し処理（いったんコメント）
        */

        $request->user()->recipes()->create([
            'recipe_name' => $request->recipe_name,
            'recipe_image1_url' => $recipe_image1_path,
            'recipe_image2_url' => $recipe_image2_path,
            'genre' => $request->input('genre'),
            'cooking_time' => $request->input('cooking_time'),
            'ingredients' => $ingredients_total,
            'summary' => $request->summary,
            'procedure' => $request->procedure,
            
        ]);
        
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //getでrecipes/id/editにアクセスされた場合の「更新画面表示処理」
    public function show($id)
    {
        //一件のレシピデータを取得,user_commentsテーブルからuser_idに紐づいたcommentをrecipeとセットで取り出す
        //$recipe = Recipe::find($id)->with(['user_comments', 'user_id']);
        //dd($recipe);
        
        $user = User::find($id);
        $recipe = Recipe::find($id);
        $recipe->load(['comments']);
        
        //レシピのお気に入り・いいね数をカウント
        
        $data = [
            'recipe' => $recipe,
            // 'user' => $user,
        ];
        
        $data += $this->UserOfCounts($recipe);

        return view('recipes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //getでrecipes/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        
        // $cooking_time = COOKING_TIME;
        $cooking_time = [
          5 => '5分',  
          10 => '10分',  
          15 => '15分',  
          20 => '20分',  
          25 => '25分',  
          30 => '30分',  
          99 => '30分以上',  
        ];
        
        $genre = [
          1 => '鍋',  
          2 => '麺類',  
          3 => '中華',  
          4 => 'ご飯',  
          5 => '一品料理',  
          6 => 'その他',  
        ];
        
        $ingredients = [
          1 => 'たまねぎ',  
          2 => 'にんじん',  
          4 => 'たまご',  
          8 => 'きゃべつ',  
        ];
        
        return view('recipes.edit',compact('ingredients','genre','cooking_time'),[
            'recipe' => $recipe,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //putでrecipes/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        //対象のrecipe_idを取得
        $recipe = Recipe::find($id);
        
        $this->validate($request,[
            'recipe_image1_url' => 'required|file|image',
            'recipe_image2_url' => 'required|file|image',
        ]);

        //S3への画像アップロード処理
        //フォームからの入力内容を受け取る
        $recipe_image1_url = $request->recipe_image1_url;
        $recipe_image2_url = $request->recipe_image2_url;

        // バケットへアップロード 
        $recipe_image1_path = Storage::disk('s3')->putfile('recipe-sites',$recipe_image1_url, 'public');
        $recipe_image2_path = Storage::disk('s3')->putfile('recipe-sites',$recipe_image2_url, 'public');

        //材料のチェックボックス取り出し処理
        $ingredients = $request->get('ingredients');//フォームからの入力
        $ingredients_total = 0;//材料のvalue値の合計値
         
        // チェックした配列のvalueを取り出し加算
        foreach($ingredients as $ingredient){
            $ingredients_total += $ingredient;
        }
        
        // dd($recipe->id);//レシピＩＤとれる
        //レシピの更新処理（対象のレシピＩＤのみ更新）323行で\Auth::user()->recipes()に直して一度試してみる！！
        $request->user()->recipes()
        ->Where('id', $recipe->id)
        ->update([
            'recipe_name' => $request->recipe_name,
            'recipe_image1_url' => $recipe_image1_path,
            'recipe_image2_url' => $recipe_image2_path,
            'genre' => $request->input('genre'),
            'cooking_time' => $request->input('cooking_time'),
            'ingredients' => $ingredients_total,
            'summary' => $request->summary,
            'procedure' => $request->procedure,
            
        ]);
        
        //saveメソッドを試したがうまくいかなのでコメントアウト
        // $request->user()->recipes()->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //deleteでrecipes/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        
        $recipe = Recipe::find($id);
        
        // ログインユーザーとレシピ投稿者のIDが一致したときのみ削除
        if(\Auth::id() === $recipe->user_id){
            $recipe->delete();
        }
        //トップページに戻る
        return redirect('/');
    }
}
