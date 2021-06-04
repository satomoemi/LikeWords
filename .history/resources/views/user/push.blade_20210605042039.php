@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
          <h1 contenteditable="true" class="">通知設定</h1>
          <p class="lead"> Wordを毎日・ランダムに通知します </p> 
          通知時間
          <input type="time" name="push-time"><br> 
          アプリ全体に対して通知
          <input type="radio" class="btn-check" name="push" id="push1">ON
          <input type="radio" class="btn-check" name="push" id="push2">OFF
        </div>
      </div>
      <button type="submit" class="btn btn-primary">更新</button>
  </div>
</div>

<script>
// サービスワーカーが使えない系では何もしない
if ('serviceWorker' in navigator) {
  console.log('Service Worker and Push is supported');

  // サービスワーカーとして、public/sw.js を登録する
  navigator.serviceWorker.register('sw.js')
  .then(function (swReg) {
    console.log('Service Worker is registered', swReg)
    initialiseServiceWorker()
  })
  .catch(function(error) {
    console.error('Service Worker Error', error)
  })
}
/** 
 * サービスワーカーを初期化する
 * 初期化では、プッシュ通知用の情報をサーバに送ることになる
 */
function initialiseServiceWorker() {
  if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
    console.log('cant use notification')
    return
  }

  if (Notification.permission === 'denied') {
    console.log('user block notification')
    return
  }

  if (!('PushManager' in window)) {
    console.log('push messaging not supported')
    return
  }

  // プッシュ通知使えるので
  navigator.serviceWorker.ready.then(registration => {
    console.log(registration)
    registration.pushManager.getSubscription()
      .then(subscription => {
        if (! subscription) {
          subscribe()
        }
      })
  })
}
@endsection