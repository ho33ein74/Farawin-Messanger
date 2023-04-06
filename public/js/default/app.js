(() => {
    var e = {
        9669: (e, t, n) => {
            e.exports = n(1609);
        }, 5448: (e, t, n) => {
            "use strict";
            var r = n(4867), i = n(6026), o = n(4372), a = n(5327), s = n(4097), l = n(4109), c = n(7985), u = n(5061);
            e.exports = function (e) {
                return new Promise((function (t, n) {
                    var d = e.data, p = e.headers, h = e.responseType;
                    r.isFormData(d) && delete p["Content-Type"];
                    var f = new XMLHttpRequest();
                    if (e.auth) {
                        var g = e.auth.username || "",
                            m = e.auth.password ? unescape(encodeURIComponent(e.auth.password)) : "";
                        p.Authorization = "Basic " + btoa(g + ":" + m);
                    }
                    var v = s(e.baseURL, e.url);

                    function b() {
                        if (f) {
                            var r = "getAllResponseHeaders" in f ? l(f.getAllResponseHeaders()) : null, o = {
                                data: h && "text" !== h && "json" !== h ? f.response : f.responseText,
                                status: f.status,
                                statusText: f.statusText,
                                headers: r,
                                config: e,
                                request: f
                            };
                            i(t, n, o), f = null;
                        }
                    }

                    if (f.open(e.method.toUpperCase(), a(v, e.params, e.paramsSerializer), !0), f.timeout = e.timeout, "onloadend" in f ? f.onloadend = b : f.onreadystatechange = function () {
                        f && 4 === f.readyState && (0 !== f.status || f.responseURL && 0 === f.responseURL.indexOf("file:")) && setTimeout(b);
                    }, f.onabort = function () {
                        f && (n(u("Request aborted", e, "ECONNABORTED", f)), f = null);
                    }, f.onerror = function () {
                        n(u("Network Error", e, null, f)), f = null;
                    }, f.ontimeout = function () {
                        var t = "timeout of " + e.timeout + "ms exceeded";
                        e.timeoutErrorMessage && (t = e.timeoutErrorMessage), n(u(t, e, e.transitional && e.transitional.clarifyTimeoutError ? "ETIMEDOUT" : "ECONNABORTED", f)), f = null;
                    }, r.isStandardBrowserEnv()) {
                        var w = (e.withCredentials || c(v)) && e.xsrfCookieName ? o.read(e.xsrfCookieName) : void 0;
                        w && (p[e.xsrfHeaderName] = w);
                    }
                    "setRequestHeader" in f && r.forEach(p, (function (e, t) {
                        void 0 === d && "content-type" === t.toLowerCase() ? delete p[t] : f.setRequestHeader(t, e)
                    })), r.isUndefined(e.withCredentials) || (f.withCredentials = !!e.withCredentials), h && "json" !== h && (f.responseType = e.responseType), "function" == typeof e.onDownloadProgress && f.addEventListener("progress", e.onDownloadProgress), "function" == typeof e.onUploadProgress && f.upload && f.upload.addEventListener("progress", e.onUploadProgress), e.cancelToken && e.cancelToken.promise.then((function (e) {
                        f && (f.abort(), n(e), f = null)
                    })), d || (d = null), f.send(d)
                }))
            }
        }, 1609: (e, t, n) => {
            "use strict";
            var r = n(4867), i = n(1849), o = n(321), a = n(7185);

            function s(e) {
                var t = new o(e), n = i(o.prototype.request, t);
                return r.extend(n, o.prototype, t), r.extend(n, t), n
            }

            var l = s(n(6419));
            l.Axios = o, l.create = function (e) {
                return s(a(l.defaults, e))
            }, l.Cancel = n(5263), l.CancelToken = n(4972), l.isCancel = n(6502), l.all = function (e) {
                return Promise.all(e)
            }, l.spread = n(8713), l.isAxiosError = n(6268), e.exports = l, e.exports.default = l
        }, 5263: e => {
            "use strict";

            function t(e) {
                this.message = e
            }

            t.prototype.toString = function () {
                return "Cancel" + (this.message ? ": " + this.message : "")
            }, t.prototype.__CANCEL__ = !0, e.exports = t
        }, 4972: (e, t, n) => {
            "use strict";
            var r = n(5263);

            function i(e) {
                if ("function" != typeof e) throw new TypeError("executor must be a function.");
                var t;
                this.promise = new Promise((function (e) {
                    t = e
                }));
                var n = this;
                e((function (e) {
                    n.reason || (n.reason = new r(e), t(n.reason))
                }))
            }

            i.prototype.throwIfRequested = function () {
                if (this.reason) throw this.reason
            }, i.source = function () {
                var e;
                return {
                    token: new i((function (t) {
                        e = t
                    })), cancel: e
                }
            }, e.exports = i
        }, 6502: e => {
            "use strict";
            e.exports = function (e) {
                return !(!e || !e.__CANCEL__)
            }
        }, 321: (e, t, n) => {
            "use strict";
            var r = n(4867), i = n(5327), o = n(782), a = n(3572), s = n(7185), l = n(4875), c = l.validators;

            function u(e) {
                this.defaults = e, this.interceptors = {request: new o, response: new o}
            }

            u.prototype.request = function (e) {
                "string" == typeof e ? (e = arguments[1] || {}).url = arguments[0] : e = e || {}, (e = s(this.defaults, e)).method ? e.method = e.method.toLowerCase() : this.defaults.method ? e.method = this.defaults.method.toLowerCase() : e.method = "get";
                var t = e.transitional;
                void 0 !== t && l.assertOptions(t, {
                    silentJSONParsing: c.transitional(c.boolean, "1.0.0"),
                    forcedJSONParsing: c.transitional(c.boolean, "1.0.0"),
                    clarifyTimeoutError: c.transitional(c.boolean, "1.0.0")
                }, !1);
                var n = [], r = !0;
                this.interceptors.request.forEach((function (t) {
                    "function" == typeof t.runWhen && !1 === t.runWhen(e) || (r = r && t.synchronous, n.unshift(t.fulfilled, t.rejected))
                }));
                var i, o = [];
                if (this.interceptors.response.forEach((function (e) {
                    o.push(e.fulfilled, e.rejected)
                })), !r) {
                    var u = [a, void 0];
                    for (Array.prototype.unshift.apply(u, n), u = u.concat(o), i = Promise.resolve(e); u.length;) i = i.then(u.shift(), u.shift());
                    return i
                }
                for (var d = e; n.length;) {
                    var p = n.shift(), h = n.shift();
                    try {
                        d = p(d)
                    } catch (e) {
                        h(e);
                        break
                    }
                }
                try {
                    i = a(d)
                } catch (e) {
                    return Promise.reject(e)
                }
                for (; o.length;) i = i.then(o.shift(), o.shift());
                return i
            }, u.prototype.getUri = function (e) {
                return e = s(this.defaults, e), i(e.url, e.params, e.paramsSerializer).replace(/^\?/, "")
            }, r.forEach(["delete", "get", "head", "options"], (function (e) {
                u.prototype[e] = function (t, n) {
                    return this.request(s(n || {}, {method: e, url: t, data: (n || {}).data}))
                }
            })), r.forEach(["post", "put", "patch"], (function (e) {
                u.prototype[e] = function (t, n, r) {
                    return this.request(s(r || {}, {method: e, url: t, data: n}))
                }
            })), e.exports = u
        }, 782: (e, t, n) => {
            "use strict";
            var r = n(4867);

            function i() {
                this.handlers = []
            }

            i.prototype.use = function (e, t, n) {
                return this.handlers.push({
                    fulfilled: e,
                    rejected: t,
                    synchronous: !!n && n.synchronous,
                    runWhen: n ? n.runWhen : null
                }), this.handlers.length - 1
            }, i.prototype.eject = function (e) {
                this.handlers[e] && (this.handlers[e] = null)
            }, i.prototype.forEach = function (e) {
                r.forEach(this.handlers, (function (t) {
                    null !== t && e(t)
                }))
            }, e.exports = i
        }, 4097: (e, t, n) => {
            "use strict";
            var r = n(9699), i = n(7303);
            e.exports = function (e, t) {
                return e && !r(t) ? i(e, t) : t
            }
        }, 5061: (e, t, n) => {
            "use strict";
            var r = n(481);
            e.exports = function (e, t, n, i, o) {
                var a = new Error(e);
                return r(a, t, n, i, o)
            }
        }, 3572: (e, t, n) => {
            "use strict";
            var r = n(4867), i = n(8527), o = n(6502), a = n(6419);

            function s(e) {
                e.cancelToken && e.cancelToken.throwIfRequested()
            }

            e.exports = function (e) {
                return s(e), e.headers = e.headers || {}, e.data = i.call(e, e.data, e.headers, e.transformRequest), e.headers = r.merge(e.headers.common || {}, e.headers[e.method] || {}, e.headers), r.forEach(["delete", "get", "head", "post", "put", "patch", "common"], (function (t) {
                    delete e.headers[t]
                })), (e.adapter || a.adapter)(e).then((function (t) {
                    return s(e), t.data = i.call(e, t.data, t.headers, e.transformResponse), t
                }), (function (t) {
                    return o(t) || (s(e), t && t.response && (t.response.data = i.call(e, t.response.data, t.response.headers, e.transformResponse))), Promise.reject(t)
                }))
            }
        }, 481: e => {
            "use strict";
            e.exports = function (e, t, n, r, i) {
                return e.config = t, n && (e.code = n), e.request = r, e.response = i, e.isAxiosError = !0, e.toJSON = function () {
                    return {
                        message: this.message,
                        name: this.name,
                        description: this.description,
                        number: this.number,
                        fileName: this.fileName,
                        lineNumber: this.lineNumber,
                        columnNumber: this.columnNumber,
                        stack: this.stack,
                        config: this.config,
                        code: this.code
                    }
                }, e
            }
        }, 7185: (e, t, n) => {
            "use strict";
            var r = n(4867);
            e.exports = function (e, t) {
                t = t || {};
                var n = {}, i = ["url", "method", "data"], o = ["headers", "auth", "proxy", "params"],
                    a = ["baseURL", "transformRequest", "transformResponse", "paramsSerializer", "timeout", "timeoutMessage", "withCredentials", "adapter", "responseType", "xsrfCookieName", "xsrfHeaderName", "onUploadProgress", "onDownloadProgress", "decompress", "maxContentLength", "maxBodyLength", "maxRedirects", "transport", "httpAgent", "httpsAgent", "cancelToken", "socketPath", "responseEncoding"],
                    s = ["validateStatus"];

                function l(e, t) {
                    return r.isPlainObject(e) && r.isPlainObject(t) ? r.merge(e, t) : r.isPlainObject(t) ? r.merge({}, t) : r.isArray(t) ? t.slice() : t
                }

                function c(i) {
                    r.isUndefined(t[i]) ? r.isUndefined(e[i]) || (n[i] = l(void 0, e[i])) : n[i] = l(e[i], t[i])
                }

                r.forEach(i, (function (e) {
                    r.isUndefined(t[e]) || (n[e] = l(void 0, t[e]))
                })), r.forEach(o, c), r.forEach(a, (function (i) {
                    r.isUndefined(t[i]) ? r.isUndefined(e[i]) || (n[i] = l(void 0, e[i])) : n[i] = l(void 0, t[i])
                })), r.forEach(s, (function (r) {
                    r in t ? n[r] = l(e[r], t[r]) : r in e && (n[r] = l(void 0, e[r]))
                }));
                var u = i.concat(o).concat(a).concat(s),
                    d = Object.keys(e).concat(Object.keys(t)).filter((function (e) {
                        return -1 === u.indexOf(e)
                    }));
                return r.forEach(d, c), n
            }
        }, 6026: (e, t, n) => {
            "use strict";
            var r = n(5061);
            e.exports = function (e, t, n) {
                var i = n.config.validateStatus;
                n.status && i && !i(n.status) ? t(r("Request failed with status code " + n.status, n.config, null, n.request, n)) : e(n)
            }
        }, 8527: (e, t, n) => {
            "use strict";
            var r = n(4867), i = n(6419);
            e.exports = function (e, t, n) {
                var o = this || i;
                return r.forEach(n, (function (n) {
                    e = n.call(o, e, t)
                })), e
            }
        }, 6419: (e, t, n) => {
            "use strict";
            var r = n(4155), i = n(4867), o = n(6016), a = n(481),
                s = {"Content-Type": "application/x-www-form-urlencoded"};

            function l(e, t) {
                !i.isUndefined(e) && i.isUndefined(e["Content-Type"]) && (e["Content-Type"] = t)
            }

            var c, u = {
                transitional: {silentJSONParsing: !0, forcedJSONParsing: !0, clarifyTimeoutError: !1},
                adapter: (("undefined" != typeof XMLHttpRequest || void 0 !== r && "[object process]" === Object.prototype.toString.call(r)) && (c = n(5448)), c),
                transformRequest: [function (e, t) {
                    return o(t, "Accept"), o(t, "Content-Type"), i.isFormData(e) || i.isArrayBuffer(e) || i.isBuffer(e) || i.isStream(e) || i.isFile(e) || i.isBlob(e) ? e : i.isArrayBufferView(e) ? e.buffer : i.isURLSearchParams(e) ? (l(t, "application/x-www-form-urlencoded;charset=utf-8"), e.toString()) : i.isObject(e) || t && "application/json" === t["Content-Type"] ? (l(t, "application/json"), function (e, t, n) {
                        if (i.isString(e)) try {
                            return (t || JSON.parse)(e), i.trim(e)
                        } catch (e) {
                            if ("SyntaxError" !== e.name) throw e
                        }
                        return (n || JSON.stringify)(e)
                    }(e)) : e
                }],
                transformResponse: [function (e) {
                    var t = this.transitional, n = t && t.silentJSONParsing, r = t && t.forcedJSONParsing,
                        o = !n && "json" === this.responseType;
                    if (o || r && i.isString(e) && e.length) try {
                        return JSON.parse(e)
                    } catch (e) {
                        if (o) {
                            if ("SyntaxError" === e.name) throw a(e, this, "E_JSON_PARSE");
                            throw e
                        }
                    }
                    return e
                }],
                timeout: 0,
                xsrfCookieName: "XSRF-TOKEN",
                xsrfHeaderName: "X-XSRF-TOKEN",
                maxContentLength: -1,
                maxBodyLength: -1,
                validateStatus: function (e) {
                    return e >= 200 && e < 300
                }
            };
            u.headers = {common: {Accept: "application/json, text/plain, */*"}}, i.forEach(["delete", "get", "head"], (function (e) {
                u.headers[e] = {}
            })), i.forEach(["post", "put", "patch"], (function (e) {
                u.headers[e] = i.merge(s)
            })), e.exports = u
        }, 1849: e => {
            "use strict";
            e.exports = function (e, t) {
                return function () {
                    for (var n = new Array(arguments.length), r = 0; r < n.length; r++) n[r] = arguments[r];
                    return e.apply(t, n)
                }
            }
        }, 5327: (e, t, n) => {
            "use strict";
            var r = n(4867);

            function i(e) {
                return encodeURIComponent(e).replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]")
            }

            e.exports = function (e, t, n) {
                if (!t) return e;
                var o;
                if (n) o = n(t); else if (r.isURLSearchParams(t)) o = t.toString(); else {
                    var a = [];
                    r.forEach(t, (function (e, t) {
                        null != e && (r.isArray(e) ? t += "[]" : e = [e], r.forEach(e, (function (e) {
                            r.isDate(e) ? e = e.toISOString() : r.isObject(e) && (e = JSON.stringify(e)), a.push(i(t) + "=" + i(e))
                        })))
                    })), o = a.join("&")
                }
                if (o) {
                    var s = e.indexOf("#");
                    -1 !== s && (e = e.slice(0, s)), e += (-1 === e.indexOf("?") ? "?" : "&") + o
                }
                return e
            }
        }, 7303: e => {
            "use strict";
            e.exports = function (e, t) {
                return t ? e.replace(/\/+$/, "") + "/" + t.replace(/^\/+/, "") : e
            }
        }, 4372: (e, t, n) => {
            "use strict";
            var r = n(4867);
            e.exports = r.isStandardBrowserEnv() ? {
                write: function (e, t, n, i, o, a) {
                    var s = [];
                    s.push(e + "=" + encodeURIComponent(t)), r.isNumber(n) && s.push("expires=" + new Date(n).toGMTString()), r.isString(i) && s.push("path=" + i), r.isString(o) && s.push("domain=" + o), !0 === a && s.push("secure"), document.cookie = s.join("; ")
                }, read: function (e) {
                    var t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
                    return t ? decodeURIComponent(t[3]) : null
                }, remove: function (e) {
                    this.write(e, "", Date.now() - 864e5)
                }
            } : {
                write: function () {
                }, read: function () {
                    return null
                }, remove: function () {
                }
            }
        }, 9699: e => {
            "use strict";
            e.exports = function (e) {
                return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e)
            }
        }, 6268: e => {
            "use strict";
            e.exports = function (e) {
                return "object" == typeof e && !0 === e.isAxiosError
            }
        }, 7985: (e, t, n) => {
            "use strict";
            var r = n(4867);
            e.exports = r.isStandardBrowserEnv() ? function () {
                var e, t = /(msie|trident)/i.test(navigator.userAgent), n = document.createElement("a");

                function i(e) {
                    var r = e;
                    return t && (n.setAttribute("href", r), r = n.href), n.setAttribute("href", r), {
                        href: n.href,
                        protocol: n.protocol ? n.protocol.replace(/:$/, "") : "",
                        host: n.host,
                        search: n.search ? n.search.replace(/^\?/, "") : "",
                        hash: n.hash ? n.hash.replace(/^#/, "") : "",
                        hostname: n.hostname,
                        port: n.port,
                        pathname: "/" === n.pathname.charAt(0) ? n.pathname : "/" + n.pathname
                    }
                }

                return e = i(window.location.href), function (t) {
                    var n = r.isString(t) ? i(t) : t;
                    return n.protocol === e.protocol && n.host === e.host
                }
            }() : function () {
                return !0
            }
        }, 6016: (e, t, n) => {
            "use strict";
            var r = n(4867);
            e.exports = function (e, t) {
                r.forEach(e, (function (n, r) {
                    r !== t && r.toUpperCase() === t.toUpperCase() && (e[t] = n, delete e[r])
                }))
            }
        }, 4109: (e, t, n) => {
            "use strict";
            var r = n(4867),
                i = ["age", "authorization", "content-length", "content-type", "etag", "expires", "from", "host", "if-modified-since", "if-unmodified-since", "last-modified", "location", "max-forwards", "proxy-authorization", "referer", "retry-after", "user-agent"];
            e.exports = function (e) {
                var t, n, o, a = {};
                return e ? (r.forEach(e.split("\n"), (function (e) {
                    if (o = e.indexOf(":"), t = r.trim(e.substr(0, o)).toLowerCase(), n = r.trim(e.substr(o + 1)), t) {
                        if (a[t] && i.indexOf(t) >= 0) return;
                        a[t] = "set-cookie" === t ? (a[t] ? a[t] : []).concat([n]) : a[t] ? a[t] + ", " + n : n
                    }
                })), a) : a
            }
        }, 8713: e => {
            "use strict";
            e.exports = function (e) {
                return function (t) {
                    return e.apply(null, t)
                }
            }
        }, 4875: (e, t, n) => {
            "use strict";
            var r = n(8593), i = {};
            ["object", "boolean", "number", "function", "string", "symbol"].forEach((function (e, t) {
                i[e] = function (n) {
                    return typeof n === e || "a" + (t < 1 ? "n " : " ") + e
                }
            }));
            var o = {}, a = r.version.split(".");

            function s(e, t) {
                for (var n = t ? t.split(".") : a, r = e.split("."), i = 0; i < 3; i++) {
                    if (n[i] > r[i]) return !0;
                    if (n[i] < r[i]) return !1
                }
                return !1
            }

            i.transitional = function (e, t, n) {
                var i = t && s(t);

                function a(e, t) {
                    return "[Axios v" + r.version + "] Transitional option '" + e + "'" + t + (n ? ". " + n : "")
                }

                return function (n, r, s) {
                    if (!1 === e) throw new Error(a(r, " has been removed in " + t));
                    return i && !o[r] && (o[r] = !0, console.warn(a(r, " has been deprecated since v" + t + " and will be removed in the near future"))), !e || e(n, r, s)
                }
            }, e.exports = {
                isOlderVersion: s, assertOptions: function (e, t, n) {
                    if ("object" != typeof e) throw new TypeError("options must be an object");
                    for (var r = Object.keys(e), i = r.length; i-- > 0;) {
                        var o = r[i], a = t[o];
                        if (a) {
                            var s = e[o], l = void 0 === s || a(s, o, e);
                            if (!0 !== l) throw new TypeError("option " + o + " must be " + l)
                        } else if (!0 !== n) throw Error("Unknown option " + o)
                    }
                }, validators: i
            }
        }, 4867: (e, t, n) => {
            "use strict";
            var r = n(1849), i = Object.prototype.toString;

            function o(e) {
                return "[object Array]" === i.call(e)
            }

            function a(e) {
                return void 0 === e
            }

            function s(e) {
                return null !== e && "object" == typeof e
            }

            function l(e) {
                if ("[object Object]" !== i.call(e)) return !1;
                var t = Object.getPrototypeOf(e);
                return null === t || t === Object.prototype
            }

            function c(e) {
                return "[object Function]" === i.call(e)
            }

            function u(e, t) {
                if (null != e) if ("object" != typeof e && (e = [e]), o(e)) for (var n = 0, r = e.length; n < r; n++) t.call(null, e[n], n, e); else for (var i in e) Object.prototype.hasOwnProperty.call(e, i) && t.call(null, e[i], i, e)
            }

            e.exports = {
                isArray: o, isArrayBuffer: function (e) {
                    return "[object ArrayBuffer]" === i.call(e)
                }, isBuffer: function (e) {
                    return null !== e && !a(e) && null !== e.constructor && !a(e.constructor) && "function" == typeof e.constructor.isBuffer && e.constructor.isBuffer(e)
                }, isFormData: function (e) {
                    return "undefined" != typeof FormData && e instanceof FormData
                }, isArrayBufferView: function (e) {
                    return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer
                }, isString: function (e) {
                    return "string" == typeof e
                }, isNumber: function (e) {
                    return "number" == typeof e
                }, isObject: s, isPlainObject: l, isUndefined: a, isDate: function (e) {
                    return "[object Date]" === i.call(e)
                }, isFile: function (e) {
                    return "[object File]" === i.call(e)
                }, isBlob: function (e) {
                    return "[object Blob]" === i.call(e)
                }, isFunction: c, isStream: function (e) {
                    return s(e) && c(e.pipe)
                }, isURLSearchParams: function (e) {
                    return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams
                }, isStandardBrowserEnv: function () {
                    return ("undefined" == typeof navigator || "ReactNative" !== navigator.product && "NativeScript" !== navigator.product && "NS" !== navigator.product) && ("undefined" != typeof window && "undefined" != typeof document)
                }, forEach: u, merge: function e() {
                    var t = {};

                    function n(n, r) {
                        l(t[r]) && l(n) ? t[r] = e(t[r], n) : l(n) ? t[r] = e({}, n) : o(n) ? t[r] = n.slice() : t[r] = n
                    }

                    for (var r = 0, i = arguments.length; r < i; r++) u(arguments[r], n);
                    return t
                }, extend: function (e, t, n) {
                    return u(t, (function (t, i) {
                        e[i] = n && "function" == typeof t ? r(t, n) : t
                    })), e
                }, trim: function (e) {
                    return e.trim ? e.trim() : e.replace(/^\s+|\s+$/g, "")
                }, stripBOM: function (e) {
                    return 65279 === e.charCodeAt(0) && (e = e.slice(1)), e
                }
            }
        }, 6271: () => {
            Alpine.data("collapseController", (function () {
                return {
                    collapse: !1, isActive: function (e) {
                        return this.collapse === e
                    }, collapseHandler: function (e) {
                        this.isActive(e) ? this.collapse = !1 : this.collapse = e
                    }
                }
            }))
        }, 1984: () => {
            Alpine.data("darkMode", (function () {
                return {dark: !1}
            }))
        }, 1061: () => {
            Alpine.data("discussBestAnswerButton", (function (e) {
                return {
                    bestAnswer: (t = {}, n = "@click", r = function () {
                        Swal.fire({
                            title: "لطفا دقت کنید",
                            text: "آیا برای انتخاب این پاسخ به عنوان بهترین پاسخ این گفتگو مطمئن هستید ؟",
                            showCancelButton: !0,
                            cancelButtonText: "نه",
                            confirmButtonText: "بله",
                            confirmButtonColor: "#27ae60",
                            icon: "warning"
                        }).then((function (t) {
                            t.value && e.call("bestAnswer")
                        }))
                    }, n in t ? Object.defineProperty(t, n, {
                        value: r,
                        enumerable: !0,
                        configurable: !0,
                        writable: !0
                    }) : t[n] = r, t)
                };
                var t, n, r
            }))
        }, 9373: () => {
            Alpine.data("discussCopyUrl", (function (e) {
                var t, n, r;
                return {
                    hover: !1, copyForUse: (t = {}, n = "@click", r = function () {
                        e.getUrl().then((function (e) {
                            var t, n;
                            t = e, (n = document.createElement("textarea")).value = t, n.setAttribute("readonly", ""), n.style.position = "absolute", n.style.left = "-9999px", document.body.appendChild(n), n.select(), document.execCommand("copy"), document.body.removeChild(n), successtoast.fire({title: "لینک مورد نظر با موفقیت کپی شد"})
                        }))
                    }, n in t ? Object.defineProperty(t, n, {
                        value: r,
                        enumerable: !0,
                        configurable: !0,
                        writable: !0
                    }) : t[n] = r, t)
                }
            }))
        }, 7271: () => {
            Alpine.data("discussDeleteButton", (function (e) {
                return {
                    deleteSubject: (t = {}, n = "@click", r = function () {
                        Swal.fire({
                            title: "لطفا دقت کنید",
                            text: "آیا برای حذف این مطلب مطمئن هستید ؟",
                            showCancelButton: !0,
                            cancelButtonText: "نه",
                            confirmButtonText: "بله مطمئنم",
                            confirmButtonColor: "#e64942",
                            reverseButtons: !0,
                            icon: "warning"
                        }).then((function (t) {
                            t.value && e.call("delete")
                        }))
                    }, n in t ? Object.defineProperty(t, n, {
                        value: r,
                        enumerable: !0,
                        configurable: !0,
                        writable: !0
                    }) : t[n] = r, t)
                };
                var t, n, r
            }))
        }, 5370: () => {
            Alpine.data("spamIcon", (function (e) {
                return {
                    hover: !1, spam: (t = {}, n = "@click", r = function () {
                        Swal.fire({
                            title: "گزارش این مطلب به عنوان یک",
                            input: "radio",
                            inputOptions: {
                                spam: "اسپم",
                                "offensive-writing": "نوشته توهین آمیز",
                                "violation-of-rules": "نقض قوانین راکت",
                                other: "موارد دیگر"
                            },
                            inputValidator: function (e) {
                                if (!e) return "یکی از گزینه‌های بالا باید انتخاب شود"
                            },
                            showCancelButton: !0,
                            cancelButtonText: "انصراف",
                            confirmButtonText: "ارسال گزارش",
                            confirmButtonColor: "#e64942",
                            reverseButtons: !0
                        }).then((function (t) {
                            t.value && e.call("spam", t.value)
                        }))
                    }, n in t ? Object.defineProperty(t, n, {
                        value: r,
                        enumerable: !0,
                        configurable: !0,
                        writable: !0
                    }) : t[n] = r, t)
                };
                var t, n, r
            }))
        }, 8079: (e, t, n) => {
            "use strict";

            function r(e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }

            function i(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var r = t[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r)
                }
            }

            function o(e, t, n) {
                return t && i(e.prototype, t), n && i(e, n), e
            }

            function a() {
                return a = Object.assign || function (e) {
                    for (var t = 1; t < arguments.length; t++) {
                        var n = arguments[t];
                        for (var r in n) Object.prototype.hasOwnProperty.call(n, r) && (e[r] = n[r])
                    }
                    return e
                }, a.apply(this, arguments)
            }

            function s(e, t) {
                if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }), t && c(e, t)
            }

            function l(e) {
                return l = Object.setPrototypeOf ? Object.getPrototypeOf : function (e) {
                    return e.__proto__ || Object.getPrototypeOf(e)
                }, l(e)
            }

            function c(e, t) {
                return c = Object.setPrototypeOf || function (e, t) {
                    return e.__proto__ = t, e
                }, c(e, t)
            }

            function u(e, t) {
                return !t || "object" != typeof t && "function" != typeof t ? function (e) {
                    if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return e
                }(e) : t
            }

            function d(e) {
                var t = function () {
                    if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
                    if (Reflect.construct.sham) return !1;
                    if ("function" == typeof Proxy) return !0;
                    try {
                        return Date.prototype.toString.call(Reflect.construct(Date, [], (function () {
                        }))), !0
                    } catch (e) {
                        return !1
                    }
                }();
                return function () {
                    var n, r = l(e);
                    if (t) {
                        var i = l(this).constructor;
                        n = Reflect.construct(r, arguments, i)
                    } else n = r.apply(this, arguments);
                    return u(this, n)
                }
            }

            n.r(t);
            var p = function () {
                function e(t) {
                    r(this, e), this._defaultOptions = {
                        auth: {headers: {}},
                        authEndpoint: "/broadcasting/auth",
                        broadcaster: "pusher",
                        csrfToken: null,
                        host: null,
                        key: null,
                        namespace: "App.Events"
                    }, this.setOptions(t), this.connect()
                }

                return o(e, [{
                    key: "setOptions", value: function (e) {
                        return this.options = a(this._defaultOptions, e), this.csrfToken() && (this.options.auth.headers["X-CSRF-TOKEN"] = this.csrfToken()), e
                    }
                }, {
                    key: "csrfToken", value: function () {
                        var e;
                        return "undefined" != typeof window && window.Laravel && window.Laravel.csrfToken ? window.Laravel.csrfToken : this.options.csrfToken ? this.options.csrfToken : "undefined" != typeof document && "function" == typeof document.querySelector && (e = document.querySelector('meta[name="csrf-token"]')) ? e.getAttribute("content") : null
                    }
                }]), e
            }(), h = function () {
                function e() {
                    r(this, e)
                }

                return o(e, [{
                    key: "listenForWhisper", value: function (e, t) {
                        return this.listen(".client-" + e, t)
                    }
                }, {
                    key: "notification", value: function (e) {
                        return this.listen(".Illuminate\\Notifications\\Events\\BroadcastNotificationCreated", e)
                    }
                }, {
                    key: "stopListeningForWhisper", value: function (e, t) {
                        return this.stopListening(".client-" + e, t)
                    }
                }]), e
            }(), f = function () {
                function e(t) {
                    r(this, e), this.setNamespace(t)
                }

                return o(e, [{
                    key: "format", value: function (e) {
                        return "." === e.charAt(0) || "\\" === e.charAt(0) ? e.substr(1) : (this.namespace && (e = this.namespace + "." + e), e.replace(/\./g, "\\"))
                    }
                }, {
                    key: "setNamespace", value: function (e) {
                        this.namespace = e
                    }
                }]), e
            }(), g = function (e) {
                s(n, e);
                var t = d(n);

                function n(e, i, o) {
                    var a;
                    return r(this, n), (a = t.call(this)).name = i, a.pusher = e, a.options = o, a.eventFormatter = new f(a.options.namespace), a.subscribe(), a
                }

                return o(n, [{
                    key: "subscribe", value: function () {
                        this.subscription = this.pusher.subscribe(this.name)
                    }
                }, {
                    key: "unsubscribe", value: function () {
                        this.pusher.unsubscribe(this.name)
                    }
                }, {
                    key: "listen", value: function (e, t) {
                        return this.on(this.eventFormatter.format(e), t), this
                    }
                }, {
                    key: "listenToAll", value: function (e) {
                        var t = this;
                        return this.subscription.bind_global((function (n, r) {
                            if (!n.startsWith("pusher:")) {
                                var i = t.options.namespace.replace(/\./g, "\\"),
                                    o = n.startsWith(i) ? n.substring(i.length + 1) : "." + n;
                                e(o, r)
                            }
                        })), this
                    }
                }, {
                    key: "stopListening", value: function (e, t) {
                        return t ? this.subscription.unbind(this.eventFormatter.format(e), t) : this.subscription.unbind(this.eventFormatter.format(e)), this
                    }
                }, {
                    key: "stopListeningToAll", value: function (e) {
                        return e ? this.subscription.unbind_global(e) : this.subscription.unbind_global(), this
                    }
                }, {
                    key: "subscribed", value: function (e) {
                        return this.on("pusher:subscription_succeeded", (function () {
                            e()
                        })), this
                    }
                }, {
                    key: "error", value: function (e) {
                        return this.on("pusher:subscription_error", (function (t) {
                            e(t)
                        })), this
                    }
                }, {
                    key: "on", value: function (e, t) {
                        return this.subscription.bind(e, t), this
                    }
                }]), n
            }(h), m = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "whisper", value: function (e, t) {
                        return this.pusher.channels.channels[this.name].trigger("client-".concat(e), t), this
                    }
                }]), n
            }(g), v = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "whisper", value: function (e, t) {
                        return this.pusher.channels.channels[this.name].trigger("client-".concat(e), t), this
                    }
                }]), n
            }(g), b = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "here", value: function (e) {
                        return this.on("pusher:subscription_succeeded", (function (t) {
                            e(Object.keys(t.members).map((function (e) {
                                return t.members[e]
                            })))
                        })), this
                    }
                }, {
                    key: "joining", value: function (e) {
                        return this.on("pusher:member_added", (function (t) {
                            e(t.info)
                        })), this
                    }
                }, {
                    key: "leaving", value: function (e) {
                        return this.on("pusher:member_removed", (function (t) {
                            e(t.info)
                        })), this
                    }
                }, {
                    key: "whisper", value: function (e, t) {
                        return this.pusher.channels.channels[this.name].trigger("client-".concat(e), t), this
                    }
                }]), n
            }(g), w = function (e) {
                s(n, e);
                var t = d(n);

                function n(e, i, o) {
                    var a;
                    return r(this, n), (a = t.call(this)).events = {}, a.listeners = {}, a.name = i, a.socket = e, a.options = o, a.eventFormatter = new f(a.options.namespace), a.subscribe(), a
                }

                return o(n, [{
                    key: "subscribe", value: function () {
                        this.socket.emit("subscribe", {channel: this.name, auth: this.options.auth || {}})
                    }
                }, {
                    key: "unsubscribe", value: function () {
                        this.unbind(), this.socket.emit("unsubscribe", {
                            channel: this.name,
                            auth: this.options.auth || {}
                        })
                    }
                }, {
                    key: "listen", value: function (e, t) {
                        return this.on(this.eventFormatter.format(e), t), this
                    }
                }, {
                    key: "stopListening", value: function (e, t) {
                        return this.unbindEvent(this.eventFormatter.format(e), t), this
                    }
                }, {
                    key: "subscribed", value: function (e) {
                        return this.on("connect", (function (t) {
                            e(t)
                        })), this
                    }
                }, {
                    key: "error", value: function (e) {
                        return this
                    }
                }, {
                    key: "on", value: function (e, t) {
                        var n = this;
                        return this.listeners[e] = this.listeners[e] || [], this.events[e] || (this.events[e] = function (t, r) {
                            n.name === t && n.listeners[e] && n.listeners[e].forEach((function (e) {
                                return e(r)
                            }))
                        }, this.socket.on(e, this.events[e])), this.listeners[e].push(t), this
                    }
                }, {
                    key: "unbind", value: function () {
                        var e = this;
                        Object.keys(this.events).forEach((function (t) {
                            e.unbindEvent(t)
                        }))
                    }
                }, {
                    key: "unbindEvent", value: function (e, t) {
                        this.listeners[e] = this.listeners[e] || [], t && (this.listeners[e] = this.listeners[e].filter((function (e) {
                            return e !== t
                        }))), t && 0 !== this.listeners[e].length || (this.events[e] && (this.socket.removeListener(e, this.events[e]), delete this.events[e]), delete this.listeners[e])
                    }
                }]), n
            }(h), y = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "whisper", value: function (e, t) {
                        return this.socket.emit("client event", {
                            channel: this.name,
                            event: "client-".concat(e),
                            data: t
                        }), this
                    }
                }]), n
            }(w), _ = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "here", value: function (e) {
                        return this.on("presence:subscribed", (function (t) {
                            e(t.map((function (e) {
                                return e.user_info
                            })))
                        })), this
                    }
                }, {
                    key: "joining", value: function (e) {
                        return this.on("presence:joining", (function (t) {
                            return e(t.user_info)
                        })), this
                    }
                }, {
                    key: "leaving", value: function (e) {
                        return this.on("presence:leaving", (function (t) {
                            return e(t.user_info)
                        })), this
                    }
                }]), n
            }(y), k = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "subscribe", value: function () {
                    }
                }, {
                    key: "unsubscribe", value: function () {
                    }
                }, {
                    key: "listen", value: function (e, t) {
                        return this
                    }
                }, {
                    key: "stopListening", value: function (e, t) {
                        return this
                    }
                }, {
                    key: "subscribed", value: function (e) {
                        return this
                    }
                }, {
                    key: "error", value: function (e) {
                        return this
                    }
                }, {
                    key: "on", value: function (e, t) {
                        return this
                    }
                }]), n
            }(h), x = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "whisper", value: function (e, t) {
                        return this
                    }
                }]), n
            }(k), S = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    return r(this, n), t.apply(this, arguments)
                }

                return o(n, [{
                    key: "here", value: function (e) {
                        return this
                    }
                }, {
                    key: "joining", value: function (e) {
                        return this
                    }
                }, {
                    key: "leaving", value: function (e) {
                        return this
                    }
                }, {
                    key: "whisper", value: function (e, t) {
                        return this
                    }
                }]), n
            }(k), C = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    var e;
                    return r(this, n), (e = t.apply(this, arguments)).channels = {}, e
                }

                return o(n, [{
                    key: "connect", value: function () {
                        void 0 !== this.options.client ? this.pusher = this.options.client : this.pusher = new Pusher(this.options.key, this.options)
                    }
                }, {
                    key: "listen", value: function (e, t, n) {
                        return this.channel(e).listen(t, n)
                    }
                }, {
                    key: "channel", value: function (e) {
                        return this.channels[e] || (this.channels[e] = new g(this.pusher, e, this.options)), this.channels[e]
                    }
                }, {
                    key: "privateChannel", value: function (e) {
                        return this.channels["private-" + e] || (this.channels["private-" + e] = new m(this.pusher, "private-" + e, this.options)), this.channels["private-" + e]
                    }
                }, {
                    key: "encryptedPrivateChannel", value: function (e) {
                        return this.channels["private-encrypted-" + e] || (this.channels["private-encrypted-" + e] = new v(this.pusher, "private-encrypted-" + e, this.options)), this.channels["private-encrypted-" + e]
                    }
                }, {
                    key: "presenceChannel", value: function (e) {
                        return this.channels["presence-" + e] || (this.channels["presence-" + e] = new b(this.pusher, "presence-" + e, this.options)), this.channels["presence-" + e]
                    }
                }, {
                    key: "leave", value: function (e) {
                        var t = this;
                        [e, "private-" + e, "presence-" + e].forEach((function (e, n) {
                            t.leaveChannel(e)
                        }))
                    }
                }, {
                    key: "leaveChannel", value: function (e) {
                        this.channels[e] && (this.channels[e].unsubscribe(), delete this.channels[e])
                    }
                }, {
                    key: "socketId", value: function () {
                        return this.pusher.connection.socket_id
                    }
                }, {
                    key: "disconnect", value: function () {
                        this.pusher.disconnect()
                    }
                }]), n
            }(p), E = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    var e;
                    return r(this, n), (e = t.apply(this, arguments)).channels = {}, e
                }

                return o(n, [{
                    key: "connect", value: function () {
                        var e = this, t = this.getSocketIO();
                        return this.socket = t(this.options.host, this.options), this.socket.on("reconnect", (function () {
                            Object.values(e.channels).forEach((function (e) {
                                e.subscribe()
                            }))
                        })), this.socket
                    }
                }, {
                    key: "getSocketIO", value: function () {
                        if (void 0 !== this.options.client) return this.options.client;
                        if ("undefined" != typeof io) return io;
                        throw new Error("Socket.io client not found. Should be globally available or passed via options.client")
                    }
                }, {
                    key: "listen", value: function (e, t, n) {
                        return this.channel(e).listen(t, n)
                    }
                }, {
                    key: "channel", value: function (e) {
                        return this.channels[e] || (this.channels[e] = new w(this.socket, e, this.options)), this.channels[e]
                    }
                }, {
                    key: "privateChannel", value: function (e) {
                        return this.channels["private-" + e] || (this.channels["private-" + e] = new y(this.socket, "private-" + e, this.options)), this.channels["private-" + e]
                    }
                }, {
                    key: "presenceChannel", value: function (e) {
                        return this.channels["presence-" + e] || (this.channels["presence-" + e] = new _(this.socket, "presence-" + e, this.options)), this.channels["presence-" + e]
                    }
                }, {
                    key: "leave", value: function (e) {
                        var t = this;
                        [e, "private-" + e, "presence-" + e].forEach((function (e) {
                            t.leaveChannel(e)
                        }))
                    }
                }, {
                    key: "leaveChannel", value: function (e) {
                        this.channels[e] && (this.channels[e].unsubscribe(), delete this.channels[e])
                    }
                }, {
                    key: "socketId", value: function () {
                        return this.socket.id
                    }
                }, {
                    key: "disconnect", value: function () {
                        this.socket.disconnect()
                    }
                }]), n
            }(p), T = function (e) {
                s(n, e);
                var t = d(n);

                function n() {
                    var e;
                    return r(this, n), (e = t.apply(this, arguments)).channels = {}, e
                }

                return o(n, [{
                    key: "connect", value: function () {
                    }
                }, {
                    key: "listen", value: function (e, t, n) {
                        return new k
                    }
                }, {
                    key: "channel", value: function (e) {
                        return new k
                    }
                }, {
                    key: "privateChannel", value: function (e) {
                        return new x
                    }
                }, {
                    key: "presenceChannel", value: function (e) {
                        return new S
                    }
                }, {
                    key: "leave", value: function (e) {
                    }
                }, {
                    key: "leaveChannel", value: function (e) {
                    }
                }, {
                    key: "socketId", value: function () {
                        return "fake-socket-id"
                    }
                }, {
                    key: "disconnect", value: function () {
                    }
                }]), n
            }(p);
            const A = function () {
                function e(t) {
                    r(this, e), this.options = t, this.connect(), this.options.withoutInterceptors || this.registerInterceptors()
                }

                return o(e, [{
                    key: "channel", value: function (e) {
                        return this.connector.channel(e)
                    }
                }, {
                    key: "connect", value: function () {
                        "pusher" == this.options.broadcaster ? this.connector = new C(this.options) : "socket.io" == this.options.broadcaster ? this.connector = new E(this.options) : "null" == this.options.broadcaster ? this.connector = new T(this.options) : "function" == typeof this.options.broadcaster && (this.connector = new this.options.broadcaster(this.options))
                    }
                }, {
                    key: "disconnect", value: function () {
                        this.connector.disconnect()
                    }
                }, {
                    key: "join", value: function (e) {
                        return this.connector.presenceChannel(e)
                    }
                }, {
                    key: "leave", value: function (e) {
                        this.connector.leave(e)
                    }
                }, {
                    key: "leaveChannel", value: function (e) {
                        this.connector.leaveChannel(e)
                    }
                }, {
                    key: "listen", value: function (e, t, n) {
                        return this.connector.listen(e, t, n)
                    }
                }, {
                    key: "private", value: function (e) {
                        return this.connector.privateChannel(e)
                    }
                }, {
                    key: "encryptedPrivate", value: function (e) {
                        return this.connector.encryptedPrivateChannel(e)
                    }
                }, {
                    key: "socketId", value: function () {
                        return this.connector.socketId()
                    }
                }, {
                    key: "registerInterceptors", value: function () {
                        "function" == typeof Vue && Vue.http && this.registerVueRequestInterceptor(), "function" == typeof axios && this.registerAxiosRequestInterceptor(), "function" == typeof jQuery && this.registerjQueryAjaxSetup()
                    }
                }, {
                    key: "registerVueRequestInterceptor", value: function () {
                        var e = this;
                        Vue.http.interceptors.push((function (t, n) {
                            e.socketId() && t.headers.set("X-Socket-ID", e.socketId()), n()
                        }))
                    }
                }, {
                    key: "registerAxiosRequestInterceptor", value: function () {
                        var e = this;
                        axios.interceptors.request.use((function (t) {
                            return e.socketId() && (t.headers["X-Socket-Id"] = e.socketId()), t
                        }))
                    }
                }, {
                    key: "registerjQueryAjaxSetup", value: function () {
                        var e = this;
                        void 0 !== jQuery.ajax && jQuery.ajaxPrefilter((function (t, n, r) {
                            e.socketId() && r.setRequestHeader("X-Socket-Id", e.socketId())
                        }))
                    }
                }]), e
            }();
            window.axios = n(9669), window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest", window.Swal = n(6455), window.toast = Swal.mixin({
                toast: !0,
                position: "bottom-start",
                background: "#1676c6",
                showConfirmButton: !1,
                timer: 4e3,
                timerProgressBar: !0,
                onOpen: function (e) {
                    e.addEventListener("mouseenter", Swal.stopTimer), e.addEventListener("mouseleave", Swal.resumeTimer)
                }
            }), window.successtoast = window.toast.mixin({
                background: "#27ae60",
                icon: "success"
            }), window.errortoast = window.toast.mixin({
                background: "#e74c3c",
                icon: "error"
            }), window.warningtoast = window.toast.mixin({
                background: "#f39c12",
                icon: "warning"
            }), window.Pusher = n(6606), window.Echo = new A({
                broadcaster: "pusher",
                key: "LYtPVBBDgtUS7vBv0Zies6XVuudKkC",
                wsHost: "",
                wsPort: 443,
                wssPort: 443,
                disableStats: !0,
                encrypted: !0,
                enabledTransports: []
            })
        }, 369: () => {
            var e, t, n, r, i, o;
            e = window, t = document, n = "script", r = "ga", e.GoogleAnalyticsObject = r, e.ga = e.ga || function () {
                (e.ga.q = e.ga.q || []).push(arguments)
            }, e.ga.l = 1 * new Date, i = t.createElement(n), o = t.getElementsByTagName(n)[0], i.async = 1, i.src = "https://www.google-analytics.com/analytics.js", o.parentNode.insertBefore(i, o), ga("create", "UA-104633902-1", "auto"), ga("send", "pageview")
        }, 219: (e, t, n) => {
            window.hljs = n(3390), n(5241), hljs.registerLanguage("javascript", n(978)), hljs.registerLanguage("php", n(2656)), hljs.registerLanguage("xml", n(4610)), hljs.registerLanguage("python", n(8245)), hljs.registerLanguage("css", n(5064)), hljs.registerLanguage("scss", n(1062)), hljs.registerLanguage("bash", n(8780)), hljs.registerLanguage("markup", n(2003)), hljs.configure({ignoreUnescapedHTML: !0}), hljs.highlightAll()
        }, 1075: () => {
            function e(t) {
                return e = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
                    return typeof e
                } : function (e) {
                    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                }, e(t)
            }

            !function () {
                var t = {}, n = {}, r = {}, i = window.document, o = window.RegExp, a = window.navigator, s = 72,
                    l = /msie/.test(a.userAgent.toLowerCase()),
                    c = (/msie 6/.test(a.userAgent.toLowerCase()) || /msie 5/.test(a.userAgent.toLowerCase()), /opera/.test(a.userAgent.toLowerCase()));

                function u(e, t) {
                    switch (e) {
                        case"bold":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="'.concat(t, '">\n                                <path fill="currentColor" d="M333.49 238a122 122 0 0 0 27-65.21C367.87 96.49 308 32 233.42 32H34a16 16 0 0 0-16 16v48a16 16 0 0 0 16 16h31.87v288H34a16 16 0 0 0-16 16v48a16 16 0 0 0 16 16h209.32c70.8 0 134.14-51.75 141-122.4 4.74-48.45-16.39-92.06-50.83-119.6zM145.66 112h87.76a48 48 0 0 1 0 96h-87.76zm87.76 288h-87.76V288h87.76a56 56 0 0 1 0 112z" class=""></path>\n                            </svg>\n                        ');
                        case"italic":
                            return '\n                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="'.concat(t, '">\n                                    <path fill="currentColor" d="M208 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h192a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm96-384H112a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h192a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z" class="opacity-40"></path>\n                                    <path fill="currentColor" d="M158.75 96h82.5l-80 320h-82.5z" class="fa-primary"></path>\n                                </svg>\n                            ');
                        case"laugh":
                            return '\n                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="'.concat(t, '">\n                                    <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm141.4 389.4c-37.8 37.8-88 58.6-141.4 58.6s-103.6-20.8-141.4-58.6S48 309.4 48 256s20.8-103.6 58.6-141.4S194.6 56 248 56s103.6 20.8 141.4 58.6S448 202.6 448 256s-20.8 103.6-58.6 141.4zM328 224c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm-160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm194.4 64H133.6c-8.2 0-14.5 7-13.5 15 7.5 59.2 58.9 105 121.1 105h13.6c62.2 0 113.6-45.8 121.1-105 1-8-5.3-15-13.5-15z" class=""></path>\n                                </svg>\n                            ');
                        case"links":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                                <path fill="currentColor" d="M44.45 252.59l37.11-37.1c9.84-9.84 26.78-3.3 27.29 10.6a184.45 184.45 0 0 0 9.69 52.72 16.08 16.08 0 0 1-3.78 16.61l-13.09 13.09c-28 28-28.9 73.66-1.15 102a72.07 72.07 0 0 0 102.32.51L270 343.79A72 72 0 0 0 270 242a75.64 75.64 0 0 0-10.34-8.57 16 16 0 0 1-6.95-12.6A39.86 39.86 0 0 1 264.45 191l21.06-21a16.06 16.06 0 0 1 20.58-1.74A152.05 152.05 0 0 1 327 400l-.36.37-67.2 67.2c-59.27 59.27-155.7 59.26-215 0s-59.26-155.72.01-214.98z" class="opacity-40"></path>\n                                <path fill="currentColor" d="M410.33 203.49c28-28 28.9-73.66 1.15-102a72.07 72.07 0 0 0-102.32-.49L242 168.21A72 72 0 0 0 242 270a75.64 75.64 0 0 0 10.34 8.57 16 16 0 0 1 6.94 12.6A39.81 39.81 0 0 1 247.55 321l-21.06 21.05a16.07 16.07 0 0 1-20.58 1.74A152.05 152.05 0 0 1 185 112l.36-.37 67.2-67.2c59.27-59.27 155.7-59.26 215 0s59.27 155.7 0 215l-37.11 37.1c-9.84 9.84-26.78 3.3-27.29-10.6a184.45 184.45 0 0 0-9.69-52.72 16.08 16.08 0 0 1 3.78-16.61z" class="fa-primary"></path>\n                            </svg>\n                        ');
                        case"quote":
                            return '\n                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M176 32H48A48 48 0 0 0 0 80v128a48 48 0 0 0 48 48h80v64a64.06 64.06 0 0 1-64 64h-8a23.94 23.94 0 0 0-24 23.88V456a23.94 23.94 0 0 0 23.88 24H64a160 160 0 0 0 160-160V80a48 48 0 0 0-48-48z" class="opacity-40"></path>\n                               <path fill="currentColor" d="M464 32H336a48 48 0 0 0-48 48v128a48 48 0 0 0 48 48h80v64a64.06 64.06 0 0 1-64 64h-8a23.94 23.94 0 0 0-24 23.88V456a23.94 23.94 0 0 0 23.88 24H352a160 160 0 0 0 160-160V80a48 48 0 0 0-48-48z" class="fa-primary"></path>\n                           </svg>\n                        ');
                        case"code":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M422.12 18.16a12 12 0 0 1 8.2 14.9l-136.5 470.2a12 12 0 0 1-14.89 8.2l-61-17.7a12 12 0 0 1-8.2-14.9l136.5-470.2a12 12 0 0 1 14.89-8.2z" class="opacity-40"></path>\n                               <path fill="currentColor" d="M636.23 247.26l-144.11-135.2a12.11 12.11 0 0 0-17 .5L431.62 159a12 12 0 0 0 .81 17.2L523 256l-90.59 79.7a11.92 11.92 0 0 0-.81 17.2l43.5 46.4a12 12 0 0 0 17 .6l144.11-135.1a11.94 11.94 0 0 0 .02-17.54zm-427.8-88.2l-43.5-46.4a12 12 0 0 0-17-.5l-144.11 135a11.94 11.94 0 0 0 0 17.5l144.11 135.1a11.92 11.92 0 0 0 17-.5l43.5-46.4a12 12 0 0 0-.81-17.2L117 256l90.6-79.7a11.92 11.92 0 0 0 .83-17.24z" class="fa-primary"></path>\n                            </svg>\n                        ');
                        case"images":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M424.49 120.48a12 12 0 0 0-17 0L272 256l-39.51-39.52a12 12 0 0 0-17 0L160 272v48h352V208zM64 336V128H48a48 48 0 0 0-48 48v256a48 48 0 0 0 48 48h384a48 48 0 0 0 48-48v-16H144a80.09 80.09 0 0 1-80-80z" class="opacity-40"></path>\n                               <path fill="currentColor" d="M528 32H144a48 48 0 0 0-48 48v256a48 48 0 0 0 48 48h384a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48zM208 80a48 48 0 1 1-48 48 48 48 0 0 1 48-48zm304 240H160v-48l55.52-55.52a12 12 0 0 1 17 0L272 256l135.52-135.52a12 12 0 0 1 17 0L512 208z" class="fa-primary"></path>\n                            </svg>\n                        ');
                        case"list_ol":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M496 224H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z" class="opacity-40"></path>\n                               <path fill="currentColor" d="M61.77 401l17.5-20.15a19.92 19.92 0 0 0 5.07-14.19v-3.31C84.34 356 80.5 352 73 352H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h22.83a157.41 157.41 0 0 0-11 12.31l-5.61 7c-4 5.07-5.25 10.13-2.8 14.88l1.05 1.93c3 5.76 6.29 7.88 12.25 7.88h4.73c10.33 0 15.94 2.44 15.94 9.09 0 4.72-4.2 8.22-14.36 8.22a41.54 41.54 0 0 1-15.47-3.12c-6.49-3.88-11.74-3.5-15.6 3.12l-5.59 9.31c-3.72 6.13-3.19 11.72 2.63 15.94 7.71 4.69 20.38 9.44 37 9.44 34.16 0 48.5-22.75 48.5-44.12-.03-14.38-9.12-29.76-28.73-34.88zM16 160h64a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H64V40a8 8 0 0 0-8-8H32a8 8 0 0 0-7.14 4.42l-8 16A8 8 0 0 0 24 64h8v64H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8zm-3.91 160H80a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H41.32c3.29-10.29 48.34-18.68 48.34-56.44 0-29.06-25-39.56-44.47-39.56-21.36 0-33.8 10-40.46 18.75-4.37 5.59-3 10.84 2.8 15.37l8.58 6.88c5.61 4.56 11 2.47 16.12-2.44a13.44 13.44 0 0 1 9.46-3.84c3.33 0 9.28 1.56 9.28 8.75C51 248.19 0 257.31 0 304.59v4C0 316 5.08 320 12.09 320z" class="fa-primary"></path>\n                            </svg>\n                        ');
                        case"list_ul":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M496 384H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z" class="opacity-40"></path>\n                               <path fill="currentColor" d="M48 48a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48z" class="fa-primary"></path>\n                            </svg>\n                        ');
                        case"heading":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M448 96v320h32a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16H320a16 16 0 0 1-16-16v-32a16 16 0 0 1 16-16h32V288H160v128h32a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16H32a16 16 0 0 1-16-16v-32a16 16 0 0 1 16-16h32V96H32a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16h-32v128h192V96h-32a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16z" class=""></path>\n                            </svg>\n                        ');
                        case"align_center":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M108.1 96h231.81A12.09 12.09 0 0 0 352 83.9V44.09A12.09 12.09 0 0 0 339.91 32H108.1A12.09 12.09 0 0 0 96 44.09V83.9A12.1 12.1 0 0 0 108.1 96zm231.81 256A12.09 12.09 0 0 0 352 339.9v-39.81A12.09 12.09 0 0 0 339.91 288H108.1A12.09 12.09 0 0 0 96 300.09v39.81a12.1 12.1 0 0 0 12.1 12.1z" class="opacity-40"></path>\n                               <path fill="currentColor" d="M432 160H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0 256H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z" class="fa-primary"></path>\n                            </svg>\n                        ');
                        case"undo":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M255.545 8c-66.269.119-126.438 26.233-170.86 68.685L48.971 40.971C33.851 25.851 8 36.559 8 57.941V192c0 13.255 10.745 24 24 24h134.059c21.382 0 32.09-25.851 16.971-40.971l-41.75-41.75c30.864-28.899 70.801-44.907 113.23-45.273 92.398-.798 170.283 73.977 169.484 169.442C423.236 348.009 349.816 424 256 424c-41.127 0-79.997-14.678-110.63-41.556-4.743-4.161-11.906-3.908-16.368.553L89.34 422.659c-4.872 4.872-4.631 12.815.482 17.433C133.798 479.813 192.074 504 256 504c136.966 0 247.999-111.033 248-247.998C504.001 119.193 392.354 7.755 255.545 8z" class=""></path>\n                            </svg>\n                        ');
                        case"redo":
                            return '\n                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                               <path fill="currentColor" d="M256.455 8c66.269.119 126.437 26.233 170.859 68.685l35.715-35.715C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.75c-30.864-28.899-70.801-44.907-113.23-45.273-92.398-.798-170.283 73.977-169.484 169.442C88.764 348.009 162.184 424 256 424c41.127 0 79.997-14.678 110.629-41.556 4.743-4.161 11.906-3.908 16.368.553l39.662 39.662c4.872 4.872 4.631 12.815-.482 17.433C378.202 479.813 319.926 504 256 504 119.034 504 8.001 392.967 8 256.002 7.999 119.193 119.646 7.755 256.455 8z" class=""></path>\n                            </svg>\n                        ');
                        case"icons":
                            return '\n                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                       <path fill="currentColor" d="M116.65 219.35a15.68 15.68 0 0 0 22.65 0l96.75-99.83c28.15-29 26.5-77.1-4.91-103.88C203.75-7.7 163-3.5 137.86 22.44L128 32.58l-9.85-10.14C93.05-3.5 52.25-7.7 24.86 15.64c-31.41 26.78-33 74.85-5 103.88zm143.92 100.49h-48l-7.08-14.24a27.39 27.39 0 0 0-25.66-17.78h-71.71a27.39 27.39 0 0 0-25.66 17.78l-7 14.24h-48A27.45 27.45 0 0 0 0 347.3v137.25A27.44 27.44 0 0 0 27.43 512h233.14A27.45 27.45 0 0 0 288 484.55V347.3a27.45 27.45 0 0 0-27.43-27.46zM144 468a52 52 0 1 1 52-52 52 52 0 0 1-52 52zm355.4-115.9h-60.58l22.36-50.75c2.1-6.65-3.93-13.21-12.18-13.21h-75.59c-6.3 0-11.66 3.9-12.5 9.1l-16.8 106.93c-1 6.3 4.88 11.89 12.5 11.89h62.31l-24.2 83c-1.89 6.65 4.2 12.9 12.23 12.9a13.26 13.26 0 0 0 10.92-5.25l92.4-138.91c4.88-6.91-1.16-15.7-10.87-15.7zM478.08.33L329.51 23.17C314.87 25.42 304 38.92 304 54.83V161.6a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V99.66l112-17.22v47.18a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V32c0-19.48-16-34.42-33.92-31.67z" class=""></path>\n                    </svg>\n                ');
                        case"frog":
                            return '\n                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="'.concat(t, '">\n                       <path fill="currentColor" d="M576 189.94c0-21.4-11.72-40.95-30.48-51.23-28.68-15.71-65.94-29.69-85.51-36.62C448.64 61.74 411.98 32 368 32c-42.97 0-78.91 28.42-91.16 67.35C120.27 120.52-.49 254.49 0 416.98.11 451.89 29.08 480 64 480h304c8.84 0 16-7.16 16-16 0-17.67-14.33-32-32-32h-29.74l18.87-25.48c9.29-13.93 14.7-29.24 17.15-44.82L469.62 480H560c8.84 0 16-7.16 16-16 0-17.67-14.33-32-32-32h-53.63l-98.52-104.68 154.44-86.65A58.183 58.183 0 0 0 576 189.94zm-53.19 8.87l-174.79 96.05c-7.56-15.39-18.32-29.45-32.92-40.4-39.66-29.72-95-29.75-134.72 0l-34.78 26.09c-10.59 7.95-12.75 23-4.78 33.61 7.97 10.59 23 12.77 33.59 4.8l34.78-26.09c22.72-17.08 54.44-17.02 77.09 0 27.28 20.45 33.81 58.67 15.59 86.06L262.56 432H64c-8.65 0-15.97-6.95-16-15.17-.41-135.69 100.74-251.73 235.27-269.92l30.21-4.08 9.15-29.08C328.98 93.56 347.21 80 368 80c21.15 0 39.99 14.43 45.81 35.1l6.74 23.93 23.44 8.3c18.33 6.49 52.91 19.47 78.47 33.47 3.47 1.9 5.54 5.32 5.54 9.14 0 3.67-1.99 7.07-5.19 8.87zM368 120c-13.25 0-24 10.74-24 24 0 13.25 10.75 24 24 24s24-10.75 24-24c0-13.26-10.75-24-24-24z" class=""></path>\n                    </svg>\n                ');
                        case"flower_daffodil":
                            return '\n                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="'.concat(t, '">\n                       <path fill="currentColor" d="M495.87 288h-47.26c-67.45 0-127.49 30-168.61 77v-82a90.52 90.52 0 0 0 102.53-139A89.43 89.43 0 0 0 400 90.67 90.76 90.76 0 0 0 309.34 0 89.39 89.39 0 0 0 256 17.47 89.4 89.4 0 0 0 202.65 0 90.75 90.75 0 0 0 112 90.67 89.43 89.43 0 0 0 129.47 144 89.43 89.43 0 0 0 112 197.33a90.48 90.48 0 0 0 120 85.72v82c-41.12-47-101.16-77-168.6-77H16.13c-9.19 0-17 9-16.06 19.65C10.06 422.15 106.43 512 223.83 512h64.34c117.4 0 213.77-89.85 223.76-204.35.92-10.65-6.87-19.65-16.06-19.65zm-272 176c-79.54 0-148.7-54.09-169.91-128 75.25 0 128.67 32.21 160.93 85.92L240.13 464zm12.92-241.37a42.48 42.48 0 1 1-59.38-59.38L203.19 144l-25.82-19.25A42.27 42.27 0 0 1 160 90.67 42.7 42.7 0 0 1 202.65 48a42.26 42.26 0 0 1 34.1 17.38L256 91.2l19.25-25.82A42.24 42.24 0 0 1 309.34 48 42.71 42.71 0 0 1 352 90.67a42.28 42.28 0 0 1-17.38 34.08L308.81 144l25.81 19.25A42.28 42.28 0 0 1 352 197.33 42.71 42.71 0 0 1 309.34 240a42.26 42.26 0 0 1-34.09-17.37L256 196.8zM288 464h-16.13l25.28-42.08c32.07-53.4 85.3-85.92 160.93-85.92-21.22 73.91-90.39 128-170.08 128zm0-320a32 32 0 1 0-32 32 32 32 0 0 0 32-32z" class=""></path>\n                    </svg>\n                ');
                        case"lightbulb":
                            return '\n                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="'.concat(t, '">\n                       <path fill="currentColor" d="M96.06 454.35c.01 6.29 1.87 12.45 5.36 17.69l17.09 25.69a31.99 31.99 0 0 0 26.64 14.28h61.71a31.99 31.99 0 0 0 26.64-14.28l17.09-25.69a31.989 31.989 0 0 0 5.36-17.69l.04-38.35H96.01l.05 38.35zM0 176c0 44.37 16.45 84.85 43.56 115.78 16.52 18.85 42.36 58.23 52.21 91.45.04.26.07.52.11.78h160.24c.04-.26.07-.51.11-.78 9.85-33.22 35.69-72.6 52.21-91.45C335.55 260.85 352 220.37 352 176 352 78.61 272.91-.3 175.45 0 73.44.31 0 82.97 0 176zm176-80c-44.11 0-80 35.89-80 80 0 8.84-7.16 16-16 16s-16-7.16-16-16c0-61.76 50.24-112 112-112 8.84 0 16 7.16 16 16s-7.16 16-16 16z" class=""></path>\n                    </svg>\n                ')
                    }
                }

                var d = {
                    bold: "تاکید",
                    boldexample: "متن تاکیدی",
                    italic: "تاکید",
                    italicexample: "متن تاکیدی",
                    emoji: "ایموجی",
                    link: "لینک",
                    linkdescription: "عنوان لینک مورد نظر",
                    linkdialog: "<strong class='text-lg dark:text-white'>اضافه کردن لینک</strong><p class='text-gray-500 dark:text-gray-200'>لطفا لینک مورد نظر خورد را وارد کنید</p>",
                    quote: "نقل قول",
                    quoteexample: "نقل قول",
                    code: "قرار دادن کد",
                    codeexample: "کد خود را اینجا وارد کنید",
                    image: "آپلود تصویر",
                    imagedescription: " تصویر",
                    imagedialog: "<strong class='text-lg dark:text-white'>آپلود تصویر</strong><p class='text-gray-500 dark:text-gray-200'>پسوند‌های مجاز :‌ jpg , jpeg , png</p>",
                    olist: "لیست شماره‌ای",
                    ulist: "لیست",
                    litem: "لیست آیتم",
                    heading: "عنوان",
                    headingexample: "عنوان",
                    hr: "خط جدا کننده",
                    undo: "عقب",
                    redo: "جلو",
                    redomac: "جلو",
                    ok: "ثبت",
                    cancel: "انصراف"
                };
                window.Editor = function (t, n, r) {
                    if (void 0 === t && "object" !== e(t)) throw Error("please select and insert textarea");
                    if (void 0 === n && "object" !== e(n)) throw Error("please select and insert btns bar");
                    "function" == typeof (r = r || {}).handler && (r = {helpButton: r}), r.strings = r.strings || {}, r.helpButton && (r.strings.help = r.strings.help || r.helpButton.title);
                    var o, a = function (e) {
                        return r.strings[e] || d[e]
                    };
                    this.run = function () {
                        if (!o) {
                            o = new h(t, n);
                            var e, s, l = new v(a, r.wrapImageInLink, r.convertImagesToLinks);
                            /\?noundo/.test(i.location.href) || (e = new f((function () {
                                s && s.setUndoRedoButtonStates()
                            }), o), this.textOperation = function (t) {
                                e.setCommandMode(), t()
                            }), (s = new m("", o, e, l, a)).setUndoRedoButtonStates()
                        }
                    }
                };

                function p() {
                }

                function h(e, t) {
                    this.buttonBar = t, this.input = e
                }

                function f(e, n) {
                    var r, i, o, a = this, s = [], c = 0, u = "none", d = function (e, t) {
                        u != e && (u = e, t || h()), l && "moving" == u ? o = null : i = setTimeout(p, 1)
                    }, p = function (e) {
                        o = new g(n, e), i = void 0
                    };
                    this.setCommandMode = function () {
                        u = "command", h(), i = setTimeout(p, 0)
                    }, this.canUndo = function () {
                        return c > 1
                    }, this.canRedo = function () {
                        return !!s[c + 1]
                    }, this.undo = function () {
                        a.canUndo() && (r ? (r.restore(), r = null) : (s[c] = new g(n), s[--c].restore(), e && e())), u = "none", n.input.focus(), p()
                    }, this.redo = function () {
                        a.canRedo() && (s[++c].restore(), e && e()), u = "none", n.input.focus(), p()
                    };
                    var h = function () {
                        var t = o || new g(n);
                        if (!t) return !1;
                        "moving" != u ? (r && (s[c - 1].text != r.text && (s[c++] = r), r = null), s[c++] = t, s[c + 1] = null, e && e()) : r || (r = t)
                    }, f = function (e) {
                        var t = !1;
                        if ((e.ctrlKey || e.metaKey) && !e.altKey) {
                            var n = e.charCode || e.keyCode;
                            switch (String.fromCharCode(n).toLowerCase()) {
                                case"y":
                                    a.redo(), t = !0;
                                    break;
                                case"z":
                                    e.shiftKey ? a.redo() : a.undo(), t = !0
                            }
                        }
                        if (t) return e.preventDefault && e.preventDefault(), void (window.event && (window.event.returnValue = !1))
                    }, m = function (e) {
                        if (!e.ctrlKey && !e.metaKey) {
                            var t = e.keyCode;
                            t >= 33 && t <= 40 || t >= 63232 && t <= 63235 ? d("moving") : 8 == t || 46 == t || 127 == t ? d("deleting") : 13 == t ? d("newlines") : 27 == t ? d("escape") : (t < 16 || t > 20) && 91 != t && d("typing")
                        }
                    };
                    !function () {
                        t.addEvent(n.input, "keypress", (function (e) {
                            !e.ctrlKey && !e.metaKey || e.altKey || 89 != e.keyCode && 90 != e.keyCode || e.preventDefault()
                        }));
                        var e = function () {
                            (l || o && o.text != n.input.value) && null == i && (u = "paste", h(), p())
                        };
                        t.addEvent(n.input, "keydown", f), t.addEvent(n.input, "keydown", m), t.addEvent(n.input, "mousedown", (function () {
                            d("moving")
                        })), n.input.onpaste = e, n.input.ondrop = e
                    }(), p(!0), h()
                }

                function g(e, n) {
                    var r = this, o = e.input;
                    this.init = function () {
                        t.isVisible(o) && (!n && i.activeElement && i.activeElement !== o || (this.setInputAreaSelectionStartEnd(), this.scrollTop = o.scrollTop, (!this.text && o.selectionStart || 0 === o.selectionStart) && (this.text = o.value)))
                    }, this.setInputAreaSelection = function () {
                        if (t.isVisible(o)) if (void 0 === o.selectionStart || c) {
                            if (i.selection) {
                                if (i.activeElement && i.activeElement !== o) return;
                                o.focus();
                                var e = o.createTextRange();
                                e.moveStart("character", -o.value.length), e.moveEnd("character", -o.value.length), e.moveEnd("character", r.end), e.moveStart("character", r.start), e.select()
                            }
                        } else o.focus(), o.selectionStart = r.start, o.selectionEnd = r.end, o.scrollTop = r.scrollTop
                    }, this.setInputAreaSelectionStartEnd = function () {
                        if (e.ieCachedRange || !o.selectionStart && 0 !== o.selectionStart) {
                            if (i.selection) {
                                r.text = t.fixEolChars(o.value);
                                var n = e.ieCachedRange || i.selection.createRange(), a = t.fixEolChars(n.text),
                                    s = "", l = s + a + s;
                                n.text = l;
                                var c = t.fixEolChars(o.value);
                                n.moveStart("character", -l.length), n.text = a, r.start = c.indexOf(s), r.end = c.lastIndexOf(s) - s.length;
                                var u = r.text.length - t.fixEolChars(o.value).length;
                                if (u) {
                                    for (n.moveStart("character", -a.length); u--;) a += "\n", r.end += 1;
                                    n.text = a
                                }
                                e.ieCachedRange && (r.scrollTop = e.ieCachedScrollTop), e.ieCachedRange = null, this.setInputAreaSelection()
                            }
                        } else r.start = o.selectionStart, r.end = o.selectionEnd
                    }, this.restore = function () {
                        null != r.text && r.text != o.value && (o.value = r.text), this.setInputAreaSelection(), o.scrollTop = r.scrollTop
                    }, this.getChunks = function () {
                        var e = new p;
                        return e.before = t.fixEolChars(r.text.substring(0, r.start)), e.startTag = "", e.selection = t.fixEolChars(r.text.substring(r.start, r.end)), e.endTag = "", e.after = t.fixEolChars(r.text.substring(r.end)), e.scrollTop = r.scrollTop, e
                    }, this.setChunks = function (e) {
                        e.before = e.before + e.startTag, e.after = e.endTag + e.after, this.start = e.before.length, this.end = e.before.length + e.selection.length, this.text = e.before + e.selection + e.after, this.scrollTop = e.scrollTop
                    }, this.init()
                }

                function m(e, t, n, r, o) {
                    var s = t.input, l = {};

                    function c(e) {
                        if (s.focus(), e.textOp) {
                            n && n.setCommandMode();
                            var r = new g(t);
                            if (!r) return;
                            var i = r.getChunks(), o = function () {
                                s.focus(), i && r.setChunks(i), r.restore()
                            };
                            e.textOp(i, o) || o()
                        }
                        e.execute && e.execute(n)
                    }

                    function d(e, t) {
                        t ? (e.querySelector("span:first-child svg").classList.remove("!text-gray-400"), e.querySelector("span:first-child") && (e.querySelector("span:first-child").onclick = function () {
                            return c(e), !1
                        })) : e.querySelector("span:first-child svg").classList.add("!text-gray-400")
                    }

                    function p(e) {
                        return "string" == typeof e && (e = r[e]), function () {
                            e.apply(r, arguments)
                        }
                    }

                    function h() {
                        n && (d(l.undo, n.canUndo()), d(l.redo, n.canRedo()))
                    }

                    !function () {
                        var e = t.buttonBar, n = document.createElement("ul");
                        n.className = " flex flex-wrap flex-row-reverse sm:justify-end  bg-gray-500 bg-opacity-5 sm:py-3 pt-3 md:px-4 px-2 flex-wrap sm:mb-0  sm:space-x-3 rounded-md dark:bg-dark-900", n = e.appendChild(n);
                        var r = function (e, t, r) {
                            var o = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : null,
                                a = document.createElement("li");
                            a.className = "cursor-pointer relative flex justify-4o....................................................... sm:mb-0 mb-3 items-center sm:w-fit-content w-30", o && (a.id = o);
                            var s = document.createElement("span");
                            s.innerHTML = t;
                            var l = i.createElement("div");
                            l.className = "absolute top-6 left-0 right-0 flex justify-center hidden z-40";
                            var c = i.createElement("div");
                            return c.innerText = e, c.classList.add("text-biscay-700", "bg-gray-80", "whitespace-nowrap", "rounded", "text-sm", "px-1"), l.appendChild(c), s.addEventListener("mouseenter", (function () {
                                l.classList.remove("hidden")
                            })), s.addEventListener("mouseleave", (function () {
                                l.classList.add("hidden")
                            })), a.appendChild(s), a.appendChild(l), r && (a.textOp = r), d(a, !0), n.appendChild(a), a
                        }, s = function (e) {
                            var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                                r = document.createElement("li");
                            r.className = "sm:border-r border-solid border-biscay-700", t && r.classList.add("hidden", "sm:flex"), n.appendChild(r)
                        };
                        l.bold = r(o("bold"), u("bold", "w-3 text-biscay-700 hover:text-biscay-500  dark:text-white"), p("doBold")), l.italic = r(o("italic"), u("italic", "w-3 text-biscay-700 hover:text-biscay-500  dark:text-white"), p("doItalic")), l.emoji = r(o("emoji"), u("laugh", "w-4 text-biscay-700 hover:text-biscay-500  dark:text-white"), p((function (e, t) {
                            return function (e) {
                                var t, n;
                                if (i.querySelector("body").addEventListener("click", (function (e) {
                                    if (!e.target.closest("#emoji")) {
                                        var n = Object.values(e.path).filter((function (e) {
                                            return e === t
                                        })).length;
                                        n || (t.classList.remove("flex"), t.classList.add("hidden"))
                                    }
                                })), e.querySelector("#emoji-group")) (t = e.querySelector("#emoji-group")).classList.contains("flex") ? (t.classList.remove("flex"), t.classList.add("hidden")) : (t.classList.add("flex"), t.classList.remove("hidden")); else {
                                    (t = i.createElement("div")).className = "ltr active emoji-group absolute dark:bg-dark-890 bg-white  top-8 -left-12 shadow flex-wrap overflow-hidden flex -ml-4 z-20", t.id = "emoji-group";
                                    var r = "laugh", o = {
                                        laugh: "😀 😁 😂 🤣 😃 😄 😅 😆 😉 😊 😋 😎 😍 😘 😗 😙 😚 🙂 🤗 🤩 🤔 🤨 😐 😑 😶 🙄 😏 😣 😥 😮 🤐 😯 😪 😫 😴 😌 😛 😜 😝 🤤 😒 😓 😔 😕 🙃 🤑 😲 🙁 😖 😞 😟 😤 😢 😭 😦 😧 😨 😩 🤯 😬 😰 😱 😳 🤪 😵 😡 😠 🤬 😷 🤒 🤕 🤢 🤮 🤧 😇 🤠 🤡 🤥 🤫 🤭 🧐 🤓 😈 👿 👹 👺 💀 👻 👽 🤖 💩 😺 😸 😹 😻 😼 😽 🙀 😿 😾 👐 🙌 👏 🤝 👍 👎 👊 ✊ 🤛 🤜 🤞 ✌️ 🤟 🤘 👌 👈 👉 👆 👇 ☝️ ✋ 🤚 🖐 🖖 👋 🤙 💪 ✍️ 🙏 👅 👂 👀 👤 👥",
                                        frog: "🐶 🐱 🐭 🐹 🐰 🦊 🐻 🐼 🐨 🐯 🦁 🐮 🐷 🐽 🐸 🐵 🙈 🙉 🙊 🐒 🐔 🐧 🐦 🐤 🐣 🐥 🦆 🦅 🦉 🦇 🐺 🐗 🐴 🦄 🐝 🐛 🦋 🐌 🐚 🐞 🐜 🦗 🕷 🕸 🦂 🐢 🐍 🦎 🦖 🦕 🐙 🦑 🦐 🦀 🐡 🐠 🐟 🐬 🐳 🐋 🦈 🐊 🐅 🐆 🦓 🦍 🐘 🦏 🐪 🐫 🦒 🐃 🐂 🐄 🐎 🐖 🐏 🐑 🐐 🦌 🐕 🐩 🐈 🐓 🦃 🐇 🐁 🐀 🦔 🐾 🐉 🐲",
                                        flower_daffodil: "🌵 🎄 🌲 🌳 🌴 🌱 🌿 ☘️ 🍀 🎍 🎋 🍃 🍂 🍁 🍄 🌾 💐 🌷 🌹 🥀 🌺 🌸 🌼 🌻 🌞 🌝 🌛 🌜 🌚 🌕 🌖 🌗 🌘 🌑 🌒 🌓 🌔 🌙 🌎 🌍 🌏 💫 ⭐️ 🌟 ✨ ⚡️ ☄️ 💥 🔥 🌈 ☀️ ⛅️ ☁️ ❄️ ☃️ ⛄️ 💨 💧 💦 ☔️ ☂️ 🌊",
                                        icons: "❤️ 🧡 💛 💚 💙 💜 🖤 💔 ❣️ 💕 💞 💓 💗 💖 💘 💝 💟 ☮️ ✝️ ☪️ ☸️ ☯️ ☦️ 🛐 ⛎ ♈️ ♉️ ♊️ ♋️ ♌️ ♍️ ♎️ ♏️ ♐️ ♑️ ♒️ ♓️ 🆔 ⚛️ 🉑 ☢️ ☣️ 📴 📳 🈶 🈚️ 🈸 🈺 🈷️ ✴️ 🆚 💮 🉐 ㊙️ ㊗️ 🈴 🈵 🈹 🈲 🅰️ 🅱️ 🆎 🆑 🅾️ 🆘 ❌ ⭕️ 🛑 ⛔️ 📛 🚫 💯 💢 ♨️ 🚷 🚯 🚳 🚱 🔞 📵 🚭 ❗️ ❕ ❓ ❔ ‼️ ⁉️ 🔅 🔆 〽️ ⚠️ 🚸 🔱 ⚜️ 🔰 ♻️ ✅ 🈯️ 💹 ❇️ ✳️ ❎ 🌐 💠 Ⓜ️ 🌀 💤 🏧 🚾 ♿️ 🅿️ 🈳 🈂️ 🛂 🛃 🛄 🛅 🚹 🚺 🚼 🚻 🚮 🎦 📶 🈁 🔣️ 🔤 🔡 🔠 🆖 🆗 🆙 🆒 🆕 🆓 0️⃣ 1️⃣ 2️⃣ 3️⃣ 4️⃣ 5️⃣ 6️⃣ 7️⃣ 8️⃣ 9️⃣ 🔟 🔢 #️⃣ *️⃣ ⏏️ ▶️ ⏸ ⏯ ⏹ ⏺ ⏭ ⏮ ⏩ ⏪ ⏫ ⏬ ◀️ ↕️ ↔️ ↪️ ↩️ ⤴️ ⤵️ 🔀 🔁 🔂 🔄 🔃 ☑️ 🔘 ⚪️ ⚫️ 🔴 🔵 🔺 🔻 🔸 🔹 🔶 🔷 🔳 🔲 🔈 🔇 🔉 🔊 🔔 🔕 📣 📢 👁‍🗨 💬 💭 🃏 🎴 🀄️ 🕐 🕑 🕒 🕓 🕔 🕕 🕖 🕗 🕘 🕙 🕚 🕛 🕜 🕝 🕞 🕟 🕠 🕡 🕢 🕣 🕤 🕥 🕦 🕧",
                                        lightbulb: "⌚️ 📱 📲 💻 ⌨️ 💽 💾 💿 📀 📼 📷 📸 📹 🎥 📞 ☎️ 📟 📠 📺 📻 ⏱ ⏲ ⏰ ⌛️ ⏳ 📡 🔋 🔌 💡 🔦 💸 💵 💴 💶 💷 💰 💳 🧾 💎 ⚖️ 🔧 🔨 🔩 ⚙️ 🔫 💣 🔪 ⚔️ 🚬 ⚰️ ⚱️ 🏺 🔮 📿 💈 ⚗️ 🔭 🔬 💊 💉 🚽 🚰 🚿 🛁 🛀 🛀🏻 🛀🏼 🛀🏽 🛀🏾 🛀🏿 🔑 🚪 🛌 🛒 🎁 🎈 🎏 🎀 🎊 🎉 🎎 🏮 🎐 ✉️ 📩 📨 📧 💌 📥 📤 📦 📪 📫 📬 📭 📮 📯 📜 📃 📄 📑 📊 📈 📉 📆 📅 📇 📋 📁 📂 🗂 📓 📔 📒 📕 📗 📘 📙 📚 📖 🔖 🔗 📎 📐 📏 📌 📍 ✂️ 📝 ✏️ 🔍 🔎 🔏 🔐 🔒 🔓"
                                    }, a = i.createElement("div");
                                    a.className = "flex items-center p-2 w-full dark:bg-dark-890 bg-gray-200 space-x-2 emoji-head-tabs text-biscay-500", Object.keys(o).forEach((function (e) {
                                        var t = i.createElement("div");
                                        t.classList.add("head-tab"), t.addEventListener("click", (function () {
                                            var t = this.parentElement.querySelector(".head-tab.active");
                                            t && t.classList.remove("active", "!text-blue-700");
                                            var n = i.querySelector(".emoji-group .emoji-lists .emoji-lists--item.active");
                                            n && (n.classList.remove("active"), n.classList.add("hidden")), a.scroll(0, 0), this.classList.add("active", "!text-blue-700"), i.querySelector(".emoji-group .emoji-lists .emoji-lists--item[data-name='".concat(e, "']")).classList.add("active"), i.querySelector(".emoji-group .emoji-lists .emoji-lists--item[data-name='".concat(e, "']")).classList.remove("hidden")
                                        })), r === e && t.classList.add("active", "!text-blue-600");
                                        var n = document.createElement("li");
                                        n.innerHTML = u(e, "frog" === e ? "w-5 dark:text-white" : "lightbulb" === e ? "w-3 dark:text-white" : "w-4 dark:text-white"), t.appendChild(n), a.appendChild(t)
                                    })), t.appendChild(a), (n = i.createElement("div")).className = "emoji-lists justify-center p-2 max-h-40 overflow-y-auto w-52", Object.entries(o).forEach((function (e) {
                                        var t = i.createElement("div");
                                        t.classList.add("hidden", "flex", "flex-wrap", "emoji-lists--item"), t.setAttribute("data-name", e[0]), e[1].split(" ").forEach((function (e) {
                                            var n = i.createElement("span");
                                            n.innerText = e, n.textOp = function (t, n) {
                                                t.trimWhitespace(), t.selection = "", t.before = t.before + e
                                            }, n.addEventListener("click", (function () {
                                                c(this)
                                            })), t.appendChild(n)
                                        })), r === e[0] && (t.classList.remove("hidden"), t.classList.add("active")), n.appendChild(t)
                                    })), t.appendChild(n), e.appendChild(t)
                                }
                            }(l.emoji)
                        })), !1, "emoji"), s(1), l.link = r(o("link"), u("links", "w-4 text-biscay-700 hover:text-biscay-500 dark:text-white"), p((function (e, t) {
                            return this.doLinkOrImage(e, t, !1)
                        }))), l.quote = r(o("quote"), u("quote", "w-4 text-biscay-700 hover:text-biscay-500 dark:text-white"), p("doBlockquote")), l.code = r(o("code"), u("code", "w-5 text-biscay-700 hover:text-biscay-500 dark:text-white"), p("doCode")), l.image = r(o("image"), u("images", "w-5 text-biscay-700 hover:text-biscay-500 dark:text-white"), p((function (e, t) {
                            return this.doLinkOrImage(e, t, !0)
                        }))), s(2, !0), l.olist = r(o("olist"), u("list_ol", "w-5 text-biscay-700 hover:text-biscay-500 dark:text-white"), p((function (e, t) {
                            this.doList(e, t, !0)
                        })), !0), l.ulist = r(o("ulist"), u("list_ul", "w-5 text-biscay-700 hover:text-biscay-500 dark:text-white"), p((function (e, t) {
                            this.doList(e, t, !1)
                        })), !0), l.heading = r(o("heading"), u("heading", "w-4 text-biscay-700 hover:text-biscay-500 dark:text-white"), p("doHeading"), !0), l.hr = r(o("hr"), u("align_center", "w-4 text-biscay-700 hover:text-biscay-500 dark:text-white"), p("doHorizontalRule"), !0), s(4, !0), l.undo = r(o("undo"), u("undo", "w-4 text-biscay-700 hover:text-biscay-500 dark:text-white"), null, !0), l.undo.execute = function (e) {
                            e && e.undo()
                        };
                        var f = /win/.test(a.platform.toLowerCase()) ? o("redo") : o("redomac");
                        l.redo = r(f, u("redo", "w-4 text-biscay-700 hover:text-biscay-500 dark:text-white"), null, !0), l.redo.execute = function (e) {
                            e && e.redo()
                        }, h()
                    }(), this.setUndoRedoButtonStates = h
                }

                function v(e, t, n) {
                    this.getString = e, this.wrapImageInLink = t, this.convertImagesToLinks = n
                }

                p.prototype.findTags = function (e, n) {
                    var r, i = this;
                    e && (r = t.extendRegExp(e, "", "$"), this.before = this.before.replace(r, (function (e) {
                        return i.startTag = i.startTag + e, ""
                    })), r = t.extendRegExp(e, "^", ""), this.selection = this.selection.replace(r, (function (e) {
                        return i.startTag = i.startTag + e, ""
                    }))), n && (r = t.extendRegExp(n, "", "$"), this.selection = this.selection.replace(r, (function (e) {
                        return i.endTag = e + i.endTag, ""
                    })), r = t.extendRegExp(n, "^", ""), this.after = this.after.replace(r, (function (e) {
                        return i.endTag = e + i.endTag, ""
                    })))
                }, p.prototype.trimWhitespace = function (e) {
                    var t, n, r = this;
                    e ? t = n = "" : (t = function (e) {
                        return r.before += e, ""
                    }, n = function (e) {
                        return r.after = e + r.after, ""
                    }), this.selection = this.selection.replace(/^(\s*)/, t).replace(/(\s*)$/, n)
                }, p.prototype.skipLines = function (e, t, n) {
                    var r, i;
                    if (void 0 === e && (e = 1), void 0 === t && (t = 1), e++, t++, navigator.userAgent.match(/Chrome/) && "X".match(/()./), this.selection = this.selection.replace(/(^\n*)/, ""), this.startTag = this.startTag + o.$1, this.selection = this.selection.replace(/(\n*$)/, ""), this.endTag = this.endTag + o.$1, this.startTag = this.startTag.replace(/(^\n*)/, ""), this.before = this.before + o.$1, this.endTag = this.endTag.replace(/(\n*$)/, ""), this.after = this.after + o.$1, this.before) {
                        for (r = i = ""; e--;) r += "\\n?", i += "\n";
                        n && (r = "\\n*"), this.before = this.before.replace(new o(r + "$", ""), i)
                    }
                    if (this.after) {
                        for (r = i = ""; t--;) r += "\\n?", i += "\n";
                        n && (r = "\\n*"), this.after = this.after.replace(new o(r, ""), i)
                    }
                }, t.isVisible = function (e) {
                    return window.getComputedStyle ? "none" !== window.getComputedStyle(e, null).getPropertyValue("display") : e.currentStyle ? "none" !== e.currentStyle.display : void 0
                }, t.addEvent = function (e, t, n) {
                    e.attachEvent ? e.attachEvent("on" + t, n) : e.addEventListener(t, n, !1)
                }, t.removeEvent = function (e, t, n) {
                    e.detachEvent ? e.detachEvent("on" + t, n) : e.removeEventListener(t, n, !1)
                }, t.fixEolChars = function (e) {
                    return e = (e = e.replace(/\r\n/g, "\n")).replace(/\r/g, "\n")
                }, t.extendRegExp = function (e, t, n) {
                    null == t && (t = ""), null == n && (n = "");
                    var r, i = e.toString();
                    return i = (i = i.replace(/\/([gim]*)$/, (function (e, t) {
                        return r = t, ""
                    }))).replace(/(^\/|\/$)/g, ""), new o(i = t + i + n, r)
                }, n.getTop = function (e, t) {
                    var n = e.offsetTop;
                    if (!t) for (; e = e.offsetParent;) n += e.offsetTop;
                    return n
                }, n.getHeight = function (e) {
                    return e.offsetHeight || e.scrollHeight
                }, n.getWidth = function (e) {
                    return e.offsetWidth || e.scrollWidth
                }, n.getPageSize = function () {
                    var e, t, n, r;
                    return self.innerHeight && self.scrollMaxY ? (e = i.body.scrollWidth, t = self.innerHeight + self.scrollMaxY) : i.body.scrollHeight > i.body.offsetHeight ? (e = i.body.scrollWidth, t = i.body.scrollHeight) : (e = i.body.offsetWidth, t = i.body.offsetHeight), self.innerHeight ? (n = self.innerWidth, r = self.innerHeight) : i.documentElement && i.documentElement.clientHeight ? (n = i.documentElement.clientWidth, r = i.documentElement.clientHeight) : i.body && (n = i.body.clientWidth, r = i.body.clientHeight), [Math.max(e, n), Math.max(t, r), n, r]
                }, r.createBackground = function () {
                    var e = i.createElement("div"), t = e.style;
                    e.className = "prompt-background", t.position = "absolute", t.top = "0", t.zIndex = "1000", l ? t.filter = "alpha(opacity=50)" : t.opacity = "0.5";
                    var r = n.getPageSize();
                    return t.height = r[1] + "px", l ? (t.left = i.documentElement.scrollLeft, t.width = i.documentElement.clientWidth) : (t.left = "0", t.width = "100%"), i.body.appendChild(e), e
                }, r.prompt = function (e, n, r, o, a, s) {
                    var l, c;
                    void 0 === r && (r = "");
                    var u = function (e) {
                        if (27 === (e.charCode || e.keyCode)) return e.stopPropagation && e.stopPropagation(), d(!0), !1
                    }, d = function (e) {
                        t.removeEvent(i.body, "keyup", u);
                        var n = c.value;
                        return e ? n = null : (n = n.replace(/^http:\/\/(https?|ftp):\/\//, "$1://"), /^(?:https?|ftp):\/\//.test(n) || (n = "http://" + n)), l.parentNode.removeChild(l), s(n), !1
                    };
                    setTimeout((function () {
                        "link" === n ? function (n, o) {
                            (l = i.createElement("div")).className = "fixed p-10 top-0 h-full w-full flex items-center justify-center bg-gray-900 bg-opacity-80 dark:bg-dark-940 dark:bg-opacity-80", l.style.zIndex = 1001;
                            var a = i.createElement("div");
                            a.className = "rounded-lg dark:bg-gray-900 bg-white p-4 w-9/12 md:w-7/12 lg:w-5/12 xl:w-4/12 overflow-hidden dark:bg-dark-900";
                            var s = i.createElement("div");
                            s.classList.add("mb-2"), s.innerHTML = e, a.appendChild(s);
                            var p = i.createElement("form");
                            p.onsubmit = function () {
                                return d(!1)
                            }, p.className = "flex flex-col space-y-4", a.appendChild(p), (c = i.createElement("input")).type = "text", c.value = r, c.className = "p-3 px-4 ltr border border-solid border-gray-200 rounded w-full focus:ring-1 focus:ring-gray-200 text-left dark:border-opacity-60 dark:bg-dark-890 dark:text-white", p.appendChild(c);
                            var h = i.createElement("div");
                            h.className = "space-x-4 space-x-reverse flex justify-end";
                            var f = i.createElement("button");
                            f.type = "button", f.onclick = function () {
                                return d(!1)
                            }, f.innerText = n, f.className = "bg-blue-500 hover:bg-blue-400 text-white p-2 px-4 font-medium rounded hover:text-white";
                            var g = i.createElement("button");
                            g.type = "button", g.onclick = function () {
                                return d(!0)
                            }, g.innerText = o, g.className = "cursor-pointer text-gray-400 hover:underline", h.appendChild(f), h.appendChild(g), p.appendChild(h), t.addEvent(i.body, "keyup", u), l.appendChild(a), i.body.appendChild(l)
                        }(o, a) : function (n, r) {
                            (l = i.createElement("div")).className = "fixed p-10 top-0 h-full w-full flex items-center justify-center bg-gray-900 bg-opacity-60 dark:bg-opacity-80 dark:bg-dark-940", l.style.zIndex = 1001;
                            var o = i.createElement("div");
                            o.className = "rounded-lg bg-white p-4 w-9/12 md:w-7/12 lg:w-5/12 xl:w-4/12 overflow-hidden dark:bg-dark-900";
                            var a = i.createElement("div");
                            a.className = "mb-2 border-b border-solid border-gray-200 pb-4 dark:border-opacity-10", a.innerHTML = e, o.appendChild(a);
                            var s = i.createElement("form");
                            s.onsubmit = function () {
                                return d(!1)
                            }, s.className = "flex flex-col space-y-4 pt-4", o.appendChild(s), (c = i.createElement("input")).style.display = "none";
                            var p = i.createElement("div");

                            function h(e) {
                                p.innerText = e, p.className = "block text-red-500 text-sm"
                            }

                            p.className = "hidden text-red-500 text-sm";
                            var f = i.createElement("div");
                            f.className = "space-x-4 space-x-reverse flex justify-end";
                            var g = i.createElement("button");
                            g.type = "button";
                            var m = !1;
                            g.onclick = function () {
                                if (1 !== v.files.length) p.innerText = "لطفا اول فایل تصویر رو انتخاب کنید و بعد روی آپلود کلیک کنید", p.classList.add("block"), p.classList.remove("hidden"); else if (!m) {
                                    m = !0, g.innerHTML = '\n                            <svg class="animate-spin w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">\n                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>\n                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>\n                            </svg>\n                        ';
                                    var e = new FormData;
                                    e.append("image", v.files[0]), axios.post("/user/upload", e).then((function (e) {
                                        c.value = e.data.url, window.dispatchEvent(new CustomEvent("editor-upload-image", {})), d(!1)
                                    })).catch((function (e) {
                                        if (m = !1, g.innerText = "آپلود", 422 === e.response.status) {
                                            var t = e.response.data.errors;
                                            t.image && h(t.image[0])
                                        } else h("مشکلی تو آپلود بود، نتونستیم فایلتونو آپلود کنیم! لطفا دوباره تست کنید")
                                    }))
                                }
                            }, g.innerText = "آپلود", g.className = "bg-blue-500 hover:bg-blue-400 text-white p-2 px-4 font-medium rounded hover:text-white";
                            var v = i.createElement("input");
                            v.classList.add("dark:text-white"), v.type = "file", v.accept = ".jpeg,.jpg,.png", s.appendChild(v), s.appendChild(c), s.appendChild(p);
                            var b = i.createElement("button");
                            b.type = "button", b.onclick = function () {
                                return d(!0)
                            }, b.innerText = r, b.className = "cursor-pointer text-gray-400 hover:underline", f.appendChild(g), f.appendChild(b), s.appendChild(f), t.addEvent(i.body, "keyup", u), l.appendChild(o), i.body.appendChild(l)
                        }(0, a);
                        var s = r.length;
                        if (void 0 !== c.selectionStart) c.selectionStart = 0, c.selectionEnd = s; else if (c.createTextRange) {
                            var p = c.createTextRange();
                            p.collapse(!1), p.moveStart("character", -s), p.moveEnd("character", s), p.select()
                        }
                        c.focus()
                    }), 0)
                };
                var b = v.prototype;
                b.prefixes = "(?:\\s{4,}|\\s*>|\\s*-\\s+|\\s*\\d+\\.|=|\\+|-|_|\\*|#|\\s*\\[[^\n]]+\\]:)", b.unwrap = function (e) {
                    var t = new o("([^\\n])\\n(?!(\\n|" + this.prefixes + "))", "g");
                    e.selection = e.selection.replace(t, "$1 $2")
                }, b.wrap = function (e, t) {
                    this.unwrap(e);
                    var n = new o("(.{1," + t + "})( +|$\\n?)", "gm"), r = this;
                    e.selection = e.selection.replace(n, (function (e, t) {
                        return new o("^" + r.prefixes, "").test(e) ? e : t + "\n"
                    })), e.selection = e.selection.replace(/\s+$/, "")
                }, b.doBold = function (e, t) {
                    return this.doBorI(e, t, 2, this.getString("boldexample"))
                }, b.doItalic = function (e, t) {
                    return this.doBorI(e, t, 1, this.getString("italicexample"))
                }, b.doBorI = function (e, t, n, r) {
                    e.trimWhitespace(), e.selection = e.selection.replace(/\n{2,}/g, "\n");
                    var i = /(\**$)/.exec(e.before)[0], a = /(^\**)/.exec(e.after)[0], s = Math.min(i.length, a.length);
                    if (s >= n && (2 != s || 1 != n)) e.before = e.before.replace(o("[*]{" + n + "}$", ""), ""), e.after = e.after.replace(o("^[*]{" + n + "}", ""), ""); else if (!e.selection && a) {
                        e.after = e.after.replace(/^([*_]*)/, ""), e.before = e.before.replace(/(\s?)$/, "");
                        var l = o.$1;
                        e.before = e.before + a + l
                    } else {
                        e.selection || a || (e.selection = r);
                        var c = n <= 1 ? "*" : "**";
                        e.before = e.before + c, e.after = c + e.after
                    }
                }, b.stripLinkDefs = function (e, t) {
                    return e = e.replace(/^[ ]{0,3}\[(\d+)\]:[ \t]*\n?[ \t]*<?(\S+?)>?[ \t]*\n?[ \t]*(?:(\n*)["(](.+?)[")][ \t]*)?(?:\n+|$)/gm, (function (e, n, r, i, o) {
                        return t[n] = e.replace(/\s*$/, ""), i ? (t[n] = e.replace(/["(](.+?)[")]$/, ""), i + o) : ""
                    }))
                }, b.addLinkDef = function (e, t) {
                    var n = 0, r = {};
                    e.before = this.stripLinkDefs(e.before, r), e.selection = this.stripLinkDefs(e.selection, r), e.after = this.stripLinkDefs(e.after, r);
                    var i, o = "", a = /\[(\d+)\]/g, s = e.before + e.selection + e.after,
                        l = (s.replace(a, (function (e, t, n) {
                            return " [" + n + "]: http://this-is-a-real-link.biz/" + n + "/unicorn\n", "[" + n + "]"
                        })), {}), c = function (e) {
                            var t = e.replace(/^[ ]{0,3}\[(\d+)\]:/, ""), r = "L_" + t;
                            return r in l ? l[r] : (n++, o += "\n" + (e = "  [" + n + "]:" + t), l[r] = n, n)
                        }, u = function (e, t, n) {
                            return r[t] ? "[" + c(r[t]) + "]" : e
                        }, d = e.before.length;
                    return e.before = e.before.replace(a, u), d, d = e.selection.length, t ? i = c(t) : e.selection = e.selection.replace(a, u), d, e.after = e.after.replace(a, u), e.after && (e.after = e.after.replace(/\n*$/, "")), e.after || (e.selection = e.selection.replace(/\n*$/, "")), e.after += "\n\n" + o, i
                }, b.doLinkOrImage = function (e, t, n) {
                    var i;
                    e.trimWhitespace(), e.findTags(/\s*!?\[/, /\][ ]?(?:\n[ ]*)?(\[.*?\])?/);
                    var o = this.wrapImageInLink, a = this.convertImagesToLinks;
                    if (!(e.endTag.length > 1 && e.startTag.length > 0)) {
                        if (e.selection = e.startTag + e.selection + e.endTag, e.startTag = e.endTag = "", /\n\n/.test(e.selection)) return void this.addLinkDef(e, null);
                        var s = this, l = function (r) {
                            if (i.parentNode.removeChild(i), null !== r) {
                                e.selection = (" " + e.selection).replace(/([^\\](?:\\\\)*)(?=[[\]])/g, "$1\\").substr(1);
                                var l = " [999]: " + r.replace(/^\s*(.*?)(?:\s+"(.+)")?\s*$/, (function (e, t, n) {
                                    var r = !1;
                                    return t = t.replace(/%(?:[\da-fA-F]{2})|\?|\+|[^\w\d-./[\]]/g, (function (e) {
                                        if (3 === e.length && "%" == e.charAt(0)) return e.toUpperCase();
                                        switch (e) {
                                            case"?":
                                                return r = !0, "?";
                                            case"+":
                                                if (r) return "%20"
                                        }
                                        return encodeURI(e)
                                    })), n && (n = (n = n.trim ? n.trim() : n.replace(/^\s*/, "").replace(/\s*$/, "")).replace(/"/g, "quot;").replace(/\(/g, "&#40;").replace(/\)/g, "&#41;").replace(/</g, "&lt;").replace(/>/g, "&gt;")), n ? t + ' "' + n + '"' : t
                                })), c = s.addLinkDef(e, l);
                                (!n || o && !a) && (e.startTag = "[", e.endTag = "][" + c + "]"), n && (e.startTag += a ? "[" : "![", e.endTag = "][" + c + "]" + e.endTag), e.selection || (e.selection = n ? s.getString("imagedescription") : s.getString("linkdescription")), n && a && s.hooks.imageConvertedToLink()
                            }
                            t()
                        };
                        return i = r.createBackground(), n ? r.prompt(this.getString("imagedialog"), "image", "http://", this.getString("ok"), this.getString("cancel"), l) : r.prompt(this.getString("linkdialog"), "link", "http://", this.getString("ok"), this.getString("cancel"), l), !0
                    }
                    e.startTag = e.startTag.replace(/!?\[/, ""), e.endTag = "", this.addLinkDef(e, null)
                }, b.doBlockquote = function (e, t) {
                    e.selection = e.selection.replace(/^(\n*)([^\r]+?)(\n*)$/, (function (t, n, r, i) {
                        return e.before += n, e.after = i + e.after, r
                    })), e.before = e.before.replace(/(>[ \t]*)$/, (function (t, n) {
                        return e.selection = n + e.selection, ""
                    })), e.selection = e.selection.replace(/^(\s|>)+$/, ""), e.selection = e.selection || this.getString("quoteexample");
                    var n, r = "", i = "";
                    if (e.before) {
                        for (var o = e.before.replace(/\n$/, "").split("\n"), a = !1, l = 0; l < o.length; l++) {
                            var c = !1;
                            n = o[l], a = a && n.length > 0, /^>/.test(n) ? (c = !0, !a && n.length > 1 && (a = !0)) : c = !!/^[ \t]*$/.test(n) || a, c ? r += n + "\n" : (i += r + n, r = "\n")
                        }
                        /(^|\n)>/.test(r) || (i += r, r = "")
                    }
                    e.startTag = r, e.before = i, e.after && (e.after = e.after.replace(/^\n?/, "\n")), e.after = e.after.replace(/^(((\n|^)(\n[ \t]*)*>(.+\n)*.*)+(\n[ \t]*)*)/, (function (t) {
                        return e.endTag = t, ""
                    }));
                    var u = function (t) {
                        var n = t ? "> " : "";
                        e.startTag && (e.startTag = e.startTag.replace(/\n((>|\s)*)\n$/, (function (e, t) {
                            return "\n" + t.replace(/^[ ]{0,3}>?[ \t]*$/gm, n) + "\n"
                        }))), e.endTag && (e.endTag = e.endTag.replace(/^\n((>|\s)*)\n/, (function (e, t) {
                            return "\n" + t.replace(/^[ ]{0,3}>?[ \t]*$/gm, n) + "\n"
                        })))
                    };
                    /^(?![ ]{0,3}>)/m.test(e.selection) ? (this.wrap(e, s - 2), e.selection = e.selection.replace(/^/gm, "> "), u(!0), e.skipLines()) : (e.selection = e.selection.replace(/^[ ]{0,3}> ?/gm, ""), this.unwrap(e), u(!1), !/^(\n|^)[ ]{0,3}>/.test(e.selection) && e.startTag && (e.startTag = e.startTag.replace(/\n{0,2}$/, "\n\n")), !/(\n|^)[ ]{0,3}>.*$/.test(e.selection) && e.endTag && (e.endTag = e.endTag.replace(/^\n{0,2}/, "\n\n"))), /\n/.test(e.selection) || (e.selection = e.selection.replace(/^(> *)/, (function (t, n) {
                        return e.startTag += n, ""
                    })))
                }, b.doCode = function (e, t) {
                    var n = /\S[ ]*$/.test(e.before);
                    !/^[ ]*\S/.test(e.after) && !n || /\n/.test(e.selection) ? (e.before = e.before.replace(/[ ]{4}$/, (function (t) {
                        return e.selection = t + e.selection, ""
                    })), e.selection ? /```$/m.test(e.before) && /^```/m.test(e.after) ? (/\n$/m.test(e.before) && (e.before = e.before.replace(/\n$/m, "")), /^\n/m.test(e.after) && (e.after = e.after.replace(/^\n/m, "")), e.before = e.before.replace(/```$/m, ""), e.after = e.after.replace(/^```/m, ""), /\n/.test(e.selection) ? e.selection = e.selection.replace(/^/gm, "    ") : e.before += "    ") : (e.startTag = "```\n", e.selection = e.selection.replace(/^(?:[ ]{4}|[ ]{0,3}\t)/gm, ""), e.endTag = "\n```") : (e.startTag = "```\n", e.selection = this.getString("codeexample"), e.endTag = "\n```")) : (e.trimWhitespace(), e.findTags(/`/, /`/), e.startTag || e.endTag ? e.endTag && !e.startTag ? (e.before += e.endTag, e.endTag = "") : e.startTag = e.endTag = "" : (e.startTag = e.endTag = "`", e.selection || (e.selection = this.getString("codeexample"))))
                }, b.doList = function (e, t, n) {
                    var r = /^\n*(([ ]{0,3}([*+-]|\d+[.])[ \t]+.*)(\n.+|\n{2,}([*+-].*|\d+[.])[ \t]+.*|\n{2,}[ \t]+\S.*)*)\n*/,
                        i = "-", a = 1, l = function () {
                            var e;
                            return n ? (e = " " + a + ". ", a++) : e = " " + i + " ", e
                        }, c = function (e) {
                            return void 0 === n && (n = /^\s*\d/.test(e)), e = e.replace(/^[ ]{0,3}([*+-]|\d+[.])\s/gm, (function (e) {
                                return l()
                            }))
                        };
                    if (e.findTags(/(\n|^)*[ ]{0,3}([*+-]|\d+[.])\s+/, null), !e.before || /\n$/.test(e.before) || /^\n/.test(e.startTag) || (e.before += e.startTag, e.startTag = ""), e.startTag) {
                        var u = /\d+[.]/.test(e.startTag);
                        if (e.startTag = "", e.selection = e.selection.replace(/\n[ ]{4}/g, "\n"), this.unwrap(e), e.skipLines(), u && (e.after = e.after.replace(r, c)), n == u) return
                    }
                    var d = 1;
                    e.before = e.before.replace(/(\n|^)(([ ]{0,3}([*+-]|\d+[.])[ \t]+.*)(\n.+|\n{2,}([*+-].*|\d+[.])[ \t]+.*|\n{2,}[ \t]+\S.*)*)\n*$/, (function (e) {
                        return /^\s*([*+-])/.test(e) && (i = o.$1), d = /[^\n]\n\n[^\n]/.test(e) ? 1 : 0, c(e)
                    })), e.selection || (e.selection = this.getString("litem"));
                    var p = l(), h = 1;
                    e.after = e.after.replace(r, (function (e) {
                        return h = /[^\n]\n\n[^\n]/.test(e) ? 1 : 0, c(e)
                    })), e.trimWhitespace(!0), e.skipLines(d, h, !0), e.startTag = p;
                    var f = p.replace(/./g, " ");
                    this.wrap(e, s - f.length), e.selection = e.selection.replace(/\n/g, "\n" + f)
                }, b.doHeading = function (e, t) {
                    if (e.selection = e.selection.replace(/\s+/g, " "), e.selection = e.selection.replace(/(^\s+|\s+$)/g, ""), !e.selection) return e.startTag = "## ", e.selection = this.getString("headingexample"), e.endTag = "", void e.skipLines(1, 1);
                    var n = 0;
                    switch (e.findTags(/#+[ ]*/, null), /#+/.test(e.startTag) && (n = o.lastMatch.length), e.startTag = e.endTag = "", e.findTags(/#+[ ]*/, null), /##/.test(e.endTag) && (n = 2), /###/.test(e.endTag) && (n = 3), e.startTag = e.endTag = "", e.skipLines(1, 1), n) {
                        case 0:
                            e.startTag = "## ", e.endTag = "";
                            break;
                        case 2:
                            e.startTag = "### ", e.endTag = "";
                            break;
                        case 3:
                            e.startTag = "#### ", e.endTag = ""
                    }
                }, b.doHorizontalRule = function (e, t) {
                    e.startTag = "----------\n", e.selection = "", e.skipLines(1, 1, !0)
                }
            }()
        }, 198: () => {
            function e(t) {
                return e = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
                    return typeof e
                } : function (e) {
                    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                }, e(t)
            }

            !function () {
                "use strict";
                var t = function (e) {
                    for (var t in this.input = null, this.inputDisplay = null, this.slider = null, this.sliderWidth = 0, this.sliderLeft = 0, this.pointerWidth = 0, this.pointerR = null, this.pointerL = null, this.activePointer = null, this.selected = null, this.scale = null, this.step = 0, this.tipL = null, this.tipR = null, this.timeout = null, this.valRange = !1, this.values = {
                        start: null,
                        end: null
                    }, this.conf = {
                        target: null,
                        values: null,
                        set: null,
                        range: !1,
                        width: null,
                        scale: !0,
                        labels: !0,
                        tooltip: !0,
                        step: null,
                        disabled: !1,
                        onChange: null
                    }, this.cls = {
                        container: "rs-container",
                        background: "rs-bg",
                        selected: "rs-selected",
                        pointer: "rs-pointer",
                        scale: "rs-scale",
                        noscale: "rs-noscale",
                        tip: "rs-tooltip"
                    }, this.conf) e.hasOwnProperty(t) && (this.conf[t] = e[t]);
                    this.init()
                };
                t.prototype.init = function () {
                    return "object" == e(this.conf.target) ? this.input = this.conf.target : this.input = document.getElementById(this.conf.target.replace("#", "")), this.input ? (this.inputDisplay = getComputedStyle(this.input, null).display, this.input.style.display = "none", this.valRange = !(this.conf.values instanceof Array), !this.valRange || this.conf.values.hasOwnProperty("min") && this.conf.values.hasOwnProperty("max") ? this.createSlider() : console.log("Missing min or max value...")) : console.log("Cannot find target element...")
                }, t.prototype.createSlider = function () {
                    return this.slider = n("div", this.cls.container), this.slider.innerHTML = '<div class="rs-bg"></div>', this.selected = n("div", this.cls.selected), this.pointerL = n("div", this.cls.pointer, ["dir", "left"]), this.scale = n("div", this.cls.scale), this.conf.tooltip && (this.tipL = n("div", this.cls.tip), this.tipR = n("div", this.cls.tip), this.pointerL.appendChild(this.tipL)), this.slider.appendChild(this.selected), this.slider.appendChild(this.scale), this.slider.appendChild(this.pointerL), this.conf.range && (this.pointerR = n("div", this.cls.pointer, ["dir", "right"]), this.conf.tooltip && this.pointerR.appendChild(this.tipR), this.slider.appendChild(this.pointerR)), this.input.parentNode.insertBefore(this.slider, this.input.nextSibling), this.conf.width && (this.slider.style.width = parseInt(this.conf.width) + "px"), this.sliderLeft = this.slider.getBoundingClientRect().left, this.sliderWidth = this.slider.clientWidth, this.pointerWidth = this.pointerL.clientWidth, this.conf.scale || this.slider.classList.add(this.cls.noscale), this.setInitialValues()
                }, t.prototype.setInitialValues = function () {
                    if (this.disabled(this.conf.disabled), this.valRange && (this.conf.values = i(this.conf)), this.values.start = 0, this.values.end = this.conf.range ? this.conf.values.length - 1 : 0, this.conf.set && this.conf.set.length && o(this.conf)) {
                        var e = this.conf.set;
                        this.conf.range ? (this.values.start = this.conf.values.indexOf(e[0]), this.values.end = this.conf.set[1] ? this.conf.values.indexOf(e[1]) : null) : this.values.end = this.conf.values.indexOf(e[0])
                    }
                    return this.createScale()
                }, t.prototype.createScale = function (e) {
                    this.step = this.sliderWidth / (this.conf.values.length - 1);
                    for (var t = 0, r = this.conf.values.length; t < r; t++) {
                        var i = n("span"), o = n("ins");
                        i.appendChild(o), this.scale.appendChild(i), i.style.width = t === r - 1 ? 0 : this.step + "px", this.conf.labels ? o.innerHTML = this.conf.values[t] : 0 !== t && t !== r - 1 || (o.innerHTML = this.conf.values[t]), o.style.marginLeft = o.clientWidth / 2 * -1 + "px"
                    }
                    return this.addEvents()
                }, t.prototype.updateScale = function () {
                    this.step = this.sliderWidth / (this.conf.values.length - 1);
                    for (var e = this.slider.querySelectorAll("span"), t = 0, n = e.length; t < n; t++) e[t].style.width = this.step + "px";
                    return this.setValues()
                }, t.prototype.addEvents = function () {
                    var e = this.slider.querySelectorAll("." + this.cls.pointer),
                        t = this.slider.querySelectorAll("span");
                    r(document, "mousemove touchmove", this.move.bind(this)), r(document, "mouseup touchend touchcancel", this.drop.bind(this));
                    for (var n = 0, i = e.length; n < i; n++) r(e[n], "mousedown touchstart", this.drag.bind(this));
                    for (n = 0, i = t.length; n < i; n++) r(t[n], "click", this.onClickPiece.bind(this));
                    return window.addEventListener("resize", this.onResize.bind(this)), this.setValues()
                }, t.prototype.drag = function (e) {
                    if (e.preventDefault(), !this.conf.disabled) {
                        var t = e.target.getAttribute("data-dir");
                        return "left" === t && (this.activePointer = this.pointerL), "right" === t && (this.activePointer = this.pointerR), this.slider.classList.add("sliding")
                    }
                }, t.prototype.move = function (e) {
                    if (this.activePointer && !this.conf.disabled) {
                        var t = ("touchmove" === e.type ? e.touches[0].clientX : e.pageX) - this.sliderLeft - this.pointerWidth / 2;
                        return (t = Math.round(t / this.step)) <= 0 && (t = 0), t > this.conf.values.length - 1 && (t = this.conf.values.length - 1), this.conf.range ? (this.activePointer === this.pointerL && (this.values.start = t), this.activePointer === this.pointerR && (this.values.end = t)) : this.values.end = t, this.setValues()
                    }
                }, t.prototype.drop = function () {
                    this.activePointer = null
                }, t.prototype.setValues = function (e, t) {
                    var n = this.conf.range ? "start" : "end";
                    return e && this.conf.values.indexOf(e) > -1 && (this.values[n] = this.conf.values.indexOf(e)), t && this.conf.values.indexOf(t) > -1 && (this.values.end = this.conf.values.indexOf(t)), this.conf.range && this.values.start > this.values.end && (this.values.start = this.values.end), this.pointerL.style.left = this.values[n] * this.step - this.pointerWidth / 2 + "px", this.conf.range ? (this.conf.tooltip && (this.tipL.innerHTML = this.conf.values[this.values.start], this.tipR.innerHTML = this.conf.values[this.values.end]), this.input.value = this.conf.values[this.values.start] + "," + this.conf.values[this.values.end], this.pointerR.style.left = this.values.end * this.step - this.pointerWidth / 2 + "px") : (this.conf.tooltip && (this.tipL.innerHTML = this.conf.values[this.values.end]), this.input.value = this.conf.values[this.values.end]), this.values.end > this.conf.values.length - 1 && (this.values.end = this.conf.values.length - 1), this.values.start < 0 && (this.values.start = 0), this.selected.style.width = (this.values.end - this.values.start) * this.step + "px", this.selected.style.left = this.values.start * this.step + "px", this.onChange()
                }, t.prototype.onClickPiece = function (e) {
                    if (!this.conf.disabled) {
                        var t = Math.round((e.clientX - this.sliderLeft) / this.step);
                        return t > this.conf.values.length - 1 && (t = this.conf.values.length - 1), t < 0 && (t = 0), this.conf.range && t - this.values.start <= this.values.end - t ? this.values.start = t : this.values.end = t, this.slider.classList.remove("sliding"), this.setValues()
                    }
                }, t.prototype.onChange = function () {
                    var e = this;
                    this.timeout && clearTimeout(this.timeout), this.timeout = setTimeout((function () {
                        if (e.conf.onChange && "function" == typeof e.conf.onChange) return e.conf.onChange(e.input.value)
                    }), 0)
                }, t.prototype.onResize = function () {
                    return this.sliderLeft = this.slider.getBoundingClientRect().left, this.sliderWidth = this.slider.clientWidth, this.updateScale()
                }, t.prototype.disabled = function (e) {
                    this.conf.disabled = e, this.slider.classList[e ? "add" : "remove"]("disabled")
                }, t.prototype.getValue = function () {
                    return this.input.value
                }, t.prototype.destroy = function () {
                    this.input.style.display = this.inputDisplay, this.slider.remove()
                };
                var n = function (e, t, n) {
                    var r = document.createElement(e);
                    return t && (r.className = t), n && 2 === n.length && r.setAttribute("data-" + n[0], n[1]), r
                }, r = function (e, t, n) {
                    for (var r = t.split(" "), i = 0, o = r.length; i < o; i++) e.addEventListener(r[i], n)
                }, i = function (e) {
                    var t = [], n = e.values.max - e.values.min;
                    if (!e.step) return console.log("No step defined..."), [e.values.min, e.values.max];
                    for (var r = 0, i = n / e.step; r < i; r++) t.push(e.values.min + r * e.step);
                    return t.indexOf(e.values.max) < 0 && t.push(e.values.max), t
                }, o = function (e) {
                    return !e.set || e.set.length < 1 || e.values.indexOf(e.set[0]) < 0 ? null : !e.range || !(e.set.length < 2 || e.values.indexOf(e.set[1]) < 0) || null
                };
                window.rSlider = t
            }()
        }, 54: function (e, t, n) {
            var r, i, o;

            function a(e, t, n) {
                return t in e ? Object.defineProperty(e, t, {
                    value: n,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : e[t] = n, e
            }

            function s(e, t) {
                return function (e) {
                    if (Array.isArray(e)) return e
                }(e) || function (e, t) {
                    var n = null == e ? null : "undefined" != typeof Symbol && e[Symbol.iterator] || e["@@iterator"];
                    if (null == n) return;
                    var r, i, o = [], a = !0, s = !1;
                    try {
                        for (n = n.call(e); !(a = (r = n.next()).done) && (o.push(r.value), !t || o.length !== t); a = !0) ;
                    } catch (e) {
                        s = !0, i = e
                    } finally {
                        try {
                            a || null == n.return || n.return()
                        } finally {
                            if (s) throw i
                        }
                    }
                    return o
                }(e, t) || c(e, t) || function () {
                    throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
                }()
            }

            function l(e) {
                return function (e) {
                    if (Array.isArray(e)) return u(e)
                }(e) || function (e) {
                    if ("undefined" != typeof Symbol && null != e[Symbol.iterator] || null != e["@@iterator"]) return Array.from(e)
                }(e) || c(e) || function () {
                    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
                }()
            }

            function c(e, t) {
                if (e) {
                    if ("string" == typeof e) return u(e, t);
                    var n = Object.prototype.toString.call(e).slice(8, -1);
                    return "Object" === n && e.constructor && (n = e.constructor.name), "Map" === n || "Set" === n ? Array.from(e) : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n) ? u(e, t) : void 0
                }
            }

            function u(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
                return r
            }

            function d(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var r = t[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r)
                }
            }

            function p(e, t, n) {
                return t && d(e.prototype, t), n && d(e, n), Object.defineProperty(e, "prototype", {writable: !1}), e
            }

            function h(e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }

            function f(e, t) {
                if (t && ("object" === _(t) || "function" == typeof t)) return t;
                if (void 0 !== t) throw new TypeError("Derived constructors may only return object or undefined");
                return g(e)
            }

            function g(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }

            function m(e) {
                var t = "function" == typeof Map ? new Map : void 0;
                return m = function (e) {
                    if (null === e || (n = e, -1 === Function.toString.call(n).indexOf("[native code]"))) return e;
                    var n;
                    if ("function" != typeof e) throw new TypeError("Super expression must either be null or a function");
                    if (void 0 !== t) {
                        if (t.has(e)) return t.get(e);
                        t.set(e, r)
                    }

                    function r() {
                        return v(e, arguments, y(this).constructor)
                    }

                    return r.prototype = Object.create(e.prototype, {
                        constructor: {
                            value: r,
                            enumerable: !1,
                            writable: !0,
                            configurable: !0
                        }
                    }), w(r, e)
                }, m(e)
            }

            function v(e, t, n) {
                return v = b() ? Reflect.construct : function (e, t, n) {
                    var r = [null];
                    r.push.apply(r, t);
                    var i = new (Function.bind.apply(e, r));
                    return n && w(i, n.prototype), i
                }, v.apply(null, arguments)
            }

            function b() {
                if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
                if (Reflect.construct.sham) return !1;
                if ("function" == typeof Proxy) return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function () {
                    }))), !0
                } catch (e) {
                    return !1
                }
            }

            function w(e, t) {
                return w = Object.setPrototypeOf || function (e, t) {
                    return e.__proto__ = t, e
                }, w(e, t)
            }

            function y(e) {
                return y = Object.setPrototypeOf ? Object.getPrototypeOf : function (e) {
                    return e.__proto__ || Object.getPrototypeOf(e)
                }, y(e)
            }

            function _(e) {
                return _ = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
                    return typeof e
                } : function (e) {
                    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                }, _(e)
            }

            o = function () {
                "use strict";

                function e(e) {
                    return null !== e && "object" == _(e) && "constructor" in e && e.constructor === Object
                }

                function t() {
                    var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                        r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                    Object.keys(r).forEach((function (i) {
                        void 0 === n[i] ? n[i] = r[i] : e(r[i]) && e(n[i]) && Object.keys(r[i]).length > 0 && t(n[i], r[i])
                    }))
                }

                var n = {
                    body: {},
                    addEventListener: function () {
                    },
                    removeEventListener: function () {
                    },
                    activeElement: {
                        blur: function () {
                        }, nodeName: ""
                    },
                    querySelector: function () {
                        return null
                    },
                    querySelectorAll: function () {
                        return []
                    },
                    getElementById: function () {
                        return null
                    },
                    createEvent: function () {
                        return {
                            initEvent: function () {
                            }
                        }
                    },
                    createElement: function () {
                        return {
                            children: [], childNodes: [], style: {}, setAttribute: function () {
                            }, getElementsByTagName: function () {
                                return []
                            }
                        }
                    },
                    createElementNS: function () {
                        return {}
                    },
                    importNode: function () {
                        return null
                    },
                    location: {
                        hash: "",
                        host: "",
                        hostname: "",
                        href: "",
                        origin: "",
                        pathname: "",
                        protocol: "",
                        search: ""
                    }
                };

                function r() {
                    var e = "undefined" != typeof document ? document : {};
                    return t(e, n), e
                }

                var i = {
                    document: n,
                    navigator: {userAgent: ""},
                    location: {
                        hash: "",
                        host: "",
                        hostname: "",
                        href: "",
                        origin: "",
                        pathname: "",
                        protocol: "",
                        search: ""
                    },
                    history: {
                        replaceState: function () {
                        }, pushState: function () {
                        }, go: function () {
                        }, back: function () {
                        }
                    },
                    CustomEvent: function () {
                        return this
                    },
                    addEventListener: function () {
                    },
                    removeEventListener: function () {
                    },
                    getComputedStyle: function () {
                        return {
                            getPropertyValue: function () {
                                return ""
                            }
                        }
                    },
                    Image: function () {
                    },
                    Date: function () {
                    },
                    screen: {},
                    setTimeout: function () {
                    },
                    clearTimeout: function () {
                    },
                    matchMedia: function () {
                        return {}
                    },
                    requestAnimationFrame: function (e) {
                        return "undefined" == typeof setTimeout ? (e(), null) : setTimeout(e, 0)
                    },
                    cancelAnimationFrame: function (e) {
                        "undefined" != typeof setTimeout && clearTimeout(e)
                    }
                };

                function o() {
                    var e = "undefined" != typeof window ? window : {};
                    return t(e, i), e
                }

                var c = function (e) {
                    !function (e, t) {
                        if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                        Object.defineProperty(e, "prototype", {
                            value: Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), writable: !1
                        }), t && w(e, t)
                    }(i, e);
                    var t, n, r = (t = i, n = b(), function () {
                        var e, r = y(t);
                        if (n) {
                            var i = y(this).constructor;
                            e = Reflect.construct(r, arguments, i)
                        } else e = r.apply(this, arguments);
                        return f(this, e)
                    });

                    function i(e) {
                        var t;
                        return h(this, i), function (e) {
                            var t = e.__proto__;
                            Object.defineProperty(e, "__proto__", {
                                get: function () {
                                    return t
                                }, set: function (e) {
                                    t.__proto__ = e
                                }
                            })
                        }(g(t = r.call.apply(r, [this].concat(l(e || []))))), t
                    }

                    return p(i)
                }(m(Array));

                function u() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [], t = [];
                    return e.forEach((function (e) {
                        Array.isArray(e) ? t.push.apply(t, l(u(e))) : t.push(e)
                    })), t
                }

                function d(e, t) {
                    return Array.prototype.filter.call(e, t)
                }

                function v(e, t) {
                    var n = o(), i = r(), a = [];
                    if (!t && e instanceof c) return e;
                    if (!e) return new c(a);
                    if ("string" == typeof e) {
                        var s = e.trim();
                        if (s.indexOf("<") >= 0 && s.indexOf(">") >= 0) {
                            var l = "div";
                            0 === s.indexOf("<li") && (l = "ul"), 0 === s.indexOf("<tr") && (l = "tbody"), 0 !== s.indexOf("<td") && 0 !== s.indexOf("<th") || (l = "tr"), 0 === s.indexOf("<tbody") && (l = "table"), 0 === s.indexOf("<option") && (l = "select");
                            var u = i.createElement(l);
                            u.innerHTML = s;
                            for (var d = 0; d < u.childNodes.length; d += 1) a.push(u.childNodes[d])
                        } else a = function (e, t) {
                            if ("string" != typeof e) return [e];
                            for (var n = [], r = t.querySelectorAll(e), i = 0; i < r.length; i += 1) n.push(r[i]);
                            return n
                        }(e.trim(), t || i)
                    } else if (e.nodeType || e === n || e === i) a.push(e); else if (Array.isArray(e)) {
                        if (e instanceof c) return e;
                        a = e
                    }
                    return new c(function (e) {
                        for (var t = [], n = 0; n < e.length; n += 1) -1 === t.indexOf(e[n]) && t.push(e[n]);
                        return t
                    }(a))
                }

                v.fn = c.prototype;
                var k, x, S, C = {
                    addClass: function () {
                        for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                        var r = u(t.map((function (e) {
                            return e.split(" ")
                        })));
                        return this.forEach((function (e) {
                            var t;
                            (t = e.classList).add.apply(t, l(r))
                        })), this
                    }, removeClass: function () {
                        for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                        var r = u(t.map((function (e) {
                            return e.split(" ")
                        })));
                        return this.forEach((function (e) {
                            var t;
                            (t = e.classList).remove.apply(t, l(r))
                        })), this
                    }, hasClass: function () {
                        for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                        var r = u(t.map((function (e) {
                            return e.split(" ")
                        })));
                        return d(this, (function (e) {
                            return r.filter((function (t) {
                                return e.classList.contains(t)
                            })).length > 0
                        })).length > 0
                    }, toggleClass: function () {
                        for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                        var r = u(t.map((function (e) {
                            return e.split(" ")
                        })));
                        this.forEach((function (e) {
                            r.forEach((function (t) {
                                e.classList.toggle(t)
                            }))
                        }))
                    }, attr: function (e, t) {
                        if (1 === arguments.length && "string" == typeof e) return this[0] ? this[0].getAttribute(e) : void 0;
                        for (var n = 0; n < this.length; n += 1) if (2 === arguments.length) this[n].setAttribute(e, t); else for (var r in e) this[n][r] = e[r], this[n].setAttribute(r, e[r]);
                        return this
                    }, removeAttr: function (e) {
                        for (var t = 0; t < this.length; t += 1) this[t].removeAttribute(e);
                        return this
                    }, transform: function (e) {
                        for (var t = 0; t < this.length; t += 1) this[t].style.transform = e;
                        return this
                    }, transition: function (e) {
                        for (var t = 0; t < this.length; t += 1) this[t].style.transitionDuration = "string" != typeof e ? "".concat(e, "ms") : e;
                        return this
                    }, on: function () {
                        for (var e, t = arguments.length, n = new Array(t), r = 0; r < t; r++) n[r] = arguments[r];
                        var i = n[0], o = n[1], a = n[2], l = n[3];

                        function c(e) {
                            var t = e.target;
                            if (t) {
                                var n = e.target.dom7EventData || [];
                                if (n.indexOf(e) < 0 && n.unshift(e), v(t).is(o)) a.apply(t, n); else for (var r = v(t).parents(), i = 0; i < r.length; i += 1) v(r[i]).is(o) && a.apply(r[i], n)
                            }
                        }

                        function u(e) {
                            var t = e && e.target && e.target.dom7EventData || [];
                            t.indexOf(e) < 0 && t.unshift(e), a.apply(this, t)
                        }

                        "function" == typeof n[1] && (i = (e = s(n, 3))[0], a = e[1], l = e[2], o = void 0), l || (l = !1);
                        for (var d, p = i.split(" "), h = 0; h < this.length; h += 1) {
                            var f = this[h];
                            if (o) for (d = 0; d < p.length; d += 1) {
                                var g = p[d];
                                f.dom7LiveListeners || (f.dom7LiveListeners = {}), f.dom7LiveListeners[g] || (f.dom7LiveListeners[g] = []), f.dom7LiveListeners[g].push({
                                    listener: a,
                                    proxyListener: c
                                }), f.addEventListener(g, c, l)
                            } else for (d = 0; d < p.length; d += 1) {
                                var m = p[d];
                                f.dom7Listeners || (f.dom7Listeners = {}), f.dom7Listeners[m] || (f.dom7Listeners[m] = []), f.dom7Listeners[m].push({
                                    listener: a,
                                    proxyListener: u
                                }), f.addEventListener(m, u, l)
                            }
                        }
                        return this
                    }, off: function () {
                        for (var e, t = arguments.length, n = new Array(t), r = 0; r < t; r++) n[r] = arguments[r];
                        var i = n[0], o = n[1], a = n[2], l = n[3];
                        "function" == typeof n[1] && (i = (e = s(n, 3))[0], a = e[1], l = e[2], o = void 0), l || (l = !1);
                        for (var c = i.split(" "), u = 0; u < c.length; u += 1) for (var d = c[u], p = 0; p < this.length; p += 1) {
                            var h = this[p], f = void 0;
                            if (!o && h.dom7Listeners ? f = h.dom7Listeners[d] : o && h.dom7LiveListeners && (f = h.dom7LiveListeners[d]), f && f.length) for (var g = f.length - 1; g >= 0; g -= 1) {
                                var m = f[g];
                                a && m.listener === a || a && m.listener && m.listener.dom7proxy && m.listener.dom7proxy === a ? (h.removeEventListener(d, m.proxyListener, l), f.splice(g, 1)) : a || (h.removeEventListener(d, m.proxyListener, l), f.splice(g, 1))
                            }
                        }
                        return this
                    }, trigger: function () {
                        for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                        for (var r = o(), i = t[0].split(" "), a = t[1], s = 0; s < i.length; s += 1) for (var l = i[s], c = 0; c < this.length; c += 1) {
                            var u = this[c];
                            if (r.CustomEvent) {
                                var d = new r.CustomEvent(l, {detail: a, bubbles: !0, cancelable: !0});
                                u.dom7EventData = t.filter((function (e, t) {
                                    return t > 0
                                })), u.dispatchEvent(d), u.dom7EventData = [], delete u.dom7EventData
                            }
                        }
                        return this
                    }, transitionEnd: function (e) {
                        var t = this;
                        return e && t.on("transitionend", (function n(r) {
                            r.target === this && (e.call(this, r), t.off("transitionend", n))
                        })), this
                    }, outerWidth: function (e) {
                        if (this.length > 0) {
                            if (e) {
                                var t = this.styles();
                                return this[0].offsetWidth + parseFloat(t.getPropertyValue("margin-right")) + parseFloat(t.getPropertyValue("margin-left"))
                            }
                            return this[0].offsetWidth
                        }
                        return null
                    }, outerHeight: function (e) {
                        if (this.length > 0) {
                            if (e) {
                                var t = this.styles();
                                return this[0].offsetHeight + parseFloat(t.getPropertyValue("margin-top")) + parseFloat(t.getPropertyValue("margin-bottom"))
                            }
                            return this[0].offsetHeight
                        }
                        return null
                    }, styles: function () {
                        var e = o();
                        return this[0] ? e.getComputedStyle(this[0], null) : {}
                    }, offset: function () {
                        if (this.length > 0) {
                            var e = o(), t = r(), n = this[0], i = n.getBoundingClientRect(), a = t.body,
                                s = n.clientTop || a.clientTop || 0, l = n.clientLeft || a.clientLeft || 0,
                                c = n === e ? e.scrollY : n.scrollTop, u = n === e ? e.scrollX : n.scrollLeft;
                            return {top: i.top + c - s, left: i.left + u - l}
                        }
                        return null
                    }, css: function (e, t) {
                        var n, r = o();
                        if (1 === arguments.length) {
                            if ("string" != typeof e) {
                                for (n = 0; n < this.length; n += 1) for (var i in e) this[n].style[i] = e[i];
                                return this
                            }
                            if (this[0]) return r.getComputedStyle(this[0], null).getPropertyValue(e)
                        }
                        if (2 === arguments.length && "string" == typeof e) {
                            for (n = 0; n < this.length; n += 1) this[n].style[e] = t;
                            return this
                        }
                        return this
                    }, each: function (e) {
                        return e ? (this.forEach((function (t, n) {
                            e.apply(t, [t, n])
                        })), this) : this
                    }, html: function (e) {
                        if (void 0 === e) return this[0] ? this[0].innerHTML : null;
                        for (var t = 0; t < this.length; t += 1) this[t].innerHTML = e;
                        return this
                    }, text: function (e) {
                        if (void 0 === e) return this[0] ? this[0].textContent.trim() : null;
                        for (var t = 0; t < this.length; t += 1) this[t].textContent = e;
                        return this
                    }, is: function (e) {
                        var t, n, i = o(), a = r(), s = this[0];
                        if (!s || void 0 === e) return !1;
                        if ("string" == typeof e) {
                            if (s.matches) return s.matches(e);
                            if (s.webkitMatchesSelector) return s.webkitMatchesSelector(e);
                            if (s.msMatchesSelector) return s.msMatchesSelector(e);
                            for (t = v(e), n = 0; n < t.length; n += 1) if (t[n] === s) return !0;
                            return !1
                        }
                        if (e === a) return s === a;
                        if (e === i) return s === i;
                        if (e.nodeType || e instanceof c) {
                            for (t = e.nodeType ? [e] : e, n = 0; n < t.length; n += 1) if (t[n] === s) return !0;
                            return !1
                        }
                        return !1
                    }, index: function () {
                        var e, t = this[0];
                        if (t) {
                            for (e = 0; null !== (t = t.previousSibling);) 1 === t.nodeType && (e += 1);
                            return e
                        }
                    }, eq: function (e) {
                        if (void 0 === e) return this;
                        var t = this.length;
                        if (e > t - 1) return v([]);
                        if (e < 0) {
                            var n = t + e;
                            return v(n < 0 ? [] : [this[n]])
                        }
                        return v([this[e]])
                    }, append: function () {
                        for (var e, t = r(), n = 0; n < arguments.length; n += 1) {
                            e = n < 0 || arguments.length <= n ? void 0 : arguments[n];
                            for (var i = 0; i < this.length; i += 1) if ("string" == typeof e) {
                                var o = t.createElement("div");
                                for (o.innerHTML = e; o.firstChild;) this[i].appendChild(o.firstChild)
                            } else if (e instanceof c) for (var a = 0; a < e.length; a += 1) this[i].appendChild(e[a]); else this[i].appendChild(e)
                        }
                        return this
                    }, prepend: function (e) {
                        var t, n, i = r();
                        for (t = 0; t < this.length; t += 1) if ("string" == typeof e) {
                            var o = i.createElement("div");
                            for (o.innerHTML = e, n = o.childNodes.length - 1; n >= 0; n -= 1) this[t].insertBefore(o.childNodes[n], this[t].childNodes[0])
                        } else if (e instanceof c) for (n = 0; n < e.length; n += 1) this[t].insertBefore(e[n], this[t].childNodes[0]); else this[t].insertBefore(e, this[t].childNodes[0]);
                        return this
                    }, next: function (e) {
                        return this.length > 0 ? e ? this[0].nextElementSibling && v(this[0].nextElementSibling).is(e) ? v([this[0].nextElementSibling]) : v([]) : this[0].nextElementSibling ? v([this[0].nextElementSibling]) : v([]) : v([])
                    }, nextAll: function (e) {
                        var t = [], n = this[0];
                        if (!n) return v([]);
                        for (; n.nextElementSibling;) {
                            var r = n.nextElementSibling;
                            e ? v(r).is(e) && t.push(r) : t.push(r), n = r
                        }
                        return v(t)
                    }, prev: function (e) {
                        if (this.length > 0) {
                            var t = this[0];
                            return e ? t.previousElementSibling && v(t.previousElementSibling).is(e) ? v([t.previousElementSibling]) : v([]) : t.previousElementSibling ? v([t.previousElementSibling]) : v([])
                        }
                        return v([])
                    }, prevAll: function (e) {
                        var t = [], n = this[0];
                        if (!n) return v([]);
                        for (; n.previousElementSibling;) {
                            var r = n.previousElementSibling;
                            e ? v(r).is(e) && t.push(r) : t.push(r), n = r
                        }
                        return v(t)
                    }, parent: function (e) {
                        for (var t = [], n = 0; n < this.length; n += 1) null !== this[n].parentNode && (e ? v(this[n].parentNode).is(e) && t.push(this[n].parentNode) : t.push(this[n].parentNode));
                        return v(t)
                    }, parents: function (e) {
                        for (var t = [], n = 0; n < this.length; n += 1) for (var r = this[n].parentNode; r;) e ? v(r).is(e) && t.push(r) : t.push(r), r = r.parentNode;
                        return v(t)
                    }, closest: function (e) {
                        var t = this;
                        return void 0 === e ? v([]) : (t.is(e) || (t = t.parents(e).eq(0)), t)
                    }, find: function (e) {
                        for (var t = [], n = 0; n < this.length; n += 1) for (var r = this[n].querySelectorAll(e), i = 0; i < r.length; i += 1) t.push(r[i]);
                        return v(t)
                    }, children: function (e) {
                        for (var t = [], n = 0; n < this.length; n += 1) for (var r = this[n].children, i = 0; i < r.length; i += 1) e && !v(r[i]).is(e) || t.push(r[i]);
                        return v(t)
                    }, filter: function (e) {
                        return v(d(this, e))
                    }, remove: function () {
                        for (var e = 0; e < this.length; e += 1) this[e].parentNode && this[e].parentNode.removeChild(this[e]);
                        return this
                    }
                };

                function E(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0;
                    return setTimeout(e, t)
                }

                function T() {
                    return Date.now()
                }

                function A(e) {
                    var t, n, r, i = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "x", a = o(),
                        s = function (e) {
                            var t, n = o();
                            return n.getComputedStyle && (t = n.getComputedStyle(e, null)), !t && e.currentStyle && (t = e.currentStyle), t || (t = e.style), t
                        }(e);
                    return a.WebKitCSSMatrix ? ((n = s.transform || s.webkitTransform).split(",").length > 6 && (n = n.split(", ").map((function (e) {
                        return e.replace(",", ".")
                    })).join(", ")), r = new a.WebKitCSSMatrix("none" === n ? "" : n)) : t = (r = s.MozTransform || s.OTransform || s.MsTransform || s.msTransform || s.transform || s.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,")).toString().split(","), "x" === i && (n = a.WebKitCSSMatrix ? r.m41 : 16 === t.length ? parseFloat(t[12]) : parseFloat(t[4])), "y" === i && (n = a.WebKitCSSMatrix ? r.m42 : 16 === t.length ? parseFloat(t[13]) : parseFloat(t[5])), n || 0
                }

                function O(e) {
                    return "object" == _(e) && null !== e && e.constructor && "Object" === Object.prototype.toString.call(e).slice(8, -1)
                }

                function P() {
                    for (var e, t = Object(arguments.length <= 0 ? void 0 : arguments[0]), n = ["__proto__", "constructor", "prototype"], r = 1; r < arguments.length; r += 1) {
                        var i = r < 0 || arguments.length <= r ? void 0 : arguments[r];
                        if (null != i && (e = i, !("undefined" != typeof window && void 0 !== window.HTMLElement ? e instanceof HTMLElement : e && (1 === e.nodeType || 11 === e.nodeType)))) for (var o = Object.keys(Object(i)).filter((function (e) {
                            return n.indexOf(e) < 0
                        })), a = 0, s = o.length; a < s; a += 1) {
                            var l = o[a], c = Object.getOwnPropertyDescriptor(i, l);
                            void 0 !== c && c.enumerable && (O(t[l]) && O(i[l]) ? i[l].__swiper__ ? t[l] = i[l] : P(t[l], i[l]) : !O(t[l]) && O(i[l]) ? (t[l] = {}, i[l].__swiper__ ? t[l] = i[l] : P(t[l], i[l])) : t[l] = i[l])
                        }
                    }
                    return t
                }

                function M(e, t, n) {
                    e.style.setProperty(t, n)
                }

                function L(e) {
                    var t, n = e.swiper, r = e.targetPosition, i = e.side, s = o(), l = -n.translate, c = null,
                        u = n.params.speed;
                    n.wrapperEl.style.scrollSnapType = "none", s.cancelAnimationFrame(n.cssModeFrameID);
                    var d = r > l ? "next" : "prev", p = function (e, t) {
                        return "next" === d && e >= t || "prev" === d && e <= t
                    };
                    !function e() {
                        t = (new Date).getTime(), null === c && (c = t);
                        var o = Math.max(Math.min((t - c) / u, 1), 0), d = 0.5 - Math.cos(o * Math.PI) / 2,
                            h = l + d * (r - l);
                        if (p(h, r) && (h = r), n.wrapperEl.scrollTo(a({}, i, h)), p(h, r)) return n.wrapperEl.style.overflow = "hidden", n.wrapperEl.style.scrollSnapType = "", setTimeout((function () {
                            n.wrapperEl.style.overflow = "", n.wrapperEl.scrollTo(a({}, i, h))
                        })), void s.cancelAnimationFrame(n.cssModeFrameID);
                        n.cssModeFrameID = s.requestAnimationFrame(e)
                    }()
                }

                function j() {
                    return k || (k = function () {
                        var e = o(), t = r();
                        return {
                            smoothScroll: t.documentElement && "scrollBehavior" in t.documentElement.style,
                            touch: !!("ontouchstart" in e || e.DocumentTouch && t instanceof e.DocumentTouch),
                            passiveListener: function () {
                                var t = !1;
                                try {
                                    var n = Object.defineProperty({}, "passive", {
                                        get: function () {
                                            t = !0
                                        }
                                    });
                                    e.addEventListener("testPassiveListener", null, n)
                                } catch (e) {
                                }
                                return t
                            }(),
                            gestures: "ongesturestart" in e
                        }
                    }()), k
                }

                function N() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    return x || (x = function () {
                        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {}, t = e.userAgent,
                            n = j(), r = o(), i = r.navigator.platform, a = t || r.navigator.userAgent,
                            s = {ios: !1, android: !1}, l = r.screen.width, c = r.screen.height,
                            u = a.match(/(Android);?[\s\/]+([\d.]+)?/), d = a.match(/(iPad).*OS\s([\d_]+)/),
                            p = a.match(/(iPod)(.*OS\s([\d_]+))?/), h = !d && a.match(/(iPhone\sOS|iOS)\s([\d_]+)/),
                            f = "Win32" === i, g = "MacIntel" === i;
                        return !d && g && n.touch && ["1024x1366", "1366x1024", "834x1194", "1194x834", "834x1112", "1112x834", "768x1024", "1024x768", "820x1180", "1180x820", "810x1080", "1080x810"].indexOf("".concat(l, "x").concat(c)) >= 0 && ((d = a.match(/(Version)\/([\d.]+)/)) || (d = [0, 1, "13_0_0"]), g = !1), u && !f && (s.os = "android", s.android = !0), (d || h || p) && (s.os = "ios", s.ios = !0), s
                    }(e)), x
                }

                function I() {
                    return S || (S = function () {
                        var e = o();
                        return {
                            isSafari: function () {
                                var t = e.navigator.userAgent.toLowerCase();
                                return t.indexOf("safari") >= 0 && t.indexOf("chrome") < 0 && t.indexOf("android") < 0
                            }(), isWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(e.navigator.userAgent)
                        }
                    }()), S
                }

                Object.keys(C).forEach((function (e) {
                    Object.defineProperty(v.fn, e, {value: C[e], writable: !0})
                }));
                var z = {
                    on: function (e, t, n) {
                        var r = this;
                        if ("function" != typeof t) return r;
                        var i = n ? "unshift" : "push";
                        return e.split(" ").forEach((function (e) {
                            r.eventsListeners[e] || (r.eventsListeners[e] = []), r.eventsListeners[e][i](t)
                        })), r
                    }, once: function (e, t, n) {
                        var r = this;
                        if ("function" != typeof t) return r;

                        function i() {
                            for (var n = arguments.length, o = new Array(n), a = 0; a < n; a++) o[a] = arguments[a];
                            r.off(e, i), i.__emitterProxy && delete i.__emitterProxy, t.apply(r, o)
                        }

                        return i.__emitterProxy = t, r.on(e, i, n)
                    }, onAny: function (e, t) {
                        var n = this;
                        if ("function" != typeof e) return n;
                        var r = t ? "unshift" : "push";
                        return n.eventsAnyListeners.indexOf(e) < 0 && n.eventsAnyListeners[r](e), n
                    }, offAny: function (e) {
                        var t = this;
                        if (!t.eventsAnyListeners) return t;
                        var n = t.eventsAnyListeners.indexOf(e);
                        return n >= 0 && t.eventsAnyListeners.splice(n, 1), t
                    }, off: function (e, t) {
                        var n = this;
                        return n.eventsListeners ? (e.split(" ").forEach((function (e) {
                            void 0 === t ? n.eventsListeners[e] = [] : n.eventsListeners[e] && n.eventsListeners[e].forEach((function (r, i) {
                                (r === t || r.__emitterProxy && r.__emitterProxy === t) && n.eventsListeners[e].splice(i, 1)
                            }))
                        })), n) : n
                    }, emit: function () {
                        var e, t, n, r = this;
                        if (!r.eventsListeners) return r;
                        for (var i = arguments.length, o = new Array(i), a = 0; a < i; a++) o[a] = arguments[a];
                        return "string" == typeof o[0] || Array.isArray(o[0]) ? (e = o[0], t = o.slice(1, o.length), n = r) : (e = o[0].events, t = o[0].data, n = o[0].context || r), t.unshift(n), (Array.isArray(e) ? e : e.split(" ")).forEach((function (e) {
                            r.eventsAnyListeners && r.eventsAnyListeners.length && r.eventsAnyListeners.forEach((function (r) {
                                r.apply(n, [e].concat(l(t)))
                            })), r.eventsListeners && r.eventsListeners[e] && r.eventsListeners[e].forEach((function (e) {
                                e.apply(n, t)
                            }))
                        })), r
                    }
                };

                function R(e) {
                    var t = e.swiper, n = e.runCallbacks, r = e.direction, i = e.step, o = t.activeIndex,
                        a = t.previousIndex, s = r;
                    if (s || (s = o > a ? "next" : o < a ? "prev" : "reset"), t.emit("transition".concat(i)), n && o !== a) {
                        if ("reset" === s) return void t.emit("slideResetTransition".concat(i));
                        t.emit("slideChangeTransition".concat(i)), "next" === s ? t.emit("slideNextTransition".concat(i)) : t.emit("slidePrevTransition".concat(i))
                    }
                }

                function B(e) {
                    var t = this, n = r(), i = o(), a = t.touchEventsData, s = t.params, l = t.touches;
                    if (t.enabled && (!t.animating || !s.preventInteractionOnTransition)) {
                        !t.animating && s.cssMode && s.loop && t.loopFix();
                        var c = e;
                        c.originalEvent && (c = c.originalEvent);
                        var u = v(c.target);
                        if (("wrapper" !== s.touchEventsTarget || u.closest(t.wrapperEl).length) && (a.isTouchEvent = "touchstart" === c.type, (a.isTouchEvent || !("which" in c) || 3 !== c.which) && !(!a.isTouchEvent && "button" in c && c.button > 0 || a.isTouched && a.isMoved))) {
                            s.noSwipingClass && "" !== s.noSwipingClass && c.target && c.target.shadowRoot && e.path && e.path[0] && (u = v(e.path[0]));
                            var d = s.noSwipingSelector ? s.noSwipingSelector : ".".concat(s.noSwipingClass),
                                p = !(!c.target || !c.target.shadowRoot);
                            if (s.noSwiping && (p ? function (e) {
                                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this;
                                return function t(n) {
                                    return n && n !== r() && n !== o() ? (n.assignedSlot && (n = n.assignedSlot), n.closest(e) || t(n.getRootNode().host)) : null
                                }(t)
                            }(d, c.target) : u.closest(d)[0])) t.allowClick = !0; else if (!s.swipeHandler || u.closest(s.swipeHandler)[0]) {
                                l.currentX = "touchstart" === c.type ? c.targetTouches[0].pageX : c.pageX, l.currentY = "touchstart" === c.type ? c.targetTouches[0].pageY : c.pageY;
                                var h = l.currentX, f = l.currentY, g = s.edgeSwipeDetection || s.iOSEdgeSwipeDetection,
                                    m = s.edgeSwipeThreshold || s.iOSEdgeSwipeThreshold;
                                if (g && (h <= m || h >= i.innerWidth - m)) {
                                    if ("prevent" !== g) return;
                                    e.preventDefault()
                                }
                                if (Object.assign(a, {
                                    isTouched: !0,
                                    isMoved: !1,
                                    allowTouchCallbacks: !0,
                                    isScrolling: void 0,
                                    startMoving: void 0
                                }), l.startX = h, l.startY = f, a.touchStartTime = T(), t.allowClick = !0, t.updateSize(), t.swipeDirection = void 0, s.threshold > 0 && (a.allowThresholdMove = !1), "touchstart" !== c.type) {
                                    var b = !0;
                                    u.is(a.focusableElements) && (b = !1), n.activeElement && v(n.activeElement).is(a.focusableElements) && n.activeElement !== u[0] && n.activeElement.blur();
                                    var w = b && t.allowTouchMove && s.touchStartPreventDefault;
                                    !s.touchStartForcePreventDefault && !w || u[0].isContentEditable || c.preventDefault()
                                }
                                t.emit("touchStart", c)
                            }
                        }
                    }
                }

                function D(e) {
                    var t = r(), n = this, i = n.touchEventsData, o = n.params, a = n.touches, s = n.rtlTranslate;
                    if (n.enabled) {
                        var l = e;
                        if (l.originalEvent && (l = l.originalEvent), i.isTouched) {
                            if (!i.isTouchEvent || "touchmove" === l.type) {
                                var c = "touchmove" === l.type && l.targetTouches && (l.targetTouches[0] || l.changedTouches[0]),
                                    u = "touchmove" === l.type ? c.pageX : l.pageX,
                                    d = "touchmove" === l.type ? c.pageY : l.pageY;
                                if (l.preventedByNestedSwiper) return a.startX = u, void (a.startY = d);
                                if (!n.allowTouchMove) return n.allowClick = !1, void (i.isTouched && (Object.assign(a, {
                                    startX: u,
                                    startY: d,
                                    currentX: u,
                                    currentY: d
                                }), i.touchStartTime = T()));
                                if (i.isTouchEvent && o.touchReleaseOnEdges && !o.loop) if (n.isVertical()) {
                                    if (d < a.startY && n.translate <= n.maxTranslate() || d > a.startY && n.translate >= n.minTranslate()) return i.isTouched = !1, void (i.isMoved = !1)
                                } else if (u < a.startX && n.translate <= n.maxTranslate() || u > a.startX && n.translate >= n.minTranslate()) return;
                                if (i.isTouchEvent && t.activeElement && l.target === t.activeElement && v(l.target).is(i.focusableElements)) return i.isMoved = !0, void (n.allowClick = !1);
                                if (i.allowTouchCallbacks && n.emit("touchMove", l), !(l.targetTouches && l.targetTouches.length > 1)) {
                                    a.currentX = u, a.currentY = d;
                                    var p, h = a.currentX - a.startX, f = a.currentY - a.startY;
                                    if (!(n.params.threshold && Math.sqrt(Math.pow(h, 2) + Math.pow(f, 2)) < n.params.threshold)) if (void 0 === i.isScrolling && (n.isHorizontal() && a.currentY === a.startY || n.isVertical() && a.currentX === a.startX ? i.isScrolling = !1 : h * h + f * f >= 25 && (p = 180 * Math.atan2(Math.abs(f), Math.abs(h)) / Math.PI, i.isScrolling = n.isHorizontal() ? p > o.touchAngle : 90 - p > o.touchAngle)), i.isScrolling && n.emit("touchMoveOpposite", l), void 0 === i.startMoving && (a.currentX === a.startX && a.currentY === a.startY || (i.startMoving = !0)), i.isScrolling) i.isTouched = !1; else if (i.startMoving) {
                                        n.allowClick = !1, !o.cssMode && l.cancelable && l.preventDefault(), o.touchMoveStopPropagation && !o.nested && l.stopPropagation(), i.isMoved || (o.loop && !o.cssMode && n.loopFix(), i.startTranslate = n.getTranslate(), n.setTransition(0), n.animating && n.$wrapperEl.trigger("webkitTransitionEnd transitionend"), i.allowMomentumBounce = !1, !o.grabCursor || !0 !== n.allowSlideNext && !0 !== n.allowSlidePrev || n.setGrabCursor(!0), n.emit("sliderFirstMove", l)), n.emit("sliderMove", l), i.isMoved = !0;
                                        var g = n.isHorizontal() ? h : f;
                                        a.diff = g, g *= o.touchRatio, s && (g = -g), n.swipeDirection = g > 0 ? "prev" : "next", i.currentTranslate = g + i.startTranslate;
                                        var m = !0, b = o.resistanceRatio;
                                        if (o.touchReleaseOnEdges && (b = 0), g > 0 && i.currentTranslate > n.minTranslate() ? (m = !1, o.resistance && (i.currentTranslate = n.minTranslate() - 1 + Math.pow(-n.minTranslate() + i.startTranslate + g, b))) : g < 0 && i.currentTranslate < n.maxTranslate() && (m = !1, o.resistance && (i.currentTranslate = n.maxTranslate() + 1 - Math.pow(n.maxTranslate() - i.startTranslate - g, b))), m && (l.preventedByNestedSwiper = !0), !n.allowSlideNext && "next" === n.swipeDirection && i.currentTranslate < i.startTranslate && (i.currentTranslate = i.startTranslate), !n.allowSlidePrev && "prev" === n.swipeDirection && i.currentTranslate > i.startTranslate && (i.currentTranslate = i.startTranslate), n.allowSlidePrev || n.allowSlideNext || (i.currentTranslate = i.startTranslate), o.threshold > 0) {
                                            if (!(Math.abs(g) > o.threshold || i.allowThresholdMove)) return void (i.currentTranslate = i.startTranslate);
                                            if (!i.allowThresholdMove) return i.allowThresholdMove = !0, a.startX = a.currentX, a.startY = a.currentY, i.currentTranslate = i.startTranslate, void (a.diff = n.isHorizontal() ? a.currentX - a.startX : a.currentY - a.startY)
                                        }
                                        o.followFinger && !o.cssMode && ((o.freeMode && o.freeMode.enabled && n.freeMode || o.watchSlidesProgress) && (n.updateActiveIndex(), n.updateSlidesClasses()), n.params.freeMode && o.freeMode.enabled && n.freeMode && n.freeMode.onTouchMove(), n.updateProgress(i.currentTranslate), n.setTranslate(i.currentTranslate))
                                    }
                                }
                            }
                        } else i.startMoving && i.isScrolling && n.emit("touchMoveOpposite", l)
                    }
                }

                function H(e) {
                    var t = this, n = t.touchEventsData, r = t.params, i = t.touches, o = t.rtlTranslate,
                        a = t.slidesGrid;
                    if (t.enabled) {
                        var s = e;
                        if (s.originalEvent && (s = s.originalEvent), n.allowTouchCallbacks && t.emit("touchEnd", s), n.allowTouchCallbacks = !1, !n.isTouched) return n.isMoved && r.grabCursor && t.setGrabCursor(!1), n.isMoved = !1, void (n.startMoving = !1);
                        r.grabCursor && n.isMoved && n.isTouched && (!0 === t.allowSlideNext || !0 === t.allowSlidePrev) && t.setGrabCursor(!1);
                        var l, c = T(), u = c - n.touchStartTime;
                        if (t.allowClick && (t.updateClickedSlide(s), t.emit("tap click", s), u < 300 && c - n.lastClickTime < 300 && t.emit("doubleTap doubleClick", s)), n.lastClickTime = T(), E((function () {
                            t.destroyed || (t.allowClick = !0)
                        })), !n.isTouched || !n.isMoved || !t.swipeDirection || 0 === i.diff || n.currentTranslate === n.startTranslate) return n.isTouched = !1, n.isMoved = !1, void (n.startMoving = !1);
                        if (n.isTouched = !1, n.isMoved = !1, n.startMoving = !1, l = r.followFinger ? o ? t.translate : -t.translate : -n.currentTranslate, !r.cssMode) if (t.params.freeMode && r.freeMode.enabled) t.freeMode.onTouchEnd({currentPos: l}); else {
                            for (var d = 0, p = t.slidesSizesGrid[0], h = 0; h < a.length; h += h < r.slidesPerGroupSkip ? 1 : r.slidesPerGroup) {
                                var f = h < r.slidesPerGroupSkip - 1 ? 1 : r.slidesPerGroup;
                                void 0 !== a[h + f] ? l >= a[h] && l < a[h + f] && (d = h, p = a[h + f] - a[h]) : l >= a[h] && (d = h, p = a[a.length - 1] - a[a.length - 2])
                            }
                            var g = (l - a[d]) / p, m = d < r.slidesPerGroupSkip - 1 ? 1 : r.slidesPerGroup;
                            if (u > r.longSwipesMs) {
                                if (!r.longSwipes) return void t.slideTo(t.activeIndex);
                                "next" === t.swipeDirection && (g >= r.longSwipesRatio ? t.slideTo(d + m) : t.slideTo(d)), "prev" === t.swipeDirection && (g > 1 - r.longSwipesRatio ? t.slideTo(d + m) : t.slideTo(d))
                            } else {
                                if (!r.shortSwipes) return void t.slideTo(t.activeIndex);
                                !t.navigation || s.target !== t.navigation.nextEl && s.target !== t.navigation.prevEl ? ("next" === t.swipeDirection && t.slideTo(d + m), "prev" === t.swipeDirection && t.slideTo(d)) : s.target === t.navigation.nextEl ? t.slideTo(d + m) : t.slideTo(d)
                            }
                        }
                    }
                }

                function $() {
                    var e = this, t = e.params, n = e.el;
                    if (!n || 0 !== n.offsetWidth) {
                        t.breakpoints && e.setBreakpoint();
                        var r = e.allowSlideNext, i = e.allowSlidePrev, o = e.snapGrid;
                        e.allowSlideNext = !0, e.allowSlidePrev = !0, e.updateSize(), e.updateSlides(), e.updateSlidesClasses(), ("auto" === t.slidesPerView || t.slidesPerView > 1) && e.isEnd && !e.isBeginning && !e.params.centeredSlides ? e.slideTo(e.slides.length - 1, 0, !1, !0) : e.slideTo(e.activeIndex, 0, !1, !0), e.autoplay && e.autoplay.running && e.autoplay.paused && e.autoplay.run(), e.allowSlidePrev = i, e.allowSlideNext = r, e.params.watchOverflow && o !== e.snapGrid && e.checkOverflow()
                    }
                }

                function q(e) {
                    var t = this;
                    t.enabled && (t.allowClick || (t.params.preventClicks && e.preventDefault(), t.params.preventClicksPropagation && t.animating && (e.stopPropagation(), e.stopImmediatePropagation())))
                }

                function F() {
                    var e = this, t = e.wrapperEl, n = e.rtlTranslate;
                    if (e.enabled) {
                        e.previousTranslate = e.translate, e.isHorizontal() ? e.translate = -t.scrollLeft : e.translate = -t.scrollTop, -0 === e.translate && (e.translate = 0), e.updateActiveIndex(), e.updateSlidesClasses();
                        var r = e.maxTranslate() - e.minTranslate();
                        (0 === r ? 0 : (e.translate - e.minTranslate()) / r) !== e.progress && e.updateProgress(n ? -e.translate : e.translate), e.emit("setTranslate", e.translate, !1)
                    }
                }

                var U = !1;

                function V() {
                }

                var W = function (e, t) {
                    var n = r(), i = e.params, o = e.touchEvents, a = e.el, s = e.wrapperEl, l = e.device,
                        c = e.support, u = !!i.nested, d = "on" === t ? "addEventListener" : "removeEventListener",
                        p = t;
                    if (c.touch) {
                        var h = !("touchstart" !== o.start || !c.passiveListener || !i.passiveListeners) && {
                            passive: !0,
                            capture: !1
                        };
                        a[d](o.start, e.onTouchStart, h), a[d](o.move, e.onTouchMove, c.passiveListener ? {
                            passive: !1,
                            capture: u
                        } : u), a[d](o.end, e.onTouchEnd, h), o.cancel && a[d](o.cancel, e.onTouchEnd, h)
                    } else a[d](o.start, e.onTouchStart, !1), n[d](o.move, e.onTouchMove, u), n[d](o.end, e.onTouchEnd, !1);
                    (i.preventClicks || i.preventClicksPropagation) && a[d]("click", e.onClick, !0), i.cssMode && s[d]("scroll", e.onScroll), i.updateOnWindowResize ? e[p](l.ios || l.android ? "resize orientationchange observerUpdate" : "resize observerUpdate", $, !0) : e[p]("observerUpdate", $, !0)
                }, G = function (e, t) {
                    return e.grid && t.grid && t.grid.rows > 1
                }, K = {
                    init: !0,
                    direction: "horizontal",
                    touchEventsTarget: "wrapper",
                    initialSlide: 0,
                    speed: 300,
                    cssMode: !1,
                    updateOnWindowResize: !0,
                    resizeObserver: !0,
                    nested: !1,
                    createElements: !1,
                    enabled: !0,
                    focusableElements: "input, select, option, textarea, button, video, label",
                    width: null,
                    height: null,
                    preventInteractionOnTransition: !1,
                    userAgent: null,
                    url: null,
                    edgeSwipeDetection: !1,
                    edgeSwipeThreshold: 20,
                    autoHeight: !1,
                    setWrapperSize: !1,
                    virtualTranslate: !1,
                    effect: "slide",
                    breakpoints: void 0,
                    breakpointsBase: "window",
                    spaceBetween: 0,
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    slidesPerGroupSkip: 0,
                    slidesPerGroupAuto: !1,
                    centeredSlides: !1,
                    centeredSlidesBounds: !1,
                    slidesOffsetBefore: 0,
                    slidesOffsetAfter: 0,
                    normalizeSlideIndex: !0,
                    centerInsufficientSlides: !1,
                    watchOverflow: !0,
                    roundLengths: !1,
                    touchRatio: 1,
                    touchAngle: 45,
                    simulateTouch: !0,
                    shortSwipes: !0,
                    longSwipes: !0,
                    longSwipesRatio: .5,
                    longSwipesMs: 300,
                    followFinger: !0,
                    allowTouchMove: !0,
                    threshold: 0,
                    touchMoveStopPropagation: !1,
                    touchStartPreventDefault: !0,
                    touchStartForcePreventDefault: !1,
                    touchReleaseOnEdges: !1,
                    uniqueNavElements: !0,
                    resistance: !0,
                    resistanceRatio: .85,
                    watchSlidesProgress: !1,
                    grabCursor: !1,
                    preventClicks: !0,
                    preventClicksPropagation: !0,
                    slideToClickedSlide: !1,
                    preloadImages: !0,
                    updateOnImagesReady: !0,
                    loop: !1,
                    loopAdditionalSlides: 0,
                    loopedSlides: null,
                    loopFillGroupWithBlank: !1,
                    loopPreventsSlide: !0,
                    allowSlidePrev: !0,
                    allowSlideNext: !0,
                    swipeHandler: null,
                    noSwiping: !0,
                    noSwipingClass: "swiper-no-swiping",
                    noSwipingSelector: null,
                    passiveListeners: !0,
                    containerModifierClass: "swiper-",
                    slideClass: "swiper-slide",
                    slideBlankClass: "swiper-slide-invisible-blank",
                    slideActiveClass: "swiper-slide-active",
                    slideDuplicateActiveClass: "swiper-slide-duplicate-active",
                    slideVisibleClass: "swiper-slide-visible",
                    slideDuplicateClass: "swiper-slide-duplicate",
                    slideNextClass: "swiper-slide-next",
                    slideDuplicateNextClass: "swiper-slide-duplicate-next",
                    slidePrevClass: "swiper-slide-prev",
                    slideDuplicatePrevClass: "swiper-slide-duplicate-prev",
                    wrapperClass: "swiper-wrapper",
                    runCallbacksOnInit: !0,
                    _emitClasses: !1
                };

                function X(e, t) {
                    return function () {
                        var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                            r = Object.keys(n)[0], i = n[r];
                        "object" == _(i) && null !== i ? (["navigation", "pagination", "scrollbar"].indexOf(r) >= 0 && !0 === e[r] && (e[r] = {auto: !0}), r in e && "enabled" in i ? (!0 === e[r] && (e[r] = {enabled: !0}), "object" != _(e[r]) || "enabled" in e[r] || (e[r].enabled = !0), e[r] || (e[r] = {enabled: !1}), P(t, n)) : P(t, n)) : P(t, n)
                    }
                }

                var Z = {
                    eventsEmitter: z, update: {
                        updateSize: function () {
                            var e, t, n = this, r = n.$el;
                            e = void 0 !== n.params.width && null !== n.params.width ? n.params.width : r[0].clientWidth, t = void 0 !== n.params.height && null !== n.params.height ? n.params.height : r[0].clientHeight, 0 === e && n.isHorizontal() || 0 === t && n.isVertical() || (e = e - parseInt(r.css("padding-left") || 0, 10) - parseInt(r.css("padding-right") || 0, 10), t = t - parseInt(r.css("padding-top") || 0, 10) - parseInt(r.css("padding-bottom") || 0, 10), Number.isNaN(e) && (e = 0), Number.isNaN(t) && (t = 0), Object.assign(n, {
                                width: e,
                                height: t,
                                size: n.isHorizontal() ? e : t
                            }))
                        }, updateSlides: function () {
                            var e = this;

                            function t(t) {
                                return e.isHorizontal() ? t : {
                                    width: "height",
                                    "margin-top": "margin-left",
                                    "margin-bottom ": "margin-right",
                                    "margin-left": "margin-top",
                                    "margin-right": "margin-bottom",
                                    "padding-left": "padding-top",
                                    "padding-right": "padding-bottom",
                                    marginRight: "marginBottom"
                                }[t]
                            }

                            function n(e, n) {
                                return parseFloat(e.getPropertyValue(t(n)) || 0)
                            }

                            var r = e.params, i = e.$wrapperEl, o = e.size, s = e.rtlTranslate, l = e.wrongRTL,
                                c = e.virtual && r.virtual.enabled, u = c ? e.virtual.slides.length : e.slides.length,
                                d = i.children(".".concat(e.params.slideClass)),
                                p = c ? e.virtual.slides.length : d.length, h = [], f = [], g = [],
                                m = r.slidesOffsetBefore;
                            "function" == typeof m && (m = r.slidesOffsetBefore.call(e));
                            var v = r.slidesOffsetAfter;
                            "function" == typeof v && (v = r.slidesOffsetAfter.call(e));
                            var b = e.snapGrid.length, w = e.slidesGrid.length, y = r.spaceBetween, _ = -m, k = 0,
                                x = 0;
                            if (void 0 !== o) {
                                "string" == typeof y && y.indexOf("%") >= 0 && (y = parseFloat(y.replace("%", "")) / 100 * o), e.virtualSize = -y, s ? d.css({
                                    marginLeft: "",
                                    marginBottom: "",
                                    marginTop: ""
                                }) : d.css({
                                    marginRight: "",
                                    marginBottom: "",
                                    marginTop: ""
                                }), r.centeredSlides && r.cssMode && (M(e.wrapperEl, "--swiper-centered-offset-before", ""), M(e.wrapperEl, "--swiper-centered-offset-after", ""));
                                var S, C = r.grid && r.grid.rows > 1 && e.grid;
                                C && e.grid.initSlides(p);
                                for (var E = "auto" === r.slidesPerView && r.breakpoints && Object.keys(r.breakpoints).filter((function (e) {
                                    return void 0 !== r.breakpoints[e].slidesPerView
                                })).length > 0, T = 0; T < p; T += 1) {
                                    S = 0;
                                    var A = d.eq(T);
                                    if (C && e.grid.updateSlide(T, A, p, t), "none" !== A.css("display")) {
                                        if ("auto" === r.slidesPerView) {
                                            E && (d[T].style[t("width")] = "");
                                            var O = getComputedStyle(A[0]), P = A[0].style.transform,
                                                L = A[0].style.webkitTransform;
                                            if (P && (A[0].style.transform = "none"), L && (A[0].style.webkitTransform = "none"), r.roundLengths) S = e.isHorizontal() ? A.outerWidth(!0) : A.outerHeight(!0); else {
                                                var j = n(O, "width"), N = n(O, "padding-left"),
                                                    I = n(O, "padding-right"), z = n(O, "margin-left"),
                                                    R = n(O, "margin-right"), B = O.getPropertyValue("box-sizing");
                                                if (B && "border-box" === B) S = j + z + R; else {
                                                    var D = A[0], H = D.clientWidth;
                                                    S = j + N + I + z + R + (D.offsetWidth - H)
                                                }
                                            }
                                            P && (A[0].style.transform = P), L && (A[0].style.webkitTransform = L), r.roundLengths && (S = Math.floor(S))
                                        } else S = (o - (r.slidesPerView - 1) * y) / r.slidesPerView, r.roundLengths && (S = Math.floor(S)), d[T] && (d[T].style[t("width")] = "".concat(S, "px"));
                                        d[T] && (d[T].swiperSlideSize = S), g.push(S), r.centeredSlides ? (_ = _ + S / 2 + k / 2 + y, 0 === k && 0 !== T && (_ = _ - o / 2 - y), 0 === T && (_ = _ - o / 2 - y), Math.abs(_) < 0.001 && (_ = 0), r.roundLengths && (_ = Math.floor(_)), x % r.slidesPerGroup == 0 && h.push(_), f.push(_)) : (r.roundLengths && (_ = Math.floor(_)), (x - Math.min(e.params.slidesPerGroupSkip, x)) % e.params.slidesPerGroup == 0 && h.push(_), f.push(_), _ = _ + S + y), e.virtualSize += S + y, k = S, x += 1
                                    }
                                }
                                if (e.virtualSize = Math.max(e.virtualSize, o) + v, s && l && ("slide" === r.effect || "coverflow" === r.effect) && i.css({width: "".concat(e.virtualSize + r.spaceBetween, "px")}), r.setWrapperSize && i.css(a({}, t("width"), "".concat(e.virtualSize + r.spaceBetween, "px"))), C && e.grid.updateWrapperSize(S, h, t), !r.centeredSlides) {
                                    for (var $ = [], q = 0; q < h.length; q += 1) {
                                        var F = h[q];
                                        r.roundLengths && (F = Math.floor(F)), h[q] <= e.virtualSize - o && $.push(F)
                                    }
                                    h = $, Math.floor(e.virtualSize - o) - Math.floor(h[h.length - 1]) > 1 && h.push(e.virtualSize - o)
                                }
                                if (0 === h.length && (h = [0]), 0 !== r.spaceBetween) {
                                    var U = e.isHorizontal() && s ? "marginLeft" : t("marginRight");
                                    d.filter((function (e, t) {
                                        return !r.cssMode || t !== d.length - 1
                                    })).css(a({}, U, "".concat(y, "px")))
                                }
                                if (r.centeredSlides && r.centeredSlidesBounds) {
                                    var V = 0;
                                    g.forEach((function (e) {
                                        V += e + (r.spaceBetween ? r.spaceBetween : 0)
                                    }));
                                    var W = (V -= r.spaceBetween) - o;
                                    h = h.map((function (e) {
                                        return e < 0 ? -m : e > W ? W + v : e
                                    }))
                                }
                                if (r.centerInsufficientSlides) {
                                    var G = 0;
                                    if (g.forEach((function (e) {
                                        G += e + (r.spaceBetween ? r.spaceBetween : 0)
                                    })), (G -= r.spaceBetween) < o) {
                                        var K = (o - G) / 2;
                                        h.forEach((function (e, t) {
                                            h[t] = e - K
                                        })), f.forEach((function (e, t) {
                                            f[t] = e + K
                                        }))
                                    }
                                }
                                if (Object.assign(e, {
                                    slides: d,
                                    snapGrid: h,
                                    slidesGrid: f,
                                    slidesSizesGrid: g
                                }), r.centeredSlides && r.cssMode && !r.centeredSlidesBounds) {
                                    M(e.wrapperEl, "--swiper-centered-offset-before", -h[0] + "px"), M(e.wrapperEl, "--swiper-centered-offset-after", e.size / 2 - g[g.length - 1] / 2 + "px");
                                    var X = -e.snapGrid[0], Z = -e.slidesGrid[0];
                                    e.snapGrid = e.snapGrid.map((function (e) {
                                        return e + X
                                    })), e.slidesGrid = e.slidesGrid.map((function (e) {
                                        return e + Z
                                    }))
                                }
                                p !== u && e.emit("slidesLengthChange"), h.length !== b && (e.params.watchOverflow && e.checkOverflow(), e.emit("snapGridLengthChange")), f.length !== w && e.emit("slidesGridLengthChange"), r.watchSlidesProgress && e.updateSlidesOffset()
                            }
                        }, updateAutoHeight: function (e) {
                            var t, n = this, r = [], i = n.virtual && n.params.virtual.enabled, o = 0;
                            "number" == typeof e ? n.setTransition(e) : !0 === e && n.setTransition(n.params.speed);
                            var a = function (e) {
                                return i ? n.slides.filter((function (t) {
                                    return parseInt(t.getAttribute("data-swiper-slide-index"), 10) === e
                                }))[0] : n.slides.eq(e)[0]
                            };
                            if ("auto" !== n.params.slidesPerView && n.params.slidesPerView > 1) if (n.params.centeredSlides) n.visibleSlides.each((function (e) {
                                r.push(e)
                            })); else for (t = 0; t < Math.ceil(n.params.slidesPerView); t += 1) {
                                var s = n.activeIndex + t;
                                if (s > n.slides.length && !i) break;
                                r.push(a(s))
                            } else r.push(a(n.activeIndex));
                            for (t = 0; t < r.length; t += 1) if (void 0 !== r[t]) {
                                var l = r[t].offsetHeight;
                                o = l > o ? l : o
                            }
                            o && n.$wrapperEl.css("height", "".concat(o, "px"))
                        }, updateSlidesOffset: function () {
                            for (var e = this.slides, t = 0; t < e.length; t += 1) e[t].swiperSlideOffset = this.isHorizontal() ? e[t].offsetLeft : e[t].offsetTop
                        }, updateSlidesProgress: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this && this.translate || 0,
                                t = this, n = t.params, r = t.slides, i = t.rtlTranslate, o = t.snapGrid;
                            if (0 !== r.length) {
                                void 0 === r[0].swiperSlideOffset && t.updateSlidesOffset();
                                var a = -e;
                                i && (a = e), r.removeClass(n.slideVisibleClass), t.visibleSlidesIndexes = [], t.visibleSlides = [];
                                for (var s = 0; s < r.length; s += 1) {
                                    var l = r[s], c = l.swiperSlideOffset;
                                    n.cssMode && n.centeredSlides && (c -= r[0].swiperSlideOffset);
                                    var u = (a + (n.centeredSlides ? t.minTranslate() : 0) - c) / (l.swiperSlideSize + n.spaceBetween),
                                        d = (a - o[0] + (n.centeredSlides ? t.minTranslate() : 0) - c) / (l.swiperSlideSize + n.spaceBetween),
                                        p = -(a - c), h = p + t.slidesSizesGrid[s];
                                    (p >= 0 && p < t.size - 1 || h > 1 && h <= t.size || p <= 0 && h >= t.size) && (t.visibleSlides.push(l), t.visibleSlidesIndexes.push(s), r.eq(s).addClass(n.slideVisibleClass)), l.progress = i ? -u : u, l.originalProgress = i ? -d : d
                                }
                                t.visibleSlides = v(t.visibleSlides)
                            }
                        }, updateProgress: function (e) {
                            var t = this;
                            if (void 0 === e) {
                                var n = t.rtlTranslate ? -1 : 1;
                                e = t && t.translate && t.translate * n || 0
                            }
                            var r = t.params, i = t.maxTranslate() - t.minTranslate(), o = t.progress,
                                a = t.isBeginning, s = t.isEnd, l = a, c = s;
                            0 === i ? (o = 0, a = !0, s = !0) : (a = (o = (e - t.minTranslate()) / i) <= 0, s = o >= 1), Object.assign(t, {
                                progress: o,
                                isBeginning: a,
                                isEnd: s
                            }), (r.watchSlidesProgress || r.centeredSlides && r.autoHeight) && t.updateSlidesProgress(e), a && !l && t.emit("reachBeginning toEdge"), s && !c && t.emit("reachEnd toEdge"), (l && !a || c && !s) && t.emit("fromEdge"), t.emit("progress", o)
                        }, updateSlidesClasses: function () {
                            var e, t = this, n = t.slides, r = t.params, i = t.$wrapperEl, o = t.activeIndex,
                                a = t.realIndex, s = t.virtual && r.virtual.enabled;
                            n.removeClass("".concat(r.slideActiveClass, " ").concat(r.slideNextClass, " ").concat(r.slidePrevClass, " ").concat(r.slideDuplicateActiveClass, " ").concat(r.slideDuplicateNextClass, " ").concat(r.slideDuplicatePrevClass)), (e = s ? t.$wrapperEl.find(".".concat(r.slideClass, '[data-swiper-slide-index="').concat(o, '"]')) : n.eq(o)).addClass(r.slideActiveClass), r.loop && (e.hasClass(r.slideDuplicateClass) ? i.children(".".concat(r.slideClass, ":not(.").concat(r.slideDuplicateClass, ')[data-swiper-slide-index="').concat(a, '"]')).addClass(r.slideDuplicateActiveClass) : i.children(".".concat(r.slideClass, ".").concat(r.slideDuplicateClass, '[data-swiper-slide-index="').concat(a, '"]')).addClass(r.slideDuplicateActiveClass));
                            var l = e.nextAll(".".concat(r.slideClass)).eq(0).addClass(r.slideNextClass);
                            r.loop && 0 === l.length && (l = n.eq(0)).addClass(r.slideNextClass);
                            var c = e.prevAll(".".concat(r.slideClass)).eq(0).addClass(r.slidePrevClass);
                            r.loop && 0 === c.length && (c = n.eq(-1)).addClass(r.slidePrevClass), r.loop && (l.hasClass(r.slideDuplicateClass) ? i.children(".".concat(r.slideClass, ":not(.").concat(r.slideDuplicateClass, ')[data-swiper-slide-index="').concat(l.attr("data-swiper-slide-index"), '"]')).addClass(r.slideDuplicateNextClass) : i.children(".".concat(r.slideClass, ".").concat(r.slideDuplicateClass, '[data-swiper-slide-index="').concat(l.attr("data-swiper-slide-index"), '"]')).addClass(r.slideDuplicateNextClass), c.hasClass(r.slideDuplicateClass) ? i.children(".".concat(r.slideClass, ":not(.").concat(r.slideDuplicateClass, ')[data-swiper-slide-index="').concat(c.attr("data-swiper-slide-index"), '"]')).addClass(r.slideDuplicatePrevClass) : i.children(".".concat(r.slideClass, ".").concat(r.slideDuplicateClass, '[data-swiper-slide-index="').concat(c.attr("data-swiper-slide-index"), '"]')).addClass(r.slideDuplicatePrevClass)), t.emitSlidesClasses()
                        }, updateActiveIndex: function (e) {
                            var t, n = this, r = n.rtlTranslate ? n.translate : -n.translate, i = n.slidesGrid,
                                o = n.snapGrid, a = n.params, s = n.activeIndex, l = n.realIndex, c = n.snapIndex,
                                u = e;
                            if (void 0 === u) {
                                for (var d = 0; d < i.length; d += 1) void 0 !== i[d + 1] ? r >= i[d] && r < i[d + 1] - (i[d + 1] - i[d]) / 2 ? u = d : r >= i[d] && r < i[d + 1] && (u = d + 1) : r >= i[d] && (u = d);
                                a.normalizeSlideIndex && (u < 0 || void 0 === u) && (u = 0)
                            }
                            if (o.indexOf(r) >= 0) t = o.indexOf(r); else {
                                var p = Math.min(a.slidesPerGroupSkip, u);
                                t = p + Math.floor((u - p) / a.slidesPerGroup)
                            }
                            if (t >= o.length && (t = o.length - 1), u !== s) {
                                var h = parseInt(n.slides.eq(u).attr("data-swiper-slide-index") || u, 10);
                                Object.assign(n, {
                                    snapIndex: t,
                                    realIndex: h,
                                    previousIndex: s,
                                    activeIndex: u
                                }), n.emit("activeIndexChange"), n.emit("snapIndexChange"), l !== h && n.emit("realIndexChange"), (n.initialized || n.params.runCallbacksOnInit) && n.emit("slideChange")
                            } else t !== c && (n.snapIndex = t, n.emit("snapIndexChange"))
                        }, updateClickedSlide: function (e) {
                            var t, n = this, r = n.params, i = v(e.target).closest(".".concat(r.slideClass))[0], o = !1;
                            if (i) for (var a = 0; a < n.slides.length; a += 1) if (n.slides[a] === i) {
                                o = !0, t = a;
                                break
                            }
                            if (!i || !o) return n.clickedSlide = void 0, void (n.clickedIndex = void 0);
                            n.clickedSlide = i, n.virtual && n.params.virtual.enabled ? n.clickedIndex = parseInt(v(i).attr("data-swiper-slide-index"), 10) : n.clickedIndex = t, r.slideToClickedSlide && void 0 !== n.clickedIndex && n.clickedIndex !== n.activeIndex && n.slideToClickedSlide()
                        }
                    }, translate: {
                        getTranslate: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.isHorizontal() ? "x" : "y",
                                t = this.params, n = this.rtlTranslate, r = this.translate, i = this.$wrapperEl;
                            if (t.virtualTranslate) return n ? -r : r;
                            if (t.cssMode) return r;
                            var o = A(i[0], e);
                            return n && (o = -o), o || 0
                        }, setTranslate: function (e, t) {
                            var n = this, r = n.rtlTranslate, i = n.params, o = n.$wrapperEl, a = n.wrapperEl,
                                s = n.progress, l = 0, c = 0;
                            n.isHorizontal() ? l = r ? -e : e : c = e, i.roundLengths && (l = Math.floor(l), c = Math.floor(c)), i.cssMode ? a[n.isHorizontal() ? "scrollLeft" : "scrollTop"] = n.isHorizontal() ? -l : -c : i.virtualTranslate || o.transform("translate3d(".concat(l, "px, ").concat(c, "px, 0px)")), n.previousTranslate = n.translate, n.translate = n.isHorizontal() ? l : c;
                            var u = n.maxTranslate() - n.minTranslate();
                            (0 === u ? 0 : (e - n.minTranslate()) / u) !== s && n.updateProgress(e), n.emit("setTranslate", n.translate, t)
                        }, minTranslate: function () {
                            return -this.snapGrid[0]
                        }, maxTranslate: function () {
                            return -this.snapGrid[this.snapGrid.length - 1]
                        }, translateTo: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.params.speed,
                                n = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2],
                                r = !(arguments.length > 3 && void 0 !== arguments[3]) || arguments[3],
                                i = arguments.length > 4 ? arguments[4] : void 0, o = this, s = o.params,
                                l = o.wrapperEl;
                            if (o.animating && s.preventInteractionOnTransition) return !1;
                            var c, u = o.minTranslate(), d = o.maxTranslate();
                            if (c = r && e > u ? u : r && e < d ? d : e, o.updateProgress(c), s.cssMode) {
                                var p = o.isHorizontal();
                                if (0 === t) l[p ? "scrollLeft" : "scrollTop"] = -c; else {
                                    var h;
                                    if (!o.support.smoothScroll) return L({
                                        swiper: o,
                                        targetPosition: -c,
                                        side: p ? "left" : "top"
                                    }), !0;
                                    l.scrollTo((a(h = {}, p ? "left" : "top", -c), a(h, "behavior", "smooth"), h))
                                }
                                return !0
                            }
                            return 0 === t ? (o.setTransition(0), o.setTranslate(c), n && (o.emit("beforeTransitionStart", t, i), o.emit("transitionEnd"))) : (o.setTransition(t), o.setTranslate(c), n && (o.emit("beforeTransitionStart", t, i), o.emit("transitionStart")), o.animating || (o.animating = !0, o.onTranslateToWrapperTransitionEnd || (o.onTranslateToWrapperTransitionEnd = function (e) {
                                o && !o.destroyed && e.target === this && (o.$wrapperEl[0].removeEventListener("transitionend", o.onTranslateToWrapperTransitionEnd), o.$wrapperEl[0].removeEventListener("webkitTransitionEnd", o.onTranslateToWrapperTransitionEnd), o.onTranslateToWrapperTransitionEnd = null, delete o.onTranslateToWrapperTransitionEnd, n && o.emit("transitionEnd"))
                            }), o.$wrapperEl[0].addEventListener("transitionend", o.onTranslateToWrapperTransitionEnd), o.$wrapperEl[0].addEventListener("webkitTransitionEnd", o.onTranslateToWrapperTransitionEnd))), !0
                        }
                    }, transition: {
                        setTransition: function (e, t) {
                            var n = this;
                            n.params.cssMode || n.$wrapperEl.transition(e), n.emit("setTransition", e, t)
                        }, transitionStart: function () {
                            var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0],
                                t = arguments.length > 1 ? arguments[1] : void 0, n = this, r = n.params;
                            r.cssMode || (r.autoHeight && n.updateAutoHeight(), R({
                                swiper: n,
                                runCallbacks: e,
                                direction: t,
                                step: "Start"
                            }))
                        }, transitionEnd: function () {
                            var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0],
                                t = arguments.length > 1 ? arguments[1] : void 0, n = this, r = n.params;
                            n.animating = !1, r.cssMode || (n.setTransition(0), R({
                                swiper: n,
                                runCallbacks: e,
                                direction: t,
                                step: "End"
                            }))
                        }
                    }, slide: {
                        slideTo: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.params.speed,
                                n = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2],
                                r = arguments.length > 3 ? arguments[3] : void 0,
                                i = arguments.length > 4 ? arguments[4] : void 0;
                            if ("number" != typeof e && "string" != typeof e) throw new Error("The 'index' argument cannot have type other than 'number' or 'string'. [".concat(_(e), "] given."));
                            if ("string" == typeof e) {
                                var o = parseInt(e, 10);
                                if (!isFinite(o)) throw new Error("The passed-in 'index' (string) couldn't be converted to 'number'. [".concat(e, "] given."));
                                e = o
                            }
                            var s = this, l = e;
                            l < 0 && (l = 0);
                            var c = s.params, u = s.snapGrid, d = s.slidesGrid, p = s.previousIndex, h = s.activeIndex,
                                f = s.rtlTranslate, g = s.wrapperEl, m = s.enabled;
                            if (s.animating && c.preventInteractionOnTransition || !m && !r && !i) return !1;
                            var v = Math.min(s.params.slidesPerGroupSkip, l),
                                b = v + Math.floor((l - v) / s.params.slidesPerGroup);
                            b >= u.length && (b = u.length - 1), (h || c.initialSlide || 0) === (p || 0) && n && s.emit("beforeSlideChangeStart");
                            var w, y = -u[b];
                            if (s.updateProgress(y), c.normalizeSlideIndex) for (var k = 0; k < d.length; k += 1) {
                                var x = -Math.floor(100 * y), S = Math.floor(100 * d[k]),
                                    C = Math.floor(100 * d[k + 1]);
                                void 0 !== d[k + 1] ? x >= S && x < C - (C - S) / 2 ? l = k : x >= S && x < C && (l = k + 1) : x >= S && (l = k)
                            }
                            if (s.initialized && l !== h) {
                                if (!s.allowSlideNext && y < s.translate && y < s.minTranslate()) return !1;
                                if (!s.allowSlidePrev && y > s.translate && y > s.maxTranslate() && (h || 0) !== l) return !1
                            }
                            if (w = l > h ? "next" : l < h ? "prev" : "reset", f && -y === s.translate || !f && y === s.translate) return s.updateActiveIndex(l), c.autoHeight && s.updateAutoHeight(), s.updateSlidesClasses(), "slide" !== c.effect && s.setTranslate(y), "reset" !== w && (s.transitionStart(n, w), s.transitionEnd(n, w)), !1;
                            if (c.cssMode) {
                                var E = s.isHorizontal(), T = f ? y : -y;
                                if (0 === t) {
                                    var A = s.virtual && s.params.virtual.enabled;
                                    A && (s.wrapperEl.style.scrollSnapType = "none", s._immediateVirtual = !0), g[E ? "scrollLeft" : "scrollTop"] = T, A && requestAnimationFrame((function () {
                                        s.wrapperEl.style.scrollSnapType = "", s._swiperImmediateVirtual = !1
                                    }))
                                } else {
                                    var O;
                                    if (!s.support.smoothScroll) return L({
                                        swiper: s,
                                        targetPosition: T,
                                        side: E ? "left" : "top"
                                    }), !0;
                                    g.scrollTo((a(O = {}, E ? "left" : "top", T), a(O, "behavior", "smooth"), O))
                                }
                                return !0
                            }
                            return 0 === t ? (s.setTransition(0), s.setTranslate(y), s.updateActiveIndex(l), s.updateSlidesClasses(), s.emit("beforeTransitionStart", t, r), s.transitionStart(n, w), s.transitionEnd(n, w)) : (s.setTransition(t), s.setTranslate(y), s.updateActiveIndex(l), s.updateSlidesClasses(), s.emit("beforeTransitionStart", t, r), s.transitionStart(n, w), s.animating || (s.animating = !0, s.onSlideToWrapperTransitionEnd || (s.onSlideToWrapperTransitionEnd = function (e) {
                                s && !s.destroyed && e.target === this && (s.$wrapperEl[0].removeEventListener("transitionend", s.onSlideToWrapperTransitionEnd), s.$wrapperEl[0].removeEventListener("webkitTransitionEnd", s.onSlideToWrapperTransitionEnd), s.onSlideToWrapperTransitionEnd = null, delete s.onSlideToWrapperTransitionEnd, s.transitionEnd(n, w))
                            }), s.$wrapperEl[0].addEventListener("transitionend", s.onSlideToWrapperTransitionEnd), s.$wrapperEl[0].addEventListener("webkitTransitionEnd", s.onSlideToWrapperTransitionEnd))), !0
                        }, slideToLoop: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.params.speed,
                                n = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2],
                                r = arguments.length > 3 ? arguments[3] : void 0, i = this, o = e;
                            return i.params.loop && (o += i.loopedSlides), i.slideTo(o, t, n, r)
                        }, slideNext: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.params.speed,
                                t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
                                n = arguments.length > 2 ? arguments[2] : void 0, r = this, i = r.animating,
                                o = r.enabled, a = r.params;
                            if (!o) return r;
                            var s = a.slidesPerGroup;
                            "auto" === a.slidesPerView && 1 === a.slidesPerGroup && a.slidesPerGroupAuto && (s = Math.max(r.slidesPerViewDynamic("current", !0), 1));
                            var l = r.activeIndex < a.slidesPerGroupSkip ? 1 : s;
                            if (a.loop) {
                                if (i && a.loopPreventsSlide) return !1;
                                r.loopFix(), r._clientLeft = r.$wrapperEl[0].clientLeft
                            }
                            return r.slideTo(r.activeIndex + l, e, t, n)
                        }, slidePrev: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.params.speed,
                                t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
                                n = arguments.length > 2 ? arguments[2] : void 0, r = this, i = r.params,
                                o = r.animating, a = r.snapGrid, s = r.slidesGrid, l = r.rtlTranslate, c = r.enabled;
                            if (!c) return r;
                            if (i.loop) {
                                if (o && i.loopPreventsSlide) return !1;
                                r.loopFix(), r._clientLeft = r.$wrapperEl[0].clientLeft
                            }

                            function u(e) {
                                return e < 0 ? -Math.floor(Math.abs(e)) : Math.floor(e)
                            }

                            var d, p = u(l ? r.translate : -r.translate), h = a.map((function (e) {
                                return u(e)
                            })), f = a[h.indexOf(p) - 1];
                            void 0 === f && i.cssMode && (a.forEach((function (e, t) {
                                p >= e && (d = t)
                            })), void 0 !== d && (f = a[d > 0 ? d - 1 : d]));
                            var g = 0;
                            return void 0 !== f && ((g = s.indexOf(f)) < 0 && (g = r.activeIndex - 1), "auto" === i.slidesPerView && 1 === i.slidesPerGroup && i.slidesPerGroupAuto && (g = g - r.slidesPerViewDynamic("previous", !0) + 1, g = Math.max(g, 0))), r.slideTo(g, e, t, n)
                        }, slideReset: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.params.speed,
                                t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
                                n = arguments.length > 2 ? arguments[2] : void 0;
                            return this.slideTo(this.activeIndex, e, t, n)
                        }, slideToClosest: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.params.speed,
                                t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
                                n = arguments.length > 2 ? arguments[2] : void 0,
                                r = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : .5, i = this,
                                o = i.activeIndex, a = Math.min(i.params.slidesPerGroupSkip, o),
                                s = a + Math.floor((o - a) / i.params.slidesPerGroup),
                                l = i.rtlTranslate ? i.translate : -i.translate;
                            if (l >= i.snapGrid[s]) {
                                var c = i.snapGrid[s];
                                l - c > (i.snapGrid[s + 1] - c) * r && (o += i.params.slidesPerGroup)
                            } else {
                                var u = i.snapGrid[s - 1];
                                l - u <= (i.snapGrid[s] - u) * r && (o -= i.params.slidesPerGroup)
                            }
                            return o = Math.max(o, 0), o = Math.min(o, i.slidesGrid.length - 1), i.slideTo(o, e, t, n)
                        }, slideToClickedSlide: function () {
                            var e, t = this, n = t.params, r = t.$wrapperEl,
                                i = "auto" === n.slidesPerView ? t.slidesPerViewDynamic() : n.slidesPerView,
                                o = t.clickedIndex;
                            if (n.loop) {
                                if (t.animating) return;
                                e = parseInt(v(t.clickedSlide).attr("data-swiper-slide-index"), 10), n.centeredSlides ? o < t.loopedSlides - i / 2 || o > t.slides.length - t.loopedSlides + i / 2 ? (t.loopFix(), o = r.children(".".concat(n.slideClass, '[data-swiper-slide-index="').concat(e, '"]:not(.').concat(n.slideDuplicateClass, ")")).eq(0).index(), E((function () {
                                    t.slideTo(o)
                                }))) : t.slideTo(o) : o > t.slides.length - i ? (t.loopFix(), o = r.children(".".concat(n.slideClass, '[data-swiper-slide-index="').concat(e, '"]:not(.').concat(n.slideDuplicateClass, ")")).eq(0).index(), E((function () {
                                    t.slideTo(o)
                                }))) : t.slideTo(o)
                            } else t.slideTo(o)
                        }
                    }, loop: {
                        loopCreate: function () {
                            var e = this, t = r(), n = e.params, i = v(e.$wrapperEl.children()[0].parentNode);
                            i.children(".".concat(n.slideClass, ".").concat(n.slideDuplicateClass)).remove();
                            var o = i.children(".".concat(n.slideClass));
                            if (n.loopFillGroupWithBlank) {
                                var a = n.slidesPerGroup - o.length % n.slidesPerGroup;
                                if (a !== n.slidesPerGroup) {
                                    for (var s = 0; s < a; s += 1) {
                                        var l = v(t.createElement("div")).addClass("".concat(n.slideClass, " ").concat(n.slideBlankClass));
                                        i.append(l)
                                    }
                                    o = i.children(".".concat(n.slideClass))
                                }
                            }
                            "auto" !== n.slidesPerView || n.loopedSlides || (n.loopedSlides = o.length), e.loopedSlides = Math.ceil(parseFloat(n.loopedSlides || n.slidesPerView, 10)), e.loopedSlides += n.loopAdditionalSlides, e.loopedSlides > o.length && (e.loopedSlides = o.length);
                            var c = [], u = [];
                            o.each((function (t, n) {
                                var r = v(t);
                                n < e.loopedSlides && u.push(t), n < o.length && n >= o.length - e.loopedSlides && c.push(t), r.attr("data-swiper-slide-index", n)
                            }));
                            for (var d = 0; d < u.length; d += 1) i.append(v(u[d].cloneNode(!0)).addClass(n.slideDuplicateClass));
                            for (var p = c.length - 1; p >= 0; p -= 1) i.prepend(v(c[p].cloneNode(!0)).addClass(n.slideDuplicateClass))
                        }, loopFix: function () {
                            var e = this;
                            e.emit("beforeLoopFix");
                            var t, n = e.activeIndex, r = e.slides, i = e.loopedSlides, o = e.allowSlidePrev,
                                a = e.allowSlideNext, s = e.snapGrid, l = e.rtlTranslate;
                            e.allowSlidePrev = !0, e.allowSlideNext = !0;
                            var c = -s[n] - e.getTranslate();
                            n < i ? (t = r.length - 3 * i + n, t += i, e.slideTo(t, 0, !1, !0) && 0 !== c && e.setTranslate((l ? -e.translate : e.translate) - c)) : n >= r.length - i && (t = -r.length + n + i, t += i, e.slideTo(t, 0, !1, !0) && 0 !== c && e.setTranslate((l ? -e.translate : e.translate) - c)), e.allowSlidePrev = o, e.allowSlideNext = a, e.emit("loopFix")
                        }, loopDestroy: function () {
                            var e = this.$wrapperEl, t = this.params, n = this.slides;
                            e.children(".".concat(t.slideClass, ".").concat(t.slideDuplicateClass, ",.").concat(t.slideClass, ".").concat(t.slideBlankClass)).remove(), n.removeAttr("data-swiper-slide-index")
                        }
                    }, grabCursor: {
                        setGrabCursor: function (e) {
                            var t = this;
                            if (!(t.support.touch || !t.params.simulateTouch || t.params.watchOverflow && t.isLocked || t.params.cssMode)) {
                                var n = "container" === t.params.touchEventsTarget ? t.el : t.wrapperEl;
                                n.style.cursor = "move", n.style.cursor = e ? "-webkit-grabbing" : "-webkit-grab", n.style.cursor = e ? "-moz-grabbin" : "-moz-grab", n.style.cursor = e ? "grabbing" : "grab"
                            }
                        }, unsetGrabCursor: function () {
                            var e = this;
                            e.support.touch || e.params.watchOverflow && e.isLocked || e.params.cssMode || (e["container" === e.params.touchEventsTarget ? "el" : "wrapperEl"].style.cursor = "")
                        }
                    }, events: {
                        attachEvents: function () {
                            var e = this, t = r(), n = e.params, i = e.support;
                            e.onTouchStart = B.bind(e), e.onTouchMove = D.bind(e), e.onTouchEnd = H.bind(e), n.cssMode && (e.onScroll = F.bind(e)), e.onClick = q.bind(e), i.touch && !U && (t.addEventListener("touchstart", V), U = !0), W(e, "on")
                        }, detachEvents: function () {
                            W(this, "off")
                        }
                    }, breakpoints: {
                        setBreakpoint: function () {
                            var e = this, t = e.activeIndex, n = e.initialized, r = e.loopedSlides,
                                i = void 0 === r ? 0 : r, o = e.params, a = e.$el, s = o.breakpoints;
                            if (s && (!s || 0 !== Object.keys(s).length)) {
                                var l = e.getBreakpoint(s, e.params.breakpointsBase, e.el);
                                if (l && e.currentBreakpoint !== l) {
                                    var c = (l in s ? s[l] : void 0) || e.originalParams, u = G(e, o), d = G(e, c),
                                        p = o.enabled;
                                    u && !d ? (a.removeClass("".concat(o.containerModifierClass, "grid ").concat(o.containerModifierClass, "grid-column")), e.emitContainerClasses()) : !u && d && (a.addClass("".concat(o.containerModifierClass, "grid")), (c.grid.fill && "column" === c.grid.fill || !c.grid.fill && "column" === o.grid.fill) && a.addClass("".concat(o.containerModifierClass, "grid-column")), e.emitContainerClasses());
                                    var h = c.direction && c.direction !== o.direction,
                                        f = o.loop && (c.slidesPerView !== o.slidesPerView || h);
                                    h && n && e.changeDirection(), P(e.params, c);
                                    var g = e.params.enabled;
                                    Object.assign(e, {
                                        allowTouchMove: e.params.allowTouchMove,
                                        allowSlideNext: e.params.allowSlideNext,
                                        allowSlidePrev: e.params.allowSlidePrev
                                    }), p && !g ? e.disable() : !p && g && e.enable(), e.currentBreakpoint = l, e.emit("_beforeBreakpoint", c), f && n && (e.loopDestroy(), e.loopCreate(), e.updateSlides(), e.slideTo(t - i + e.loopedSlides, 0, !1)), e.emit("breakpoint", c)
                                }
                            }
                        }, getBreakpoint: function (e) {
                            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "window",
                                n = arguments.length > 2 ? arguments[2] : void 0;
                            if (e && ("container" !== t || n)) {
                                var r = !1, i = o(), a = "window" === t ? i.innerHeight : n.clientHeight,
                                    s = Object.keys(e).map((function (e) {
                                        if ("string" == typeof e && 0 === e.indexOf("@")) {
                                            var t = parseFloat(e.substr(1));
                                            return {value: a * t, point: e}
                                        }
                                        return {value: e, point: e}
                                    }));
                                s.sort((function (e, t) {
                                    return parseInt(e.value, 10) - parseInt(t.value, 10)
                                }));
                                for (var l = 0; l < s.length; l += 1) {
                                    var c = s[l], u = c.point, d = c.value;
                                    "window" === t ? i.matchMedia("(min-width: ".concat(d, "px)")).matches && (r = u) : d <= n.clientWidth && (r = u)
                                }
                                return r || "max"
                            }
                        }
                    }, checkOverflow: {
                        checkOverflow: function () {
                            var e = this, t = e.isLocked, n = e.params, r = n.slidesOffsetBefore;
                            if (r) {
                                var i = e.slides.length - 1, o = e.slidesGrid[i] + e.slidesSizesGrid[i] + 2 * r;
                                e.isLocked = e.size > o
                            } else e.isLocked = 1 === e.snapGrid.length;
                            !0 === n.allowSlideNext && (e.allowSlideNext = !e.isLocked), !0 === n.allowSlidePrev && (e.allowSlidePrev = !e.isLocked), t && t !== e.isLocked && (e.isEnd = !1), t !== e.isLocked && e.emit(e.isLocked ? "lock" : "unlock")
                        }
                    }, classes: {
                        addClasses: function () {
                            var e = this, t = e.classNames, n = e.params, r = e.rtl, i = e.$el, o = e.device,
                                a = e.support, s = function (e, t) {
                                    var n = [];
                                    return e.forEach((function (e) {
                                        "object" == _(e) ? Object.keys(e).forEach((function (r) {
                                            e[r] && n.push(t + r)
                                        })) : "string" == typeof e && n.push(t + e)
                                    })), n
                                }(["initialized", n.direction, {"pointer-events": !a.touch}, {"free-mode": e.params.freeMode && n.freeMode.enabled}, {autoheight: n.autoHeight}, {rtl: r}, {grid: n.grid && n.grid.rows > 1}, {"grid-column": n.grid && n.grid.rows > 1 && "column" === n.grid.fill}, {android: o.android}, {ios: o.ios}, {"css-mode": n.cssMode}, {centered: n.cssMode && n.centeredSlides}], n.containerModifierClass);
                            t.push.apply(t, l(s)), i.addClass(l(t).join(" ")), e.emitContainerClasses()
                        }, removeClasses: function () {
                            var e = this.$el, t = this.classNames;
                            e.removeClass(t.join(" ")), this.emitContainerClasses()
                        }
                    }, images: {
                        loadImage: function (e, t, n, r, i, a) {
                            var s, l = o();

                            function c() {
                                a && a()
                            }

                            v(e).parent("picture")[0] || e.complete && i ? c() : t ? ((s = new l.Image).onload = c, s.onerror = c, r && (s.sizes = r), n && (s.srcset = n), t && (s.src = t)) : c()
                        }, preloadImages: function () {
                            var e = this;

                            function t() {
                                null != e && e && !e.destroyed && (void 0 !== e.imagesLoaded && (e.imagesLoaded += 1), e.imagesLoaded === e.imagesToLoad.length && (e.params.updateOnImagesReady && e.update(), e.emit("imagesReady")))
                            }

                            e.imagesToLoad = e.$el.find("img");
                            for (var n = 0; n < e.imagesToLoad.length; n += 1) {
                                var r = e.imagesToLoad[n];
                                e.loadImage(r, r.currentSrc || r.getAttribute("src"), r.srcset || r.getAttribute("srcset"), r.sizes || r.getAttribute("sizes"), !0, t)
                            }
                        }
                    }
                }, Y = {}, J = function () {
                    function e() {
                        var t, n, r, i;
                        h(this, e);
                        for (var o = arguments.length, a = new Array(o), c = 0; c < o; c++) a[c] = arguments[c];
                        if (1 === a.length && a[0].constructor && "Object" === Object.prototype.toString.call(a[0]).slice(8, -1) ? i = a[0] : (r = (t = s(a, 2))[0], i = t[1]), i || (i = {}), i = P({}, i), r && !i.el && (i.el = r), i.el && v(i.el).length > 1) {
                            var u = [];
                            return v(i.el).each((function (t) {
                                var n = P({}, i, {el: t});
                                u.push(new e(n))
                            })), u
                        }
                        var d = this;
                        d.__swiper__ = !0, d.support = j(), d.device = N({userAgent: i.userAgent}), d.browser = I(), d.eventsListeners = {}, d.eventsAnyListeners = [], d.modules = l(d.__modules__), i.modules && Array.isArray(i.modules) && (n = d.modules).push.apply(n, l(i.modules));
                        var p = {};
                        d.modules.forEach((function (e) {
                            e({
                                swiper: d,
                                extendParams: X(i, p),
                                on: d.on.bind(d),
                                once: d.once.bind(d),
                                off: d.off.bind(d),
                                emit: d.emit.bind(d)
                            })
                        }));
                        var f = P({}, K, p);
                        return d.params = P({}, f, Y, i), d.originalParams = P({}, d.params), d.passedParams = P({}, i), d.params && d.params.on && Object.keys(d.params.on).forEach((function (e) {
                            d.on(e, d.params.on[e])
                        })), d.params && d.params.onAny && d.onAny(d.params.onAny), d.$ = v, Object.assign(d, {
                            enabled: d.params.enabled,
                            el: r,
                            classNames: [],
                            slides: v(),
                            slidesGrid: [],
                            snapGrid: [],
                            slidesSizesGrid: [],
                            isHorizontal: function () {
                                return "horizontal" === d.params.direction
                            },
                            isVertical: function () {
                                return "vertical" === d.params.direction
                            },
                            activeIndex: 0,
                            realIndex: 0,
                            isBeginning: !0,
                            isEnd: !1,
                            translate: 0,
                            previousTranslate: 0,
                            progress: 0,
                            velocity: 0,
                            animating: !1,
                            allowSlideNext: d.params.allowSlideNext,
                            allowSlidePrev: d.params.allowSlidePrev,
                            touchEvents: function () {
                                var e = ["touchstart", "touchmove", "touchend", "touchcancel"],
                                    t = ["pointerdown", "pointermove", "pointerup"];
                                return d.touchEventsTouch = {
                                    start: e[0],
                                    move: e[1],
                                    end: e[2],
                                    cancel: e[3]
                                }, d.touchEventsDesktop = {
                                    start: t[0],
                                    move: t[1],
                                    end: t[2]
                                }, d.support.touch || !d.params.simulateTouch ? d.touchEventsTouch : d.touchEventsDesktop
                            }(),
                            touchEventsData: {
                                isTouched: void 0,
                                isMoved: void 0,
                                allowTouchCallbacks: void 0,
                                touchStartTime: void 0,
                                isScrolling: void 0,
                                currentTranslate: void 0,
                                startTranslate: void 0,
                                allowThresholdMove: void 0,
                                focusableElements: d.params.focusableElements,
                                lastClickTime: T(),
                                clickTimeout: void 0,
                                velocities: [],
                                allowMomentumBounce: void 0,
                                isTouchEvent: void 0,
                                startMoving: void 0
                            },
                            allowClick: !0,
                            allowTouchMove: d.params.allowTouchMove,
                            touches: {startX: 0, startY: 0, currentX: 0, currentY: 0, diff: 0},
                            imagesToLoad: [],
                            imagesLoaded: 0
                        }), d.emit("_swiper"), d.params.init && d.init(), d
                    }

                    return p(e, [{
                        key: "enable", value: function () {
                            var e = this;
                            e.enabled || (e.enabled = !0, e.params.grabCursor && e.setGrabCursor(), e.emit("enable"))
                        }
                    }, {
                        key: "disable", value: function () {
                            var e = this;
                            e.enabled && (e.enabled = !1, e.params.grabCursor && e.unsetGrabCursor(), e.emit("disable"))
                        }
                    }, {
                        key: "setProgress", value: function (e, t) {
                            var n = this;
                            e = Math.min(Math.max(e, 0), 1);
                            var r = n.minTranslate(), i = (n.maxTranslate() - r) * e + r;
                            n.translateTo(i, void 0 === t ? 0 : t), n.updateActiveIndex(), n.updateSlidesClasses()
                        }
                    }, {
                        key: "emitContainerClasses", value: function () {
                            var e = this;
                            if (e.params._emitClasses && e.el) {
                                var t = e.el.className.split(" ").filter((function (t) {
                                    return 0 === t.indexOf("swiper") || 0 === t.indexOf(e.params.containerModifierClass)
                                }));
                                e.emit("_containerClasses", t.join(" "))
                            }
                        }
                    }, {
                        key: "getSlideClasses", value: function (e) {
                            var t = this;
                            return e.className.split(" ").filter((function (e) {
                                return 0 === e.indexOf("swiper-slide") || 0 === e.indexOf(t.params.slideClass)
                            })).join(" ")
                        }
                    }, {
                        key: "emitSlidesClasses", value: function () {
                            var e = this;
                            if (e.params._emitClasses && e.el) {
                                var t = [];
                                e.slides.each((function (n) {
                                    var r = e.getSlideClasses(n);
                                    t.push({slideEl: n, classNames: r}), e.emit("_slideClass", n, r)
                                })), e.emit("_slideClasses", t)
                            }
                        }
                    }, {
                        key: "slidesPerViewDynamic", value: function () {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "current",
                                t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1], n = this.params,
                                r = this.slides, i = this.slidesGrid, o = this.slidesSizesGrid, a = this.size,
                                s = this.activeIndex, l = 1;
                            if (n.centeredSlides) {
                                for (var c, u = r[s].swiperSlideSize, d = s + 1; d < r.length; d += 1) r[d] && !c && (l += 1, (u += r[d].swiperSlideSize) > a && (c = !0));
                                for (var p = s - 1; p >= 0; p -= 1) r[p] && !c && (l += 1, (u += r[p].swiperSlideSize) > a && (c = !0))
                            } else if ("current" === e) for (var h = s + 1; h < r.length; h += 1) (t ? i[h] + o[h] - i[s] < a : i[h] - i[s] < a) && (l += 1); else for (var f = s - 1; f >= 0; f -= 1) i[s] - i[f] < a && (l += 1);
                            return l
                        }
                    }, {
                        key: "update", value: function () {
                            var e = this;
                            if (e && !e.destroyed) {
                                var t = e.snapGrid, n = e.params;
                                n.breakpoints && e.setBreakpoint(), e.updateSize(), e.updateSlides(), e.updateProgress(), e.updateSlidesClasses(), e.params.freeMode && e.params.freeMode.enabled ? (r(), e.params.autoHeight && e.updateAutoHeight()) : (("auto" === e.params.slidesPerView || e.params.slidesPerView > 1) && e.isEnd && !e.params.centeredSlides ? e.slideTo(e.slides.length - 1, 0, !1, !0) : e.slideTo(e.activeIndex, 0, !1, !0)) || r(), n.watchOverflow && t !== e.snapGrid && e.checkOverflow(), e.emit("update")
                            }

                            function r() {
                                var t = e.rtlTranslate ? -1 * e.translate : e.translate,
                                    n = Math.min(Math.max(t, e.maxTranslate()), e.minTranslate());
                                e.setTranslate(n), e.updateActiveIndex(), e.updateSlidesClasses()
                            }
                        }
                    }, {
                        key: "changeDirection", value: function (e) {
                            var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], n = this,
                                r = n.params.direction;
                            return e || (e = "horizontal" === r ? "vertical" : "horizontal"), e === r || "horizontal" !== e && "vertical" !== e || (n.$el.removeClass("".concat(n.params.containerModifierClass).concat(r)).addClass("".concat(n.params.containerModifierClass).concat(e)), n.emitContainerClasses(), n.params.direction = e, n.slides.each((function (t) {
                                "vertical" === e ? t.style.width = "" : t.style.height = ""
                            })), n.emit("changeDirection"), t && n.update()), n
                        }
                    }, {
                        key: "mount", value: function (e) {
                            var t = this;
                            if (t.mounted) return !0;
                            var n = v(e || t.params.el);
                            if (!(e = n[0])) return !1;
                            e.swiper = t;
                            var i = function () {
                                return ".".concat((t.params.wrapperClass || "").trim().split(" ").join("."))
                            }, o = function () {
                                if (e && e.shadowRoot && e.shadowRoot.querySelector) {
                                    var t = v(e.shadowRoot.querySelector(i()));
                                    return t.children = function (e) {
                                        return n.children(e)
                                    }, t
                                }
                                return n.children(i())
                            }();
                            if (0 === o.length && t.params.createElements) {
                                var a = r().createElement("div");
                                o = v(a), a.className = t.params.wrapperClass, n.append(a), n.children(".".concat(t.params.slideClass)).each((function (e) {
                                    o.append(e)
                                }))
                            }
                            return Object.assign(t, {
                                $el: n,
                                el: e,
                                $wrapperEl: o,
                                wrapperEl: o[0],
                                mounted: !0,
                                rtl: "rtl" === e.dir.toLowerCase() || "rtl" === n.css("direction"),
                                rtlTranslate: "horizontal" === t.params.direction && ("rtl" === e.dir.toLowerCase() || "rtl" === n.css("direction")),
                                wrongRTL: "-webkit-box" === o.css("display")
                            }), !0
                        }
                    }, {
                        key: "init", value: function (e) {
                            var t = this;
                            return t.initialized || !1 === t.mount(e) || (t.emit("beforeInit"), t.params.breakpoints && t.setBreakpoint(), t.addClasses(), t.params.loop && t.loopCreate(), t.updateSize(), t.updateSlides(), t.params.watchOverflow && t.checkOverflow(), t.params.grabCursor && t.enabled && t.setGrabCursor(), t.params.preloadImages && t.preloadImages(), t.params.loop ? t.slideTo(t.params.initialSlide + t.loopedSlides, 0, t.params.runCallbacksOnInit, !1, !0) : t.slideTo(t.params.initialSlide, 0, t.params.runCallbacksOnInit, !1, !0), t.attachEvents(), t.initialized = !0, t.emit("init"), t.emit("afterInit")), t
                        }
                    }, {
                        key: "destroy", value: function () {
                            var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0],
                                t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], n = this,
                                r = n.params, i = n.$el, o = n.$wrapperEl, a = n.slides;
                            return void 0 === n.params || n.destroyed || (n.emit("beforeDestroy"), n.initialized = !1, n.detachEvents(), r.loop && n.loopDestroy(), t && (n.removeClasses(), i.removeAttr("style"), o.removeAttr("style"), a && a.length && a.removeClass([r.slideVisibleClass, r.slideActiveClass, r.slideNextClass, r.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-slide-index")), n.emit("destroy"), Object.keys(n.eventsListeners).forEach((function (e) {
                                n.off(e)
                            })), !1 !== e && (n.$el[0].swiper = null, function (e) {
                                var t = e;
                                Object.keys(t).forEach((function (e) {
                                    try {
                                        t[e] = null
                                    } catch (e) {
                                    }
                                    try {
                                        delete t[e]
                                    } catch (e) {
                                    }
                                }))
                            }(n)), n.destroyed = !0), null
                        }
                    }], [{
                        key: "extendDefaults", value: function (e) {
                            P(Y, e)
                        }
                    }, {
                        key: "extendedDefaults", get: function () {
                            return Y
                        }
                    }, {
                        key: "defaults", get: function () {
                            return K
                        }
                    }, {
                        key: "installModule", value: function (t) {
                            e.prototype.__modules__ || (e.prototype.__modules__ = []);
                            var n = e.prototype.__modules__;
                            "function" == typeof t && n.indexOf(t) < 0 && n.push(t)
                        }
                    }, {
                        key: "use", value: function (t) {
                            return Array.isArray(t) ? (t.forEach((function (t) {
                                return e.installModule(t)
                            })), e) : (e.installModule(t), e)
                        }
                    }]), e
                }();

                function Q(e, t, n, i) {
                    var o = r();
                    return e.params.createElements && Object.keys(i).forEach((function (r) {
                        if (!n[r] && !0 === n.auto) {
                            var a = e.$el.children(".".concat(i[r]))[0];
                            a || ((a = o.createElement("div")).className = i[r], e.$el.append(a)), n[r] = a, t[r] = a
                        }
                    })), n
                }

                function ee() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "";
                    return ".".concat(e.trim().replace(/([\.:!\/])/g, "\\$1").replace(/ /g, "."))
                }

                function te(e, t, n) {
                    var r = "swiper-slide-shadow" + (n ? "-".concat(n) : ""),
                        i = e.transformEl ? t.find(e.transformEl) : t, o = i.children(".".concat(r));
                    return o.length || (o = v('<div class="swiper-slide-shadow'.concat(n ? "-".concat(n) : "", '"></div>')), i.append(o)), o
                }

                function ne(e, t) {
                    return e.transformEl ? t.find(e.transformEl).css({
                        "backface-visibility": "hidden",
                        "-webkit-backface-visibility": "hidden"
                    }) : t
                }

                Object.keys(Z).forEach((function (e) {
                    Object.keys(Z[e]).forEach((function (t) {
                        J.prototype[t] = Z[e][t]
                    }))
                })), J.use([function (e) {
                    var t = e.swiper, n = e.on, r = e.emit, i = o(), a = null, s = function () {
                        t && !t.destroyed && t.initialized && (r("beforeResize"), r("resize"))
                    }, l = function () {
                        t && !t.destroyed && t.initialized && r("orientationchange")
                    };
                    n("init", (function () {
                        t.params.resizeObserver && void 0 !== i.ResizeObserver ? t && !t.destroyed && t.initialized && (a = new ResizeObserver((function (e) {
                            var n = t.width, r = t.height, i = n, o = r;
                            e.forEach((function (e) {
                                var n = e.contentBoxSize, r = e.contentRect, a = e.target;
                                a && a !== t.el || (i = r ? r.width : (n[0] || n).inlineSize, o = r ? r.height : (n[0] || n).blockSize)
                            })), i === n && o === r || s()
                        })), a.observe(t.el)) : (i.addEventListener("resize", s), i.addEventListener("orientationchange", l))
                    })), n("destroy", (function () {
                        a && a.unobserve && t.el && (a.unobserve(t.el), a = null), i.removeEventListener("resize", s), i.removeEventListener("orientationchange", l)
                    }))
                }, function (e) {
                    var t = e.swiper, n = e.extendParams, r = e.on, i = e.emit, a = [], s = o(), l = function (e) {
                        var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                            n = new (s.MutationObserver || s.WebkitMutationObserver)((function (e) {
                                if (1 !== e.length) {
                                    var t = function () {
                                        i("observerUpdate", e[0])
                                    };
                                    s.requestAnimationFrame ? s.requestAnimationFrame(t) : s.setTimeout(t, 0)
                                } else i("observerUpdate", e[0])
                            }));
                        n.observe(e, {
                            attributes: void 0 === t.attributes || t.attributes,
                            childList: void 0 === t.childList || t.childList,
                            characterData: void 0 === t.characterData || t.characterData
                        }), a.push(n)
                    };
                    n({observer: !1, observeParents: !1, observeSlideChildren: !1}), r("init", (function () {
                        if (t.params.observer) {
                            if (t.params.observeParents) for (var e = t.$el.parents(), n = 0; n < e.length; n += 1) l(e[n]);
                            l(t.$el[0], {childList: t.params.observeSlideChildren}), l(t.$wrapperEl[0], {attributes: !1})
                        }
                    })), r("destroy", (function () {
                        a.forEach((function (e) {
                            e.disconnect()
                        })), a.splice(0, a.length)
                    }))
                }]);
                var re = [function (e) {
                    var t = e.swiper, n = e.extendParams, r = e.on, i = e.emit;

                    function o(e) {
                        var n;
                        return e && (n = v(e), t.params.uniqueNavElements && "string" == typeof e && n.length > 1 && 1 === t.$el.find(e).length && (n = t.$el.find(e))), n
                    }

                    function a(e, n) {
                        var r = t.params.navigation;
                        e && e.length > 0 && (e[n ? "addClass" : "removeClass"](r.disabledClass), e[0] && "BUTTON" === e[0].tagName && (e[0].disabled = n), t.params.watchOverflow && t.enabled && e[t.isLocked ? "addClass" : "removeClass"](r.lockClass))
                    }

                    function s() {
                        if (!t.params.loop) {
                            var e = t.navigation, n = e.$nextEl;
                            a(e.$prevEl, t.isBeginning), a(n, t.isEnd)
                        }
                    }

                    function l(e) {
                        e.preventDefault(), t.isBeginning && !t.params.loop || t.slidePrev()
                    }

                    function c(e) {
                        e.preventDefault(), t.isEnd && !t.params.loop || t.slideNext()
                    }

                    function u() {
                        var e = t.params.navigation;
                        if (t.params.navigation = Q(t, t.originalParams.navigation, t.params.navigation, {
                            nextEl: "swiper-button-next",
                            prevEl: "swiper-button-prev"
                        }), e.nextEl || e.prevEl) {
                            var n = o(e.nextEl), r = o(e.prevEl);
                            n && n.length > 0 && n.on("click", c), r && r.length > 0 && r.on("click", l), Object.assign(t.navigation, {
                                $nextEl: n,
                                nextEl: n && n[0],
                                $prevEl: r,
                                prevEl: r && r[0]
                            }), t.enabled || (n && n.addClass(e.lockClass), r && r.addClass(e.lockClass))
                        }
                    }

                    function d() {
                        var e = t.navigation, n = e.$nextEl, r = e.$prevEl;
                        n && n.length && (n.off("click", c), n.removeClass(t.params.navigation.disabledClass)), r && r.length && (r.off("click", l), r.removeClass(t.params.navigation.disabledClass))
                    }

                    n({
                        navigation: {
                            nextEl: null,
                            prevEl: null,
                            hideOnClick: !1,
                            disabledClass: "swiper-button-disabled",
                            hiddenClass: "swiper-button-hidden",
                            lockClass: "swiper-button-lock"
                        }
                    }), t.navigation = {
                        nextEl: null,
                        $nextEl: null,
                        prevEl: null,
                        $prevEl: null
                    }, r("init", (function () {
                        u(), s()
                    })), r("toEdge fromEdge lock unlock", (function () {
                        s()
                    })), r("destroy", (function () {
                        d()
                    })), r("enable disable", (function () {
                        var e = t.navigation, n = e.$nextEl, r = e.$prevEl;
                        n && n[t.enabled ? "removeClass" : "addClass"](t.params.navigation.lockClass), r && r[t.enabled ? "removeClass" : "addClass"](t.params.navigation.lockClass)
                    })), r("click", (function (e, n) {
                        var r = t.navigation, o = r.$nextEl, a = r.$prevEl, s = n.target;
                        if (t.params.navigation.hideOnClick && !v(s).is(a) && !v(s).is(o)) {
                            if (t.pagination && t.params.pagination && t.params.pagination.clickable && (t.pagination.el === s || t.pagination.el.contains(s))) return;
                            var l;
                            o ? l = o.hasClass(t.params.navigation.hiddenClass) : a && (l = a.hasClass(t.params.navigation.hiddenClass)), i(!0 === l ? "navigationShow" : "navigationHide"), o && o.toggleClass(t.params.navigation.hiddenClass), a && a.toggleClass(t.params.navigation.hiddenClass)
                        }
                    })), Object.assign(t.navigation, {update: s, init: u, destroy: d})
                }, function (e) {
                    var t, n = e.swiper, r = e.extendParams, i = e.on, o = e.emit, a = "swiper-pagination";
                    r({
                        pagination: {
                            el: null,
                            bulletElement: "span",
                            clickable: !1,
                            hideOnClick: !1,
                            renderBullet: null,
                            renderProgressbar: null,
                            renderFraction: null,
                            renderCustom: null,
                            progressbarOpposite: !1,
                            type: "bullets",
                            dynamicBullets: !1,
                            dynamicMainBullets: 1,
                            formatFractionCurrent: function (e) {
                                return e
                            },
                            formatFractionTotal: function (e) {
                                return e
                            },
                            bulletClass: "".concat(a, "-bullet"),
                            bulletActiveClass: "".concat(a, "-bullet-active"),
                            modifierClass: "".concat(a, "-"),
                            currentClass: "".concat(a, "-current"),
                            totalClass: "".concat(a, "-total"),
                            hiddenClass: "".concat(a, "-hidden"),
                            progressbarFillClass: "".concat(a, "-progressbar-fill"),
                            progressbarOppositeClass: "".concat(a, "-progressbar-opposite"),
                            clickableClass: "".concat(a, "-clickable"),
                            lockClass: "".concat(a, "-lock"),
                            horizontalClass: "".concat(a, "-horizontal"),
                            verticalClass: "".concat(a, "-vertical")
                        }
                    }), n.pagination = {el: null, $el: null, bullets: []};
                    var s = 0;

                    function l() {
                        return !n.params.pagination.el || !n.pagination.el || !n.pagination.$el || 0 === n.pagination.$el.length
                    }

                    function c(e, t) {
                        var r = n.params.pagination.bulletActiveClass;
                        e[t]().addClass("".concat(r, "-").concat(t))[t]().addClass("".concat(r, "-").concat(t, "-").concat(t))
                    }

                    function u() {
                        var e = n.rtl, r = n.params.pagination;
                        if (!l()) {
                            var i,
                                a = n.virtual && n.params.virtual.enabled ? n.virtual.slides.length : n.slides.length,
                                u = n.pagination.$el,
                                d = n.params.loop ? Math.ceil((a - 2 * n.loopedSlides) / n.params.slidesPerGroup) : n.snapGrid.length;
                            if (n.params.loop ? ((i = Math.ceil((n.activeIndex - n.loopedSlides) / n.params.slidesPerGroup)) > a - 1 - 2 * n.loopedSlides && (i -= a - 2 * n.loopedSlides), i > d - 1 && (i -= d), i < 0 && "bullets" !== n.params.paginationType && (i = d + i)) : i = void 0 !== n.snapIndex ? n.snapIndex : n.activeIndex || 0, "bullets" === r.type && n.pagination.bullets && n.pagination.bullets.length > 0) {
                                var p, h, f, g = n.pagination.bullets;
                                if (r.dynamicBullets && (t = g.eq(0)[n.isHorizontal() ? "outerWidth" : "outerHeight"](!0), u.css(n.isHorizontal() ? "width" : "height", t * (r.dynamicMainBullets + 4) + "px"), r.dynamicMainBullets > 1 && void 0 !== n.previousIndex && ((s += i - n.previousIndex) > r.dynamicMainBullets - 1 ? s = r.dynamicMainBullets - 1 : s < 0 && (s = 0)), f = ((h = (p = i - s) + (Math.min(g.length, r.dynamicMainBullets) - 1)) + p) / 2), g.removeClass(["", "-next", "-next-next", "-prev", "-prev-prev", "-main"].map((function (e) {
                                    return "".concat(r.bulletActiveClass).concat(e)
                                })).join(" ")), u.length > 1) g.each((function (e) {
                                    var t = v(e), n = t.index();
                                    n === i && t.addClass(r.bulletActiveClass), r.dynamicBullets && (n >= p && n <= h && t.addClass("".concat(r.bulletActiveClass, "-main")), n === p && c(t, "prev"), n === h && c(t, "next"))
                                })); else {
                                    var m = g.eq(i), b = m.index();
                                    if (m.addClass(r.bulletActiveClass), r.dynamicBullets) {
                                        for (var w = g.eq(p), y = g.eq(h), _ = p; _ <= h; _ += 1) g.eq(_).addClass("".concat(r.bulletActiveClass, "-main"));
                                        if (n.params.loop) if (b >= g.length - r.dynamicMainBullets) {
                                            for (var k = r.dynamicMainBullets; k >= 0; k -= 1) g.eq(g.length - k).addClass("".concat(r.bulletActiveClass, "-main"));
                                            g.eq(g.length - r.dynamicMainBullets - 1).addClass("".concat(r.bulletActiveClass, "-prev"))
                                        } else c(w, "prev"), c(y, "next"); else c(w, "prev"), c(y, "next")
                                    }
                                }
                                if (r.dynamicBullets) {
                                    var x = Math.min(g.length, r.dynamicMainBullets + 4), S = (t * x - t) / 2 - f * t,
                                        C = e ? "right" : "left";
                                    g.css(n.isHorizontal() ? C : "top", "".concat(S, "px"))
                                }
                            }
                            if ("fraction" === r.type && (u.find(ee(r.currentClass)).text(r.formatFractionCurrent(i + 1)), u.find(ee(r.totalClass)).text(r.formatFractionTotal(d))), "progressbar" === r.type) {
                                var E;
                                E = r.progressbarOpposite ? n.isHorizontal() ? "vertical" : "horizontal" : n.isHorizontal() ? "horizontal" : "vertical";
                                var T = (i + 1) / d, A = 1, O = 1;
                                "horizontal" === E ? A = T : O = T, u.find(ee(r.progressbarFillClass)).transform("translate3d(0,0,0) scaleX(".concat(A, ") scaleY(").concat(O, ")")).transition(n.params.speed)
                            }
                            "custom" === r.type && r.renderCustom ? (u.html(r.renderCustom(n, i + 1, d)), o("paginationRender", u[0])) : o("paginationUpdate", u[0]), n.params.watchOverflow && n.enabled && u[n.isLocked ? "addClass" : "removeClass"](r.lockClass)
                        }
                    }

                    function d() {
                        var e = n.params.pagination;
                        if (!l()) {
                            var t = n.virtual && n.params.virtual.enabled ? n.virtual.slides.length : n.slides.length,
                                r = n.pagination.$el, i = "";
                            if ("bullets" === e.type) {
                                var a = n.params.loop ? Math.ceil((t - 2 * n.loopedSlides) / n.params.slidesPerGroup) : n.snapGrid.length;
                                n.params.freeMode && n.params.freeMode.enabled && !n.params.loop && a > t && (a = t);
                                for (var s = 0; s < a; s += 1) e.renderBullet ? i += e.renderBullet.call(n, s, e.bulletClass) : i += "<".concat(e.bulletElement, ' class="').concat(e.bulletClass, '"></').concat(e.bulletElement, ">");
                                r.html(i), n.pagination.bullets = r.find(ee(e.bulletClass))
                            }
                            "fraction" === e.type && (i = e.renderFraction ? e.renderFraction.call(n, e.currentClass, e.totalClass) : '<span class="'.concat(e.currentClass, '"></span> / <span class="').concat(e.totalClass, '"></span>'), r.html(i)), "progressbar" === e.type && (i = e.renderProgressbar ? e.renderProgressbar.call(n, e.progressbarFillClass) : '<span class="'.concat(e.progressbarFillClass, '"></span>'), r.html(i)), "custom" !== e.type && o("paginationRender", n.pagination.$el[0])
                        }
                    }

                    function p() {
                        n.params.pagination = Q(n, n.originalParams.pagination, n.params.pagination, {el: "swiper-pagination"});
                        var e = n.params.pagination;
                        if (e.el) {
                            var t = v(e.el);
                            0 !== t.length && (n.params.uniqueNavElements && "string" == typeof e.el && t.length > 1 && (t = n.$el.find(e.el)).length > 1 && (t = t.filter((function (e) {
                                return v(e).parents(".swiper")[0] === n.el
                            }))), "bullets" === e.type && e.clickable && t.addClass(e.clickableClass), t.addClass(e.modifierClass + e.type), t.addClass(e.modifierClass + n.params.direction), "bullets" === e.type && e.dynamicBullets && (t.addClass("".concat(e.modifierClass).concat(e.type, "-dynamic")), s = 0, e.dynamicMainBullets < 1 && (e.dynamicMainBullets = 1)), "progressbar" === e.type && e.progressbarOpposite && t.addClass(e.progressbarOppositeClass), e.clickable && t.on("click", ee(e.bulletClass), (function (e) {
                                e.preventDefault();
                                var t = v(this).index() * n.params.slidesPerGroup;
                                n.params.loop && (t += n.loopedSlides), n.slideTo(t)
                            })), Object.assign(n.pagination, {$el: t, el: t[0]}), n.enabled || t.addClass(e.lockClass))
                        }
                    }

                    function h() {
                        var e = n.params.pagination;
                        if (!l()) {
                            var t = n.pagination.$el;
                            t.removeClass(e.hiddenClass), t.removeClass(e.modifierClass + e.type), t.removeClass(e.modifierClass + n.params.direction), n.pagination.bullets && n.pagination.bullets.removeClass && n.pagination.bullets.removeClass(e.bulletActiveClass), e.clickable && t.off("click", ee(e.bulletClass))
                        }
                    }

                    i("init", (function () {
                        p(), d(), u()
                    })), i("activeIndexChange", (function () {
                        (n.params.loop || void 0 === n.snapIndex) && u()
                    })), i("snapIndexChange", (function () {
                        n.params.loop || u()
                    })), i("slidesLengthChange", (function () {
                        n.params.loop && (d(), u())
                    })), i("snapGridLengthChange", (function () {
                        n.params.loop || (d(), u())
                    })), i("destroy", (function () {
                        h()
                    })), i("enable disable", (function () {
                        var e = n.pagination.$el;
                        e && e[n.enabled ? "removeClass" : "addClass"](n.params.pagination.lockClass)
                    })), i("lock unlock", (function () {
                        u()
                    })), i("click", (function (e, t) {
                        var r = t.target, i = n.pagination.$el;
                        if (n.params.pagination.el && n.params.pagination.hideOnClick && i.length > 0 && !v(r).hasClass(n.params.pagination.bulletClass)) {
                            if (n.navigation && (n.navigation.nextEl && r === n.navigation.nextEl || n.navigation.prevEl && r === n.navigation.prevEl)) return;
                            var a = i.hasClass(n.params.pagination.hiddenClass);
                            o(!0 === a ? "paginationShow" : "paginationHide"), i.toggleClass(n.params.pagination.hiddenClass)
                        }
                    })), Object.assign(n.pagination, {render: d, update: u, init: p, destroy: h})
                }, function (e) {
                    var t = e.swiper, n = e.extendParams, r = e.on;
                    n({cardsEffect: {slideShadows: !0, transformEl: null}}), function (e) {
                        var t = e.effect, n = e.swiper, r = e.on, i = e.setTranslate, o = e.setTransition,
                            a = e.overwriteParams, s = e.perspective;
                        r("beforeInit", (function () {
                            if (n.params.effect === t) {
                                n.classNames.push("".concat(n.params.containerModifierClass).concat(t)), s && s() && n.classNames.push("".concat(n.params.containerModifierClass, "3d"));
                                var e = a ? a() : {};
                                Object.assign(n.params, e), Object.assign(n.originalParams, e)
                            }
                        })), r("setTranslate", (function () {
                            n.params.effect === t && i()
                        })), r("setTransition", (function (e, r) {
                            n.params.effect === t && o(r)
                        }))
                    }({
                        effect: "cards", swiper: t, on: r, setTranslate: function () {
                            for (var e = t.slides, n = t.activeIndex, r = t.params.cardsEffect, i = t.touchEventsData, o = i.startTranslate, a = i.isTouched, s = t.translate, l = 0; l < e.length; l += 1) {
                                var c = e.eq(l), u = c[0].progress, d = Math.min(Math.max(u, -4), 4),
                                    p = c[0].swiperSlideOffset;
                                t.params.centeredSlides && !t.params.cssMode && t.$wrapperEl.transform("translateX(".concat(t.minTranslate(), "px)")), t.params.centeredSlides && t.params.cssMode && (p -= e[0].swiperSlideOffset);
                                var h = t.params.cssMode ? -p - t.translate : -p, f = 0, g = -100 * Math.abs(d), m = 1,
                                    v = -2 * d, b = 8 - .75 * Math.abs(d),
                                    w = (l === n || l === n - 1) && d > 0 && d < 1 && (a || t.params.cssMode) && s < o,
                                    y = (l === n || l === n + 1) && d < 0 && d > -1 && (a || t.params.cssMode) && s > o;
                                if (w || y) {
                                    var _ = Math.pow(1 - Math.abs((Math.abs(d) - .5) / .5), .5);
                                    v += -28 * d * _, m += -.5 * _, b += 96 * _, f = -25 * _ * Math.abs(d) + "%"
                                }
                                if (h = d < 0 ? "calc(".concat(h, "px + (").concat(b * Math.abs(d), "%))") : d > 0 ? "calc(".concat(h, "px + (-").concat(b * Math.abs(d), "%))") : "".concat(h, "px"), !t.isHorizontal()) {
                                    var k = f;
                                    f = h, h = k
                                }
                                var x = "\n        translate3d(".concat(h, ", ").concat(f, ", ").concat(g, "px)\n        rotateZ(").concat(v, "deg)\n        scale(").concat(d < 0 ? "" + (1 + (1 - m) * d) : "" + (1 - (1 - m) * d), ")\n      ");
                                if (r.slideShadows) {
                                    var S = c.find(".swiper-slide-shadow");
                                    0 === S.length && (S = te(r, c)), S.length && (S[0].style.opacity = Math.min(Math.max((Math.abs(d) - .5) / .5, 0), 1))
                                }
                                c[0].style.zIndex = -Math.abs(Math.round(u)) + e.length, ne(r, c).transform(x)
                            }
                        }, setTransition: function (e) {
                            var n = t.params.cardsEffect.transformEl;
                            (n ? t.slides.find(n) : t.slides).transition(e).find(".swiper-slide-shadow").transition(e), function (e) {
                                var t = e.swiper, n = e.duration, r = e.transformEl, i = e.allSlides, o = t.slides,
                                    a = t.activeIndex, s = t.$wrapperEl;
                                if (t.params.virtualTranslate && 0 !== n) {
                                    var l = !1;
                                    (i ? r ? o.find(r) : o : r ? o.eq(a).find(r) : o.eq(a)).transitionEnd((function () {
                                        if (!l && t && !t.destroyed) {
                                            l = !0, t.animating = !1;
                                            for (var e = ["webkitTransitionEnd", "transitionend"], n = 0; n < e.length; n += 1) s.trigger(e[n])
                                        }
                                    }))
                                }
                            }({swiper: t, duration: e, transformEl: n})
                        }, perspective: function () {
                            return !0
                        }, overwriteParams: function () {
                            return {watchSlidesProgress: !0, virtualTranslate: !t.params.cssMode}
                        }
                    })
                }];
                return J.use(re), J
            }, "object" == _(t) ? e.exports = o() : void 0 === (i = "function" == typeof (r = o) ? r.call(t, n, t, e) : r) || (e.exports = i)
        }, 5241: () => {
            !function (e, t) {
                "use strict";
                var n, r = "hljs-ln", i = "hljs-ln-line", o = "hljs-ln-code", a = "hljs-ln-numbers", s = "hljs-ln-n",
                    l = "data-line-number", c = /\r\n|\r|\n/g;

                function u(n) {
                    try {
                        var r = t.querySelectorAll("code.hljs,code.nohighlight");
                        for (var i in r) r.hasOwnProperty(i) && (r[i].classList.contains("nohljsln") || d(r[i], n))
                    } catch (t) {
                        e.console.error("LineNumbers error: ", t);
                    }
                }

                function d(t, n) {
                    var r;
                    "object" == typeof t && (r = function () {
                        t.innerHTML = p(t, n)
                    }, e.setTimeout(r, 0))
                }

                function p(e, t) {
                    var n = function (e, t) {
                        return {singleLine: h(t = t || {}), startFrom: f(e, t)}
                    }(e, t);
                    return g(e), function (e, t) {
                        var n = v(e);
                        "" === n[n.length - 1].trim() && n.pop();
                        if (n.length > 1 || t.singleLine) {
                            for (var c = "", u = 0, d = n.length; u < d; u++) c += b('<tr><td class="{0} {1}" {3}="{5}"><div class="{2}" {3}="{5}"></div></td><td class="{0} {4}" {3}="{5}">{6}</td></tr>', [i, a, s, l, o, u + t.startFrom, n[u].length > 0 ? n[u] : " "]);
                            return b('<table class="{0}">{1}</table>', [r, c])
                        }
                        return e
                    }(e.innerHTML, n)
                }

                function h(e) {
                    return !!e.singleLine && e.singleLine
                }

                function f(e, t) {
                    var n = 1;
                    isFinite(t.startFrom) && (n = t.startFrom);
                    var r = function (e, t) {
                        return e.hasAttribute(t) ? e.getAttribute(t) : null
                    }(e, "data-ln-start-from");
                    return null !== r && (n = function (e, t) {
                        if (!e) return t;
                        var n = Number(e);
                        return isFinite(n) ? n : t
                    }(r, 1)), n
                }

                function g(e) {
                    var t = e.childNodes;
                    for (var n in t) if (t.hasOwnProperty(n)) {
                        var r = t[n];
                        (r.textContent.trim().match(c) || []).length > 0 && (r.childNodes.length > 0 ? g(r) : m(r.parentNode))
                    }
                }

                function m(e) {
                    var t = e.className;
                    if (/hljs-/.test(t)) {
                        for (var n = v(e.innerHTML), r = 0, i = ""; r < n.length; r++) {
                            i += b('<span class="{0}">{1}</span>\n', [t, n[r].length > 0 ? n[r] : " "])
                        }
                        e.innerHTML = i.trim()
                    }
                }

                function v(e) {
                    return 0 === e.length ? [] : e.split(c)
                }

                function b(e, t) {
                    return e.replace(/\{(\d+)\}/g, (function (e, n) {
                        return void 0 !== t[n] ? t[n] : e
                    }))
                }

                e.hljs ? (e.hljs.initLineNumbersOnLoad = function (n) {
                    "interactive" === t.readyState || "complete" === t.readyState ? u(n) : e.addEventListener("DOMContentLoaded", (function () {
                        u(n)
                    }))
                }, e.hljs.lineNumbersBlock = d, e.hljs.lineNumbersValue = function (e, t) {
                    if ("string" != typeof e) return;
                    var n = document.createElement("code");
                    return n.innerHTML = e, p(n, t)
                }, (n = t.createElement("style")).type = "text/css", n.innerHTML = b(".{0}{border-collapse:collapse}.{0} td{padding:0}.{1}:before{content:attr({2})}", [r, s, l]), t.getElementsByTagName("head")[0].appendChild(n)) : e.console.error("highlight.js not detected!"), document.addEventListener("copy", (function (e) {
                    var t, n = window.getSelection();
                    (function (e) {
                        for (var t = e; t;) {
                            if (t.className && -1 !== t.className.indexOf("hljs-ln-code")) return !0;
                            t = t.parentNode
                        }
                        return !1
                    })(n.anchorNode) && (t = -1 !== window.navigator.userAgent.indexOf("Edge") ? function (e) {
                        for (var t = e.toString(), n = e.anchorNode; "TD" !== n.nodeName;) n = n.parentNode;
                        for (var r = e.focusNode; "TD" !== r.nodeName;) r = r.parentNode;
                        var i = parseInt(n.dataset.lineNumber), a = parseInt(r.dataset.lineNumber);
                        if (i != a) {
                            var s = n.textContent, c = r.textContent;
                            if (i > a) {
                                var u = i;
                                i = a, a = u, u = s, s = c, c = u
                            }
                            for (; 0 !== t.indexOf(s);) s = s.slice(1);
                            for (; -1 === t.lastIndexOf(c);) c = c.slice(0, -1);
                            for (var d = s, p = function (e) {
                                for (var t = e; "TABLE" !== t.nodeName;) t = t.parentNode;
                                return t
                            }(n), h = i + 1; h < a; ++h) {
                                var f = b('.{0}[{1}="{2}"]', [o, l, h]);
                                d += "\n" + p.querySelector(f).textContent
                            }
                            return d + "\n" + c
                        }
                        return t
                    }(n) : n.toString(), e.clipboardData.setData("text/plain", t), e.preventDefault())
                }))
            }(window, document)
        }, 7059: function (e) {/*! lozad.js - v1.16.0 - 2020-09-06
* https://github.com/ApoorvSaxena/lozad.js
* Copyright (c) 2020 Apoorv Saxena; Licensed MIT */
            e.exports = function () {
                "use strict";
                var e = "undefined" != typeof document && document.documentMode, t = {
                    rootMargin: "0px", threshold: 0, load: function (t) {
                        if ("picture" === t.nodeName.toLowerCase()) {
                            var n = t.querySelector("img"), r = !1;
                            null === n && (n = document.createElement("img"), r = !0), e && t.getAttribute("data-iesrc") && (n.src = t.getAttribute("data-iesrc")), t.getAttribute("data-alt") && (n.alt = t.getAttribute("data-alt")), r && t.append(n)
                        }
                        if ("video" === t.nodeName.toLowerCase() && !t.getAttribute("data-src") && t.children) {
                            for (var i = t.children, o = void 0, a = 0; a <= i.length - 1; a++) (o = i[a].getAttribute("data-src")) && (i[a].src = o);
                            t.load()
                        }
                        t.getAttribute("data-poster") && (t.poster = t.getAttribute("data-poster")), t.getAttribute("data-src") && (t.src = t.getAttribute("data-src")), t.getAttribute("data-srcset") && t.setAttribute("srcset", t.getAttribute("data-srcset"));
                        var s = ",";
                        if (t.getAttribute("data-background-delimiter") && (s = t.getAttribute("data-background-delimiter")), t.getAttribute("data-background-image")) t.style.backgroundImage = "url('" + t.getAttribute("data-background-image").split(s).join("'),url('") + "')"; else if (t.getAttribute("data-background-image-set")) {
                            var l = t.getAttribute("data-background-image-set").split(s),
                                c = l[0].substr(0, l[0].indexOf(" ")) || l[0];
                            c = -1 === c.indexOf("url(") ? "url(" + c + ")" : c, 1 === l.length ? t.style.backgroundImage = c : t.setAttribute("style", (t.getAttribute("style") || "") + "background-image: " + c + "; background-image: -webkit-image-set(" + l + "); background-image: image-set(" + l + ")")
                        }
                        t.getAttribute("data-toggle-class") && t.classList.toggle(t.getAttribute("data-toggle-class"))
                    }, loaded: function () {
                    }
                };

                function n(e) {
                    e.setAttribute("data-loaded", !0)
                }

                var r = function (e) {
                    return "true" === e.getAttribute("data-loaded")
                }, i = function (e) {
                    var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : document;
                    return e instanceof Element ? [e] : e instanceof NodeList ? e : t.querySelectorAll(e)
                };
                return function () {
                    var e, o, a = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : ".lozad",
                        s = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                        l = Object.assign({}, t, s), c = l.root, u = l.rootMargin, d = l.threshold, p = l.load,
                        h = l.loaded, f = void 0;
                    "undefined" != typeof window && window.IntersectionObserver && (f = new IntersectionObserver((e = p, o = h, function (t, i) {
                        t.forEach((function (t) {
                            (0 < t.intersectionRatio || t.isIntersecting) && (i.unobserve(t.target), r(t.target) || (e(t.target), n(t.target), o(t.target)))
                        }))
                    }), {root: c, rootMargin: u, threshold: d}));
                    for (var g, m = i(a, c), v = 0; v < m.length; v++) (g = m[v]).getAttribute("data-placeholder-background") && (g.style.background = g.getAttribute("data-placeholder-background"));
                    return {
                        observe: function () {
                            for (var e = i(a, c), t = 0; t < e.length; t++) r(e[t]) || (f ? f.observe(e[t]) : (p(e[t]), n(e[t]), h(e[t])))
                        }, triggerLoad: function (e) {
                            r(e) || (p(e), n(e), h(e))
                        }, observer: f
                    }
                }
            }()
        }, 4155: e => {
            var t, n, r = e.exports = {};

            function i() {
                throw new Error("setTimeout has not been defined")
            }

            function o() {
                throw new Error("clearTimeout has not been defined")
            }

            function a(e) {
                if (t === setTimeout) return setTimeout(e, 0);
                if ((t === i || !t) && setTimeout) return t = setTimeout, setTimeout(e, 0);
                try {
                    return t(e, 0)
                } catch (n) {
                    try {
                        return t.call(null, e, 0)
                    } catch (n) {
                        return t.call(this, e, 0)
                    }
                }
            }

            !function () {
                try {
                    t = "function" == typeof setTimeout ? setTimeout : i
                } catch (e) {
                    t = i
                }
                try {
                    n = "function" == typeof clearTimeout ? clearTimeout : o
                } catch (e) {
                    n = o
                }
            }();
            var s, l = [], c = !1, u = -1;

            function d() {
                c && s && (c = !1, s.length ? l = s.concat(l) : u = -1, l.length && p())
            }

            function p() {
                if (!c) {
                    var e = a(d);
                    c = !0;
                    for (var t = l.length; t;) {
                        for (s = l, l = []; ++u < t;) s && s[u].run();
                        u = -1, t = l.length
                    }
                    s = null, c = !1, function (e) {
                        if (n === clearTimeout) return clearTimeout(e);
                        if ((n === o || !n) && clearTimeout) return n = clearTimeout, clearTimeout(e);
                        try {
                            n(e)
                        } catch (t) {
                            try {
                                return n.call(null, e)
                            } catch (t) {
                                return n.call(this, e)
                            }
                        }
                    }(e)
                }
            }

            function h(e, t) {
                this.fun = e, this.array = t
            }

            function f() {
            }

            r.nextTick = function (e) {
                var t = new Array(arguments.length - 1);
                if (arguments.length > 1) for (var n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
                l.push(new h(e, t)), 1 !== l.length || c || a(p)
            }, h.prototype.run = function () {
                this.fun.apply(null, this.array)
            }, r.title = "browser", r.browser = !0, r.env = {}, r.argv = [], r.version = "", r.versions = {}, r.on = f, r.addListener = f, r.once = f, r.off = f, r.removeListener = f, r.removeAllListeners = f, r.emit = f, r.prependListener = f, r.prependOnceListener = f, r.listeners = function (e) {
                return []
            }, r.binding = function (e) {
                throw new Error("process.binding is not supported")
            }, r.cwd = function () {
                return "/"
            }, r.chdir = function (e) {
                throw new Error("process.chdir is not supported")
            }, r.umask = function () {
                return 0
            }
        }, 6606: e => {/*!
* Pusher JavaScript Library v7.0.3
* https://pusher.com/
*
* Copyright 2020, Pusher
* Released under the MIT licence.
*/
            var t;
            window, t = function () {
                return function (e) {
                    var t = {};

                    function n(r) {
                        if (t[r]) return t[r].exports;
                        var i = t[r] = {i: r, l: !1, exports: {}};
                        return e[r].call(i.exports, i, i.exports, n), i.l = !0, i.exports
                    }

                    return n.m = e, n.c = t, n.d = function (e, t, r) {
                        n.o(e, t) || Object.defineProperty(e, t, {enumerable: !0, get: r})
                    }, n.r = function (e) {
                        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
                    }, n.t = function (e, t) {
                        if (1 & t && (e = n(e)), 8 & t) return e;
                        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
                        var r = Object.create(null);
                        if (n.r(r), Object.defineProperty(r, "default", {
                            enumerable: !0,
                            value: e
                        }), 2 & t && "string" != typeof e) for (var i in e) n.d(r, i, function (t) {
                            return e[t]
                        }.bind(null, i));
                        return r
                    }, n.n = function (e) {
                        var t = e && e.__esModule ? function () {
                            return e.default
                        } : function () {
                            return e
                        };
                        return n.d(t, "a", t), t
                    }, n.o = function (e, t) {
                        return Object.prototype.hasOwnProperty.call(e, t)
                    }, n.p = "", n(n.s = 2)
                }([function (e, t, n) {
                    "use strict";
                    var r, i = this && this.__extends || (r = function (e, t) {
                        return r = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                            e.__proto__ = t
                        } || function (e, t) {
                            for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                        }, r(e, t)
                    }, function (e, t) {
                        function n() {
                            this.constructor = e
                        }

                        r(e, t), e.prototype = null === t ? Object.create(t) : (n.prototype = t.prototype, new n)
                    });
                    Object.defineProperty(t, "__esModule", {value: !0});
                    var o = 256, a = function () {
                        function e(e) {
                            void 0 === e && (e = "="), this._paddingCharacter = e
                        }

                        return e.prototype.encodedLength = function (e) {
                            return this._paddingCharacter ? (e + 2) / 3 * 4 | 0 : (8 * e + 5) / 6 | 0
                        }, e.prototype.encode = function (e) {
                            for (var t = "", n = 0; n < e.length - 2; n += 3) {
                                var r = e[n] << 16 | e[n + 1] << 8 | e[n + 2];
                                t += this._encodeByte(r >>> 18 & 63), t += this._encodeByte(r >>> 12 & 63), t += this._encodeByte(r >>> 6 & 63), t += this._encodeByte(r >>> 0 & 63)
                            }
                            var i = e.length - n;
                            return i > 0 && (r = e[n] << 16 | (2 === i ? e[n + 1] << 8 : 0), t += this._encodeByte(r >>> 18 & 63), t += this._encodeByte(r >>> 12 & 63), t += 2 === i ? this._encodeByte(r >>> 6 & 63) : this._paddingCharacter || "", t += this._paddingCharacter || ""), t
                        }, e.prototype.maxDecodedLength = function (e) {
                            return this._paddingCharacter ? e / 4 * 3 | 0 : (6 * e + 7) / 8 | 0
                        }, e.prototype.decodedLength = function (e) {
                            return this.maxDecodedLength(e.length - this._getPaddingLength(e))
                        }, e.prototype.decode = function (e) {
                            if (0 === e.length) return new Uint8Array(0);
                            for (var t = this._getPaddingLength(e), n = e.length - t, r = new Uint8Array(this.maxDecodedLength(n)), i = 0, a = 0, s = 0, l = 0, c = 0, u = 0, d = 0; a < n - 4; a += 4) l = this._decodeChar(e.charCodeAt(a + 0)), c = this._decodeChar(e.charCodeAt(a + 1)), u = this._decodeChar(e.charCodeAt(a + 2)), d = this._decodeChar(e.charCodeAt(a + 3)), r[i++] = l << 2 | c >>> 4, r[i++] = c << 4 | u >>> 2, r[i++] = u << 6 | d, s |= l & o, s |= c & o, s |= u & o, s |= d & o;
                            if (a < n - 1 && (l = this._decodeChar(e.charCodeAt(a)), c = this._decodeChar(e.charCodeAt(a + 1)), r[i++] = l << 2 | c >>> 4, s |= l & o, s |= c & o), a < n - 2 && (u = this._decodeChar(e.charCodeAt(a + 2)), r[i++] = c << 4 | u >>> 2, s |= u & o), a < n - 3 && (d = this._decodeChar(e.charCodeAt(a + 3)), r[i++] = u << 6 | d, s |= d & o), 0 !== s) throw new Error("Base64Coder: incorrect characters for decoding");
                            return r
                        }, e.prototype._encodeByte = function (e) {
                            var t = e;
                            return t += 65, t += 25 - e >>> 8 & 6, t += 51 - e >>> 8 & -75, t += 61 - e >>> 8 & -15, t += 62 - e >>> 8 & 3, String.fromCharCode(t)
                        }, e.prototype._decodeChar = function (e) {
                            var t = o;
                            return t += (42 - e & e - 44) >>> 8 & -256 + e - 43 + 62, t += (46 - e & e - 48) >>> 8 & -256 + e - 47 + 63, t += (47 - e & e - 58) >>> 8 & -256 + e - 48 + 52, t += (64 - e & e - 91) >>> 8 & -256 + e - 65 + 0, t += (96 - e & e - 123) >>> 8 & -256 + e - 97 + 26
                        }, e.prototype._getPaddingLength = function (e) {
                            var t = 0;
                            if (this._paddingCharacter) {
                                for (var n = e.length - 1; n >= 0 && e[n] === this._paddingCharacter; n--) t++;
                                if (e.length < 4 || t > 2) throw new Error("Base64Coder: incorrect padding")
                            }
                            return t
                        }, e
                    }();
                    t.Coder = a;
                    var s = new a;
                    t.encode = function (e) {
                        return s.encode(e)
                    }, t.decode = function (e) {
                        return s.decode(e)
                    };
                    var l = function (e) {
                        function t() {
                            return null !== e && e.apply(this, arguments) || this
                        }

                        return i(t, e), t.prototype._encodeByte = function (e) {
                            var t = e;
                            return t += 65, t += 25 - e >>> 8 & 6, t += 51 - e >>> 8 & -75, t += 61 - e >>> 8 & -13, t += 62 - e >>> 8 & 49, String.fromCharCode(t)
                        }, t.prototype._decodeChar = function (e) {
                            var t = o;
                            return t += (44 - e & e - 46) >>> 8 & -256 + e - 45 + 62, t += (94 - e & e - 96) >>> 8 & -256 + e - 95 + 63, t += (47 - e & e - 58) >>> 8 & -256 + e - 48 + 52, t += (64 - e & e - 91) >>> 8 & -256 + e - 65 + 0, t += (96 - e & e - 123) >>> 8 & -256 + e - 97 + 26
                        }, t
                    }(a);
                    t.URLSafeCoder = l;
                    var c = new l;
                    t.encodeURLSafe = function (e) {
                        return c.encode(e)
                    }, t.decodeURLSafe = function (e) {
                        return c.decode(e)
                    }, t.encodedLength = function (e) {
                        return s.encodedLength(e)
                    }, t.maxDecodedLength = function (e) {
                        return s.maxDecodedLength(e)
                    }, t.decodedLength = function (e) {
                        return s.decodedLength(e)
                    }
                }, function (e, t, n) {
                    "use strict";
                    Object.defineProperty(t, "__esModule", {value: !0});
                    var r = "utf8: invalid string", i = "utf8: invalid source encoding";

                    function o(e) {
                        for (var t = 0, n = 0; n < e.length; n++) {
                            var i = e.charCodeAt(n);
                            if (i < 128) t += 1; else if (i < 2048) t += 2; else if (i < 55296) t += 3; else {
                                if (!(i <= 57343)) throw new Error(r);
                                if (n >= e.length - 1) throw new Error(r);
                                n++, t += 4
                            }
                        }
                        return t
                    }

                    t.encode = function (e) {
                        for (var t = new Uint8Array(o(e)), n = 0, r = 0; r < e.length; r++) {
                            var i = e.charCodeAt(r);
                            i < 128 ? t[n++] = i : i < 2048 ? (t[n++] = 192 | i >> 6, t[n++] = 128 | 63 & i) : i < 55296 ? (t[n++] = 224 | i >> 12, t[n++] = 128 | i >> 6 & 63, t[n++] = 128 | 63 & i) : (r++, i = (1023 & i) << 10, i |= 1023 & e.charCodeAt(r), i += 65536, t[n++] = 240 | i >> 18, t[n++] = 128 | i >> 12 & 63, t[n++] = 128 | i >> 6 & 63, t[n++] = 128 | 63 & i)
                        }
                        return t
                    }, t.encodedLength = o, t.decode = function (e) {
                        for (var t = [], n = 0; n < e.length; n++) {
                            var r = e[n];
                            if (128 & r) {
                                var o = void 0;
                                if (r < 224) {
                                    if (n >= e.length) throw new Error(i);
                                    if (128 != (192 & (a = e[++n]))) throw new Error(i);
                                    r = (31 & r) << 6 | 63 & a, o = 128
                                } else if (r < 240) {
                                    if (n >= e.length - 1) throw new Error(i);
                                    var a = e[++n], s = e[++n];
                                    if (128 != (192 & a) || 128 != (192 & s)) throw new Error(i);
                                    r = (15 & r) << 12 | (63 & a) << 6 | 63 & s, o = 2048
                                } else {
                                    if (!(r < 248)) throw new Error(i);
                                    if (n >= e.length - 2) throw new Error(i);
                                    a = e[++n], s = e[++n];
                                    var l = e[++n];
                                    if (128 != (192 & a) || 128 != (192 & s) || 128 != (192 & l)) throw new Error(i);
                                    r = (15 & r) << 18 | (63 & a) << 12 | (63 & s) << 6 | 63 & l, o = 65536
                                }
                                if (r < o || r >= 55296 && r <= 57343) throw new Error(i);
                                if (r >= 65536) {
                                    if (r > 1114111) throw new Error(i);
                                    r -= 65536, t.push(String.fromCharCode(55296 | r >> 10)), r = 56320 | 1023 & r
                                }
                            }
                            t.push(String.fromCharCode(r))
                        }
                        return t.join("")
                    }
                }, function (e, t, n) {
                    e.exports = n(3).default
                }, function (e, t, n) {
                    "use strict";
                    n.r(t);
                    for (var r, i = function () {
                        function e(e, t) {
                            this.lastId = 0, this.prefix = e, this.name = t
                        }

                        return e.prototype.create = function (e) {
                            this.lastId++;
                            var t = this.lastId, n = this.prefix + t, r = this.name + "[" + t + "]", i = !1,
                                o = function () {
                                    i || (e.apply(null, arguments), i = !0)
                                };
                            return this[t] = o, {number: t, id: n, name: r, callback: o}
                        }, e.prototype.remove = function (e) {
                            delete this[e.number]
                        }, e
                    }(), o = new i("_pusher_script_", "Pusher.ScriptReceivers"), a = {
                        VERSION: "7.0.3",
                        PROTOCOL: 7,
                        wsPort: 80,
                        wssPort: 443,
                        wsPath: "",
                        httpHost: "sockjs.pusher.com",
                        httpPort: 80,
                        httpsPort: 443,
                        httpPath: "/pusher",
                        stats_host: "stats.pusher.com",
                        authEndpoint: "/pusher/auth",
                        authTransport: "ajax",
                        activityTimeout: 12e4,
                        pongTimeout: 3e4,
                        unavailableTimeout: 1e4,
                        cluster: "mt1",
                        cdn_http: "http://js.pusher.com",
                        cdn_https: "https://js.pusher.com",
                        dependency_suffix: ""
                    }, s = function () {
                        function e(e) {
                            this.options = e, this.receivers = e.receivers || o, this.loading = {}
                        }

                        return e.prototype.load = function (e, t, n) {
                            var r = this;
                            if (r.loading[e] && r.loading[e].length > 0) r.loading[e].push(n); else {
                                r.loading[e] = [n];
                                var i = Tt.createScriptRequest(r.getPath(e, t)), o = r.receivers.create((function (t) {
                                    if (r.receivers.remove(o), r.loading[e]) {
                                        var n = r.loading[e];
                                        delete r.loading[e];
                                        for (var a = function (e) {
                                            e || i.cleanup()
                                        }, s = 0; s < n.length; s++) n[s](t, a)
                                    }
                                }));
                                i.send(o)
                            }
                        }, e.prototype.getRoot = function (e) {
                            var t = Tt.getDocument().location.protocol;
                            return (e && e.useTLS || "https:" === t ? this.options.cdn_https : this.options.cdn_http).replace(/\/*$/, "") + "/" + this.options.version
                        }, e.prototype.getPath = function (e, t) {
                            return this.getRoot(t) + "/" + e + this.options.suffix + ".js"
                        }, e
                    }(), l = new i("_pusher_dependencies", "Pusher.DependenciesReceivers"), c = new s({
                        cdn_http: a.cdn_http,
                        cdn_https: a.cdn_https,
                        version: a.VERSION,
                        suffix: a.dependency_suffix,
                        receivers: l
                    }), u = {
                        baseUrl: "https://pusher.com",
                        urls: {
                            authenticationEndpoint: {path: "/docs/authenticating_users"},
                            javascriptQuickStart: {path: "/docs/javascript_quick_start"},
                            triggeringClientEvents: {path: "/docs/client_api_guide/client_events#trigger-events"},
                            encryptedChannelSupport: {fullUrl: "https://github.com/pusher/pusher-js/tree/cc491015371a4bde5743d1c87a0fbac0feb53195#encrypted-channel-support"}
                        }
                    }, d = function (e) {
                        var t, n = u.urls[e];
                        return n ? (n.fullUrl ? t = n.fullUrl : n.path && (t = u.baseUrl + n.path), t ? "See: " + t : "") : ""
                    }, p = (r = function (e, t) {
                        return r = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                            e.__proto__ = t
                        } || function (e, t) {
                            for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                        }, r(e, t)
                    }, function (e, t) {
                        function n() {
                            this.constructor = e
                        }

                        r(e, t), e.prototype = null === t ? Object.create(t) : (n.prototype = t.prototype, new n)
                    }), h = function (e) {
                        function t(t) {
                            var n = this.constructor, r = e.call(this, t) || this;
                            return Object.setPrototypeOf(r, n.prototype), r
                        }

                        return p(t, e), t
                    }(Error), f = function (e) {
                        function t(t) {
                            var n = this.constructor, r = e.call(this, t) || this;
                            return Object.setPrototypeOf(r, n.prototype), r
                        }

                        return p(t, e), t
                    }(Error), g = function (e) {
                        function t(t) {
                            var n = this.constructor, r = e.call(this, t) || this;
                            return Object.setPrototypeOf(r, n.prototype), r
                        }

                        return p(t, e), t
                    }(Error), m = function (e) {
                        function t(t) {
                            var n = this.constructor, r = e.call(this, t) || this;
                            return Object.setPrototypeOf(r, n.prototype), r
                        }

                        return p(t, e), t
                    }(Error), v = function (e) {
                        function t(t) {
                            var n = this.constructor, r = e.call(this, t) || this;
                            return Object.setPrototypeOf(r, n.prototype), r
                        }

                        return p(t, e), t
                    }(Error), b = function (e) {
                        function t(t) {
                            var n = this.constructor, r = e.call(this, t) || this;
                            return Object.setPrototypeOf(r, n.prototype), r
                        }

                        return p(t, e), t
                    }(Error), w = function (e) {
                        function t(t) {
                            var n = this.constructor, r = e.call(this, t) || this;
                            return Object.setPrototypeOf(r, n.prototype), r
                        }

                        return p(t, e), t
                    }(Error), y = function (e) {
                        function t(t, n) {
                            var r = this.constructor, i = e.call(this, n) || this;
                            return i.status = t, Object.setPrototypeOf(i, r.prototype), i
                        }

                        return p(t, e), t
                    }(Error), _ = function (e, t, n) {
                        var r, i = this;
                        for (var o in (r = Tt.createXHR()).open("POST", i.options.authEndpoint, !0), r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), this.authOptions.headers) r.setRequestHeader(o, this.authOptions.headers[o]);
                        return r.onreadystatechange = function () {
                            if (4 === r.readyState) if (200 === r.status) {
                                var e = void 0, t = !1;
                                try {
                                    e = JSON.parse(r.responseText), t = !0
                                } catch (e) {
                                    n(new y(200, "JSON returned from auth endpoint was invalid, yet status code was 200. Data was: " + r.responseText), {auth: ""})
                                }
                                t && n(null, e)
                            } else {
                                var o = d("authenticationEndpoint");
                                n(new y(r.status, "Unable to retrieve auth string from auth endpoint - received status: " + r.status + " from " + i.options.authEndpoint + ". Clients must be authenticated to join private or presence channels. " + o), {auth: ""})
                            }
                        }, r.send(this.composeQuery(t)), r
                    }, k = String.fromCharCode, x = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", S = {}, C = 0, E = x.length; C < E; C++) S[x.charAt(C)] = C;
                    var T = function (e) {
                        var t = e.charCodeAt(0);
                        return t < 128 ? e : t < 2048 ? k(192 | t >>> 6) + k(128 | 63 & t) : k(224 | t >>> 12 & 15) + k(128 | t >>> 6 & 63) + k(128 | 63 & t)
                    }, A = function (e) {
                        return e.replace(/[^\x00-\x7F]/g, T)
                    }, O = function (e) {
                        var t = [0, 2, 1][e.length % 3],
                            n = e.charCodeAt(0) << 16 | (e.length > 1 ? e.charCodeAt(1) : 0) << 8 | (e.length > 2 ? e.charCodeAt(2) : 0);
                        return [x.charAt(n >>> 18), x.charAt(n >>> 12 & 63), t >= 2 ? "=" : x.charAt(n >>> 6 & 63), t >= 1 ? "=" : x.charAt(63 & n)].join("")
                    }, P = window.btoa || function (e) {
                        return e.replace(/[\s\S]{1,3}/g, O)
                    }, M = function () {
                        function e(e, t, n, r) {
                            var i = this;
                            this.clear = t, this.timer = e((function () {
                                i.timer && (i.timer = r(i.timer))
                            }), n)
                        }

                        return e.prototype.isRunning = function () {
                            return null !== this.timer
                        }, e.prototype.ensureAborted = function () {
                            this.timer && (this.clear(this.timer), this.timer = null)
                        }, e
                    }(), L = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }();

                    function j(e) {
                        window.clearTimeout(e)
                    }

                    function N(e) {
                        window.clearInterval(e)
                    }

                    var I = function (e) {
                        function t(t, n) {
                            return e.call(this, setTimeout, j, t, (function (e) {
                                return n(), null
                            })) || this
                        }

                        return L(t, e), t
                    }(M), z = function (e) {
                        function t(t, n) {
                            return e.call(this, setInterval, N, t, (function (e) {
                                return n(), e
                            })) || this
                        }

                        return L(t, e), t
                    }(M), R = {
                        now: function () {
                            return Date.now ? Date.now() : (new Date).valueOf()
                        }, defer: function (e) {
                            return new I(0, e)
                        }, method: function (e) {
                            for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
                            var r = Array.prototype.slice.call(arguments, 1);
                            return function (t) {
                                return t[e].apply(t, r.concat(arguments))
                            }
                        }
                    }, B = R;

                    function D(e) {
                        for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
                        for (var r = 0; r < t.length; r++) {
                            var i = t[r];
                            for (var o in i) i[o] && i[o].constructor && i[o].constructor === Object ? e[o] = D(e[o] || {}, i[o]) : e[o] = i[o]
                        }
                        return e
                    }

                    function H() {
                        for (var e = ["Pusher"], t = 0; t < arguments.length; t++) "string" == typeof arguments[t] ? e.push(arguments[t]) : e.push(Y(arguments[t]));
                        return e.join(" : ")
                    }

                    function $(e, t) {
                        var n = Array.prototype.indexOf;
                        if (null === e) return -1;
                        if (n && e.indexOf === n) return e.indexOf(t);
                        for (var r = 0, i = e.length; r < i; r++) if (e[r] === t) return r;
                        return -1
                    }

                    function q(e, t) {
                        for (var n in e) Object.prototype.hasOwnProperty.call(e, n) && t(e[n], n, e)
                    }

                    function F(e) {
                        var t = [];
                        return q(e, (function (e, n) {
                            t.push(n)
                        })), t
                    }

                    function U(e, t, n) {
                        for (var r = 0; r < e.length; r++) t.call(n || window, e[r], r, e)
                    }

                    function V(e, t) {
                        for (var n = [], r = 0; r < e.length; r++) n.push(t(e[r], r, e, n));
                        return n
                    }

                    function W(e, t) {
                        t = t || function (e) {
                            return !!e
                        };
                        for (var n = [], r = 0; r < e.length; r++) t(e[r], r, e, n) && n.push(e[r]);
                        return n
                    }

                    function G(e, t) {
                        var n = {};
                        return q(e, (function (r, i) {
                            (t && t(r, i, e, n) || Boolean(r)) && (n[i] = r)
                        })), n
                    }

                    function K(e, t) {
                        for (var n = 0; n < e.length; n++) if (t(e[n], n, e)) return !0;
                        return !1
                    }

                    function X(e) {
                        return t = function (e) {
                            return "object" == typeof e && (e = Y(e)), encodeURIComponent((t = e.toString(), P(A(t))));
                            var t
                        }, n = {}, q(e, (function (e, r) {
                            n[r] = t(e)
                        })), n;
                        var t, n
                    }

                    function Z(e) {
                        var t, n, r = G(e, (function (e) {
                            return void 0 !== e
                        }));
                        return V((t = X(r), n = [], q(t, (function (e, t) {
                            n.push([t, e])
                        })), n), B.method("join", "=")).join("&")
                    }

                    function Y(e) {
                        try {
                            return JSON.stringify(e)
                        } catch (r) {
                            return JSON.stringify((t = [], n = [], function e(r, i) {
                                var o, a, s;
                                switch (typeof r) {
                                    case"object":
                                        if (!r) return null;
                                        for (o = 0; o < t.length; o += 1) if (t[o] === r) return {$ref: n[o]};
                                        if (t.push(r), n.push(i), "[object Array]" === Object.prototype.toString.apply(r)) for (s = [], o = 0; o < r.length; o += 1) s[o] = e(r[o], i + "[" + o + "]"); else for (a in s = {}, r) Object.prototype.hasOwnProperty.call(r, a) && (s[a] = e(r[a], i + "[" + JSON.stringify(a) + "]"));
                                        return s;
                                    case"number":
                                    case"string":
                                    case"boolean":
                                        return r
                                }
                            }(e, "$")))
                        }
                        var t, n
                    }

                    var J = function () {
                        function e() {
                            this.globalLog = function (e) {
                                window.console && window.console.log && window.console.log(e)
                            }
                        }

                        return e.prototype.debug = function () {
                            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                            this.log(this.globalLog, e)
                        }, e.prototype.warn = function () {
                            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                            this.log(this.globalLogWarn, e)
                        }, e.prototype.error = function () {
                            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                            this.log(this.globalLogError, e)
                        }, e.prototype.globalLogWarn = function (e) {
                            window.console && window.console.warn ? window.console.warn(e) : this.globalLog(e)
                        }, e.prototype.globalLogError = function (e) {
                            window.console && window.console.error ? window.console.error(e) : this.globalLogWarn(e)
                        }, e.prototype.log = function (e) {
                            for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
                            var r = H.apply(this, arguments);
                            if ($t.log) $t.log(r); else if ($t.logToConsole) {
                                var i = e.bind(this);
                                i(r)
                            }
                        }, e
                    }(), Q = new J, ee = function (e, t, n) {
                        void 0 !== this.authOptions.headers && Q.warn("To send headers with the auth request, you must use AJAX, rather than JSONP.");
                        var r = e.nextAuthCallbackID.toString();
                        e.nextAuthCallbackID++;
                        var i = e.getDocument(), o = i.createElement("script");
                        e.auth_callbacks[r] = function (e) {
                            n(null, e)
                        };
                        var a = "Pusher.auth_callbacks['" + r + "']";
                        o.src = this.options.authEndpoint + "?callback=" + encodeURIComponent(a) + "&" + this.composeQuery(t);
                        var s = i.getElementsByTagName("head")[0] || i.documentElement;
                        s.insertBefore(o, s.firstChild)
                    }, te = function () {
                        function e(e) {
                            this.src = e
                        }

                        return e.prototype.send = function (e) {
                            var t = this, n = "Error loading " + t.src;
                            t.script = document.createElement("script"), t.script.id = e.id, t.script.src = t.src, t.script.type = "text/javascript", t.script.charset = "UTF-8", t.script.addEventListener ? (t.script.onerror = function () {
                                e.callback(n)
                            }, t.script.onload = function () {
                                e.callback(null)
                            }) : t.script.onreadystatechange = function () {
                                "loaded" !== t.script.readyState && "complete" !== t.script.readyState || e.callback(null)
                            }, void 0 === t.script.async && document.attachEvent && /opera/i.test(navigator.userAgent) ? (t.errorScript = document.createElement("script"), t.errorScript.id = e.id + "_error", t.errorScript.text = e.name + "('" + n + "');", t.script.async = t.errorScript.async = !1) : t.script.async = !0;
                            var r = document.getElementsByTagName("head")[0];
                            r.insertBefore(t.script, r.firstChild), t.errorScript && r.insertBefore(t.errorScript, t.script.nextSibling)
                        }, e.prototype.cleanup = function () {
                            this.script && (this.script.onload = this.script.onerror = null, this.script.onreadystatechange = null), this.script && this.script.parentNode && this.script.parentNode.removeChild(this.script), this.errorScript && this.errorScript.parentNode && this.errorScript.parentNode.removeChild(this.errorScript), this.script = null, this.errorScript = null
                        }, e
                    }(), ne = function () {
                        function e(e, t) {
                            this.url = e, this.data = t
                        }

                        return e.prototype.send = function (e) {
                            if (!this.request) {
                                var t = Z(this.data), n = this.url + "/" + e.number + "?" + t;
                                this.request = Tt.createScriptRequest(n), this.request.send(e)
                            }
                        }, e.prototype.cleanup = function () {
                            this.request && this.request.cleanup()
                        }, e
                    }(), re = {
                        name: "jsonp", getAgent: function (e, t) {
                            return function (n, r) {
                                var i = "http" + (t ? "s" : "") + "://" + (e.host || e.options.host) + e.options.path,
                                    a = Tt.createJSONPRequest(i, n), s = Tt.ScriptReceivers.create((function (t, n) {
                                        o.remove(s), a.cleanup(), n && n.host && (e.host = n.host), r && r(t, n)
                                    }));
                                a.send(s)
                            }
                        }
                    };

                    function ie(e, t, n) {
                        return e + (t.useTLS ? "s" : "") + "://" + (t.useTLS ? t.hostTLS : t.hostNonTLS) + n
                    }

                    function oe(e, t) {
                        return "/app/" + e + "?protocol=" + a.PROTOCOL + "&client=js&version=" + a.VERSION + (t ? "&" + t : "")
                    }

                    var ae = {
                        getInitial: function (e, t) {
                            return ie("ws", t, (t.httpPath || "") + oe(e, "flash=false"))
                        }
                    }, se = {
                        getInitial: function (e, t) {
                            return ie("http", t, (t.httpPath || "/pusher") + oe(e))
                        }
                    }, le = {
                        getInitial: function (e, t) {
                            return ie("http", t, t.httpPath || "/pusher")
                        }, getPath: function (e, t) {
                            return oe(e)
                        }
                    }, ce = function () {
                        function e() {
                            this._callbacks = {}
                        }

                        return e.prototype.get = function (e) {
                            return this._callbacks[ue(e)]
                        }, e.prototype.add = function (e, t, n) {
                            var r = ue(e);
                            this._callbacks[r] = this._callbacks[r] || [], this._callbacks[r].push({fn: t, context: n})
                        }, e.prototype.remove = function (e, t, n) {
                            if (e || t || n) {
                                var r = e ? [ue(e)] : F(this._callbacks);
                                t || n ? this.removeCallback(r, t, n) : this.removeAllCallbacks(r)
                            } else this._callbacks = {}
                        }, e.prototype.removeCallback = function (e, t, n) {
                            U(e, (function (e) {
                                this._callbacks[e] = W(this._callbacks[e] || [], (function (e) {
                                    return t && t !== e.fn || n && n !== e.context
                                })), 0 === this._callbacks[e].length && delete this._callbacks[e]
                            }), this)
                        }, e.prototype.removeAllCallbacks = function (e) {
                            U(e, (function (e) {
                                delete this._callbacks[e]
                            }), this)
                        }, e
                    }();

                    function ue(e) {
                        return "_" + e
                    }

                    var de = function () {
                            function e(e) {
                                this.callbacks = new ce, this.global_callbacks = [], this.failThrough = e
                            }

                            return e.prototype.bind = function (e, t, n) {
                                return this.callbacks.add(e, t, n), this
                            }, e.prototype.bind_global = function (e) {
                                return this.global_callbacks.push(e), this
                            }, e.prototype.unbind = function (e, t, n) {
                                return this.callbacks.remove(e, t, n), this
                            }, e.prototype.unbind_global = function (e) {
                                return e ? (this.global_callbacks = W(this.global_callbacks || [], (function (t) {
                                    return t !== e
                                })), this) : (this.global_callbacks = [], this)
                            }, e.prototype.unbind_all = function () {
                                return this.unbind(), this.unbind_global(), this
                            }, e.prototype.emit = function (e, t, n) {
                                for (var r = 0; r < this.global_callbacks.length; r++) this.global_callbacks[r](e, t);
                                var i = this.callbacks.get(e), o = [];
                                if (n ? o.push(t, n) : t && o.push(t), i && i.length > 0) for (r = 0; r < i.length; r++) i[r].fn.apply(i[r].context || window, o); else this.failThrough && this.failThrough(e, t);
                                return this
                            }, e
                        }(), pe = function () {
                            var e = function (t, n) {
                                return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                    e.__proto__ = t
                                } || function (e, t) {
                                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                                }, e(t, n)
                            };
                            return function (t, n) {
                                function r() {
                                    this.constructor = t
                                }

                                e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                            }
                        }(), he = function (e) {
                            function t(t, n, r, i, o) {
                                var a = e.call(this) || this;
                                return a.initialize = Tt.transportConnectionInitializer, a.hooks = t, a.name = n, a.priority = r, a.key = i, a.options = o, a.state = "new", a.timeline = o.timeline, a.activityTimeout = o.activityTimeout, a.id = a.timeline.generateUniqueID(), a
                            }

                            return pe(t, e), t.prototype.handlesActivityChecks = function () {
                                return Boolean(this.hooks.handlesActivityChecks)
                            }, t.prototype.supportsPing = function () {
                                return Boolean(this.hooks.supportsPing)
                            }, t.prototype.connect = function () {
                                var e = this;
                                if (this.socket || "initialized" !== this.state) return !1;
                                var t = this.hooks.urls.getInitial(this.key, this.options);
                                try {
                                    this.socket = this.hooks.getSocket(t, this.options)
                                } catch (t) {
                                    return B.defer((function () {
                                        e.onError(t), e.changeState("closed")
                                    })), !1
                                }
                                return this.bindListeners(), Q.debug("Connecting", {
                                    transport: this.name,
                                    url: t
                                }), this.changeState("connecting"), !0
                            }, t.prototype.close = function () {
                                return !!this.socket && (this.socket.close(), !0)
                            }, t.prototype.send = function (e) {
                                var t = this;
                                return "open" === this.state && (B.defer((function () {
                                    t.socket && t.socket.send(e)
                                })), !0)
                            }, t.prototype.ping = function () {
                                "open" === this.state && this.supportsPing() && this.socket.ping()
                            }, t.prototype.onOpen = function () {
                                this.hooks.beforeOpen && this.hooks.beforeOpen(this.socket, this.hooks.urls.getPath(this.key, this.options)), this.changeState("open"), this.socket.onopen = void 0
                            }, t.prototype.onError = function (e) {
                                this.emit("error", {
                                    type: "WebSocketError",
                                    error: e
                                }), this.timeline.error(this.buildTimelineMessage({error: e.toString()}))
                            }, t.prototype.onClose = function (e) {
                                e ? this.changeState("closed", {
                                    code: e.code,
                                    reason: e.reason,
                                    wasClean: e.wasClean
                                }) : this.changeState("closed"), this.unbindListeners(), this.socket = void 0
                            }, t.prototype.onMessage = function (e) {
                                this.emit("message", e)
                            }, t.prototype.onActivity = function () {
                                this.emit("activity")
                            }, t.prototype.bindListeners = function () {
                                var e = this;
                                this.socket.onopen = function () {
                                    e.onOpen()
                                }, this.socket.onerror = function (t) {
                                    e.onError(t)
                                }, this.socket.onclose = function (t) {
                                    e.onClose(t)
                                }, this.socket.onmessage = function (t) {
                                    e.onMessage(t)
                                }, this.supportsPing() && (this.socket.onactivity = function () {
                                    e.onActivity()
                                })
                            }, t.prototype.unbindListeners = function () {
                                this.socket && (this.socket.onopen = void 0, this.socket.onerror = void 0, this.socket.onclose = void 0, this.socket.onmessage = void 0, this.supportsPing() && (this.socket.onactivity = void 0))
                            }, t.prototype.changeState = function (e, t) {
                                this.state = e, this.timeline.info(this.buildTimelineMessage({
                                    state: e,
                                    params: t
                                })), this.emit(e, t)
                            }, t.prototype.buildTimelineMessage = function (e) {
                                return D({cid: this.id}, e)
                            }, t
                        }(de), fe = he, ge = function () {
                            function e(e) {
                                this.hooks = e
                            }

                            return e.prototype.isSupported = function (e) {
                                return this.hooks.isSupported(e)
                            }, e.prototype.createConnection = function (e, t, n, r) {
                                return new fe(this.hooks, e, t, n, r)
                            }, e
                        }(), me = new ge({
                            urls: ae, handlesActivityChecks: !1, supportsPing: !1, isInitialized: function () {
                                return Boolean(Tt.getWebSocketAPI())
                            }, isSupported: function () {
                                return Boolean(Tt.getWebSocketAPI())
                            }, getSocket: function (e) {
                                return Tt.createWebSocket(e)
                            }
                        }), ve = {
                            urls: se, handlesActivityChecks: !1, supportsPing: !0, isInitialized: function () {
                                return !0
                            }
                        }, be = D({
                            getSocket: function (e) {
                                return Tt.HTTPFactory.createStreamingSocket(e)
                            }
                        }, ve), we = D({
                            getSocket: function (e) {
                                return Tt.HTTPFactory.createPollingSocket(e)
                            }
                        }, ve), ye = {
                            isSupported: function () {
                                return Tt.isXHRSupported()
                            }
                        }, _e = {ws: me, xhr_streaming: new ge(D({}, be, ye)), xhr_polling: new ge(D({}, we, ye))},
                        ke = new ge({
                            file: "sockjs",
                            urls: le,
                            handlesActivityChecks: !0,
                            supportsPing: !1,
                            isSupported: function () {
                                return !0
                            },
                            isInitialized: function () {
                                return void 0 !== window.SockJS
                            },
                            getSocket: function (e, t) {
                                return new window.SockJS(e, null, {
                                    js_path: c.getPath("sockjs", {useTLS: t.useTLS}),
                                    ignore_null_origin: t.ignoreNullOrigin
                                })
                            },
                            beforeOpen: function (e, t) {
                                e.send(JSON.stringify({path: t}))
                            }
                        }), xe = {
                            isSupported: function (e) {
                                return Tt.isXDRSupported(e.useTLS)
                            }
                        }, Se = new ge(D({}, be, xe)), Ce = new ge(D({}, we, xe));
                    _e.xdr_streaming = Se, _e.xdr_polling = Ce, _e.sockjs = ke;
                    var Ee = _e, Te = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), Ae = new (function (e) {
                        function t() {
                            var t = e.call(this) || this, n = t;
                            return void 0 !== window.addEventListener && (window.addEventListener("online", (function () {
                                n.emit("online")
                            }), !1), window.addEventListener("offline", (function () {
                                n.emit("offline")
                            }), !1)), t
                        }

                        return Te(t, e), t.prototype.isOnline = function () {
                            return void 0 === window.navigator.onLine || window.navigator.onLine
                        }, t
                    }(de)), Oe = function () {
                        function e(e, t, n) {
                            this.manager = e, this.transport = t, this.minPingDelay = n.minPingDelay, this.maxPingDelay = n.maxPingDelay, this.pingDelay = void 0
                        }

                        return e.prototype.createConnection = function (e, t, n, r) {
                            var i = this;
                            r = D({}, r, {activityTimeout: this.pingDelay});
                            var o = this.transport.createConnection(e, t, n, r), a = null, s = function () {
                                o.unbind("open", s), o.bind("closed", l), a = B.now()
                            }, l = function (e) {
                                if (o.unbind("closed", l), 1002 === e.code || 1003 === e.code) i.manager.reportDeath(); else if (!e.wasClean && a) {
                                    var t = B.now() - a;
                                    t < 2 * i.maxPingDelay && (i.manager.reportDeath(), i.pingDelay = Math.max(t / 2, i.minPingDelay))
                                }
                            };
                            return o.bind("open", s), o
                        }, e.prototype.isSupported = function (e) {
                            return this.manager.isAlive() && this.transport.isSupported(e)
                        }, e
                    }(), Pe = {
                        decodeMessage: function (e) {
                            try {
                                var t = JSON.parse(e.data), n = t.data;
                                if ("string" == typeof n) try {
                                    n = JSON.parse(t.data)
                                } catch (e) {
                                }
                                var r = {event: t.event, channel: t.channel, data: n};
                                return t.user_id && (r.user_id = t.user_id), r
                            } catch (t) {
                                throw{type: "MessageParseError", error: t, data: e.data}
                            }
                        }, encodeMessage: function (e) {
                            return JSON.stringify(e)
                        }, processHandshake: function (e) {
                            var t = Pe.decodeMessage(e);
                            if ("pusher:connection_established" === t.event) {
                                if (!t.data.activity_timeout) throw"No activity timeout specified in handshake";
                                return {
                                    action: "connected",
                                    id: t.data.socket_id,
                                    activityTimeout: 1e3 * t.data.activity_timeout
                                }
                            }
                            if ("pusher:error" === t.event) return {
                                action: this.getCloseAction(t.data),
                                error: this.getCloseError(t.data)
                            };
                            throw"Invalid handshake"
                        }, getCloseAction: function (e) {
                            return e.code < 4e3 ? e.code >= 1002 && e.code <= 1004 ? "backoff" : null : 4e3 === e.code ? "tls_only" : e.code < 4100 ? "refused" : e.code < 4200 ? "backoff" : e.code < 4300 ? "retry" : "refused"
                        }, getCloseError: function (e) {
                            return 1e3 !== e.code && 1001 !== e.code ? {
                                type: "PusherError",
                                data: {code: e.code, message: e.reason || e.message}
                            } : null
                        }
                    }, Me = Pe, Le = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), je = function (e) {
                        function t(t, n) {
                            var r = e.call(this) || this;
                            return r.id = t, r.transport = n, r.activityTimeout = n.activityTimeout, r.bindListeners(), r
                        }

                        return Le(t, e), t.prototype.handlesActivityChecks = function () {
                            return this.transport.handlesActivityChecks()
                        }, t.prototype.send = function (e) {
                            return this.transport.send(e)
                        }, t.prototype.send_event = function (e, t, n) {
                            var r = {event: e, data: t};
                            return n && (r.channel = n), Q.debug("Event sent", r), this.send(Me.encodeMessage(r))
                        }, t.prototype.ping = function () {
                            this.transport.supportsPing() ? this.transport.ping() : this.send_event("pusher:ping", {})
                        }, t.prototype.close = function () {
                            this.transport.close()
                        }, t.prototype.bindListeners = function () {
                            var e = this, t = {
                                message: function (t) {
                                    var n;
                                    try {
                                        n = Me.decodeMessage(t)
                                    } catch (n) {
                                        e.emit("error", {type: "MessageParseError", error: n, data: t.data})
                                    }
                                    if (void 0 !== n) {
                                        switch (Q.debug("Event recd", n), n.event) {
                                            case"pusher:error":
                                                e.emit("error", {type: "PusherError", data: n.data});
                                                break;
                                            case"pusher:ping":
                                                e.emit("ping");
                                                break;
                                            case"pusher:pong":
                                                e.emit("pong")
                                        }
                                        e.emit("message", n)
                                    }
                                }, activity: function () {
                                    e.emit("activity")
                                }, error: function (t) {
                                    e.emit("error", t)
                                }, closed: function (t) {
                                    n(), t && t.code && e.handleCloseEvent(t), e.transport = null, e.emit("closed")
                                }
                            }, n = function () {
                                q(t, (function (t, n) {
                                    e.transport.unbind(n, t)
                                }))
                            };
                            q(t, (function (t, n) {
                                e.transport.bind(n, t)
                            }))
                        }, t.prototype.handleCloseEvent = function (e) {
                            var t = Me.getCloseAction(e), n = Me.getCloseError(e);
                            n && this.emit("error", n), t && this.emit(t, {action: t, error: n})
                        }, t
                    }(de), Ne = function () {
                        function e(e, t) {
                            this.transport = e, this.callback = t, this.bindListeners()
                        }

                        return e.prototype.close = function () {
                            this.unbindListeners(), this.transport.close()
                        }, e.prototype.bindListeners = function () {
                            var e = this;
                            this.onMessage = function (t) {
                                var n;
                                e.unbindListeners();
                                try {
                                    n = Me.processHandshake(t)
                                } catch (t) {
                                    return e.finish("error", {error: t}), void e.transport.close()
                                }
                                "connected" === n.action ? e.finish("connected", {
                                    connection: new je(n.id, e.transport),
                                    activityTimeout: n.activityTimeout
                                }) : (e.finish(n.action, {error: n.error}), e.transport.close())
                            }, this.onClosed = function (t) {
                                e.unbindListeners();
                                var n = Me.getCloseAction(t) || "backoff", r = Me.getCloseError(t);
                                e.finish(n, {error: r})
                            }, this.transport.bind("message", this.onMessage), this.transport.bind("closed", this.onClosed)
                        }, e.prototype.unbindListeners = function () {
                            this.transport.unbind("message", this.onMessage), this.transport.unbind("closed", this.onClosed)
                        }, e.prototype.finish = function (e, t) {
                            this.callback(D({transport: this.transport, action: e}, t))
                        }, e
                    }(), Ie = function () {
                        function e(e, t) {
                            this.channel = e;
                            var n = t.authTransport;
                            if (void 0 === Tt.getAuthorizers()[n]) throw"'" + n + "' is not a recognized auth transport";
                            this.type = n, this.options = t, this.authOptions = t.auth || {}
                        }

                        return e.prototype.composeQuery = function (e) {
                            var t = "socket_id=" + encodeURIComponent(e) + "&channel_name=" + encodeURIComponent(this.channel.name);
                            for (var n in this.authOptions.params) t += "&" + encodeURIComponent(n) + "=" + encodeURIComponent(this.authOptions.params[n]);
                            return t
                        }, e.prototype.authorize = function (t, n) {
                            e.authorizers = e.authorizers || Tt.getAuthorizers(), e.authorizers[this.type].call(this, Tt, t, n)
                        }, e
                    }(), ze = function () {
                        function e(e, t) {
                            this.timeline = e, this.options = t || {}
                        }

                        return e.prototype.send = function (e, t) {
                            this.timeline.isEmpty() || this.timeline.send(Tt.TimelineTransport.getAgent(this, e), t)
                        }, e
                    }(), Re = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), Be = function (e) {
                        function t(t, n) {
                            var r = e.call(this, (function (e, n) {
                                Q.debug("No callbacks on " + t + " for " + e)
                            })) || this;
                            return r.name = t, r.pusher = n, r.subscribed = !1, r.subscriptionPending = !1, r.subscriptionCancelled = !1, r
                        }

                        return Re(t, e), t.prototype.authorize = function (e, t) {
                            return t(null, {auth: ""})
                        }, t.prototype.trigger = function (e, t) {
                            if (0 !== e.indexOf("client-")) throw new h("Event '" + e + "' does not start with 'client-'");
                            if (!this.subscribed) {
                                var n = d("triggeringClientEvents");
                                Q.warn("Client event triggered before channel 'subscription_succeeded' event . " + n)
                            }
                            return this.pusher.send_event(e, t, this.name)
                        }, t.prototype.disconnect = function () {
                            this.subscribed = !1, this.subscriptionPending = !1
                        }, t.prototype.handleEvent = function (e) {
                            var t = e.event, n = e.data;
                            "pusher_internal:subscription_succeeded" === t ? this.handleSubscriptionSucceededEvent(e) : 0 !== t.indexOf("pusher_internal:") && this.emit(t, n, {})
                        }, t.prototype.handleSubscriptionSucceededEvent = function (e) {
                            this.subscriptionPending = !1, this.subscribed = !0, this.subscriptionCancelled ? this.pusher.unsubscribe(this.name) : this.emit("pusher:subscription_succeeded", e.data)
                        }, t.prototype.subscribe = function () {
                            var e = this;
                            this.subscribed || (this.subscriptionPending = !0, this.subscriptionCancelled = !1, this.authorize(this.pusher.connection.socket_id, (function (t, n) {
                                t ? (e.subscriptionPending = !1, Q.error(t.toString()), e.emit("pusher:subscription_error", Object.assign({}, {
                                    type: "AuthError",
                                    error: t.message
                                }, t instanceof y ? {status: t.status} : {}))) : e.pusher.send_event("pusher:subscribe", {
                                    auth: n.auth,
                                    channel_data: n.channel_data,
                                    channel: e.name
                                })
                            })))
                        }, t.prototype.unsubscribe = function () {
                            this.subscribed = !1, this.pusher.send_event("pusher:unsubscribe", {channel: this.name})
                        }, t.prototype.cancelSubscription = function () {
                            this.subscriptionCancelled = !0
                        }, t.prototype.reinstateSubscription = function () {
                            this.subscriptionCancelled = !1
                        }, t
                    }(de), De = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), He = function (e) {
                        function t() {
                            return null !== e && e.apply(this, arguments) || this
                        }

                        return De(t, e), t.prototype.authorize = function (e, t) {
                            return Qe.createAuthorizer(this, this.pusher.config).authorize(e, t)
                        }, t
                    }(Be), $e = He, qe = function () {
                        function e() {
                            this.reset()
                        }

                        return e.prototype.get = function (e) {
                            return Object.prototype.hasOwnProperty.call(this.members, e) ? {
                                id: e,
                                info: this.members[e]
                            } : null
                        }, e.prototype.each = function (e) {
                            var t = this;
                            q(this.members, (function (n, r) {
                                e(t.get(r))
                            }))
                        }, e.prototype.setMyID = function (e) {
                            this.myID = e
                        }, e.prototype.onSubscription = function (e) {
                            this.members = e.presence.hash, this.count = e.presence.count, this.me = this.get(this.myID)
                        }, e.prototype.addMember = function (e) {
                            return null === this.get(e.user_id) && this.count++, this.members[e.user_id] = e.user_info, this.get(e.user_id)
                        }, e.prototype.removeMember = function (e) {
                            var t = this.get(e.user_id);
                            return t && (delete this.members[e.user_id], this.count--), t
                        }, e.prototype.reset = function () {
                            this.members = {}, this.count = 0, this.myID = null, this.me = null
                        }, e
                    }(), Fe = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), Ue = function (e) {
                        function t(t, n) {
                            var r = e.call(this, t, n) || this;
                            return r.members = new qe, r
                        }

                        return Fe(t, e), t.prototype.authorize = function (t, n) {
                            var r = this;
                            e.prototype.authorize.call(this, t, (function (e, t) {
                                if (!e) {
                                    if (void 0 === (t = t).channel_data) {
                                        var i = d("authenticationEndpoint");
                                        return Q.error("Invalid auth response for channel '" + r.name + "',expected 'channel_data' field. " + i), void n("Invalid auth response")
                                    }
                                    var o = JSON.parse(t.channel_data);
                                    r.members.setMyID(o.user_id)
                                }
                                n(e, t)
                            }))
                        }, t.prototype.handleEvent = function (e) {
                            var t = e.event;
                            if (0 === t.indexOf("pusher_internal:")) this.handleInternalEvent(e); else {
                                var n = e.data, r = {};
                                e.user_id && (r.user_id = e.user_id), this.emit(t, n, r)
                            }
                        }, t.prototype.handleInternalEvent = function (e) {
                            var t = e.event, n = e.data;
                            switch (t) {
                                case"pusher_internal:subscription_succeeded":
                                    this.handleSubscriptionSucceededEvent(e);
                                    break;
                                case"pusher_internal:member_added":
                                    var r = this.members.addMember(n);
                                    this.emit("pusher:member_added", r);
                                    break;
                                case"pusher_internal:member_removed":
                                    var i = this.members.removeMember(n);
                                    i && this.emit("pusher:member_removed", i)
                            }
                        }, t.prototype.handleSubscriptionSucceededEvent = function (e) {
                            this.subscriptionPending = !1, this.subscribed = !0, this.subscriptionCancelled ? this.pusher.unsubscribe(this.name) : (this.members.onSubscription(e.data), this.emit("pusher:subscription_succeeded", this.members))
                        }, t.prototype.disconnect = function () {
                            this.members.reset(), e.prototype.disconnect.call(this)
                        }, t
                    }($e), Ve = n(1), We = n(0), Ge = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), Ke = function (e) {
                        function t(t, n, r) {
                            var i = e.call(this, t, n) || this;
                            return i.key = null, i.nacl = r, i
                        }

                        return Ge(t, e), t.prototype.authorize = function (t, n) {
                            var r = this;
                            e.prototype.authorize.call(this, t, (function (e, t) {
                                if (e) n(e, t); else {
                                    var i = t.shared_secret;
                                    i ? (r.key = Object(We.decode)(i), delete t.shared_secret, n(null, t)) : n(new Error("No shared_secret key in auth payload for encrypted channel: " + r.name), null)
                                }
                            }))
                        }, t.prototype.trigger = function (e, t) {
                            throw new v("Client events are not currently supported for encrypted channels")
                        }, t.prototype.handleEvent = function (t) {
                            var n = t.event, r = t.data;
                            0 !== n.indexOf("pusher_internal:") && 0 !== n.indexOf("pusher:") ? this.handleEncryptedEvent(n, r) : e.prototype.handleEvent.call(this, t)
                        }, t.prototype.handleEncryptedEvent = function (e, t) {
                            var n = this;
                            if (this.key) if (t.ciphertext && t.nonce) {
                                var r = Object(We.decode)(t.ciphertext);
                                if (r.length < this.nacl.secretbox.overheadLength) Q.error("Expected encrypted event ciphertext length to be " + this.nacl.secretbox.overheadLength + ", got: " + r.length); else {
                                    var i = Object(We.decode)(t.nonce);
                                    if (i.length < this.nacl.secretbox.nonceLength) Q.error("Expected encrypted event nonce length to be " + this.nacl.secretbox.nonceLength + ", got: " + i.length); else {
                                        var o = this.nacl.secretbox.open(r, i, this.key);
                                        if (null === o) return Q.debug("Failed to decrypt an event, probably because it was encrypted with a different key. Fetching a new key from the authEndpoint..."), void this.authorize(this.pusher.connection.socket_id, (function (t, a) {
                                            t ? Q.error("Failed to make a request to the authEndpoint: " + a + ". Unable to fetch new key, so dropping encrypted event") : null !== (o = n.nacl.secretbox.open(r, i, n.key)) ? n.emit(e, n.getDataToEmit(o)) : Q.error("Failed to decrypt event with new key. Dropping encrypted event")
                                        }));
                                        this.emit(e, this.getDataToEmit(o))
                                    }
                                }
                            } else Q.error("Unexpected format for encrypted event, expected object with `ciphertext` and `nonce` fields, got: " + t); else Q.debug("Received encrypted event before key has been retrieved from the authEndpoint")
                        }, t.prototype.getDataToEmit = function (e) {
                            var t = Object(Ve.decode)(e);
                            try {
                                return JSON.parse(t)
                            } catch (e) {
                                return t
                            }
                        }, t
                    }($e), Xe = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), Ze = function (e) {
                        function t(t, n) {
                            var r = e.call(this) || this;
                            r.state = "initialized", r.connection = null, r.key = t, r.options = n, r.timeline = r.options.timeline, r.usingTLS = r.options.useTLS, r.errorCallbacks = r.buildErrorCallbacks(), r.connectionCallbacks = r.buildConnectionCallbacks(r.errorCallbacks), r.handshakeCallbacks = r.buildHandshakeCallbacks(r.errorCallbacks);
                            var i = Tt.getNetwork();
                            return i.bind("online", (function () {
                                r.timeline.info({netinfo: "online"}), "connecting" !== r.state && "unavailable" !== r.state || r.retryIn(0)
                            })), i.bind("offline", (function () {
                                r.timeline.info({netinfo: "offline"}), r.connection && r.sendActivityCheck()
                            })), r.updateStrategy(), r
                        }

                        return Xe(t, e), t.prototype.connect = function () {
                            this.connection || this.runner || (this.strategy.isSupported() ? (this.updateState("connecting"), this.startConnecting(), this.setUnavailableTimer()) : this.updateState("failed"))
                        }, t.prototype.send = function (e) {
                            return !!this.connection && this.connection.send(e)
                        }, t.prototype.send_event = function (e, t, n) {
                            return !!this.connection && this.connection.send_event(e, t, n)
                        }, t.prototype.disconnect = function () {
                            this.disconnectInternally(), this.updateState("disconnected")
                        }, t.prototype.isUsingTLS = function () {
                            return this.usingTLS
                        }, t.prototype.startConnecting = function () {
                            var e = this, t = function (n, r) {
                                n ? e.runner = e.strategy.connect(0, t) : "error" === r.action ? (e.emit("error", {
                                    type: "HandshakeError",
                                    error: r.error
                                }), e.timeline.error({handshakeError: r.error})) : (e.abortConnecting(), e.handshakeCallbacks[r.action](r))
                            };
                            this.runner = this.strategy.connect(0, t)
                        }, t.prototype.abortConnecting = function () {
                            this.runner && (this.runner.abort(), this.runner = null)
                        }, t.prototype.disconnectInternally = function () {
                            this.abortConnecting(), this.clearRetryTimer(), this.clearUnavailableTimer(), this.connection && this.abandonConnection().close()
                        }, t.prototype.updateStrategy = function () {
                            this.strategy = this.options.getStrategy({
                                key: this.key,
                                timeline: this.timeline,
                                useTLS: this.usingTLS
                            })
                        }, t.prototype.retryIn = function (e) {
                            var t = this;
                            this.timeline.info({
                                action: "retry",
                                delay: e
                            }), e > 0 && this.emit("connecting_in", Math.round(e / 1e3)), this.retryTimer = new I(e || 0, (function () {
                                t.disconnectInternally(), t.connect()
                            }))
                        }, t.prototype.clearRetryTimer = function () {
                            this.retryTimer && (this.retryTimer.ensureAborted(), this.retryTimer = null)
                        }, t.prototype.setUnavailableTimer = function () {
                            var e = this;
                            this.unavailableTimer = new I(this.options.unavailableTimeout, (function () {
                                e.updateState("unavailable")
                            }))
                        }, t.prototype.clearUnavailableTimer = function () {
                            this.unavailableTimer && this.unavailableTimer.ensureAborted()
                        }, t.prototype.sendActivityCheck = function () {
                            var e = this;
                            this.stopActivityCheck(), this.connection.ping(), this.activityTimer = new I(this.options.pongTimeout, (function () {
                                e.timeline.error({pong_timed_out: e.options.pongTimeout}), e.retryIn(0)
                            }))
                        }, t.prototype.resetActivityCheck = function () {
                            var e = this;
                            this.stopActivityCheck(), this.connection && !this.connection.handlesActivityChecks() && (this.activityTimer = new I(this.activityTimeout, (function () {
                                e.sendActivityCheck()
                            })))
                        }, t.prototype.stopActivityCheck = function () {
                            this.activityTimer && this.activityTimer.ensureAborted()
                        }, t.prototype.buildConnectionCallbacks = function (e) {
                            var t = this;
                            return D({}, e, {
                                message: function (e) {
                                    t.resetActivityCheck(), t.emit("message", e)
                                }, ping: function () {
                                    t.send_event("pusher:pong", {})
                                }, activity: function () {
                                    t.resetActivityCheck()
                                }, error: function (e) {
                                    t.emit("error", e)
                                }, closed: function () {
                                    t.abandonConnection(), t.shouldRetry() && t.retryIn(1e3)
                                }
                            })
                        }, t.prototype.buildHandshakeCallbacks = function (e) {
                            var t = this;
                            return D({}, e, {
                                connected: function (e) {
                                    t.activityTimeout = Math.min(t.options.activityTimeout, e.activityTimeout, e.connection.activityTimeout || 1 / 0), t.clearUnavailableTimer(), t.setConnection(e.connection), t.socket_id = t.connection.id, t.updateState("connected", {socket_id: t.socket_id})
                                }
                            })
                        }, t.prototype.buildErrorCallbacks = function () {
                            var e = this, t = function (t) {
                                return function (n) {
                                    n.error && e.emit("error", {type: "WebSocketError", error: n.error}), t(n)
                                }
                            };
                            return {
                                tls_only: t((function () {
                                    e.usingTLS = !0, e.updateStrategy(), e.retryIn(0)
                                })), refused: t((function () {
                                    e.disconnect()
                                })), backoff: t((function () {
                                    e.retryIn(1e3)
                                })), retry: t((function () {
                                    e.retryIn(0)
                                }))
                            }
                        }, t.prototype.setConnection = function (e) {
                            for (var t in this.connection = e, this.connectionCallbacks) this.connection.bind(t, this.connectionCallbacks[t]);
                            this.resetActivityCheck()
                        }, t.prototype.abandonConnection = function () {
                            if (this.connection) {
                                for (var e in this.stopActivityCheck(), this.connectionCallbacks) this.connection.unbind(e, this.connectionCallbacks[e]);
                                var t = this.connection;
                                return this.connection = null, t
                            }
                        }, t.prototype.updateState = function (e, t) {
                            var n = this.state;
                            if (this.state = e, n !== e) {
                                var r = e;
                                "connected" === r && (r += " with new socket ID " + t.socket_id), Q.debug("State changed", n + " -> " + r), this.timeline.info({
                                    state: e,
                                    params: t
                                }), this.emit("state_change", {previous: n, current: e}), this.emit(e, t)
                            }
                        }, t.prototype.shouldRetry = function () {
                            return "connecting" === this.state || "connected" === this.state
                        }, t
                    }(de), Ye = function () {
                        function e() {
                            this.channels = {}
                        }

                        return e.prototype.add = function (e, t) {
                            return this.channels[e] || (this.channels[e] = function (e, t) {
                                if (0 === e.indexOf("private-encrypted-")) {
                                    if (t.config.nacl) return Qe.createEncryptedChannel(e, t, t.config.nacl);
                                    var n = "Tried to subscribe to a private-encrypted- channel but no nacl implementation available",
                                        r = d("encryptedChannelSupport");
                                    throw new v(n + ". " + r)
                                }
                                return 0 === e.indexOf("private-") ? Qe.createPrivateChannel(e, t) : 0 === e.indexOf("presence-") ? Qe.createPresenceChannel(e, t) : Qe.createChannel(e, t)
                            }(e, t)), this.channels[e]
                        }, e.prototype.all = function () {
                            return function (e) {
                                var t = [];
                                return q(e, (function (e) {
                                    t.push(e)
                                })), t
                            }(this.channels)
                        }, e.prototype.find = function (e) {
                            return this.channels[e]
                        }, e.prototype.remove = function (e) {
                            var t = this.channels[e];
                            return delete this.channels[e], t
                        }, e.prototype.disconnect = function () {
                            q(this.channels, (function (e) {
                                e.disconnect()
                            }))
                        }, e
                    }(), Je = Ye, Qe = {
                        createChannels: function () {
                            return new Je
                        }, createConnectionManager: function (e, t) {
                            return new Ze(e, t)
                        }, createChannel: function (e, t) {
                            return new Be(e, t)
                        }, createPrivateChannel: function (e, t) {
                            return new $e(e, t)
                        }, createPresenceChannel: function (e, t) {
                            return new Ue(e, t)
                        }, createEncryptedChannel: function (e, t, n) {
                            return new Ke(e, t, n)
                        }, createTimelineSender: function (e, t) {
                            return new ze(e, t)
                        }, createAuthorizer: function (e, t) {
                            return t.authorizer ? t.authorizer(e, t) : new Ie(e, t)
                        }, createHandshake: function (e, t) {
                            return new Ne(e, t)
                        }, createAssistantToTheTransportManager: function (e, t, n) {
                            return new Oe(e, t, n)
                        }
                    }, et = function () {
                        function e(e) {
                            this.options = e || {}, this.livesLeft = this.options.lives || 1 / 0
                        }

                        return e.prototype.getAssistant = function (e) {
                            return Qe.createAssistantToTheTransportManager(this, e, {
                                minPingDelay: this.options.minPingDelay,
                                maxPingDelay: this.options.maxPingDelay
                            })
                        }, e.prototype.isAlive = function () {
                            return this.livesLeft > 0
                        }, e.prototype.reportDeath = function () {
                            this.livesLeft -= 1
                        }, e
                    }(), tt = function () {
                        function e(e, t) {
                            this.strategies = e, this.loop = Boolean(t.loop), this.failFast = Boolean(t.failFast), this.timeout = t.timeout, this.timeoutLimit = t.timeoutLimit
                        }

                        return e.prototype.isSupported = function () {
                            return K(this.strategies, B.method("isSupported"))
                        }, e.prototype.connect = function (e, t) {
                            var n = this, r = this.strategies, i = 0, o = this.timeout, a = null, s = function (l, c) {
                                c ? t(null, c) : (i += 1, n.loop && (i %= r.length), i < r.length ? (o && (o *= 2, n.timeoutLimit && (o = Math.min(o, n.timeoutLimit))), a = n.tryStrategy(r[i], e, {
                                    timeout: o,
                                    failFast: n.failFast
                                }, s)) : t(!0))
                            };
                            return a = this.tryStrategy(r[i], e, {
                                timeout: o,
                                failFast: this.failFast
                            }, s), {
                                abort: function () {
                                    a.abort()
                                }, forceMinPriority: function (t) {
                                    e = t, a && a.forceMinPriority(t)
                                }
                            }
                        }, e.prototype.tryStrategy = function (e, t, n, r) {
                            var i = null, o = null;
                            return n.timeout > 0 && (i = new I(n.timeout, (function () {
                                o.abort(), r(!0)
                            }))), o = e.connect(t, (function (e, t) {
                                e && i && i.isRunning() && !n.failFast || (i && i.ensureAborted(), r(e, t))
                            })), {
                                abort: function () {
                                    i && i.ensureAborted(), o.abort()
                                }, forceMinPriority: function (e) {
                                    o.forceMinPriority(e)
                                }
                            }
                        }, e
                    }(), nt = function () {
                        function e(e) {
                            this.strategies = e
                        }

                        return e.prototype.isSupported = function () {
                            return K(this.strategies, B.method("isSupported"))
                        }, e.prototype.connect = function (e, t) {
                            return function (e, t, n) {
                                var r = V(e, (function (e, r, i, o) {
                                    return e.connect(t, n(r, o))
                                }));
                                return {
                                    abort: function () {
                                        U(r, rt)
                                    }, forceMinPriority: function (e) {
                                        U(r, (function (t) {
                                            t.forceMinPriority(e)
                                        }))
                                    }
                                }
                            }(this.strategies, e, (function (e, n) {
                                return function (r, i) {
                                    n[e].error = r, r ? function (e) {
                                        return function (e, t) {
                                            for (var n = 0; n < e.length; n++) if (!t(e[n], n, e)) return !1;
                                            return !0
                                        }(e, (function (e) {
                                            return Boolean(e.error)
                                        }))
                                    }(n) && t(!0) : (U(n, (function (e) {
                                        e.forceMinPriority(i.transport.priority)
                                    })), t(null, i))
                                }
                            }))
                        }, e
                    }();

                    function rt(e) {
                        e.error || e.aborted || (e.abort(), e.aborted = !0)
                    }

                    var it = function () {
                        function e(e, t, n) {
                            this.strategy = e, this.transports = t, this.ttl = n.ttl || 18e5, this.usingTLS = n.useTLS, this.timeline = n.timeline
                        }

                        return e.prototype.isSupported = function () {
                            return this.strategy.isSupported()
                        }, e.prototype.connect = function (e, t) {
                            var n = this.usingTLS, r = function (e) {
                                var t = Tt.getLocalStorage();
                                if (t) try {
                                    var n = t[at(e)];
                                    if (n) return JSON.parse(n)
                                } catch (t) {
                                    st(e)
                                }
                                return null
                            }(n), i = [this.strategy];
                            if (r && r.timestamp + this.ttl >= B.now()) {
                                var o = this.transports[r.transport];
                                o && (this.timeline.info({
                                    cached: !0,
                                    transport: r.transport,
                                    latency: r.latency
                                }), i.push(new tt([o], {timeout: 2 * r.latency + 1e3, failFast: !0})))
                            }
                            var a = B.now(), s = i.pop().connect(e, (function r(o, l) {
                                o ? (st(n), i.length > 0 ? (a = B.now(), s = i.pop().connect(e, r)) : t(o)) : (function (e, t, n) {
                                    var r = Tt.getLocalStorage();
                                    if (r) try {
                                        r[at(e)] = Y({timestamp: B.now(), transport: t, latency: n})
                                    } catch (e) {
                                    }
                                }(n, l.transport.name, B.now() - a), t(null, l))
                            }));
                            return {
                                abort: function () {
                                    s.abort()
                                }, forceMinPriority: function (t) {
                                    e = t, s && s.forceMinPriority(t)
                                }
                            }
                        }, e
                    }(), ot = it;

                    function at(e) {
                        return "pusherTransport" + (e ? "TLS" : "NonTLS")
                    }

                    function st(e) {
                        var t = Tt.getLocalStorage();
                        if (t) try {
                            delete t[at(e)]
                        } catch (e) {
                        }
                    }

                    var lt = function () {
                        function e(e, t) {
                            var n = t.delay;
                            this.strategy = e, this.options = {delay: n}
                        }

                        return e.prototype.isSupported = function () {
                            return this.strategy.isSupported()
                        }, e.prototype.connect = function (e, t) {
                            var n, r = this.strategy, i = new I(this.options.delay, (function () {
                                n = r.connect(e, t)
                            }));
                            return {
                                abort: function () {
                                    i.ensureAborted(), n && n.abort()
                                }, forceMinPriority: function (t) {
                                    e = t, n && n.forceMinPriority(t)
                                }
                            }
                        }, e
                    }(), ct = function () {
                        function e(e, t, n) {
                            this.test = e, this.trueBranch = t, this.falseBranch = n
                        }

                        return e.prototype.isSupported = function () {
                            return (this.test() ? this.trueBranch : this.falseBranch).isSupported()
                        }, e.prototype.connect = function (e, t) {
                            return (this.test() ? this.trueBranch : this.falseBranch).connect(e, t)
                        }, e
                    }(), ut = function () {
                        function e(e) {
                            this.strategy = e
                        }

                        return e.prototype.isSupported = function () {
                            return this.strategy.isSupported()
                        }, e.prototype.connect = function (e, t) {
                            var n = this.strategy.connect(e, (function (e, r) {
                                r && n.abort(), t(e, r)
                            }));
                            return n
                        }, e
                    }();

                    function dt(e) {
                        return function () {
                            return e.isSupported()
                        }
                    }

                    var pt, ht = function (e, t, n) {
                        var r = {};

                        function i(t, i, o, a, s) {
                            var l = n(e, t, i, o, a, s);
                            return r[t] = l, l
                        }

                        var o, a = Object.assign({}, t, {
                                hostNonTLS: e.wsHost + ":" + e.wsPort,
                                hostTLS: e.wsHost + ":" + e.wssPort,
                                httpPath: e.wsPath
                            }), s = Object.assign({}, a, {useTLS: !0}), l = Object.assign({}, t, {
                                hostNonTLS: e.httpHost + ":" + e.httpPort,
                                hostTLS: e.httpHost + ":" + e.httpsPort,
                                httpPath: e.httpPath
                            }), c = {loop: !0, timeout: 15e3, timeoutLimit: 6e4},
                            u = new et({lives: 2, minPingDelay: 1e4, maxPingDelay: e.activityTimeout}),
                            d = new et({lives: 2, minPingDelay: 1e4, maxPingDelay: e.activityTimeout}),
                            p = i("ws", "ws", 3, a, u), h = i("wss", "ws", 3, s, u), f = i("sockjs", "sockjs", 1, l),
                            g = i("xhr_streaming", "xhr_streaming", 1, l, d),
                            m = i("xdr_streaming", "xdr_streaming", 1, l, d), v = i("xhr_polling", "xhr_polling", 1, l),
                            b = i("xdr_polling", "xdr_polling", 1, l), w = new tt([p], c), y = new tt([h], c),
                            _ = new tt([f], c), k = new tt([new ct(dt(g), g, m)], c),
                            x = new tt([new ct(dt(v), v, b)], c),
                            S = new tt([new ct(dt(k), new nt([k, new lt(x, {delay: 4e3})]), x)], c),
                            C = new ct(dt(S), S, _);
                        return o = t.useTLS ? new nt([w, new lt(C, {delay: 2e3})]) : new nt([w, new lt(y, {delay: 2e3}), new lt(C, {delay: 5e3})]), new ot(new ut(new ct(dt(p), o, C)), r, {
                            ttl: 18e5,
                            timeline: t.timeline,
                            useTLS: t.useTLS
                        })
                    }, ft = {
                        getRequest: function (e) {
                            var t = new window.XDomainRequest;
                            return t.ontimeout = function () {
                                e.emit("error", new f), e.close()
                            }, t.onerror = function (t) {
                                e.emit("error", t), e.close()
                            }, t.onprogress = function () {
                                t.responseText && t.responseText.length > 0 && e.onChunk(200, t.responseText)
                            }, t.onload = function () {
                                t.responseText && t.responseText.length > 0 && e.onChunk(200, t.responseText), e.emit("finished", 200), e.close()
                            }, t
                        }, abortRequest: function (e) {
                            e.ontimeout = e.onerror = e.onprogress = e.onload = null, e.abort()
                        }
                    }, gt = function () {
                        var e = function (t, n) {
                            return e = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (e, t) {
                                e.__proto__ = t
                            } || function (e, t) {
                                for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                            }, e(t, n)
                        };
                        return function (t, n) {
                            function r() {
                                this.constructor = t
                            }

                            e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, new r)
                        }
                    }(), mt = function (e) {
                        function t(t, n, r) {
                            var i = e.call(this) || this;
                            return i.hooks = t, i.method = n, i.url = r, i
                        }

                        return gt(t, e), t.prototype.start = function (e) {
                            var t = this;
                            this.position = 0, this.xhr = this.hooks.getRequest(this), this.unloader = function () {
                                t.close()
                            }, Tt.addUnloadListener(this.unloader), this.xhr.open(this.method, this.url, !0), this.xhr.setRequestHeader && this.xhr.setRequestHeader("Content-Type", "application/json"), this.xhr.send(e)
                        }, t.prototype.close = function () {
                            this.unloader && (Tt.removeUnloadListener(this.unloader), this.unloader = null), this.xhr && (this.hooks.abortRequest(this.xhr), this.xhr = null)
                        }, t.prototype.onChunk = function (e, t) {
                            for (; ;) {
                                var n = this.advanceBuffer(t);
                                if (!n) break;
                                this.emit("chunk", {status: e, data: n})
                            }
                            this.isBufferTooLong(t) && this.emit("buffer_too_long")
                        }, t.prototype.advanceBuffer = function (e) {
                            var t = e.slice(this.position), n = t.indexOf("\n");
                            return -1 !== n ? (this.position += n + 1, t.slice(0, n)) : null
                        }, t.prototype.isBufferTooLong = function (e) {
                            return this.position === e.length && e.length > 262144
                        }, t
                    }(de);
                    !function (e) {
                        e[e.CONNECTING = 0] = "CONNECTING", e[e.OPEN = 1] = "OPEN", e[e.CLOSED = 3] = "CLOSED"
                    }(pt || (pt = {}));
                    var vt = pt, bt = 1;

                    function wt(e) {
                        var t = -1 === e.indexOf("?") ? "?" : "&";
                        return e + t + "t=" + +new Date + "&n=" + bt++
                    }

                    function yt(e) {
                        return Math.floor(Math.random() * e)
                    }

                    var _t, kt = function () {
                        function e(e, t) {
                            this.hooks = e, this.session = yt(1e3) + "/" + function (e) {
                                for (var t = [], n = 0; n < e; n++) t.push(yt(32).toString(32));
                                return t.join("")
                            }(8), this.location = function (e) {
                                var t = /([^\?]*)\/*(\??.*)/.exec(e);
                                return {base: t[1], queryString: t[2]}
                            }(t), this.readyState = vt.CONNECTING, this.openStream()
                        }

                        return e.prototype.send = function (e) {
                            return this.sendRaw(JSON.stringify([e]))
                        }, e.prototype.ping = function () {
                            this.hooks.sendHeartbeat(this)
                        }, e.prototype.close = function (e, t) {
                            this.onClose(e, t, !0)
                        }, e.prototype.sendRaw = function (e) {
                            if (this.readyState !== vt.OPEN) return !1;
                            try {
                                return Tt.createSocketRequest("POST", wt((t = this.location, n = this.session, t.base + "/" + n + "/xhr_send"))).start(e), !0
                            } catch (e) {
                                return !1
                            }
                            var t, n
                        }, e.prototype.reconnect = function () {
                            this.closeStream(), this.openStream()
                        }, e.prototype.onClose = function (e, t, n) {
                            this.closeStream(), this.readyState = vt.CLOSED, this.onclose && this.onclose({
                                code: e,
                                reason: t,
                                wasClean: n
                            })
                        }, e.prototype.onChunk = function (e) {
                            var t;
                            if (200 === e.status) switch (this.readyState === vt.OPEN && this.onActivity(), e.data.slice(0, 1)) {
                                case"o":
                                    t = JSON.parse(e.data.slice(1) || "{}"), this.onOpen(t);
                                    break;
                                case"a":
                                    t = JSON.parse(e.data.slice(1) || "[]");
                                    for (var n = 0; n < t.length; n++) this.onEvent(t[n]);
                                    break;
                                case"m":
                                    t = JSON.parse(e.data.slice(1) || "null"), this.onEvent(t);
                                    break;
                                case"h":
                                    this.hooks.onHeartbeat(this);
                                    break;
                                case"c":
                                    t = JSON.parse(e.data.slice(1) || "[]"), this.onClose(t[0], t[1], !0)
                            }
                        }, e.prototype.onOpen = function (e) {
                            var t, n, r;
                            this.readyState === vt.CONNECTING ? (e && e.hostname && (this.location.base = (t = this.location.base, n = e.hostname, (r = /(https?:\/\/)([^\/:]+)((\/|:)?.*)/.exec(t))[1] + n + r[3])), this.readyState = vt.OPEN, this.onopen && this.onopen()) : this.onClose(1006, "Server lost session", !0)
                        }, e.prototype.onEvent = function (e) {
                            this.readyState === vt.OPEN && this.onmessage && this.onmessage({data: e})
                        }, e.prototype.onActivity = function () {
                            this.onactivity && this.onactivity()
                        }, e.prototype.onError = function (e) {
                            this.onerror && this.onerror(e)
                        }, e.prototype.openStream = function () {
                            var e = this;
                            this.stream = Tt.createSocketRequest("POST", wt(this.hooks.getReceiveURL(this.location, this.session))), this.stream.bind("chunk", (function (t) {
                                e.onChunk(t)
                            })), this.stream.bind("finished", (function (t) {
                                e.hooks.onFinished(e, t)
                            })), this.stream.bind("buffer_too_long", (function () {
                                e.reconnect()
                            }));
                            try {
                                this.stream.start()
                            } catch (t) {
                                B.defer((function () {
                                    e.onError(t), e.onClose(1006, "Could not start streaming", !1)
                                }))
                            }
                        }, e.prototype.closeStream = function () {
                            this.stream && (this.stream.unbind_all(), this.stream.close(), this.stream = null)
                        }, e
                    }(), xt = {
                        getReceiveURL: function (e, t) {
                            return e.base + "/" + t + "/xhr_streaming" + e.queryString
                        }, onHeartbeat: function (e) {
                            e.sendRaw("[]")
                        }, sendHeartbeat: function (e) {
                            e.sendRaw("[]")
                        }, onFinished: function (e, t) {
                            e.onClose(1006, "Connection interrupted (" + t + ")", !1)
                        }
                    }, St = {
                        getReceiveURL: function (e, t) {
                            return e.base + "/" + t + "/xhr" + e.queryString
                        }, onHeartbeat: function () {
                        }, sendHeartbeat: function (e) {
                            e.sendRaw("[]")
                        }, onFinished: function (e, t) {
                            200 === t ? e.reconnect() : e.onClose(1006, "Connection interrupted (" + t + ")", !1)
                        }
                    }, Ct = {
                        getRequest: function (e) {
                            var t = new (Tt.getXHRAPI());
                            return t.onreadystatechange = t.onprogress = function () {
                                switch (t.readyState) {
                                    case 3:
                                        t.responseText && t.responseText.length > 0 && e.onChunk(t.status, t.responseText);
                                        break;
                                    case 4:
                                        t.responseText && t.responseText.length > 0 && e.onChunk(t.status, t.responseText), e.emit("finished", t.status), e.close()
                                }
                            }, t
                        }, abortRequest: function (e) {
                            e.onreadystatechange = null, e.abort()
                        }
                    }, Et = {
                        createStreamingSocket: function (e) {
                            return this.createSocket(xt, e)
                        }, createPollingSocket: function (e) {
                            return this.createSocket(St, e)
                        }, createSocket: function (e, t) {
                            return new kt(e, t)
                        }, createXHR: function (e, t) {
                            return this.createRequest(Ct, e, t)
                        }, createRequest: function (e, t, n) {
                            return new mt(e, t, n)
                        }, createXDR: function (e, t) {
                            return this.createRequest(ft, e, t)
                        }
                    }, Tt = {
                        nextAuthCallbackID: 1,
                        auth_callbacks: {},
                        ScriptReceivers: o,
                        DependenciesReceivers: l,
                        getDefaultStrategy: ht,
                        Transports: Ee,
                        transportConnectionInitializer: function () {
                            var e = this;
                            e.timeline.info(e.buildTimelineMessage({transport: e.name + (e.options.useTLS ? "s" : "")})), e.hooks.isInitialized() ? e.changeState("initialized") : e.hooks.file ? (e.changeState("initializing"), c.load(e.hooks.file, {useTLS: e.options.useTLS}, (function (t, n) {
                                e.hooks.isInitialized() ? (e.changeState("initialized"), n(!0)) : (t && e.onError(t), e.onClose(), n(!1))
                            }))) : e.onClose()
                        },
                        HTTPFactory: Et,
                        TimelineTransport: re,
                        getXHRAPI: function () {
                            return window.XMLHttpRequest
                        },
                        getWebSocketAPI: function () {
                            return window.WebSocket || window.MozWebSocket
                        },
                        setup: function (e) {
                            var t = this;
                            window.Pusher = e;
                            var n = function () {
                                t.onDocumentBody(e.ready)
                            };
                            window.JSON ? n() : c.load("json2", {}, n)
                        },
                        getDocument: function () {
                            return document
                        },
                        getProtocol: function () {
                            return this.getDocument().location.protocol
                        },
                        getAuthorizers: function () {
                            return {ajax: _, jsonp: ee}
                        },
                        onDocumentBody: function (e) {
                            var t = this;
                            document.body ? e() : setTimeout((function () {
                                t.onDocumentBody(e)
                            }), 0)
                        },
                        createJSONPRequest: function (e, t) {
                            return new ne(e, t)
                        },
                        createScriptRequest: function (e) {
                            return new te(e)
                        },
                        getLocalStorage: function () {
                            try {
                                return window.localStorage
                            } catch (e) {
                                return
                            }
                        },
                        createXHR: function () {
                            return this.getXHRAPI() ? this.createXMLHttpRequest() : this.createMicrosoftXHR()
                        },
                        createXMLHttpRequest: function () {
                            return new (this.getXHRAPI())
                        },
                        createMicrosoftXHR: function () {
                            return new ActiveXObject("Microsoft.XMLHTTP")
                        },
                        getNetwork: function () {
                            return Ae
                        },
                        createWebSocket: function (e) {
                            return new (this.getWebSocketAPI())(e)
                        },
                        createSocketRequest: function (e, t) {
                            if (this.isXHRSupported()) return this.HTTPFactory.createXHR(e, t);
                            if (this.isXDRSupported(0 === t.indexOf("https:"))) return this.HTTPFactory.createXDR(e, t);
                            throw"Cross-origin HTTP requests are not supported"
                        },
                        isXHRSupported: function () {
                            var e = this.getXHRAPI();
                            return Boolean(e) && void 0 !== (new e).withCredentials
                        },
                        isXDRSupported: function (e) {
                            var t = e ? "https:" : "http:", n = this.getProtocol();
                            return Boolean(window.XDomainRequest) && n === t
                        },
                        addUnloadListener: function (e) {
                            void 0 !== window.addEventListener ? window.addEventListener("unload", e, !1) : void 0 !== window.attachEvent && window.attachEvent("onunload", e)
                        },
                        removeUnloadListener: function (e) {
                            void 0 !== window.addEventListener ? window.removeEventListener("unload", e, !1) : void 0 !== window.detachEvent && window.detachEvent("onunload", e)
                        }
                    };
                    !function (e) {
                        e[e.ERROR = 3] = "ERROR", e[e.INFO = 6] = "INFO", e[e.DEBUG = 7] = "DEBUG"
                    }(_t || (_t = {}));
                    var At = _t, Ot = function () {
                        function e(e, t, n) {
                            this.key = e, this.session = t, this.events = [], this.options = n || {}, this.sent = 0, this.uniqueID = 0
                        }

                        return e.prototype.log = function (e, t) {
                            e <= this.options.level && (this.events.push(D({}, t, {timestamp: B.now()})), this.options.limit && this.events.length > this.options.limit && this.events.shift())
                        }, e.prototype.error = function (e) {
                            this.log(At.ERROR, e)
                        }, e.prototype.info = function (e) {
                            this.log(At.INFO, e)
                        }, e.prototype.debug = function (e) {
                            this.log(At.DEBUG, e)
                        }, e.prototype.isEmpty = function () {
                            return 0 === this.events.length
                        }, e.prototype.send = function (e, t) {
                            var n = this, r = D({
                                session: this.session,
                                bundle: this.sent + 1,
                                key: this.key,
                                lib: "js",
                                version: this.options.version,
                                cluster: this.options.cluster,
                                features: this.options.features,
                                timeline: this.events
                            }, this.options.params);
                            return this.events = [], e(r, (function (e, r) {
                                e || n.sent++, t && t(e, r)
                            })), !0
                        }, e.prototype.generateUniqueID = function () {
                            return this.uniqueID++, this.uniqueID
                        }, e
                    }(), Pt = function () {
                        function e(e, t, n, r) {
                            this.name = e, this.priority = t, this.transport = n, this.options = r || {}
                        }

                        return e.prototype.isSupported = function () {
                            return this.transport.isSupported({useTLS: this.options.useTLS})
                        }, e.prototype.connect = function (e, t) {
                            var n = this;
                            if (!this.isSupported()) return Mt(new w, t);
                            if (this.priority < e) return Mt(new g, t);
                            var r = !1,
                                i = this.transport.createConnection(this.name, this.priority, this.options.key, this.options),
                                o = null, a = function () {
                                    i.unbind("initialized", a), i.connect()
                                }, s = function () {
                                    o = Qe.createHandshake(i, (function (e) {
                                        r = !0, u(), t(null, e)
                                    }))
                                }, l = function (e) {
                                    u(), t(e)
                                }, c = function () {
                                    var e;
                                    u(), e = Y(i), t(new m(e))
                                }, u = function () {
                                    i.unbind("initialized", a), i.unbind("open", s), i.unbind("error", l), i.unbind("closed", c)
                                };
                            return i.bind("initialized", a), i.bind("open", s), i.bind("error", l), i.bind("closed", c), i.initialize(), {
                                abort: function () {
                                    r || (u(), o ? o.close() : i.close())
                                }, forceMinPriority: function (e) {
                                    r || n.priority < e && (o ? o.close() : i.close())
                                }
                            }
                        }, e
                    }();

                    function Mt(e, t) {
                        return B.defer((function () {
                            t(e)
                        })), {
                            abort: function () {
                            }, forceMinPriority: function () {
                            }
                        }
                    }

                    var Lt = Tt.Transports, jt = function (e, t, n, r, i, o) {
                        var a, s = Lt[n];
                        if (!s) throw new b(n);
                        return e.enabledTransports && -1 === $(e.enabledTransports, t) || e.disabledTransports && -1 !== $(e.disabledTransports, t) ? a = Nt : (i = Object.assign({ignoreNullOrigin: e.ignoreNullOrigin}, i), a = new Pt(t, r, o ? o.getAssistant(s) : s, i)), a
                    }, Nt = {
                        isSupported: function () {
                            return !1
                        }, connect: function (e, t) {
                            var n = B.defer((function () {
                                t(new w)
                            }));
                            return {
                                abort: function () {
                                    n.ensureAborted()
                                }, forceMinPriority: function () {
                                }
                            }
                        }
                    };

                    function It(e) {
                        return e.httpHost ? e.httpHost : e.cluster ? "sockjs-" + e.cluster + ".pusher.com" : a.httpHost
                    }

                    function zt(e) {
                        return e.wsHost ? e.wsHost : e.cluster ? Rt(e.cluster) : Rt(a.cluster)
                    }

                    function Rt(e) {
                        return "ws-" + e + ".pusher.com"
                    }

                    function Bt(e) {
                        return "https:" === Tt.getProtocol() || !1 !== e.forceTLS
                    }

                    function Dt(e) {
                        return "enableStats" in e ? e.enableStats : "disableStats" in e && !e.disableStats
                    }

                    var Ht = function () {
                        function e(t, n) {
                            var r, i, o = this;
                            if (function (e) {
                                if (null == e) throw"You must pass your app key when you instantiate Pusher."
                            }(t), !(n = n || {}).cluster && !n.wsHost && !n.httpHost) {
                                var s = d("javascriptQuickStart");
                                Q.warn("You should always specify a cluster when connecting. " + s)
                            }
                            "disableStats" in n && Q.warn("The disableStats option is deprecated in favor of enableStats"), this.key = t, this.config = (i = {
                                activityTimeout: (r = n).activityTimeout || a.activityTimeout,
                                authEndpoint: r.authEndpoint || a.authEndpoint,
                                authTransport: r.authTransport || a.authTransport,
                                cluster: r.cluster || a.cluster,
                                httpPath: r.httpPath || a.httpPath,
                                httpPort: r.httpPort || a.httpPort,
                                httpsPort: r.httpsPort || a.httpsPort,
                                pongTimeout: r.pongTimeout || a.pongTimeout,
                                statsHost: r.statsHost || a.stats_host,
                                unavailableTimeout: r.unavailableTimeout || a.unavailableTimeout,
                                wsPath: r.wsPath || a.wsPath,
                                wsPort: r.wsPort || a.wsPort,
                                wssPort: r.wssPort || a.wssPort,
                                enableStats: Dt(r),
                                httpHost: It(r),
                                useTLS: Bt(r),
                                wsHost: zt(r)
                            }, "auth" in r && (i.auth = r.auth), "authorizer" in r && (i.authorizer = r.authorizer), "disabledTransports" in r && (i.disabledTransports = r.disabledTransports), "enabledTransports" in r && (i.enabledTransports = r.enabledTransports), "ignoreNullOrigin" in r && (i.ignoreNullOrigin = r.ignoreNullOrigin), "timelineParams" in r && (i.timelineParams = r.timelineParams), "nacl" in r && (i.nacl = r.nacl), i), this.channels = Qe.createChannels(), this.global_emitter = new de, this.sessionID = Math.floor(1e9 * Math.random()), this.timeline = new Ot(this.key, this.sessionID, {
                                cluster: this.config.cluster,
                                features: e.getClientFeatures(),
                                params: this.config.timelineParams || {},
                                limit: 50,
                                level: At.INFO,
                                version: a.VERSION
                            }), this.config.enableStats && (this.timelineSender = Qe.createTimelineSender(this.timeline, {
                                host: this.config.statsHost,
                                path: "/timeline/v2/" + Tt.TimelineTransport.name
                            })), this.connection = Qe.createConnectionManager(this.key, {
                                getStrategy: function (e) {
                                    return Tt.getDefaultStrategy(o.config, e, jt)
                                },
                                timeline: this.timeline,
                                activityTimeout: this.config.activityTimeout,
                                pongTimeout: this.config.pongTimeout,
                                unavailableTimeout: this.config.unavailableTimeout,
                                useTLS: Boolean(this.config.useTLS)
                            }), this.connection.bind("connected", (function () {
                                o.subscribeAll(), o.timelineSender && o.timelineSender.send(o.connection.isUsingTLS())
                            })), this.connection.bind("message", (function (e) {
                                var t = 0 === e.event.indexOf("pusher_internal:");
                                if (e.channel) {
                                    var n = o.channel(e.channel);
                                    n && n.handleEvent(e)
                                }
                                t || o.global_emitter.emit(e.event, e.data)
                            })), this.connection.bind("connecting", (function () {
                                o.channels.disconnect()
                            })), this.connection.bind("disconnected", (function () {
                                o.channels.disconnect()
                            })), this.connection.bind("error", (function (e) {
                                Q.warn(e)
                            })), e.instances.push(this), this.timeline.info({instances: e.instances.length}), e.isReady && this.connect()
                        }

                        return e.ready = function () {
                            e.isReady = !0;
                            for (var t = 0, n = e.instances.length; t < n; t++) e.instances[t].connect()
                        }, e.getClientFeatures = function () {
                            return F(G({ws: Tt.Transports.ws}, (function (e) {
                                return e.isSupported({})
                            })))
                        }, e.prototype.channel = function (e) {
                            return this.channels.find(e)
                        }, e.prototype.allChannels = function () {
                            return this.channels.all()
                        }, e.prototype.connect = function () {
                            if (this.connection.connect(), this.timelineSender && !this.timelineSenderTimer) {
                                var e = this.connection.isUsingTLS(), t = this.timelineSender;
                                this.timelineSenderTimer = new z(6e4, (function () {
                                    t.send(e)
                                }))
                            }
                        }, e.prototype.disconnect = function () {
                            this.connection.disconnect(), this.timelineSenderTimer && (this.timelineSenderTimer.ensureAborted(), this.timelineSenderTimer = null)
                        }, e.prototype.bind = function (e, t, n) {
                            return this.global_emitter.bind(e, t, n), this
                        }, e.prototype.unbind = function (e, t, n) {
                            return this.global_emitter.unbind(e, t, n), this
                        }, e.prototype.bind_global = function (e) {
                            return this.global_emitter.bind_global(e), this
                        }, e.prototype.unbind_global = function (e) {
                            return this.global_emitter.unbind_global(e), this
                        }, e.prototype.unbind_all = function (e) {
                            return this.global_emitter.unbind_all(), this
                        }, e.prototype.subscribeAll = function () {
                            var e;
                            for (e in this.channels.channels) this.channels.channels.hasOwnProperty(e) && this.subscribe(e)
                        }, e.prototype.subscribe = function (e) {
                            var t = this.channels.add(e, this);
                            return t.subscriptionPending && t.subscriptionCancelled ? t.reinstateSubscription() : t.subscriptionPending || "connected" !== this.connection.state || t.subscribe(), t
                        }, e.prototype.unsubscribe = function (e) {
                            var t = this.channels.find(e);
                            t && t.subscriptionPending ? t.cancelSubscription() : (t = this.channels.remove(e)) && t.subscribed && t.unsubscribe()
                        }, e.prototype.send_event = function (e, t, n) {
                            return this.connection.send_event(e, t, n)
                        }, e.prototype.shouldUseTLS = function () {
                            return this.config.useTLS
                        }, e.instances = [], e.isReady = !1, e.logToConsole = !1, e.Runtime = Tt, e.ScriptReceivers = Tt.ScriptReceivers, e.DependenciesReceivers = Tt.DependenciesReceivers, e.auth_callbacks = Tt.auth_callbacks, e
                    }(), $t = t.default = Ht;
                    Tt.setup(Ht)
                }])
            }, e.exports = t()
        }, 708: e => {/*!showdown-htmlescape 17-07-2017*/
            !function () {
                "use strict";
                var t = [{
                    type: "lang", filter: function (e, t, n) {
                        var r = [];

                        function i(e) {
                            return e = "~C" + (r.push(e) - 1) + "C"
                        }

                        for (e = (e += "~0").replace(/(^[ \t]*>([ \t]*>)*)(?=.*?$)/gm, (function (e) {
                            return e = e.replace(/>/g, "~Q")
                        })), n.ghCodeBlocks && (e = e.replace(/(^|\n)(```(.*)\n([\s\S]*?)\n```)/g, (function (e, t, n) {
                            return t + i(n)
                        }))), e = (e = (e = (e = (e = e.replace(/((?:(?:(?: |\t|~Q)*?~Q)?\n){2}|^(?:(?: |\t|~Q)*?~Q)?)((?:(?:(?: |\t|~Q)*?~Q)?(?:[ ]{4}|\t).*\n+)+)((?:(?: |\t|~Q)*?~Q)?\n*[ ]{0,3}(?![^ \t\n])|(?=(?:(?: |\t|~Q)*?~Q)?~0))/g, (function (e, t, n, r) {
                            return t + i(n) + r
                        }))).replace(/(^|[^\\])((`+)([^\r]*?[^`])\3)(?!`)/gm, (function (e) {
                            return i(e)
                        }))).replace(/&/g, "&amp;")).replace(/</g, "&lt;")).replace(/>/g, "&gt;"); e.search(/~C(\d+)C/) >= 0;) {
                            var o = r[RegExp.$1];
                            o = o.replace(/\$/g, "$$$$"), e = e.replace(/~C\d+C/, o)
                        }
                        return e = (e = e.replace(/~Q/g, ">")).replace(/~0$/, "")
                    }
                }];
                "undefined" != typeof window && window.showdown && window.showdown.extension && window.showdown.extension("htmlescape", t), e.exports = t
            }()
        }, 3787: function (e, t, n) {
            var r;/*!showdown v 1.9.1 - 02-11-2019*/
            (function () {
                function i(e) {
                    "use strict";
                    var t = {
                        omitExtraWLInCodeBlocks: {
                            defaultValue: !1,
                            describe: "Omit the default extra whiteline added to code blocks",
                            type: "boolean"
                        },
                        noHeaderId: {defaultValue: !1, describe: "Turn on/off generated header id", type: "boolean"},
                        prefixHeaderId: {
                            defaultValue: !1,
                            describe: "Add a prefix to the generated header ids. Passing a string will prefix that string to the header id. Setting to true will add a generic 'section-' prefix",
                            type: "string"
                        },
                        rawPrefixHeaderId: {
                            defaultValue: !1,
                            describe: 'Setting this option to true will prevent showdown from modifying the prefix. This might result in malformed IDs (if, for instance, the " char is used in the prefix)',
                            type: "boolean"
                        },
                        ghCompatibleHeaderId: {
                            defaultValue: !1,
                            describe: "Generate header ids compatible with github style (spaces are replaced with dashes, a bunch of non alphanumeric chars are removed)",
                            type: "boolean"
                        },
                        rawHeaderId: {
                            defaultValue: !1,
                            describe: "Remove only spaces, ' and \" from generated header ids (including prefixes), replacing them with dashes (-). WARNING: This might result in malformed ids",
                            type: "boolean"
                        },
                        headerLevelStart: {
                            defaultValue: !1,
                            describe: "The header blocks level start",
                            type: "integer"
                        },
                        parseImgDimensions: {
                            defaultValue: !1,
                            describe: "Turn on/off image dimension parsing",
                            type: "boolean"
                        },
                        simplifiedAutoLink: {
                            defaultValue: !1,
                            describe: "Turn on/off GFM autolink style",
                            type: "boolean"
                        },
                        excludeTrailingPunctuationFromURLs: {
                            defaultValue: !1,
                            describe: "Excludes trailing punctuation from links generated with autoLinking",
                            type: "boolean"
                        },
                        literalMidWordUnderscores: {
                            defaultValue: !1,
                            describe: "Parse midword underscores as literal underscores",
                            type: "boolean"
                        },
                        literalMidWordAsterisks: {
                            defaultValue: !1,
                            describe: "Parse midword asterisks as literal asterisks",
                            type: "boolean"
                        },
                        strikethrough: {
                            defaultValue: !1,
                            describe: "Turn on/off strikethrough support",
                            type: "boolean"
                        },
                        tables: {defaultValue: !1, describe: "Turn on/off tables support", type: "boolean"},
                        tablesHeaderId: {defaultValue: !1, describe: "Add an id to table headers", type: "boolean"},
                        ghCodeBlocks: {
                            defaultValue: !0,
                            describe: "Turn on/off GFM fenced code blocks support",
                            type: "boolean"
                        },
                        tasklists: {defaultValue: !1, describe: "Turn on/off GFM tasklist support", type: "boolean"},
                        smoothLivePreview: {
                            defaultValue: !1,
                            describe: "Prevents weird effects in live previews due to incomplete input",
                            type: "boolean"
                        },
                        smartIndentationFix: {
                            defaultValue: !1,
                            description: "Tries to smartly fix indentation in es6 strings",
                            type: "boolean"
                        },
                        disableForced4SpacesIndentedSublists: {
                            defaultValue: !1,
                            description: "Disables the requirement of indenting nested sublists by 4 spaces",
                            type: "boolean"
                        },
                        simpleLineBreaks: {
                            defaultValue: !1,
                            description: "Parses simple line breaks as <br> (GFM Style)",
                            type: "boolean"
                        },
                        requireSpaceBeforeHeadingText: {
                            defaultValue: !1,
                            description: "Makes adding a space between `#` and the header text mandatory (GFM Style)",
                            type: "boolean"
                        },
                        ghMentions: {defaultValue: !1, description: "Enables github @mentions", type: "boolean"},
                        ghMentionsLink: {
                            defaultValue: "https://github.com/{u}",
                            description: "Changes the link generated by @mentions. Only applies if ghMentions option is enabled.",
                            type: "string"
                        },
                        encodeEmails: {
                            defaultValue: !0,
                            description: "Encode e-mail addresses through the use of Character Entities, transforming ASCII e-mail addresses into its equivalent decimal entities",
                            type: "boolean"
                        },
                        openLinksInNewWindow: {
                            defaultValue: !1,
                            description: "Open all links in new windows",
                            type: "boolean"
                        },
                        backslashEscapesHTMLTags: {
                            defaultValue: !1,
                            description: "Support for HTML Tag escaping. ex: <div>foo</div>",
                            type: "boolean"
                        },
                        emoji: {
                            defaultValue: !1,
                            description: "Enable emoji support. Ex: `this is a :smile: emoji`",
                            type: "boolean"
                        },
                        underline: {
                            defaultValue: !1,
                            description: "Enable support for underline. Syntax is double or triple underscores: `__underline word__`. With this option enabled, underscores no longer parses into `<em>` and `<strong>`",
                            type: "boolean"
                        },
                        completeHTMLDocument: {
                            defaultValue: !1,
                            description: "Outputs a complete html document, including `<html>`, `<head>` and `<body>` tags",
                            type: "boolean"
                        },
                        metadata: {
                            defaultValue: !1,
                            description: "Enable support for document metadata (defined at the top of the document between `«««` and `»»»` or between `---` and `---`).",
                            type: "boolean"
                        },
                        splitAdjacentBlockquotes: {
                            defaultValue: !1,
                            description: "Split adjacent blockquote blocks",
                            type: "boolean"
                        }
                    };
                    if (!1 === e) return JSON.parse(JSON.stringify(t));
                    var n = {};
                    for (var r in t) t.hasOwnProperty(r) && (n[r] = t[r].defaultValue);
                    return n
                }

                var o = {}, a = {}, s = {}, l = i(!0), c = "vanilla", u = {
                    github: {
                        omitExtraWLInCodeBlocks: !0,
                        simplifiedAutoLink: !0,
                        excludeTrailingPunctuationFromURLs: !0,
                        literalMidWordUnderscores: !0,
                        strikethrough: !0,
                        tables: !0,
                        tablesHeaderId: !0,
                        ghCodeBlocks: !0,
                        tasklists: !0,
                        disableForced4SpacesIndentedSublists: !0,
                        simpleLineBreaks: !0,
                        requireSpaceBeforeHeadingText: !0,
                        ghCompatibleHeaderId: !0,
                        ghMentions: !0,
                        backslashEscapesHTMLTags: !0,
                        emoji: !0,
                        splitAdjacentBlockquotes: !0
                    },
                    original: {noHeaderId: !0, ghCodeBlocks: !1},
                    ghost: {
                        omitExtraWLInCodeBlocks: !0,
                        parseImgDimensions: !0,
                        simplifiedAutoLink: !0,
                        excludeTrailingPunctuationFromURLs: !0,
                        literalMidWordUnderscores: !0,
                        strikethrough: !0,
                        tables: !0,
                        tablesHeaderId: !0,
                        ghCodeBlocks: !0,
                        tasklists: !0,
                        smoothLivePreview: !0,
                        simpleLineBreaks: !0,
                        requireSpaceBeforeHeadingText: !0,
                        ghMentions: !1,
                        encodeEmails: !0
                    },
                    vanilla: i(!0),
                    allOn: function () {
                        "use strict";
                        var e = i(!0), t = {};
                        for (var n in e) e.hasOwnProperty(n) && (t[n] = !0);
                        return t
                    }()
                };

                function d(e, t) {
                    "use strict";
                    var n = t ? "Error in " + t + " extension->" : "Error in unnamed extension",
                        r = {valid: !0, error: ""};
                    o.helper.isArray(e) || (e = [e]);
                    for (var i = 0; i < e.length; ++i) {
                        var a = n + " sub-extension " + i + ": ", s = e[i];
                        if ("object" != typeof s) return r.valid = !1, r.error = a + "must be an object, but " + typeof s + " given", r;
                        if (!o.helper.isString(s.type)) return r.valid = !1, r.error = a + 'property "type" must be a string, but ' + typeof s.type + " given", r;
                        var l = s.type = s.type.toLowerCase();
                        if ("language" === l && (l = s.type = "lang"), "html" === l && (l = s.type = "output"), "lang" !== l && "output" !== l && "listener" !== l) return r.valid = !1, r.error = a + "type " + l + ' is not recognized. Valid values: "lang/language", "output/html" or "listener"', r;
                        if ("listener" === l) {
                            if (o.helper.isUndefined(s.listeners)) return r.valid = !1, r.error = a + '. Extensions of type "listener" must have a property called "listeners"', r
                        } else if (o.helper.isUndefined(s.filter) && o.helper.isUndefined(s.regex)) return r.valid = !1, r.error = a + l + ' extensions must define either a "regex" property or a "filter" method', r;
                        if (s.listeners) {
                            if ("object" != typeof s.listeners) return r.valid = !1, r.error = a + '"listeners" property must be an object but ' + typeof s.listeners + " given", r;
                            for (var c in s.listeners) if (s.listeners.hasOwnProperty(c) && "function" != typeof s.listeners[c]) return r.valid = !1, r.error = a + '"listeners" property must be an hash of [event name]: [callback]. listeners.' + c + " must be a function but " + typeof s.listeners[c] + " given", r
                        }
                        if (s.filter) {
                            if ("function" != typeof s.filter) return r.valid = !1, r.error = a + '"filter" must be a function, but ' + typeof s.filter + " given", r
                        } else if (s.regex) {
                            if (o.helper.isString(s.regex) && (s.regex = new RegExp(s.regex, "g")), !(s.regex instanceof RegExp)) return r.valid = !1, r.error = a + '"regex" property must either be a string or a RegExp object, but ' + typeof s.regex + " given", r;
                            if (o.helper.isUndefined(s.replace)) return r.valid = !1, r.error = a + '"regex" extensions must implement a replace string or function', r
                        }
                    }
                    return r
                }

                function p(e, t) {
                    "use strict";
                    return "¨E" + t.charCodeAt(0) + "E"
                }

                o.helper = {}, o.extensions = {}, o.setOption = function (e, t) {
                    "use strict";
                    return l[e] = t, this
                }, o.getOption = function (e) {
                    "use strict";
                    return l[e]
                }, o.getOptions = function () {
                    "use strict";
                    return l
                }, o.resetOptions = function () {
                    "use strict";
                    l = i(!0)
                }, o.setFlavor = function (e) {
                    "use strict";
                    if (!u.hasOwnProperty(e)) throw Error(e + " flavor was not found");
                    o.resetOptions();
                    var t = u[e];
                    for (var n in c = e, t) t.hasOwnProperty(n) && (l[n] = t[n])
                }, o.getFlavor = function () {
                    "use strict";
                    return c
                }, o.getFlavorOptions = function (e) {
                    "use strict";
                    if (u.hasOwnProperty(e)) return u[e]
                }, o.getDefaultOptions = function (e) {
                    "use strict";
                    return i(e)
                }, o.subParser = function (e, t) {
                    "use strict";
                    if (o.helper.isString(e)) {
                        if (void 0 === t) {
                            if (a.hasOwnProperty(e)) return a[e];
                            throw Error("SubParser named " + e + " not registered!")
                        }
                        a[e] = t
                    }
                }, o.extension = function (e, t) {
                    "use strict";
                    if (!o.helper.isString(e)) throw Error("Extension 'name' must be a string");
                    if (e = o.helper.stdExtName(e), o.helper.isUndefined(t)) {
                        if (!s.hasOwnProperty(e)) throw Error("Extension named " + e + " is not registered!");
                        return s[e]
                    }
                    "function" == typeof t && (t = t()), o.helper.isArray(t) || (t = [t]);
                    var n = d(t, e);
                    if (!n.valid) throw Error(n.error);
                    s[e] = t
                }, o.getAllExtensions = function () {
                    "use strict";
                    return s
                }, o.removeExtension = function (e) {
                    "use strict";
                    delete s[e]
                }, o.resetExtensions = function () {
                    "use strict";
                    s = {}
                }, o.validateExtension = function (e) {
                    "use strict";
                    var t = d(e, null);
                    return !!t.valid || (console.warn(t.error), !1)
                }, o.hasOwnProperty("helper") || (o.helper = {}), o.helper.isString = function (e) {
                    "use strict";
                    return "string" == typeof e || e instanceof String
                }, o.helper.isFunction = function (e) {
                    "use strict";
                    return e && "[object Function]" === {}.toString.call(e)
                }, o.helper.isArray = function (e) {
                    "use strict";
                    return Array.isArray(e)
                }, o.helper.isUndefined = function (e) {
                    "use strict";
                    return void 0 === e
                }, o.helper.forEach = function (e, t) {
                    "use strict";
                    if (o.helper.isUndefined(e)) throw new Error("obj param is required");
                    if (o.helper.isUndefined(t)) throw new Error("callback param is required");
                    if (!o.helper.isFunction(t)) throw new Error("callback param must be a function/closure");
                    if ("function" == typeof e.forEach) e.forEach(t); else if (o.helper.isArray(e)) for (var n = 0; n < e.length; n++) t(e[n], n, e); else {
                        if ("object" != typeof e) throw new Error("obj does not seem to be an array or an iterable object");
                        for (var r in e) e.hasOwnProperty(r) && t(e[r], r, e)
                    }
                }, o.helper.stdExtName = function (e) {
                    "use strict";
                    return e.replace(/[_?*+\/\\.^-]/g, "").replace(/\s/g, "").toLowerCase()
                }, o.helper.escapeCharactersCallback = p, o.helper.escapeCharacters = function (e, t, n) {
                    "use strict";
                    var r = "([" + t.replace(/([\[\]\\])/g, "\\$1") + "])";
                    n && (r = "\\\\" + r);
                    var i = new RegExp(r, "g");
                    return e = e.replace(i, p)
                }, o.helper.unescapeHTMLEntities = function (e) {
                    "use strict";
                    return e.replace(/&quot;/g, '"').replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&")
                };
                var h = function (e, t, n, r) {
                    "use strict";
                    var i, o, a, s, l, c = r || "", u = c.indexOf("g") > -1,
                        d = new RegExp(t + "|" + n, "g" + c.replace(/g/g, "")), p = new RegExp(t, c.replace(/g/g, "")),
                        h = [];
                    do {
                        for (i = 0; a = d.exec(e);) if (p.test(a[0])) i++ || (s = (o = d.lastIndex) - a[0].length); else if (i && !--i) {
                            l = a.index + a[0].length;
                            var f = {
                                left: {start: s, end: o},
                                match: {start: o, end: a.index},
                                right: {start: a.index, end: l},
                                wholeMatch: {start: s, end: l}
                            };
                            if (h.push(f), !u) return h
                        }
                    } while (i && (d.lastIndex = o));
                    return h
                };
                o.helper.matchRecursiveRegExp = function (e, t, n, r) {
                    "use strict";
                    for (var i = h(e, t, n, r), o = [], a = 0; a < i.length; ++a) o.push([e.slice(i[a].wholeMatch.start, i[a].wholeMatch.end), e.slice(i[a].match.start, i[a].match.end), e.slice(i[a].left.start, i[a].left.end), e.slice(i[a].right.start, i[a].right.end)]);
                    return o
                }, o.helper.replaceRecursiveRegExp = function (e, t, n, r, i) {
                    "use strict";
                    if (!o.helper.isFunction(t)) {
                        var a = t;
                        t = function () {
                            return a
                        }
                    }
                    var s = h(e, n, r, i), l = e, c = s.length;
                    if (c > 0) {
                        var u = [];
                        0 !== s[0].wholeMatch.start && u.push(e.slice(0, s[0].wholeMatch.start));
                        for (var d = 0; d < c; ++d) u.push(t(e.slice(s[d].wholeMatch.start, s[d].wholeMatch.end), e.slice(s[d].match.start, s[d].match.end), e.slice(s[d].left.start, s[d].left.end), e.slice(s[d].right.start, s[d].right.end))), d < c - 1 && u.push(e.slice(s[d].wholeMatch.end, s[d + 1].wholeMatch.start));
                        s[c - 1].wholeMatch.end < e.length && u.push(e.slice(s[c - 1].wholeMatch.end)), l = u.join("")
                    }
                    return l
                }, o.helper.regexIndexOf = function (e, t, n) {
                    "use strict";
                    if (!o.helper.isString(e)) throw"InvalidArgumentError: first parameter of showdown.helper.regexIndexOf function must be a string";
                    if (t instanceof RegExp == !1) throw"InvalidArgumentError: second parameter of showdown.helper.regexIndexOf function must be an instance of RegExp";
                    var r = e.substring(n || 0).search(t);
                    return r >= 0 ? r + (n || 0) : r
                }, o.helper.splitAtIndex = function (e, t) {
                    "use strict";
                    if (!o.helper.isString(e)) throw"InvalidArgumentError: first parameter of showdown.helper.regexIndexOf function must be a string";
                    return [e.substring(0, t), e.substring(t)]
                }, o.helper.encodeEmailAddress = function (e) {
                    "use strict";
                    var t = [function (e) {
                        return "&#" + e.charCodeAt(0) + ";"
                    }, function (e) {
                        return "&#x" + e.charCodeAt(0).toString(16) + ";"
                    }, function (e) {
                        return e
                    }];
                    return e = e.replace(/./g, (function (e) {
                        if ("@" === e) e = t[Math.floor(2 * Math.random())](e); else {
                            var n = Math.random();
                            e = n > .9 ? t[2](e) : n > .45 ? t[1](e) : t[0](e)
                        }
                        return e
                    }))
                }, o.helper.padEnd = function (e, t, n) {
                    "use strict";
                    return t >>= 0, n = String(n || " "), e.length > t ? String(e) : ((t -= e.length) > n.length && (n += n.repeat(t / n.length)), String(e) + n.slice(0, t))
                }, "undefined" == typeof console && (console = {
                    warn: function (e) {
                        "use strict";
                        alert(e)
                    }, log: function (e) {
                        "use strict";
                        alert(e)
                    }, error: function (e) {
                        "use strict";
                        throw e
                    }
                }), o.helper.regexes = {asteriskDashAndColon: /([*_:~])/g}, o.helper.emojis = {
                    "+1": "👍",
                    "-1": "👎",
                    100: "💯",
                    1234: "🔢",
                    "1st_place_medal": "🥇",
                    "2nd_place_medal": "🥈",
                    "3rd_place_medal": "🥉",
                    "8ball": "🎱",
                    a: "🅰️",
                    ab: "🆎",
                    abc: "🔤",
                    abcd: "🔡",
                    accept: "🉑",
                    aerial_tramway: "🚡",
                    airplane: "✈️",
                    alarm_clock: "⏰",
                    alembic: "⚗️",
                    alien: "👽",
                    ambulance: "🚑",
                    amphora: "🏺",
                    anchor: "⚓️",
                    angel: "👼",
                    anger: "💢",
                    angry: "😠",
                    anguished: "😧",
                    ant: "🐜",
                    apple: "🍎",
                    aquarius: "♒️",
                    aries: "♈️",
                    arrow_backward: "◀️",
                    arrow_double_down: "⏬",
                    arrow_double_up: "⏫",
                    arrow_down: "⬇️",
                    arrow_down_small: "🔽",
                    arrow_forward: "▶️",
                    arrow_heading_down: "⤵️",
                    arrow_heading_up: "⤴️",
                    arrow_left: "⬅️",
                    arrow_lower_left: "↙️",
                    arrow_lower_right: "↘️",
                    arrow_right: "➡️",
                    arrow_right_hook: "↪️",
                    arrow_up: "⬆️",
                    arrow_up_down: "↕️",
                    arrow_up_small: "🔼",
                    arrow_upper_left: "↖️",
                    arrow_upper_right: "↗️",
                    arrows_clockwise: "🔃",
                    arrows_counterclockwise: "🔄",
                    art: "🎨",
                    articulated_lorry: "🚛",
                    artificial_satellite: "🛰",
                    astonished: "😲",
                    athletic_shoe: "👟",
                    atm: "🏧",
                    atom_symbol: "⚛️",
                    avocado: "🥑",
                    b: "🅱️",
                    baby: "👶",
                    baby_bottle: "🍼",
                    baby_chick: "🐤",
                    baby_symbol: "🚼",
                    back: "🔙",
                    bacon: "🥓",
                    badminton: "🏸",
                    baggage_claim: "🛄",
                    baguette_bread: "🥖",
                    balance_scale: "⚖️",
                    balloon: "🎈",
                    ballot_box: "🗳",
                    ballot_box_with_check: "☑️",
                    bamboo: "🎍",
                    banana: "🍌",
                    bangbang: "‼️",
                    bank: "🏦",
                    bar_chart: "📊",
                    barber: "💈",
                    baseball: "⚾️",
                    basketball: "🏀",
                    basketball_man: "⛹️",
                    basketball_woman: "⛹️&zwj;♀️",
                    bat: "🦇",
                    bath: "🛀",
                    bathtub: "🛁",
                    battery: "🔋",
                    beach_umbrella: "🏖",
                    bear: "🐻",
                    bed: "🛏",
                    bee: "🐝",
                    beer: "🍺",
                    beers: "🍻",
                    beetle: "🐞",
                    beginner: "🔰",
                    bell: "🔔",
                    bellhop_bell: "🛎",
                    bento: "🍱",
                    biking_man: "🚴",
                    bike: "🚲",
                    biking_woman: "🚴&zwj;♀️",
                    bikini: "👙",
                    biohazard: "☣️",
                    bird: "🐦",
                    birthday: "🎂",
                    black_circle: "⚫️",
                    black_flag: "🏴",
                    black_heart: "🖤",
                    black_joker: "🃏",
                    black_large_square: "⬛️",
                    black_medium_small_square: "◾️",
                    black_medium_square: "◼️",
                    black_nib: "✒️",
                    black_small_square: "▪️",
                    black_square_button: "🔲",
                    blonde_man: "👱",
                    blonde_woman: "👱&zwj;♀️",
                    blossom: "🌼",
                    blowfish: "🐡",
                    blue_book: "📘",
                    blue_car: "🚙",
                    blue_heart: "💙",
                    blush: "😊",
                    boar: "🐗",
                    boat: "⛵️",
                    bomb: "💣",
                    book: "📖",
                    bookmark: "🔖",
                    bookmark_tabs: "📑",
                    books: "📚",
                    boom: "💥",
                    boot: "👢",
                    bouquet: "💐",
                    bowing_man: "🙇",
                    bow_and_arrow: "🏹",
                    bowing_woman: "🙇&zwj;♀️",
                    bowling: "🎳",
                    boxing_glove: "🥊",
                    boy: "👦",
                    bread: "🍞",
                    bride_with_veil: "👰",
                    bridge_at_night: "🌉",
                    briefcase: "💼",
                    broken_heart: "💔",
                    bug: "🐛",
                    building_construction: "🏗",
                    bulb: "💡",
                    bullettrain_front: "🚅",
                    bullettrain_side: "🚄",
                    burrito: "🌯",
                    bus: "🚌",
                    business_suit_levitating: "🕴",
                    busstop: "🚏",
                    bust_in_silhouette: "👤",
                    busts_in_silhouette: "👥",
                    butterfly: "🦋",
                    cactus: "🌵",
                    cake: "🍰",
                    calendar: "📆",
                    call_me_hand: "🤙",
                    calling: "📲",
                    camel: "🐫",
                    camera: "📷",
                    camera_flash: "📸",
                    camping: "🏕",
                    cancer: "♋️",
                    candle: "🕯",
                    candy: "🍬",
                    canoe: "🛶",
                    capital_abcd: "🔠",
                    capricorn: "♑️",
                    car: "🚗",
                    card_file_box: "🗃",
                    card_index: "📇",
                    card_index_dividers: "🗂",
                    carousel_horse: "🎠",
                    carrot: "🥕",
                    cat: "🐱",
                    cat2: "🐈",
                    cd: "💿",
                    chains: "⛓",
                    champagne: "🍾",
                    chart: "💹",
                    chart_with_downwards_trend: "📉",
                    chart_with_upwards_trend: "📈",
                    checkered_flag: "🏁",
                    cheese: "🧀",
                    cherries: "🍒",
                    cherry_blossom: "🌸",
                    chestnut: "🌰",
                    chicken: "🐔",
                    children_crossing: "🚸",
                    chipmunk: "🐿",
                    chocolate_bar: "🍫",
                    christmas_tree: "🎄",
                    church: "⛪️",
                    cinema: "🎦",
                    circus_tent: "🎪",
                    city_sunrise: "🌇",
                    city_sunset: "🌆",
                    cityscape: "🏙",
                    cl: "🆑",
                    clamp: "🗜",
                    clap: "👏",
                    clapper: "🎬",
                    classical_building: "🏛",
                    clinking_glasses: "🥂",
                    clipboard: "📋",
                    clock1: "🕐",
                    clock10: "🕙",
                    clock1030: "🕥",
                    clock11: "🕚",
                    clock1130: "🕦",
                    clock12: "🕛",
                    clock1230: "🕧",
                    clock130: "🕜",
                    clock2: "🕑",
                    clock230: "🕝",
                    clock3: "🕒",
                    clock330: "🕞",
                    clock4: "🕓",
                    clock430: "🕟",
                    clock5: "🕔",
                    clock530: "🕠",
                    clock6: "🕕",
                    clock630: "🕡",
                    clock7: "🕖",
                    clock730: "🕢",
                    clock8: "🕗",
                    clock830: "🕣",
                    clock9: "🕘",
                    clock930: "🕤",
                    closed_book: "📕",
                    closed_lock_with_key: "🔐",
                    closed_umbrella: "🌂",
                    cloud: "☁️",
                    cloud_with_lightning: "🌩",
                    cloud_with_lightning_and_rain: "⛈",
                    cloud_with_rain: "🌧",
                    cloud_with_snow: "🌨",
                    clown_face: "🤡",
                    clubs: "♣️",
                    cocktail: "🍸",
                    coffee: "☕️",
                    coffin: "⚰️",
                    cold_sweat: "😰",
                    comet: "☄️",
                    computer: "💻",
                    computer_mouse: "🖱",
                    confetti_ball: "🎊",
                    confounded: "😖",
                    confused: "😕",
                    congratulations: "㊗️",
                    construction: "🚧",
                    construction_worker_man: "👷",
                    construction_worker_woman: "👷&zwj;♀️",
                    control_knobs: "🎛",
                    convenience_store: "🏪",
                    cookie: "🍪",
                    cool: "🆒",
                    policeman: "👮",
                    copyright: "©️",
                    corn: "🌽",
                    couch_and_lamp: "🛋",
                    couple: "👫",
                    couple_with_heart_woman_man: "💑",
                    couple_with_heart_man_man: "👨&zwj;❤️&zwj;👨",
                    couple_with_heart_woman_woman: "👩&zwj;❤️&zwj;👩",
                    couplekiss_man_man: "👨&zwj;❤️&zwj;💋&zwj;👨",
                    couplekiss_man_woman: "💏",
                    couplekiss_woman_woman: "👩&zwj;❤️&zwj;💋&zwj;👩",
                    cow: "🐮",
                    cow2: "🐄",
                    cowboy_hat_face: "🤠",
                    crab: "🦀",
                    crayon: "🖍",
                    credit_card: "💳",
                    crescent_moon: "🌙",
                    cricket: "🏏",
                    crocodile: "🐊",
                    croissant: "🥐",
                    crossed_fingers: "🤞",
                    crossed_flags: "🎌",
                    crossed_swords: "⚔️",
                    crown: "👑",
                    cry: "😢",
                    crying_cat_face: "😿",
                    crystal_ball: "🔮",
                    cucumber: "🥒",
                    cupid: "💘",
                    curly_loop: "➰",
                    currency_exchange: "💱",
                    curry: "🍛",
                    custard: "🍮",
                    customs: "🛃",
                    cyclone: "🌀",
                    dagger: "🗡",
                    dancer: "💃",
                    dancing_women: "👯",
                    dancing_men: "👯&zwj;♂️",
                    dango: "🍡",
                    dark_sunglasses: "🕶",
                    dart: "🎯",
                    dash: "💨",
                    date: "📅",
                    deciduous_tree: "🌳",
                    deer: "🦌",
                    department_store: "🏬",
                    derelict_house: "🏚",
                    desert: "🏜",
                    desert_island: "🏝",
                    desktop_computer: "🖥",
                    male_detective: "🕵️",
                    diamond_shape_with_a_dot_inside: "💠",
                    diamonds: "♦️",
                    disappointed: "😞",
                    disappointed_relieved: "😥",
                    dizzy: "💫",
                    dizzy_face: "😵",
                    do_not_litter: "🚯",
                    dog: "🐶",
                    dog2: "🐕",
                    dollar: "💵",
                    dolls: "🎎",
                    dolphin: "🐬",
                    door: "🚪",
                    doughnut: "🍩",
                    dove: "🕊",
                    dragon: "🐉",
                    dragon_face: "🐲",
                    dress: "👗",
                    dromedary_camel: "🐪",
                    drooling_face: "🤤",
                    droplet: "💧",
                    drum: "🥁",
                    duck: "🦆",
                    dvd: "📀",
                    "e-mail": "📧",
                    eagle: "🦅",
                    ear: "👂",
                    ear_of_rice: "🌾",
                    earth_africa: "🌍",
                    earth_americas: "🌎",
                    earth_asia: "🌏",
                    egg: "🥚",
                    eggplant: "🍆",
                    eight_pointed_black_star: "✴️",
                    eight_spoked_asterisk: "✳️",
                    electric_plug: "🔌",
                    elephant: "🐘",
                    email: "✉️",
                    end: "🔚",
                    envelope_with_arrow: "📩",
                    euro: "💶",
                    european_castle: "🏰",
                    european_post_office: "🏤",
                    evergreen_tree: "🌲",
                    exclamation: "❗️",
                    expressionless: "😑",
                    eye: "👁",
                    eye_speech_bubble: "👁&zwj;🗨",
                    eyeglasses: "👓",
                    eyes: "👀",
                    face_with_head_bandage: "🤕",
                    face_with_thermometer: "🤒",
                    fist_oncoming: "👊",
                    factory: "🏭",
                    fallen_leaf: "🍂",
                    family_man_woman_boy: "👪",
                    family_man_boy: "👨&zwj;👦",
                    family_man_boy_boy: "👨&zwj;👦&zwj;👦",
                    family_man_girl: "👨&zwj;👧",
                    family_man_girl_boy: "👨&zwj;👧&zwj;👦",
                    family_man_girl_girl: "👨&zwj;👧&zwj;👧",
                    family_man_man_boy: "👨&zwj;👨&zwj;👦",
                    family_man_man_boy_boy: "👨&zwj;👨&zwj;👦&zwj;👦",
                    family_man_man_girl: "👨&zwj;👨&zwj;👧",
                    family_man_man_girl_boy: "👨&zwj;👨&zwj;👧&zwj;👦",
                    family_man_man_girl_girl: "👨&zwj;👨&zwj;👧&zwj;👧",
                    family_man_woman_boy_boy: "👨&zwj;👩&zwj;👦&zwj;👦",
                    family_man_woman_girl: "👨&zwj;👩&zwj;👧",
                    family_man_woman_girl_boy: "👨&zwj;👩&zwj;👧&zwj;👦",
                    family_man_woman_girl_girl: "👨&zwj;👩&zwj;👧&zwj;👧",
                    family_woman_boy: "👩&zwj;👦",
                    family_woman_boy_boy: "👩&zwj;👦&zwj;👦",
                    family_woman_girl: "👩&zwj;👧",
                    family_woman_girl_boy: "👩&zwj;👧&zwj;👦",
                    family_woman_girl_girl: "👩&zwj;👧&zwj;👧",
                    family_woman_woman_boy: "👩&zwj;👩&zwj;👦",
                    family_woman_woman_boy_boy: "👩&zwj;👩&zwj;👦&zwj;👦",
                    family_woman_woman_girl: "👩&zwj;👩&zwj;👧",
                    family_woman_woman_girl_boy: "👩&zwj;👩&zwj;👧&zwj;👦",
                    family_woman_woman_girl_girl: "👩&zwj;👩&zwj;👧&zwj;👧",
                    fast_forward: "⏩",
                    fax: "📠",
                    fearful: "😨",
                    feet: "🐾",
                    female_detective: "🕵️&zwj;♀️",
                    ferris_wheel: "🎡",
                    ferry: "⛴",
                    field_hockey: "🏑",
                    file_cabinet: "🗄",
                    file_folder: "📁",
                    film_projector: "📽",
                    film_strip: "🎞",
                    fire: "🔥",
                    fire_engine: "🚒",
                    fireworks: "🎆",
                    first_quarter_moon: "🌓",
                    first_quarter_moon_with_face: "🌛",
                    fish: "🐟",
                    fish_cake: "🍥",
                    fishing_pole_and_fish: "🎣",
                    fist_raised: "✊",
                    fist_left: "🤛",
                    fist_right: "🤜",
                    flags: "🎏",
                    flashlight: "🔦",
                    fleur_de_lis: "⚜️",
                    flight_arrival: "🛬",
                    flight_departure: "🛫",
                    floppy_disk: "💾",
                    flower_playing_cards: "🎴",
                    flushed: "😳",
                    fog: "🌫",
                    foggy: "🌁",
                    football: "🏈",
                    footprints: "👣",
                    fork_and_knife: "🍴",
                    fountain: "⛲️",
                    fountain_pen: "🖋",
                    four_leaf_clover: "🍀",
                    fox_face: "🦊",
                    framed_picture: "🖼",
                    free: "🆓",
                    fried_egg: "🍳",
                    fried_shrimp: "🍤",
                    fries: "🍟",
                    frog: "🐸",
                    frowning: "😦",
                    frowning_face: "☹️",
                    frowning_man: "🙍&zwj;♂️",
                    frowning_woman: "🙍",
                    middle_finger: "🖕",
                    fuelpump: "⛽️",
                    full_moon: "🌕",
                    full_moon_with_face: "🌝",
                    funeral_urn: "⚱️",
                    game_die: "🎲",
                    gear: "⚙️",
                    gem: "💎",
                    gemini: "♊️",
                    ghost: "👻",
                    gift: "🎁",
                    gift_heart: "💝",
                    girl: "👧",
                    globe_with_meridians: "🌐",
                    goal_net: "🥅",
                    goat: "🐐",
                    golf: "⛳️",
                    golfing_man: "🏌️",
                    golfing_woman: "🏌️&zwj;♀️",
                    gorilla: "🦍",
                    grapes: "🍇",
                    green_apple: "🍏",
                    green_book: "📗",
                    green_heart: "💚",
                    green_salad: "🥗",
                    grey_exclamation: "❕",
                    grey_question: "❔",
                    grimacing: "😬",
                    grin: "😁",
                    grinning: "😀",
                    guardsman: "💂",
                    guardswoman: "💂&zwj;♀️",
                    guitar: "🎸",
                    gun: "🔫",
                    haircut_woman: "💇",
                    haircut_man: "💇&zwj;♂️",
                    hamburger: "🍔",
                    hammer: "🔨",
                    hammer_and_pick: "⚒",
                    hammer_and_wrench: "🛠",
                    hamster: "🐹",
                    hand: "✋",
                    handbag: "👜",
                    handshake: "🤝",
                    hankey: "💩",
                    hatched_chick: "🐥",
                    hatching_chick: "🐣",
                    headphones: "🎧",
                    hear_no_evil: "🙉",
                    heart: "❤️",
                    heart_decoration: "💟",
                    heart_eyes: "😍",
                    heart_eyes_cat: "😻",
                    heartbeat: "💓",
                    heartpulse: "💗",
                    hearts: "♥️",
                    heavy_check_mark: "✔️",
                    heavy_division_sign: "➗",
                    heavy_dollar_sign: "💲",
                    heavy_heart_exclamation: "❣️",
                    heavy_minus_sign: "➖",
                    heavy_multiplication_x: "✖️",
                    heavy_plus_sign: "➕",
                    helicopter: "🚁",
                    herb: "🌿",
                    hibiscus: "🌺",
                    high_brightness: "🔆",
                    high_heel: "👠",
                    hocho: "🔪",
                    hole: "🕳",
                    honey_pot: "🍯",
                    horse: "🐴",
                    horse_racing: "🏇",
                    hospital: "🏥",
                    hot_pepper: "🌶",
                    hotdog: "🌭",
                    hotel: "🏨",
                    hotsprings: "♨️",
                    hourglass: "⌛️",
                    hourglass_flowing_sand: "⏳",
                    house: "🏠",
                    house_with_garden: "🏡",
                    houses: "🏘",
                    hugs: "🤗",
                    hushed: "😯",
                    ice_cream: "🍨",
                    ice_hockey: "🏒",
                    ice_skate: "⛸",
                    icecream: "🍦",
                    id: "🆔",
                    ideograph_advantage: "🉐",
                    imp: "👿",
                    inbox_tray: "📥",
                    incoming_envelope: "📨",
                    tipping_hand_woman: "💁",
                    information_source: "ℹ️",
                    innocent: "😇",
                    interrobang: "⁉️",
                    iphone: "📱",
                    izakaya_lantern: "🏮",
                    jack_o_lantern: "🎃",
                    japan: "🗾",
                    japanese_castle: "🏯",
                    japanese_goblin: "👺",
                    japanese_ogre: "👹",
                    jeans: "👖",
                    joy: "😂",
                    joy_cat: "😹",
                    joystick: "🕹",
                    kaaba: "🕋",
                    key: "🔑",
                    keyboard: "⌨️",
                    keycap_ten: "🔟",
                    kick_scooter: "🛴",
                    kimono: "👘",
                    kiss: "💋",
                    kissing: "😗",
                    kissing_cat: "😽",
                    kissing_closed_eyes: "😚",
                    kissing_heart: "😘",
                    kissing_smiling_eyes: "😙",
                    kiwi_fruit: "🥝",
                    koala: "🐨",
                    koko: "🈁",
                    label: "🏷",
                    large_blue_circle: "🔵",
                    large_blue_diamond: "🔷",
                    large_orange_diamond: "🔶",
                    last_quarter_moon: "🌗",
                    last_quarter_moon_with_face: "🌜",
                    latin_cross: "✝️",
                    laughing: "😆",
                    leaves: "🍃",
                    ledger: "📒",
                    left_luggage: "🛅",
                    left_right_arrow: "↔️",
                    leftwards_arrow_with_hook: "↩️",
                    lemon: "🍋",
                    leo: "♌️",
                    leopard: "🐆",
                    level_slider: "🎚",
                    libra: "♎️",
                    light_rail: "🚈",
                    link: "🔗",
                    lion: "🦁",
                    lips: "👄",
                    lipstick: "💄",
                    lizard: "🦎",
                    lock: "🔒",
                    lock_with_ink_pen: "🔏",
                    lollipop: "🍭",
                    loop: "➿",
                    loud_sound: "🔊",
                    loudspeaker: "📢",
                    love_hotel: "🏩",
                    love_letter: "💌",
                    low_brightness: "🔅",
                    lying_face: "🤥",
                    m: "Ⓜ️",
                    mag: "🔍",
                    mag_right: "🔎",
                    mahjong: "🀄️",
                    mailbox: "📫",
                    mailbox_closed: "📪",
                    mailbox_with_mail: "📬",
                    mailbox_with_no_mail: "📭",
                    man: "👨",
                    man_artist: "👨&zwj;🎨",
                    man_astronaut: "👨&zwj;🚀",
                    man_cartwheeling: "🤸&zwj;♂️",
                    man_cook: "👨&zwj;🍳",
                    man_dancing: "🕺",
                    man_facepalming: "🤦&zwj;♂️",
                    man_factory_worker: "👨&zwj;🏭",
                    man_farmer: "👨&zwj;🌾",
                    man_firefighter: "👨&zwj;🚒",
                    man_health_worker: "👨&zwj;⚕️",
                    man_in_tuxedo: "🤵",
                    man_judge: "👨&zwj;⚖️",
                    man_juggling: "🤹&zwj;♂️",
                    man_mechanic: "👨&zwj;🔧",
                    man_office_worker: "👨&zwj;💼",
                    man_pilot: "👨&zwj;✈️",
                    man_playing_handball: "🤾&zwj;♂️",
                    man_playing_water_polo: "🤽&zwj;♂️",
                    man_scientist: "👨&zwj;🔬",
                    man_shrugging: "🤷&zwj;♂️",
                    man_singer: "👨&zwj;🎤",
                    man_student: "👨&zwj;🎓",
                    man_teacher: "👨&zwj;🏫",
                    man_technologist: "👨&zwj;💻",
                    man_with_gua_pi_mao: "👲",
                    man_with_turban: "👳",
                    tangerine: "🍊",
                    mans_shoe: "👞",
                    mantelpiece_clock: "🕰",
                    maple_leaf: "🍁",
                    martial_arts_uniform: "🥋",
                    mask: "😷",
                    massage_woman: "💆",
                    massage_man: "💆&zwj;♂️",
                    meat_on_bone: "🍖",
                    medal_military: "🎖",
                    medal_sports: "🏅",
                    mega: "📣",
                    melon: "🍈",
                    memo: "📝",
                    men_wrestling: "🤼&zwj;♂️",
                    menorah: "🕎",
                    mens: "🚹",
                    metal: "🤘",
                    metro: "🚇",
                    microphone: "🎤",
                    microscope: "🔬",
                    milk_glass: "🥛",
                    milky_way: "🌌",
                    minibus: "🚐",
                    minidisc: "💽",
                    mobile_phone_off: "📴",
                    money_mouth_face: "🤑",
                    money_with_wings: "💸",
                    moneybag: "💰",
                    monkey: "🐒",
                    monkey_face: "🐵",
                    monorail: "🚝",
                    moon: "🌔",
                    mortar_board: "🎓",
                    mosque: "🕌",
                    motor_boat: "🛥",
                    motor_scooter: "🛵",
                    motorcycle: "🏍",
                    motorway: "🛣",
                    mount_fuji: "🗻",
                    mountain: "⛰",
                    mountain_biking_man: "🚵",
                    mountain_biking_woman: "🚵&zwj;♀️",
                    mountain_cableway: "🚠",
                    mountain_railway: "🚞",
                    mountain_snow: "🏔",
                    mouse: "🐭",
                    mouse2: "🐁",
                    movie_camera: "🎥",
                    moyai: "🗿",
                    mrs_claus: "🤶",
                    muscle: "💪",
                    mushroom: "🍄",
                    musical_keyboard: "🎹",
                    musical_note: "🎵",
                    musical_score: "🎼",
                    mute: "🔇",
                    nail_care: "💅",
                    name_badge: "📛",
                    national_park: "🏞",
                    nauseated_face: "🤢",
                    necktie: "👔",
                    negative_squared_cross_mark: "❎",
                    nerd_face: "🤓",
                    neutral_face: "😐",
                    new: "🆕",
                    new_moon: "🌑",
                    new_moon_with_face: "🌚",
                    newspaper: "📰",
                    newspaper_roll: "🗞",
                    next_track_button: "⏭",
                    ng: "🆖",
                    no_good_man: "🙅&zwj;♂️",
                    no_good_woman: "🙅",
                    night_with_stars: "🌃",
                    no_bell: "🔕",
                    no_bicycles: "🚳",
                    no_entry: "⛔️",
                    no_entry_sign: "🚫",
                    no_mobile_phones: "📵",
                    no_mouth: "😶",
                    no_pedestrians: "🚷",
                    no_smoking: "🚭",
                    "non-potable_water": "🚱",
                    nose: "👃",
                    notebook: "📓",
                    notebook_with_decorative_cover: "📔",
                    notes: "🎶",
                    nut_and_bolt: "🔩",
                    o: "⭕️",
                    o2: "🅾️",
                    ocean: "🌊",
                    octopus: "🐙",
                    oden: "🍢",
                    office: "🏢",
                    oil_drum: "🛢",
                    ok: "🆗",
                    ok_hand: "👌",
                    ok_man: "🙆&zwj;♂️",
                    ok_woman: "🙆",
                    old_key: "🗝",
                    older_man: "👴",
                    older_woman: "👵",
                    om: "🕉",
                    on: "🔛",
                    oncoming_automobile: "🚘",
                    oncoming_bus: "🚍",
                    oncoming_police_car: "🚔",
                    oncoming_taxi: "🚖",
                    open_file_folder: "📂",
                    open_hands: "👐",
                    open_mouth: "😮",
                    open_umbrella: "☂️",
                    ophiuchus: "⛎",
                    orange_book: "📙",
                    orthodox_cross: "☦️",
                    outbox_tray: "📤",
                    owl: "🦉",
                    ox: "🐂",
                    package: "📦",
                    page_facing_up: "📄",
                    page_with_curl: "📃",
                    pager: "📟",
                    paintbrush: "🖌",
                    palm_tree: "🌴",
                    pancakes: "🥞",
                    panda_face: "🐼",
                    paperclip: "📎",
                    paperclips: "🖇",
                    parasol_on_ground: "⛱",
                    parking: "🅿️",
                    part_alternation_mark: "〽️",
                    partly_sunny: "⛅️",
                    passenger_ship: "🛳",
                    passport_control: "🛂",
                    pause_button: "⏸",
                    peace_symbol: "☮️",
                    peach: "🍑",
                    peanuts: "🥜",
                    pear: "🍐",
                    pen: "🖊",
                    pencil2: "✏️",
                    penguin: "🐧",
                    pensive: "😔",
                    performing_arts: "🎭",
                    persevere: "😣",
                    person_fencing: "🤺",
                    pouting_woman: "🙎",
                    phone: "☎️",
                    pick: "⛏",
                    pig: "🐷",
                    pig2: "🐖",
                    pig_nose: "🐽",
                    pill: "💊",
                    pineapple: "🍍",
                    ping_pong: "🏓",
                    pisces: "♓️",
                    pizza: "🍕",
                    place_of_worship: "🛐",
                    plate_with_cutlery: "🍽",
                    play_or_pause_button: "⏯",
                    point_down: "👇",
                    point_left: "👈",
                    point_right: "👉",
                    point_up: "☝️",
                    point_up_2: "👆",
                    police_car: "🚓",
                    policewoman: "👮&zwj;♀️",
                    poodle: "🐩",
                    popcorn: "🍿",
                    post_office: "🏣",
                    postal_horn: "📯",
                    postbox: "📮",
                    potable_water: "🚰",
                    potato: "🥔",
                    pouch: "👝",
                    poultry_leg: "🍗",
                    pound: "💷",
                    rage: "😡",
                    pouting_cat: "😾",
                    pouting_man: "🙎&zwj;♂️",
                    pray: "🙏",
                    prayer_beads: "📿",
                    pregnant_woman: "🤰",
                    previous_track_button: "⏮",
                    prince: "🤴",
                    princess: "👸",
                    printer: "🖨",
                    purple_heart: "💜",
                    purse: "👛",
                    pushpin: "📌",
                    put_litter_in_its_place: "🚮",
                    question: "❓",
                    rabbit: "🐰",
                    rabbit2: "🐇",
                    racehorse: "🐎",
                    racing_car: "🏎",
                    radio: "📻",
                    radio_button: "🔘",
                    radioactive: "☢️",
                    railway_car: "🚃",
                    railway_track: "🛤",
                    rainbow: "🌈",
                    rainbow_flag: "🏳️&zwj;🌈",
                    raised_back_of_hand: "🤚",
                    raised_hand_with_fingers_splayed: "🖐",
                    raised_hands: "🙌",
                    raising_hand_woman: "🙋",
                    raising_hand_man: "🙋&zwj;♂️",
                    ram: "🐏",
                    ramen: "🍜",
                    rat: "🐀",
                    record_button: "⏺",
                    recycle: "♻️",
                    red_circle: "🔴",
                    registered: "®️",
                    relaxed: "☺️",
                    relieved: "😌",
                    reminder_ribbon: "🎗",
                    repeat: "🔁",
                    repeat_one: "🔂",
                    rescue_worker_helmet: "⛑",
                    restroom: "🚻",
                    revolving_hearts: "💞",
                    rewind: "⏪",
                    rhinoceros: "🦏",
                    ribbon: "🎀",
                    rice: "🍚",
                    rice_ball: "🍙",
                    rice_cracker: "🍘",
                    rice_scene: "🎑",
                    right_anger_bubble: "🗯",
                    ring: "💍",
                    robot: "🤖",
                    rocket: "🚀",
                    rofl: "🤣",
                    roll_eyes: "🙄",
                    roller_coaster: "🎢",
                    rooster: "🐓",
                    rose: "🌹",
                    rosette: "🏵",
                    rotating_light: "🚨",
                    round_pushpin: "📍",
                    rowing_man: "🚣",
                    rowing_woman: "🚣&zwj;♀️",
                    rugby_football: "🏉",
                    running_man: "🏃",
                    running_shirt_with_sash: "🎽",
                    running_woman: "🏃&zwj;♀️",
                    sa: "🈂️",
                    sagittarius: "♐️",
                    sake: "🍶",
                    sandal: "👡",
                    santa: "🎅",
                    satellite: "📡",
                    saxophone: "🎷",
                    school: "🏫",
                    school_satchel: "🎒",
                    scissors: "✂️",
                    scorpion: "🦂",
                    scorpius: "♏️",
                    scream: "😱",
                    scream_cat: "🙀",
                    scroll: "📜",
                    seat: "💺",
                    secret: "㊙️",
                    see_no_evil: "🙈",
                    seedling: "🌱",
                    selfie: "🤳",
                    shallow_pan_of_food: "🥘",
                    shamrock: "☘️",
                    shark: "🦈",
                    shaved_ice: "🍧",
                    sheep: "🐑",
                    shell: "🐚",
                    shield: "🛡",
                    shinto_shrine: "⛩",
                    ship: "🚢",
                    shirt: "👕",
                    shopping: "🛍",
                    shopping_cart: "🛒",
                    shower: "🚿",
                    shrimp: "🦐",
                    signal_strength: "📶",
                    six_pointed_star: "🔯",
                    ski: "🎿",
                    skier: "⛷",
                    skull: "💀",
                    skull_and_crossbones: "☠️",
                    sleeping: "😴",
                    sleeping_bed: "🛌",
                    sleepy: "😪",
                    slightly_frowning_face: "🙁",
                    slightly_smiling_face: "🙂",
                    slot_machine: "🎰",
                    small_airplane: "🛩",
                    small_blue_diamond: "🔹",
                    small_orange_diamond: "🔸",
                    small_red_triangle: "🔺",
                    small_red_triangle_down: "🔻",
                    smile: "😄",
                    smile_cat: "😸",
                    smiley: "😃",
                    smiley_cat: "😺",
                    smiling_imp: "😈",
                    smirk: "😏",
                    smirk_cat: "😼",
                    smoking: "🚬",
                    snail: "🐌",
                    snake: "🐍",
                    sneezing_face: "🤧",
                    snowboarder: "🏂",
                    snowflake: "❄️",
                    snowman: "⛄️",
                    snowman_with_snow: "☃️",
                    sob: "😭",
                    soccer: "⚽️",
                    soon: "🔜",
                    sos: "🆘",
                    sound: "🔉",
                    space_invader: "👾",
                    spades: "♠️",
                    spaghetti: "🍝",
                    sparkle: "❇️",
                    sparkler: "🎇",
                    sparkles: "✨",
                    sparkling_heart: "💖",
                    speak_no_evil: "🙊",
                    speaker: "🔈",
                    speaking_head: "🗣",
                    speech_balloon: "💬",
                    speedboat: "🚤",
                    spider: "🕷",
                    spider_web: "🕸",
                    spiral_calendar: "🗓",
                    spiral_notepad: "🗒",
                    spoon: "🥄",
                    squid: "🦑",
                    stadium: "🏟",
                    star: "⭐️",
                    star2: "🌟",
                    star_and_crescent: "☪️",
                    star_of_david: "✡️",
                    stars: "🌠",
                    station: "🚉",
                    statue_of_liberty: "🗽",
                    steam_locomotive: "🚂",
                    stew: "🍲",
                    stop_button: "⏹",
                    stop_sign: "🛑",
                    stopwatch: "⏱",
                    straight_ruler: "📏",
                    strawberry: "🍓",
                    stuck_out_tongue: "😛",
                    stuck_out_tongue_closed_eyes: "😝",
                    stuck_out_tongue_winking_eye: "😜",
                    studio_microphone: "🎙",
                    stuffed_flatbread: "🥙",
                    sun_behind_large_cloud: "🌥",
                    sun_behind_rain_cloud: "🌦",
                    sun_behind_small_cloud: "🌤",
                    sun_with_face: "🌞",
                    sunflower: "🌻",
                    sunglasses: "😎",
                    sunny: "☀️",
                    sunrise: "🌅",
                    sunrise_over_mountains: "🌄",
                    surfing_man: "🏄",
                    surfing_woman: "🏄&zwj;♀️",
                    sushi: "🍣",
                    suspension_railway: "🚟",
                    sweat: "😓",
                    sweat_drops: "💦",
                    sweat_smile: "😅",
                    sweet_potato: "🍠",
                    swimming_man: "🏊",
                    swimming_woman: "🏊&zwj;♀️",
                    symbols: "🔣",
                    synagogue: "🕍",
                    syringe: "💉",
                    taco: "🌮",
                    tada: "🎉",
                    tanabata_tree: "🎋",
                    taurus: "♉️",
                    taxi: "🚕",
                    tea: "🍵",
                    telephone_receiver: "📞",
                    telescope: "🔭",
                    tennis: "🎾",
                    tent: "⛺️",
                    thermometer: "🌡",
                    thinking: "🤔",
                    thought_balloon: "💭",
                    ticket: "🎫",
                    tickets: "🎟",
                    tiger: "🐯",
                    tiger2: "🐅",
                    timer_clock: "⏲",
                    tipping_hand_man: "💁&zwj;♂️",
                    tired_face: "😫",
                    tm: "™️",
                    toilet: "🚽",
                    tokyo_tower: "🗼",
                    tomato: "🍅",
                    tongue: "👅",
                    top: "🔝",
                    tophat: "🎩",
                    tornado: "🌪",
                    trackball: "🖲",
                    tractor: "🚜",
                    traffic_light: "🚥",
                    train: "🚋",
                    train2: "🚆",
                    tram: "🚊",
                    triangular_flag_on_post: "🚩",
                    triangular_ruler: "📐",
                    trident: "🔱",
                    triumph: "😤",
                    trolleybus: "🚎",
                    trophy: "🏆",
                    tropical_drink: "🍹",
                    tropical_fish: "🐠",
                    truck: "🚚",
                    trumpet: "🎺",
                    tulip: "🌷",
                    tumbler_glass: "🥃",
                    turkey: "🦃",
                    turtle: "🐢",
                    tv: "📺",
                    twisted_rightwards_arrows: "🔀",
                    two_hearts: "💕",
                    two_men_holding_hands: "👬",
                    two_women_holding_hands: "👭",
                    u5272: "🈹",
                    u5408: "🈴",
                    u55b6: "🈺",
                    u6307: "🈯️",
                    u6708: "🈷️",
                    u6709: "🈶",
                    u6e80: "🈵",
                    u7121: "🈚️",
                    u7533: "🈸",
                    u7981: "🈲",
                    u7a7a: "🈳",
                    umbrella: "☔️",
                    unamused: "😒",
                    underage: "🔞",
                    unicorn: "🦄",
                    unlock: "🔓",
                    up: "🆙",
                    upside_down_face: "🙃",
                    v: "✌️",
                    vertical_traffic_light: "🚦",
                    vhs: "📼",
                    vibration_mode: "📳",
                    video_camera: "📹",
                    video_game: "🎮",
                    violin: "🎻",
                    virgo: "♍️",
                    volcano: "🌋",
                    volleyball: "🏐",
                    vs: "🆚",
                    vulcan_salute: "🖖",
                    walking_man: "🚶",
                    walking_woman: "🚶&zwj;♀️",
                    waning_crescent_moon: "🌘",
                    waning_gibbous_moon: "🌖",
                    warning: "⚠️",
                    wastebasket: "🗑",
                    watch: "⌚️",
                    water_buffalo: "🐃",
                    watermelon: "🍉",
                    wave: "👋",
                    wavy_dash: "〰️",
                    waxing_crescent_moon: "🌒",
                    wc: "🚾",
                    weary: "😩",
                    wedding: "💒",
                    weight_lifting_man: "🏋️",
                    weight_lifting_woman: "🏋️&zwj;♀️",
                    whale: "🐳",
                    whale2: "🐋",
                    wheel_of_dharma: "☸️",
                    wheelchair: "♿️",
                    white_check_mark: "✅",
                    white_circle: "⚪️",
                    white_flag: "🏳️",
                    white_flower: "💮",
                    white_large_square: "⬜️",
                    white_medium_small_square: "◽️",
                    white_medium_square: "◻️",
                    white_small_square: "▫️",
                    white_square_button: "🔳",
                    wilted_flower: "🥀",
                    wind_chime: "🎐",
                    wind_face: "🌬",
                    wine_glass: "🍷",
                    wink: "😉",
                    wolf: "🐺",
                    woman: "👩",
                    woman_artist: "👩&zwj;🎨",
                    woman_astronaut: "👩&zwj;🚀",
                    woman_cartwheeling: "🤸&zwj;♀️",
                    woman_cook: "👩&zwj;🍳",
                    woman_facepalming: "🤦&zwj;♀️",
                    woman_factory_worker: "👩&zwj;🏭",
                    woman_farmer: "👩&zwj;🌾",
                    woman_firefighter: "👩&zwj;🚒",
                    woman_health_worker: "👩&zwj;⚕️",
                    woman_judge: "👩&zwj;⚖️",
                    woman_juggling: "🤹&zwj;♀️",
                    woman_mechanic: "👩&zwj;🔧",
                    woman_office_worker: "👩&zwj;💼",
                    woman_pilot: "👩&zwj;✈️",
                    woman_playing_handball: "🤾&zwj;♀️",
                    woman_playing_water_polo: "🤽&zwj;♀️",
                    woman_scientist: "👩&zwj;🔬",
                    woman_shrugging: "🤷&zwj;♀️",
                    woman_singer: "👩&zwj;🎤",
                    woman_student: "👩&zwj;🎓",
                    woman_teacher: "👩&zwj;🏫",
                    woman_technologist: "👩&zwj;💻",
                    woman_with_turban: "👳&zwj;♀️",
                    womans_clothes: "👚",
                    womans_hat: "👒",
                    women_wrestling: "🤼&zwj;♀️",
                    womens: "🚺",
                    world_map: "🗺",
                    worried: "😟",
                    wrench: "🔧",
                    writing_hand: "✍️",
                    x: "❌",
                    yellow_heart: "💛",
                    yen: "💴",
                    yin_yang: "☯️",
                    yum: "😋",
                    zap: "⚡️",
                    zipper_mouth_face: "🤐",
                    zzz: "💤",
                    octocat: '<img alt=":octocat:" height="20" width="20" align="absmiddle" src="https://assets-cdn.github.com/images/icons/emoji/octocat.png">',
                    showdown: "<span style=\"font-family: 'Anonymous Pro', monospace; text-decoration: underline; text-decoration-style: dashed; text-decoration-color: #3e8b8a;text-underline-position: under;\">S</span>"
                }, o.Converter = function (e) {
                    "use strict";
                    var t = {}, n = [], r = [], i = {}, a = c, p = {parsed: {}, raw: "", format: ""};

                    function h(e, t) {
                        if (t = t || null, o.helper.isString(e)) {
                            if (t = e = o.helper.stdExtName(e), o.extensions[e]) return console.warn("DEPRECATION WARNING: " + e + " is an old extension that uses a deprecated loading method.Please inform the developer that the extension should be updated!"), void function (e, t) {
                                "function" == typeof e && (e = e(new o.Converter));
                                o.helper.isArray(e) || (e = [e]);
                                var i = d(e, t);
                                if (!i.valid) throw Error(i.error);
                                for (var a = 0; a < e.length; ++a) switch (e[a].type) {
                                    case"lang":
                                        n.push(e[a]);
                                        break;
                                    case"output":
                                        r.push(e[a]);
                                        break;
                                    default:
                                        throw Error("Extension loader error: Type unrecognized!!!")
                                }
                            }(o.extensions[e], e);
                            if (o.helper.isUndefined(s[e])) throw Error('Extension "' + e + '" could not be loaded. It was either not found or is not a valid extension.');
                            e = s[e]
                        }
                        "function" == typeof e && (e = e()), o.helper.isArray(e) || (e = [e]);
                        var i = d(e, t);
                        if (!i.valid) throw Error(i.error);
                        for (var a = 0; a < e.length; ++a) {
                            switch (e[a].type) {
                                case"lang":
                                    n.push(e[a]);
                                    break;
                                case"output":
                                    r.push(e[a])
                            }
                            if (e[a].hasOwnProperty("listeners")) for (var l in e[a].listeners) e[a].listeners.hasOwnProperty(l) && f(l, e[a].listeners[l])
                        }
                    }

                    function f(e, t) {
                        if (!o.helper.isString(e)) throw Error("Invalid argument in converter.listen() method: name must be a string, but " + typeof e + " given");
                        if ("function" != typeof t) throw Error("Invalid argument in converter.listen() method: callback must be a function, but " + typeof t + " given");
                        i.hasOwnProperty(e) || (i[e] = []), i[e].push(t)
                    }

                    !function () {
                        for (var n in e = e || {}, l) l.hasOwnProperty(n) && (t[n] = l[n]);
                        if ("object" != typeof e) throw Error("Converter expects the passed parameter to be an object, but " + typeof e + " was passed instead.");
                        for (var r in e) e.hasOwnProperty(r) && (t[r] = e[r]);
                        t.extensions && o.helper.forEach(t.extensions, h)
                    }(), this._dispatch = function (e, t, n, r) {
                        if (i.hasOwnProperty(e)) for (var o = 0; o < i[e].length; ++o) {
                            var a = i[e][o](e, t, this, n, r);
                            a && void 0 !== a && (t = a)
                        }
                        return t
                    }, this.listen = function (e, t) {
                        return f(e, t), this
                    }, this.makeHtml = function (e) {
                        if (!e) return e;
                        var i = {
                            gHtmlBlocks: [],
                            gHtmlMdBlocks: [],
                            gHtmlSpans: [],
                            gUrls: {},
                            gTitles: {},
                            gDimensions: {},
                            gListLevel: 0,
                            hashLinkCounts: {},
                            langExtensions: n,
                            outputModifiers: r,
                            converter: this,
                            ghCodeBlocks: [],
                            metadata: {parsed: {}, raw: "", format: ""}
                        };
                        return e = (e = (e = (e = (e = e.replace(/¨/g, "¨T")).replace(/\$/g, "¨D")).replace(/\r\n/g, "\n")).replace(/\r/g, "\n")).replace(/\u00A0/g, "&nbsp;"), t.smartIndentationFix && (e = function (e) {
                            var t = e.match(/^\s*/)[0].length, n = new RegExp("^\\s{0," + t + "}", "gm");
                            return e.replace(n, "")
                        }(e)), e = "\n\n" + e + "\n\n", e = (e = o.subParser("detab")(e, t, i)).replace(/^[ \t]+$/gm, ""), o.helper.forEach(n, (function (n) {
                            e = o.subParser("runExtension")(n, e, t, i)
                        })), e = o.subParser("metadata")(e, t, i), e = o.subParser("hashPreCodeTags")(e, t, i), e = o.subParser("githubCodeBlocks")(e, t, i), e = o.subParser("hashHTMLBlocks")(e, t, i), e = o.subParser("hashCodeTags")(e, t, i), e = o.subParser("stripLinkDefinitions")(e, t, i), e = o.subParser("blockGamut")(e, t, i), e = o.subParser("unhashHTMLSpans")(e, t, i), e = (e = (e = o.subParser("unescapeSpecialChars")(e, t, i)).replace(/¨D/g, "$$")).replace(/¨T/g, "¨"), e = o.subParser("completeHTMLDocument")(e, t, i), o.helper.forEach(r, (function (n) {
                            e = o.subParser("runExtension")(n, e, t, i)
                        })), p = i.metadata, e
                    }, this.makeMarkdown = this.makeMd = function (e, t) {
                        if (e = (e = (e = e.replace(/\r\n/g, "\n")).replace(/\r/g, "\n")).replace(/>[ \t]+</, ">¨NBSP;<"), !t) {
                            if (!window || !window.document) throw new Error("HTMLParser is undefined. If in a webworker or nodejs environment, you need to provide a WHATWG DOM and HTML such as JSDOM");
                            t = window.document
                        }
                        var n = t.createElement("div");
                        n.innerHTML = e;
                        var r = {
                            preList: function (e) {
                                for (var t = e.querySelectorAll("pre"), n = [], r = 0; r < t.length; ++r) if (1 === t[r].childElementCount && "code" === t[r].firstChild.tagName.toLowerCase()) {
                                    var i = t[r].firstChild.innerHTML.trim(),
                                        a = t[r].firstChild.getAttribute("data-language") || "";
                                    if ("" === a) for (var s = t[r].firstChild.className.split(" "), l = 0; l < s.length; ++l) {
                                        var c = s[l].match(/^language-(.+)$/);
                                        if (null !== c) {
                                            a = c[1];
                                            break
                                        }
                                    }
                                    i = o.helper.unescapeHTMLEntities(i), n.push(i), t[r].outerHTML = '<precode language="' + a + '" precodenum="' + r.toString() + '"></precode>'
                                } else n.push(t[r].innerHTML), t[r].innerHTML = "", t[r].setAttribute("prenum", r.toString());
                                return n
                            }(n)
                        };
                        !function e(t) {
                            for (var n = 0; n < t.childNodes.length; ++n) {
                                var r = t.childNodes[n];
                                3 === r.nodeType ? /\S/.test(r.nodeValue) ? (r.nodeValue = r.nodeValue.split("\n").join(" "), r.nodeValue = r.nodeValue.replace(/(\s)+/g, "$1")) : (t.removeChild(r), --n) : 1 === r.nodeType && e(r)
                            }
                        }(n);
                        for (var i = n.childNodes, a = "", s = 0; s < i.length; s++) a += o.subParser("makeMarkdown.node")(i[s], r);
                        return a
                    }, this.setOption = function (e, n) {
                        t[e] = n
                    }, this.getOption = function (e) {
                        return t[e]
                    }, this.getOptions = function () {
                        return t
                    }, this.addExtension = function (e, t) {
                        h(e, t = t || null)
                    }, this.useExtension = function (e) {
                        h(e)
                    }, this.setFlavor = function (e) {
                        if (!u.hasOwnProperty(e)) throw Error(e + " flavor was not found");
                        var n = u[e];
                        for (var r in a = e, n) n.hasOwnProperty(r) && (t[r] = n[r])
                    }, this.getFlavor = function () {
                        return a
                    }, this.removeExtension = function (e) {
                        o.helper.isArray(e) || (e = [e]);
                        for (var t = 0; t < e.length; ++t) {
                            for (var i = e[t], a = 0; a < n.length; ++a) n[a] === i && n[a].splice(a, 1);
                            for (; 0 < r.length; ++a) r[0] === i && r[0].splice(a, 1)
                        }
                    }, this.getAllExtensions = function () {
                        return {language: n, output: r}
                    }, this.getMetadata = function (e) {
                        return e ? p.raw : p.parsed
                    }, this.getMetadataFormat = function () {
                        return p.format
                    }, this._setMetadataPair = function (e, t) {
                        p.parsed[e] = t
                    }, this._setMetadataFormat = function (e) {
                        p.format = e
                    }, this._setMetadataRaw = function (e) {
                        p.raw = e
                    }
                }, o.subParser("anchors", (function (e, t, n) {
                    "use strict";
                    var r = function (e, r, i, a, s, l, c) {
                        if (o.helper.isUndefined(c) && (c = ""), i = i.toLowerCase(), e.search(/\(<?\s*>? ?(['"].*['"])?\)$/m) > -1) a = ""; else if (!a) {
                            if (i || (i = r.toLowerCase().replace(/ ?\n/g, " ")), a = "#" + i, o.helper.isUndefined(n.gUrls[i])) return e;
                            a = n.gUrls[i], o.helper.isUndefined(n.gTitles[i]) || (c = n.gTitles[i])
                        }
                        var u = '<a href="' + (a = a.replace(o.helper.regexes.asteriskDashAndColon, o.helper.escapeCharactersCallback)) + '"';
                        return "" !== c && null !== c && (u += ' title="' + (c = (c = c.replace(/"/g, "&quot;")).replace(o.helper.regexes.asteriskDashAndColon, o.helper.escapeCharactersCallback)) + '"'), t.openLinksInNewWindow && !/^#/.test(a) && (u += ' rel="noopener noreferrer" target="¨E95Eblank"'), u += ">" + r + "</a>"
                    };
                    return e = (e = (e = (e = (e = n.converter._dispatch("anchors.before", e, t, n)).replace(/\[((?:\[[^\]]*]|[^\[\]])*)] ?(?:\n *)?\[(.*?)]()()()()/g, r)).replace(/\[((?:\[[^\]]*]|[^\[\]])*)]()[ \t]*\([ \t]?<([^>]*)>(?:[ \t]*((["'])([^"]*?)\5))?[ \t]?\)/g, r)).replace(/\[((?:\[[^\]]*]|[^\[\]])*)]()[ \t]*\([ \t]?<?([\S]+?(?:\([\S]*?\)[\S]*?)?)>?(?:[ \t]*((["'])([^"]*?)\5))?[ \t]?\)/g, r)).replace(/\[([^\[\]]+)]()()()()()/g, r), t.ghMentions && (e = e.replace(/(^|\s)(\\)?(@([a-z\d]+(?:[a-z\d.-]+?[a-z\d]+)*))/gim, (function (e, n, r, i, a) {
                        if ("\\" === r) return n + i;
                        if (!o.helper.isString(t.ghMentionsLink)) throw new Error("ghMentionsLink option must be a string");
                        var s = t.ghMentionsLink.replace(/\{u}/g, a), l = "";
                        return t.openLinksInNewWindow && (l = ' rel="noopener noreferrer" target="¨E95Eblank"'), n + '<a href="' + s + '"' + l + ">" + i + "</a>"
                    }))), e = n.converter._dispatch("anchors.after", e, t, n)
                }));
                var f = /([*~_]+|\b)(((https?|ftp|dict):\/\/|www\.)[^'">\s]+?\.[^'">\s]+?)()(\1)?(?=\s|$)(?!["<>])/gi,
                    g = /([*~_]+|\b)(((https?|ftp|dict):\/\/|www\.)[^'">\s]+\.[^'">\s]+?)([.!?,()\[\]])?(\1)?(?=\s|$)(?!["<>])/gi,
                    m = /()<(((https?|ftp|dict):\/\/|www\.)[^'">\s]+)()>()/gi,
                    v = /(^|\s)(?:mailto:)?([A-Za-z0-9!#$%&'*+-/=?^_`{|}~.]+@[-a-z0-9]+(\.[-a-z0-9]+)*\.[a-z]+)(?=$|\s)/gim,
                    b = /<()(?:mailto:)?([-.\w]+@[-a-z0-9]+(\.[-a-z0-9]+)*\.[a-z]+)>/gi, w = function (e) {
                        "use strict";
                        return function (t, n, r, i, a, s, l) {
                            var c = r = r.replace(o.helper.regexes.asteriskDashAndColon, o.helper.escapeCharactersCallback),
                                u = "", d = "", p = n || "", h = l || "";
                            return /^www\./i.test(r) && (r = r.replace(/^www\./i, "http://www.")), e.excludeTrailingPunctuationFromURLs && s && (u = s), e.openLinksInNewWindow && (d = ' rel="noopener noreferrer" target="¨E95Eblank"'), p + '<a href="' + r + '"' + d + ">" + c + "</a>" + u + h
                        }
                    }, y = function (e, t) {
                        "use strict";
                        return function (n, r, i) {
                            var a = "mailto:";
                            return r = r || "", i = o.subParser("unescapeSpecialChars")(i, e, t), e.encodeEmails ? (a = o.helper.encodeEmailAddress(a + i), i = o.helper.encodeEmailAddress(i)) : a += i, r + '<a href="' + a + '">' + i + "</a>"
                        }
                    };
                o.subParser("autoLinks", (function (e, t, n) {
                    "use strict";
                    return e = (e = (e = n.converter._dispatch("autoLinks.before", e, t, n)).replace(m, w(t))).replace(b, y(t, n)), e = n.converter._dispatch("autoLinks.after", e, t, n)
                })), o.subParser("simplifiedAutoLinks", (function (e, t, n) {
                    "use strict";
                    return t.simplifiedAutoLink ? (e = n.converter._dispatch("simplifiedAutoLinks.before", e, t, n), e = (e = t.excludeTrailingPunctuationFromURLs ? e.replace(g, w(t)) : e.replace(f, w(t))).replace(v, y(t, n)), e = n.converter._dispatch("simplifiedAutoLinks.after", e, t, n)) : e
                })), o.subParser("blockGamut", (function (e, t, n) {
                    "use strict";
                    return e = n.converter._dispatch("blockGamut.before", e, t, n), e = o.subParser("blockQuotes")(e, t, n), e = o.subParser("headers")(e, t, n), e = o.subParser("horizontalRule")(e, t, n), e = o.subParser("lists")(e, t, n), e = o.subParser("codeBlocks")(e, t, n), e = o.subParser("tables")(e, t, n), e = o.subParser("hashHTMLBlocks")(e, t, n), e = o.subParser("paragraphs")(e, t, n), e = n.converter._dispatch("blockGamut.after", e, t, n)
                })), o.subParser("blockQuotes", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("blockQuotes.before", e, t, n), e += "\n\n";
                    var r = /(^ {0,3}>[ \t]?.+\n(.+\n)*\n*)+/gm;
                    return t.splitAdjacentBlockquotes && (r = /^ {0,3}>[\s\S]*?(?:\n\n)/gm), e = e.replace(r, (function (e) {
                        return e = (e = (e = e.replace(/^[ \t]*>[ \t]?/gm, "")).replace(/¨0/g, "")).replace(/^[ \t]+$/gm, ""), e = o.subParser("githubCodeBlocks")(e, t, n), e = (e = (e = o.subParser("blockGamut")(e, t, n)).replace(/(^|\n)/g, "$1  ")).replace(/(\s*<pre>[^\r]+?<\/pre>)/gm, (function (e, t) {
                            var n = t;
                            return n = (n = n.replace(/^  /gm, "¨0")).replace(/¨0/g, "")
                        })), o.subParser("hashBlock")("<blockquote>\n" + e + "\n</blockquote>", t, n)
                    })), e = n.converter._dispatch("blockQuotes.after", e, t, n)
                })), o.subParser("codeBlocks", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("codeBlocks.before", e, t, n);
                    return e = (e = (e += "¨0").replace(/(?:\n\n|^)((?:(?:[ ]{4}|\t).*\n+)+)(\n*[ ]{0,3}[^ \t\n]|(?=¨0))/g, (function (e, r, i) {
                        var a = r, s = i, l = "\n";
                        return a = o.subParser("outdent")(a, t, n), a = o.subParser("encodeCode")(a, t, n), a = (a = (a = o.subParser("detab")(a, t, n)).replace(/^\n+/g, "")).replace(/\n+$/g, ""), t.omitExtraWLInCodeBlocks && (l = ""), a = "<pre><code>" + a + l + "</code></pre>", o.subParser("hashBlock")(a, t, n) + s
                    }))).replace(/¨0/, ""), e = n.converter._dispatch("codeBlocks.after", e, t, n)
                })), o.subParser("codeSpans", (function (e, t, n) {
                    "use strict";
                    return void 0 === (e = n.converter._dispatch("codeSpans.before", e, t, n)) && (e = ""), e = e.replace(/(^|[^\\])(`+)([^\r]*?[^`])\2(?!`)/gm, (function (e, r, i, a) {
                        var s = a;
                        return s = (s = s.replace(/^([ \t]*)/g, "")).replace(/[ \t]*$/g, ""), s = r + "<code>" + (s = o.subParser("encodeCode")(s, t, n)) + "</code>", s = o.subParser("hashHTMLSpans")(s, t, n)
                    })), e = n.converter._dispatch("codeSpans.after", e, t, n)
                })), o.subParser("completeHTMLDocument", (function (e, t, n) {
                    "use strict";
                    if (!t.completeHTMLDocument) return e;
                    e = n.converter._dispatch("completeHTMLDocument.before", e, t, n);
                    var r = "html", i = "<!DOCTYPE HTML>\n", o = "", a = '<meta charset="utf-8">\n', s = "", l = "";
                    for (var c in void 0 !== n.metadata.parsed.doctype && (i = "<!DOCTYPE " + n.metadata.parsed.doctype + ">\n", "html" !== (r = n.metadata.parsed.doctype.toString().toLowerCase()) && "html5" !== r || (a = '<meta charset="utf-8">')), n.metadata.parsed) if (n.metadata.parsed.hasOwnProperty(c)) switch (c.toLowerCase()) {
                        case"doctype":
                            break;
                        case"title":
                            o = "<title>" + n.metadata.parsed.title + "</title>\n";
                            break;
                        case"charset":
                            a = "html" === r || "html5" === r ? '<meta charset="' + n.metadata.parsed.charset + '">\n' : '<meta name="charset" content="' + n.metadata.parsed.charset + '">\n';
                            break;
                        case"language":
                        case"lang":
                            s = ' lang="' + n.metadata.parsed[c] + '"', l += '<meta name="' + c + '" content="' + n.metadata.parsed[c] + '">\n';
                            break;
                        default:
                            l += '<meta name="' + c + '" content="' + n.metadata.parsed[c] + '">\n'
                    }
                    return e = i + "<html" + s + ">\n<head>\n" + o + a + l + "</head>\n<body>\n" + e.trim() + "\n</body>\n</html>", e = n.converter._dispatch("completeHTMLDocument.after", e, t, n)
                })), o.subParser("detab", (function (e, t, n) {
                    "use strict";
                    return e = (e = (e = (e = (e = (e = n.converter._dispatch("detab.before", e, t, n)).replace(/\t(?=\t)/g, "    ")).replace(/\t/g, "¨A¨B")).replace(/¨B(.+?)¨A/g, (function (e, t) {
                        for (var n = t, r = 4 - n.length % 4, i = 0; i < r; i++) n += " ";
                        return n
                    }))).replace(/¨A/g, "    ")).replace(/¨B/g, ""), e = n.converter._dispatch("detab.after", e, t, n)
                })), o.subParser("ellipsis", (function (e, t, n) {
                    "use strict";
                    return e = (e = n.converter._dispatch("ellipsis.before", e, t, n)).replace(/\.\.\./g, "…"), e = n.converter._dispatch("ellipsis.after", e, t, n)
                })), o.subParser("emoji", (function (e, t, n) {
                    "use strict";
                    if (!t.emoji) return e;
                    return e = (e = n.converter._dispatch("emoji.before", e, t, n)).replace(/:([\S]+?):/g, (function (e, t) {
                        return o.helper.emojis.hasOwnProperty(t) ? o.helper.emojis[t] : e
                    })), e = n.converter._dispatch("emoji.after", e, t, n)
                })), o.subParser("encodeAmpsAndAngles", (function (e, t, n) {
                    "use strict";
                    return e = (e = (e = (e = (e = n.converter._dispatch("encodeAmpsAndAngles.before", e, t, n)).replace(/&(?!#?[xX]?(?:[0-9a-fA-F]+|\w+);)/g, "&amp;")).replace(/<(?![a-z\/?$!])/gi, "&lt;")).replace(/</g, "&lt;")).replace(/>/g, "&gt;"), e = n.converter._dispatch("encodeAmpsAndAngles.after", e, t, n)
                })), o.subParser("encodeBackslashEscapes", (function (e, t, n) {
                    "use strict";
                    return e = (e = (e = n.converter._dispatch("encodeBackslashEscapes.before", e, t, n)).replace(/\\(\\)/g, o.helper.escapeCharactersCallback)).replace(/\\([`*_{}\[\]()>#+.!~=|-])/g, o.helper.escapeCharactersCallback), e = n.converter._dispatch("encodeBackslashEscapes.after", e, t, n)
                })), o.subParser("encodeCode", (function (e, t, n) {
                    "use strict";
                    return e = (e = n.converter._dispatch("encodeCode.before", e, t, n)).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/([*_{}\[\]\\=~-])/g, o.helper.escapeCharactersCallback), e = n.converter._dispatch("encodeCode.after", e, t, n)
                })), o.subParser("escapeSpecialCharsWithinTagAttributes", (function (e, t, n) {
                    "use strict";
                    return e = (e = (e = n.converter._dispatch("escapeSpecialCharsWithinTagAttributes.before", e, t, n)).replace(/<\/?[a-z\d_:-]+(?:[\s]+[\s\S]+?)?>/gi, (function (e) {
                        return e.replace(/(.)<\/?code>(?=.)/g, "$1`").replace(/([\\`*_~=|])/g, o.helper.escapeCharactersCallback)
                    }))).replace(/<!(--(?:(?:[^>-]|-[^>])(?:[^-]|-[^-])*)--)>/gi, (function (e) {
                        return e.replace(/([\\`*_~=|])/g, o.helper.escapeCharactersCallback)
                    })), e = n.converter._dispatch("escapeSpecialCharsWithinTagAttributes.after", e, t, n)
                })), o.subParser("githubCodeBlocks", (function (e, t, n) {
                    "use strict";
                    return t.ghCodeBlocks ? (e = n.converter._dispatch("githubCodeBlocks.before", e, t, n), e = (e = (e += "¨0").replace(/(?:^|\n)(?: {0,3})(```+|~~~+)(?: *)([^\s`~]*)\n([\s\S]*?)\n(?: {0,3})\1/g, (function (e, r, i, a) {
                        var s = t.omitExtraWLInCodeBlocks ? "" : "\n";
                        return a = o.subParser("encodeCode")(a, t, n), a = "<pre><code" + (i ? ' class="' + i + " language-" + i + '"' : "") + ">" + (a = (a = (a = o.subParser("detab")(a, t, n)).replace(/^\n+/g, "")).replace(/\n+$/g, "")) + s + "</code></pre>", a = o.subParser("hashBlock")(a, t, n), "\n\n¨G" + (n.ghCodeBlocks.push({
                            text: e,
                            codeblock: a
                        }) - 1) + "G\n\n"
                    }))).replace(/¨0/, ""), n.converter._dispatch("githubCodeBlocks.after", e, t, n)) : e
                })), o.subParser("hashBlock", (function (e, t, n) {
                    "use strict";
                    return e = (e = n.converter._dispatch("hashBlock.before", e, t, n)).replace(/(^\n+|\n+$)/g, ""), e = "\n\n¨K" + (n.gHtmlBlocks.push(e) - 1) + "K\n\n", e = n.converter._dispatch("hashBlock.after", e, t, n)
                })), o.subParser("hashCodeTags", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("hashCodeTags.before", e, t, n);
                    return e = o.helper.replaceRecursiveRegExp(e, (function (e, r, i, a) {
                        var s = i + o.subParser("encodeCode")(r, t, n) + a;
                        return "¨C" + (n.gHtmlSpans.push(s) - 1) + "C"
                    }), "<code\\b[^>]*>", "</code>", "gim"), e = n.converter._dispatch("hashCodeTags.after", e, t, n)
                })), o.subParser("hashElement", (function (e, t, n) {
                    "use strict";
                    return function (e, t) {
                        var r = t;
                        return r = (r = (r = r.replace(/\n\n/g, "\n")).replace(/^\n/, "")).replace(/\n+$/g, ""), r = "\n\n¨K" + (n.gHtmlBlocks.push(r) - 1) + "K\n\n"
                    }
                })), o.subParser("hashHTMLBlocks", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("hashHTMLBlocks.before", e, t, n);
                    var r = ["pre", "div", "h1", "h2", "h3", "h4", "h5", "h6", "blockquote", "table", "dl", "ol", "ul", "script", "noscript", "form", "fieldset", "iframe", "math", "style", "section", "header", "footer", "nav", "article", "aside", "address", "audio", "canvas", "figure", "hgroup", "output", "video", "p"],
                        i = function (e, t, r, i) {
                            var o = e;
                            return -1 !== r.search(/\bmarkdown\b/) && (o = r + n.converter.makeHtml(t) + i), "\n\n¨K" + (n.gHtmlBlocks.push(o) - 1) + "K\n\n"
                        };
                    t.backslashEscapesHTMLTags && (e = e.replace(/\\<(\/?[^>]+?)>/g, (function (e, t) {
                        return "&lt;" + t + "&gt;"
                    })));
                    for (var a = 0; a < r.length; ++a) for (var s, l = new RegExp("^ {0,3}(<" + r[a] + "\\b[^>]*>)", "im"), c = "<" + r[a] + "\\b[^>]*>", u = "</" + r[a] + ">"; -1 !== (s = o.helper.regexIndexOf(e, l));) {
                        var d = o.helper.splitAtIndex(e, s), p = o.helper.replaceRecursiveRegExp(d[1], i, c, u, "im");
                        if (p === d[1]) break;
                        e = d[0].concat(p)
                    }
                    return e = e.replace(/(\n {0,3}(<(hr)\b([^<>])*?\/?>)[ \t]*(?=\n{2,}))/g, o.subParser("hashElement")(e, t, n)), e = (e = o.helper.replaceRecursiveRegExp(e, (function (e) {
                        return "\n\n¨K" + (n.gHtmlBlocks.push(e) - 1) + "K\n\n"
                    }), "^ {0,3}\x3c!--", "--\x3e", "gm")).replace(/(?:\n\n)( {0,3}(?:<([?%])[^\r]*?\2>)[ \t]*(?=\n{2,}))/g, o.subParser("hashElement")(e, t, n)), e = n.converter._dispatch("hashHTMLBlocks.after", e, t, n)
                })), o.subParser("hashHTMLSpans", (function (e, t, n) {
                    "use strict";

                    function r(e) {
                        return "¨C" + (n.gHtmlSpans.push(e) - 1) + "C"
                    }

                    return e = (e = (e = (e = (e = n.converter._dispatch("hashHTMLSpans.before", e, t, n)).replace(/<[^>]+?\/>/gi, (function (e) {
                        return r(e)
                    }))).replace(/<([^>]+?)>[\s\S]*?<\/\1>/g, (function (e) {
                        return r(e)
                    }))).replace(/<([^>]+?)\s[^>]+?>[\s\S]*?<\/\1>/g, (function (e) {
                        return r(e)
                    }))).replace(/<[^>]+?>/gi, (function (e) {
                        return r(e)
                    })), e = n.converter._dispatch("hashHTMLSpans.after", e, t, n)
                })), o.subParser("unhashHTMLSpans", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("unhashHTMLSpans.before", e, t, n);
                    for (var r = 0; r < n.gHtmlSpans.length; ++r) {
                        for (var i = n.gHtmlSpans[r], o = 0; /¨C(\d+)C/.test(i);) {
                            var a = RegExp.$1;
                            if (i = i.replace("¨C" + a + "C", n.gHtmlSpans[a]), 10 === o) {
                                console.error("maximum nesting of 10 spans reached!!!");
                                break
                            }
                            ++o
                        }
                        e = e.replace("¨C" + r + "C", i)
                    }
                    return e = n.converter._dispatch("unhashHTMLSpans.after", e, t, n)
                })), o.subParser("hashPreCodeTags", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("hashPreCodeTags.before", e, t, n);
                    return e = o.helper.replaceRecursiveRegExp(e, (function (e, r, i, a) {
                        var s = i + o.subParser("encodeCode")(r, t, n) + a;
                        return "\n\n¨G" + (n.ghCodeBlocks.push({text: e, codeblock: s}) - 1) + "G\n\n"
                    }), "^ {0,3}<pre\\b[^>]*>\\s*<code\\b[^>]*>", "^ {0,3}</code>\\s*</pre>", "gim"), e = n.converter._dispatch("hashPreCodeTags.after", e, t, n)
                })), o.subParser("headers", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("headers.before", e, t, n);
                    var r = isNaN(parseInt(t.headerLevelStart)) ? 1 : parseInt(t.headerLevelStart),
                        i = t.smoothLivePreview ? /^(.+)[ \t]*\n={2,}[ \t]*\n+/gm : /^(.+)[ \t]*\n=+[ \t]*\n+/gm,
                        a = t.smoothLivePreview ? /^(.+)[ \t]*\n-{2,}[ \t]*\n+/gm : /^(.+)[ \t]*\n-+[ \t]*\n+/gm;
                    e = (e = e.replace(i, (function (e, i) {
                        var a = o.subParser("spanGamut")(i, t, n), s = t.noHeaderId ? "" : ' id="' + l(i) + '"',
                            c = "<h" + r + s + ">" + a + "</h" + r + ">";
                        return o.subParser("hashBlock")(c, t, n)
                    }))).replace(a, (function (e, i) {
                        var a = o.subParser("spanGamut")(i, t, n), s = t.noHeaderId ? "" : ' id="' + l(i) + '"',
                            c = r + 1, u = "<h" + c + s + ">" + a + "</h" + c + ">";
                        return o.subParser("hashBlock")(u, t, n)
                    }));
                    var s = t.requireSpaceBeforeHeadingText ? /^(#{1,6})[ \t]+(.+?)[ \t]*#*\n+/gm : /^(#{1,6})[ \t]*(.+?)[ \t]*#*\n+/gm;

                    function l(e) {
                        var r, i;
                        if (t.customizedHeaderId) {
                            var a = e.match(/\{([^{]+?)}\s*$/);
                            a && a[1] && (e = a[1])
                        }
                        return r = e, i = o.helper.isString(t.prefixHeaderId) ? t.prefixHeaderId : !0 === t.prefixHeaderId ? "section-" : "", t.rawPrefixHeaderId || (r = i + r), r = t.ghCompatibleHeaderId ? r.replace(/ /g, "-").replace(/&amp;/g, "").replace(/¨T/g, "").replace(/¨D/g, "").replace(/[&+$,\/:;=?@"#{}|^¨~\[\]`\\*)(%.!'<>]/g, "").toLowerCase() : t.rawHeaderId ? r.replace(/ /g, "-").replace(/&amp;/g, "&").replace(/¨T/g, "¨").replace(/¨D/g, "$").replace(/["']/g, "-").toLowerCase() : r.replace(/[^\w]/g, "").toLowerCase(), t.rawPrefixHeaderId && (r = i + r), n.hashLinkCounts[r] ? r = r + "-" + n.hashLinkCounts[r]++ : n.hashLinkCounts[r] = 1, r
                    }

                    return e = e.replace(s, (function (e, i, a) {
                        var s = a;
                        t.customizedHeaderId && (s = a.replace(/\s?\{([^{]+?)}\s*$/, ""));
                        var c = o.subParser("spanGamut")(s, t, n), u = t.noHeaderId ? "" : ' id="' + l(a) + '"',
                            d = r - 1 + i.length, p = "<h" + d + u + ">" + c + "</h" + d + ">";
                        return o.subParser("hashBlock")(p, t, n)
                    })), e = n.converter._dispatch("headers.after", e, t, n)
                })), o.subParser("horizontalRule", (function (e, t, n) {
                    "use strict";
                    e = n.converter._dispatch("horizontalRule.before", e, t, n);
                    var r = o.subParser("hashBlock")("<hr />", t, n);
                    return e = (e = (e = e.replace(/^ {0,2}( ?-){3,}[ \t]*$/gm, r)).replace(/^ {0,2}( ?\*){3,}[ \t]*$/gm, r)).replace(/^ {0,2}( ?_){3,}[ \t]*$/gm, r), e = n.converter._dispatch("horizontalRule.after", e, t, n)
                })), o.subParser("images", (function (e, t, n) {
                    "use strict";

                    function r(e, t, r, i, a, s, l, c) {
                        var u = n.gUrls, d = n.gTitles, p = n.gDimensions;
                        if (r = r.toLowerCase(), c || (c = ""), e.search(/\(<?\s*>? ?(['"].*['"])?\)$/m) > -1) i = ""; else if ("" === i || null === i) {
                            if ("" !== r && null !== r || (r = t.toLowerCase().replace(/ ?\n/g, " ")), i = "#" + r, o.helper.isUndefined(u[r])) return e;
                            i = u[r], o.helper.isUndefined(d[r]) || (c = d[r]), o.helper.isUndefined(p[r]) || (a = p[r].width, s = p[r].height)
                        }
                        t = t.replace(/"/g, "&quot;").replace(o.helper.regexes.asteriskDashAndColon, o.helper.escapeCharactersCallback);
                        var h = '<img src="' + (i = i.replace(o.helper.regexes.asteriskDashAndColon, o.helper.escapeCharactersCallback)) + '" alt="' + t + '"';
                        return c && o.helper.isString(c) && (h += ' title="' + (c = c.replace(/"/g, "&quot;").replace(o.helper.regexes.asteriskDashAndColon, o.helper.escapeCharactersCallback)) + '"'), a && s && (h += ' width="' + (a = "*" === a ? "auto" : a) + '"', h += ' height="' + (s = "*" === s ? "auto" : s) + '"'), h += " />"
                    }

                    return e = (e = (e = (e = (e = (e = n.converter._dispatch("images.before", e, t, n)).replace(/!\[([^\]]*?)] ?(?:\n *)?\[([\s\S]*?)]()()()()()/g, r)).replace(/!\[([^\]]*?)][ \t]*()\([ \t]?<?(data:.+?\/.+?;base64,[A-Za-z0-9+/=\n]+?)>?(?: =([*\d]+[A-Za-z%]{0,4})x([*\d]+[A-Za-z%]{0,4}))?[ \t]*(?:(["'])([^"]*?)\6)?[ \t]?\)/g, (function (e, t, n, i, o, a, s, l) {
                        return r(e, t, n, i = i.replace(/\s/g, ""), o, a, s, l)
                    }))).replace(/!\[([^\]]*?)][ \t]*()\([ \t]?<([^>]*)>(?: =([*\d]+[A-Za-z%]{0,4})x([*\d]+[A-Za-z%]{0,4}))?[ \t]*(?:(?:(["'])([^"]*?)\6))?[ \t]?\)/g, r)).replace(/!\[([^\]]*?)][ \t]*()\([ \t]?<?([\S]+?(?:\([\S]*?\)[\S]*?)?)>?(?: =([*\d]+[A-Za-z%]{0,4})x([*\d]+[A-Za-z%]{0,4}))?[ \t]*(?:(["'])([^"]*?)\6)?[ \t]?\)/g, r)).replace(/!\[([^\[\]]+)]()()()()()/g, r), e = n.converter._dispatch("images.after", e, t, n)
                })), o.subParser("italicsAndBold", (function (e, t, n) {
                    "use strict";

                    function r(e, t, n) {
                        return t + e + n
                    }

                    return e = n.converter._dispatch("italicsAndBold.before", e, t, n), e = t.literalMidWordUnderscores ? (e = (e = e.replace(/\b___(\S[\s\S]*?)___\b/g, (function (e, t) {
                        return r(t, "<strong><em>", "</em></strong>")
                    }))).replace(/\b__(\S[\s\S]*?)__\b/g, (function (e, t) {
                        return r(t, "<strong>", "</strong>")
                    }))).replace(/\b_(\S[\s\S]*?)_\b/g, (function (e, t) {
                        return r(t, "<em>", "</em>")
                    })) : (e = (e = e.replace(/___(\S[\s\S]*?)___/g, (function (e, t) {
                        return /\S$/.test(t) ? r(t, "<strong><em>", "</em></strong>") : e
                    }))).replace(/__(\S[\s\S]*?)__/g, (function (e, t) {
                        return /\S$/.test(t) ? r(t, "<strong>", "</strong>") : e
                    }))).replace(/_([^\s_][\s\S]*?)_/g, (function (e, t) {
                        return /\S$/.test(t) ? r(t, "<em>", "</em>") : e
                    })), e = t.literalMidWordAsterisks ? (e = (e = e.replace(/([^*]|^)\B\*\*\*(\S[\s\S]*?)\*\*\*\B(?!\*)/g, (function (e, t, n) {
                        return r(n, t + "<strong><em>", "</em></strong>")
                    }))).replace(/([^*]|^)\B\*\*(\S[\s\S]*?)\*\*\B(?!\*)/g, (function (e, t, n) {
                        return r(n, t + "<strong>", "</strong>")
                    }))).replace(/([^*]|^)\B\*(\S[\s\S]*?)\*\B(?!\*)/g, (function (e, t, n) {
                        return r(n, t + "<em>", "</em>")
                    })) : (e = (e = e.replace(/\*\*\*(\S[\s\S]*?)\*\*\*/g, (function (e, t) {
                        return /\S$/.test(t) ? r(t, "<strong><em>", "</em></strong>") : e
                    }))).replace(/\*\*(\S[\s\S]*?)\*\*/g, (function (e, t) {
                        return /\S$/.test(t) ? r(t, "<strong>", "</strong>") : e
                    }))).replace(/\*([^\s*][\s\S]*?)\*/g, (function (e, t) {
                        return /\S$/.test(t) ? r(t, "<em>", "</em>") : e
                    })), e = n.converter._dispatch("italicsAndBold.after", e, t, n)
                })), o.subParser("lists", (function (e, t, n) {
                    "use strict";

                    function r(e, r) {
                        n.gListLevel++, e = e.replace(/\n{2,}$/, "\n");
                        var i = /(\n)?(^ {0,3})([*+-]|\d+[.])[ \t]+((\[(x|X| )?])?[ \t]*[^\r]+?(\n{1,2}))(?=\n*(¨0| {0,3}([*+-]|\d+[.])[ \t]+))/gm,
                            a = /\n[ \t]*\n(?!¨0)/.test(e += "¨0");
                        return t.disableForced4SpacesIndentedSublists && (i = /(\n)?(^ {0,3})([*+-]|\d+[.])[ \t]+((\[(x|X| )?])?[ \t]*[^\r]+?(\n{1,2}))(?=\n*(¨0|\2([*+-]|\d+[.])[ \t]+))/gm), e = (e = e.replace(i, (function (e, r, i, s, l, c, u) {
                            u = u && "" !== u.trim();
                            var d = o.subParser("outdent")(l, t, n), p = "";
                            return c && t.tasklists && (p = ' class="task-list-item" style="list-style-type: none;"', d = d.replace(/^[ \t]*\[(x|X| )?]/m, (function () {
                                var e = '<input type="checkbox" disabled style="margin: 0px 0.35em 0.25em -1.6em; vertical-align: middle;"';
                                return u && (e += " checked"), e += ">"
                            }))), d = d.replace(/^([-*+]|\d\.)[ \t]+[\S\n ]*/g, (function (e) {
                                return "¨A" + e
                            })), r || d.search(/\n{2,}/) > -1 ? (d = o.subParser("githubCodeBlocks")(d, t, n), d = o.subParser("blockGamut")(d, t, n)) : (d = (d = o.subParser("lists")(d, t, n)).replace(/\n$/, ""), d = (d = o.subParser("hashHTMLBlocks")(d, t, n)).replace(/\n\n+/g, "\n\n"), d = a ? o.subParser("paragraphs")(d, t, n) : o.subParser("spanGamut")(d, t, n)), d = "<li" + p + ">" + (d = d.replace("¨A", "")) + "</li>\n"
                        }))).replace(/¨0/g, ""), n.gListLevel--, r && (e = e.replace(/\s+$/, "")), e
                    }

                    function i(e, t) {
                        if ("ol" === t) {
                            var n = e.match(/^ *(\d+)\./);
                            if (n && "1" !== n[1]) return ' start="' + n[1] + '"'
                        }
                        return ""
                    }

                    function a(e, n, o) {
                        var a = t.disableForced4SpacesIndentedSublists ? /^ ?\d+\.[ \t]/gm : /^ {0,3}\d+\.[ \t]/gm,
                            s = t.disableForced4SpacesIndentedSublists ? /^ ?[*+-][ \t]/gm : /^ {0,3}[*+-][ \t]/gm,
                            l = "ul" === n ? a : s, c = "";
                        if (-1 !== e.search(l)) !function t(u) {
                            var d = u.search(l), p = i(e, n);
                            -1 !== d ? (c += "\n\n<" + n + p + ">\n" + r(u.slice(0, d), !!o) + "</" + n + ">\n", l = "ul" === (n = "ul" === n ? "ol" : "ul") ? a : s, t(u.slice(d))) : c += "\n\n<" + n + p + ">\n" + r(u, !!o) + "</" + n + ">\n"
                        }(e); else {
                            var u = i(e, n);
                            c = "\n\n<" + n + u + ">\n" + r(e, !!o) + "</" + n + ">\n"
                        }
                        return c
                    }

                    return e = n.converter._dispatch("lists.before", e, t, n), e += "¨0", e = (e = n.gListLevel ? e.replace(/^(( {0,3}([*+-]|\d+[.])[ \t]+)[^\r]+?(¨0|\n{2,}(?=\S)(?![ \t]*(?:[*+-]|\d+[.])[ \t]+)))/gm, (function (e, t, n) {
                        return a(t, n.search(/[*+-]/g) > -1 ? "ul" : "ol", !0)
                    })) : e.replace(/(\n\n|^\n?)(( {0,3}([*+-]|\d+[.])[ \t]+)[^\r]+?(¨0|\n{2,}(?=\S)(?![ \t]*(?:[*+-]|\d+[.])[ \t]+)))/gm, (function (e, t, n, r) {
                        return a(n, r.search(/[*+-]/g) > -1 ? "ul" : "ol", !1)
                    }))).replace(/¨0/, ""), e = n.converter._dispatch("lists.after", e, t, n)
                })), o.subParser("metadata", (function (e, t, n) {
                    "use strict";
                    if (!t.metadata) return e;

                    function r(e) {
                        n.metadata.raw = e, (e = (e = e.replace(/&/g, "&amp;").replace(/"/g, "&quot;")).replace(/\n {4}/g, " ")).replace(/^([\S ]+): +([\s\S]+?)$/gm, (function (e, t, r) {
                            return n.metadata.parsed[t] = r, ""
                        }))
                    }

                    return e = (e = (e = (e = n.converter._dispatch("metadata.before", e, t, n)).replace(/^\s*«««+(\S*?)\n([\s\S]+?)\n»»»+\n/, (function (e, t, n) {
                        return r(n), "¨M"
                    }))).replace(/^\s*---+(\S*?)\n([\s\S]+?)\n---+\n/, (function (e, t, i) {
                        return t && (n.metadata.format = t), r(i), "¨M"
                    }))).replace(/¨M/g, ""), e = n.converter._dispatch("metadata.after", e, t, n)
                })), o.subParser("outdent", (function (e, t, n) {
                    "use strict";
                    return e = (e = (e = n.converter._dispatch("outdent.before", e, t, n)).replace(/^(\t|[ ]{1,4})/gm, "¨0")).replace(/¨0/g, ""), e = n.converter._dispatch("outdent.after", e, t, n)
                })), o.subParser("paragraphs", (function (e, t, n) {
                    "use strict";
                    for (var r = (e = (e = (e = n.converter._dispatch("paragraphs.before", e, t, n)).replace(/^\n+/g, "")).replace(/\n+$/g, "")).split(/\n{2,}/g), i = [], a = r.length, s = 0; s < a; s++) {
                        var l = r[s];
                        l.search(/¨(K|G)(\d+)\1/g) >= 0 ? i.push(l) : l.search(/\S/) >= 0 && (l = (l = o.subParser("spanGamut")(l, t, n)).replace(/^([ \t]*)/g, "<p>"), l += "</p>", i.push(l))
                    }
                    for (a = i.length, s = 0; s < a; s++) {
                        for (var c = "", u = i[s], d = !1; /¨(K|G)(\d+)\1/.test(u);) {
                            var p = RegExp.$1, h = RegExp.$2;
                            c = (c = "K" === p ? n.gHtmlBlocks[h] : d ? o.subParser("encodeCode")(n.ghCodeBlocks[h].text, t, n) : n.ghCodeBlocks[h].codeblock).replace(/\$/g, "$$$$"), u = u.replace(/(\n\n)?¨(K|G)\d+\2(\n\n)?/, c), /^<pre\b[^>]*>\s*<code\b[^>]*>/.test(u) && (d = !0)
                        }
                        i[s] = u
                    }
                    return e = (e = (e = i.join("\n")).replace(/^\n+/g, "")).replace(/\n+$/g, ""), n.converter._dispatch("paragraphs.after", e, t, n)
                })), o.subParser("runExtension", (function (e, t, n, r) {
                    "use strict";
                    if (e.filter) t = e.filter(t, r.converter, n); else if (e.regex) {
                        var i = e.regex;
                        i instanceof RegExp || (i = new RegExp(i, "g")), t = t.replace(i, e.replace)
                    }
                    return t
                })), o.subParser("spanGamut", (function (e, t, n) {
                    "use strict";
                    return e = n.converter._dispatch("spanGamut.before", e, t, n), e = o.subParser("codeSpans")(e, t, n), e = o.subParser("escapeSpecialCharsWithinTagAttributes")(e, t, n), e = o.subParser("encodeBackslashEscapes")(e, t, n), e = o.subParser("images")(e, t, n), e = o.subParser("anchors")(e, t, n), e = o.subParser("autoLinks")(e, t, n), e = o.subParser("simplifiedAutoLinks")(e, t, n), e = o.subParser("emoji")(e, t, n), e = o.subParser("underline")(e, t, n), e = o.subParser("italicsAndBold")(e, t, n), e = o.subParser("strikethrough")(e, t, n), e = o.subParser("ellipsis")(e, t, n), e = o.subParser("hashHTMLSpans")(e, t, n), e = o.subParser("encodeAmpsAndAngles")(e, t, n), t.simpleLineBreaks ? /\n\n¨K/.test(e) || (e = e.replace(/\n+/g, "<br />\n")) : e = e.replace(/  +\n/g, "<br />\n"), e = n.converter._dispatch("spanGamut.after", e, t, n)
                })), o.subParser("strikethrough", (function (e, t, n) {
                    "use strict";
                    return t.strikethrough && (e = (e = n.converter._dispatch("strikethrough.before", e, t, n)).replace(/(?:~){2}([\s\S]+?)(?:~){2}/g, (function (e, r) {
                        return function (e) {
                            return t.simplifiedAutoLink && (e = o.subParser("simplifiedAutoLinks")(e, t, n)), "<del>" + e + "</del>"
                        }(r)
                    })), e = n.converter._dispatch("strikethrough.after", e, t, n)), e
                })), o.subParser("stripLinkDefinitions", (function (e, t, n) {
                    "use strict";
                    var r = function (e, r, i, a, s, l, c) {
                        return r = r.toLowerCase(), i.match(/^data:.+?\/.+?;base64,/) ? n.gUrls[r] = i.replace(/\s/g, "") : n.gUrls[r] = o.subParser("encodeAmpsAndAngles")(i, t, n), l ? l + c : (c && (n.gTitles[r] = c.replace(/"|'/g, "&quot;")), t.parseImgDimensions && a && s && (n.gDimensions[r] = {
                            width: a,
                            height: s
                        }), "")
                    };
                    return e = (e = (e = (e += "¨0").replace(/^ {0,3}\[(.+)]:[ \t]*\n?[ \t]*<?(data:.+?\/.+?;base64,[A-Za-z0-9+/=\n]+?)>?(?: =([*\d]+[A-Za-z%]{0,4})x([*\d]+[A-Za-z%]{0,4}))?[ \t]*\n?[ \t]*(?:(\n*)["|'(](.+?)["|')][ \t]*)?(?:\n\n|(?=¨0)|(?=\n\[))/gm, r)).replace(/^ {0,3}\[(.+)]:[ \t]*\n?[ \t]*<?([^>\s]+)>?(?: =([*\d]+[A-Za-z%]{0,4})x([*\d]+[A-Za-z%]{0,4}))?[ \t]*\n?[ \t]*(?:(\n*)["|'(](.+?)["|')][ \t]*)?(?:\n+|(?=¨0))/gm, r)).replace(/¨0/, "")
                })), o.subParser("tables", (function (e, t, n) {
                    "use strict";
                    if (!t.tables) return e;

                    function r(e, r) {
                        return "<td" + r + ">" + o.subParser("spanGamut")(e, t, n) + "</td>\n"
                    }

                    function i(e) {
                        var i, a = e.split("\n");
                        for (i = 0; i < a.length; ++i) /^ {0,3}\|/.test(a[i]) && (a[i] = a[i].replace(/^ {0,3}\|/, "")), /\|[ \t]*$/.test(a[i]) && (a[i] = a[i].replace(/\|[ \t]*$/, "")), a[i] = o.subParser("codeSpans")(a[i], t, n);
                        var s, l, c, u, d = a[0].split("|").map((function (e) {
                            return e.trim()
                        })), p = a[1].split("|").map((function (e) {
                            return e.trim()
                        })), h = [], f = [], g = [], m = [];
                        for (a.shift(), a.shift(), i = 0; i < a.length; ++i) "" !== a[i].trim() && h.push(a[i].split("|").map((function (e) {
                            return e.trim()
                        })));
                        if (d.length < p.length) return e;
                        for (i = 0; i < p.length; ++i) g.push((s = p[i], /^:[ \t]*--*$/.test(s) ? ' style="text-align:left;"' : /^--*[ \t]*:[ \t]*$/.test(s) ? ' style="text-align:right;"' : /^:[ \t]*--*[ \t]*:$/.test(s) ? ' style="text-align:center;"' : ""));
                        for (i = 0; i < d.length; ++i) o.helper.isUndefined(g[i]) && (g[i] = ""), f.push((l = d[i], c = g[i], u = void 0, u = "", l = l.trim(), (t.tablesHeaderId || t.tableHeaderId) && (u = ' id="' + l.replace(/ /g, "_").toLowerCase() + '"'), "<th" + u + c + ">" + (l = o.subParser("spanGamut")(l, t, n)) + "</th>\n"));
                        for (i = 0; i < h.length; ++i) {
                            for (var v = [], b = 0; b < f.length; ++b) o.helper.isUndefined(h[i][b]), v.push(r(h[i][b], g[b]));
                            m.push(v)
                        }
                        return function (e, t) {
                            for (var n = "<table>\n<thead>\n<tr>\n", r = e.length, i = 0; i < r; ++i) n += e[i];
                            for (n += "</tr>\n</thead>\n<tbody>\n", i = 0; i < t.length; ++i) {
                                n += "<tr>\n";
                                for (var o = 0; o < r; ++o) n += t[i][o];
                                n += "</tr>\n"
                            }
                            return n + "</tbody>\n</table>\n"
                        }(f, m)
                    }

                    return e = (e = (e = (e = n.converter._dispatch("tables.before", e, t, n)).replace(/\\(\|)/g, o.helper.escapeCharactersCallback)).replace(/^ {0,3}\|?.+\|.+\n {0,3}\|?[ \t]*:?[ \t]*(?:[-=]){2,}[ \t]*:?[ \t]*\|[ \t]*:?[ \t]*(?:[-=]){2,}[\s\S]+?(?:\n\n|¨0)/gm, i)).replace(/^ {0,3}\|.+\|[ \t]*\n {0,3}\|[ \t]*:?[ \t]*(?:[-=]){2,}[ \t]*:?[ \t]*\|[ \t]*\n( {0,3}\|.+\|[ \t]*\n)*(?:\n|¨0)/gm, i), e = n.converter._dispatch("tables.after", e, t, n)
                })), o.subParser("underline", (function (e, t, n) {
                    "use strict";
                    return t.underline ? (e = n.converter._dispatch("underline.before", e, t, n), e = (e = t.literalMidWordUnderscores ? (e = e.replace(/\b___(\S[\s\S]*?)___\b/g, (function (e, t) {
                        return "<u>" + t + "</u>"
                    }))).replace(/\b__(\S[\s\S]*?)__\b/g, (function (e, t) {
                        return "<u>" + t + "</u>"
                    })) : (e = e.replace(/___(\S[\s\S]*?)___/g, (function (e, t) {
                        return /\S$/.test(t) ? "<u>" + t + "</u>" : e
                    }))).replace(/__(\S[\s\S]*?)__/g, (function (e, t) {
                        return /\S$/.test(t) ? "<u>" + t + "</u>" : e
                    }))).replace(/(_)/g, o.helper.escapeCharactersCallback), e = n.converter._dispatch("underline.after", e, t, n)) : e
                })), o.subParser("unescapeSpecialChars", (function (e, t, n) {
                    "use strict";
                    return e = (e = n.converter._dispatch("unescapeSpecialChars.before", e, t, n)).replace(/¨E(\d+)E/g, (function (e, t) {
                        var n = parseInt(t);
                        return String.fromCharCode(n)
                    })), e = n.converter._dispatch("unescapeSpecialChars.after", e, t, n)
                })), o.subParser("makeMarkdown.blockquote", (function (e, t) {
                    "use strict";
                    var n = "";
                    if (e.hasChildNodes()) for (var r = e.childNodes, i = r.length, a = 0; a < i; ++a) {
                        var s = o.subParser("makeMarkdown.node")(r[a], t);
                        "" !== s && (n += s)
                    }
                    return n = "> " + (n = n.trim()).split("\n").join("\n> ")
                })), o.subParser("makeMarkdown.codeBlock", (function (e, t) {
                    "use strict";
                    var n = e.getAttribute("language"), r = e.getAttribute("precodenum");
                    return "```" + n + "\n" + t.preList[r] + "\n```"
                })), o.subParser("makeMarkdown.codeSpan", (function (e) {
                    "use strict";
                    return "`" + e.innerHTML + "`"
                })), o.subParser("makeMarkdown.emphasis", (function (e, t) {
                    "use strict";
                    var n = "";
                    if (e.hasChildNodes()) {
                        n += "*";
                        for (var r = e.childNodes, i = r.length, a = 0; a < i; ++a) n += o.subParser("makeMarkdown.node")(r[a], t);
                        n += "*"
                    }
                    return n
                })), o.subParser("makeMarkdown.header", (function (e, t, n) {
                    "use strict";
                    var r = new Array(n + 1).join("#"), i = "";
                    if (e.hasChildNodes()) {
                        i = r + " ";
                        for (var a = e.childNodes, s = a.length, l = 0; l < s; ++l) i += o.subParser("makeMarkdown.node")(a[l], t)
                    }
                    return i
                })), o.subParser("makeMarkdown.hr", (function () {
                    "use strict";
                    return "---"
                })), o.subParser("makeMarkdown.image", (function (e) {
                    "use strict";
                    var t = "";
                    return e.hasAttribute("src") && (t += "![" + e.getAttribute("alt") + "](", t += "<" + e.getAttribute("src") + ">", e.hasAttribute("width") && e.hasAttribute("height") && (t += " =" + e.getAttribute("width") + "x" + e.getAttribute("height")), e.hasAttribute("title") && (t += ' "' + e.getAttribute("title") + '"'), t += ")"), t
                })), o.subParser("makeMarkdown.links", (function (e, t) {
                    "use strict";
                    var n = "";
                    if (e.hasChildNodes() && e.hasAttribute("href")) {
                        var r = e.childNodes, i = r.length;
                        n = "[";
                        for (var a = 0; a < i; ++a) n += o.subParser("makeMarkdown.node")(r[a], t);
                        n += "](", n += "<" + e.getAttribute("href") + ">", e.hasAttribute("title") && (n += ' "' + e.getAttribute("title") + '"'), n += ")"
                    }
                    return n
                })), o.subParser("makeMarkdown.list", (function (e, t, n) {
                    "use strict";
                    var r = "";
                    if (!e.hasChildNodes()) return "";
                    for (var i = e.childNodes, a = i.length, s = e.getAttribute("start") || 1, l = 0; l < a; ++l) if (void 0 !== i[l].tagName && "li" === i[l].tagName.toLowerCase()) {
                        r += ("ol" === n ? s.toString() + ". " : "- ") + o.subParser("makeMarkdown.listItem")(i[l], t), ++s
                    }
                    return (r += "\n\x3c!-- --\x3e\n").trim()
                })), o.subParser("makeMarkdown.listItem", (function (e, t) {
                    "use strict";
                    for (var n = "", r = e.childNodes, i = r.length, a = 0; a < i; ++a) n += o.subParser("makeMarkdown.node")(r[a], t);
                    return /\n$/.test(n) ? n = n.split("\n").join("\n    ").replace(/^ {4}$/gm, "").replace(/\n\n+/g, "\n\n") : n += "\n", n
                })), o.subParser("makeMarkdown.node", (function (e, t, n) {
                    "use strict";
                    n = n || !1;
                    var r = "";
                    if (3 === e.nodeType) return o.subParser("makeMarkdown.txt")(e, t);
                    if (8 === e.nodeType) return "\x3c!--" + e.data + "--\x3e\n\n";
                    if (1 !== e.nodeType) return "";
                    switch (e.tagName.toLowerCase()) {
                        case"h1":
                            n || (r = o.subParser("makeMarkdown.header")(e, t, 1) + "\n\n");
                            break;
                        case"h2":
                            n || (r = o.subParser("makeMarkdown.header")(e, t, 2) + "\n\n");
                            break;
                        case"h3":
                            n || (r = o.subParser("makeMarkdown.header")(e, t, 3) + "\n\n");
                            break;
                        case"h4":
                            n || (r = o.subParser("makeMarkdown.header")(e, t, 4) + "\n\n");
                            break;
                        case"h5":
                            n || (r = o.subParser("makeMarkdown.header")(e, t, 5) + "\n\n");
                            break;
                        case"h6":
                            n || (r = o.subParser("makeMarkdown.header")(e, t, 6) + "\n\n");
                            break;
                        case"p":
                            n || (r = o.subParser("makeMarkdown.paragraph")(e, t) + "\n\n");
                            break;
                        case"blockquote":
                            n || (r = o.subParser("makeMarkdown.blockquote")(e, t) + "\n\n");
                            break;
                        case"hr":
                            n || (r = o.subParser("makeMarkdown.hr")(e, t) + "\n\n");
                            break;
                        case"ol":
                            n || (r = o.subParser("makeMarkdown.list")(e, t, "ol") + "\n\n");
                            break;
                        case"ul":
                            n || (r = o.subParser("makeMarkdown.list")(e, t, "ul") + "\n\n");
                            break;
                        case"precode":
                            n || (r = o.subParser("makeMarkdown.codeBlock")(e, t) + "\n\n");
                            break;
                        case"pre":
                            n || (r = o.subParser("makeMarkdown.pre")(e, t) + "\n\n");
                            break;
                        case"table":
                            n || (r = o.subParser("makeMarkdown.table")(e, t) + "\n\n");
                            break;
                        case"code":
                            r = o.subParser("makeMarkdown.codeSpan")(e, t);
                            break;
                        case"em":
                        case"i":
                            r = o.subParser("makeMarkdown.emphasis")(e, t);
                            break;
                        case"strong":
                        case"b":
                            r = o.subParser("makeMarkdown.strong")(e, t);
                            break;
                        case"del":
                            r = o.subParser("makeMarkdown.strikethrough")(e, t);
                            break;
                        case"a":
                            r = o.subParser("makeMarkdown.links")(e, t);
                            break;
                        case"img":
                            r = o.subParser("makeMarkdown.image")(e, t);
                            break;
                        default:
                            r = e.outerHTML + "\n\n"
                    }
                    return r
                })), o.subParser("makeMarkdown.paragraph", (function (e, t) {
                    "use strict";
                    var n = "";
                    if (e.hasChildNodes()) for (var r = e.childNodes, i = r.length, a = 0; a < i; ++a) n += o.subParser("makeMarkdown.node")(r[a], t);
                    return n = n.trim()
                })), o.subParser("makeMarkdown.pre", (function (e, t) {
                    "use strict";
                    var n = e.getAttribute("prenum");
                    return "<pre>" + t.preList[n] + "</pre>"
                })), o.subParser("makeMarkdown.strikethrough", (function (e, t) {
                    "use strict";
                    var n = "";
                    if (e.hasChildNodes()) {
                        n += "~~";
                        for (var r = e.childNodes, i = r.length, a = 0; a < i; ++a) n += o.subParser("makeMarkdown.node")(r[a], t);
                        n += "~~"
                    }
                    return n
                })), o.subParser("makeMarkdown.strong", (function (e, t) {
                    "use strict";
                    var n = "";
                    if (e.hasChildNodes()) {
                        n += "**";
                        for (var r = e.childNodes, i = r.length, a = 0; a < i; ++a) n += o.subParser("makeMarkdown.node")(r[a], t);
                        n += "**"
                    }
                    return n
                })), o.subParser("makeMarkdown.table", (function (e, t) {
                    "use strict";
                    var n, r, i = "", a = [[], []], s = e.querySelectorAll("thead>tr>th"),
                        l = e.querySelectorAll("tbody>tr");
                    for (n = 0; n < s.length; ++n) {
                        var c = o.subParser("makeMarkdown.tableCell")(s[n], t), u = "---";
                        if (s[n].hasAttribute("style")) switch (s[n].getAttribute("style").toLowerCase().replace(/\s/g, "")) {
                            case"text-align:left;":
                                u = ":---";
                                break;
                            case"text-align:right;":
                                u = "---:";
                                break;
                            case"text-align:center;":
                                u = ":---:"
                        }
                        a[0][n] = c.trim(), a[1][n] = u
                    }
                    for (n = 0; n < l.length; ++n) {
                        var d = a.push([]) - 1, p = l[n].getElementsByTagName("td");
                        for (r = 0; r < s.length; ++r) {
                            var h = " ";
                            void 0 !== p[r] && (h = o.subParser("makeMarkdown.tableCell")(p[r], t)), a[d].push(h)
                        }
                    }
                    var f = 3;
                    for (n = 0; n < a.length; ++n) for (r = 0; r < a[n].length; ++r) {
                        var g = a[n][r].length;
                        g > f && (f = g)
                    }
                    for (n = 0; n < a.length; ++n) {
                        for (r = 0; r < a[n].length; ++r) 1 === n ? ":" === a[n][r].slice(-1) ? a[n][r] = o.helper.padEnd(a[n][r].slice(-1), f - 1, "-") + ":" : a[n][r] = o.helper.padEnd(a[n][r], f, "-") : a[n][r] = o.helper.padEnd(a[n][r], f);
                        i += "| " + a[n].join(" | ") + " |\n"
                    }
                    return i.trim()
                })), o.subParser("makeMarkdown.tableCell", (function (e, t) {
                    "use strict";
                    var n = "";
                    if (!e.hasChildNodes()) return "";
                    for (var r = e.childNodes, i = r.length, a = 0; a < i; ++a) n += o.subParser("makeMarkdown.node")(r[a], t, !0);
                    return n.trim()
                })), o.subParser("makeMarkdown.txt", (function (e) {
                    "use strict";
                    var t = e.nodeValue;
                    return t = (t = t.replace(/ +/g, " ")).replace(/¨NBSP;/g, " "), t = (t = (t = (t = (t = (t = (t = (t = (t = o.helper.unescapeHTMLEntities(t)).replace(/([*_~|`])/g, "\\$1")).replace(/^(\s*)>/g, "\\$1>")).replace(/^#/gm, "\\#")).replace(/^(\s*)([-=]{3,})(\s*)$/, "$1\\$2$3")).replace(/^( {0,3}\d+)\./gm, "$1\\.")).replace(/^( {0,3})([+-])/gm, "$1\\$2")).replace(/]([\s]*)\(/g, "\\]$1\\(")).replace(/^ {0,3}\[([\S \t]*?)]:/gm, "\\[$1]:")
                }));
                void 0 === (r = function () {
                    "use strict";
                    return o
                }.call(t, n, t, e)) || (e.exports = r)
            }).call(this)
        }, 6455: function (e) {
            e.exports = function () {
                "use strict";

                function e(t) {
                    return e = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
                        return typeof e
                    } : function (e) {
                        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                    }, e(t)
                }

                function t(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }

                function n(e, t) {
                    for (var n = 0; n < t.length; n++) {
                        var r = t[n];
                        r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r)
                    }
                }

                function r(e, t, r) {
                    return t && n(e.prototype, t), r && n(e, r), e
                }

                function i() {
                    return i = Object.assign || function (e) {
                        for (var t = 1; t < arguments.length; t++) {
                            var n = arguments[t];
                            for (var r in n) Object.prototype.hasOwnProperty.call(n, r) && (e[r] = n[r])
                        }
                        return e
                    }, i.apply(this, arguments)
                }

                function o(e, t) {
                    if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            writable: !0,
                            configurable: !0
                        }
                    }), t && s(e, t)
                }

                function a(e) {
                    return a = Object.setPrototypeOf ? Object.getPrototypeOf : function (e) {
                        return e.__proto__ || Object.getPrototypeOf(e)
                    }, a(e)
                }

                function s(e, t) {
                    return s = Object.setPrototypeOf || function (e, t) {
                        return e.__proto__ = t, e
                    }, s(e, t)
                }

                function l() {
                    if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
                    if (Reflect.construct.sham) return !1;
                    if ("function" == typeof Proxy) return !0;
                    try {
                        return Date.prototype.toString.call(Reflect.construct(Date, [], (function () {
                        }))), !0
                    } catch (e) {
                        return !1
                    }
                }

                function c(e, t, n) {
                    return c = l() ? Reflect.construct : function (e, t, n) {
                        var r = [null];
                        r.push.apply(r, t);
                        var i = new (Function.bind.apply(e, r));
                        return n && s(i, n.prototype), i
                    }, c.apply(null, arguments)
                }

                function u(e) {
                    if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return e
                }

                function d(e, t) {
                    return !t || "object" != typeof t && "function" != typeof t ? u(e) : t
                }

                function p(e) {
                    var t = l();
                    return function () {
                        var n, r = a(e);
                        if (t) {
                            var i = a(this).constructor;
                            n = Reflect.construct(r, arguments, i)
                        } else n = r.apply(this, arguments);
                        return d(this, n)
                    }
                }

                function h(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = a(e));) ;
                    return e
                }

                function f(e, t, n) {
                    return f = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function (e, t, n) {
                        var r = h(e, t);
                        if (r) {
                            var i = Object.getOwnPropertyDescriptor(r, t);
                            return i.get ? i.get.call(n) : i.value
                        }
                    }, f(e, t, n || e)
                }

                var g = "SweetAlert2:", m = function (e) {
                        for (var t = [], n = 0; n < e.length; n++) -1 === t.indexOf(e[n]) && t.push(e[n]);
                        return t
                    }, v = function (e) {
                        return e.charAt(0).toUpperCase() + e.slice(1)
                    }, b = function (e) {
                        return Object.keys(e).map((function (t) {
                            return e[t]
                        }))
                    }, w = function (e) {
                        return Array.prototype.slice.call(e)
                    }, y = function (e) {
                        console.warn("".concat(g, " ").concat(e))
                    }, _ = function (e) {
                        console.error("".concat(g, " ").concat(e))
                    }, k = [], x = function (e) {
                        -1 === k.indexOf(e) && (k.push(e), y(e))
                    }, S = function (e, t) {
                        x('"'.concat(e, '" is deprecated and will be removed in the next major release. Please use "').concat(t, '" instead.'))
                    }, C = function (e) {
                        return "function" == typeof e ? e() : e
                    }, E = function (e) {
                        return e && "function" == typeof e.toPromise
                    }, T = function (e) {
                        return E(e) ? e.toPromise() : Promise.resolve(e)
                    }, A = function (e) {
                        return e && Promise.resolve(e) === e
                    }, O = Object.freeze({
                        cancel: "cancel",
                        backdrop: "backdrop",
                        close: "close",
                        esc: "esc",
                        timer: "timer"
                    }), P = function (t) {
                        return "object" === e(t) && t.jquery
                    }, M = function (e) {
                        return e instanceof Element || P(e)
                    }, L = function (t) {
                        var n = {};
                        return "object" !== e(t[0]) || M(t[0]) ? ["title", "html", "icon"].forEach((function (r, i) {
                            var o = t[i];
                            "string" == typeof o || M(o) ? n[r] = o : void 0 !== o && _("Unexpected type of ".concat(r, '! Expected "string" or "Element", got ').concat(e(o)))
                        })) : i(n, t[0]), n
                    }, j = "swal2-", N = function (e) {
                        var t = {};
                        for (var n in e) t[e[n]] = j + e[n];
                        return t
                    },
                    I = N(["container", "shown", "height-auto", "iosfix", "popup", "modal", "no-backdrop", "no-transition", "toast", "toast-shown", "toast-column", "show", "hide", "close", "title", "header", "content", "html-container", "actions", "confirm", "cancel", "footer", "icon", "icon-content", "image", "input", "file", "range", "select", "radio", "checkbox", "label", "textarea", "inputerror", "validation-message", "progress-steps", "active-progress-step", "progress-step", "progress-step-line", "loading", "styled", "top", "top-start", "top-end", "top-left", "top-right", "center", "center-start", "center-end", "center-left", "center-right", "bottom", "bottom-start", "bottom-end", "bottom-left", "bottom-right", "grow-row", "grow-column", "grow-fullscreen", "rtl", "timer-progress-bar", "timer-progress-bar-container", "scrollbar-measure", "icon-success", "icon-warning", "icon-info", "icon-question", "icon-error"]),
                    z = N(["success", "warning", "info", "question", "error"]), R = function () {
                        return document.body.querySelector(".".concat(I.container))
                    }, B = function (e) {
                        var t = R();
                        return t ? t.querySelector(e) : null
                    }, D = function (e) {
                        return B(".".concat(e))
                    }, H = function () {
                        return D(I.popup)
                    }, $ = function () {
                        var e = H();
                        return w(e.querySelectorAll(".".concat(I.icon)))
                    }, q = function () {
                        var e = $().filter((function (e) {
                            return xe(e)
                        }));
                        return e.length ? e[0] : null
                    }, F = function () {
                        return D(I.title)
                    }, U = function () {
                        return D(I.content)
                    }, V = function () {
                        return D(I["html-container"])
                    }, W = function () {
                        return D(I.image)
                    }, G = function () {
                        return D(I["progress-steps"])
                    }, K = function () {
                        return D(I["validation-message"])
                    }, X = function () {
                        return B(".".concat(I.actions, " .").concat(I.confirm))
                    }, Z = function () {
                        return B(".".concat(I.actions, " .").concat(I.cancel))
                    }, Y = function () {
                        return D(I.actions)
                    }, J = function () {
                        return D(I.header)
                    }, Q = function () {
                        return D(I.footer)
                    }, ee = function () {
                        return D(I["timer-progress-bar"])
                    }, te = function () {
                        return D(I.close)
                    },
                    ne = '\n  a[href],\n  area[href],\n  input:not([disabled]),\n  select:not([disabled]),\n  textarea:not([disabled]),\n  button:not([disabled]),\n  iframe,\n  object,\n  embed,\n  [tabindex="0"],\n  [contenteditable],\n  audio[controls],\n  video[controls],\n  summary\n',
                    re = function () {
                        var e = w(H().querySelectorAll('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])')).sort((function (e, t) {
                            return (e = parseInt(e.getAttribute("tabindex"))) > (t = parseInt(t.getAttribute("tabindex"))) ? 1 : e < t ? -1 : 0
                        })), t = w(H().querySelectorAll(ne)).filter((function (e) {
                            return "-1" !== e.getAttribute("tabindex")
                        }));
                        return m(e.concat(t)).filter((function (e) {
                            return xe(e)
                        }))
                    }, ie = function () {
                        return !oe() && !document.body.classList.contains(I["no-backdrop"])
                    }, oe = function () {
                        return document.body.classList.contains(I["toast-shown"])
                    }, ae = function () {
                        return H().hasAttribute("data-loading")
                    }, se = {previousBodyPadding: null}, le = function (e, t) {
                        if (e.textContent = "", t) {
                            var n = (new DOMParser).parseFromString(t, "text/html");
                            w(n.querySelector("head").childNodes).forEach((function (t) {
                                e.appendChild(t)
                            })), w(n.querySelector("body").childNodes).forEach((function (t) {
                                e.appendChild(t)
                            }))
                        }
                    }, ce = function (e, t) {
                        if (!t) return !1;
                        for (var n = t.split(/\s+/), r = 0; r < n.length; r++) if (!e.classList.contains(n[r])) return !1;
                        return !0
                    }, ue = function (e, t) {
                        w(e.classList).forEach((function (n) {
                            -1 === b(I).indexOf(n) && -1 === b(z).indexOf(n) && -1 === b(t.showClass).indexOf(n) && e.classList.remove(n)
                        }))
                    }, de = function (t, n, r) {
                        if (ue(t, n), n.customClass && n.customClass[r]) {
                            if ("string" != typeof n.customClass[r] && !n.customClass[r].forEach) return y("Invalid type of customClass.".concat(r, '! Expected string or iterable object, got "').concat(e(n.customClass[r]), '"'));
                            me(t, n.customClass[r])
                        }
                    };

                function pe(e, t) {
                    if (!t) return null;
                    switch (t) {
                        case"select":
                        case"textarea":
                        case"file":
                            return be(e, I[t]);
                        case"checkbox":
                            return e.querySelector(".".concat(I.checkbox, " input"));
                        case"radio":
                            return e.querySelector(".".concat(I.radio, " input:checked")) || e.querySelector(".".concat(I.radio, " input:first-child"));
                        case"range":
                            return e.querySelector(".".concat(I.range, " input"));
                        default:
                            return be(e, I.input)
                    }
                }

                var he, fe = function (e) {
                        if (e.focus(), "file" !== e.type) {
                            var t = e.value;
                            e.value = "", e.value = t
                        }
                    }, ge = function (e, t, n) {
                        e && t && ("string" == typeof t && (t = t.split(/\s+/).filter(Boolean)), t.forEach((function (t) {
                            e.forEach ? e.forEach((function (e) {
                                n ? e.classList.add(t) : e.classList.remove(t)
                            })) : n ? e.classList.add(t) : e.classList.remove(t)
                        })))
                    }, me = function (e, t) {
                        ge(e, t, !0)
                    }, ve = function (e, t) {
                        ge(e, t, !1)
                    }, be = function (e, t) {
                        for (var n = 0; n < e.childNodes.length; n++) if (ce(e.childNodes[n], t)) return e.childNodes[n]
                    }, we = function (e, t, n) {
                        n || 0 === parseInt(n) ? e.style[t] = "number" == typeof n ? "".concat(n, "px") : n : e.style.removeProperty(t)
                    }, ye = function (e) {
                        var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "flex";
                        e.style.opacity = "", e.style.display = t
                    }, _e = function (e) {
                        e.style.opacity = "", e.style.display = "none"
                    }, ke = function (e, t, n) {
                        t ? ye(e, n) : _e(e)
                    }, xe = function (e) {
                        return !(!e || !(e.offsetWidth || e.offsetHeight || e.getClientRects().length))
                    }, Se = function (e) {
                        return !!(e.scrollHeight > e.clientHeight)
                    }, Ce = function (e) {
                        var t = window.getComputedStyle(e), n = parseFloat(t.getPropertyValue("animation-duration") || "0"),
                            r = parseFloat(t.getPropertyValue("transition-duration") || "0");
                        return n > 0 || r > 0
                    }, Ee = function (e, t) {
                        if ("function" == typeof e.contains) return e.contains(t)
                    }, Te = function (e) {
                        var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1], n = ee();
                        xe(n) && (t && (n.style.transition = "none", n.style.width = "100%"), setTimeout((function () {
                            n.style.transition = "width ".concat(e / 1e3, "s linear"), n.style.width = "0%"
                        }), 10))
                    }, Ae = function () {
                        var e = ee(), t = parseInt(window.getComputedStyle(e).width);
                        e.style.removeProperty("transition"), e.style.width = "100%";
                        var n = parseInt(window.getComputedStyle(e).width), r = parseInt(t / n * 100);
                        e.style.removeProperty("transition"), e.style.width = "".concat(r, "%")
                    }, Oe = function () {
                        return "undefined" == typeof window || "undefined" == typeof document
                    },
                    Pe = '\n <div aria-labelledby="'.concat(I.title, '" aria-describedby="').concat(I.content, '" class="').concat(I.popup, '" tabindex="-1">\n   <div class="').concat(I.header, '">\n     <ul class="').concat(I["progress-steps"], '"></ul>\n     <div class="').concat(I.icon, " ").concat(z.error, '"></div>\n     <div class="').concat(I.icon, " ").concat(z.question, '"></div>\n     <div class="').concat(I.icon, " ").concat(z.warning, '"></div>\n     <div class="').concat(I.icon, " ").concat(z.info, '"></div>\n     <div class="').concat(I.icon, " ").concat(z.success, '"></div>\n     <img class="').concat(I.image, '" />\n     <h2 class="').concat(I.title, '" id="').concat(I.title, '"></h2>\n     <button type="button" class="').concat(I.close, '"></button>\n   </div>\n   <div class="').concat(I.content, '">\n     <div id="').concat(I.content, '" class="').concat(I["html-container"], '"></div>\n     <input class="').concat(I.input, '" />\n     <input type="file" class="').concat(I.file, '" />\n     <div class="').concat(I.range, '">\n       <input type="range" />\n       <output></output>\n     </div>\n     <select class="').concat(I.select, '"></select>\n     <div class="').concat(I.radio, '"></div>\n     <label for="').concat(I.checkbox, '" class="').concat(I.checkbox, '">\n       <input type="checkbox" />\n       <span class="').concat(I.label, '"></span>\n     </label>\n     <textarea class="').concat(I.textarea, '"></textarea>\n     <div class="').concat(I["validation-message"], '" id="').concat(I["validation-message"], '"></div>\n   </div>\n   <div class="').concat(I.actions, '">\n     <button type="button" class="').concat(I.confirm, '">OK</button>\n     <button type="button" class="').concat(I.cancel, '">Cancel</button>\n   </div>\n   <div class="').concat(I.footer, '"></div>\n   <div class="').concat(I["timer-progress-bar-container"], '">\n     <div class="').concat(I["timer-progress-bar"], '"></div>\n   </div>\n </div>\n').replace(/(^|\n)\s*/g, ""),
                    Me = function () {
                        var e = R();
                        return !!e && (e.parentNode.removeChild(e), ve([document.documentElement, document.body], [I["no-backdrop"], I["toast-shown"], I["has-column"]]), !0)
                    }, Le = function (e) {
                        jr.isVisible() && he !== e.target.value && jr.resetValidationMessage(), he = e.target.value
                    }, je = function () {
                        var e = U(), t = be(e, I.input), n = be(e, I.file),
                            r = e.querySelector(".".concat(I.range, " input")),
                            i = e.querySelector(".".concat(I.range, " output")), o = be(e, I.select),
                            a = e.querySelector(".".concat(I.checkbox, " input")), s = be(e, I.textarea);
                        t.oninput = Le, n.onchange = Le, o.onchange = Le, a.onchange = Le, s.oninput = Le, r.oninput = function (e) {
                            Le(e), i.value = r.value
                        }, r.onchange = function (e) {
                            Le(e), r.nextSibling.value = r.value
                        }
                    }, Ne = function (e) {
                        return "string" == typeof e ? document.querySelector(e) : e
                    }, Ie = function (e) {
                        var t = H();
                        t.setAttribute("role", e.toast ? "alert" : "dialog"), t.setAttribute("aria-live", e.toast ? "polite" : "assertive"), e.toast || t.setAttribute("aria-modal", "true")
                    }, ze = function (e) {
                        "rtl" === window.getComputedStyle(e).direction && me(R(), I.rtl)
                    }, Re = function (e) {
                        var t = Me();
                        if (Oe()) _("SweetAlert2 requires document to initialize"); else {
                            var n = document.createElement("div");
                            n.className = I.container, t && me(n, I["no-transition"]), le(n, Pe);
                            var r = Ne(e.target);
                            r.appendChild(n), Ie(e), ze(r), je()
                        }
                    }, Be = function (t, n) {
                        t instanceof HTMLElement ? n.appendChild(t) : "object" === e(t) ? De(t, n) : t && le(n, t)
                    }, De = function (e, t) {
                        e.jquery ? He(t, e) : le(t, e.toString())
                    }, He = function (e, t) {
                        if (e.textContent = "", 0 in t) for (var n = 0; n in t; n++) e.appendChild(t[n].cloneNode(!0)); else e.appendChild(t.cloneNode(!0))
                    }, $e = function () {
                        if (Oe()) return !1;
                        var e = document.createElement("div"), t = {
                            WebkitAnimation: "webkitAnimationEnd",
                            OAnimation: "oAnimationEnd oanimationend",
                            animation: "animationend"
                        };
                        for (var n in t) if (Object.prototype.hasOwnProperty.call(t, n) && void 0 !== e.style[n]) return t[n];
                        return !1
                    }(), qe = function () {
                        var e = document.createElement("div");
                        e.className = I["scrollbar-measure"], document.body.appendChild(e);
                        var t = e.getBoundingClientRect().width - e.clientWidth;
                        return document.body.removeChild(e), t
                    }, Fe = function (e, t) {
                        var n = Y(), r = X(), i = Z();
                        t.showConfirmButton || t.showCancelButton || _e(n), de(n, t, "actions"), Ve(r, "confirm", t), Ve(i, "cancel", t), t.buttonsStyling ? Ue(r, i, t) : (ve([r, i], I.styled), r.style.backgroundColor = r.style.borderLeftColor = r.style.borderRightColor = "", i.style.backgroundColor = i.style.borderLeftColor = i.style.borderRightColor = ""), t.reverseButtons && r.parentNode.insertBefore(i, r)
                    };

                function Ue(e, t, n) {
                    if (me([e, t], I.styled), n.confirmButtonColor && (e.style.backgroundColor = n.confirmButtonColor), n.cancelButtonColor && (t.style.backgroundColor = n.cancelButtonColor), !ae()) {
                        var r = window.getComputedStyle(e).getPropertyValue("background-color");
                        e.style.borderLeftColor = r, e.style.borderRightColor = r
                    }
                }

                function Ve(e, t, n) {
                    ke(e, n["show".concat(v(t), "Button")], "inline-block"), le(e, n["".concat(t, "ButtonText")]), e.setAttribute("aria-label", n["".concat(t, "ButtonAriaLabel")]), e.className = I[t], de(e, n, "".concat(t, "Button")), me(e, n["".concat(t, "ButtonClass")])
                }

                function We(e, t) {
                    "string" == typeof t ? e.style.background = t : t || me([document.documentElement, document.body], I["no-backdrop"])
                }

                function Ge(e, t) {
                    t in I ? me(e, I[t]) : (y('The "position" parameter is not valid, defaulting to "center"'), me(e, I.center))
                }

                function Ke(e, t) {
                    if (t && "string" == typeof t) {
                        var n = "grow-".concat(t);
                        n in I && me(e, I[n])
                    }
                }

                var Xe = function (e, t) {
                        var n = R();
                        if (n) {
                            We(n, t.backdrop), !t.backdrop && t.allowOutsideClick && y('"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`'), Ge(n, t.position), Ke(n, t.grow), de(n, t, "container");
                            var r = document.body.getAttribute("data-swal2-queue-step");
                            r && (n.setAttribute("data-queue-step", r), document.body.removeAttribute("data-swal2-queue-step"))
                        }
                    }, Ze = {promise: new WeakMap, innerParams: new WeakMap, domCache: new WeakMap},
                    Ye = ["input", "file", "range", "select", "radio", "checkbox", "textarea"], Je = function (e, t) {
                        var n = U(), r = Ze.innerParams.get(e), i = !r || t.input !== r.input;
                        Ye.forEach((function (e) {
                            var r = I[e], o = be(n, r);
                            tt(e, t.inputAttributes), o.className = r, i && _e(o)
                        })), t.input && (i && Qe(t), nt(t))
                    }, Qe = function (e) {
                        if (!ot[e.input]) return _('Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'.concat(e.input, '"'));
                        var t = it(e.input), n = ot[e.input](t, e);
                        ye(n), setTimeout((function () {
                            fe(n)
                        }))
                    }, et = function (e) {
                        for (var t = 0; t < e.attributes.length; t++) {
                            var n = e.attributes[t].name;
                            -1 === ["type", "value", "style"].indexOf(n) && e.removeAttribute(n)
                        }
                    }, tt = function (e, t) {
                        var n = pe(U(), e);
                        if (n) for (var r in et(n), t) "range" === e && "placeholder" === r || n.setAttribute(r, t[r])
                    }, nt = function (e) {
                        var t = it(e.input);
                        e.customClass && me(t, e.customClass.input)
                    }, rt = function (e, t) {
                        e.placeholder && !t.inputPlaceholder || (e.placeholder = t.inputPlaceholder)
                    }, it = function (e) {
                        var t = I[e] ? I[e] : I.input;
                        return be(U(), t)
                    }, ot = {};
                ot.text = ot.email = ot.password = ot.number = ot.tel = ot.url = function (t, n) {
                    return "string" == typeof n.inputValue || "number" == typeof n.inputValue ? t.value = n.inputValue : A(n.inputValue) || y('Unexpected type of inputValue! Expected "string", "number" or "Promise", got "'.concat(e(n.inputValue), '"')), rt(t, n), t.type = n.input, t
                }, ot.file = function (e, t) {
                    return rt(e, t), e
                }, ot.range = function (e, t) {
                    var n = e.querySelector("input"), r = e.querySelector("output");
                    return n.value = t.inputValue, n.type = t.input, r.value = t.inputValue, e
                }, ot.select = function (e, t) {
                    if (e.textContent = "", t.inputPlaceholder) {
                        var n = document.createElement("option");
                        le(n, t.inputPlaceholder), n.value = "", n.disabled = !0, n.selected = !0, e.appendChild(n)
                    }
                    return e
                }, ot.radio = function (e) {
                    return e.textContent = "", e
                }, ot.checkbox = function (e, t) {
                    var n = pe(U(), "checkbox");
                    n.value = 1, n.id = I.checkbox, n.checked = Boolean(t.inputValue);
                    var r = e.querySelector("span");
                    return le(r, t.inputPlaceholder), e
                }, ot.textarea = function (e, t) {
                    if (e.value = t.inputValue, rt(e, t), "MutationObserver" in window) {
                        var n = parseInt(window.getComputedStyle(H()).width),
                            r = parseInt(window.getComputedStyle(H()).paddingLeft) + parseInt(window.getComputedStyle(H()).paddingRight);
                        new MutationObserver((function () {
                            var t = e.offsetWidth + r;
                            H().style.width = t > n ? "".concat(t, "px") : null
                        })).observe(e, {attributes: !0, attributeFilter: ["style"]})
                    }
                    return e
                };
                var at = function (e, t) {
                    var n = U().querySelector("#".concat(I.content));
                    t.html ? (Be(t.html, n), ye(n, "block")) : t.text ? (n.textContent = t.text, ye(n, "block")) : _e(n), Je(e, t), de(U(), t, "content")
                }, st = function (e, t) {
                    var n = Q();
                    ke(n, t.footer), t.footer && Be(t.footer, n), de(n, t, "footer")
                }, lt = function (e, t) {
                    var n = te();
                    le(n, t.closeButtonHtml), de(n, t, "closeButton"), ke(n, t.showCloseButton), n.setAttribute("aria-label", t.closeButtonAriaLabel)
                }, ct = function (e, t) {
                    var n = Ze.innerParams.get(e);
                    if (n && t.icon === n.icon && q()) de(q(), t, "icon"); else if (ut(), t.icon) if (-1 !== Object.keys(z).indexOf(t.icon)) {
                        var r = B(".".concat(I.icon, ".").concat(z[t.icon]));
                        ye(r), pt(r, t), dt(), de(r, t, "icon"), me(r, t.showClass.icon)
                    } else _('Unknown icon! Expected "success", "error", "warning", "info" or "question", got "'.concat(t.icon, '"'))
                }, ut = function () {
                    for (var e = $(), t = 0; t < e.length; t++) _e(e[t])
                }, dt = function () {
                    for (var e = H(), t = window.getComputedStyle(e).getPropertyValue("background-color"), n = e.querySelectorAll("[class^=swal2-success-circular-line], .swal2-success-fix"), r = 0; r < n.length; r++) n[r].style.backgroundColor = t
                }, pt = function (e, t) {
                    e.textContent = "", t.iconHtml ? le(e, ht(t.iconHtml)) : "success" === t.icon ? le(e, '\n      <div class="swal2-success-circular-line-left"></div>\n      <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n      <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n      <div class="swal2-success-circular-line-right"></div>\n    ') : "error" === t.icon ? le(e, '\n      <span class="swal2-x-mark">\n        <span class="swal2-x-mark-line-left"></span>\n        <span class="swal2-x-mark-line-right"></span>\n      </span>\n    ') : le(e, ht({
                        question: "?",
                        warning: "!",
                        info: "i"
                    }[t.icon]))
                }, ht = function (e) {
                    return '<div class="'.concat(I["icon-content"], '">').concat(e, "</div>")
                }, ft = function (e, t) {
                    var n = W();
                    if (!t.imageUrl) return _e(n);
                    ye(n, ""), n.setAttribute("src", t.imageUrl), n.setAttribute("alt", t.imageAlt), we(n, "width", t.imageWidth), we(n, "height", t.imageHeight), n.className = I.image, de(n, t, "image")
                }, gt = [], mt = function (e) {
                    var t = this;
                    gt = e;
                    var n = function (e, t) {
                        gt = [], e(t)
                    }, r = [];
                    return new Promise((function (e) {
                        !function i(o, a) {
                            o < gt.length ? (document.body.setAttribute("data-swal2-queue-step", o), t.fire(gt[o]).then((function (t) {
                                void 0 !== t.value ? (r.push(t.value), i(o + 1, a)) : n(e, {dismiss: t.dismiss})
                            }))) : n(e, {value: r})
                        }(0)
                    }))
                }, vt = function () {
                    return R() && R().getAttribute("data-queue-step")
                }, bt = function (e, t) {
                    return t && t < gt.length ? gt.splice(t, 0, e) : gt.push(e)
                }, wt = function (e) {
                    void 0 !== gt[e] && gt.splice(e, 1)
                }, yt = function (e) {
                    var t = document.createElement("li");
                    return me(t, I["progress-step"]), le(t, e), t
                }, _t = function (e) {
                    var t = document.createElement("li");
                    return me(t, I["progress-step-line"]), e.progressStepsDistance && (t.style.width = e.progressStepsDistance), t
                }, kt = function (e, t) {
                    var n = G();
                    if (!t.progressSteps || 0 === t.progressSteps.length) return _e(n);
                    ye(n), n.textContent = "";
                    var r = parseInt(void 0 === t.currentProgressStep ? vt() : t.currentProgressStep);
                    r >= t.progressSteps.length && y("Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"), t.progressSteps.forEach((function (e, i) {
                        var o = yt(e);
                        if (n.appendChild(o), i === r && me(o, I["active-progress-step"]), i !== t.progressSteps.length - 1) {
                            var a = _t(t);
                            n.appendChild(a)
                        }
                    }))
                }, xt = function (e, t) {
                    var n = F();
                    ke(n, t.title || t.titleText), t.title && Be(t.title, n), t.titleText && (n.innerText = t.titleText), de(n, t, "title")
                }, St = function (e, t) {
                    var n = J();
                    de(n, t, "header"), kt(e, t), ct(e, t), ft(e, t), xt(e, t), lt(e, t)
                }, Ct = function (e, t) {
                    var n = H();
                    we(n, "width", t.width), we(n, "padding", t.padding), t.background && (n.style.background = t.background), Et(n, t)
                }, Et = function (e, t) {
                    e.className = "".concat(I.popup, " ").concat(xe(e) ? t.showClass.popup : ""), t.toast ? (me([document.documentElement, document.body], I["toast-shown"]), me(e, I.toast)) : me(e, I.modal), de(e, t, "popup"), "string" == typeof t.customClass && me(e, t.customClass), t.icon && me(e, I["icon-".concat(t.icon)])
                }, Tt = function (e, t) {
                    Ct(e, t), Xe(e, t), St(e, t), at(e, t), Fe(e, t), st(e, t), "function" == typeof t.onRender && t.onRender(H())
                }, At = function () {
                    return xe(H())
                }, Ot = function () {
                    return X() && X().click()
                }, Pt = function () {
                    return Z() && Z().click()
                };

                function Mt() {
                    for (var e = this, t = arguments.length, n = new Array(t), r = 0; r < t; r++) n[r] = arguments[r];
                    return c(e, n)
                }

                function Lt(e) {
                    var n = function (n) {
                        o(l, n);
                        var s = p(l);

                        function l() {
                            return t(this, l), s.apply(this, arguments)
                        }

                        return r(l, [{
                            key: "_main", value: function (t) {
                                return f(a(l.prototype), "_main", this).call(this, i({}, e, t))
                            }
                        }]), l
                    }(this);
                    return n
                }

                var jt = function () {
                        var e = H();
                        e || jr.fire(), e = H();
                        var t = Y(), n = X();
                        ye(t), ye(n, "inline-block"), me([e, t], I.loading), n.disabled = !0, e.setAttribute("data-loading", !0), e.setAttribute("aria-busy", !0), e.focus()
                    }, Nt = 100, It = {}, zt = function () {
                        It.previousActiveElement && It.previousActiveElement.focus ? (It.previousActiveElement.focus(), It.previousActiveElement = null) : document.body && document.body.focus()
                    }, Rt = function () {
                        return new Promise((function (e) {
                            var t = window.scrollX, n = window.scrollY;
                            It.restoreFocusTimeout = setTimeout((function () {
                                zt(), e()
                            }), Nt), void 0 !== t && void 0 !== n && window.scrollTo(t, n)
                        }))
                    }, Bt = function () {
                        return It.timeout && It.timeout.getTimerLeft()
                    }, Dt = function () {
                        if (It.timeout) return Ae(), It.timeout.stop()
                    }, Ht = function () {
                        if (It.timeout) {
                            var e = It.timeout.start();
                            return Te(e), e
                        }
                    }, $t = function () {
                        var e = It.timeout;
                        return e && (e.running ? Dt() : Ht())
                    }, qt = function (e) {
                        if (It.timeout) {
                            var t = It.timeout.increase(e);
                            return Te(t, !0), t
                        }
                    }, Ft = function () {
                        return It.timeout && It.timeout.isRunning()
                    }, Ut = {
                        title: "",
                        titleText: "",
                        text: "",
                        html: "",
                        footer: "",
                        icon: void 0,
                        iconHtml: void 0,
                        toast: !1,
                        animation: !0,
                        showClass: {popup: "swal2-show", backdrop: "swal2-backdrop-show", icon: "swal2-icon-show"},
                        hideClass: {popup: "swal2-hide", backdrop: "swal2-backdrop-hide", icon: "swal2-icon-hide"},
                        customClass: void 0,
                        target: "body",
                        backdrop: !0,
                        heightAuto: !0,
                        allowOutsideClick: !0,
                        allowEscapeKey: !0,
                        allowEnterKey: !0,
                        stopKeydownPropagation: !0,
                        keydownListenerCapture: !1,
                        showConfirmButton: !0,
                        showCancelButton: !1,
                        preConfirm: void 0,
                        confirmButtonText: "OK",
                        confirmButtonAriaLabel: "",
                        confirmButtonColor: void 0,
                        cancelButtonText: "Cancel",
                        cancelButtonAriaLabel: "",
                        cancelButtonColor: void 0,
                        buttonsStyling: !0,
                        reverseButtons: !1,
                        focusConfirm: !0,
                        focusCancel: !1,
                        showCloseButton: !1,
                        closeButtonHtml: "&times;",
                        closeButtonAriaLabel: "Close this dialog",
                        showLoaderOnConfirm: !1,
                        imageUrl: void 0,
                        imageWidth: void 0,
                        imageHeight: void 0,
                        imageAlt: "",
                        timer: void 0,
                        timerProgressBar: !1,
                        width: void 0,
                        padding: void 0,
                        background: void 0,
                        input: void 0,
                        inputPlaceholder: "",
                        inputValue: "",
                        inputOptions: {},
                        inputAutoTrim: !0,
                        inputAttributes: {},
                        inputValidator: void 0,
                        validationMessage: void 0,
                        grow: !1,
                        position: "center",
                        progressSteps: [],
                        currentProgressStep: void 0,
                        progressStepsDistance: void 0,
                        onBeforeOpen: void 0,
                        onOpen: void 0,
                        onRender: void 0,
                        onClose: void 0,
                        onAfterClose: void 0,
                        onDestroy: void 0,
                        scrollbarPadding: !0
                    },
                    Vt = ["allowEscapeKey", "allowOutsideClick", "buttonsStyling", "cancelButtonAriaLabel", "cancelButtonColor", "cancelButtonText", "closeButtonAriaLabel", "closeButtonHtml", "confirmButtonAriaLabel", "confirmButtonColor", "confirmButtonText", "currentProgressStep", "customClass", "footer", "hideClass", "html", "icon", "imageAlt", "imageHeight", "imageUrl", "imageWidth", "onAfterClose", "onClose", "onDestroy", "progressSteps", "reverseButtons", "showCancelButton", "showCloseButton", "showConfirmButton", "text", "title", "titleText"],
                    Wt = {animation: 'showClass" and "hideClass'},
                    Gt = ["allowOutsideClick", "allowEnterKey", "backdrop", "focusConfirm", "focusCancel", "heightAuto", "keydownListenerCapture"],
                    Kt = function (e) {
                        return Object.prototype.hasOwnProperty.call(Ut, e)
                    }, Xt = function (e) {
                        return -1 !== Vt.indexOf(e)
                    }, Zt = function (e) {
                        return Wt[e]
                    }, Yt = function (e) {
                        Kt(e) || y('Unknown parameter "'.concat(e, '"'))
                    }, Jt = function (e) {
                        -1 !== Gt.indexOf(e) && y('The parameter "'.concat(e, '" is incompatible with toasts'))
                    }, Qt = function (e) {
                        Zt(e) && S(e, Zt(e))
                    }, en = function (e) {
                        for (var t in e) Yt(t), e.toast && Jt(t), Qt(t)
                    }, tn = Object.freeze({
                        isValidParameter: Kt,
                        isUpdatableParameter: Xt,
                        isDeprecatedParameter: Zt,
                        argsToParams: L,
                        isVisible: At,
                        clickConfirm: Ot,
                        clickCancel: Pt,
                        getContainer: R,
                        getPopup: H,
                        getTitle: F,
                        getContent: U,
                        getHtmlContainer: V,
                        getImage: W,
                        getIcon: q,
                        getIcons: $,
                        getCloseButton: te,
                        getActions: Y,
                        getConfirmButton: X,
                        getCancelButton: Z,
                        getHeader: J,
                        getFooter: Q,
                        getTimerProgressBar: ee,
                        getFocusableElements: re,
                        getValidationMessage: K,
                        isLoading: ae,
                        fire: Mt,
                        mixin: Lt,
                        queue: mt,
                        getQueueStep: vt,
                        insertQueueStep: bt,
                        deleteQueueStep: wt,
                        showLoading: jt,
                        enableLoading: jt,
                        getTimerLeft: Bt,
                        stopTimer: Dt,
                        resumeTimer: Ht,
                        toggleTimer: $t,
                        increaseTimer: qt,
                        isTimerRunning: Ft
                    });

                function nn() {
                    var e = Ze.innerParams.get(this);
                    if (e) {
                        var t = Ze.domCache.get(this);
                        e.showConfirmButton || (_e(t.confirmButton), e.showCancelButton || _e(t.actions)), ve([t.popup, t.actions], I.loading), t.popup.removeAttribute("aria-busy"), t.popup.removeAttribute("data-loading"), t.confirmButton.disabled = !1, t.cancelButton.disabled = !1
                    }
                }

                function rn(e) {
                    var t = Ze.innerParams.get(e || this), n = Ze.domCache.get(e || this);
                    return n ? pe(n.content, t.input) : null
                }

                var on = function () {
                    null === se.previousBodyPadding && document.body.scrollHeight > window.innerHeight && (se.previousBodyPadding = parseInt(window.getComputedStyle(document.body).getPropertyValue("padding-right")), document.body.style.paddingRight = "".concat(se.previousBodyPadding + qe(), "px"))
                }, an = function () {
                    null !== se.previousBodyPadding && (document.body.style.paddingRight = "".concat(se.previousBodyPadding, "px"), se.previousBodyPadding = null)
                }, sn = function () {
                    if ((/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream || "MacIntel" === navigator.platform && navigator.maxTouchPoints > 1) && !ce(document.body, I.iosfix)) {
                        var e = document.body.scrollTop;
                        document.body.style.top = "".concat(-1 * e, "px"), me(document.body, I.iosfix), cn(), ln()
                    }
                }, ln = function () {
                    if (!navigator.userAgent.match(/(CriOS|FxiOS|EdgiOS|YaBrowser|UCBrowser)/i)) {
                        var e = 44;
                        H().scrollHeight > window.innerHeight - e && (R().style.paddingBottom = "".concat(e, "px"))
                    }
                }, cn = function () {
                    var e, t = R();
                    t.ontouchstart = function (t) {
                        e = un(t.target)
                    }, t.ontouchmove = function (t) {
                        e && (t.preventDefault(), t.stopPropagation())
                    }
                }, un = function (e) {
                    var t = R();
                    return e === t || !(Se(t) || "INPUT" === e.tagName || Se(U()) && U().contains(e))
                }, dn = function () {
                    if (ce(document.body, I.iosfix)) {
                        var e = parseInt(document.body.style.top, 10);
                        ve(document.body, I.iosfix), document.body.style.top = "", document.body.scrollTop = -1 * e
                    }
                }, pn = function () {
                    return !!window.MSInputMethodContext && !!document.documentMode
                }, hn = function () {
                    var e = R(), t = H();
                    e.style.removeProperty("align-items"), t.offsetTop < 0 && (e.style.alignItems = "flex-start")
                }, fn = function () {
                    "undefined" != typeof window && pn() && (hn(), window.addEventListener("resize", hn))
                }, gn = function () {
                    "undefined" != typeof window && pn() && window.removeEventListener("resize", hn)
                }, mn = function () {
                    w(document.body.children).forEach((function (e) {
                        e === R() || Ee(e, R()) || (e.hasAttribute("aria-hidden") && e.setAttribute("data-previous-aria-hidden", e.getAttribute("aria-hidden")), e.setAttribute("aria-hidden", "true"))
                    }))
                }, vn = function () {
                    w(document.body.children).forEach((function (e) {
                        e.hasAttribute("data-previous-aria-hidden") ? (e.setAttribute("aria-hidden", e.getAttribute("data-previous-aria-hidden")), e.removeAttribute("data-previous-aria-hidden")) : e.removeAttribute("aria-hidden")
                    }))
                }, bn = {swalPromiseResolve: new WeakMap};

                function wn(e, t, n, r) {
                    n ? Sn(e, r) : (Rt().then((function () {
                        return Sn(e, r)
                    })), It.keydownTarget.removeEventListener("keydown", It.keydownHandler, {capture: It.keydownListenerCapture}), It.keydownHandlerAdded = !1), t.parentNode && !document.body.getAttribute("data-swal2-queue-step") && t.parentNode.removeChild(t), ie() && (an(), dn(), gn(), vn()), yn()
                }

                function yn() {
                    ve([document.documentElement, document.body], [I.shown, I["height-auto"], I["no-backdrop"], I["toast-shown"], I["toast-column"]])
                }

                function _n(e) {
                    var t = H();
                    if (t) {
                        var n = Ze.innerParams.get(this);
                        if (n && !ce(t, n.hideClass.popup)) {
                            var r = bn.swalPromiseResolve.get(this);
                            ve(t, n.showClass.popup), me(t, n.hideClass.popup);
                            var i = R();
                            ve(i, n.showClass.backdrop), me(i, n.hideClass.backdrop), kn(this, t, n), void 0 !== e ? (e.isDismissed = void 0 !== e.dismiss, e.isConfirmed = void 0 === e.dismiss) : e = {
                                isDismissed: !0,
                                isConfirmed: !1
                            }, r(e || {})
                        }
                    }
                }

                var kn = function (e, t, n) {
                    var r = R(), i = $e && Ce(t), o = n.onClose, a = n.onAfterClose;
                    null !== o && "function" == typeof o && o(t), i ? xn(e, t, r, a) : wn(e, r, oe(), a)
                }, xn = function (e, t, n, r) {
                    It.swalCloseEventFinishedCallback = wn.bind(null, e, n, oe(), r), t.addEventListener($e, (function (e) {
                        e.target === t && (It.swalCloseEventFinishedCallback(), delete It.swalCloseEventFinishedCallback)
                    }))
                }, Sn = function (e, t) {
                    setTimeout((function () {
                        "function" == typeof t && t(), e._destroy()
                    }))
                };

                function Cn(e, t, n) {
                    var r = Ze.domCache.get(e);
                    t.forEach((function (e) {
                        r[e].disabled = n
                    }))
                }

                function En(e, t) {
                    if (!e) return !1;
                    if ("radio" === e.type) for (var n = e.parentNode.parentNode.querySelectorAll("input"), r = 0; r < n.length; r++) n[r].disabled = t; else e.disabled = t
                }

                function Tn() {
                    Cn(this, ["confirmButton", "cancelButton"], !1)
                }

                function An() {
                    Cn(this, ["confirmButton", "cancelButton"], !0)
                }

                function On() {
                    return En(this.getInput(), !1)
                }

                function Pn() {
                    return En(this.getInput(), !0)
                }

                function Mn(e) {
                    var t = Ze.domCache.get(this);
                    le(t.validationMessage, e);
                    var n = window.getComputedStyle(t.popup);
                    t.validationMessage.style.marginLeft = "-".concat(n.getPropertyValue("padding-left")), t.validationMessage.style.marginRight = "-".concat(n.getPropertyValue("padding-right")), ye(t.validationMessage);
                    var r = this.getInput();
                    r && (r.setAttribute("aria-invalid", !0), r.setAttribute("aria-describedBy", I["validation-message"]), fe(r), me(r, I.inputerror))
                }

                function Ln() {
                    var e = Ze.domCache.get(this);
                    e.validationMessage && _e(e.validationMessage);
                    var t = this.getInput();
                    t && (t.removeAttribute("aria-invalid"), t.removeAttribute("aria-describedBy"), ve(t, I.inputerror))
                }

                function jn() {
                    return Ze.domCache.get(this).progressSteps
                }

                var Nn = function () {
                    function e(n, r) {
                        t(this, e), this.callback = n, this.remaining = r, this.running = !1, this.start()
                    }

                    return r(e, [{
                        key: "start", value: function () {
                            return this.running || (this.running = !0, this.started = new Date, this.id = setTimeout(this.callback, this.remaining)), this.remaining
                        }
                    }, {
                        key: "stop", value: function () {
                            return this.running && (this.running = !1, clearTimeout(this.id), this.remaining -= new Date - this.started), this.remaining
                        }
                    }, {
                        key: "increase", value: function (e) {
                            var t = this.running;
                            return t && this.stop(), this.remaining += e, t && this.start(), this.remaining
                        }
                    }, {
                        key: "getTimerLeft", value: function () {
                            return this.running && (this.stop(), this.start()), this.remaining
                        }
                    }, {
                        key: "isRunning", value: function () {
                            return this.running
                        }
                    }]), e
                }(), In = {
                    email: function (e, t) {
                        return /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(e) ? Promise.resolve() : Promise.resolve(t || "Invalid email address")
                    }, url: function (e, t) {
                        return /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{1,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)$/.test(e) ? Promise.resolve() : Promise.resolve(t || "Invalid URL")
                    }
                };

                function zn(e) {
                    e.inputValidator || Object.keys(In).forEach((function (t) {
                        e.input === t && (e.inputValidator = In[t])
                    }))
                }

                function Rn(e) {
                    (!e.target || "string" == typeof e.target && !document.querySelector(e.target) || "string" != typeof e.target && !e.target.appendChild) && (y('Target parameter is not valid, defaulting to "body"'), e.target = "body")
                }

                function Bn(e) {
                    zn(e), e.showLoaderOnConfirm && !e.preConfirm && y("showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://sweetalert2.github.io/#ajax-request"), e.animation = C(e.animation), Rn(e), "string" == typeof e.title && (e.title = e.title.split("\n").join("<br />")), Re(e)
                }

                var Dn = function (e) {
                    var t = R(), n = H();
                    "function" == typeof e.onBeforeOpen && e.onBeforeOpen(n);
                    var r = window.getComputedStyle(document.body).overflowY;
                    Fn(t, n, e), $n(t, n), ie() && (qn(t, e.scrollbarPadding, r), mn()), oe() || It.previousActiveElement || (It.previousActiveElement = document.activeElement), "function" == typeof e.onOpen && setTimeout((function () {
                        return e.onOpen(n)
                    })), ve(t, I["no-transition"])
                };

                function Hn(e) {
                    var t = H();
                    if (e.target === t) {
                        var n = R();
                        t.removeEventListener($e, Hn), n.style.overflowY = "auto"
                    }
                }

                var $n = function (e, t) {
                        $e && Ce(t) ? (e.style.overflowY = "hidden", t.addEventListener($e, Hn)) : e.style.overflowY = "auto"
                    }, qn = function (e, t, n) {
                        sn(), fn(), t && "hidden" !== n && on(), setTimeout((function () {
                            e.scrollTop = 0
                        }))
                    }, Fn = function (e, t, n) {
                        me(e, n.showClass.backdrop), ye(t), me(t, n.showClass.popup), me([document.documentElement, document.body], I.shown), n.heightAuto && n.backdrop && !n.toast && me([document.documentElement, document.body], I["height-auto"])
                    }, Un = function (e, t) {
                        "select" === t.input || "radio" === t.input ? Xn(e, t) : -1 !== ["text", "email", "number", "tel", "textarea"].indexOf(t.input) && (E(t.inputValue) || A(t.inputValue)) && Zn(e, t)
                    }, Vn = function (e, t) {
                        var n = e.getInput();
                        if (!n) return null;
                        switch (t.input) {
                            case"checkbox":
                                return Wn(n);
                            case"radio":
                                return Gn(n);
                            case"file":
                                return Kn(n);
                            default:
                                return t.inputAutoTrim ? n.value.trim() : n.value
                        }
                    }, Wn = function (e) {
                        return e.checked ? 1 : 0
                    }, Gn = function (e) {
                        return e.checked ? e.value : null
                    }, Kn = function (e) {
                        return e.files.length ? null !== e.getAttribute("multiple") ? e.files : e.files[0] : null
                    }, Xn = function (t, n) {
                        var r = U(), i = function (e) {
                            return Yn[n.input](r, Jn(e), n)
                        };
                        E(n.inputOptions) || A(n.inputOptions) ? (jt(), T(n.inputOptions).then((function (e) {
                            t.hideLoading(), i(e)
                        }))) : "object" === e(n.inputOptions) ? i(n.inputOptions) : _("Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(e(n.inputOptions)))
                    }, Zn = function (e, t) {
                        var n = e.getInput();
                        _e(n), T(t.inputValue).then((function (r) {
                            n.value = "number" === t.input ? parseFloat(r) || 0 : "".concat(r), ye(n), n.focus(), e.hideLoading()
                        })).catch((function (t) {
                            _("Error in inputValue promise: ".concat(t)), n.value = "", ye(n), n.focus(), e.hideLoading()
                        }))
                    }, Yn = {
                        select: function (e, t, n) {
                            var r = be(e, I.select), i = function (e, t, r) {
                                var i = document.createElement("option");
                                i.value = r, le(i, t), n.inputValue.toString() === r.toString() && (i.selected = !0), e.appendChild(i)
                            };
                            t.forEach((function (e) {
                                var t = e[0], n = e[1];
                                if (Array.isArray(n)) {
                                    var o = document.createElement("optgroup");
                                    o.label = t, o.disabled = !1, r.appendChild(o), n.forEach((function (e) {
                                        return i(o, e[1], e[0])
                                    }))
                                } else i(r, n, t)
                            })), r.focus()
                        }, radio: function (e, t, n) {
                            var r = be(e, I.radio);
                            t.forEach((function (e) {
                                var t = e[0], i = e[1], o = document.createElement("input"),
                                    a = document.createElement("label");
                                o.type = "radio", o.name = I.radio, o.value = t, n.inputValue.toString() === t.toString() && (o.checked = !0);
                                var s = document.createElement("span");
                                le(s, i), s.className = I.label, a.appendChild(o), a.appendChild(s), r.appendChild(a)
                            }));
                            var i = r.querySelectorAll("input");
                            i.length && i[0].focus()
                        }
                    }, Jn = function t(n) {
                        var r = [];
                        return "undefined" != typeof Map && n instanceof Map ? n.forEach((function (n, i) {
                            var o = n;
                            "object" === e(o) && (o = t(o)), r.push([i, o])
                        })) : Object.keys(n).forEach((function (i) {
                            var o = n[i];
                            "object" === e(o) && (o = t(o)), r.push([i, o])
                        })), r
                    }, Qn = function (e, t) {
                        e.disableButtons(), t.input ? tr(e, t) : rr(e, t, !0)
                    }, er = function (e, t) {
                        e.disableButtons(), t(O.cancel)
                    }, tr = function (e, t) {
                        var n = Vn(e, t);
                        t.inputValidator ? (e.disableInput(), Promise.resolve().then((function () {
                            return T(t.inputValidator(n, t.validationMessage))
                        })).then((function (r) {
                            e.enableButtons(), e.enableInput(), r ? e.showValidationMessage(r) : rr(e, t, n)
                        }))) : e.getInput().checkValidity() ? rr(e, t, n) : (e.enableButtons(), e.showValidationMessage(t.validationMessage))
                    }, nr = function (e, t) {
                        e.closePopup({value: t})
                    }, rr = function (e, t, n) {
                        t.showLoaderOnConfirm && jt(), t.preConfirm ? (e.resetValidationMessage(), Promise.resolve().then((function () {
                            return T(t.preConfirm(n, t.validationMessage))
                        })).then((function (t) {
                            xe(K()) || !1 === t ? e.hideLoading() : nr(e, void 0 === t ? n : t)
                        }))) : nr(e, n)
                    }, ir = function (e, t, n, r) {
                        t.keydownTarget && t.keydownHandlerAdded && (t.keydownTarget.removeEventListener("keydown", t.keydownHandler, {capture: t.keydownListenerCapture}), t.keydownHandlerAdded = !1), n.toast || (t.keydownHandler = function (t) {
                            return lr(e, t, r)
                        }, t.keydownTarget = n.keydownListenerCapture ? window : H(), t.keydownListenerCapture = n.keydownListenerCapture, t.keydownTarget.addEventListener("keydown", t.keydownHandler, {capture: t.keydownListenerCapture}), t.keydownHandlerAdded = !0)
                    }, or = function (e, t, n) {
                        for (var r = re(), i = 0; i < r.length; i++) return (t += n) === r.length ? t = 0 : -1 === t && (t = r.length - 1), r[t].focus();
                        H().focus()
                    }, ar = ["ArrowLeft", "ArrowRight", "ArrowUp", "ArrowDown", "Left", "Right", "Up", "Down"],
                    sr = ["Escape", "Esc"], lr = function (e, t, n) {
                        var r = Ze.innerParams.get(e);
                        r.stopKeydownPropagation && t.stopPropagation(), "Enter" === t.key ? cr(e, t, r) : "Tab" === t.key ? ur(t, r) : -1 !== ar.indexOf(t.key) ? dr() : -1 !== sr.indexOf(t.key) && pr(t, r, n)
                    }, cr = function (e, t, n) {
                        if (!t.isComposing && t.target && e.getInput() && t.target.outerHTML === e.getInput().outerHTML) {
                            if (-1 !== ["textarea", "file"].indexOf(n.input)) return;
                            Ot(), t.preventDefault()
                        }
                    }, ur = function (e, t) {
                        for (var n = e.target, r = re(), i = -1, o = 0; o < r.length; o++) if (n === r[o]) {
                            i = o;
                            break
                        }
                        e.shiftKey ? or(t, i, -1) : or(t, i, 1), e.stopPropagation(), e.preventDefault()
                    }, dr = function () {
                        var e = X(), t = Z();
                        document.activeElement === e && xe(t) ? t.focus() : document.activeElement === t && xe(e) && e.focus()
                    }, pr = function (e, t, n) {
                        C(t.allowEscapeKey) && (e.preventDefault(), n(O.esc))
                    }, hr = function (e, t, n) {
                        Ze.innerParams.get(e).toast ? fr(e, t, n) : (mr(t), vr(t), br(e, t, n))
                    }, fr = function (e, t, n) {
                        t.popup.onclick = function () {
                            var t = Ze.innerParams.get(e);
                            t.showConfirmButton || t.showCancelButton || t.showCloseButton || t.input || n(O.close)
                        }
                    }, gr = !1, mr = function (e) {
                        e.popup.onmousedown = function () {
                            e.container.onmouseup = function (t) {
                                e.container.onmouseup = void 0, t.target === e.container && (gr = !0)
                            }
                        }
                    }, vr = function (e) {
                        e.container.onmousedown = function () {
                            e.popup.onmouseup = function (t) {
                                e.popup.onmouseup = void 0, (t.target === e.popup || e.popup.contains(t.target)) && (gr = !0)
                            }
                        }
                    }, br = function (e, t, n) {
                        t.container.onclick = function (r) {
                            var i = Ze.innerParams.get(e);
                            gr ? gr = !1 : r.target === t.container && C(i.allowOutsideClick) && n(O.backdrop)
                        }
                    };

                function wr(e) {
                    en(e), It.currentInstance && It.currentInstance._destroy(), It.currentInstance = this;
                    var t = yr(e);
                    Bn(t), Object.freeze(t), It.timeout && (It.timeout.stop(), delete It.timeout), clearTimeout(It.restoreFocusTimeout);
                    var n = kr(this);
                    return Tt(this, t), Ze.innerParams.set(this, t), _r(this, n, t)
                }

                var yr = function (e) {
                    var t = i({}, Ut.showClass, e.showClass), n = i({}, Ut.hideClass, e.hideClass), r = i({}, Ut, e);
                    return r.showClass = t, r.hideClass = n, !1 === e.animation && (r.showClass = {
                        popup: "swal2-noanimation",
                        backdrop: "swal2-noanimation"
                    }, r.hideClass = {}), r
                }, _r = function (e, t, n) {
                    return new Promise((function (r) {
                        var i = function (t) {
                            e.closePopup({dismiss: t})
                        };
                        bn.swalPromiseResolve.set(e, r), t.confirmButton.onclick = function () {
                            return Qn(e, n)
                        }, t.cancelButton.onclick = function () {
                            return er(e, i)
                        }, t.closeButton.onclick = function () {
                            return i(O.close)
                        }, hr(e, t, i), ir(e, It, n, i), n.toast && (n.input || n.footer || n.showCloseButton) ? me(document.body, I["toast-column"]) : ve(document.body, I["toast-column"]), Un(e, n), Dn(n), xr(It, n, i), Sr(t, n), setTimeout((function () {
                            t.container.scrollTop = 0
                        }))
                    }))
                }, kr = function (e) {
                    var t = {
                        popup: H(),
                        container: R(),
                        content: U(),
                        actions: Y(),
                        confirmButton: X(),
                        cancelButton: Z(),
                        closeButton: te(),
                        validationMessage: K(),
                        progressSteps: G()
                    };
                    return Ze.domCache.set(e, t), t
                }, xr = function (e, t, n) {
                    var r = ee();
                    _e(r), t.timer && (e.timeout = new Nn((function () {
                        n("timer"), delete e.timeout
                    }), t.timer), t.timerProgressBar && (ye(r), setTimeout((function () {
                        e.timeout.running && Te(t.timer)
                    }))))
                }, Sr = function (e, t) {
                    if (!t.toast) return C(t.allowEnterKey) ? t.focusCancel && xe(e.cancelButton) ? e.cancelButton.focus() : t.focusConfirm && xe(e.confirmButton) ? e.confirmButton.focus() : void or(t, -1, 1) : Cr()
                }, Cr = function () {
                    document.activeElement && "function" == typeof document.activeElement.blur && document.activeElement.blur()
                };

                function Er(e) {
                    var t = H(), n = Ze.innerParams.get(this);
                    if (!t || ce(t, n.hideClass.popup)) return y("You're trying to update the closed or closing popup, that won't work. Use the update() method in preConfirm parameter or show a new popup.");
                    var r = {};
                    Object.keys(e).forEach((function (t) {
                        jr.isUpdatableParameter(t) ? r[t] = e[t] : y('Invalid parameter to update: "'.concat(t, '". Updatable params are listed here: https://github.com/sweetalert2/sweetalert2/blob/master/src/utils/params.js'))
                    }));
                    var o = i({}, n, r);
                    Tt(this, o), Ze.innerParams.set(this, o), Object.defineProperties(this, {
                        params: {
                            value: i({}, this.params, e),
                            writable: !1,
                            enumerable: !0
                        }
                    })
                }

                function Tr() {
                    var e = Ze.domCache.get(this), t = Ze.innerParams.get(this);
                    t && (e.popup && It.swalCloseEventFinishedCallback && (It.swalCloseEventFinishedCallback(), delete It.swalCloseEventFinishedCallback), It.deferDisposalTimer && (clearTimeout(It.deferDisposalTimer), delete It.deferDisposalTimer), "function" == typeof t.onDestroy && t.onDestroy(), Or(this))
                }

                var Ar, Or = function (e) {
                    delete e.params, delete It.keydownHandler, delete It.keydownTarget, Pr(Ze), Pr(bn)
                }, Pr = function (e) {
                    for (var t in e) e[t] = new WeakMap
                }, Mr = Object.freeze({
                    hideLoading: nn,
                    disableLoading: nn,
                    getInput: rn,
                    close: _n,
                    closePopup: _n,
                    closeModal: _n,
                    closeToast: _n,
                    enableButtons: Tn,
                    disableButtons: An,
                    enableInput: On,
                    disableInput: Pn,
                    showValidationMessage: Mn,
                    resetValidationMessage: Ln,
                    getProgressSteps: jn,
                    _main: wr,
                    update: Er,
                    _destroy: Tr
                }), Lr = function () {
                    function e() {
                        if (t(this, e), "undefined" != typeof window) {
                            "undefined" == typeof Promise && _("This package requires a Promise library, please include a shim to enable it in this browser (See: https://github.com/sweetalert2/sweetalert2/wiki/Migration-from-SweetAlert-to-SweetAlert2#1-ie-support)"), Ar = this;
                            for (var n = arguments.length, r = new Array(n), i = 0; i < n; i++) r[i] = arguments[i];
                            var o = Object.freeze(this.constructor.argsToParams(r));
                            Object.defineProperties(this, {
                                params: {
                                    value: o,
                                    writable: !1,
                                    enumerable: !0,
                                    configurable: !0
                                }
                            });
                            var a = this._main(this.params);
                            Ze.promise.set(this, a)
                        }
                    }

                    return r(e, [{
                        key: "then", value: function (e) {
                            return Ze.promise.get(this).then(e)
                        }
                    }, {
                        key: "finally", value: function (e) {
                            return Ze.promise.get(this).finally(e)
                        }
                    }]), e
                }();
                i(Lr.prototype, Mr), i(Lr, tn), Object.keys(Mr).forEach((function (e) {
                    Lr[e] = function () {
                        var t;
                        if (Ar) return (t = Ar)[e].apply(t, arguments)
                    }
                })), Lr.DismissReason = O, Lr.version = "9.17.2";
                var jr = Lr;
                return jr.default = jr, jr
            }(), void 0 !== this && this.Sweetalert2 && (this.swal = this.sweetAlert = this.Swal = this.SweetAlert = this.Sweetalert2), "undefined" != typeof document && function (e, t) {
                var n = e.createElement("style");
                if (e.getElementsByTagName("head")[0].appendChild(n), n.styleSheet) n.styleSheet.disabled || (n.styleSheet.cssText = t); else try {
                    n.innerHTML = t
                } catch (e) {
                    n.innerText = t
                }
            }(document, '.swal2-popup.swal2-toast{flex-direction:row;align-items:center;width:auto;padding:.625em;overflow-y:hidden;background:#fff;box-shadow:0 0 .625em #d9d9d9}.swal2-popup.swal2-toast .swal2-header{flex-direction:row;padding:0}.swal2-popup.swal2-toast .swal2-title{flex-grow:1;justify-content:flex-start;margin:0 .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{position:static;width:.8em;height:.8em;line-height:.8}.swal2-popup.swal2-toast .swal2-content{justify-content:flex-start;padding:0;font-size:1em}.swal2-popup.swal2-toast .swal2-icon{width:2em;min-width:2em;height:2em;margin:0}.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:1.8em;font-weight:700}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{font-size:.25em}}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{flex-basis:auto!important;width:auto;height:auto;margin:0 .3125em}.swal2-popup.swal2-toast .swal2-styled{margin:0 .3125em;padding:.3125em .625em;font-size:1em}.swal2-popup.swal2-toast .swal2-styled:focus{box-shadow:0 0 0 1px #fff,0 0 0 3px rgba(50,100,150,.4)}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:1.6em;height:3em;transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.8em;left:-.5em;transform:rotate(-45deg);transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.25em;left:.9375em;transform-origin:0 1.5em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-toast-animate-success-line-tip .75s;animation:swal2-toast-animate-success-line-tip .75s}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-toast-animate-success-line-long .75s;animation:swal2-toast-animate-success-line-long .75s}.swal2-popup.swal2-toast.swal2-show{-webkit-animation:swal2-toast-show .5s;animation:swal2-toast-show .5s}.swal2-popup.swal2-toast.swal2-hide{-webkit-animation:swal2-toast-hide .1s forwards;animation:swal2-toast-hide .1s forwards}.swal2-container{display:flex;position:fixed;z-index:1060;top:0;right:0;bottom:0;left:0;flex-direction:row;align-items:center;justify-content:center;padding:.625em;overflow-x:hidden;transition:background-color .1s;-webkit-overflow-scrolling:touch}.swal2-container.swal2-backdrop-show,.swal2-container.swal2-noanimation{background:rgba(0,0,0,.4)}.swal2-container.swal2-backdrop-hide{background:0 0!important}.swal2-container.swal2-top{align-items:flex-start}.swal2-container.swal2-top-left,.swal2-container.swal2-top-start{align-items:flex-start;justify-content:flex-start}.swal2-container.swal2-top-end,.swal2-container.swal2-top-right{align-items:flex-start;justify-content:flex-end}.swal2-container.swal2-center{align-items:center}.swal2-container.swal2-center-left,.swal2-container.swal2-center-start{align-items:center;justify-content:flex-start}.swal2-container.swal2-center-end,.swal2-container.swal2-center-right{align-items:center;justify-content:flex-end}.swal2-container.swal2-bottom{align-items:flex-end}.swal2-container.swal2-bottom-left,.swal2-container.swal2-bottom-start{align-items:flex-end;justify-content:flex-start}.swal2-container.swal2-bottom-end,.swal2-container.swal2-bottom-right{align-items:flex-end;justify-content:flex-end}.swal2-container.swal2-bottom-end>:first-child,.swal2-container.swal2-bottom-left>:first-child,.swal2-container.swal2-bottom-right>:first-child,.swal2-container.swal2-bottom-start>:first-child,.swal2-container.swal2-bottom>:first-child{margin-top:auto}.swal2-container.swal2-grow-fullscreen>.swal2-modal{display:flex!important;flex:1;align-self:stretch;justify-content:center}.swal2-container.swal2-grow-row>.swal2-modal{display:flex!important;flex:1;align-content:center;justify-content:center}.swal2-container.swal2-grow-column{flex:1;flex-direction:column}.swal2-container.swal2-grow-column.swal2-bottom,.swal2-container.swal2-grow-column.swal2-center,.swal2-container.swal2-grow-column.swal2-top{align-items:center}.swal2-container.swal2-grow-column.swal2-bottom-left,.swal2-container.swal2-grow-column.swal2-bottom-start,.swal2-container.swal2-grow-column.swal2-center-left,.swal2-container.swal2-grow-column.swal2-center-start,.swal2-container.swal2-grow-column.swal2-top-left,.swal2-container.swal2-grow-column.swal2-top-start{align-items:flex-start}.swal2-container.swal2-grow-column.swal2-bottom-end,.swal2-container.swal2-grow-column.swal2-bottom-right,.swal2-container.swal2-grow-column.swal2-center-end,.swal2-container.swal2-grow-column.swal2-center-right,.swal2-container.swal2-grow-column.swal2-top-end,.swal2-container.swal2-grow-column.swal2-top-right{align-items:flex-end}.swal2-container.swal2-grow-column>.swal2-modal{display:flex!important;flex:1;align-content:center;justify-content:center}.swal2-container.swal2-no-transition{transition:none!important}.swal2-container:not(.swal2-top):not(.swal2-top-start):not(.swal2-top-end):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-start):not(.swal2-center-end):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-start):not(.swal2-bottom-end):not(.swal2-bottom-left):not(.swal2-bottom-right):not(.swal2-grow-fullscreen)>.swal2-modal{margin:auto}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-container .swal2-modal{margin:0!important}}.swal2-popup{display:none;position:relative;box-sizing:border-box;flex-direction:column;justify-content:center;width:32em;max-width:100%;padding:1.25em;border:none;border-radius:.3125em;background:#fff;font-family:inherit;font-size:1rem}.swal2-popup:focus{outline:0}.swal2-popup.swal2-loading{overflow-y:hidden}.swal2-header{display:flex;flex-direction:column;align-items:center;padding:0 1.8em}.swal2-title{position:relative;max-width:100%;margin:0 0 .4em;padding:0;color:#595959;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}.swal2-actions{display:flex;z-index:1;flex-wrap:wrap;align-items:center;justify-content:center;width:100%;margin:1.25em auto 0}.swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}.swal2-actions:not(.swal2-loading) .swal2-styled:hover{background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))}.swal2-actions:not(.swal2-loading) .swal2-styled:active{background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))}.swal2-actions.swal2-loading .swal2-styled.swal2-confirm{box-sizing:border-box;width:2.5em;height:2.5em;margin:.46875em;padding:0;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border:.25em solid transparent;border-radius:100%;border-color:transparent;background-color:transparent!important;color:transparent!important;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-actions.swal2-loading .swal2-styled.swal2-cancel{margin-right:30px;margin-left:30px}.swal2-actions.swal2-loading :not(.swal2-styled).swal2-confirm::after{content:"";display:inline-block;width:15px;height:15px;margin-left:5px;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border:3px solid #999;border-radius:50%;border-right-color:transparent;box-shadow:1px 1px 1px #fff}.swal2-styled{margin:.3125em;padding:.625em 2em;box-shadow:none;font-weight:500}.swal2-styled:not([disabled]){cursor:pointer}.swal2-styled.swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#3085d6;color:#fff;font-size:1.0625em}.swal2-styled.swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#aaa;color:#fff;font-size:1.0625em}.swal2-styled:focus{outline:0;box-shadow:0 0 0 1px #fff,0 0 0 3px rgba(50,100,150,.4)}.swal2-styled::-moz-focus-inner{border:0}.swal2-footer{justify-content:center;margin:1.25em 0 0;padding:1em 0 0;border-top:1px solid #eee;color:#545454;font-size:1em}.swal2-timer-progress-bar-container{position:absolute;right:0;bottom:0;left:0;height:.25em;overflow:hidden;border-bottom-right-radius:.3125em;border-bottom-left-radius:.3125em}.swal2-timer-progress-bar{width:100%;height:.25em;background:rgba(0,0,0,.2)}.swal2-image{max-width:100%;margin:1.25em auto}.swal2-close{position:absolute;z-index:2;top:0;right:0;align-items:center;justify-content:center;width:1.2em;height:1.2em;padding:0;overflow:hidden;transition:color .1s ease-out;border:none;border-radius:0;background:0 0;color:#ccc;font-family:serif;font-size:2.5em;line-height:1.2;cursor:pointer}.swal2-close:hover{transform:none;background:0 0;color:#f27474}.swal2-close::-moz-focus-inner{border:0}.swal2-content{z-index:1;justify-content:center;margin:0;padding:0 1.6em;color:#545454;font-size:1.125em;font-weight:400;line-height:normal;text-align:center;word-wrap:break-word}.swal2-checkbox,.swal2-file,.swal2-input,.swal2-radio,.swal2-select,.swal2-textarea{margin:1em auto}.swal2-file,.swal2-input,.swal2-textarea{box-sizing:border-box;width:100%;transition:border-color .3s,box-shadow .3s;border:1px solid #d9d9d9;border-radius:.1875em;background:inherit;box-shadow:inset 0 1px 1px rgba(0,0,0,.06);color:inherit;font-size:1.125em}.swal2-file.swal2-inputerror,.swal2-input.swal2-inputerror,.swal2-textarea.swal2-inputerror{border-color:#f27474!important;box-shadow:0 0 2px #f27474!important}.swal2-file:focus,.swal2-input:focus,.swal2-textarea:focus{border:1px solid #b4dbed;outline:0;box-shadow:0 0 3px #c4e6f5}.swal2-file::-moz-placeholder,.swal2-input::-moz-placeholder,.swal2-textarea::-moz-placeholder{color:#ccc}.swal2-file:-ms-input-placeholder,.swal2-input:-ms-input-placeholder,.swal2-textarea:-ms-input-placeholder{color:#ccc}.swal2-file::-ms-input-placeholder,.swal2-input::-ms-input-placeholder,.swal2-textarea::-ms-input-placeholder{color:#ccc}.swal2-file::placeholder,.swal2-input::placeholder,.swal2-textarea::placeholder{color:#ccc}.swal2-range{margin:1em auto;background:#fff}.swal2-range input{width:80%}.swal2-range output{width:20%;color:inherit;font-weight:600;text-align:center}.swal2-range input,.swal2-range output{height:2.625em;padding:0;font-size:1.125em;line-height:2.625em}.swal2-input{height:2.625em;padding:0 .75em}.swal2-input[type=number]{max-width:10em}.swal2-file{background:inherit;font-size:1.125em}.swal2-textarea{height:6.75em;padding:.75em}.swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;background:inherit;color:inherit;font-size:1.125em}.swal2-checkbox,.swal2-radio{align-items:center;justify-content:center;background:#fff;color:inherit}.swal2-checkbox label,.swal2-radio label{margin:0 .6em;font-size:1.125em}.swal2-checkbox input,.swal2-radio input{margin:0 .4em}.swal2-validation-message{display:none;align-items:center;justify-content:center;padding:.625em;overflow:hidden;background:#f0f0f0;color:#666;font-size:1em;font-weight:300}.swal2-validation-message::before{content:"!";display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center}.swal2-icon{position:relative;box-sizing:content-box;justify-content:center;width:5em;height:5em;margin:1.25em auto 1.875em;border:.25em solid transparent;border-radius:50%;font-family:inherit;line-height:5em;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:3.75em}.swal2-icon.swal2-error{border-color:#f27474;color:#f27474}.swal2-icon.swal2-error .swal2-x-mark{position:relative;flex-grow:1}.swal2-icon.swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;transform:rotate(45deg)}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;transform:rotate(-45deg)}.swal2-icon.swal2-error.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-error.swal2-icon-show .swal2-x-mark{-webkit-animation:swal2-animate-error-x-mark .5s;animation:swal2-animate-error-x-mark .5s}.swal2-icon.swal2-warning{border-color:#facea8;color:#f8bb86}.swal2-icon.swal2-info{border-color:#9de0f6;color:#3fc3ee}.swal2-icon.swal2-question{border-color:#c9dae1;color:#87adbd}.swal2-icon.swal2-success{border-color:#a5dc86;color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;transform:rotate(45deg);border-radius:50%}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.4375em;left:-2.0635em;transform:rotate(-45deg);transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.6875em;left:1.875em;transform:rotate(-45deg);transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}.swal2-icon.swal2-success .swal2-success-ring{position:absolute;z-index:2;top:-.25em;left:-.25em;box-sizing:content-box;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%}.swal2-icon.swal2-success .swal2-success-fix{position:absolute;z-index:1;top:.5em;left:1.625em;width:.4375em;height:5.625em;transform:rotate(-45deg)}.swal2-icon.swal2-success [class^=swal2-success-line]{display:block;position:absolute;z-index:2;height:.3125em;border-radius:.125em;background-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.8125em;width:1.5625em;transform:rotate(45deg)}.swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;transform:rotate(-45deg)}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-animate-success-line-tip .75s;animation:swal2-animate-success-line-tip .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-animate-success-line-long .75s;animation:swal2-animate-success-line-long .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-circular-line-right{-webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;animation:swal2-rotate-success-circular-line 4.25s ease-in}.swal2-progress-steps{align-items:center;margin:0 0 1.25em;padding:0;background:inherit;font-weight:600}.swal2-progress-steps li{display:inline-block;position:relative}.swal2-progress-steps .swal2-progress-step{z-index:20;width:2em;height:2em;border-radius:2em;background:#3085d6;color:#fff;line-height:2em;text-align:center}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step{background:#3085d6}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step{background:#add8e6;color:#fff}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line{background:#add8e6}.swal2-progress-steps .swal2-progress-step-line{z-index:10;width:2.5em;height:.4em;margin:0 -1px;background:#3085d6}[class^=swal2]{-webkit-tap-highlight-color:transparent}.swal2-show{-webkit-animation:swal2-show .3s;animation:swal2-show .3s}.swal2-hide{-webkit-animation:swal2-hide .15s forwards;animation:swal2-hide .15s forwards}.swal2-noanimation{transition:none}.swal2-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}.swal2-rtl .swal2-close{right:auto;left:0}.swal2-rtl .swal2-timer-progress-bar{right:0;left:auto}@supports (-ms-accelerator:true){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@-moz-document url-prefix(){.swal2-close:focus{outline:2px solid rgba(50,100,150,.4)}}@-webkit-keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@-webkit-keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@-webkit-keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@-webkit-keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@-webkit-keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@-webkit-keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@-webkit-keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@-webkit-keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@-webkit-keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@-webkit-keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@-webkit-keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@-webkit-keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto!important}body.swal2-no-backdrop .swal2-container{top:auto;right:auto;bottom:auto;left:auto;max-width:calc(100% - .625em * 2);background-color:transparent!important}body.swal2-no-backdrop .swal2-container>.swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}body.swal2-no-backdrop .swal2-container.swal2-top{top:0;left:50%;transform:translateX(-50%)}body.swal2-no-backdrop .swal2-container.swal2-top-left,body.swal2-no-backdrop .swal2-container.swal2-top-start{top:0;left:0}body.swal2-no-backdrop .swal2-container.swal2-top-end,body.swal2-no-backdrop .swal2-container.swal2-top-right{top:0;right:0}body.swal2-no-backdrop .swal2-container.swal2-center{top:50%;left:50%;transform:translate(-50%,-50%)}body.swal2-no-backdrop .swal2-container.swal2-center-left,body.swal2-no-backdrop .swal2-container.swal2-center-start{top:50%;left:0;transform:translateY(-50%)}body.swal2-no-backdrop .swal2-container.swal2-center-end,body.swal2-no-backdrop .swal2-container.swal2-center-right{top:50%;right:0;transform:translateY(-50%)}body.swal2-no-backdrop .swal2-container.swal2-bottom{bottom:0;left:50%;transform:translateX(-50%)}body.swal2-no-backdrop .swal2-container.swal2-bottom-left,body.swal2-no-backdrop .swal2-container.swal2-bottom-start{bottom:0;left:0}body.swal2-no-backdrop .swal2-container.swal2-bottom-end,body.swal2-no-backdrop .swal2-container.swal2-bottom-right{right:0;bottom:0}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll!important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:static!important}}body.swal2-toast-shown .swal2-container{background-color:transparent}body.swal2-toast-shown .swal2-container.swal2-top{top:0;right:auto;bottom:auto;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{top:0;right:0;bottom:auto;left:auto}body.swal2-toast-shown .swal2-container.swal2-top-left,body.swal2-toast-shown .swal2-container.swal2-top-start{top:0;right:auto;bottom:auto;left:0}body.swal2-toast-shown .swal2-container.swal2-center-left,body.swal2-toast-shown .swal2-container.swal2-center-start{top:50%;right:auto;bottom:auto;left:0;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{top:50%;right:auto;bottom:auto;left:50%;transform:translate(-50%,-50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{top:50%;right:0;bottom:auto;left:auto;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-left,body.swal2-toast-shown .swal2-container.swal2-bottom-start{top:auto;right:auto;bottom:0;left:0}body.swal2-toast-shown .swal2-container.swal2-bottom{top:auto;right:auto;bottom:0;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{top:auto;right:0;bottom:0;left:auto}body.swal2-toast-column .swal2-toast{flex-direction:column;align-items:stretch}body.swal2-toast-column .swal2-toast .swal2-actions{flex:1;align-self:stretch;height:2.2em;margin-top:.3125em}body.swal2-toast-column .swal2-toast .swal2-loading{justify-content:center}body.swal2-toast-column .swal2-toast .swal2-input{height:2em;margin:.3125em auto;font-size:1em}body.swal2-toast-column .swal2-toast .swal2-validation-message{font-size:1em}')
        }, 9351: function (e) {
            e.exports = function () {
                "use strict";

                function e(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }

                function t(e, t) {
                    for (var n = 0; n < t.length; n++) {
                        var r = t[n];
                        r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r)
                    }
                }

                function n(e, n, r) {
                    return n && t(e.prototype, n), r && t(e, r), e
                }

                function r(e, t) {
                    return function (e) {
                        if (Array.isArray(e)) return e
                    }(e) || function (e, t) {
                        if (Symbol.iterator in Object(e) || "[object Arguments]" === Object.prototype.toString.call(e)) {
                            var n = [], r = !0, i = !1, o = void 0;
                            try {
                                for (var a, s = e[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !t || n.length !== t); r = !0) ;
                            } catch (e) {
                                i = !0, o = e
                            } finally {
                                try {
                                    r || null == s.return || s.return()
                                } finally {
                                    if (i) throw o
                                }
                            }
                            return n
                        }
                    }(e, t) || function () {
                        throw new TypeError("Invalid attempt to destructure non-iterable instance")
                    }()
                }

                if (Array.prototype.find || (Array.prototype.find = function (e) {
                    if (null === this) throw new TypeError("Array.prototype.find called on null or undefined");
                    if ("function" != typeof e) throw new TypeError("predicate must be a function");
                    for (var t, n = Object(this), r = n.length >>> 0, i = arguments[1], o = 0; o < r; o++) if (t = n[o], e.call(i, t, o, n)) return t
                }), window && "function" != typeof window.CustomEvent) {
                    var i = function (e, t) {
                        t = t || {bubbles: !1, cancelable: !1, detail: void 0};
                        var n = document.createEvent("CustomEvent");
                        return n.initCustomEvent(e, t.bubbles, t.cancelable, t.detail), n
                    };
                    void 0 !== window.Event && (i.prototype = window.Event.prototype), window.CustomEvent = i
                }
                var o = function () {
                    function t(n) {
                        e(this, t), this.tribute = n, this.tribute.events = this
                    }

                    return n(t, [{
                        key: "bind", value: function (e) {
                            e.boundKeydown = this.keydown.bind(e, this), e.boundKeyup = this.keyup.bind(e, this), e.boundInput = this.input.bind(e, this), e.addEventListener("keydown", e.boundKeydown, !1), e.addEventListener("keyup", e.boundKeyup, !1), e.addEventListener("input", e.boundInput, !1)
                        }
                    }, {
                        key: "unbind", value: function (e) {
                            e.removeEventListener("keydown", e.boundKeydown, !1), e.removeEventListener("keyup", e.boundKeyup, !1), e.removeEventListener("input", e.boundInput, !1), delete e.boundKeydown, delete e.boundKeyup, delete e.boundInput
                        }
                    }, {
                        key: "keydown", value: function (e, n) {
                            e.shouldDeactivate(n) && (e.tribute.isActive = !1, e.tribute.hideMenu());
                            var r = this;
                            e.commandEvent = !1, t.keys().forEach((function (t) {
                                t.key === n.keyCode && (e.commandEvent = !0, e.callbacks()[t.value.toLowerCase()](n, r))
                            }))
                        }
                    }, {
                        key: "input", value: function (e, t) {
                            e.inputEvent = !0, e.keyup.call(this, e, t)
                        }
                    }, {
                        key: "click", value: function (e, t) {
                            var n = e.tribute;
                            if (n.menu && n.menu.contains(t.target)) {
                                var r = t.target;
                                for (t.preventDefault(), t.stopPropagation(); "li" !== r.nodeName.toLowerCase();) if (!(r = r.parentNode) || r === n.menu) throw new Error("cannot find the <li> container for the click");
                                n.selectItemAtIndex(r.getAttribute("data-index"), t), n.hideMenu()
                            } else n.current.element && !n.current.externalTrigger && (n.current.externalTrigger = !1, setTimeout((function () {
                                return n.hideMenu()
                            })))
                        }
                    }, {
                        key: "keyup", value: function (e, t) {
                            if (e.inputEvent && (e.inputEvent = !1), e.updateSelection(this), 27 !== t.keyCode) {
                                if (!e.tribute.allowSpaces && e.tribute.hasTrailingSpace) return e.tribute.hasTrailingSpace = !1, e.commandEvent = !0, void e.callbacks().space(t, this);
                                if (!e.tribute.isActive) if (e.tribute.autocompleteMode) e.callbacks().triggerChar(t, this, ""); else {
                                    var n = e.getKeyCode(e, this, t);
                                    if (isNaN(n) || !n) return;
                                    var r = e.tribute.triggers().find((function (e) {
                                        return e.charCodeAt(0) === n
                                    }));
                                    void 0 !== r && e.callbacks().triggerChar(t, this, r)
                                }
                                e.tribute.current.mentionText.length < e.tribute.current.collection.menuShowMinLength || ((e.tribute.current.trigger || e.tribute.autocompleteMode) && !1 === e.commandEvent || e.tribute.isActive && 8 === t.keyCode) && e.tribute.showMenuFor(this, !0)
                            }
                        }
                    }, {
                        key: "shouldDeactivate", value: function (e) {
                            if (!this.tribute.isActive) return !1;
                            if (0 === this.tribute.current.mentionText.length) {
                                var n = !1;
                                return t.keys().forEach((function (t) {
                                    e.keyCode === t.key && (n = !0)
                                })), !n
                            }
                            return !1
                        }
                    }, {
                        key: "getKeyCode", value: function (e, t, n) {
                            var r = e.tribute,
                                i = r.range.getTriggerInfo(!1, r.hasTrailingSpace, !0, r.allowSpaces, r.autocompleteMode);
                            return !!i && i.mentionTriggerChar.charCodeAt(0)
                        }
                    }, {
                        key: "updateSelection", value: function (e) {
                            this.tribute.current.element = e;
                            var t = this.tribute.range.getTriggerInfo(!1, this.tribute.hasTrailingSpace, !0, this.tribute.allowSpaces, this.tribute.autocompleteMode);
                            t && (this.tribute.current.selectedPath = t.mentionSelectedPath, this.tribute.current.mentionText = t.mentionText, this.tribute.current.selectedOffset = t.mentionSelectedOffset)
                        }
                    }, {
                        key: "callbacks", value: function () {
                            var e = this;
                            return {
                                triggerChar: function (t, n, r) {
                                    var i = e.tribute;
                                    i.current.trigger = r;
                                    var o = i.collection.find((function (e) {
                                        return e.trigger === r
                                    }));
                                    i.current.collection = o, i.current.mentionText.length >= i.current.collection.menuShowMinLength && i.inputEvent && i.showMenuFor(n, !0)
                                }, enter: function (t, n) {
                                    e.tribute.isActive && e.tribute.current.filteredItems && (t.preventDefault(), t.stopPropagation(), setTimeout((function () {
                                        e.tribute.selectItemAtIndex(e.tribute.menuSelected, t), e.tribute.hideMenu()
                                    }), 0))
                                }, escape: function (t, n) {
                                    e.tribute.isActive && (t.preventDefault(), t.stopPropagation(), e.tribute.isActive = !1, e.tribute.hideMenu())
                                }, tab: function (t, n) {
                                    e.callbacks().enter(t, n)
                                }, space: function (t, n) {
                                    e.tribute.isActive && (e.tribute.spaceSelectsMatch ? e.callbacks().enter(t, n) : e.tribute.allowSpaces || (t.stopPropagation(), setTimeout((function () {
                                        e.tribute.hideMenu(), e.tribute.isActive = !1
                                    }), 0)))
                                }, up: function (t, n) {
                                    if (e.tribute.isActive && e.tribute.current.filteredItems) {
                                        t.preventDefault(), t.stopPropagation();
                                        var r = e.tribute.current.filteredItems.length, i = e.tribute.menuSelected;
                                        r > i && i > 0 ? (e.tribute.menuSelected--, e.setActiveLi()) : 0 === i && (e.tribute.menuSelected = r - 1, e.setActiveLi(), e.tribute.menu.scrollTop = e.tribute.menu.scrollHeight)
                                    }
                                }, down: function (t, n) {
                                    if (e.tribute.isActive && e.tribute.current.filteredItems) {
                                        t.preventDefault(), t.stopPropagation();
                                        var r = e.tribute.current.filteredItems.length - 1, i = e.tribute.menuSelected;
                                        r > i ? (e.tribute.menuSelected++, e.setActiveLi()) : r === i && (e.tribute.menuSelected = 0, e.setActiveLi(), e.tribute.menu.scrollTop = 0)
                                    }
                                }, delete: function (t, n) {
                                    e.tribute.isActive && e.tribute.current.mentionText.length < 1 ? e.tribute.hideMenu() : e.tribute.isActive && e.tribute.showMenuFor(n)
                                }
                            }
                        }
                    }, {
                        key: "setActiveLi", value: function (e) {
                            var t = this.tribute.menu.querySelectorAll("li"), n = t.length >>> 0;
                            e && (this.tribute.menuSelected = parseInt(e));
                            for (var r = 0; r < n; r++) {
                                var i = t[r];
                                if (r === this.tribute.menuSelected) {
                                    i.classList.add(this.tribute.current.collection.selectClass);
                                    var o = i.getBoundingClientRect(), a = this.tribute.menu.getBoundingClientRect();
                                    if (o.bottom > a.bottom) {
                                        var s = o.bottom - a.bottom;
                                        this.tribute.menu.scrollTop += s
                                    } else if (o.top < a.top) {
                                        var l = a.top - o.top;
                                        this.tribute.menu.scrollTop -= l
                                    }
                                } else i.classList.remove(this.tribute.current.collection.selectClass)
                            }
                        }
                    }, {
                        key: "getFullHeight", value: function (e, t) {
                            var n = e.getBoundingClientRect().height;
                            if (t) {
                                var r = e.currentStyle || window.getComputedStyle(e);
                                return n + parseFloat(r.marginTop) + parseFloat(r.marginBottom)
                            }
                            return n
                        }
                    }], [{
                        key: "keys", value: function () {
                            return [{key: 9, value: "TAB"}, {key: 8, value: "DELETE"}, {
                                key: 13,
                                value: "ENTER"
                            }, {key: 27, value: "ESCAPE"}, {key: 32, value: "SPACE"}, {key: 38, value: "UP"}, {
                                key: 40,
                                value: "DOWN"
                            }]
                        }
                    }]), t
                }(), a = function () {
                    function t(n) {
                        e(this, t), this.tribute = n, this.tribute.menuEvents = this, this.menu = this.tribute.menu
                    }

                    return n(t, [{
                        key: "bind", value: function (e) {
                            var t = this;
                            this.menuClickEvent = this.tribute.events.click.bind(null, this), this.menuContainerScrollEvent = this.debounce((function () {
                                t.tribute.isActive && t.tribute.showMenuFor(t.tribute.current.element, !1)
                            }), 300, !1), this.windowResizeEvent = this.debounce((function () {
                                t.tribute.isActive && t.tribute.range.positionMenuAtCaret(!0)
                            }), 300, !1), this.tribute.range.getDocument().addEventListener("MSPointerDown", this.menuClickEvent, !1), this.tribute.range.getDocument().addEventListener("mousedown", this.menuClickEvent, !1), window.addEventListener("resize", this.windowResizeEvent), this.menuContainer ? this.menuContainer.addEventListener("scroll", this.menuContainerScrollEvent, !1) : window.addEventListener("scroll", this.menuContainerScrollEvent)
                        }
                    }, {
                        key: "unbind", value: function (e) {
                            this.tribute.range.getDocument().removeEventListener("mousedown", this.menuClickEvent, !1), this.tribute.range.getDocument().removeEventListener("MSPointerDown", this.menuClickEvent, !1), window.removeEventListener("resize", this.windowResizeEvent), this.menuContainer ? this.menuContainer.removeEventListener("scroll", this.menuContainerScrollEvent, !1) : window.removeEventListener("scroll", this.menuContainerScrollEvent)
                        }
                    }, {
                        key: "debounce", value: function (e, t, n) {
                            var r, i = arguments, o = this;
                            return function () {
                                var a = o, s = i, l = n && !r;
                                clearTimeout(r), r = setTimeout((function () {
                                    r = null, n || e.apply(a, s)
                                }), t), l && e.apply(a, s)
                            }
                        }
                    }]), t
                }(), s = function () {
                    function t(n) {
                        e(this, t), this.tribute = n, this.tribute.range = this
                    }

                    return n(t, [{
                        key: "getDocument", value: function () {
                            var e;
                            return this.tribute.current.collection && (e = this.tribute.current.collection.iframe), e ? e.contentWindow.document : document
                        }
                    }, {
                        key: "positionMenuAtCaret", value: function (e) {
                            var t, n = this, r = this.tribute.current,
                                i = this.getTriggerInfo(!1, this.tribute.hasTrailingSpace, !0, this.tribute.allowSpaces, this.tribute.autocompleteMode);
                            if (void 0 !== i) {
                                if (!this.tribute.positionMenu) return void (this.tribute.menu.style.cssText = "display: block;");
                                t = this.isContentEditable(r.element) ? this.getContentEditableCaretPosition(i.mentionPosition) : this.getTextAreaOrInputUnderlinePosition(this.tribute.current.element, i.mentionPosition), this.tribute.menu.style.cssText = "top: ".concat(t.top, "px;\n                                     left: ").concat(t.left, "px;\n                                     right: ").concat(t.right, "px;\n                                     bottom: ").concat(t.bottom, "px;\n                                     position: absolute;\n                                     display: block;"), "auto" === t.left && (this.tribute.menu.style.left = "auto"), "auto" === t.top && (this.tribute.menu.style.top = "auto"), e && this.scrollIntoView(), window.setTimeout((function () {
                                    var r = {width: n.tribute.menu.offsetWidth, height: n.tribute.menu.offsetHeight},
                                        i = n.isMenuOffScreen(t, r),
                                        o = window.innerWidth > r.width && (i.left || i.right),
                                        a = window.innerHeight > r.height && (i.top || i.bottom);
                                    (o || a) && (n.tribute.menu.style.cssText = "display: none", n.positionMenuAtCaret(e))
                                }), 0)
                            } else this.tribute.menu.style.cssText = "display: none"
                        }
                    }, {
                        key: "selectElement", value: function (e, t, n) {
                            var r, i = e;
                            if (t) for (var o = 0; o < t.length; o++) {
                                if (void 0 === (i = i.childNodes[t[o]])) return;
                                for (; i.length < n;) n -= i.length, i = i.nextSibling;
                                0 !== i.childNodes.length || i.length || (i = i.previousSibling)
                            }
                            var a = this.getWindowSelection();
                            (r = this.getDocument().createRange()).setStart(i, n), r.setEnd(i, n), r.collapse(!0);
                            try {
                                a.removeAllRanges()
                            } catch (e) {
                            }
                            a.addRange(r), e.focus()
                        }
                    }, {
                        key: "replaceTriggerText", value: function (e, t, n, r, i) {
                            var o = this.getTriggerInfo(!0, n, t, this.tribute.allowSpaces, this.tribute.autocompleteMode);
                            if (void 0 !== o) {
                                var a = this.tribute.current, s = new CustomEvent("tribute-replaced", {
                                    detail: {
                                        item: i,
                                        instance: a,
                                        context: o,
                                        event: r
                                    }
                                });
                                if (this.isContentEditable(a.element)) {
                                    e += "string" == typeof this.tribute.replaceTextSuffix ? this.tribute.replaceTextSuffix : " ";
                                    var l = o.mentionPosition + o.mentionText.length;
                                    this.tribute.autocompleteMode || (l += o.mentionTriggerChar.length), this.pasteHtml(e, o.mentionPosition, l)
                                } else {
                                    var c = this.tribute.current.element,
                                        u = "string" == typeof this.tribute.replaceTextSuffix ? this.tribute.replaceTextSuffix : " ";
                                    e += u;
                                    var d = o.mentionPosition, p = o.mentionPosition + o.mentionText.length + u.length;
                                    this.tribute.autocompleteMode || (p += o.mentionTriggerChar.length - 1), c.value = c.value.substring(0, d) + e + c.value.substring(p, c.value.length), c.selectionStart = d + e.length, c.selectionEnd = d + e.length
                                }
                                a.element.dispatchEvent(new CustomEvent("input", {bubbles: !0})), a.element.dispatchEvent(s)
                            }
                        }
                    }, {
                        key: "pasteHtml", value: function (e, t, n) {
                            var r, i;
                            i = this.getWindowSelection(), (r = this.getDocument().createRange()).setStart(i.anchorNode, t), r.setEnd(i.anchorNode, n), r.deleteContents();
                            var o = this.getDocument().createElement("div");
                            o.innerHTML = e;
                            for (var a, s, l = this.getDocument().createDocumentFragment(); a = o.firstChild;) s = l.appendChild(a);
                            r.insertNode(l), s && ((r = r.cloneRange()).setStartAfter(s), r.collapse(!0), i.removeAllRanges(), i.addRange(r))
                        }
                    }, {
                        key: "getWindowSelection", value: function () {
                            return this.tribute.collection.iframe ? this.tribute.collection.iframe.contentWindow.getSelection() : window.getSelection()
                        }
                    }, {
                        key: "getNodePositionInParent", value: function (e) {
                            if (null === e.parentNode) return 0;
                            for (var t = 0; t < e.parentNode.childNodes.length; t++) if (e.parentNode.childNodes[t] === e) return t
                        }
                    }, {
                        key: "getContentEditableSelectedPath", value: function (e) {
                            var t = this.getWindowSelection(), n = t.anchorNode, r = [];
                            if (null != n) {
                                for (var i, o = n.contentEditable; null !== n && "true" !== o;) i = this.getNodePositionInParent(n), r.push(i), null !== (n = n.parentNode) && (o = n.contentEditable);
                                return r.reverse(), {selected: n, path: r, offset: t.getRangeAt(0).startOffset}
                            }
                        }
                    }, {
                        key: "getTextPrecedingCurrentSelection", value: function () {
                            var e = this.tribute.current, t = "";
                            if (this.isContentEditable(e.element)) {
                                var n = this.getWindowSelection().anchorNode;
                                if (null != n) {
                                    var r = n.textContent, i = this.getWindowSelection().getRangeAt(0).startOffset;
                                    r && i >= 0 && (t = r.substring(0, i))
                                }
                            } else {
                                var o = this.tribute.current.element;
                                if (o) {
                                    var a = o.selectionStart;
                                    o.value && a >= 0 && (t = o.value.substring(0, a))
                                }
                            }
                            return t
                        }
                    }, {
                        key: "getLastWordInText", value: function (e) {
                            var t = (e = e.replace(/\u00A0/g, " ")).split(/\s+/);
                            return t[t.length - 1].trim()
                        }
                    }, {
                        key: "getTriggerInfo", value: function (e, t, n, r, i) {
                            var o, a, s, l = this, c = this.tribute.current;
                            if (this.isContentEditable(c.element)) {
                                var u = this.getContentEditableSelectedPath(c);
                                u && (o = u.selected, a = u.path, s = u.offset)
                            } else o = this.tribute.current.element;
                            var d = this.getTextPrecedingCurrentSelection(), p = this.getLastWordInText(d);
                            if (i) return {
                                mentionPosition: d.length - p.length,
                                mentionText: p,
                                mentionSelectedElement: o,
                                mentionSelectedPath: a,
                                mentionSelectedOffset: s
                            };
                            if (null != d) {
                                var h, f = -1;
                                if (this.tribute.collection.forEach((function (e) {
                                    var t = e.trigger,
                                        r = e.requireLeadingSpace ? l.lastIndexWithLeadingSpace(d, t) : d.lastIndexOf(t);
                                    r > f && (f = r, h = t, n = e.requireLeadingSpace)
                                })), f >= 0 && (0 === f || !n || /[\xA0\s]/g.test(d.substring(f - 1, f)))) {
                                    var g = d.substring(f + h.length, d.length);
                                    h = d.substring(f, f + h.length);
                                    var m = g.substring(0, 1), v = g.length > 0 && (" " === m || " " === m);
                                    t && (g = g.trim());
                                    var b = r ? /[^\S ]/g : /[\xA0\s]/g;
                                    if (this.tribute.hasTrailingSpace = b.test(g), !v && (e || !b.test(g))) return {
                                        mentionPosition: f,
                                        mentionText: g,
                                        mentionSelectedElement: o,
                                        mentionSelectedPath: a,
                                        mentionSelectedOffset: s,
                                        mentionTriggerChar: h
                                    }
                                }
                            }
                        }
                    }, {
                        key: "lastIndexWithLeadingSpace", value: function (e, t) {
                            for (var n = e.split("").reverse().join(""), r = -1, i = 0, o = e.length; i < o; i++) {
                                for (var a = i === e.length - 1, s = /\s/.test(n[i + 1]), l = !0, c = t.length - 1; c >= 0; c--) if (t[c] !== n[i - c]) {
                                    l = !1;
                                    break
                                }
                                if (l && (a || s)) {
                                    r = e.length - 1 - i;
                                    break
                                }
                            }
                            return r
                        }
                    }, {
                        key: "isContentEditable", value: function (e) {
                            return "INPUT" !== e.nodeName && "TEXTAREA" !== e.nodeName
                        }
                    }, {
                        key: "isMenuOffScreen", value: function (e, t) {
                            var n = window.innerWidth, r = window.innerHeight, i = document.documentElement,
                                o = (window.pageXOffset || i.scrollLeft) - (i.clientLeft || 0),
                                a = (window.pageYOffset || i.scrollTop) - (i.clientTop || 0),
                                s = "number" == typeof e.top ? e.top : a + r - e.bottom - t.height,
                                l = "number" == typeof e.right ? e.right : e.left + t.width,
                                c = "number" == typeof e.bottom ? e.bottom : e.top + t.height,
                                u = "number" == typeof e.left ? e.left : o + n - e.right - t.width;
                            return {
                                top: s < Math.floor(a),
                                right: l > Math.ceil(o + n),
                                bottom: c > Math.ceil(a + r),
                                left: u < Math.floor(o)
                            }
                        }
                    }, {
                        key: "getMenuDimensions", value: function () {
                            var e = {width: null, height: null};
                            return this.tribute.menu.style.cssText = "top: 0px;\n                                 left: 0px;\n                                 position: fixed;\n                                 display: block;\n                                 visibility; hidden;", e.width = this.tribute.menu.offsetWidth, e.height = this.tribute.menu.offsetHeight, this.tribute.menu.style.cssText = "display: none;", e
                        }
                    }, {
                        key: "getTextAreaOrInputUnderlinePosition", value: function (e, t, n) {
                            var r = null !== window.mozInnerScreenX, i = this.getDocument().createElement("div");
                            i.id = "input-textarea-caret-position-mirror-div", this.getDocument().body.appendChild(i);
                            var o = i.style, a = window.getComputedStyle ? getComputedStyle(e) : e.currentStyle;
                            o.whiteSpace = "pre-wrap", "INPUT" !== e.nodeName && (o.wordWrap = "break-word"), o.position = "absolute", o.visibility = "hidden", ["direction", "boxSizing", "width", "height", "overflowX", "overflowY", "borderTopWidth", "borderRightWidth", "borderBottomWidth", "borderLeftWidth", "paddingTop", "paddingRight", "paddingBottom", "paddingLeft", "fontStyle", "fontVariant", "fontWeight", "fontStretch", "fontSize", "fontSizeAdjust", "lineHeight", "fontFamily", "textAlign", "textTransform", "textIndent", "textDecoration", "letterSpacing", "wordSpacing"].forEach((function (e) {
                                o[e] = a[e]
                            })), r ? (o.width = "".concat(parseInt(a.width) - 2, "px"), e.scrollHeight > parseInt(a.height) && (o.overflowY = "scroll")) : o.overflow = "hidden", i.textContent = e.value.substring(0, t), "INPUT" === e.nodeName && (i.textContent = i.textContent.replace(/\s/g, " "));
                            var s = this.getDocument().createElement("span");
                            s.textContent = e.value.substring(t) || ".", i.appendChild(s);
                            var l = e.getBoundingClientRect(), c = document.documentElement,
                                u = (window.pageXOffset || c.scrollLeft) - (c.clientLeft || 0),
                                d = (window.pageYOffset || c.scrollTop) - (c.clientTop || 0), p = 0, h = 0;
                            this.menuContainerIsBody && (p = l.top, h = l.left);
                            var f = {
                                    top: p + d + s.offsetTop + parseInt(a.borderTopWidth) + parseInt(a.fontSize) - e.scrollTop,
                                    left: h + u + s.offsetLeft + parseInt(a.borderLeftWidth)
                                }, g = window.innerWidth, m = window.innerHeight, v = this.getMenuDimensions(),
                                b = this.isMenuOffScreen(f, v);
                            b.right && (f.right = g - f.left, f.left = "auto");
                            var w = this.tribute.menuContainer ? this.tribute.menuContainer.offsetHeight : this.getDocument().body.offsetHeight;
                            if (b.bottom) {
                                var y = w - (m - (this.tribute.menuContainer ? this.tribute.menuContainer.getBoundingClientRect() : this.getDocument().body.getBoundingClientRect()).top);
                                f.bottom = y + (m - l.top - s.offsetTop), f.top = "auto"
                            }
                            return (b = this.isMenuOffScreen(f, v)).left && (f.left = g > v.width ? u + g - v.width : u, delete f.right), b.top && (f.top = m > v.height ? d + m - v.height : d, delete f.bottom), this.getDocument().body.removeChild(i), f
                        }
                    }, {
                        key: "getContentEditableCaretPosition", value: function (e) {
                            var t, n = this.getWindowSelection();
                            (t = this.getDocument().createRange()).setStart(n.anchorNode, e), t.setEnd(n.anchorNode, e), t.collapse(!1);
                            var r = t.getBoundingClientRect(), i = document.documentElement,
                                o = (window.pageXOffset || i.scrollLeft) - (i.clientLeft || 0),
                                a = (window.pageYOffset || i.scrollTop) - (i.clientTop || 0),
                                s = {left: r.left + o, top: r.top + r.height + a}, l = window.innerWidth,
                                c = window.innerHeight, u = this.getMenuDimensions(), d = this.isMenuOffScreen(s, u);
                            d.right && (s.left = "auto", s.right = l - r.left - o);
                            var p = this.tribute.menuContainer ? this.tribute.menuContainer.offsetHeight : this.getDocument().body.offsetHeight;
                            if (d.bottom) {
                                var h = p - (c - (this.tribute.menuContainer ? this.tribute.menuContainer.getBoundingClientRect() : this.getDocument().body.getBoundingClientRect()).top);
                                s.top = "auto", s.bottom = h + (c - r.top)
                            }
                            return (d = this.isMenuOffScreen(s, u)).left && (s.left = l > u.width ? o + l - u.width : o, delete s.right), d.top && (s.top = c > u.height ? a + c - u.height : a, delete s.bottom), this.menuContainerIsBody || (s.left = s.left ? s.left - this.tribute.menuContainer.offsetLeft : s.left, s.top = s.top ? s.top - this.tribute.menuContainer.offsetTop : s.top), s
                        }
                    }, {
                        key: "scrollIntoView", value: function (e) {
                            var t, n = this.menu;
                            if (void 0 !== n) {
                                for (; void 0 === t || 0 === t.height;) if (0 === (t = n.getBoundingClientRect()).height && (void 0 === (n = n.childNodes[0]) || !n.getBoundingClientRect)) return;
                                var r = t.top, i = r + t.height;
                                if (r < 0) window.scrollTo(0, window.pageYOffset + t.top - 20); else if (i > window.innerHeight) {
                                    var o = window.pageYOffset + t.top - 20;
                                    o - window.pageYOffset > 100 && (o = window.pageYOffset + 100);
                                    var a = window.pageYOffset - (window.innerHeight - i);
                                    a > o && (a = o), window.scrollTo(0, a)
                                }
                            }
                        }
                    }, {
                        key: "menuContainerIsBody", get: function () {
                            return this.tribute.menuContainer === document.body || !this.tribute.menuContainer
                        }
                    }]), t
                }(), l = function () {
                    function t(n) {
                        e(this, t), this.tribute = n, this.tribute.search = this
                    }

                    return n(t, [{
                        key: "simpleFilter", value: function (e, t) {
                            var n = this;
                            return t.filter((function (t) {
                                return n.test(e, t)
                            }))
                        }
                    }, {
                        key: "test", value: function (e, t) {
                            return null !== this.match(e, t)
                        }
                    }, {
                        key: "match", value: function (e, t, n) {
                            n = n || {}, t.length;
                            var r = n.pre || "", i = n.post || "", o = n.caseSensitive && t || t.toLowerCase();
                            if (n.skip) return {rendered: t, score: 0};
                            e = n.caseSensitive && e || e.toLowerCase();
                            var a = this.traverse(o, e, 0, 0, []);
                            return a ? {rendered: this.render(t, a.cache, r, i), score: a.score} : null
                        }
                    }, {
                        key: "traverse", value: function (e, t, n, r, i) {
                            if (t.length === r) return {score: this.calculateScore(i), cache: i.slice()};
                            if (!(e.length === n || t.length - r > e.length - n)) {
                                for (var o, a, s = t[r], l = e.indexOf(s, n); l > -1;) {
                                    if (i.push(l), a = this.traverse(e, t, l + 1, r + 1, i), i.pop(), !a) return o;
                                    (!o || o.score < a.score) && (o = a), l = e.indexOf(s, l + 1)
                                }
                                return o
                            }
                        }
                    }, {
                        key: "calculateScore", value: function (e) {
                            var t = 0, n = 1;
                            return e.forEach((function (r, i) {
                                i > 0 && (e[i - 1] + 1 === r ? n += n + 1 : n = 1), t += n
                            })), t
                        }
                    }, {
                        key: "render", value: function (e, t, n, r) {
                            var i = e.substring(0, t[0]);
                            return t.forEach((function (o, a) {
                                i += n + e[o] + r + e.substring(o + 1, t[a + 1] ? t[a + 1] : e.length)
                            })), i
                        }
                    }, {
                        key: "filter", value: function (e, t, n) {
                            var r = this;
                            return n = n || {}, t.reduce((function (t, i, o, a) {
                                var s = i;
                                n.extract && ((s = n.extract(i)) || (s = ""));
                                var l = r.match(e, s, n);
                                return null != l && (t[t.length] = {
                                    string: l.rendered,
                                    score: l.score,
                                    index: o,
                                    original: i
                                }), t
                            }), []).sort((function (e, t) {
                                return t.score - e.score || e.index - t.index
                            }))
                        }
                    }]), t
                }();
                return function () {
                    function t(n) {
                        var r, i = this, c = n.values, u = void 0 === c ? null : c, d = n.iframe,
                            p = void 0 === d ? null : d, h = n.selectClass, f = void 0 === h ? "highlight" : h,
                            g = n.containerClass, m = void 0 === g ? "tribute-container" : g, v = n.itemClass,
                            b = void 0 === v ? "" : v, w = n.trigger, y = void 0 === w ? "@" : w,
                            _ = n.autocompleteMode, k = void 0 !== _ && _, x = n.selectTemplate,
                            S = void 0 === x ? null : x, C = n.menuItemTemplate, E = void 0 === C ? null : C,
                            T = n.lookup, A = void 0 === T ? "key" : T, O = n.fillAttr, P = void 0 === O ? "value" : O,
                            M = n.collection, L = void 0 === M ? null : M, j = n.menuContainer,
                            N = void 0 === j ? null : j, I = n.noMatchTemplate, z = void 0 === I ? null : I,
                            R = n.requireLeadingSpace, B = void 0 === R || R, D = n.allowSpaces, H = void 0 !== D && D,
                            $ = n.replaceTextSuffix, q = void 0 === $ ? null : $, F = n.positionMenu,
                            U = void 0 === F || F, V = n.spaceSelectsMatch, W = void 0 !== V && V, G = n.searchOpts,
                            K = void 0 === G ? {} : G, X = n.menuItemLimit, Z = void 0 === X ? null : X,
                            Y = n.menuShowMinLength, J = void 0 === Y ? 0 : Y;
                        if (e(this, t), this.autocompleteMode = k, this.menuSelected = 0, this.current = {}, this.inputEvent = !1, this.isActive = !1, this.menuContainer = N, this.allowSpaces = H, this.replaceTextSuffix = q, this.positionMenu = U, this.hasTrailingSpace = !1, this.spaceSelectsMatch = W, this.autocompleteMode && (y = "", H = !1), u) this.collection = [{
                            trigger: y,
                            iframe: p,
                            selectClass: f,
                            containerClass: m,
                            itemClass: b,
                            selectTemplate: (S || t.defaultSelectTemplate).bind(this),
                            menuItemTemplate: (E || t.defaultMenuItemTemplate).bind(this),
                            noMatchTemplate: (r = z, "string" == typeof r ? "" === r.trim() ? null : r : "function" == typeof r ? r.bind(i) : z || function () {
                                return "<li>No Match Found!</li>"
                            }.bind(i)),
                            lookup: A,
                            fillAttr: P,
                            values: u,
                            requireLeadingSpace: B,
                            searchOpts: K,
                            menuItemLimit: Z,
                            menuShowMinLength: J
                        }]; else {
                            if (!L) throw new Error("[Tribute] No collection specified.");
                            this.autocompleteMode && console.warn("Tribute in autocomplete mode does not work for collections"), this.collection = L.map((function (e) {
                                return {
                                    trigger: e.trigger || y,
                                    iframe: e.iframe || p,
                                    selectClass: e.selectClass || f,
                                    containerClass: e.containerClass || m,
                                    itemClass: e.itemClass || b,
                                    selectTemplate: (e.selectTemplate || t.defaultSelectTemplate).bind(i),
                                    menuItemTemplate: (e.menuItemTemplate || t.defaultMenuItemTemplate).bind(i),
                                    noMatchTemplate: function (e) {
                                        return "string" == typeof e ? "" === e.trim() ? null : e : "function" == typeof e ? e.bind(i) : z || function () {
                                            return "<li>No Match Found!</li>"
                                        }.bind(i)
                                    }(z),
                                    lookup: e.lookup || A,
                                    fillAttr: e.fillAttr || P,
                                    values: e.values,
                                    requireLeadingSpace: e.requireLeadingSpace,
                                    searchOpts: e.searchOpts || K,
                                    menuItemLimit: e.menuItemLimit || Z,
                                    menuShowMinLength: e.menuShowMinLength || J
                                }
                            }))
                        }
                        new s(this), new o(this), new a(this), new l(this)
                    }

                    return n(t, [{
                        key: "triggers", value: function () {
                            return this.collection.map((function (e) {
                                return e.trigger
                            }))
                        }
                    }, {
                        key: "attach", value: function (e) {
                            if (!e) throw new Error("[Tribute] Must pass in a DOM node or NodeList.");
                            if ("undefined" != typeof jQuery && e instanceof jQuery && (e = e.get()), e.constructor === NodeList || e.constructor === HTMLCollection || e.constructor === Array) for (var t = e.length, n = 0; n < t; ++n) this._attach(e[n]); else this._attach(e)
                        }
                    }, {
                        key: "_attach", value: function (e) {
                            e.hasAttribute("data-tribute") && console.warn("Tribute was already bound to " + e.nodeName), this.ensureEditable(e), this.events.bind(e), e.setAttribute("data-tribute", !0)
                        }
                    }, {
                        key: "ensureEditable", value: function (e) {
                            if (-1 === t.inputTypes().indexOf(e.nodeName)) {
                                if (!e.contentEditable) throw new Error("[Tribute] Cannot bind to " + e.nodeName);
                                e.contentEditable = !0
                            }
                        }
                    }, {
                        key: "createMenu", value: function (e) {
                            var t = this.range.getDocument().createElement("div"),
                                n = this.range.getDocument().createElement("ul");
                            return t.className = e, t.appendChild(n), this.menuContainer ? this.menuContainer.appendChild(t) : this.range.getDocument().body.appendChild(t)
                        }
                    }, {
                        key: "showMenuFor", value: function (e, t) {
                            var n = this;
                            if (!this.isActive || this.current.element !== e || this.current.mentionText !== this.currentMentionTextSnapshot) {
                                this.currentMentionTextSnapshot = this.current.mentionText, this.menu || (this.menu = this.createMenu(this.current.collection.containerClass), e.tributeMenu = this.menu, this.menuEvents.bind(this.menu)), this.isActive = !0, this.menuSelected = 0, this.current.mentionText || (this.current.mentionText = "");
                                var i = function (e) {
                                    if (n.isActive) {
                                        var i = n.search.filter(n.current.mentionText, e, {
                                            pre: n.current.collection.searchOpts.pre || "<span>",
                                            post: n.current.collection.searchOpts.post || "</span>",
                                            skip: n.current.collection.searchOpts.skip,
                                            extract: function (e) {
                                                if ("string" == typeof n.current.collection.lookup) return e[n.current.collection.lookup];
                                                if ("function" == typeof n.current.collection.lookup) return n.current.collection.lookup(e, n.current.mentionText);
                                                throw new Error("Invalid lookup attribute, lookup must be string or function.")
                                            }
                                        });
                                        n.current.collection.menuItemLimit && (i = i.slice(0, n.current.collection.menuItemLimit)), n.current.filteredItems = i;
                                        var o = n.menu.querySelector("ul");
                                        if (n.range.positionMenuAtCaret(t), !i.length) {
                                            var a = new CustomEvent("tribute-no-match", {detail: n.menu});
                                            return n.current.element.dispatchEvent(a), void ("function" == typeof n.current.collection.noMatchTemplate && !n.current.collection.noMatchTemplate() || !n.current.collection.noMatchTemplate ? n.hideMenu() : "function" == typeof n.current.collection.noMatchTemplate ? o.innerHTML = n.current.collection.noMatchTemplate() : o.innerHTML = n.current.collection.noMatchTemplate)
                                        }
                                        o.innerHTML = "";
                                        var s = n.range.getDocument().createDocumentFragment();
                                        i.forEach((function (e, t) {
                                            var i = n.range.getDocument().createElement("li");
                                            i.setAttribute("data-index", t), i.className = n.current.collection.itemClass, i.addEventListener("mousemove", (function (e) {
                                                var t = r(n._findLiTarget(e.target), 2), i = (t[0], t[1]);
                                                0 !== e.movementY && n.events.setActiveLi(i)
                                            })), n.menuSelected === t && i.classList.add(n.current.collection.selectClass), i.innerHTML = n.current.collection.menuItemTemplate(e), s.appendChild(i)
                                        })), o.appendChild(s)
                                    }
                                };
                                "function" == typeof this.current.collection.values ? this.current.collection.values(this.current.mentionText, i) : i(this.current.collection.values)
                            }
                        }
                    }, {
                        key: "_findLiTarget", value: function (e) {
                            if (!e) return [];
                            var t = e.getAttribute("data-index");
                            return t ? [e, t] : this._findLiTarget(e.parentNode)
                        }
                    }, {
                        key: "showMenuForCollection", value: function (e, t) {
                            e !== document.activeElement && this.placeCaretAtEnd(e), this.current.collection = this.collection[t || 0], this.current.externalTrigger = !0, this.current.element = e, e.isContentEditable ? this.insertTextAtCursor(this.current.collection.trigger) : this.insertAtCaret(e, this.current.collection.trigger), this.showMenuFor(e)
                        }
                    }, {
                        key: "placeCaretAtEnd", value: function (e) {
                            if (e.focus(), void 0 !== window.getSelection && void 0 !== document.createRange) {
                                var t = document.createRange();
                                t.selectNodeContents(e), t.collapse(!1);
                                var n = window.getSelection();
                                n.removeAllRanges(), n.addRange(t)
                            } else if (void 0 !== document.body.createTextRange) {
                                var r = document.body.createTextRange();
                                r.moveToElementText(e), r.collapse(!1), r.select()
                            }
                        }
                    }, {
                        key: "insertTextAtCursor", value: function (e) {
                            var t, n;
                            (n = (t = window.getSelection()).getRangeAt(0)).deleteContents();
                            var r = document.createTextNode(e);
                            n.insertNode(r), n.selectNodeContents(r), n.collapse(!1), t.removeAllRanges(), t.addRange(n)
                        }
                    }, {
                        key: "insertAtCaret", value: function (e, t) {
                            var n = e.scrollTop, r = e.selectionStart, i = e.value.substring(0, r),
                                o = e.value.substring(e.selectionEnd, e.value.length);
                            e.value = i + t + o, r += t.length, e.selectionStart = r, e.selectionEnd = r, e.focus(), e.scrollTop = n
                        }
                    }, {
                        key: "hideMenu", value: function () {
                            this.menu && (this.menu.style.cssText = "display: none;", this.isActive = !1, this.menuSelected = 0, this.current = {})
                        }
                    }, {
                        key: "selectItemAtIndex", value: function (e, t) {
                            if ("number" == typeof (e = parseInt(e)) && !isNaN(e)) {
                                var n = this.current.filteredItems[e], r = this.current.collection.selectTemplate(n);
                                null !== r && this.replaceText(r, t, n)
                            }
                        }
                    }, {
                        key: "replaceText", value: function (e, t, n) {
                            this.range.replaceTriggerText(e, !0, !0, t, n)
                        }
                    }, {
                        key: "_append", value: function (e, t, n) {
                            if ("function" == typeof e.values) throw new Error("Unable to append to values, as it is a function.");
                            e.values = n ? t : e.values.concat(t)
                        }
                    }, {
                        key: "append", value: function (e, t, n) {
                            var r = parseInt(e);
                            if ("number" != typeof r) throw new Error("please provide an index for the collection to update.");
                            var i = this.collection[r];
                            this._append(i, t, n)
                        }
                    }, {
                        key: "appendCurrent", value: function (e, t) {
                            if (!this.isActive) throw new Error("No active state. Please use append instead and pass an index.");
                            this._append(this.current.collection, e, t)
                        }
                    }, {
                        key: "detach", value: function (e) {
                            if (!e) throw new Error("[Tribute] Must pass in a DOM node or NodeList.");
                            if ("undefined" != typeof jQuery && e instanceof jQuery && (e = e.get()), e.constructor === NodeList || e.constructor === HTMLCollection || e.constructor === Array) for (var t = e.length, n = 0; n < t; ++n) this._detach(e[n]); else this._detach(e)
                        }
                    }, {
                        key: "_detach", value: function (e) {
                            var t = this;
                            this.events.unbind(e), e.tributeMenu && this.menuEvents.unbind(e.tributeMenu), setTimeout((function () {
                                e.removeAttribute("data-tribute"), t.isActive = !1, e.tributeMenu && e.tributeMenu.remove()
                            }))
                        }
                    }, {
                        key: "isActive", get: function () {
                            return this._isActive
                        }, set: function (e) {
                            if (this._isActive != e && (this._isActive = e, this.current.element)) {
                                var t = new CustomEvent("tribute-active-".concat(e));
                                this.current.element.dispatchEvent(t)
                            }
                        }
                    }], [{
                        key: "defaultSelectTemplate", value: function (e) {
                            return void 0 === e ? "".concat(this.current.collection.trigger).concat(this.current.mentionText) : this.range.isContentEditable(this.current.element) ? '<span class="tribute-mention">' + (this.current.collection.trigger + e.original[this.current.collection.fillAttr]) + "</span>" : this.current.collection.trigger + e.original[this.current.collection.fillAttr]
                        }
                    }, {
                        key: "defaultMenuItemTemplate", value: function (e) {
                            return e.string
                        }
                    }, {
                        key: "inputTypes", value: function () {
                            return ["TEXTAREA", "INPUT"]
                        }
                    }]), t
                }()
            }()
        }, 3390: e => {
            var t = {exports: {}};

            function n(e) {
                return e instanceof Map ? e.clear = e.delete = e.set = function () {
                    throw new Error("map is read-only")
                } : e instanceof Set && (e.add = e.clear = e.delete = function () {
                    throw new Error("set is read-only")
                }), Object.freeze(e), Object.getOwnPropertyNames(e).forEach((function (t) {
                    var r = e[t];
                    "object" != typeof r || Object.isFrozen(r) || n(r)
                })), e
            }

            t.exports = n, t.exports.default = n;
            var r = t.exports;

            class i {
                constructor(e) {
                    void 0 === e.data && (e.data = {}), this.data = e.data, this.isMatchIgnored = !1
                }

                ignoreMatch() {
                    this.isMatchIgnored = !0
                }
            }

            function o(e) {
                return e.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#x27;")
            }

            function a(e, ...t) {
                const n = Object.create(null);
                for (const t in e) n[t] = e[t];
                return t.forEach((function (e) {
                    for (const t in e) n[t] = e[t]
                })), n
            }

            const s = e => !!e.kind;

            class l {
                constructor(e, t) {
                    this.buffer = "", this.classPrefix = t.classPrefix, e.walk(this)
                }

                addText(e) {
                    this.buffer += o(e)
                }

                openNode(e) {
                    if (!s(e)) return;
                    let t = e.kind;
                    t = e.sublanguage ? `language-${t}` : ((e, {prefix: t}) => {
                        if (e.includes(".")) {
                            const n = e.split(".");
                            return [`${t}${n.shift()}`, ...n.map(((e, t) => `${e}${"_".repeat(t + 1)}`))].join(" ")
                        }
                        return `${t}${e}`
                    })(t, {prefix: this.classPrefix}), this.span(t)
                }

                closeNode(e) {
                    s(e) && (this.buffer += "</span>")
                }

                value() {
                    return this.buffer
                }

                span(e) {
                    this.buffer += `<span class="${e}">`
                }
            }

            class c {
                constructor() {
                    this.rootNode = {children: []}, this.stack = [this.rootNode]
                }

                get top() {
                    return this.stack[this.stack.length - 1]
                }

                get root() {
                    return this.rootNode
                }

                add(e) {
                    this.top.children.push(e)
                }

                openNode(e) {
                    const t = {kind: e, children: []};
                    this.add(t), this.stack.push(t)
                }

                closeNode() {
                    if (this.stack.length > 1) return this.stack.pop()
                }

                closeAllNodes() {
                    for (; this.closeNode();) ;
                }

                toJSON() {
                    return JSON.stringify(this.rootNode, null, 4)
                }

                walk(e) {
                    return this.constructor._walk(e, this.rootNode)
                }

                static _walk(e, t) {
                    return "string" == typeof t ? e.addText(t) : t.children && (e.openNode(t), t.children.forEach((t => this._walk(e, t))), e.closeNode(t)), e
                }

                static _collapse(e) {
                    "string" != typeof e && e.children && (e.children.every((e => "string" == typeof e)) ? e.children = [e.children.join("")] : e.children.forEach((e => {
                        c._collapse(e)
                    })))
                }
            }

            class u extends c {
                constructor(e) {
                    super(), this.options = e
                }

                addKeyword(e, t) {
                    "" !== e && (this.openNode(t), this.addText(e), this.closeNode())
                }

                addText(e) {
                    "" !== e && this.add(e)
                }

                addSublanguage(e, t) {
                    const n = e.root;
                    n.kind = t, n.sublanguage = !0, this.add(n)
                }

                toHTML() {
                    return new l(this, this.options).value()
                }

                finalize() {
                    return !0
                }
            }

            function d(e) {
                return e ? "string" == typeof e ? e : e.source : null
            }

            function p(e) {
                return g("(?=", e, ")")
            }

            function h(e) {
                return g("(?:", e, ")*")
            }

            function f(e) {
                return g("(?:", e, ")?")
            }

            function g(...e) {
                return e.map((e => d(e))).join("")
            }

            function m(...e) {
                const t = function (e) {
                    const t = e[e.length - 1];
                    return "object" == typeof t && t.constructor === Object ? (e.splice(e.length - 1, 1), t) : {}
                }(e);
                return "(" + (t.capture ? "" : "?:") + e.map((e => d(e))).join("|") + ")"
            }

            function v(e) {
                return new RegExp(e.toString() + "|").exec("").length - 1
            }

            const b = /\[(?:[^\\\]]|\\.)*\]|\(\??|\\([1-9][0-9]*)|\\./;

            function w(e, {joinWith: t}) {
                let n = 0;
                return e.map((e => {
                    n += 1;
                    const t = n;
                    let r = d(e), i = "";
                    for (; r.length > 0;) {
                        const e = b.exec(r);
                        if (!e) {
                            i += r;
                            break
                        }
                        i += r.substring(0, e.index), r = r.substring(e.index + e[0].length), "\\" === e[0][0] && e[1] ? i += "\\" + String(Number(e[1]) + t) : (i += e[0], "(" === e[0] && n++)
                    }
                    return i
                })).map((e => `(${e})`)).join(t)
            }

            const y = "[a-zA-Z]\\w*", _ = "[a-zA-Z_]\\w*", k = "\\b\\d+(\\.\\d+)?",
                x = "(-?)(\\b0[xX][a-fA-F0-9]+|(\\b\\d+(\\.\\d*)?|\\.\\d+)([eE][-+]?\\d+)?)", S = "\\b(0b[01]+)",
                C = {begin: "\\\\[\\s\\S]", relevance: 0},
                E = {scope: "string", begin: "'", end: "'", illegal: "\\n", contains: [C]},
                T = {scope: "string", begin: '"', end: '"', illegal: "\\n", contains: [C]},
                A = function (e, t, n = {}) {
                    const r = a({scope: "comment", begin: e, end: t, contains: []}, n);
                    r.contains.push({
                        scope: "doctag",
                        begin: "[ ]*(?=(TODO|FIXME|NOTE|BUG|OPTIMIZE|HACK|XXX):)",
                        end: /(TODO|FIXME|NOTE|BUG|OPTIMIZE|HACK|XXX):/,
                        excludeBegin: !0,
                        relevance: 0
                    });
                    const i = m("I", "a", "is", "so", "us", "to", "at", "if", "in", "it", "on", /[A-Za-z]+['](d|ve|re|ll|t|s|n)/, /[A-Za-z]+[-][a-z]+/, /[A-Za-z][a-z]{2,}/);
                    return r.contains.push({begin: g(/[ ]+/, "(", i, /[.]?[:]?([.][ ]|[ ])/, "){3}")}), r
                }, O = A("//", "$"), P = A("/\\*", "\\*/"), M = A("#", "$"),
                L = {scope: "number", begin: k, relevance: 0}, j = {scope: "number", begin: x, relevance: 0},
                N = {scope: "number", begin: S, relevance: 0}, I = {
                    begin: /(?=\/[^/\n]*\/)/,
                    contains: [{
                        scope: "regexp",
                        begin: /\//,
                        end: /\/[gimuy]*/,
                        illegal: /\n/,
                        contains: [C, {begin: /\[/, end: /\]/, relevance: 0, contains: [C]}]
                    }]
                }, z = {scope: "title", begin: y, relevance: 0}, R = {scope: "title", begin: _, relevance: 0},
                B = {begin: "\\.\\s*[a-zA-Z_]\\w*", relevance: 0};
            var D = Object.freeze({
                __proto__: null,
                MATCH_NOTHING_RE: /\b\B/,
                IDENT_RE: y,
                UNDERSCORE_IDENT_RE: _,
                NUMBER_RE: k,
                C_NUMBER_RE: x,
                BINARY_NUMBER_RE: S,
                RE_STARTERS_RE: "!|!=|!==|%|%=|&|&&|&=|\\*|\\*=|\\+|\\+=|,|-|-=|/=|/|:|;|<<|<<=|<=|<|===|==|=|>>>=|>>=|>=|>>>|>>|>|\\?|\\[|\\{|\\(|\\^|\\^=|\\||\\|=|\\|\\||~",
                SHEBANG: (e = {}) => {
                    const t = /^#![ ]*\//;
                    return e.binary && (e.begin = g(t, /.*\b/, e.binary, /\b.*/)), a({
                        scope: "meta",
                        begin: t,
                        end: /$/,
                        relevance: 0,
                        "on:begin": (e, t) => {
                            0 !== e.index && t.ignoreMatch()
                        }
                    }, e)
                },
                BACKSLASH_ESCAPE: C,
                APOS_STRING_MODE: E,
                QUOTE_STRING_MODE: T,
                PHRASAL_WORDS_MODE: {begin: /\b(a|an|the|are|I'm|isn't|don't|doesn't|won't|but|just|should|pretty|simply|enough|gonna|going|wtf|so|such|will|you|your|they|like|more)\b/},
                COMMENT: A,
                C_LINE_COMMENT_MODE: O,
                C_BLOCK_COMMENT_MODE: P,
                HASH_COMMENT_MODE: M,
                NUMBER_MODE: L,
                C_NUMBER_MODE: j,
                BINARY_NUMBER_MODE: N,
                REGEXP_MODE: I,
                TITLE_MODE: z,
                UNDERSCORE_TITLE_MODE: R,
                METHOD_GUARD: B,
                END_SAME_AS_BEGIN: function (e) {
                    return Object.assign(e, {
                        "on:begin": (e, t) => {
                            t.data._beginMatch = e[1]
                        }, "on:end": (e, t) => {
                            t.data._beginMatch !== e[1] && t.ignoreMatch()
                        }
                    })
                }
            });

            function H(e, t) {
                "." === e.input[e.index - 1] && t.ignoreMatch()
            }

            function $(e, t) {
                void 0 !== e.className && (e.scope = e.className, delete e.className)
            }

            function q(e, t) {
                t && e.beginKeywords && (e.begin = "\\b(" + e.beginKeywords.split(" ").join("|") + ")(?!\\.)(?=\\b|\\s)", e.__beforeBegin = H, e.keywords = e.keywords || e.beginKeywords, delete e.beginKeywords, void 0 === e.relevance && (e.relevance = 0))
            }

            function F(e, t) {
                Array.isArray(e.illegal) && (e.illegal = m(...e.illegal))
            }

            function U(e, t) {
                if (e.match) {
                    if (e.begin || e.end) throw new Error("begin & end are not supported with match");
                    e.begin = e.match, delete e.match
                }
            }

            function V(e, t) {
                void 0 === e.relevance && (e.relevance = 1)
            }

            const W = (e, t) => {
                if (!e.beforeMatch) return;
                if (e.starts) throw new Error("beforeMatch cannot be used with starts");
                const n = Object.assign({}, e);
                Object.keys(e).forEach((t => {
                    delete e[t]
                })), e.keywords = n.keywords, e.begin = g(n.beforeMatch, p(n.begin)), e.starts = {
                    relevance: 0,
                    contains: [Object.assign(n, {endsParent: !0})]
                }, e.relevance = 0, delete n.beforeMatch
            }, G = ["of", "and", "for", "in", "not", "or", "if", "then", "parent", "list", "value"];

            function K(e, t, n = "keyword") {
                const r = Object.create(null);
                return "string" == typeof e ? i(n, e.split(" ")) : Array.isArray(e) ? i(n, e) : Object.keys(e).forEach((function (n) {
                    Object.assign(r, K(e[n], t, n))
                })), r;

                function i(e, n) {
                    t && (n = n.map((e => e.toLowerCase()))), n.forEach((function (t) {
                        const n = t.split("|");
                        r[n[0]] = [e, X(n[0], n[1])]
                    }))
                }
            }

            function X(e, t) {
                return t ? Number(t) : function (e) {
                    return G.includes(e.toLowerCase())
                }(e) ? 0 : 1
            }

            const Z = {}, Y = e => {
                console.error(e)
            }, J = (e, ...t) => {
                console.log(`WARN: ${e}`, ...t)
            }, Q = (e, t) => {
                Z[`${e}/${t}`] || (console.log(`Deprecated as of ${e}. ${t}`), Z[`${e}/${t}`] = !0)
            }, ee = new Error;

            function te(e, t, {key: n}) {
                let r = 0;
                const i = e[n], o = {}, a = {};
                for (let e = 1; e <= t.length; e++) a[e + r] = i[e], o[e + r] = !0, r += v(t[e - 1]);
                e[n] = a, e[n]._emit = o, e[n]._multi = !0
            }

            function ne(e) {
                !function (e) {
                    e.scope && "object" == typeof e.scope && null !== e.scope && (e.beginScope = e.scope, delete e.scope)
                }(e), "string" == typeof e.beginScope && (e.beginScope = {_wrap: e.beginScope}), "string" == typeof e.endScope && (e.endScope = {_wrap: e.endScope}), function (e) {
                    if (Array.isArray(e.begin)) {
                        if (e.skip || e.excludeBegin || e.returnBegin) throw Y("skip, excludeBegin, returnBegin not compatible with beginScope: {}"), ee;
                        if ("object" != typeof e.beginScope || null === e.beginScope) throw Y("beginScope must be object"), ee;
                        te(e, e.begin, {key: "beginScope"}), e.begin = w(e.begin, {joinWith: ""})
                    }
                }(e), function (e) {
                    if (Array.isArray(e.end)) {
                        if (e.skip || e.excludeEnd || e.returnEnd) throw Y("skip, excludeEnd, returnEnd not compatible with endScope: {}"), ee;
                        if ("object" != typeof e.endScope || null === e.endScope) throw Y("endScope must be object"), ee;
                        te(e, e.end, {key: "endScope"}), e.end = w(e.end, {joinWith: ""})
                    }
                }(e)
            }

            function re(e) {
                function t(t, n) {
                    return new RegExp(d(t), "m" + (e.case_insensitive ? "i" : "") + (e.unicodeRegex ? "u" : "") + (n ? "g" : ""))
                }

                class n {
                    constructor() {
                        this.matchIndexes = {}, this.regexes = [], this.matchAt = 1, this.position = 0
                    }

                    addRule(e, t) {
                        t.position = this.position++, this.matchIndexes[this.matchAt] = t, this.regexes.push([t, e]), this.matchAt += v(e) + 1
                    }

                    compile() {
                        0 === this.regexes.length && (this.exec = () => null);
                        const e = this.regexes.map((e => e[1]));
                        this.matcherRe = t(w(e, {joinWith: "|"}), !0), this.lastIndex = 0
                    }

                    exec(e) {
                        this.matcherRe.lastIndex = this.lastIndex;
                        const t = this.matcherRe.exec(e);
                        if (!t) return null;
                        const n = t.findIndex(((e, t) => t > 0 && void 0 !== e)), r = this.matchIndexes[n];
                        return t.splice(0, n), Object.assign(t, r)
                    }
                }

                class r {
                    constructor() {
                        this.rules = [], this.multiRegexes = [], this.count = 0, this.lastIndex = 0, this.regexIndex = 0
                    }

                    getMatcher(e) {
                        if (this.multiRegexes[e]) return this.multiRegexes[e];
                        const t = new n;
                        return this.rules.slice(e).forEach((([e, n]) => t.addRule(e, n))), t.compile(), this.multiRegexes[e] = t, t
                    }

                    resumingScanAtSamePosition() {
                        return 0 !== this.regexIndex
                    }

                    considerAll() {
                        this.regexIndex = 0
                    }

                    addRule(e, t) {
                        this.rules.push([e, t]), "begin" === t.type && this.count++
                    }

                    exec(e) {
                        const t = this.getMatcher(this.regexIndex);
                        t.lastIndex = this.lastIndex;
                        let n = t.exec(e);
                        if (this.resumingScanAtSamePosition()) if (n && n.index === this.lastIndex) ; else {
                            const t = this.getMatcher(0);
                            t.lastIndex = this.lastIndex + 1, n = t.exec(e)
                        }
                        return n && (this.regexIndex += n.position + 1, this.regexIndex === this.count && this.considerAll()), n
                    }
                }

                if (e.compilerExtensions || (e.compilerExtensions = []), e.contains && e.contains.includes("self")) throw new Error("ERR: contains `self` is not supported at the top-level of a language.  See documentation.");
                return e.classNameAliases = a(e.classNameAliases || {}), function n(i, o) {
                    const s = i;
                    if (i.isCompiled) return s;
                    [$, U, ne, W].forEach((e => e(i, o))), e.compilerExtensions.forEach((e => e(i, o))), i.__beforeBegin = null, [q, F, V].forEach((e => e(i, o))), i.isCompiled = !0;
                    let l = null;
                    return "object" == typeof i.keywords && i.keywords.$pattern && (i.keywords = Object.assign({}, i.keywords), l = i.keywords.$pattern, delete i.keywords.$pattern), l = l || /\w+/, i.keywords && (i.keywords = K(i.keywords, e.case_insensitive)), s.keywordPatternRe = t(l, !0), o && (i.begin || (i.begin = /\B|\b/), s.beginRe = t(s.begin), i.end || i.endsWithParent || (i.end = /\B|\b/), i.end && (s.endRe = t(s.end)), s.terminatorEnd = d(s.end) || "", i.endsWithParent && o.terminatorEnd && (s.terminatorEnd += (i.end ? "|" : "") + o.terminatorEnd)), i.illegal && (s.illegalRe = t(i.illegal)), i.contains || (i.contains = []), i.contains = [].concat(...i.contains.map((function (e) {
                        return function (e) {
                            e.variants && !e.cachedVariants && (e.cachedVariants = e.variants.map((function (t) {
                                return a(e, {variants: null}, t)
                            })));
                            if (e.cachedVariants) return e.cachedVariants;
                            if (ie(e)) return a(e, {starts: e.starts ? a(e.starts) : null});
                            if (Object.isFrozen(e)) return a(e);
                            return e
                        }("self" === e ? i : e)
                    }))), i.contains.forEach((function (e) {
                        n(e, s)
                    })), i.starts && n(i.starts, o), s.matcher = function (e) {
                        const t = new r;
                        return e.contains.forEach((e => t.addRule(e.begin, {
                            rule: e,
                            type: "begin"
                        }))), e.terminatorEnd && t.addRule(e.terminatorEnd, {type: "end"}), e.illegal && t.addRule(e.illegal, {type: "illegal"}), t
                    }(s), s
                }(e)
            }

            function ie(e) {
                return !!e && (e.endsWithParent || ie(e.starts))
            }

            class oe extends Error {
                constructor(e, t) {
                    super(e), this.name = "HTMLInjectionError", this.html = t
                }
            }

            const ae = o, se = a, le = Symbol("nomatch");
            var ce = function (e) {
                const t = Object.create(null), n = Object.create(null), o = [];
                let a = !0;
                const s = "Could not find the language '{}', did you forget to load/include a language module?",
                    l = {disableAutodetect: !0, name: "Plain text", contains: []};
                let c = {
                    ignoreUnescapedHTML: !1,
                    throwUnescapedHTML: !1,
                    noHighlightRe: /^(no-?highlight)$/i,
                    languageDetectRe: /\blang(?:uage)?-([\w-]+)\b/i,
                    classPrefix: "hljs-",
                    cssSelector: "pre code",
                    languages: null,
                    __emitter: u
                };

                function d(e) {
                    return c.noHighlightRe.test(e)
                }

                function v(e, t, n) {
                    let r = "", i = "";
                    "object" == typeof t ? (r = e, n = t.ignoreIllegals, i = t.language) : (Q("10.7.0", "highlight(lang, code, ...args) has been deprecated."), Q("10.7.0", "Please use highlight(code, options) instead.\nhttps://github.com/highlightjs/highlight.js/issues/2277"), i = e, r = t), void 0 === n && (n = !0);
                    const o = {code: r, language: i};
                    E("before:highlight", o);
                    const a = o.result ? o.result : b(o.language, o.code, n);
                    return a.code = o.code, E("after:highlight", a), a
                }

                function b(e, n, r, o) {
                    const l = Object.create(null);

                    function u() {
                        if (!C.keywords) return void T.addText(A);
                        let e = 0;
                        C.keywordPatternRe.lastIndex = 0;
                        let t = C.keywordPatternRe.exec(A), n = "";
                        for (; t;) {
                            n += A.substring(e, t.index);
                            const i = _.case_insensitive ? t[0].toLowerCase() : t[0], o = (r = i, C.keywords[r]);
                            if (o) {
                                const [e, r] = o;
                                if (T.addText(n), n = "", l[i] = (l[i] || 0) + 1, l[i] <= 7 && (O += r), e.startsWith("_")) n += t[0]; else {
                                    const n = _.classNameAliases[e] || e;
                                    T.addKeyword(t[0], n)
                                }
                            } else n += t[0];
                            e = C.keywordPatternRe.lastIndex, t = C.keywordPatternRe.exec(A)
                        }
                        var r;
                        n += A.substr(e), T.addText(n)
                    }

                    function d() {
                        null != C.subLanguage ? function () {
                            if ("" === A) return;
                            let e = null;
                            if ("string" == typeof C.subLanguage) {
                                if (!t[C.subLanguage]) return void T.addText(A);
                                e = b(C.subLanguage, A, !0, E[C.subLanguage]), E[C.subLanguage] = e._top
                            } else e = w(A, C.subLanguage.length ? C.subLanguage : null);
                            C.relevance > 0 && (O += e.relevance), T.addSublanguage(e._emitter, e.language)
                        }() : u(), A = ""
                    }

                    function p(e, t) {
                        let n = 1;
                        for (; void 0 !== t[n];) {
                            if (!e._emit[n]) {
                                n++;
                                continue
                            }
                            const r = _.classNameAliases[e[n]] || e[n], i = t[n];
                            r ? T.addKeyword(i, r) : (A = i, u(), A = ""), n++
                        }
                    }

                    function h(e, t) {
                        return e.scope && "string" == typeof e.scope && T.openNode(_.classNameAliases[e.scope] || e.scope), e.beginScope && (e.beginScope._wrap ? (T.addKeyword(A, _.classNameAliases[e.beginScope._wrap] || e.beginScope._wrap), A = "") : e.beginScope._multi && (p(e.beginScope, t), A = "")), C = Object.create(e, {parent: {value: C}}), C
                    }

                    function f(e, t, n) {
                        let r = function (e, t) {
                            const n = e && e.exec(t);
                            return n && 0 === n.index
                        }(e.endRe, n);
                        if (r) {
                            if (e["on:end"]) {
                                const n = new i(e);
                                e["on:end"](t, n), n.isMatchIgnored && (r = !1)
                            }
                            if (r) {
                                for (; e.endsParent && e.parent;) e = e.parent;
                                return e
                            }
                        }
                        if (e.endsWithParent) return f(e.parent, t, n)
                    }

                    function g(e) {
                        return 0 === C.matcher.regexIndex ? (A += e[0], 1) : (L = !0, 0)
                    }

                    function m(e) {
                        const t = e[0], r = n.substr(e.index), i = f(C, e, r);
                        if (!i) return le;
                        const o = C;
                        C.endScope && C.endScope._wrap ? (d(), T.addKeyword(t, C.endScope._wrap)) : C.endScope && C.endScope._multi ? (d(), p(C.endScope, e)) : o.skip ? A += t : (o.returnEnd || o.excludeEnd || (A += t), d(), o.excludeEnd && (A = t));
                        do {
                            C.scope && T.closeNode(), C.skip || C.subLanguage || (O += C.relevance), C = C.parent
                        } while (C !== i.parent);
                        return i.starts && h(i.starts, e), o.returnEnd ? 0 : t.length
                    }

                    let v = {};

                    function y(t, o) {
                        const s = o && o[0];
                        if (A += t, null == s) return d(), 0;
                        if ("begin" === v.type && "end" === o.type && v.index === o.index && "" === s) {
                            if (A += n.slice(o.index, o.index + 1), !a) {
                                const t = new Error(`0 width match regex (${e})`);
                                throw t.languageName = e, t.badRule = v.rule, t
                            }
                            return 1
                        }
                        if (v = o, "begin" === o.type) return function (e) {
                            const t = e[0], n = e.rule, r = new i(n), o = [n.__beforeBegin, n["on:begin"]];
                            for (const n of o) if (n && (n(e, r), r.isMatchIgnored)) return g(t);
                            return n.skip ? A += t : (n.excludeBegin && (A += t), d(), n.returnBegin || n.excludeBegin || (A = t)), h(n, e), n.returnBegin ? 0 : t.length
                        }(o);
                        if ("illegal" === o.type && !r) {
                            const e = new Error('Illegal lexeme "' + s + '" for mode "' + (C.scope || "<unnamed>") + '"');
                            throw e.mode = C, e
                        }
                        if ("end" === o.type) {
                            const e = m(o);
                            if (e !== le) return e
                        }
                        if ("illegal" === o.type && "" === s) return 1;
                        if (M > 1e5 && M > 3 * o.index) {
                            throw new Error("potential infinite loop, way more iterations than matches")
                        }
                        return A += s, s.length
                    }

                    const _ = x(e);
                    if (!_) throw Y(s.replace("{}", e)), new Error('Unknown language: "' + e + '"');
                    const k = re(_);
                    let S = "", C = o || k;
                    const E = {}, T = new c.__emitter(c);
                    !function () {
                        const e = [];
                        for (let t = C; t !== _; t = t.parent) t.scope && e.unshift(t.scope);
                        e.forEach((e => T.openNode(e)))
                    }();
                    let A = "", O = 0, P = 0, M = 0, L = !1;
                    try {
                        for (C.matcher.considerAll(); ;) {
                            M++, L ? L = !1 : C.matcher.considerAll(), C.matcher.lastIndex = P;
                            const e = C.matcher.exec(n);
                            if (!e) break;
                            const t = y(n.substring(P, e.index), e);
                            P = e.index + t
                        }
                        return y(n.substr(P)), T.closeAllNodes(), T.finalize(), S = T.toHTML(), {
                            language: e,
                            value: S,
                            relevance: O,
                            illegal: !1,
                            _emitter: T,
                            _top: C
                        }
                    } catch (t) {
                        if (t.message && t.message.includes("Illegal")) return {
                            language: e,
                            value: ae(n),
                            illegal: !0,
                            relevance: 0,
                            _illegalBy: {
                                message: t.message,
                                index: P,
                                context: n.slice(P - 100, P + 100),
                                mode: t.mode,
                                resultSoFar: S
                            },
                            _emitter: T
                        };
                        if (a) return {
                            language: e,
                            value: ae(n),
                            illegal: !1,
                            relevance: 0,
                            errorRaised: t,
                            _emitter: T,
                            _top: C
                        };
                        throw t
                    }
                }

                function w(e, n) {
                    n = n || c.languages || Object.keys(t);
                    const r = function (e) {
                        const t = {value: ae(e), illegal: !1, relevance: 0, _top: l, _emitter: new c.__emitter(c)};
                        return t._emitter.addText(e), t
                    }(e), i = n.filter(x).filter(C).map((t => b(t, e, !1)));
                    i.unshift(r);
                    const o = i.sort(((e, t) => {
                        if (e.relevance !== t.relevance) return t.relevance - e.relevance;
                        if (e.language && t.language) {
                            if (x(e.language).supersetOf === t.language) return 1;
                            if (x(t.language).supersetOf === e.language) return -1
                        }
                        return 0
                    })), [a, s] = o, u = a;
                    return u.secondBest = s, u
                }

                function y(e) {
                    let t = null;
                    const r = function (e) {
                        let t = e.className + " ";
                        t += e.parentNode ? e.parentNode.className : "";
                        const n = c.languageDetectRe.exec(t);
                        if (n) {
                            const t = x(n[1]);
                            return t || (J(s.replace("{}", n[1])), J("Falling back to no-highlight mode for this block.", e)), t ? n[1] : "no-highlight"
                        }
                        return t.split(/\s+/).find((e => d(e) || x(e)))
                    }(e);
                    if (d(r)) return;
                    if (E("before:highlightElement", {
                        el: e,
                        language: r
                    }), e.children.length > 0 && (c.ignoreUnescapedHTML || (console.warn("One of your code blocks includes unescaped HTML. This is a potentially serious security risk."), console.warn("https://github.com/highlightjs/highlight.js/issues/2886"), console.warn(e)), c.throwUnescapedHTML)) {
                        throw new oe("One of your code blocks includes unescaped HTML.", e.innerHTML)
                    }
                    t = e;
                    const i = t.textContent, o = r ? v(i, {language: r, ignoreIllegals: !0}) : w(i);
                    e.innerHTML = o.value, function (e, t, r) {
                        const i = t && n[t] || r;
                        e.classList.add("hljs"), e.classList.add(`language-${i}`)
                    }(e, r, o.language), e.result = {
                        language: o.language,
                        re: o.relevance,
                        relevance: o.relevance
                    }, o.secondBest && (e.secondBest = {
                        language: o.secondBest.language,
                        relevance: o.secondBest.relevance
                    }), E("after:highlightElement", {el: e, result: o, text: i})
                }

                let _ = !1;

                function k() {
                    if ("loading" === document.readyState) return void (_ = !0);
                    document.querySelectorAll(c.cssSelector).forEach(y)
                }

                function x(e) {
                    return e = (e || "").toLowerCase(), t[e] || t[n[e]]
                }

                function S(e, {languageName: t}) {
                    "string" == typeof e && (e = [e]), e.forEach((e => {
                        n[e.toLowerCase()] = t
                    }))
                }

                function C(e) {
                    const t = x(e);
                    return t && !t.disableAutodetect
                }

                function E(e, t) {
                    const n = e;
                    o.forEach((function (e) {
                        e[n] && e[n](t)
                    }))
                }

                "undefined" != typeof window && window.addEventListener && window.addEventListener("DOMContentLoaded", (function () {
                    _ && k()
                }), !1), Object.assign(e, {
                    highlight: v, highlightAuto: w, highlightAll: k, highlightElement: y, highlightBlock: function (e) {
                        return Q("10.7.0", "highlightBlock will be removed entirely in v12.0"), Q("10.7.0", "Please use highlightElement now."), y(e)
                    }, configure: function (e) {
                        c = se(c, e)
                    }, initHighlighting: () => {
                        k(), Q("10.6.0", "initHighlighting() deprecated.  Use highlightAll() now.")
                    }, initHighlightingOnLoad: function () {
                        k(), Q("10.6.0", "initHighlightingOnLoad() deprecated.  Use highlightAll() now.")
                    }, registerLanguage: function (n, r) {
                        let i = null;
                        try {
                            i = r(e)
                        } catch (e) {
                            if (Y("Language definition for '{}' could not be registered.".replace("{}", n)), !a) throw e;
                            Y(e), i = l
                        }
                        i.name || (i.name = n), t[n] = i, i.rawDefinition = r.bind(null, e), i.aliases && S(i.aliases, {languageName: n})
                    }, unregisterLanguage: function (e) {
                        delete t[e];
                        for (const t of Object.keys(n)) n[t] === e && delete n[t]
                    }, listLanguages: function () {
                        return Object.keys(t)
                    }, getLanguage: x, registerAliases: S, autoDetection: C, inherit: se, addPlugin: function (e) {
                        !function (e) {
                            e["before:highlightBlock"] && !e["before:highlightElement"] && (e["before:highlightElement"] = t => {
                                e["before:highlightBlock"](Object.assign({block: t.el}, t))
                            }), e["after:highlightBlock"] && !e["after:highlightElement"] && (e["after:highlightElement"] = t => {
                                e["after:highlightBlock"](Object.assign({block: t.el}, t))
                            })
                        }(e), o.push(e)
                    }
                }), e.debugMode = function () {
                    a = !1
                }, e.safeMode = function () {
                    a = !0
                }, e.versionString = "11.3.1", e.regex = {
                    concat: g,
                    lookahead: p,
                    either: m,
                    optional: f,
                    anyNumberOfTimes: h
                };
                for (const e in D) "object" == typeof D[e] && r(D[e]);
                return Object.assign(e, D), e
            }({});
            e.exports = ce, ce.HighlightJS = ce, ce.default = ce
        }, 8780: e => {
            e.exports = function (e) {
                const t = e.regex, n = {},
                    r = {begin: /\$\{/, end: /\}/, contains: ["self", {begin: /:-/, contains: [n]}]};
                Object.assign(n, {
                    className: "variable",
                    variants: [{begin: t.concat(/\$[\w\d#@][\w\d_]*/, "(?![\\w\\d])(?![$])")}, r]
                });
                const i = {className: "subst", begin: /\$\(/, end: /\)/, contains: [e.BACKSLASH_ESCAPE]}, o = {
                    begin: /<<-?\s*(?=\w+)/,
                    starts: {contains: [e.END_SAME_AS_BEGIN({begin: /(\w+)/, end: /(\w+)/, className: "string"})]}
                }, a = {className: "string", begin: /"/, end: /"/, contains: [e.BACKSLASH_ESCAPE, n, i]};
                i.contains.push(a);
                const s = {
                    begin: /\$\(\(/,
                    end: /\)\)/,
                    contains: [{begin: /\d+#[0-9a-f]+/, className: "number"}, e.NUMBER_MODE, n]
                }, l = e.SHEBANG({
                    binary: `(${["fish", "bash", "zsh", "sh", "csh", "ksh", "tcsh", "dash", "scsh"].join("|")})`,
                    relevance: 10
                }), c = {
                    className: "function",
                    begin: /\w[\w\d_]*\s*\(\s*\)\s*\{/,
                    returnBegin: !0,
                    contains: [e.inherit(e.TITLE_MODE, {begin: /\w[\w\d_]*/})],
                    relevance: 0
                };
                return {
                    name: "Bash",
                    aliases: ["sh"],
                    keywords: {
                        $pattern: /\b[a-z._-]+\b/,
                        keyword: ["if", "then", "else", "elif", "fi", "for", "while", "in", "do", "done", "case", "esac", "function"],
                        literal: ["true", "false"],
                        built_in: ["break", "cd", "continue", "eval", "exec", "exit", "export", "getopts", "hash", "pwd", "readonly", "return", "shift", "test", "times", "trap", "umask", "unset", "alias", "bind", "builtin", "caller", "command", "declare", "echo", "enable", "help", "let", "local", "logout", "mapfile", "printf", "read", "readarray", "source", "type", "typeset", "ulimit", "unalias", "set", "shopt", "autoload", "bg", "bindkey", "bye", "cap", "chdir", "clone", "comparguments", "compcall", "compctl", "compdescribe", "compfiles", "compgroups", "compquote", "comptags", "comptry", "compvalues", "dirs", "disable", "disown", "echotc", "echoti", "emulate", "fc", "fg", "float", "functions", "getcap", "getln", "history", "integer", "jobs", "kill", "limit", "log", "noglob", "popd", "print", "pushd", "pushln", "rehash", "sched", "setcap", "setopt", "stat", "suspend", "ttyctl", "unfunction", "unhash", "unlimit", "unsetopt", "vared", "wait", "whence", "where", "which", "zcompile", "zformat", "zftp", "zle", "zmodload", "zparseopts", "zprof", "zpty", "zregexparse", "zsocket", "zstyle", "ztcp", "chcon", "chgrp", "chown", "chmod", "cp", "dd", "df", "dir", "dircolors", "ln", "ls", "mkdir", "mkfifo", "mknod", "mktemp", "mv", "realpath", "rm", "rmdir", "shred", "sync", "touch", "truncate", "vdir", "b2sum", "base32", "base64", "cat", "cksum", "comm", "csplit", "cut", "expand", "fmt", "fold", "head", "join", "md5sum", "nl", "numfmt", "od", "paste", "ptx", "pr", "sha1sum", "sha224sum", "sha256sum", "sha384sum", "sha512sum", "shuf", "sort", "split", "sum", "tac", "tail", "tr", "tsort", "unexpand", "uniq", "wc", "arch", "basename", "chroot", "date", "dirname", "du", "echo", "env", "expr", "factor", "groups", "hostid", "id", "link", "logname", "nice", "nohup", "nproc", "pathchk", "pinky", "printenv", "printf", "pwd", "readlink", "runcon", "seq", "sleep", "stat", "stdbuf", "stty", "tee", "test", "timeout", "tty", "uname", "unlink", "uptime", "users", "who", "whoami", "yes"]
                    },
                    contains: [l, e.SHEBANG(), c, s, e.HASH_COMMENT_MODE, o, {match: /(\/[a-z._-]+)+/}, a, {
                        className: "",
                        begin: /\\"/
                    }, {className: "string", begin: /'/, end: /'/}, n]
                }
            }
        }, 5064: e => {
            const t = ["a", "abbr", "address", "article", "aside", "audio", "b", "blockquote", "body", "button", "canvas", "caption", "cite", "code", "dd", "del", "details", "dfn", "div", "dl", "dt", "em", "fieldset", "figcaption", "figure", "footer", "form", "h1", "h2", "h3", "h4", "h5", "h6", "header", "hgroup", "html", "i", "iframe", "img", "input", "ins", "kbd", "label", "legend", "li", "main", "mark", "menu", "nav", "object", "ol", "p", "q", "quote", "samp", "section", "span", "strong", "summary", "sup", "table", "tbody", "td", "textarea", "tfoot", "th", "thead", "time", "tr", "ul", "var", "video"],
                n = ["any-hover", "any-pointer", "aspect-ratio", "color", "color-gamut", "color-index", "device-aspect-ratio", "device-height", "device-width", "display-mode", "forced-colors", "grid", "height", "hover", "inverted-colors", "monochrome", "orientation", "overflow-block", "overflow-inline", "pointer", "prefers-color-scheme", "prefers-contrast", "prefers-reduced-motion", "prefers-reduced-transparency", "resolution", "scan", "scripting", "update", "width", "min-width", "max-width", "min-height", "max-height"],
                r = ["active", "any-link", "blank", "checked", "current", "default", "defined", "dir", "disabled", "drop", "empty", "enabled", "first", "first-child", "first-of-type", "fullscreen", "future", "focus", "focus-visible", "focus-within", "has", "host", "host-context", "hover", "indeterminate", "in-range", "invalid", "is", "lang", "last-child", "last-of-type", "left", "link", "local-link", "not", "nth-child", "nth-col", "nth-last-child", "nth-last-col", "nth-last-of-type", "nth-of-type", "only-child", "only-of-type", "optional", "out-of-range", "past", "placeholder-shown", "read-only", "read-write", "required", "right", "root", "scope", "target", "target-within", "user-invalid", "valid", "visited", "where"],
                i = ["after", "backdrop", "before", "cue", "cue-region", "first-letter", "first-line", "grammar-error", "marker", "part", "placeholder", "selection", "slotted", "spelling-error"],
                o = ["align-content", "align-items", "align-self", "all", "animation", "animation-delay", "animation-direction", "animation-duration", "animation-fill-mode", "animation-iteration-count", "animation-name", "animation-play-state", "animation-timing-function", "backface-visibility", "background", "background-attachment", "background-clip", "background-color", "background-image", "background-origin", "background-position", "background-repeat", "background-size", "border", "border-bottom", "border-bottom-color", "border-bottom-left-radius", "border-bottom-right-radius", "border-bottom-style", "border-bottom-width", "border-collapse", "border-color", "border-image", "border-image-outset", "border-image-repeat", "border-image-slice", "border-image-source", "border-image-width", "border-left", "border-left-color", "border-left-style", "border-left-width", "border-radius", "border-right", "border-right-color", "border-right-style", "border-right-width", "border-spacing", "border-style", "border-top", "border-top-color", "border-top-left-radius", "border-top-right-radius", "border-top-style", "border-top-width", "border-width", "bottom", "box-decoration-break", "box-shadow", "box-sizing", "break-after", "break-before", "break-inside", "caption-side", "caret-color", "clear", "clip", "clip-path", "clip-rule", "color", "column-count", "column-fill", "column-gap", "column-rule", "column-rule-color", "column-rule-style", "column-rule-width", "column-span", "column-width", "columns", "contain", "content", "content-visibility", "counter-increment", "counter-reset", "cue", "cue-after", "cue-before", "cursor", "direction", "display", "empty-cells", "filter", "flex", "flex-basis", "flex-direction", "flex-flow", "flex-grow", "flex-shrink", "flex-wrap", "float", "flow", "font", "font-display", "font-family", "font-feature-settings", "font-kerning", "font-language-override", "font-size", "font-size-adjust", "font-smoothing", "font-stretch", "font-style", "font-synthesis", "font-variant", "font-variant-caps", "font-variant-east-asian", "font-variant-ligatures", "font-variant-numeric", "font-variant-position", "font-variation-settings", "font-weight", "gap", "glyph-orientation-vertical", "grid", "grid-area", "grid-auto-columns", "grid-auto-flow", "grid-auto-rows", "grid-column", "grid-column-end", "grid-column-start", "grid-gap", "grid-row", "grid-row-end", "grid-row-start", "grid-template", "grid-template-areas", "grid-template-columns", "grid-template-rows", "hanging-punctuation", "height", "hyphens", "icon", "image-orientation", "image-rendering", "image-resolution", "ime-mode", "isolation", "justify-content", "left", "letter-spacing", "line-break", "line-height", "list-style", "list-style-image", "list-style-position", "list-style-type", "margin", "margin-bottom", "margin-left", "margin-right", "margin-top", "marks", "mask", "mask-border", "mask-border-mode", "mask-border-outset", "mask-border-repeat", "mask-border-slice", "mask-border-source", "mask-border-width", "mask-clip", "mask-composite", "mask-image", "mask-mode", "mask-origin", "mask-position", "mask-repeat", "mask-size", "mask-type", "max-height", "max-width", "min-height", "min-width", "mix-blend-mode", "nav-down", "nav-index", "nav-left", "nav-right", "nav-up", "none", "normal", "object-fit", "object-position", "opacity", "order", "orphans", "outline", "outline-color", "outline-offset", "outline-style", "outline-width", "overflow", "overflow-wrap", "overflow-x", "overflow-y", "padding", "padding-bottom", "padding-left", "padding-right", "padding-top", "page-break-after", "page-break-before", "page-break-inside", "pause", "pause-after", "pause-before", "perspective", "perspective-origin", "pointer-events", "position", "quotes", "resize", "rest", "rest-after", "rest-before", "right", "row-gap", "scroll-margin", "scroll-margin-block", "scroll-margin-block-end", "scroll-margin-block-start", "scroll-margin-bottom", "scroll-margin-inline", "scroll-margin-inline-end", "scroll-margin-inline-start", "scroll-margin-left", "scroll-margin-right", "scroll-margin-top", "scroll-padding", "scroll-padding-block", "scroll-padding-block-end", "scroll-padding-block-start", "scroll-padding-bottom", "scroll-padding-inline", "scroll-padding-inline-end", "scroll-padding-inline-start", "scroll-padding-left", "scroll-padding-right", "scroll-padding-top", "scroll-snap-align", "scroll-snap-stop", "scroll-snap-type", "shape-image-threshold", "shape-margin", "shape-outside", "speak", "speak-as", "src", "tab-size", "table-layout", "text-align", "text-align-all", "text-align-last", "text-combine-upright", "text-decoration", "text-decoration-color", "text-decoration-line", "text-decoration-style", "text-emphasis", "text-emphasis-color", "text-emphasis-position", "text-emphasis-style", "text-indent", "text-justify", "text-orientation", "text-overflow", "text-rendering", "text-shadow", "text-transform", "text-underline-position", "top", "transform", "transform-box", "transform-origin", "transform-style", "transition", "transition-delay", "transition-duration", "transition-property", "transition-timing-function", "unicode-bidi", "vertical-align", "visibility", "voice-balance", "voice-duration", "voice-family", "voice-pitch", "voice-range", "voice-rate", "voice-stress", "voice-volume", "white-space", "widows", "width", "will-change", "word-break", "word-spacing", "word-wrap", "writing-mode", "z-index"].reverse();
            e.exports = function (e) {
                const a = e.regex, s = (e => ({
                    IMPORTANT: {scope: "meta", begin: "!important"},
                    BLOCK_COMMENT: e.C_BLOCK_COMMENT_MODE,
                    HEXCOLOR: {scope: "number", begin: /#(([0-9a-fA-F]{3,4})|(([0-9a-fA-F]{2}){3,4}))\b/},
                    FUNCTION_DISPATCH: {className: "built_in", begin: /[\w-]+(?=\()/},
                    ATTRIBUTE_SELECTOR_MODE: {
                        scope: "selector-attr",
                        begin: /\[/,
                        end: /\]/,
                        illegal: "$",
                        contains: [e.APOS_STRING_MODE, e.QUOTE_STRING_MODE]
                    },
                    CSS_NUMBER_MODE: {
                        scope: "number",
                        begin: e.NUMBER_RE + "(%|em|ex|ch|rem|vw|vh|vmin|vmax|cm|mm|in|pt|pc|px|deg|grad|rad|turn|s|ms|Hz|kHz|dpi|dpcm|dppx)?",
                        relevance: 0
                    },
                    CSS_VARIABLE: {className: "attr", begin: /--[A-Za-z][A-Za-z0-9_-]*/}
                }))(e), l = [e.APOS_STRING_MODE, e.QUOTE_STRING_MODE];
                return {
                    name: "CSS",
                    case_insensitive: !0,
                    illegal: /[=|'\$]/,
                    keywords: {keyframePosition: "from to"},
                    classNameAliases: {keyframePosition: "selector-tag"},
                    contains: [s.BLOCK_COMMENT, {begin: /-(webkit|moz|ms|o)-(?=[a-z])/}, s.CSS_NUMBER_MODE, {
                        className: "selector-id",
                        begin: /#[A-Za-z0-9_-]+/,
                        relevance: 0
                    }, {
                        className: "selector-class",
                        begin: "\\.[a-zA-Z-][a-zA-Z0-9_-]*",
                        relevance: 0
                    }, s.ATTRIBUTE_SELECTOR_MODE, {
                        className: "selector-pseudo",
                        variants: [{begin: ":(" + r.join("|") + ")"}, {begin: ":(:)?(" + i.join("|") + ")"}]
                    }, s.CSS_VARIABLE, {className: "attribute", begin: "\\b(" + o.join("|") + ")\\b"}, {
                        begin: /:/,
                        end: /[;}{]/,
                        contains: [s.BLOCK_COMMENT, s.HEXCOLOR, s.IMPORTANT, s.CSS_NUMBER_MODE, ...l, {
                            begin: /(url|data-uri)\(/,
                            end: /\)/,
                            relevance: 0,
                            keywords: {built_in: "url data-uri"},
                            contains: [{className: "string", begin: /[^)]/, endsWithParent: !0, excludeEnd: !0}]
                        }, s.FUNCTION_DISPATCH]
                    }, {
                        begin: a.lookahead(/@/),
                        end: "[{;]",
                        relevance: 0,
                        illegal: /:/,
                        contains: [{className: "keyword", begin: /@-?\w[\w]*(-\w+)*/}, {
                            begin: /\s/,
                            endsWithParent: !0,
                            excludeEnd: !0,
                            relevance: 0,
                            keywords: {$pattern: /[a-z-]+/, keyword: "and or not only", attribute: n.join(" ")},
                            contains: [{begin: /[a-z-]+(?=:)/, className: "attribute"}, ...l, s.CSS_NUMBER_MODE]
                        }]
                    }, {className: "selector-tag", begin: "\\b(" + t.join("|") + ")\\b"}]
                }
            }
        }, 978: e => {
            const t = "[A-Za-z$_][0-9A-Za-z$_]*",
                n = ["as", "in", "of", "if", "for", "while", "finally", "var", "new", "function", "do", "return", "void", "else", "break", "catch", "instanceof", "with", "throw", "case", "default", "try", "switch", "continue", "typeof", "delete", "let", "yield", "const", "class", "debugger", "async", "await", "static", "import", "from", "export", "extends"],
                r = ["true", "false", "null", "undefined", "NaN", "Infinity"],
                i = ["Object", "Function", "Boolean", "Symbol", "Math", "Date", "Number", "BigInt", "String", "RegExp", "Array", "Float32Array", "Float64Array", "Int8Array", "Uint8Array", "Uint8ClampedArray", "Int16Array", "Int32Array", "Uint16Array", "Uint32Array", "BigInt64Array", "BigUint64Array", "Set", "Map", "WeakSet", "WeakMap", "ArrayBuffer", "SharedArrayBuffer", "Atomics", "DataView", "JSON", "Promise", "Generator", "GeneratorFunction", "AsyncFunction", "Reflect", "Proxy", "Intl", "WebAssembly"],
                o = ["Error", "EvalError", "InternalError", "RangeError", "ReferenceError", "SyntaxError", "TypeError", "URIError"],
                a = ["setInterval", "setTimeout", "clearInterval", "clearTimeout", "require", "exports", "eval", "isFinite", "isNaN", "parseFloat", "parseInt", "decodeURI", "decodeURIComponent", "encodeURI", "encodeURIComponent", "escape", "unescape"],
                s = ["arguments", "this", "super", "console", "window", "document", "localStorage", "module", "global"],
                l = [].concat(a, i, o);
            e.exports = function (e) {
                const c = e.regex, u = t, d = "<>", p = "</>", h = {
                        begin: /<[A-Za-z0-9\\._:-]+/, end: /\/[A-Za-z0-9\\._:-]+>|\/>/, isTrulyOpeningTag: (e, t) => {
                            const n = e[0].length + e.index, r = e.input[n];
                            if ("<" === r || "," === r) return void t.ignoreMatch();
                            let i;
                            ">" === r && (((e, {after: t}) => {
                                const n = "</" + e[0].slice(1);
                                return -1 !== e.input.indexOf(n, t)
                            })(e, {after: n}) || t.ignoreMatch());
                            (i = e.input.substr(n).match(/^\s+extends\s+/)) && 0 === i.index && t.ignoreMatch()
                        }
                    }, f = {$pattern: t, keyword: n, literal: r, built_in: l, "variable.language": s},
                    g = "\\.([0-9](_?[0-9])*)", m = "0|[1-9](_?[0-9])*|0[0-7]*[89][0-9]*", v = {
                        className: "number",
                        variants: [{begin: `(\\b(${m})((${g})|\\.)?|(${g}))[eE][+-]?([0-9](_?[0-9])*)\\b`}, {begin: `\\b(${m})\\b((${g})\\b|\\.)?|(${g})\\b`}, {begin: "\\b(0|[1-9](_?[0-9])*)n\\b"}, {begin: "\\b0[xX][0-9a-fA-F](_?[0-9a-fA-F])*n?\\b"}, {begin: "\\b0[bB][0-1](_?[0-1])*n?\\b"}, {begin: "\\b0[oO][0-7](_?[0-7])*n?\\b"}, {begin: "\\b0[0-7]+n?\\b"}],
                        relevance: 0
                    }, b = {className: "subst", begin: "\\$\\{", end: "\\}", keywords: f, contains: []}, w = {
                        begin: "html`",
                        end: "",
                        starts: {end: "`", returnEnd: !1, contains: [e.BACKSLASH_ESCAPE, b], subLanguage: "xml"}
                    }, y = {
                        begin: "css`",
                        end: "",
                        starts: {end: "`", returnEnd: !1, contains: [e.BACKSLASH_ESCAPE, b], subLanguage: "css"}
                    }, _ = {className: "string", begin: "`", end: "`", contains: [e.BACKSLASH_ESCAPE, b]}, k = {
                        className: "comment",
                        variants: [e.COMMENT(/\/\*\*(?!\/)/, "\\*/", {
                            relevance: 0,
                            contains: [{
                                begin: "(?=@[A-Za-z]+)",
                                relevance: 0,
                                contains: [{className: "doctag", begin: "@[A-Za-z]+"}, {
                                    className: "type",
                                    begin: "\\{",
                                    end: "\\}",
                                    excludeEnd: !0,
                                    excludeBegin: !0,
                                    relevance: 0
                                }, {
                                    className: "variable",
                                    begin: u + "(?=\\s*(-)|$)",
                                    endsParent: !0,
                                    relevance: 0
                                }, {begin: /(?=[^\n])\s/, relevance: 0}]
                            }]
                        }), e.C_BLOCK_COMMENT_MODE, e.C_LINE_COMMENT_MODE]
                    }, x = [e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, w, y, _, v];
                b.contains = x.concat({begin: /\{/, end: /\}/, keywords: f, contains: ["self"].concat(x)});
                const S = [].concat(k, b.contains),
                    C = S.concat([{begin: /\(/, end: /\)/, keywords: f, contains: ["self"].concat(S)}]), E = {
                        className: "params",
                        begin: /\(/,
                        end: /\)/,
                        excludeBegin: !0,
                        excludeEnd: !0,
                        keywords: f,
                        contains: C
                    }, T = {
                        variants: [{
                            match: [/class/, /\s+/, u, /\s+/, /extends/, /\s+/, c.concat(u, "(", c.concat(/\./, u), ")*")],
                            scope: {1: "keyword", 3: "title.class", 5: "keyword", 7: "title.class.inherited"}
                        }, {match: [/class/, /\s+/, u], scope: {1: "keyword", 3: "title.class"}}]
                    }, A = {
                        relevance: 0,
                        match: c.either(/\bJSON/, /\b[A-Z][a-z]+([A-Z][a-z]+|\d)*/, /\b[A-Z]{2,}([A-Z][a-z]+|\d)+/),
                        className: "title.class",
                        keywords: {_: [...i, ...o]}
                    }, O = {
                        variants: [{match: [/function/, /\s+/, u, /(?=\s*\()/]}, {match: [/function/, /\s*(?=\()/]}],
                        className: {1: "keyword", 3: "title.function"},
                        label: "func.def",
                        contains: [E],
                        illegal: /%/
                    }, P = {
                        match: c.concat(/\b/, (M = [...a, "super"], c.concat("(?!", M.join("|"), ")")), u, c.lookahead(/\(/)),
                        className: "title.function",
                        relevance: 0
                    };
                var M;
                const L = {
                        begin: c.concat(/\./, c.lookahead(c.concat(u, /(?![0-9A-Za-z$_(])/))),
                        end: u,
                        excludeBegin: !0,
                        keywords: "prototype",
                        className: "property",
                        relevance: 0
                    }, j = {
                        match: [/get|set/, /\s+/, u, /(?=\()/],
                        className: {1: "keyword", 3: "title.function"},
                        contains: [{begin: /\(\)/}, E]
                    }, N = "(\\([^()]*(\\([^()]*(\\([^()]*\\)[^()]*)*\\)[^()]*)*\\)|" + e.UNDERSCORE_IDENT_RE + ")\\s*=>",
                    I = {
                        match: [/const|var|let/, /\s+/, u, /\s*/, /=\s*/, c.lookahead(N)],
                        className: {1: "keyword", 3: "title.function"},
                        contains: [E]
                    };
                return {
                    name: "Javascript",
                    aliases: ["js", "jsx", "mjs", "cjs"],
                    keywords: f,
                    exports: {PARAMS_CONTAINS: C, CLASS_REFERENCE: A},
                    illegal: /#(?![$_A-z])/,
                    contains: [e.SHEBANG({label: "shebang", binary: "node", relevance: 5}), {
                        label: "use_strict",
                        className: "meta",
                        relevance: 10,
                        begin: /^\s*['"]use (strict|asm)['"]/
                    }, e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, w, y, _, k, v, A, {
                        className: "attr",
                        begin: u + c.lookahead(":"),
                        relevance: 0
                    }, I, {
                        begin: "(" + e.RE_STARTERS_RE + "|\\b(case|return|throw)\\b)\\s*",
                        keywords: "return throw case",
                        relevance: 0,
                        contains: [k, e.REGEXP_MODE, {
                            className: "function",
                            begin: N,
                            returnBegin: !0,
                            end: "\\s*=>",
                            contains: [{
                                className: "params",
                                variants: [{begin: e.UNDERSCORE_IDENT_RE, relevance: 0}, {
                                    className: null,
                                    begin: /\(\s*\)/,
                                    skip: !0
                                }, {begin: /\(/, end: /\)/, excludeBegin: !0, excludeEnd: !0, keywords: f, contains: C}]
                            }]
                        }, {begin: /,/, relevance: 0}, {match: /\s+/, relevance: 0}, {
                            variants: [{
                                begin: d,
                                end: p
                            }, {match: /<[A-Za-z0-9\\._:-]+\s*\/>/}, {
                                begin: h.begin,
                                "on:begin": h.isTrulyOpeningTag,
                                end: h.end
                            }],
                            subLanguage: "xml",
                            contains: [{begin: h.begin, end: h.end, skip: !0, contains: ["self"]}]
                        }]
                    }, O, {beginKeywords: "while if switch catch for"}, {
                        begin: "\\b(?!function)" + e.UNDERSCORE_IDENT_RE + "\\([^()]*(\\([^()]*(\\([^()]*\\)[^()]*)*\\)[^()]*)*\\)\\s*\\{",
                        returnBegin: !0,
                        label: "func.def",
                        contains: [E, e.inherit(e.TITLE_MODE, {begin: u, className: "title.function"})]
                    }, {match: /\.\.\./, relevance: 0}, L, {
                        match: "\\$" + u,
                        relevance: 0
                    }, {
                        match: [/\bconstructor(?=\s*\()/],
                        className: {1: "title.function"},
                        contains: [E]
                    }, P, {
                        relevance: 0,
                        match: /\b[A-Z][A-Z_0-9]+\b/,
                        className: "variable.constant"
                    }, T, j, {match: /\$[(.]/}]
                }
            }
        }, 2003: e => {
            e.exports = function (e) {
                const t = {begin: /<\/?[A-Za-z_]/, end: ">", subLanguage: "xml", relevance: 0}, n = {
                    variants: [{
                        begin: /\[.+?\]\[.*?\]/,
                        relevance: 0
                    }, {
                        begin: /\[.+?\]\(((data|javascript|mailto):|(?:http|ftp)s?:\/\/).*?\)/,
                        relevance: 2
                    }, {
                        begin: e.regex.concat(/\[.+?\]\(/, /[A-Za-z][A-Za-z0-9+.-]*/, /:\/\/.*?\)/),
                        relevance: 2
                    }, {begin: /\[.+?\]\([./?&#].*?\)/, relevance: 1}, {begin: /\[.*?\]\(.*?\)/, relevance: 0}],
                    returnBegin: !0,
                    contains: [{match: /\[(?=\])/}, {
                        className: "string",
                        relevance: 0,
                        begin: "\\[",
                        end: "\\]",
                        excludeBegin: !0,
                        returnEnd: !0
                    }, {
                        className: "link",
                        relevance: 0,
                        begin: "\\]\\(",
                        end: "\\)",
                        excludeBegin: !0,
                        excludeEnd: !0
                    }, {
                        className: "symbol",
                        relevance: 0,
                        begin: "\\]\\[",
                        end: "\\]",
                        excludeBegin: !0,
                        excludeEnd: !0
                    }]
                }, r = {
                    className: "strong",
                    contains: [],
                    variants: [{begin: /_{2}/, end: /_{2}/}, {begin: /\*{2}/, end: /\*{2}/}]
                }, i = {
                    className: "emphasis",
                    contains: [],
                    variants: [{begin: /\*(?!\*)/, end: /\*/}, {begin: /_(?!_)/, end: /_/, relevance: 0}]
                };
                r.contains.push(i), i.contains.push(r);
                let o = [t, n];
                return r.contains = r.contains.concat(o), i.contains = i.contains.concat(o), o = o.concat(r, i), {
                    name: "Markdown",
                    aliases: ["md", "mkdown", "mkd"],
                    contains: [{
                        className: "section",
                        variants: [{begin: "^#{1,6}", end: "$", contains: o}, {
                            begin: "(?=^.+?\\n[=-]{2,}$)",
                            contains: [{begin: "^[=-]*$"}, {begin: "^", end: "\\n", contains: o}]
                        }]
                    }, t, {
                        className: "bullet",
                        begin: "^[ \t]*([*+-]|(\\d+\\.))(?=\\s+)",
                        end: "\\s+",
                        excludeEnd: !0
                    }, r, i, {className: "quote", begin: "^>\\s+", contains: o, end: "$"}, {
                        className: "code",
                        variants: [{begin: "(`{3,})[^`](.|\\n)*?\\1`*[ ]*"}, {begin: "(~{3,})[^~](.|\\n)*?\\1~*[ ]*"}, {
                            begin: "```",
                            end: "```+[ ]*$"
                        }, {begin: "~~~", end: "~~~+[ ]*$"}, {begin: "`.+?`"}, {
                            begin: "(?=^( {4}|\\t))",
                            contains: [{begin: "^( {4}|\\t)", end: "(\\n)$"}],
                            relevance: 0
                        }]
                    }, {begin: "^[-\\*]{3,}", end: "$"}, n, {
                        begin: /^\[[^\n]+\]:/,
                        returnBegin: !0,
                        contains: [{
                            className: "symbol",
                            begin: /\[/,
                            end: /\]/,
                            excludeBegin: !0,
                            excludeEnd: !0
                        }, {className: "link", begin: /:\s*/, end: /$/, excludeBegin: !0}]
                    }]
                }
            }
        }, 2656: e => {
            e.exports = function (e) {
                const t = {className: "variable", begin: "\\$+[a-zA-Z_-ÿ][a-zA-Z0-9_-ÿ]*(?![A-Za-z0-9])(?![$])"},
                    n = {
                        className: "meta",
                        variants: [{begin: /<\?php/, relevance: 10}, {begin: /<\?[=]?/}, {begin: /\?>/}]
                    }, r = {className: "subst", variants: [{begin: /\$\w+/}, {begin: /\{\$/, end: /\}/}]},
                    i = e.inherit(e.APOS_STRING_MODE, {illegal: null}), o = e.inherit(e.QUOTE_STRING_MODE, {
                        illegal: null,
                        contains: e.QUOTE_STRING_MODE.contains.concat(r)
                    }), a = e.END_SAME_AS_BEGIN({
                        begin: /<<<[ \t]*(\w+)\n/,
                        end: /[ \t]*(\w+)\b/,
                        contains: e.QUOTE_STRING_MODE.contains.concat(r)
                    }), s = {
                        className: "string",
                        contains: [e.BACKSLASH_ESCAPE, n],
                        variants: [e.inherit(i, {begin: "b'", end: "'"}), e.inherit(o, {begin: 'b"', end: '"'}), o, i, a]
                    }, l = {
                        className: "number",
                        variants: [{begin: "\\b0b[01]+(?:_[01]+)*\\b"}, {begin: "\\b0o[0-7]+(?:_[0-7]+)*\\b"}, {begin: "\\b0x[\\da-f]+(?:_[\\da-f]+)*\\b"}, {begin: "(?:\\b\\d+(?:_\\d+)*(\\.(?:\\d+(?:_\\d+)*))?|\\B\\.\\d+)(?:e[+-]?\\d+)?"}],
                        relevance: 0
                    }, c = {
                        keyword: "__CLASS__ __DIR__ __FILE__ __FUNCTION__ __LINE__ __METHOD__ __NAMESPACE__ __TRAIT__ die echo exit include include_once print require require_once array abstract and as binary bool boolean break callable case catch class clone const continue declare default do double else elseif empty enddeclare endfor endforeach endif endswitch endwhile enum eval extends final finally float for foreach from global goto if implements instanceof insteadof int integer interface isset iterable list match|0 mixed new object or private protected public real return string switch throw trait try unset use var void while xor yield",
                        literal: "false null true",
                        built_in: "Error|0 AppendIterator ArgumentCountError ArithmeticError ArrayIterator ArrayObject AssertionError BadFunctionCallException BadMethodCallException CachingIterator CallbackFilterIterator CompileError Countable DirectoryIterator DivisionByZeroError DomainException EmptyIterator ErrorException Exception FilesystemIterator FilterIterator GlobIterator InfiniteIterator InvalidArgumentException IteratorIterator LengthException LimitIterator LogicException MultipleIterator NoRewindIterator OutOfBoundsException OutOfRangeException OuterIterator OverflowException ParentIterator ParseError RangeException RecursiveArrayIterator RecursiveCachingIterator RecursiveCallbackFilterIterator RecursiveDirectoryIterator RecursiveFilterIterator RecursiveIterator RecursiveIteratorIterator RecursiveRegexIterator RecursiveTreeIterator RegexIterator RuntimeException SeekableIterator SplDoublyLinkedList SplFileInfo SplFileObject SplFixedArray SplHeap SplMaxHeap SplMinHeap SplObjectStorage SplObserver SplObserver SplPriorityQueue SplQueue SplStack SplSubject SplSubject SplTempFileObject TypeError UnderflowException UnexpectedValueException UnhandledMatchError ArrayAccess Closure Generator Iterator IteratorAggregate Serializable Stringable Throwable Traversable WeakReference WeakMap Directory __PHP_Incomplete_Class parent php_user_filter self static stdClass"
                    };
                return {
                    case_insensitive: !0,
                    keywords: c,
                    contains: [e.HASH_COMMENT_MODE, e.COMMENT("//", "$", {contains: [n]}), e.COMMENT("/\\*", "\\*/", {
                        contains: [{
                            className: "doctag",
                            begin: "@[A-Za-z]+"
                        }]
                    }), e.COMMENT("__halt_compiler.+?;", !1, {
                        endsWithParent: !0,
                        keywords: "__halt_compiler"
                    }), n, {
                        className: "keyword",
                        begin: /\$this\b/
                    }, t, {begin: /(::|->)+[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/}, {
                        className: "function",
                        relevance: 0,
                        beginKeywords: "fn function",
                        end: /[;{]/,
                        excludeEnd: !0,
                        illegal: "[$%\\[]",
                        contains: [{beginKeywords: "use"}, e.UNDERSCORE_TITLE_MODE, {
                            begin: "=>",
                            endsParent: !0
                        }, {
                            className: "params",
                            begin: "\\(",
                            end: "\\)",
                            excludeBegin: !0,
                            excludeEnd: !0,
                            keywords: c,
                            contains: ["self", t, e.C_BLOCK_COMMENT_MODE, s, l]
                        }]
                    }, {
                        className: "class",
                        variants: [{beginKeywords: "enum", illegal: /[($"]/}, {
                            beginKeywords: "class interface trait",
                            illegal: /[:($"]/
                        }],
                        relevance: 0,
                        end: /\{/,
                        excludeEnd: !0,
                        contains: [{beginKeywords: "extends implements"}, e.UNDERSCORE_TITLE_MODE]
                    }, {
                        beginKeywords: "namespace",
                        relevance: 0,
                        end: ";",
                        illegal: /[.']/,
                        contains: [e.UNDERSCORE_TITLE_MODE]
                    }, {beginKeywords: "use", relevance: 0, end: ";", contains: [e.UNDERSCORE_TITLE_MODE]}, s, l]
                }
            }
        }, 8245: e => {
            e.exports = function (e) {
                const t = e.regex, n = /[\p{XID_Start}_]\p{XID_Continue}*/u, r = {
                        $pattern: /[A-Za-z]\w+|__\w+__/,
                        keyword: ["and", "as", "assert", "async", "await", "break", "class", "continue", "def", "del", "elif", "else", "except", "finally", "for", "from", "global", "if", "import", "in", "is", "lambda", "nonlocal|10", "not", "or", "pass", "raise", "return", "try", "while", "with", "yield"],
                        built_in: ["__import__", "abs", "all", "any", "ascii", "bin", "bool", "breakpoint", "bytearray", "bytes", "callable", "chr", "classmethod", "compile", "complex", "delattr", "dict", "dir", "divmod", "enumerate", "eval", "exec", "filter", "float", "format", "frozenset", "getattr", "globals", "hasattr", "hash", "help", "hex", "id", "input", "int", "isinstance", "issubclass", "iter", "len", "list", "locals", "map", "max", "memoryview", "min", "next", "object", "oct", "open", "ord", "pow", "print", "property", "range", "repr", "reversed", "round", "set", "setattr", "slice", "sorted", "staticmethod", "str", "sum", "super", "tuple", "type", "vars", "zip"],
                        literal: ["__debug__", "Ellipsis", "False", "None", "NotImplemented", "True"],
                        type: ["Any", "Callable", "Coroutine", "Dict", "List", "Literal", "Generic", "Optional", "Sequence", "Set", "Tuple", "Type", "Union"]
                    }, i = {className: "meta", begin: /^(>>>|\.\.\.) /},
                    o = {className: "subst", begin: /\{/, end: /\}/, keywords: r, illegal: /#/},
                    a = {begin: /\{\{/, relevance: 0}, s = {
                        className: "string",
                        contains: [e.BACKSLASH_ESCAPE],
                        variants: [{
                            begin: /([uU]|[bB]|[rR]|[bB][rR]|[rR][bB])?'''/,
                            end: /'''/,
                            contains: [e.BACKSLASH_ESCAPE, i],
                            relevance: 10
                        }, {
                            begin: /([uU]|[bB]|[rR]|[bB][rR]|[rR][bB])?"""/,
                            end: /"""/,
                            contains: [e.BACKSLASH_ESCAPE, i],
                            relevance: 10
                        }, {
                            begin: /([fF][rR]|[rR][fF]|[fF])'''/,
                            end: /'''/,
                            contains: [e.BACKSLASH_ESCAPE, i, a, o]
                        }, {
                            begin: /([fF][rR]|[rR][fF]|[fF])"""/,
                            end: /"""/,
                            contains: [e.BACKSLASH_ESCAPE, i, a, o]
                        }, {begin: /([uU]|[rR])'/, end: /'/, relevance: 10}, {
                            begin: /([uU]|[rR])"/,
                            end: /"/,
                            relevance: 10
                        }, {begin: /([bB]|[bB][rR]|[rR][bB])'/, end: /'/}, {
                            begin: /([bB]|[bB][rR]|[rR][bB])"/,
                            end: /"/
                        }, {
                            begin: /([fF][rR]|[rR][fF]|[fF])'/,
                            end: /'/,
                            contains: [e.BACKSLASH_ESCAPE, a, o]
                        }, {
                            begin: /([fF][rR]|[rR][fF]|[fF])"/,
                            end: /"/,
                            contains: [e.BACKSLASH_ESCAPE, a, o]
                        }, e.APOS_STRING_MODE, e.QUOTE_STRING_MODE]
                    }, l = "[0-9](_?[0-9])*", c = `(\\b(${l}))?\\.(${l})|\\b(${l})\\.`, u = {
                        className: "number",
                        relevance: 0,
                        variants: [{begin: `(\\b(${l})|(${c}))[eE][+-]?(${l})[jJ]?\\b`}, {begin: `(${c})[jJ]?`}, {begin: "\\b([1-9](_?[0-9])*|0+(_?0)*)[lLjJ]?\\b"}, {begin: "\\b0[bB](_?[01])+[lL]?\\b"}, {begin: "\\b0[oO](_?[0-7])+[lL]?\\b"}, {begin: "\\b0[xX](_?[0-9a-fA-F])+[lL]?\\b"}, {begin: `\\b(${l})[jJ]\\b`}]
                    }, d = {
                        className: "comment",
                        begin: t.lookahead(/# type:/),
                        end: /$/,
                        keywords: r,
                        contains: [{begin: /# type:/}, {begin: /#/, end: /\b\B/, endsWithParent: !0}]
                    }, p = {
                        className: "params",
                        variants: [{className: "", begin: /\(\s*\)/, skip: !0}, {
                            begin: /\(/,
                            end: /\)/,
                            excludeBegin: !0,
                            excludeEnd: !0,
                            keywords: r,
                            contains: ["self", i, u, s, e.HASH_COMMENT_MODE]
                        }]
                    };
                return o.contains = [s, u, i], {
                    name: "Python",
                    aliases: ["py", "gyp", "ipython"],
                    unicodeRegex: !0,
                    keywords: r,
                    illegal: /(<\/|->|\?)|=>/,
                    contains: [i, u, {begin: /\bself\b/}, {
                        beginKeywords: "if",
                        relevance: 0
                    }, s, d, e.HASH_COMMENT_MODE, {
                        match: [/def/, /\s+/, n],
                        scope: {1: "keyword", 3: "title.function"},
                        contains: [p]
                    }, {
                        variants: [{match: [/class/, /\s+/, n, /\s*/, /\(\s*/, n, /\s*\)/]}, {match: [/class/, /\s+/, n]}],
                        scope: {1: "keyword", 3: "title.class", 6: "title.class.inherited"}
                    }, {className: "meta", begin: /^[\t ]*@/, end: /(?=#)|$/, contains: [u, p, s]}]
                }
            }
        }, 1062: e => {
            const t = ["a", "abbr", "address", "article", "aside", "audio", "b", "blockquote", "body", "button", "canvas", "caption", "cite", "code", "dd", "del", "details", "dfn", "div", "dl", "dt", "em", "fieldset", "figcaption", "figure", "footer", "form", "h1", "h2", "h3", "h4", "h5", "h6", "header", "hgroup", "html", "i", "iframe", "img", "input", "ins", "kbd", "label", "legend", "li", "main", "mark", "menu", "nav", "object", "ol", "p", "q", "quote", "samp", "section", "span", "strong", "summary", "sup", "table", "tbody", "td", "textarea", "tfoot", "th", "thead", "time", "tr", "ul", "var", "video"],
                n = ["any-hover", "any-pointer", "aspect-ratio", "color", "color-gamut", "color-index", "device-aspect-ratio", "device-height", "device-width", "display-mode", "forced-colors", "grid", "height", "hover", "inverted-colors", "monochrome", "orientation", "overflow-block", "overflow-inline", "pointer", "prefers-color-scheme", "prefers-contrast", "prefers-reduced-motion", "prefers-reduced-transparency", "resolution", "scan", "scripting", "update", "width", "min-width", "max-width", "min-height", "max-height"],
                r = ["active", "any-link", "blank", "checked", "current", "default", "defined", "dir", "disabled", "drop", "empty", "enabled", "first", "first-child", "first-of-type", "fullscreen", "future", "focus", "focus-visible", "focus-within", "has", "host", "host-context", "hover", "indeterminate", "in-range", "invalid", "is", "lang", "last-child", "last-of-type", "left", "link", "local-link", "not", "nth-child", "nth-col", "nth-last-child", "nth-last-col", "nth-last-of-type", "nth-of-type", "only-child", "only-of-type", "optional", "out-of-range", "past", "placeholder-shown", "read-only", "read-write", "required", "right", "root", "scope", "target", "target-within", "user-invalid", "valid", "visited", "where"],
                i = ["after", "backdrop", "before", "cue", "cue-region", "first-letter", "first-line", "grammar-error", "marker", "part", "placeholder", "selection", "slotted", "spelling-error"],
                o = ["align-content", "align-items", "align-self", "all", "animation", "animation-delay", "animation-direction", "animation-duration", "animation-fill-mode", "animation-iteration-count", "animation-name", "animation-play-state", "animation-timing-function", "backface-visibility", "background", "background-attachment", "background-clip", "background-color", "background-image", "background-origin", "background-position", "background-repeat", "background-size", "border", "border-bottom", "border-bottom-color", "border-bottom-left-radius", "border-bottom-right-radius", "border-bottom-style", "border-bottom-width", "border-collapse", "border-color", "border-image", "border-image-outset", "border-image-repeat", "border-image-slice", "border-image-source", "border-image-width", "border-left", "border-left-color", "border-left-style", "border-left-width", "border-radius", "border-right", "border-right-color", "border-right-style", "border-right-width", "border-spacing", "border-style", "border-top", "border-top-color", "border-top-left-radius", "border-top-right-radius", "border-top-style", "border-top-width", "border-width", "bottom", "box-decoration-break", "box-shadow", "box-sizing", "break-after", "break-before", "break-inside", "caption-side", "caret-color", "clear", "clip", "clip-path", "clip-rule", "color", "column-count", "column-fill", "column-gap", "column-rule", "column-rule-color", "column-rule-style", "column-rule-width", "column-span", "column-width", "columns", "contain", "content", "content-visibility", "counter-increment", "counter-reset", "cue", "cue-after", "cue-before", "cursor", "direction", "display", "empty-cells", "filter", "flex", "flex-basis", "flex-direction", "flex-flow", "flex-grow", "flex-shrink", "flex-wrap", "float", "flow", "font", "font-display", "font-family", "font-feature-settings", "font-kerning", "font-language-override", "font-size", "font-size-adjust", "font-smoothing", "font-stretch", "font-style", "font-synthesis", "font-variant", "font-variant-caps", "font-variant-east-asian", "font-variant-ligatures", "font-variant-numeric", "font-variant-position", "font-variation-settings", "font-weight", "gap", "glyph-orientation-vertical", "grid", "grid-area", "grid-auto-columns", "grid-auto-flow", "grid-auto-rows", "grid-column", "grid-column-end", "grid-column-start", "grid-gap", "grid-row", "grid-row-end", "grid-row-start", "grid-template", "grid-template-areas", "grid-template-columns", "grid-template-rows", "hanging-punctuation", "height", "hyphens", "icon", "image-orientation", "image-rendering", "image-resolution", "ime-mode", "isolation", "justify-content", "left", "letter-spacing", "line-break", "line-height", "list-style", "list-style-image", "list-style-position", "list-style-type", "margin", "margin-bottom", "margin-left", "margin-right", "margin-top", "marks", "mask", "mask-border", "mask-border-mode", "mask-border-outset", "mask-border-repeat", "mask-border-slice", "mask-border-source", "mask-border-width", "mask-clip", "mask-composite", "mask-image", "mask-mode", "mask-origin", "mask-position", "mask-repeat", "mask-size", "mask-type", "max-height", "max-width", "min-height", "min-width", "mix-blend-mode", "nav-down", "nav-index", "nav-left", "nav-right", "nav-up", "none", "normal", "object-fit", "object-position", "opacity", "order", "orphans", "outline", "outline-color", "outline-offset", "outline-style", "outline-width", "overflow", "overflow-wrap", "overflow-x", "overflow-y", "padding", "padding-bottom", "padding-left", "padding-right", "padding-top", "page-break-after", "page-break-before", "page-break-inside", "pause", "pause-after", "pause-before", "perspective", "perspective-origin", "pointer-events", "position", "quotes", "resize", "rest", "rest-after", "rest-before", "right", "row-gap", "scroll-margin", "scroll-margin-block", "scroll-margin-block-end", "scroll-margin-block-start", "scroll-margin-bottom", "scroll-margin-inline", "scroll-margin-inline-end", "scroll-margin-inline-start", "scroll-margin-left", "scroll-margin-right", "scroll-margin-top", "scroll-padding", "scroll-padding-block", "scroll-padding-block-end", "scroll-padding-block-start", "scroll-padding-bottom", "scroll-padding-inline", "scroll-padding-inline-end", "scroll-padding-inline-start", "scroll-padding-left", "scroll-padding-right", "scroll-padding-top", "scroll-snap-align", "scroll-snap-stop", "scroll-snap-type", "shape-image-threshold", "shape-margin", "shape-outside", "speak", "speak-as", "src", "tab-size", "table-layout", "text-align", "text-align-all", "text-align-last", "text-combine-upright", "text-decoration", "text-decoration-color", "text-decoration-line", "text-decoration-style", "text-emphasis", "text-emphasis-color", "text-emphasis-position", "text-emphasis-style", "text-indent", "text-justify", "text-orientation", "text-overflow", "text-rendering", "text-shadow", "text-transform", "text-underline-position", "top", "transform", "transform-box", "transform-origin", "transform-style", "transition", "transition-delay", "transition-duration", "transition-property", "transition-timing-function", "unicode-bidi", "vertical-align", "visibility", "voice-balance", "voice-duration", "voice-family", "voice-pitch", "voice-range", "voice-rate", "voice-stress", "voice-volume", "white-space", "widows", "width", "will-change", "word-break", "word-spacing", "word-wrap", "writing-mode", "z-index"].reverse();
            e.exports = function (e) {
                const a = (e => ({
                        IMPORTANT: {scope: "meta", begin: "!important"},
                        BLOCK_COMMENT: e.C_BLOCK_COMMENT_MODE,
                        HEXCOLOR: {scope: "number", begin: /#(([0-9a-fA-F]{3,4})|(([0-9a-fA-F]{2}){3,4}))\b/},
                        FUNCTION_DISPATCH: {className: "built_in", begin: /[\w-]+(?=\()/},
                        ATTRIBUTE_SELECTOR_MODE: {
                            scope: "selector-attr",
                            begin: /\[/,
                            end: /\]/,
                            illegal: "$",
                            contains: [e.APOS_STRING_MODE, e.QUOTE_STRING_MODE]
                        },
                        CSS_NUMBER_MODE: {
                            scope: "number",
                            begin: e.NUMBER_RE + "(%|em|ex|ch|rem|vw|vh|vmin|vmax|cm|mm|in|pt|pc|px|deg|grad|rad|turn|s|ms|Hz|kHz|dpi|dpcm|dppx)?",
                            relevance: 0
                        },
                        CSS_VARIABLE: {className: "attr", begin: /--[A-Za-z][A-Za-z0-9_-]*/}
                    }))(e), s = i, l = r, c = "@[a-z-]+",
                    u = {className: "variable", begin: "(\\$[a-zA-Z-][a-zA-Z0-9_-]*)\\b"};
                return {
                    name: "SCSS",
                    case_insensitive: !0,
                    illegal: "[=/|']",
                    contains: [e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, a.CSS_NUMBER_MODE, {
                        className: "selector-id",
                        begin: "#[A-Za-z0-9_-]+",
                        relevance: 0
                    }, {
                        className: "selector-class",
                        begin: "\\.[A-Za-z0-9_-]+",
                        relevance: 0
                    }, a.ATTRIBUTE_SELECTOR_MODE, {
                        className: "selector-tag",
                        begin: "\\b(" + t.join("|") + ")\\b",
                        relevance: 0
                    }, {className: "selector-pseudo", begin: ":(" + l.join("|") + ")"}, {
                        className: "selector-pseudo",
                        begin: ":(:)?(" + s.join("|") + ")"
                    }, u, {
                        begin: /\(/,
                        end: /\)/,
                        contains: [a.CSS_NUMBER_MODE]
                    }, a.CSS_VARIABLE, {
                        className: "attribute",
                        begin: "\\b(" + o.join("|") + ")\\b"
                    }, {begin: "\\b(whitespace|wait|w-resize|visible|vertical-text|vertical-ideographic|uppercase|upper-roman|upper-alpha|underline|transparent|top|thin|thick|text|text-top|text-bottom|tb-rl|table-header-group|table-footer-group|sw-resize|super|strict|static|square|solid|small-caps|separate|se-resize|scroll|s-resize|rtl|row-resize|ridge|right|repeat|repeat-y|repeat-x|relative|progress|pointer|overline|outside|outset|oblique|nowrap|not-allowed|normal|none|nw-resize|no-repeat|no-drop|newspaper|ne-resize|n-resize|move|middle|medium|ltr|lr-tb|lowercase|lower-roman|lower-alpha|loose|list-item|line|line-through|line-edge|lighter|left|keep-all|justify|italic|inter-word|inter-ideograph|inside|inset|inline|inline-block|inherit|inactive|ideograph-space|ideograph-parenthesis|ideograph-numeric|ideograph-alpha|horizontal|hidden|help|hand|groove|fixed|ellipsis|e-resize|double|dotted|distribute|distribute-space|distribute-letter|distribute-all-lines|disc|disabled|default|decimal|dashed|crosshair|collapse|col-resize|circle|char|center|capitalize|break-word|break-all|bottom|both|bolder|bold|block|bidi-override|below|baseline|auto|always|all-scroll|absolute|table|table-cell)\\b"}, {
                        begin: /:/,
                        end: /[;}{]/,
                        contains: [a.BLOCK_COMMENT, u, a.HEXCOLOR, a.CSS_NUMBER_MODE, e.QUOTE_STRING_MODE, e.APOS_STRING_MODE, a.IMPORTANT]
                    }, {begin: "@(page|font-face)", keywords: {$pattern: c, keyword: "@page @font-face"}}, {
                        begin: "@",
                        end: "[{;]",
                        returnBegin: !0,
                        keywords: {$pattern: /[a-z-]+/, keyword: "and or not only", attribute: n.join(" ")},
                        contains: [{begin: c, className: "keyword"}, {
                            begin: /[a-z-]+(?=:)/,
                            className: "attribute"
                        }, u, e.QUOTE_STRING_MODE, e.APOS_STRING_MODE, a.HEXCOLOR, a.CSS_NUMBER_MODE]
                    }, a.FUNCTION_DISPATCH]
                }
            }
        }, 4610: e => {
            e.exports = function (e) {
                const t = e.regex, n = t.concat(/[A-Z_]/, t.optional(/[A-Z0-9_.-]*:/), /[A-Z0-9_.-]*/),
                    r = {className: "symbol", begin: /&[a-z]+;|&#[0-9]+;|&#x[a-f0-9]+;/},
                    i = {begin: /\s/, contains: [{className: "keyword", begin: /#?[a-z_][a-z1-9_-]+/, illegal: /\n/}]},
                    o = e.inherit(i, {begin: /\(/, end: /\)/}),
                    a = e.inherit(e.APOS_STRING_MODE, {className: "string"}),
                    s = e.inherit(e.QUOTE_STRING_MODE, {className: "string"}), l = {
                        endsWithParent: !0,
                        illegal: /</,
                        relevance: 0,
                        contains: [{className: "attr", begin: /[A-Za-z0-9._:-]+/, relevance: 0}, {
                            begin: /=\s*/,
                            relevance: 0,
                            contains: [{
                                className: "string",
                                endsParent: !0,
                                variants: [{begin: /"/, end: /"/, contains: [r]}, {
                                    begin: /'/,
                                    end: /'/,
                                    contains: [r]
                                }, {begin: /[^\s"'=<>`]+/}]
                            }]
                        }]
                    };
                return {
                    name: "HTML, XML",
                    aliases: ["html", "xhtml", "rss", "atom", "xjb", "xsd", "xsl", "plist", "wsf", "svg"],
                    case_insensitive: !0,
                    contains: [{
                        className: "meta",
                        begin: /<![a-z]/,
                        end: />/,
                        relevance: 10,
                        contains: [i, s, a, o, {
                            begin: /\[/,
                            end: /\]/,
                            contains: [{className: "meta", begin: /<![a-z]/, end: />/, contains: [i, o, s, a]}]
                        }]
                    }, e.COMMENT(/<!--/, /-->/, {relevance: 10}), {
                        begin: /<!\[CDATA\[/,
                        end: /\]\]>/,
                        relevance: 10
                    }, r, {className: "meta", begin: /<\?xml/, end: /\?>/, relevance: 10}, {
                        className: "tag",
                        begin: /<style(?=\s|>)/,
                        end: />/,
                        keywords: {name: "style"},
                        contains: [l],
                        starts: {end: /<\/style>/, returnEnd: !0, subLanguage: ["css", "xml"]}
                    }, {
                        className: "tag",
                        begin: /<script(?=\s|>)/,
                        end: />/,
                        keywords: {name: "script"},
                        contains: [l],
                        starts: {end: /<\/script>/, returnEnd: !0, subLanguage: ["javascript", "handlebars", "xml"]}
                    }, {className: "tag", begin: /<>|<\/>/}, {
                        className: "tag",
                        begin: t.concat(/</, t.lookahead(t.concat(n, t.either(/\/>/, />/, /\s/)))),
                        end: /\/?>/,
                        contains: [{className: "name", begin: n, relevance: 0, starts: l}]
                    }, {
                        className: "tag",
                        begin: t.concat(/<\//, t.lookahead(t.concat(n, />/))),
                        contains: [{className: "name", begin: n, relevance: 0}, {
                            begin: />/,
                            relevance: 0,
                            endsParent: !0
                        }]
                    }]
                }
            }
        }, 8593: e => {
            "use strict";
            e.exports = JSON.parse('{"_from":"axios@^0.21.4","_id":"axios@0.21.4","_inBundle":false,"_integrity":"sha512-ut5vewkiu8jjGBdqpM44XxjuCjq9LAKeHVmoVfHVzy8eHgxxq8SbAVQNovDA8mVi05kP0Ea/n/UzcSHcTJQfNg==","_location":"/axios","_phantomChildren":{},"_requested":{"type":"range","registry":true,"raw":"axios@^0.21.4","name":"axios","escapedName":"axios","rawSpec":"^0.21.4","saveSpec":null,"fetchSpec":"^0.21.4"},"_requiredBy":["/","/localtunnel"],"_resolved":"https://registry.npmjs.org/axios/-/axios-0.21.4.tgz","_shasum":"c67b90dc0568e5c1cf2b0b858c43ba28e2eda575","_spec":"axios@^0.21.4","_where":"/home/forge/roocket.ir","author":{"name":"Matt Zabriskie"},"browser":{"./lib/adapters/http.js":"./lib/adapters/xhr.js"},"bugs":{"url":"https://github.com/axios/axios/issues"},"bundleDependencies":false,"bundlesize":[{"path":"./dist/axios.min.js","threshold":"5kB"}],"dependencies":{"follow-redirects":"^1.14.0"},"deprecated":false,"description":"Promise based HTTP client for the browser and node.js","devDependencies":{"coveralls":"^3.0.0","es6-promise":"^4.2.4","grunt":"^1.3.0","grunt-banner":"^0.6.0","grunt-cli":"^1.2.0","grunt-contrib-clean":"^1.1.0","grunt-contrib-watch":"^1.0.0","grunt-eslint":"^23.0.0","grunt-karma":"^4.0.0","grunt-mocha-test":"^0.13.3","grunt-ts":"^6.0.0-beta.19","grunt-webpack":"^4.0.2","istanbul-instrumenter-loader":"^1.0.0","jasmine-core":"^2.4.1","karma":"^6.3.2","karma-chrome-launcher":"^3.1.0","karma-firefox-launcher":"^2.1.0","karma-jasmine":"^1.1.1","karma-jasmine-ajax":"^0.1.13","karma-safari-launcher":"^1.0.0","karma-sauce-launcher":"^4.3.6","karma-sinon":"^1.0.5","karma-sourcemap-loader":"^0.3.8","karma-webpack":"^4.0.2","load-grunt-tasks":"^3.5.2","minimist":"^1.2.0","mocha":"^8.2.1","sinon":"^4.5.0","terser-webpack-plugin":"^4.2.3","typescript":"^4.0.5","url-search-params":"^0.10.0","webpack":"^4.44.2","webpack-dev-server":"^3.11.0"},"homepage":"https://axios-http.com","jsdelivr":"dist/axios.min.js","keywords":["xhr","http","ajax","promise","node"],"license":"MIT","main":"index.js","name":"axios","repository":{"type":"git","url":"git+https://github.com/axios/axios.git"},"scripts":{"build":"NODE_ENV=production grunt build","coveralls":"cat coverage/lcov.info | ./node_modules/coveralls/bin/coveralls.js","examples":"node ./examples/server.js","fix":"eslint --fix lib/**/*.js","postversion":"git push && git push --tags","preversion":"npm test","start":"node ./sandbox/server.js","test":"grunt test","version":"npm run build && grunt version && git add -A dist && git add CHANGELOG.md bower.json package.json"},"typings":"./index.d.ts","unpkg":"dist/axios.min.js","version":"0.21.4"}')
        }
    }, t = {};

    function n(r) {
        var i = t[r];
        if (void 0 !== i) return i.exports;
        var o = t[r] = {exports: {}};
        return e[r].call(o.exports, o, o.exports, n), o.exports
    }

    n.n = e => {
        var t = e && e.__esModule ? () => e.default : () => e;
        return n.d(t, {a: t}), t
    }, n.d = (e, t) => {
        for (var r in t) n.o(t, r) && !n.o(e, r) && Object.defineProperty(e, r, {enumerable: !0, get: t[r]})
    }, n.g = function () {
        if ("object" == typeof globalThis) return globalThis;
        try {
            return this || new Function("return this")()
        } catch (e) {
            if ("object" == typeof window) return window
        }
    }(), n.o = (e, t) => Object.prototype.hasOwnProperty.call(e, t), n.r = e => {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
    }, (() => {
        "use strict";
        var e, t, r, i, o = Object.create, a = Object.defineProperty, s = Object.getPrototypeOf,
            l = Object.prototype.hasOwnProperty, c = Object.getOwnPropertyNames, u = Object.getOwnPropertyDescriptor,
            d = (e, t) => () => (t || e((t = {exports: {}}).exports, t), t.exports), p = d((e => {
                function t(e, t) {
                    const n = Object.create(null), r = e.split(",");
                    for (let e = 0; e < r.length; e++) n[r[e]] = !0;
                    return t ? e => !!n[e.toLowerCase()] : e => !!n[e]
                }

                Object.defineProperty(e, "__esModule", {value: !0});
                var r = {
                        1: "TEXT",
                        2: "CLASS",
                        4: "STYLE",
                        8: "PROPS",
                        16: "FULL_PROPS",
                        32: "HYDRATE_EVENTS",
                        64: "STABLE_FRAGMENT",
                        128: "KEYED_FRAGMENT",
                        256: "UNKEYED_FRAGMENT",
                        512: "NEED_PATCH",
                        1024: "DYNAMIC_SLOTS",
                        2048: "DEV_ROOT_FRAGMENT",
                        [-1]: "HOISTED",
                        [-2]: "BAIL"
                    }, i = {1: "STABLE", 2: "DYNAMIC", 3: "FORWARDED"},
                    o = t("Infinity,undefined,NaN,isFinite,isNaN,parseFloat,parseInt,decodeURI,decodeURIComponent,encodeURI,encodeURIComponent,Math,Number,Date,Array,Object,Boolean,String,RegExp,Map,Set,JSON,Intl,BigInt");
                var a = "itemscope,allowfullscreen,formnovalidate,ismap,nomodule,novalidate,readonly", s = t(a),
                    l = t(a + ",async,autofocus,autoplay,controls,default,defer,disabled,hidden,loop,open,required,reversed,scoped,seamless,checked,muted,multiple,selected"),
                    c = /[>/="'\u0009\u000a\u000c\u0020]/, u = {};
                var d = t("animation-iteration-count,border-image-outset,border-image-slice,border-image-width,box-flex,box-flex-group,box-ordinal-group,column-count,columns,flex,flex-grow,flex-positive,flex-shrink,flex-negative,flex-order,grid-row,grid-row-end,grid-row-span,grid-row-start,grid-column,grid-column-end,grid-column-span,grid-column-start,font-weight,line-clamp,line-height,opacity,order,orphans,tab-size,widows,z-index,zoom,fill-opacity,flood-opacity,stop-opacity,stroke-dasharray,stroke-dashoffset,stroke-miterlimit,stroke-opacity,stroke-width"),
                    p = t("accept,accept-charset,accesskey,action,align,allow,alt,async,autocapitalize,autocomplete,autofocus,autoplay,background,bgcolor,border,buffered,capture,challenge,charset,checked,cite,class,code,codebase,color,cols,colspan,content,contenteditable,contextmenu,controls,coords,crossorigin,csp,data,datetime,decoding,default,defer,dir,dirname,disabled,download,draggable,dropzone,enctype,enterkeyhint,for,form,formaction,formenctype,formmethod,formnovalidate,formtarget,headers,height,hidden,high,href,hreflang,http-equiv,icon,id,importance,integrity,ismap,itemprop,keytype,kind,label,lang,language,loading,list,loop,low,manifest,max,maxlength,minlength,media,min,multiple,muted,name,novalidate,open,optimum,pattern,ping,placeholder,poster,preload,radiogroup,readonly,referrerpolicy,rel,required,reversed,rows,rowspan,sandbox,scope,scoped,selected,shape,size,sizes,slot,span,spellcheck,src,srcdoc,srclang,srcset,start,step,style,summary,tabindex,target,title,translate,type,usemap,value,width,wrap");
                var h = /;(?![^(]*\))/g, f = /:(.+)/;

                function g(e) {
                    const t = {};
                    return e.split(h).forEach((e => {
                        if (e) {
                            const n = e.split(f);
                            n.length > 1 && (t[n[0].trim()] = n[1].trim())
                        }
                    })), t
                }

                var m = t("html,body,base,head,link,meta,style,title,address,article,aside,footer,header,h1,h2,h3,h4,h5,h6,hgroup,nav,section,div,dd,dl,dt,figcaption,figure,picture,hr,img,li,main,ol,p,pre,ul,a,b,abbr,bdi,bdo,br,cite,code,data,dfn,em,i,kbd,mark,q,rp,rt,rtc,ruby,s,samp,small,span,strong,sub,sup,time,u,var,wbr,area,audio,map,track,video,embed,object,param,source,canvas,script,noscript,del,ins,caption,col,colgroup,table,thead,tbody,td,th,tr,button,datalist,fieldset,form,input,label,legend,meter,optgroup,option,output,progress,select,textarea,details,dialog,menu,summary,template,blockquote,iframe,tfoot"),
                    v = t("svg,animate,animateMotion,animateTransform,circle,clipPath,color-profile,defs,desc,discard,ellipse,feBlend,feColorMatrix,feComponentTransfer,feComposite,feConvolveMatrix,feDiffuseLighting,feDisplacementMap,feDistanceLight,feDropShadow,feFlood,feFuncA,feFuncB,feFuncG,feFuncR,feGaussianBlur,feImage,feMerge,feMergeNode,feMorphology,feOffset,fePointLight,feSpecularLighting,feSpotLight,feTile,feTurbulence,filter,foreignObject,g,hatch,hatchpath,image,line,linearGradient,marker,mask,mesh,meshgradient,meshpatch,meshrow,metadata,mpath,path,pattern,polygon,polyline,radialGradient,rect,set,solidcolor,stop,switch,symbol,text,textPath,title,tspan,unknown,use,view"),
                    b = t("area,base,br,col,embed,hr,img,input,link,meta,param,source,track,wbr"), w = /["'&<>]/;
                var y = /^-?>|<!--|-->|--!>|<!-$/g;

                function _(e, t) {
                    if (e === t) return !0;
                    let n = L(e), r = L(t);
                    if (n || r) return !(!n || !r) && e.getTime() === t.getTime();
                    if (n = O(e), r = O(t), n || r) return !(!n || !r) && function (e, t) {
                        if (e.length !== t.length) return !1;
                        let n = !0;
                        for (let r = 0; n && r < e.length; r++) n = _(e[r], t[r]);
                        return n
                    }(e, t);
                    if (n = I(e), r = I(t), n || r) {
                        if (!n || !r) return !1;
                        if (Object.keys(e).length !== Object.keys(t).length) return !1;
                        for (const n in e) {
                            const r = e.hasOwnProperty(n), i = t.hasOwnProperty(n);
                            if (r && !i || !r && i || !_(e[n], t[n])) return !1
                        }
                    }
                    return String(e) === String(t)
                }

                var k,
                    x = (e, t) => P(t) ? {[`Map(${t.size})`]: [...t.entries()].reduce(((e, [t, n]) => (e[`${t} =>`] = n, e)), {})} : M(t) ? {[`Set(${t.size})`]: [...t.values()]} : !I(t) || O(t) || B(t) ? t : String(t),
                    S = Object.freeze({}), C = Object.freeze([]), E = /^on[^a-z]/, T = Object.assign,
                    A = Object.prototype.hasOwnProperty, O = Array.isArray, P = e => "[object Map]" === R(e),
                    M = e => "[object Set]" === R(e), L = e => e instanceof Date, j = e => "function" == typeof e,
                    N = e => "string" == typeof e, I = e => null !== e && "object" == typeof e,
                    z = Object.prototype.toString, R = e => z.call(e), B = e => "[object Object]" === R(e),
                    D = t(",key,ref,onVnodeBeforeMount,onVnodeMounted,onVnodeBeforeUpdate,onVnodeUpdated,onVnodeBeforeUnmount,onVnodeUnmounted"),
                    H = e => {
                        const t = Object.create(null);
                        return n => t[n] || (t[n] = e(n))
                    }, $ = /-(\w)/g, q = H((e => e.replace($, ((e, t) => t ? t.toUpperCase() : "")))), F = /\B([A-Z])/g,
                    U = H((e => e.replace(F, "-$1").toLowerCase())), V = H((e => e.charAt(0).toUpperCase() + e.slice(1))),
                    W = H((e => e ? `on${V(e)}` : ""));
                e.EMPTY_ARR = C, e.EMPTY_OBJ = S, e.NO = () => !1, e.NOOP = () => {
                }, e.PatchFlagNames = r, e.babelParserDefaultPlugins = ["bigInt", "optionalChaining", "nullishCoalescingOperator"], e.camelize = q, e.capitalize = V, e.def = (e, t, n) => {
                    Object.defineProperty(e, t, {configurable: !0, enumerable: !1, value: n})
                }, e.escapeHtml = function (e) {
                    const t = "" + e, n = w.exec(t);
                    if (!n) return t;
                    let r, i, o = "", a = 0;
                    for (i = n.index; i < t.length; i++) {
                        switch (t.charCodeAt(i)) {
                            case 34:
                                r = "&quot;";
                                break;
                            case 38:
                                r = "&amp;";
                                break;
                            case 39:
                                r = "&#39;";
                                break;
                            case 60:
                                r = "&lt;";
                                break;
                            case 62:
                                r = "&gt;";
                                break;
                            default:
                                continue
                        }
                        a !== i && (o += t.substring(a, i)), a = i + 1, o += r
                    }
                    return a !== i ? o + t.substring(a, i) : o
                }, e.escapeHtmlComment = function (e) {
                    return e.replace(y, "")
                }, e.extend = T, e.generateCodeFrame = function (e, t = 0, n = e.length) {
                    const r = e.split(/\r?\n/);
                    let i = 0;
                    const o = [];
                    for (let e = 0; e < r.length; e++) if (i += r[e].length + 1, i >= t) {
                        for (let a = e - 2; a <= e + 2 || n > i; a++) {
                            if (a < 0 || a >= r.length) continue;
                            const s = a + 1;
                            o.push(`${s}${" ".repeat(Math.max(3 - String(s).length, 0))}|  ${r[a]}`);
                            const l = r[a].length;
                            if (a === e) {
                                const e = t - (i - l) + 1, r = Math.max(1, n > i ? l - e : n - t);
                                o.push("   |  " + " ".repeat(e) + "^".repeat(r))
                            } else if (a > e) {
                                if (n > i) {
                                    const e = Math.max(Math.min(n - i, l), 1);
                                    o.push("   |  " + "^".repeat(e))
                                }
                                i += l + 1
                            }
                        }
                        break
                    }
                    return o.join("\n")
                }, e.getGlobalThis = () => k || (k = "undefined" != typeof globalThis ? globalThis : "undefined" != typeof self ? self : "undefined" != typeof window ? window : void 0 !== n.g ? n.g : {}), e.hasChanged = (e, t) => e !== t && (e == e || t == t), e.hasOwn = (e, t) => A.call(e, t), e.hyphenate = U, e.invokeArrayFns = (e, t) => {
                    for (let n = 0; n < e.length; n++) e[n](t)
                }, e.isArray = O, e.isBooleanAttr = l, e.isDate = L, e.isFunction = j, e.isGloballyWhitelisted = o, e.isHTMLTag = m, e.isIntegerKey = e => N(e) && "NaN" !== e && "-" !== e[0] && "" + parseInt(e, 10) === e, e.isKnownAttr = p, e.isMap = P, e.isModelListener = e => e.startsWith("onUpdate:"), e.isNoUnitNumericStyleProp = d, e.isObject = I, e.isOn = e => E.test(e), e.isPlainObject = B, e.isPromise = e => I(e) && j(e.then) && j(e.catch), e.isReservedProp = D, e.isSSRSafeAttrName = function (e) {
                    if (u.hasOwnProperty(e)) return u[e];
                    const t = c.test(e);
                    return t && console.error(`unsafe attribute name: ${e}`), u[e] = !t
                }, e.isSVGTag = v, e.isSet = M, e.isSpecialBooleanAttr = s, e.isString = N, e.isSymbol = e => "symbol" == typeof e, e.isVoidTag = b, e.looseEqual = _, e.looseIndexOf = function (e, t) {
                    return e.findIndex((e => _(e, t)))
                }, e.makeMap = t, e.normalizeClass = function e(t) {
                    let n = "";
                    if (N(t)) n = t; else if (O(t)) for (let r = 0; r < t.length; r++) {
                        const i = e(t[r]);
                        i && (n += i + " ")
                    } else if (I(t)) for (const e in t) t[e] && (n += e + " ");
                    return n.trim()
                }, e.normalizeStyle = function e(t) {
                    if (O(t)) {
                        const n = {};
                        for (let r = 0; r < t.length; r++) {
                            const i = t[r], o = e(N(i) ? g(i) : i);
                            if (o) for (const e in o) n[e] = o[e]
                        }
                        return n
                    }
                    if (I(t)) return t
                }, e.objectToString = z, e.parseStringStyle = g, e.propsToAttrMap = {
                    acceptCharset: "accept-charset",
                    className: "class",
                    htmlFor: "for",
                    httpEquiv: "http-equiv"
                }, e.remove = (e, t) => {
                    const n = e.indexOf(t);
                    n > -1 && e.splice(n, 1)
                }, e.slotFlagsText = i, e.stringifyStyle = function (e) {
                    let t = "";
                    if (!e) return t;
                    for (const n in e) {
                        const r = e[n], i = n.startsWith("--") ? n : U(n);
                        (N(r) || "number" == typeof r && d(i)) && (t += `${i}:${r};`)
                    }
                    return t
                }, e.toDisplayString = e => null == e ? "" : I(e) ? JSON.stringify(e, x, 2) : String(e), e.toHandlerKey = W, e.toNumber = e => {
                    const t = parseFloat(e);
                    return isNaN(t) ? e : t
                }, e.toRawType = e => R(e).slice(8, -1), e.toTypeString = R
            })), h = d(((e, t) => {
                t.exports = p()
            })), f = d((e => {
                Object.defineProperty(e, "__esModule", {value: !0});
                var t, n = h(), r = new WeakMap, i = [], o = Symbol("iterate"), a = Symbol("Map key iterate");

                function s(e, r = n.EMPTY_OBJ) {
                    (function (e) {
                        return e && !0 === e._isEffect
                    })(e) && (e = e.raw);
                    const o = function (e, n) {
                        const r = function () {
                            if (!r.active) return e();
                            if (!i.includes(r)) {
                                c(r);
                                try {
                                    return f(), i.push(r), t = r, e()
                                } finally {
                                    i.pop(), g(), t = i[i.length - 1]
                                }
                            }
                        };
                        return r.id = l++, r.allowRecurse = !!n.allowRecurse, r._isEffect = !0, r.active = !0, r.raw = e, r.deps = [], r.options = n, r
                    }(e, r);
                    return r.lazy || o(), o
                }

                var l = 0;

                function c(e) {
                    const {deps: t} = e;
                    if (t.length) {
                        for (let n = 0; n < t.length; n++) t[n].delete(e);
                        t.length = 0
                    }
                }

                var u = !0, d = [];

                function p() {
                    d.push(u), u = !1
                }

                function f() {
                    d.push(u), u = !0
                }

                function g() {
                    const e = d.pop();
                    u = void 0 === e || e
                }

                function m(e, n, i) {
                    if (!u || void 0 === t) return;
                    let o = r.get(e);
                    o || r.set(e, o = new Map);
                    let a = o.get(i);
                    a || o.set(i, a = new Set), a.has(t) || (a.add(t), t.deps.push(a), t.options.onTrack && t.options.onTrack({
                        effect: t,
                        target: e,
                        type: n,
                        key: i
                    }))
                }

                function v(e, i, s, l, c, u) {
                    const d = r.get(e);
                    if (!d) return;
                    const p = new Set, h = e => {
                        e && e.forEach((e => {
                            (e !== t || e.allowRecurse) && p.add(e)
                        }))
                    };
                    if ("clear" === i) d.forEach(h); else if ("length" === s && n.isArray(e)) d.forEach(((e, t) => {
                        ("length" === t || t >= l) && h(e)
                    })); else switch (void 0 !== s && h(d.get(s)), i) {
                        case"add":
                            n.isArray(e) ? n.isIntegerKey(s) && h(d.get("length")) : (h(d.get(o)), n.isMap(e) && h(d.get(a)));
                            break;
                        case"delete":
                            n.isArray(e) || (h(d.get(o)), n.isMap(e) && h(d.get(a)));
                            break;
                        case"set":
                            n.isMap(e) && h(d.get(o))
                    }
                    p.forEach((t => {
                        t.options.onTrigger && t.options.onTrigger({
                            effect: t,
                            target: e,
                            key: s,
                            type: i,
                            newValue: l,
                            oldValue: c,
                            oldTarget: u
                        }), t.options.scheduler ? t.options.scheduler(t) : t()
                    }))
                }

                var b = n.makeMap("__proto__,__v_isRef,__isVue"),
                    w = new Set(Object.getOwnPropertyNames(Symbol).map((e => Symbol[e])).filter(n.isSymbol)), y = C(),
                    _ = C(!1, !0), k = C(!0), x = C(!0, !0), S = {};

                function C(e = !1, t = !1) {
                    return function (r, i, o) {
                        if ("__v_isReactive" === i) return !e;
                        if ("__v_isReadonly" === i) return e;
                        if ("__v_raw" === i && o === (e ? t ? ae : oe : t ? ie : re).get(r)) return r;
                        const a = n.isArray(r);
                        if (!e && a && n.hasOwn(S, i)) return Reflect.get(S, i, o);
                        const s = Reflect.get(r, i, o);
                        if (n.isSymbol(i) ? w.has(i) : b(i)) return s;
                        if (e || m(r, "get", i), t) return s;
                        if (ge(s)) {
                            return !a || !n.isIntegerKey(i) ? s.value : s
                        }
                        return n.isObject(s) ? e ? le(s) : se(s) : s
                    }
                }

                ["includes", "indexOf", "lastIndexOf"].forEach((e => {
                    const t = Array.prototype[e];
                    S[e] = function (...e) {
                        const n = he(this);
                        for (let e = 0, t = this.length; e < t; e++) m(n, "get", e + "");
                        const r = t.apply(n, e);
                        return -1 === r || !1 === r ? t.apply(n, e.map(he)) : r
                    }
                })), ["push", "pop", "shift", "unshift", "splice"].forEach((e => {
                    const t = Array.prototype[e];
                    S[e] = function (...e) {
                        p();
                        const n = t.apply(this, e);
                        return g(), n
                    }
                }));
                var E = A(), T = A(!0);

                function A(e = !1) {
                    return function (t, r, i, o) {
                        let a = t[r];
                        if (!e && (i = he(i), a = he(a), !n.isArray(t) && ge(a) && !ge(i))) return a.value = i, !0;
                        const s = n.isArray(t) && n.isIntegerKey(r) ? Number(r) < t.length : n.hasOwn(t, r),
                            l = Reflect.set(t, r, i, o);
                        return t === he(o) && (s ? n.hasChanged(i, a) && v(t, "set", r, i, a) : v(t, "add", r, i)), l
                    }
                }

                var O = {
                        get: y, set: E, deleteProperty: function (e, t) {
                            const r = n.hasOwn(e, t), i = e[t], o = Reflect.deleteProperty(e, t);
                            return o && r && v(e, "delete", t, void 0, i), o
                        }, has: function (e, t) {
                            const r = Reflect.has(e, t);
                            return n.isSymbol(t) && w.has(t) || m(e, "has", t), r
                        }, ownKeys: function (e) {
                            return m(e, "iterate", n.isArray(e) ? "length" : o), Reflect.ownKeys(e)
                        }
                    }, P = {
                        get: k,
                        set: (e, t) => (console.warn(`Set operation on key "${String(t)}" failed: target is readonly.`, e), !0),
                        deleteProperty: (e, t) => (console.warn(`Delete operation on key "${String(t)}" failed: target is readonly.`, e), !0)
                    }, M = n.extend({}, O, {get: _, set: T}), L = n.extend({}, P, {get: x}), j = e => n.isObject(e) ? se(e) : e,
                    N = e => n.isObject(e) ? le(e) : e, I = e => e, z = e => Reflect.getPrototypeOf(e);

                function R(e, t, n = !1, r = !1) {
                    const i = he(e = e.__v_raw), o = he(t);
                    t !== o && !n && m(i, "get", t), !n && m(i, "get", o);
                    const {has: a} = z(i), s = r ? I : n ? N : j;
                    return a.call(i, t) ? s(e.get(t)) : a.call(i, o) ? s(e.get(o)) : void (e !== i && e.get(t))
                }

                function B(e, t = !1) {
                    const n = this.__v_raw, r = he(n), i = he(e);
                    return e !== i && !t && m(r, "has", e), !t && m(r, "has", i), e === i ? n.has(e) : n.has(e) || n.has(i)
                }

                function D(e, t = !1) {
                    return e = e.__v_raw, !t && m(he(e), "iterate", o), Reflect.get(e, "size", e)
                }

                function H(e) {
                    e = he(e);
                    const t = he(this);
                    return z(t).has.call(t, e) || (t.add(e), v(t, "add", e, e)), this
                }

                function $(e, t) {
                    t = he(t);
                    const r = he(this), {has: i, get: o} = z(r);
                    let a = i.call(r, e);
                    a ? ne(r, i, e) : (e = he(e), a = i.call(r, e));
                    const s = o.call(r, e);
                    return r.set(e, t), a ? n.hasChanged(t, s) && v(r, "set", e, t, s) : v(r, "add", e, t), this
                }

                function q(e) {
                    const t = he(this), {has: n, get: r} = z(t);
                    let i = n.call(t, e);
                    i ? ne(t, n, e) : (e = he(e), i = n.call(t, e));
                    const o = r ? r.call(t, e) : void 0, a = t.delete(e);
                    return i && v(t, "delete", e, void 0, o), a
                }

                function F() {
                    const e = he(this), t = 0 !== e.size, r = n.isMap(e) ? new Map(e) : new Set(e), i = e.clear();
                    return t && v(e, "clear", void 0, void 0, r), i
                }

                function U(e, t) {
                    return function (n, r) {
                        const i = this, a = i.__v_raw, s = he(a), l = t ? I : e ? N : j;
                        return !e && m(s, "iterate", o), a.forEach(((e, t) => n.call(r, l(e), l(t), i)))
                    }
                }

                function V(e, t, r) {
                    return function (...i) {
                        const s = this.__v_raw, l = he(s), c = n.isMap(l),
                            u = "entries" === e || e === Symbol.iterator && c, d = "keys" === e && c, p = s[e](...i),
                            h = r ? I : t ? N : j;
                        return !t && m(l, "iterate", d ? a : o), {
                            next() {
                                const {value: e, done: t} = p.next();
                                return t ? {value: e, done: t} : {value: u ? [h(e[0]), h(e[1])] : h(e), done: t}
                            }, [Symbol.iterator]() {
                                return this
                            }
                        }
                    }
                }

                function W(e) {
                    return function (...t) {
                        {
                            const r = t[0] ? `on key "${t[0]}" ` : "";
                            console.warn(`${n.capitalize(e)} operation ${r}failed: target is readonly.`, he(this))
                        }
                        return "delete" !== e && this
                    }
                }

                var G = {
                    get(e) {
                        return R(this, e)
                    }, get size() {
                        return D(this)
                    }, has: B, add: H, set: $, delete: q, clear: F, forEach: U(!1, !1)
                }, K = {
                    get(e) {
                        return R(this, e, !1, !0)
                    }, get size() {
                        return D(this)
                    }, has: B, add: H, set: $, delete: q, clear: F, forEach: U(!1, !0)
                }, X = {
                    get(e) {
                        return R(this, e, !0)
                    }, get size() {
                        return D(this, !0)
                    }, has(e) {
                        return B.call(this, e, !0)
                    }, add: W("add"), set: W("set"), delete: W("delete"), clear: W("clear"), forEach: U(!0, !1)
                }, Z = {
                    get(e) {
                        return R(this, e, !0, !0)
                    }, get size() {
                        return D(this, !0)
                    }, has(e) {
                        return B.call(this, e, !0)
                    }, add: W("add"), set: W("set"), delete: W("delete"), clear: W("clear"), forEach: U(!0, !0)
                };

                function Y(e, t) {
                    const r = t ? e ? Z : K : e ? X : G;
                    return (t, i, o) => "__v_isReactive" === i ? !e : "__v_isReadonly" === i ? e : "__v_raw" === i ? t : Reflect.get(n.hasOwn(r, i) && i in t ? r : t, i, o)
                }

                ["keys", "values", "entries", Symbol.iterator].forEach((e => {
                    G[e] = V(e, !1, !1), X[e] = V(e, !0, !1), K[e] = V(e, !1, !0), Z[e] = V(e, !0, !0)
                }));
                var J = {get: Y(!1, !1)}, Q = {get: Y(!1, !0)}, ee = {get: Y(!0, !1)}, te = {get: Y(!0, !0)};

                function ne(e, t, r) {
                    const i = he(r);
                    if (i !== r && t.call(e, i)) {
                        const t = n.toRawType(e);
                        console.warn(`Reactive ${t} contains both the raw and reactive versions of the same object${"Map" === t ? " as keys" : ""}, which can lead to inconsistencies. Avoid differentiating between the raw and reactive versions of an object and only use the reactive version if possible.`)
                    }
                }

                var re = new WeakMap, ie = new WeakMap, oe = new WeakMap, ae = new WeakMap;

                function se(e) {
                    return e && e.__v_isReadonly ? e : ce(e, !1, O, J, re)
                }

                function le(e) {
                    return ce(e, !0, P, ee, oe)
                }

                function ce(e, t, r, i, o) {
                    if (!n.isObject(e)) return console.warn(`value cannot be made reactive: ${String(e)}`), e;
                    if (e.__v_raw && (!t || !e.__v_isReactive)) return e;
                    const a = o.get(e);
                    if (a) return a;
                    const s = (l = e).__v_skip || !Object.isExtensible(l) ? 0 : function (e) {
                        switch (e) {
                            case"Object":
                            case"Array":
                                return 1;
                            case"Map":
                            case"Set":
                            case"WeakMap":
                            case"WeakSet":
                                return 2;
                            default:
                                return 0
                        }
                    }(n.toRawType(l));
                    var l;
                    if (0 === s) return e;
                    const c = new Proxy(e, 2 === s ? i : r);
                    return o.set(e, c), c
                }

                function ue(e) {
                    return de(e) ? ue(e.__v_raw) : !(!e || !e.__v_isReactive)
                }

                function de(e) {
                    return !(!e || !e.__v_isReadonly)
                }

                function pe(e) {
                    return ue(e) || de(e)
                }

                function he(e) {
                    return e && he(e.__v_raw) || e
                }

                var fe = e => n.isObject(e) ? se(e) : e;

                function ge(e) {
                    return Boolean(e && !0 === e.__v_isRef)
                }

                function me(e, t = !1) {
                    return ge(e) ? e : new class {
                        constructor(e, t = !1) {
                            this._rawValue = e, this._shallow = t, this.__v_isRef = !0, this._value = t ? e : fe(e)
                        }

                        get value() {
                            return m(he(this), "get", "value"), this._value
                        }

                        set value(e) {
                            n.hasChanged(he(e), this._rawValue) && (this._rawValue = e, this._value = this._shallow ? e : fe(e), v(he(this), "set", "value", e))
                        }
                    }(e, t)
                }

                function ve(e) {
                    return ge(e) ? e.value : e
                }

                var be = {
                    get: (e, t, n) => ve(Reflect.get(e, t, n)), set: (e, t, n, r) => {
                        const i = e[t];
                        return ge(i) && !ge(n) ? (i.value = n, !0) : Reflect.set(e, t, n, r)
                    }
                };

                function we(e, t) {
                    return ge(e[t]) ? e[t] : new class {
                        constructor(e, t) {
                            this._object = e, this._key = t, this.__v_isRef = !0
                        }

                        get value() {
                            return this._object[this._key]
                        }

                        set value(e) {
                            this._object[this._key] = e
                        }
                    }(e, t)
                }

                e.ITERATE_KEY = o, e.computed = function (e) {
                    let t, r;
                    return n.isFunction(e) ? (t = e, r = () => {
                        console.warn("Write operation failed: computed value is readonly")
                    }) : (t = e.get, r = e.set), new class {
                        constructor(e, t, n) {
                            this._setter = t, this._dirty = !0, this.__v_isRef = !0, this.effect = s(e, {
                                lazy: !0,
                                scheduler: () => {
                                    this._dirty || (this._dirty = !0, v(he(this), "set", "value"))
                                }
                            }), this.__v_isReadonly = n
                        }

                        get value() {
                            const e = he(this);
                            return e._dirty && (e._value = this.effect(), e._dirty = !1), m(e, "get", "value"), e._value
                        }

                        set value(e) {
                            this._setter(e)
                        }
                    }(t, r, n.isFunction(e) || !e.set)
                }, e.customRef = function (e) {
                    return new class {
                        constructor(e) {
                            this.__v_isRef = !0;
                            const {get: t, set: n} = e((() => m(this, "get", "value")), (() => v(this, "set", "value")));
                            this._get = t, this._set = n
                        }

                        get value() {
                            return this._get()
                        }

                        set value(e) {
                            this._set(e)
                        }
                    }(e)
                }, e.effect = s, e.enableTracking = f, e.isProxy = pe, e.isReactive = ue, e.isReadonly = de, e.isRef = ge, e.markRaw = function (e) {
                    return n.def(e, "__v_skip", !0), e
                }, e.pauseTracking = p, e.proxyRefs = function (e) {
                    return ue(e) ? e : new Proxy(e, be)
                }, e.reactive = se, e.readonly = le, e.ref = function (e) {
                    return me(e)
                }, e.resetTracking = g, e.shallowReactive = function (e) {
                    return ce(e, !1, M, Q, ie)
                }, e.shallowReadonly = function (e) {
                    return ce(e, !0, L, te, ae)
                }, e.shallowRef = function (e) {
                    return me(e, !0)
                }, e.stop = function (e) {
                    e.active && (c(e), e.options.onStop && e.options.onStop(), e.active = !1)
                }, e.toRaw = he, e.toRef = we, e.toRefs = function (e) {
                    pe(e) || console.warn("toRefs() expects a reactive object but received a plain one.");
                    const t = n.isArray(e) ? new Array(e.length) : {};
                    for (const n in e) t[n] = we(e, n);
                    return t
                }, e.track = m, e.trigger = v, e.triggerRef = function (e) {
                    v(he(e), "set", "value", e.value)
                }, e.unref = ve
            })), g = d(((e, t) => {
                t.exports = f()
            })), m = !1, v = !1, b = [];

        function w(e) {
            !function (e) {
                b.includes(e) || b.push(e);
                v || m || (m = !0, queueMicrotask(y))
            }(e)
        }

        function y() {
            m = !1, v = !0;
            for (let e = 0; e < b.length; e++) b[e]();
            b.length = 0, v = !1
        }

        var _ = !0;

        function k(e) {
            t = e
        }

        var x = [], S = [], C = [];

        function E(e, t) {
            e._x_attributeCleanups && Object.entries(e._x_attributeCleanups).forEach((([n, r]) => {
                (void 0 === t || t.includes(n)) && (r.forEach((e => e())), delete e._x_attributeCleanups[n])
            }))
        }

        var T = new MutationObserver(z), A = !1;

        function O() {
            T.observe(document, {subtree: !0, childList: !0, attributes: !0, attributeOldValue: !0}), A = !0
        }

        function P() {
            (M = M.concat(T.takeRecords())).length && !L && (L = !0, queueMicrotask((() => {
                z(M), M.length = 0, L = !1
            }))), T.disconnect(), A = !1
        }

        var M = [], L = !1;

        function j(e) {
            if (!A) return e();
            P();
            let t = e();
            return O(), t
        }

        var N = !1, I = [];

        function z(e) {
            if (N) return void (I = I.concat(e));
            let t = [], n = [], r = new Map, i = new Map;
            for (let o = 0; o < e.length; o++) if (!e[o].target._x_ignoreMutationObserver && ("childList" === e[o].type && (e[o].addedNodes.forEach((e => 1 === e.nodeType && t.push(e))), e[o].removedNodes.forEach((e => 1 === e.nodeType && n.push(e)))), "attributes" === e[o].type)) {
                let t = e[o].target, n = e[o].attributeName, a = e[o].oldValue, s = () => {
                    r.has(t) || r.set(t, []), r.get(t).push({name: n, value: t.getAttribute(n)})
                }, l = () => {
                    i.has(t) || i.set(t, []), i.get(t).push(n)
                };
                t.hasAttribute(n) && null === a ? s() : t.hasAttribute(n) ? (l(), s()) : l()
            }
            i.forEach(((e, t) => {
                E(t, e)
            })), r.forEach(((e, t) => {
                x.forEach((n => n(t, e)))
            }));
            for (let e of n) t.includes(e) || S.forEach((t => t(e)));
            t.forEach((e => {
                e._x_ignoreSelf = !0, e._x_ignore = !0
            }));
            for (let e of t) n.includes(e) || e.isConnected && (delete e._x_ignoreSelf, delete e._x_ignore, C.forEach((t => t(e))), e._x_ignore = !0, e._x_ignoreSelf = !0);
            t.forEach((e => {
                delete e._x_ignoreSelf, delete e._x_ignore
            })), t = null, n = null, r = null, i = null
        }

        function R(e, t, n) {
            return e._x_dataStack = [t, ...D(n || e)], () => {
                e._x_dataStack = e._x_dataStack.filter((e => e !== t))
            }
        }

        function B(e, t) {
            let n = e._x_dataStack[0];
            Object.entries(t).forEach((([e, t]) => {
                n[e] = t
            }))
        }

        function D(e) {
            return e._x_dataStack ? e._x_dataStack : "function" == typeof ShadowRoot && e instanceof ShadowRoot ? D(e.host) : e.parentNode ? D(e.parentNode) : []
        }

        function H(e) {
            let t = new Proxy({}, {
                ownKeys: () => Array.from(new Set(e.flatMap((e => Object.keys(e))))),
                has: (t, n) => e.some((e => e.hasOwnProperty(n))),
                get: (n, r) => (e.find((e => {
                    if (e.hasOwnProperty(r)) {
                        let n = Object.getOwnPropertyDescriptor(e, r);
                        if (n.get && n.get._x_alreadyBound || n.set && n.set._x_alreadyBound) return !0;
                        if ((n.get || n.set) && n.enumerable) {
                            let i = n.get, o = n.set, a = n;
                            i = i && i.bind(t), o = o && o.bind(t), i && (i._x_alreadyBound = !0), o && (o._x_alreadyBound = !0), Object.defineProperty(e, r, {
                                ...a,
                                get: i,
                                set: o
                            })
                        }
                        return !0
                    }
                    return !1
                })) || {})[r],
                set: (t, n, r) => {
                    let i = e.find((e => e.hasOwnProperty(n)));
                    return i ? i[n] = r : e[e.length - 1][n] = r, !0
                }
            });
            return t
        }

        function $(e) {
            let t = (n, r = "") => {
                Object.entries(Object.getOwnPropertyDescriptors(n)).forEach((([i, {value: o, enumerable: a}]) => {
                    if (!1 === a || void 0 === o) return;
                    let s = "" === r ? i : `${r}.${i}`;
                    var l;
                    "object" == typeof o && null !== o && o._x_interceptor ? n[i] = o.initialize(e, s, i) : "object" != typeof (l = o) || Array.isArray(l) || null === l || o === n || o instanceof Element || t(o, s)
                }))
            };
            return t(e)
        }

        function q(e, t = (() => {
        })) {
            let n = {
                initialValue: void 0, _x_interceptor: !0, initialize(t, n, r) {
                    return e(this.initialValue, (() => function (e, t) {
                        return t.split(".").reduce(((e, t) => e[t]), e)
                    }(t, n)), (e => F(t, n, e)), n, r)
                }
            };
            return t(n), e => {
                if ("object" == typeof e && null !== e && e._x_interceptor) {
                    let t = n.initialize.bind(n);
                    n.initialize = (r, i, o) => {
                        let a = e.initialize(r, i, o);
                        return n.initialValue = a, t(r, i, o)
                    }
                } else n.initialValue = e;
                return n
            }
        }

        function F(e, t, n) {
            if ("string" == typeof t && (t = t.split(".")), 1 !== t.length) {
                if (0 === t.length) throw error;
                return e[t[0]] || (e[t[0]] = {}), F(e[t[0]], t.slice(1), n)
            }
            e[t[0]] = n
        }

        var U = {};

        function V(e, t) {
            U[e] = t
        }

        function W(e, t) {
            return Object.entries(U).forEach((([n, r]) => {
                Object.defineProperty(e, `$${n}`, {get: () => r(t, {Alpine: Ye, interceptor: q}), enumerable: !1})
            })), e
        }

        function G(e, t, n, ...r) {
            try {
                return n(...r)
            } catch (n) {
                K(n, e, t)
            }
        }

        function K(e, t, n) {
            Object.assign(e, {
                el: t,
                expression: n
            })
        }

        function X(e, t, n = {}) {
            let r;
            return Z(e, t)((e => r = e), n), r
        }

        function Z(...e) {
            return Y(...e)
        }

        var Y = J;

        function J(e, t) {
            let n = {};
            W(n, e);
            let r = [n, ...D(e)];
            if ("function" == typeof t) return function (e, t) {
                return (n = (() => {
                }), {scope: r = {}, params: i = []} = {}) => {
                    ee(n, t.apply(H([r, ...e]), i))
                }
            }(r, t);
            let i = function (e, t, n) {
                let r = function (e, t) {
                    if (Q[e]) return Q[e];
                    let n = Object.getPrototypeOf((async function () {
                        })).constructor,
                        r = /^[\n\s]*if.*\(.*\)/.test(e) || /^(let|const)\s/.test(e) ? `(() => { ${e} })()` : e;
                    let i = (() => {
                        try {
                            return new n(["__self", "scope"], `with (scope) { __self.result = ${r} }; __self.finished = true; return __self.result;`)
                        } catch (n) {
                            return K(n, t, e), Promise.resolve()
                        }
                    })();
                    return Q[e] = i, i
                }(t, n);
                return (i = (() => {
                }), {scope: o = {}, params: a = []} = {}) => {
                    r.result = void 0, r.finished = !1;
                    let s = H([o, ...e]);
                    if ("function" == typeof r) {
                        let e = r(r, s).catch((e => K(e, n, t)));
                        r.finished ? (ee(i, r.result, s, a, n), r.result = void 0) : e.then((e => {
                            ee(i, e, s, a, n)
                        })).catch((e => K(e, n, t))).finally((() => r.result = void 0))
                    }
                }
            }(r, t, e);
            return G.bind(null, e, t, i)
        }

        var Q = {};

        function ee(e, t, n, r, i) {
            if ("function" == typeof t) {
                let o = t.apply(n, r);
                o instanceof Promise ? o.then((t => ee(e, t, n, r))).catch((e => K(e, i, t))) : e(o)
            } else e(t)
        }

        var te = "x-";

        function ne(e = "") {
            return te + e
        }

        var re = {};

        function ie(e, t) {
            re[e] = t
        }

        function oe(e, n, i) {
            let o = {}, a = Array.from(n).map(ue(((e, t) => o[e] = t))).filter(he).map(function (e, t) {
                return ({name: n, value: r}) => {
                    let i = n.match(fe()), o = n.match(/:([a-zA-Z0-9\-:]+)/),
                        a = n.match(/\.[^.\]]+(?=[^\]]*$)/g) || [], s = t || e[n] || n;
                    return {
                        type: i ? i[1] : null,
                        value: o ? o[1] : null,
                        modifiers: a.map((e => e.replace(".", ""))),
                        expression: r,
                        original: s
                    }
                }
            }(o, i)).sort(ve);
            return a.map((n => function (e, n) {
                let i = () => {
                }, o = re[n.type] || i, a = [], s = e => a.push(e), [l, c] = function (e) {
                    let n = () => {
                    };
                    return [i => {
                        let o = t(i);
                        e._x_effects || (e._x_effects = new Set, e._x_runEffects = () => {
                            e._x_effects.forEach((e => e()))
                        }), e._x_effects.add(o), n = () => {
                            void 0 !== o && (e._x_effects.delete(o), r(o))
                        }
                    }, () => {
                        n()
                    }]
                }(e);
                a.push(c);
                let u = {Alpine: Ye, effect: l, cleanup: s, evaluateLater: Z.bind(Z, e), evaluate: X.bind(X, e)},
                    d = () => a.forEach((e => e()));
                !function (e, t, n) {
                    e._x_attributeCleanups || (e._x_attributeCleanups = {}), e._x_attributeCleanups[t] || (e._x_attributeCleanups[t] = []), e._x_attributeCleanups[t].push(n)
                }(e, n.original, d);
                let p = () => {
                    e._x_ignore || e._x_ignoreSelf || (o.inline && o.inline(e, n, u), o = o.bind(o, e, n, u), ae ? se.get(le).push(o) : o())
                };
                return p.runCleanups = d, p
            }(e, n)))
        }

        var ae = !1, se = new Map, le = Symbol();
        var ce = (e, t) => ({name: n, value: r}) => (n.startsWith(e) && (n = n.replace(e, t)), {name: n, value: r});

        function ue(e = (() => {
        })) {
            return ({name: t, value: n}) => {
                let {name: r, value: i} = de.reduce(((e, t) => t(e)), {name: t, value: n});
                return r !== t && e(r, t), {name: r, value: i}
            }
        }

        var de = [];

        function pe(e) {
            de.push(e)
        }

        function he({name: e}) {
            return fe().test(e)
        }

        var fe = () => new RegExp(`^${te}([^:^.]+)\\b`);
        var ge = "DEFAULT",
            me = ["ignore", "ref", "data", "id", "bind", "init", "for", "model", "transition", "show", "if", ge, "teleport", "element"];

        function ve(e, t) {
            let n = -1 === me.indexOf(e.type) ? ge : e.type, r = -1 === me.indexOf(t.type) ? ge : t.type;
            return me.indexOf(n) - me.indexOf(r)
        }

        function be(e, t, n = {}) {
            e.dispatchEvent(new CustomEvent(t, {detail: n, bubbles: !0, composed: !0, cancelable: !0}))
        }

        var we = [], ye = !1;

        function _e(e) {
            we.push(e), queueMicrotask((() => {
                ye || setTimeout((() => {
                    ke()
                }))
            }))
        }

        function ke() {
            for (ye = !1; we.length;) we.shift()()
        }

        function xe(e, t) {
            if ("function" == typeof ShadowRoot && e instanceof ShadowRoot) return void Array.from(e.children).forEach((e => xe(e, t)));
            let n = !1;
            if (t(e, (() => n = !0)), n) return;
            let r = e.firstElementChild;
            for (; r;) xe(r, t), r = r.nextElementSibling
        }

        function Se(e, ...t) {
            console.warn(`Alpine Warning: ${e}`, ...t)
        }

        var Ce = [], Ee = [];

        function Te() {
            return Ce.map((e => e()))
        }

        function Ae() {
            return Ce.concat(Ee).map((e => e()))
        }

        function Oe(e) {
            Ce.push(e)
        }

        function Pe(e) {
            Ee.push(e)
        }

        function Me(e, t = !1) {
            return Le(e, (e => {
                if ((t ? Ae() : Te()).some((t => e.matches(t)))) return !0
            }))
        }

        function Le(e, t) {
            if (e) {
                if (t(e)) return e;
                if (e._x_teleportBack && (e = e._x_teleportBack), e.parentElement) return Le(e.parentElement, t)
            }
        }

        function je(e, t = xe) {
            !function (e) {
                ae = !0;
                let t = Symbol();
                le = t, se.set(t, []);
                let n = () => {
                    for (; se.get(t).length;) se.get(t).shift()();
                    se.delete(t)
                };
                e(n), ae = !1, n()
            }((() => {
                t(e, ((e, t) => {
                    oe(e, e.attributes).forEach((e => e())), e._x_ignore && t()
                }))
            }))
        }

        function Ne(e, t) {
            return Array.isArray(t) ? Ie(e, t.join(" ")) : "object" == typeof t && null !== t ? function (e, t) {
                let n = e => e.split(" ").filter(Boolean),
                    r = Object.entries(t).flatMap((([e, t]) => !!t && n(e))).filter(Boolean),
                    i = Object.entries(t).flatMap((([e, t]) => !t && n(e))).filter(Boolean), o = [], a = [];
                return i.forEach((t => {
                    e.classList.contains(t) && (e.classList.remove(t), a.push(t))
                })), r.forEach((t => {
                    e.classList.contains(t) || (e.classList.add(t), o.push(t))
                })), () => {
                    a.forEach((t => e.classList.add(t))), o.forEach((t => e.classList.remove(t)))
                }
            }(e, t) : "function" == typeof t ? Ne(e, t()) : Ie(e, t)
        }

        function Ie(e, t) {
            return t = !0 === t ? t = "" : t || "", n = t.split(" ").filter((t => !e.classList.contains(t))).filter(Boolean), e.classList.add(...n), () => {
                e.classList.remove(...n)
            };
            var n
        }

        function ze(e, t) {
            return "object" == typeof t && null !== t ? function (e, t) {
                let n = {};
                return Object.entries(t).forEach((([t, r]) => {
                    n[t] = e.style[t], e.style.setProperty(t.replace(/([a-z])([A-Z])/g, "$1-$2").toLowerCase(), r)
                })), setTimeout((() => {
                    0 === e.style.length && e.removeAttribute("style")
                })), () => {
                    ze(e, n)
                }
            }(e, t) : function (e, t) {
                let n = e.getAttribute("style", t);
                return e.setAttribute("style", t), () => {
                    e.setAttribute("style", n || "")
                }
            }(e, t)
        }

        function Re(e, t = (() => {
        })) {
            let n = !1;
            return function () {
                n ? t.apply(this, arguments) : (n = !0, e.apply(this, arguments))
            }
        }

        function Be(e, t, n = {}) {
            e._x_transition || (e._x_transition = {
                enter: {during: n, start: n, end: n},
                leave: {during: n, start: n, end: n},
                in(n = (() => {
                }), r = (() => {
                })) {
                    He(e, t, {during: this.enter.during, start: this.enter.start, end: this.enter.end}, n, r)
                },
                out(n = (() => {
                }), r = (() => {
                })) {
                    He(e, t, {during: this.leave.during, start: this.leave.start, end: this.leave.end}, n, r)
                }
            })
        }

        function De(e) {
            let t = e.parentNode;
            if (t) return t._x_hidePromise ? t : De(t)
        }

        function He(e, t, {during: n, start: r, end: i} = {}, o = (() => {
        }), a = (() => {
        })) {
            if (e._x_transitioning && e._x_transitioning.cancel(), 0 === Object.keys(n).length && 0 === Object.keys(r).length && 0 === Object.keys(i).length) return o(), void a();
            let s, l, c;
            !function (e, t) {
                let n, r, i, o = Re((() => {
                    j((() => {
                        n = !0, r || t.before(), i || (t.end(), ke()), t.after(), e.isConnected && t.cleanup(), delete e._x_transitioning
                    }))
                }));
                e._x_transitioning = {
                    beforeCancels: [], beforeCancel(e) {
                        this.beforeCancels.push(e)
                    }, cancel: Re((function () {
                        for (; this.beforeCancels.length;) this.beforeCancels.shift()();
                        o()
                    })), finish: o
                }, j((() => {
                    t.start(), t.during()
                })), ye = !0, requestAnimationFrame((() => {
                    if (n) return;
                    let o = 1e3 * Number(getComputedStyle(e).transitionDuration.replace(/,.*/, "").replace("s", "")),
                        a = 1e3 * Number(getComputedStyle(e).transitionDelay.replace(/,.*/, "").replace("s", ""));
                    0 === o && (o = 1e3 * Number(getComputedStyle(e).animationDuration.replace("s", ""))), j((() => {
                        t.before()
                    })), r = !0, requestAnimationFrame((() => {
                        n || (j((() => {
                            t.end()
                        })), ke(), setTimeout(e._x_transitioning.finish, o + a), i = !0)
                    }))
                }))
            }(e, {
                start() {
                    s = t(e, r)
                }, during() {
                    l = t(e, n)
                }, before: o, end() {
                    s(), c = t(e, i)
                }, after: a, cleanup() {
                    l(), c()
                }
            })
        }

        function $e(e, t, n) {
            if (-1 === e.indexOf(t)) return n;
            const r = e[e.indexOf(t) + 1];
            if (!r) return n;
            if ("scale" === t && isNaN(r)) return n;
            if ("duration" === t) {
                let e = r.match(/([0-9]+)ms/);
                if (e) return e[1]
            }
            return "origin" === t && ["top", "right", "left", "center", "bottom"].includes(e[e.indexOf(t) + 2]) ? [r, e[e.indexOf(t) + 2]].join(" ") : r
        }

        ie("transition", ((e, {value: t, modifiers: n, expression: r}, {evaluate: i}) => {
            "function" == typeof r && (r = i(r)), r ? function (e, t, n) {
                Be(e, Ne, ""), {
                    enter: t => {
                        e._x_transition.enter.during = t
                    }, "enter-start": t => {
                        e._x_transition.enter.start = t
                    }, "enter-end": t => {
                        e._x_transition.enter.end = t
                    }, leave: t => {
                        e._x_transition.leave.during = t
                    }, "leave-start": t => {
                        e._x_transition.leave.start = t
                    }, "leave-end": t => {
                        e._x_transition.leave.end = t
                    }
                }[n](t)
            }(e, r, t) : function (e, t, n) {
                Be(e, ze);
                let r = !t.includes("in") && !t.includes("out") && !n,
                    i = r || t.includes("in") || ["enter"].includes(n),
                    o = r || t.includes("out") || ["leave"].includes(n);
                t.includes("in") && !r && (t = t.filter(((e, n) => n < t.indexOf("out"))));
                t.includes("out") && !r && (t = t.filter(((e, n) => n > t.indexOf("out"))));
                let a = !t.includes("opacity") && !t.includes("scale"), s = a || t.includes("opacity"),
                    l = a || t.includes("scale"), c = s ? 0 : 1, u = l ? $e(t, "scale", 95) / 100 : 1,
                    d = $e(t, "delay", 0), p = $e(t, "origin", "center"), h = "opacity, transform",
                    f = $e(t, "duration", 150) / 1e3, g = $e(t, "duration", 75) / 1e3,
                    m = "cubic-bezier(0.4, 0.0, 0.2, 1)";
                i && (e._x_transition.enter.during = {
                    transformOrigin: p,
                    transitionDelay: d,
                    transitionProperty: h,
                    transitionDuration: `${f}s`,
                    transitionTimingFunction: m
                }, e._x_transition.enter.start = {
                    opacity: c,
                    transform: `scale(${u})`
                }, e._x_transition.enter.end = {opacity: 1, transform: "scale(1)"});
                o && (e._x_transition.leave.during = {
                    transformOrigin: p,
                    transitionDelay: d,
                    transitionProperty: h,
                    transitionDuration: `${g}s`,
                    transitionTimingFunction: m
                }, e._x_transition.leave.start = {
                    opacity: 1,
                    transform: "scale(1)"
                }, e._x_transition.leave.end = {opacity: c, transform: `scale(${u})`})
            }(e, n, t)
        })), window.Element.prototype._x_toggleAndCascadeWithTransitions = function (e, t, n, r) {
            let i = () => {
                "visible" === document.visibilityState ? requestAnimationFrame(n) : setTimeout(n)
            };
            t ? e._x_transition && (e._x_transition.enter || e._x_transition.leave) ? e._x_transition.enter && (Object.entries(e._x_transition.enter.during).length || Object.entries(e._x_transition.enter.start).length || Object.entries(e._x_transition.enter.end).length) ? e._x_transition.in(n) : i() : e._x_transition ? e._x_transition.in(n) : i() : (e._x_hidePromise = e._x_transition ? new Promise(((t, n) => {
                e._x_transition.out((() => {
                }), (() => t(r))), e._x_transitioning.beforeCancel((() => n({isFromCancelledTransition: !0})))
            })) : Promise.resolve(r), queueMicrotask((() => {
                let t = De(e);
                t ? (t._x_hideChildren || (t._x_hideChildren = []), t._x_hideChildren.push(e)) : queueMicrotask((() => {
                    let t = e => {
                        let n = Promise.all([e._x_hidePromise, ...(e._x_hideChildren || []).map(t)]).then((([e]) => e()));
                        return delete e._x_hidePromise, delete e._x_hideChildren, n
                    };
                    t(e).catch((e => {
                        if (!e.isFromCancelledTransition) throw e
                    }))
                }))
            })))
        };
        var qe = !1;

        function Fe(e, t = (() => {
        })) {
            return (...n) => qe ? t(...n) : e(...n)
        }

        function Ue(e, t) {
            var n;
            return function () {
                var r = this, i = arguments, o = function () {
                    n = null, e.apply(r, i)
                };
                clearTimeout(n), n = setTimeout(o, t)
            }
        }

        function Ve(e, t) {
            let n;
            return function () {
                let r = this, i = arguments;
                n || (e.apply(r, i), n = !0, setTimeout((() => n = !1), t))
            }
        }

        var We = {}, Ge = !1;
        var Ke = {};
        var Xe, Ze, Ye = {
            get reactive() {
                return e
            },
            get release() {
                return r
            },
            get effect() {
                return t
            },
            get raw() {
                return i
            },
            version: "3.7.1",
            flushAndStopDeferringMutations: function () {
                N = !1, z(I), I = []
            },
            disableEffectScheduling: function (e) {
                _ = !1, e(), _ = !0
            },
            setReactivityEngine: function (n) {
                e = n.reactive, r = n.release, t = e => n.effect(e, {
                    scheduler: e => {
                        _ ? w(e) : e()
                    }
                }), i = n.raw
            },
            closestDataStack: D,
            skipDuringClone: Fe,
            addRootSelector: Oe,
            addInitSelector: Pe,
            addScopeToNode: R,
            deferMutations: function () {
                N = !0
            },
            mapAttributes: pe,
            evaluateLater: Z,
            setEvaluator: function (e) {
                Y = e
            },
            mergeProxies: H,
            closestRoot: Me,
            interceptor: q,
            transition: He,
            setStyles: ze,
            mutateDom: j,
            directive: ie,
            throttle: Ve,
            debounce: Ue,
            evaluate: X,
            initTree: je,
            nextTick: _e,
            prefixed: ne,
            prefix: function (e) {
                te = e
            },
            plugin: function (e) {
                e(Ye)
            },
            magic: V,
            store: function (t, n) {
                if (Ge || (We = e(We), Ge = !0), void 0 === n) return We[t];
                We[t] = n, "object" == typeof n && null !== n && n.hasOwnProperty("init") && "function" == typeof n.init && We[t].init(), $(We[t])
            },
            start: function () {
                var e;
                document.body || Se("Unable to initialize. Trying to load Alpine before `<body>` is available. Did you forget to add `defer` in Alpine's `<script>` tag?"), be(document, "alpine:init"), be(document, "alpine:initializing"), O(), e = e => je(e, xe), C.push(e), function (e) {
                    S.push(e)
                }((e => {
                    xe(e, (e => E(e)))
                })), function (e) {
                    x.push(e)
                }(((e, t) => {
                    oe(e, t).forEach((e => e()))
                })), Array.from(document.querySelectorAll(Ae())).filter((e => !Me(e.parentElement, !0))).forEach((e => {
                    je(e)
                })), be(document, "alpine:initialized")
            },
            clone: function (e, n) {
                n._x_dataStack || (n._x_dataStack = e._x_dataStack), qe = !0, function (e) {
                    let n = t;
                    k(((e, t) => {
                        let i = n(e);
                        return r(i), () => {
                        }
                    })), e(), k(n)
                }((() => {
                    !function (e) {
                        let t = !1;
                        je(e, ((e, n) => {
                            xe(e, ((e, r) => {
                                if (t && function (e) {
                                    return Te().some((t => e.matches(t)))
                                }(e)) return r();
                                t = !0, n(e, r)
                            }))
                        }))
                    }(n)
                })), qe = !1
            },
            data: function (e, t) {
                Ke[e] = t
            }
        }, Je = (Xe = g(), ((e, t, n) => {
            if (t && "object" == typeof t || "function" == typeof t) for (let r of c(t)) l.call(e, r) || "default" === r || a(e, r, {
                get: () => t[r],
                enumerable: !(n = u(t, r)) || n.enumerable
            });
            return e
        })((Ze = a(null != Xe ? o(s(Xe)) : {}, "default", Xe && Xe.__esModule && "default" in Xe ? {
            get: () => Xe.default,
            enumerable: !0
        } : {value: Xe, enumerable: !0}), a(Ze, "__esModule", {value: !0})), Xe));
        V("nextTick", (() => _e)), V("dispatch", (e => be.bind(be, e))), V("watch", (e => (n, r) => {
            let i, o = Z(e, n), a = !0;
            t((() => o((e => {
                JSON.stringify(e), a ? i = e : queueMicrotask((() => {
                    r(e, i), i = e
                })), a = !1
            }))))
        })), V("store", (function () {
            return We
        })), V("data", (e => H(D(e)))), V("root", (e => Me(e))), V("refs", (e => (e._x_refs_proxy || (e._x_refs_proxy = H(function (e) {
            let t = [], n = e;
            for (; n;) n._x_refs && t.push(n._x_refs), n = n.parentNode;
            return t
        }(e))), e._x_refs_proxy)));
        var Qe = {};

        function et(e) {
            return Qe[e] || (Qe[e] = 0), ++Qe[e]
        }

        V("id", (e => (t, n = null) => {
            let r = function (e, t) {
                return Le(e, (e => {
                    if (e._x_ids && e._x_ids[t]) return !0
                }))
            }(e, t), i = r ? r._x_ids[t] : et(t);
            return new tt(n ? `${t}-${i}-${n}` : `${t}-${i}`)
        }));
        var tt = class {
            constructor(e) {
                this.id = e
            }

            toString() {
                return this.id
            }
        };
        V("el", (e => e)), ie("teleport", ((e, {expression: t}, {cleanup: n}) => {
            "template" !== e.tagName.toLowerCase() && Se("x-teleport can only be used on a <template> tag", e);
            let r = document.querySelector(t);
            r || Se(`Cannot find x-teleport element for selector: "${t}"`);
            let i = e.content.cloneNode(!0).firstElementChild;
            e._x_teleport = i, i._x_teleportBack = e, e._x_forwardEvents && e._x_forwardEvents.forEach((t => {
                i.addEventListener(t, (t => {
                    t.stopPropagation(), e.dispatchEvent(new t.constructor(t.type, t))
                }))
            })), R(i, {}, e), j((() => {
                r.appendChild(i), je(i), i._x_ignore = !0
            })), n((() => i.remove()))
        }));
        var nt = () => {
        };

        function rt(t, n, r, i = []) {
            switch (t._x_bindings || (t._x_bindings = e({})), t._x_bindings[n] = r, n = i.includes("camel") ? n.toLowerCase().replace(/-(\w)/g, ((e, t) => t.toUpperCase())) : n) {
                case"value":
                    !function (e, t) {
                        if ("radio" === e.type) void 0 === e.attributes.value && (e.value = t), window.fromModel && (e.checked = it(e.value, t)); else if ("checkbox" === e.type) Number.isInteger(t) ? e.value = t : Number.isInteger(t) || Array.isArray(t) || "boolean" == typeof t || [null, void 0].includes(t) ? Array.isArray(t) ? e.checked = t.some((t => it(t, e.value))) : e.checked = !!t : e.value = String(t); else if ("SELECT" === e.tagName) !function (e, t) {
                            const n = [].concat(t).map((e => e + ""));
                            Array.from(e.options).forEach((e => {
                                e.selected = n.includes(e.value)
                            }))
                        }(e, t); else {
                            if (e.value === t) return;
                            e.value = t
                        }
                    }(t, r);
                    break;
                case"style":
                    !function (e, t) {
                        e._x_undoAddedStyles && e._x_undoAddedStyles();
                        e._x_undoAddedStyles = ze(e, t)
                    }(t, r);
                    break;
                case"class":
                    !function (e, t) {
                        e._x_undoAddedClasses && e._x_undoAddedClasses();
                        e._x_undoAddedClasses = Ne(e, t)
                    }(t, r);
                    break;
                default:
                    !function (e, t, n) {
                        [null, void 0, !1].includes(n) && function (e) {
                            return !["aria-pressed", "aria-checked", "aria-expanded"].includes(e)
                        }(t) ? e.removeAttribute(t) : (["disabled", "checked", "required", "readonly", "hidden", "open", "selected", "autofocus", "itemscope", "multiple", "novalidate", "allowfullscreen", "allowpaymentrequest", "formnovalidate", "autoplay", "controls", "loop", "muted", "playsinline", "default", "ismap", "reversed", "async", "defer", "nomodule"].includes(t) && (n = t), function (e, t, n) {
                            e.getAttribute(t) != n && e.setAttribute(t, n)
                        }(e, t, n))
                    }(t, n, r)
            }
        }

        function it(e, t) {
            return e == t
        }

        function ot(e, t, n, r) {
            let i = e, o = e => r(e), a = {}, s = (e, t) => n => t(e, n);
            if (n.includes("dot") && (t = t.replace(/-/g, ".")), n.includes("camel") && (t = function (e) {
                return e.toLowerCase().replace(/-(\w)/g, ((e, t) => t.toUpperCase()))
            }(t)), n.includes("passive") && (a.passive = !0), n.includes("capture") && (a.capture = !0), n.includes("window") && (i = window), n.includes("document") && (i = document), n.includes("prevent") && (o = s(o, ((e, t) => {
                t.preventDefault(), e(t)
            }))), n.includes("stop") && (o = s(o, ((e, t) => {
                t.stopPropagation(), e(t)
            }))), n.includes("self") && (o = s(o, ((t, n) => {
                n.target === e && t(n)
            }))), (n.includes("away") || n.includes("outside")) && (i = document, o = s(o, ((t, n) => {
                e.contains(n.target) || e.offsetWidth < 1 && e.offsetHeight < 1 || !1 !== e._x_isShown && t(n)
            }))), o = s(o, ((e, r) => {
                (function (e) {
                    return ["keydown", "keyup"].includes(e)
                })(t) && function (e, t) {
                    let n = t.filter((e => !["window", "document", "prevent", "stop", "once"].includes(e)));
                    if (n.includes("debounce")) {
                        let e = n.indexOf("debounce");
                        n.splice(e, at((n[e + 1] || "invalid-wait").split("ms")[0]) ? 2 : 1)
                    }
                    if (0 === n.length) return !1;
                    if (1 === n.length && st(e.key).includes(n[0])) return !1;
                    const r = ["ctrl", "shift", "alt", "meta", "cmd", "super"].filter((e => n.includes(e)));
                    if (n = n.filter((e => !r.includes(e))), r.length > 0) {
                        if (r.filter((t => ("cmd" !== t && "super" !== t || (t = "meta"), e[`${t}Key`]))).length === r.length && st(e.key).includes(n[0])) return !1
                    }
                    return !0
                }(r, n) || e(r)
            })), n.includes("debounce")) {
                let e = n[n.indexOf("debounce") + 1] || "invalid-wait",
                    t = at(e.split("ms")[0]) ? Number(e.split("ms")[0]) : 250;
                o = Ue(o, t)
            }
            if (n.includes("throttle")) {
                let e = n[n.indexOf("throttle") + 1] || "invalid-wait",
                    t = at(e.split("ms")[0]) ? Number(e.split("ms")[0]) : 250;
                o = Ve(o, t)
            }
            return n.includes("once") && (o = s(o, ((e, n) => {
                e(n), i.removeEventListener(t, o, a)
            }))), i.addEventListener(t, o, a), () => {
                i.removeEventListener(t, o, a)
            }
        }

        function at(e) {
            return !Array.isArray(e) && !isNaN(e)
        }

        function st(e) {
            if (!e) return [];
            e = e.replace(/([a-z])([A-Z])/g, "$1-$2").replace(/[_\s]/, "-").toLowerCase();
            let t = {
                ctrl: "control",
                slash: "/",
                space: "-",
                spacebar: "-",
                cmd: "meta",
                esc: "escape",
                up: "arrow-up",
                down: "arrow-down",
                left: "arrow-left",
                right: "arrow-right",
                period: ".",
                equal: "="
            };
            return t[e] = e, Object.keys(t).map((n => {
                if (t[n] === e) return n
            })).filter((e => e))
        }

        function lt(e) {
            let t = e ? parseFloat(e) : null;
            return n = t, Array.isArray(n) || isNaN(n) ? e : t;
            var n
        }

        function ct(e, t, n, r) {
            let i = {};
            if (/^\[.*\]$/.test(e.item) && Array.isArray(t)) {
                e.item.replace("[", "").replace("]", "").split(",").map((e => e.trim())).forEach(((e, n) => {
                    i[e] = t[n]
                }))
            } else if (/^\{.*\}$/.test(e.item) && !Array.isArray(t) && "object" == typeof t) {
                e.item.replace("{", "").replace("}", "").split(",").map((e => e.trim())).forEach((e => {
                    i[e] = t[e]
                }))
            } else i[e.item] = t;
            return e.index && (i[e.index] = n), e.collection && (i[e.collection] = r), i
        }

        function ut() {
        }

        nt.inline = (e, {modifiers: t}, {cleanup: n}) => {
            t.includes("self") ? e._x_ignoreSelf = !0 : e._x_ignore = !0, n((() => {
                t.includes("self") ? delete e._x_ignoreSelf : delete e._x_ignore
            }))
        }, ie("ignore", nt), ie("effect", ((e, {expression: t}, {effect: n}) => n(Z(e, t)))), ie("model", ((e, {
            modifiers: t,
            expression: n
        }, {effect: r, cleanup: i}) => {
            let o = Z(e, n), a = Z(e, `${n} = rightSideOfExpression($event, ${n})`);
            var s = "select" === e.tagName.toLowerCase() || ["checkbox", "radio"].includes(e.type) || t.includes("lazy") ? "change" : "input";
            let l = function (e, t, n) {
                "radio" === e.type && j((() => {
                    e.hasAttribute("name") || e.setAttribute("name", n)
                }));
                return (n, r) => j((() => {
                    if (n instanceof CustomEvent && void 0 !== n.detail) return n.detail || n.target.value;
                    if ("checkbox" === e.type) {
                        if (Array.isArray(r)) {
                            let e = t.includes("number") ? lt(n.target.value) : n.target.value;
                            return n.target.checked ? r.concat([e]) : r.filter((t => !(t == e)))
                        }
                        return n.target.checked
                    }
                    if ("select" === e.tagName.toLowerCase() && e.multiple) return t.includes("number") ? Array.from(n.target.selectedOptions).map((e => lt(e.value || e.text))) : Array.from(n.target.selectedOptions).map((e => e.value || e.text));
                    {
                        let e = n.target.value;
                        return t.includes("number") ? lt(e) : t.includes("trim") ? e.trim() : e
                    }
                }))
            }(e, t, n), c = ot(e, s, t, (e => {
                a((() => {
                }), {scope: {$event: e, rightSideOfExpression: l}})
            }));
            i((() => c()));
            let u = Z(e, `${n} = __placeholder`);
            e._x_model = {
                get() {
                    let e;
                    return o((t => e = t)), e
                }, set(e) {
                    u((() => {
                    }), {scope: {__placeholder: e}})
                }
            }, e._x_forceModelUpdate = () => {
                o((t => {
                    void 0 === t && n.match(/\./) && (t = ""), window.fromModel = !0, j((() => rt(e, "value", t))), delete window.fromModel
                }))
            }, r((() => {
                t.includes("unintrusive") && document.activeElement.isSameNode(e) || e._x_forceModelUpdate()
            }))
        })), ie("cloak", (e => queueMicrotask((() => j((() => e.removeAttribute(ne("cloak")))))))), Pe((() => `[${ne("init")}]`)), ie("init", Fe(((e, {expression: t}) => "string" == typeof t ? !!t.trim() && X(e, t, {}) : X(e, t, {})))), ie("text", ((e, {expression: t}, {
            effect: n,
            evaluateLater: r
        }) => {
            let i = r(t);
            n((() => {
                i((t => {
                    j((() => {
                        e.textContent = t
                    }))
                }))
            }))
        })), ie("html", ((e, {expression: t}, {effect: n, evaluateLater: r}) => {
            let i = r(t);
            n((() => {
                i((t => {
                    e.innerHTML = t
                }))
            }))
        })), pe(ce(":", ne("bind:"))), ie("bind", ((e, {
            value: t,
            modifiers: n,
            expression: r,
            original: i
        }, {effect: o}) => {
            if (!t) return function (e, t, n, r) {
                let i = Z(e, t), o = [];
                r((() => {
                    for (; o.length;) o.pop()();
                    i((t => {
                        let r = Object.entries(t).map((([e, t]) => ({name: e, value: t}))), i = function (e) {
                            return Array.from(e).map(ue()).filter((e => !he(e)))
                        }(r);
                        r = r.map((e => i.find((t => t.name === e.name)) ? {
                            name: `x-bind:${e.name}`,
                            value: `"${e.value}"`
                        } : e)), oe(e, r, n).map((e => {
                            o.push(e.runCleanups), e()
                        }))
                    }))
                }))
            }(e, r, i, o);
            if ("key" === t) return function (e, t) {
                e._x_keyExpression = t
            }(e, r);
            let a = Z(e, r);
            o((() => a((i => {
                void 0 === i && r.match(/\./) && (i = ""), j((() => rt(e, t, i, n)))
            }))))
        })), Oe((() => `[${ne("data")}]`)), ie("data", Fe(((t, {expression: n}, {cleanup: r}) => {
            n = "" === n ? "{}" : n;
            let i = {};
            W(i, t);
            let o = {};
            var a, s;
            a = o, s = i, Object.entries(Ke).forEach((([e, t]) => {
                Object.defineProperty(a, e, {get: () => (...e) => t.bind(s)(...e), enumerable: !1})
            }));
            let l = X(t, n, {scope: o});
            void 0 === l && (l = {}), W(l, t);
            let c = e(l);
            $(c);
            let u = R(t, c);
            c.init && X(t, c.init), r((() => {
                u(), c.destroy && X(t, c.destroy)
            }))
        }))), ie("show", ((e, {modifiers: t, expression: n}, {effect: r}) => {
            let i, o = Z(e, n), a = () => j((() => {
                e.style.display = "none", e._x_isShown = !1
            })), s = () => j((() => {
                1 === e.style.length && "none" === e.style.display ? e.removeAttribute("style") : e.style.removeProperty("display"), e._x_isShown = !0
            })), l = () => setTimeout(s), c = Re((e => e ? s() : a()), (t => {
                "function" == typeof e._x_toggleAndCascadeWithTransitions ? e._x_toggleAndCascadeWithTransitions(e, t, s, a) : t ? l() : a()
            })), u = !0;
            r((() => o((e => {
                (u || e !== i) && (t.includes("immediate") && (e ? l() : a()), c(e), i = e, u = !1)
            }))))
        })), ie("for", ((t, {expression: n}, {effect: r, cleanup: i}) => {
            let o = function (e) {
                let t = /,([^,\}\]]*)(?:,([^,\}\]]*))?$/, n = /^\s*\(|\)\s*$/g,
                    r = /([\s\S]*?)\s+(?:in|of)\s+([\s\S]*)/, i = e.match(r);
                if (!i) return;
                let o = {};
                o.items = i[2].trim();
                let a = i[1].replace(n, "").trim(), s = a.match(t);
                s ? (o.item = a.replace(t, "").trim(), o.index = s[1].trim(), s[2] && (o.collection = s[2].trim())) : o.item = a;
                return o
            }(n), a = Z(t, o.items), s = Z(t, t._x_keyExpression || "index");
            t._x_prevKeys = [], t._x_lookup = {}, r((() => function (t, n, r, i) {
                let o = e => "object" == typeof e && !Array.isArray(e), a = t;
                r((r => {
                    var s;
                    s = r, !Array.isArray(s) && !isNaN(s) && r >= 0 && (r = Array.from(Array(r).keys(), (e => e + 1))), void 0 === r && (r = []);
                    let l = t._x_lookup, c = t._x_prevKeys, u = [], d = [];
                    if (o(r)) r = Object.entries(r).map((([e, t]) => {
                        let o = ct(n, t, e, r);
                        i((e => d.push(e)), {scope: {index: e, ...o}}), u.push(o)
                    })); else for (let e = 0; e < r.length; e++) {
                        let t = ct(n, r[e], e, r);
                        i((e => d.push(e)), {scope: {index: e, ...t}}), u.push(t)
                    }
                    let p = [], h = [], f = [], g = [];
                    for (let e = 0; e < c.length; e++) {
                        let t = c[e];
                        -1 === d.indexOf(t) && f.push(t)
                    }
                    c = c.filter((e => !f.includes(e)));
                    let m = "template";
                    for (let e = 0; e < d.length; e++) {
                        let t = d[e], n = c.indexOf(t);
                        if (-1 === n) c.splice(e, 0, t), p.push([m, e]); else if (n !== e) {
                            let t = c.splice(e, 1)[0], r = c.splice(n - 1, 1)[0];
                            c.splice(e, 0, r), c.splice(n, 0, t), h.push([t, r])
                        } else g.push(t);
                        m = t
                    }
                    for (let e = 0; e < f.length; e++) {
                        let t = f[e];
                        l[t].remove(), l[t] = null, delete l[t]
                    }
                    for (let e = 0; e < h.length; e++) {
                        let [t, n] = h[e], r = l[t], i = l[n], o = document.createElement("div");
                        j((() => {
                            i.after(o), r.after(i), i._x_currentIfEl && i.after(i._x_currentIfEl), o.before(r), r._x_currentIfEl && r.after(r._x_currentIfEl), o.remove()
                        })), B(i, u[d.indexOf(n)])
                    }
                    for (let t = 0; t < p.length; t++) {
                        let [n, r] = p[t], i = "template" === n ? a : l[n];
                        i._x_currentIfEl && (i = i._x_currentIfEl);
                        let o = u[r], s = d[r], c = document.importNode(a.content, !0).firstElementChild;
                        R(c, e(o), a), j((() => {
                            i.after(c), je(c)
                        })), "object" == typeof s && Se("x-for key cannot be an object, it must be a string or an integer", a), l[s] = c
                    }
                    for (let e = 0; e < g.length; e++) B(l[g[e]], u[d.indexOf(g[e])]);
                    a._x_prevKeys = d
                }))
            }(t, o, a, s))), i((() => {
                Object.values(t._x_lookup).forEach((e => e.remove())), delete t._x_prevKeys, delete t._x_lookup
            }))
        })), ut.inline = (e, {expression: t}, {cleanup: n}) => {
            let r = Me(e);
            r._x_refs || (r._x_refs = {}), r._x_refs[t] = e, n((() => delete r._x_refs[t]))
        }, ie("ref", ut), ie("if", ((e, {expression: t}, {effect: n, cleanup: r}) => {
            let i = Z(e, t);
            n((() => i((t => {
                t ? (() => {
                    if (e._x_currentIfEl) return e._x_currentIfEl;
                    let t = e.content.cloneNode(!0).firstElementChild;
                    R(t, {}, e), j((() => {
                        e.after(t), je(t)
                    })), e._x_currentIfEl = t, e._x_undoIf = () => {
                        t.remove(), delete e._x_currentIfEl
                    }
                })() : e._x_undoIf && (e._x_undoIf(), delete e._x_undoIf)
            })))), r((() => e._x_undoIf && e._x_undoIf()))
        })), ie("id", ((e, {expression: t}, {evaluate: n}) => {
            n(t).forEach((t => function (e, t) {
                e._x_ids || (e._x_ids = {}), e._x_ids[t] || (e._x_ids[t] = et(t))
            }(e, t)))
        })), pe(ce("@", ne("on:"))), ie("on", Fe(((e, {value: t, modifiers: n, expression: r}, {cleanup: i}) => {
            let o = r ? Z(e, r) : () => {
            };
            "template" === e.tagName.toLowerCase() && (e._x_forwardEvents || (e._x_forwardEvents = []), e._x_forwardEvents.includes(t) || e._x_forwardEvents.push(t));
            let a = ot(e, t, n, (e => {
                o((() => {
                }), {scope: {$event: e}, params: [e]})
            }));
            i((() => a()))
        }))), Ye.setEvaluator(J), Ye.setReactivityEngine({
            reactive: Je.reactive,
            effect: Je.effect,
            release: Je.stop,
            raw: Je.toRaw
        });
        var dt = Ye;
        var pt = function (e) {
            e.directive("collapse", ((t, {expression: n, modifiers: r}, {effect: i, evaluateLater: o}) => {
                let a = function (e, t, n) {
                    if (-1 === e.indexOf(t)) return n;
                    const r = e[e.indexOf(t) + 1];
                    if (!r) return n;
                    if ("duration" === t) {
                        let e = r.match(/([0-9]+)ms/);
                        if (e) return e[1]
                    }
                    return r
                }(r, "duration", 250) / 1e3;
                t._x_isShown || (t.style.height = "0px"), t._x_isShown || (t.hidden = !0), t._x_isShown || (t.style.overflow = "hidden");
                let s = (t, n) => {
                    let r = e.setStyles(t, n);
                    return n.height ? () => {
                    } : r
                }, l = {
                    transitionProperty: "height",
                    transitionDuration: `${a}s`,
                    transitionTimingFunction: "cubic-bezier(0.4, 0.0, 0.2, 1)"
                };
                t._x_transition = {
                    in(n = (() => {
                    }), r = (() => {
                    })) {
                        t.hidden = !1, t.style.display = null;
                        let i = t.getBoundingClientRect().height;
                        t.style.height = "auto";
                        let o = t.getBoundingClientRect().height;
                        i === o && (i = 0), e.transition(t, e.setStyles, {
                            during: l,
                            start: {height: i + "px"},
                            end: {height: o + "px"}
                        }, (() => t._x_isShown = !0), (() => {
                            t.style.height == `${o}px` && (t.style.overflow = null)
                        }))
                    }, out(n = (() => {
                    }), r = (() => {
                    })) {
                        let i = t.getBoundingClientRect().height;
                        e.transition(t, s, {
                            during: l,
                            start: {height: i + "px"},
                            end: {height: "0px"}
                        }, (() => t.style.overflow = "hidden"), (() => {
                            t._x_isShown = !1, "0px" == t.style.height && (t.style.display = "none", t.hidden = !0)
                        }))
                    }
                }
            }))
        };
        let ht = () => {
        };

        function ft(e) {
            e.magic("clipboard", (() => function (e) {
                return "function" == typeof e && (e = e()), "object" == typeof e && (e = JSON.stringify(e)), window.navigator.clipboard.writeText(e).then(ht)
            }))
        }

        ft.configure = e => (e.hasOwnProperty("onCopy") && "function" == typeof e.onCopy && (ht = e.onCopy), ft);
        const gt = ft;
        const mt = function () {
            return Alpine.data("countdownTimer", (function (e) {
                return {
                    duration: e, countdownDelay: 1, remainingTime: "به اتمام رسیده", init: function () {
                        var t = this;
                        e <= 0 || (this.remainingTime = this.computingTimer(this.duration), setInterval((function () {
                            t.remainingTime = t.computingTimer(t.duration), t.duration--
                        }), 1e3 * this.countdownDelay))
                    }, computingTimer: function (e) {
                        var t, n, r = (t = e, n = Math.floor(t), {
                            days: Math.floor(n / 86400),
                            hours: Math.floor(n % 86400 / 3600),
                            minutes: Math.floor(n % 3600 / 60),
                            seconds: n % 60
                        }), i = r.days, o = r.hours, a = r.minutes, s = r.seconds;
                        return i > 0 ? "".concat(i.toString().padStart(2, "0"), " روز و ").concat(o.toString().padStart(2, "0"), " ساعت") : o > 0 ? "".concat(o.toString().padStart(2, "0"), " ساعت و ").concat(a.toString().padStart(2, "0"), " دقیقه") : "".concat(a.toString().padStart(2, "0"), " دقیقه و ").concat(s.toString().padStart(2, "0"), " ثانیه")
                    }
                }
            }))
        };

        function vt(e) {
            if (e.includes("full")) return .99;
            if (e.includes("half")) return .5;
            if (!e.includes("threshold")) return 0;
            let t = e[e.indexOf("threshold") + 1];
            return "100" === t ? 1 : "0" === t ? 0 : Number(`.${t}`)
        }

        function bt(e) {
            let t = e.match(/^(-?[0-9]+)(px|%)?$/);
            return t ? t[1] + (t[2] || "px") : void 0
        }

        function wt(e) {
            const t = "0px 0px 0px 0px", n = e.indexOf("margin");
            if (-1 === n) return t;
            let r = [];
            for (let t = 1; t < 5; t++) r.push(bt(e[n + t] || ""));
            return r = r.filter((e => void 0 !== e)), r.length ? r.join(" ").trim() : t
        }

        var yt = function (e) {
            e.directive("intersect", ((e, {value: t, expression: n, modifiers: r}, {evaluateLater: i, cleanup: o}) => {
                let a = i(n), s = {rootMargin: wt(r), threshold: vt(r)}, l = new IntersectionObserver((e => {
                    e.forEach((e => {
                        e.isIntersecting !== ("leave" === t) && (a(), r.includes("once") && l.disconnect())
                    }))
                }), s);
                l.observe(e), o((() => {
                    l.disconnect()
                }))
            }))
        };
        n(1075);
        n(3787), n(708);
        n(9351);
        const _t = function () {
            window.Alpine = dt, dt.plugin(gt), dt.plugin(pt), dt.plugin(yt), mt()
        };
        var kt = n(54), xt = n.n(kt);
        const St = function () {
            xt().use([kt.Navigation, kt.Pagination, kt.EffectCards]), window.Swiper = xt()
        };
        n(219);
        var Ct = n(7059), Et = n.n(Ct)()();
        Et.observe(), Livewire.hook("message.processed", (function () {
            Et.observe()
        }));
        n(198), n(369);
        St(), _t();
        n(6271), n(1061), n(9373), n(7271), n(5370), n(1984);

        function Tt(e, t) {
            var n = Object.keys(e);
            if (Object.getOwnPropertySymbols) {
                var r = Object.getOwnPropertySymbols(e);
                t && (r = r.filter((function (t) {
                    return Object.getOwnPropertyDescriptor(e, t).enumerable
                }))), n.push.apply(n, r)
            }
            return n
        }

        function At(e) {
            for (var t = 1; t < arguments.length; t++) {
                var n = null != arguments[t] ? arguments[t] : {};
                t % 2 ? Tt(Object(n), !0).forEach((function (t) {
                    Ot(e, t, n[t])
                })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n)) : Tt(Object(n)).forEach((function (t) {
                    Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t))
                }))
            }
            return e
        }

        function Ot(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        const Pt = function () {
            Livewire.hook("message.processed", (function () {
                document.querySelectorAll("pre code").forEach((function (e) {
                    e && !e.classList.contains("hljs") && (window.hljs.highlightElement(e), window.hljs.lineNumbersBlock(e))
                }))
            })), Livewire.on("toast", (function (e, t) {
                var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
                switch (t) {
                    case"success":
                        successtoast.fire(At({title: e}, n));
                        break;
                    case"warning":
                        warningtoast.fire(At({title: e}, n));
                        break;
                    case"error":
                        errortoast.fire(At({title: e}, n))
                }
            }))
        };
        const Mt = {
            PersianToEnglish: function () {
                document.querySelectorAll("[num-en]").forEach((function (e) {
                    e.style.fontFamily = "tahoma", e.style.fontStyle = "normal"
                }))
            }, turnNumberToPerisan: function () {
                window.turnNumberToPerisan = function (e) {
                    var t = {0: "۰", 1: "۱", 2: "۲", 3: "۳", 4: "۴", 5: "۵", 6: "۶", 7: "۷", 8: "۸", 9: "۹"};
                    return e.toString().replace(/[0-9]/g, (function (e) {
                        return t[e]
                    }))
                }
            }
        };
        const Lt = function () {
            document.querySelectorAll("pre code").forEach((function (e) {
                window.hljs.highlightElement(e), window.hljs.lineNumbersBlock(e)
            }))
        };

        function jt(e, t) {
            var n = "undefined" != typeof Symbol && e[Symbol.iterator] || e["@@iterator"];
            if (!n) {
                if (Array.isArray(e) || (n = function (e, t) {
                    if (!e) return;
                    if ("string" == typeof e) return Nt(e, t);
                    var n = Object.prototype.toString.call(e).slice(8, -1);
                    "Object" === n && e.constructor && (n = e.constructor.name);
                    if ("Map" === n || "Set" === n) return Array.from(e);
                    if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return Nt(e, t)
                }(e)) || t && e && "number" == typeof e.length) {
                    n && (e = n);
                    var r = 0, i = function () {
                    };
                    return {
                        s: i, n: function () {
                            return r >= e.length ? {done: !0} : {done: !1, value: e[r++]}
                        }, e: function (e) {
                            throw e
                        }, f: i
                    }
                }
                throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
            }
            var o, a = !0, s = !1;
            return {
                s: function () {
                    n = n.call(e)
                }, n: function () {
                    var e = n.next();
                    return a = e.done, e
                }, e: function (e) {
                    s = !0, o = e
                }, f: function () {
                    try {
                        a || null == n.return || n.return()
                    } finally {
                        if (s) throw o
                    }
                }
            }
        }

        function Nt(e, t) {
            (null == t || t > e.length) && (t = e.length);
            for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
            return r
        }

        const It = {
            init: function () {
                var e, t = jt(document.querySelectorAll("pre code"));
                try {
                    for (t.s(); !(e = t.n()).done;) {
                        var n = e.value;
                        0 === n.classList.length && n.classList.add("hljs")
                    }
                } catch (e) {
                    t.e(e)
                } finally {
                    t.f()
                }
            }
        };

        function zt(e, t) {
            for (var n = 0; n < t.length; n++) {
                var r = t[n];
                r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r)
            }
        }

        var Rt = function () {
            function e() {
                !function (e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.init()
            }

            var t, n, r;
            return t = e, n = [{
                key: "init", value: function () {
                    var e = this;
                    !1 in navigator || !1 in window || navigator.serviceWorker.register("/service-worker.js", {scope: "/"}).then((function () {
                        e.initPush()
                    })).catch((function (e) {
                        return console.log(e)
                    }))
                }
            }, {
                key: "initPush", value: function () {
                    navigator.serviceWorker.ready && ("granted" === Notification.permission ? this.notificationRequest() : "default" === Notification.permission && this.initNotificationModal())
                }
            }, {
                key: "initNotificationModal", value: function () {
                    var e = localStorage.getItem("notificationModalCondition");
                    e ? "accepted" !== e && (new Date).getTime() >= e ? this.generateModal() : document.querySelector(".notification_modal_access").remove() : this.generateModal()
                }
            }, {
                key: "generateModal", value: function () {
                    document.querySelector(".notification_modal_access").classList.remove("hidden"), this.modalBtnHandler()
                }
            }, {
                key: "modalBtnHandler", value: function () {
                    var e = this;
                    document.querySelector("#accept_access_notification").addEventListener("click", (function () {
                        return e.acceptNotification()
                    })), document.querySelector("#cancel_access_notification").addEventListener("click", (function () {
                        return e.cancelNotification()
                    }))
                }
            }, {
                key: "acceptNotification", value: function () {
                    this.notificationRequest({withModal: !0}), document.querySelector(".notification_modal_access").remove()
                }
            }, {
                key: "cancelNotification", value: function () {
                    var e = (new Date).getTime() + 432e6;
                    localStorage.setItem("notificationModalCondition", e), document.querySelector(".notification_modal_access").remove()
                }
            }, {
                key: "notificationRequest", value: function () {
                    var e = this, t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {withModal: !1};
                    new Promise((function (e, t) {
                        var n = Notification.requestPermission((function (t) {
                            e(t)
                        }));
                        n && n.then(e, t)
                    })).then((function (n) {
                        "granted" === n && (t.withModal && localStorage.setItem("notificationModalCondition", "accepted"), e.subscribeUser())
                    }))
                }
            }, {
                key: "subscribeUser", value: function () {
                    var e = this;
                    navigator.serviceWorker.ready.then((function (t) {
                        var n = {
                            userVisibleOnly: !0,
                            applicationServerKey: e.urlBase64ToUint8Array("BI9j_uXmOZsrCOecLVna5oTksRWYK_YyMEowIhGvrnOQk8h-oAvQc5vWjYX0qscm7rWZhDQlVqVinxi9slpMrcQ")
                        };
                        return t.pushManager.subscribe(n)
                    })).then((function (t) {
                        e.storePushSubscription(t)
                    }))
                }
            }, {
                key: "urlBase64ToUint8Array", value: function (e) {
                    for (var t = (e + "=".repeat((4 - e.length % 4) % 4)).replace(/\-/g, "+").replace(/_/g, "/"), n = window.atob(t), r = new Uint8Array(n.length), i = 0; i < n.length; ++i) r[i] = n.charCodeAt(i);
                    return r
                }
            }, {
                key: "storePushSubscription", value: function (e) {
                    axios.post("/push", e).then((function (e) {
                    }))
                }
            }], n && zt(t.prototype, n), r && zt(t, r), Object.defineProperty(t, "prototype", {writable: !1}), e
        }();
        const Bt = {
            NumberPresenter: Mt, HljsInitial: Lt, NotFoundLangHljs: It, ServiceWorker: {
                init: function () {
                    return new Rt
                }
            }
        };
        n(8079), window.addEventListener("load", (function () {
            Bt.NumberPresenter.PersianToEnglish(), Bt.HljsInitial(), Bt.NotFoundLangHljs.init(), Bt.ServiceWorker.init(), Pt()
        }))
    })()
})();