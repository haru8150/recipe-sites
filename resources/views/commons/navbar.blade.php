<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-light bg-light border-bottom">

        <!-- 横幅が狭い時に出るハンバーガーボタン -->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- メニュー項目 -->
        <div class="collapse navbar-collapse form-inline pr-4" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
            <!-- ホームへ戻るリンク。ロゴ置く。 -->
            <a class="navbar-brand text-warning" href="/">時短レシピサイト</a>
                <div class="form-group">
                    <!--<li class="nav-item"><a href="#" class="nav-link">ランキング</a></li>-->
                    <!--<li class="nav-item dropdown">-->
                    <!--    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ジャンル</a>-->
                    <!--    <ul class="dropdown-menu dropdown-menu-right">-->
                    <!--        <li class="dropdown-item">すべて</li>-->
                    <!--        <li class="dropdown-divider"></li>-->
                    <!--        <li class="dropdown-item">鍋</li>-->
                    <!--        <li class="dropdown-item">麺類</li>-->
                    <!--        <li class="dropdown-item">ごはん</li>-->
                    <!--        <li class="dropdown-item">一品料理</li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                </div>
                <div class="search form-group mr-5">
                {!! Form::label('ingredients', '自分が投稿したレシピも含む',['class' => 'pr-2']) !!}
                {!! Form::open(['route' => 'recipes.index', 'method' => 'post']) !!}
                    {!! Form::checkbox('self-posts', 1,['class' => 'form-control pr-2']) !!}
                    {!! Form::text('keywords', null,['class' => 'form-control pr-2']) !!}
                    {!! Form::submit('検索する',['class' => 'btn btn-primary form-control mr-5']) !!}
                {!! Form::close() !!}
                </div>
                <div class="form-group ml-5">
                    @if(Auth::check())
                        <!--<li class="nav-item"><a href="#" class="nav-link">ユーザー情報</a></li>-->
                        <button type="button" class="btn btn-warning ml-5">{!! link_to_route('recipes_detail.create', '新規レシピ投稿') !!}</button>
                
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item">{!! link_to_route('users.favorites', 'お気に入り一覧',  ['id' => Auth::user()->id]) !!}</li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                        <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                    @endif
                </div>
            </ul>
        </div>
    </nav>
</header>
