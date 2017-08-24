//页头左边出发城市
j(document).ready(function () {
    j(".pop_depart_city").hide();
    j(".top_info .depart_city .chose").mouseover(function () {
        j(".pop_depart_city").show();
    });
    j(".top_info .depart_city .chose").mouseout(function () {
        j(".pop_depart_city").hide();
    });
    j(".pop_depart_city > b").click(function () {
        j(".pop_depart_city").hide();
    });
    j("#mask_close").click(depart_hide);
    j("#dest_other").click(depart_show);
    j("#theme_other").click(depart_show);
    j("#theme_other_single").click(depart_show);

    //    //read cookie
    //    var isLogin = j.cookie("ticket_hhtravel") != null;

    //    if (isLogin) {
    //        j("#loginLink").html("登出");
    //    } else {
    //        j("#loginLink").html("登录");
    //    }

    j("#loginLink").click(login_click);
    menu();
});
function menu() {
    var nav_destn_timeout;
    j("#nav_destn").mouseenter(function () {
        clearTimeout(nav_destn_timeout);
        nav_theme_close();
        nav_destn_open();
    });
    j("#nav_destn").mouseleave(function () {
        nav_destn_timeout = setTimeout(function () {
            nav_destn_close();
        }, 500);
    });
    j("#pop_panel_destn").mouseenter(function () {
        clearTimeout(nav_destn_timeout);
    });
    j("#pop_panel_destn").mouseleave(function () {
        nav_destn_close();
    });

    var nav_theme_timeout;
    var pop_panel_theme
    if (j("#pop_panel_theme").hasClass("disable")) {
        pop_panel_theme = j("#pop_panel_theme_single");
    }
    else {
        pop_panel_theme = j("#pop_panel_theme");
    }
    j("#nav_theme").mouseenter(function () {
        clearTimeout(nav_theme_timeout);
        nav_destn_close();
        nav_theme_open()
    });
    j("#nav_theme").mouseleave(function () {
        nav_theme_timeout = setTimeout(function () {
            nav_theme_close();
        }, 200);
    });
    pop_panel_theme.mouseenter(function () {
        clearTimeout(nav_theme_timeout);
    });
    pop_panel_theme.mouseleave(function () {
        nav_theme_close();
    });

    j(".pop_panel .close").click(navclose);

    function nav_destn_open() {
        j("#nav_destn .arrow_down").removeClass('arrow_down').addClass('arrow_up');
        j("#pop_panel_destn").show();
    };
    function nav_destn_close() {
        j("#nav_destn .arrow_up").removeClass('arrow_up').addClass('arrow_down');
        j("#pop_panel_destn").hide();
    };
    function nav_theme_open() {
        j("#nav_theme .arrow_down").removeClass('arrow_down').addClass('arrow_up');
        pop_panel_theme.show();
    };
    function nav_theme_close() {
        j("#nav_theme .arrow_up").removeClass('arrow_up').addClass('arrow_down');
        pop_panel_theme.hide();
    };
    function navclose() {
        j(".nav_list a span").removeClass('arrow_up').addClass('arrow_down');
        j(".pop_panel").hide();
    };
}

//跳转登录，并写下回来的url进入cookie

function login_click() {
    //read cookie
    var isLogin = j.cookie("ticket_hhtravel") != null;

    if (isLogin) {

        if (isOfflineOrder) {
            deleteCookie("ticket_hhtravel", { "domain": cookieDomain, "expires": -1 });
            j("#loginLink").html("登录");
            j("#userName").html("");
            j("#userSlash").hide();
            window.location.href = App_Root;
        } else {
            j.ajax({ url: App_Root + 'Shared/Logout',
                type: "post",
                success: function (data) {
                    if (data == "True") {
                        deleteCookie("ticket_hhtravel", { "domain": cookieDomain, "expires": -1 });
                        j("#loginLink").html("登录");
                        j("#userName").html("");
                        j("#userSlash").hide();
                        window.location.href = App_Root;
                    }
                },
                error: function () {
                }
            });
        }
    } else {
        j.cookie("login_backurl", window.location.href);
        j.cookie("login_method", "Get");
        //redirect to login page
        window.location.href = loginUrl;
    }
}

//改变出发城市
function changeCity(cityId) {
    var taipei = 617;
    if (cityId == taipei) {
        document.location.href = "http://tb.hhtravel.com";
    }
    else {
        j.cookie("DepartureCity", cityId, { expires: 7 });
        window.location.reload(true);
    }
}
//改变出发城市2
function changeCity2(cityId) {
    depart_hide();
    changeCity(cityId);
}
//出发城市mask
function depart_show() {
    var top = j("#mask_content_depart").height() / 2;
    var left = j("#mask_content_depart").width() / 2;
    j("#mask_content_depart").css({ "top": "50%", "margin-top": -top + "px" });
    j("#mask_content_depart").css({ "left": "50%", "margin-left": -left + "px" });
    j('#mask_bg').show();
    j('#mask_content_depart').show();
}
function depart_hide() {
    j('#mask_bg').hide();
    j('#mask_content_depart').hide();
}

// 数值显示为千分位
var formatToCurrency = function (num) {
    var numStr = num.toString();
    var re = /(\d{1,3})(?=(\d{3})+(?:$|\D))/g;
    numStr = numStr.replace(re, "$1,");
    return numStr;
};
/**Parses string formatted as YYYY-MM-DD to a Date object.
* If the supplied string does not match the format, an
* invalid Date (value NaN) is returned.
* @param {string} dateStringInRange format YYYY-MM-DD, with year in
* range of 0000-9999, inclusive.
* @return {Date} Date object representing the string.
*/
function parseISO8601(dateStringInRange) {
    var isoExp = /^\s*(\d{4})-(\d\d)-(\d\d)\s*$/,
       date = new Date(NaN), month,
       parts = isoExp.exec(dateStringInRange);

    if (parts) {
        month = +parts[2];
        date.setFullYear(parts[1], month - 1, parts[3]);
        if (month != date.getMonth() + 1) {
            date.setTime(NaN);
        }
    }
    return date;
}

/**Parses string formatted as YYYY-MM-DD 或者 YYYY-M-D
*/
function parseDate(dateStringInRange) {
    var isoExp = /^\s*(\d{4})-(\d?\d)-(\d?\d)\s*$/,
       date = new Date(NaN), month,
       parts = isoExp.exec(dateStringInRange);

    if (parts) {
        month = +parts[2];
        date.setFullYear(parts[1], month - 1, parts[3]);
        if (month != date.getMonth() + 1) {
            date.setTime(NaN);
        }
    }
    return date;
}

//cookie操作,http://hi.baidu.com/bareearthling/item/51c6c3ecf45192adc00d7540
jQuery.cookie = function (name, value, options) {
    if (typeof value != 'undefined') {
        options = options || {};
        if (value === null) {
            value = '';
            options = $.extend({}, options);
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString();
        }
        var path = options.path ? '; path=' + (options.path) : '; path=/';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

////删除cookie
//function deleteCookie(name) {
//    deleteCookie(name, '', { expires: -1 });
//}

//删除cookie with options
function deleteCookie(name, options) {
    options = options || { expires: -1 };

    j.cookie(name, '', options);
}

function addDate(date, days) {
    var result = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    result.setDate(result.getDate() + days);
    return result;
}

function dateToStr(date) {
    var padZero = function (i) {
        return (i < 10) ? "0" + i : "" + i;
    };
    var strDate = date.getFullYear() + '-' + padZero(date.getMonth() + 1) + '-' + padZero(date.getDate());
    return strDate;
}

var position = function (element) {
    //var top = element.position().top, pos = element.css("position");
    var top = element.offset().top;
    j(window).scroll(function () {
        var scrolls = j(this).scrollTop();
        if (scrolls > top) {
            element.addClass("journey_date_fixed");
        }
        else {
            element.removeClass("journey_date_fixed");
        }
    });
};