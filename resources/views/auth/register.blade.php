@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ユーザー登録</h1>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => 'signup.post' ,"enctype" => "multipart/form-data"]) !!}
                <div class="form-group">
                    {!! Form::label('name','お名前', ['class' => 'font-weight-bold']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email','メール', ['class' => 'font-weight-bold']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password','パスワード', ['class' => 'font-weight-bold']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password_confirmation','再度パスワード', ['class' => 'font-weight-bold']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('user_image_url','ユーザ画像', ['class' => 'font-weight-bold']) !!}
                        {{ csrf_field() }}
                    {!! Form::file('user_image_url',['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection