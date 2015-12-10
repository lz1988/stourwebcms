/**
 * Created by Administrator on 14-12-22.
 */
; (function(o) {
    Ctrip.Namespace.define("Ctrip.pages", {
        config: {
            domainUrl: "flights.ctrip.com",
            redirectUrl: "u.ctrip.com",
            ajaxUrl: "http://openapi.ctrip.com/logicsvr/AjaxServerNew.ashx",
            allianceID: "6491",
            sID: "165594",
            userId: "",
            secretKey: "0FEFFC1F-D220-4AAD-8F24-642C962092B7"
        },
        LabReady: function() {
            var a = this;
            $.ready(function() {
                a.pageInit() && (a.searchParams(), a.eventBind(), a.getLowPriceList(), a.getFlightList())
            })
        },
        pageInit: function() {
            var a = o.parameters();
            this.params = {
                arriveCity: this.getCityCodeByCityName(a.q, "a"),
                departCity: this.getCityCodeByCityName(a.t, "d"),
                arriveCityName: a.q,
                departCityName: a.t,
                departDate: a.date,
                backDate: a.Rtdate,
                searchType: "1" == a.type ? "S": "D"
            };
            "SHA" == this.params.departCity && (this.params.departCityName = "\u4e0a\u6d77");
            "BJS" == this.params.arriveCity && (this.params.arriveCityName = "\u5317\u4eac");
            this.selectedLowPriceItem = null;
            this.lowPriceContainer = document.getElementById("lowPriceContainer");
            this.btnLowPricePrev = document.getElementById("btnPrev");
            this.btnLowPriceNext = document.getElementById("btnNext");
            this.selectedFlight = document.getElementById("selected");
            this.baseInfo = document.getElementById("baseInfo");
            this.nodata = document.getElementById("nodata");
            this.flightListContainer = document.getElementById("flightListContainer");
            this.fliterContainer = document.getElementById("fliterContainer");
            this.btnModifyFlight = document.getElementById("btnModifyFlight");
            this.backInfoContainer = document.getElementById("backInfoContainer");
            this.rateInfoContainer = document.getElementById("rateInfoContainer");
            this.kindInfoContainer = document.getElementById("kindInfoContainer");
            this.ifra = document.getElementById("jmp-iframe-type-group");
            this.topTip = document.getElementById("topTip");
            this.topTip_p = document.getElementById("topTip_p");
            this.loadingDiv = document.getElementById("loadingDiv");
            this.clearConditions = document.getElementById("clearConditions");
            this.fliterNodata = document.getElementById("fliterNodata");
            this.sort = {
                time: {
                    status: "DESC",
                    tag: document.getElementById("sortTime")
                },
                price: {
                    status: "ASC",
                    tag: document.getElementById("sortPrice")
                },
                type: "time"
            };
            if (this.verifyParams()) {
                this.showBaseInfo();
                for (var a = {
                        data: []
                    },
                         b = 0; 7 > b; b++) {
                    var c = {
                        canClick: !1
                    };
                    b || (c.classname = "current");
                    c.FullDate = this.params.departDate.isEffectiveDate().next(b);
                    c.DepartDate = c.FullDate.isEffectiveDate().formatStr("-").split("-")[1] + "-" + c.FullDate.isEffectiveDate().formatStr("-").split("-")[2];
                    c.weekDay = this.getWeekDay(c.FullDate);
                    c.LowestPrice = 0;
                    a.data.push(c)
                }
                this.lowPriceContainer.innerHTML = cQuery.tmpl.render(this.tmp().lowPrice, a);
                return ! 0
            }
            return ! 1
        },
        verifyParams: function() {
            var a = !0;
            "D" != this.params.searchType.toUpperCase() && "S" != this.params.searchType.toUpperCase() && (this.errorMsg("ctripCustomerInfomations:<p>\u60a8\u8f93\u5165\u4e86\u9519\u8bef\u7684\u53c2\u6570</p>\u65e0\u6cd5\u5206\u6790\u67e5\u8be2\u7c7b\u578b\uff0c \u4ed6\u7528\u6765\u6307\u5b9a\u67e5\u8be2\u5355\u7a0b\u6216\u5f80\u8fd4"), a = !1);
            this.params.departDate.isEffectiveDate() ? this.params.departDate = this.params.departDate.isEffectiveDate().formatStr("-") : (this.errorMsg("ctripCustomerInfomations:<p>\u60a8\u8f93\u5165\u4e86\u9519\u8bef\u7684\u53c2\u6570</p>\u65e0\u6cd5\u5206\u6790\u8d77\u7a0b\u65e5\u671f\uff0c\u56e0\u4e3a\u4ed6\u4eec\u4e0d\u662f\u6709\u6548\u7684\u65f6\u95f4\u683c\u5f0f"), a = !1);
            this.params.backDate && !this.params.backDate.isEffectiveDate() ? (this.errorMsg("ctripCustomerInfomations:<p>\u60a8\u8f93\u5165\u4e86\u9519\u8bef\u7684\u53c2\u6570</p>\u65e0\u6cd5\u5206\u6790\u8fd4\u7a0b\u65e5\u671f\uff0c\u56e0\u4e3a\u4ed6\u4eec\u4e0d\u662f\u6709\u6548\u7684\u65f6\u95f4\u683c\u5f0f"), a = !1) : this.params.backDate && (this.params.backDate = this.params.backDate.isEffectiveDate().formatStr("-"));
            if (!this.getCityNameByCityCode(this.params.arriveCity) || !this.getCityNameByCityCode(this.params.departCity)) this.errorMsg("ctripCustomerInfomations:<p>\u60a8\u8f93\u5165\u4e86\u9519\u8bef\u7684\u53c2\u6570</p>\u65e0\u6cd5\u5206\u6790\u8d77\u7a0b\u6216\u843d\u5730\u57ce\u5e02\uff0c\u56e0\u4e3a\u4ed6\u4eec\u4e0d\u662f\u6709\u6548\u7684\u57ce\u5e02\u4e09\u5b57\u7801"),
                a = !1;
            return a
        },
        showBaseInfo: function() {
            var a = [],
                b = "go" == this.FlightList.status ? this.params.departCityName: this.params.arriveCityName,
                c = "go" == this.FlightList.status ? this.params.arriveCityName: this.params.departCityName,
                d = "go" == this.FlightList.status ? "  (" + this.params.departDate.isEffectiveDate().formatStr("-") + "  " + this.getWeekDay(this.params.departDate.isEffectiveDate().formatStr("-")) + ")  ": "  (" + this.params.backDate.isEffectiveDate().formatStr("-") + "  " + this.getWeekDay(this.params.backDate.isEffectiveDate().formatStr("-")) + ")  ";
            a.push("\u9009\u62e9\u822a\u73ed  ");
            a.push(b);
            a.push("  <span>\u2192</span>  ");
            a.push(c);
            a.push(d);
            this.baseInfo.innerHTML = a.join("")
        },
        animateStatus: {
            moveing: !1,
            moveQueue: []
        },
        pager: {
            total: 0,
            current: 0,
            next: 0,
            prev: 0,
            pageSize: 7
        },
        flightCache: {
            go: null,
            back: null
        },
        FlightList: {
            go: [],
            back: [],
            status: "go",
            result: {
                go: [],
                back: []
            }
        },
        tmp: function() {
            return {
                lowPrice: '                    {{each(i, c) data}}                        <a href="javascript:void(0);" index="${i+1}" {{if classname == \'current\'}}id="_lowPriceAutoID_current"{{else}}id="_lowPriceAutoID_${i+1}"{{/if}}                             class="${classname}"                              data-date="${FullDate}" {{if canClick}}onclick = "Ctrip.pages.changeLowPriceHandle.call(Ctrip.pages, this);"{{/if}}>\t\t\t\t\t\t    ${DepartDate} ${weekDay}<br />\t\t\t\t\t\t    <strong class="price">{{if LowestPrice == 0}}\u67e5\u8be2{{else}}&yen;${LowestPrice}{{/if}}</strong>\t\t\t\t\t    </a>                    {{/each}}',
                flightList: '                            {{each(i,c) data}}                                <div class="fltresuslt_box">\t\t\t                        <table>\t\t\t\t                        <tbody>\t\t\t\t\t                        <tr>\t\t\t\t\t\t                        <td width="45"><strong class="txt_time">${DepartSortTime}</strong><br />${ArriveSortTime}</td>\t\t\t\t\t\t                        <td width="80">${DPortName}<br />${APortName}</td>\t\t\t\t\t\t                        <td width="130" class="flt_company">\t\t\t\t\t\t\t                        <strong class="pubFlights_${AirlineCode} flight_name">${AirlineName}</strong> ${Flight}<br />\t\t\t\t\t\t\t                        \u8ba1\u5212\u673a\u578b\uff1a<span class="base_txtdiv"                                                        onmouseover="Ctrip.pages.showJumpInfo.call(Ctrip.pages, this, \'${i}\', \'NaN\', \'kind\')"                                                        onmouseout="Ctrip.pages.cancelInterval.call(Ctrip.pages);"                                                        >${CraftInfo.CraftType}{{if CraftInfo.CraftKindName.trim().length > 0}}\uff08${CraftInfo.CraftKindName}\uff09{{/if}}</span>\t\t\t\t\t\t                        </td>                                                {{each(j, z, total) FlightClassList}}                                                    {{if j == 0}}\t\t\t\t\t\t                                <td width="40">${ClassDesc}</td>\t\t\t\t\t\t                                <td width="125">\t\t\t\t\t\t\t                                <span class="base_price"><dfn>&yen;</dfn>${Price}</span>                                                            {{if IsRebate}}<span class="ico_refund"                                                                 onmouseover="Ctrip.pages.showJumpInfo.call(Ctrip.pages, this, \'${i}\', \'${j}\', \'back\');"                                                                onmouseout="Ctrip.pages.cancelInterval.call(Ctrip.pages);"                                                            >${RebateAmount}\u5143</span>{{/if}}<br />\t\t\t\t\t\t\t                                {{if parseInt(DisplayRate) == 10}}\u5168\u4ef7{{else}}${DisplayRate}\u6298{{/if}}\t\t\t\t\t\t\t                                <span class="base_txtdiv"                                                                 onmouseover="Ctrip.pages.showJumpInfo.call(Ctrip.pages, this, \'${i}\', \'${j}\', \'rate\')"                                                                onmouseout="Ctrip.pages.cancelInterval.call(Ctrip.pages);"                                                                >\u9000\u6539\u7b7e</span>\t\t\t\t\t\t                                </td>\t\t\t\t\t\t                                <td width="80">{{if Quantity < 10 && Quantity >= 5}}<span class="onlyone">\u7968\u91cf\u7d27\u5f20</span>{{else Quantity < 5}}<span class="onlyone">\u4ec5\u5269${Quantity}\u5f20\u7968</span>{{/if}}</td>\t\t\t\t\t\t                                <td align="center">\t\t\t\t\t\t\t                                <input type="button" {{if Ctrip.pages.params.searchType == \'D\' && Ctrip.pages.FlightList.status == \'go\'}} value="\u9009\u62e9\u8fd4\u7a0b" {{else}} value="\u9884 \u8ba2"{{/if}} class="btn_flt"                                                                 onclick="Ctrip.pages.selectFlightHandle.call(Ctrip.pages, this, \'${i}\', \'${j}\');"/>                                                            {{if total > 1}}\t\t\t\t\t\t\t                                    <a href="javascript:void(0);" class="tri_down"                                                                     onclick="Ctrip.pages.moreClass.call(Ctrip.pages, \'${i}\', this);">\u66f4\u591a\u8231\u4f4d</a>                                                            {{/if}}\t\t\t\t\t\t                                </td>                                                    {{/if}}                                                {{/each}}\t\t\t\t\t                        </tr>                                            {{each(z) FlightClassList}}                                                {{if z !== 0}}\t\t\t\t\t                                <tr style="display: none;" name="_FlightListAutoID_${i}">\t\t\t\t\t\t                                <td colspan="3"></td>\t\t\t\t\t\t                                <td>${ClassDesc}</td>\t\t\t\t\t\t                                <td>\t\t\t\t\t\t\t                                <span class="base_price"><dfn>&yen;</dfn>${Price}</span>\t\t\t\t\t\t\t                                {{if IsRebate}}<span class="ico_refund"                                                                onmouseover="Ctrip.pages.showJumpInfo.call(Ctrip.pages, this, \'${i}\', \'${z}\', \'back\')"                                                                onmouseout="Ctrip.pages.cancelInterval.call(Ctrip.pages);"                                                            >${RebateAmount}\u5143</span>{{/if}}<br />\t\t\t\t\t\t\t                                {{if parseInt(DisplayRate) == 10}}\u5168\u4ef7{{else}}${DisplayRate}\u6298{{/if}}\t\t\t\t\t\t\t                                <span class="base_txtdiv"                                                                onmouseover="Ctrip.pages.showJumpInfo.call(Ctrip.pages, this, \'${i}\', \'${z}\', \'rate\')"                                                                onmouseout="Ctrip.pages.cancelInterval.call(Ctrip.pages);"                                                            >\u9000\u6539\u7b7e</span>\t\t\t\t\t\t                                </td>\t\t\t\t\t\t                                <td>{{if Quantity < 10 && Quantity >= 5}}<span class="onlyone">\u7968\u91cf\u7d27\u5f20</span>{{else Quantity < 5}}<span class="onlyone">\u4ec5\u5269${Quantity}\u5f20\u7968</span>{{/if}}</td>\t\t\t\t\t\t                                <td align="center">\t\t\t\t\t\t\t                                <input type="button" {{if Ctrip.pages.params.searchType == \'D\' && Ctrip.pages.FlightList.status == \'go\'}} value="\u9009\u62e9\u8fd4\u7a0b" {{else}} value="\u9884 \u8ba2"{{/if}} class="btn_flt"                                                                 onclick="Ctrip.pages.selectFlightHandle.call(Ctrip.pages, this, \'${i}\', \'${z}\');" />\t\t\t\t\t\t                                </td>\t\t\t\t\t                                </tr>                                                {{/if}}                                            {{/each}}\t\t\t\t\t\t\t\t\t    </tbody>\t\t\t                        </table>\t\t                        </div>                            {{/each}}'
            }
        },
        showDepartPanle: function() {
            var a = document.getElementById("__selectedFlightContainer");
            a && this.selectedFlight.removeChild(a);
            var a = this.flightCache.go.flight,
                b = this.flightCache.go.classes,
                a = '<table>\t\t\t\t            <tr>\t\t\t\t\t            <td width="130">\t\t\t\t\t\t            <strong>' + this.getCityNameByCityCode(a.DCityCode) + " - " + this.getCityNameByCityCode(a.ACityCode) + "</strong><br />                                    <strong>" + a.ArriveTime.split("T")[0] + '</strong>\t\t\t\t\t            </td>\t\t\t\t\t            <td width="350">\t\t\t\t\t\t            <p>\t\t\t\t\t\t\t            ' + this.getAirCompByAirCompCode(a.AirlineCode) + " " + a.Flight + " \u8ba1\u5212\u673a\u578b " + (a.CraftInfo.CraftType || "") + " " + b.ClassDesc + "<br />\t\t\t\t\t\t\t            <strong>\u8d77\u98de</strong>\uff1a" + a.DepartSortTime + '\t\t\t\t\t\t\t            <span class="airport">' + this.getAirPortNameByAirPortCode(a.DPortCode) + (a.DBuildingName || "") + "</span>\t\t\t\t\t\t            </p>\t\t\t\t\t\t            <p>\t\t\t\t\t\t\t            <strong>\u5230\u8fbe</strong>\uff1a" + a.ArriveSortTime + '\t\t\t\t\t\t\t            <span class="airport">' + this.getAirPortNameByAirPortCode(a.APortCode) + (a.ABuildingName || "") + '</span>\t\t\t\t\t\t            </p>\t\t\t\t\t            </td>\t\t\t\t\t            <td align="center">\t\t\t\t\t\t            <span class="base_price"><dfn>&yen;</dfn>' + b.Price + "</span>\t\t\t\t\t\t            /\u6210\u4eba<br />\t\t\t\t\t\t            \uff08\u542b\u7a0e\u8d39\uff09\t\t\t\t\t            </td>\t\t\t\t            </tr>\t\t\t            </table>",
                b = document.createElement("div");
            b.id = "__selectedFlightContainer";
            b.innerHTML = a;
            this.selectedFlight.appendChild(b);
            this.selectedFlight.style.display = ""
        },
        eventBind: function() {
            var a = this;
            this.btnLowPricePrev.onclick = this.btnLowPriceNext.onclick = function(b) {
                var b = window.event || b,
                    c = b.srcElement || b.target;
                a.animateStatus.moveing ? a.animateStatus.moveQueue.push(function() {
                    a.lowPriceMove.call(a, c.id)
                }) : a.lowPriceMove.call(a, c.id)
            };
            for (var b = document.getElementById("fliterContainer").getElementsByTagName("ul"), c = document.getElementById("fliterContainer").getElementsByTagName("dd"), d = 0; d < c.length; d++) c[d].index = d,
                c[d].onmouseover = function() {
                    this.className = "active";
                    b[this.index].style.display = "block"
                },
                c[d].onmouseout = function() {
                    this.className = "";
                    b[this.index].style.display = "none"
                };
            this.fliterContainer.onclick = function(b) {
                var b = window.event || b,
                    c = b.srcElement || b.target;
                b.stopPropagation ? b.stopPropagation() : b.cancelBubble = !0;
                if (!a.loading && c.getAttribute("data-action") && 0 < c.getAttribute("data-action").trim().length) {
                    if ("ALL" == c.getAttribute("data-action").trim().split("__")[1]) for (var b = c.getAttribute("data-action").trim().split("__")[0], c = a.fliterContainer.getElementsByTagName("input"), d = 0; d < c.length; d++) c[d].getAttribute("data-action") && (0 < c[d].getAttribute("data-action").trim().length && b == c[d].getAttribute("data-action").trim().split("__")[0]) && (c[d].checked = !1);
                    a.intervalID && clearInterval(a.intervalID);
                    a.intervalID = setInterval(function() {
                            a.fliterWhat()
                        },
                        1E3)
                }
            };
            this.btnModifyFlight.onclick = function() {
                a.FlightList.status = "go";
                a.selectedFlight.style.display = "none";
                a.topTip.style.display = "none";
                a.showBaseInfo();
                a.searchParams();
                a.getLowPriceList();
                a.fliterWhat()
            };
            this.backInfoContainer.onmouseover = function() {
                Ctrip.pages.backInfoContainer.style.display = "";
                Ctrip.pages.ifra.style.display = ""
            };
            this.backInfoContainer.onmouseout = function() {
                Ctrip.pages.backInfoContainer.style.display = "none";
                Ctrip.pages.ifra.style.display = "none"
            };
            this.rateInfoContainer.onmouseover = function() {
                Ctrip.pages.rateInfoContainer.style.display = "";
                Ctrip.pages.ifra.style.display = ""
            };
            this.rateInfoContainer.onmouseout = function() {
                Ctrip.pages.rateInfoContainer.style.display = "none";
                Ctrip.pages.ifra.style.display = "none"
            };
            this.kindInfoContainer.onmouseover = function() {
                Ctrip.pages.kindInfoContainer.style.display = "";
                Ctrip.pages.ifra.style.display = ""
            };
            this.kindInfoContainer.onmouseout = function() {
                Ctrip.pages.kindInfoContainer.style.display = "none";
                Ctrip.pages.ifra.style.display = "none"
            };
            this.sort.time.tag.onclick = function() {
                document.getElementById("b_pricesort").className = "";
                document.getElementById("b_timesort").className = "ASC" == Ctrip.pages.sort.time.status ? "ico_down": "ico_up";
                a.sort.type = "time";
                Ctrip.pages.sort.time.status = "ASC" == Ctrip.pages.sort.time.status ? "DESC": "ASC";
                Ctrip.pages._sort.call(Ctrip.pages, "time")
            };
            this.sort.price.tag.onclick = function() {
                document.getElementById("b_timesort").className = "";
                document.getElementById("b_pricesort").className = "ASC" == Ctrip.pages.sort.price.status ? "ico_down": "ico_up";
                a.sort.type = "price";
                Ctrip.pages.sort.price.status = "ASC" == Ctrip.pages.sort.price.status ? "DESC": "ASC";
                Ctrip.pages._sort.call(Ctrip.pages, "price")
            };
            this.clearConditions.onclick = function() {
                for (var b = a.fliterContainer.getElementsByTagName("input"), c = 0, d = b.length; c < d; c++) b[c].getAttribute("data-action") && 0 < b[c].getAttribute("data-action").trim().length && (b[c].checked = !1);
                a.fliterWhat()
            }
        },
        searchParams: function() {
            this.lowPriceSearchParams = new Ctrip.Entitys.FlightLowPriceSearchParameters;
            this.lowPriceSearchParams.host = this.config.ajaxUrl;
            this.lowPriceSearchParams.method = Ctrip.config.method.JSONP;
            this.lowPriceSearchParams.userId = this.config.userId;
            this.lowPriceSearchParams.allianceId = this.config.allianceID;
            this.lowPriceSearchParams.sid = this.config.sID;
            this.lowPriceSearchParams.secretKey = this.config.secretKey;
            this.lowPriceSearchParams.dCity = "go" == this.FlightList.status ? this.params.departCity: this.params.arriveCity;
            this.lowPriceSearchParams.aCity = "go" == this.FlightList.status ? this.params.arriveCity: this.params.departCity;
            var a = "go" == this.FlightList.status ? this.params.departDate: this.params.backDate,
                b = 14 <= Math.ceil((new Date((new Date).formatStr("/"))).diff(a.isEffectiveDate())) ? 14 : Math.ceil((new Date((new Date).formatStr("/"))).diff(a.isEffectiveDate())),
                c = 29 - b,
                b = a.isEffectiveDate().next( - b),
                a = a.isEffectiveDate().next(c);
            this.lowPriceSearchParams.startDate = b;
            this.lowPriceSearchParams.endDate = a;
            this.flightSearchParams = new Ctrip.Entitys.FlightSearchParameters;
            this.flightSearchParams.host = this.config.ajaxUrl;
            this.flightSearchParams.method = Ctrip.config.method.JSONP;
            this.flightSearchParams.userId = this.config.userId;
            this.flightSearchParams.allianceId = this.config.allianceID;
            this.flightSearchParams.sid = this.config.sID;
            this.flightSearchParams.secretKey = this.config.secretKey;
            this.flightSearchParams.Routes = [{
                departCity: this.params.departCity,
                arriveCity: this.params.arriveCity,
                departDate: this.params.departDate
            }];
            "D" === this.params.searchType && this.flightSearchParams.Routes.push({
                departCity: this.params.arriveCity,
                arriveCity: this.params.departCity,
                departDate: this.params.backDate
            });
            this.flightSearchParams.departCity = this.params.departCity;
            this.flightSearchParams.arriveCity = this.params.arriveCity;
            this.flightSearchParams.departDate = this.params.departDate
        },
        lowPriceMove: function(a) {
            var b = $(this.selectedLowPriceItem).offset().width;
            switch (a) {
                case "btnPrev":
                    0 == this.pager.prev ? this.animate(this.lowPriceContainer, "marginLeft", b, "leftLess",
                        function() {}) : this.animate(this.lowPriceContainer, "marginLeft", b * this.pager.prev, "left",
                        function() {});
                    break;
                case "btnNext":
                    0 == this.pager.next ? this.animate(this.lowPriceContainer, "marginLeft", -b, "rightLess",
                        function() {}) : this.animate(this.lowPriceContainer, "marginLeft", -(b * this.pager.next), "right",
                        function() {})
            }
        },
        animate: function(a, b, c, d, e) {
            this.animateStatus.moveing = !0;
            var f = this;
            this.initPager(d);
            var g = this._countPath(Number(a.style[b].replace(/[px,em,pt]/gi, "")), c, d),
                i = setInterval(function() {
                        0 < g.length ? a.style[b] = g.shift() + "px": (f.animateStatus.moveing = !1, clearInterval(i), f.CorrectError(), e(1))
                    },
                    10)
        },
        CorrectError: function() {
            var a = document.getElementById("_lowPriceAutoID_" + (this.pager.current - (this.pager.pageSize - 1))) || document.getElementById("_lowPriceAutoID_current"),
                a = this.getLeft(document.getElementById("scrollcontainer")) - this.getLeft(a);
            this.lowPriceContainer.style.marginLeft = Number(this.lowPriceContainer.style.marginLeft.replace("px", "")) + a + "px"
        },
        _countPath: function(a, b, c) {
            var d = [];
            switch (c) {
                case "leftLess":
                    for (var e = 40,
                             c = 0; c < e; c++) d.push(Math.ceil(Ctrip.Tween.Back.easeOut(c, a, b, e)));
                    e = 20;
                    for (c = 0; c < e; c++) d.push(Math.ceil(Ctrip.Tween.Quart.easeOut(c, b, -b - 1, e)));
                    break;
                case "left":
                    for (c = 0; 100 > c; c++) d.push(Math.ceil(Ctrip.Tween.Quart.easeOut(c, a, b, 100)));
                    break;
                case "rightLess":
                    e = 40;
                    for (c = 0; c < e; c++) d.push(Math.ceil(Ctrip.Tween.Back.easeOut(c, a, b, e)));
                    e = 20;
                    for (c = 0; c < e; c++) d.push(Math.ceil(Ctrip.Tween.Quart.easeOut(c, b + a, -b, e)));
                    break;
                case "right":
                    for (c = 0; 100 > c; c++) d.push(Math.ceil(Ctrip.Tween.Quart.easeOut(c, a, b, 100)))
            }
            return d
        },
        getLeft: function(a) {
            var b = a.offsetLeft;
            null != a.offsetParent && (b += this.getLeft(a.offsetParent));
            return b
        },
        getTop: function(a) {
            var b = a.offsetTop;
            null != a.offsetParent && (b += this.getTop(a.offsetParent));
            return b
        },
        getClientHeight: function() {
            var a = document.body.clientHeight; - 1 != navigator.userAgent.indexOf("MSIE 6.0") ? a = document.body.clientHeight: -1 != navigator.userAgent.indexOf("MSIE") && (a = document.documentElement.offsetHeight); - 1 != navigator.userAgent.indexOf("Chrome") && (a = window.innerHeight); - 1 != navigator.userAgent.indexOf("Firefox") && (a = window.innerHeight);
            return a
        },
        initPager: function(a) {
            switch (a) {
                case "left":
                    this.pager.current -= this.pager.current - this.pager.pageSize >= this.pager.pageSize ? this.pager.pageSize: this.pager.current - this.pager.pageSize;
                    this.pager.prev = this.pager.current - this.pager.pageSize >= this.pager.pageSize ? this.pager.pageSize: this.pager.current - this.pager.pageSize;
                    break;
                case "right":
                    this.pager.current += this.pager.next,
                        this.pager.prev = this.pager.prev + this.pager.next >= this.pager.pageSize ? this.pager.pageSize: this.pager.prev + this.pager.next
            }
            this.pager.next = this.pager.total - this.pager.current >= this.pager.pageSize ? this.pager.pageSize: 0 < this.pager.total - this.pager.current ? this.pager.total - this.pager.current: 0
        },
        getWeekDay: function(a) {
            return "\u5468\u65e5 \u5468\u4e00 \u5468\u4e8c \u5468\u4e09 \u5468\u56db \u5468\u4e94 \u5468\u516d".split(" ")[(new Date(a.replace(/\-/gi, "/"))).getDay()]
        },
        getLowPriceList: function() {
            var a = this; (new Ctrip.XHR.FlightLowPriceSearch(this.lowPriceSearchParams)).then(function(b) {
                    if (b.IsSucceed) {
                        var c = [];
                        a.pager.total = b.FlightsLowestPricesList.length;
                        a.pager.current = a.pager.total >= a.pager.pageSize ? a.pager.pageSize: a.pager.total;
                        a.pager.next = a.pager.total - a.pager.current >= a.pager.pageSize ? a.pager.pageSize: 0 < a.pager.total - a.pager.current ? a.pager.total - a.pager.current: 0;
                        for (var d = 0,
                                 e = b.FlightsLowestPricesList.length,
                                 b = b.FlightsLowestPricesList; d < e; d++) {
                            var f = b[d][0];
                            f.canClick = !0;
                            var g = f.DepartDate.split("T")[0].isEffectiveDate().formatStr("-").split("-");
                            f.DepartDate = g[1] + "-" + g[2];
                            f.FullDate = g[0] + "-" + g[1] + "-" + g[2];
                            f.weekDay = a.getWeekDay(g[0] + "/" + g[1] + "/" + g[2]);
                            f.classname = ("go" == a.FlightList.status ? a.params.departDate: a.params.backDate).isEffectiveDate().formatStr("-").convertToTimeStamp() == (g[0] + "-" + g[1] + "-" + g[2]).convertToTimeStamp() ? "current": "";
                            c.push(b[d][0])
                        }
                        a.createLowPriceElement(c)
                    }
                },
                function() {})
        },
        createLowPriceElement: function(a) {
            this.lowPriceContainer.innerHTML = cQuery.tmpl.render(this.tmp().lowPrice, {
                data: a
            });
            this.selectedLowPriceItem = document.getElementById("_lowPriceAutoID_current");
            this.selectedLowPriceItem.index = this.selectedLowPriceItem.getAttribute("index");
            this.setLowPricePanelLocation()
        },
        setLowPricePanelLocation: function(a) {
            if (a) {
                this.pager.current = 7;
                this.selectedLowPriceItem.className = "";
                for (var b = this.lowPriceContainer.getElementsByTagName("a"), c = 0, d = b.length; c < d; c++) if (b[c].getAttribute("data-date") && 0 < b[c].getAttribute("data-date").trim().length && b[c].getAttribute("data-date").trim() == a) {
                    this.selectedLowPriceItem = b[c];
                    this.selectedLowPriceItem.index = b[c].getAttribute("index");
                    break
                }
                this.selectedLowPriceItem.className = "current"
            }
            c = Math.floor((this.selectedLowPriceItem.index - 1) / this.pager.pageSize) * this.pager.pageSize + 1;
            c = document.getElementById("_lowPriceAutoID_" + (c - (this.pager.total - (c - 1) < this.pager.pageSize ? this.pager.pageSize - (this.pager.total - (c - 1)) : 0))) || document.getElementById("_lowPriceAutoID_current");
            c = this.getLeft(document.getElementById("scrollcontainer")) - this.getLeft(c);
            this.lowPriceContainer.style.marginLeft = Number(this.lowPriceContainer.style.marginLeft.replace("px", "")) + c + "px";
            c = 0;
            for (a = Math.ceil(this.selectedLowPriceItem.index / this.pager.pageSize) - 1; c < a; c++) this.initPager("right")
        },
        changeLowPriceHandle: function(a) { ! this.loading && "current" != a.className && (this.topTip.style.display = "none", this.selectedLowPriceItem.className = "", this.selectedLowPriceItem = a, this.selectedLowPriceItem.index = Number(a.getAttribute("index")), a.className = "current", "go" == this.FlightList.status ? this.params.departDate = a.getAttribute("data-date") : "back" == this.FlightList.status && (this.params.backDate = a.getAttribute("data-date")), "D" == this.params.searchType.toUpperCase() && this.params.departDate.convertToTimeStamp() > this.params.backDate.convertToTimeStamp() && (this.params.backDate = this.params.departDate.isEffectiveDate().next(1)), a = {
            t: this.params.departCityName,
            q: this.params.arriveCityName,
            type: "S" == this.params.searchType ? "1": "2",
            date: this.params.departDate.isEffectiveDate().formatStr("-"),
            rtdate: this.params.backDate ? this.params.backDate.isEffectiveDate().formatStr("-") : null
        },
            window.QHLY ? QHLY.userBehavior(QHLY.ACTION.CHANGE_ROUTE, a) : window.location.href = "FlightSearchResult.html?type=" + a.type + "&t=" + a.t + "&q=" + a.q + "&date=" + a.date + (a.rtdate ? "&Rtdate=" + a.rtdate: "") + "&tmp=" + (new Date).getTime())
        },
        getFlightList: function() {
            var a = this;
            a.loading = !0;
            a.showLoading();
            this.nodata.style.display = "none";
            this.FlightList.go = [];
            this.FlightList.back = [];
            this.FlightList.result.go = [];
            this.FlightList.result.back = [];
            this.resetSortEle(); (new Ctrip.XHR.FlightSearch(this.flightSearchParams)).then(function(b) {
                    a.loading = !1;
                    a.loadingDiv.style.display = "none";
                    if (b.IsSucceed) {
                        for (var c = 0; c < b.FlightRoutes.length; c++) {
                            c ? (a.FlightList.back.AirlineInfoList = b.FlightRoutes[c].AirlineCodeList, a.FlightList.back.DPortInfoList = b.FlightRoutes[c].DPortCodeList, a.FlightList.back.APortInfoList = b.FlightRoutes[c].APortCodeList, a.FlightList.back.AcityID = b.FlightRoutes[c].ACityID, a.FlightList.back.DcityID = b.FlightRoutes[c].DCityID) : (a.FlightList.go.AirlineInfoList = b.FlightRoutes[c].AirlineCodeList, a.FlightList.go.DPortInfoList = b.FlightRoutes[c].DPortCodeList, a.FlightList.go.APortInfoList = b.FlightRoutes[c].APortCodeList, a.FlightList.go.AcityID = b.FlightRoutes[c].ACityID, a.FlightList.go.DcityID = b.FlightRoutes[c].DCityID);
                            for (var d = 0,
                                     e = b.FlightRoutes[c].FlightsList.length; d < e; d++) {
                                var f = b.FlightRoutes[c].FlightsList[d],
                                    g = f.ArriveTime.split("T")[1].split(":");
                                f.ArriveSortTime = g[0] + ":" + g[1];
                                g = f.TakeOffTime.split("T")[1].split(":");
                                f.DepartSortTime = g[0] + ":" + g[1];
                                f.CraftKindDesc = f.CraftKindDesc ? f.CraftKindDesc.replace("\u578b\u673a", "") : "";
                                f.state = "D" === a.searchType && !!c;
                                f.rebate = f.IsRebate ? f.RebateAmount: "0";
                                f.APortName = a.getAirPortNameByAirPortCode(f.APortCode);
                                f.DPortName = a.getAirPortNameByAirPortCode(f.DPortCode);
                                f.AirlineName = a.getAirCompByAirCompCode(f.AirlineCode);
                                f.CraftInfo = a.getCraftInfoByCraftID(f.CraftType);
                                c ? a.FlightList.back.push(f) : a.FlightList.go.push(f)
                            }
                        }
                        a.FlightList.result.go = a.FlightList.go.slice();
                        a.FlightList.result.back = a.FlightList.back.slice();
                        a.conditions();
                        a.fliterWhat()
                    } else a.errorMsg(b.ErrorMessage)
                },
                function(b) {
                    a.errorMsg(b)
                })
        },
        errorMsg: function(a) {
            if ( - 1 != a.indexOf("ctripCustomerInfomations:")) a = a.replace("ctripCustomerInfomations:", "");
            else switch (a) {
                case "Parameter Value Error: DepartDate in the second route can not earlier than the DepartDate of the first route.":
                    a = "<p>\u51fa\u9519\u5566\uff01 \u53bb\u7a0b\u65e5\u671f\u5927\u4e8e\u8fd4\u7a0b\u65e5\u671f</p>                            \u8bf7\u91cd\u65b0\u9009\u62e9\u6761\u4ef6\u540e\u518d\u8bd5\u3002";
                    break;
                default:
                    a = "<p>\u5f88\u62b1\u6b49\uff0c\u60a8\u641c\u7d22\u7684\u822a\u73ed\u5df2\u552e\u5b8c\u3002</p>\t\t\t                \u53bb\u770b\u770b\u5176\u4ed6\u65e5\u671f"
            }
            this.nodata.innerHTML = a;
            this.nodata.style.display = ""
        },
        conditions: function() {
            for (var a = [], b, c = b = 0, d = this.FlightList[this.FlightList.status].AirlineInfoList.length, e = this.FlightList[this.FlightList.status].AirlineInfoList; c < d; c++) a.push('<li><label class="label"><input data-action="airComp__' + e[c] + '" type="checkbox" />' + this.getAirCompByAirCompCode(e[c]) + "</label></li>"),
                b++;
            document.getElementById("condition_airComp").innerHTML = a.join("");
            1 < b ? document.getElementById("condition_airComp").parentNode.style.display = "": document.getElementById("condition_airComp").parentNode.style.display = "none";
            b = 0;
            a = [];
            c = 0;
            d = this.FlightList[this.FlightList.status].DPortInfoList.length;
            for (e = this.FlightList[this.FlightList.status].DPortInfoList; c < d; c++) a.push('<li><label class="label"><input   data-action="dAirport__' + e[c] + '" type="checkbox" />' + this.getAirPortNameByAirPortCode(e[c]).replace(/\u56fd\u9645/gi, "") + "</label></li>"),
                b++;
            document.getElementById("condition_dAirport").innerHTML = a.join("");
            1 < b ? document.getElementById("condition_dAirport").parentNode.style.display = "": document.getElementById("condition_dAirport").parentNode.style.display = "none";
            b = 0;
            a = [];
            c = 0;
            d = this.FlightList[this.FlightList.status].APortInfoList.length;
            for (e = this.FlightList[this.FlightList.status].APortInfoList; c < d; c++) a.push('<li><label class="label"><input   data-action="aAirport__' + e[c] + '" type="checkbox" />' + this.getAirPortNameByAirPortCode(e[c]).replace(/\u56fd\u9645/gi, "") + "</label></li>"),
                b++;
            document.getElementById("condition_aAirport").innerHTML = a.join("");
            1 < b ? document.getElementById("condition_aAirport").parentNode.style.display = "": document.getElementById("condition_aAirport").parentNode.style.display = "none"
        },
        moreClass: function(a, b) {
            var c, d;
            cQuery.browser.isIE ? (c = b.parentNode.parentNode.parentNode.getElementsByTagName("tr"), d = 1) : (c = document.getElementsByName("_FlightListAutoID_" + a), d = 0);
            if ("tri_down" == b.className.trim()) {
                for (len = c.length; d < len; d++) c[d].style.display = "";
                b.className = "tri_up"
            } else {
                for (len = c.length; d < len; d++) c[d].style.display = "none";
                b.className = "tri_down"
            }
        },
        fliterWhat: function() {
            this.fliterNodata.style.display = "none";
            clearInterval(this.intervalID);
            for (var a = this.fliterContainer.getElementsByTagName("input"), b = {
                    airComp: [],
                    flyTime: [],
                    planSize: [],
                    dAirport: [],
                    aAirport: []
                },
                     c = 0, d = a.length; c < d; c++) if (a[c].getAttribute("data-action") && 0 < a[c].getAttribute("data-action").trim().length && !0 == a[c].checked) {
                var e = a[c].getAttribute("data-action").trim().split("__");
                b[e[0]].push(e[1])
            }
            this.fliter(b)
        },
        fliter: function(a) {
            this.FlightList.result[this.FlightList.status] = [];
            for (var b = 0,
                     c = this.FlightList[this.FlightList.status].length; b < c; b++) {
                var d = !1,
                    e = !1,
                    f = !1,
                    g = !1,
                    i = !1,
                    j = this.FlightList[this.FlightList.status][b];
                0 == a.airComp.length && (d = !0);
                for (var h = 0; h < a.airComp.length; h++) d |= a.airComp[h] == j.AirlineCode;
                0 == a.flyTime.length && (e = !0);
                for (h = 0; h < a.flyTime.length; h++) var k = j.TakeOffTime.split("T")[1].split(":"),
                    m = a.flyTime[h].split("_")[0].split(":"),
                    l = a.flyTime[h].split("_")[1].split(":"),
                    n = 3600 * k[0] + 60 * k[1] + (k[2] || 0),
                    l = 3600 * l[0] + 60 * l[1] + (k[2] || 0),
                    e = e | (n > 3600 * m[0] + 60 * m[1] + (k[2] || 0) && n <= l);
                0 == a.planSize.length && (f = !0);
                for (h = 0; h < a.planSize.length; h++) f |= a.planSize[h] == j.CraftInfo.CraftKind;
                0 == a.dAirport.length && (g = !0);
                for (h = 0; h < a.dAirport.length; h++) g |= a.dAirport[h] == j.DPortCode;
                0 == a.aAirport.length && (i = !0);
                for (h = 0; h < a.aAirport.length; h++) i |= a.aAirport[h] == j.APortCode;
                d && (e && f && g && i) && this.FlightList.result[this.FlightList.status].push(j)
            }
            0 < this.FlightList.result[this.FlightList.status].length ? this._sort(this.sort.type) : (this.flightListContainer.innerHTML = "", this.fliterNodata.style.display = "")
        },
        _sort: function(a) {
            var b = this;
            this.FlightList.result[this.FlightList.status] = this.FlightList.result[this.FlightList.status].sort(function(c, d) {
                if ("time" == a) {
                    var e = c.TakeOffTime.split("T")[1].split(":"),
                        f = d.TakeOffTime.split("T")[1].split(":"),
                        e = 3600 * e[0] + 60 * e[1] + (e[2] || 0),
                        f = 3600 * f[0] + 60 * f[1] + (f[2] || 0);
                    return "ASC" == b.sort.time.status ? e - f: f - e
                }
                return "ASC" == b.sort.price.status ? c.FlightClassList[0].Price - d.FlightClassList[0].Price: d.FlightClassList[0].Price - c.FlightClassList[0].Price
            });
            this.flightListContainer.innerHTML = cQuery.tmpl.render(this.tmp().flightList, {
                data: this.FlightList.result[this.FlightList.status]
            })
        },
        showJumpInfo: function(a, b, c, d) {
            var e, f, g;
            if (this.jumpInfoIntervalID) {
                clearInterval(this.jumpInfoIntervalID);
                e = "back" == d ? document.getElementById("backInfoContainer") : "rate" == d ? document.getElementById("rateInfoContainer") : document.getElementById("kindInfoContainer");
                f = this.FlightList.result[this.FlightList.status][b];
                g = this.FlightList.result[this.FlightList.status][b].FlightClassList[c];
                a.offsets = {
                    left: this.getLeft(a),
                    top: this.getTop(a)
                };
                e.style.left = this.ifra.style.left = a.offsets.left + "px";
                e.style.top = this.ifra.style.top = a.offsets.top + 10 + "px";
                switch (d) {
                    case "back":
                        document.getElementById("_insaidElement_backAmount").innerHTML = g.RebateAmount + "\u5143";
                        break;
                    case "rate":
                        document.getElementById("_insaidElement_rernote").innerHTML = g.Rernote || "[\u6682\u65e0\u6570\u636e]";
                        document.getElementById("_insaidElement_refnote").innerHTML = g.Refnote || "[\u6682\u65e0\u6570\u636e]";
                        document.getElementById("_insaidElement_endNote").innerHTML = g.Endnote || "[\u6682\u65e0\u6570\u636e]";
                        break;
                    case "kind":
                        document.getElementById("array1").innerHTML = f.CraftInfo.CraftType || "[\u6682\u65e0]",
                            document.getElementById("array2").innerHTML = f.CraftInfo.Crafttype_ename || "[\u6682\u65e0]",
                            document.getElementById("array3").innerHTML = (f.CraftInfo.WidthLevel ? "W" == f.CraftInfo.WidthLevel.toUpperCase() ? "\u5bbd\u4f53": "\u7a84\u4f53": null) || "[\u6682\u65e0]",
                            document.getElementById("array4").innerHTML = f.CraftInfo.MinSeats || "[\u6682\u65e0]",
                            document.getElementById("array5").innerHTML = f.CraftInfo.MaxSeats || "[\u6682\u65e0]"
                }
                e.style.display = "";
                this.ifra.style.width = e.offsetWidth + "px";
                this.ifra.style.height = e.offsetHeight + "px";
                this.ifra.style.display = "";
                this.getClientHeight() < this.getTop(e) - document.documentElement.scrollTop + e.offsetHeight && (e.style.top = this.ifra.style.top = this.getTop(a) - e.offsetHeight + "px")
            } else this.jumpInfoIntervalID = setInterval(function() {
                    Ctrip.pages.showJumpInfo.call(Ctrip.pages, a, b, c, d)
                },
                500)
        },
        cancelInterval: function() {
            this.jumpInfoIntervalID && (clearInterval(this.jumpInfoIntervalID), this.jumpInfoIntervalID = null, this.backInfoContainer.style.display = "none", this.rateInfoContainer.style.display = "none", this.kindInfoContainer.style.display = "none", this.ifra.style.display = "none")
        },
        showLoading: function() {
            this.flightListContainer.innerHTML = "";
            this.loadingDiv.style.display = ""
        },
        getCityNameByCityCode: function(a) {
            return (a = Ctrip.mod.flight.address.match(RegExp("@[^|]*\\|([^|]*)\\|" + a + "\\|"))) ? a[1] : !1
        },
        getCityCodeByCityName: function(a, b) {
            var c = Ctrip.mod.flight.address.match(RegExp("@[^|]*\\|" + a + "\\|([^|]*)\\|"));
            return c ? c[1] : "d" == b ? "SHA": "BJS"
        },
        getAirPortNameByAirPortCode: function(a) {
            return Ctrip.mod.flight.airPort[a.trim()] || "[\u6682\u65e0]"
        },
        getAirCompByAirCompCode: function(a) {
            return Ctrip.mod.flight.airCompany[a.trim()] || "[\u6682\u65e0]"
        },
        getCraftInfoByCraftID: function(a) {
            var a = Ctrip.mod.flight.flightInfo.match(RegExp("@(" + a + ")\\|([^|]*)\\|([^|]*)\\|([^|]*)\\|([^|]*)\\|([^|]*)\\|")),
                b = {
                    CraftType: "",
                    Crafttype_ename: "",
                    WidthLevel: "",
                    MinSeats: "",
                    MaxSeats: "",
                    WidthLevel: "",
                    CraftKind: "",
                    CraftKindName: ""
                };
            return a ? {
                CraftType: a[1],
                Crafttype_ename: a[5],
                WidthLevel: a[2],
                MinSeats: a[3],
                MaxSeats: a[4],
                CraftKind: a[6],
                CraftKindName: "L" == a[6].toUpperCase() ? "\u5927": "M" == a[6].toUpperCase() ? "\u4e2d": "\u5c0f"
            }: b
        },
        resetSortEle: function() {
            this.sort.type = "time";
            this.sort.time.status = "ASC";
            this.sort.price.status = "ASC";
            document.getElementById("b_timesort").className = "ico_up";
            document.getElementById("b_pricesort").className = ""
        },
        unionLogin: function() {
            var a = new Date,
                a = a.getFullYear() + (9 < a.getMonth() + 1 ? a.getMonth() + 1 : "0" + (a.getMonth() + 1)) + (9 < a.getDate() ? a.getDate() : "0" + a.getDate()) + (9 < a.getHours() ? a.getHours() : "0" + a.getHours()) + (9 < a.getMinutes() ? a.getMinutes() : "0" + a.getMinutes()) + (9 < a.getSeconds() ? a.getSeconds() : "0" + a.getSeconds());
            return {
                SSOh: md5("uHzgx0YWAq+1Q3HsdW+wHR+SXh/YEX6j1itac4bf5ghYZ8OkgagJiBlcKTRVaqJZT5QZmjBm6sGq/JgBYTK5UA==__" + a),
                SSOt: a
            }
        },
        selectFlightHandle: function(a, b, c) {
            this.flightCache[this.FlightList.status] = {
                flight: this.FlightList.result[this.FlightList.status][b],
                classes: this.FlightList.result[this.FlightList.status][b].FlightClassList[c]
            };
            if ("D" === this.params.searchType && "go" === this.FlightList.status) this.FlightList.status = "back",
                this.topTip.style.display = "none",
                this.searchParams(),
                this.getLowPriceList(),
                this.showDepartPanle(),
                this.showBaseInfo(),
                this.conditions(),
                this.fliterWhat(),
                QHLY && QHLY.userBehavior && QHLY.userBehavior(QHLY.ACTION.SELECT_FLIGHT, {});
            else {
                if ("D" === this.params.searchType && "back" === this.FlightList.status) {
                    var c = this.flightCache.go.flight,
                        d = this.flightCache.go.classes,
                        e = this.flightCache.back.flight,
                        f = this.flightCache.back.classes,
                        a = this.unionLogin(),
                        b = "http://" + this.config.redirectUrl + "/union/CtripRedirect.aspx?TypeID=23&AllianceID=" + this.config.allianceID + "&SID=" + this.config.sID + "&Ouid=",
                        b = b + ("&SSOh=" + a.SSOh + "&SSOt=" + a.SSOt),
                        b = b + ("&ACity1=" + c.ACityCode),
                        b = b + ("&DCity1=" + c.DCityCode),
                        b = b + ("&ACity2=" + e.ACityCode),
                        b = b + ("&DCity2=" + e.DCityCode),
                        b = b + ("&DDate1=" + c.TakeOffTime.split("T")[0]),
                        b = b + ("&DDate2=" + e.TakeOffTime.split("T")[0]),
                        b = b + ("&Flight1=" + c.Flight),
                        b = b + ("&Flight2=" + e.Flight),
                        b = b + "&FlightWay=D&PassengerQuantity=1&PassengerType=ADU&SendTicketCityID=1" + ("&Subclass1=" + d.SubClass),
                        b = b + ("&Subclass2=" + f.SubClass),
                        b = b + "&ProductType1=&ProductType2=" + ("&PolicyID1=" + c.PolicyID),
                        b = b + ("&PolicyID2=" + e.PolicyID),
                        b = b + ("&Price1=" + d.Price),
                        b = b + ("&Price2=" + f.Price);
                    QHLY && QHLY.userBehavior && QHLY.userBehavior(QHLY.ACTION.ORDER_TICKETS, {})
                } else c = this.flightCache.go.flight,
                    d = this.flightCache.go.classes,
                    QHLY && QHLY.userBehavior && QHLY.userBehavior(QHLY.ACTION.ORDER_TICKETS, {}),
                    a = this.unionLogin(),
                    b = "http://" + this.config.redirectUrl + "/union/CtripRedirect.aspx?TypeID=22&AllianceID=" + this.config.allianceID + "&SID=" + this.config.sID + "&Ouid=",
                    b += "&SSOh=" + a.SSOh + "&SSOt=" + a.SSOt,
                    b += "&ACity1=" + c.ACityCode,
                    b += "&DCity1=" + c.DCityCode,
                    b += "&DDate1=" + c.TakeOffTime.split("T")[0],
                    b += "&Flight1=" + c.Flight,
                    b = b + "&FlightWay=S&PassengerQuantity=1&PassengerType=ADU&SendTicketCityID=1" + ("&Subclass1=" + d.SubClass),
                    b = b + "&ProductType1=" + ("&Price1=" + d.Price),
                    b += "&PolicyID1=" + c.PolicyID;
                window.open(b)
            }
        }
    })
})(Ctrip.pages);