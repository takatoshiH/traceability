<body>
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
          <h3>商品登録情報</h3>
        </div>
        <div class="uk-text-center uk-h4">
          <div class="uk-inline">
            <span class="uk-text-success" uk-icon="icon: check"></span>
            <span class="uk-text-middle uk-text-success">商品登録完了しました</span>
          </div>
        </div>
        <div class="identifier-qr">
          <span class="identifier">製品コード：{{$content->identifier}}</span>
          <div id="qr_maker">
            <input class="url-input" type="hidden" id="url" value="http://18.220.72.4/trace/content_detail?search={{$content->identifier}}">
            <div id="qrcode"></div> 
            <button class="uk-button uk-button-default printing" type="button" onclick="funcprint();">印刷する</button>
          </div>
        </div>  
        <div class="uk-card-footer uk-margin uk-text-center">
          <button class="uk-button uk-button-primary return" type="button" onclick="location.href='{{ route('index') }}'">戻る</button>
        </div>
      </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>
<script>
  //QRコード生成
  let qr = qrcode(4, 'L');
  qr.addData(document.getElementById('url').value);
  qr.make();
  document.getElementById('qrcode').innerHTML = qr.createImgTag();
</script>
</html>