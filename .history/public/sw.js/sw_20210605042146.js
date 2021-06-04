'use strict'

self.addEventListener('install', function (e) {
  console.log('ServiceWorker install')
})

self.addEventListener('activate', function (e) {
  console.log('Serviceworker activated')
})

