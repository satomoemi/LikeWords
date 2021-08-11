## LikeWords について https://like-words.com/
 記録したい好きな「単語or定型文」「メモ」を登録でき、毎日ランダムに「単語or定型文」を好きな時間に通知してくれる語学学習アプリです。

外国語を学ぶのが好きで、単語もしくは文を登録でき、かつ通知してくれるアプリはないかなとずっと思っていました。
単語は登録できるけど通知はしてくれないアプリが多く、プログラミングを学んだきっかけで作ってみたいと思いました。

## 推奨環境
現時点（2021/8/10）でPCからのGoogle Chromeのみの対応となっています。


## LikeWords使い方
<dl>
  <dt>ユーザーオリジナルの学習帳になるようにユーザー登録が必要</dt>
      <dd>ログイン画面「新規会員登録」から登録できる</dd>

  <dt>ログイン画面から「メールアドレス」「パスワード」入力して「ログイン」へ</dt>

  <dt>ホーム画面で「新規フォルダ作成」でWordを種類分けできる、フォルダの作成ができる</dt>
      <dd>フォルダ名入力必須、出ないと作成できない</dd>
      <dd>「作成」押すとホーム画面に戻り、作成したフォルダが表示される</dd>

  <dt>ホーム画面でフォルダ名を押すと、右側に「Word作成」とWord一覧が表示されるようになっている</dt>
      <dd>初めての場合は何も表示されない</dd>

  <dt>ホーム画面の「Word作成」から単語や文・メモが作成できます</dt>
      <dd>Wordは入力必須、メモは未入力でも作成できる</dd>
      <dd>「作成」押すとホーム画面に戻り、作成したWordが表示される</dd>

  <dt>ホーム画面でWord検索ができる</dt>
      <dd>フォームに入力し、「検索」を押す</dd>
      <dd>部分一致検索のため、1文字でも一致したWordが出力される</dd>

  <dt>ホーム画面でフォルダとWordは「編集」「削除」ができる</dt>
      <dd>フォルダ名ごと、Wordごと右側に配置される</dd>
      <dd>フォルダ名やWordにはすでに作成した、フォルダ名やWordが表示される</dd>
      <dd>「編集」押すと、ホーム画面に戻りフォルダ名やWordが変更されている</dd>

  <dt>ホーム画面の右下のモノクロのベルマークで通知ON/OFFの切替ができる</dt>
      <dd>One Signalというサービスを使っている</dd>
      <dd>ベルマークを初めて押すとブラウザから、許可無許可の表示が出る</dd>
      <dd>通知ONにした時Thanks通知がくるようになっている</dd>

  <dt>ホーム画面のナビバーの「通知時間設定」から通知時間を設定できる</dt>
      <dd>通知がOFFになっていると、時間設定できないようになっている</dd>
      <dd>何時何分という形で設定できる</dd>
      <dd>「更新」押すと、ホーム画面に戻り、「Word作成」の上に設定した時間が表示される</dd>

  <dt>ホーム画面のナビバーの「ユーザー編集」からユーザー登録した際の内容が表示され、直接編集できる</dt>
      <dd>登録内容個々に更新できるようになっている</dd>
      <dd>「更新」押すと、更新しましたメッセージが表示される</dd>

  <dt>ホーム画面のナビバーの「退会」から退会できる</dt>
      <dd>退会理由・パスワード入力必須、出ないと退会できない</dd>
      <dd>物理削除のため、データに残らず全て消えてしまい、復元不可</dd>
      <dd>誤って退会した場合は、再度新規会員登録から始める</dd>

  <dt>ホーム画面のナビバーの「ホーム」からホーム画面表示できる</dt>

  <dt>全ての画面の一番右下にある「使い方詳しく」「利用規約」「プライバシーポリシー」それぞれクリックすると内容か確認できる</dt>
</dl>

## 補足
### WebPush通知機能について
 ① 一つのブラウザで、いくつものユーザーを作成し、全てを通知しようとするとベルマーク表示の不具合が生じます。</br>
 例えばUser_1がベルマークで通知ONにすると、User_2もUser_3もベルマークの表示がONになってしまいます。（OFFも同様）。</br>
 この状態はUser_1は通知がきますが、User_2・User_3は通知がきません。</br>
 User_2・User_3は一度OFFにして再度ONにしていただければ通知はできてしまいます。</br>
 ただややこしくなるのを防ぐため、基本的には一つのブラウザにつき一つのユーザーという使い方になります。</br>

② MacのGoogle ChromeとWindowsのGoogle Chromeでの同一アカウントで同時に通知はできません。</br>
もしどちらも使いたい場合は、どちらも違うアカウントを作成、使用して下さい。</br>

③LikeWords以外のWebサイトを表示していても通知が届きます。</br>

④受信設定はアカウントではなくブラウザに保存されます。</br>



## AWSにインフラ図
AWSにデプロイした際のインフラ図です。</br>
https://gyazo.com/b1b0b1741f3ea5367b3e5f19218c3b21
