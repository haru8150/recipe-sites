<!--共通レイアウトの呼び出し-->
@extends('layouts.app')

<!--@yield('content')の中身-->
@section('content')
<h1 class="text-center">お気に入り一覧</h1>
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <!--2カラムレイアウト　まずはべた書きでかく　1アイテム１div 他サイトを参考にする　大枠のdivの範囲（ピクセル？）を切る　ためしにifで3つdivdivきたら改行するとか-->
            <!--レシピ一覧の表示枠--> 
            <div class="col-md-12">
                @foreach($recipes as $recipe)
                    @if(count($recipes) > 0)
                        <div class="float-left border border-solid border-dark ml-5 mt-4">
                            <div class="card md-4 shadow-sm">
                                <p><img src="{{ $recipe->recipeImage1Url() }} " class="center-block" width="300" height="200"></p>
                                <div class="card-body">
                                    <p class="card-text">
                                        <p class="text-center bg-warning font-weight-bold">
                                            {!! link_to_route('recipes.show', $recipe->recipe_name, ['id' => $recipe->id]) !!}
                                        </p>
                                        <label class="font-weight-bold"></label>
                                        {{ $recipe->created_at}}</p>
                                        <p><span>調理時間：</span>{{ $recipe->recipe_cooking_time()}}</p>
                                        <p><span>ジャンル：</span>{{ $recipe->recipe_genre()}}</p>
                                        <p><span>材料：</span>{{ $recipe->recipe_ingredients()}}</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection