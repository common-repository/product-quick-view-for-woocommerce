"use strict";

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*(function( $ ) {
    'use strict';
*/
/**
 * All of the code for your public-facing JavaScript source
 * should reside in this file.
 *
 * Note: It has been assumed you will write jQuery code here, so the
 * $ function reference has been prepared for usage within the scope
 * of this function.
 *
 * This enables you to define handlers, for when the DOM is ready:
 *
 * $(function() {
 *
 * });
 *
 * When the window is loaded:
 *
 * $( window ).load(function() {
 *
 * });
 *
 * ...and/or other possibilities.
 *
 * Ideally, it is not considered best practise to attach more than a
 * single DOM-ready or window-load handler for a particular page.
 * Although scripts in the WordPress core, Plugins and Themes may be
 * practising this, we should strive to set a better example in our own work.
 */
/*
})( jQuery );
*/

/*glide.js*/
!function (t, e) {
    "object" == (typeof exports === "undefined" ? "undefined" : _typeof(exports)) && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.Glide = e();
}(undefined, function () {
    "use strict";

    var t = {
        type: "slider",
        startAt: 0,
        perView: 1,
        focusAt: 0,
        gap: 10,
        autoplay: !1,
        hoverpause: !0,
        keyboard: !0,
        swipeThreshold: 80,
        dragThreshold: 120,
        perTouch: !1,
        touchRatio: .5,
        touchAngle: 45,
        animationDuration: 400,
        rewindDuration: 800,
        animationTimingFunc: "cubic-bezier(0.165, 0.840, 0.440, 1.000)",
        throttle: 10,
        direction: "ltr",
        peek: 0,
        breakpoints: {},
        classes: {
            direction: {
                ltr: "glide--ltr",
                rtl: "glide--rtl"
            },
            slider: "glide--slider",
            carousel: "glide--carousel",
            swipeable: "glide--swipeable",
            dragging: "glide--dragging",
            cloneSlide: "glide__slide--clone",
            activeNav: "glide__bullet--active",
            activeSlide: "glide__slide--active",
            disabledArrow: "glide__arrow--disabled"
        }
    };

    function e(t) {
        console.error("[Glide warn]: " + t);
    }
    var n = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (t) {
        return typeof t === "undefined" ? "undefined" : _typeof(t);
    } : function (t) {
        return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t === "undefined" ? "undefined" : _typeof(t);
    },
        i = function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
    },
        o = function () {
        function t(t, e) {
            for (var n = 0; n < e.length; n++) {
                var i = e[n];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i);
            }
        }
        return function (e, n, i) {
            return n && t(e.prototype, n), i && t(e, i), e;
        };
    }(),
        r = Object.assign || function (t) {
        for (var e = 1; e < arguments.length; e++) {
            var n = arguments[e];
            for (var i in n) {
                Object.prototype.hasOwnProperty.call(n, i) && (t[i] = n[i]);
            }
        }
        return t;
    },
        s = function s(t, e) {
        if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !e || "object" != (typeof e === "undefined" ? "undefined" : _typeof(e)) && "function" != typeof e ? t : e;
    };

    function u(t) {
        return parseInt(t);
    }

    function a(t) {
        return "string" == typeof t;
    }

    function c(t) {
        var e = void 0 === t ? "undefined" : n(t);
        return "function" === e || "object" === e && !!t;
    }

    function l(t) {
        return "function" == typeof t;
    }

    function f(t) {
        return void 0 === t;
    }

    function d(t) {
        return t.constructor === Array;
    }

    function h(t, e, n) {
        Object.defineProperty(t, e, n);
    }
    var p = function () {
        function t() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            i(this, t), this.events = e, this.hop = e.hasOwnProperty;
        }
        return o(t, [{
            key: "on",
            value: function value(t, e) {
                if (d(t)) for (var n = 0; n < t.length; n++) {
                    this.on(t[n], e);
                }this.hop.call(this.events, t) || (this.events[t] = []);
                var i = this.events[t].push(e) - 1;
                return {
                    remove: function remove() {
                        delete this.events[t][i];
                    }
                };
            }
        }, {
            key: "emit",
            value: function value(t, e) {
                if (d(t)) for (var n = 0; n < t.length; n++) {
                    this.emit(t[n], e);
                }this.hop.call(this.events, t) && this.events[t].forEach(function (t) {
                    t(e || {});
                });
            }
        }]), t;
    }(),
        v = function () {
        function n(e) {
            var o,
                s,
                u,
                a = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            i(this, n), this._c = {}, this._e = new p(), this.disabled = !1, this.selector = e, this.settings = (u = r({}, o = t, s = a), s.hasOwnProperty("classes") && (u.classes = r({}, o.classes, s.classes), s.classes.hasOwnProperty("direction") && (u.classes.direction = r({}, o.classes.direction, s.classes.direction))), u), this.index = this.settings.startAt;
        }
        return o(n, [{
            key: "mount",
            value: function value() {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                return this._e.emit("mount.before"), c(t) ? this._c = function (t, n, i) {
                    var o = {};
                    for (var r in n) {
                        l(n[r]) ? o[r] = n[r](t, o, i) : e("Extension must be a function");
                    }for (var s in o) {
                        l(o[s].mount) && o[s].mount();
                    }return o;
                }(this, t, this._e) : e("You need to provide a object on `mount()`"), this._e.emit("mount.after"), this;
            }
        }, {
            key: "update",
            value: function value() {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                return this.settings = r({}, this.settings, t), t.hasOwnProperty("startAt") && (this.index = t.startAt), this._e.emit("update"), this;
            }
        }, {
            key: "go",
            value: function value(t) {
                return this._c.Run.make(t), this;
            }
        }, {
            key: "move",
            value: function value(t) {
                return this._c.Transition.disable(), this._c.Move.make(t), this;
            }
        }, {
            key: "destroy",
            value: function value() {
                return this._e.emit("destroy"), this;
            }
        }, {
            key: "play",
            value: function value() {
                var t = arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
                return t && (this.settings.autoplay = t), this._e.emit("play"), this;
            }
        }, {
            key: "pause",
            value: function value() {
                return this._e.emit("pause"), this;
            }
        }, {
            key: "disable",
            value: function value() {
                return this.disabled = !0, this;
            }
        }, {
            key: "enable",
            value: function value() {
                return this.disabled = !1, this;
            }
        }, {
            key: "on",
            value: function value(t, e) {
                return this._e.on(t, e), this;
            }
        }, {
            key: "isType",
            value: function value(t) {
                return this.settings.type === t;
            }
        }, {
            key: "settings",
            get: function get() {
                return this._o;
            },
            set: function set(t) {
                c(t) ? this._o = t : e("Options must be an `object` instance.");
            }
        }, {
            key: "index",
            get: function get() {
                return this._i;
            },
            set: function set(t) {
                this._i = u(t);
            }
        }, {
            key: "type",
            get: function get() {
                return this.settings.type;
            }
        }, {
            key: "disabled",
            get: function get() {
                return this._d;
            },
            set: function set(t) {
                this._d = !!t;
            }
        }]), n;
    }();

    function m() {
        return new Date().getTime();
    }

    function g(t, e, n) {
        var i = void 0,
            o = void 0,
            r = void 0,
            s = void 0,
            u = 0;
        n || (n = {});
        var a = function a() {
            u = !1 === n.leading ? 0 : m(), i = null, s = t.apply(o, r), i || (o = r = null);
        },
            c = function c() {
            var c = m();
            u || !1 !== n.leading || (u = c);
            var l = e - (c - u);
            return o = this, r = arguments, l <= 0 || l > e ? (i && (clearTimeout(i), i = null), u = c, s = t.apply(o, r), i || (o = r = null)) : i || !1 === n.trailing || (i = setTimeout(a, l)), s;
        };
        return c.cancel = function () {
            clearTimeout(i), u = 0, i = o = r = null;
        }, c;
    }
    var y = {
        ltr: ["marginLeft", "marginRight"],
        rtl: ["marginRight", "marginLeft"]
    };

    function b(t) {
        for (var e = t.parentNode.firstChild, n = []; e; e = e.nextSibling) {
            1 === e.nodeType && e !== t && n.push(e);
        }return n;
    }

    function w(t) {
        return !!(t && t instanceof window.HTMLElement);
    }
    var _ = '[data-glide-el="track"]',
        k = function () {
        function t() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            i(this, t), this.listeners = e;
        }
        return o(t, [{
            key: "on",
            value: function value(t, e, n) {
                a(t) && (t = [t]);
                for (var i = 0; i < t.length; i++) {
                    this.listeners[t[i]] = n, e.addEventListener(t[i], this.listeners[t[i]], !1);
                }
            }
        }, {
            key: "off",
            value: function value(t, e) {
                a(t) && (t = [t]);
                for (var n = 0; n < t.length; n++) {
                    e.removeEventListener(t[n], this.listeners[t[n]], !1);
                }
            }
        }, {
            key: "destroy",
            value: function value() {
                delete this.listeners;
            }
        }]), t;
    }(),
        S = ["ltr", "rtl"],
        H = {
        ">": "<",
        "<": ">",
        "=": "="
    },
        T = [function (t, e) {
        return {
            modify: function modify(n) {
                return n + e.Gaps.value * t.index;
            }
        };
    }, function (t, e) {
        return {
            modify: function modify(t) {
                return t + e.Clones.grow / 2;
            }
        };
    }, function (t, e) {
        return {
            modify: function modify(n) {
                if (t.settings.focusAt >= 0) {
                    var i = e.Peek.value;
                    return c(i) ? n - i.before : n - i;
                }
                return n;
            }
        };
    }, function (t, e) {
        return {
            modify: function modify(n) {
                var i = e.Gaps.value,
                    o = e.Sizes.width,
                    r = t.settings.focusAt,
                    s = e.Sizes.slideWidth;
                return "center" === r ? n - (o / 2 - s / 2) : n - s * r - i * r;
            }
        };
    }, function (t, e) {
        return {
            modify: function modify(t) {
                return e.Direction.is("rtl") ? -t : t;
            }
        };
    }],
        x = ["touchstart", "mousedown"],
        O = ["touchmove", "mousemove"],
        A = ["touchend", "touchcancel", "mouseup", "mouseleave"],
        M = ["mousedown", "mousemove", "mouseup", "mouseleave"];

    function C(t) {
        return c(t) ? (n = t, Object.keys(n).sort().reduce(function (t, e) {
            return t[e] = n[e], t[e], t;
        }, {})) : (e("Breakpoints option must be an object"), {});
        var n;
    }
    var z = {
        Html: function Html(t, n) {
            var i = {
                mount: function mount() {
                    this.root = t.selector, this.track = this.root.querySelector(_), this.slides = Array.from(this.wrapper.children).filter(function (e) {
                        return !e.classList.contains(t.settings.classes.cloneSlide);
                    });
                }
            };
            return h(i, "root", {
                get: function get() {
                    return i._r;
                },
                set: function set(t) {
                    a(t) && (t = document.querySelector(t)), w(t) ? i._r = t : e("Root element must be a existing Html node");
                }
            }), h(i, "track", {
                get: function get() {
                    return i._t;
                },
                set: function set(t) {
                    w(t) ? i._t = t : e("Could not find track element. Please use " + _ + " attribute.");
                }
            }), h(i, "wrapper", {
                get: function get() {
                    return i.track.children[0];
                }
            }), i;
        },
        Translate: function Translate(t, e, n) {
            var i = {
                set: function set(n) {
                    var i,
                        o,
                        r = (i = t, o = e, {
                        mutate: function mutate(t) {
                            for (var e = 0; e < T.length; e++) {
                                t = T[e](i, o).modify(t);
                            }return t;
                        }
                    }).mutate(n);
                    e.Html.wrapper.style.transform = "translate3d(" + -1 * r + "px, 0px, 0px)";
                },
                remove: function remove() {
                    e.Html.wrapper.style.transform = "";
                }
            };
            return n.on("move", function (o) {
                var r = e.Gaps.value,
                    s = e.Sizes.length,
                    u = e.Sizes.slideWidth;
                return t.isType("carousel") && e.Run.isOffset("<") ? (e.Transition.after(function () {
                    n.emit("translate.jump"), i.set(u * (s - 1));
                }), i.set(-u - r * s)) : t.isType("carousel") && e.Run.isOffset(">") ? (e.Transition.after(function () {
                    n.emit("translate.jump"), i.set(0);
                }), i.set(u * s + r * s)) : i.set(o.movement);
            }), n.on("destroy", function () {
                i.remove();
            }), i;
        },
        Transition: function Transition(t, e, n) {
            var i = !1,
                o = {
                compose: function compose(e) {
                    var n = t.settings;
                    return i ? e + " 0ms " + n.animationTimingFunc : e + " " + this.duration + "ms " + n.animationTimingFunc;
                },
                set: function set() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "transform";
                    e.Html.wrapper.style.transition = this.compose(t);
                },
                remove: function remove() {
                    e.Html.wrapper.style.transition = "";
                },
                after: function after(t) {
                    setTimeout(function () {
                        t();
                    }, this.duration);
                },
                enable: function enable() {
                    i = !1, this.set();
                },
                disable: function disable() {
                    i = !0, this.set();
                }
            };
            return h(o, "duration", {
                get: function get() {
                    var n = t.settings;
                    return t.isType("slider") && e.Run.offset ? n.rewindDuration : n.animationDuration;
                }
            }), n.on("move", function () {
                o.set();
            }), n.on(["build.before", "resize", "translate.jump"], function () {
                o.disable();
            }), n.on("run", function () {
                o.enable();
            }), n.on("destroy", function () {
                o.remove();
            }), o;
        },
        Direction: function Direction(t, n, i) {
            var o = {
                mount: function mount() {
                    this.value = t.settings.direction;
                },
                resolve: function resolve(t) {
                    var e = t.slice(0, 1);
                    return this.is("rtl") ? t.split(e).join(H[e]) : t;
                },
                is: function is(t) {
                    return this.value === t;
                },
                addClass: function addClass() {
                    n.Html.root.classList.add(t.settings.classes.direction[this.value]);
                },
                removeClass: function removeClass() {
                    n.Html.root.classList.remove(t.settings.classes.direction[this.value]);
                }
            };
            return h(o, "value", {
                get: function get() {
                    return o._v;
                },
                set: function set(t) {
                    S.includes(t) ? o._v = t : e("Direction value must be `ltr` or `rtl`");
                }
            }), i.on(["destroy", "update"], function () {
                o.removeClass();
            }), i.on("update", function () {
                o.mount();
            }), i.on(["build.before", "update"], function () {
                o.addClass();
            }), o;
        },
        Peek: function Peek(t, e, n) {
            var i = {
                mount: function mount() {
                    this.value = t.settings.peek;
                }
            };
            return h(i, "value", {
                get: function get() {
                    return i._v;
                },
                set: function set(t) {
                    c(t) ? (t.before = u(t.before), t.after = u(t.after)) : t = u(t), i._v = t;
                }
            }), h(i, "reductor", {
                get: function get() {
                    var e = i.value,
                        n = t.settings.perView;
                    return c(e) ? e.before / n + e.after / n : 2 * e / n;
                }
            }), n.on(["resize", "update"], function () {
                i.mount();
            }), i;
        },
        Sizes: function Sizes(t, e, n) {
            var i = {
                setupSlides: function setupSlides() {
                    for (var t = e.Html.slides, n = 0; n < t.length; n++) {
                        t[n].style.width = this.slideWidth + "px";
                    }
                },
                setupWrapper: function setupWrapper(t) {
                    e.Html.wrapper.style.width = this.wrapperSize + "px";
                },
                remove: function remove() {
                    for (var t = e.Html.slides, n = 0; n < t.length; n++) {
                        t[n].style.width = "";
                    }e.Html.wrapper.style.width = "";
                }
            };
            return h(i, "length", {
                get: function get() {
                    return e.Html.slides.length;
                }
            }), h(i, "width", {
                get: function get() {
                    return e.Html.root.offsetWidth;
                }
            }), h(i, "wrapperSize", {
                get: function get() {
                    return i.slideWidth * i.length + e.Gaps.grow + e.Clones.grow;
                }
            }), h(i, "slideWidth", {
                get: function get() {
                    return i.width / t.settings.perView - e.Peek.reductor - e.Gaps.reductor;
                }
            }), n.on(["build.before", "resize", "update"], function () {
                i.setupSlides(), i.setupWrapper();
            }), n.on("destroy", function () {
                i.remove();
            }), i;
        },
        Gaps: function Gaps(t, e, n) {
            var i = {
                mount: function mount() {
                    this.value = t.settings.gap;
                },
                apply: function apply(t) {
                    for (var n = 0, i = t.length; n < i; n++) {
                        var o = t[n].style,
                            r = e.Direction.value;
                        o[y[r][0]] = 0 !== n ? this.value / 2 + "px" : "", n !== t.length - 1 ? o[y[r][1]] = this.value / 2 + "px" : o[y[r][1]] = "";
                    }
                },
                remove: function remove(t) {
                    for (var e = 0, n = t.length; e < n; e++) {
                        var i = t[e].style;
                        i.marginLeft = "", i.marginRight = "";
                    }
                }
            };
            return h(i, "value", {
                get: function get() {
                    return i._v;
                },
                set: function set(t) {
                    i._v = u(t);
                }
            }), h(i, "grow", {
                get: function get() {
                    return i.value * (e.Sizes.length - 1);
                }
            }), h(i, "reductor", {
                get: function get() {
                    var e = t.settings.perView;
                    return i.value * (e - 1) / e;
                }
            }), n.on("update", function () {
                i.mount();
            }), n.on(["build.after", "update"], g(function () {
                i.apply(e.Html.wrapper.children);
            }, 30)), n.on("destroy", function () {
                i.remove(e.Html.wrapper.children);
            }), i;
        },
        Move: function Move(t, e, n) {
            var i = {
                mount: function mount() {
                    this._o = 0;
                },
                make: function make() {
                    var t = this,
                        i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0;
                    this.offset = i, n.emit("move", {
                        movement: this.value
                    }), e.Transition.after(function () {
                        n.emit("move.after", {
                            movement: t.value
                        });
                    });
                }
            };
            return h(i, "offset", {
                get: function get() {
                    return i._o;
                },
                set: function set(t) {
                    i._o = f(t) ? 0 : u(t);
                }
            }), h(i, "translate", {
                get: function get() {
                    return e.Sizes.slideWidth * t.index;
                }
            }), h(i, "value", {
                get: function get() {
                    var t = this.offset,
                        n = this.translate;
                    return e.Direction.is("rtl") ? n + t : n - t;
                }
            }), n.on(["build.before", "run"], function () {
                i.make();
            }), i;
        },
        Clones: function Clones(t, e, n) {
            var i = {
                mount: function mount() {
                    this.items = [], t.isType("carousel") && (this.pattern = this.map(), this.items = this.collect());
                },
                map: function map() {
                    for (var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [], i = t.settings.perView, o = e.Html.slides.length, r = 0; r < Math.max(1, Math.floor(i / o)); r++) {
                        for (var s = 0; s <= o - 1; s++) {
                            n.push("" + s);
                        }for (var u = o - 1; u >= 0; u--) {
                            n.unshift("-" + u);
                        }
                    }
                    return n;
                },
                collect: function collect() {
                    for (var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [], i = this.pattern, o = 0; o < i.length; o++) {
                        var r = e.Html.slides[Math.abs(i[o])].cloneNode(!0);
                        r.classList.add(t.settings.classes.cloneSlide), n.push(r);
                    }
                    return n;
                },
                append: function append() {
                    for (var t = this.items, n = this.pattern, i = 0; i < t.length; i++) {
                        var o = t[i];
                        o.style.width = e.Sizes.slideWidth + "px", "-" === n[i][0] ? e.Html.wrapper.insertBefore(o, e.Html.slides[0]) : e.Html.wrapper.appendChild(o);
                    }
                },
                remove: function remove() {
                    for (var t = this.items, e = 0; e < t.length; e++) {
                        t[e].remove();
                    }
                }
            };
            return h(i, "grow", {
                get: function get() {
                    return (e.Sizes.slideWidth + e.Gaps.value) * i.items.length;
                }
            }), n.on("update", function () {
                i.remove(), i.mount(), i.append();
            }), n.on("build.before", function () {
                t.isType("carousel") && i.append();
            }), n.on("destroy", function () {
                i.remove();
            }), i;
        },
        Resize: function Resize(t, e, n) {
            var i = new k(),
                o = {
                mount: function mount() {
                    this.bind();
                },
                bind: function bind() {
                    i.on("resize", window, g(function () {
                        n.emit("resize");
                    }, t.settings.throttle));
                },
                unbind: function unbind() {
                    i.off("resize", window);
                }
            };
            return n.on("destroy", function () {
                o.unbind(), i.destroy();
            }), o;
        },
        Build: function Build(t, e, n) {
            var i = {
                mount: function mount() {
                    n.emit("build.before"), this.typeClass(), this.activeClass(), n.emit("build.after");
                },
                typeClass: function typeClass() {
                    e.Html.root.classList.add(t.settings.classes[t.settings.type]);
                },
                activeClass: function activeClass() {
                    var n = t.settings.classes,
                        i = e.Html.slides[t.index];
                    i.classList.add(n.activeSlide), b(i).forEach(function (t) {
                        t.classList.remove(n.activeSlide);
                    });
                },
                removeClasses: function removeClasses() {
                    var n = t.settings.classes;
                    e.Html.root.classList.remove(n[t.settings.type]), e.Html.slides.forEach(function (t) {
                        t.classList.remove(n.activeSlide);
                    });
                }
            };
            return n.on(["destroy", "update"], function () {
                i.removeClasses();
            }), n.on(["resize", "update"], function () {
                i.mount();
            }), n.on("move.after", function () {
                i.activeClass();
            }), i;
        },
        Run: function Run(t, e, n) {
            var i = {
                mount: function mount() {
                    this._o = !1;
                },
                make: function make(i) {
                    var o = this;
                    t.disabled || (t.disable(), this.move = i, n.emit("run.before", this.move), this.calculate(), n.emit("run", this.move), e.Transition.after(function () {
                        (o.isOffset("<") || o.isOffset(">")) && (o._o = !1, n.emit("run.offset", o.move)), n.emit("run.after", o.move), t.enable();
                    }));
                },
                calculate: function calculate() {
                    var e = this.move,
                        i = this.length,
                        o = e.steps,
                        r = e.direction,
                        s = "number" == typeof u(o) && 0 !== u(o);
                    switch (r) {
                        case ">":
                            ">" === o ? t.index = i : this.isEnd() ? (this._o = !0, t.index = 0, n.emit("run.end", e)) : s ? t.index += Math.min(i - t.index, -u(o)) : t.index++;
                            break;
                        case "<":
                            "<" === o ? t.index = 0 : this.isStart() ? (this._o = !0, t.index = i, n.emit("run.start", e)) : s ? t.index -= Math.min(t.index, u(o)) : t.index--;
                            break;
                        case "=":
                            t.index = o;
                    }
                },
                isStart: function isStart() {
                    return 0 === t.index;
                },
                isEnd: function isEnd() {
                    return t.index === this.length;
                },
                isOffset: function isOffset(t) {
                    return this._o && this.move.direction === t;
                }
            };
            return h(i, "move", {
                get: function get() {
                    return this._m;
                },
                set: function set(t) {
                    this._m = {
                        direction: t.substr(0, 1),
                        steps: t.substr(1) ? t.substr(1) : 0
                    };
                }
            }), h(i, "length", {
                get: function get() {
                    return e.Html.slides.length - 1;
                }
            }), h(i, "offset", {
                get: function get() {
                    return this._o;
                }
            }), i;
        },
        Swipe: function Swipe(t, e, n) {
            var i = new k(),
                o = 0,
                r = 0,
                s = 0,
                a = !1,
                c = {
                mount: function mount() {
                    this.bindSwipeStart();
                },
                start: function start(e) {
                    if (!a && !t.disabled) {
                        this.disable();
                        var i = this.touches(e);
                        o = null, r = u(i.pageX), s = u(i.pageY), this.bindSwipeMove(), this.bindSwipeEnd(), n.emit("swipe.start");
                    }
                },
                move: function move(i) {
                    if (!t.disabled) {
                        var a = t.settings,
                            c = this.touches(i),
                            l = u(c.pageX) - r,
                            f = u(c.pageY) - s,
                            d = Math.abs(l << 2),
                            h = Math.abs(f << 2),
                            p = Math.sqrt(d + h),
                            v = Math.sqrt(h);
                        if (180 * (o = Math.asin(v / p)) / Math.PI < a.touchAngle && e.Move.make(l * parseFloat(a.touchRatio)), !(180 * o / Math.PI < a.touchAngle)) return !1;
                        i.stopPropagation(), i.preventDefault(), e.Html.root.classList.add(a.classes.dragging), n.emit("swipe.move");
                    }
                },
                end: function end(i) {
                    if (!t.disabled) {
                        var s = t.settings,
                            a = this.touches(i),
                            c = this.threshold(i),
                            l = a.pageX - r,
                            f = 180 * o / Math.PI,
                            d = Math.round(l / e.Sizes.slideWidth);
                        this.enable(), l > c && f < s.touchAngle ? (s.perTouch && (d = Math.min(d, u(s.perTouch))), e.Direction.is("rtl") && (d = -d), e.Run.make(e.Direction.resolve("<" + d))) : l < -c && f < s.touchAngle ? (s.perTouch && (d = Math.max(d, -u(s.perTouch))), e.Direction.is("rtl") && (d = -d), e.Run.make(e.Direction.resolve(">" + d))) : e.Move.make(), e.Html.root.classList.remove(s.classes.dragging), this.unbindSwipeMove(), this.unbindSwipeEnd(), n.emit("swipe.end");
                    }
                },
                bindSwipeStart: function bindSwipeStart() {
                    var n = t.settings;
                    n.swipeThreshold && i.on(x[0], e.Html.wrapper, this.start.bind(this)), n.dragThreshold && i.on(x[1], e.Html.wrapper, this.start.bind(this));
                },
                unbindSwipeStart: function unbindSwipeStart() {
                    i.off(x[0], e.Html.wrapper), i.off(x[1], e.Html.wrapper);
                },
                bindSwipeMove: function bindSwipeMove() {
                    i.on(O, e.Html.wrapper, g(this.move.bind(this), t.settings.throttle));
                },
                unbindSwipeMove: function unbindSwipeMove() {
                    i.off(O, e.Html.wrapper);
                },
                bindSwipeEnd: function bindSwipeEnd() {
                    i.on(A, e.Html.wrapper, this.end.bind(this));
                },
                unbindSwipeEnd: function unbindSwipeEnd() {
                    i.off(A, e.Html.wrapper);
                },
                touches: function touches(t) {
                    return M.includes(t.type) ? t : t.touches[0] || t.changedTouches[0];
                },
                threshold: function threshold(e) {
                    var n = t.settings;
                    return M.includes(e.type) ? n.dragThreshold : n.swipeThreshold;
                },
                enable: function enable() {
                    return a = !1, e.Transition.enable(), this;
                },
                disable: function disable() {
                    return a = !0, e.Transition.disable(), this;
                }
            };
            return n.on("build.after", function () {
                e.Html.root.classList.add(t.settings.classes.swipeable);
            }), n.on("destroy", function () {
                c.unbindSwipeStart(), c.unbindSwipeMove(), c.unbindSwipeEnd(), i.destroy();
            }), c;
        },
        Images: function Images(t, e, n) {
            var i = new k(),
                o = {
                mount: function mount() {
                    this.bind();
                },
                bind: function bind() {
                    i.on("dragstart", e.Html.wrapper, this.dragstart);
                },
                unbind: function unbind() {
                    i.off("dragstart", e.Html.wrapper);
                },
                dragstart: function dragstart(t) {
                    t.preventDefault();
                }
            };
            return n.on("destroy", function () {
                o.unbind(), i.destroy();
            }), o;
        },
        Anchors: function Anchors(t, e, n) {
            var i = new k(),
                o = !1,
                r = !1,
                s = {
                mount: function mount() {
                    this._a = e.Html.wrapper.querySelectorAll("a"), this.bind();
                },
                bind: function bind() {
                    i.on("click", e.Html.wrapper, this.click);
                },
                unbind: function unbind() {
                    i.off("click", e.Html.wrapper);
                },
                click: function click(t) {
                    t.stopPropagation(), r && t.preventDefault();
                },
                detach: function detach() {
                    if (r = !0, !o) {
                        for (var t = 0; t < this.items.length; t++) {
                            this.items[t].draggable = !1, this.items[t].dataset.href = this.items[t].getAttribute("href"), this.items[t].removeAttribute("href");
                        }o = !0;
                    }
                    return this;
                },
                attach: function attach() {
                    if (r = !1, o) {
                        for (var t = 0; t < this.items.length; t++) {
                            this.items[t].draggable = !0, this.items[t].setAttribute("href", this.items[t].dataset.href), delete this.items[t].dataset.href;
                        }o = !1;
                    }
                    return this;
                }
            };
            return h(s, "items", {
                get: function get() {
                    return s._a;
                }
            }), n.on("swipe.move", function () {
                s.detach();
            }), n.on("swipe.end", function () {
                e.Transition.after(function () {
                    s.attach();
                });
            }), n.on("destroy", function () {
                s.attach(), s.unbind(), i.destroy();
            }), s;
        },
        Controls: function Controls(t, e, n) {
            var i = new k(),
                o = {
                mount: function mount() {
                    this._n = e.Html.root.querySelectorAll('[data-glide-el="controls[nav]"]'), this._i = e.Html.root.querySelectorAll('[data-glide-el^="controls"]'), this.addBindings();
                },
                setActive: function setActive() {
                    for (var t = 0; t < this._n.length; t++) {
                        this.addClass(this._n[t].children);
                    }
                },
                removeActive: function removeActive() {
                    for (var t = 0; t < this._n.length; t++) {
                        this.removeClass(this._n[t].children);
                    }
                },
                addClass: function addClass(e) {
                    var n = t.settings,
                        i = e[t.index];
                    i.classList.add(n.classes.activeNav), b(i).forEach(function (t) {
                        t.classList.remove(n.classes.activeNav);
                    });
                },
                removeClass: function removeClass(e) {
                    e[t.index].classList.remove(t.settings.classes.activeNav);
                },
                addBindings: function addBindings() {
                    for (var t = 0; t < this._i.length; t++) {
                        this.bind(this._i[t].children);
                    }
                },
                removeBindings: function removeBindings() {
                    for (var t = 0; t < this._i.length; t++) {
                        this.unbind(this._i[t].children);
                    }
                },
                bind: function bind(t) {
                    for (var e = 0; e < t.length; e++) {
                        i.on(["click", "touchstart"], t[e], this.click);
                    }
                },
                unbind: function unbind(t) {
                    for (var e = 0; e < t.length; e++) {
                        i.off(["click", "touchstart"], t[e]);
                    }
                },
                click: function click(t) {
                    t.preventDefault(), e.Run.make(e.Direction.resolve(t.currentTarget.dataset.glideDir));
                }
            };
            return h(o, "items", {
                get: function get() {
                    return o._i;
                }
            }), n.on(["mount.after", "move.after"], function () {
                o.setActive();
            }), n.on("destroy", function () {
                o.removeBindings(), o.removeActive(), i.destroy();
            }), o;
        },
        Keyboard: function Keyboard(t, e, n) {
            var i = new k(),
                o = {
                mount: function mount() {
                    t.settings.keyboard && this.bind();
                },
                bind: function bind() {
                    i.on("keyup", document, this.press);
                },
                unbind: function unbind() {
                    i.off("keyup", document);
                },
                press: function press(t) {
                    39 === t.keyCode && e.Run.make(e.Direction.resolve(">")), 37 === t.keyCode && e.Run.make(e.Direction.resolve("<"));
                }
            };
            return n.on(["destroy", "update"], function () {
                o.unbind();
            }), n.on("update", function () {
                o.mount();
            }), n.on("destroy", function () {
                i.destroy();
            }), o;
        },
        Autoplay: function Autoplay(t, e, n) {
            var i = new k(),
                o = {
                mount: function mount() {
                    this.start(), t.settings.hoverpause && this.bind();
                },
                start: function start() {
                    var n = this;
                    t.settings.autoplay && f(this._i) && (this._i = setInterval(function () {
                        n.stop(), e.Run.make(">"), n.start();
                    }, this.time));
                },
                stop: function stop() {
                    this._i = clearInterval(this._i);
                },
                bind: function bind() {
                    var t = this;
                    i.on("mouseover", e.Html.root, function () {
                        t.stop();
                    }), i.on("mouseout", e.Html.root, function () {
                        t.start();
                    });
                },
                unbind: function unbind() {
                    i.off(["mouseover", "mouseout"], e.Html.root);
                }
            };
            return h(o, "time", {
                get: function get() {
                    var n = e.Html.slides[t.index].getAttribute("data-glide-autoplay");
                    return u(n || t.settings.autoplay);
                }
            }), n.on(["destroy", "update"], function () {
                o.unbind();
            }), n.on(["run.before", "pause", "destroy", "swipe.start", "update"], function () {
                o.stop();
            }), n.on(["run.after", "play", "swipe.end"], function () {
                o.start();
            }), n.on("update", function () {
                o.mount();
            }), n.on("destroy", function () {
                i.destroy();
            }), o;
        },
        Breakpoints: function Breakpoints(t, e, n) {
            var i = new k(),
                o = t.settings,
                s = o.breakpoints;
            s = C(s);
            var u = r({}, o),
                a = {
                match: function match(t) {
                    if (void 0 !== window.matchMedia) for (var e in t) {
                        if (t.hasOwnProperty(e) && window.matchMedia("(max-width: " + e + "px)").matches) return t[e];
                    }return u;
                }
            };
            return r(o, a.match(s)), i.on("resize", window, g(function () {
                r(o, a.match(s));
            }, t.settings.throttle)), n.on("update", function () {
                s = C(s), u = r({}, o);
            }), n.on("destroy", function () {
                i.off("resize", window);
            }), a;
        }
    };
    return function (t) {
        function e() {
            return i(this, e), s(this, (e.__proto__ || Object.getPrototypeOf(e)).apply(this, arguments));
        }
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + (typeof e === "undefined" ? "undefined" : _typeof(e)));
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e);
        }(e, v), o(e, [{
            key: "mount",
            value: function value() {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                return function t(e, n, i) {
                    null === e && (e = Function.prototype);
                    var o = Object.getOwnPropertyDescriptor(e, n);
                    if (void 0 === o) {
                        var r = Object.getPrototypeOf(e);
                        return null === r ? void 0 : t(r, n, i);
                    }
                    if ("value" in o) return o.value;
                    var s = o.get;
                    return void 0 !== s ? s.call(i) : void 0;
                }(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "mount", this).call(this, r({}, z, t));
            }
        }]), e;
    }();
});

/*===================================================================
---------------------------------modal and slider---------------------
====================================================================*/
var wcqcModalToggle = document.getElementsByClassName("wcqv_modal_toggle"); //delete/x icons in tags by class
var modal = document.getElementsByClassName('wcqv_modal');
var closeModal = document.getElementsByClassName("wcqvCloseModal");

var wcqv_toggle_modal = function wcqv_toggle_modal() {
    var attribute = this.getAttribute("data-product_id");
    var getModal = document.getElementById('wcqv-modal-' + attribute + '');
    var getModalID = getModal.getAttribute('id');
    getModal.style.display = "block";

    // new Glide('.glide').mount()
    var getGlide = document.getElementById('glide-' + attribute + '');
    var glide = new Glide(getGlide);
    glide.mount();
};

Array.from(wcqcModalToggle).forEach(function (element) {
    element.addEventListener('click', wcqv_toggle_modal);
});

var wcqv_close_modal = function wcqv_close_modal() {

    var attributeT = this.getAttribute("modal_target");
    var targetModal = document.getElementById('wcqv-modal-' + attributeT + '');

    targetModal.style.display = "none";
};

Array.from(closeModal).forEach(function (element) {
    element.addEventListener('click', wcqv_close_modal);
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {

    Array.from(modal).forEach(function (element) {

        if (event.target == element) {
            element.style.display = "none";
        }
    });
};