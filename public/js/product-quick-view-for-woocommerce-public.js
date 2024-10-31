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
! function(t, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.Glide = e()
}(this, function() {
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
        console.error("[Glide warn]: " + t)
    }
    var n = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
            return typeof t
        } : function(t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        },
        i = function(t, e) {
            if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
        },
        o = function() {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var i = e[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                }
            }
            return function(e, n, i) {
                return n && t(e.prototype, n), i && t(e, i), e
            }
        }(),
        r = Object.assign || function(t) {
            for (var e = 1; e < arguments.length; e++) {
                var n = arguments[e];
                for (var i in n) Object.prototype.hasOwnProperty.call(n, i) && (t[i] = n[i])
            }
            return t
        },
        s = function(t, e) {
            if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return !e || "object" != typeof e && "function" != typeof e ? t : e
        };

    function u(t) {
        return parseInt(t)
    }

    function a(t) {
        return "string" == typeof t
    }

    function c(t) {
        var e = void 0 === t ? "undefined" : n(t);
        return "function" === e || "object" === e && !!t
    }

    function l(t) {
        return "function" == typeof t
    }

    function f(t) {
        return void 0 === t
    }

    function d(t) {
        return t.constructor === Array
    }

    function h(t, e, n) {
        Object.defineProperty(t, e, n)
    }
    var p = function() {
            function t() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                i(this, t), this.events = e, this.hop = e.hasOwnProperty
            }
            return o(t, [{
                key: "on",
                value: function(t, e) {
                    if (d(t))
                        for (var n = 0; n < t.length; n++) this.on(t[n], e);
                    this.hop.call(this.events, t) || (this.events[t] = []);
                    var i = this.events[t].push(e) - 1;
                    return {
                        remove: function() {
                            delete this.events[t][i]
                        }
                    }
                }
            }, {
                key: "emit",
                value: function(t, e) {
                    if (d(t))
                        for (var n = 0; n < t.length; n++) this.emit(t[n], e);
                    this.hop.call(this.events, t) && this.events[t].forEach(function(t) {
                        t(e || {})
                    })
                }
            }]), t
        }(),
        v = function() {
            function n(e) {
                var o, s, u, a = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                i(this, n), this._c = {}, this._e = new p, this.disabled = !1, this.selector = e, this.settings = (u = r({}, o = t, s = a), s.hasOwnProperty("classes") && (u.classes = r({}, o.classes, s.classes), s.classes.hasOwnProperty("direction") && (u.classes.direction = r({}, o.classes.direction, s.classes.direction))), u), this.index = this.settings.startAt
            }
            return o(n, [{
                key: "mount",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    return this._e.emit("mount.before"), c(t) ? this._c = function(t, n, i) {
                        var o = {};
                        for (var r in n) l(n[r]) ? o[r] = n[r](t, o, i) : e("Extension must be a function");
                        for (var s in o) l(o[s].mount) && o[s].mount();
                        return o
                    }(this, t, this._e) : e("You need to provide a object on `mount()`"), this._e.emit("mount.after"), this
                }
            }, {
                key: "update",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    return this.settings = r({}, this.settings, t), t.hasOwnProperty("startAt") && (this.index = t.startAt), this._e.emit("update"), this
                }
            }, {
                key: "go",
                value: function(t) {
                    return this._c.Run.make(t), this
                }
            }, {
                key: "move",
                value: function(t) {
                    return this._c.Transition.disable(), this._c.Move.make(t), this
                }
            }, {
                key: "destroy",
                value: function() {
                    return this._e.emit("destroy"), this
                }
            }, {
                key: "play",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
                    return t && (this.settings.autoplay = t), this._e.emit("play"), this
                }
            }, {
                key: "pause",
                value: function() {
                    return this._e.emit("pause"), this
                }
            }, {
                key: "disable",
                value: function() {
                    return this.disabled = !0, this
                }
            }, {
                key: "enable",
                value: function() {
                    return this.disabled = !1, this
                }
            }, {
                key: "on",
                value: function(t, e) {
                    return this._e.on(t, e), this
                }
            }, {
                key: "isType",
                value: function(t) {
                    return this.settings.type === t
                }
            }, {
                key: "settings",
                get: function() {
                    return this._o
                },
                set: function(t) {
                    c(t) ? this._o = t : e("Options must be an `object` instance.")
                }
            }, {
                key: "index",
                get: function() {
                    return this._i
                },
                set: function(t) {
                    this._i = u(t)
                }
            }, {
                key: "type",
                get: function() {
                    return this.settings.type
                }
            }, {
                key: "disabled",
                get: function() {
                    return this._d
                },
                set: function(t) {
                    this._d = !!t
                }
            }]), n
        }();

    function m() {
        return (new Date).getTime()
    }

    function g(t, e, n) {
        var i = void 0,
            o = void 0,
            r = void 0,
            s = void 0,
            u = 0;
        n || (n = {});
        var a = function() {
                u = !1 === n.leading ? 0 : m(), i = null, s = t.apply(o, r), i || (o = r = null)
            },
            c = function() {
                var c = m();
                u || !1 !== n.leading || (u = c);
                var l = e - (c - u);
                return o = this, r = arguments, l <= 0 || l > e ? (i && (clearTimeout(i), i = null), u = c, s = t.apply(o, r), i || (o = r = null)) : i || !1 === n.trailing || (i = setTimeout(a, l)), s
            };
        return c.cancel = function() {
            clearTimeout(i), u = 0, i = o = r = null
        }, c
    }
    var y = {
        ltr: ["marginLeft", "marginRight"],
        rtl: ["marginRight", "marginLeft"]
    };

    function b(t) {
        for (var e = t.parentNode.firstChild, n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
        return n
    }

    function w(t) {
        return !!(t && t instanceof window.HTMLElement)
    }
    var _ = '[data-glide-el="track"]',
        k = function() {
            function t() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                i(this, t), this.listeners = e
            }
            return o(t, [{
                key: "on",
                value: function(t, e, n) {
                    a(t) && (t = [t]);
                    for (var i = 0; i < t.length; i++) this.listeners[t[i]] = n, e.addEventListener(t[i], this.listeners[t[i]], !1)
                }
            }, {
                key: "off",
                value: function(t, e) {
                    a(t) && (t = [t]);
                    for (var n = 0; n < t.length; n++) e.removeEventListener(t[n], this.listeners[t[n]], !1)
                }
            }, {
                key: "destroy",
                value: function() {
                    delete this.listeners
                }
            }]), t
        }(),
        S = ["ltr", "rtl"],
        H = {
            ">": "<",
            "<": ">",
            "=": "="
        },
        T = [function(t, e) {
            return {
                modify: function(n) {
                    return n + e.Gaps.value * t.index
                }
            }
        }, function(t, e) {
            return {
                modify: function(t) {
                    return t + e.Clones.grow / 2
                }
            }
        }, function(t, e) {
            return {
                modify: function(n) {
                    if (t.settings.focusAt >= 0) {
                        var i = e.Peek.value;
                        return c(i) ? n - i.before : n - i
                    }
                    return n
                }
            }
        }, function(t, e) {
            return {
                modify: function(n) {
                    var i = e.Gaps.value,
                        o = e.Sizes.width,
                        r = t.settings.focusAt,
                        s = e.Sizes.slideWidth;
                    return "center" === r ? n - (o / 2 - s / 2) : n - s * r - i * r
                }
            }
        }, function(t, e) {
            return {
                modify: function(t) {
                    return e.Direction.is("rtl") ? -t : t
                }
            }
        }],
        x = ["touchstart", "mousedown"],
        O = ["touchmove", "mousemove"],
        A = ["touchend", "touchcancel", "mouseup", "mouseleave"],
        M = ["mousedown", "mousemove", "mouseup", "mouseleave"];

    function C(t) {
        return c(t) ? (n = t, Object.keys(n).sort().reduce(function(t, e) {
            return t[e] = n[e], t[e], t
        }, {})) : (e("Breakpoints option must be an object"), {});
        var n
    }
    var z = {
        Html: function(t, n) {
            var i = {
                mount: function() {
                    this.root = t.selector, this.track = this.root.querySelector(_), this.slides = Array.from(this.wrapper.children).filter(function(e) {
                        return !e.classList.contains(t.settings.classes.cloneSlide)
                    })
                }
            };
            return h(i, "root", {
                get: function() {
                    return i._r
                },
                set: function(t) {
                    a(t) && (t = document.querySelector(t)), w(t) ? i._r = t : e("Root element must be a existing Html node")
                }
            }), h(i, "track", {
                get: function() {
                    return i._t
                },
                set: function(t) {
                    w(t) ? i._t = t : e("Could not find track element. Please use " + _ + " attribute.")
                }
            }), h(i, "wrapper", {
                get: function() {
                    return i.track.children[0]
                }
            }), i
        },
        Translate: function(t, e, n) {
            var i = {
                set: function(n) {
                    var i, o, r = (i = t, o = e, {
                        mutate: function(t) {
                            for (var e = 0; e < T.length; e++) t = T[e](i, o).modify(t);
                            return t
                        }
                    }).mutate(n);
                    e.Html.wrapper.style.transform = "translate3d(" + -1 * r + "px, 0px, 0px)"
                },
                remove: function() {
                    e.Html.wrapper.style.transform = ""
                }
            };
            return n.on("move", function(o) {
                var r = e.Gaps.value,
                    s = e.Sizes.length,
                    u = e.Sizes.slideWidth;
                return t.isType("carousel") && e.Run.isOffset("<") ? (e.Transition.after(function() {
                    n.emit("translate.jump"), i.set(u * (s - 1))
                }), i.set(-u - r * s)) : t.isType("carousel") && e.Run.isOffset(">") ? (e.Transition.after(function() {
                    n.emit("translate.jump"), i.set(0)
                }), i.set(u * s + r * s)) : i.set(o.movement)
            }), n.on("destroy", function() {
                i.remove()
            }), i
        },
        Transition: function(t, e, n) {
            var i = !1,
                o = {
                    compose: function(e) {
                        var n = t.settings;
                        return i ? e + " 0ms " + n.animationTimingFunc : e + " " + this.duration + "ms " + n.animationTimingFunc
                    },
                    set: function() {
                        var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "transform";
                        e.Html.wrapper.style.transition = this.compose(t)
                    },
                    remove: function() {
                        e.Html.wrapper.style.transition = ""
                    },
                    after: function(t) {
                        setTimeout(function() {
                            t()
                        }, this.duration)
                    },
                    enable: function() {
                        i = !1, this.set()
                    },
                    disable: function() {
                        i = !0, this.set()
                    }
                };
            return h(o, "duration", {
                get: function() {
                    var n = t.settings;
                    return t.isType("slider") && e.Run.offset ? n.rewindDuration : n.animationDuration
                }
            }), n.on("move", function() {
                o.set()
            }), n.on(["build.before", "resize", "translate.jump"], function() {
                o.disable()
            }), n.on("run", function() {
                o.enable()
            }), n.on("destroy", function() {
                o.remove()
            }), o
        },
        Direction: function(t, n, i) {
            var o = {
                mount: function() {
                    this.value = t.settings.direction
                },
                resolve: function(t) {
                    var e = t.slice(0, 1);
                    return this.is("rtl") ? t.split(e).join(H[e]) : t
                },
                is: function(t) {
                    return this.value === t
                },
                addClass: function() {
                    n.Html.root.classList.add(t.settings.classes.direction[this.value])
                },
                removeClass: function() {
                    n.Html.root.classList.remove(t.settings.classes.direction[this.value])
                }
            };
            return h(o, "value", {
                get: function() {
                    return o._v
                },
                set: function(t) {
                    S.includes(t) ? o._v = t : e("Direction value must be `ltr` or `rtl`")
                }
            }), i.on(["destroy", "update"], function() {
                o.removeClass()
            }), i.on("update", function() {
                o.mount()
            }), i.on(["build.before", "update"], function() {
                o.addClass()
            }), o
        },
        Peek: function(t, e, n) {
            var i = {
                mount: function() {
                    this.value = t.settings.peek
                }
            };
            return h(i, "value", {
                get: function() {
                    return i._v
                },
                set: function(t) {
                    c(t) ? (t.before = u(t.before), t.after = u(t.after)) : t = u(t), i._v = t
                }
            }), h(i, "reductor", {
                get: function() {
                    var e = i.value,
                        n = t.settings.perView;
                    return c(e) ? e.before / n + e.after / n : 2 * e / n
                }
            }), n.on(["resize", "update"], function() {
                i.mount()
            }), i
        },
        Sizes: function(t, e, n) {
            var i = {
                setupSlides: function() {
                    for (var t = e.Html.slides, n = 0; n < t.length; n++) t[n].style.width = this.slideWidth + "px"
                },
                setupWrapper: function(t) {
                    e.Html.wrapper.style.width = this.wrapperSize + "px"
                },
                remove: function() {
                    for (var t = e.Html.slides, n = 0; n < t.length; n++) t[n].style.width = "";
                    e.Html.wrapper.style.width = ""
                }
            };
            return h(i, "length", {
                get: function() {
                    return e.Html.slides.length
                }
            }), h(i, "width", {
                get: function() {
                    return e.Html.root.offsetWidth
                }
            }), h(i, "wrapperSize", {
                get: function() {
                    return i.slideWidth * i.length + e.Gaps.grow + e.Clones.grow
                }
            }), h(i, "slideWidth", {
                get: function() {
                    return i.width / t.settings.perView - e.Peek.reductor - e.Gaps.reductor
                }
            }), n.on(["build.before", "resize", "update"], function() {
                i.setupSlides(), i.setupWrapper()
            }), n.on("destroy", function() {
                i.remove()
            }), i
        },
        Gaps: function(t, e, n) {
            var i = {
                mount: function() {
                    this.value = t.settings.gap
                },
                apply: function(t) {
                    for (var n = 0, i = t.length; n < i; n++) {
                        var o = t[n].style,
                            r = e.Direction.value;
                        o[y[r][0]] = 0 !== n ? this.value / 2 + "px" : "", n !== t.length - 1 ? o[y[r][1]] = this.value / 2 + "px" : o[y[r][1]] = ""
                    }
                },
                remove: function(t) {
                    for (var e = 0, n = t.length; e < n; e++) {
                        var i = t[e].style;
                        i.marginLeft = "", i.marginRight = ""
                    }
                }
            };
            return h(i, "value", {
                get: function() {
                    return i._v
                },
                set: function(t) {
                    i._v = u(t)
                }
            }), h(i, "grow", {
                get: function() {
                    return i.value * (e.Sizes.length - 1)
                }
            }), h(i, "reductor", {
                get: function() {
                    var e = t.settings.perView;
                    return i.value * (e - 1) / e
                }
            }), n.on("update", function() {
                i.mount()
            }), n.on(["build.after", "update"], g(function() {
                i.apply(e.Html.wrapper.children)
            }, 30)), n.on("destroy", function() {
                i.remove(e.Html.wrapper.children)
            }), i
        },
        Move: function(t, e, n) {
            var i = {
                mount: function() {
                    this._o = 0
                },
                make: function() {
                    var t = this,
                        i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0;
                    this.offset = i, n.emit("move", {
                        movement: this.value
                    }), e.Transition.after(function() {
                        n.emit("move.after", {
                            movement: t.value
                        })
                    })
                }
            };
            return h(i, "offset", {
                get: function() {
                    return i._o
                },
                set: function(t) {
                    i._o = f(t) ? 0 : u(t)
                }
            }), h(i, "translate", {
                get: function() {
                    return e.Sizes.slideWidth * t.index
                }
            }), h(i, "value", {
                get: function() {
                    var t = this.offset,
                        n = this.translate;
                    return e.Direction.is("rtl") ? n + t : n - t
                }
            }), n.on(["build.before", "run"], function() {
                i.make()
            }), i
        },
        Clones: function(t, e, n) {
            var i = {
                mount: function() {
                    this.items = [], t.isType("carousel") && (this.pattern = this.map(), this.items = this.collect())
                },
                map: function() {
                    for (var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [], i = t.settings.perView, o = e.Html.slides.length, r = 0; r < Math.max(1, Math.floor(i / o)); r++) {
                        for (var s = 0; s <= o - 1; s++) n.push("" + s);
                        for (var u = o - 1; u >= 0; u--) n.unshift("-" + u)
                    }
                    return n
                },
                collect: function() {
                    for (var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [], i = this.pattern, o = 0; o < i.length; o++) {
                        var r = e.Html.slides[Math.abs(i[o])].cloneNode(!0);
                        r.classList.add(t.settings.classes.cloneSlide), n.push(r)
                    }
                    return n
                },
                append: function() {
                    for (var t = this.items, n = this.pattern, i = 0; i < t.length; i++) {
                        var o = t[i];
                        o.style.width = e.Sizes.slideWidth + "px", "-" === n[i][0] ? e.Html.wrapper.insertBefore(o, e.Html.slides[0]) : e.Html.wrapper.appendChild(o)
                    }
                },
                remove: function() {
                    for (var t = this.items, e = 0; e < t.length; e++) t[e].remove()
                }
            };
            return h(i, "grow", {
                get: function() {
                    return (e.Sizes.slideWidth + e.Gaps.value) * i.items.length
                }
            }), n.on("update", function() {
                i.remove(), i.mount(), i.append()
            }), n.on("build.before", function() {
                t.isType("carousel") && i.append()
            }), n.on("destroy", function() {
                i.remove()
            }), i
        },
        Resize: function(t, e, n) {
            var i = new k,
                o = {
                    mount: function() {
                        this.bind()
                    },
                    bind: function() {
                        i.on("resize", window, g(function() {
                            n.emit("resize")
                        }, t.settings.throttle))
                    },
                    unbind: function() {
                        i.off("resize", window)
                    }
                };
            return n.on("destroy", function() {
                o.unbind(), i.destroy()
            }), o
        },
        Build: function(t, e, n) {
            var i = {
                mount: function() {
                    n.emit("build.before"), this.typeClass(), this.activeClass(), n.emit("build.after")
                },
                typeClass: function() {
                    e.Html.root.classList.add(t.settings.classes[t.settings.type])
                },
                activeClass: function() {
                    var n = t.settings.classes,
                        i = e.Html.slides[t.index];
                    i.classList.add(n.activeSlide), b(i).forEach(function(t) {
                        t.classList.remove(n.activeSlide)
                    })
                },
                removeClasses: function() {
                    var n = t.settings.classes;
                    e.Html.root.classList.remove(n[t.settings.type]), e.Html.slides.forEach(function(t) {
                        t.classList.remove(n.activeSlide)
                    })
                }
            };
            return n.on(["destroy", "update"], function() {
                i.removeClasses()
            }), n.on(["resize", "update"], function() {
                i.mount()
            }), n.on("move.after", function() {
                i.activeClass()
            }), i
        },
        Run: function(t, e, n) {
            var i = {
                mount: function() {
                    this._o = !1
                },
                make: function(i) {
                    var o = this;
                    t.disabled || (t.disable(), this.move = i, n.emit("run.before", this.move), this.calculate(), n.emit("run", this.move), e.Transition.after(function() {
                        (o.isOffset("<") || o.isOffset(">")) && (o._o = !1, n.emit("run.offset", o.move)), n.emit("run.after", o.move), t.enable()
                    }))
                },
                calculate: function() {
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
                            t.index = o
                    }
                },
                isStart: function() {
                    return 0 === t.index
                },
                isEnd: function() {
                    return t.index === this.length
                },
                isOffset: function(t) {
                    return this._o && this.move.direction === t
                }
            };
            return h(i, "move", {
                get: function() {
                    return this._m
                },
                set: function(t) {
                    this._m = {
                        direction: t.substr(0, 1),
                        steps: t.substr(1) ? t.substr(1) : 0
                    }
                }
            }), h(i, "length", {
                get: function() {
                    return e.Html.slides.length - 1
                }
            }), h(i, "offset", {
                get: function() {
                    return this._o
                }
            }), i
        },
        Swipe: function(t, e, n) {
            var i = new k,
                o = 0,
                r = 0,
                s = 0,
                a = !1,
                c = {
                    mount: function() {
                        this.bindSwipeStart()
                    },
                    start: function(e) {
                        if (!a && !t.disabled) {
                            this.disable();
                            var i = this.touches(e);
                            o = null, r = u(i.pageX), s = u(i.pageY), this.bindSwipeMove(), this.bindSwipeEnd(), n.emit("swipe.start")
                        }
                    },
                    move: function(i) {
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
                            i.stopPropagation(), i.preventDefault(), e.Html.root.classList.add(a.classes.dragging), n.emit("swipe.move")
                        }
                    },
                    end: function(i) {
                        if (!t.disabled) {
                            var s = t.settings,
                                a = this.touches(i),
                                c = this.threshold(i),
                                l = a.pageX - r,
                                f = 180 * o / Math.PI,
                                d = Math.round(l / e.Sizes.slideWidth);
                            this.enable(), l > c && f < s.touchAngle ? (s.perTouch && (d = Math.min(d, u(s.perTouch))), e.Direction.is("rtl") && (d = -d), e.Run.make(e.Direction.resolve("<" + d))) : l < -c && f < s.touchAngle ? (s.perTouch && (d = Math.max(d, -u(s.perTouch))), e.Direction.is("rtl") && (d = -d), e.Run.make(e.Direction.resolve(">" + d))) : e.Move.make(), e.Html.root.classList.remove(s.classes.dragging), this.unbindSwipeMove(), this.unbindSwipeEnd(), n.emit("swipe.end")
                        }
                    },
                    bindSwipeStart: function() {
                        var n = t.settings;
                        n.swipeThreshold && i.on(x[0], e.Html.wrapper, this.start.bind(this)), n.dragThreshold && i.on(x[1], e.Html.wrapper, this.start.bind(this))
                    },
                    unbindSwipeStart: function() {
                        i.off(x[0], e.Html.wrapper), i.off(x[1], e.Html.wrapper)
                    },
                    bindSwipeMove: function() {
                        i.on(O, e.Html.wrapper, g(this.move.bind(this), t.settings.throttle))
                    },
                    unbindSwipeMove: function() {
                        i.off(O, e.Html.wrapper)
                    },
                    bindSwipeEnd: function() {
                        i.on(A, e.Html.wrapper, this.end.bind(this))
                    },
                    unbindSwipeEnd: function() {
                        i.off(A, e.Html.wrapper)
                    },
                    touches: function(t) {
                        return M.includes(t.type) ? t : t.touches[0] || t.changedTouches[0]
                    },
                    threshold: function(e) {
                        var n = t.settings;
                        return M.includes(e.type) ? n.dragThreshold : n.swipeThreshold
                    },
                    enable: function() {
                        return a = !1, e.Transition.enable(), this
                    },
                    disable: function() {
                        return a = !0, e.Transition.disable(), this
                    }
                };
            return n.on("build.after", function() {
                e.Html.root.classList.add(t.settings.classes.swipeable)
            }), n.on("destroy", function() {
                c.unbindSwipeStart(), c.unbindSwipeMove(), c.unbindSwipeEnd(), i.destroy()
            }), c
        },
        Images: function(t, e, n) {
            var i = new k,
                o = {
                    mount: function() {
                        this.bind()
                    },
                    bind: function() {
                        i.on("dragstart", e.Html.wrapper, this.dragstart)
                    },
                    unbind: function() {
                        i.off("dragstart", e.Html.wrapper)
                    },
                    dragstart: function(t) {
                        t.preventDefault()
                    }
                };
            return n.on("destroy", function() {
                o.unbind(), i.destroy()
            }), o
        },
        Anchors: function(t, e, n) {
            var i = new k,
                o = !1,
                r = !1,
                s = {
                    mount: function() {
                        this._a = e.Html.wrapper.querySelectorAll("a"), this.bind()
                    },
                    bind: function() {
                        i.on("click", e.Html.wrapper, this.click)
                    },
                    unbind: function() {
                        i.off("click", e.Html.wrapper)
                    },
                    click: function(t) {
                        t.stopPropagation(), r && t.preventDefault()
                    },
                    detach: function() {
                        if (r = !0, !o) {
                            for (var t = 0; t < this.items.length; t++) this.items[t].draggable = !1, this.items[t].dataset.href = this.items[t].getAttribute("href"), this.items[t].removeAttribute("href");
                            o = !0
                        }
                        return this
                    },
                    attach: function() {
                        if (r = !1, o) {
                            for (var t = 0; t < this.items.length; t++) this.items[t].draggable = !0, this.items[t].setAttribute("href", this.items[t].dataset.href), delete this.items[t].dataset.href;
                            o = !1
                        }
                        return this
                    }
                };
            return h(s, "items", {
                get: function() {
                    return s._a
                }
            }), n.on("swipe.move", function() {
                s.detach()
            }), n.on("swipe.end", function() {
                e.Transition.after(function() {
                    s.attach()
                })
            }), n.on("destroy", function() {
                s.attach(), s.unbind(), i.destroy()
            }), s
        },
        Controls: function(t, e, n) {
            var i = new k,
                o = {
                    mount: function() {
                        this._n = e.Html.root.querySelectorAll('[data-glide-el="controls[nav]"]'), this._i = e.Html.root.querySelectorAll('[data-glide-el^="controls"]'), this.addBindings()
                    },
                    setActive: function() {
                        for (var t = 0; t < this._n.length; t++) this.addClass(this._n[t].children)
                    },
                    removeActive: function() {
                        for (var t = 0; t < this._n.length; t++) this.removeClass(this._n[t].children)
                    },
                    addClass: function(e) {
                        var n = t.settings,
                            i = e[t.index];
                        i.classList.add(n.classes.activeNav), b(i).forEach(function(t) {
                            t.classList.remove(n.classes.activeNav)
                        })
                    },
                    removeClass: function(e) {
                        e[t.index].classList.remove(t.settings.classes.activeNav)
                    },
                    addBindings: function() {
                        for (var t = 0; t < this._i.length; t++) this.bind(this._i[t].children)
                    },
                    removeBindings: function() {
                        for (var t = 0; t < this._i.length; t++) this.unbind(this._i[t].children)
                    },
                    bind: function(t) {
                        for (var e = 0; e < t.length; e++) i.on(["click", "touchstart"], t[e], this.click)
                    },
                    unbind: function(t) {
                        for (var e = 0; e < t.length; e++) i.off(["click", "touchstart"], t[e])
                    },
                    click: function(t) {
                        t.preventDefault(), e.Run.make(e.Direction.resolve(t.currentTarget.dataset.glideDir))
                    }
                };
            return h(o, "items", {
                get: function() {
                    return o._i
                }
            }), n.on(["mount.after", "move.after"], function() {
                o.setActive()
            }), n.on("destroy", function() {
                o.removeBindings(), o.removeActive(), i.destroy()
            }), o
        },
        Keyboard: function(t, e, n) {
            var i = new k,
                o = {
                    mount: function() {
                        t.settings.keyboard && this.bind()
                    },
                    bind: function() {
                        i.on("keyup", document, this.press)
                    },
                    unbind: function() {
                        i.off("keyup", document)
                    },
                    press: function(t) {
                        39 === t.keyCode && e.Run.make(e.Direction.resolve(">")), 37 === t.keyCode && e.Run.make(e.Direction.resolve("<"))
                    }
                };
            return n.on(["destroy", "update"], function() {
                o.unbind()
            }), n.on("update", function() {
                o.mount()
            }), n.on("destroy", function() {
                i.destroy()
            }), o
        },
        Autoplay: function(t, e, n) {
            var i = new k,
                o = {
                    mount: function() {
                        this.start(), t.settings.hoverpause && this.bind()
                    },
                    start: function() {
                        var n = this;
                        t.settings.autoplay && f(this._i) && (this._i = setInterval(function() {
                            n.stop(), e.Run.make(">"), n.start()
                        }, this.time))
                    },
                    stop: function() {
                        this._i = clearInterval(this._i)
                    },
                    bind: function() {
                        var t = this;
                        i.on("mouseover", e.Html.root, function() {
                            t.stop()
                        }), i.on("mouseout", e.Html.root, function() {
                            t.start()
                        })
                    },
                    unbind: function() {
                        i.off(["mouseover", "mouseout"], e.Html.root)
                    }
                };
            return h(o, "time", {
                get: function() {
                    var n = e.Html.slides[t.index].getAttribute("data-glide-autoplay");
                    return u(n || t.settings.autoplay)
                }
            }), n.on(["destroy", "update"], function() {
                o.unbind()
            }), n.on(["run.before", "pause", "destroy", "swipe.start", "update"], function() {
                o.stop()
            }), n.on(["run.after", "play", "swipe.end"], function() {
                o.start()
            }), n.on("update", function() {
                o.mount()
            }), n.on("destroy", function() {
                i.destroy()
            }), o
        },
        Breakpoints: function(t, e, n) {
            var i = new k,
                o = t.settings,
                s = o.breakpoints;
            s = C(s);
            var u = r({}, o),
                a = {
                    match: function(t) {
                        if (void 0 !== window.matchMedia)
                            for (var e in t)
                                if (t.hasOwnProperty(e) && window.matchMedia("(max-width: " + e + "px)").matches) return t[e];
                        return u
                    }
                };
            return r(o, a.match(s)), i.on("resize", window, g(function() {
                r(o, a.match(s))
            }, t.settings.throttle)), n.on("update", function() {
                s = C(s), u = r({}, o)
            }), n.on("destroy", function() {
                i.off("resize", window)
            }), a
        }
    };
    return function(t) {
        function e() {
            return i(this, e), s(this, (e.__proto__ || Object.getPrototypeOf(e)).apply(this, arguments))
        }
        return function(t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }(e, v), o(e, [{
            key: "mount",
            value: function() {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                return function t(e, n, i) {
                    null === e && (e = Function.prototype);
                    var o = Object.getOwnPropertyDescriptor(e, n);
                    if (void 0 === o) {
                        var r = Object.getPrototypeOf(e);
                        return null === r ? void 0 : t(r, n, i)
                    }
                    if ("value" in o) return o.value;
                    var s = o.get;
                    return void 0 !== s ? s.call(i) : void 0
                }(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "mount", this).call(this, r({}, z, t))
            }
        }]), e
    }()
});

/*===================================================================
---------------------------------modal and slider---------------------
====================================================================*/
const wcqcModalToggle = document.getElementsByClassName("wcqv_modal_toggle");//delete/x icons in tags by class
const modal = document.getElementsByClassName('wcqv_modal');
const closeModal = document.getElementsByClassName("wcqvCloseModal");


const wcqv_toggle_modal = function() {
        let attribute = this.getAttribute("data-product_id");
        let getModal = document.getElementById('wcqv-modal-' + attribute + '');
        let getModalID = getModal.getAttribute('id');
        getModal.style.display = "block";
        getModal.classList.add('wcqv-modal-active');

        const getGlide = document.getElementById('glide-' + attribute + '');

            if(getGlide != null ) {  
                const glide = new Glide(getGlide);
                glide.mount()
            }
}


Array.from(wcqcModalToggle).forEach(function(element) {
    element.addEventListener('click', wcqv_toggle_modal);
});



const wcqv_close_modal = function() {

    let attributeT = this.getAttribute("modal_target");
    let targetModal = document.getElementById('wcqv-modal-' + attributeT + '');

    targetModal.style.display = "none";
    targetModal.classList.remove('wcqv-modal-active');

}

Array.from(closeModal).forEach(function(element) {
    element.addEventListener('click', wcqv_close_modal);
});


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {

    Array.from(modal).forEach(function(element) {

        if (event.target == element) {
            element.style.display = "none";
            element.classList.remove('wcqv-modal-active');
        }
    });

}
/*-------------------------------------------------------------------*/



/*====================================================================
--------------woocommerce selectbox choose variation----------------
=====================================================================*/


    //capitize passed in string
    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }




    const wcqvAttributeSelectChange = function (event) {

        let findModalID = document.querySelector('.wcqv-modal-active');//active modal
        let matches = findModalID.querySelector("div.glide").getAttribute('id');//
        let capFirsstlettsr = 'glide_slide_' + event.target.value.capitalize() + '';
        const ttt = findModalID.querySelector("#" + capFirsstlettsr );

            if(ttt != null ) {

                let wcqvslideNum = ttt.parentElement.getAttribute('slideNum');
                let getGlide = document.getElementById(matches);        

                    if(getGlide != null ) {  

                        const glide = new Glide(getGlide);//reset object 
                        glide.mount();//new instance
                        glide.go('=' + wcqvslideNum + '');
                    }

            } else {

                console.log('product quick view for woocommerce error: variation assigned image is not in the product gallery');

            }  

    }



    const getSelectClass = document.getElementsByClassName('variations');

    const removeActiveSlide =  Array.from(getSelectClass).map((element) => {

       let matches = element.querySelector("select");

       let p = Array.from(matches).map((element2) => {
            element2.parentElement.classList.add('ddtest');

       }); 

       const ty = document.getElementsByClassName('ddtest');

       let tp = Array.from(ty).map((element3) => {
                     
            element3.onchange=wcqvAttributeSelectChange;

        }); 

    });
/*-------------------------------------------------------------------*/
