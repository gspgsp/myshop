var lazyLoad = {
    Init: function () {
        return $("img[lazyload]");
    },
    Calculate: function (lazyloadobject) {
        var windowHeight = $(window).height();
        var arrReturn = {};
        var _scrollTop;
        if (lazyloadobject.length == 0) {
            return null;
        }
        else {
            lazyloadobject.each(function (i) {
                _scrollTop = parseInt($(this).offset().top - windowHeight);
                if (!arrReturn.hasOwnProperty(_scrollTop)) {
                    arrReturn[_scrollTop] = new Array();
                }
                arrReturn[_scrollTop].push($(this));
            });
            this.ArrLoad = arrReturn;
            return arrReturn;
        }
    },
    ArrLoad: null,
    IsLoad: function (scrolltop, objectstop) {
        if (objectstop != null && objectstop != {}) {
            for (i in this.ArrLoad) {
                if (parseInt(i) <= scrolltop && this.ArrLoad.hasOwnProperty(i)) {
                    for (j = 0; j < this.ArrLoad[i].length; j++) {
                        this.ArrLoad[i][j].attr("src", this.ArrLoad[i][j].attr("lazyload")).removeAttr("lazyload");
                    }
                    delete this.ArrLoad[i];
                }
            }
        }
    },
    Run: function () {
        var lazyLoadObject = this.Init();
        this.Calculate(lazyLoadObject);
        arrScrollTop = this.ArrLoad;
        if (arrScrollTop == null) {
            return false;
        }
        else {
            var _this = this;
            _this.IsLoad($(window).scrollTop(), arrScrollTop);
            $(window).scroll(function () {
                _this.IsLoad($(this).scrollTop(), arrScrollTop);
            });
        }
    }
}
$(function () {
    lazyLoad.Run();
});

$(window).resize(function () {
    lazyLoad.Run();
});