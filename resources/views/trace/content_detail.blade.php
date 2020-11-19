<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>商品詳細</title>
  <link rel="stylesheet" href="./css/reset.css">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/css/uikit.min.css" />
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit-icons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>
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
  <div class="main-area">
    <div class="uk-card uk-card-body uk-card-default uk-margin uk-margin-auto">
      <div class="uk-card-title uk-margin uk-margin-auto">
        <h3>製品詳細</h3>
      </div>
      <div id="qr_maker">
        <input type="hidden" style="width: 50%;" id="url">
        <div id="qrcode"></div>
      </div>
      <div class="content-detail-info uk-child-width-1-2@m uk-child-width-1-1@s uk-margin uk-margin-auto uk-grid-collapse" uk-grid>
        <div>
          <div class="content-name uk-padding-small">
          <div class="content-brand">
                <label class="uk-form-label">ブランド名</label>
                <div class="uk-form-controls">
                  <h4>{{ $content->brand }}</h4>
                </div>
              </div>
              <div class="content-name">
                <label class="uk-form-label">製品名</label>
                <div class="uk-form-controls">
                  <h4>{{ $content->name }}</h4>
                </div>
              </div><div class="content-name">
                <label class="uk-form-label">出荷価格</label>
                <div class="uk-form-controls">
                  <h4>{{ $content->price }}円</h4>
                </div>
              </div>
              <div class="uk-section-muted uk-section-small">
              <h4>{{ $content->information }}</h4>
              </div>
          </div>
        </div>
        <div>
          <div class="uk-padding-small">
            <div class="content-image-area">
              <div class="content-image uk-margin-auto uk-background-muted">
                <img src="{{ asset($content->image_path) }}" alt="製品画像">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @auth
      <div class="uk-card uk-card-body uk-card-default uk-margin uk-margin-auto">
        <div class="uk-card-title">
          <h3>流通履歴</h3>
        </div>
        @foreach($traces as $trace)
          <div class="content-history">
            <table class="uk-table uk-table-responsive uk-table-divider uk-table-justify">
                <thead>
                    <tr>
                        <th class="uk-width-small">日時</th>
                        <th class="uk-width-small">場所</th>
                        <th class="uk-width-small">ユーザー名</th>
                        <th class="uk-table-expand">コメント</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                          <!--モバイル表示用とPC表示用で２種類出力を用意してます。面倒ですがこれがbetterかと-->
                          <div class="uk-visible@m">
                            {{$trace->created_at}}
                          </div>
                          <div class="uk-inline uk-hidden@m">
                            <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                            <p class="uk-input uk-form-blank uk-disabled">{{$trace->created_at}}</p>
                          </div>
                        </td>
                        <td>
{{--                          <div class="uk-visible@m">--}}
{{--                          緯度：{{$trace->latitude}}<br>--}}
{{--                          経度：{{$trace->longitude}}--}}
{{--                          </div>--}}
{{--                          <div class="uk-inline uk-hidden@m">--}}
{{--                            <span class="uk-form-icon" uk-icon="icon: location"></span>--}}
{{--                            <p class="uk-input uk-form-blank uk-disabled">緯度{{$trace->latitude}}経度{{$trace->longitude}}</p>--}}
{{--                          </div>--}}
                        </td>
                        <td>
                          <div class="uk-visible@m">
                            {{$user->name}}
                          </div>
                          <div class="uk-inline uk-hidden@m">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <p class="uk-input uk-form-blank uk-disabled">{{$user->name}}</p>
                          </div>
                        </td>
                        <td>
                          <div class="uk-visible@m">
                            {{$trace->comment}}
                          </div>
                          <div class="uk-inline uk-hidden@m">
                            <span class="uk-form-icon" uk-icon="icon: comment"></span>
                            <p class="uk-input uk-form-blank uk-disabled">{{$trace->comment}}</p>
                          </div>
                          <iframe frameborder="0" style="border:0; width: 100%; height: 100%" src="//www.google.com/maps/embed/v1/place?key=AIzaSyCHHmpm5hgNJI-K9s5Q92uvPrtWPpwJN3E&zoom=12&q={{$trace->latitude}},{{$trace->longitude}}"></iframe>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
        @endforeach
      </div>
      @cannot('isAdmin')
        <div class="add-comment uk-card uk-card-body uk-card-default uk-margin uk-margin-auto">
          <div class="uk-card-title">
            <h3>コメントを追加</h3>
          </div>
          <div class="uk-margin-auto">
            <form class="uk-grid-small" uk-grid action="{{ route('content_detail_store') }}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="uk-width-2-3@m uk-width-1-1@s uk-margin-small-bottom">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-margin-small-bottom">
                    <div class="uk-inline">
                      <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                      <input class="uk-input uk-form-blank uk-disabled" type="text"  placeholder={{ $dateTime->format('Y/m/d-H:s') }}>
                    </div>
                  </div>
                  <div class="uk-margin-small-bottom uk-margin-remove-top">
                    <div class="uk-inline">
                      <span class="uk-form-icon" uk-icon="icon: location"></span>
                      <input class="uk-input uk-form-blank uk-disabled" type="text" placeholder="場所">
                      <input name='latitude' type="text" required placeholder="緯度">
                      @if($errors->has('latitude'))
                        <div class="error-msg">！{{ $errors->first('latitude') }}</div>
                      @endif
                      <input type="text" name="longitude" required placeholder="経度">
                      @if($errors->has('longitude'))
                        <div class="error-msg">！{{ $errors->first('longitude') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="uk-margin-small-bottom uk-margin-remove-top">
                    <div class="uk-inline">
                      <span class="uk-form-icon" uk-icon="icon: user"></span>
                      <input class="uk-input uk-form-blank uk-disabled" type="text" placeholder={{ $user->name }}>
                    </div>
                  </div>
                </div>
                <fieldset class="uk-fieldset">
                  <input type="hidden" name="content_id" value="{{ $content->id }}">
                  <input type="hidden" name="user_id" value="{{ $user->id }}">
                    @if($errors->has('comment'))
                      <div class="error-msg">！{{ $errors->first('comment') }}</div>
                    @endif
                  <textarea class="uk-textarea uk-padding-small" type="textarea" name='comment' rows="5" required placeholder="コメントを入力"></textarea>
                </fieldset>
              </div>
              <div class="comment-btn-area uk-margin-auto uk-margin-auto-top uk-margin-small-bottom">
                <button class="uk-button uk-button-primary" type="submit">送信</button>
              </div>
            </form>
          </div>
        </div>
      @endcan
    @endauth
  </div>
</body>
{{--<script>--}}
{{--  //QRコード生成--}}
{{--  var url = location.href;--}}
{{--  document.getElementById('url').innerHTML = url;--}}
{{--  document.getElementById('url').value = url;--}}

{{--  let qr = qrcode(4, 'L');--}}
{{--  qr.addData(document.getElementById('url').value);--}}
{{--  qr.make();--}}
{{--  document.getElementById('qrcode').innerHTML = qr.createImgTag();--}}

{{--//ユーザーの現在の位置情報を取得--}}
{{--navigator.geolocation.getCurrentPosition(successCallback, errorCallback);--}}

{{--/***** ユーザーの現在の位置情報を取得 *****/--}}
{{--function successCallback(position) {--}}
{{--  var gl_text = "緯度：" + position.coords.latitude + "<br>";--}}
{{--    gl_text += "経度：" + position.coords.longitude + "<br>";--}}
{{--    gl_text += "高度：" + position.coords.altitude + "<br>";--}}
{{--    gl_text += "緯度・経度の誤差：" + position.coords.accuracy + "<br>";--}}
{{--    gl_text += "高度の誤差：" + position.coords.altitudeAccuracy + "<br>";--}}
{{--    gl_text += "方角：" + position.coords.heading + "<br>";--}}
{{--    gl_text += "速度：" + position.coords.speed + "<br>";--}}
{{--  document.getElementById("show_result").innerHTML = gl_text;--}}
{{--}--}}

{{--/***** 位置情報が取得できない場合 *****/--}}
{{--function errorCallback(error) {--}}
{{--  var err_msg = "";--}}
{{--  switch(error.code)--}}
{{--  {--}}
{{--    case 1:--}}
{{--      err_msg = "位置情報の利用が許可されていません";--}}
{{--      break;--}}
{{--    case 2:--}}
{{--      err_msg = "デバイスの位置が判定できません";--}}
{{--      break;--}}
{{--    case 3:--}}
{{--      err_msg = "タイムアウトしました";--}}
{{--      break;--}}
{{--  }--}}
{{--  document.getElementById("show_result").innerHTML = err_msg;--}}
{{--  // document.getElementById("show_result").innerHTML = error.message;--}}
{{--}--}}
{{--</script>--}}
{{--<p>あなたの現在位置</p>--}}
{{--<div id="show_result"></div>--}}
</html>
