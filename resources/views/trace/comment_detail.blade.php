<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>コメント更新</title>
  <link rel="stylesheet" href="./css/reset.css">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/css/uikit.min.css" />
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit-icons.min.js"></script>
  <link rel="stylesheet" href="./css/style.css">
  <script>
//ユーザーの現在の位置情報を取得
navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

/***** ユーザーの現在の位置情報を取得 *****/
function successCallback(position) {
  var gl_text = "緯度：" + position.coords.latitude + "<br>";
    gl_text += "経度：" + position.coords.longitude + "<br>";
    gl_text += "高度：" + position.coords.altitude + "<br>";
    gl_text += "緯度・経度の誤差：" + position.coords.accuracy + "<br>";
    gl_text += "高度の誤差：" + position.coords.altitudeAccuracy + "<br>";
    gl_text += "方角：" + position.coords.heading + "<br>";
    gl_text += "速度：" + position.coords.speed + "<br>";
  document.getElementById("show_result").innerHTML = gl_text;
}

/***** 位置情報が取得できない場合 *****/
function errorCallback(error) {
  var err_msg = "";
  switch(error.code)
  {
    case 1:
      err_msg = "位置情報の利用が許可されていません";
      break;
    case 2:
      err_msg = "デバイスの位置が判定できません";
      break;
    case 3:
      err_msg = "タイムアウトしました";
      break;
  }
  document.getElementById("show_result").innerHTML = err_msg;
  // document.getElementById("show_result").innerHTML = error.message;
}
</script>
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
    <div class="uk-card uk-card-body uk-card-default uk-margin uk-margin-auto">
      <div class="uk-card-title uk-margin uk-margin-auto">
        <h3>コメント（詳細）</h3>
      </div>
      <div class="uk-margin-auto">
        <form class="uk-grid-small" uk-grid action="" method="post" enctype="multipart/form-data">
        @csrf
          <div class=" uk-margin-small-bottom">
            <div class="uk-grid-small" uk-grid>
              <div>
                <div class="uk-margin-small-bottom">
                  <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                    <input class="uk-input uk-form-blank uk-disabled" type="text"  placeholder={{ $dateTime->format('Y/m/d-H:s') }}>
                  </div>
                </div>
                <div class="uk-margin-small-bottom uk-margin-remove-top">
                  <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input class="uk-input uk-form-blank uk-disabled" type="text" placeholder={{ $auth->name }}>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-margin-small-bottom uk-margin-remove-top uk-width-1-1">
                  <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: location"></span>
                    <input class="uk-input uk-form-blank" type="text" placeholder="場所（地図から選択）">
                    </div>
                    <div class="select-map-area">
                      <div class="select-map">
                      <!--ここはおそらくJSとかでの実装になるかと思うので空欄
                          座標選択した箇所の住所を仮表示するinputがあると良い？-->
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-width-2-3@m uk-width-1-1@s uk-margin-small-bottom">
            <fieldset class="uk-fieldset">
                @if($errors->has('comment'))
                  <div class="error-msg">！{{ $errors->first('comment') }}</div>
                @endif 
              <textarea class="uk-textarea uk-padding-small" type="textarea" name="comment" rows="5" placeholder="コメントを入力"></textarea>
            </fieldset>
          </div>
          <div class="comment-btn-area uk-margin-auto uk-margin-auto-top uk-margin-small-bottom">
            <button class="uk-button uk-button-primary" type="button">送信</button>
          </div>
        </form>
        <p>あなたの現在位置</p>
        <div id="show_result"></div>    
      </div>
  </div>
</body>
</html>