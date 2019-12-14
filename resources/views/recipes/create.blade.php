<!--共通レイアウトの呼び出し-->
@extends('layouts.app')

<!--@yield('content')の中身-->
@section('content')
    
    <h1>レシピ新規登録ページ</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($recipe, ['route' => 'recipes.store']) !!}
            
                <div class="form-group">
                    {!! Form::label('recipe_name', 'レシピ名') !!}
                    {!! Form::text('recipe_name', '', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('recipe_image1_url', 'レシピ画像１') !!}
                    {!! Form::file('recipe_image1_url', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('recipe_image2_url', 'レシピ画像２') !!}
                    {!! Form::file('recipe_image2_url', ['class' => 'form-control']) !!}
                </div>
            
                <div class="form-group">
                    {!! Form::label('cooking_time', '調理時間') !!}
                    {!! Form::select('cooking_time', ['5分', '10分' ,'15分' ,'20分', '25分' ,'30分','30分以上'] ,'', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('genre', '料理ジャンル') !!}
                    {!! Form::select('genre', ['鍋', '麺類' ,'中華' ,'ご飯', '一品料理' ,'その他'] ,'', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('ingredients', '材料') !!}
                    {!! Form::label('ingredients', 'たまねぎ') !!}
                    {!! Form::checkbox('ingredients', 1,['class' => 'form-control']) !!}
                    {!! Form::label('ingredients', 'にんじん') !!}
                    {!! Form::checkbox('ingredients', 2,['class' => 'form-control']) !!}
                    {!! Form::label('ingredients', 'たまご') !!}
                    {!! Form::checkbox('ingredients', 4,['class' => 'form-control']) !!}
                    {!! Form::label('ingredients', 'きゃべつ') !!}
                    {!! Form::checkbox('ingredients', 8,['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('summary', '料理の概要') !!}
                    {!! Form::text('summary', '',['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('procedure', '手順') !!}
                    {!! Form::text('procedure','', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
                
            {!! Form::close() !!}
        </div>
    </div>
@endsection