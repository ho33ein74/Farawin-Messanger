if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./sw.js')
        .then(() => navigator.serviceWorker.ready)
        .then(reg => {
            // console.log("Service worker registred successfully", reg);
            if ('SyncManager' in window) {
                reg.sync.register('sync-tweets');
            }
        })
        .catch(err => {
            // console.log("service worker not registred !!", err);
        });
}
