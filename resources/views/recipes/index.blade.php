<!--共通レイアウトの呼び出し-->
@extends('layouts.app')

<!--@yield('content')の中身-->
@section('content')
    <div class="center">
        <div class="text-center">
            <h1>ようこそ、時短レシピサイトへ！</h1>
            <hr>
            <h2>レシピ一覧　{{ $count_recipes }}件</h2>
                <!--レシピ一覧の選択肢（デフォルトは新着順）-->
                <div class="dropdown">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                        新着順
                    </button>
                    <!--<div class="dropdown-menu">-->
                    <!--    <a class="dropdown-item" href="#">いいね順</a>-->
                    <!--</div>-->
                </div>
                
        </div>
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
                    <!--ランキング一覧の表示枠--> 
                    <!--<div class="col-md-3 border-left border-dark">-->
                    <!--    <strong>ランキングTOP5</strong>-->
                    <!--    <p>１、もつ煮込みうどん</p>-->
                    <!--    <p>２、カニクリームパスタ</p>-->
                    <!--    <p>３、甘口カレー</p>-->
                    <!--    <p>４、ピザトースト</p>-->
                    <!--    <p>５、豚肉の生姜焼き</p>-->
                    <!--    <a href="#" class="nav-link">ランキング詳細へ</a>-->
                    </div>
                </div>
            </div>
            
        </div>

    </div>
    {{ $recipes->appends(['keywords' => Request::get('keywords')])->links('pagination::bootstrap-4') }}
@endsection