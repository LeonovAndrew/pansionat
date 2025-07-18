!function (t, e) {
    "object" == typeof exports && "undefined" != typeof module ? e(exports) : "function" == typeof define && define.amd ? define(["exports"], e) : e((t = "undefined" != typeof globalThis ? globalThis : t || self).window = t.window || {})
}(this, (function (t) {
    "use strict";
    const e = (t, ...i) => {
        const s = i.length;
        for (let n = 0; n < s; n++) {
            const s = i[n] || {};
            Object.entries(s).forEach((([i, s]) => {
                const n = Array.isArray(s) ? [] : {};
                var r;
                t[i] || Object.assign(t, {[i]: n}), "object" == typeof (r = s) && null !== r && r.constructor === Object && "[object Object]" === Object.prototype.toString.call(r) ? Object.assign(t[i], e(n, s)) : Array.isArray(s) ? Object.assign(t, {[i]: [...s]}) : Object.assign(t, {[i]: s})
            }))
        }
        return t
    }, i = function (t) {
        return (new DOMParser).parseFromString(t, "text/html").body.firstChild
    }, s = t => `${t || ""}`.split(" ").filter((t => !!t)), n = (t, e) => {
        s(e).forEach((e => {
            t && t.classList.add(e)
        }))
    }, r = (t, e, i) => {
        s(e).forEach((e => {
            t && t.classList.toggle(e, i || !1)
        }))
    }, o = function (t, e) {
        return t.split(".").reduce(((t, e) => "object" == typeof t ? t[e] : void 0), e)
    };

    class a {
        constructor(t = {}) {
            Object.defineProperty(this, "options", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: t
            }), Object.defineProperty(this, "events", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: new Map
            }), this.setOptions(t);
            for (const t of Object.getOwnPropertyNames(Object.getPrototypeOf(this))) t.startsWith("on") && "function" == typeof this[t] && (this[t] = this[t].bind(this))
        }

        setOptions(t) {
            this.options = t ? e({}, this.constructor.defaults, t) : {};
            for (const [t, e] of Object.entries(this.option("on") || {})) this.on(t, e)
        }

        option(t, ...e) {
            let i = o(t, this.options);
            return i && "function" == typeof i && (i = i.call(this, this, ...e)), i
        }

        optionFor(t, e, i, ...s) {
            let n = o(e, t);
            var r;
            "string" != typeof (r = n) || isNaN(r) || isNaN(parseFloat(r)) || (n = parseFloat(n)), "true" === n && (n = !0), "false" === n && (n = !1), n && "function" == typeof n && (n = n.call(this, this, t, ...s));
            let a = o(e, this.options);
            return a && "function" == typeof a ? n = a.call(this, this, t, ...s, n) : void 0 === n && (n = a), void 0 === n ? i : n
        }

        cn(t) {
            const e = this.options.classes;
            return e && e[t] || ""
        }

        localize(t, e = []) {
            t = String(t).replace(/\{\{(\w+).?(\w+)?\}\}/g, ((t, e, i) => {
                let s = "";
                return i ? s = this.option(`${e[0] + e.toLowerCase().substring(1)}.l10n.${i}`) : e && (s = this.option(`l10n.${e}`)), s || (s = t), s
            }));
            for (let i = 0; i < e.length; i++) t = t.split(e[i][0]).join(e[i][1]);
            return t = t.replace(/\{\{(.*)\}\}/, ((t, e) => e))
        }

        on(t, e) {
            let i = [];
            "string" == typeof t ? i = t.split(" ") : Array.isArray(t) && (i = t), this.events || (this.events = new Map), i.forEach((t => {
                let i = this.events.get(t);
                i || (this.events.set(t, []), i = []), i.includes(e) || i.push(e), this.events.set(t, i)
            }))
        }

        off(t, e) {
            let i = [];
            "string" == typeof t ? i = t.split(" ") : Array.isArray(t) && (i = t), i.forEach((t => {
                const i = this.events.get(t);
                if (Array.isArray(i)) {
                    const t = i.indexOf(e);
                    t > -1 && i.splice(t, 1)
                }
            }))
        }

        emit(t, ...e) {
            [...this.events.get(t) || []].forEach((t => t(this, ...e))), "*" !== t && this.emit("*", t, ...e)
        }
    }

    Object.defineProperty(a, "version", {
        enumerable: !0,
        configurable: !0,
        writable: !0,
        value: "5.0.3"
    }), Object.defineProperty(a, "defaults", {enumerable: !0, configurable: !0, writable: !0, value: {}});

    class h extends a {
        constructor(t, e) {
            super(e), Object.defineProperty(this, "instance", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: t
            })
        }

        attach() {
        }

        detach() {
        }
    }

    var l;
    !function (t) {
        t[t.Init = 0] = "Init", t[t.Error = 1] = "Error", t[t.Ready = 2] = "Ready", t[t.Panning = 3] = "Panning", t[t.Mousemove = 4] = "Mousemove", t[t.Destroy = 5] = "Destroy"
    }(l || (l = {}));
    const c = (t, e = 1e4) => (t = parseFloat(t + "") || 0, Math.round((t + Number.EPSILON) * e) / e), u = {
        classes: {
            container: "f-thumbs",
            viewport: "f-thumbs__viewport",
            track: "f-thumbs__track",
            slide: "f-thumbs__slide",
            isResting: "is-resting",
            isSelected: "is-selected",
            isLoading: "is-loading",
            hasThumbs: "has-thumbs"
        },
        minCount: 2,
        parentEl: null,
        thumbTpl: '<button class="f-thumbs__slide__button" tabindex="0" type="button" aria-label="{{GOTO}}" data-carousel-page="%i"><img class="f-thumbs__slide__img" data-lazy-src="{{%s}}" alt="" /></button>',
        type: "modern"
    };
    t.States = void 0, function (t) {
        t[t.Init = 0] = "Init", t[t.Ready = 1] = "Ready", t[t.Hidden = 2] = "Hidden", t[t.Disabled = 3] = "Disabled"
    }(t.States || (t.States = {}));

    class d extends h {
        constructor() {
            super(...arguments), Object.defineProperty(this, "type", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: "modern"
            }), Object.defineProperty(this, "container", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: null
            }), Object.defineProperty(this, "track", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: null
            }), Object.defineProperty(this, "carousel", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: null
            }), Object.defineProperty(this, "panzoom", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: null
            }), Object.defineProperty(this, "thumbWidth", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: 0
            }), Object.defineProperty(this, "thumbClipWidth", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: 0
            }), Object.defineProperty(this, "thumbHeight", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: 0
            }), Object.defineProperty(this, "thumbGap", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: 0
            }), Object.defineProperty(this, "thumbExtraGap", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: 0
            }), Object.defineProperty(this, "shouldCenter", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: !0
            }), Object.defineProperty(this, "state", {
                enumerable: !0,
                configurable: !0,
                writable: !0,
                value: t.States.Init
            })
        }

        formatThumb(t, e) {
            return this.instance.localize(e, [["%i", t.index], ["%d", t.index + 1], ["%s", t.thumbSrc || "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"]])
        }

        getSlides() {
            const t = [], e = this.option("thumbTpl") || "";
            if (e) for (const i of this.instance.slides || []) t.push({
                html: this.formatThumb(i, e),
                customClass: `has-thumb for-${i.type || "image"}`
            });
            return t
        }

        getProgress(t) {
            const e = this.instance, i = e.panzoom, s = e.pages[t] || 0;
            if (!s || !i) return 0;
            let n = -1 * i.current.e, r = e.contentDim, o = (n - s.pos) / (1 * s.dim),
                a = (n + r - s.pos) / (1 * s.dim), h = (n - r - s.pos) / (1 * s.dim);
            return o = Math.max(0, Math.min(1, Math.abs(o))), a = Math.max(0, Math.min(1, Math.abs(a))), h = Math.max(0, Math.min(1, Math.abs(h))), o = Math.min(o, a, h), o
        }

        onInitSlide(t, e) {
            const i = e.el;
            i && (e.thumbSrc = i.dataset.thumbSrc || e.thumbSrc || "", e.thumbClipWidth = parseFloat(i.dataset.thumbClipWidth || "") || e.thumbClipWidth || 0, e.thumbHeight = parseFloat(i.dataset.thumbHeight || "") || e.thumbHeight || 0)
        }

        onInitSlides() {
            this.state === t.States.Init && this.build()
        }

        onRefreshM() {
            this.refreshModern()
        }

        onChangeM() {
            "modern" === this.type && (this.shouldCenter = !0, this.centerModern())
        }

        onClickModern(t) {
            t.preventDefault(), t.stopPropagation();
            const e = this.instance, i = e.page, s = t => {
                if (t) {
                    const e = t.closest("[data-carousel-page]");
                    if (e) return parseInt(e.dataset.carouselPage || "", 10) || 0
                }
                return -1
            }, n = (t, e) => {
                const i = document.elementFromPoint(t, e);
                return i ? s(i) : -1
            };
            let r = s(t.target);
            r < 0 && (r = n(t.clientX + this.thumbGap, t.clientY), r === i && (r = i - 1)), r < 0 && (r = n(t.clientX - this.thumbGap, t.clientY), r === i && (r = i + 1)), r < 0 && (r = (e => {
                let s = n(t.clientX - e, t.clientY), o = n(t.clientX + e, t.clientY);
                return r < 0 && s === i && (r = i + 1), r < 0 && o === i && (r = i - 1), r
            })(this.thumbExtraGap)), r === i ? this.centerModern() : r > -1 && r < e.pages.length && e.slideTo(r)
        }

        onTransformM() {
            if ("modern" !== this.type) return;
            const {instance: t, container: e, track: i} = this, s = t.panzoom;
            if (!(e && i && s && this.panzoom)) return;
            r(e, this.cn("isResting"), s.state !== l.Init && s.isResting);
            let n = 0, o = 0, a = 0;
            for (const e of t.slides) {
                let t = e.index, i = e.thumbSlideEl;
                if (!i) continue;
                o = 0, r(i, this.cn("isSelected"), t === this.instance.page), o = 1 - this.getProgress(t), i.style.setProperty("--progress", o ? o + "" : "");
                const s = .5 * ((e.thumbWidth || 0) - this.thumbClipWidth);
                n += s, o && (n -= o * (s + this.thumbExtraGap)), i.style.setProperty("--shift", n + ""), n += s, o && (n -= o * (s + this.thumbExtraGap)), n -= this.thumbGap, 0 === t && (a = this.thumbExtraGap * o)
            }
            i && (i.style.setProperty("--left", a + ""), i.style.setProperty("--width", n + a + this.thumbGap + this.thumbExtraGap * o + "")), this.shouldCenter && this.centerModern()
        }

        buildClassic() {
            const {container: t, track: i} = this, s = this.getSlides();
            if (!t || !i || !s) return;
            const n = new this.instance.constructor(t, e({
                track: i,
                infinite: !1,
                center: !0,
                fill: !0,
                dragFree: !0,
                slidesPerPage: 1,
                transition: !1,
                Dots: !1,
                Navigation: !1,
                Sync: {},
                classes: {
                    container: "f-thumbs f-classic-thumbs",
                    viewport: "f-thumbs__viewport",
                    track: "f-thumbs__track",
                    slide: "f-thumbs__slide"
                }
            }, this.option("Carousel") || {}, {Sync: {target: this.instance}, slides: s}));
            this.carousel = n, this.track = i, n.on("ready", (() => {
                this.emit("ready")
            }))
        }

        buildModern() {
            if ("modern" !== this.type) return;
            const {container: t, track: e, instance: s} = this, r = this.option("thumbTpl") || "";
            if (!t || !e || !r) return;
            this.updateModern();
            for (const t of s.slides || []) {
                const s = document.createElement("div");
                n(s, this.cn("slide")), s.appendChild(i(this.formatThumb(t, r))), t.thumbSlideEl = s, e.appendChild(s), this.resizeModernSlide(t)
            }
            const o = new s.constructor.Panzoom(t, {
                content: e,
                lockAxis: "x",
                zoom: !1,
                panOnlyZoomed: !1,
                bounds: () => {
                    let t = 0, e = 0, i = s.slides[0], n = s.slides[s.slides.length - 1], r = s.slides[s.page];
                    return i && n && r && (e = -1 * this.getModernThumbPos(0), 0 !== s.page && (e += .5 * (i.thumbWidth || 0)), t = -1 * this.getModernThumbPos(s.slides.length - 1), s.page !== s.slides.length - 1 && (t += (n.thumbWidth || 0) - (r.thumbWidth || 0) - .5 * (n.thumbWidth || 0))), {
                        x: {
                            min: t,
                            max: e
                        }, y: {min: 0, max: 0}
                    }
                }
            });
            o.on("touchStart", (() => {
                this.shouldCenter = !1
            })), o.on("click", ((t, e) => this.onClickModern(e))), o.on("ready", (() => {
                this.centerModern(), this.emit("ready")
            })), o.on(["afterTransform", "refresh"], (t => {
                this.lazyLoadModern()
            })), this.panzoom = o, this.refreshModern()
        }

        updateModern() {
            if ("modern" !== this.type) return;
            const {container: t} = this;
            t && (this.thumbGap = parseFloat(getComputedStyle(t).getPropertyValue("--f-thumb-gap")) || 0, this.thumbExtraGap = parseFloat(getComputedStyle(t).getPropertyValue("--f-thumb-extra-gap")) || 0, this.thumbWidth = parseFloat(getComputedStyle(t).getPropertyValue("--f-thumb-width")) || 40, this.thumbClipWidth = parseFloat(getComputedStyle(t).getPropertyValue("--f-thumb-clip-width")) || 40, this.thumbHeight = parseFloat(getComputedStyle(t).getPropertyValue("--f-thumb-height")) || 40)
        }

        refreshModern() {
            var t;
            if ("modern" === this.type) {
                this.updateModern();
                for (const t of this.instance.slides || []) this.resizeModernSlide(t);
                this.onTransformM(), null === (t = this.panzoom) || void 0 === t || t.updateMetrics(!0), this.centerModern(0)
            }
        }

        centerModern(t) {
            const e = this.instance, {container: i, panzoom: s} = this;
            if (!i || !s || s.state === l.Init) return;
            const n = e.page;
            let r = this.getModernThumbPos(n), o = r;
            for (let t = e.page - 3; t < e.page + 3; t++) {
                if (t < 0 || t > e.pages.length - 1 || t === e.page) continue;
                const i = 1 - this.getProgress(t);
                i > 0 && i < 1 && (o += i * (this.getModernThumbPos(t) - r))
            }
            let a = 100;
            void 0 === t && (t = .2, e.inTransition.size > 0 && (t = .12), Math.abs(-1 * s.current.e - o) > s.containerRect.width && (t = .5, a = 0)), s.options.maxVelocity = a, s.applyChange({
                panX: c(-1 * o - s.target.e, 1e3),
                friction: null === e.prevPage ? 0 : t
            })
        }

        lazyLoadModern() {
            const {instance: t, panzoom: e} = this;
            if (!e) return;
            const s = -1 * e.current.e || 0;
            let r = this.getModernThumbPos(t.page);
            if (e.state !== l.Init || 0 === r) for (const r of t.slides || []) {
                const t = r.thumbSlideEl;
                if (!t) continue;
                const o = t.querySelector("img[data-lazy-src]"), a = r.index, h = this.getModernThumbPos(a),
                    l = s - .5 * e.containerRect.innerWidth, c = l + e.containerRect.innerWidth;
                if (!o || h < l || h > c) continue;
                let u = o.dataset.lazySrc;
                if (!u || !u.length) continue;
                if (delete o.dataset.lazySrc, o.src = u, o.complete) continue;
                n(t, this.cn("isLoading"));
                const d = i('<div class="f-spinner"><svg viewBox="0 0 50 50"><circle cx="25" cy="25" r="20"></circle><circle cx="25" cy="25" r="20"></circle></svg></div>');
                t.appendChild(d), o.addEventListener("load", (() => {
                    t.offsetParent && (t.classList.remove(this.cn("isLoading")), d.remove())
                }), !1)
            }
        }

        resizeModernSlide(t) {
            if ("modern" !== this.type) return;
            if (!t.thumbSlideEl) return;
            const e = t.thumbClipWidth && t.thumbHeight ? Math.round(this.thumbHeight * (t.thumbClipWidth / t.thumbHeight)) : this.thumbWidth;
            t.thumbWidth = e
        }

        getModernThumbPos(t) {
            const e = this.instance.slides[t], i = this.panzoom;
            if (!i || !i.contentRect.fitWidth) return 0;
            let s = i.containerRect.innerWidth, n = i.contentRect.width;
            2 === this.instance.slides.length && (t -= 1, n = 2 * this.thumbClipWidth);
            let r = t * (this.thumbClipWidth + this.thumbGap) + this.thumbExtraGap + .5 * (e.thumbWidth || 0);
            return r -= n > s ? .5 * s : .5 * n, c(r || 0, 1)
        }

        build() {
            const e = this.instance, i = e.container, s = this.option("minCount") || 0;
            if (s) {
                let i = 0;
                for (const t of e.slides || []) t.thumbSrc && i++;
                if (i < s) return this.cleanup(), void (this.state = t.States.Disabled)
            }
            const r = this.option("type");
            if (["modern", "classic"].indexOf(r) < 0) return void (this.state = t.States.Disabled);
            this.type = r;
            const o = document.createElement("div");
            n(o, this.cn("container")), n(o, `is-${r}`);
            const a = this.option("parentEl");
            a ? a.appendChild(o) : i.after(o), this.container = o, n(i, this.cn("hasThumbs"));
            const h = document.createElement("div");
            n(h, this.cn("track")), o.appendChild(h), this.track = h, "classic" === r ? this.buildClassic() : this.buildModern(), this.state = t.States.Ready
        }

        cleanup() {
            var e, i;
            this.carousel && this.carousel.destroy(), this.carousel = null, this.panzoom && this.panzoom.destroy(), this.panzoom = null, this.container && this.container.remove(), this.container = null, this.track = null, this.state = t.States.Init, e = this.instance.container, i = this.cn("hasThumbs"), s(i).forEach((t => {
                e && e.classList.remove(t)
            }))
        }

        attach() {
            this.instance.on("initSlide", this.onInitSlide), this.instance.on("initSlides", this.onInitSlides), this.instance.on("Panzoom.afterTransform", this.onTransformM), this.instance.on("Panzoom.refresh", this.onRefreshM), this.instance.on("change", this.onChangeM)
        }

        detach() {
            this.instance.off("initSlide", this.onInitSlide), this.instance.off("initSlides", this.onInitSlides), this.instance.off("Panzoom.afterTransform", this.onTransformM), this.instance.off("Panzoom.refresh", this.onRefreshM), this.instance.off("change", this.onChangeM), this.cleanup()
        }
    }

    Object.defineProperty(d, "defaults", {
        enumerable: !0,
        configurable: !0,
        writable: !0,
        value: u
    }), t.Thumbs = d, t.defaultOptions = u
}));
