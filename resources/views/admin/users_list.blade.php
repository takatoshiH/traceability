<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>users list</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="/css/users_list.css">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/css/uikit.min.css" />
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit-icons.min.js"></script>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <!--ナビゲーション-->
  <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
      <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
          <li><button  class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #my-id"></button></li>
          <li><a href="{{ route('admin_index') }}" class="uk-navbar-item uk-logo">高級バッグ追跡システム</a></li>
        </ul>
      </div>
      <div class="uk-navbar-right">
          <ul class="uk-navbar-nav">
              <li><a href="{{ route('user_info') }}">ユーザー情報</a></li>
              <li><a href="{{ route('user_logout') }}">ログアウト</a></li>
          </ul>
      </div>
  </nav>
  <!-- off-canvas 単に便利だから入れているだけで不要なら消してください-->
  <div id="my-id" uk-offcanvas="overlay: true">
      <div class="uk-offcanvas-bar">
          <button class="uk-offcanvas-close" type="button" uk-close></button>
          <ul class="uk-nav uk-nav-default">
            <li>単に便利だから入れているだけで不要なら消してください</li>
            <li><a href="./add-content.html" teitle="製品登録">製品登録</a></li>
            <li><a href="./user-info.html" teitle="ユーザー情報">ユーザー情報</a></li>
            <li><a href="./css-check.html" title="CSSの当たり方をチェックする">style確認用のページ</a></li>
            <li><a href="./partslist.html" title="使えそうなパーツ">パーツ確認用のページ</a></li>
          </ul>
      </div>
  </div>
  <!--main content-->
  <div class="main-area">
    <div class="uk-card-default uk-card-body">
        <div class="uk-card-title">
            <h4>ユーザー 一覧</h4>
        </div>
        <table class="list"> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>氏名</th>
                    <th>メールアドレス</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="id">{{$user->id}}</td>
                        <td class="name">{{$user->name}}</td>
                        <td class="email">{{$user->email}}</td>
                        <td class="detail"><a href="/admin/users_list/{{ $user->id }}" class="uk-button uk-button-small uk-button-primary">詳細</a></td>
                    </tr>
                @endforeach
            </tbode>
        </table>
    </div>
  </div>
</body>
</html>