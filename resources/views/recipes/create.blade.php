<!--共通レイアウトの呼び出し-->
@extends('layouts.app')

<!--@yield('content')の中身-->
@section('content')
<div class="center">
    
    <h1 class="text-center">レシピ新規登録ページ</h1>
    
    <div class="row">
        <div class="col-6 offset-md-3 jumbotron pt-2">
            {!! Form::model($recipe, ['route' => 'recipes_detail.store', "enctype" => "multipart/form-data"]) !!}
            
                <div class="form-group">
                    {!! Form::label('recipe_name', 'レシピ名', ['class' => 'font-weight-bold']) !!}
                    {!! Form::text('recipe_name', '', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('recipe_image1_url', 'レシピ画像１', ['class' => 'font-weight-bold']) !!}
                         {{ csrf_field() }}
                    {!! Form::file('recipe_image1_url', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('recipe_image2_url', 'レシピ画像２', ['class' => 'font-weight-bold']) !!}
                         {{ csrf_field() }}
                    {!! Form::file('recipe_image2_url', ['class' => 'form-control']) !!}
                </div>
            
                <div class="form-group">
                        <div class="select">
                                {!! Form::label('cooking_time', '調理時間', ['class' => 'font-weight-bold']) !!}
                                {!! Form::select('cooking_time',$cooking_time,null,['class' => 'form-control']) !!}
                        </div>
                </div>
                
                <div class="form-group">
                        <div class="select">
                                {!! Form::label('genre', 'ジャンル', ['class' => 'font-weight-bold']) !!}
                                {!! Form::select('genre',$genre,null,['class' => 'form-control']) !!}
                        </div>
                </div>
                
                <div class="form-group">
                    {!! Form::label('ingredients', '材料', ['class' => 'font-weight-bold']) !!}
                    @foreach($ingredients as $key => $ingredient)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('ingredients[]',$key,null,['class' => 'form-checkbox']) !!}
                                {{ $ingredient }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    {!! Form::label('summary', '料理の概要', ['class' => 'font-weight-bold']) !!}
                    {!! Form::textarea('summary', '',['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('procedure', '手順', ['class' => 'font-weight-bold']) !!}
                    {!! Form::textarea('procedure','', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('投稿', ['class' => 'btn btn-primary float-left']) !!}
                
            {!! Form::close() !!}
            
            {!! Form::model($recipe, ['route' => ['recipes.index']]) !!}
                {!! Form::submit('一覧に戻る', ['class' => 'btn btn-secondary ml-4']) !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection