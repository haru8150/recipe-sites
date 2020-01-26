<!--共通レイアウトの呼び出し-->
@extends('layouts.app')

<!--@yield('content')の中身-->
@section('content')
    <h1 class="text-center">レシピ詳細ページ</h1>
    <div class="row">
        <div class="col-6 offset-md-3 jumbotron pt-2">
            @if(Auth::user()->is_favoriting($recipe->id))
                {!! Form::open(['route' => ['favorites.unfavorite', $recipe->id], 'method' => 'delete']) !!}
                    {!! Form::submit('お気に入り解除', ['class' => "btn btn-danger btn-sm float-left mr-3"]) !!}
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => ['favorites.favorite', $recipe->id]]) !!}
                    {!! Form::submit('お気に入り登録', ['class' => "btn btn-success btn-sm float-left mr-3"]) !!}
                {!! Form::close() !!}
            @endif
            
            @if(Auth::user()->is_good($recipe->id))
                {!! Form::open(['route' => ['goods.ungood', $recipe->id], 'method' => 'delete']) !!}
                    {!! Form::submit('いいね解除', ['class' => "btn btn-danger btn-sm"]) !!}
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => ['goods.good', $recipe->id]]) !!}
                    {!! Form::submit('いいね登録', ['class' => "btn btn-success btn-sm"]) !!}
                {!! Form::close() !!}
            @endif
            
            <button type="button" class="btn btn-warning mt-3">{!! link_to_route('recipes_detail.edit', "編集する", ['id' => $recipe->id]) !!}</button>
            <div class="form-group mt-5">
                <label class="font-weight-bold">レシピ名</label>
                <p>{{ $recipe->recipe_name }}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">お気に入り数</label>
                <p{{ $count_favorites}}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">投稿日</label>
                <p>{{ $recipe->created_at }}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">ジャンル</label>
                <p>{{ $recipe->genre }}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">料理の概要</label>
                <p>{{ $recipe->summary }}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">レシピ写真1</label>
                <p><img src="{{ $recipe->recipeImage1Url() }}" class="center-block" width="300" height="200"></p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">レシピ写真2</label>
                <p><img src="{{ $recipe->recipeImage2Url() }}" class="center-block" width="300" height="200"></p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">調理時間</label>
                <p>{{ $recipe->recipe_cooking_time()}}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">ジャンル</label>
                <p><span>ジャンル：</span>{{ $recipe->recipe_genre()}}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">材料</label>
                <p>{{ $recipe->recipe_ingredients()}}</p>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">料理の手順</label>
                <p>{{ $recipe->procedure}}</p>
            </div>

            <!--ログインユーザーのみ投稿可能-->
            @auth()
                {!! Form::open(['route' => 'comments.store']) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                        {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            @endauth()
            
            <div class="form-group">
                <label class="font-weight-bold">コメント一覧</label>
                <hr>
                    @foreach($recipe->comments as $comment)
                <div class="form-group">
                    <label class="font-weight-bold">ユーザーID:</label>
                    {{ $comment->user_id }}
                    <label class="font-weight-bold">コメント：</label>
                    {{ $comment->content }}
                </div>
                <hr>
                    @endforeach
            </div>
        </div>
    </div>
    <!--<p>一覧に戻る</p>-->
@endsection