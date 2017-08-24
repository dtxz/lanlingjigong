$(function() {
    var a = function() {
        this.$homepage = $(".homepage-rotation"),
        this.$picbox = $(".homepage-picbox"),
        this.$parImage = this.$picbox.find(">span"),
        this.$arrImage = this.$parImage.find(">a"),
        this.$arrow = $(".homepage-arrow"),
        this.config = {
            width: 150,
            firstLeft: 36,
            perLeft: 125,
            originImageLen: 0,
            moveTime: 0,
            defaultTime: 300,
            spanTime: 100,
            isFirst: !0,
            loadUrl: {
                0 : "",
                1 : "",
                2 : "",
                3 : "",
                4 : ""
            }
        },
        this.init()
    };
    a.prototype.init = function() {
        var a = this;
        this.initImage(),
        this.$arrImage.on("click",
        function() {
            a.config.moveTime = a.config.defaultTime,
            a.move($(this).index())
        }),
        this.$arrow.find("span").on("click",
        function() {
            var b = a.$arrow.find("span.current").index(),
            c = $(this).index() - b;
            a.config.moveTime = a.config.defaultTime + (Math.abs(c) - 1) * a.config.spanTime,
            b = a.$picbox.find(".current").index() + c,
            a.move(b)
        }),
        this.$arrImage.hover(function() {
            if ($(this).hasClass("current")) {
                var a = $(this).find("img").get(0);
                Util.startMove(a, {
                    marginTop: "-5"
                },
                {
                    time: 60
                })
            }
        },
        function() {
            if ($(this).hasClass("current")) {
                var a = $(this).find("img").get(0);
                Util.startMove(a, {
                    marginTop: "0"
                },
                {
                    time: 60
                })
            }
        })
    },
    a.prototype.initImage = function() {
        this.config.originImageLen = this.$arrImage.length,
        this.$parImage.prepend(this.$parImage.html()),
        this.$arrImage = this.$parImage.find(">a"),
        this.$parImage.find(">a:lt(4)").removeClass("current"),
        this.$parImage.css("width", 2 * this.config.originImageLen * this.config.width + 10)
    },
    a.prototype.move = function(a) {
        if (this.$picbox.find(".current").index() != a) {
            var b = this,
            c = (a - 1) * this.config.perLeft + this.config.firstLeft;
            this.$arrImage.removeClass("current"),
            Util.startMove(this.$picbox.get(0), {
                left: -c
            },
            {
                time: b.config.moveTime,
                succFn: function() {
                    var c = 1 >= a,
                    d = a >= 2 * b.config.originImageLen - 2,
                    e = a;
                    if (c || d) {
                        c && (e = b.config.originImageLen + a),
                        d && (e = a - b.config.originImageLen);
                        var f = (e - 1) * b.config.perLeft + b.config.firstLeft;
                        b.$picbox.css("left", -f + "px")
                    }
                    var g = e > b.config.originImageLen - 1 ? e - b.config.originImageLen: e;
                    b.$arrow.find("span").removeClass("current").eq(g).addClass("current"),
                    b.$arrImage.attr({
                        href: "javascript:;"
                    }).removeAttr("target").eq(e).addClass("current").attr({
                        href: b.config.loadUrl[b.$arrImage.eq(g).attr("data-loc")],
                        target: "_blank"
                    })
                }
            })
        }
    };
    new a
});
var numAnimate = null;
$(function() {
    var a = function() {
        this.$number = $(".homepage-amount .number"),
        this.indexConfig = {
            money: "0000000000",
            fmtMoney: "",
            arrMoney: [],
            lastArrMoney: [],
            firstLeft: 30,
            perLeft: 20,
            commaLeft: 10,
            isFirst: !0,
            numHeight: 33,
            numSec: 150,
            time: 1e4,
            numTimer: null,
            intervalTime: 500
        },
        this.initNumLocation()
    };
    a.prototype.initNumLocation = function() {
        var a = 0,
        b = 0;
        this.disposeMoney(this.indexConfig.money);
        for (var c = '<span class="aymbol" style= "left: ' + this.indexConfig.firstLeft + 'px">￥</span>',
        d = 0; d < this.indexConfig.arrMoney.length; d++) {
            var e = this.indexConfig.arrMoney[d],
            f = this.indexConfig.firstLeft + this.indexConfig.perLeft + (a * this.indexConfig.commaLeft + b * this.indexConfig.perLeft);
            a += "," == e ? 1 : 0,
            b += "," == e ? 0 : 1,
            c += '<div style="left: ' + f + 'px;"><span>' + e + "</span></div>"
        }
        this.$number.html(c)
    },
    a.prototype.disposeMoney = function(a) {
        a = ("" + a).replace(/(\d)(?=(?:\d{3})+(?:\.\d+)?$)/g, "$1,"),
        this.indexConfig.fmtMoney = a,
        this.indexConfig.lastArrMoney = 0 == this.indexConfig.arrMoney.length ? ("" + this.indexConfig.fmtMoney).split("") : this.indexConfig.arrMoney,
        this.indexConfig.arrMoney = ("" + this.indexConfig.fmtMoney).split("")
    },
    a.prototype.setNumAnimate = function(a) {
        var b = (a / 100).toFixed(0),
        c = ("" + b).length;
        if (this.indexConfig.isFirst && this.indexConfig.money.length != c) {
            for (var d = "",
            e = 0; c > e; e++) d += "0";
            this.indexConfig.money = d,
            this.initNumLocation()
        }
        if (this.disposeMoney(b), this.indexConfig.isFirst) for (var e = 0; e < this.indexConfig.arrMoney.length; e++) {
            var f = this.indexConfig.arrMoney[e];
            "," != f && this.everyNumAnimate(e, f)
        } else this.setNumAnimateToInterval();
        this.indexConfig.isFirst = !1
    },
    a.prototype.everyNumAnimate = function(a, b) {
        for (var c = this.$number.find(">div").eq(a), d = 1 * c.find("span").html(), e = 10 + 1 * b, f = "", g = 600 + 1.8 * b * this.indexConfig.numSec, h = 0; e > h; h++) d++,
        d = d > 9 ? 0 : d,
        f += "<span>" + d + "</span>";
        c.append(f),
        Util.startMove(c[0], {
            top: -this.indexConfig.numHeight * e
        },
        {
            type: "ease-out",
            time: g,
            succFn: function() {
                c.html("<span>" + d + "</span>").css("top", 0)
            }
        })
    },
    a.prototype.setNumAnimateToInterval = function() {
        var a = this.indexConfig.lastArrMoney,
        b = this.indexConfig.arrMoney,
        c = !1;
        if (b.length > a.length) {
            var d = this.$number.find(".aymbol");
            c = !0,
            d.after('<div style="left:' + this.indexConfig.firstLeft + 'px"><span></span></div>'),
            this.indexConfig.lastArrMoney.unshift(0),
            a = this.indexConfig.lastArrMoney
        }
        for (var e = 0,
        f = 0,
        g = b.length - 1; g >= 0; g--) e = c && 0 == g ? 288 : 30,
        b[g] != a[g] && (f = f + this.indexConfig.intervalTime + e, this.everyNumAnimateToInterval(g, b[g], f, c))
    },
    a.prototype.everyNumAnimateToInterval = function(a, b, c, d) {
        var e = this;
        setTimeout(function() {
            var c = e.$number.find(">div").eq(a),
            f = (1 * c.find("span").html(), "<span>" + b + "</span>");
            c.append(f),
            Util.startMove(c[0], {
                top: 1 * -e.indexConfig.numHeight
            },
            {
                type: "ease-out",
                time: e.indexConfig.intervalTime,
                succFn: function() {
                    if (d && 1 == a) {
                        var b = e.$number.find(".aymbol"),
                        f = e.indexConfig.firstLeft - e.indexConfig.perLeft;
                        b.css("left", f)
                    }
                    c.css("top", 0).find(":lt(1)").remove()
                }
            })
        },
        c)
    },
    numAnimate = new a
}),
$(function() {
    function a(a) {
        var b = $(this).parent(),
        c = b.attr("data-line") || 153,
        d = 0;
        if ("enter" == a) {
            var e = $(this).index();
            d = e * c
        } else {
            var f = b.find(">span.current").index();
            d = f * c
        }
        var g = b.find(".lines");
        g.stop().animate({
            left: d + "px"
        },
        60)
    }
    $(".figure-row a").each(function(a, b) {
        var c = $(b); - 1 == c.attr("href").indexOf("http") && c.removeAttr("target").css("cursor", "default")
    });
    var b = $('[data-type="data-container"]'),
    c = $(".homepage-heading");
    c.find(">span");
    b.on("mouseenter", ".homepage-heading>span",
    function() {
        a.call(this, "enter")
    }).on("mouseleave", ".homepage-heading>span",
    function() {
        a.call(this, "leave")
    }).on("click", ".homepage-heading>span",
    function() {
        var a = $(this).parent();
        a.find(">span").removeClass("current"),
        $(this).addClass("current");
        var b = a.attr("data-line") || 153,
        c = $(this).index();
        a.find(".lines").css("left", c * b),
        a.parent().find(">div:eq(1)").find(">div").hide().eq(c).show(),
        1 == c && e.mediaActive(),
        "ztxm" == a.attr("data-value") && (indexObject.config.isClickTab = !0, $.support.changeBubbles || indexObject.setCvsProgress($("#index-ztxm").find(".homepage-project:not(:hidden)")), 3 == c ? $("#ztxm-bottom-tip").html("<i class='ver-home-img'>&nbsp;</i>由其他投资人发起，无固定发布时间，可全额购买，或部分购买（不能低于100元）\r\n                ") : $("#ztxm-bottom-tip").html("<i class='ver-home-img'>&nbsp;</i>工作日10:30、14:30、20:00、22:00（app专场）开放，最低1元起投\r\n                "))
    }),
    $("a[data-type='index-announce']").each(function(a, b) {
        for (var c = $(b), d = c.attr("title"), e = 0, a = 0; a < d.length; a++) {
            var f = d.charCodeAt(a);
            if (f > 255 || 0 > f ? e += 2 : e++, e >= 28) {
                d = d.substring(0, a);
                break
            }
        }
        c.html(d)
    });
    var d = function() {
        this.firstturn,
        this.hidelist = [],
        this.mediaArrP = this.getData(),
        this.init()
    };
    d.prototype.init = function() {
        for (var a = this,
        b = 0; b < this.mediaArrP.length; b++) b > 8 && this.hidelist.push(this.mediaArrP[b]);
        $(".homepage-media .media-wrapper").hover(function() {
            $(this).children(".media-rotate").addClass("hoverstyle"),
            a.firstturn && clearInterval(a.firstturn)
        },
        function() {
            $(this).children(".media-rotate").removeClass("hoverstyle"),
            a.mediaActive()
        }),
        this.fillInMedia()
    },
    d.prototype.mediaActive = function() {
        var a = this,
        b = $(".homepage-media .media-wrapper"),
        c = 5e3,
        d = a.support3D();
        return d ? (this.firstturn && clearInterval(this.firstturn), void(this.firstturn = setInterval(function() {
            var d, e = a.hidelist[8],
            f = a.getRandom(9),
            g = a.getRandom(50),
            h = b.eq(f);
            h.children("a").each(function() {
                if ($(this).hasClass("media-rotate")) {
                    $(this).removeClass("media-rotate").addClass("media-rotate");
                    var a = $(this).attr("href"),
                    b = $(this).attr("title"),
                    c = $(this).children("img").attr("src");
                    d = {
                        name: b,
                        href: a,
                        image: c
                    }
                } else $(this).hasClass("media-rotate-01") ? $(this).removeClass("media-rotate").addClass("media-rotate") : $(this).hasClass("media-rotate") ? $(this).removeClass("media-rotate").addClass("media-rotate") : $(this).hasClass("media-rotate") && ($(this).attr("href", e.href), $(this).attr("title", e.name), $(this).children("img").attr("src", e.image), $(this).removeClass("media-rotate").addClass("media-rotate"))
            }),
            a.hidelist.splice(8, 1),
            a.hidelist.push(d),
            c = 1e3 * (1 + g / 50)
        },
        c))) : void b.each(function() {
            $(this).children("a:gt(0)").hide()
        })
    },
    d.prototype.getData = function() {
        for (var a = $("#index-media-data").find(">p"), b = [], c = 0; c < a.length; c++) {
            var d = a.eq(c),
            e = d.attr("name"),
            f = d.attr("href"),
            g = d.attr("image");
            b.push({
                name: e,
                href: f,
                image: g
            })
        }
        return b
    },
    d.prototype.fillInMedia = function() {
        for (var a = this.getData(), b = $(".homepage-media .media-wrapper .media-rotate"), c = 0; 9 > c; c++) b.eq(c).attr("href", a[c].href),
        b.eq(c).attr("title", a[c].name),
        b.eq(c).children("img").attr("src", a[c].image)
    },
    d.prototype.getRandom = function(a) {
        return Math.floor(Math.random() * a)
    },
    d.prototype.support3D = function() {
        if (!window.getComputedStyle) return ! 1;
        var a, b = document.createElement("p"),
        c = {
            webkitTransform: "-webkit-transform",
            OTransform: "-o-transform",
            msTransform: "-ms-transform",
            MozTransform: "-moz-transform",
            transform: "transform"
        };
        document.body.insertBefore(b, null);
        for (var d in c) void 0 !== b.style[d] && (b.style[d] = "translate3d(1px,1px,1px)", a = window.getComputedStyle(b).getPropertyValue(c[d]));
        return document.body.removeChild(b),
        void 0 !== a && a.length > 0 && "none" !== a
    };
    var e = new d
});
var indexObject = null;
$(function() {
    var a = function() {
        this.$freshman = $("#index-freshman"),
        this.$hqb = $("#index-hqb"),
        this.$dqb = $("#index-dqb"),
        this.$fyd = $("#index-fyd"),
        this.$cyd = $("#index-cyd"),
        this.$xyd = $("#index-xyd"),
        this.$ztxm = $("#index-ztxm"),
        this.$transfer = $("#index-transfer"),
        this.$ztxmTitle = $("#index-ztxm-title"),
        this.$titleSpan = this.$ztxmTitle.find(">span"),
        this.$notice = $("#index-notice"),
        this.$media = $("#index-media"),
        this.$main = $("[data-type='data-main']"),
        this.isIE8 = !$.support.changeBubbles,
        this.config = {
            isClickTab: !1,
            productList: {},
            mark: "fyd"
        },
        this.init()
    };
    a.prototype.init = function() {
        this.btnInit(),
        this.isIE8 || this.ztxmHover(),
        this.productList(),
        this.timer()
    },
    a.prototype.productList = function() {
        var a = this,
        b = {
            url: "/export/invest/portalData2",
            succFn: function(b) {
                function c(a) {
                    return 0 >= a ? "": a > 99 ? "<em>99+</em>": "<em>" + a + "</em>"
                }
                if (numAnimate.setNumAnimate(b.data.turnover), a.config.productList = b.data, a.$freshman.html(template("src_index/freshman", {
                    items: a.config.productList.fresh
                })), a.$hqb.html(template("src_index/hqb", {
                    items: a.config.productList.hqb
                })), a.config.productList.dqb.length > 0) {
                    for (var d = [], e = 0, f = a.config.productList.dqb.length; f > e; e++) !
                    function(b) {
                        $("[data-type='dqb-order" + a.config.productList.dqb[b].order + "']").html(template("src_index/dqb_" + a.config.productList.dqb[b].order, {
                            items: a.config.productList.dqb[b]
                        })),
                        d.push(a.config.productList.dqb[b].order)
                    } (e);
                    for (var g = 1; 4 >= g; g++) !
                    function(a) { - 1 == $.inArray(a, d) && $("[data-type='dqb-order" + a + "']").html(template("src_index/dqb_" + a, {
                            items: "default"
                        }))
                    } (g)
                } else for (var g = 1; 4 >= g; g++) !
                function(a) {
                    $("[data-type='dqb-order" + a + "']").html(template("src_index/dqb_" + a, {
                        items: "default"
                    }))
                } (g);
                a.config.productList[a.config.mark].length > 0 && (a.$fyd.html(template("src_index/ztxm", {
                    items: a.config.productList.fyd
                })), a.$cyd.html(template("src_index/ztxm", {
                    items: a.config.productList.cyd
                })), a.$xyd.html(template("src_index/ztxm", {
                    items: a.config.productList.xyd
                })), a.$transfer.html(template("src_index/ztxm", {
                    items: a.config.productList.transfer
                })));
                for (var e = 0; e < a.$titleSpan.length; e++) {
                    var h = a.$titleSpan.eq(e),
                    i = h.attr("data-value");
                    if (a.config.productList[i]) {
                        var j = a.config.productList[i][0][i + "Bubble"],
                        k = c(j);
                        h.html("<span>" + h.find(">span:eq(0)").html() + "</span>" + k)
                    }
                }
                if (!a.config.isClickTab) {
                    var l = a.$ztxmTitle.find("em:eq(0)").closest("span").index("#index-ztxm-title >span");
                    l = -1 == l ? 0 : l,
                    a.$titleSpan.eq(l).trigger("click"),
                    3 == l ? $("#ztxm-bottom-tip").html("<i class='ver-home-img'>&nbsp;</i>由其他投资人发起，无固定发布时间，可全额购买，或部分购买（不能低于100元）\r\n                            ") : $("#ztxm-bottom-tip").html("<i class='ver-home-img'>&nbsp;</i>工作日10:30、14:30、20:00、22:00（app专场）开放，最低1元起投\r\n                            ")
                }
                a.isIE8 ? a.setCvsProgress($("#index-ztxm").find(".homepage-project:not(:hidden)")) : a.setCvsProgress($("#index-ztxm"))
            }
        };
        Util.requestAjaxFn(b)
    },
    a.prototype.ztxmHover = function() {
        this.$main.on("mouseover", ".project-item>div",
        function() {
            $(this).addClass("hover")
        }),
        this.$main.on("mouseout", ".project-item>div",
        function() {
            $(this).removeClass("hover")
        })
    },
    a.prototype.timer = function() {
        var a = this;
        clearInterval(a.timer),
        a.timer = setInterval(function() {
            a.productList()
        },
        1e4)
    },
    a.prototype.btnInit = function() {
        var a = this;
        a.$main.on("click", "[data-type='data-invest']",
        function() {
            a.btnLink("invest")
        }),
        a.$main.on("click", "[data-type='data-apply']",
        function() {
            a.btnLink("apply")
        }),
        a.$main.on("click", "[data-type='data-security']",
        function() {
            a.btnLink("security")
        })
    },
    a.prototype.setCvsProgress = function(a) {
        var b = this;
        setTimeout(function() {
            var c = a ? a.find(".cvs-circle-progress") : $(".cvs-circle-progress");
            c.each(function(a, c) {
                b.isIE8 && G_vmlCanvasManager.initElement(c),
                Util.setProgress(c, $(c).next().find(".span-circle-progress"))
            })
        },
        50)
    },
    a.prototype.btnLink = function(a) {
        "invest" == a ? window.open("https://www.souyidai.com/invest", "_blank") : "apply" == a ? window.open("https://www.souyidai.com/info/fangyidai.htm", "_blank") : "security" == a && window.open("https://www.souyidai.com/info/security.htm", "_blank")
    },
    indexObject = new a
}),
$(function() {
    var a = function() {
        this.executeNum = 0,
        this.beforeScrollTop = document.body.scrollTop,
        this.init()
    };
    a.prototype.init = function() {
        var a = this;
        $(".homepage-histogram").on("click",
        function() {
            a.initHistoram(),
            a.historam()
        }),
        $(window).on("scroll",
        function() {
            var b = document.body.scrollTop,
            c = b - a.beforeScrollTop;
            beforeScrollTop = b,
            0 == a.executeNum && a.isInScreen(".homepage-histogram", c) && (a.historam(), a.executeNum++)
        }),
        this.HistoramFirstShow()
    },
    a.prototype.historam = function() {
        var a = $(".item-bar"),
        b = $(".item-bar .standing strong"),
        c = $(".item-bar .standing");
        $.each(b,
        function(b, d) {
            var e = 10 * parseFloat($(d).html());
            $(a[b]).stop(!0).animate({
                height: e
            },
            10 * e, "linear",
            function() {
                $(c[b]).show();
                var a, d;
                0 == b ? (a = -34, d = 24) : (a = -28, d = 18),
                $(c[b]).stop(!0).animate({
                    top: a,
                    height: d
                },
                10 * d)
            })
        })
    },
    a.prototype.initHistoram = function() {
        $.each($(".item-bar"),
        function(a, b) {
            $(b).css({
                height: 0
            }),
            $(b).children(".standing").css({
                top: "0px",
                height: "0px",
                display: "none"
            })
        })
    },
    a.prototype.HistoramFirstShow = function() {
        this.isInScreen(".homepage-histogram", 0) && (this.historam(), this.executeNum++)
    },
    a.prototype.isInScreen = function(a, b) {
        var c = $(window).scrollTop(),
        d = $(a).offset().top,
        e = $(a).outerHeight(),
        f = $(window).height();
        if (! (d + e > c)) return ! 1;
        if (b > 0) {
            if (f > d + e - c) return ! 0
        } else if (0 > b) {
            if (d > c) return ! 0
        } else if (0 == b && d > c && c + f > d + e) return ! 0
    };
    new a
});