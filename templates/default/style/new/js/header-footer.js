var login = function() {};
$(function() {
    function a() {
        $.ajax({
            type: "GET",
            async: !0,
            dataType: "json",
            url: "/",
            success: function(a) {
                0 == a.errorCode && (j = a.data, $("#myCoupon").html(j))
            }
        }),
        $.ajax({
            type: "GET",
            async: !0,
            dataType: "json",
            url: "/myaccount/stainfo/count",
            success: function(a) {
                i = a.count,
                $("#myMsg").html(i).show(),
                i > 0 ? $("#redPoint").show() : $("#redPoint").hide()
            }
        }),
        $.ajax({
            type: "GET",
            async: !0,
            dataType: "json",
            url: "/",
            success: function(a) {
                i = a.data,
                $("#myTicket").html(i)
            }
        })
    }
    function b(a) {
        a.each(function() {
            var a = $(this);
            a.hide()
        })
    }
    function c(a, b) {
        a.each(function() {
            var a = $(this);
            a.removeClass(b)
        })
    }
    function d(a) {
        a.addClass("weak-hover-border"),
        a.find("i[data-type='hover-tip-arrow']").addClass("ver-arrow-hover"),
        a.find("em[data-type='ico-tel-em']").addClass("ico-tel-hover"),
        a.css("color", "#53a0e3"),
        o.hide()
    }
    function e(a) {
        a.removeClass("weak-hover-border"),
        a.find("i[data-type='hover-tip-arrow']").removeClass("ver-arrow-hover"),
        a.find("em[data-type='ico-tel-em']").removeClass("ico-tel-hover"),
        a.css("color", "#333"),
        o.show()
    }
    function f(a) {
        a.each(function() {
            var a = $(this);
            a.stop().animate({
                opacity: "0",
                "z-index": "-1"
            },
            700)
        })
    }
    function g(a, b) {
        a.eq(b).stop().animate({
            opacity: "1",
            "z-index": "0"
        },
        700,
        function() {
            z = b
        })
    }
    function h() {
        z++,
        z > x.children().length - 1 && (z = 0),
        f(x.children()),
        x.children().eq(z).stop().animate({
            opacity: "1",
            "z-index": "0"
        },
        700),
        c(y.children(), "current"),
        y.children().eq(z).addClass("current")
    }
    location.href;
    login = function() {
        var b = "";
        $.cookie("syd_name") && (b = $.base64.atob($.cookie("syd_name"))),
        b.length > 0 ? ($("#login_before").hide(), $("#login_after").show(), $("#login_after").html('您好，<a href="/">' + b + '</a><a href="">【安全退出】</a>'), $("#login_before_t").hide(), $("#login_after_t").show(), $("#login_name_2").html(b), a(), setInterval(a, 6e4)) : ($("#login_after").hide(), $("#login_before").show(), $("#login_after_t").hide(), $("#login_before_t").show()),
        $("#login_name_2").on("click",
        function(a) {
            location.href = ""
        })
    };
    var i = 0,
    j = 0;
    login(),
    $("div[data-type='tail-ton-box']").find("a").on("mouseenter",
    function() {
        $(this).find("span").fadeIn(150)
    }),
    $("div[data-type='tail-ton-box']").find("a").on("mouseleave",
    function() {
        $(this).find("span").fadeOut(150)
    });
    var k = $("#sidebar-weixin");
    k.on("mouseenter",
    function() {
        $(".qr-codes").show()
    }),
    k.on("mouseleave",
    function() {
        $(".qr-codes").hide()
    });
    var l = $("#sidebar-top");
    l.hide(),
    l.click(function() {
        $("body,html").animate({
            scrollTop: "0px"
        },
        800)
    }),
    $(window).scroll(function() {
        var a = $(window).scrollTop();
        a > 50 ? l.fadeIn(400) : l.fadeOut(200)
    });
    var m = $("#home-pop-closed");
    m.on("click",
    function() {
        var a = $(this);
        a.parents(".home-pop").hide()
    });
    var n = $("a[data-type='weak-item-a']"),
    o = $("span[data-type='lines-color']");
    n.on("mouseenter",
    function() {
        var a = $(this);
        d(a)
    }),
    n.on("mouseleave",
    function() {
        var a = $(this);
        e(a)
    });
    var p = $("a[data-type='weak-item-a1']"),
    q = $("div[data-type='weak-contact-us']");
    p.on("mouseenter",
    function() {
        var a = $(this);
        d(a),
        q.show()
    }),
    q.on("mouseenter",
    function() {
        $(this);
        q.show(),
        d(p)
    }),
    $(document).on("mouseleave", "a[data-type='weak-item-a1'],div[data-type='weak-contact-us']",
    function() {
        var a = $(this);
        e(a),
        q.hide(),
        e(p)
    });
    var r = $("div[data-type='service-list']");
    r.on("mouseenter", "a",
    function() {
        var a = $(this),
        b = a.index();
        a.find("span").addClass("ico-service-h" + b)
    }),
    r.on("mouseleave", "a",
    function() {
        var a = $(this),
        b = a.index();
        c(a.find("span"), "ico-service-h" + b)
    });
    var s = $("span[data-type='after-logging']"),
    t = $("div[data-type='logging-up']");
    $(document).on("mouseenter", "span[data-type='after-logging'],div[data-type='logging-up']",
    function() {
        $(this);
        t.show(),
        s.addClass("logging-down")
    }),
    $(document).on("mouseleave", "span[data-type='after-logging'],div[data-type='logging-up']",
    function() {
        $(this);
        t.hide(),
        s.removeClass("logging-down")
    });
    var u = $("ul[data-type='nav-menu']> li>a"),
    v = $("ul[data-type='nav-menu']> li> div[data-type='borrow-drop-down']");
    u.on("mouseenter",
    function() {
        var a = $(this),
        b = $(this).parent();
        b.addClass("nav-li-hover");
        var c = $(this).parents("ul[data-type='nav-menu']").find(".nav-hover");
        c.css({
            width: b.width() + "px"
        });
        var d = $(this).offset().left - $("ul[data-type='nav-menu']").offset().left;
        c.stop().animate({
            left: d - 30 + "px"
        },
        200),
        a.next().show()
    }),
    u.on("mouseleave",
    function() {
        var a = $(this),
        b = $(this).parent(),
        c = $(this).parents("ul[data-type='nav-menu']").find(".nav-hover");
        b.removeClass("nav-li-hover"),
        c.css({
            width: "0"
        }),
        a.next().hide()
    }),
    v.on("mouseenter",
    function() {
        var a = $(this);
        a.show(),
        a.parent().addClass("nav-li-hover")
    }),
    v.on("mouseleave",
    function() {
        var a = $(this);
        a.hide(),
        a.parent().removeClass("nav-li-hover")
    });
    var w = $("a[data-type='version-links-action']");
    w.on("click",
    function() {
        var a = $(this);
        a.toggleClass("current"),
        a.parent().parent().find("span[data-type='version-links-a-an']").toggleClass("overflow-hidden")
    });
    var x = $("div[data-type='figure-picture']"),
    y = $("div[data-type='figure-btns']"),
    z = 0,
    A = null;
    x.children().eq(0).css({
        "z-index": "0",
        opacity: "1"
    });
    var B = y.width();
    y.css({
        "margin-left": "-" + B + "px",
        display: "block"
    }),
    y.children().on("click",
    function() {
        var a = $(this),
        b = a.index();
        clearInterval(A),
        f(x.children()),
        g(x.children(), b),
        c(y.children(), "current"),
        a.addClass("current")
    }),
    x.hover(function() {
        clearInterval(A)
    },
    function() {
        A = window.setInterval(h, 5e3)
    }).trigger("mouseenter");
    var C = $("div[data-type='tail-any']");
    C.children("a").on("mouseenter",
    function() {
        var a = $(this),
        d = a.index();
        C.children("a").each(function(a) {
            $(this).removeClass("ico-ver-fight-" + a)
        }),
        a.addClass("ico-ver-fight-" + d),
        c(C.children("div").children(), "flicking-opcity"),
        b(C.children("div").children()),
        C.children("div").children().eq(d).addClass("flicking-opcity").show()
    }),
    C.children("a").on("mouseleave",
    function() {
        var a = $(this);
        a.index();
        C.children("a").each(function(a) {
            $(this).removeClass("ico-ver-fight-" + a)
        }),
        c(C.children("div").children(), "flicking-opcity")
    });
    var D = $("a[data-type='tail-weixin']"),
    E = $("div[data-type='micro']");
    D.hover(function() {
        $(this);
        E.show()
    },
    function() {
        E.hide()
    });
    var F = $("a[data-type='tail-qq'],span[data-type='qqlayer']"),
    G = $("span[data-type='qqlayer']");
    F.hover(function() {
        G.show()
    },
    function() {
        G.hide()
    })
});