<!--共通レイアウトの呼び出し-->
@extends('layouts.app')

<!--@yield('script')の中身-->
@section('script')
    <script>
        $(function(){
            $(".btn-index").click(function(){
               if(confirm("一覧に戻りますか？")){
                    //一覧に戻る   
               }else{
                   //キャンセルする
                   return false;
               } 
            });
        });
        
        $(function(){
            $(".btn-delete").click(function(){
               if(confirm("本当に削除しますか？")){
                    //一覧に戻る   
               }else{
                   //キャンセルする
                   return false;
               } 
            });
        });
    </script>
@endsection

<!--@yield('script')の中身-->
@section('script')
    <script>
        $(function(){
            $(".btn-index").click(function(){
               if(confirm("一覧に戻りますか？")){
                    //一覧に戻る   
               }else{
                   //キャンセルする
                   return false;
               } 
            });
        });
        
        $(function(){
            $(".btn-delete").click(function(){
               if(confirm("本当に削除しますか？")){
                    //一覧に戻る   
               }else{
                   //キャンセルする
                   return false;
               } 
            });
        });
    </script>
@endsection

<!--@yield('content')の中身-->
@section('content')
<div class="center">
        <h1 class="text-center">レシピ更新ページ</h1>
    
    <div class="row">
        <div class="col-6 offset-md-3 jumbotron pt-2">
            {!! Form::model($recipe, ['route' => ['recipes_detail.update', $recipe->id], "enctype" => "multipart/form-data", 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('recipe_name', 'レシピ名',['class' => 'font-weight-bold']) !!}
                    {!! Form::text('recipe_name', $recipe->recipe_name, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('recipe_image1_url', 'レシピ画像１',['class' => 'font-weight-bold']) !!}
                    <p><img src="{{ $recipe->recipeImage1Url() }} " class="center-block" width="300" height="200"></p>
                         {{ csrf_field() }}
                    {!! Form::file('recipe_image1_url',['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('recipe_image2_url', 'レシピ画像２',['class' => 'font-weight-bold']) !!}
                    <p><img src="{{ $recipe->recipeImage2Url() }} " class="center-block" width="300" height="200"></p>
                         {{ csrf_field() }}
                    {!! Form::file('recipe_image2_url',['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    <div class="select">
                        {!! Form::label('cooking_time', '調理時間',['class' => 'font-weight-bold']) !!}
                        {!! Form::select('cooking_time',$cooking_time,$recipe->recipe_cooking_time(),['class' => 'form-control']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="select">
                            {!! Form::label('genre', 'ジャンル',['class' => 'font-weight-bold']) !!}
                            {!! Form::select('genre',$genre,$recipe->recipe_genre(),['class' => 'form-control']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    {!! Form::label('ingredients', '材料',['class' => 'font-weight-bold']) !!}
                    @foreach($ingredients as $key => $ingredient)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('ingredients[]',$key,['class' => 'form-checkbox']) !!}
                                {{ $ingredient }}
                            </label>
                        </div>
                    @endforeach
                </div>
                
                <div class="form-group">
                    {!! Form::label('summary', '料理の概要',['class' => 'font-weight-bold']) !!}
                    {!! Form::textarea('summary', $recipe->summary,['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('procedure', '調理手順',['class' => 'font-weight-bold']) !!}
                    {!! Form::textarea('procedure',$recipe->procedure, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('更新', ['class' => 'btn btn-primary float-left']) !!}
                
            {!! Form::close() !!}
            
            <!--レシピの削除ボタン-->
            <div>
                @if(Auth::id() == $recipe->user_id)
                    {!! Form::open(['route' => ['recipes_detail.destroy', $recipe->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-danger btn-delete float-left']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
            <div>
                {!! Form::model($recipe, ['route' => ['recipes.index']]) !!}
                    {!! Form::submit('一覧に戻る', ['class' => 'btn btn-secondary btn-index ml-4']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
