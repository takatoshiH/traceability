<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>トップページ</title>
  <link rel="stylesheet" href="./css/reset.css">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/css/uikit.min.css" />
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit-icons.min.js"></script>
 <link rel="stylesheet" href="./css/style.css">
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
{{--  <div id="my-id" uk-offcanvas="overlay: true">--}}
{{--      <div class="uk-offcanvas-bar">--}}
{{--          <button class="uk-offcanvas-close" type="button" uk-close></button>--}}
{{--          <ul class="uk-nav uk-nav-default">--}}
{{--            <li>単に便利だから入れているだけで不要なら消してください</li>--}}
{{--            <li><a href="./add-content.html" teitle="製品登録">製品登録</a></li>--}}
{{--            <li><a href="./user-info.html" teitle="ユーザー情報">ユーザー情報</a></li>--}}
{{--            <li><a href="./css-check.html" title="CSSの当たり方をチェックする">style確認用のページ</a></li>--}}
{{--            <li><a href="./partslist.html" title="使えそうなパーツ">パーツ確認用のページ</a></li>--}}
{{--          </ul>--}}
{{--      </div>--}}
{{--  </div>--}}

  <!--main content-->
  <div class="main-area">
    <div class="add-comment-detail uk-child-width-1-2@m uk-child-width-1-1@s uk-text-center uk-grid-match" uk-grid>
      <div>
        <div class="uk-card-default uk-card-body">
          <p>ユーザーの一覧を見る</p>
          <a href="{{ route('users_list') }}" title="製品を登録する" class="uk-button uk-button uk-button-primary">一覧表</a>
        </div>
      </div>
      <div>
        <div class="uk-card-default uk-card-body">
          <p>製品の一覧を見る</p>
          <a href="{{ route('contents_list') }}" title="製品を登録する" class="uk-button uk-button uk-button-primary">一覧表</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
