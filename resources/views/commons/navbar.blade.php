<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <!-- ホームへ戻るリンク。ロゴ置く。 -->
        <a class="navbar-brand" href="/">時短レシピサイト</a>
        
        <!-- 横幅が狭い時に出るハンバーガーボタン -->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- メニュー項目 -->
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">{!! link_to_route('recipes.create', '新規レシピ投稿', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
            </ul>
        </div>
    </nav>
</header>
