self.addEventListener('install', e => {
  console.log('Install PWA!');

});

self.addEventListener('fetch', e =>{
	console.log('Intercepting fetch requests fpr:  ${e.request.url}');
});



self.addEventListener('activate', function(event) {

  var cacheAllowlist = ['pages-cache-v1', 'my-site-cache-v1'];

  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheAllowlist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
