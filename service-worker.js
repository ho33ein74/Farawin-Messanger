self.addEventListener("push", (function (i) {
    if (self.Notification && "granted" === self.Notification.permission && i.data) {
        var t = i.data.json();
        i.waitUntil(self.registration.showNotification(t.title, {
            body: t.body,
            icon: "public/images/favicon/android-icon-192x192.ico",
            data: t.data || {}
        }))
    }
})), self.addEventListener("notificationclick", (function (i) {
    var t = i.notification.data;
    i.notification.close();
    var o = "user/notifications";
    t.hasOwnProperty("url") && (o = t.url), clients.openWindow(o)
}));