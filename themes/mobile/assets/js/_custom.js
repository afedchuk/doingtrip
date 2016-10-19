! function(e, t) {
    function n(e) {
        var t = e.length,
            n = lt.type(e);
        return lt.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === n || "function" !== n && (0 === t || "number" == typeof t && t > 0 && t - 1 in e)
    }

    function i(e) {
        var t = _t[e] = {};
        return lt.each(e.match(ut) || [], function(e, n) {
            t[n] = !0
        }), t
    }

    function r(e, n, i, r) {
        if (lt.acceptData(e)) {
            var o, a, s = lt.expando,
                l = "string" == typeof n,
                c = e.nodeType,
                u = c ? lt.cache : e,
                d = c ? e[s] : e[s] && s;
            if (d && u[d] && (r || u[d].data) || !l || i !== t) return d || (c ? e[s] = d = Z.pop() || lt.guid++ : d = s), u[d] || (u[d] = {}, c || (u[d].toJSON = lt.noop)), ("object" == typeof n || "function" == typeof n) && (r ? u[d] = lt.extend(u[d], n) : u[d].data = lt.extend(u[d].data, n)), o = u[d], r || (o.data || (o.data = {}), o = o.data), i !== t && (o[lt.camelCase(n)] = i), l ? (a = o[n], null == a && (a = o[lt.camelCase(n)])) : a = o, a
        }
    }

    function o(e, t, n) {
        if (lt.acceptData(e)) {
            var i, r, o, a = e.nodeType,
                l = a ? lt.cache : e,
                c = a ? e[lt.expando] : lt.expando;
            if (l[c]) {
                if (t && (o = n ? l[c] : l[c].data)) {
                    lt.isArray(t) ? t = t.concat(lt.map(t, lt.camelCase)) : t in o ? t = [t] : (t = lt.camelCase(t), t = t in o ? [t] : t.split(" "));
                    for (i = 0, r = t.length; r > i; i++) delete o[t[i]];
                    if (!(n ? s : lt.isEmptyObject)(o)) return
                }(n || (delete l[c].data, s(l[c]))) && (a ? lt.cleanData([e], !0) : lt.support.deleteExpando || l != l.window ? delete l[c] : l[c] = null)
            }
        }
    }

    function a(e, n, i) {
        if (i === t && 1 === e.nodeType) {
            var r = "data-" + n.replace(St, "-$1").toLowerCase();
            if (i = e.getAttribute(r), "string" == typeof i) {
                try {
                    i = "true" === i ? !0 : "false" === i ? !1 : "null" === i ? null : +i + "" === i ? +i : kt.test(i) ? lt.parseJSON(i) : i
                } catch (o) {}
                lt.data(e, n, i)
            } else i = t
        }
        return i
    }

    function s(e) {
        var t;
        for (t in e)
            if (("data" !== t || !lt.isEmptyObject(e[t])) && "toJSON" !== t) return !1;
        return !0
    }

    function l() {
        return !0
    }

    function c() {
        return !1
    }

    function u(e, t) {
        do e = e[t]; while (e && 1 !== e.nodeType);
        return e
    }

    function d(e, t, n) {
        if (t = t || 0, lt.isFunction(t)) return lt.grep(e, function(e, i) {
            var r = !!t.call(e, i, e);
            return r === n
        });
        if (t.nodeType) return lt.grep(e, function(e) {
            return e === t === n
        });
        if ("string" == typeof t) {
            var i = lt.grep(e, function(e) {
                return 1 === e.nodeType
            });
            if (Bt.test(t)) return lt.filter(t, i, !n);
            t = lt.filter(t, i)
        }
        return lt.grep(e, function(e) {
            return lt.inArray(e, t) >= 0 === n
        })
    }

    function p(e) {
        var t = Ut.split("|"),
            n = e.createDocumentFragment();
        if (n.createElement)
            for (; t.length;) n.createElement(t.pop());
        return n
    }

    function f(e, t) {
        return e.getElementsByTagName(t)[0] || e.appendChild(e.ownerDocument.createElement(t))
    }

    function h(e) {
        var t = e.getAttributeNode("type");
        return e.type = (t && t.specified) + "/" + e.type, e
    }

    function g(e) {
        var t = on.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e
    }

    function m(e, t) {
        for (var n, i = 0; null != (n = e[i]); i++) lt._data(n, "globalEval", !t || lt._data(t[i], "globalEval"))
    }

    function v(e, t) {
        if (1 === t.nodeType && lt.hasData(e)) {
            var n, i, r, o = lt._data(e),
                a = lt._data(t, o),
                s = o.events;
            if (s) {
                delete a.handle, a.events = {};
                for (n in s)
                    for (i = 0, r = s[n].length; r > i; i++) lt.event.add(t, n, s[n][i])
            }
            a.data && (a.data = lt.extend({}, a.data))
        }
    }

    function y(e, t) {
        var n, i, r;
        if (1 === t.nodeType) {
            if (n = t.nodeName.toLowerCase(), !lt.support.noCloneEvent && t[lt.expando]) {
                r = lt._data(t);
                for (i in r.events) lt.removeEvent(t, i, r.handle);
                t.removeAttribute(lt.expando)
            }
            "script" === n && t.text !== e.text ? (h(t).text = e.text, g(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML), lt.support.html5Clone && e.innerHTML && !lt.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && tn.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue)
        }
    }

    function b(e, n) {
        var i, r, o = 0,
            a = typeof e.getElementsByTagName !== Q ? e.getElementsByTagName(n || "*") : typeof e.querySelectorAll !== Q ? e.querySelectorAll(n || "*") : t;
        if (!a)
            for (a = [], i = e.childNodes || e; null != (r = i[o]); o++) !n || lt.nodeName(r, n) ? a.push(r) : lt.merge(a, b(r, n));
        return n === t || n && lt.nodeName(e, n) ? lt.merge([e], a) : a
    }

    function x(e) {
        tn.test(e.type) && (e.defaultChecked = e.checked)
    }

    function w(e, t) {
        if (t in e) return t;
        for (var n = t.charAt(0).toUpperCase() + t.slice(1), i = t, r = Sn.length; r--;)
            if (t = Sn[r] + n, t in e) return t;
        return i
    }

    function C(e, t) {
        return e = t || e, "none" === lt.css(e, "display") || !lt.contains(e.ownerDocument, e)
    }

    function _(e, t) {
        for (var n, i, r, o = [], a = 0, s = e.length; s > a; a++) i = e[a], i.style && (o[a] = lt._data(i, "olddisplay"), n = i.style.display, t ? (o[a] || "none" !== n || (i.style.display = ""), "" === i.style.display && C(i) && (o[a] = lt._data(i, "olddisplay", $(i.nodeName)))) : o[a] || (r = C(i), (n && "none" !== n || !r) && lt._data(i, "olddisplay", r ? n : lt.css(i, "display"))));
        for (a = 0; s > a; a++) i = e[a], i.style && (t && "none" !== i.style.display && "" !== i.style.display || (i.style.display = t ? o[a] || "" : "none"));
        return e
    }

    function k(e, t, n) {
        var i = yn.exec(t);
        return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : t
    }

    function S(e, t, n, i, r) {
        for (var o = n === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0, a = 0; 4 > o; o += 2) "margin" === n && (a += lt.css(e, n + kn[o], !0, r)), i ? ("content" === n && (a -= lt.css(e, "padding" + kn[o], !0, r)), "margin" !== n && (a -= lt.css(e, "border" + kn[o] + "Width", !0, r))) : (a += lt.css(e, "padding" + kn[o], !0, r), "padding" !== n && (a += lt.css(e, "border" + kn[o] + "Width", !0, r)));
        return a
    }

    function T(e, t, n) {
        var i = !0,
            r = "width" === t ? e.offsetWidth : e.offsetHeight,
            o = dn(e),
            a = lt.support.boxSizing && "border-box" === lt.css(e, "boxSizing", !1, o);
        if (0 >= r || null == r) {
            if (r = pn(e, t, o), (0 > r || null == r) && (r = e.style[t]), bn.test(r)) return r;
            i = a && (lt.support.boxSizingReliable || r === e.style[t]), r = parseFloat(r) || 0
        }
        return r + S(e, t, n || (a ? "border" : "content"), i, o) + "px"
    }

    function $(e) {
        var t = X,
            n = wn[e];
        return n || (n = A(e, t), "none" !== n && n || (un = (un || lt("<iframe frameborder='0' width='0' height='0'/>").css("cssText", "display:block !important")).appendTo(t.documentElement), t = (un[0].contentWindow || un[0].contentDocument).document, t.write("<!doctype html><html><body>"), t.close(), n = A(e, t), un.detach()), wn[e] = n), n
    }

    function A(e, t) {
        var n = lt(t.createElement(e)).appendTo(t.body),
            i = lt.css(n[0], "display");
        return n.remove(), i
    }

    function E(e, t, n, i) {
        var r;
        if (lt.isArray(t)) lt.each(t, function(t, r) {
            n || $n.test(e) ? i(e, r) : E(e + "[" + ("object" == typeof r ? t : "") + "]", r, n, i)
        });
        else if (n || "object" !== lt.type(t)) i(e, t);
        else
            for (r in t) E(e + "[" + r + "]", t[r], n, i)
    }

    function N(e) {
        return function(t, n) {
            "string" != typeof t && (n = t, t = "*");
            var i, r = 0,
                o = t.toLowerCase().match(ut) || [];
            if (lt.isFunction(n))
                for (; i = o[r++];) "+" === i[0] ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n)
        }
    }

    function O(e, t, n, i) {
        function r(s) {
            var l;
            return o[s] = !0, lt.each(e[s] || [], function(e, s) {
                var c = s(t, n, i);
                return "string" != typeof c || a || o[c] ? a ? !(l = c) : void 0 : (t.dataTypes.unshift(c), r(c), !1)
            }), l
        }
        var o = {},
            a = e === zn;
        return r(t.dataTypes[0]) || !o["*"] && r("*")
    }

    function P(e, n) {
        var i, r, o = lt.ajaxSettings.flatOptions || {};
        for (r in n) n[r] !== t && ((o[r] ? e : i || (i = {}))[r] = n[r]);
        return i && lt.extend(!0, e, i), e
    }

    function I(e, n, i) {
        var r, o, a, s, l = e.contents,
            c = e.dataTypes,
            u = e.responseFields;
        for (s in u) s in i && (n[u[s]] = i[s]);
        for (;
            "*" === c[0];) c.shift(), o === t && (o = e.mimeType || n.getResponseHeader("Content-Type"));
        if (o)
            for (s in l)
                if (l[s] && l[s].test(o)) {
                    c.unshift(s);
                    break
                }
        if (c[0] in i) a = c[0];
        else {
            for (s in i) {
                if (!c[0] || e.converters[s + " " + c[0]]) {
                    a = s;
                    break
                }
                r || (r = s)
            }
            a = a || r
        }
        return a ? (a !== c[0] && c.unshift(a), i[a]) : void 0
    }

    function j(e, t) {
        var n, i, r, o, a = {},
            s = 0,
            l = e.dataTypes.slice(),
            c = l[0];
        if (e.dataFilter && (t = e.dataFilter(t, e.dataType)), l[1])
            for (r in e.converters) a[r.toLowerCase()] = e.converters[r];
        for (; i = l[++s];)
            if ("*" !== i) {
                if ("*" !== c && c !== i) {
                    if (r = a[c + " " + i] || a["* " + i], !r)
                        for (n in a)
                            if (o = n.split(" "), o[1] === i && (r = a[c + " " + o[0]] || a["* " + o[0]])) {
                                r === !0 ? r = a[n] : a[n] !== !0 && (i = o[0], l.splice(s--, 0, i));
                                break
                            }
                    if (r !== !0)
                        if (r && e["throws"]) t = r(t);
                        else try {
                            t = r(t)
                        } catch (u) {
                            return {
                                state: "parsererror",
                                error: r ? u : "No conversion from " + c + " to " + i
                            }
                        }
                }
                c = i
            }
        return {
            state: "success",
            data: t
        }
    }

    function D() {
        try {
            return new e.XMLHttpRequest
        } catch (t) {}
    }

    function M() {
        try {
            return new e.ActiveXObject("Microsoft.XMLHTTP")
        } catch (t) {}
    }

    function F() {
        return setTimeout(function() {
            Zn = t
        }), Zn = lt.now()
    }

    function H(e, t) {
        lt.each(t, function(t, n) {
            for (var i = (oi[t] || []).concat(oi["*"]), r = 0, o = i.length; o > r; r++)
                if (i[r].call(e, t, n)) return
        })
    }

    function q(e, t, n) {
        var i, r, o = 0,
            a = ri.length,
            s = lt.Deferred().always(function() {
                delete l.elem
            }),
            l = function() {
                if (r) return !1;
                for (var t = Zn || F(), n = Math.max(0, c.startTime + c.duration - t), i = n / c.duration || 0, o = 1 - i, a = 0, l = c.tweens.length; l > a; a++) c.tweens[a].run(o);
                return s.notifyWith(e, [c, o, n]), 1 > o && l ? n : (s.resolveWith(e, [c]), !1)
            },
            c = s.promise({
                elem: e,
                props: lt.extend({}, t),
                opts: lt.extend(!0, {
                    specialEasing: {}
                }, n),
                originalProperties: t,
                originalOptions: n,
                startTime: Zn || F(),
                duration: n.duration,
                tweens: [],
                createTween: function(t, n) {
                    var i = lt.Tween(e, c.opts, t, n, c.opts.specialEasing[t] || c.opts.easing);
                    return c.tweens.push(i), i
                },
                stop: function(t) {
                    var n = 0,
                        i = t ? c.tweens.length : 0;
                    if (r) return this;
                    for (r = !0; i > n; n++) c.tweens[n].run(1);
                    return t ? s.resolveWith(e, [c, t]) : s.rejectWith(e, [c, t]), this
                }
            }),
            u = c.props;
        for (L(u, c.opts.specialEasing); a > o; o++)
            if (i = ri[o].call(c, e, u, c.opts)) return i;
        return H(c, u), lt.isFunction(c.opts.start) && c.opts.start.call(e, c), lt.fx.timer(lt.extend(l, {
            elem: e,
            anim: c,
            queue: c.opts.queue
        })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always)
    }

    function L(e, t) {
        var n, i, r, o, a;
        for (r in e)
            if (i = lt.camelCase(r), o = t[i], n = e[r], lt.isArray(n) && (o = n[1], n = e[r] = n[0]), r !== i && (e[i] = n, delete e[r]), a = lt.cssHooks[i], a && "expand" in a) {
                n = a.expand(n), delete e[i];
                for (r in n) r in e || (e[r] = n[r], t[r] = o)
            } else t[i] = o
    }

    function R(e, t, n) {
        var i, r, o, a, s, l, c, u, d, p = this,
            f = e.style,
            h = {},
            g = [],
            m = e.nodeType && C(e);
        n.queue || (u = lt._queueHooks(e, "fx"), null == u.unqueued && (u.unqueued = 0, d = u.empty.fire, u.empty.fire = function() {
            u.unqueued || d()
        }), u.unqueued++, p.always(function() {
            p.always(function() {
                u.unqueued--, lt.queue(e, "fx").length || u.empty.fire()
            })
        })), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [f.overflow, f.overflowX, f.overflowY], "inline" === lt.css(e, "display") && "none" === lt.css(e, "float") && (lt.support.inlineBlockNeedsLayout && "inline" !== $(e.nodeName) ? f.zoom = 1 : f.display = "inline-block")), n.overflow && (f.overflow = "hidden", lt.support.shrinkWrapBlocks || p.always(function() {
            f.overflow = n.overflow[0], f.overflowX = n.overflow[1], f.overflowY = n.overflow[2]
        }));
        for (r in t)
            if (a = t[r], ti.exec(a)) {
                if (delete t[r], l = l || "toggle" === a, a === (m ? "hide" : "show")) continue;
                g.push(r)
            }
        if (o = g.length) {
            s = lt._data(e, "fxshow") || lt._data(e, "fxshow", {}), "hidden" in s && (m = s.hidden), l && (s.hidden = !m), m ? lt(e).show() : p.done(function() {
                lt(e).hide()
            }), p.done(function() {
                var t;
                lt._removeData(e, "fxshow");
                for (t in h) lt.style(e, t, h[t])
            });
            for (r = 0; o > r; r++) i = g[r], c = p.createTween(i, m ? s[i] : 0), h[i] = s[i] || lt.style(e, i), i in s || (s[i] = c.start, m && (c.end = c.start, c.start = "width" === i || "height" === i ? 1 : 0))
        }
    }

    function W(e, t, n, i, r) {
        return new W.prototype.init(e, t, n, i, r)
    }

    function B(e, t) {
        var n, i = {
                height: e
            },
            r = 0;
        for (t = t ? 1 : 0; 4 > r; r += 2 - t) n = kn[r], i["margin" + n] = i["padding" + n] = e;
        return t && (i.opacity = i.width = e), i
    }

    function z(e) {
        return lt.isWindow(e) ? e : 9 === e.nodeType ? e.defaultView || e.parentWindow : !1
    }
    var V, U, Q = typeof t,
        X = e.document,
        K = e.location,
        G = e.jQuery,
        Y = e.$,
        J = {},
        Z = [],
        et = "1.9.1",
        tt = Z.concat,
        nt = Z.push,
        it = Z.slice,
        rt = Z.indexOf,
        ot = J.toString,
        at = J.hasOwnProperty,
        st = et.trim,
        lt = function(e, t) {
            return new lt.fn.init(e, t, U)
        },
        ct = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        ut = /\S+/g,
        dt = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        pt = /^(?:(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        ft = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        ht = /^[\],:{}\s]*$/,
        gt = /(?:^|:|,)(?:\s*\[)+/g,
        mt = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
        vt = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,
        yt = /^-ms-/,
        bt = /-([\da-z])/gi,
        xt = function(e, t) {
            return t.toUpperCase()
        },
        wt = function(e) {
            (X.addEventListener || "load" === e.type || "complete" === X.readyState) && (Ct(), lt.ready())
        },
        Ct = function() {
            X.addEventListener ? (X.removeEventListener("DOMContentLoaded", wt, !1), e.removeEventListener("load", wt, !1)) : (X.detachEvent("onreadystatechange", wt), e.detachEvent("onload", wt))
        };
    lt.fn = lt.prototype = {
        jquery: et,
        constructor: lt,
        init: function(e, n, i) {
            var r, o;
            if (!e) return this;
            if ("string" == typeof e) {
                if (r = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : pt.exec(e), !r || !r[1] && n) return !n || n.jquery ? (n || i).find(e) : this.constructor(n).find(e);
                if (r[1]) {
                    if (n = n instanceof lt ? n[0] : n, lt.merge(this, lt.parseHTML(r[1], n && n.nodeType ? n.ownerDocument || n : X, !0)), ft.test(r[1]) && lt.isPlainObject(n))
                        for (r in n) lt.isFunction(this[r]) ? this[r](n[r]) : this.attr(r, n[r]);
                    return this
                }
                if (o = X.getElementById(r[2]), o && o.parentNode) {
                    if (o.id !== r[2]) return i.find(e);
                    this.length = 1, this[0] = o
                }
                return this.context = X, this.selector = e, this
            }
            return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : lt.isFunction(e) ? i.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), lt.makeArray(e, this))
        },
        selector: "",
        length: 0,
        size: function() {
            return this.length
        },
        toArray: function() {
            return it.call(this)
        },
        get: function(e) {
            return null == e ? this.toArray() : 0 > e ? this[this.length + e] : this[e]
        },
        pushStack: function(e) {
            var t = lt.merge(this.constructor(), e);
            return t.prevObject = this, t.context = this.context, t
        },
        each: function(e, t) {
            return lt.each(this, e, t)
        },
        ready: function(e) {
            return lt.ready.promise().done(e), this
        },
        slice: function() {
            return this.pushStack(it.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(e) {
            var t = this.length,
                n = +e + (0 > e ? t : 0);
            return this.pushStack(n >= 0 && t > n ? [this[n]] : [])
        },
        map: function(e) {
            return this.pushStack(lt.map(this, function(t, n) {
                return e.call(t, n, t)
            }))
        },
        end: function() {
            return this.prevObject || this.constructor(null)
        },
        push: nt,
        sort: [].sort,
        splice: [].splice
    }, lt.fn.init.prototype = lt.fn, lt.extend = lt.fn.extend = function() {
        var e, n, i, r, o, a, s = arguments[0] || {},
            l = 1,
            c = arguments.length,
            u = !1;
        for ("boolean" == typeof s && (u = s, s = arguments[1] || {}, l = 2), "object" == typeof s || lt.isFunction(s) || (s = {}), c === l && (s = this, --l); c > l; l++)
            if (null != (o = arguments[l]))
                for (r in o) e = s[r], i = o[r], s !== i && (u && i && (lt.isPlainObject(i) || (n = lt.isArray(i))) ? (n ? (n = !1, a = e && lt.isArray(e) ? e : []) : a = e && lt.isPlainObject(e) ? e : {}, s[r] = lt.extend(u, a, i)) : i !== t && (s[r] = i));
        return s
    }, lt.extend({
        noConflict: function(t) {
            return e.$ === lt && (e.$ = Y), t && e.jQuery === lt && (e.jQuery = G), lt
        },
        isReady: !1,
        readyWait: 1,
        holdReady: function(e) {
            e ? lt.readyWait++ : lt.ready(!0)
        },
        ready: function(e) {
            if (e === !0 ? !--lt.readyWait : !lt.isReady) {
                if (!X.body) return setTimeout(lt.ready);
                lt.isReady = !0, e !== !0 && --lt.readyWait > 0 || (V.resolveWith(X, [lt]), lt.fn.trigger && lt(X).trigger("ready").off("ready"))
            }
        },
        isFunction: function(e) {
            return "function" === lt.type(e)
        },
        isArray: Array.isArray || function(e) {
            return "array" === lt.type(e)
        },
        isWindow: function(e) {
            return null != e && e == e.window
        },
        isNumeric: function(e) {
            return !isNaN(parseFloat(e)) && isFinite(e)
        },
        type: function(e) {
            return null == e ? String(e) : "object" == typeof e || "function" == typeof e ? J[ot.call(e)] || "object" : typeof e
        },
        isPlainObject: function(e) {
            if (!e || "object" !== lt.type(e) || e.nodeType || lt.isWindow(e)) return !1;
            try {
                if (e.constructor && !at.call(e, "constructor") && !at.call(e.constructor.prototype, "isPrototypeOf")) return !1
            } catch (n) {
                return !1
            }
            var i;
            for (i in e);
            return i === t || at.call(e, i)
        },
        isEmptyObject: function(e) {
            var t;
            for (t in e) return !1;
            return !0
        },
        error: function(e) {
            throw new Error(e)
        },
        parseHTML: function(e, t, n) {
            if (!e || "string" != typeof e) return null;
            "boolean" == typeof t && (n = t, t = !1), t = t || X;
            var i = ft.exec(e),
                r = !n && [];
            return i ? [t.createElement(i[1])] : (i = lt.buildFragment([e], t, r), r && lt(r).remove(), lt.merge([], i.childNodes))
        },
        parseJSON: function(t) {
            return e.JSON && e.JSON.parse ? e.JSON.parse(t) : null === t ? t : "string" == typeof t && (t = lt.trim(t), t && ht.test(t.replace(mt, "@").replace(vt, "]").replace(gt, ""))) ? new Function("return " + t)() : void lt.error("Invalid JSON: " + t)
        },
        parseXML: function(n) {
            var i, r;
            if (!n || "string" != typeof n) return null;
            try {
                e.DOMParser ? (r = new DOMParser, i = r.parseFromString(n, "text/xml")) : (i = new ActiveXObject("Microsoft.XMLDOM"), i.async = "false", i.loadXML(n))
            } catch (o) {
                i = t
            }
            return i && i.documentElement && !i.getElementsByTagName("parsererror").length || lt.error("Invalid XML: " + n), i
        },
        noop: function() {},
        globalEval: function(t) {
            t && lt.trim(t) && (e.execScript || function(t) {
                e.eval.call(e, t)
            })(t)
        },
        camelCase: function(e) {
            return e.replace(yt, "ms-").replace(bt, xt)
        },
        nodeName: function(e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        },
        each: function(e, t, i) {
            var r, o = 0,
                a = e.length,
                s = n(e);
            if (i) {
                if (s)
                    for (; a > o && (r = t.apply(e[o], i), r !== !1); o++);
                else
                    for (o in e)
                        if (r = t.apply(e[o], i), r === !1) break
            } else if (s)
                for (; a > o && (r = t.call(e[o], o, e[o]), r !== !1); o++);
            else
                for (o in e)
                    if (r = t.call(e[o], o, e[o]), r === !1) break; return e
        },
        trim: st && !st.call("\ufeff\xa0") ? function(e) {
            return null == e ? "" : st.call(e)
        } : function(e) {
            return null == e ? "" : (e + "").replace(dt, "")
        },
        makeArray: function(e, t) {
            var i = t || [];
            return null != e && (n(Object(e)) ? lt.merge(i, "string" == typeof e ? [e] : e) : nt.call(i, e)), i
        },
        inArray: function(e, t, n) {
            var i;
            if (t) {
                if (rt) return rt.call(t, e, n);
                for (i = t.length, n = n ? 0 > n ? Math.max(0, i + n) : n : 0; i > n; n++)
                    if (n in t && t[n] === e) return n
            }
            return -1
        },
        merge: function(e, n) {
            var i = n.length,
                r = e.length,
                o = 0;
            if ("number" == typeof i)
                for (; i > o; o++) e[r++] = n[o];
            else
                for (; n[o] !== t;) e[r++] = n[o++];
            return e.length = r, e
        },
        grep: function(e, t, n) {
            var i, r = [],
                o = 0,
                a = e.length;
            for (n = !!n; a > o; o++) i = !!t(e[o], o), n !== i && r.push(e[o]);
            return r
        },
        map: function(e, t, i) {
            var r, o = 0,
                a = e.length,
                s = n(e),
                l = [];
            if (s)
                for (; a > o; o++) r = t(e[o], o, i), null != r && (l[l.length] = r);
            else
                for (o in e) r = t(e[o], o, i), null != r && (l[l.length] = r);
            return tt.apply([], l)
        },
        guid: 1,
        proxy: function(e, n) {
            var i, r, o;
            return "string" == typeof n && (o = e[n], n = e, e = o), lt.isFunction(e) ? (i = it.call(arguments, 2), r = function() {
                return e.apply(n || this, i.concat(it.call(arguments)))
            }, r.guid = e.guid = e.guid || lt.guid++, r) : t
        },
        access: function(e, n, i, r, o, a, s) {
            var l = 0,
                c = e.length,
                u = null == i;
            if ("object" === lt.type(i)) {
                o = !0;
                for (l in i) lt.access(e, n, l, i[l], !0, a, s)
            } else if (r !== t && (o = !0, lt.isFunction(r) || (s = !0), u && (s ? (n.call(e, r), n = null) : (u = n, n = function(e, t, n) {
                    return u.call(lt(e), n)
                })), n))
                for (; c > l; l++) n(e[l], i, s ? r : r.call(e[l], l, n(e[l], i)));
            return o ? e : u ? n.call(e) : c ? n(e[0], i) : a
        },
        now: function() {
            return (new Date).getTime()
        }
    }), lt.ready.promise = function(t) {
        if (!V)
            if (V = lt.Deferred(), "complete" === X.readyState) setTimeout(lt.ready);
            else if (X.addEventListener) X.addEventListener("DOMContentLoaded", wt, !1), e.addEventListener("load", wt, !1);
        else {
            X.attachEvent("onreadystatechange", wt), e.attachEvent("onload", wt);
            var n = !1;
            try {
                n = null == e.frameElement && X.documentElement
            } catch (i) {}
            n && n.doScroll && ! function r() {
                if (!lt.isReady) {
                    try {
                        n.doScroll("left")
                    } catch (e) {
                        return setTimeout(r, 50)
                    }
                    Ct(), lt.ready()
                }
            }()
        }
        return V.promise(t)
    }, lt.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(e, t) {
        J["[object " + t + "]"] = t.toLowerCase()
    }), U = lt(X);
    var _t = {};
    lt.Callbacks = function(e) {
        e = "string" == typeof e ? _t[e] || i(e) : lt.extend({}, e);
        var n, r, o, a, s, l, c = [],
            u = !e.once && [],
            d = function(t) {
                for (r = e.memory && t, o = !0, s = l || 0, l = 0, a = c.length, n = !0; c && a > s; s++)
                    if (c[s].apply(t[0], t[1]) === !1 && e.stopOnFalse) {
                        r = !1;
                        break
                    }
                n = !1, c && (u ? u.length && d(u.shift()) : r ? c = [] : p.disable())
            },
            p = {
                add: function() {
                    if (c) {
                        var t = c.length;
                        ! function i(t) {
                            lt.each(t, function(t, n) {
                                var r = lt.type(n);
                                "function" === r ? e.unique && p.has(n) || c.push(n) : n && n.length && "string" !== r && i(n)
                            })
                        }(arguments), n ? a = c.length : r && (l = t, d(r))
                    }
                    return this
                },
                remove: function() {
                    return c && lt.each(arguments, function(e, t) {
                        for (var i;
                            (i = lt.inArray(t, c, i)) > -1;) c.splice(i, 1), n && (a >= i && a--, s >= i && s--)
                    }), this
                },
                has: function(e) {
                    return e ? lt.inArray(e, c) > -1 : !(!c || !c.length)
                },
                empty: function() {
                    return c = [], this
                },
                disable: function() {
                    return c = u = r = t, this
                },
                disabled: function() {
                    return !c
                },
                lock: function() {
                    return u = t, r || p.disable(), this
                },
                locked: function() {
                    return !u
                },
                fireWith: function(e, t) {
                    return t = t || [], t = [e, t.slice ? t.slice() : t], !c || o && !u || (n ? u.push(t) : d(t)), this
                },
                fire: function() {
                    return p.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!o
                }
            };
        return p
    }, lt.extend({
        Deferred: function(e) {
            var t = [
                    ["resolve", "done", lt.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", lt.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", lt.Callbacks("memory")]
                ],
                n = "pending",
                i = {
                    state: function() {
                        return n
                    },
                    always: function() {
                        return r.done(arguments).fail(arguments), this
                    },
                    then: function() {
                        var e = arguments;
                        return lt.Deferred(function(n) {
                            lt.each(t, function(t, o) {
                                var a = o[0],
                                    s = lt.isFunction(e[t]) && e[t];
                                r[o[1]](function() {
                                    var e = s && s.apply(this, arguments);
                                    e && lt.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[a + "With"](this === i ? n.promise() : this, s ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    },
                    promise: function(e) {
                        return null != e ? lt.extend(e, i) : i
                    }
                },
                r = {};
            return i.pipe = i.then, lt.each(t, function(e, o) {
                var a = o[2],
                    s = o[3];
                i[o[1]] = a.add, s && a.add(function() {
                    n = s
                }, t[1 ^ e][2].disable, t[2][2].lock), r[o[0]] = function() {
                    return r[o[0] + "With"](this === r ? i : this, arguments), this
                }, r[o[0] + "With"] = a.fireWith
            }), i.promise(r), e && e.call(r, r), r
        },
        when: function(e) {
            var t, n, i, r = 0,
                o = it.call(arguments),
                a = o.length,
                s = 1 !== a || e && lt.isFunction(e.promise) ? a : 0,
                l = 1 === s ? e : lt.Deferred(),
                c = function(e, n, i) {
                    return function(r) {
                        n[e] = this, i[e] = arguments.length > 1 ? it.call(arguments) : r, i === t ? l.notifyWith(n, i) : --s || l.resolveWith(n, i)
                    }
                };
            if (a > 1)
                for (t = new Array(a), n = new Array(a), i = new Array(a); a > r; r++) o[r] && lt.isFunction(o[r].promise) ? o[r].promise().done(c(r, i, o)).fail(l.reject).progress(c(r, n, t)) : --s;
            return s || l.resolveWith(i, o), l.promise()
        }
    }), lt.support = function() {
        var t, n, i, r, o, a, s, l, c, u, d = X.createElement("div");
        if (d.setAttribute("className", "t"), d.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = d.getElementsByTagName("*"), i = d.getElementsByTagName("a")[0], !n || !i || !n.length) return {};
        o = X.createElement("select"), s = o.appendChild(X.createElement("option")), r = d.getElementsByTagName("input")[0], i.style.cssText = "top:1px;float:left;opacity:.5", t = {
            getSetAttribute: "t" !== d.className,
            leadingWhitespace: 3 === d.firstChild.nodeType,
            tbody: !d.getElementsByTagName("tbody").length,
            htmlSerialize: !!d.getElementsByTagName("link").length,
            style: /top/.test(i.getAttribute("style")),
            hrefNormalized: "/a" === i.getAttribute("href"),
            opacity: /^0.5/.test(i.style.opacity),
            cssFloat: !!i.style.cssFloat,
            checkOn: !!r.value,
            optSelected: s.selected,
            enctype: !!X.createElement("form").enctype,
            html5Clone: "<:nav></:nav>" !== X.createElement("nav").cloneNode(!0).outerHTML,
            boxModel: "CSS1Compat" === X.compatMode,
            deleteExpando: !0,
            noCloneEvent: !0,
            inlineBlockNeedsLayout: !1,
            shrinkWrapBlocks: !1,
            reliableMarginRight: !0,
            boxSizingReliable: !0,
            pixelPosition: !1
        }, r.checked = !0, t.noCloneChecked = r.cloneNode(!0).checked, o.disabled = !0, t.optDisabled = !s.disabled;
        try {
            delete d.test
        } catch (p) {
            t.deleteExpando = !1
        }
        r = X.createElement("input"), r.setAttribute("value", ""), t.input = "" === r.getAttribute("value"), r.value = "t", r.setAttribute("type", "radio"), t.radioValue = "t" === r.value, r.setAttribute("checked", "t"), r.setAttribute("name", "t"), a = X.createDocumentFragment(), a.appendChild(r), t.appendChecked = r.checked, t.checkClone = a.cloneNode(!0).cloneNode(!0).lastChild.checked, d.attachEvent && (d.attachEvent("onclick", function() {
            t.noCloneEvent = !1
        }), d.cloneNode(!0).click());
        for (u in {
                submit: !0,
                change: !0,
                focusin: !0
            }) d.setAttribute(l = "on" + u, "t"), t[u + "Bubbles"] = l in e || d.attributes[l].expando === !1;
        return d.style.backgroundClip = "content-box", d.cloneNode(!0).style.backgroundClip = "", t.clearCloneStyle = "content-box" === d.style.backgroundClip, lt(function() {
            var n, i, r, o = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",
                a = X.getElementsByTagName("body")[0];
            a && (n = X.createElement("div"), n.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", a.appendChild(n).appendChild(d), d.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", r = d.getElementsByTagName("td"), r[0].style.cssText = "padding:0;margin:0;border:0;display:none", c = 0 === r[0].offsetHeight, r[0].style.display = "", r[1].style.display = "none", t.reliableHiddenOffsets = c && 0 === r[0].offsetHeight, d.innerHTML = "", d.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", t.boxSizing = 4 === d.offsetWidth, t.doesNotIncludeMarginInBodyOffset = 1 !== a.offsetTop, e.getComputedStyle && (t.pixelPosition = "1%" !== (e.getComputedStyle(d, null) || {}).top, t.boxSizingReliable = "4px" === (e.getComputedStyle(d, null) || {
                width: "4px"
            }).width, i = d.appendChild(X.createElement("div")), i.style.cssText = d.style.cssText = o, i.style.marginRight = i.style.width = "0", d.style.width = "1px", t.reliableMarginRight = !parseFloat((e.getComputedStyle(i, null) || {}).marginRight)), typeof d.style.zoom !== Q && (d.innerHTML = "", d.style.cssText = o + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = 3 === d.offsetWidth, d.style.display = "block", d.innerHTML = "<div></div>", d.firstChild.style.width = "5px", t.shrinkWrapBlocks = 3 !== d.offsetWidth, t.inlineBlockNeedsLayout && (a.style.zoom = 1)), a.removeChild(n), n = d = r = i = null)
        }), n = o = a = s = i = r = null, t
    }();
    var kt = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
        St = /([A-Z])/g;
    lt.extend({
        cache: {},
        expando: "jQuery" + (et + Math.random()).replace(/\D/g, ""),
        noData: {
            embed: !0,
            object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
            applet: !0
        },
        hasData: function(e) {
            return e = e.nodeType ? lt.cache[e[lt.expando]] : e[lt.expando], !!e && !s(e)
        },
        data: function(e, t, n) {
            return r(e, t, n)
        },
        removeData: function(e, t) {
            return o(e, t)
        },
        _data: function(e, t, n) {
            return r(e, t, n, !0)
        },
        _removeData: function(e, t) {
            return o(e, t, !0)
        },
        acceptData: function(e) {
            if (e.nodeType && 1 !== e.nodeType && 9 !== e.nodeType) return !1;
            var t = e.nodeName && lt.noData[e.nodeName.toLowerCase()];
            return !t || t !== !0 && e.getAttribute("classid") === t
        }
    }), lt.fn.extend({
        data: function(e, n) {
            var i, r, o = this[0],
                s = 0,
                l = null;
            if (e === t) {
                if (this.length && (l = lt.data(o), 1 === o.nodeType && !lt._data(o, "parsedAttrs"))) {
                    for (i = o.attributes; s < i.length; s++) r = i[s].name, r.indexOf("data-") || (r = lt.camelCase(r.slice(5)), a(o, r, l[r]));
                    lt._data(o, "parsedAttrs", !0)
                }
                return l
            }
            return "object" == typeof e ? this.each(function() {
                lt.data(this, e)
            }) : lt.access(this, function(n) {
                return n === t ? o ? a(o, e, lt.data(o, e)) : null : void this.each(function() {
                    lt.data(this, e, n)
                })
            }, null, n, arguments.length > 1, null, !0)
        },
        removeData: function(e) {
            return this.each(function() {
                lt.removeData(this, e)
            })
        }
    }), lt.extend({
        queue: function(e, t, n) {
            var i;
            return e ? (t = (t || "fx") + "queue", i = lt._data(e, t), n && (!i || lt.isArray(n) ? i = lt._data(e, t, lt.makeArray(n)) : i.push(n)), i || []) : void 0
        },
        dequeue: function(e, t) {
            t = t || "fx";
            var n = lt.queue(e, t),
                i = n.length,
                r = n.shift(),
                o = lt._queueHooks(e, t),
                a = function() {
                    lt.dequeue(e, t)
                };
            "inprogress" === r && (r = n.shift(), i--), o.cur = r, r && ("fx" === t && n.unshift("inprogress"), delete o.stop, r.call(e, a, o)), !i && o && o.empty.fire()
        },
        _queueHooks: function(e, t) {
            var n = t + "queueHooks";
            return lt._data(e, n) || lt._data(e, n, {
                empty: lt.Callbacks("once memory").add(function() {
                    lt._removeData(e, t + "queue"), lt._removeData(e, n)
                })
            })
        }
    }), lt.fn.extend({
        queue: function(e, n) {
            var i = 2;
            return "string" != typeof e && (n = e, e = "fx", i--), arguments.length < i ? lt.queue(this[0], e) : n === t ? this : this.each(function() {
                var t = lt.queue(this, e, n);
                lt._queueHooks(this, e), "fx" === e && "inprogress" !== t[0] && lt.dequeue(this, e)
            })
        },
        dequeue: function(e) {
            return this.each(function() {
                lt.dequeue(this, e)
            })
        },
        delay: function(e, t) {
            return e = lt.fx ? lt.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function(t, n) {
                var i = setTimeout(t, e);
                n.stop = function() {
                    clearTimeout(i)
                }
            })
        },
        clearQueue: function(e) {
            return this.queue(e || "fx", [])
        },
        promise: function(e, n) {
            var i, r = 1,
                o = lt.Deferred(),
                a = this,
                s = this.length,
                l = function() {
                    --r || o.resolveWith(a, [a])
                };
            for ("string" != typeof e && (n = e, e = t), e = e || "fx"; s--;) i = lt._data(a[s], e + "queueHooks"), i && i.empty && (r++, i.empty.add(l));
            return l(), o.promise(n)
        }
    });
    var Tt, $t, At = /[\t\r\n]/g,
        Et = /\r/g,
        Nt = /^(?:input|select|textarea|button|object)$/i,
        Ot = /^(?:a|area)$/i,
        Pt = /^(?:checked|selected|autofocus|autoplay|async|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped)$/i,
        It = /^(?:checked|selected)$/i,
        jt = lt.support.getSetAttribute,
        Dt = lt.support.input;
    lt.fn.extend({
        attr: function(e, t) {
            return lt.access(this, lt.attr, e, t, arguments.length > 1)
        },
        removeAttr: function(e) {
            return this.each(function() {
                lt.removeAttr(this, e)
            })
        },
        prop: function(e, t) {
            return lt.access(this, lt.prop, e, t, arguments.length > 1)
        },
        removeProp: function(e) {
            return e = lt.propFix[e] || e, this.each(function() {
                try {
                    this[e] = t, delete this[e]
                } catch (n) {}
            })
        },
        addClass: function(e) {
            var t, n, i, r, o, a = 0,
                s = this.length,
                l = "string" == typeof e && e;
            if (lt.isFunction(e)) return this.each(function(t) {
                lt(this).addClass(e.call(this, t, this.className))
            });
            if (l)
                for (t = (e || "").match(ut) || []; s > a; a++)
                    if (n = this[a], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(At, " ") : " ")) {
                        for (o = 0; r = t[o++];) i.indexOf(" " + r + " ") < 0 && (i += r + " ");
                        n.className = lt.trim(i)
                    }
            return this
        },
        removeClass: function(e) {
            var t, n, i, r, o, a = 0,
                s = this.length,
                l = 0 === arguments.length || "string" == typeof e && e;
            if (lt.isFunction(e)) return this.each(function(t) {
                lt(this).removeClass(e.call(this, t, this.className))
            });
            if (l)
                for (t = (e || "").match(ut) || []; s > a; a++)
                    if (n = this[a], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(At, " ") : "")) {
                        for (o = 0; r = t[o++];)
                            for (; i.indexOf(" " + r + " ") >= 0;) i = i.replace(" " + r + " ", " ");
                        n.className = e ? lt.trim(i) : ""
                    }
            return this
        },
        toggleClass: function(e, t) {
            var n = typeof e,
                i = "boolean" == typeof t;
            return this.each(lt.isFunction(e) ? function(n) {
                lt(this).toggleClass(e.call(this, n, this.className, t), t)
            } : function() {
                if ("string" === n)
                    for (var r, o = 0, a = lt(this), s = t, l = e.match(ut) || []; r = l[o++];) s = i ? s : !a.hasClass(r), a[s ? "addClass" : "removeClass"](r);
                else(n === Q || "boolean" === n) && (this.className && lt._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : lt._data(this, "__className__") || "")
            })
        },
        hasClass: function(e) {
            for (var t = " " + e + " ", n = 0, i = this.length; i > n; n++)
                if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(At, " ").indexOf(t) >= 0) return !0;
            return !1
        },
        val: function(e) {
            var n, i, r, o = this[0]; {
                if (arguments.length) return r = lt.isFunction(e), this.each(function(n) {
                    var o, a = lt(this);
                    1 === this.nodeType && (o = r ? e.call(this, n, a.val()) : e, null == o ? o = "" : "number" == typeof o ? o += "" : lt.isArray(o) && (o = lt.map(o, function(e) {
                        return null == e ? "" : e + ""
                    })), i = lt.valHooks[this.type] || lt.valHooks[this.nodeName.toLowerCase()], i && "set" in i && i.set(this, o, "value") !== t || (this.value = o))
                });
                if (o) return i = lt.valHooks[o.type] || lt.valHooks[o.nodeName.toLowerCase()], i && "get" in i && (n = i.get(o, "value")) !== t ? n : (n = o.value, "string" == typeof n ? n.replace(Et, "") : null == n ? "" : n)
            }
        }
    }), lt.extend({
        valHooks: {
            option: {
                get: function(e) {
                    var t = e.attributes.value;
                    return !t || t.specified ? e.value : e.text
                }
            },
            select: {
                get: function(e) {
                    for (var t, n, i = e.options, r = e.selectedIndex, o = "select-one" === e.type || 0 > r, a = o ? null : [], s = o ? r + 1 : i.length, l = 0 > r ? s : o ? r : 0; s > l; l++)
                        if (n = i[l], !(!n.selected && l !== r || (lt.support.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && lt.nodeName(n.parentNode, "optgroup"))) {
                            if (t = lt(n).val(), o) return t;
                            a.push(t)
                        }
                    return a
                },
                set: function(e, t) {
                    var n = lt.makeArray(t);
                    return lt(e).find("option").each(function() {
                        this.selected = lt.inArray(lt(this).val(), n) >= 0
                    }), n.length || (e.selectedIndex = -1), n
                }
            }
        },
        attr: function(e, n, i) {
            var r, o, a, s = e.nodeType;
            if (e && 3 !== s && 8 !== s && 2 !== s) return typeof e.getAttribute === Q ? lt.prop(e, n, i) : (o = 1 !== s || !lt.isXMLDoc(e), o && (n = n.toLowerCase(), r = lt.attrHooks[n] || (Pt.test(n) ? $t : Tt)), i === t ? r && o && "get" in r && null !== (a = r.get(e, n)) ? a : (typeof e.getAttribute !== Q && (a = e.getAttribute(n)), null == a ? t : a) : null !== i ? r && o && "set" in r && (a = r.set(e, i, n)) !== t ? a : (e.setAttribute(n, i + ""), i) : void lt.removeAttr(e, n))
        },
        removeAttr: function(e, t) {
            var n, i, r = 0,
                o = t && t.match(ut);
            if (o && 1 === e.nodeType)
                for (; n = o[r++];) i = lt.propFix[n] || n, Pt.test(n) ? !jt && It.test(n) ? e[lt.camelCase("default-" + n)] = e[i] = !1 : e[i] = !1 : lt.attr(e, n, ""), e.removeAttribute(jt ? n : i)
        },
        attrHooks: {
            type: {
                set: function(e, t) {
                    if (!lt.support.radioValue && "radio" === t && lt.nodeName(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        },
        propFix: {
            tabindex: "tabIndex",
            readonly: "readOnly",
            "for": "htmlFor",
            "class": "className",
            maxlength: "maxLength",
            cellspacing: "cellSpacing",
            cellpadding: "cellPadding",
            rowspan: "rowSpan",
            colspan: "colSpan",
            usemap: "useMap",
            frameborder: "frameBorder",
            contenteditable: "contentEditable"
        },
        prop: function(e, n, i) {
            var r, o, a, s = e.nodeType;
            if (e && 3 !== s && 8 !== s && 2 !== s) return a = 1 !== s || !lt.isXMLDoc(e), a && (n = lt.propFix[n] || n, o = lt.propHooks[n]), i !== t ? o && "set" in o && (r = o.set(e, i, n)) !== t ? r : e[n] = i : o && "get" in o && null !== (r = o.get(e, n)) ? r : e[n]
        },
        propHooks: {
            tabIndex: {
                get: function(e) {
                    var n = e.getAttributeNode("tabindex");
                    return n && n.specified ? parseInt(n.value, 10) : Nt.test(e.nodeName) || Ot.test(e.nodeName) && e.href ? 0 : t
                }
            }
        }
    }), $t = {
        get: function(e, n) {
            var i = lt.prop(e, n),
                r = "boolean" == typeof i && e.getAttribute(n),
                o = "boolean" == typeof i ? Dt && jt ? null != r : It.test(n) ? e[lt.camelCase("default-" + n)] : !!r : e.getAttributeNode(n);
            return o && o.value !== !1 ? n.toLowerCase() : t
        },
        set: function(e, t, n) {
            return t === !1 ? lt.removeAttr(e, n) : Dt && jt || !It.test(n) ? e.setAttribute(!jt && lt.propFix[n] || n, n) : e[lt.camelCase("default-" + n)] = e[n] = !0, n
        }
    }, Dt && jt || (lt.attrHooks.value = {
        get: function(e, n) {
            var i = e.getAttributeNode(n);
            return lt.nodeName(e, "input") ? e.defaultValue : i && i.specified ? i.value : t
        },
        set: function(e, t, n) {
            return lt.nodeName(e, "input") ? void(e.defaultValue = t) : Tt && Tt.set(e, t, n)
        }
    }), jt || (Tt = lt.valHooks.button = {
        get: function(e, n) {
            var i = e.getAttributeNode(n);
            return i && ("id" === n || "name" === n || "coords" === n ? "" !== i.value : i.specified) ? i.value : t
        },
        set: function(e, n, i) {
            var r = e.getAttributeNode(i);
            return r || e.setAttributeNode(r = e.ownerDocument.createAttribute(i)), r.value = n += "", "value" === i || n === e.getAttribute(i) ? n : t
        }
    }, lt.attrHooks.contenteditable = {
        get: Tt.get,
        set: function(e, t, n) {
            Tt.set(e, "" === t ? !1 : t, n)
        }
    }, lt.each(["width", "height"], function(e, t) {
        lt.attrHooks[t] = lt.extend(lt.attrHooks[t], {
            set: function(e, n) {
                return "" === n ? (e.setAttribute(t, "auto"), n) : void 0
            }
        })
    })), lt.support.hrefNormalized || (lt.each(["href", "src", "width", "height"], function(e, n) {
        lt.attrHooks[n] = lt.extend(lt.attrHooks[n], {
            get: function(e) {
                var i = e.getAttribute(n, 2);
                return null == i ? t : i
            }
        })
    }), lt.each(["href", "src"], function(e, t) {
        lt.propHooks[t] = {
            get: function(e) {
                return e.getAttribute(t, 4)
            }
        }
    })), lt.support.style || (lt.attrHooks.style = {
        get: function(e) {
            return e.style.cssText || t
        },
        set: function(e, t) {
            return e.style.cssText = t + ""
        }
    }), lt.support.optSelected || (lt.propHooks.selected = lt.extend(lt.propHooks.selected, {
        get: function(e) {
            var t = e.parentNode;
            return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
        }
    })), lt.support.enctype || (lt.propFix.enctype = "encoding"), lt.support.checkOn || lt.each(["radio", "checkbox"], function() {
        lt.valHooks[this] = {
            get: function(e) {
                return null === e.getAttribute("value") ? "on" : e.value
            }
        }
    }), lt.each(["radio", "checkbox"], function() {
        lt.valHooks[this] = lt.extend(lt.valHooks[this], {
            set: function(e, t) {
                return lt.isArray(t) ? e.checked = lt.inArray(lt(e).val(), t) >= 0 : void 0
            }
        })
    });
    var Mt = /^(?:input|select|textarea)$/i,
        Ft = /^key/,
        Ht = /^(?:mouse|contextmenu)|click/,
        qt = /^(?:focusinfocus|focusoutblur)$/,
        Lt = /^([^.]*)(?:\.(.+)|)$/;
    lt.event = {
            global: {},
            add: function(e, n, i, r, o) {
                var a, s, l, c, u, d, p, f, h, g, m, v = lt._data(e);
                if (v) {
                    for (i.handler && (c = i, i = c.handler, o = c.selector), i.guid || (i.guid = lt.guid++), (s = v.events) || (s = v.events = {}), (d = v.handle) || (d = v.handle = function(e) {
                            return typeof lt === Q || e && lt.event.triggered === e.type ? t : lt.event.dispatch.apply(d.elem, arguments)
                        }, d.elem = e), n = (n || "").match(ut) || [""], l = n.length; l--;) a = Lt.exec(n[l]) || [], h = m = a[1], g = (a[2] || "").split(".").sort(), u = lt.event.special[h] || {}, h = (o ? u.delegateType : u.bindType) || h, u = lt.event.special[h] || {}, p = lt.extend({
                        type: h,
                        origType: m,
                        data: r,
                        handler: i,
                        guid: i.guid,
                        selector: o,
                        needsContext: o && lt.expr.match.needsContext.test(o),
                        namespace: g.join(".")
                    }, c), (f = s[h]) || (f = s[h] = [], f.delegateCount = 0, u.setup && u.setup.call(e, r, g, d) !== !1 || (e.addEventListener ? e.addEventListener(h, d, !1) : e.attachEvent && e.attachEvent("on" + h, d))), u.add && (u.add.call(e, p), p.handler.guid || (p.handler.guid = i.guid)), o ? f.splice(f.delegateCount++, 0, p) : f.push(p), lt.event.global[h] = !0;
                    e = null
                }
            },
            remove: function(e, t, n, i, r) {
                var o, a, s, l, c, u, d, p, f, h, g, m = lt.hasData(e) && lt._data(e);
                if (m && (u = m.events)) {
                    for (t = (t || "").match(ut) || [""], c = t.length; c--;)
                        if (s = Lt.exec(t[c]) || [], f = g = s[1], h = (s[2] || "").split(".").sort(), f) {
                            for (d = lt.event.special[f] || {}, f = (i ? d.delegateType : d.bindType) || f, p = u[f] || [], s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = o = p.length; o--;) a = p[o], !r && g !== a.origType || n && n.guid !== a.guid || s && !s.test(a.namespace) || i && i !== a.selector && ("**" !== i || !a.selector) || (p.splice(o, 1), a.selector && p.delegateCount--, d.remove && d.remove.call(e, a));
                            l && !p.length && (d.teardown && d.teardown.call(e, h, m.handle) !== !1 || lt.removeEvent(e, f, m.handle), delete u[f])
                        } else
                            for (f in u) lt.event.remove(e, f + t[c], n, i, !0);
                    lt.isEmptyObject(u) && (delete m.handle, lt._removeData(e, "events"))
                }
            },
            trigger: function(n, i, r, o) {
                var a, s, l, c, u, d, p, f = [r || X],
                    h = at.call(n, "type") ? n.type : n,
                    g = at.call(n, "namespace") ? n.namespace.split(".") : [];
                if (l = d = r = r || X, 3 !== r.nodeType && 8 !== r.nodeType && !qt.test(h + lt.event.triggered) && (h.indexOf(".") >= 0 && (g = h.split("."), h = g.shift(), g.sort()), s = h.indexOf(":") < 0 && "on" + h, n = n[lt.expando] ? n : new lt.Event(h, "object" == typeof n && n), n.isTrigger = !0, n.namespace = g.join("."), n.namespace_re = n.namespace ? new RegExp("(^|\\.)" + g.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, n.result = t, n.target || (n.target = r), i = null == i ? [n] : lt.makeArray(i, [n]), u = lt.event.special[h] || {}, o || !u.trigger || u.trigger.apply(r, i) !== !1)) {
                    if (!o && !u.noBubble && !lt.isWindow(r)) {
                        for (c = u.delegateType || h, qt.test(c + h) || (l = l.parentNode); l; l = l.parentNode) f.push(l), d = l;
                        d === (r.ownerDocument || X) && f.push(d.defaultView || d.parentWindow || e)
                    }
                    for (p = 0;
                        (l = f[p++]) && !n.isPropagationStopped();) n.type = p > 1 ? c : u.bindType || h, a = (lt._data(l, "events") || {})[n.type] && lt._data(l, "handle"), a && a.apply(l, i), a = s && l[s], a && lt.acceptData(l) && a.apply && a.apply(l, i) === !1 && n.preventDefault();
                    if (n.type = h, !(o || n.isDefaultPrevented() || u._default && u._default.apply(r.ownerDocument, i) !== !1 || "click" === h && lt.nodeName(r, "a") || !lt.acceptData(r) || !s || !r[h] || lt.isWindow(r))) {
                        d = r[s], d && (r[s] = null), lt.event.triggered = h;
                        try {
                            r[h]()
                        } catch (m) {}
                        lt.event.triggered = t, d && (r[s] = d)
                    }
                    return n.result
                }
            },
            dispatch: function(e) {
                e = lt.event.fix(e);
                var n, i, r, o, a, s = [],
                    l = it.call(arguments),
                    c = (lt._data(this, "events") || {})[e.type] || [],
                    u = lt.event.special[e.type] || {};
                if (l[0] = e, e.delegateTarget = this, !u.preDispatch || u.preDispatch.call(this, e) !== !1) {
                    for (s = lt.event.handlers.call(this, e, c), n = 0;
                        (o = s[n++]) && !e.isPropagationStopped();)
                        for (e.currentTarget = o.elem, a = 0;
                            (r = o.handlers[a++]) && !e.isImmediatePropagationStopped();)(!e.namespace_re || e.namespace_re.test(r.namespace)) && (e.handleObj = r, e.data = r.data, i = ((lt.event.special[r.origType] || {}).handle || r.handler).apply(o.elem, l), i !== t && (e.result = i) === !1 && (e.preventDefault(), e.stopPropagation()));
                    return u.postDispatch && u.postDispatch.call(this, e), e.result
                }
            },
            handlers: function(e, n) {
                var i, r, o, a, s = [],
                    l = n.delegateCount,
                    c = e.target;
                if (l && c.nodeType && (!e.button || "click" !== e.type))
                    for (; c != this; c = c.parentNode || this)
                        if (1 === c.nodeType && (c.disabled !== !0 || "click" !== e.type)) {
                            for (o = [], a = 0; l > a; a++) r = n[a], i = r.selector + " ", o[i] === t && (o[i] = r.needsContext ? lt(i, this).index(c) >= 0 : lt.find(i, this, null, [c]).length), o[i] && o.push(r);
                            o.length && s.push({
                                elem: c,
                                handlers: o
                            })
                        }
                return l < n.length && s.push({
                    elem: this,
                    handlers: n.slice(l)
                }), s
            },
            fix: function(e) {
                if (e[lt.expando]) return e;
                var t, n, i, r = e.type,
                    o = e,
                    a = this.fixHooks[r];
                for (a || (this.fixHooks[r] = a = Ht.test(r) ? this.mouseHooks : Ft.test(r) ? this.keyHooks : {}), i = a.props ? this.props.concat(a.props) : this.props, e = new lt.Event(o), t = i.length; t--;) n = i[t], e[n] = o[n];
                return e.target || (e.target = o.srcElement || X), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, a.filter ? a.filter(e, o) : e
            },
            props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "),
                filter: function(e, t) {
                    return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function(e, n) {
                    var i, r, o, a = n.button,
                        s = n.fromElement;
                    return null == e.pageX && null != n.clientX && (r = e.target.ownerDocument || X, o = r.documentElement, i = r.body, e.pageX = n.clientX + (o && o.scrollLeft || i && i.scrollLeft || 0) - (o && o.clientLeft || i && i.clientLeft || 0), e.pageY = n.clientY + (o && o.scrollTop || i && i.scrollTop || 0) - (o && o.clientTop || i && i.clientTop || 0)), !e.relatedTarget && s && (e.relatedTarget = s === e.target ? n.toElement : s), e.which || a === t || (e.which = 1 & a ? 1 : 2 & a ? 3 : 4 & a ? 2 : 0), e
                }
            },
            special: {
                load: {
                    noBubble: !0
                },
                click: {
                    trigger: function() {
                        return lt.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
                    }
                },
                focus: {
                    trigger: function() {
                        if (this !== X.activeElement && this.focus) try {
                            return this.focus(), !1
                        } catch (e) {}
                    },
                    delegateType: "focusin"
                },
                blur: {
                    trigger: function() {
                        return this === X.activeElement && this.blur ? (this.blur(), !1) : void 0
                    },
                    delegateType: "focusout"
                },
                beforeunload: {
                    postDispatch: function(e) {
                        e.result !== t && (e.originalEvent.returnValue = e.result)
                    }
                }
            },
            simulate: function(e, t, n, i) {
                var r = lt.extend(new lt.Event, n, {
                    type: e,
                    isSimulated: !0,
                    originalEvent: {}
                });
                i ? lt.event.trigger(r, null, t) : lt.event.dispatch.call(t, r), r.isDefaultPrevented() && n.preventDefault()
            }
        }, lt.removeEvent = X.removeEventListener ? function(e, t, n) {
            e.removeEventListener && e.removeEventListener(t, n, !1)
        } : function(e, t, n) {
            var i = "on" + t;
            e.detachEvent && (typeof e[i] === Q && (e[i] = null), e.detachEvent(i, n))
        }, lt.Event = function(e, t) {
            return this instanceof lt.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? l : c) : this.type = e, t && lt.extend(this, t), this.timeStamp = e && e.timeStamp || lt.now(), void(this[lt.expando] = !0)) : new lt.Event(e, t)
        }, lt.Event.prototype = {
            isDefaultPrevented: c,
            isPropagationStopped: c,
            isImmediatePropagationStopped: c,
            preventDefault: function() {
                var e = this.originalEvent;
                this.isDefaultPrevented = l, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
            },
            stopPropagation: function() {
                var e = this.originalEvent;
                this.isPropagationStopped = l, e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0)
            },
            stopImmediatePropagation: function() {
                this.isImmediatePropagationStopped = l, this.stopPropagation()
            }
        }, lt.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout"
        }, function(e, t) {
            lt.event.special[e] = {
                delegateType: t,
                bindType: t,
                handle: function(e) {
                    var n, i = this,
                        r = e.relatedTarget,
                        o = e.handleObj;
                    return (!r || r !== i && !lt.contains(i, r)) && (e.type = o.origType, n = o.handler.apply(this, arguments), e.type = t), n
                }
            }
        }), lt.support.submitBubbles || (lt.event.special.submit = {
            setup: function() {
                return lt.nodeName(this, "form") ? !1 : void lt.event.add(this, "click._submit keypress._submit", function(e) {
                    var n = e.target,
                        i = lt.nodeName(n, "input") || lt.nodeName(n, "button") ? n.form : t;
                    i && !lt._data(i, "submitBubbles") && (lt.event.add(i, "submit._submit", function(e) {
                        e._submit_bubble = !0
                    }), lt._data(i, "submitBubbles", !0))
                })
            },
            postDispatch: function(e) {
                e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && lt.event.simulate("submit", this.parentNode, e, !0))
            },
            teardown: function() {
                return lt.nodeName(this, "form") ? !1 : void lt.event.remove(this, "._submit")
            }
        }), lt.support.changeBubbles || (lt.event.special.change = {
            setup: function() {
                return Mt.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (lt.event.add(this, "propertychange._change", function(e) {
                    "checked" === e.originalEvent.propertyName && (this._just_changed = !0)
                }), lt.event.add(this, "click._change", function(e) {
                    this._just_changed && !e.isTrigger && (this._just_changed = !1), lt.event.simulate("change", this, e, !0)
                })), !1) : void lt.event.add(this, "beforeactivate._change", function(e) {
                    var t = e.target;
                    Mt.test(t.nodeName) && !lt._data(t, "changeBubbles") && (lt.event.add(t, "change._change", function(e) {
                        !this.parentNode || e.isSimulated || e.isTrigger || lt.event.simulate("change", this.parentNode, e, !0)
                    }), lt._data(t, "changeBubbles", !0))
                })
            },
            handle: function(e) {
                var t = e.target;
                return this !== t || e.isSimulated || e.isTrigger || "radio" !== t.type && "checkbox" !== t.type ? e.handleObj.handler.apply(this, arguments) : void 0
            },
            teardown: function() {
                return lt.event.remove(this, "._change"), !Mt.test(this.nodeName)
            }
        }), lt.support.focusinBubbles || lt.each({
            focus: "focusin",
            blur: "focusout"
        }, function(e, t) {
            var n = 0,
                i = function(e) {
                    lt.event.simulate(t, e.target, lt.event.fix(e), !0)
                };
            lt.event.special[t] = {
                setup: function() {
                    0 === n++ && X.addEventListener(e, i, !0)
                },
                teardown: function() {
                    0 === --n && X.removeEventListener(e, i, !0)
                }
            }
        }), lt.fn.extend({
            on: function(e, n, i, r, o) {
                var a, s;
                if ("object" == typeof e) {
                    "string" != typeof n && (i = i || n, n = t);
                    for (a in e) this.on(a, n, i, e[a], o);
                    return this
                }
                if (null == i && null == r ? (r = n, i = n = t) : null == r && ("string" == typeof n ? (r = i, i = t) : (r = i, i = n, n = t)), r === !1) r = c;
                else if (!r) return this;
                return 1 === o && (s = r, r = function(e) {
                    return lt().off(e), s.apply(this, arguments)
                }, r.guid = s.guid || (s.guid = lt.guid++)), this.each(function() {
                    lt.event.add(this, e, r, i, n)
                })
            },
            one: function(e, t, n, i) {
                return this.on(e, t, n, i, 1)
            },
            off: function(e, n, i) {
                var r, o;
                if (e && e.preventDefault && e.handleObj) return r = e.handleObj, lt(e.delegateTarget).off(r.namespace ? r.origType + "." + r.namespace : r.origType, r.selector, r.handler), this;
                if ("object" == typeof e) {
                    for (o in e) this.off(o, n, e[o]);
                    return this
                }
                return (n === !1 || "function" == typeof n) && (i = n, n = t), i === !1 && (i = c), this.each(function() {
                    lt.event.remove(this, e, i, n)
                })
            },
            bind: function(e, t, n) {
                return this.on(e, null, t, n)
            },
            unbind: function(e, t) {
                return this.off(e, null, t)
            },
            delegate: function(e, t, n, i) {
                return this.on(t, e, n, i)
            },
            undelegate: function(e, t, n) {
                return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
            },
            trigger: function(e, t) {
                return this.each(function() {
                    lt.event.trigger(e, t, this)
                })
            },
            triggerHandler: function(e, t) {
                var n = this[0];
                return n ? lt.event.trigger(e, t, n, !0) : void 0
            }
        }),
        function(e, t) {
            function n(e) {
                return ht.test(e + "")
            }

            function i() {
                var e, t = [];
                return e = function(n, i) {
                    return t.push(n += " ") > k.cacheLength && delete e[t.shift()], e[n] = i
                }
            }

            function r(e) {
                return e[q] = !0, e
            }

            function o(e) {
                var t = O.createElement("div");
                try {
                    return e(t)
                } catch (n) {
                    return !1
                } finally {
                    t = null
                }
            }

            function a(e, t, n, i) {
                var r, o, a, s, l, c, u, f, h, g;
                if ((t ? t.ownerDocument || t : L) !== O && N(t), t = t || O, n = n || [], !e || "string" != typeof e) return n;
                if (1 !== (s = t.nodeType) && 9 !== s) return [];
                if (!I && !i) {
                    if (r = gt.exec(e))
                        if (a = r[1]) {
                            if (9 === s) {
                                if (o = t.getElementById(a), !o || !o.parentNode) return n;
                                if (o.id === a) return n.push(o), n
                            } else if (t.ownerDocument && (o = t.ownerDocument.getElementById(a)) && F(t, o) && o.id === a) return n.push(o), n
                        } else {
                            if (r[2]) return Y.apply(n, J.call(t.getElementsByTagName(e), 0)), n;
                            if ((a = r[3]) && R.getByClassName && t.getElementsByClassName) return Y.apply(n, J.call(t.getElementsByClassName(a), 0)), n
                        }
                    if (R.qsa && !j.test(e)) {
                        if (u = !0, f = q, h = t, g = 9 === s && e, 1 === s && "object" !== t.nodeName.toLowerCase()) {
                            for (c = d(e), (u = t.getAttribute("id")) ? f = u.replace(yt, "\\$&") : t.setAttribute("id", f), f = "[id='" + f + "'] ", l = c.length; l--;) c[l] = f + p(c[l]);
                            h = ft.test(e) && t.parentNode || t, g = c.join(",")
                        }
                        if (g) try {
                            return Y.apply(n, J.call(h.querySelectorAll(g), 0)), n
                        } catch (m) {} finally {
                            u || t.removeAttribute("id")
                        }
                    }
                }
                return x(e.replace(at, "$1"), t, n, i)
            }

            function s(e, t) {
                var n = t && e,
                    i = n && (~t.sourceIndex || X) - (~e.sourceIndex || X);
                if (i) return i;
                if (n)
                    for (; n = n.nextSibling;)
                        if (n === t) return -1;
                return e ? 1 : -1
            }

            function l(e) {
                return function(t) {
                    var n = t.nodeName.toLowerCase();
                    return "input" === n && t.type === e
                }
            }

            function c(e) {
                return function(t) {
                    var n = t.nodeName.toLowerCase();
                    return ("input" === n || "button" === n) && t.type === e
                }
            }

            function u(e) {
                return r(function(t) {
                    return t = +t, r(function(n, i) {
                        for (var r, o = e([], n.length, t), a = o.length; a--;) n[r = o[a]] && (n[r] = !(i[r] = n[r]))
                    })
                })
            }

            function d(e, t) {
                var n, i, r, o, s, l, c, u = V[e + " "];
                if (u) return t ? 0 : u.slice(0);
                for (s = e, l = [], c = k.preFilter; s;) {
                    (!n || (i = st.exec(s))) && (i && (s = s.slice(i[0].length) || s), l.push(r = [])), n = !1, (i = ct.exec(s)) && (n = i.shift(), r.push({
                        value: n,
                        type: i[0].replace(at, " ")
                    }), s = s.slice(n.length));
                    for (o in k.filter) !(i = pt[o].exec(s)) || c[o] && !(i = c[o](i)) || (n = i.shift(), r.push({
                        value: n,
                        type: o,
                        matches: i
                    }), s = s.slice(n.length));
                    if (!n) break
                }
                return t ? s.length : s ? a.error(e) : V(e, l).slice(0)
            }

            function p(e) {
                for (var t = 0, n = e.length, i = ""; n > t; t++) i += e[t].value;
                return i
            }

            function f(e, t, n) {
                var i = t.dir,
                    r = n && "parentNode" === i,
                    o = B++;
                return t.first ? function(t, n, o) {
                    for (; t = t[i];)
                        if (1 === t.nodeType || r) return e(t, n, o)
                } : function(t, n, a) {
                    var s, l, c, u = W + " " + o;
                    if (a) {
                        for (; t = t[i];)
                            if ((1 === t.nodeType || r) && e(t, n, a)) return !0
                    } else
                        for (; t = t[i];)
                            if (1 === t.nodeType || r)
                                if (c = t[q] || (t[q] = {}), (l = c[i]) && l[0] === u) {
                                    if ((s = l[1]) === !0 || s === _) return s === !0
                                } else if (l = c[i] = [u], l[1] = e(t, n, a) || _, l[1] === !0) return !0
                }
            }

            function h(e) {
                return e.length > 1 ? function(t, n, i) {
                    for (var r = e.length; r--;)
                        if (!e[r](t, n, i)) return !1;
                    return !0
                } : e[0]
            }

            function g(e, t, n, i, r) {
                for (var o, a = [], s = 0, l = e.length, c = null != t; l > s; s++)(o = e[s]) && (!n || n(o, i, r)) && (a.push(o), c && t.push(s));
                return a
            }

            function m(e, t, n, i, o, a) {
                return i && !i[q] && (i = m(i)), o && !o[q] && (o = m(o, a)), r(function(r, a, s, l) {
                    var c, u, d, p = [],
                        f = [],
                        h = a.length,
                        m = r || b(t || "*", s.nodeType ? [s] : s, []),
                        v = !e || !r && t ? m : g(m, p, e, s, l),
                        y = n ? o || (r ? e : h || i) ? [] : a : v;
                    if (n && n(v, y, s, l), i)
                        for (c = g(y, f), i(c, [], s, l), u = c.length; u--;)(d = c[u]) && (y[f[u]] = !(v[f[u]] = d));
                    if (r) {
                        if (o || e) {
                            if (o) {
                                for (c = [], u = y.length; u--;)(d = y[u]) && c.push(v[u] = d);
                                o(null, y = [], c, l)
                            }
                            for (u = y.length; u--;)(d = y[u]) && (c = o ? Z.call(r, d) : p[u]) > -1 && (r[c] = !(a[c] = d))
                        }
                    } else y = g(y === a ? y.splice(h, y.length) : y), o ? o(null, a, y, l) : Y.apply(a, y)
                })
            }

            function v(e) {
                for (var t, n, i, r = e.length, o = k.relative[e[0].type], a = o || k.relative[" "], s = o ? 1 : 0, l = f(function(e) {
                        return e === t
                    }, a, !0), c = f(function(e) {
                        return Z.call(t, e) > -1
                    }, a, !0), u = [function(e, n, i) {
                        return !o && (i || n !== E) || ((t = n).nodeType ? l(e, n, i) : c(e, n, i))
                    }]; r > s; s++)
                    if (n = k.relative[e[s].type]) u = [f(h(u), n)];
                    else {
                        if (n = k.filter[e[s].type].apply(null, e[s].matches), n[q]) {
                            for (i = ++s; r > i && !k.relative[e[i].type]; i++);
                            return m(s > 1 && h(u), s > 1 && p(e.slice(0, s - 1)).replace(at, "$1"), n, i > s && v(e.slice(s, i)), r > i && v(e = e.slice(i)), r > i && p(e))
                        }
                        u.push(n)
                    }
                return h(u)
            }

            function y(e, t) {
                var n = 0,
                    i = t.length > 0,
                    o = e.length > 0,
                    s = function(r, s, l, c, u) {
                        var d, p, f, h = [],
                            m = 0,
                            v = "0",
                            y = r && [],
                            b = null != u,
                            x = E,
                            w = r || o && k.find.TAG("*", u && s.parentNode || s),
                            C = W += null == x ? 1 : Math.random() || .1;
                        for (b && (E = s !== O && s, _ = n); null != (d = w[v]); v++) {
                            if (o && d) {
                                for (p = 0; f = e[p++];)
                                    if (f(d, s, l)) {
                                        c.push(d);
                                        break
                                    }
                                b && (W = C, _ = ++n)
                            }
                            i && ((d = !f && d) && m--, r && y.push(d))
                        }
                        if (m += v, i && v !== m) {
                            for (p = 0; f = t[p++];) f(y, h, s, l);
                            if (r) {
                                if (m > 0)
                                    for (; v--;) y[v] || h[v] || (h[v] = G.call(c));
                                h = g(h)
                            }
                            Y.apply(c, h), b && !r && h.length > 0 && m + t.length > 1 && a.uniqueSort(c)
                        }
                        return b && (W = C, E = x), y
                    };
                return i ? r(s) : s
            }

            function b(e, t, n) {
                for (var i = 0, r = t.length; r > i; i++) a(e, t[i], n);
                return n
            }

            function x(e, t, n, i) {
                var r, o, a, s, l, c = d(e);
                if (!i && 1 === c.length) {
                    if (o = c[0] = c[0].slice(0), o.length > 2 && "ID" === (a = o[0]).type && 9 === t.nodeType && !I && k.relative[o[1].type]) {
                        if (t = k.find.ID(a.matches[0].replace(xt, wt), t)[0], !t) return n;
                        e = e.slice(o.shift().value.length)
                    }
                    for (r = pt.needsContext.test(e) ? 0 : o.length; r-- && (a = o[r], !k.relative[s = a.type]);)
                        if ((l = k.find[s]) && (i = l(a.matches[0].replace(xt, wt), ft.test(o[0].type) && t.parentNode || t))) {
                            if (o.splice(r, 1), e = i.length && p(o), !e) return Y.apply(n, J.call(i, 0)), n;
                            break
                        }
                }
                return $(e, c)(i, t, I, n, ft.test(e)), n
            }

            function w() {}
            var C, _, k, S, T, $, A, E, N, O, P, I, j, D, M, F, H, q = "sizzle" + -new Date,
                L = e.document,
                R = {},
                W = 0,
                B = 0,
                z = i(),
                V = i(),
                U = i(),
                Q = typeof t,
                X = 1 << 31,
                K = [],
                G = K.pop,
                Y = K.push,
                J = K.slice,
                Z = K.indexOf || function(e) {
                    for (var t = 0, n = this.length; n > t; t++)
                        if (this[t] === e) return t;
                    return -1
                },
                et = "[\\x20\\t\\r\\n\\f]",
                tt = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
                nt = tt.replace("w", "w#"),
                it = "([*^$|!~]?=)",
                rt = "\\[" + et + "*(" + tt + ")" + et + "*(?:" + it + et + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + nt + ")|)|)" + et + "*\\]",
                ot = ":(" + tt + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + rt.replace(3, 8) + ")*)|.*)\\)|)",
                at = new RegExp("^" + et + "+|((?:^|[^\\\\])(?:\\\\.)*)" + et + "+$", "g"),
                st = new RegExp("^" + et + "*," + et + "*"),
                ct = new RegExp("^" + et + "*([\\x20\\t\\r\\n\\f>+~])" + et + "*"),
                ut = new RegExp(ot),
                dt = new RegExp("^" + nt + "$"),
                pt = {
                    ID: new RegExp("^#(" + tt + ")"),
                    CLASS: new RegExp("^\\.(" + tt + ")"),
                    NAME: new RegExp("^\\[name=['\"]?(" + tt + ")['\"]?\\]"),
                    TAG: new RegExp("^(" + tt.replace("w", "w*") + ")"),
                    ATTR: new RegExp("^" + rt),
                    PSEUDO: new RegExp("^" + ot),
                    CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + et + "*(even|odd|(([+-]|)(\\d*)n|)" + et + "*(?:([+-]|)" + et + "*(\\d+)|))" + et + "*\\)|)", "i"),
                    needsContext: new RegExp("^" + et + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + et + "*((?:-\\d)?\\d*)" + et + "*\\)|)(?=[^-]|$)", "i")
                },
                ft = /[\x20\t\r\n\f]*[+~]/,
                ht = /^[^{]+\{\s*\[native code/,
                gt = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
                mt = /^(?:input|select|textarea|button)$/i,
                vt = /^h\d$/i,
                yt = /'|\\/g,
                bt = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,
                xt = /\\([\da-fA-F]{1,6}[\x20\t\r\n\f]?|.)/g,
                wt = function(e, t) {
                    var n = "0x" + t - 65536;
                    return n !== n ? t : 0 > n ? String.fromCharCode(n + 65536) : String.fromCharCode(n >> 10 | 55296, 1023 & n | 56320)
                };
            try {
                J.call(L.documentElement.childNodes, 0)[0].nodeType
            } catch (Ct) {
                J = function(e) {
                    for (var t, n = []; t = this[e++];) n.push(t);
                    return n
                }
            }
            T = a.isXML = function(e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return t ? "HTML" !== t.nodeName : !1
            }, N = a.setDocument = function(e) {
                var i = e ? e.ownerDocument || e : L;
                return i !== O && 9 === i.nodeType && i.documentElement ? (O = i, P = i.documentElement, I = T(i), R.tagNameNoComments = o(function(e) {
                    return e.appendChild(i.createComment("")), !e.getElementsByTagName("*").length
                }), R.attributes = o(function(e) {
                    e.innerHTML = "<select></select>";
                    var t = typeof e.lastChild.getAttribute("multiple");
                    return "boolean" !== t && "string" !== t
                }), R.getByClassName = o(function(e) {
                    return e.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", e.getElementsByClassName && e.getElementsByClassName("e").length ? (e.lastChild.className = "e", 2 === e.getElementsByClassName("e").length) : !1
                }), R.getByName = o(function(e) {
                    e.id = q + 0, e.innerHTML = "<a name='" + q + "'></a><div name='" + q + "'></div>", P.insertBefore(e, P.firstChild);
                    var t = i.getElementsByName && i.getElementsByName(q).length === 2 + i.getElementsByName(q + 0).length;
                    return R.getIdNotName = !i.getElementById(q), P.removeChild(e), t
                }), k.attrHandle = o(function(e) {
                    return e.innerHTML = "<a href='#'></a>", e.firstChild && typeof e.firstChild.getAttribute !== Q && "#" === e.firstChild.getAttribute("href")
                }) ? {} : {
                    href: function(e) {
                        return e.getAttribute("href", 2)
                    },
                    type: function(e) {
                        return e.getAttribute("type")
                    }
                }, R.getIdNotName ? (k.find.ID = function(e, t) {
                    if (typeof t.getElementById !== Q && !I) {
                        var n = t.getElementById(e);
                        return n && n.parentNode ? [n] : []
                    }
                }, k.filter.ID = function(e) {
                    var t = e.replace(xt, wt);
                    return function(e) {
                        return e.getAttribute("id") === t
                    }
                }) : (k.find.ID = function(e, n) {
                    if (typeof n.getElementById !== Q && !I) {
                        var i = n.getElementById(e);
                        return i ? i.id === e || typeof i.getAttributeNode !== Q && i.getAttributeNode("id").value === e ? [i] : t : []
                    }
                }, k.filter.ID = function(e) {
                    var t = e.replace(xt, wt);
                    return function(e) {
                        var n = typeof e.getAttributeNode !== Q && e.getAttributeNode("id");
                        return n && n.value === t
                    }
                }), k.find.TAG = R.tagNameNoComments ? function(e, t) {
                    return typeof t.getElementsByTagName !== Q ? t.getElementsByTagName(e) : void 0
                } : function(e, t) {
                    var n, i = [],
                        r = 0,
                        o = t.getElementsByTagName(e);
                    if ("*" === e) {
                        for (; n = o[r++];) 1 === n.nodeType && i.push(n);
                        return i
                    }
                    return o
                }, k.find.NAME = R.getByName && function(e, t) {
                    return typeof t.getElementsByName !== Q ? t.getElementsByName(name) : void 0
                }, k.find.CLASS = R.getByClassName && function(e, t) {
                    return typeof t.getElementsByClassName === Q || I ? void 0 : t.getElementsByClassName(e)
                }, D = [], j = [":focus"], (R.qsa = n(i.querySelectorAll)) && (o(function(e) {
                    e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || j.push("\\[" + et + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), e.querySelectorAll(":checked").length || j.push(":checked")
                }), o(function(e) {
                    e.innerHTML = "<input type='hidden' i=''/>", e.querySelectorAll("[i^='']").length && j.push("[*^$]=" + et + "*(?:\"\"|'')"), e.querySelectorAll(":enabled").length || j.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), j.push(",.*:")
                })), (R.matchesSelector = n(M = P.matchesSelector || P.mozMatchesSelector || P.webkitMatchesSelector || P.oMatchesSelector || P.msMatchesSelector)) && o(function(e) {
                    R.disconnectedMatch = M.call(e, "div"), M.call(e, "[s!='']:x"), D.push("!=", ot)
                }), j = new RegExp(j.join("|")), D = new RegExp(D.join("|")), F = n(P.contains) || P.compareDocumentPosition ? function(e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e,
                        i = t && t.parentNode;
                    return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
                } : function(e, t) {
                    if (t)
                        for (; t = t.parentNode;)
                            if (t === e) return !0;
                    return !1
                }, H = P.compareDocumentPosition ? function(e, t) {
                    var n;
                    return e === t ? (A = !0, 0) : (n = t.compareDocumentPosition && e.compareDocumentPosition && e.compareDocumentPosition(t)) ? 1 & n || e.parentNode && 11 === e.parentNode.nodeType ? e === i || F(L, e) ? -1 : t === i || F(L, t) ? 1 : 0 : 4 & n ? -1 : 1 : e.compareDocumentPosition ? -1 : 1
                } : function(e, t) {
                    var n, r = 0,
                        o = e.parentNode,
                        a = t.parentNode,
                        l = [e],
                        c = [t];
                    if (e === t) return A = !0, 0;
                    if (!o || !a) return e === i ? -1 : t === i ? 1 : o ? -1 : a ? 1 : 0;
                    if (o === a) return s(e, t);
                    for (n = e; n = n.parentNode;) l.unshift(n);
                    for (n = t; n = n.parentNode;) c.unshift(n);
                    for (; l[r] === c[r];) r++;
                    return r ? s(l[r], c[r]) : l[r] === L ? -1 : c[r] === L ? 1 : 0
                }, A = !1, [0, 0].sort(H), R.detectDuplicates = A, O) : O
            }, a.matches = function(e, t) {
                return a(e, null, null, t)
            }, a.matchesSelector = function(e, t) {
                if ((e.ownerDocument || e) !== O && N(e), t = t.replace(bt, "='$1']"), !(!R.matchesSelector || I || D && D.test(t) || j.test(t))) try {
                    var n = M.call(e, t);
                    if (n || R.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n
                } catch (i) {}
                return a(t, O, null, [e]).length > 0
            }, a.contains = function(e, t) {
                return (e.ownerDocument || e) !== O && N(e), F(e, t)
            }, a.attr = function(e, t) {
                var n;
                return (e.ownerDocument || e) !== O && N(e), I || (t = t.toLowerCase()), (n = k.attrHandle[t]) ? n(e) : I || R.attributes ? e.getAttribute(t) : ((n = e.getAttributeNode(t)) || e.getAttribute(t)) && e[t] === !0 ? t : n && n.specified ? n.value : null
            }, a.error = function(e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, a.uniqueSort = function(e) {
                var t, n = [],
                    i = 1,
                    r = 0;
                if (A = !R.detectDuplicates, e.sort(H), A) {
                    for (; t = e[i]; i++) t === e[i - 1] && (r = n.push(i));
                    for (; r--;) e.splice(n[r], 1)
                }
                return e
            }, S = a.getText = function(e) {
                var t, n = "",
                    i = 0,
                    r = e.nodeType;
                if (r) {
                    if (1 === r || 9 === r || 11 === r) {
                        if ("string" == typeof e.textContent) return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling) n += S(e)
                    } else if (3 === r || 4 === r) return e.nodeValue
                } else
                    for (; t = e[i]; i++) n += S(t);
                return n
            }, k = a.selectors = {
                cacheLength: 50,
                createPseudo: r,
                match: pt,
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(e) {
                        return e[1] = e[1].replace(xt, wt), e[3] = (e[4] || e[5] || "").replace(xt, wt), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    },
                    CHILD: function(e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || a.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && a.error(e[0]), e
                    },
                    PSEUDO: function(e) {
                        var t, n = !e[5] && e[2];
                        return pt.CHILD.test(e[0]) ? null : (e[4] ? e[2] = e[4] : n && ut.test(n) && (t = d(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(e) {
                        return "*" === e ? function() {
                            return !0
                        } : (e = e.replace(xt, wt).toLowerCase(), function(t) {
                            return t.nodeName && t.nodeName.toLowerCase() === e
                        })
                    },
                    CLASS: function(e) {
                        var t = z[e + " "];
                        return t || (t = new RegExp("(^|" + et + ")" + e + "(" + et + "|$)")) && z(e, function(e) {
                            return t.test(e.className || typeof e.getAttribute !== Q && e.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(e, t, n) {
                        return function(i) {
                            var r = a.attr(i, e);
                            return null == r ? "!=" === t : t ? (r += "", "=" === t ? r === n : "!=" === t ? r !== n : "^=" === t ? n && 0 === r.indexOf(n) : "*=" === t ? n && r.indexOf(n) > -1 : "$=" === t ? n && r.slice(-n.length) === n : "~=" === t ? (" " + r + " ").indexOf(n) > -1 : "|=" === t ? r === n || r.slice(0, n.length + 1) === n + "-" : !1) : !0
                        }
                    },
                    CHILD: function(e, t, n, i, r) {
                        var o = "nth" !== e.slice(0, 3),
                            a = "last" !== e.slice(-4),
                            s = "of-type" === t;
                        return 1 === i && 0 === r ? function(e) {
                            return !!e.parentNode
                        } : function(t, n, l) {
                            var c, u, d, p, f, h, g = o !== a ? "nextSibling" : "previousSibling",
                                m = t.parentNode,
                                v = s && t.nodeName.toLowerCase(),
                                y = !l && !s;
                            if (m) {
                                if (o) {
                                    for (; g;) {
                                        for (d = t; d = d[g];)
                                            if (s ? d.nodeName.toLowerCase() === v : 1 === d.nodeType) return !1;
                                        h = g = "only" === e && !h && "nextSibling"
                                    }
                                    return !0
                                }
                                if (h = [a ? m.firstChild : m.lastChild], a && y) {
                                    for (u = m[q] || (m[q] = {}), c = u[e] || [], f = c[0] === W && c[1], p = c[0] === W && c[2], d = f && m.childNodes[f]; d = ++f && d && d[g] || (p = f = 0) || h.pop();)
                                        if (1 === d.nodeType && ++p && d === t) {
                                            u[e] = [W, f, p];
                                            break
                                        }
                                } else if (y && (c = (t[q] || (t[q] = {}))[e]) && c[0] === W) p = c[1];
                                else
                                    for (;
                                        (d = ++f && d && d[g] || (p = f = 0) || h.pop()) && ((s ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) || !++p || (y && ((d[q] || (d[q] = {}))[e] = [W, p]), d !== t)););
                                return p -= r, p === i || p % i === 0 && p / i >= 0
                            }
                        }
                    },
                    PSEUDO: function(e, t) {
                        var n, i = k.pseudos[e] || k.setFilters[e.toLowerCase()] || a.error("unsupported pseudo: " + e);
                        return i[q] ? i(t) : i.length > 1 ? (n = [e, e, "", t], k.setFilters.hasOwnProperty(e.toLowerCase()) ? r(function(e, n) {
                            for (var r, o = i(e, t), a = o.length; a--;) r = Z.call(e, o[a]), e[r] = !(n[r] = o[a])
                        }) : function(e) {
                            return i(e, 0, n)
                        }) : i
                    }
                },
                pseudos: {
                    not: r(function(e) {
                        var t = [],
                            n = [],
                            i = $(e.replace(at, "$1"));
                        return i[q] ? r(function(e, t, n, r) {
                            for (var o, a = i(e, null, r, []), s = e.length; s--;)(o = a[s]) && (e[s] = !(t[s] = o))
                        }) : function(e, r, o) {
                            return t[0] = e, i(t, null, o, n), !n.pop()
                        }
                    }),
                    has: r(function(e) {
                        return function(t) {
                            return a(e, t).length > 0
                        }
                    }),
                    contains: r(function(e) {
                        return function(t) {
                            return (t.textContent || t.innerText || S(t)).indexOf(e) > -1
                        }
                    }),
                    lang: r(function(e) {
                        return dt.test(e || "") || a.error("unsupported lang: " + e), e = e.replace(xt, wt).toLowerCase(),
                            function(t) {
                                var n;
                                do
                                    if (n = I ? t.getAttribute("xml:lang") || t.getAttribute("lang") : t.lang) return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-");
                                while ((t = t.parentNode) && 1 === t.nodeType);
                                return !1
                            }
                    }),
                    target: function(t) {
                        var n = e.location && e.location.hash;
                        return n && n.slice(1) === t.id
                    },
                    root: function(e) {
                        return e === P
                    },
                    focus: function(e) {
                        return e === O.activeElement && (!O.hasFocus || O.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    },
                    enabled: function(e) {
                        return e.disabled === !1
                    },
                    disabled: function(e) {
                        return e.disabled === !0
                    },
                    checked: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    },
                    selected: function(e) {
                        return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                    },
                    empty: function(e) {
                        for (e = e.firstChild; e; e = e.nextSibling)
                            if (e.nodeName > "@" || 3 === e.nodeType || 4 === e.nodeType) return !1;
                        return !0
                    },
                    parent: function(e) {
                        return !k.pseudos.empty(e)
                    },
                    header: function(e) {
                        return vt.test(e.nodeName)
                    },
                    input: function(e) {
                        return mt.test(e.nodeName)
                    },
                    button: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    },
                    text: function(e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || t.toLowerCase() === e.type)
                    },
                    first: u(function() {
                        return [0]
                    }),
                    last: u(function(e, t) {
                        return [t - 1]
                    }),
                    eq: u(function(e, t, n) {
                        return [0 > n ? n + t : n]
                    }),
                    even: u(function(e, t) {
                        for (var n = 0; t > n; n += 2) e.push(n);
                        return e
                    }),
                    odd: u(function(e, t) {
                        for (var n = 1; t > n; n += 2) e.push(n);
                        return e
                    }),
                    lt: u(function(e, t, n) {
                        for (var i = 0 > n ? n + t : n; --i >= 0;) e.push(i);
                        return e
                    }),
                    gt: u(function(e, t, n) {
                        for (var i = 0 > n ? n + t : n; ++i < t;) e.push(i);
                        return e
                    })
                }
            };
            for (C in {
                    radio: !0,
                    checkbox: !0,
                    file: !0,
                    password: !0,
                    image: !0
                }) k.pseudos[C] = l(C);
            for (C in {
                    submit: !0,
                    reset: !0
                }) k.pseudos[C] = c(C);
            $ = a.compile = function(e, t) {
                var n, i = [],
                    r = [],
                    o = U[e + " "];
                if (!o) {
                    for (t || (t = d(e)), n = t.length; n--;) o = v(t[n]), o[q] ? i.push(o) : r.push(o);
                    o = U(e, y(r, i))
                }
                return o
            }, k.pseudos.nth = k.pseudos.eq, k.filters = w.prototype = k.pseudos, k.setFilters = new w, N(), a.attr = lt.attr, lt.find = a, lt.expr = a.selectors, lt.expr[":"] = lt.expr.pseudos, lt.unique = a.uniqueSort, lt.text = a.getText, lt.isXMLDoc = a.isXML, lt.contains = a.contains
        }(e);
    var Rt = /Until$/,
        Wt = /^(?:parents|prev(?:Until|All))/,
        Bt = /^.[^:#\[\.,]*$/,
        zt = lt.expr.match.needsContext,
        Vt = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };
    lt.fn.extend({
        find: function(e) {
            var t, n, i, r = this.length;
            if ("string" != typeof e) return i = this, this.pushStack(lt(e).filter(function() {
                for (t = 0; r > t; t++)
                    if (lt.contains(i[t], this)) return !0
            }));
            for (n = [], t = 0; r > t; t++) lt.find(e, this[t], n);
            return n = this.pushStack(r > 1 ? lt.unique(n) : n), n.selector = (this.selector ? this.selector + " " : "") + e, n
        },
        has: function(e) {
            var t, n = lt(e, this),
                i = n.length;
            return this.filter(function() {
                for (t = 0; i > t; t++)
                    if (lt.contains(this, n[t])) return !0
            })
        },
        not: function(e) {
            return this.pushStack(d(this, e, !1))
        },
        filter: function(e) {
            return this.pushStack(d(this, e, !0))
        },
        is: function(e) {
            return !!e && ("string" == typeof e ? zt.test(e) ? lt(e, this.context).index(this[0]) >= 0 : lt.filter(e, this).length > 0 : this.filter(e).length > 0)
        },
        closest: function(e, t) {
            for (var n, i = 0, r = this.length, o = [], a = zt.test(e) || "string" != typeof e ? lt(e, t || this.context) : 0; r > i; i++)
                for (n = this[i]; n && n.ownerDocument && n !== t && 11 !== n.nodeType;) {
                    if (a ? a.index(n) > -1 : lt.find.matchesSelector(n, e)) {
                        o.push(n);
                        break
                    }
                    n = n.parentNode
                }
            return this.pushStack(o.length > 1 ? lt.unique(o) : o)
        },
        index: function(e) {
            return e ? "string" == typeof e ? lt.inArray(this[0], lt(e)) : lt.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(e, t) {
            var n = "string" == typeof e ? lt(e, t) : lt.makeArray(e && e.nodeType ? [e] : e),
                i = lt.merge(this.get(), n);
            return this.pushStack(lt.unique(i))
        },
        addBack: function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), lt.fn.andSelf = lt.fn.addBack, lt.each({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function(e) {
            return lt.dir(e, "parentNode")
        },
        parentsUntil: function(e, t, n) {
            return lt.dir(e, "parentNode", n)
        },
        next: function(e) {
            return u(e, "nextSibling")
        },
        prev: function(e) {
            return u(e, "previousSibling")
        },
        nextAll: function(e) {
            return lt.dir(e, "nextSibling")
        },
        prevAll: function(e) {
            return lt.dir(e, "previousSibling")
        },
        nextUntil: function(e, t, n) {
            return lt.dir(e, "nextSibling", n)
        },
        prevUntil: function(e, t, n) {
            return lt.dir(e, "previousSibling", n)
        },
        siblings: function(e) {
            return lt.sibling((e.parentNode || {}).firstChild, e)
        },
        children: function(e) {
            return lt.sibling(e.firstChild)
        },
        contents: function(e) {
            return lt.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : lt.merge([], e.childNodes)
        }
    }, function(e, t) {
        lt.fn[e] = function(n, i) {
            var r = lt.map(this, t, n);
            return Rt.test(e) || (i = n), i && "string" == typeof i && (r = lt.filter(i, r)), r = this.length > 1 && !Vt[e] ? lt.unique(r) : r, this.length > 1 && Wt.test(e) && (r = r.reverse()), this.pushStack(r)
        }
    }), lt.extend({
        filter: function(e, t, n) {
            return n && (e = ":not(" + e + ")"), 1 === t.length ? lt.find.matchesSelector(t[0], e) ? [t[0]] : [] : lt.find.matches(e, t)
        },
        dir: function(e, n, i) {
            for (var r = [], o = e[n]; o && 9 !== o.nodeType && (i === t || 1 !== o.nodeType || !lt(o).is(i));) 1 === o.nodeType && r.push(o), o = o[n];
            return r
        },
        sibling: function(e, t) {
            for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
            return n
        }
    });
    var Ut = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        Qt = / jQuery\d+="(?:null|\d+)"/g,
        Xt = new RegExp("<(?:" + Ut + ")[\\s/>]", "i"),
        Kt = /^\s+/,
        Gt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        Yt = /<([\w:]+)/,
        Jt = /<tbody/i,
        Zt = /<|&#?\w+;/,
        en = /<(?:script|style|link)/i,
        tn = /^(?:checkbox|radio)$/i,
        nn = /checked\s*(?:[^=]|=\s*.checked.)/i,
        rn = /^$|\/(?:java|ecma)script/i,
        on = /^true\/(.*)/,
        an = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        sn = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: lt.support.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        },
        ln = p(X),
        cn = ln.appendChild(X.createElement("div"));
    sn.optgroup = sn.option, sn.tbody = sn.tfoot = sn.colgroup = sn.caption = sn.thead, sn.th = sn.td, lt.fn.extend({
        text: function(e) {
            return lt.access(this, function(e) {
                return e === t ? lt.text(this) : this.empty().append((this[0] && this[0].ownerDocument || X).createTextNode(e))
            }, null, e, arguments.length)
        },
        wrapAll: function(e) {
            if (lt.isFunction(e)) return this.each(function(t) {
                lt(this).wrapAll(e.call(this, t))
            });
            if (this[0]) {
                var t = lt(e, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && t.insertBefore(this[0]), t.map(function() {
                    for (var e = this; e.firstChild && 1 === e.firstChild.nodeType;) e = e.firstChild;
                    return e
                }).append(this)
            }
            return this
        },
        wrapInner: function(e) {
            return this.each(lt.isFunction(e) ? function(t) {
                lt(this).wrapInner(e.call(this, t))
            } : function() {
                var t = lt(this),
                    n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e)
            })
        },
        wrap: function(e) {
            var t = lt.isFunction(e);
            return this.each(function(n) {
                lt(this).wrapAll(t ? e.call(this, n) : e)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                lt.nodeName(this, "body") || lt(this).replaceWith(this.childNodes)
            }).end()
        },
        append: function() {
            return this.domManip(arguments, !0, function(e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.appendChild(e)
            })
        },
        prepend: function() {
            return this.domManip(arguments, !0, function(e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.insertBefore(e, this.firstChild)
            })
        },
        before: function() {
            return this.domManip(arguments, !1, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        },
        after: function() {
            return this.domManip(arguments, !1, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        },
        remove: function(e, t) {
            for (var n, i = 0; null != (n = this[i]); i++)(!e || lt.filter(e, [n]).length > 0) && (t || 1 !== n.nodeType || lt.cleanData(b(n)), n.parentNode && (t && lt.contains(n.ownerDocument, n) && m(b(n, "script")), n.parentNode.removeChild(n)));
            return this
        },
        empty: function() {
            for (var e, t = 0; null != (e = this[t]); t++) {
                for (1 === e.nodeType && lt.cleanData(b(e, !1)); e.firstChild;) e.removeChild(e.firstChild);
                e.options && lt.nodeName(e, "select") && (e.options.length = 0)
            }
            return this
        },
        clone: function(e, t) {
            return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function() {
                return lt.clone(this, e, t)
            })
        },
        html: function(e) {
            return lt.access(this, function(e) {
                var n = this[0] || {},
                    i = 0,
                    r = this.length;
                if (e === t) return 1 === n.nodeType ? n.innerHTML.replace(Qt, "") : t;
                if (!("string" != typeof e || en.test(e) || !lt.support.htmlSerialize && Xt.test(e) || !lt.support.leadingWhitespace && Kt.test(e) || sn[(Yt.exec(e) || ["", ""])[1].toLowerCase()])) {
                    e = e.replace(Gt, "<$1></$2>");
                    try {
                        for (; r > i; i++) n = this[i] || {}, 1 === n.nodeType && (lt.cleanData(b(n, !1)), n.innerHTML = e);
                        n = 0
                    } catch (o) {}
                }
                n && this.empty().append(e)
            }, null, e, arguments.length)
        },
        replaceWith: function(e) {
            var t = lt.isFunction(e);
            return t || "string" == typeof e || (e = lt(e).not(this).detach()), this.domManip([e], !0, function(e) {
                var t = this.nextSibling,
                    n = this.parentNode;
                n && (lt(this).remove(), n.insertBefore(e, t))
            })
        },
        detach: function(e) {
            return this.remove(e, !0)
        },
        domManip: function(e, n, i) {
            e = tt.apply([], e);
            var r, o, a, s, l, c, u = 0,
                d = this.length,
                p = this,
                m = d - 1,
                v = e[0],
                y = lt.isFunction(v);
            if (y || !(1 >= d || "string" != typeof v || lt.support.checkClone) && nn.test(v)) return this.each(function(r) {
                var o = p.eq(r);
                y && (e[0] = v.call(this, r, n ? o.html() : t)), o.domManip(e, n, i)
            });
            if (d && (c = lt.buildFragment(e, this[0].ownerDocument, !1, this), r = c.firstChild, 1 === c.childNodes.length && (c = r), r)) {
                for (n = n && lt.nodeName(r, "tr"), s = lt.map(b(c, "script"), h), a = s.length; d > u; u++) o = c, u !== m && (o = lt.clone(o, !0, !0), a && lt.merge(s, b(o, "script"))), i.call(n && lt.nodeName(this[u], "table") ? f(this[u], "tbody") : this[u], o, u);
                if (a)
                    for (l = s[s.length - 1].ownerDocument, lt.map(s, g), u = 0; a > u; u++) o = s[u], rn.test(o.type || "") && !lt._data(o, "globalEval") && lt.contains(l, o) && (o.src ? lt.ajax({
                        url: o.src,
                        type: "GET",
                        dataType: "script",
                        async: !1,
                        global: !1,
                        "throws": !0
                    }) : lt.globalEval((o.text || o.textContent || o.innerHTML || "").replace(an, "")));
                c = r = null
            }
            return this
        }
    }), lt.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(e, t) {
        lt.fn[e] = function(e) {
            for (var n, i = 0, r = [], o = lt(e), a = o.length - 1; a >= i; i++) n = i === a ? this : this.clone(!0), lt(o[i])[t](n), nt.apply(r, n.get());
            return this.pushStack(r)
        }
    }), lt.extend({
        clone: function(e, t, n) {
            var i, r, o, a, s, l = lt.contains(e.ownerDocument, e);
            if (lt.support.html5Clone || lt.isXMLDoc(e) || !Xt.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (cn.innerHTML = e.outerHTML, cn.removeChild(o = cn.firstChild)), !(lt.support.noCloneEvent && lt.support.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || lt.isXMLDoc(e)))
                for (i = b(o), s = b(e), a = 0; null != (r = s[a]); ++a) i[a] && y(r, i[a]);
            if (t)
                if (n)
                    for (s = s || b(e), i = i || b(o), a = 0; null != (r = s[a]); a++) v(r, i[a]);
                else v(e, o);
            return i = b(o, "script"), i.length > 0 && m(i, !l && b(e, "script")), i = s = r = null, o
        },
        buildFragment: function(e, t, n, i) {
            for (var r, o, a, s, l, c, u, d = e.length, f = p(t), h = [], g = 0; d > g; g++)
                if (o = e[g], o || 0 === o)
                    if ("object" === lt.type(o)) lt.merge(h, o.nodeType ? [o] : o);
                    else if (Zt.test(o)) {
                for (s = s || f.appendChild(t.createElement("div")), l = (Yt.exec(o) || ["", ""])[1].toLowerCase(), u = sn[l] || sn._default, s.innerHTML = u[1] + o.replace(Gt, "<$1></$2>") + u[2], r = u[0]; r--;) s = s.lastChild;
                if (!lt.support.leadingWhitespace && Kt.test(o) && h.push(t.createTextNode(Kt.exec(o)[0])), !lt.support.tbody)
                    for (o = "table" !== l || Jt.test(o) ? "<table>" !== u[1] || Jt.test(o) ? 0 : s : s.firstChild, r = o && o.childNodes.length; r--;) lt.nodeName(c = o.childNodes[r], "tbody") && !c.childNodes.length && o.removeChild(c);
                for (lt.merge(h, s.childNodes), s.textContent = ""; s.firstChild;) s.removeChild(s.firstChild);
                s = f.lastChild
            } else h.push(t.createTextNode(o));
            for (s && f.removeChild(s), lt.support.appendChecked || lt.grep(b(h, "input"), x), g = 0; o = h[g++];)
                if ((!i || -1 === lt.inArray(o, i)) && (a = lt.contains(o.ownerDocument, o), s = b(f.appendChild(o), "script"), a && m(s), n))
                    for (r = 0; o = s[r++];) rn.test(o.type || "") && n.push(o);
            return s = null, f
        },
        cleanData: function(e, t) {
            for (var n, i, r, o, a = 0, s = lt.expando, l = lt.cache, c = lt.support.deleteExpando, u = lt.event.special; null != (n = e[a]); a++)
                if ((t || lt.acceptData(n)) && (r = n[s], o = r && l[r])) {
                    if (o.events)
                        for (i in o.events) u[i] ? lt.event.remove(n, i) : lt.removeEvent(n, i, o.handle);
                    l[r] && (delete l[r], c ? delete n[s] : typeof n.removeAttribute !== Q ? n.removeAttribute(s) : n[s] = null, Z.push(r))
                }
        }
    });
    var un, dn, pn, fn = /alpha\([^)]*\)/i,
        hn = /opacity\s*=\s*([^)]*)/,
        gn = /^(top|right|bottom|left)$/,
        mn = /^(none|table(?!-c[ea]).+)/,
        vn = /^margin/,
        yn = new RegExp("^(" + ct + ")(.*)$", "i"),
        bn = new RegExp("^(" + ct + ")(?!px)[a-z%]+$", "i"),
        xn = new RegExp("^([+-])=(" + ct + ")", "i"),
        wn = {
            BODY: "block"
        },
        Cn = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        _n = {
            letterSpacing: 0,
            fontWeight: 400
        },
        kn = ["Top", "Right", "Bottom", "Left"],
        Sn = ["Webkit", "O", "Moz", "ms"];
    lt.fn.extend({
        css: function(e, n) {
            return lt.access(this, function(e, n, i) {
                var r, o, a = {},
                    s = 0;
                if (lt.isArray(n)) {
                    for (o = dn(e), r = n.length; r > s; s++) a[n[s]] = lt.css(e, n[s], !1, o);
                    return a
                }
                return i !== t ? lt.style(e, n, i) : lt.css(e, n)
            }, e, n, arguments.length > 1)
        },
        show: function() {
            return _(this, !0)
        },
        hide: function() {
            return _(this)
        },
        toggle: function(e) {
            var t = "boolean" == typeof e;
            return this.each(function() {
                (t ? e : C(this)) ? lt(this).show(): lt(this).hide()
            })
        }
    }), lt.extend({
        cssHooks: {
            opacity: {
                get: function(e, t) {
                    if (t) {
                        var n = pn(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            "float": lt.support.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function(e, n, i, r) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var o, a, s, l = lt.camelCase(n),
                    c = e.style;
                if (n = lt.cssProps[l] || (lt.cssProps[l] = w(c, l)), s = lt.cssHooks[n] || lt.cssHooks[l], i === t) return s && "get" in s && (o = s.get(e, !1, r)) !== t ? o : c[n];
                if (a = typeof i, "string" === a && (o = xn.exec(i)) && (i = (o[1] + 1) * o[2] + parseFloat(lt.css(e, n)), a = "number"), !(null == i || "number" === a && isNaN(i) || ("number" !== a || lt.cssNumber[l] || (i += "px"), lt.support.clearCloneStyle || "" !== i || 0 !== n.indexOf("background") || (c[n] = "inherit"), s && "set" in s && (i = s.set(e, i, r)) === t))) try {
                    c[n] = i
                } catch (u) {}
            }
        },
        css: function(e, n, i, r) {
            var o, a, s, l = lt.camelCase(n);
            return n = lt.cssProps[l] || (lt.cssProps[l] = w(e.style, l)), s = lt.cssHooks[n] || lt.cssHooks[l], s && "get" in s && (a = s.get(e, !0, i)), a === t && (a = pn(e, n, r)), "normal" === a && n in _n && (a = _n[n]), "" === i || i ? (o = parseFloat(a), i === !0 || lt.isNumeric(o) ? o || 0 : a) : a
        },
        swap: function(e, t, n, i) {
            var r, o, a = {};
            for (o in t) a[o] = e.style[o], e.style[o] = t[o];
            r = n.apply(e, i || []);
            for (o in t) e.style[o] = a[o];
            return r
        }
    }), e.getComputedStyle ? (dn = function(t) {
        return e.getComputedStyle(t, null)
    }, pn = function(e, n, i) {
        var r, o, a, s = i || dn(e),
            l = s ? s.getPropertyValue(n) || s[n] : t,
            c = e.style;
        return s && ("" !== l || lt.contains(e.ownerDocument, e) || (l = lt.style(e, n)), bn.test(l) && vn.test(n) && (r = c.width, o = c.minWidth, a = c.maxWidth, c.minWidth = c.maxWidth = c.width = l, l = s.width, c.width = r, c.minWidth = o, c.maxWidth = a)), l
    }) : X.documentElement.currentStyle && (dn = function(e) {
        return e.currentStyle
    }, pn = function(e, n, i) {
        var r, o, a, s = i || dn(e),
            l = s ? s[n] : t,
            c = e.style;
        return null == l && c && c[n] && (l = c[n]), bn.test(l) && !gn.test(n) && (r = c.left, o = e.runtimeStyle, a = o && o.left, a && (o.left = e.currentStyle.left), c.left = "fontSize" === n ? "1em" : l, l = c.pixelLeft + "px", c.left = r, a && (o.left = a)), "" === l ? "auto" : l
    }), lt.each(["height", "width"], function(e, t) {
        lt.cssHooks[t] = {
            get: function(e, n, i) {
                return n ? 0 === e.offsetWidth && mn.test(lt.css(e, "display")) ? lt.swap(e, Cn, function() {
                    return T(e, t, i)
                }) : T(e, t, i) : void 0
            },
            set: function(e, n, i) {
                var r = i && dn(e);
                return k(e, n, i ? S(e, t, i, lt.support.boxSizing && "border-box" === lt.css(e, "boxSizing", !1, r), r) : 0)
            }
        }
    }), lt.support.opacity || (lt.cssHooks.opacity = {
        get: function(e, t) {
            return hn.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
        },
        set: function(e, t) {
            var n = e.style,
                i = e.currentStyle,
                r = lt.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "",
                o = i && i.filter || n.filter || "";
            n.zoom = 1, (t >= 1 || "" === t) && "" === lt.trim(o.replace(fn, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === t || i && !i.filter) || (n.filter = fn.test(o) ? o.replace(fn, r) : o + " " + r)
        }
    }), lt(function() {
        lt.support.reliableMarginRight || (lt.cssHooks.marginRight = {
            get: function(e, t) {
                return t ? lt.swap(e, {
                    display: "inline-block"
                }, pn, [e, "marginRight"]) : void 0
            }
        }), !lt.support.pixelPosition && lt.fn.position && lt.each(["top", "left"], function(e, t) {
            lt.cssHooks[t] = {
                get: function(e, n) {
                    return n ? (n = pn(e, t), bn.test(n) ? lt(e).position()[t] + "px" : n) : void 0
                }
            }
        })
    }), lt.expr && lt.expr.filters && (lt.expr.filters.hidden = function(e) {
        return e.offsetWidth <= 0 && e.offsetHeight <= 0 || !lt.support.reliableHiddenOffsets && "none" === (e.style && e.style.display || lt.css(e, "display"))
    }, lt.expr.filters.visible = function(e) {
        return !lt.expr.filters.hidden(e)
    }), lt.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(e, t) {
        lt.cssHooks[e + t] = {
            expand: function(n) {
                for (var i = 0, r = {}, o = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++) r[e + kn[i] + t] = o[i] || o[i - 2] || o[0];
                return r
            }
        }, vn.test(e) || (lt.cssHooks[e + t].set = k)
    });
    var Tn = /%20/g,
        $n = /\[\]$/,
        An = /\r?\n/g,
        En = /^(?:submit|button|image|reset|file)$/i,
        Nn = /^(?:input|select|textarea|keygen)/i;
    lt.fn.extend({
        serialize: function() {
            return lt.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var e = lt.prop(this, "elements");
                return e ? lt.makeArray(e) : this
            }).filter(function() {
                var e = this.type;
                return this.name && !lt(this).is(":disabled") && Nn.test(this.nodeName) && !En.test(e) && (this.checked || !tn.test(e))
            }).map(function(e, t) {
                var n = lt(this).val();
                return null == n ? null : lt.isArray(n) ? lt.map(n, function(e) {
                    return {
                        name: t.name,
                        value: e.replace(An, "\r\n")
                    }
                }) : {
                    name: t.name,
                    value: n.replace(An, "\r\n")
                }
            }).get()
        }
    }), lt.param = function(e, n) {
        var i, r = [],
            o = function(e, t) {
                t = lt.isFunction(t) ? t() : null == t ? "" : t, r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
            };
        if (n === t && (n = lt.ajaxSettings && lt.ajaxSettings.traditional), lt.isArray(e) || e.jquery && !lt.isPlainObject(e)) lt.each(e, function() {
            o(this.name, this.value)
        });
        else
            for (i in e) E(i, e[i], n, o);
        return r.join("&").replace(Tn, "+")
    }, lt.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(e, t) {
        lt.fn[t] = function(e, n) {
            return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
        }
    }), lt.fn.hover = function(e, t) {
        return this.mouseenter(e).mouseleave(t || e)
    };
    var On, Pn, In = lt.now(),
        jn = /\?/,
        Dn = /#.*$/,
        Mn = /([?&])_=[^&]*/,
        Fn = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Hn = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        qn = /^(?:GET|HEAD)$/,
        Ln = /^\/\//,
        Rn = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
        Wn = lt.fn.load,
        Bn = {},
        zn = {},
        Vn = "*/".concat("*");
    try {
        Pn = K.href
    } catch (Un) {
        Pn = X.createElement("a"), Pn.href = "", Pn = Pn.href
    }
    On = Rn.exec(Pn.toLowerCase()) || [], lt.fn.load = function(e, n, i) {
        if ("string" != typeof e && Wn) return Wn.apply(this, arguments);
        var r, o, a, s = this,
            l = e.indexOf(" ");
        return l >= 0 && (r = e.slice(l, e.length), e = e.slice(0, l)), lt.isFunction(n) ? (i = n, n = t) : n && "object" == typeof n && (a = "POST"), s.length > 0 && lt.ajax({
            url: e,
            type: a,
            dataType: "html",
            data: n
        }).done(function(e) {
            o = arguments, s.html(r ? lt("<div>").append(lt.parseHTML(e)).find(r) : e)
        }).complete(i && function(e, t) {
            s.each(i, o || [e.responseText, t, e])
        }), this
    }, lt.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
        lt.fn[t] = function(e) {
            return this.on(t, e)
        }
    }), lt.each(["get", "post"], function(e, n) {
        lt[n] = function(e, i, r, o) {
            return lt.isFunction(i) && (o = o || r, r = i, i = t), lt.ajax({
                url: e,
                type: n,
                dataType: o,
                data: i,
                success: r
            })
        }
    }), lt.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Pn,
            type: "GET",
            isLocal: Hn.test(On[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Vn,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText"
            },
            converters: {
                "* text": e.String,
                "text html": !0,
                "text json": lt.parseJSON,
                "text xml": lt.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(e, t) {
            return t ? P(P(e, lt.ajaxSettings), t) : P(lt.ajaxSettings, e)
        },
        ajaxPrefilter: N(Bn),
        ajaxTransport: N(zn),
        ajax: function(e, n) {
            function i(e, n, i, r) {
                var o, d, y, b, w, _ = n;
                2 !== x && (x = 2, l && clearTimeout(l), u = t, s = r || "", C.readyState = e > 0 ? 4 : 0, i && (b = I(p, C, i)), e >= 200 && 300 > e || 304 === e ? (p.ifModified && (w = C.getResponseHeader("Last-Modified"), w && (lt.lastModified[a] = w), w = C.getResponseHeader("etag"), w && (lt.etag[a] = w)), 204 === e ? (o = !0, _ = "nocontent") : 304 === e ? (o = !0, _ = "notmodified") : (o = j(p, b), _ = o.state, d = o.data, y = o.error, o = !y)) : (y = _, (e || !_) && (_ = "error", 0 > e && (e = 0))), C.status = e, C.statusText = (n || _) + "", o ? g.resolveWith(f, [d, _, C]) : g.rejectWith(f, [C, _, y]), C.statusCode(v), v = t, c && h.trigger(o ? "ajaxSuccess" : "ajaxError", [C, p, o ? d : y]), m.fireWith(f, [C, _]), c && (h.trigger("ajaxComplete", [C, p]), --lt.active || lt.event.trigger("ajaxStop")))
            }
            "object" == typeof e && (n = e, e = t), n = n || {};
            var r, o, a, s, l, c, u, d, p = lt.ajaxSetup({}, n),
                f = p.context || p,
                h = p.context && (f.nodeType || f.jquery) ? lt(f) : lt.event,
                g = lt.Deferred(),
                m = lt.Callbacks("once memory"),
                v = p.statusCode || {},
                y = {},
                b = {},
                x = 0,
                w = "canceled",
                C = {
                    readyState: 0,
                    getResponseHeader: function(e) {
                        var t;
                        if (2 === x) {
                            if (!d)
                                for (d = {}; t = Fn.exec(s);) d[t[1].toLowerCase()] = t[2];
                            t = d[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function() {
                        return 2 === x ? s : null
                    },
                    setRequestHeader: function(e, t) {
                        var n = e.toLowerCase();
                        return x || (e = b[n] = b[n] || e, y[e] = t), this
                    },
                    overrideMimeType: function(e) {
                        return x || (p.mimeType = e), this
                    },
                    statusCode: function(e) {
                        var t;
                        if (e)
                            if (2 > x)
                                for (t in e) v[t] = [v[t], e[t]];
                            else C.always(e[C.status]);
                        return this
                    },
                    abort: function(e) {
                        var t = e || w;
                        return u && u.abort(t), i(0, t), this
                    }
                };
            if (g.promise(C).complete = m.add, C.success = C.done, C.error = C.fail, p.url = ((e || p.url || Pn) + "").replace(Dn, "").replace(Ln, On[1] + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = lt.trim(p.dataType || "*").toLowerCase().match(ut) || [""], null == p.crossDomain && (r = Rn.exec(p.url.toLowerCase()), p.crossDomain = !(!r || r[1] === On[1] && r[2] === On[2] && (r[3] || ("http:" === r[1] ? 80 : 443)) == (On[3] || ("http:" === On[1] ? 80 : 443)))), p.data && p.processData && "string" != typeof p.data && (p.data = lt.param(p.data, p.traditional)), O(Bn, p, n, C), 2 === x) return C;
            c = p.global, c && 0 === lt.active++ && lt.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !qn.test(p.type), a = p.url, p.hasContent || (p.data && (a = p.url += (jn.test(a) ? "&" : "?") + p.data, delete p.data), p.cache === !1 && (p.url = Mn.test(a) ? a.replace(Mn, "$1_=" + In++) : a + (jn.test(a) ? "&" : "?") + "_=" + In++)), p.ifModified && (lt.lastModified[a] && C.setRequestHeader("If-Modified-Since", lt.lastModified[a]), lt.etag[a] && C.setRequestHeader("If-None-Match", lt.etag[a])), (p.data && p.hasContent && p.contentType !== !1 || n.contentType) && C.setRequestHeader("Content-Type", p.contentType), C.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + Vn + "; q=0.01" : "") : p.accepts["*"]);
            for (o in p.headers) C.setRequestHeader(o, p.headers[o]);
            if (p.beforeSend && (p.beforeSend.call(f, C, p) === !1 || 2 === x)) return C.abort();
            w = "abort";
            for (o in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) C[o](p[o]);
            if (u = O(zn, p, n, C)) {
                C.readyState = 1, c && h.trigger("ajaxSend", [C, p]), p.async && p.timeout > 0 && (l = setTimeout(function() {
                    C.abort("timeout")
                }, p.timeout));
                try {
                    x = 1, u.send(y, i)
                } catch (_) {
                    if (!(2 > x)) throw _;
                    i(-1, _)
                }
            } else i(-1, "No Transport");
            return C
        },
        getScript: function(e, n) {
            return lt.get(e, t, n, "script")
        },
        getJSON: function(e, t, n) {
            return lt.get(e, t, n, "json")
        }
    }), lt.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function(e) {
                return lt.globalEval(e), e
            }
        }
    }), lt.ajaxPrefilter("script", function(e) {
        e.cache === t && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1)
    }), lt.ajaxTransport("script", function(e) {
        if (e.crossDomain) {
            var n, i = X.head || lt("head")[0] || X.documentElement;
            return {
                send: function(t, r) {
                    n = X.createElement("script"), n.async = !0, e.scriptCharset && (n.charset = e.scriptCharset), n.src = e.url, n.onload = n.onreadystatechange = function(e, t) {
                        (t || !n.readyState || /loaded|complete/.test(n.readyState)) && (n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n), n = null, t || r(200, "success"))
                    }, i.insertBefore(n, i.firstChild)
                },
                abort: function() {
                    n && n.onload(t, !0)
                }
            }
        }
    });
    var Qn = [],
        Xn = /(=)\?(?=&|$)|\?\?/;
    lt.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var e = Qn.pop() || lt.expando + "_" + In++;
            return this[e] = !0, e
        }
    }), lt.ajaxPrefilter("json jsonp", function(n, i, r) {
        var o, a, s, l = n.jsonp !== !1 && (Xn.test(n.url) ? "url" : "string" == typeof n.data && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && Xn.test(n.data) && "data");
        return l || "jsonp" === n.dataTypes[0] ? (o = n.jsonpCallback = lt.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, l ? n[l] = n[l].replace(Xn, "$1" + o) : n.jsonp !== !1 && (n.url += (jn.test(n.url) ? "&" : "?") + n.jsonp + "=" + o), n.converters["script json"] = function() {
            return s || lt.error(o + " was not called"), s[0]
        }, n.dataTypes[0] = "json", a = e[o], e[o] = function() {
            s = arguments
        }, r.always(function() {
            e[o] = a, n[o] && (n.jsonpCallback = i.jsonpCallback, Qn.push(o)), s && lt.isFunction(a) && a(s[0]), s = a = t
        }), "script") : void 0
    });
    var Kn, Gn, Yn = 0,
        Jn = e.ActiveXObject && function() {
            var e;
            for (e in Kn) Kn[e](t, !0)
        };
    lt.ajaxSettings.xhr = e.ActiveXObject ? function() {
        return !this.isLocal && D() || M()
    } : D, Gn = lt.ajaxSettings.xhr(), lt.support.cors = !!Gn && "withCredentials" in Gn, Gn = lt.support.ajax = !!Gn, Gn && lt.ajaxTransport(function(n) {
        if (!n.crossDomain || lt.support.cors) {
            var i;
            return {
                send: function(r, o) {
                    var a, s, l = n.xhr();
                    if (n.username ? l.open(n.type, n.url, n.async, n.username, n.password) : l.open(n.type, n.url, n.async), n.xhrFields)
                        for (s in n.xhrFields) l[s] = n.xhrFields[s];
                    n.mimeType && l.overrideMimeType && l.overrideMimeType(n.mimeType), n.crossDomain || r["X-Requested-With"] || (r["X-Requested-With"] = "XMLHttpRequest");
                    try {
                        for (s in r) l.setRequestHeader(s, r[s])
                    } catch (c) {}
                    l.send(n.hasContent && n.data || null), i = function(e, r) {
                        var s, c, u, d;
                        try {
                            if (i && (r || 4 === l.readyState))
                                if (i = t, a && (l.onreadystatechange = lt.noop, Jn && delete Kn[a]), r) 4 !== l.readyState && l.abort();
                                else {
                                    d = {}, s = l.status, c = l.getAllResponseHeaders(), "string" == typeof l.responseText && (d.text = l.responseText);
                                    try {
                                        u = l.statusText
                                    } catch (p) {
                                        u = ""
                                    }
                                    s || !n.isLocal || n.crossDomain ? 1223 === s && (s = 204) : s = d.text ? 200 : 404
                                }
                        } catch (f) {
                            r || o(-1, f)
                        }
                        d && o(s, u, d, c)
                    }, n.async ? 4 === l.readyState ? setTimeout(i) : (a = ++Yn, Jn && (Kn || (Kn = {}, lt(e).unload(Jn)), Kn[a] = i), l.onreadystatechange = i) : i()
                },
                abort: function() {
                    i && i(t, !0)
                }
            }
        }
    });
    var Zn, ei, ti = /^(?:toggle|show|hide)$/,
        ni = new RegExp("^(?:([+-])=|)(" + ct + ")([a-z%]*)$", "i"),
        ii = /queueHooks$/,
        ri = [R],
        oi = {
            "*": [function(e, t) {
                var n, i, r = this.createTween(e, t),
                    o = ni.exec(t),
                    a = r.cur(),
                    s = +a || 0,
                    l = 1,
                    c = 20;
                if (o) {
                    if (n = +o[2], i = o[3] || (lt.cssNumber[e] ? "" : "px"), "px" !== i && s) {
                        s = lt.css(r.elem, e, !0) || n || 1;
                        do l = l || ".5", s /= l, lt.style(r.elem, e, s + i); while (l !== (l = r.cur() / a) && 1 !== l && --c)
                    }
                    r.unit = i, r.start = s, r.end = o[1] ? s + (o[1] + 1) * n : n
                }
                return r
            }]
        };
    lt.Animation = lt.extend(q, {
        tweener: function(e, t) {
            lt.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
            for (var n, i = 0, r = e.length; r > i; i++) n = e[i], oi[n] = oi[n] || [], oi[n].unshift(t)
        },
        prefilter: function(e, t) {
            t ? ri.unshift(e) : ri.push(e)
        }
    }), lt.Tween = W, W.prototype = {
        constructor: W,
        init: function(e, t, n, i, r, o) {
            this.elem = e, this.prop = n, this.easing = r || "swing", this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = o || (lt.cssNumber[n] ? "" : "px")
        },
        cur: function() {
            var e = W.propHooks[this.prop];
            return e && e.get ? e.get(this) : W.propHooks._default.get(this)
        },
        run: function(e) {
            var t, n = W.propHooks[this.prop];
            return this.pos = t = this.options.duration ? lt.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : W.propHooks._default.set(this), this
        }
    }, W.prototype.init.prototype = W.prototype, W.propHooks = {
        _default: {
            get: function(e) {
                var t;
                return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = lt.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop]
            },
            set: function(e) {
                lt.fx.step[e.prop] ? lt.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[lt.cssProps[e.prop]] || lt.cssHooks[e.prop]) ? lt.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
            }
        }
    }, W.propHooks.scrollTop = W.propHooks.scrollLeft = {
        set: function(e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, lt.each(["toggle", "show", "hide"], function(e, t) {
        var n = lt.fn[t];
        lt.fn[t] = function(e, i, r) {
            return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(B(t, !0), e, i, r)
        }
    }), lt.fn.extend({
        fadeTo: function(e, t, n, i) {
            return this.filter(C).css("opacity", 0).show().end().animate({
                opacity: t
            }, e, n, i)
        },
        animate: function(e, t, n, i) {
            var r = lt.isEmptyObject(e),
                o = lt.speed(t, n, i),
                a = function() {
                    var t = q(this, lt.extend({}, e), o);
                    a.finish = function() {
                        t.stop(!0)
                    }, (r || lt._data(this, "finish")) && t.stop(!0)
                };
            return a.finish = a, r || o.queue === !1 ? this.each(a) : this.queue(o.queue, a)
        },
        stop: function(e, n, i) {
            var r = function(e) {
                var t = e.stop;
                delete e.stop, t(i)
            };
            return "string" != typeof e && (i = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function() {
                var t = !0,
                    n = null != e && e + "queueHooks",
                    o = lt.timers,
                    a = lt._data(this);
                if (n) a[n] && a[n].stop && r(a[n]);
                else
                    for (n in a) a[n] && a[n].stop && ii.test(n) && r(a[n]);
                for (n = o.length; n--;) o[n].elem !== this || null != e && o[n].queue !== e || (o[n].anim.stop(i), t = !1, o.splice(n, 1));
                (t || !i) && lt.dequeue(this, e)
            })
        },
        finish: function(e) {
            return e !== !1 && (e = e || "fx"), this.each(function() {
                var t, n = lt._data(this),
                    i = n[e + "queue"],
                    r = n[e + "queueHooks"],
                    o = lt.timers,
                    a = i ? i.length : 0;
                for (n.finish = !0, lt.queue(this, e, []), r && r.cur && r.cur.finish && r.cur.finish.call(this), t = o.length; t--;) o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
                for (t = 0; a > t; t++) i[t] && i[t].finish && i[t].finish.call(this);
                delete n.finish
            })
        }
    }), lt.each({
        slideDown: B("show"),
        slideUp: B("hide"),
        slideToggle: B("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function(e, t) {
        lt.fn[e] = function(e, n, i) {
            return this.animate(t, e, n, i)
        }
    }), lt.speed = function(e, t, n) {
        var i = e && "object" == typeof e ? lt.extend({}, e) : {
            complete: n || !n && t || lt.isFunction(e) && e,
            duration: e,
            easing: n && t || t && !lt.isFunction(t) && t
        };
        return i.duration = lt.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in lt.fx.speeds ? lt.fx.speeds[i.duration] : lt.fx.speeds._default, (null == i.queue || i.queue === !0) && (i.queue = "fx"), i.old = i.complete, i.complete = function() {
            lt.isFunction(i.old) && i.old.call(this), i.queue && lt.dequeue(this, i.queue)
        }, i
    }, lt.easing = {
        linear: function(e) {
            return e
        },
        swing: function(e) {
            return .5 - Math.cos(e * Math.PI) / 2
        }
    }, lt.timers = [], lt.fx = W.prototype.init, lt.fx.tick = function() {
        var e, n = lt.timers,
            i = 0;
        for (Zn = lt.now(); i < n.length; i++) e = n[i], e() || n[i] !== e || n.splice(i--, 1);
        n.length || lt.fx.stop(), Zn = t
    }, lt.fx.timer = function(e) {
        e() && lt.timers.push(e) && lt.fx.start()
    }, lt.fx.interval = 13, lt.fx.start = function() {
        ei || (ei = setInterval(lt.fx.tick, lt.fx.interval))
    }, lt.fx.stop = function() {
        clearInterval(ei), ei = null
    }, lt.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, lt.fx.step = {}, lt.expr && lt.expr.filters && (lt.expr.filters.animated = function(e) {
        return lt.grep(lt.timers, function(t) {
            return e === t.elem
        }).length
    }), lt.fn.offset = function(e) {
        if (arguments.length) return e === t ? this : this.each(function(t) {
            lt.offset.setOffset(this, e, t)
        });
        var n, i, r = {
                top: 0,
                left: 0
            },
            o = this[0],
            a = o && o.ownerDocument;
        if (a) return n = a.documentElement, lt.contains(n, o) ? (typeof o.getBoundingClientRect !== Q && (r = o.getBoundingClientRect()), i = z(a), {
            top: r.top + (i.pageYOffset || n.scrollTop) - (n.clientTop || 0),
            left: r.left + (i.pageXOffset || n.scrollLeft) - (n.clientLeft || 0)
        }) : r
    }, lt.offset = {
        setOffset: function(e, t, n) {
            var i = lt.css(e, "position");
            "static" === i && (e.style.position = "relative");
            var r, o, a = lt(e),
                s = a.offset(),
                l = lt.css(e, "top"),
                c = lt.css(e, "left"),
                u = ("absolute" === i || "fixed" === i) && lt.inArray("auto", [l, c]) > -1,
                d = {},
                p = {};
            u ? (p = a.position(), r = p.top, o = p.left) : (r = parseFloat(l) || 0, o = parseFloat(c) || 0), lt.isFunction(t) && (t = t.call(e, n, s)), null != t.top && (d.top = t.top - s.top + r), null != t.left && (d.left = t.left - s.left + o), "using" in t ? t.using.call(e, d) : a.css(d)
        }
    }, lt.fn.extend({
        position: function() {
            if (this[0]) {
                var e, t, n = {
                        top: 0,
                        left: 0
                    },
                    i = this[0];
                return "fixed" === lt.css(i, "position") ? t = i.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), lt.nodeName(e[0], "html") || (n = e.offset()), n.top += lt.css(e[0], "borderTopWidth", !0), n.left += lt.css(e[0], "borderLeftWidth", !0)), {
                    top: t.top - n.top - lt.css(i, "marginTop", !0),
                    left: t.left - n.left - lt.css(i, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var e = this.offsetParent || X.documentElement; e && !lt.nodeName(e, "html") && "static" === lt.css(e, "position");) e = e.offsetParent;
                return e || X.documentElement
            })
        }
    }), lt.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(e, n) {
        var i = /Y/.test(n);
        lt.fn[e] = function(r) {
            return lt.access(this, function(e, r, o) {
                var a = z(e);
                return o === t ? a ? n in a ? a[n] : a.document.documentElement[r] : e[r] : void(a ? a.scrollTo(i ? lt(a).scrollLeft() : o, i ? o : lt(a).scrollTop()) : e[r] = o)
            }, e, r, arguments.length, null)
        }
    }), lt.each({
        Height: "height",
        Width: "width"
    }, function(e, n) {
        lt.each({
            padding: "inner" + e,
            content: n,
            "": "outer" + e
        }, function(i, r) {
            lt.fn[r] = function(r, o) {
                var a = arguments.length && (i || "boolean" != typeof r),
                    s = i || (r === !0 || o === !0 ? "margin" : "border");
                return lt.access(this, function(n, i, r) {
                    var o;
                    return lt.isWindow(n) ? n.document.documentElement["client" + e] : 9 === n.nodeType ? (o = n.documentElement, Math.max(n.body["scroll" + e], o["scroll" + e], n.body["offset" + e], o["offset" + e], o["client" + e])) : r === t ? lt.css(n, i, s) : lt.style(n, i, r, s)
                }, n, a ? r : t, a, null)
            }
        })
    }), e.jQuery = e.$ = lt, "function" == typeof define && define.amd && define.amd.jQuery && define("jquery", [], function() {
        return lt
    })
}(window),
function() {
    this.I18n = {
        pluralize: function(e, t, n, i, r) {
            var o, a;
            return o = e % 10, a = e % 100, 1 === o && 11 !== a ? t : -1 !== $.inArray(o, [2, 3, 4]) && -1 === $.inArray(a, [12, 13, 14]) ? n : 0 === o || -1 !== $.inArray(o, [5, 6, 7, 8, 9]) || -1 !== $.inArray(a, [11, 12, 13, 14]) ? i : r
        },
        t: function(e, t) {
            var n;
            return null == t && (t = {}), n = I18n.translations[e], "object" == typeof n && void 0 !== t.count && (n = this.pluralize(t.count, n.one, n.few, n.many, n.other)), "string" == typeof n && $.each(t, function(e, t) {
                return n = n.replace(new RegExp("%{" + e + "}", "g"), t)
            }), n
        }
    }
}.call(this),
    function(e, t) {
        e.rails !== t && e.error("jquery-ujs has already been loaded!");
        var n, i = e(document);
        e.rails = n = {
            linkClickSelector: "a[data-confirm], a[data-method], a[data-remote], a[data-disable-with], a[data-disable]",
            buttonClickSelector: "button[data-remote]:not(form button), button[data-confirm]:not(form button)",
            inputChangeSelector: "select[data-remote], input[data-remote], textarea[data-remote]",
            formSubmitSelector: "form",
            formInputClickSelector: "form input[type=submit], form input[type=image], form button[type=submit], form button:not([type]), input[type=submit][form], input[type=image][form], button[type=submit][form], button[form]:not([type])",
            disableSelector: "input[data-disable-with]:enabled, button[data-disable-with]:enabled, textarea[data-disable-with]:enabled, input[data-disable]:enabled, button[data-disable]:enabled, textarea[data-disable]:enabled",
            enableSelector: "input[data-disable-with]:disabled, button[data-disable-with]:disabled, textarea[data-disable-with]:disabled, input[data-disable]:disabled, button[data-disable]:disabled, textarea[data-disable]:disabled",
            requiredInputSelector: "input[name][required]:not([disabled]),textarea[name][required]:not([disabled])",
            fileInputSelector: "input[type=file]",
            linkDisableSelector: "a[data-disable-with], a[data-disable]",
            buttonDisableSelector: "button[data-remote][data-disable-with], button[data-remote][data-disable]",
            CSRFProtection: function(t) {
                var n = e('meta[name="csrf-token"]').attr("content");
                n && t.setRequestHeader("X-CSRF-Token", n)
            },
            refreshCSRFTokens: function() {
                var t = e("meta[name=csrf-token]").attr("content"),
                    n = e("meta[name=csrf-param]").attr("content");
                e('form input[name="' + n + '"]').val(t)
            },
            fire: function(t, n, i) {
                var r = e.Event(n);
                return t.trigger(r, i), r.result !== !1
            },
            confirm: function(e) {
                return confirm(e)
            },
            ajax: function(t) {
                return e.ajax(t)
            },
            href: function(e) {
                return e.attr("href")
            },
            handleRemote: function(i) {
                var r, o, a, s, l, c, u, d;
                if (n.fire(i, "ajax:before")) {
                    if (s = i.data("cross-domain"), l = s === t ? null : s, c = i.data("with-credentials") || null, u = i.data("type") || e.ajaxSettings && e.ajaxSettings.dataType, i.is("form")) {
                        r = i.attr("method"), o = i.attr("action"), a = i.serializeArray();
                        var p = i.data("ujs:submit-button");
                        p && (a.push(p), i.data("ujs:submit-button", null))
                    } else i.is(n.inputChangeSelector) ? (r = i.data("method"), o = i.data("url"), a = i.serialize(), i.data("params") && (a = a + "&" + i.data("params"))) : i.is(n.buttonClickSelector) ? (r = i.data("method") || "get", o = i.data("url"), a = i.serialize(), i.data("params") && (a = a + "&" + i.data("params"))) : (r = i.data("method"), o = n.href(i), a = i.data("params") || null);
                    return d = {
                        type: r || "GET",
                        data: a,
                        dataType: u,
                        beforeSend: function(e, r) {
                            return r.dataType === t && e.setRequestHeader("accept", "*/*;q=0.5, " + r.accepts.script), n.fire(i, "ajax:beforeSend", [e, r]) ? void i.trigger("ajax:send", e) : !1
                        },
                        success: function(e, t, n) {
                            i.trigger("ajax:success", [e, t, n])
                        },
                        complete: function(e, t) {
                            i.trigger("ajax:complete", [e, t])
                        },
                        error: function(e, t, n) {
                            i.trigger("ajax:error", [e, t, n])
                        },
                        crossDomain: l
                    }, c && (d.xhrFields = {
                        withCredentials: c
                    }), o && (d.url = o), n.ajax(d)
                }
                return !1
            },
            handleMethod: function(i) {
                var r = n.href(i),
                    o = i.data("method"),
                    a = i.attr("target"),
                    s = e("meta[name=csrf-token]").attr("content"),
                    l = e("meta[name=csrf-param]").attr("content"),
                    c = e('<form method="post" action="' + r + '"></form>'),
                    u = '<input name="_method" value="' + o + '" type="hidden" />';
                l !== t && s !== t && (u += '<input name="' + l + '" value="' + s + '" type="hidden" />'), a && c.attr("target", a), c.hide().append(u).appendTo("body"), c.submit()
            },
            formElements: function(t, n) {
                return t.is("form") ? e(t[0].elements).filter(n) : t.find(n)
            },
            disableFormElements: function(t) {
                n.formElements(t, n.disableSelector).each(function() {
                    n.disableFormElement(e(this))
                })
            },
            disableFormElement: function(e) {
                var n, i;
                n = e.is("button") ? "html" : "val", i = e.data("disable-with"), e.data("ujs:enable-with", e[n]()), i !== t && e[n](i), e.prop("disabled", !0)
            },
            enableFormElements: function(t) {
                n.formElements(t, n.enableSelector).each(function() {
                    n.enableFormElement(e(this))
                })
            },
            enableFormElement: function(e) {
                var t = e.is("button") ? "html" : "val";
                e.data("ujs:enable-with") && e[t](e.data("ujs:enable-with")), e.prop("disabled", !1)
            },
            allowAction: function(e) {
                var t, i = e.data("confirm"),
                    r = !1;
                return i ? (n.fire(e, "confirm") && (r = n.confirm(i), t = n.fire(e, "confirm:complete", [r])), r && t) : !0
            },
            blankInputs: function(t, n, i) {
                var r, o, a = e(),
                    s = n || "input,textarea",
                    l = t.find(s);
                return l.each(function() {
                    if (r = e(this), o = r.is("input[type=checkbox],input[type=radio]") ? r.is(":checked") : r.val(), !o == !i) {
                        if (r.is("input[type=radio]") && l.filter('input[type=radio]:checked[name="' + r.attr("name") + '"]').length) return !0;
                        a = a.add(r)
                    }
                }), a.length ? a : !1
            },
            nonBlankInputs: function(e, t) {
                return n.blankInputs(e, t, !0)
            },
            stopEverything: function(t) {
                return e(t.target).trigger("ujs:everythingStopped"), t.stopImmediatePropagation(), !1
            },
            disableElement: function(e) {
                var i = e.data("disable-with");
                e.data("ujs:enable-with", e.html()), i !== t && e.html(i), e.bind("click.railsDisable", function(e) {
                    return n.stopEverything(e)
                })
            },
            enableElement: function(e) {
                e.data("ujs:enable-with") !== t && (e.html(e.data("ujs:enable-with")), e.removeData("ujs:enable-with")), e.unbind("click.railsDisable")
            }
        }, n.fire(i, "rails:attachBindings") && (e.ajaxPrefilter(function(e, t, i) {
            e.crossDomain || n.CSRFProtection(i)
        }), i.delegate(n.linkDisableSelector, "ajax:complete", function() {
            n.enableElement(e(this))
        }), i.delegate(n.buttonDisableSelector, "ajax:complete", function() {
            n.enableFormElement(e(this))
        }), i.delegate(n.linkClickSelector, "click.rails", function(i) {
            var r = e(this),
                o = r.data("method"),
                a = r.data("params"),
                s = i.metaKey || i.ctrlKey;
            if (!n.allowAction(r)) return n.stopEverything(i);
            if (!s && r.is(n.linkDisableSelector) && n.disableElement(r), r.data("remote") !== t) {
                if (s && (!o || "GET" === o) && !a) return !0;
                var l = n.handleRemote(r);
                return l === !1 ? n.enableElement(r) : l.error(function() {
                    n.enableElement(r)
                }), !1
            }
            return r.data("method") ? (n.handleMethod(r), !1) : void 0
        }), i.delegate(n.buttonClickSelector, "click.rails", function(t) {
            var i = e(this);
            if (!n.allowAction(i)) return n.stopEverything(t);
            i.is(n.buttonDisableSelector) && n.disableFormElement(i);
            var r = n.handleRemote(i);
            return r === !1 ? n.enableFormElement(i) : r.error(function() {
                n.enableFormElement(i)
            }), !1
        }), i.delegate(n.inputChangeSelector, "change.rails", function(t) {
            var i = e(this);
            return n.allowAction(i) ? (n.handleRemote(i), !1) : n.stopEverything(t)
        }), i.delegate(n.formSubmitSelector, "submit.rails", function(i) {
            var r, o, a = e(this),
                s = a.data("remote") !== t;
            if (!n.allowAction(a)) return n.stopEverything(i);
            if (a.attr("novalidate") == t && (r = n.blankInputs(a, n.requiredInputSelector), r && n.fire(a, "ajax:aborted:required", [r]))) return n.stopEverything(i);
            if (s) {
                if (o = n.nonBlankInputs(a, n.fileInputSelector)) {
                    setTimeout(function() {
                        n.disableFormElements(a)
                    }, 13);
                    var l = n.fire(a, "ajax:aborted:file", [o]);
                    return l || setTimeout(function() {
                        n.enableFormElements(a)
                    }, 13), l
                }
                return n.handleRemote(a), !1
            }
            setTimeout(function() {
                n.disableFormElements(a)
            }, 13)
        }), i.delegate(n.formInputClickSelector, "click.rails", function(t) {
            var i = e(this);
            if (!n.allowAction(i)) return n.stopEverything(t);
            var r = i.attr("name"),
                o = r ? {
                    name: r,
                    value: i.val()
                } : null;
            i.closest("form").data("ujs:submit-button", o)
        }), i.delegate(n.formSubmitSelector, "ajax:send.rails", function(t) {
            this == t.target && n.disableFormElements(e(this))
        }), i.delegate(n.formSubmitSelector, "ajax:complete.rails", function(t) {
            this == t.target && n.enableFormElements(e(this))
        }), e(function() {
            n.refreshCSRFTokens()
        }))
    }(jQuery), ! function(e) {
        e.flexslider = function(t, n) {
            var i = e(t);
            i.vars = e.extend({}, e.flexslider.defaults, n);
            var r, o = i.vars.namespace,
                a = window.navigator && window.navigator.msPointerEnabled && window.MSGesture,
                s = ("ontouchstart" in window || a || window.DocumentTouch && document instanceof DocumentTouch) && i.vars.touch,
                l = "click touchend MSPointerUp keyup",
                c = "",
                u = "vertical" === i.vars.direction,
                d = i.vars.reverse,
                p = i.vars.itemWidth > 0,
                f = "fade" === i.vars.animation,
                h = "" !== i.vars.asNavFor,
                g = {},
                m = !0;
            e.data(t, "flexslider", i), g = {
                init: function() {
                    i.animating = !1, i.currentSlide = parseInt(i.vars.startAt ? i.vars.startAt : 0, 10), isNaN(i.currentSlide) && (i.currentSlide = 0), i.animatingTo = i.currentSlide, i.atEnd = 0 === i.currentSlide || i.currentSlide === i.last, i.containerSelector = i.vars.selector.substr(0, i.vars.selector.search(" ")), i.slides = e(i.vars.selector, i), i.container = e(i.containerSelector, i), i.count = i.slides.length, i.syncExists = e(i.vars.sync).length > 0, "slide" === i.vars.animation && (i.vars.animation = "swing"), i.prop = u ? "top" : "marginLeft", i.args = {}, i.manualPause = !1, i.stopped = !1, i.started = !1, i.startTimeout = null, i.transitions = !i.vars.video && !f && i.vars.useCSS && function() {
                        var e = document.createElement("div"),
                            t = ["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                        for (var n in t)
                            if (void 0 !== e.style[t[n]]) return i.pfx = t[n].replace("Perspective", "").toLowerCase(), i.prop = "-" + i.pfx + "-transform", !0;
                        return !1
                    }(), i.ensureAnimationEnd = "", "" !== i.vars.controlsContainer && (i.controlsContainer = e(i.vars.controlsContainer).length > 0 && e(i.vars.controlsContainer)), "" !== i.vars.manualControls && (i.manualControls = e(i.vars.manualControls).length > 0 && e(i.vars.manualControls)), i.vars.randomize && (i.slides.sort(function() {
                        return Math.round(Math.random()) - .5
                    }), i.container.empty().append(i.slides)), i.doMath(), i.setup("init"), i.vars.controlNav && g.controlNav.setup(), i.vars.directionNav && g.directionNav.setup(), i.vars.keyboard && (1 === e(i.containerSelector).length || i.vars.multipleKeyboard) && e(document).bind("keyup", function(e) {
                        var t = e.keyCode;
                        if (!i.animating && (39 === t || 37 === t)) {
                            var n = 39 === t ? i.getTarget("next") : 37 === t ? i.getTarget("prev") : !1;
                            i.flexAnimate(n, i.vars.pauseOnAction)
                        }
                    }), i.vars.mousewheel && i.bind("mousewheel", function(e, t) {
                        e.preventDefault();
                        var n = i.getTarget(0 > t ? "next" : "prev");
                        i.flexAnimate(n, i.vars.pauseOnAction)
                    }), i.vars.pausePlay && g.pausePlay.setup(), i.vars.slideshow && i.vars.pauseInvisible && g.pauseInvisible.init(), i.vars.slideshow && (i.vars.pauseOnHover && i.hover(function() {
                        i.manualPlay || i.manualPause || i.pause()
                    }, function() {
                        i.manualPause || i.manualPlay || i.stopped || i.play()
                    }), i.vars.pauseInvisible && g.pauseInvisible.isHidden() || (i.vars.initDelay > 0 ? i.startTimeout = setTimeout(i.play, i.vars.initDelay) : i.play())), h && g.asNav.setup(), s && i.vars.touch && g.touch(), (!f || f && i.vars.smoothHeight) && e(window).bind("resize orientationchange focus", g.resize), i.find("img").attr("draggable", "false"), setTimeout(function() {
                        i.vars.start(i)
                    }, 200)
                },
                asNav: {
                    setup: function() {
                        i.asNav = !0, i.animatingTo = Math.floor(i.currentSlide / i.move), i.currentItem = i.currentSlide, i.slides.removeClass(o + "active-slide").eq(i.currentItem).addClass(o + "active-slide"), a ? (t._slider = i, i.slides.each(function() {
                            var t = this;
                            t._gesture = new MSGesture, t._gesture.target = t, t.addEventListener("MSPointerDown", function(e) {
                                e.preventDefault(), e.currentTarget._gesture && e.currentTarget._gesture.addPointer(e.pointerId)
                            }, !1), t.addEventListener("MSGestureTap", function(t) {
                                t.preventDefault();
                                var n = e(this),
                                    r = n.index();
                                e(i.vars.asNavFor).data("flexslider").animating || n.hasClass("active") || (i.direction = i.currentItem < r ? "next" : "prev", i.flexAnimate(r, i.vars.pauseOnAction, !1, !0, !0))
                            })
                        })) : i.slides.on(l, function(t) {
                            t.preventDefault();
                            var n = e(this),
                                r = n.index(),
                                a = n.offset().left - e(i).scrollLeft();
                            0 >= a && n.hasClass(o + "active-slide") ? i.flexAnimate(i.getTarget("prev"), !0) : e(i.vars.asNavFor).data("flexslider").animating || n.hasClass(o + "active-slide") || (i.direction = i.currentItem < r ? "next" : "prev", i.flexAnimate(r, i.vars.pauseOnAction, !1, !0, !0))
                        })
                    }
                },
                controlNav: {
                    setup: function() {
                        i.manualControls ? g.controlNav.setupManual() : g.controlNav.setupPaging()
                    },
                    setupPaging: function() {
                        var t, n, r = "thumbnails" === i.vars.controlNav ? "control-thumbs" : "control-paging",
                            a = 1;
                        if (i.controlNavScaffold = e('<ol class="' + o + "control-nav " + o + r + '"></ol>'), i.pagingCount > 1)
                            for (var s = 0; s < i.pagingCount; s++) {
                                if (n = i.slides.eq(s), t = "thumbnails" === i.vars.controlNav ? '<img src="' + n.attr("data-thumb") + '"/>' : "<a>" + a + "</a>", "thumbnails" === i.vars.controlNav && !0 === i.vars.thumbCaptions) {
                                    var u = n.attr("data-thumbcaption");
                                    "" != u && void 0 != u && (t += '<span class="' + o + 'caption">' + u + "</span>")
                                }
                                i.controlNavScaffold.append("<li>" + t + "</li>"), a++
                            }
                        i.controlsContainer ? e(i.controlsContainer).append(i.controlNavScaffold) : i.append(i.controlNavScaffold), g.controlNav.set(), g.controlNav.active(), i.controlNavScaffold.delegate("a, img", l, function(t) {
                            if (t.preventDefault(), "" === c || c === t.type) {
                                var n = e(this),
                                    r = i.controlNav.index(n);
                                n.hasClass(o + "active") || (i.direction = r > i.currentSlide ? "next" : "prev", i.flexAnimate(r, i.vars.pauseOnAction))
                            }
                            "" === c && (c = t.type), g.setToClearWatchedEvent()
                        })
                    },
                    setupManual: function() {
                        i.controlNav = i.manualControls, g.controlNav.active(), i.controlNav.bind(l, function(t) {
                            if (t.preventDefault(), "" === c || c === t.type) {
                                var n = e(this),
                                    r = i.controlNav.index(n);
                                n.hasClass(o + "active") || (i.direction = r > i.currentSlide ? "next" : "prev", i.flexAnimate(r, i.vars.pauseOnAction))
                            }
                            "" === c && (c = t.type), g.setToClearWatchedEvent()
                        })
                    },
                    set: function() {
                        var t = "thumbnails" === i.vars.controlNav ? "img" : "a";
                        i.controlNav = e("." + o + "control-nav li " + t, i.controlsContainer ? i.controlsContainer : i)
                    },
                    active: function() {
                        i.controlNav.removeClass(o + "active").eq(i.animatingTo).addClass(o + "active")
                    },
                    update: function(t, n) {
                        i.pagingCount > 1 && "add" === t ? i.controlNavScaffold.append(e("<li><a>" + i.count + "</a></li>")) : 1 === i.pagingCount ? i.controlNavScaffold.find("li").remove() : i.controlNav.eq(n).closest("li").remove(), g.controlNav.set(), i.pagingCount > 1 && i.pagingCount !== i.controlNav.length ? i.update(n, t) : g.controlNav.active()
                    }
                },
                directionNav: {
                    setup: function() {
                        var t = e('<ul class="' + o + 'direction-nav"><li class="' + o + 'nav-prev"><a class="' + o + 'prev" href="#">' + i.vars.prevText + '</a></li><li class="' + o + 'nav-next"><a class="' + o + 'next" href="#">' + i.vars.nextText + "</a></li></ul>");
                        i.controlsContainer ? (e(i.controlsContainer).append(t), i.directionNav = e("." + o + "direction-nav li a", i.controlsContainer)) : (i.append(t), i.directionNav = e("." + o + "direction-nav li a", i)), g.directionNav.update(), i.directionNav.bind(l, function(t) {
                            t.preventDefault();
                            var n;
                            ("" === c || c === t.type) && (n = i.getTarget(e(this).hasClass(o + "next") ? "next" : "prev"), i.flexAnimate(n, i.vars.pauseOnAction)), "" === c && (c = t.type), g.setToClearWatchedEvent()
                        })
                    },
                    update: function() {
                        var e = o + "disabled";
                        1 === i.pagingCount ? i.directionNav.addClass(e).attr("tabindex", "-1") : i.vars.animationLoop ? i.directionNav.removeClass(e).removeAttr("tabindex") : 0 === i.animatingTo ? i.directionNav.removeClass(e).filter("." + o + "prev").addClass(e).attr("tabindex", "-1") : i.animatingTo === i.last ? i.directionNav.removeClass(e).filter("." + o + "next").addClass(e).attr("tabindex", "-1") : i.directionNav.removeClass(e).removeAttr("tabindex")
                    }
                },
                pausePlay: {
                    setup: function() {
                        var t = e('<div class="' + o + 'pauseplay"><a></a></div>');
                        i.controlsContainer ? (i.controlsContainer.append(t), i.pausePlay = e("." + o + "pauseplay a", i.controlsContainer)) : (i.append(t), i.pausePlay = e("." + o + "pauseplay a", i)), g.pausePlay.update(i.vars.slideshow ? o + "pause" : o + "play"), i.pausePlay.bind(l, function(t) {
                            t.preventDefault(), ("" === c || c === t.type) && (e(this).hasClass(o + "pause") ? (i.manualPause = !0, i.manualPlay = !1, i.pause()) : (i.manualPause = !1, i.manualPlay = !0, i.play())), "" === c && (c = t.type), g.setToClearWatchedEvent()
                        })
                    },
                    update: function(e) {
                        "play" === e ? i.pausePlay.removeClass(o + "pause").addClass(o + "play").html(i.vars.playText) : i.pausePlay.removeClass(o + "play").addClass(o + "pause").html(i.vars.pauseText)
                    }
                },
                touch: function() {
                    function e(e) {
                        i.animating ? e.preventDefault() : (window.navigator.msPointerEnabled || 1 === e.touches.length) && (i.pause(), m = u ? i.h : i.w, y = Number(new Date), x = e.touches[0].pageX, w = e.touches[0].pageY, g = p && d && i.animatingTo === i.last ? 0 : p && d ? i.limit - (i.itemW + i.vars.itemMargin) * i.move * i.animatingTo : p && i.currentSlide === i.last ? i.limit : p ? (i.itemW + i.vars.itemMargin) * i.move * i.currentSlide : d ? (i.last - i.currentSlide + i.cloneOffset) * m : (i.currentSlide + i.cloneOffset) * m, c = u ? w : x, h = u ? x : w, t.addEventListener("touchmove", n, !1), t.addEventListener("touchend", r, !1))
                    }

                    function n(e) {
                        x = e.touches[0].pageX, w = e.touches[0].pageY, v = u ? c - w : c - x, b = u ? Math.abs(v) < Math.abs(x - h) : Math.abs(v) < Math.abs(w - h);
                        var t = 500;
                        (!b || Number(new Date) - y > t) && (e.preventDefault(), !f && i.transitions && (i.vars.animationLoop || (v /= 0 === i.currentSlide && 0 > v || i.currentSlide === i.last && v > 0 ? Math.abs(v) / m + 2 : 1), i.setProps(g + v, "setTouch")))
                    }

                    function r() {
                        if (t.removeEventListener("touchmove", n, !1), i.animatingTo === i.currentSlide && !b && null !== v) {
                            var e = d ? -v : v,
                                o = i.getTarget(e > 0 ? "next" : "prev");
                            i.canAdvance(o) && (Number(new Date) - y < 550 && Math.abs(e) > 50 || Math.abs(e) > m / 2) ? i.flexAnimate(o, i.vars.pauseOnAction) : f || i.flexAnimate(i.currentSlide, i.vars.pauseOnAction, !0)
                        }
                        t.removeEventListener("touchend", r, !1), c = null, h = null, v = null, g = null
                    }

                    function o(e) {
                        e.stopPropagation(), i.animating ? e.preventDefault() : (i.pause(), t._gesture.addPointer(e.pointerId), C = 0, m = u ? i.h : i.w, y = Number(new Date), g = p && d && i.animatingTo === i.last ? 0 : p && d ? i.limit - (i.itemW + i.vars.itemMargin) * i.move * i.animatingTo : p && i.currentSlide === i.last ? i.limit : p ? (i.itemW + i.vars.itemMargin) * i.move * i.currentSlide : d ? (i.last - i.currentSlide + i.cloneOffset) * m : (i.currentSlide + i.cloneOffset) * m)
                    }

                    function s(e) {
                        e.stopPropagation();
                        var n = e.target._slider;
                        if (n) {
                            var i = -e.translationX,
                                r = -e.translationY;
                            return C += u ? r : i, v = C, b = u ? Math.abs(C) < Math.abs(-i) : Math.abs(C) < Math.abs(-r), e.detail === e.MSGESTURE_FLAG_INERTIA ? void setImmediate(function() {
                                t._gesture.stop()
                            }) : void((!b || Number(new Date) - y > 500) && (e.preventDefault(), !f && n.transitions && (n.vars.animationLoop || (v = C / (0 === n.currentSlide && 0 > C || n.currentSlide === n.last && C > 0 ? Math.abs(C) / m + 2 : 1)), n.setProps(g + v, "setTouch"))))
                        }
                    }

                    function l(e) {
                        e.stopPropagation();
                        var t = e.target._slider;
                        if (t) {
                            if (t.animatingTo === t.currentSlide && !b && null !== v) {
                                var n = d ? -v : v,
                                    i = t.getTarget(n > 0 ? "next" : "prev");
                                t.canAdvance(i) && (Number(new Date) - y < 550 && Math.abs(n) > 50 || Math.abs(n) > m / 2) ? t.flexAnimate(i, t.vars.pauseOnAction) : f || t.flexAnimate(t.currentSlide, t.vars.pauseOnAction, !0)
                            }
                            c = null, h = null, v = null, g = null, C = 0
                        }
                    }
                    var c, h, g, m, v, y, b = !1,
                        x = 0,
                        w = 0,
                        C = 0;
                    a ? (t.style.msTouchAction = "none", t._gesture = new MSGesture, t._gesture.target = t, t.addEventListener("MSPointerDown", o, !1), t._slider = i, t.addEventListener("MSGestureChange", s, !1), t.addEventListener("MSGestureEnd", l, !1)) : t.addEventListener("touchstart", e, !1)
                },
                resize: function() {
                    !i.animating && i.is(":visible") && (p || i.doMath(), f ? g.smoothHeight() : p ? (i.slides.width(i.computedW), i.update(i.pagingCount), i.setProps()) : u ? (i.viewport.height(i.h), i.setProps(i.h, "setTotal")) : (i.vars.smoothHeight && g.smoothHeight(), i.newSlides.width(i.computedW), i.setProps(i.computedW, "setTotal")))
                },
                smoothHeight: function(e) {
                    if (!u || f) {
                        var t = f ? i : i.viewport;
                        e ? t.animate({
                            height: i.slides.eq(i.animatingTo).height()
                        }, e) : t.height(i.slides.eq(i.animatingTo).height())
                    }
                },
                sync: function(t) {
                    var n = e(i.vars.sync).data("flexslider"),
                        r = i.animatingTo;
                    switch (t) {
                        case "animate":
                            n.flexAnimate(r, i.vars.pauseOnAction, !1, !0);
                            break;
                        case "play":
                            n.playing || n.asNav || n.play();
                            break;
                        case "pause":
                            n.pause()
                    }
                },
                uniqueID: function(t) {
                    return t.filter("[id]").add(t.find("[id]")).each(function() {
                        var t = e(this);
                        t.attr("id", t.attr("id") + "_clone")
                    }), t
                },
                pauseInvisible: {
                    visProp: null,
                    init: function() {
                        var e = g.pauseInvisible.getHiddenProp();
                        if (e) {
                            var t = e.replace(/[H|h]idden/, "") + "visibilitychange";
                            document.addEventListener(t, function() {
                                g.pauseInvisible.isHidden() ? i.startTimeout ? clearTimeout(i.startTimeout) : i.pause() : i.started ? i.play() : i.vars.initDelay > 0 ? setTimeout(i.play, i.vars.initDelay) : i.play()
                            })
                        }
                    },
                    isHidden: function() {
                        var e = g.pauseInvisible.getHiddenProp();
                        return e ? document[e] : !1
                    },
                    getHiddenProp: function() {
                        var e = ["webkit", "moz", "ms", "o"];
                        if ("hidden" in document) return "hidden";
                        for (var t = 0; t < e.length; t++)
                            if (e[t] + "Hidden" in document) return e[t] + "Hidden";
                        return null
                    }
                },
                setToClearWatchedEvent: function() {
                    clearTimeout(r), r = setTimeout(function() {
                        c = ""
                    }, 3e3)
                }
            }, i.flexAnimate = function(t, n, r, a, l) {
                if (i.vars.animationLoop || t === i.currentSlide || (i.direction = t > i.currentSlide ? "next" : "prev"), h && 1 === i.pagingCount && (i.direction = i.currentItem < t ? "next" : "prev"), !i.animating && (i.canAdvance(t, l) || r) && i.is(":visible")) {
                    if (h && a) {
                        var c = e(i.vars.asNavFor).data("flexslider");
                        if (i.atEnd = 0 === t || t === i.count - 1, c.flexAnimate(t, !0, !1, !0, l), i.direction = i.currentItem < t ? "next" : "prev", c.direction = i.direction, Math.ceil((t + 1) / i.visible) - 1 === i.currentSlide || 0 === t) return i.currentItem = t, i.slides.removeClass(o + "active-slide").eq(t).addClass(o + "active-slide"), !1;
                        i.currentItem = t, i.slides.removeClass(o + "active-slide").eq(t).addClass(o + "active-slide"), t = Math.floor(t / i.visible)
                    }
                    if (i.animating = !0, i.animatingTo = t, n && i.pause(), i.vars.before(i), i.syncExists && !l && g.sync("animate"), i.vars.controlNav && g.controlNav.active(), p || i.slides.removeClass(o + "active-slide").eq(t).addClass(o + "active-slide"), i.atEnd = 0 === t || t === i.last, i.vars.directionNav && g.directionNav.update(), t === i.last && (i.vars.end(i), i.vars.animationLoop || i.pause()), f) s ? (i.slides.eq(i.currentSlide).css({
                        opacity: 0,
                        zIndex: 1
                    }), i.slides.eq(t).css({
                        opacity: 1,
                        zIndex: 2
                    }), i.wrapup(b)) : (i.slides.eq(i.currentSlide).css({
                        zIndex: 1
                    }).animate({
                        opacity: 0
                    }, i.vars.animationSpeed, i.vars.easing), i.slides.eq(t).css({
                        zIndex: 2
                    }).animate({
                        opacity: 1
                    }, i.vars.animationSpeed, i.vars.easing, i.wrapup));
                    else {
                        var m, v, y, b = u ? i.slides.filter(":first").height() : i.computedW;
                        p ? (m = i.vars.itemMargin, y = (i.itemW + m) * i.move * i.animatingTo, v = y > i.limit && 1 !== i.visible ? i.limit : y) : v = 0 === i.currentSlide && t === i.count - 1 && i.vars.animationLoop && "next" !== i.direction ? d ? (i.count + i.cloneOffset) * b : 0 : i.currentSlide === i.last && 0 === t && i.vars.animationLoop && "prev" !== i.direction ? d ? 0 : (i.count + 1) * b : d ? (i.count - 1 - t + i.cloneOffset) * b : (t + i.cloneOffset) * b, i.setProps(v, "", i.vars.animationSpeed), i.transitions ? (i.vars.animationLoop && i.atEnd || (i.animating = !1, i.currentSlide = i.animatingTo), i.container.unbind("webkitTransitionEnd transitionend"), i.container.bind("webkitTransitionEnd transitionend", function() {
                            clearTimeout(i.ensureAnimationEnd), i.wrapup(b)
                        }), clearTimeout(i.ensureAnimationEnd), i.ensureAnimationEnd = setTimeout(function() {
                            i.wrapup(b)
                        }, i.vars.animationSpeed + 100)) : i.container.animate(i.args, i.vars.animationSpeed, i.vars.easing, function() {
                            i.wrapup(b)
                        })
                    }
                    i.vars.smoothHeight && g.smoothHeight(i.vars.animationSpeed)
                }
            }, i.wrapup = function(e) {
                f || p || (0 === i.currentSlide && i.animatingTo === i.last && i.vars.animationLoop ? i.setProps(e, "jumpEnd") : i.currentSlide === i.last && 0 === i.animatingTo && i.vars.animationLoop && i.setProps(e, "jumpStart")), i.animating = !1, i.currentSlide = i.animatingTo, i.vars.after(i)
            }, i.animateSlides = function() {
                !i.animating && m && i.flexAnimate(i.getTarget("next"))
            }, i.pause = function() {
                clearInterval(i.animatedSlides), i.animatedSlides = null, i.playing = !1, i.vars.pausePlay && g.pausePlay.update("play"), i.syncExists && g.sync("pause")
            }, i.play = function() {
                i.playing && clearInterval(i.animatedSlides), i.animatedSlides = i.animatedSlides || setInterval(i.animateSlides, i.vars.slideshowSpeed), i.started = i.playing = !0, i.vars.pausePlay && g.pausePlay.update("pause"), i.syncExists && g.sync("play")
            }, i.stop = function() {
                i.pause(), i.stopped = !0
            }, i.canAdvance = function(e, t) {
                var n = h ? i.pagingCount - 1 : i.last;
                return t ? !0 : h && i.currentItem === i.count - 1 && 0 === e && "prev" === i.direction ? !0 : h && 0 === i.currentItem && e === i.pagingCount - 1 && "next" !== i.direction ? !1 : e !== i.currentSlide || h ? i.vars.animationLoop ? !0 : i.atEnd && 0 === i.currentSlide && e === n && "next" !== i.direction ? !1 : i.atEnd && i.currentSlide === n && 0 === e && "next" === i.direction ? !1 : !0 : !1
            }, i.getTarget = function(e) {
                return i.direction = e, "next" === e ? i.currentSlide === i.last ? 0 : i.currentSlide + 1 : 0 === i.currentSlide ? i.last : i.currentSlide - 1
            }, i.setProps = function(e, t, n) {
                var r = function() {
                    var n = e ? e : (i.itemW + i.vars.itemMargin) * i.move * i.animatingTo,
                        r = function() {
                            if (p) return "setTouch" === t ? e : d && i.animatingTo === i.last ? 0 : d ? i.limit - (i.itemW + i.vars.itemMargin) * i.move * i.animatingTo : i.animatingTo === i.last ? i.limit : n;
                            switch (t) {
                                case "setTotal":
                                    return d ? (i.count - 1 - i.currentSlide + i.cloneOffset) * e : (i.currentSlide + i.cloneOffset) * e;
                                case "setTouch":
                                    return d ? e : e;
                                case "jumpEnd":
                                    return d ? e : i.count * e;
                                case "jumpStart":
                                    return d ? i.count * e : e;
                                default:
                                    return e
                            }
                        }();
                    return -1 * r + "px"
                }();
                i.transitions && (r = u ? "translate3d(0," + r + ",0)" : "translate3d(" + r + ",0,0)", n = void 0 !== n ? n / 1e3 + "s" : "0s", i.container.css("-" + i.pfx + "-transition-duration", n), i.container.css("transition-duration", n)), i.args[i.prop] = r, (i.transitions || void 0 === n) && i.container.css(i.args), i.container.css("transform", r)
            }, i.setup = function(t) {
                if (f) i.slides.css({
                    width: "100%",
                    "float": "left",
                    marginRight: "-100%",
                    position: "relative"
                }), "init" === t && (s ? i.slides.css({
                    opacity: 0,
                    display: "block",
                    webkitTransition: "opacity " + i.vars.animationSpeed / 1e3 + "s ease",
                    zIndex: 1
                }).eq(i.currentSlide).css({
                    opacity: 1,
                    zIndex: 2
                }) : 0 == i.vars.fadeFirstSlide ? i.slides.css({
                    opacity: 0,
                    display: "block",
                    zIndex: 1
                }).eq(i.currentSlide).css({
                    zIndex: 2
                }).css({
                    opacity: 1
                }) : i.slides.css({
                    opacity: 0,
                    display: "block",
                    zIndex: 1
                }).eq(i.currentSlide).css({
                    zIndex: 2
                }).animate({
                    opacity: 1
                }, i.vars.animationSpeed, i.vars.easing)), i.vars.smoothHeight && g.smoothHeight();
                else {
                    var n, r;
                    "init" === t && (i.viewport = e('<div class="' + o + 'viewport"></div>').css({
                        overflow: "hidden",
                        position: "relative"
                    }).appendTo(i).append(i.container), i.cloneCount = 0, i.cloneOffset = 0, d && (r = e.makeArray(i.slides).reverse(), i.slides = e(r), i.container.empty().append(i.slides))), i.vars.animationLoop && !p && (i.cloneCount = 2, i.cloneOffset = 1, "init" !== t && i.container.find(".clone").remove(), i.container.append(g.uniqueID(i.slides.first().clone().addClass("clone")).attr("aria-hidden", "true")).prepend(g.uniqueID(i.slides.last().clone().addClass("clone")).attr("aria-hidden", "true"))), i.newSlides = e(i.vars.selector, i), n = d ? i.count - 1 - i.currentSlide + i.cloneOffset : i.currentSlide + i.cloneOffset, u && !p ? (i.container.height(200 * (i.count + i.cloneCount) + "%").css("position", "absolute").width("100%"), setTimeout(function() {
                        i.newSlides.css({
                            display: "block"
                        }), i.doMath(), i.viewport.height(i.h), i.setProps(n * i.h, "init")
                    }, "init" === t ? 100 : 0)) : (i.container.width(200 * (i.count + i.cloneCount) + "%"), i.setProps(n * i.computedW, "init"), setTimeout(function() {
                        i.doMath(), i.newSlides.css({
                            width: i.computedW,
                            "float": "left",
                            display: "block"
                        }), i.vars.smoothHeight && g.smoothHeight()
                    }, "init" === t ? 100 : 0))
                }
                p || i.slides.removeClass(o + "active-slide").eq(i.currentSlide).addClass(o + "active-slide"), i.vars.init(i)
            }, i.doMath = function() {
                var e = i.slides.first(),
                    t = i.vars.itemMargin,
                    n = i.vars.minItems,
                    r = i.vars.maxItems;
                i.w = void 0 === i.viewport ? i.width() : i.viewport.width(), i.h = e.height(), i.boxPadding = e.outerWidth() - e.width(), p ? (i.itemT = i.vars.itemWidth + t, i.minW = n ? n * i.itemT : i.w, i.maxW = r ? r * i.itemT - t : i.w, i.itemW = i.minW > i.w ? (i.w - t * (n - 1)) / n : i.maxW < i.w ? (i.w - t * (r - 1)) / r : i.vars.itemWidth > i.w ? i.w : i.vars.itemWidth, i.visible = Math.floor(i.w / i.itemW), i.move = i.vars.move > 0 && i.vars.move < i.visible ? i.vars.move : i.visible, i.pagingCount = Math.ceil((i.count - i.visible) / i.move + 1), i.last = i.pagingCount - 1, i.limit = 1 === i.pagingCount ? 0 : i.vars.itemWidth > i.w ? i.itemW * (i.count - 1) + t * (i.count - 1) : (i.itemW + t) * i.count - i.w - t) : (i.itemW = i.w, i.pagingCount = i.count, i.last = i.count - 1), i.computedW = i.itemW - i.boxPadding
            }, i.update = function(e, t) {
                i.doMath(), p || (e < i.currentSlide ? i.currentSlide += 1 : e <= i.currentSlide && 0 !== e && (i.currentSlide -= 1), i.animatingTo = i.currentSlide), i.vars.controlNav && !i.manualControls && ("add" === t && !p || i.pagingCount > i.controlNav.length ? g.controlNav.update("add") : ("remove" === t && !p || i.pagingCount < i.controlNav.length) && (p && i.currentSlide > i.last && (i.currentSlide -= 1, i.animatingTo -= 1), g.controlNav.update("remove", i.last))), i.vars.directionNav && g.directionNav.update()
            }, i.addSlide = function(t, n) {
                var r = e(t);
                i.count += 1, i.last = i.count - 1, u && d ? void 0 !== n ? i.slides.eq(i.count - n).after(r) : i.container.prepend(r) : void 0 !== n ? i.slides.eq(n).before(r) : i.container.append(r), i.update(n, "add"), i.slides = e(i.vars.selector + ":not(.clone)", i), i.setup(), i.vars.added(i)
            }, i.removeSlide = function(t) {
                var n = isNaN(t) ? i.slides.index(e(t)) : t;
                i.count -= 1, i.last = i.count - 1, isNaN(t) ? e(t, i.slides).remove() : u && d ? i.slides.eq(i.last).remove() : i.slides.eq(t).remove(), i.doMath(), i.update(n, "remove"), i.slides = e(i.vars.selector + ":not(.clone)", i), i.setup(), i.vars.removed(i)
            }, g.init()
        }, e(window).blur(function() {
            focused = !1
        }).focus(function() {
            focused = !0
        }), e.flexslider.defaults = {
            namespace: "flex-",
            selector: ".slides > li",
            animation: "fade",
            easing: "swing",
            direction: "horizontal",
            reverse: !1,
            animationLoop: !0,
            smoothHeight: !1,
            startAt: 0,
            slideshow: !0,
            slideshowSpeed: 7e3,
            animationSpeed: 600,
            initDelay: 0,
            randomize: !1,
            fadeFirstSlide: !0,
            thumbCaptions: !1,
            pauseOnAction: !0,
            pauseOnHover: !1,
            pauseInvisible: !0,
            useCSS: !0,
            touch: !0,
            video: !1,
            controlNav: !0,
            directionNav: !0,
            prevText: "Previous",
            nextText: "Next",
            keyboard: !0,
            multipleKeyboard: !1,
            mousewheel: !1,
            pausePlay: !1,
            pauseText: "Pause",
            playText: "Play",
            controlsContainer: "",
            manualControls: "",
            sync: "",
            asNavFor: "",
            itemWidth: 0,
            itemMargin: 0,
            minItems: 1,
            maxItems: 0,
            move: 0,
            allowOneSlide: !0,
            start: function() {},
            before: function() {},
            after: function() {},
            end: function() {},
            added: function() {},
            removed: function() {},
            init: function() {}
        }, e.fn.flexslider = function(t) {
            if (void 0 === t && (t = {}), "object" == typeof t) return this.each(function() {
                var n = e(this),
                    i = t.selector ? t.selector : ".slides > li",
                    r = n.find(i);
                1 === r.length && t.allowOneSlide === !0 || 0 === r.length ? (r.fadeIn(400), t.start && t.start(n)) : void 0 === n.data("flexslider") && new e.flexslider(this, t)
            });
            var n = e(this).data("flexslider");
            switch (t) {
                case "play":
                    n.play();
                    break;
                case "pause":
                    n.pause();
                    break;
                case "stop":
                    n.stop();
                    break;
                case "next":
                    n.flexAnimate(n.getTarget("next"), !0);
                    break;
                case "prev":
                case "previous":
                    n.flexAnimate(n.getTarget("prev"), !0);
                    break;
                default:
                    "number" == typeof t && n.flexAnimate(t, !0)
            }
        }
    }(jQuery),
    function(e, t) {
        "use strict";

        function n(t) {
            t = e.extend({}, O, t || {}), null === N && (N = e("body"));
            for (var n = e(this), r = 0, o = n.length; o > r; r++) i(n.eq(r), t);
            return n
        }

        function i(t, n) {
            if (!t.hasClass("selecter-element")) {
                n = e.extend({}, n, t.data("selecter-options")), n.external && (n.links = !0);
                var i = t.find("option, optgroup"),
                    a = i.filter("option"),
                    s = a.filter(":selected"),
                    c = s.length > 0 ? a.index(s) : 1,
                    u = "div";
                n.tabIndex = t[0].tabIndex, t[0].tabIndex = -1, n.multiple = t.prop("multiple"), n.disabled = t.is(":disabled");
                var m = "",
                    y = "";
                y += "<" + u + ' class="selecter ' + n.customClass, A ? y += " mobile" : n.cover && (y += " cover"), y += n.multiple ? " multiple" : " closed", n.disabled && (y += " disabled"), y += '" tabindex="' + n.tabIndex + '">', y += "</" + u + ">", n.multiple || (m += '<span class="selecter-selected' + ("" !== n.label ? " placeholder" : "") + '">', m += e("<span></span>").text(w("" !== s.text() ? s.text() : n.label, n.trim)).html(), m += "</span>"), m += '<div class="selecter-options">', m += "</div>", t.addClass("selecter-element").wrap(y).after(m);
                var b = t.parent(".selecter"),
                    x = e.extend({
                        $select: t,
                        $allOptions: i,
                        $options: a,
                        $selecter: b,
                        $selected: b.find(".selecter-selected"),
                        $itemsWrapper: b.find(".selecter-options"),
                        index: -1,
                        guid: S++
                    }, n);
                r(x), x.multiple || v(c, x), void 0 !== e.fn.scroller && x.$itemsWrapper.scroller(), x.$selecter.on("touchstart.selecter", ".selecter-selected", x, o).on("click.selecter", ".selecter-selected", x, l).on("click.selecter", ".selecter-item", x, p).on("close.selecter", x, d).data("selecter", x), x.$select.on("change.selecter", x, f), A || (x.$selecter.on("focus.selecter", x, h).on("blur.selecter", x, g), x.$select.on("focus.selecter", x, function(e) {
                    e.data.$selecter.trigger("focus")
                }))
            }
        }

        function r(t) {
            for (var n = "", i = t.links ? "a" : "span", r = 0, o = 0, a = t.$allOptions.length; a > o; o++) {
                var s = t.$allOptions.eq(o);
                if ("OPTGROUP" === s[0].tagName) n += '<span class="selecter-group', s.is(":disabled") && (n += " disabled"), n += '">' + s.attr("label") + "</span>";
                else {
                    var l = s.val();
                    s.attr("value") || s.attr("value", l), n += "<" + i + ' class="selecter-item', s.is(":selected") && (n += " selected"), s.is(":disabled") && (n += " disabled"), n += '" ', n += t.links ? 'href="' + l + '"' : 'data-value="' + l + '"', n += ">" + e("<span></span>").text(w(s.text(), t.trim)).html() + "</" + i + ">", r++
                }
            }
            t.$itemsWrapper.html(n), t.$items = t.$selecter.find(".selecter-item")
        }

        function o(e) {
            e.stopPropagation();
            var t = e.data,
                n = e.originalEvent;
            k(t.timer), t.touchStartX = n.touches[0].clientX, t.touchStartY = n.touches[0].clientY, t.$selecter.on("touchmove.selecter", ".selecter-selected", t, a).on("touchend.selecter", ".selecter-selected", t, s)
        }

        function a(e) {
            var t = e.data,
                n = e.originalEvent;
            (Math.abs(n.touches[0].clientX - t.touchStartX) > 10 || Math.abs(n.touches[0].clientY - t.touchStartY) > 10) && t.$selecter.off("touchmove.selecter touchend.selecter")
        }

        function s(e) {
            var t = e.data;
            t.$selecter.off("touchmove.selecter touchend.selecter click.selecter"), t.timer = _(t.timer, 1e3, function() {
                t.$selecter.on("click.selecter", ".selecter-selected", t, l)
            }), l(e)
        }

        function l(n) {
            n.preventDefault(), n.stopPropagation();
            var i = n.data;
            if (!i.$select.is(":disabled"))
                if (e(".selecter").not(i.$selecter).trigger("close.selecter", [i]), A && !E) {
                    var r = i.$select[0];
                    if (t.document.createEvent) {
                        var o = t.document.createEvent("MouseEvents");
                        o.initMouseEvent("mousedown", !1, !0, t, 0, 0, 0, 0, 0, !1, !1, !1, !1, 0, null), r.dispatchEvent(o)
                    } else r.fireEvent && r.fireEvent("onmousedown")
                } else i.$selecter.hasClass("closed") ? c(n) : i.$selecter.hasClass("open") && d(n)
        }

        function c(e) {
            e.preventDefault(), e.stopPropagation();
            var t = e.data;
            if (!t.$selecter.hasClass("open")) {
                {
                    var n = t.$selecter.offset(),
                        i = N.outerHeight(),
                        r = t.$itemsWrapper.outerHeight(!0);
                    t.index >= 0 ? t.$items.eq(t.index).position() : {
                        left: 0,
                        top: 0
                    }
                }
                n.top + r > i && t.$selecter.addClass("bottom"), t.$itemsWrapper.show(), t.$selecter.removeClass("closed").addClass("open"), N.on("click.selecter-" + t.guid, ":not(.selecter-options)", t, u), y(t)
            }
        }

        function u(t) {
            t.preventDefault(), t.stopPropagation(), 0 === e(t.currentTarget).parents(".selecter").length && d(t)
        }

        function d(e) {
            e.preventDefault(), e.stopPropagation();
            var t = e.data;
            t.$selecter.hasClass("open") && (t.$itemsWrapper.hide(), t.$selecter.removeClass("open bottom").addClass("closed"), N.off(".selecter-" + t.guid))
        }

        function p(t) {
            t.preventDefault(), t.stopPropagation();
            var n = e(this),
                i = t.data;
            if (!i.$select.is(":disabled")) {
                if (i.$itemsWrapper.is(":visible")) {
                    var r = i.$items.index(n);
                    r !== i.index && (v(r, i), b(i))
                }
                i.multiple || d(t)
            }
        }

        function f(t, n) {
            var i = e(this),
                r = t.data;
            if (!n && !r.multiple) {
                var o = r.$options.index(r.$options.filter("[value='" + C(i.val()) + "']"));
                v(o, r), b(r)
            }
        }

        function h(t) {
            t.preventDefault(), t.stopPropagation();
            var n = t.data;
            n.$select.is(":disabled") || n.multiple || (n.$selecter.addClass("focus").on("keydown.selecter-" + n.guid, n, m), e(".selecter").not(n.$selecter).trigger("close.selecter", [n]))
        }

        function g(t) {
            t.preventDefault(), t.stopPropagation();
            var n = t.data;
            n.$selecter.removeClass("focus").off("keydown.selecter-" + n.guid), e(".selecter").not(n.$selecter).trigger("close.selecter", [n])
        }

        function m(t) {
            var n = t.data;
            if (13 === t.keyCode) n.$selecter.hasClass("open") && (d(t), v(n.index, n)), b(n);
            else if (!(9 === t.keyCode || t.metaKey || t.altKey || t.ctrlKey || t.shiftKey)) {
                t.preventDefault(), t.stopPropagation();
                var i = n.$items.length - 1,
                    r = n.index < 0 ? 0 : n.index;
                if (e.inArray(t.keyCode, $ ? [38, 40, 37, 39] : [38, 40]) > -1) r += 38 === t.keyCode || $ && 37 === t.keyCode ? -1 : 1, 0 > r && (r = 0), r > i && (r = i);
                else {
                    var o, a, s = String.fromCharCode(t.keyCode).toUpperCase();
                    for (a = n.index + 1; i >= a; a++)
                        if (o = n.$options.eq(a).text().charAt(0).toUpperCase(), o === s) {
                            r = a;
                            break
                        }
                    if (0 > r || r === n.index)
                        for (a = 0; i >= a; a++)
                            if (o = n.$options.eq(a).text().charAt(0).toUpperCase(), o === s) {
                                r = a;
                                break
                            }
                }
                r >= 0 && (v(r, n), y(n))
            }
        }

        function v(e, t) {
            var n = t.$items.eq(e),
                i = n.hasClass("selected"),
                r = n.hasClass("disabled");
            if (!r) {
                if (-1 === e && "" !== t.label) t.$selected.html(t.label);
                else if (i) t.multiple && (t.$options.eq(e).prop("selected", null), n.removeClass("selected"));
                else {
                    {
                        var o = n.html();
                        n.data("value")
                    }
                    t.multiple ? t.$options.eq(e).prop("selected", !0) : (t.$selected.html(o).removeClass("placeholder"), t.$items.filter(".selected").removeClass("selected"), t.$select[0].selectedIndex = e), n.addClass("selected")
                }
                t.multiple || (t.index = e)
            }
        }

        function y(t) {
            var n = t.index >= 0 ? t.$items.eq(t.index).position() : {
                left: 0,
                top: 0
            };
            void 0 !== e.fn.scroller ? t.$itemsWrapper.scroller("scroll", t.$itemsWrapper.find(".scroller-content").scrollTop() + n.top, 0).scroller("reset") : t.$itemsWrapper.scrollTop(t.$itemsWrapper.scrollTop() + n.top)
        }

        function b(e) {
            e.links ? x(e) : (e.callback.call(e.$selecter, e.$select.val(), e.index), e.$select.trigger("change", [!0]))
        }

        function x(e) {
            var n = e.$select.val();
            e.external ? t.open(n) : t.location.href = n
        }

        function w(e, t) {
            return 0 === t ? e : e.length > t ? e.substring(0, t) + "..." : e
        }

        function C(e) {
            return "string" == typeof e ? e.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, "\\$1") : e
        }

        function _(e, t, n, i) {
            return k(e, i), i === !0 ? setInterval(n, t) : setTimeout(n, t)
        }

        function k(e) {
            null !== e && (clearInterval(e), e = null)
        }
        var S = 0,
            T = t.navigator.userAgent || t.navigator.vendor || t.opera,
            $ = /Firefox/i.test(T),
            A = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(T),
            E = $ && A,
            N = null,
            O = {
                callback: e.noop,
                cover: !1,
                customClass: "",
                label: "",
                external: !1,
                links: !1,
                trim: 0
            },
            P = {
                defaults: function(t) {
                    return O = e.extend(O, t || {}), e(this)
                },
                disable: function(t) {
                    return e(this).each(function(n, i) {
                        var r = e(i).next(".selecter").data("selecter");
                        if (r)
                            if ("undefined" != typeof t) {
                                var o = r.$items.index(r.$items.filter("[data-value=" + t + "]"));
                                r.$items.eq(o).addClass("disabled"), r.$options.eq(o).prop("disabled", !0)
                            } else r.$selecter.hasClass("open") && r.$selecter.find(".selecter-selected").trigger("click.selecter"), r.$selecter.addClass("disabled"), r.$select.prop("disabled", !0)
                    })
                },
                enable: function(t) {
                    return e(this).each(function(n, i) {
                        var r = e(i).next(".selecter").data("selecter");
                        if (r)
                            if ("undefined" != typeof t) {
                                var o = r.$items.index(r.$items.filter("[data-value=" + t + "]"));
                                r.$items.eq(o).removeClass("disabled"), r.$options.eq(o).prop("disabled", !1)
                            } else r.$selecter.removeClass("disabled"), r.$select.prop("disabled", !1)
                    })
                },
                destroy: function() {
                    return e(this).each(function(t, n) {
                        var i = e(n).next(".selecter").data("selecter");
                        i && (i.$selecter.hasClass("open") && i.$selecter.find(".selecter-selected").trigger("click.selecter"), void 0 !== e.fn.scroller && i.$selecter.find(".selecter-options").scroller("destroy"), i.$select[0].tabIndex = i.tabIndex, i.$select.off(".selecter").removeClass("selecter-element").show(), i.$selecter.off(".selecter").remove())
                    })
                },
                refresh: function() {
                    return e(this).each(function(t, n) {
                        var i = e(n).next(".selecter").data("selecter");
                        if (i) {
                            var o = i.index;
                            i.$allOptions = i.$select.find("option, optgroup"), i.$options = i.$allOptions.filter("option"), i.index = -1, o = i.$options.index(i.$options.filter(":selected")), r(i), i.multiple || v(o, i)
                        }
                    })
                }
            };
        e.fn.selecter = function(e) {
            return P[e] ? P[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e ? this : n.apply(this, arguments)
        }, e.selecter = function(e) {
            "defaults" === e && P.defaults.apply(this, Array.prototype.slice.call(arguments, 1))
        }
    }(jQuery, window),
    function(e) {
        e.fn.ezMark = function(t) {
            t = t || {};
            var n = {
                checkboxCls: t.checkboxCls || "ez-checkbox",
                radioCls: t.radioCls || "ez-radio",
                checkedCls: t.checkedCls || "ez-checked",
                selectedCls: t.selectedCls || "ez-selected",
                hideCls: "ez-hide"
            };
            return this.each(function() {
                var t = e(this),
                    i = "checkbox" == t.attr("type") ? '<div class="' + n.checkboxCls + '">' : '<div class="' + n.radioCls + '">';
                "checkbox" == t.attr("type") ? (t.addClass(n.hideCls).wrap(i).change(function() {
                    e(this).is(":checked") ? e(this).parent().addClass(n.checkedCls) : e(this).parent().removeClass(n.checkedCls)
                }), t.is(":checked") && t.parent().addClass(n.checkedCls)) : "radio" == t.attr("type") && (t.addClass(n.hideCls).wrap(i).change(function() {
                    e('input[name="' + e(this).attr("name") + '"]').each(function() {
                        e(this).is(":checked") ? e(this).parent().addClass(n.selectedCls) : e(this).parent().removeClass(n.selectedCls)
                    })
                }), t.is(":checked") && t.parent().addClass(n.selectedCls))
            })
        }
    }(jQuery),
    function(e, t, n) {
        function i(t, n) {
            this.element = t, this.$element = e(t), this.tabs = [], this.state = "", this.rotateInterval = 0, this.$queue = e({}), this.options = e.extend({}, r, n), this.init()
        }
        var r = {
            active: null,
            disabled: [],
            collapsible: "accordion",
            startCollapsed: !1,
            rotate: !1,
            setHash: !1,
            animation: "default",
            duration: 500,
            activate: function() {},
            deactivate: function() {},
            load: function() {},
            activateState: function() {},
            classes: {
                stateDefault: "r-tabs-state-default",
                stateActive: "r-tabs-state-active",
                stateDisabled: "r-tabs-state-disabled",
                tab: "r-tabs-tab",
                anchor: "r-tabs-anchor",
                panel: "r-tabs-panel",
                accordionTitle: "r-tabs-accordion-title"
            }
        };
        i.prototype.init = function() {
            var n = this;
            this.tabs = this._loadElements(), this._loadClasses(), this._loadEvents(), e(t).on("resize", function(e) {
                n._setState(e)
            }), e(t).on("hashchange", function(e) {
                var i = n._getTabRefBySelector(t.location.hash),
                    r = n._getTab(i);
                i >= 0 && !r._ignoreHashChange && !r.disabled && n._openTab(e, n._getTab(i), !0)
            }), this.options.rotate !== !1 && this.startRotation(), this.$element.bind("tabs-activate", function(e) {
                n.options.activate.call(this, e)
            }), this.$element.bind("tabs-deactivate", function(e) {
                n.options.deactivate.call(this, e)
            }), this.$element.bind("tabs-load", function(e) {
                var i, r = n._getTabRefBySelector(t.location.hash);
                n._setState(e), n.options.startCollapsed === !0 || "accordion" === n.options.startCollapsed && "accordion" === n.state || (i = n._getTab(r >= 0 && !n._getTab(r).disabled ? r : n.options.active > 0 && !n._getTab(n.options.active).disabled ? n.options.active : 0), n._openTab(e, i), n.options.load.call(this, e, i))
            }), this.$element.trigger("tabs-load")
        }, i.prototype._loadElements = function() {
            var t = this,
                n = this.$element.children("ul"),
                i = [],
                r = 0;
            return this.$element.addClass("r-tabs"), n.addClass("r-tabs-nav"), e("li", n).each(function() {
                var n = e(this),
                    o = e("a", n),
                    a = o.attr("href"),
                    s = e(a),
                    l = e("<div></div>").insertBefore(s),
                    c = e("<a></a>").attr("href", a).html(o.html()).appendTo(l),
                    u = {
                        _ignoreHashChange: !1,
                        id: r,
                        disabled: -1 !== e.inArray(r, t.options.disabled),
                        tab: e(this),
                        anchor: e("a", n),
                        panel: s,
                        selector: a,
                        accordionTab: l,
                        accordionAnchor: c,
                        active: !1
                    };
                r++, i.push(u)
            }), i
        }, i.prototype._loadClasses = function() {
            for (var e = 0; e < this.tabs.length; e++) this.tabs[e].tab.addClass(this.options.classes.stateDefault).addClass(this.options.classes.tab), this.tabs[e].anchor.addClass(this.options.classes.anchor), this.tabs[e].panel.addClass(this.options.classes.stateDefault).addClass(this.options.classes.panel), this.tabs[e].accordionTab.addClass(this.options.classes.accordionTitle), this.tabs[e].accordionAnchor.addClass(this.options.classes.anchor), this.tabs[e].disabled && (this.tabs[e].tab.removeClass(this.options.classes.stateDefault).addClass(this.options.classes.stateDisabled), this.tabs[e].accordionTab.removeClass(this.options.classes.stateDefault).addClass(this.options.classes.stateDisabled))
        }, i.prototype._loadEvents = function() {
            for (var e = this, n = function(n) {
                    var i = e._getCurrentTab(),
                        r = n.data.tab;
                    n.preventDefault(), r.disabled || (e.options.setHash && (t.location.hash = r.selector), n.data.tab._ignoreHashChange = !0, (i !== r || e._isCollapisble()) && (e._closeTab(n, i), (i !== r || !e._isCollapisble()) && e._openTab(n, r, !1, !0)))
                }, i = 0; i < this.tabs.length; i++) this.tabs[i].anchor.on("click", {
                tab: e.tabs[i]
            }, n), this.tabs[i].accordionAnchor.on("click", {
                tab: e.tabs[i]
            }, n)
        }, i.prototype._setState = function(t) {
            var n = e("ul", this.$element),
                i = this.state;
            this.state = n.is(":visible") ? "tabs" : "accordion", this.state !== i && this.$element.trigger("tabs-activate-state", t, {
                oldState: i,
                newState: this.state
            })
        }, i.prototype._openTab = function(e, t, n, i) {
            var r = this;
            n && this._closeTab(e, this._getCurrentTab()), i && this.rotateInterval > 0 && this.stopRotation(), t.active = !0, t.tab.removeClass(r.options.classes.stateDefault).addClass(r.options.classes.stateActive), t.accordionTab.removeClass(r.options.classes.stateDefault).addClass(r.options.classes.stateActive), r._doTransition(t.panel, r.options.animation, "open", function() {
                t.panel.removeClass(r.options.classes.stateDefault).addClass(r.options.classes.stateActive)
            }), this.$element.trigger("tabs-activate", e, t)
        }, i.prototype._closeTab = function(e, t) {
            var i = this;
            t !== n && (t.active = !1, t.tab.removeClass(i.options.classes.stateActive).addClass(i.options.classes.stateDefault), i._doTransition(t.panel, i.options.animation, "close", function() {
                t.accordionTab.removeClass(i.options.classes.stateActive).addClass(i.options.classes.stateDefault), t.panel.removeClass(i.options.classes.stateActive).addClass(i.options.classes.stateDefault)
            }, !0), this.$element.trigger("tabs-deactivate", e, t))
        }, i.prototype._doTransition = function(e, t, n, i, r) {
            var o, a = this;
            switch (t) {
                case "slide":
                    o = "open" === n ? "slideDown" : "slideUp";
                    break;
                case "fade":
                    o = "open" === n ? "fadeIn" : "fadeOut";
                    break;
                default:
                    o = "open" === n ? "show" : "hide", a.options.duration = 0
            }
            this.$queue.queue("responsive-tabs", function(r) {
                e[o]({
                    duration: a.options.duration,
                    complete: function() {
                        i.call(e, t, n), r()
                    }
                })
            }), ("open" === n || r) && this.$queue.dequeue("responsive-tabs")
        }, i.prototype._isCollapisble = function() {
            return "boolean" == typeof this.options.collapsible && this.options.collapsible || "string" == typeof this.options.collapsible && this.options.collapsible === this.getState()
        }, i.prototype._getTab = function(e) {
            return this.tabs[e]
        }, i.prototype._getTabRefBySelector = function(e) {
            for (var t = 0; t < this.tabs.length; t++)
                if (this.tabs[t].selector === e) return t;
            return -1
        }, i.prototype._getCurrentTab = function() {
            return this._getTab(this._getCurrentTabRef())
        }, i.prototype._getNextTabRef = function(e) {
            var t = e || this._getCurrentTabRef(),
                n = t === this.tabs.length - 1 ? 0 : t + 1;
            return this._getTab(n).disabled ? this._getNextTabRef(n) : n
        }, i.prototype._getPreviousTabRef = function() {
            return 0 === this._getCurrentTabRef() ? this.tabs.length - 1 : this._getCurrentTabRef() - 1
        }, i.prototype._getCurrentTabRef = function() {
            for (var e = 0; e < this.tabs.length; e++)
                if (this.tabs[e].active) return e;
            return -1
        }, i.prototype.activate = function(e, t) {
            var n = jQuery.Event("tabs-activate"),
                i = this._getTab(e);
            i.disabled || this._openTab(n, i, !0, t || !0)
        }, i.prototype.getState = function() {
            return this.state
        }, i.prototype.startRotation = function(t) {
            var n = this;
            if (!(this.tabs.length > this.options.disabled.length)) throw new Error("Rotation is not possible if all tabs are disabled");
            this.rotateInterval = setInterval(function() {
                var e = jQuery.Event("rotate");
                n._openTab(e, n._getTab(n._getNextTabRef()), !0)
            }, t || (e.isNumeric(n.options.rotate) ? n.options.rotate : 4e3))
        }, i.prototype.stopRotation = function() {
            t.clearInterval(this.rotateInterval), this.rotateInterval = 0
        }, e.fn.responsiveTabs = function(t) {
            var r = arguments;
            return t === n || "object" == typeof t ? this.each(function() {
                e.data(this, "responsivetabs") || e.data(this, "responsivetabs", new i(this, t))
            }) : "string" == typeof t && "_" !== t[0] && "init" !== t ? this.each(function() {
                var n = e.data(this, "responsivetabs");
                n instanceof i && "function" == typeof n[t] && n[t].apply(n, Array.prototype.slice.call(r, 1)), "destroy" === t && e.data(this, "responsivetabs", null)
            }) : void 0
        }
    }(jQuery, window),
    function(e, t, n) {
        e.fn.backstretch = function(i, r) {
            return (i === n || 0 === i.length) && e.error("No images were supplied for Backstretch"), 0 === e(t).scrollTop() && t.scrollTo(0, 0), this.each(function() {
                var t = e(this),
                    n = t.data("backstretch");
                if (n) {
                    if ("string" == typeof i && "function" == typeof n[i]) return void n[i](r);
                    r = e.extend(n.options, r), n.destroy(!0)
                }
                n = new o(this, i, r), t.data("backstretch", n)
            })
        }, e.backstretch = function(t, n) {
            return e("body").backstretch(t, n).data("backstretch")
        }, e.expr[":"].backstretch = function(t) {
            return e(t).data("backstretch") !== n
        }, e.fn.backstretch.defaults = {
            centeredX: !0,
            centeredY: !0,
            duration: 5e3,
            fade: 0
        };
        var i = {
                left: 0,
                top: 0,
                overflow: "hidden",
                margin: 0,
                padding: 0,
                height: "100%",
                width: "100%",
                zIndex: -999999
            },
            r = {
                position: "absolute",
                display: "none",
                margin: 0,
                padding: 0,
                border: "none",
                width: "auto",
                height: "auto",
                maxHeight: "none",
                maxWidth: "none",
                zIndex: -999999
            },
            o = function(n, r, o) {
                this.options = e.extend({}, e.fn.backstretch.defaults, o || {}), this.images = e.isArray(r) ? r : [r], e.each(this.images, function() {
                    e("<img />")[0].src = this
                }), this.isBody = n === document.body, this.$container = e(n), this.$root = this.isBody ? e(a ? t : document) : this.$container, n = this.$container.children(".backstretch").first(), this.$wrap = n.length ? n : e('<div class="backstretch"></div>').css(i).appendTo(this.$container), this.isBody || (n = this.$container.css("position"), r = this.$container.css("zIndex"), this.$container.css({
                    position: "static" === n ? "relative" : n,
                    zIndex: "auto" === r ? 0 : r,
                    background: "none"
                }), this.$wrap.css({
                    zIndex: -999998
                })), this.$wrap.css({
                    position: this.isBody && a ? "fixed" : "absolute"
                }), this.index = 0, this.show(this.index), e(t).on("resize.backstretch", e.proxy(this.resize, this)).on("orientationchange.backstretch", e.proxy(function() {
                    this.isBody && 0 === t.pageYOffset && (t.scrollTo(0, 1), this.resize())
                }, this))
            };
        o.prototype = {
            resize: function() {
                try {
                    var e, n = {
                            left: 0,
                            top: 0
                        },
                        i = this.isBody ? this.$root.width() : this.$root.innerWidth(),
                        r = i,
                        o = this.isBody ? t.innerHeight ? t.innerHeight : this.$root.height() : this.$root.innerHeight(),
                        a = r / this.$img.data("ratio");
                    a >= o ? (e = (a - o) / 2, this.options.centeredY && (n.top = "-" + e + "px")) : (a = o, r = a * this.$img.data("ratio"), e = (r - i) / 2, this.options.centeredX && (n.left = "-" + e + "px")), this.$wrap.css({
                        width: i,
                        height: o
                    }).find("img:not(.deleteable)").css({
                        width: r,
                        height: a
                    }).css(n)
                } catch (s) {}
                return this
            },
            show: function(t) {
                if (!(Math.abs(t) > this.images.length - 1)) {
                    var n = this,
                        i = n.$wrap.find("img").addClass("deleteable"),
                        o = {
                            relatedTarget: n.$container[0]
                        };
                    return n.$container.trigger(e.Event("backstretch.before", o), [n, t]), this.index = t, clearInterval(n.interval), n.$img = e("<img />").css(r).bind("load", function(r) {
                        var a = this.width || e(r.target).width();
                        r = this.height || e(r.target).height(), e(this).data("ratio", a / r), e(this).fadeIn(n.options.speed || n.options.fade, function() {
                            i.remove(), n.paused || n.cycle(), e(["after", "show"]).each(function() {
                                n.$container.trigger(e.Event("backstretch." + this, o), [n, t])
                            })
                        }), n.resize()
                    }).appendTo(n.$wrap), n.$img.attr("src", n.images[t]), n
                }
            },
            next: function() {
                return this.show(this.index < this.images.length - 1 ? this.index + 1 : 0)
            },
            prev: function() {
                return this.show(0 === this.index ? this.images.length - 1 : this.index - 1)
            },
            pause: function() {
                return this.paused = !0, this
            },
            resume: function() {
                return this.paused = !1, this.next(), this
            },
            cycle: function() {
                return 1 < this.images.length && (clearInterval(this.interval), this.interval = setInterval(e.proxy(function() {
                    this.paused || this.next()
                }, this), this.options.duration)), this
            },
            destroy: function(n) {
                e(t).off("resize.backstretch orientationchange.backstretch"), clearInterval(this.interval), n || this.$wrap.remove(), this.$container.removeData("backstretch")
            }
        };
        var a, s = navigator.userAgent,
            l = navigator.platform,
            c = s.match(/AppleWebKit\/([0-9]+)/),
            c = !!c && c[1],
            u = s.match(/Fennec\/([0-9]+)/),
            u = !!u && u[1],
            d = s.match(/Opera Mobi\/([0-9]+)/),
            p = !!d && d[1],
            f = s.match(/MSIE ([0-9]+)/),
            f = !!f && f[1];
        a = !((-1 < l.indexOf("iPhone") || -1 < l.indexOf("iPad") || -1 < l.indexOf("iPod")) && c && 534 > c || t.operamini && "[object OperaMini]" === {}.toString.call(t.operamini) || d && 7458 > p || -1 < s.indexOf("Android") && c && 533 > c || u && 6 > u || "palmGetResource" in t && c && 534 > c || -1 < s.indexOf("MeeGo") && -1 < s.indexOf("NokiaBrowser/8.5.0") || f && 6 >= f)
    }(jQuery, window),
    function(e, t, n) {
        function i(t, n) {
            this.bodyOverflowX, this.callbacks = {
                hide: [],
                show: []
            }, this.checkInterval = null, this.Content, this.$el = e(t), this.$elProxy, this.elProxyPosition, this.enabled = !0, this.options = e.extend({}, l, n), this.mouseIsOverProxy = !1, this.namespace = "tooltipster-" + Math.round(1e5 * Math.random()), this.Status = "hidden", this.timerHide = null, this.timerShow = null, this.$tooltip, this.options.iconTheme = this.options.iconTheme.replace(".", ""), this.options.theme = this.options.theme.replace(".", ""), this._init()
        }

        function r(t, n) {
            var i = !0;
            return e.each(t, function(e) {
                return "undefined" == typeof n[e] || t[e] !== n[e] ? (i = !1, !1) : void 0
            }), i
        }

        function o() {
            return !u && c
        }

        function a() {
            var e = n.body || n.documentElement,
                t = e.style,
                i = "transition";
            if ("string" == typeof t[i]) return !0;
            v = ["Moz", "Webkit", "Khtml", "O", "ms"], i = i.charAt(0).toUpperCase() + i.substr(1);
            for (var r = 0; r < v.length; r++)
                if ("string" == typeof t[v[r] + i]) return !0;
            return !1
        }
        var s = "tooltipster",
            l = {
                animation: "fade",
                arrow: !0,
                arrowColor: "",
                autoClose: !0,
                content: null,
                contentAsHTML: !1,
                contentCloning: !0,
                debug: !0,
                delay: 200,
                minWidth: 0,
                maxWidth: null,
                functionInit: function() {},
                functionBefore: function(e, t) {
                    t()
                },
                functionReady: function() {},
                functionAfter: function() {},
                icon: "(?)",
                iconCloning: !0,
                iconDesktop: !1,
                iconTouch: !1,
                iconTheme: "tooltipster-icon",
                interactive: !1,
                interactiveTolerance: 350,
                multiple: !1,
                offsetX: 0,
                offsetY: 0,
                onlyOne: !1,
                position: "top",
                positionTracker: !1,
                speed: 350,
                timer: 0,
                theme: "tooltipster-default",
                touchDevices: !0,
                trigger: "hover",
                updateAnimation: !0
            };
        i.prototype = {
            _init: function() {
                var t = this;
                if (n.querySelector) {
                    if (null !== t.options.content) t._content_set(t.options.content);
                    else {
                        var i = t.$el.attr("title");
                        "undefined" == typeof i && (i = null), t._content_set(i)
                    }
                    var r = t.options.functionInit.call(t.$el, t.$el, t.Content);
                    "undefined" != typeof r && t._content_set(r), t.$el.removeAttr("title").addClass("tooltipstered"), !c && t.options.iconDesktop || c && t.options.iconTouch ? ("string" == typeof t.options.icon ? (t.$elProxy = e('<span class="' + t.options.iconTheme + '"></span>'), t.$elProxy.text(t.options.icon)) : t.$elProxy = t.options.iconCloning ? t.options.icon.clone(!0) : t.options.icon, t.$elProxy.insertAfter(t.$el)) : t.$elProxy = t.$el, "hover" == t.options.trigger ? (t.$elProxy.on("mouseenter." + t.namespace, function() {
                        (!o() || t.options.touchDevices) && (t.mouseIsOverProxy = !0, t._show())
                    }).on("mouseleave." + t.namespace, function() {
                        (!o() || t.options.touchDevices) && (t.mouseIsOverProxy = !1)
                    }), c && t.options.touchDevices && t.$elProxy.on("touchstart." + t.namespace, function() {
                        t._showNow()
                    })) : "click" == t.options.trigger && t.$elProxy.on("click." + t.namespace, function() {
                        (!o() || t.options.touchDevices) && t._show()
                    })
                }
            },
            _show: function() {
                var e = this;
                "shown" != e.Status && "appearing" != e.Status && (e.options.delay ? e.timerShow = setTimeout(function() {
                    ("click" == e.options.trigger || "hover" == e.options.trigger && e.mouseIsOverProxy) && e._showNow()
                }, e.options.delay) : e._showNow())
            },
            _showNow: function(n) {
                var i = this;
                i.options.functionBefore.call(i.$el, i.$el, function() {
                    if (i.enabled && null !== i.Content) {
                        n && i.callbacks.show.push(n), i.callbacks.hide = [], clearTimeout(i.timerShow), i.timerShow = null, clearTimeout(i.timerHide), i.timerHide = null, i.options.onlyOne && e(".tooltipstered").not(i.$el).each(function(t, n) {
                            var i = e(n),
                                r = i.data("tooltipster-ns");
                            e.each(r, function(e, t) {
                                var n = i.data(t),
                                    r = n.status(),
                                    o = n.option("autoClose");
                                "hidden" !== r && "disappearing" !== r && o && n.hide()
                            })
                        });
                        var r = function() {
                            i.Status = "shown", e.each(i.callbacks.show, function(e, t) {
                                t.call(i.$el)
                            }), i.callbacks.show = []
                        };
                        if ("hidden" !== i.Status) {
                            var o = 0;
                            "disappearing" === i.Status ? (i.Status = "appearing", a() ? (i.$tooltip.clearQueue().removeClass("tooltipster-dying").addClass("tooltipster-" + i.options.animation + "-show"), i.options.speed > 0 && i.$tooltip.delay(i.options.speed), i.$tooltip.queue(r)) : i.$tooltip.stop().fadeIn(r)) : "shown" === i.Status && r()
                        } else {
                            i.Status = "appearing";
                            var o = i.options.speed;
                            i.bodyOverflowX = e("body").css("overflow-x"), e("body").css("overflow-x", "hidden");
                            var s = "tooltipster-" + i.options.animation,
                                l = "-webkit-transition-duration: " + i.options.speed + "ms; -webkit-animation-duration: " + i.options.speed + "ms; -moz-transition-duration: " + i.options.speed + "ms; -moz-animation-duration: " + i.options.speed + "ms; -o-transition-duration: " + i.options.speed + "ms; -o-animation-duration: " + i.options.speed + "ms; -ms-transition-duration: " + i.options.speed + "ms; -ms-animation-duration: " + i.options.speed + "ms; transition-duration: " + i.options.speed + "ms; animation-duration: " + i.options.speed + "ms;",
                                u = i.options.minWidth ? "min-width:" + Math.round(i.options.minWidth) + "px;" : "",
                                d = i.options.maxWidth ? "max-width:" + Math.round(i.options.maxWidth) + "px;" : "",
                                p = i.options.interactive ? "pointer-events: auto;" : "";
                            if (i.$tooltip = e('<div class="tooltipster-base ' + i.options.theme + '" style="' + u + " " + d + " " + p + " " + l + '"><div class="tooltipster-content"></div></div>'), a() && i.$tooltip.addClass(s), i._content_insert(), i.$tooltip.appendTo("body"), i.reposition(), i.options.functionReady.call(i.$el, i.$el, i.$tooltip), a() ? (i.$tooltip.addClass(s + "-show"), i.options.speed > 0 && i.$tooltip.delay(i.options.speed), i.$tooltip.queue(r)) : i.$tooltip.css("display", "none").fadeIn(i.options.speed, r), i._interval_set(), e(t).on("scroll." + i.namespace + " resize." + i.namespace, function() {
                                    i.reposition()
                                }), i.options.autoClose)
                                if (e("body").off("." + i.namespace), "hover" == i.options.trigger)
                                    if (c && setTimeout(function() {
                                            e("body").on("touchstart." + i.namespace, function() {
                                                i.hide()
                                            })
                                        }, 0), i.options.interactive) {
                                        c && i.$tooltip.on("touchstart." + i.namespace, function(e) {
                                            e.stopPropagation()
                                        });
                                        var f = null;
                                        i.$elProxy.add(i.$tooltip).on("mouseleave." + i.namespace + "-autoClose", function() {
                                            clearTimeout(f), f = setTimeout(function() {
                                                i.hide()
                                            }, i.options.interactiveTolerance)
                                        }).on("mouseenter." + i.namespace + "-autoClose", function() {
                                            clearTimeout(f)
                                        })
                                    } else i.$elProxy.on("mouseleave." + i.namespace + "-autoClose", function() {
                                        i.hide()
                                    });
                            else "click" == i.options.trigger && (setTimeout(function() {
                                e("body").on("click." + i.namespace + " touchstart." + i.namespace, function() {
                                    i.hide()
                                })
                            }, 0), i.options.interactive && i.$tooltip.on("click." + i.namespace + " touchstart." + i.namespace, function(e) {
                                e.stopPropagation()
                            }))
                        }
                        i.options.timer > 0 && (i.timerHide = setTimeout(function() {
                            i.timerHide = null, i.hide()
                        }, i.options.timer + o))
                    }
                })
            },
            _interval_set: function() {
                var t = this;
                t.checkInterval = setInterval(function() {
                    if (0 === e("body").find(t.$el).length || 0 === e("body").find(t.$elProxy).length || "hidden" == t.Status || 0 === e("body").find(t.$tooltip).length)("shown" == t.Status || "appearing" == t.Status) && t.hide(), t._interval_cancel();
                    else if (t.options.positionTracker) {
                        var n = t._repositionInfo(t.$elProxy),
                            i = !1;
                        r(n.dimension, t.elProxyPosition.dimension) && ("fixed" === t.$elProxy.css("position") ? r(n.position, t.elProxyPosition.position) && (i = !0) : r(n.offset, t.elProxyPosition.offset) && (i = !0)), i || t.reposition()
                    }
                }, 200)
            },
            _interval_cancel: function() {
                clearInterval(this.checkInterval), this.checkInterval = null
            },
            _content_set: function(e) {
                "object" == typeof e && null !== e && this.options.contentCloning && (e = e.clone(!0)), this.Content = e
            },
            _content_insert: function() {
                var e = this,
                    t = this.$tooltip.find(".tooltipster-content");
                "string" != typeof e.Content || e.options.contentAsHTML ? t.empty().append(e.Content) : t.text(e.Content)
            },
            _update: function(e) {
                var t = this;
                t._content_set(e), null !== t.Content ? "hidden" !== t.Status && (t._content_insert(), t.reposition(), t.options.updateAnimation && (a() ? (t.$tooltip.css({
                    width: "",
                    "-webkit-transition": "all " + t.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                    "-moz-transition": "all " + t.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                    "-o-transition": "all " + t.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                    "-ms-transition": "all " + t.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                    transition: "all " + t.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms"
                }).addClass("tooltipster-content-changing"), setTimeout(function() {
                    "hidden" != t.Status && (t.$tooltip.removeClass("tooltipster-content-changing"), setTimeout(function() {
                        "hidden" !== t.Status && t.$tooltip.css({
                            "-webkit-transition": t.options.speed + "ms",
                            "-moz-transition": t.options.speed + "ms",
                            "-o-transition": t.options.speed + "ms",
                            "-ms-transition": t.options.speed + "ms",
                            transition: t.options.speed + "ms"
                        })
                    }, t.options.speed))
                }, t.options.speed)) : t.$tooltip.fadeTo(t.options.speed, .5, function() {
                    "hidden" != t.Status && t.$tooltip.fadeTo(t.options.speed, 1)
                }))) : t.hide()
            },
            _repositionInfo: function(e) {
                return {
                    dimension: {
                        height: e.outerHeight(!1),
                        width: e.outerWidth(!1)
                    },
                    offset: e.offset(),
                    position: {
                        left: parseInt(e.css("left")),
                        top: parseInt(e.css("top"))
                    }
                }
            },
            hide: function(n) {
                var i = this;
                n && i.callbacks.hide.push(n), i.callbacks.show = [], clearTimeout(i.timerShow), i.timerShow = null, clearTimeout(i.timerHide), i.timerHide = null;
                var r = function() {
                    e.each(i.callbacks.hide, function(e, t) {
                        t.call(i.$el)
                    }), i.callbacks.hide = []
                };
                if ("shown" == i.Status || "appearing" == i.Status) {
                    i.Status = "disappearing";
                    var o = function() {
                        i.Status = "hidden", "object" == typeof i.Content && null !== i.Content && i.Content.detach(), i.$tooltip.remove(), i.$tooltip = null, e(t).off("." + i.namespace), e("body").off("." + i.namespace).css("overflow-x", i.bodyOverflowX), e("body").off("." + i.namespace), i.$elProxy.off("." + i.namespace + "-autoClose"), i.options.functionAfter.call(i.$el, i.$el), r()
                    };
                    a() ? (i.$tooltip.clearQueue().removeClass("tooltipster-" + i.options.animation + "-show").addClass("tooltipster-dying"), i.options.speed > 0 && i.$tooltip.delay(i.options.speed), i.$tooltip.queue(o)) : i.$tooltip.stop().fadeOut(i.options.speed, o)
                } else "hidden" == i.Status && r();
                return i
            },
            show: function(e) {
                return this._showNow(e), this
            },
            update: function(e) {
                return this.content(e)
            },
            content: function(e) {
                return "undefined" == typeof e ? this.Content : (this._update(e), this)
            },
            reposition: function() {
                function n() {
                    var n = e(t).scrollLeft();
                    0 > A - n && (o = A - n, A = n), A + l - n > a && (o = A - (a + n - l), A = a + n - l)
                }

                function i(n, i) {
                    s.offset.top - e(t).scrollTop() - c - O - 12 < 0 && i.indexOf("top") > -1 && (I = n), s.offset.top + s.dimension.height + c + 12 + O > e(t).scrollTop() + e(t).height() && i.indexOf("bottom") > -1 && (I = n, N = s.offset.top - c - O - 12)
                }
                var r = this;
                if (0 !== e("body").find(r.$tooltip).length) {
                    r.$tooltip.css("width", ""), r.elProxyPosition = r._repositionInfo(r.$elProxy);
                    var o = null,
                        a = e(t).width(),
                        s = r.elProxyPosition,
                        l = r.$tooltip.outerWidth(!1),
                        c = (r.$tooltip.innerWidth() + 1, r.$tooltip.outerHeight(!1));
                    if (r.$elProxy.is("area")) {
                        var u = r.$elProxy.attr("shape"),
                            d = r.$elProxy.parent().attr("name"),
                            p = e('img[usemap="#' + d + '"]'),
                            f = p.offset().left,
                            h = p.offset().top,
                            g = void 0 !== r.$elProxy.attr("coords") ? r.$elProxy.attr("coords").split(",") : void 0;
                        if ("circle" == u) {
                            var m = parseInt(g[0]),
                                v = parseInt(g[1]),
                                y = parseInt(g[2]);
                            s.dimension.height = 2 * y, s.dimension.width = 2 * y, s.offset.top = h + v - y, s.offset.left = f + m - y
                        } else if ("rect" == u) {
                            var m = parseInt(g[0]),
                                v = parseInt(g[1]),
                                b = parseInt(g[2]),
                                x = parseInt(g[3]);
                            s.dimension.height = x - v, s.dimension.width = b - m, s.offset.top = h + v, s.offset.left = f + m
                        } else if ("poly" == u) {
                            for (var w = 0, C = 0, _ = 0, k = 0, S = "even", T = 0; T < g.length; T++) {
                                var $ = parseInt(g[T]);
                                "even" == S ? ($ > _ && (_ = $, 0 === T && (w = _)), w > $ && (w = $), S = "odd") : ($ > k && (k = $, 1 == T && (C = k)), C > $ && (C = $), S = "even")
                            }
                            s.dimension.height = k - C, s.dimension.width = _ - w, s.offset.top = h + C, s.offset.left = f + w
                        } else s.dimension.height = p.outerHeight(!1), s.dimension.width = p.outerWidth(!1), s.offset.top = h, s.offset.left = f
                    }
                    var A = 0,
                        E = 0,
                        N = 0,
                        O = parseInt(r.options.offsetY),
                        P = parseInt(r.options.offsetX),
                        I = r.options.position;
                    if ("top" == I) {
                        var j = s.offset.left + l - (s.offset.left + s.dimension.width);
                        A = s.offset.left + P - j / 2, N = s.offset.top - c - O - 12, n(), i("bottom", "top")
                    }
                    if ("top-left" == I && (A = s.offset.left + P, N = s.offset.top - c - O - 12, n(), i("bottom-left", "top-left")), "top-right" == I && (A = s.offset.left + s.dimension.width + P - l, N = s.offset.top - c - O - 12, n(), i("bottom-right", "top-right")), "bottom" == I) {
                        var j = s.offset.left + l - (s.offset.left + s.dimension.width);
                        A = s.offset.left - j / 2 + P, N = s.offset.top + s.dimension.height + O + 12, n(), i("top", "bottom")
                    }
                    if ("bottom-left" == I && (A = s.offset.left + P, N = s.offset.top + s.dimension.height + O + 12, n(), i("top-left", "bottom-left")), "bottom-right" == I && (A = s.offset.left + s.dimension.width + P - l, N = s.offset.top + s.dimension.height + O + 12, n(), i("bottom-right", "top-right")), "left" == I) {
                        A = s.offset.left - P - l - 12, E = s.offset.left + P + s.dimension.width + 12;
                        var D = s.offset.top + c - (s.offset.top + s.dimension.height);
                        if (N = s.offset.top - D / 2 - O, 0 > A && E + l > a) {
                            var M = 2 * parseFloat(r.$tooltip.css("border-width")),
                                F = l + A - M;
                            r.$tooltip.css("width", F + "px"), c = r.$tooltip.outerHeight(!1), A = s.offset.left - P - F - 12 - M, D = s.offset.top + c - (s.offset.top + s.dimension.height), N = s.offset.top - D / 2 - O
                        } else 0 > A && (A = s.offset.left + P + s.dimension.width + 12, o = "left")
                    }
                    if ("right" == I) {
                        A = s.offset.left + P + s.dimension.width + 12, E = s.offset.left - P - l - 12;
                        var D = s.offset.top + c - (s.offset.top + s.dimension.height);
                        if (N = s.offset.top - D / 2 - O, A + l > a && 0 > E) {
                            var M = 2 * parseFloat(r.$tooltip.css("border-width")),
                                F = a - A - M;
                            r.$tooltip.css("width", F + "px"), c = r.$tooltip.outerHeight(!1), D = s.offset.top + c - (s.offset.top + s.dimension.height), N = s.offset.top - D / 2 - O
                        } else A + l > a && (A = s.offset.left - P - l - 12, o = "right")
                    }
                    if (r.options.arrow) {
                        var H = "tooltipster-arrow-" + I;
                        if (r.options.arrowColor.length < 1) var q = r.$tooltip.css("background-color");
                        else var q = r.options.arrowColor;
                        if (o ? "left" == o ? (H = "tooltipster-arrow-right", o = "") : "right" == o ? (H = "tooltipster-arrow-left", o = "") : o = "left:" + Math.round(o) + "px;" : o = "", "top" == I || "top-left" == I || "top-right" == I) var L = parseFloat(r.$tooltip.css("border-bottom-width")),
                            R = r.$tooltip.css("border-bottom-color");
                        else if ("bottom" == I || "bottom-left" == I || "bottom-right" == I) var L = parseFloat(r.$tooltip.css("border-top-width")),
                            R = r.$tooltip.css("border-top-color");
                        else if ("left" == I) var L = parseFloat(r.$tooltip.css("border-right-width")),
                            R = r.$tooltip.css("border-right-color");
                        else if ("right" == I) var L = parseFloat(r.$tooltip.css("border-left-width")),
                            R = r.$tooltip.css("border-left-color");
                        else var L = parseFloat(r.$tooltip.css("border-bottom-width")),
                            R = r.$tooltip.css("border-bottom-color");
                        L > 1 && L++;
                        var W = "";
                        if (0 !== L) {
                            var B = "",
                                z = "border-color: " + R + ";"; - 1 !== H.indexOf("bottom") ? B = "margin-top: -" + Math.round(L) + "px;" : -1 !== H.indexOf("top") ? B = "margin-bottom: -" + Math.round(L) + "px;" : -1 !== H.indexOf("left") ? B = "margin-right: -" + Math.round(L) + "px;" : -1 !== H.indexOf("right") && (B = "margin-left: -" + Math.round(L) + "px;"), W = '<span class="tooltipster-arrow-border" style="' + B + " " + z + ';"></span>'
                        }
                        r.$tooltip.find(".tooltipster-arrow").remove();
                        var V = '<div class="' + H + ' tooltipster-arrow" style="' + o + '">' + W + '<span style="border-color:' + q + ';"></span></div>';
                        r.$tooltip.append(V)
                    }
                    r.$tooltip.css({
                        top: Math.round(N) + "px",
                        left: Math.round(A) + "px"
                    })
                }
                return r
            },
            enable: function() {
                return this.enabled = !0, this
            },
            disable: function() {
                return this.hide(), this.enabled = !1, this
            },
            destroy: function() {
                var t = this;
                t.hide(), t.$el[0] !== t.$elProxy[0] && t.$elProxy.remove(), t.$el.removeData(t.namespace).off("." + t.namespace);
                var n = t.$el.data("tooltipster-ns");
                if (1 === n.length) {
                    var i = "string" == typeof t.Content ? t.Content : e("<div></div>").append(t.Content).html();
                    t.$el.removeClass("tooltipstered").attr("title", i).removeData(t.namespace).removeData("tooltipster-ns").off("." + t.namespace)
                } else n = e.grep(n, function(e) {
                    return e !== t.namespace
                }), t.$el.data("tooltipster-ns", n);
                return t
            },
            elementIcon: function() {
                return this.$el[0] !== this.$elProxy[0] ? this.$elProxy[0] : void 0
            },
            elementTooltip: function() {
                return this.$tooltip ? this.$tooltip[0] : void 0
            },
            option: function(e, t) {
                return "undefined" == typeof t ? this.options[e] : (this.options[e] = t, this)
            },
            status: function() {
                return this.Status
            }
        }, e.fn[s] = function() {
            var t = arguments;
            if (0 === this.length) {
                if ("string" == typeof t[0]) {
                    var n = !0;
                    switch (t[0]) {
                        case "setDefaults":
                            e.extend(l, t[1]);
                            break;
                        default:
                            n = !1
                    }
                    return n ? !0 : this
                }
                return this
            }
            if ("string" == typeof t[0]) {
                var r = "#*$~&";
                return this.each(function() {
                    var n = e(this).data("tooltipster-ns"),
                        i = n ? e(this).data(n[0]) : null;
                    if (!i) throw new Error("You called Tooltipster's \"" + t[0] + '" method on an uninitialized element');
                    if ("function" != typeof i[t[0]]) throw new Error('Unknown method .tooltipster("' + t[0] + '")');
                    var o = i[t[0]](t[1], t[2]);
                    return o !== i ? (r = o, !1) : void 0
                }), "#*$~&" !== r ? r : this
            }
            var o = [],
                a = t[0] && "undefined" != typeof t[0].multiple,
                s = a && t[0].multiple || !a && l.multiple;
            return this.each(function() {
                var n = !1,
                    r = e(this).data("tooltipster-ns"),
                    a = null;
                r ? s ? n = !0 : self.options.debug && console.log('Tooltipster: one or more tooltips are already attached to this element: ignoring. Use the "multiple" option to attach more tooltips.') : n = !0, n && (a = new i(this, t[0]), r || (r = []), r.push(a.namespace), e(this).data("tooltipster-ns", r), e(this).data(a.namespace, a)), o.push(a)
            }), s ? o : this
        };
        var c = !!("ontouchstart" in t),
            u = !1;
        e("body").one("mousemove", function() {
            u = !0
        })
    }(jQuery, window, document), window.Socialite = function(e, t, n) {
        var i = 0,
            r = [],
            o = {},
            a = {},
            s = /^($|loaded|complete)/,
            l = e.encodeURIComponent,
            c = {
                settings: {},
                trim: function(e) {
                    return e.trim ? e.trim() : e.replace(/^\s+|\s+$/g, "")
                },
                hasClass: function(e, t) {
                    return -1 !== (" " + e.className + " ").indexOf(" " + t + " ")
                },
                addClass: function(e, t) {
                    c.hasClass(e, t) || (e.className = "" === e.className ? t : e.className + " " + t)
                },
                removeClass: function(e, t) {
                    e.className = c.trim(" " + e.className + " ".replace(" " + t + " ", " "))
                },
                extendObject: function(e, t, i) {
                    for (var r in t) {
                        var o = e[r] !== n;
                        o && "object" == typeof t[r] ? c.extendObject(e[r], t[r], i) : (i || !o) && (e[r] = t[r])
                    }
                },
                getElements: function(e, t) {
                    for (var n = 0, i = [], r = !!e.getElementsByClassName, o = r ? e.getElementsByClassName(t) : e.getElementsByTagName("*"); n < o.length; n++)(r || c.hasClass(o[n], t)) && i.push(o[n]);
                    return i
                },
                getDataAttributes: function(e, t, n) {
                    for (var i = 0, r = "", o = {}, a = e.attributes; i < a.length; i++) {
                        var s = a[i].name,
                            c = a[i].value;
                        c.length && 0 === s.indexOf("data-") && (t && (s = s.substring(5)), n ? o[s] = c : r += l(s) + "=" + l(c) + "&")
                    }
                    return n ? o : r
                },
                copyDataAttributes: function(e, t, n, i) {
                    var r = c.getDataAttributes(e, n, !0);
                    for (var o in r) t.setAttribute(i ? o.replace(/-/g, "_") : o, r[o])
                },
                createIframe: function(e, n) {
                    var i = t.createElement("iframe");
                    return i.style.cssText = "overflow: hidden; border: none;", c.extendObject(i, {
                        src: e,
                        allowtransparency: "true",
                        frameborder: "0",
                        scrolling: "no"
                    }, !0), n && (i.onload = i.onreadystatechange = function() {
                        s.test(i.readyState || "") && (i.onload = i.onreadystatechange = null, c.activateInstance(n))
                    }), i
                },
                networkReady: function(e) {
                    return o[e] ? o[e].loaded : n
                },
                appendNetwork: function(e) {
                    if (e && !e.appended) {
                        if ("function" == typeof e.append && e.append(e) === !1) return e.appended = e.loaded = !0, void c.activateAll(e);
                        e.script && (e.el = t.createElement("script"), c.extendObject(e.el, e.script, !0), e.el.async = !0, e.el.onload = e.el.onreadystatechange = function() {
                            if (s.test(e.el.readyState || "")) {
                                if (e.el.onload = e.el.onreadystatechange = null, e.loaded = !0, "function" == typeof e.onload && e.onload(e) === !1) return;
                                c.activateAll(e)
                            }
                        }, t.body.appendChild(e.el)), e.appended = !0
                    }
                },
                removeNetwork: function(e) {
                    return c.networkReady(e.name) ? (e.el.parentNode && e.el.parentNode.removeChild(e.el), !(e.appended = e.loaded = !1)) : !1
                },
                reloadNetwork: function(e) {
                    var t = o[e];
                    t && c.removeNetwork(t) && c.appendNetwork(t)
                },
                createInstance: function(e, t) {
                    var o = !0,
                        a = {
                            el: e,
                            uid: i++,
                            widget: t
                        };
                    return r.push(a), t.process !== n && (o = "function" == typeof t.process ? t.process(a) : !1), o && c.processInstance(a), a.el.setAttribute("data-socialite", a.uid), a.el.className = "socialite " + t.name + " socialite-instance", a
                },
                processInstance: function(e) {
                    var n = e.el;
                    e.el = t.createElement("div"), e.el.className = n.className, c.copyDataAttributes(n, e.el), "a" !== n.nodeName.toLowerCase() || n.getAttribute("data-default-href") || e.el.setAttribute("data-default-href", n.getAttribute("href"));
                    var i = n.parentNode;
                    i.insertBefore(e.el, n), i.removeChild(n)
                },
                activateInstance: function(e) {
                    return e && !e.loaded ? (e.loaded = !0, "function" == typeof e.widget.activate && e.widget.activate(e), c.addClass(e.el, "socialite-loaded"), e.onload ? e.onload(e.el) : null) : void 0
                },
                activateAll: function(e) {
                    "string" == typeof e && (e = o[e]);
                    for (var t = 0; t < r.length; t++) {
                        var n = r[t];
                        n.init && n.widget.network === e && c.activateInstance(n)
                    }
                },
                load: function(e, n, i, o, s) {
                    if (e = e && "object" == typeof e && 1 === e.nodeType ? e : t, !n || "object" != typeof n) return void c.load(e, c.getElements(e, "socialite"), i, o, s);
                    var l;
                    if (/Array/.test(Object.prototype.toString.call(n)))
                        for (l = 0; l < n.length; l++) c.load(e, n[l], i, o, s);
                    else if (1 === n.nodeType) {
                        if (!i || !a[i]) {
                            i = null;
                            var u = n.className.split(" ");
                            for (l = 0; l < u.length; l++)
                                if (a[u[l]]) {
                                    i = u[l];
                                    break
                                }
                            if (!i) return
                        }
                        var d, p = a[i],
                            f = parseInt(n.getAttribute("data-socialite"), 10);
                        if (isNaN(f)) d = c.createInstance(n, p);
                        else
                            for (l = 0; l < r.length; l++)
                                if (r[l].uid === f) {
                                    d = r[l];
                                    break
                                }!s && d && (d.init || (d.init = !0, d.onload = "function" == typeof o ? o : null, p.init(d)), p.network.appended ? c.networkReady(p.network.name) && c.activateInstance(d) : c.appendNetwork(p.network))
                    }
                },
                activate: function(t, n, i) {
                    e.Socialite.load(null, t, n, i)
                },
                process: function(t, n, i) {
                    e.Socialite.load(t, n, i, null, !0)
                },
                network: function(e, t) {
                    o[e] = {
                        name: e,
                        el: null,
                        appended: !1,
                        loaded: !1,
                        widgets: {}
                    }, t && c.extendObject(o[e], t)
                },
                widget: function(e, t, n) {
                    n.name = e + "-" + t, o[e] && !a[n.name] && (n.network = o[e], o[e].widgets[t] = a[n.name] = n)
                },
                setup: function(e) {
                    c.extendObject(c.settings, e, !0)
                }
            };
        return c
    }(window, window.document),
    function(e, n, i) {
        i.setup({
            facebook: {
                lang: "en_GB",
                appId: null
            },
            twitter: {
                lang: "en"
            },
            googleplus: {
                lang: "en-GB"
            }
        }), i.network("facebook", {
            script: {
                src: "//connect.facebook.net/{{language}}/all.js",
                id: "facebook-jssdk"
            },
            append: function(t) {
                var r = n.createElement("div"),
                    o = i.settings.facebook,
                    a = {
                        onlike: "edge.create",
                        onunlike: "edge.remove",
                        onsend: "message.send"
                    };
                r.id = "fb-root", n.body.appendChild(r), t.script.src = t.script.src.replace("{{language}}", o.lang), e.fbAsyncInit = function() {
                    e.FB.init({
                        appId: o.appId,
                        xfbml: !0
                    });
                    for (var t in a) "function" == typeof o[t] && e.FB.Event.subscribe(a[t], o[t])
                }
            }
        });
        var r = function(t) {
            var r = n.createElement("div");
            r.className = t.widget.fbtype, i.copyDataAttributes(t.el, r), t.el.appendChild(r), e.FB && e.FB.XFBML && e.FB.XFBML.parse(t.el)
        };
        i.widget("facebook", "like", {
            init: r,
            fbtype: "fb-like"
        }), i.widget("facebook", "share", {
            init: r,
            fbtype: "fb-share-button"
        }), i.network("twitter", {
            script: {
                src: "//platform.twitter.com/widgets.js",
                id: "twitter-wjs",
                charset: "utf-8"
            },
            append: function() {
                var n = "object" != typeof e.twttr,
                    r = i.settings.twitter,
                    o = ["click", "tweet", "retweet", "favorite", "follow"];
                return n && (e.twttr = t = {
                    _e: [],
                    ready: function(e) {
                        t._e.push(e)
                    }
                }), e.twttr.ready(function(e) {
                    for (var t = 0; t < o.length; t++) {
                        var n = o[t];
                        "function" == typeof r["on" + n] && e.events.bind(n, r["on" + n])
                    }
                    i.activateAll("twitter")
                }), n
            }
        });
        var o = function(e) {
                var t = n.createElement("a");
                t.className = e.widget.name + "-button", i.copyDataAttributes(e.el, t), t.setAttribute("href", e.el.getAttribute("data-default-href")), t.setAttribute("data-lang", e.el.getAttribute("data-lang") || i.settings.twitter.lang), e.el.appendChild(t)
            },
            a = function() {
                e.twttr && "object" == typeof e.twttr.widgets && "function" == typeof e.twttr.widgets.load && e.twttr.widgets.load()
            };
        i.widget("twitter", "share", {
            init: o,
            activate: a
        }), i.widget("twitter", "follow", {
            init: o,
            activate: a
        }), i.widget("twitter", "hashtag", {
            init: o,
            activate: a
        }), i.widget("twitter", "mention", {
            init: o,
            activate: a
        }), i.widget("twitter", "embed", {
            process: function(e) {
                e.innerEl = e.el, e.innerEl.getAttribute("data-lang") || e.innerEl.setAttribute("data-lang", i.settings.twitter.lang), e.el = n.createElement("div"), e.el.className = e.innerEl.className, e.innerEl.className = "", e.innerEl.parentNode.insertBefore(e.el, e.innerEl), e.el.appendChild(e.innerEl)
            },
            init: function(e) {
                e.innerEl.className = "twitter-tweet"
            },
            activate: a
        }), i.network("googleplus", {
            script: {
                src: "//apis.google.com/js/plusone.js"
            },
            append: function() {
                return e.gapi ? !1 : void(e.___gcfg = {
                    lang: i.settings.googleplus.lang,
                    parsetags: "explicit"
                })
            }
        });
        var s = function(e) {
                var t = n.createElement("div");
                t.className = "g-" + e.widget.gtype, i.copyDataAttributes(e.el, t), e.el.appendChild(t), e.gplusEl = t
            },
            l = function(e, t) {
                return "function" != typeof t ? null : function(n) {
                    t(e.el, n)
                }
            },
            c = function(t) {
                var n = t.widget.gtype;
                if (e.gapi && e.gapi[n]) {
                    for (var r = i.settings.googleplus, o = i.getDataAttributes(t.el, !0, !0), a = ["onstartinteraction", "onendinteraction", "callback"], s = 0; s < a.length; s++) o[a[s]] = l(t, r[a[s]]);
                    e.gapi[n].render(t.gplusEl, o)
                }
            };
        i.widget("googleplus", "one", {
            init: s,
            activate: c,
            gtype: "plusone"
        }), i.widget("googleplus", "share", {
            init: s,
            activate: c,
            gtype: "plus"
        }), i.widget("googleplus", "badge", {
            init: s,
            activate: c,
            gtype: "plus"
        }), i.network("linkedin", {
            script: {
                src: "//platform.linkedin.com/in.js"
            }
        });
        var u = function(t) {
            var r = n.createElement("script");
            r.type = "IN/" + t.widget.intype, i.copyDataAttributes(t.el, r), t.el.appendChild(r), "object" == typeof e.IN && "function" == typeof e.IN.parse && (e.IN.parse(t.el), i.activateInstance(t))
        };
        i.widget("linkedin", "share", {
            init: u,
            intype: "Share"
        }), i.widget("linkedin", "recommend", {
            init: u,
            intype: "RecommendProduct"
        }), i.widget("linkedin", "follow", {
            init: u,
            intype: "FollowCompany"
        })
    }(window, window.document, window.Socialite),
    function() {
        var e = window._socialite;
        if (/Array/.test(Object.prototype.toString.call(e)))
            for (var t = 0, n = e.length; n > t; t++) "function" == typeof e[t] && e[t]()
    }(),
    function(e, t, n) {
        var i = [];
        n.setup({
            vkontakte: {
                apiId: null,
                group: {
                    id: 0,
                    mode: 0,
                    width: 300,
                    height: 290
                },
                like: {
                    type: "mini"
                }
            }
        }), n.network("vkontakte", {
            script: {
                src: "//userapi.com/js/api/openapi.js?49",
                id: "vk-jsapi"
            },
            onload: function() {
                var e = n.settings.vkontakte;
                VK.init({
                    apiId: e.apiId,
                    onlyWidgets: !0
                });
                for (var t = 0, r = i.length; r > t; i[t].call(this), t++);
            }
        });
        var r = function(e, t, n) {
            for (var i, r = {}, o = 0, a = t.length; a > o; i = t[o], r[i] = e.getAttribute("data-" + i) || n[i], o++);
            return r
        };
        n.widget("vkontakte", "group", {
            init: function(o) {
                "object" != typeof e.VK && i.push(function() {
                    var e = t.createElement("div"),
                        i = n.settings.vkontakte;
                    e.className = "vk-group", e.id = "vkontakte-group-" + (new Date).getTime(), n.copyDataAttributes(o.el, e), group = r(o.el, ["id", "mode", "width", "height"], i.group), o.el.appendChild(e), VK.Widgets.Group(e.id, group, group.id)
                })
            }
        }), n.widget("vkontakte", "like", {
            init: function(o) {
                "object" != typeof e.VK && i.push(function() {
                    var e = t.createElement("div"),
                        i = n.settings.vkontakte;
                    e.className = "vk-like", e.id = "vkontakte-like-" + (new Date).getTime() + Math.random().toString().replace(".", "-"), n.copyDataAttributes(o.el, e), like = r(o.el, ["type"], i.like), o.el.appendChild(e), VK.Widgets.Like(e.id, like)
                })
            }
        })
    }(window, window.document, window.Socialite), ! function(e) {
        "use strict";
        "function" == typeof define && define.amd ? define(["jquery"], e) : e("object" == typeof exports && "function" == typeof require ? require("jquery") : jQuery)
    }(function(e) {
        "use strict";

        function t(n, i) {
            var r = function() {},
                o = this,
                a = {
                    ajaxSettings: {},
                    autoSelectFirst: !1,
                    appendTo: document.body,
                    serviceUrl: null,
                    lookup: null,
                    onSelect: null,
                    width: "auto",
                    minChars: 1,
                    maxHeight: 300,
                    deferRequestBy: 0,
                    params: {},
                    formatResult: t.formatResult,
                    delimiter: null,
                    zIndex: 9999,
                    type: "GET",
                    noCache: !1,
                    onSearchStart: r,
                    onSearchComplete: r,
                    onSearchError: r,
                    preserveInput: !1,
                    containerClass: "autocomplete-suggestions",
                    tabDisabled: !1,
                    dataType: "text",
                    currentRequest: null,
                    triggerSelectOnValidInput: !0,
                    preventBadQueries: !0,
                    lookupFilter: function(e, t, n) {
                        return -1 !== e.value.toLowerCase().indexOf(n)
                    },
                    paramName: "query",
                    transformResult: function(t) {
                        return "string" == typeof t ? e.parseJSON(t) : t
                    },
                    showNoSuggestionNotice: !1,
                    noSuggestionNotice: "No results",
                    orientation: "bottom",
                    forceFixPosition: !1
                };
            o.element = n, o.el = e(n), o.suggestions = [], o.badQueries = [], o.selectedIndex = -1, o.currentValue = o.element.value, o.intervalId = 0, o.cachedResponse = {}, o.onChangeInterval = null, o.onChange = null, o.isLocal = !1, o.suggestionsContainer = null, o.noSuggestionsContainer = null, o.options = e.extend({}, a, i), o.classes = {
                selected: "autocomplete-selected",
                suggestion: "autocomplete-suggestion"
            }, o.hint = null, o.hintValue = "", o.selection = null, o.initialize(), o.setOptions(i)
        }
        var n = function() {
                return {
                    escapeRegExChars: function(e) {
                        return e.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
                    },
                    createNode: function(e) {
                        var t = document.createElement("div");
                        return t.className = e, t.style.position = "absolute", t.style.display = "none", t
                    }
                }
            }(),
            i = {
                ESC: 27,
                TAB: 9,
                RETURN: 13,
                LEFT: 37,
                UP: 38,
                RIGHT: 39,
                DOWN: 40
            };
        t.utils = n, e.Autocomplete = t, t.formatResult = function(e, t) {
            var i = e.value.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;"),
                r = "(" + n.escapeRegExChars(t) + ")";
            return i.replace(new RegExp(r, "gi"), "<strong>$1</strong>")
        }, t.prototype = {
            killerFn: null,
            initialize: function() {
                var n, i = this,
                    r = "." + i.classes.suggestion,
                    o = i.classes.selected,
                    a = i.options;
                i.element.setAttribute("autocomplete", "off"), i.killerFn = function(t) {
                    0 === e(t.target).closest("." + i.options.containerClass).length && (i.killSuggestions(), i.disableKillerFn())
                }, i.noSuggestionsContainer = e('<div class="autocomplete-no-suggestion"></div>').html(this.options.noSuggestionNotice).get(0), i.suggestionsContainer = t.utils.createNode(a.containerClass), n = e(i.suggestionsContainer), n.appendTo(a.appendTo), "auto" !== a.width && n.width(a.width), n.on("mouseover.autocomplete", r, function() {
                    i.activate(e(this).data("index"))
                }), n.on("mouseout.autocomplete", function() {
                    i.selectedIndex = -1, n.children("." + o).removeClass(o)
                }), n.on("click.autocomplete", r, function() {
                    i.select(e(this).data("index"))
                }), i.fixPositionCapture = function() {
                    i.visible && i.fixPosition()
                }, e(window).on("resize.autocomplete", i.fixPositionCapture), i.el.on("keydown.autocomplete", function(e) {
                    i.onKeyPress(e)
                }), i.el.on("keyup.autocomplete", function(e) {
                    i.onKeyUp(e)
                }), i.el.on("blur.autocomplete", function() {
                    i.onBlur()
                }), i.el.on("focus.autocomplete", function() {
                    i.onFocus()
                }), i.el.on("change.autocomplete", function(e) {
                    i.onKeyUp(e)
                }), i.el.on("input.autocomplete", function(e) {
                    i.onKeyUp(e)
                })
            },
            onFocus: function() {
                var e = this;
                e.fixPosition(), e.options.minChars <= e.el.val().length && e.onValueChange()
            },
            onBlur: function() {
                this.enableKillerFn()
            },
            abortAjax: function() {
                var e = this;
                e.currentRequest && (e.currentRequest.abort(), e.currentRequest = null)
            },
            setOptions: function(t) {
                var n = this,
                    i = n.options;
                e.extend(i, t), n.isLocal = e.isArray(i.lookup), n.isLocal && (i.lookup = n.verifySuggestionsFormat(i.lookup)), i.orientation = n.validateOrientation(i.orientation, "bottom"), e(n.suggestionsContainer).css({
                    "max-height": i.maxHeight + "px",
                    width: i.width + "px",
                    "z-index": i.zIndex
                })
            },
            clearCache: function() {
                this.cachedResponse = {}, this.badQueries = []
            },
            clear: function() {
                this.clearCache(), this.currentValue = "", this.suggestions = []
            },
            disable: function() {
                var e = this;
                e.disabled = !0, clearInterval(e.onChangeInterval), e.abortAjax()
            },
            enable: function() {
                this.disabled = !1
            },
            fixPosition: function() {
                var t = this,
                    n = e(t.suggestionsContainer),
                    i = n.parent().get(0);
                if (i === document.body || t.options.forceFixPosition) {
                    var r = t.options.orientation,
                        o = n.outerHeight(),
                        a = t.el.outerHeight(),
                        s = t.el.offset(),
                        l = {
                            top: s.top,
                            left: s.left
                        };
                    if ("auto" === r) {
                        var c = e(window).height(),
                            u = e(window).scrollTop(),
                            d = -u + s.top - o,
                            p = u + c - (s.top + a + o);
                        r = Math.max(d, p) === d ? "top" : "bottom"
                    }
                    if (l.top += "top" === r ? -o : a, i !== document.body) {
                        var f, h = n.css("opacity");
                        t.visible || n.css("opacity", 0).show(), f = n.offsetParent().offset(), l.top -= f.top, l.left -= f.left, t.visible || n.css("opacity", h).hide()
                    }
                    "auto" === t.options.width && (l.width = t.el.outerWidth() - 2 + "px"), n.css(l)
                }
            },
            enableKillerFn: function() {
                var t = this;
                e(document).on("click.autocomplete", t.killerFn)
            },
            disableKillerFn: function() {
                var t = this;
                e(document).off("click.autocomplete", t.killerFn)
            },
            killSuggestions: function() {
                var e = this;
                e.stopKillSuggestions(), e.intervalId = window.setInterval(function() {
                    e.hide(), e.stopKillSuggestions()
                }, 50)
            },
            stopKillSuggestions: function() {
                window.clearInterval(this.intervalId)
            },
            isCursorAtEnd: function() {
                var e, t = this,
                    n = t.el.val().length,
                    i = t.element.selectionStart;
                return "number" == typeof i ? i === n : document.selection ? (e = document.selection.createRange(), e.moveStart("character", -n), n === e.text.length) : !0
            },
            onKeyPress: function(e) {
                var t = this;
                if (!t.disabled && !t.visible && e.which === i.DOWN && t.currentValue) return void t.suggest();
                if (!t.disabled && t.visible) {
                    switch (e.which) {
                        case i.ESC:
                            t.el.val(t.currentValue), t.hide();
                            break;
                        case i.RIGHT:
                            if (t.hint && t.options.onHint && t.isCursorAtEnd()) {
                                t.selectHint();
                                break
                            }
                            return;
                        case i.TAB:
                            if (t.hint && t.options.onHint) return void t.selectHint();
                            if (-1 === t.selectedIndex) return void t.hide();
                            if (t.select(t.selectedIndex), t.options.tabDisabled === !1) return;
                            break;
                        case i.RETURN:
                            if (-1 === t.selectedIndex) return void t.hide();
                            t.select(t.selectedIndex);
                            break;
                        case i.UP:
                            t.moveUp();
                            break;
                        case i.DOWN:
                            t.moveDown();
                            break;
                        default:
                            return
                    }
                    e.stopImmediatePropagation(), e.preventDefault()
                }
            },
            onKeyUp: function(e) {
                var t = this;
                if (!t.disabled) {
                    switch (e.which) {
                        case i.UP:
                        case i.DOWN:
                            return
                    }
                    clearInterval(t.onChangeInterval), t.currentValue !== t.el.val() && (t.findBestHint(), t.options.deferRequestBy > 0 ? t.onChangeInterval = setInterval(function() {
                        t.onValueChange()
                    }, t.options.deferRequestBy) : t.onValueChange())
                }
            },
            onValueChange: function() {
                var t, n = this,
                    i = n.options,
                    r = n.el.val(),
                    o = n.getQuery(r);
                return n.selection && n.currentValue !== o && (n.selection = null, (i.onInvalidateSelection || e.noop).call(n.element)), clearInterval(n.onChangeInterval), n.currentValue = r, n.selectedIndex = -1, i.triggerSelectOnValidInput && (t = n.findSuggestionIndex(o), -1 !== t) ? void n.select(t) : void(o.length < i.minChars ? n.hide() : n.getSuggestions(o))
            },
            findSuggestionIndex: function(t) {
                var n = this,
                    i = -1,
                    r = t.toLowerCase();
                return e.each(n.suggestions, function(e, t) {
                    return t.value.toLowerCase() === r ? (i = e, !1) : void 0
                }), i
            },
            getQuery: function(t) {
                var n, i = this.options.delimiter;
                return i ? (n = t.split(i), e.trim(n[n.length - 1])) : t
            },
            getSuggestionsLocal: function(t) {
                var n, i = this,
                    r = i.options,
                    o = t.toLowerCase(),
                    a = r.lookupFilter,
                    s = parseInt(r.lookupLimit, 10);
                return n = {
                    suggestions: e.grep(r.lookup, function(e) {
                        return a(e, t, o)
                    })
                }, s && n.suggestions.length > s && (n.suggestions = n.suggestions.slice(0, s)), n
            },
            getSuggestions: function(t) {
                var n, i, r, o, a = this,
                    s = a.options,
                    l = s.serviceUrl;
                if (s.params[s.paramName] = t, i = s.ignoreParams ? null : s.params, s.onSearchStart.call(a.element, s.params) !== !1) {
                    if (e.isFunction(s.lookup)) return void s.lookup(t, function(e) {
                        a.suggestions = e.suggestions, a.suggest(), s.onSearchComplete.call(a.element, t, e.suggestions)
                    });
                    a.isLocal ? n = a.getSuggestionsLocal(t) : (e.isFunction(l) && (l = l.call(a.element, t)), r = l + "?" + e.param(i || {}), n = a.cachedResponse[r]), n && e.isArray(n.suggestions) ? (a.suggestions = n.suggestions, a.suggest(), s.onSearchComplete.call(a.element, t, n.suggestions)) : a.isBadQuery(t) ? s.onSearchComplete.call(a.element, t, []) : (a.abortAjax(), o = {
                        url: l,
                        data: i,
                        type: s.type,
                        dataType: s.dataType
                    }, e.extend(o, s.ajaxSettings), a.currentRequest = e.ajax(o).done(function(e) {
                        var n;
                        a.currentRequest = null, n = s.transformResult(e), a.processResponse(n, t, r), s.onSearchComplete.call(a.element, t, n.suggestions)
                    }).fail(function(e, n, i) {
                        s.onSearchError.call(a.element, t, e, n, i)
                    }))
                }
            },
            isBadQuery: function(e) {
                if (!this.options.preventBadQueries) return !1;
                for (var t = this.badQueries, n = t.length; n--;)
                    if (0 === e.indexOf(t[n])) return !0;
                return !1
            },
            hide: function() {
                var t = this,
                    n = e(t.suggestionsContainer);
                e.isFunction(t.options.onHide) && t.visible && t.options.onHide.call(t.element, n), t.visible = !1, t.selectedIndex = -1, clearInterval(t.onChangeInterval), e(t.suggestionsContainer).hide(), t.signalHint(null)
            },
            suggest: function() {
                if (0 === this.suggestions.length) return void(this.options.showNoSuggestionNotice ? this.noSuggestions() : this.hide());
                var t, n, i = this,
                    r = i.options,
                    o = r.groupBy,
                    a = r.formatResult,
                    s = i.getQuery(i.currentValue),
                    l = i.classes.suggestion,
                    c = i.classes.selected,
                    u = e(i.suggestionsContainer),
                    d = e(i.noSuggestionsContainer),
                    p = r.beforeRender,
                    f = "",
                    h = function(e) {
                        var n = e.data[o];
                        return t === n ? "" : (t = n, '<div class="autocomplete-group"><strong>' + t + "</strong></div>")
                    };
                return r.triggerSelectOnValidInput && (n = i.findSuggestionIndex(s), -1 !== n) ? void i.select(n) : (e.each(i.suggestions, function(e, t) {
                    o && (f += h(t, s, e)), f += '<div class="' + l + '" data-index="' + e + '">' + a(t, s) + "</div>"
                }), this.adjustContainerWidth(), d.detach(), u.html(f), e.isFunction(p) && p.call(i.element, u), i.fixPosition(), u.show(), r.autoSelectFirst && (i.selectedIndex = 0, u.scrollTop(0), u.children("." + l).first().addClass(c)), i.visible = !0, void i.findBestHint())
            },
            noSuggestions: function() {
                var t = this,
                    n = e(t.suggestionsContainer),
                    i = e(t.noSuggestionsContainer);
                this.adjustContainerWidth(), i.detach(), n.empty(), n.append(i), t.fixPosition(), n.show(), t.visible = !0
            },
            adjustContainerWidth: function() {
                var t, n = this,
                    i = n.options,
                    r = e(n.suggestionsContainer);
                "auto" === i.width && (t = n.el.outerWidth() - 2, r.width(t > 0 ? t : 300))
            },
            findBestHint: function() {
                var t = this,
                    n = t.el.val().toLowerCase(),
                    i = null;
                n && (e.each(t.suggestions, function(e, t) {
                    var r = 0 === t.value.toLowerCase().indexOf(n);
                    return r && (i = t), !r
                }), t.signalHint(i))
            },
            signalHint: function(t) {
                var n = "",
                    i = this;
                t && (n = i.currentValue + t.value.substr(i.currentValue.length)), i.hintValue !== n && (i.hintValue = n, i.hint = t, (this.options.onHint || e.noop)(n))
            },
            verifySuggestionsFormat: function(t) {
                return t.length && "string" == typeof t[0] ? e.map(t, function(e) {
                    return {
                        value: e,
                        data: null
                    }
                }) : t
            },
            validateOrientation: function(t, n) {
                return t = e.trim(t || "").toLowerCase(), -1 === e.inArray(t, ["auto", "bottom", "top"]) && (t = n), t
            },
            processResponse: function(e, t, n) {
                var i = this,
                    r = i.options;
                e.suggestions = i.verifySuggestionsFormat(e.suggestions), r.noCache || (i.cachedResponse[n] = e, r.preventBadQueries && 0 === e.suggestions.length && i.badQueries.push(t)), t === i.getQuery(i.currentValue) && (i.suggestions = e.suggestions, i.suggest())
            },
            activate: function(t) {
                var n, i = this,
                    r = i.classes.selected,
                    o = e(i.suggestionsContainer),
                    a = o.find("." + i.classes.suggestion);
                return o.find("." + r).removeClass(r), i.selectedIndex = t, -1 !== i.selectedIndex && a.length > i.selectedIndex ? (n = a.get(i.selectedIndex), e(n).addClass(r), n) : null
            },
            selectHint: function() {
                var t = this,
                    n = e.inArray(t.hint, t.suggestions);
                t.select(n)
            },
            select: function(e) {
                var t = this;
                t.hide(), t.onSelect(e)
            },
            moveUp: function() {
                var t = this;
                return -1 !== t.selectedIndex ? 0 === t.selectedIndex ? (e(t.suggestionsContainer).children().first().removeClass(t.classes.selected), t.selectedIndex = -1, t.el.val(t.currentValue), void t.findBestHint()) : void t.adjustScroll(t.selectedIndex - 1) : void 0
            },
            moveDown: function() {
                var e = this;
                e.selectedIndex !== e.suggestions.length - 1 && e.adjustScroll(e.selectedIndex + 1)
            },
            adjustScroll: function(t) {
                var n = this,
                    i = n.activate(t);
                if (i) {
                    var r, o, a, s = e(i).outerHeight();
                    r = i.offsetTop, o = e(n.suggestionsContainer).scrollTop(), a = o + n.options.maxHeight - s, o > r ? e(n.suggestionsContainer).scrollTop(r) : r > a && e(n.suggestionsContainer).scrollTop(r - n.options.maxHeight + s), n.options.preserveInput || n.el.val(n.getValue(n.suggestions[t].value)), n.signalHint(null)
                }
            },
            onSelect: function(t) {
                var n = this,
                    i = n.options.onSelect,
                    r = n.suggestions[t];
                n.currentValue = n.getValue(r.value), n.currentValue === n.el.val() || n.options.preserveInput || n.el.val(n.currentValue), n.signalHint(null), n.suggestions = [], n.selection = r, e.isFunction(i) && i.call(n.element, r)
            },
            getValue: function(e) {
                var t, n, i = this,
                    r = i.options.delimiter;
                return r ? (t = i.currentValue, n = t.split(r), 1 === n.length ? e : t.substr(0, t.length - n[n.length - 1].length) + e) : e
            },
            dispose: function() {
                var t = this;
                t.el.off(".autocomplete").removeData("autocomplete"), t.disableKillerFn(), e(window).off("resize.autocomplete", t.fixPositionCapture), e(t.suggestionsContainer).remove()
            }
        }, e.fn.autocomplete = e.fn.devbridgeAutocomplete = function(n, i) {
            var r = "autocomplete";
            return 0 === arguments.length ? this.first().data(r) : this.each(function() {
                var o = e(this),
                    a = o.data(r);
                "string" == typeof n ? a && "function" == typeof a[n] && a[n](i) : (a && a.dispose && a.dispose(), a = new t(this, n), o.data(r, a))
            })
        }
    }),
    function() {
        var e = this,
            t = e._,
            n = {},
            i = Array.prototype,
            r = Object.prototype,
            o = Function.prototype,
            a = i.push,
            s = i.slice,
            l = i.concat,
            c = r.toString,
            u = r.hasOwnProperty,
            d = i.forEach,
            p = i.map,
            f = i.reduce,
            h = i.reduceRight,
            g = i.filter,
            m = i.every,
            v = i.some,
            y = i.indexOf,
            b = i.lastIndexOf,
            x = Array.isArray,
            w = Object.keys,
            C = o.bind,
            _ = function(e) {
                return e instanceof _ ? e : this instanceof _ ? void(this._wrapped = e) : new _(e)
            };
        "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = _), exports._ = _) : e._ = _, _.VERSION = "1.6.0";
        var k = _.each = _.forEach = function(e, t, i) {
            if (null == e) return e;
            if (d && e.forEach === d) e.forEach(t, i);
            else if (e.length === +e.length) {
                for (var r = 0, o = e.length; o > r; r++)
                    if (t.call(i, e[r], r, e) === n) return
            } else
                for (var a = _.keys(e), r = 0, o = a.length; o > r; r++)
                    if (t.call(i, e[a[r]], a[r], e) === n) return; return e
        };
        _.map = _.collect = function(e, t, n) {
            var i = [];
            return null == e ? i : p && e.map === p ? e.map(t, n) : (k(e, function(e, r, o) {
                i.push(t.call(n, e, r, o))
            }), i)
        };
        var S = "Reduce of empty array with no initial value";
        _.reduce = _.foldl = _.inject = function(e, t, n, i) {
            var r = arguments.length > 2;
            if (null == e && (e = []), f && e.reduce === f) return i && (t = _.bind(t, i)), r ? e.reduce(t, n) : e.reduce(t);
            if (k(e, function(e, o, a) {
                    r ? n = t.call(i, n, e, o, a) : (n = e, r = !0)
                }), !r) throw new TypeError(S);
            return n
        }, _.reduceRight = _.foldr = function(e, t, n, i) {
            var r = arguments.length > 2;
            if (null == e && (e = []), h && e.reduceRight === h) return i && (t = _.bind(t, i)), r ? e.reduceRight(t, n) : e.reduceRight(t);
            var o = e.length;
            if (o !== +o) {
                var a = _.keys(e);
                o = a.length
            }
            if (k(e, function(s, l, c) {
                    l = a ? a[--o] : --o, r ? n = t.call(i, n, e[l], l, c) : (n = e[l], r = !0)
                }), !r) throw new TypeError(S);
            return n
        }, _.find = _.detect = function(e, t, n) {
            var i;
            return T(e, function(e, r, o) {
                return t.call(n, e, r, o) ? (i = e, !0) : void 0
            }), i
        }, _.filter = _.select = function(e, t, n) {
            var i = [];
            return null == e ? i : g && e.filter === g ? e.filter(t, n) : (k(e, function(e, r, o) {
                t.call(n, e, r, o) && i.push(e)
            }), i)
        }, _.reject = function(e, t, n) {
            return _.filter(e, function(e, i, r) {
                return !t.call(n, e, i, r)
            }, n)
        }, _.every = _.all = function(e, t, i) {
            t || (t = _.identity);
            var r = !0;
            return null == e ? r : m && e.every === m ? e.every(t, i) : (k(e, function(e, o, a) {
                return (r = r && t.call(i, e, o, a)) ? void 0 : n
            }), !!r)
        };
        var T = _.some = _.any = function(e, t, i) {
            t || (t = _.identity);
            var r = !1;
            return null == e ? r : v && e.some === v ? e.some(t, i) : (k(e, function(e, o, a) {
                return r || (r = t.call(i, e, o, a)) ? n : void 0
            }), !!r)
        };
        _.contains = _.include = function(e, t) {
            return null == e ? !1 : y && e.indexOf === y ? -1 != e.indexOf(t) : T(e, function(e) {
                return e === t
            })
        }, _.invoke = function(e, t) {
            var n = s.call(arguments, 2),
                i = _.isFunction(t);
            return _.map(e, function(e) {
                return (i ? t : e[t]).apply(e, n)
            })
        }, _.pluck = function(e, t) {
            return _.map(e, _.property(t))
        }, _.where = function(e, t) {
            return _.filter(e, _.matches(t))
        }, _.findWhere = function(e, t) {
            return _.find(e, _.matches(t))
        }, _.max = function(e, t, n) {
            if (!t && _.isArray(e) && e[0] === +e[0] && e.length < 65535) return Math.max.apply(Math, e);
            var i = -1 / 0,
                r = -1 / 0;
            return k(e, function(e, o, a) {
                var s = t ? t.call(n, e, o, a) : e;
                s > r && (i = e, r = s)
            }), i
        }, _.min = function(e, t, n) {
            if (!t && _.isArray(e) && e[0] === +e[0] && e.length < 65535) return Math.min.apply(Math, e);
            var i = 1 / 0,
                r = 1 / 0;
            return k(e, function(e, o, a) {
                var s = t ? t.call(n, e, o, a) : e;
                r > s && (i = e, r = s)
            }), i
        }, _.shuffle = function(e) {
            var t, n = 0,
                i = [];
            return k(e, function(e) {
                t = _.random(n++), i[n - 1] = i[t], i[t] = e
            }), i
        }, _.sample = function(e, t, n) {
            return null == t || n ? (e.length !== +e.length && (e = _.values(e)), e[_.random(e.length - 1)]) : _.shuffle(e).slice(0, Math.max(0, t))
        };
        var $ = function(e) {
            return null == e ? _.identity : _.isFunction(e) ? e : _.property(e)
        };
        _.sortBy = function(e, t, n) {
            return t = $(t), _.pluck(_.map(e, function(e, i, r) {
                return {
                    value: e,
                    index: i,
                    criteria: t.call(n, e, i, r)
                }
            }).sort(function(e, t) {
                var n = e.criteria,
                    i = t.criteria;
                if (n !== i) {
                    if (n > i || void 0 === n) return 1;
                    if (i > n || void 0 === i) return -1
                }
                return e.index - t.index
            }), "value")
        };
        var A = function(e) {
            return function(t, n, i) {
                var r = {};
                return n = $(n), k(t, function(o, a) {
                    var s = n.call(i, o, a, t);
                    e(r, s, o)
                }), r
            }
        };
        _.groupBy = A(function(e, t, n) {
            _.has(e, t) ? e[t].push(n) : e[t] = [n]
        }), _.indexBy = A(function(e, t, n) {
            e[t] = n
        }), _.countBy = A(function(e, t) {
            _.has(e, t) ? e[t]++ : e[t] = 1
        }), _.sortedIndex = function(e, t, n, i) {
            n = $(n);
            for (var r = n.call(i, t), o = 0, a = e.length; a > o;) {
                var s = o + a >>> 1;
                n.call(i, e[s]) < r ? o = s + 1 : a = s
            }
            return o
        }, _.toArray = function(e) {
            return e ? _.isArray(e) ? s.call(e) : e.length === +e.length ? _.map(e, _.identity) : _.values(e) : []
        }, _.size = function(e) {
            return null == e ? 0 : e.length === +e.length ? e.length : _.keys(e).length
        }, _.first = _.head = _.take = function(e, t, n) {
            return null == e ? void 0 : null == t || n ? e[0] : 0 > t ? [] : s.call(e, 0, t)
        }, _.initial = function(e, t, n) {
            return s.call(e, 0, e.length - (null == t || n ? 1 : t))
        }, _.last = function(e, t, n) {
            return null == e ? void 0 : null == t || n ? e[e.length - 1] : s.call(e, Math.max(e.length - t, 0))
        }, _.rest = _.tail = _.drop = function(e, t, n) {
            return s.call(e, null == t || n ? 1 : t)
        }, _.compact = function(e) {
            return _.filter(e, _.identity)
        };
        var E = function(e, t, n) {
            return t && _.every(e, _.isArray) ? l.apply(n, e) : (k(e, function(e) {
                _.isArray(e) || _.isArguments(e) ? t ? a.apply(n, e) : E(e, t, n) : n.push(e)
            }), n)
        };
        _.flatten = function(e, t) {
            return E(e, t, [])
        }, _.without = function(e) {
            return _.difference(e, s.call(arguments, 1))
        }, _.partition = function(e, t) {
            var n = [],
                i = [];
            return k(e, function(e) {
                (t(e) ? n : i).push(e)
            }), [n, i]
        }, _.uniq = _.unique = function(e, t, n, i) {
            _.isFunction(t) && (i = n, n = t, t = !1);
            var r = n ? _.map(e, n, i) : e,
                o = [],
                a = [];
            return k(r, function(n, i) {
                (t ? i && a[a.length - 1] === n : _.contains(a, n)) || (a.push(n), o.push(e[i]))
            }), o
        }, _.union = function() {
            return _.uniq(_.flatten(arguments, !0))
        }, _.intersection = function(e) {
            var t = s.call(arguments, 1);
            return _.filter(_.uniq(e), function(e) {
                return _.every(t, function(t) {
                    return _.contains(t, e)
                })
            })
        }, _.difference = function(e) {
            var t = l.apply(i, s.call(arguments, 1));
            return _.filter(e, function(e) {
                return !_.contains(t, e)
            })
        }, _.zip = function() {
            for (var e = _.max(_.pluck(arguments, "length").concat(0)), t = new Array(e), n = 0; e > n; n++) t[n] = _.pluck(arguments, "" + n);
            return t
        }, _.object = function(e, t) {
            if (null == e) return {};
            for (var n = {}, i = 0, r = e.length; r > i; i++) t ? n[e[i]] = t[i] : n[e[i][0]] = e[i][1];
            return n
        }, _.indexOf = function(e, t, n) {
            if (null == e) return -1;
            var i = 0,
                r = e.length;
            if (n) {
                if ("number" != typeof n) return i = _.sortedIndex(e, t), e[i] === t ? i : -1;
                i = 0 > n ? Math.max(0, r + n) : n
            }
            if (y && e.indexOf === y) return e.indexOf(t, n);
            for (; r > i; i++)
                if (e[i] === t) return i;
            return -1
        }, _.lastIndexOf = function(e, t, n) {
            if (null == e) return -1;
            var i = null != n;
            if (b && e.lastIndexOf === b) return i ? e.lastIndexOf(t, n) : e.lastIndexOf(t);
            for (var r = i ? n : e.length; r--;)
                if (e[r] === t) return r;
            return -1
        }, _.range = function(e, t, n) {
            arguments.length <= 1 && (t = e || 0, e = 0), n = arguments[2] || 1;
            for (var i = Math.max(Math.ceil((t - e) / n), 0), r = 0, o = new Array(i); i > r;) o[r++] = e, e += n;
            return o
        };
        var N = function() {};
        _.bind = function(e, t) {
            var n, i;
            if (C && e.bind === C) return C.apply(e, s.call(arguments, 1));
            if (!_.isFunction(e)) throw new TypeError;
            return n = s.call(arguments, 2), i = function() {
                if (!(this instanceof i)) return e.apply(t, n.concat(s.call(arguments)));
                N.prototype = e.prototype;
                var r = new N;
                N.prototype = null;
                var o = e.apply(r, n.concat(s.call(arguments)));
                return Object(o) === o ? o : r
            }
        }, _.partial = function(e) {
            var t = s.call(arguments, 1);
            return function() {
                for (var n = 0, i = t.slice(), r = 0, o = i.length; o > r; r++) i[r] === _ && (i[r] = arguments[n++]);
                for (; n < arguments.length;) i.push(arguments[n++]);
                return e.apply(this, i)
            }
        }, _.bindAll = function(e) {
            var t = s.call(arguments, 1);
            if (0 === t.length) throw new Error("bindAll must be passed function names");
            return k(t, function(t) {
                e[t] = _.bind(e[t], e)
            }), e
        }, _.memoize = function(e, t) {
            var n = {};
            return t || (t = _.identity),
                function() {
                    var i = t.apply(this, arguments);
                    return _.has(n, i) ? n[i] : n[i] = e.apply(this, arguments)
                }
        }, _.delay = function(e, t) {
            var n = s.call(arguments, 2);
            return setTimeout(function() {
                return e.apply(null, n)
            }, t)
        }, _.defer = function(e) {
            return _.delay.apply(_, [e, 1].concat(s.call(arguments, 1)))
        }, _.throttle = function(e, t, n) {
            var i, r, o, a = null,
                s = 0;
            n || (n = {});
            var l = function() {
                s = n.leading === !1 ? 0 : _.now(), a = null, o = e.apply(i, r), i = r = null
            };
            return function() {
                var c = _.now();
                s || n.leading !== !1 || (s = c);
                var u = t - (c - s);
                return i = this, r = arguments, 0 >= u ? (clearTimeout(a), a = null, s = c, o = e.apply(i, r), i = r = null) : a || n.trailing === !1 || (a = setTimeout(l, u)), o
            }
        }, _.debounce = function(e, t, n) {
            var i, r, o, a, s, l = function() {
                var c = _.now() - a;
                t > c ? i = setTimeout(l, t - c) : (i = null, n || (s = e.apply(o, r), o = r = null))
            };
            return function() {
                o = this, r = arguments, a = _.now();
                var c = n && !i;
                return i || (i = setTimeout(l, t)), c && (s = e.apply(o, r), o = r = null), s
            }
        }, _.once = function(e) {
            var t, n = !1;
            return function() {
                return n ? t : (n = !0, t = e.apply(this, arguments), e = null, t)
            }
        }, _.wrap = function(e, t) {
            return _.partial(t, e)
        }, _.compose = function() {
            var e = arguments;
            return function() {
                for (var t = arguments, n = e.length - 1; n >= 0; n--) t = [e[n].apply(this, t)];
                return t[0]
            }
        }, _.after = function(e, t) {
            return function() {
                return --e < 1 ? t.apply(this, arguments) : void 0
            }
        }, _.keys = function(e) {
            if (!_.isObject(e)) return [];
            if (w) return w(e);
            var t = [];
            for (var n in e) _.has(e, n) && t.push(n);
            return t
        }, _.values = function(e) {
            for (var t = _.keys(e), n = t.length, i = new Array(n), r = 0; n > r; r++) i[r] = e[t[r]];
            return i
        }, _.pairs = function(e) {
            for (var t = _.keys(e), n = t.length, i = new Array(n), r = 0; n > r; r++) i[r] = [t[r], e[t[r]]];
            return i
        }, _.invert = function(e) {
            for (var t = {}, n = _.keys(e), i = 0, r = n.length; r > i; i++) t[e[n[i]]] = n[i];
            return t
        }, _.functions = _.methods = function(e) {
            var t = [];
            for (var n in e) _.isFunction(e[n]) && t.push(n);
            return t.sort()
        }, _.extend = function(e) {
            return k(s.call(arguments, 1), function(t) {
                if (t)
                    for (var n in t) e[n] = t[n]
            }), e
        }, _.pick = function(e) {
            var t = {},
                n = l.apply(i, s.call(arguments, 1));
            return k(n, function(n) {
                n in e && (t[n] = e[n])
            }), t
        }, _.omit = function(e) {
            var t = {},
                n = l.apply(i, s.call(arguments, 1));
            for (var r in e) _.contains(n, r) || (t[r] = e[r]);
            return t
        }, _.defaults = function(e) {
            return k(s.call(arguments, 1), function(t) {
                if (t)
                    for (var n in t) void 0 === e[n] && (e[n] = t[n])
            }), e
        }, _.clone = function(e) {
            return _.isObject(e) ? _.isArray(e) ? e.slice() : _.extend({}, e) : e
        }, _.tap = function(e, t) {
            return t(e), e
        };
        var O = function(e, t, n, i) {
            if (e === t) return 0 !== e || 1 / e == 1 / t;
            if (null == e || null == t) return e === t;
            e instanceof _ && (e = e._wrapped), t instanceof _ && (t = t._wrapped);
            var r = c.call(e);
            if (r != c.call(t)) return !1;
            switch (r) {
                case "[object String]":
                    return e == String(t);
                case "[object Number]":
                    return e != +e ? t != +t : 0 == e ? 1 / e == 1 / t : e == +t;
                case "[object Date]":
                case "[object Boolean]":
                    return +e == +t;
                case "[object RegExp]":
                    return e.source == t.source && e.global == t.global && e.multiline == t.multiline && e.ignoreCase == t.ignoreCase
            }
            if ("object" != typeof e || "object" != typeof t) return !1;
            for (var o = n.length; o--;)
                if (n[o] == e) return i[o] == t;
            var a = e.constructor,
                s = t.constructor;
            if (a !== s && !(_.isFunction(a) && a instanceof a && _.isFunction(s) && s instanceof s) && "constructor" in e && "constructor" in t) return !1;
            n.push(e), i.push(t);
            var l = 0,
                u = !0;
            if ("[object Array]" == r) {
                if (l = e.length, u = l == t.length)
                    for (; l-- && (u = O(e[l], t[l], n, i)););
            } else {
                for (var d in e)
                    if (_.has(e, d) && (l++, !(u = _.has(t, d) && O(e[d], t[d], n, i)))) break;
                if (u) {
                    for (d in t)
                        if (_.has(t, d) && !l--) break;
                    u = !l
                }
            }
            return n.pop(), i.pop(), u
        };
        _.isEqual = function(e, t) {
            return O(e, t, [], [])
        }, _.isEmpty = function(e) {
            if (null == e) return !0;
            if (_.isArray(e) || _.isString(e)) return 0 === e.length;
            for (var t in e)
                if (_.has(e, t)) return !1;
            return !0
        }, _.isElement = function(e) {
            return !(!e || 1 !== e.nodeType)
        }, _.isArray = x || function(e) {
            return "[object Array]" == c.call(e)
        }, _.isObject = function(e) {
            return e === Object(e)
        }, k(["Arguments", "Function", "String", "Number", "Date", "RegExp"], function(e) {
            _["is" + e] = function(t) {
                return c.call(t) == "[object " + e + "]"
            }
        }), _.isArguments(arguments) || (_.isArguments = function(e) {
            return !(!e || !_.has(e, "callee"))
        }), "function" != typeof /./ && (_.isFunction = function(e) {
            return "function" == typeof e
        }), _.isFinite = function(e) {
            return isFinite(e) && !isNaN(parseFloat(e))
        }, _.isNaN = function(e) {
            return _.isNumber(e) && e != +e
        }, _.isBoolean = function(e) {
            return e === !0 || e === !1 || "[object Boolean]" == c.call(e)
        }, _.isNull = function(e) {
            return null === e
        }, _.isUndefined = function(e) {
            return void 0 === e
        }, _.has = function(e, t) {
            return u.call(e, t)
        }, _.noConflict = function() {
            return e._ = t, this
        }, _.identity = function(e) {
            return e
        }, _.constant = function(e) {
            return function() {
                return e
            }
        }, _.property = function(e) {
            return function(t) {
                return t[e]
            }
        }, _.matches = function(e) {
            return function(t) {
                if (t === e) return !0;
                for (var n in e)
                    if (e[n] !== t[n]) return !1;
                return !0
            }
        }, _.times = function(e, t, n) {
            for (var i = Array(Math.max(0, e)), r = 0; e > r; r++) i[r] = t.call(n, r);
            return i
        }, _.random = function(e, t) {
            return null == t && (t = e, e = 0), e + Math.floor(Math.random() * (t - e + 1))
        }, _.now = Date.now || function() {
            return (new Date).getTime()
        };
        var P = {
            escape: {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;"
            }
        };
        P.unescape = _.invert(P.escape);
        var I = {
            escape: new RegExp("[" + _.keys(P.escape).join("") + "]", "g"),
            unescape: new RegExp("(" + _.keys(P.unescape).join("|") + ")", "g")
        };
        _.each(["escape", "unescape"], function(e) {
            _[e] = function(t) {
                return null == t ? "" : ("" + t).replace(I[e], function(t) {
                    return P[e][t]
                })
            }
        }), _.result = function(e, t) {
            if (null == e) return void 0;
            var n = e[t];
            return _.isFunction(n) ? n.call(e) : n
        }, _.mixin = function(e) {
            k(_.functions(e), function(t) {
                var n = _[t] = e[t];
                _.prototype[t] = function() {
                    var e = [this._wrapped];
                    return a.apply(e, arguments), H.call(this, n.apply(_, e))
                }
            })
        };
        var j = 0;
        _.uniqueId = function(e) {
            var t = ++j + "";
            return e ? e + t : t
        }, _.templateSettings = {
            evaluate: /<%([\s\S]+?)%>/g,
            interpolate: /<%=([\s\S]+?)%>/g,
            escape: /<%-([\s\S]+?)%>/g
        };
        var D = /(.)^/,
            M = {
                "'": "'",
                "\\": "\\",
                "\r": "r",
                "\n": "n",
                "	": "t",
                "\u2028": "u2028",
                "\u2029": "u2029"
            },
            F = /\\|'|\r|\n|\t|\u2028|\u2029/g;
        _.template = function(e, t, n) {
            var i;
            n = _.defaults({}, n, _.templateSettings);
            var r = new RegExp([(n.escape || D).source, (n.interpolate || D).source, (n.evaluate || D).source].join("|") + "|$", "g"),
                o = 0,
                a = "__p+='";
            e.replace(r, function(t, n, i, r, s) {
                return a += e.slice(o, s).replace(F, function(e) {
                    return "\\" + M[e]
                }), n && (a += "'+\n((__t=(" + n + "))==null?'':_.escape(__t))+\n'"), i && (a += "'+\n((__t=(" + i + "))==null?'':__t)+\n'"), r && (a += "';\n" + r + "\n__p+='"), o = s + t.length, t
            }), a += "';\n", n.variable || (a = "with(obj||{}){\n" + a + "}\n"), a = "var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n" + a + "return __p;\n";
            try {
                i = new Function(n.variable || "obj", "_", a)
            } catch (s) {
                throw s.source = a, s
            }
            if (t) return i(t, _);
            var l = function(e) {
                return i.call(this, e, _)
            };
            return l.source = "function(" + (n.variable || "obj") + "){\n" + a + "}", l
        }, _.chain = function(e) {
            return _(e).chain()
        };
        var H = function(e) {
            return this._chain ? _(e).chain() : e
        };
        _.mixin(_), k(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function(e) {
            var t = i[e];
            _.prototype[e] = function() {
                var n = this._wrapped;
                return t.apply(n, arguments), "shift" != e && "splice" != e || 0 !== n.length || delete n[0], H.call(this, n)
            }
        }), k(["concat", "join", "slice"], function(e) {
            var t = i[e];
            _.prototype[e] = function() {
                return H.call(this, t.apply(this._wrapped, arguments))
            }
        }), _.extend(_.prototype, {
            chain: function() {
                return this._chain = !0, this
            },
            value: function() {
                return this._wrapped
            }
        }), "function" == typeof define && define.amd && define("underscore", [], function() {
            return _
        })
    }.call(this);
var PourOver = function() {
    PourOver = {
        union_sorted: function(e, t) {
            for (var n, i, r = 0, o = 0, a = e.length, s = t.length, l = []; a > r || s > o;) {
                if (n = e[r], i = t[o], _.isUndefined(n) && (n = 1 / 0), _.isUndefined(i) && (i = 1 / 0), r == a) return l.concat(t.slice(o, s));
                if (o == s) return l.concat(e.slice(r, a));
                n == i ? (l.push(n), r++, o++) : i > n ? (l.push(n), r++) : (l.push(i), o++)
            }
            return l
        },
        intersect_sorted: function(e, t) {
            for (var n, i, r = 0, o = 0, a = e.length, s = t.length, l = []; a > r && s > o;) n = e[r], i = t[o], n == i ? (l.push(n), r++, o++) : i > n ? r++ : o++;
            return l
        },
        subtract_sorted: function(e, t) {
            for (var n, i, r = 0, o = 0, a = e.length, s = t.length, l = []; a > r || s > o;) {
                if (n = e[r], i = t[o], a == r) return l;
                if (s == o) return l.concat(e.slice(r, a));
                n == i ? (r++, o++) : i > n ? (l.push(n), r++) : o++
            }
            return l
        },
        insert_sorted: function(e, t) {
            var n = e.length,
                i = 0,
                r = e[n - 1];
            if (t > r) return e.push(t), e;
            for (; n > i;) {
                if (t < e[i]) return e.slice(0, i).concat([t]).concat(e.slice(i, n));
                i++
            }
            return e.push(t), e
        },
        build_permutation_array: function(e, t) {
            var n = _(e).clone(),
                i = [];
            return n.sort("function" == typeof t ? t : function(e, n) {
                return t.fn.call(t, e, n)
            }), _(n).each(function(e, t) {
                i[e.cid] = t
            }), i
        },
        permute_from_array: function(e, t) {
            var n = [];
            return _(e).each("number" == typeof e[0] ? function(e) {
                n[t[e]] = e
            } : function(e) {
                n[t[e.cid]] = e
            }), _(n).without(void 0)
        },
        remove_sorted: function(e, t) {
            for (var n = e.length, i = 0; n > i;) {
                if (t == e[i]) return e.slice(0, i).concat(e.slice(i + 1, n));
                i++
            }
            return e
        },
        cacheMethods: {
            defaultCache: function(e) {
                var t = this;
                _(t.possibilities).each(function(n) {
                    var i = _(e).filter(function(e) {
                            return t.fn(n, e)
                        }),
                        r = _(i).map(function(e) {
                            return e.cid
                        });
                    n.matching_cids = r
                })
            },
            defaultAddCache: function(e) {
                var t = this;
                _(t.possibilities).each(function(n) {
                    var i = _(e).filter(function(e) {
                            return t.fn(n, e)
                        }),
                        r = _(i).map(function(e) {
                            return e.cid
                        });
                    n.matching_cids = PourOver.union_sorted(n.matching_cids, r)
                })
            },
            exactCache: function(e) {
                var t = this,
                    n = this.attr || this.name;
                _(e).each(function(e) {
                    var i = t.possibilities[e[n]];
                    i && (i.matching_cids = PourOver.insert_sorted(i.matching_cids, e.cid))
                })
            },
            exactAddCache: function(e) {
                PourOver.cacheMethods.exactCache.call(this, e)
            },
            inclusionCache: function(e) {
                var t = this,
                    n = this.attr || this.name;
                _(e).each(function(e) {
                    _(e[n]).each(function(n) {
                        var i = t.possibilities[n];
                        i && (i.matching_cids = PourOver.insert_sorted(i.matching_cids, e.cid))
                    })
                })
            },
            inclusionAddCache: function(e) {
                PourOver.cacheMethods.inclusionCache.call(this, e)
            }
        }
    };
    var e = [],
        t = (e.push, e.slice),
        n = (e.splice, PourOver.Events = {
            on: function(e, t, n) {
                if (!r(this, "on", e, [t, n]) || !t) return this;
                this._events || (this._events = {});
                var i = this._events[e] || (this._events[e] = []);
                return i.push({
                    callback: t,
                    context: n,
                    ctx: n || this
                }), this
            },
            once: function(e, t, n) {
                if (!r(this, "once", e, [t, n]) || !t) return this;
                var i = this,
                    o = _.once(function() {
                        i.off(e, o), t.apply(this, arguments)
                    });
                return o._callback = t, this.on(e, o, n)
            },
            off: function(e, t, n) {
                var i, o, a, s, l, c, u, d;
                if (!this._events || !r(this, "off", e, [t, n])) return this;
                if (!e && !t && !n) return this._events = void 0, this;
                for (s = e ? [e] : _.keys(this._events), l = 0, c = s.length; c > l; l++)
                    if (e = s[l], a = this._events[e]) {
                        if (this._events[e] = i = [], t || n)
                            for (u = 0, d = a.length; d > u; u++) o = a[u], (t && t !== o.callback && t !== o.callback._callback || n && n !== o.context) && i.push(o);
                        i.length || delete this._events[e]
                    }
                return this
            },
            trigger: function(e) {
                if (!this._events) return this;
                var n = t.call(arguments, 1);
                if (!r(this, "trigger", e, n)) return this;
                var i = this._events[e],
                    a = this._events.all;
                return i && o(i, n), a && o(a, arguments), this
            },
            stopListening: function(e, t, n) {
                var i = this._listeningTo;
                if (!i) return this;
                var r = !t && !n;
                n || "object" != typeof t || (n = this), e && ((i = {})[e._listenId] = e);
                for (var o in i) e = i[o], e.off(t, n, this), (r || _.isEmpty(e._events)) && delete this._listeningTo[o];
                return this
            }
        }),
        i = /\s+/,
        r = function(e, t, n, r) {
            if (!n) return !0;
            if ("object" == typeof n) {
                for (var o in n) e[t].apply(e, [o, n[o]].concat(r));
                return !1
            }
            if (i.test(n)) {
                for (var a = n.split(i), s = 0, l = a.length; l > s; s++) e[t].apply(e, [a[s]].concat(r));
                return !1
            }
            return !0
        },
        o = function(e, t) {
            var n, i = -1,
                r = e.length,
                o = t[0],
                a = t[1],
                s = t[2];
            switch (t.length) {
                case 0:
                    for (; ++i < r;)(n = e[i]).callback.call(n.ctx);
                    return;
                case 1:
                    for (; ++i < r;)(n = e[i]).callback.call(n.ctx, o);
                    return;
                case 2:
                    for (; ++i < r;)(n = e[i]).callback.call(n.ctx, o, a);
                    return;
                case 3:
                    for (; ++i < r;)(n = e[i]).callback.call(n.ctx, o, a, s);
                    return;
                default:
                    for (; ++i < r;)(n = e[i]).callback.apply(n.ctx, t);
                    return
            }
        },
        a = {
            listenTo: "on",
            listenToOnce: "once"
        };
    return _.each(a, function(e, t) {
        n[t] = function(t, n, i) {
            var r = this._listeningTo || (this._listeningTo = {}),
                o = t._listenId || (t._listenId = _.uniqueId("l"));
            return r[o] = t, i || "object" != typeof n || (i = this), t[e](n, i, this), this
        }
    }), n.bind = n.on, n.unbind = n.off, _.extend(PourOver, n), PourOver.Collection = function(e) {
        "undefined" == typeof e && (e = []), this.items = [], this.filters = {}, this.sorts = {}, this.addItems(e), this.on("change", function() {
            _(this.filters).each(function(e) {
                e.current_query && e.current_query.refresh()
            })
        }), this.initialize.apply(this, arguments)
    }, _.extend(PourOver.Collection.prototype, PourOver.Events, {
        initialize: function() {},
        refresh: function() {
            this.trigger("queryChange")
        },
        get: function(e) {
            return PourOver.Collection.prototype.getBy.call(this, "cid", e, !0)
        },
        getBy: function(e, t, n) {
            if (!_.isArray(t)) var t = [t];
            "undefined" == typeof n && (n = !1);
            var i, r = 0,
                o = this.items.length,
                a = 0,
                s = t.length,
                l = [],
                c = this.items;
            if (1 == n)
                for (; o > r && s > a;) t[a] == (i = c[r])[e] ? (l.push(i), r++, a++) : t[a] < i[e] ? a++ : r++;
            else if ("reverse" == n)
                for (; o > r && s > a;) t[a] == (i = c[r])[e] ? (l.push(i), r++, a++) : t[a] > i[e] ? a++ : r++;
            else
                for (; o > r && s > a;) _(t).include((i = c[r])[e]) ? (l.push(i), t = _(t).without(i[e]), r++, a++) : r++;
            return l
        },
        addItems: function(e) {
            if (this.trigger("will_change"), !_.isArray(e)) var e = [e];
            var t, n = this.items.length > 0 ? _(this.items).last().cid + 1 : 0;
            t = _(e).map(function(e) {
                var t = PourOver.Item(e);
                return t.cid = n++, t
            }), this.items = this.items.concat(t), this.regenerateFilterSets(t), this.trigger("change")
        },
        removeItems: function(e, t) {
            if (this.trigger("will_change"), "undefined" == typeof t) var t = !1;
            if (!_.isArray(e)) var e = [e];
            if (t) {
                e = e.sort(function(e, t) {
                    return e.cid - t.cid
                });
                for (var n = [], i = this.items, r = e.length, o = this.items.length, a = 0, s = 0; o > s;) {
                    if (r > !a) {
                        n = n.concat(i.slice(s));
                        break
                    }
                    i[s].cid === e[a].cid ? (a++, s++) : (n.push(i[s]), s++)
                }
            } else
                for (var n = [], i = this.items, o = this.items.length, s = 0, l = _(e).pluck("cid"); o > s && l.length > 0;) _(l).include(i[s].cid) || n.push(i[s]), s++;
            this.items = n, this.regenerateFilterSets(), this.trigger("change")
        },
        addFilters: function(e) {
            var t, n = this;
            if (!_.isArray(e)) var e = [e];
            t = _(e).reduce(function(e, t) {
                return e[t.name] = _.clone(t), e[t.name].collection = n, e
            }, {}), this.filters = _(this.filters).extend(t), _(t).each(function(e) {
                e.on("queryChange", function() {
                    n.trigger("queryChange")
                }), e.cacheResults(n.items), e.associated_attrs && _(e.associated_attrs).each(function(t) {
                    n.on("change:" + t, function(t) {
                        e.removeFromCache(t), e.addCacheResults(t), e.current_query && e.current_query.refresh()
                    })
                })
            })
        },
        regenerateFilterSets: function(e) {
            var t = this;
            _(this.filters).each("undefined" == typeof e ? function(e) {
                e.cacheResults(t.items)
            } : function(t) {
                t.addCacheResults(e)
            })
        },
        getAllItems: function() {
            var e = _(this.items).map(function(e) {
                return e.cid
            });
            return new PourOver.MatchSet(e, this, ["all"])
        },
        getCurrentFilteredItems: function(e, t) {
            return "undefined" == typeof t && (t = !1), this.filters[e].current_query && this.filters[e].current_query.stack.length > 0 ? this.filters[e].current_query : t ? new PourOver.MatchSet([], this, []) : this.getAllItems()
        },
        getFilteredItems: function(e, t) {
            var n = this.filters[e];
            if (_.isUndefined(n)) throw "The filter " + e + " does not exist.";
            return n.getFn(t)
        },
        addSort: function(e) {
            var t = this;
            this.sorts[e.name] = e, e.collection = this, e.rebuild_sort(), this.on("change", function() {
                e.rebuild_sort()
            }), e.associated_attrs && _(e.associated_attrs).each(function(n) {
                t.on("change:" + n, function() {
                    e.rebuild_sort()
                })
            })
        },
        addSorts: function(e) {
            "undefined" == typeof opts && (opts = {}), _(e).isArray() || (e = [e]);
            var t = this;
            _(e).each(function(e) {
                t.addSort(e)
            })
        },
        getSortedItems: function(e) {
            var t = this.sorts[e];
            return t.sort(this.items)
        },
        getItemValue: function(e, t) {
            var n = _(this.items).find(function(t) {
                return t.cid === Number(e)
            });
            return n[t]
        },
        updateItem: function(e, t, n) {
            this.trigger("will_incremental_change");
            var i = _(this.items).find(function(t) {
                return t.cid === Number(e)
            });
            return i[t] = n, this.trigger("change:" + t, [i]), this.trigger("incremental_change", [t]), this.trigger("update", "updateItem"), i.guid
        },
        batchUpdateItems: function(e, t, n) {
            this.trigger("will_incremental_change");
            var i = this.get(e, !0);
            return _(i).each(function(e) {
                e[t] = n
            }), this.trigger("change:" + t, i), this.trigger("incremental_change", [t]), this.trigger("update", "batchUpdate"), _(i).pluck("guid")
        },
        updateAttributes: function(e, t) {
            this.trigger("will_incremental_change");
            var n = _(this.items).find(function(t) {
                    return t.cid === Number(e)
                }),
                i = this;
            return _(t).each(function(e, t) {
                n[t] = e, i.trigger("change:" + t, [n])
            }), this.trigger("incremental_change", _(t).keys()), this.trigger("update", "updateAttribute"), n.guid
        },
        batchUpdateAttributes: function(e, t) {
            this.trigger("will_incremental_change");
            var n = this.get(e, !0),
                i = this;
            return _(n).each(function(e) {
                _(t).each(function(t, n) {
                    e[n] = t
                })
            }), _(t).each(function(e, t) {
                i.trigger("change:" + t, n)
            }), this.trigger("incremental_change", _(t).keys()), this.trigger("update"), this.trigger("batchUpdateAttribute"), _(n).pluck("guid")
        }
    }), PourOver.Item = function(e) {
        return e
    }, PourOver.Filter = function(e, t, n) {
        "undefined" == typeof n && (n = {}), this.name = e, this.possibilities = this.create_possibilities(t), this.values = _(t).map(function(e) {
            return e.value
        }), _.extend(this, n), this.initialize.apply(this, arguments)
    }, _.extend(PourOver.Filter.prototype, PourOver.Events, {
        initialize: function() {},
        create_possibilities: function(e) {
            var t = {};
            return _(e).each(function(e) {
                var n = e.name || String(e.value);
                t[n] = e, t[n].matching_cids = []
            }), t
        },
        cacheResults: function() {
            throw "No cache function has been defined for this filter '" + this.name + "'."
        },
        addCacheResults: function() {
            throw "No add cache function has been defined for this filter '" + this.name + "'."
        },
        makeQueryMatchSet: function(e, t) {
            return new PourOver.MatchSet(e, this.getCollection(), [
                [this, t]
            ])
        },
        removeFromCache: function(e) {
            var t = _(e).map(function(e) {
                return e.cid
            }).sort(function(e, t) {
                return e - t
            });
            _(this.possibilities).each(function(e) {
                e.matching_cids = PourOver.subtract_sorted(e.matching_cids, t)
            })
        },
        query: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            var n = this.getFn(e);
            this.setQuery(n, t)
        },
        setQuery: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            this.current_query = e, t || this.trigger("queryChange")
        },
        clearQuery: function(e) {
            if ("undefined" == typeof e) var e = !1;
            this.current_query = !1, e || this.trigger("queryChange")
        },
        unionQuery: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            if ("string" == typeof e || "number" == typeof e || _.isArray(e)) var e = this.getFn(e);
            this.current_query = this.current_query ? this.current_query.or(e) : e, t || this.trigger("queryChange")
        },
        intersectQuery: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            if ("string" == typeof e || "number" == typeof e || _.isArray(e)) var e = this.getFn(e);
            this.current_query = this.current_query ? this.current_query.and(e) : e, t || this.trigger("queryChange")
        },
        subtractQuery: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            if ("string" == typeof e || "number" == typeof e || _.isArray(e)) var e = this.getFn(e);
            this.current_query = this.current_query ? this.current_query.not(e) : e, t || this.trigger("queryChange")
        },
        removeSingleQuery: function(e, t) {
            if (!this.current_query) return !1;
            if ("undefined" == typeof t) var t = !1;
            if ("string" == typeof e || "number" == typeof e || _.isArray(e)) var e = this.getFn(e);
            var n, i = [],
                r = this.current_query.stack,
                o = function(e) {
                    return _.isString(e) && e.match(/^(or|and|not)$/)
                };
            n = _(r).reduce(function(t, n) {
                return n[1] === e.stack[0][1] ? t : o(n[0]) && n[1][0][1] === e.stack[0][1] ? t : (t.push(n), t)
            }, i), !n[0] || "and" != n[0][0] && "or" != n[0][0] && "not" != n[0][0] || (n[0] = n[0][1][0]), this.current_query.stack = n, this.current_query.refresh(), t || this.trigger("queryChange")
        },
        getCollection: function() {
            return this.collection
        }
    }), PourOver.Sort = function(e, t) {
        this.name = e, _.extend(this, t), this.initialize.apply(this, arguments)
    }, _.extend(PourOver.Sort.prototype, PourOver.Events, {
        initialize: function() {},
        view: !1,
        sort: function(e) {
            return PourOver.permute_from_array(e, this.permutation_array)
        },
        rebuild_sort: function() {
            if (this.view) var e = this.view.match_set.all();
            else var e = this.collection.items;
            this.permutation_array = PourOver.build_permutation_array(e, this), this.trigger("resort")
        }
    }), PourOver.View = function(e, t, n) {
        var i = this;
        this.name = e, "undefined" == typeof n && (n = {}), this.collection = t, this.match_set = new PourOver.MatchSet(_(this.collection.items).map(function(e) {
            return e.cid
        }), this.collection, ["all"]), n.template && (this.template = n.template), this.collection.on("will_change will_incremental_change", function() {
            i.storeViewPosition()
        }), this.collection.on("change", function() {
            i.match_set.refresh(), i.setNaturalSelection(), i.resetPage()
        }), this.collection.on("incremental_change", function(e) {
            i.match_set.refresh(), i.setNaturalSelection(e), i.resetPage()
        }), this.collection.on("update", function(e) {
            i.trigger("update", e)
        }), this.collection.on("queryChange", function() {
            i.setNaturalSelection(), i.trigger("update", "query")
        }), this.on("sortChange", function() {
            this.trigger("update", "sort")
        }), this.on("pageChange", function() {
            this.trigger("update", "page")
        }), _.extend(this, n), this.initialize.apply(this, arguments)
    }, _.extend(PourOver.View.prototype, PourOver.Events, {
        initialize: function() {},
        current_page: 0,
        view_sorts: [],
        page_size: 1 / 0,
        current_sort: !1,
        removeSort: function() {
            this.current_sort.off && this.current_sort.off("resort"), this.current_sort = !1, this.trigger("sortChange")
        },
        setSort: function(e, t) {
            "undefined" == typeof t && (t = !1);
            var n = this;
            this.current_sort.off && this.current_sort.off("resort"), e && t ? (this.current_sort = this.view_sorts[e], this.current_sort.on("resort", function() {
                n.trigger("sortChange")
            })) : e ? (this.current_sort = this.collection.sorts[e], this.current_sort.on("resort", function() {
                n.trigger("sortChange")
            })) : this.current_sort = !1, this.trigger("sortChange")
        },
        getSort: function() {
            return this.current_sort ? this.current_sort.name : !1
        },
        addViewSorts: function(e) {
            "undefined" == typeof opts && (opts = {}), _(e).isArray() || (e = [e]);
            var t = this;
            _(e).each(function(e) {
                t.view_sorts[e.name] = e, e.collection = t.collection, e.view = t, e.rebuild_sort(), t.on("selectionChange", function(t) {
                    void 0 == e.associated_attrs && e.rebuild_sort(), e.associated_attrs && _.intersection(e.associated_attrs, t).length > 0 && e.rebuild_sort()
                })
            })
        },
        selectionFn: function() {
            var e = this.collection,
                t = _(e.filters).reduce(function(t, n) {
                    var i = n.current_query;
                    return !t || i && !_.isEmpty(i.stack) ? t || i && !_.isEmpty(i.stack) ? t ? t.and(i) : i : e.getAllItems() : t
                }, !1);
            return t
        },
        setSelection: function(e, t) {
            this.match_set = e, this.trigger("selectionChange", t)
        },
        setNaturalSelection: function(e) {
            var t;
            t = this.selectionFn(), this.setSelection(t, e)
        },
        clearSelection: function() {
            this.match_set = this.collection.getAllItems()
        },
        getCurrentItems: function(e) {
            if (!this.match_set) return [];
            if ("undefined" == typeof e) var e = this.current_page;
            if (1 / 0 == this.page_size)
                if (this.current_sort) var t = this.match_set.all_sorted(this.current_sort);
                else var t = this.match_set.all();
            else if (this.current_sort) {
                var t = this.match_set.all_sorted_cids(this.current_sort);
                t = t.slice(this.page_size * e, this.page_size * (e + 1));
                var n = _(t).clone().sort(function(e, t) {
                        return e - t
                    }),
                    i = this.collection.get(n);
                t = _(t).map(function(e) {
                    return _(i).find(function(t) {
                        return t.cid === e
                    })
                })
            } else {
                var t = this.match_set.cids;
                t = t.slice(this.page_size * e, this.page_size * (e + 1)), t = this.collection.get(t)
            }
            return t
        },
        storeViewPosition: function() {
            var e = this.getCurrentItems()[0];
            e && (this.last_head_cid = e.cid)
        },
        resetPage: function() {
            this.last_head_cid && (this.current_sort && this.current_sort.rebuild_sort(), this.pageTo(this.last_head_cid, !0)), this.last_head_cid = void 0
        },
        page: function(e) {
            var t = e + this.current_page;
            0 > t && (t = 0), t > Math.ceil(this.match_set.length() / this.page_size - 1) && (t = Math.ceil(this.match_set.length() / this.page_size - 1)), this.current_page = t, this.trigger("pageChange")
        },
        pageTo: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            if (this.current_sort) var n = _(this.match_set.all_sorted_cids(this.current_sort)).indexOf(e),
                i = (this.match_set.cids.length, Math.floor(n / this.page_size));
            else var n = _(this.match_set.cids).indexOf(e),
                i = (this.match_set.cids.length, Math.floor(n / this.page_size));
            n >= 0 && (this.current_page = i, t || this.trigger("pageChange"))
        },
        setPageSize: function(e) {
            this.page_size = e, this.trigger("pageChange")
        },
        render: function() {}
    }), PourOver.MatchSet = function(e, t, n) {
        this.cids = e, this.collection = t, this.stack = n, this.initialize.apply(this, arguments)
    }, _.extend(PourOver.MatchSet.prototype, PourOver.Events, {
        initialize: function() {},
        refresh: function(e, t) {
            if ("undefined" == typeof e) var e = this.stack || [];
            if (e.length < 1 && t) return this.cids = t.cids, this;
            if (e.length < 1) return this.cids = !1, this;
            var n = e[0],
                i = n[0],
                r = function(e) {
                    return _.isString(e) && e.match(/^(or|and|not)$/)
                };
            if ("object" == typeof i) {
                var t = i.getFn(n[1]);
                return this.refresh(_(e).rest(), t)
            }
            if ("all" === i || "all" === n) {
                var o = _(this.collection.items).map(function(e) {
                        return e.cid
                    }),
                    t = new PourOver.MatchSet(o, this, ["all"]);
                return this.refresh(_(e).rest(), t)
            }
            if (r(i)) var a = t[i](this.refresh(n[1]));
            else var a = this.refresh(n[1]);
            return this.refresh(_(e).rest(), a)
        },
        and: function(e) {
            if (this.stack.length < 1 && e) return e;
            if (e) {
                var t = PourOver.intersect_sorted(this.cids, e.cids);
                return new PourOver.MatchSet(t, this.collection, this.stack.concat([
                    ["and", e.stack]
                ]))
            }
            return this
        },
        or: function(e) {
            if (this.stack.length < 1 && e) return e;
            if (e) {
                var t = PourOver.union_sorted(this.cids, e.cids);
                return new PourOver.MatchSet(t, this.collection, this.stack.concat([
                    ["or", e.stack]
                ]))
            }
            return this
        },
        not: function(e) {
            if (this.stack.length < 1 || !e) return this;
            var t = PourOver.subtract_sorted(this.cids, e.cids);
            return new PourOver.MatchSet(t, this.collection, this.stack.concat([
                ["not", e.stack]
            ]))
        },
        all: function() {
            return this.collection.get(this.cids)
        },
        slice: function(e, t) {
            return this.collection.get(this.cids.slice(e, t))
        },
        all_sorted: function(e) {
            var t = this.all();
            return e ? e.sort(t) : t
        },
        all_sorted_cids: function(e) {
            var t = this.cids;
            return e ? e.sort(t) : t
        },
        length: function() {
            return this.cids.length
        }
    }), PourOver.UI = {}, PourOver.UI.Element = function(e) {
        if ("undefined" == typeof e) var e = {};
        _.extend(this, e), this.initialize.apply(this, arguments)
    }, _.extend(PourOver.UI.Element.prototype, PourOver.Events, {
        initialize: function() {},
        getMatchSet: function() {
            throw "No get match set function specifiec"
        },
        getFilterState: function() {
            throw "No get filter state specified"
        },
        template: function() {
            throw "No template specified"
        },
        render: function() {
            var e = this.getFilterState(),
                t = this.template({
                    state: e
                });
            return t
        },
        getSimpleSelectState: function(e, t, n) {
            if ("undefined" == typeof e || !e || !e.stack) return !1;
            if ("undefined" == typeof t) var t = e.stack;
            if ("undefined" == typeof n) var n = [];
            if (t.length < 1) return n;
            if ("object" == typeof t[0][0]) return n.push(t[0][1]), this.getSimpleSelectState(e, _(t).rest(), n);
            if ("or" === t[0][0]) return n = n.concat(this.getSimpleSelectState(e, t[0][1])), this.getSimpleSelectState(e, _(t).rest(), n);
            throw "This does not appear to be a valid, simple selectElement stack."
        },
        getIntersectedSelectState: function(e, t, n) {
            if ("undefined" == typeof e || !e || !e.stack) return !1;
            if ("undefined" == typeof t) var t = e.stack;
            if ("undefined" == typeof n) var n = [];
            if (t.length < 1) return n;
            if ("object" == typeof t[0][0]) return n.push(t[0][1]), this.getIntersectedSelectState(e, _(t).rest(), n);
            if ("and" === t[0][0]) return n = n.concat(this.getIntersectedSelectState(e, t[0][1])), this.getIntersectedSelectState(e, _(t).rest(), n);
            throw "This does not appear to be a valid, simple selectElement stack."
        },
        getSimpleRangeState: function(e) {
            if ("undefined" == typeof e || !e || !e.stack) return !1;
            if (stack = e.stack, 1 !== stack.length || 2 !== stack[0][1].length) throw "The filter specified does not appear to have a simple range stack.";
            return stack[0][1]
        }
    }), PourOver.extend = function(e, t) {
        var n, i = this;
        n = e && _.has(e, "constructor") ? e.constructor : function() {
            return i.apply(this, arguments)
        }, _.extend(n, i, t);
        var r = function() {
            this.constructor = n
        };
        return r.prototype = i.prototype, n.prototype = new r, e && _.extend(n.prototype, e), n.__super__ = i.prototype, n
    }, PourOver.Collection.extend = PourOver.View.extend = PourOver.Filter.extend = PourOver.Sort.extend = PourOver.MatchSet.extend = PourOver.UI.Element.extend = PourOver.extend, PourOver.BufferedCollection = PourOver.Collection.extend({
        buffered_items: {},
        stripFutures: function(e) {
            return _(e).reduce(function(e, t, n) {
                return "undefined" != typeof t && (e[n] = t), e
            }, {})
        },
        get: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            var n = PourOver.Collection.prototype.get.call(this, e),
                i = this;
            return t ? n : _(n).map(function(e) {
                var t = e.guid;
                return i.buffered_items.hasOwnProperty(t) ? _(i.buffered_items[t]).extend(i.stripFutures(e)) : e
            })
        },
        getBy: function(e, t, n, i) {
            if ("undefined" == typeof i) var i = !1;
            var r = PourOver.Collection.prototype.getBy.call(this, e, t, n),
                o = this;
            return i ? r : _(r).map(function(e) {
                var t = e.guid;
                return o.buffered_items.hasOwnProperty(t) ? _(o.buffered_items[t]).extend(o.stripFutures(e)) : e
            })
        },
        getBufferedValue: function(e, t) {
            return this.buffered_items.hasOwnProperty(e) ? this.buffered_items[e][t] || !1 : !1
        },
        clearBufferedItems: function() {
            var e = this.buffered_items;
            for (var t in e) e.hasOwnProperty(t) && delete e[t]
        },
        getBufferUrl: function() {
            throw "You must override getBufferUrl;"
        },
        preprocessItem: function(e) {
            return [e.guid, e]
        },
        bufferGuids: function(e) {
            {
                var t = this,
                    e = _(e).select(function(e) {
                        return e && !t.buffered_items.hasOwnProperty(e)
                    }),
                    n = this.getBufferUrl(e),
                    i = n[0];
                n[1]
            }
            return e.length > 0 ? $.ajax({
                url: i,
                dataType: "jsonp",
                cache: !0
            }).always(function(e) {
                _.isArray(e) && (items = _(e).map(_.bind(t.preprocessItem, t)), _(items).each(function(e) {
                    t.buffered_items[e[0]] = e[1]
                }))
            }) : $.Deferred().resolve(!1)
        }
    }), PourOver.BufferedView = PourOver.View.extend({
        buffer_pages: 1,
        bufferAroundCurrentPage: function() {
            var e = this.current_page,
                t = e - this.buffer_pages > 0 ? e - this.buffer_pages : 0,
                n = e + this.buffer_pages,
                i = _.range(t, n + 1),
                r = this;
            i = _(i).map(function(e) {
                return _(r.getCurrentItems(e)).pluck("guid")
            });
            var o = _.flatten(i);
            buffer_deferred = this.collection.bufferGuids(o), buffer_deferred.done(function(e) {
                e && r.render()
            })
        },
        bufferRender: function() {
            var e = _(this.getCurrentItems()).pluck("guid"),
                t = this.collection.bufferGuids(e);
            t.done(_(function() {
                this.render()
            }).bind(this))
        },
        page: function(e) {
            PourOver.View.prototype.page.call(this, e), this.bufferAroundCurrentPage()
        },
        pageTo: function(e, t) {
            if ("undefined" == typeof t) var t = !1;
            PourOver.View.prototype.pageTo.call(this, e, t), this.bufferAroundCurrentPage()
        }
    }), PourOver.manualFilter = PourOver.Filter.extend({
        cacheResults: function() {
            return !1
        },
        addCacheResults: function() {
            return !1
        },
        getFn: function(e) {
            if (_(e).isArray()) return e = e.sort(function(e, t) {
                return e - t
            }), new PourOver.MatchSet(e, this.getCollection(), [
                [this, e]
            ]);
            if ("number" == typeof e) return new PourOver.MatchSet([e], this.getCollection(), [
                [this, e]
            ]);
            throw "Manual filters only support querying by one or more cids"
        },
        addItems: function(e) {
            if (_(e).isArray() || (e = [e]), e = e.sort(function(e, t) {
                    return e - t
                }), this.current_query) var t = this.current_query.cids,
                n = PourOver.union_sorted(t, e);
            else var n = e;
            this.query(n)
        },
        removeItems: function(e) {
            _(e).isArray() || (e = [e]), e = e.sort(function(e, t) {
                return e - t
            });
            var t = this.current_query.cids,
                n = PourOver.subtract_sorted(t, e);
            this.query(n)
        }
    }), PourOver.makeManualFilter = function(e) {
        var t = new PourOver.manualFilter(e, []);
        return t
    }, PourOver.exactFilter = PourOver.Filter.extend({
        cacheResults: PourOver.cacheMethods.exactCache,
        addCacheResults: PourOver.cacheMethods.exactAddCache,
        getFn: function(e) {
            var t = this;
            if (_(e).isArray()) {
                var n = _(e).reduce(function(e, n) {
                    return e ? e.or(t.getFn(n)) : t.getFn(n)
                }, !1);
                return n
            }
            var i = this.possibilities[e];
            if (_.isUndefined(i)) throw "The filter " + this.name + " does not have a match for the query '" + e + "'.";
            return new PourOver.MatchSet(i.matching_cids, this.getCollection(), [
                [this, e]
            ])
        }
    }), PourOver.makeExactFilter = function(e, t, n) {
        "undefined" == typeof n && (n = {});
        var t = _(t).map(function(e) {
                return {
                    value: e
                }
            }),
            i = n.attr || e,
            n = _.extend({
                associated_attrs: [i]
            }, n),
            r = new PourOver.exactFilter(e, t, n);
        return r
    }, PourOver.inclusionFilter = PourOver.exactFilter.extend({
        cacheResults: PourOver.cacheMethods.inclusionCache,
        addCacheResults: PourOver.cacheMethods.inclusionAddCache
    }), PourOver.makeInclusionFilter = function(e, t, n) {
        "undefined" == typeof n && (n = {});
        var t = _(t).map(function(e) {
                return {
                    value: e
                }
            }),
            i = n.attr || e,
            n = _.extend({
                associated_attrs: [i]
            }, n),
            r = new PourOver.inclusionFilter(e, t, n);
        return r
    }, PourOver.rangeFilter = PourOver.Filter.extend({
        cacheResults: PourOver.cacheMethods.defaultCache,
        addCacheResults: PourOver.cacheMethods.defaultAddCache,
        fn: function(e, t) {
            var n = this.attr || this.name;
            return e.low <= t[n] && e.high >= t[n]
        },
        getFn: function(e) {
            var t = this.possibilities[e.join("-")];
            if (_.isUndefined(t)) throw "The filter " + this.name + " does not have a match for the query '" + e + "'.";
            return new PourOver.MatchSet(t.matching_cids, this.getCollection(), [
                [this, e]
            ])
        }
    }), PourOver.makeRangeFilter = function(e, t, n) {
        "undefined" == typeof n && (n = {});
        var i = _(t).map(function(e) {
                return {
                    low: e[0],
                    high: e[1],
                    value: e.join("-")
                }
            }),
            r = n.attr || e,
            o = _.extend({
                associated_attrs: [r]
            }, n),
            a = new PourOver.rangeFilter(e, i, o);
        return a
    }, PourOver.dvrangeFilter = PourOver.Filter.extend({
        cacheResults: PourOver.cacheMethods.exactCache,
        addCacheResults: PourOver.cacheMethods.exactAddCache,
        getFn: function(e) {
            if (!e[0] || !e[1]) return new PourOver.MatchSet([], this.getCollection(), [
                [this, e]
            ]);
            var t, n, i, r, o;
            return t = _(this.values).indexOf(e[0]), n = _(this.values).indexOf(e[1]), i = this, r = _(this.values.slice(t, n + 1)).map(function(e) {
                return i.possibilities[e]
            }), o = _(r).reduce(function(e, t) {
                return PourOver.union_sorted(e, t.matching_cids)
            }, []), new PourOver.MatchSet(o, this.getCollection(), [
                [this, e]
            ])
        }
    }), PourOver.makeDVrangeFilter = function(e, t, n) {
        "undefined" == typeof n && (n = {});
        var i = _(t).map(function(e) {
                return {
                    value: e
                }
            }),
            r = n.attr || e,
            o = _.extend({
                associated_attrs: [r]
            }, n),
            a = new PourOver.dvrangeFilter(e, i, o);
        return a
    }, PourOver.explicitSort = PourOver.Sort.extend({
        fn: function(e, t) {
            var n = _(this.order).indexOf(e[this.attr]),
                i = _(this.order).indexOf(t[this.attr]);
            return -1 === n && (n = 1 / 0), -1 === i && (i = 1 / 0), n - i
        },
        reset: function(e) {
            this.order = _(e).pluck(this.attr), this.rebuild_sort()
        },
        insert: function(e, t) {
            if ("undefined" == typeof t) var t = this.order.length;
            _(e).isArray() || (e = [e]);
            var n = _(e).pluck(this.attr),
                i = [t, 0].concat(n);
            this.order.splice.apply(this.order, i), this.rebuild_sort()
        },
        remove: function(e) {
            _(e).isArray() || (e = [e]);
            var t = _(e).pluck(this.attr);
            this.order = _(this.order).difference(t), this.rebuild_sort()
        },
        move: function(e, t) {
            _(e).isArray() || (e = [e]);
            var n = _(e).pluck(this.attr);
            this.order = _(this.order).map(function(e) {
                return _(n).include(e) ? null : e
            }), this.insert(e, t), this.order = _(this.order).compact()
        }
    }), PourOver.makeExplicitSort = function(e, t, n, i, r) {
        var o = new PourOver.explicitSort(e, r);
        return o.attr = n, o.order = i, o
    }, PourOver.reverseCidSort = PourOver.Sort.extend({
        fn: function(e, t) {
            return t.cid - e.cid
        }
    }), PourOver.makeReverseCidSort = function(e) {
        var t = new PourOver.reverseCidSort(e);
        return t.attr = "cid", t
    }, PourOver.UI.SimpleSelectElement = PourOver.UI.Element.extend({
        initialize: function(e) {
            if (!e.filter) throw "A simple select element must have a filter specified";
            this.filter = e.filter
        },
        getMatchSet: function() {
            return this.filter.current_query
        },
        getFilterState: function() {
            var e = this.getMatchSet();
            return this.getSimpleSelectState(e)
        }
    }), PourOver.UI.SimpleDVRangeElement = PourOver.UI.Element.extend({
        initialize: function(e) {
            if (!e.filter) throw "A simple dv range element must have a filter specified";
            this.filter = e.filter
        },
        getMatchSet: function() {
            return this.filter.current_query
        },
        getFilterState: function() {
            var e = this.getMatchSet();
            return this.getSimpleRangeState(e)
        }
    }), PourOver
}();
(function() {
    var e, t = function(e, t) {
        return function() {
            return e.apply(t, arguments)
        }
    };
    e = function() {
        function e() {
            this.addFilter = t(this.addFilter, this), this.add = t(this.add, this), this.remove = t(this.remove, this), this.activeItemsId = {}, this.objects = {}, this.changed = !1, this.hashFilteredIds = [], this.onFilterAdded = function() {}, this.onFilterRemoved = function() {}, this.possibleValuesId = {}, this.loadPossibleValuesFromButtonsContainer($(".more-search-options-container .house_type")), this.loadPossibleValuesFromButtonsContainer($(".more-search-options-container .rest_category")), this.loadPossibleValuesFromButtonsContainer($(".more-search-options-container .price_range")), $(".more-search-options-container ul").each(function(e) {
                return function(t, n) {
                    var i;
                    return i = $(n).data("type"), void 0 !== i ? (e.activeItemsId[i] = [], $(n).find("li input").each(function(t, n) {
                        var r, o;
                        return o = $(n).val(), r = $(n).parent().parent().children("label").text().strip(), "undefined" == typeof e.possibleValuesId[i] && (e.possibleValuesId[i] = []), void 0 !== o && e.possibleValuesId[i].push(o), e.objects[o] = {
                            id: o,
                            text: r,
                            type: i,
                            input_type: "checkbox"
                        }
                    })) : void 0
                }
            }(this)), this.checkWindowHash()
        }
        return e.prototype.checkWindowHash = function() {
            var e;
            return e = window.location.hash.substring(1).split("|"), e.forEach(function(e) {
                return function(t) {
                    return null != t && t.length > 0 ? e.hashFilteredIds.push(t) : void 0
                }
            }(this))
        }, e.prototype.getActiveFiltersString = function() {
            return _.flatten(_.values(this.activeItemsId)).join("|")
        }, e.prototype.loadPossibleValuesFromButtonsContainer = function(e) {
            var t;
            return t = e.data("type"), this.activeItemsId[t] = [], e.find("a").each(function(e) {
                return function(n, i) {
                    var r, o;
                    return o = $(i).data("id"), r = $(i).text(), "undefined" == typeof e.possibleValuesId[t] && (e.possibleValuesId[t] = []), void 0 !== o && e.possibleValuesId[t].push(o), e.objects[o] = {
                        id: o,
                        text: r,
                        type: t,
                        input_type: "button"
                    }
                }
            }(this))
        }, e.prototype.filterAddedEvent = function(e) {
            return this.onFilterAdded(e)
        }, e.prototype.filterRemovedEvent = function(e) {
            return this.onFilterRemoved(e)
        }, e.prototype.getObject = function(e) {
            return this.objects[e]
        }, e.prototype.remove = function(e) {
            return this.changed = !0, this.activeItemsId[this.objects[e].type] = this.activeItemsId[this.objects[e].type].removeItem(this.objects[e].id)
        }, e.prototype.add = function(e) {
            return this.objects[e] ? (this.changed = !0, this.activeItemsId[this.objects[e].type].push(this.objects[e].id)) : void 0
        }, e.prototype.check = function(e) {
            if (this.objects[e]) {
                if ("checkbox" === this.objects[e].input_type) return $("#fc" + e).prop("checked", !0).parent().addClass("ez-checked");
                if ("button" === this.objects[e].input_type) return $("#b" + e).addClass("active")
            }
        }, e.prototype.uncheck = function(e) {
            if (this.objects[e]) {
                if ("checkbox" === this.objects[e].input_type) return $("#fc" + e).prop("checked", !1).parent().removeClass("ez-checked");
                if ("button" === this.objects[e].input_type) return $("#b" + e).removeClass("active")
            }
        }, e.prototype.removeFilter = function(e) {
            return this.remove(e), this.filterRemovedEvent(e)
        }, e.prototype.addFilter = function(e) {
            return this.add(e), this.filterAddedEvent(e)
        }, e
    }(), window.FilterItems = e, Array.prototype.removeItem = function(e) {
        return jQuery.grep(this, function(t) {
            return t !== e
        })
    }, String.prototype.strip = function() {
        return null != String.prototype.trim ? this.trim() : this.replace(/^\n+|\n+$/g, "")
    }
}).call(this),
    function() {
        var e, t = function(e, t) {
            return function() {
                return e.apply(t, arguments)
            }
        };
        e = function() {
            function e(e) {
                this.drawNextPage = t(this.drawNextPage, this), this.drawCurrentPage = t(this.drawCurrentPage, this), this.template = $("script#item_template").html(), this.container = $(".catalog-apartment-list ul.list"), this.pagerLink = $(".catalog-pager-ajax"), this.loadData(e.dataLink), this.loadingOverlay = $(".loading-overlay"), this.catalogApartmentContainer = $(".catalog-apartment-container"), this.filterManager = e.manager, this.filter = this.filterManager.filter, this.tooltip = this.filterManager.tooltip, this.currentPage = 1, this.pageSize = 24, this.zeroResults = !1, this.filterKeys = {
                    city: "city_id",
                    service_category: "service_type_ids",
                    house_type: "house_type_id",
                    rest_category: "rest_category_ids",
                    price_range: "price_range"
                }
            }
            return e.prototype.loadData = function(e) {
                return $.get(e).done(function(e) {
                    return function(t) {
                        var n, i, r, o, a;
                        return e.collection = new PourOver.Collection(t.houses), n = PourOver.makeExactFilter("city_id", e.filter.possibleValuesId.city), i = PourOver.makeExactFilter("house_type_id", e.filter.possibleValuesId.house_type), r = PourOver.makeExactFilter("price_range", e.filter.possibleValuesId.price_range), o = PourOver.makeInclusionFilter("rest_category_ids", e.filter.possibleValuesId.rest_category), a = PourOver.makeInclusionFilter("service_type_ids", e.filter.possibleValuesId.service_category), e.collection.addFilters([n, a, i, o, r]), e.view = new PourOver.View("default_view", e.collection, {
                            page_size: e.pageSize
                        }), e.initPager(), e.drawCurrentPage()
                    }
                }(this))
            }, e.prototype.showOverlay = function() {
                return this.loadingOverlay.height(this.catalogApartmentContainer.height()), this.loadingOverlay.width(this.catalogApartmentContainer.width()), this.loadingOverlay.show()
            }, e.prototype.hideOverlay = function() {
                return this.loadingOverlay.hide()
            }, e.prototype.initPager = function() {
                return this.pagerLink.on("click", this.drawNextPage)
            }, e.prototype.nextPage = function() {
                return this.hasNextPage() ? this.currentPage += 1 : void 0
            }, e.prototype.previousPage = function() {
                return this.currentPage > 1 ? this.currentPage -= 1 : void 0
            }, e.prototype.hasNextPage = function() {
                return !(this.currentPage >= this.view.match_set.all().length / this.pageSize)
            }, e.prototype.checkPager = function() {
                return this.hasNextPage() ? this.pagerLink.show() : this.pagerLink.hide()
            }, e.prototype.initTooltips = function() {
                return $(".reviews-ico").tooltipster({
                    theme: "tooltip-custom-response",
                    maxWidth: "192px"
                })
            }, e.prototype.drawItemsEvent = function() {
                return this.onDrawItems()
            }, e.prototype.applyFilters = function() {
                var e;
                return this.filter.changed ? (e = this.filter.getActiveFiltersString(), window.location.hash = "" === e ? "_" : e, this.currentPage = 1, this.collection.filters.city_id.query(this.filter.activeItemsId.city, !0), this.collection.filters.service_type_ids.query(this.filter.activeItemsId.service_category, !0), this.collection.filters.house_type_id.query(this.filter.activeItemsId.house_type, !0), this.collection.filters.rest_category_ids.query(this.filter.activeItemsId.rest_category, !0), this.collection.filters.price_range.query(this.filter.activeItemsId.price_range), this.filter.changed = !1) : void 0
            }, e.prototype.clearFilters = function() {
                return this.collection.filters.city_id.clearQuery(!0), this.collection.filters.service_type_ids.clearQuery(!0), this.collection.filters.house_type_id.clearQuery(!0), this.collection.filters.rest_category_ids.clearQuery(!0), this.collection.filters.price_range.clearQuery(!0)
            }, e.prototype.processZeroResults = function() {
                var e, t;
                return this.clearFilters(), e = [], t = ["city", "price_range", "service_category", "house_type"], _.each(t, function(t) {
                    return function(n) {
                        return t.addFilter(n) ? e.push(n) : void 0
                    }
                }(this)), this.clearFilters(), _.each(e, function(e) {
                    return function(t) {
                        var n;
                        return n = e.filterKeys[t], e.collection.filters[n].query(e.filter.activeItemsId[t])
                    }
                }(this)), this.filter.changed = !0, this.writeHtml()
            }, e.prototype.addFilter = function(e) {
                var t;
                return t = this.filterKeys[e], this.filter.activeItemsId[e].length > 0 ? (this.collection.filters[t].query(this.filter.activeItemsId[e]), this.view.getCurrentItems().length > 0) : !1
            }, e.prototype.filteredCount = function(e) {
                return null == e && (e = !0), e && this.applyFilters(), this.zeroResults ? 0 : this.view.match_set.all().length
            }, e.prototype.prepareItemsHtml = function() {
                return this.resultHtml = "", _.each(this.view.getCurrentItems(this.currentPage - 1), function(e) {
                    return function(t) {
                        return e.resultHtml += _.template(e.template, {
                            house: t
                        })
                    }
                }(this)), this.resultHtml
            }, e.prototype.drawCurrentPage = function(e) {
                return null == e && (e = null), null != e && e.preventDefault(), this.applyFilters(), 0 === this.view.getCurrentItems().length ? (this.zeroResults = !0, this.processZeroResults()) : (this.zeroResults = !1, this.writeHtml())
            }, e.prototype.writeHtml = function() {
                return this.checkPager(), this.filterManager.toggleAdvancedSearch({
                    target: $(".more-search-options-button a")
                }, "yes"), this.tooltip.hideAll(), this.showOverlay(), this.container.fadeOut(400, function(e) {
                    return function() {
                        return e.container.html(e.prepareItemsHtml()), e.container.fadeIn(400, function() {
                            return e.initTooltips()
                        }), e.hideOverlay()
                    }
                }(this)), this.drawItemsEvent()
            }, e.prototype.drawNextPage = function(e) {
                return null == e && (e = null), null != e && e.preventDefault(), this.nextPage(), this.checkPager(), this.container.append(this.prepareItemsHtml())
            }, e
        }(), window.Houses = e
    }.call(this),
    function() {
        var e;
        e = function() {
            function e() {
                this.container = $(".checkbox-list li"), this.buttonsContainer = $(".more-search-options-container .buttons-container a"), this.container.tooltipster({
                    trigger: "custom",
                    offsetX: -105,
                    onlyOne: !0,
                    speed: 10,
                    timer: 1e4,
                    theme: "tooltip-custom-link",
                    maxWidth: "192px",
                    contentAsHTML: !0,
                    interactive: !0
                }), this.buttonsContainer.tooltipster({
                    trigger: "custom",
                    offsetX: 0,
                    onlyOne: !0,
                    speed: 10,
                    timer: 1e4,
                    theme: "tooltip-custom-link",
                    maxWidth: "192px",
                    contentAsHTML: !0,
                    interactive: !0
                }), this.template = $("script#tooltip_template").html()
            }
            return e.prototype.show = function(e, t) {
                var n;
                return n = _.template(this.template, {
                    count: t
                }), e.tooltipster("content", n).tooltipster("show")
            }, e.prototype.hideAll = function() {
                return this.buttonsContainer.tooltipster("hide"), this.container.tooltipster("hide")
            }, e
        }(), window.Tooltips = e
    }.call(this),
    function() {
        var e;
        e = function() {
            function e(e) {
                this.filters = e.filters, this.template = $("script#option_widget").html()
            }
            return e.prototype.add = function(e) {
                var t;
                return this.filters.getObject(e) ? (t = _.template(this.template, {
                    text: this.filters.getObject(e).text,
                    id: e
                }), $("#tc" + e).length > 0 ? this.check(e) : ($(".filtered-options-container .list").append(t), $("#tc" + e).ezMark())) : void 0
            }, e.prototype.remove = function(e) {
                return $("#c" + e).remove()
            }, e
        }(), window.OptionWidget = e
    }.call(this),
    function() {
        var e, t = function(e, t) {
            return function() {
                return e.apply(t, arguments)
            }
        };
        e = function() {
                function e(e) {
                    this.removeOptionWidgetByUncheck = t(this.removeOptionWidgetByUncheck, this), this.removeOptionWidgetByClick = t(this.removeOptionWidgetByClick, this), this.addOptionWidget = t(this.addOptionWidget, this), this.filterButtonClick = t(this.filterButtonClick, this), this.updateItemsCount = t(this.updateItemsCount, this), this.toggleAdvancedSearch = t(this.toggleAdvancedSearch, this), this.itemsCountTextContainer = $(".catalog-heading p.results"), this.noItemsCountText = $(".catalog-heading p.no-results"), $(".catalog-heading p").hide(), this.filter = new FilterItems, this.optionWidget = new OptionWidget({
                        filters: this.filter
                    }), this.tooltip = new Tooltips, this.houses = new Houses({
                        dataLink: e.data("path"),
                        manager: this
                    }), this.houses.showOverlay(), this.initTogglers(), this.initEvents(e)
                }
                return e.prototype.initEvents = function(e) {
                    return this.filter.hashFilteredIds.length > 0 && this.addFiltersfromHash(this.filter.hashFilteredIds), $(".apply-search-options button").on("click", this.houses.drawCurrentPage), $(document).on("click", ".apply-search-filter", this.houses.drawCurrentPage), $(document).on("click", ".filtered-options-container .remove", this.removeOptionWidgetByClick), $(".more-search-options-container .buttons-container a").on("click", this.filterButtonClick), this.filter.onFilterAdded = this.addOptionWidget, this.filter.onFilterRemoved = this.removeOptionWidgetByUncheck, this.houses.onDrawItems = this.updateItemsCount, this.initFilterButtons(), e.find('ul li input[type="checkbox"]').on("change", function(e) {
                        return function(t) {
                            var n;
                            return n = $(t.target), n.prop("checked") ? e.filter.addFilter(n.val()) : e.filter.removeFilter(n.val())
                        }
                    }(this))
                }, e.prototype.initFilterButtons = function() {
                    return $(".item a.filter-btn").on("click", function(e) {
                        var t;
                        return t = $(e.target), e.preventDefault(), t.hasClass("active") ? t.removeClass("active") : t.addClass("active")
                    })
                }, e.prototype.initTogglers = function() {
                    return $("a.toggle-checkbox-container").on("click", function(e) {
                        return e.preventDefault(), "no" === $(this).data("showed") ? $(this).addClass("opened").data("showed", "yes").parent().animate({
                            height: $(this).parent().children(".checkbox-list").outerHeight()
                        }) : ($(this).removeClass("opened").data("showed", "no").parent().animate({
                            height: "58px"
                        }), this.tooltip.hideAll())
                    }), $(".more-search-options-button a").on("click", this.toggleAdvancedSearch)
                }, e.prototype.toggleAdvancedSearch = function(e, t) {
                    var n, i;
                    return null == t && (t = null), n = $(e.target), "function" == typeof e.preventDefault && e.preventDefault(), null != t && n.data("showed", t), i = n.closest(".catalog-search-form").find(".more-search-options-container"), "no" !== n.data("showed") ? (n.removeClass("opened").data("showed", "no"), this.tooltip.hideAll(), i.slideUp(200)) : (n.addClass("opened").data("showed", "yes"), i.slideDown(300), window.ga ? ga("send", "event", "button", "advanced-search", "open") : void 0)
                }, e.prototype.updateItemsCount = function() {
                    return $(".catalog-heading p").show(), this.houses.zeroResults ? (this.itemsCountTextContainer.hide(), this.noItemsCountText.show(), $("h4.no-results").show()) : ($("h4.no-results").hide(), this.itemsCountTextContainer.show(), this.noItemsCountText.hide(), this.itemsCountTextContainer.html(I18n.t("total_results_html", {
                        count: this.houses.filteredCount(!1)
                    })))
                }, e.prototype.filterButtonClick = function(e) {
                    var t, n;
                    return t = $(e.target), n = t.data("id"), t.hasClass("active") ? (this.filter.remove(n), this.optionWidget.remove(n)) : (this.filter.add(n), this.optionWidget.add(n)), this.tooltip.show(t, this.houses.filteredCount())
                }, e.prototype.addOptionWidget = function(e) {
                    return this.optionWidget.add(e), this.tooltip.show($("#fc" + e).parent().parent(), this.houses.filteredCount())
                }, e.prototype.addFiltersfromHash = function(e) {
                    return e.forEach(function(e) {
                        return function(t) {
                            return e.optionWidget.add(t), e.filter.add(t), e.filter.check(t)
                        }
                    }(this))
                }, e.prototype.removeOptionWidgetByClick = function(e) {
                    var t;
                    return t = $(e.target).parent().data("id"), this.optionWidget.remove(t), this.filter.remove(t), this.filter.uncheck(t), this.houses.drawCurrentPage()
                }, e.prototype.removeOptionWidgetByUncheck = function(e) {
                    return this.optionWidget.remove(e), this.filter.remove(e), this.tooltip.show($("#fc" + e).parent().parent(), this.houses.filteredCount())
                }, e
            }(),
            function(t) {
                return t.fn.checkboxFilter = function() {
                    return this.cfm = new e(t(this))
                }
            }(jQuery)
    }.call(this),
    function(e) {
        e.fn.simplyCountable = function(t) {
            t = e.extend({
                counter: "#counter",
                countType: "characters",
                maxCount: 140,
                strictMax: !1,
                countDirection: "down",
                safeClass: "safe",
                overClass: "over",
                thousandSeparator: ",",
                onOverCount: function() {},
                onSafeCount: function() {},
                onMaxCount: function() {}
            }, t);
            var n = [33, 34, 35, 36, 37, 38, 39, 40];
            return e(this).each(function() {
                var i = e(this),
                    r = e(t.counter);
                if (!r.length) return !1;
                var o = function() {
                    var n, o, a = function(e) {
                            return e - 2 * e + t.maxCount
                        },
                        s = function() {
                            return "up" === t.countDirection ? o : n
                        },
                        l = function(e) {
                            var n = "";
                            if (t.thousandSeparator) {
                                e = e.toString(), e.match(/^-/) && (e = e.substr(1), n = "-");
                                for (var i = e.length - 3; i > 0; i -= 3) e = e.substr(0, i) + t.thousandSeparator + e.substr(i)
                            }
                            return n + e
                        },
                        c = function(e) {
                            i.val(e).trigger("change")
                        };
                    if ("words" === t.countType ? (n = t.maxCount - e.trim(i.val()).split(/\s+/).length, "" === i.val() && (n += 1)) : n = t.maxCount - i.val().length, o = a(n), t.strictMax && 0 >= n) {
                        var u = i.val();
                        if (0 > n && t.onMaxCount(s(), i, r), "words" === t.countType) {
                            var d = u.match(new RegExp("\\s?(\\S+\\s+){" + t.maxCount + "}"));
                            d && c(d[0])
                        } else c(u.substring(0, t.maxCount));
                        n = 0, o = t.maxCount
                    }
                    r.text(l(s())), r.hasClass(t.safeClass) || r.hasClass(t.overClass) ? 0 > n && r.hasClass(t.safeClass) ? (r.removeClass(t.safeClass).addClass(t.overClass), t.onOverCount(s(), i, r)) : n >= 0 && r.hasClass(t.overClass) && (r.removeClass(t.overClass).addClass(t.safeClass), t.onSafeCount(s(), i, r)) : r.addClass(0 > n ? t.overClass : t.safeClass)
                };
                o(), i.on("keyup blur paste", function(t) {
                    switch (t.type) {
                        case "keyup":
                            e.inArray(t.which, n) < 0 && o();
                            break;
                        case "paste":
                            setTimeout(o, "paste" === t.type ? 5 : 0);
                            break;
                        default:
                            o()
                    }
                })
            })
        }
    }(jQuery),
    function() {
        ! function(e) {
            return e.fn.ContactForm = function() {
                return this.form = e(this), this.form.find(".submit").on("click", function(e) {
                    return function() {
                        return e.form.submit(), !1
                    }
                }(this)), this.form.on("ajax:success", function(t) {
                    return function() {
                        return e(".notification-container").fadeIn(), t.form.find("#hide-feedback").click(), t.form[0].reset()
                    }
                }(this)), this.form.on("ajax:beforeSend", function(e) {
                    return function() {
                        return e.form.find(".tooltipstered").tooltipster("destroy").removeAttr("title"), e.form.find("input, textarea").removeClass("error")
                    }
                }(this)), this.form.on("ajax:error", function(t) {
                    return function(n, i) {
                        var r;
                        return 422 === i.status ? (r = e.parseJSON(i.responseText), e.each(r, function(t, n) {
                            return e('[name="contact_request[' + t + ']"]').addClass("error").attr("title", "" + n)
                        }), t.form.find(".error").tooltipster({
                            theme: "tooltip-custom-error",
                            maxWidth: "192px"
                        })) : void 0
                    }
                }(this))
            }
        }(jQuery)
    }.call(this),
    function() {
        ! function(e) {
            return e.fn.HouseForm = function() {
                return this.form = e(this), this.form.find(".type-of-accommodation .item.toggle").on("click", function(t) {
                    return t.preventDefault(), t.stopPropagation(), e(this).closest(".type-of-accommodation").find("a.filter").removeClass("active"), e(this).find("a.filter").addClass("active"), e(this).find('input[type="radio"]').prop("checked", !0)
                }), this.form.find("#send-reg-info").on("click", function(e) {
                    return function(t) {
                        return t.preventDefault(), t.stopPropagation(), window.ga && ga("send", "event", "button", "add-house-form", "submit"), e.form.submit()
                    }
                }(this))
            }
        }(jQuery)
    }.call(this),
    function() {
        ! function(e) {
            return e.fn.SearchForm = function() {
                var t, n, i, r, o;
                return this.form = e(this), this.cityId = void 0, n = this.form.find("#autocomplete_cities"), r = n.parent().find(".error"), app.common.autocomplete(n), n.on("keydown", function() {
                    return r.tooltipster("hide").hide(), i() ? e(this).removeData("selected") : void 0
                }).on("OnSelect", function(t, n) {
                    return r.tooltipster("hide").hide(), e(this).data("selected", n)
                }), this.form.find("button").on("click", function(e) {
                    return function(i) {
                        return i.preventDefault(), void 0 !== n.data("selected") && (e.cityId = n.data("selected").data), o() ? (window.ga && ga("send", "event", "button", "search", "submit"), window.location.href = t()) : void r.show().tooltipster("show")
                    }
                }(this)), o = function() {
                    return void 0 !== n.data("selected") || "" === n.val()
                }, i = function() {
                    return void 0 !== n.data("selected") && n.data("selected").value !== n.val()
                }, t = function(t) {
                    return function() {
                        var n, i, r, o;
                        return o = [], r = t.form.prop("action"), i = e("#types_select").val(), n = e("#prices_select").val(), "" !== i && o.push(i), "" !== n && o.push(n), void 0 !== t.cityId && o.push(t.cityId), "" + r + "#" + o.join("|")
                    }
                }(this)
            }
        }(jQuery)
    }.call(this),
    function() {
        this.app = {
            common: {
                init: function() {
                    var e, t, n, i, r;
                    return $(window).load(function() {
                        return $("#top-search-form").SearchForm()
                    }), $("#registration-form form").HouseForm(), $("#contacts-form form").ContactForm(), $(":checkbox:checked").prop("checked", !1), $("input[type='checkbox']").ezMark(), $(".tooltiped").tooltipster({
                        theme: "tooltip-custom-link",
                        maxWidth: "192px",
                        contentAsHTML: !0,
                        interactive: !0
                    }), $(".error").tooltipster({
                        theme: "tooltip-custom-error",
                        contentAsHTML: !0,
                        interactive: !0,
                        maxWidth: "192px"
                    }), $(".tooltip_button").tooltipster({
                        theme: "tooltip-custom-big",
                        content: $("ul.tooltip"),
                        maxWidth: "415px",
                        position: "bottom-right",
                        interactive: !0,
                        animation: "grow"
                    }), $("#responsiveTabs").responsiveTabs({
                        rotate: !1,
                        startCollapsed: "accordion",
                        collapsible: "accordion",
                        setHash: !0
                    }), $(".contacts-list a.mask").on("click", function(e) {
                        return e.preventDefault(), $(".contacts-list a.mask").fadeOut("slow").promise().done(function() {
                            return $(".contacts-list.js").hide(), $(".contacts-list.no-js").show()
                        })
                    }), $(".apartment-short-desc-container .contacts-list a.mask").on("click", function() {
                        return window.ga ? ga("send", "event", "link", "phone-view", $(this).data("house")) : void 0
                    }), $(".apartment-full-desc-container .contacts-list a.mask").on("click", function() {
                        return window.ga ? ga("send", "event", "link", "phone-view-bottom", $(this).data("house")) : void 0
                    }), r = $(window).outerHeight(), t = $(".guide").outerHeight(), $(".guide-page-content").css({
                        height: r - 60 + "px",
                        "min-height": t
                    }), $(".contacts-page-content, .not-found-page-content").css({
                        height: r - 60 + "px"
                    }), $(".not-found-page-content .not-found-page-text").css({
                        "margin-top": (r - 60 - 150) / 2 + "px"
                    }), $(".guide-page-content").backstretch("/assets/guide-back-c0e8d117ce8807a182e64258aecb26e0.jpg"), $(".facts-about-city").length && $(".facts-about-city").backstretch($(".facts-about-city").data("image")), $(".contacts-page-content").backstretch("/assets/contacts-back-ca3c16af3e60a03026c3ccf3a914dff3.jpg"), $(".not-found-page-content").backstretch("/assets/404-23d85f57c18a075b163c5cfc7138ea0e.jpg"), $(".backstretch-image").each(function() {
                        return $(this).backstretch($(this).data("image"))
                    }), $(".select-lang select.select-big-blue").selecter({
                        customClass: "select-big-blue",
                        links: !0
                    }), $("select.select-big-blue").selecter({
                        customClass: "select-big-blue"
                    }), $("select.select").selecter({
                        customClass: "select",
                        links: !0
                    }), i = function() {
                        return $(".overlay").fadeIn(), $("#registration-form").fadeIn(), window.ga ? ga("send", "event", "button", "add-house-form", "open") : void 0
                    }, n = function() {
                        return $("#registration-form").fadeOut(), $(".notification-container").fadeOut(), $(".overlay").fadeOut()
                    }, "#add-apartment" === window.location.hash && i(), $(window).on("hashchange", function() {
                        return "#add-apartment" === window.location.hash ? i() : n()
                    }), $("a#add-apartment, .bottom-text-form-link").on("click", function(e) {
                        return e.preventDefault(), window.location.hash = "add-apartment"
                    }), $(".overlay, #hide-form").on("click", function(e) {
                        return e.preventDefault(), window.location.hash = ""
                    }), $("a#close-notification").on("click", function(e) {
                        return e.preventDefault(), $(".overlay").fadeOut(), $(".notification-container").fadeOut()
                    }), $("#show-feedback").on("click", function() {
                        var e;
                        return e = $(this).closest(".contacts-page-content"), e.find(".contacts-info").fadeOut(), e.append($("#contacts-form .contacts-form")), e.find(".contacts-form").fadeIn(), !1
                    }), $(".contacts-page-content").on("click", "#hide-feedback", function() {
                        return $(this).closest(".contacts-page-content").find(".contacts-form").fadeOut().promise().done(function() {
                            return $("#contacts-form").append($(this))
                        }), $(this).closest(".contacts-page-content").find(".contacts-info").fadeIn(), !1
                    }), $("#main-slider").flexslider({
                        selector: ".slides > .slide",
                        controlNav: !1,
                        animation: "slide",
                        animationSpeed: 1e3,
                        prevText: "",
                        nextText: ""
                    }), $(".step-1 .step-main-body .row").on("click", function() {
                        var e;
                        return e = $(this), e.parents(".step-main-body").find(".active").removeClass("active"), e.addClass("active"), !1
                    }), e = $("footer").outerHeight(), $(".wrap .footer-push").css("height", e), $(".wrap").css("margin-bottom", -e)
                },
                initialize_map: function(e) {
                    return this.mapfield = e, 0 !== this.mapfield.length ? ("undefined" == typeof google ? $.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=showMap") : showMap(), window.showMap = function(e) {
                        return function() {
                            var t, n, i;
                            return n = {
                                scrollwheel: !1,
                                zoom: 13,
                                center: new google.maps.LatLng(e.mapfield.data("lat"), e.mapfield.data("lng")),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }, t = new google.maps.Map(e.mapfield[0], n), t.setOptions({
                                styles: [{
                                    featureType: "all"
                                }, {
                                    featureType: "road"
                                }]
                            }), i = new google.maps.Marker({
                                map: t,
                                position: t.getCenter(),
                                icon: "/assets/MapPin.png"
                            })
                        }
                    }(this)) : void 0
                },
                autocomplete: function(e, t) {
                    var n, i, r;
                    return null == t && (t = !1), r = e.data("autocomplete-path"), r ? (n = function(e) {
                        return !(e[0] instanceof Array) && e[Object.keys(e)[0]] instanceof Array && (e = e[Object.keys(e)[0]]), e
                    }, i = {
                        paramName: e.data("autocomplete-param") || "term",
                        formatResult: function(e, t) {
                            var n, i, r, o;
                            return i = "(" + $.Autocomplete.utils.escapeRegExChars(t) + ")", r = e.value.replace(new RegExp(i, "gi"), "<strong>$1</strong>"), o = $("<div>").prepend(r), null !== e.picture && void 0 !== e.picture && o.css({
                                background: "url(" + e.picture + ") no-repeat left center",
                                backgroundSize: "22px 22px",
                                paddingLeft: "30px"
                            }), null !== e.link && void 0 !== e.link && (n = $("<div>", {
                                css: {
                                    background: "url(/assets/house-open-icon-c6f2e8e5d08bf0e0d339670f637cca9c.png) no-repeat right center",
                                    paddingRight: "20px"
                                }
                            }), o = n.append(o)), o.wrap("<div>").parent().html()
                        },
                        onSelect: function(e) {
                            return null !== e.link && void 0 !== e.link ? window.location.href = e.link : ($("#house_id").val(e.data), $("#house_id").trigger("change")), $(this).trigger("OnSelect", e)
                        },
                        transformResult: function(e) {
                            return {
                                suggestions: n(e)
                            }
                        }
                    }, t === !0 ? (i.serviceUrl = r, i.dataType = "json", e.autocomplete(i)) : $.get(r).done(function() {
                        return function(t) {
                            return i.lookup = n(t), e.autocomplete(i)
                        }
                    }(this))) : void 0
                },
                socialite_load: function(e) {
                    var t;
                    return t = $("html").prop("lang"), Socialite.setup({
                        facebook: {
                            lang: {
                                uk: "uk_UA",
                                ru: "ru_RU",
                                en: "en_GB"
                            }[t],
                            appId: e.find(".like-button.facebook").data("appid")
                        },
                        vkontakte: {
                            apiId: e.find(".like-button.vkontakte").data("appid")
                        },
                        googleplus: {
                            lang: {
                                uk: "uk_UA",
                                ru: "ru_RU",
                                en: "en_GB"
                            }[t]
                        }
                    }), Socialite.load(e)
                }
            }
        }
    }.call(this),
    function() {
        this.app.cities = {
            init: function() {},
            show: function() {
                return $(window).load(function() {
                    return app.common.socialite_load($(".social-share")), app.common.initialize_map($("#location-on-map"))
                })
            }
        }
    }.call(this),
    function() {
        this.app.home = {
            index: function() {
                var e, t;
                return e = $(".adv"), t = function() {
                    var t;
                    return t = $("#main-slider").height(), e.css({
                        top: t
                    })
                }, $(window).on("load", function() {
                    return t()
                }), $(window).on("resize", function() {
                    return t()
                })
            }
        }
    }.call(this),
    function() {

        var e;
        this.app.houses = {
            index: function() {
                return $(".more-search-options-container").checkboxFilter()
            },
            category: function() {
                return "" === window.location.hash && (window.location.hash = $("#search_anchor").data("anchor")), app.houses.index()
            },
            city: function() {
                return "" === window.location.hash && (window.location.hash = $("#search_anchor").data("anchor")), app.houses.index()
            },
            show: function() {console.log('sss');
                return $(".fancy-photo").fancybox({
                    prevEffect: "none",
                    nextEffect: "none",
                    padding: 0,
                    helpers: {
                        overlay: {
                            locked: !1
                        },
                        thumbs: {
                            width: 50,
                            height: 50
                        }
                    }
                }), $(window).on("resize", function() {  
                    return e($(".header-slider-container"))
                }), $("#carousel").flexslider({
                    keyboard: !1,
                    animation: "slide",
                    controlNav: !1,
                    slideshow: !1,
                    animationLoop: !1,
                    prevText: "",
                    nextText: "",
                    itemWidth: 60,
                    itemMargin: 1,
                    asNavFor: "#slider"
                }), $("#slider").flexslider({
                    keyboard: !0,
                    multipleKeyboard: !0,
                    animation: "slide",
                    controlNav: !1,
                    slideshow: !1,
                    animationLoop: !1,
                    sync: "#carousel",
                    prevText: "",
                    nextText: ""
                }), $("#house_comment_text").simplyCountable({
                    counter: "#count_char",
                    countType: "characters",
                    maxCount: 1e3,
                    strictMax: !0,
                    countDirection: "down",
                    thousandSeparator: ""
                }), $(window).load(function() {
                    return $(window).resize(), app.common.socialite_load($(".social-share")), app.common.initialize_map($("#location-on-map"))
                })
            }
        }, e = function(e) {
            var t, n, i, r;
            r = $(window).height(), t = $(".apartment-short-desc-container").outerHeight(), n = $(".main-header").height(), i = r - t - n, e.height(i)
        }, this.app.house_comments = {
            index: function() {
                return $("#house_comment_text").simplyCountable({
                    counter: "#count_char",
                    countType: "characters",
                    maxCount: 1e3,
                    strictMax: !0,
                    countDirection: "down",
                    thousandSeparator: ""
                })
            }
        }
    }.call(this),
    function() {
        this.app.static_pages = {
            show: function() {
                var e, t, n, i, r;
                return n = !1, i = "", app.common.autocomplete($("#inst-name")), e = $(".overlay"), t = $("#topup-form"), $("#topup").on("click", function() {
                    return e.fadeIn(), t.fadeIn()
                }), e.on("click", function(n) {
                    return n.preventDefault(), t.fadeOut(), e.fadeOut()
                }), $("#close-form, #hide-form-ok").on("click", function(n) {
                    return n.preventDefault(), t.fadeOut(), e.fadeOut()
                }), $(".tooltip").tooltipster({
                    contentAsHTML: !0,
                    theme: "tooltip-custom-link-left"
                }), r = function() {
                    return $("#send-form").prop("disabled", !(n && i))
                }, $("#terms-of-use").on("change", function() {
                    return n = $(this).is(":checked"), r()
                }), $("#house_id").on("change", function() {
                    return i = $(this).val(), r()
                }), $("input.rate").on("change", function() {
                    return $(".full-price span").text($(this).data("price"))
                })
            }
        }
    }.call(this),
    function() {
        var e;
        e = {
            exec: function(e, t) {
                return null == t && (t = "init"), "" !== e && app[e] && "function" == typeof app[e][t] ? app[e][t]() : void 0
            },
            init: function() {
                var t, n, i;
                return n = document.body, i = n.getAttribute("data-controller"), t = n.getAttribute("data-action"), e.exec("common"), e.exec(i), e.exec(i, t)
            }
        }, $(function() {
            return e.init()
        })
    }.call(this),
    function(e, t, n, i) {
        var r = n("html"),
            o = n(e),
            a = n(t),
            s = n.fancybox = function() {
                s.open.apply(this, arguments)
            },
            l = navigator.userAgent.match(/msie/i),
            c = null,
            u = t.createTouch !== i,
            d = function(e) {
                return e && e.hasOwnProperty && e instanceof n
            },
            p = function(e) {
                return e && "string" === n.type(e)
            },
            f = function(e) {
                return p(e) && 0 < e.indexOf("%")
            },
            h = function(e, t) {
                var n = parseInt(e, 10) || 0;
                return t && f(e) && (n *= s.getViewport()[t] / 100), Math.ceil(n)
            },
            g = function(e, t) {
                return h(e, t) + "px"
            };
        n.extend(s, {
            version: "2.1.5",
            defaults: {
                padding: 15,
                margin: 20,
                width: 800,
                height: 600,
                minWidth: 100,
                minHeight: 100,
                maxWidth: 9999,
                maxHeight: 9999,
                pixelRatio: 1,
                autoSize: !0,
                autoHeight: !1,
                autoWidth: !1,
                autoResize: !0,
                autoCenter: !u,
                fitToView: !0,
                aspectRatio: !1,
                topRatio: .5,
                leftRatio: .5,
                scrolling: "auto",
                wrapCSS: "",
                arrows: !0,
                closeBtn: !0,
                closeClick: !1,
                nextClick: !1,
                mouseWheel: !0,
                autoPlay: !1,
                playSpeed: 3e3,
                preload: 3,
                modal: !1,
                loop: !0,
                ajax: {
                    dataType: "html",
                    headers: {
                        "X-fancyBox": !0
                    }
                },
                iframe: {
                    scrolling: "auto",
                    preload: !0
                },
                swf: {
                    wmode: "transparent",
                    allowfullscreen: "true",
                    allowscriptaccess: "always"
                },
                keys: {
                    next: {
                        13: "left",
                        34: "up",
                        39: "left",
                        40: "up"
                    },
                    prev: {
                        8: "right",
                        33: "down",
                        37: "right",
                        38: "down"
                    },
                    close: [27],
                    play: [32],
                    toggle: [70]
                },
                direction: {
                    next: "left",
                    prev: "right"
                },
                scrollOutside: !0,
                index: 0,
                type: null,
                href: null,
                content: null,
                title: null,
                tpl: {
                    wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                    image: '<img class="fancybox-image" src="{href}" alt="" />',
                    iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (l ? ' allowtransparency="true"' : "") + "></iframe>",
                    error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                    closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                    next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                    prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
                },
                openEffect: "fade",
                openSpeed: 250,
                openEasing: "swing",
                openOpacity: !0,
                openMethod: "zoomIn",
                closeEffect: "fade",
                closeSpeed: 250,
                closeEasing: "swing",
                closeOpacity: !0,
                closeMethod: "zoomOut",
                nextEffect: "elastic",
                nextSpeed: 250,
                nextEasing: "swing",
                nextMethod: "changeIn",
                prevEffect: "elastic",
                prevSpeed: 250,
                prevEasing: "swing",
                prevMethod: "changeOut",
                helpers: {
                    overlay: !0,
                    title: !0
                },
                onCancel: n.noop,
                beforeLoad: n.noop,
                afterLoad: n.noop,
                beforeShow: n.noop,
                afterShow: n.noop,
                beforeChange: n.noop,
                beforeClose: n.noop,
                afterClose: n.noop
            },
            group: {},
            opts: {},
            previous: null,
            coming: null,
            current: null,
            isActive: !1,
            isOpen: !1,
            isOpened: !1,
            wrap: null,
            skin: null,
            outer: null,
            inner: null,
            player: {
                timer: null,
                isActive: !1
            },
            ajaxLoad: null,
            imgPreload: null,
            transitions: {},
            helpers: {},
            open: function(e, t) {
                return e && (n.isPlainObject(t) || (t = {}), !1 !== s.close(!0)) ? (n.isArray(e) || (e = d(e) ? n(e).get() : [e]), n.each(e, function(r, o) {
                    var a, l, c, u, f, h = {};
                    "object" === n.type(o) && (o.nodeType && (o = n(o)), d(o) ? (h = {
                        href: o.data("fancybox-href") || o.attr("href"),
                        title: o.data("fancybox-title") || o.attr("title"),
                        isDom: !0,
                        element: o
                    }, n.metadata && n.extend(!0, h, o.metadata())) : h = o), a = t.href || h.href || (p(o) ? o : null), l = t.title !== i ? t.title : h.title || "", u = (c = t.content || h.content) ? "html" : t.type || h.type, !u && h.isDom && (u = o.data("fancybox-type"), u || (u = (u = o.prop("class").match(/fancybox\.(\w+)/)) ? u[1] : null)), p(a) && (u || (s.isImage(a) ? u = "image" : s.isSWF(a) ? u = "swf" : "#" === a.charAt(0) ? u = "inline" : p(o) && (u = "html", c = o)), "ajax" === u && (f = a.split(/\s+/, 2), a = f.shift(), f = f.shift())), c || ("inline" === u ? a ? c = n(p(a) ? a.replace(/.*(?=#[^\s]+$)/, "") : a) : h.isDom && (c = o) : "html" === u ? c = a : !u && !a && h.isDom && (u = "inline", c = o)), n.extend(h, {
                        href: a,
                        type: u,
                        content: c,
                        title: l,
                        selector: f
                    }), e[r] = h
                }), s.opts = n.extend(!0, {}, s.defaults, t), t.keys !== i && (s.opts.keys = t.keys ? n.extend({}, s.defaults.keys, t.keys) : !1), s.group = e, s._start(s.opts.index)) : void 0
            },
            cancel: function() {
                var e = s.coming;
                e && !1 !== s.trigger("onCancel") && (s.hideLoading(), s.ajaxLoad && s.ajaxLoad.abort(), s.ajaxLoad = null, s.imgPreload && (s.imgPreload.onload = s.imgPreload.onerror = null), e.wrap && e.wrap.stop(!0, !0).trigger("onReset").remove(), s.coming = null, s.current || s._afterZoomOut(e))
            },
            close: function(e) {
                s.cancel(), !1 !== s.trigger("beforeClose") && (s.unbindEvents(), s.isActive && (s.isOpen && !0 !== e ? (s.isOpen = s.isOpened = !1, s.isClosing = !0, n(".fancybox-item, .fancybox-nav").remove(), s.wrap.stop(!0, !0).removeClass("fancybox-opened"), s.transitions[s.current.closeMethod]()) : (n(".fancybox-wrap").stop(!0).trigger("onReset").remove(), s._afterZoomOut())))
            },
            play: function(e) {
                var t = function() {
                        clearTimeout(s.player.timer)
                    },
                    n = function() {
                        t(), s.current && s.player.isActive && (s.player.timer = setTimeout(s.next, s.current.playSpeed))
                    },
                    i = function() {
                        t(), a.unbind(".player"), s.player.isActive = !1, s.trigger("onPlayEnd")
                    };
                !0 === e || !s.player.isActive && !1 !== e ? s.current && (s.current.loop || s.current.index < s.group.length - 1) && (s.player.isActive = !0, a.bind({
                    "onCancel.player beforeClose.player": i,
                    "onUpdate.player": n,
                    "beforeLoad.player": t
                }), n(), s.trigger("onPlayStart")) : i()
            },
            next: function(e) {
                var t = s.current;
                t && (p(e) || (e = t.direction.next), s.jumpto(t.index + 1, e, "next"))
            },
            prev: function(e) {
                var t = s.current;
                t && (p(e) || (e = t.direction.prev), s.jumpto(t.index - 1, e, "prev"))
            },
            jumpto: function(e, t, n) {
                var r = s.current;
                r && (e = h(e), s.direction = t || r.direction[e >= r.index ? "next" : "prev"], s.router = n || "jumpto", r.loop && (0 > e && (e = r.group.length + e % r.group.length), e %= r.group.length), r.group[e] !== i && (s.cancel(), s._start(e)))
            },
            reposition: function(e, t) {
                var i, r = s.current,
                    o = r ? r.wrap : null;
                o && (i = s._getPosition(t), e && "scroll" === e.type ? (delete i.position, o.stop(!0, !0).animate(i, 200)) : (o.css(i), r.pos = n.extend({}, r.dim, i)))
            },
            update: function(e) {
                var t = e && e.type,
                    n = !t || "orientationchange" === t;
                n && (clearTimeout(c), c = null), s.isOpen && !c && (c = setTimeout(function() {
                    var i = s.current;
                    i && !s.isClosing && (s.wrap.removeClass("fancybox-tmp"), (n || "load" === t || "resize" === t && i.autoResize) && s._setDimension(), "scroll" === t && i.canShrink || s.reposition(e), s.trigger("onUpdate"), c = null)
                }, n && !u ? 0 : 300))
            },
            toggle: function(e) {
                s.isOpen && (s.current.fitToView = "boolean" === n.type(e) ? e : !s.current.fitToView, u && (s.wrap.removeAttr("style").addClass("fancybox-tmp"), s.trigger("onUpdate")), s.update())
            },
            hideLoading: function() {
                a.unbind(".loading"), n("#fancybox-loading").remove()
            },
            showLoading: function() {
                var e, t;
                s.hideLoading(), e = n('<div id="fancybox-loading"><div></div></div>').click(s.cancel).appendTo("body"), a.bind("keydown.loading", function(e) {
                    27 === (e.which || e.keyCode) && (e.preventDefault(), s.cancel())
                }), s.defaults.fixed || (t = s.getViewport(), e.css({
                    position: "absolute",
                    top: .5 * t.h + t.y,
                    left: .5 * t.w + t.x
                }))
            },
            getViewport: function() {
                var t = s.current && s.current.locked || !1,
                    n = {
                        x: o.scrollLeft(),
                        y: o.scrollTop()
                    };
                return t ? (n.w = t[0].clientWidth, n.h = t[0].clientHeight) : (n.w = u && e.innerWidth ? e.innerWidth : o.width(), n.h = u && e.innerHeight ? e.innerHeight : o.height()), n
            },
            unbindEvents: function() {
                s.wrap && d(s.wrap) && s.wrap.unbind(".fb"), a.unbind(".fb"), o.unbind(".fb")
            },
            bindEvents: function() {
                var e, t = s.current;
                t && (o.bind("orientationchange.fb" + (u ? "" : " resize.fb") + (t.autoCenter && !t.locked ? " scroll.fb" : ""), s.update), (e = t.keys) && a.bind("keydown.fb", function(r) {
                    var o = r.which || r.keyCode,
                        a = r.target || r.srcElement;
                    return 27 === o && s.coming ? !1 : void!(r.ctrlKey || r.altKey || r.shiftKey || r.metaKey || a && (a.type || n(a).is("[contenteditable]")) || !n.each(e, function(e, a) {
                        return 1 < t.group.length && a[o] !== i ? (s[e](a[o]), r.preventDefault(), !1) : -1 < n.inArray(o, a) ? (s[e](), r.preventDefault(), !1) : void 0
                    }))
                }), n.fn.mousewheel && t.mouseWheel && s.wrap.bind("mousewheel.fb", function(e, i, r, o) {
                    for (var a = n(e.target || null), l = !1; a.length && !l && !a.is(".fancybox-skin") && !a.is(".fancybox-wrap");) l = a[0] && !(a[0].style.overflow && "hidden" === a[0].style.overflow) && (a[0].clientWidth && a[0].scrollWidth > a[0].clientWidth || a[0].clientHeight && a[0].scrollHeight > a[0].clientHeight), a = n(a).parent();
                    0 !== i && !l && 1 < s.group.length && !t.canShrink && (o > 0 || r > 0 ? s.prev(o > 0 ? "down" : "left") : (0 > o || 0 > r) && s.next(0 > o ? "up" : "right"), e.preventDefault())
                }))
            },
            trigger: function(e, t) {
                var i, r = t || s.coming || s.current;
                if (r) {
                    if (n.isFunction(r[e]) && (i = r[e].apply(r, Array.prototype.slice.call(arguments, 1))), !1 === i) return !1;
                    r.helpers && n.each(r.helpers, function(t, i) {
                        i && s.helpers[t] && n.isFunction(s.helpers[t][e]) && s.helpers[t][e](n.extend(!0, {}, s.helpers[t].defaults, i), r)
                    }), a.trigger(e)
                }
            },
            isImage: function(e) {
                return p(e) && e.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
            },
            isSWF: function(e) {
                return p(e) && e.match(/\.(swf)((\?|#).*)?$/i)
            },
            _start: function(e) {
                var t, i, r = {};
                if (e = h(e), t = s.group[e] || null, !t) return !1;
                if (r = n.extend(!0, {}, s.opts, t), t = r.margin, i = r.padding, "number" === n.type(t) && (r.margin = [t, t, t, t]), "number" === n.type(i) && (r.padding = [i, i, i, i]), r.modal && n.extend(!0, r, {
                        closeBtn: !1,
                        closeClick: !1,
                        nextClick: !1,
                        arrows: !1,
                        mouseWheel: !1,
                        keys: null,
                        helpers: {
                            overlay: {
                                closeClick: !1
                            }
                        }
                    }), r.autoSize && (r.autoWidth = r.autoHeight = !0), "auto" === r.width && (r.autoWidth = !0), "auto" === r.height && (r.autoHeight = !0), r.group = s.group, r.index = e, s.coming = r, !1 === s.trigger("beforeLoad")) s.coming = null;
                else {
                    if (i = r.type, t = r.href, !i) return s.coming = null, s.current && s.router && "jumpto" !== s.router ? (s.current.index = e, s[s.router](s.direction)) : !1;
                    if (s.isActive = !0, ("image" === i || "swf" === i) && (r.autoHeight = r.autoWidth = !1, r.scrolling = "visible"), "image" === i && (r.aspectRatio = !0), "iframe" === i && u && (r.scrolling = "scroll"), r.wrap = n(r.tpl.wrap).addClass("fancybox-" + (u ? "mobile" : "desktop") + " fancybox-type-" + i + " fancybox-tmp " + r.wrapCSS).appendTo(r.parent || "body"), n.extend(r, {
                            skin: n(".fancybox-skin", r.wrap),
                            outer: n(".fancybox-outer", r.wrap),
                            inner: n(".fancybox-inner", r.wrap)
                        }), n.each(["Top", "Right", "Bottom", "Left"], function(e, t) {
                            r.skin.css("padding" + t, g(r.padding[e]))
                        }), s.trigger("onReady"), "inline" === i || "html" === i) {
                        if (!r.content || !r.content.length) return s._error("content")
                    } else if (!t) return s._error("href");
                    "image" === i ? s._loadImage() : "ajax" === i ? s._loadAjax() : "iframe" === i ? s._loadIframe() : s._afterLoad()
                }
            },
            _error: function(e) {
                n.extend(s.coming, {
                    type: "html",
                    autoWidth: !0,
                    autoHeight: !0,
                    minWidth: 0,
                    minHeight: 0,
                    scrolling: "no",
                    hasError: e,
                    content: s.coming.tpl.error
                }), s._afterLoad()
            },
            _loadImage: function() {
                var e = s.imgPreload = new Image;
                e.onload = function() {
                    this.onload = this.onerror = null, s.coming.width = this.width / s.opts.pixelRatio, s.coming.height = this.height / s.opts.pixelRatio, s._afterLoad()
                }, e.onerror = function() {
                    this.onload = this.onerror = null, s._error("image")
                }, e.src = s.coming.href, !0 !== e.complete && s.showLoading()
            },
            _loadAjax: function() {
                var e = s.coming;
                s.showLoading(), s.ajaxLoad = n.ajax(n.extend({}, e.ajax, {
                    url: e.href,
                    error: function(e, t) {
                        s.coming && "abort" !== t ? s._error("ajax", e) : s.hideLoading()
                    },
                    success: function(t, n) {
                        "success" === n && (e.content = t, s._afterLoad())
                    }
                }))
            },
            _loadIframe: function() {
                var e = s.coming,
                    t = n(e.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", u ? "auto" : e.iframe.scrolling).attr("src", e.href);
                n(e.wrap).bind("onReset", function() {
                    try {
                        n(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                    } catch (e) {}
                }), e.iframe.preload && (s.showLoading(), t.one("load", function() {
                    n(this).data("ready", 1), u || n(this).bind("load.fb", s.update), n(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), s._afterLoad()
                })), e.content = t.appendTo(e.inner), e.iframe.preload || s._afterLoad()
            },
            _preloadImages: function() {
                var e, t, n = s.group,
                    i = s.current,
                    r = n.length,
                    o = i.preload ? Math.min(i.preload, r - 1) : 0;
                for (t = 1; o >= t; t += 1) e = n[(i.index + t) % r], "image" === e.type && e.href && ((new Image).src = e.href)
            },
            _afterLoad: function() {
                var e, t, i, r, o, a = s.coming,
                    l = s.current;
                if (s.hideLoading(), a && !1 !== s.isActive)
                    if (!1 === s.trigger("afterLoad", a, l)) a.wrap.stop(!0).trigger("onReset").remove(), s.coming = null;
                    else {
                        switch (l && (s.trigger("beforeChange", l), l.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), s.unbindEvents(), e = a.content, t = a.type, i = a.scrolling, n.extend(s, {
                            wrap: a.wrap,
                            skin: a.skin,
                            outer: a.outer,
                            inner: a.inner,
                            current: a,
                            previous: l
                        }), r = a.href, t) {
                            case "inline":
                            case "ajax":
                            case "html":
                                a.selector ? e = n("<div>").html(e).find(a.selector) : d(e) && (e.data("fancybox-placeholder") || e.data("fancybox-placeholder", n('<div class="fancybox-placeholder"></div>').insertAfter(e).hide()), e = e.show().detach(), a.wrap.bind("onReset", function() {
                                    n(this).find(e).length && e.hide().replaceAll(e.data("fancybox-placeholder")).data("fancybox-placeholder", !1)
                                }));
                                break;
                            case "image":
                                e = a.tpl.image.replace("{href}", r);
                                break;
                            case "swf":
                                e = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + r + '"></param>', o = "", n.each(a.swf, function(t, n) {
                                    e += '<param name="' + t + '" value="' + n + '"></param>', o += " " + t + '="' + n + '"'
                                }), e += '<embed src="' + r + '" type="application/x-shockwave-flash" width="100%" height="100%"' + o + "></embed></object>"
                        }(!d(e) || !e.parent().is(a.inner)) && a.inner.append(e), s.trigger("beforeShow"), a.inner.css("overflow", "yes" === i ? "scroll" : "no" === i ? "hidden" : i), s._setDimension(), s.reposition(), s.isOpen = !1, s.coming = null, s.bindEvents(), s.isOpened ? l.prevMethod && s.transitions[l.prevMethod]() : n(".fancybox-wrap").not(a.wrap).stop(!0).trigger("onReset").remove(), s.transitions[s.isOpened ? a.nextMethod : a.openMethod](), s._preloadImages()
                    }
            },
            _setDimension: function() {
                var e, t, i, r, o, a, l, c, u, d = s.getViewport(),
                    p = 0,
                    m = !1,
                    v = !1,
                    m = s.wrap,
                    y = s.skin,
                    b = s.inner,
                    x = s.current,
                    v = x.width,
                    w = x.height,
                    C = x.minWidth,
                    _ = x.minHeight,
                    k = x.maxWidth,
                    S = x.maxHeight,
                    T = x.scrolling,
                    $ = x.scrollOutside ? x.scrollbarWidth : 0,
                    A = x.margin,
                    E = h(A[1] + A[3]),
                    N = h(A[0] + A[2]);
                if (m.add(y).add(b).width("auto").height("auto").removeClass("fancybox-tmp"), A = h(y.outerWidth(!0) - y.width()), e = h(y.outerHeight(!0) - y.height()), t = E + A, i = N + e, r = f(v) ? (d.w - t) * h(v) / 100 : v, o = f(w) ? (d.h - i) * h(w) / 100 : w, "iframe" === x.type) {
                    if (u = x.content, x.autoHeight && 1 === u.data("ready")) try {
                        u[0].contentWindow.document.location && (b.width(r).height(9999), a = u.contents().find("body"), $ && a.css("overflow-x", "hidden"), o = a.outerHeight(!0))
                    } catch (O) {}
                } else(x.autoWidth || x.autoHeight) && (b.addClass("fancybox-tmp"), x.autoWidth || b.width(r), x.autoHeight || b.height(o), x.autoWidth && (r = b.width()), x.autoHeight && (o = b.height()), b.removeClass("fancybox-tmp"));
                if (v = h(r), w = h(o), c = r / o, C = h(f(C) ? h(C, "w") - t : C), k = h(f(k) ? h(k, "w") - t : k), _ = h(f(_) ? h(_, "h") - i : _), S = h(f(S) ? h(S, "h") - i : S), a = k, l = S, x.fitToView && (k = Math.min(d.w - t, k), S = Math.min(d.h - i, S)), t = d.w - E, N = d.h - N, x.aspectRatio ? (v > k && (v = k, w = h(v / c)), w > S && (w = S, v = h(w * c)), C > v && (v = C, w = h(v / c)), _ > w && (w = _, v = h(w * c))) : (v = Math.max(C, Math.min(v, k)), x.autoHeight && "iframe" !== x.type && (b.width(v), w = b.height()), w = Math.max(_, Math.min(w, S))), x.fitToView)
                    if (b.width(v).height(w), m.width(v + A), d = m.width(), E = m.height(), x.aspectRatio)
                        for (;
                            (d > t || E > N) && v > C && w > _ && !(19 < p++);) w = Math.max(_, Math.min(S, w - 10)), v = h(w * c), C > v && (v = C, w = h(v / c)), v > k && (v = k, w = h(v / c)), b.width(v).height(w), m.width(v + A), d = m.width(), E = m.height();
                    else v = Math.max(C, Math.min(v, v - (d - t))), w = Math.max(_, Math.min(w, w - (E - N)));
                $ && "auto" === T && o > w && t > v + A + $ && (v += $), b.width(v).height(w), m.width(v + A), d = m.width(), E = m.height(), m = (d > t || E > N) && v > C && w > _, v = x.aspectRatio ? a > v && l > w && r > v && o > w : (a > v || l > w) && (r > v || o > w), n.extend(x, {
                    dim: {
                        width: g(d),
                        height: g(E)
                    },
                    origWidth: r,
                    origHeight: o,
                    canShrink: m,
                    canExpand: v,
                    wPadding: A,
                    hPadding: e,
                    wrapSpace: E - y.outerHeight(!0),
                    skinSpace: y.height() - w
                }), !u && x.autoHeight && w > _ && S > w && !v && b.height("auto")
            },
            _getPosition: function(e) {
                var t = s.current,
                    n = s.getViewport(),
                    i = t.margin,
                    r = s.wrap.width() + i[1] + i[3],
                    o = s.wrap.height() + i[0] + i[2],
                    i = {
                        position: "absolute",
                        top: i[0],
                        left: i[3]
                    };
                return t.autoCenter && t.fixed && !e && o <= n.h && r <= n.w ? i.position = "fixed" : t.locked || (i.top += n.y, i.left += n.x), i.top = g(Math.max(i.top, i.top + (n.h - o) * t.topRatio)), i.left = g(Math.max(i.left, i.left + (n.w - r) * t.leftRatio)), i
            },
            _afterZoomIn: function() {
                var e = s.current;
                e && (s.isOpen = s.isOpened = !0, s.wrap.css("overflow", "visible").addClass("fancybox-opened"), s.update(), (e.closeClick || e.nextClick && 1 < s.group.length) && s.inner.css("cursor", "pointer").bind("click.fb", function(t) {
                    !n(t.target).is("a") && !n(t.target).parent().is("a") && (t.preventDefault(), s[e.closeClick ? "close" : "next"]())
                }), e.closeBtn && n(e.tpl.closeBtn).appendTo(s.skin).bind("click.fb", function(e) {
                    e.preventDefault(), s.close()
                }), e.arrows && 1 < s.group.length && ((e.loop || 0 < e.index) && n(e.tpl.prev).appendTo(s.outer).bind("click.fb", s.prev), (e.loop || e.index < s.group.length - 1) && n(e.tpl.next).appendTo(s.outer).bind("click.fb", s.next)), s.trigger("afterShow"), e.loop || e.index !== e.group.length - 1 ? s.opts.autoPlay && !s.player.isActive && (s.opts.autoPlay = !1, s.play()) : s.play(!1))
            },
            _afterZoomOut: function(e) {
                e = e || s.current, n(".fancybox-wrap").trigger("onReset").remove(), n.extend(s, {
                    group: {},
                    opts: {},
                    router: !1,
                    current: null,
                    isActive: !1,
                    isOpened: !1,
                    isOpen: !1,
                    isClosing: !1,
                    wrap: null,
                    skin: null,
                    outer: null,
                    inner: null
                }), s.trigger("afterClose", e)
            }
        }), s.transitions = {
            getOrigPosition: function() {
                var e = s.current,
                    t = e.element,
                    n = e.orig,
                    i = {},
                    r = 50,
                    o = 50,
                    a = e.hPadding,
                    l = e.wPadding,
                    c = s.getViewport();
                return !n && e.isDom && t.is(":visible") && (n = t.find("img:first"), n.length || (n = t)), d(n) ? (i = n.offset(), n.is("img") && (r = n.outerWidth(), o = n.outerHeight())) : (i.top = c.y + (c.h - o) * e.topRatio, i.left = c.x + (c.w - r) * e.leftRatio), ("fixed" === s.wrap.css("position") || e.locked) && (i.top -= c.y, i.left -= c.x), i = {
                    top: g(i.top - a * e.topRatio),
                    left: g(i.left - l * e.leftRatio),
                    width: g(r + l),
                    height: g(o + a)
                }
            },
            step: function(e, t) {
                var n, i, r = t.prop;
                i = s.current;
                var o = i.wrapSpace,
                    a = i.skinSpace;
                ("width" === r || "height" === r) && (n = t.end === t.start ? 1 : (e - t.start) / (t.end - t.start), s.isClosing && (n = 1 - n), i = "width" === r ? i.wPadding : i.hPadding, i = e - i, s.skin[r](h("width" === r ? i : i - o * n)), s.inner[r](h("width" === r ? i : i - o * n - a * n)))
            },
            zoomIn: function() {
                var e = s.current,
                    t = e.pos,
                    i = e.openEffect,
                    r = "elastic" === i,
                    o = n.extend({
                        opacity: 1
                    }, t);
                delete o.position, r ? (t = this.getOrigPosition(), e.openOpacity && (t.opacity = .1)) : "fade" === i && (t.opacity = .1), s.wrap.css(t).animate(o, {
                    duration: "none" === i ? 0 : e.openSpeed,
                    easing: e.openEasing,
                    step: r ? this.step : null,
                    complete: s._afterZoomIn
                })
            },
            zoomOut: function() {
                var e = s.current,
                    t = e.closeEffect,
                    n = "elastic" === t,
                    i = {
                        opacity: .1
                    };
                n && (i = this.getOrigPosition(), e.closeOpacity && (i.opacity = .1)), s.wrap.animate(i, {
                    duration: "none" === t ? 0 : e.closeSpeed,
                    easing: e.closeEasing,
                    step: n ? this.step : null,
                    complete: s._afterZoomOut
                })
            },
            changeIn: function() {
                var e, t = s.current,
                    n = t.nextEffect,
                    i = t.pos,
                    r = {
                        opacity: 1
                    },
                    o = s.direction;
                i.opacity = .1, "elastic" === n && (e = "down" === o || "up" === o ? "top" : "left", "down" === o || "right" === o ? (i[e] = g(h(i[e]) - 200), r[e] = "+=200px") : (i[e] = g(h(i[e]) + 200), r[e] = "-=200px")), "none" === n ? s._afterZoomIn() : s.wrap.css(i).animate(r, {
                    duration: t.nextSpeed,
                    easing: t.nextEasing,
                    complete: s._afterZoomIn
                })
            },
            changeOut: function() {
                var e = s.previous,
                    t = e.prevEffect,
                    i = {
                        opacity: .1
                    },
                    r = s.direction;
                "elastic" === t && (i["down" === r || "up" === r ? "top" : "left"] = ("up" === r || "left" === r ? "-" : "+") + "=200px"), e.wrap.animate(i, {
                    duration: "none" === t ? 0 : e.prevSpeed,
                    easing: e.prevEasing,
                    complete: function() {
                        n(this).trigger("onReset").remove()
                    }
                })
            }
        }, s.helpers.overlay = {
            defaults: {
                closeClick: !0,
                speedOut: 200,
                showEarly: !0,
                css: {},
                locked: !u,
                fixed: !0
            },
            overlay: null,
            fixed: !1,
            el: n("html"),
            create: function(e) {
                e = n.extend({}, this.defaults, e), this.overlay && this.close(), this.overlay = n('<div class="fancybox-overlay"></div>').appendTo(s.coming ? s.coming.parent : e.parent), this.fixed = !1, e.fixed && s.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
            },
            open: function(e) {
                var t = this;
                e = n.extend({}, this.defaults, e), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(e), this.fixed || (o.bind("resize.overlay", n.proxy(this.update, this)), this.update()), e.closeClick && this.overlay.bind("click.overlay", function(e) {
                    return n(e.target).hasClass("fancybox-overlay") ? (s.isActive ? s.close() : t.close(), !1) : void 0
                }), this.overlay.css(e.css).show()
            },
            close: function() {
                var e, t;
                o.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (n(".fancybox-margin").removeClass("fancybox-margin"), e = o.scrollTop(), t = o.scrollLeft(), this.el.removeClass("fancybox-lock"), o.scrollTop(e).scrollLeft(t)), n(".fancybox-overlay").remove().hide(), n.extend(this, {
                    overlay: null,
                    fixed: !1
                })
            },
            update: function() {
                var e, n = "100%";
                this.overlay.width(n).height("100%"), l ? (e = Math.max(t.documentElement.offsetWidth, t.body.offsetWidth), a.width() > e && (n = a.width())) : a.width() > o.width() && (n = a.width()), this.overlay.width(n).height(a.height())
            },
            onReady: function(e, t) {
                var i = this.overlay;
                n(".fancybox-overlay").stop(!0, !0), i || this.create(e), e.locked && this.fixed && t.fixed && (i || (this.margin = a.height() > o.height() ? n("html").css("margin-right").replace("px", "") : !1), t.locked = this.overlay.append(t.wrap), t.fixed = !1), !0 === e.showEarly && this.beforeShow.apply(this, arguments)
            },
            beforeShow: function(e, t) {
                var i, r;
                t.locked && (!1 !== this.margin && (n("*").filter(function() {
                    return "fixed" === n(this).css("position") && !n(this).hasClass("fancybox-overlay") && !n(this).hasClass("fancybox-wrap")
                }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin")), i = o.scrollTop(), r = o.scrollLeft(), this.el.addClass("fancybox-lock"), o.scrollTop(i).scrollLeft(r)), this.open(e)
            },
            onUpdate: function() {
                this.fixed || this.update()
            },
            afterClose: function(e) {
                this.overlay && !s.coming && this.overlay.fadeOut(e.speedOut, n.proxy(this.close, this))
            }
        }, s.helpers.title = {
            defaults: {
                type: "float",
                position: "bottom"
            },
            beforeShow: function(e) {
                var t = s.current,
                    i = t.title,
                    r = e.type;
                if (n.isFunction(i) && (i = i.call(t.element, t)), p(i) && "" !== n.trim(i)) {
                    switch (t = n('<div class="fancybox-title fancybox-title-' + r + '-wrap">' + i + "</div>"), r) {
                        case "inside":
                            r = s.skin;
                            break;
                        case "outside":
                            r = s.wrap;
                            break;
                        case "over":
                            r = s.inner;
                            break;
                        default:
                            r = s.skin, t.appendTo("body"), l && t.width(t.width()), t.wrapInner('<span class="child"></span>'), s.current.margin[2] += Math.abs(h(t.css("margin-bottom")))
                    }
                    t["top" === e.position ? "prependTo" : "appendTo"](r)
                }
            }
        }, n.fn.fancybox = function(e) {
            var t, i = n(this),
                r = this.selector || "",
                o = function(o) {
                    var a, l, c = n(this).blur(),
                        u = t;
                    !(o.ctrlKey || o.altKey || o.shiftKey || o.metaKey || c.is(".fancybox-wrap") || (a = e.groupAttr || "data-fancybox-group", l = c.attr(a), l || (a = "rel", l = c.get(0)[a]), l && "" !== l && "nofollow" !== l && (c = r.length ? n(r) : i, c = c.filter("[" + a + '="' + l + '"]'), u = c.index(this)), e.index = u, !1 === s.open(c, e) || !o.preventDefault()))
                };
            return e = e || {}, t = e.index || 0, r && !1 !== e.live ? a.undelegate(r, "click.fb-start").delegate(r + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", o) : i.unbind("click.fb-start").bind("click.fb-start", o), this.filter("[data-fancybox-start=1]").trigger("click"), this
        }, a.ready(function() {
            var t, o;
            if (n.scrollbarWidth === i && (n.scrollbarWidth = function() {
                    var e = n('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),
                        t = e.children(),
                        t = t.innerWidth() - t.height(99).innerWidth();
                    return e.remove(), t
                }), n.support.fixedPosition === i) {
                t = n.support, o = n('<div style="position:fixed;top:20px;"></div>').appendTo("body");
                var a = 20 === o[0].offsetTop || 15 === o[0].offsetTop;
                o.remove(), t.fixedPosition = a
            }
            n.extend(s.defaults, {
                scrollbarWidth: n.scrollbarWidth(),
                fixed: n.support.fixedPosition,
                parent: n("body")
            }), t = n(e).width(), r.addClass("fancybox-lock-test"), o = n(e).width(), r.removeClass("fancybox-lock-test"), n("<style type='text/css'>.fancybox-margin{margin-right:" + (o - t) + "px;}</style>").appendTo("head")
        })
    }(window, document, jQuery),
    function(e) {
        var t = e.fancybox;
        t.helpers.thumbs = {
            defaults: {
                width: 50,
                height: 50,
                position: "bottom",
                source: function(t) {
                    var n;
                    return t.element && (n = e(t.element).find("img").attr("src")), !n && "image" === t.type && t.href && (n = t.href), n
                }
            },
            wrap: null,
            list: null,
            width: 0,
            init: function(t, n) {
                var i, r = this,
                    o = t.width,
                    a = t.height,
                    s = t.source;
                i = "";
                for (var l = 0; l < n.group.length; l++) i += '<li><a style="width:' + o + "px;height:" + a + 'px;" href="javascript:jQuery.fancybox.jumpto(' + l + ');"></a></li>';
                this.wrap = e('<div id="fancybox-thumbs"></div>').addClass(t.position).appendTo("body"), this.list = e("<ul>" + i + "</ul>").appendTo(this.wrap), e.each(n.group, function(t) {
                    var i = s(n.group[t]);
                    i && e("<img />").load(function() {
                        var n, i, s, l = this.width,
                            c = this.height;
                        r.list && l && c && (n = l / o, i = c / a, s = r.list.children().eq(t).find("a"), n >= 1 && i >= 1 && (n > i ? (l = Math.floor(l / i), c = a) : (l = o, c = Math.floor(c / n))), e(this).css({
                            width: l,
                            height: c,
                            top: Math.floor(a / 2 - c / 2),
                            left: Math.floor(o / 2 - l / 2)
                        }), s.width(o).height(a), e(this).hide().appendTo(s).fadeIn(300))
                    }).attr("src", i)
                }), this.width = this.list.children().eq(0).outerWidth(!0), this.list.width(this.width * (n.group.length + 1)).css("left", Math.floor(.5 * e(window).width() - (n.index * this.width + .5 * this.width)))
            },
            beforeLoad: function(e, t) {
                return t.group.length < 2 ? void(t.helpers.thumbs = !1) : void(t.margin["top" === e.position ? 0 : 2] += e.height + 15)
            },
            afterShow: function(e, t) {
                this.list ? this.onUpdate(e, t) : this.init(e, t), this.list.children().removeClass("active").eq(t.index).addClass("active")
            },
            onUpdate: function(t, n) {
                this.list && this.list.stop(!0).animate({
                    left: Math.floor(.5 * e(window).width() - (n.index * this.width + .5 * this.width))
                }, 150)
            },
            beforeClose: function() {
                this.wrap && this.wrap.remove(), this.wrap = null, this.list = null, this.width = 0
            }
        }
    }(jQuery),
    function() {
        ! function() {
            var e, t, n, i, r;
            return r = ".js-menu-toggler", n = ".js-main-menu", i = ".js-menu-page-overlay", t = function(e) {
                return e.stopPropagation(), e.preventDefault(), $([r, n, i].join(", ")).toggleClass("active"), $("body").toggleClass("overflow-hidden"), $(".js-menu-category").removeClass("opened"), $(".js-menu-category.active").addClass("opened")
            }, e = function(e) {
                var t;
                return e.stopPropagation(), e.preventDefault(), t = $(this).parent().hasClass("opened"), $(".js-menu-category").removeClass("opened"), t ? void 0 : $(this).parent().addClass("opened")
            }, $(document).on("click", [r, i].join(", "), t), $(document).on("click", ".js-menu-category-name", e)
        }()
    }.call(this),
    function() {}.call(this);