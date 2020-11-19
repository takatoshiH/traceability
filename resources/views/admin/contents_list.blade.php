<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>contents list</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="/css/contents_list.css">
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
          @can('isAdmin')
          <li><a href="{{ route('admin_index') }}" class="uk-navbar-item uk-logo">高級バッグ追跡システム</a></li>
          @else
          <li><a href="{{ route('index') }}" class="uk-navbar-item uk-logo">高級バッグ追跡システム</a></li>
          @endcan        
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
            <h4>製品 一覧</h4>
        </div>
        @foreach($contents as $content)
          <div class="contents-list">
            <div class="id-img">
              <img src="{{ asset($content->image_path) }}" alt="製品画像"></td>
            </div>
            <div class="content">
                  <h4>製品名<span class="mar-name"> | </span>{{$content->name}}</h4>
              <ul class="content-ul">
                  <li>ID<span class="mar-03"> | </span>{{$content->id}}</li>
                  <li>ブランド名 | {{$content->brand}}</li>
                  <li>製品コード | {{$content->identifier}}</li>
                  <li>登録日<span class="mar-01"> | </span>{{$content->created_at}}</li>
                  <li class="a-button"><a href="/admin/contents_list/{{ $content->id }}" class="uk-button uk-button-small uk-button-primary">詳細</a></li>
              </ul>
            </div>
          </div>
        @endforeach
    </div>
  </div>
</body>
</html>