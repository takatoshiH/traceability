<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>製品登録</title>
  <link rel="stylesheet" href="./css/reset.css">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/css/uikit.min.css" />
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit-icons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>
 <link rel="stylesheet" href="/css/style.css">
 <link rel="stylesheet" href="/css/modal.css">

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
            <li><a href="css-check.html" title="CSSの当たり方をチェックする">style確認用のページ</a></li>
            <li><a href="partslist.html" title="使えそうなパーツ">パーツ確認用のページ</a></li>
          </ul>
      </div>
  </div>

  <!--コンテンツ-->
<form class="h-adr" action="{{ route('content_store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="main-area">
    <div class="uk-card-default uk-card-body">
      <div class="uk-card-title uk-margin uk-margin-auto">
        @if(Session::has('success'))
          {{ session('success') }}
        @endif
        <h3>製品登録</h3>
      </div>
      <div class="add-content-info uk-child-width-1-2@m uk-child-width-1-1@s uk-margin uk-margin-auto uk-grid-collapse" uk-grid>
        <div>
          <div class="uk-padding-small">
            <div class="uk-form-stacked">
              <div class="content-brand">
                <label class="uk-form-label" for="form-stacked-text">ブランド名</label>
                @if($errors->has('brand'))
                  <div class="error-msg">！{{ $errors->first('brand') }}</div>
                @endif <div class="uk-form-controls">
                    <input name="brand" class="uk-input" type="text" required placeholder="ブランド名を入力...">
                </div>
              </div>
              <div class="content-name">
                <label class="uk-form-label" for="form-stacked-text">製品名</label>
                @if($errors->has('name'))
                  <div class="error-msg">！{{ $errors->first('name') }}</div>
                @endif 
                <div class="uk-form-controls">
                    <input name="name" class="uk-input" type="text" required placeholder="製品名を入力...">
                </div>
              </div>              
                <div class="content-price">
                <label class="uk-form-label" for="form-stacked-text">出荷価格</label>
                @if($errors->has('price'))
                  <div class="error-msg">！{{ $errors->first('price') }}</div>
                @endif 
                <div class="uk-form-controls">
                    <input name="price" class="uk-input" type="text" required placeholder="出荷価格を入力...">
                </div>
              </div><div class="content-info">
                <label class="uk-form-label" for="form-stacked-text">製品情報</label>
                @if($errors->has('information'))
                  <div class="error-msg">！{{ $errors->first('information') }}</div>
                @endif 
                <div class="uk-form-controls">
                    <textarea name="information" class="uk-input" type="textarea" required placeholder="製品情報を入力..."></textarea>
                </div>
              </div></div>
          </div>
        </div>
        <div>
          <div class="uk-padding-small">
            <div class="content-image-area">
              <div class="content-image uk-margin-auto uk-background-muted">
                <div class="preview"></div>
              </div>
            </div>
            <div class="uk-margin uk-text-center">
              <div uk-form-custom>
                <input type="file" name="imagefile" required>
                <button class="uk-button uk-button-secondary" type="button" tabindex="-1">画像を選択</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="uk-card-footer uk-margin uk-margin-auto uk-text-center">
        <div id="open">
          <button type="submit" class="uk-button uk-button-primary">登録</button>
        </div>
      </div>
    </div>
  </div>
</form>
</body>
<script>
  // 画像選択後出力
var $ = document;

$.addEventListener('DOMContentLoaded', function(){
    $.querySelector("[name='imagefile']").addEventListener('change', function(e) {
        var file = e.target.files[0],
            reader = new FileReader(),
            $preview = $.querySelector(".preview"),
            t = this;

            reader.onload = (function(file) {
                return function(e) {
                    while ($preview.firstChild) $preview.removeChild($preview.firstChild);

                    var img = document.createElement("img");
                    img.setAttribute('src', e.target.result);
                    img.setAttribute('title', file.name);
                    $preview.appendChild(img);
                };
            })(file);

            reader.readAsDataURL(file);
    });
});

</script>
</html>