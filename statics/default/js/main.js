! function e(t, i, a) {
    function n(l, r) {
        if (!i[l]) {
            if (!t[l]) {
                var o = "function" == typeof require && require;
                if (!r && o) return o(l, !0);
                if (s) return s(l, !0);
                var d = new Error("Cannot find module '" + l + "'");
                throw d.code = "MODULE_NOT_FOUND", d
            }
            var c = i[l] = {
                exports: {}
            };
            t[l][0].call(c.exports, (function(e) {
                return n(t[l][1][e] || e)
            }), c, c.exports, e, t, i, a)
        }
        return i[l].exports
    }
    for (var s = "function" == typeof require && require, l = 0; l < a.length; l++) n(a[l]);
    return n
}({
    1: [function(e, t, i) {
        "use strict";
        var a, n;
        t.exports = (n = function() {
            var e, t, i = window.location.href,
                a = new URL(i),
                n = a.searchParams.get("utm_source"),
                s = a.searchParams.get("utm_medium"),
                l = a.searchParams.get("utm_campaign"),
                r = a.searchParams.get("utm_term"),
                o = a.searchParams.get("tm_content"),
                d = a.searchParams.get("fbclid"),
                c = a.searchParams.get("gclid");
            return d ? (e = "fbclid", t = d) : c ? (e = "gclid", t = c) : (e = null, t = null), !!(n || s || l || r || o || d || c || e || t) && {
                Source: n,
                Medium: s,
                Campaign: l,
                Term: r,
                UTMContent: o,
                Social: e,
                SocialId: t
            }
        }, void(! function(e) {
            for (var t = e + "=", i = document.cookie.split(";"), a = 0; a < i.length; a++) {
                for (var n = i[a];
                    " " == n.charAt(0);) n = n.substring(1, n.length);
                if (0 == n.indexOf(t)) return n.substring(t.length, n.length)
            }
            return null
        }("utm") && n() && function(e, t, i) {
            var a = "";
            if (i) {
                var n = new Date;
                n.setTime(n.getTime() + 24 * i * 60 * 60 * 1e3), a = "; expires=" + n.toUTCString()
            }
            document.cookie = e + "=" + (t || "") + a + "; path=/"
        }("utm", (a = n(), window.btoa(JSON.stringify(a))), 1)))
    }, {}],
    2: [function(e, t, i) {
        "use strict";
        t.exports = function() {
            return new Promise((function(e, t) {
                var i = document.getElementById("loading"),
                    a = document.getElementById("progress"),
                    n = document.getElementById("progstat"),
                    s = document.images,
                    l = s.length,
                    r = 0,
                    o = function() {
                        i.style.opacity = "0", setTimeout((function() {
                            i.style.display = "none", i.parentNode.removeChild(i), document.querySelector("body").classList.add("show-page"), e()
                        }), 1e3)
                    },
                    d = function() {
                        var e = Math.round(100 / l * (r += 1));
                        if (a.style.width = "".concat(e), n.innerHTML = "".concat(e), r === l) return o()
                    };
                if (i) {
                    if (0 === l) return o();
                    for (var c = 0; c < l; c++) {
                        var u = new Image;
                        u.onload = d, u.onerror = d, u.src = s[c].src
                    }
                }
            }))
        }
    }, {}],
    3: [function(e, t, i) {
        "use strict";
        n(e("./lib/Cookie"));
        var a = n(e("./lib/Loading"));

        function n(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }
        var s = function(e) {
                $(e).each((function() {
                    var e = $(this).find("[data-getHeight]").innerHeight(),
                        t = $(this).find("[data-setHeight]"),
                        i = t.attr("data-setHeight");
                    window.innerWidth > i && t.css("max-height", e)
                }))
            },
            l = function() {
                var e = $(".slider-customer .thumbnail-image .swiper-button-next").outerWidth();
                $(".slider-customer .thumbnail-image .swiper-container").css("margin-right", e + 19)
            };
        document.addEventListener("DOMContentLoaded", (function() {
            var e, t;
            (0, a.default)().then((function() {
                s(".thumbnail-image,.review-image,.index-5")
            })), (new WOW).init(), jQuery("img.svg").each((function() {
                var e = jQuery(this),
                    t = e.attr("id"),
                    i = e.attr("class"),
                    a = e.attr("src");
                jQuery.get(a, (function(a) {
                    var n = jQuery(a).find("svg");
                    void 0 !== t && (n = n.attr("id", t)), void 0 !== i && (n = n.attr("class", i + " replaced-svg")), !(n = n.removeAttr("xmlns:a")).attr("viewBox") && n.attr("height") && n.attr("width") && n.attr("viewBox", "0 0 " + n.attr("height") + " " + n.attr("width")), e.replaceWith(n)
                }), "xml")
            })), $("[data-bg]").each((function() {
                var e = $(this).attr("data-bg");
                $(this).css("background", e)
            })), $("[data-width]").each((function() {
                var e = $(this).attr("data-width");
                $(this).css("width", e)
            })), $("[data-max-width]").each((function() {
                var e = $(this).attr("data-max-width");
                $(this).css("maxWidth", e + "px")
            })), $("[data-height]").each((function() {
                var e = $(this).attr("data-height");
                $(this).css("height", e)
            })), $("[data-max-height]").each((function() {
                var e = $(this).attr("data-max-height");
                $(this).css("maxHeight", e + "px")
            })), e = $("header").outerHeight(), $("main").css("padding-top", e), t = new Swiper(".slider-customer .thumbnail-image .swiper-container", {
                spaceBetween: 10,
                slidesPerView: 1,
                loop: !0,
                observer: !0,
                observeParents: !0,
                slideToClickedSlide: !0,
                speed: 1e3,
                autoplay: {
                    delay: 5e3,
                    disableOnInteraction: !1
                },
                navigation: {
                    nextEl: ".thumbnail-image .swiper-button-next",
                    prevEl: ".thumbnail-image .swiper-button-prev"
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2
                    },
                    1440: {
                        slidesPerView: 4
                    }
                }
            }), new Swiper(".slider-customer .review-image .swiper-container", {
                effect: "fade",
                fadeEffect: {
                    crossFade: !0
                },
                autoplay: {
                    delay: 3e3,
                    disableOnInteraction: !1
                },
                speed: 1e3,
                spaceBetween: 20,
                loop: !0,
                simulateTouch: !1,
                slidesPerView: 1,
                thumbs: {
                    swiper: t
                },
                navigation: {
                    nextEl: ".thumbnail-image .swiper-button-next",
                    prevEl: ".thumbnail-image .swiper-button-prev"
                }
            }), l(), $("#block-form-login button").on("click", (function(e) {
                $.blockUI();
                e.preventDefault();
                var t = $(this).attr("data-url"),
                    a = $('#block-form-login input[name="email"]').val(),
                    n = $('#block-form-login input[name="password"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        email: a,
                        password: n
                    },
                    success: function(e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? ($.fancybox.close(), window.location.href=e.link) : alert(e.message)
                    }
                })
            })), $("#block-form-forget button").on("click", (function(e) {
                $.blockUI();
                e.preventDefault();
                var t = $(this).attr("data-url"),
                    a = $('#block-form-forget input[name="email"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        email: a
                    },
                    success: function(e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? ($.fancybox.close(), alert(e.message)) : alert(e.message)
                    }
                })
            })),$("#block-register button").on("click", (function(e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    a = $('#block-register .block-form input[name="email"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        email: a
                    },
                    success: function(e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? ($.fancybox.close(), alert(e.message)) : alert(e.message)
                    }
                })
            })), $("#block-new-group button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    a = $('#block-new-group .block-form input[name="name"]').val(),
                    n = $('#block-new-group .block-form textarea[name="description"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        name: a,
                        description: n
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert('Group Created: '+e.groupName),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })),$("#block-new-project button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    a = $('#block-new-project .block-form input[name="name"]').val(),
                    n = $('#block-new-project .block-form textarea[name="description"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        name: a,
                        description: n
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert('Project Created: '+e.projectName),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })),$("#block-new-task button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    name = $('#block-new-task .block-form input[name="name"]').val(),
                    description = $('#block-new-task .block-form textarea[name="description"]').val(),
                    report_to = $('#block-new-task .block-form select[name="report_to"]').val(),
                    assignee = $('#block-new-task .block-form select[name="assignee"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        name: name,
                        description: description,
                        report_to : report_to,
                        assignee : assignee
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert(e.message),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })), $("#block-invite-group button").on("click", (function(e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    i = $("#block-invite-group .block-form input#email").val(),
                    a = $("#block-invite-group .block-form input#project").val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        email: i,
                    },
                    success: function(e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        alert(e.message)
                    }
                })
            })), $(".block-invite-project button").on("click", (function(e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    n = $(this).attr("redirect-url"),
                    i = $(this).parents('.block-form').find('.form-group-email').find('textarea[name="email"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        email: i,
                    },
                    success: function(e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert(e.message),$.fancybox.close(),window.location.href = n) : alert(e.message)
                    }
                })
            })),  $("#block-announcement button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    a = $('#block-announcement .block-form input[name="title"]').val(),
                    n = $('#block-announcement .block-form textarea[name="description"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        title: a,
                        description: n
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert('Announcement Published'),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })), $("#block-edit-group button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    a = $('#block-edit-group .block-form input[name="name"]').val(),
                    n = $('#block-edit-group .block-form textarea[name="description"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        name: a,
                        description: n
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert('Info Saved'),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })), $("#block-edit-project button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    a = $('#block-edit-project .block-form input[name="name"]').val(),
                    n = $('#block-edit-project .block-form textarea[name="description"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        name: a,
                        description: n
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert('Info Saved'),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })), $("#block-edit-task button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    a = $('#block-edit-task .block-form input[name="name"]').val(),
                    n = $('#block-edit-task .block-form textarea[name="description"]').val(),
                    m = $('#block-edit-task .block-form select[name="assignee"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        name: a,
                        description: n,
                        assignee : m
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert('Info Saved'),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })), $(".delete-project-member-button").on("click", (function (e) {
                e.preventDefault();
                $.blockUI();
                var t = $(this).attr("data-url"),
                    uid = $(this).parent().find('input[name="member_id"]').val(),
                    a = $(this).parent().find('input[name="project_detail_id"]').val();
                $.ajax({
                    type: "POST",
                    url: t,
                    data: {
                        project_detail_id: a
                    },
                    success: function (e) {
                        $.unblockUI();
                        e = JSON.parse(e)
                        '200' == e.code ? (alert(e.message),$.fancybox.close(),window.location.href = e.link) : alert(e.message)
                    }
                })
            })),$(".item-click-dropdown").on("click", (function() {
                $(this).siblings(".content-dropdown").slideToggle()
            })), $(".aside-list .aside-item").children(".list-link").addClass("list-link-level--1"), $(".aside-list .aside-item").children(".name").addClass("name-link-level--1"), $(".aside-list .aside-item .list-link-level--1").children(".link").addClass("link-level--1"), $(".aside-list .aside-item .list-link-level--1").find(".list-link").addClass("list-link-level--2"), $(".aside-list .aside-item .link-level--1").children(".name").addClass("name-link-level--2"), $(".aside-list .aside-item .list-link-level--2").children(".link").addClass("link-level--2"), $(".aside-list .aside-item .name-link-level--1").on("click", (function() {
                var e = $(".aside-list .aside-item .name-link-level--1").not(this);
                $(this).siblings(".list-link").slideToggle(), $(this).toggleClass("active"), e.siblings(".list-link").slideUp(), e.removeClass("active"), $(".aside-list .aside-item .list-link-level--2").slideUp(), $(".aside-list .aside-item .name-link-level--2").removeClass("active")
            })), $(".aside-list .aside-item .name-link-level--2").on("click", (function() {
                var e = $(".aside-list .aside-item .name-link-level--2").not(this);
                $(this).siblings(".list-link").slideToggle(), $(this).toggleClass("active"), e.siblings(".list-link").slideUp(), e.removeClass("active")
            })), $(window).width() < 1024 && $("body, aside").addClass("active"), $(".block-logo .button-close").on("click", (function() {
                $(window).width() > 1024 && ($(this).toggleClass("active"), $("body, aside").toggleClass("active"));
                setTimeout(function(){
                asideWidth = $('aside').width();
                $('.header-breadcrumb').css('margin-left',asideWidth + 20);
                }, 200);
            }))
        })), document.addEventListener("resize", (function() {
            s(".thumbnail-image,.review-image,.index-5"), l()
        }))
    }, {
        "./lib/Cookie": 1,
        "./lib/Loading": 2
    }]
}, {}, [3]);
//# sourceMappingURL=main.min.js.map
