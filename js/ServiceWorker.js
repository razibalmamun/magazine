

var CACHE_NAME = 'bnbd01';
var urlsToCache = [
    'https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
    'https://bnbd24.com/css/responsive.css',
    'https://bnbd24.com/css/fontawesome.css',
    'https://bnbd24.com/css/animate.min.css',
    'https://bnbd24.com/css/datatables.min.css',
    'https://bnbd24.com/css/toastr.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.2/css/lightgallery-bundle.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css',
    'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.2/lightgallery.umd.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.2/plugins/zoom/lg-zoom.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.2/plugins/video/lg-video.min.js',
    'https://bnbd24.com/js/bootstrap.bundle.js',
    'https://bnbd24.com/js/axios.min.js',
    'https://bnbd24.com/js/config.js',
    'https://bnbd24.com/js/datatables.min.js',
    'https://bnbd24.com/js/moment.js',
    'https://bnbd24.com/js/bangla-date.js',
];


self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function (cache) {
                return cache.addAll(urlsToCache);
            })
    );
});


self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.filter(function (cacheName) {
                    // Return true if you want to remove this cache,
                    // but remember that caches are shared across
                    // the whole origin
                }).map(function (cacheName) {
                    return caches.delete(cacheName);
                })
            );
        })
    );
});



self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request);
        })
    );
});


