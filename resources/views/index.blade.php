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
 <link rel="stylesheet" href="/css/style.css">
 <link rel="stylesheet" href="/css/modal.css">
</head>
<body>
  <!--ナビゲーション-->
  @auth
    <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
  @endauth
  @guest
    <nav class="guest-uk-navbar-container uk-navbar-transparent" uk-navbar>
  @endguest
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
              @auth
                <li><a href="{{ route('user_info') }}">ユーザー情報</a></li>
                <li><a href="{{ route('user_logout') }}">ログアウト</a></li>
              @endauth
              @guest
                <li><a href="{{ route('login') }}">ログイン</a></li>
              @endguest
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
  <div class="main-area" id="main-area">
    @cannot('isAdmin')
      @auth
          <div class="add-comment-detail uk-child-width-1-2@m uk-child-width-1-1@s uk-text-center uk-grid-match" uk-grid>
            <div>
              <div class="uk-card-default uk-card-body">
                <p>新しい製品を登録する</p>
                <a href="{{ route('content.add_content') }}" title="製品を登録する" class="uk-button uk-button uk-button-primary">製品登録</a>
              </div>
            </div>
            <div>
              <div class="uk-card-default uk-card-body">
                <p>流通経路確認</p>
                <form class="uk-search uk-search-default uk-width-medium" method="get" action="{{ route('content_detail') }}">
                  <button type="submit" class="uk-search-icon-flip uk-background-primary" uk-search-icon></button>
                  <input class="uk-search-input" type="search" name="search" placeholder="製品コードを入力...">
                </form>
                  <li class="error">{{ session('identifier_error') }}</li>
              </div>
            </div>
          </div>
      @endauth
      @guest
        <div>
          <div class="uk-card-default uk-card-body guest-main-area">
            <p>製品を見る</p>
            <form class="uk-search uk-search-default uk-width-medium" method="get" action="{{ route('content_detail') }}">
              <button type="submit" class="uk-search-icon-flip uk-background-primary" uk-search-icon></button>
              <input class="uk-search-input" type="search" name="search" required placeholder="製品コードを入力...">
            </form>
              <li class="error">{{ session('identifier_error') }}</li>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </div>
        </div>
      @endguest
    @endcan
    @can('isAdmin')
      <p class="not-admin">管理者は利用出来ません</p>
    @endcan
  </div>
  @if (isset($content))
    <div class="popup" id="js-popup">
      <div class="popup-inner">
        <div class="close-btn" id="js-close-btn"><i class="fas fa-times"></i></div>
            @include('content.add_content_success', ['content' => $content])
      </div>
      <div class="black-background" id="js-black-bg"></div>
    </div>
  @endif
</body>
<script>
  window.onload = function() {
  var popup = document.getElementById('js-popup');
  if(!popup) return;
  popup.classList.add('is-show');

  var blackBg = document.getElementById('js-black-bg');
  var closeBtn = document.getElementById('js-close-btn');

  closePopUp(blackBg);
  closePopUp(closeBtn);

  function closePopUp(elem) {
    if(!elem) return;
    elem.addEventListener('click', function() {
      popup.classList.remove('is-show');
    })
  }
}
</script>
<script>
  function funcprint(){
    
    var mainArea = document.getElementById('main-area');

    mainArea.style.visibility = "hidden";

    window.print();

    mainArea.style.visibility = "visible";
  };
</script>
</html>