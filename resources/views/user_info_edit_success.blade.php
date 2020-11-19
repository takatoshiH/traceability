<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>登録完了</title>
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
          <li><a href="{{ route('index') }}" class="uk-navbar-item uk-logo">高級バッグ追跡システム</a></li>
        </ul>
      </div>
      <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
          <li><button  class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #my-id"></button></li>
          @can('isAdmin')
          <li><a href="{{ route('admin_index') }}" class="uk-navbar-item uk-logo">高級バッグ追跡システム</a></li>
          @else
          <li><a href="{{ route('index') }}" class="uk-navbar-item uk-logo">高級バッグ追跡システム</a></li>
          @endcan        
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
    <div class="uk-card uk-card-body uk-card-default uk-margin uk-margin-auto">
      <div class="uk-card-title uk-margin uk-margin-auto">
        <h3>ユーザー情報編集</h3>
      </div>
      <div class="uk-text-center uk-h4">
        <div class="uk-inline">
          <span class="uk-text-success" uk-icon="icon: check"></span>
          <span class="uk-text-middle uk-text-success">ユーザー情報が変更されました</span>
        </div>
      </div>
      <div class="uk-card-footer uk-margin uk-text-center">
        <button class="uk-button uk-button-primary" type="button" onclick="location.href='{{ route('index') }}'">戻る</button>
      </div>
    </div>
  </div>
</body>
</html>