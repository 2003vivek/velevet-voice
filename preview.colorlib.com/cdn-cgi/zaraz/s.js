(function(w, d) {
    zaraz.debug = (dV = "") => {
        document.cookie = `zarazDebug=${dV}; path=/`;
        location.reload()
    };
    window.zaraz._al = function(di, dj, dk) {
        w.zaraz.listeners.push({
            item: di,
            type: dj,
            callback: dk
        });
        di.addEventListener(dj, dk)
    };
    zaraz.preview = (dl = "") => {
        document.cookie = `zarazPreview=${dl}; path=/`;
        location.reload()
    };
    zaraz.i = function(dM) {
        const dN = d.createElement("div");
        dN.innerHTML = unescape(dM);
        const dO = dN.querySelectorAll("script");
        for (let dP = 0; dP < dO.length; dP++) {
            const dQ = d.createElement("script");
            dO[dP].innerHTML && (dQ.innerHTML = dO[dP].innerHTML);
            for (const dR of dO[dP].attributes) dQ.setAttribute(dR.name, dR.value);
            d.head.appendChild(dQ);
            dO[dP].remove()
        }
        d.body.appendChild(dN)
    };
    zaraz.f = async function(dS, dT) {
        const dU = {
            credentials: "include",
            keepalive: !0,
            mode: "no-cors"
        };
        if (dT) {
            dU.method = "POST";
            dU.body = new URLSearchParams(dT);
            dU.headers = {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }
        return await fetch(dS, dU)
    };
    window.zaraz._p = async bv => new Promise((bw => {
        if (bv) {
            bv.e && bv.e.forEach((bx => {
                try {
                    new Function(bx)()
                } catch (by) {
                    console.error(`Error executing script: ${bx}\n`, by)
                }
            }));
            Promise.allSettled((bv.f || []).map((bz => fetch(bz[0], bz[1]))))
        }
        bw()
    }));
    zaraz.pageVariables = {};
    zaraz.__zcl = zaraz.__zcl || {};
    zaraz.track = async function(dq, dr, ds) {
        return new Promise(((dt, du) => {
            const dv = {
                name: dq,
                data: {}
            };
            for (const dw of [localStorage, sessionStorage]) Object.keys(dw || {}).filter((dy => dy.startsWith("_zaraz_"))).forEach((dx => {
                try {
                    dv.data[dx.slice(7)] = JSON.parse(dw.getItem(dx))
                } catch {
                    dv.data[dx.slice(7)] = dw.getItem(dx)
                }
            }));
            Object.keys(zaraz.pageVariables).forEach((dz => dv.data[dz] = JSON.parse(zaraz.pageVariables[dz])));
            Object.keys(zaraz.__zcl).forEach((dA => dv.data[`__zcl_${dA}`] = zaraz.__zcl[dA]));
            dv.data.__zarazMCListeners = zaraz.__zarazMCListeners;
            //
            dv.data = { ...dv.data,
                ...dr
            };
            dv.zarazData = zarazData;
            fetch("/cdn-cgi/zaraz/t", {
                credentials: "include",
                keepalive: !0,
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(dv)
            }).catch((() => {
                //
                return fetch("/cdn-cgi/zaraz/t", {
                    credentials: "include",
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(dv)
                })
            })).then((function(dC) {
                zarazData._let = (new Date).getTime();
                dC.ok || du();
                return 204 !== dC.status && dC.json()
            })).then((async dB => {
                await zaraz._p(dB);
                "function" == typeof ds && ds()
            })).finally((() => dt()))
        }))
    };
    zaraz.set = function(dD, dE, dF) {
        try {
            dE = JSON.stringify(dE)
        } catch (dG) {
            return
        }
        prefixedKey = "_zaraz_" + dD;
        sessionStorage && sessionStorage.removeItem(prefixedKey);
        localStorage && localStorage.removeItem(prefixedKey);
        delete zaraz.pageVariables[dD];
        if (void 0 !== dE) {
            dF && "session" == dF.scope ? sessionStorage && sessionStorage.setItem(prefixedKey, dE) : dF && "page" == dF.scope ? zaraz.pageVariables[dD] = dE : localStorage && localStorage.setItem(prefixedKey, dE);
            zaraz.__watchVar = {
                key: dD,
                value: dE
            }
        }
    };
    for (const {
            m: dH,
            a: dI
        } of zarazData.q.filter((({
            m: dJ
        }) => ["debug", "set"].includes(dJ)))) zaraz[dH](...dI);
    for (const {
            m: dK,
            a: dL
        } of zaraz.q) zaraz[dK](...dL);
    delete zaraz.q;
    delete zarazData.q;
    zaraz.fulfilTrigger = function(cI, cJ, cK, cL) {
        zaraz.__zarazTriggerMap || (zaraz.__zarazTriggerMap = {});
        zaraz.__zarazTriggerMap[cI] || (zaraz.__zarazTriggerMap[cI] = "");
        zaraz.__zarazTriggerMap[cI] += "*" + cJ + "*";
        zaraz.track("__zarazEmpty", { ...cK,
            __zarazClientTriggers: zaraz.__zarazTriggerMap[cI]
        }, cL)
    };
    window.dataLayer = w.dataLayer || [];
    zaraz._processDataLayer = es => {
        for (const et of Object.entries(es)) zaraz.set(et[0], et[1], {
            scope: "page"
        });
        if (es.event) {
            if (zarazData.dataLayerIgnore && zarazData.dataLayerIgnore.includes(es.event)) return;
            let eu = {};
            for (let ev of dataLayer.slice(0, dataLayer.indexOf(es) + 1)) eu = { ...eu,
                ...ev
            };
            delete eu.event;
            es.event.startsWith("gtm.") || zaraz.track(es.event, eu)
        }
    };
    const er = w.dataLayer.push;
    Object.defineProperty(w.dataLayer, "push", {
        configurable: !0,
        enumerable: !1,
        writable: !0,
        value: function(...ew) {
            let ex = er.apply(this, ew);
            zaraz._processDataLayer(ew[0]);
            return ex
        }
    });
    dataLayer.forEach((ey => zaraz._processDataLayer(ey)));
    zaraz._cts = () => {
        zaraz._timeouts && zaraz._timeouts.forEach((bB => clearTimeout(bB)));
        zaraz._timeouts = []
    };
    zaraz._rl = function() {
        w.zaraz.listeners && w.zaraz.listeners.forEach((bC => bC.item.removeEventListener(bC.type, bC.callback)));
        window.zaraz.listeners = []
    };
    history.pushState = function() {
        try {
            zaraz._rl();
            zaraz._cts && zaraz._cts()
        } finally {
            History.prototype.pushState.apply(history, arguments);
            setTimeout((() => {
                zarazData.l = d.location.href;
                zarazData.t = d.title;
                zaraz.pageVariables = {};
                zaraz.__zarazMCListeners = {};
                zaraz.track("__zarazSPA")
            }), 100)
        }
    };
    history.replaceState = function() {
        try {
            zaraz._rl();
            zaraz._cts && zaraz._cts()
        } finally {
            History.prototype.replaceState.apply(history, arguments);
            setTimeout((() => {
                zarazData.l = d.location.href;
                zarazData.t = d.title;
                zaraz.pageVariables = {};
                zaraz.track("__zarazSPA")
            }), 100)
        }
    };
    zaraz._c = fU => {
        const {
            event: fV,
            ...fW
        } = fU;
        zaraz.track(fV, { ...fW,
            __zarazClientEvent: !0
        })
    };
    zaraz._syncedAttributes = ["altKey", "clientX", "clientY", "pageX", "pageY", "button"];
    zaraz.__zcl.track = !0;
    d.addEventListener("visibilitychange", (fX => {
        zaraz._c({
            event: "visibilityChange",
            visibilityChange: [{
                state: d.visibilityState,
                timestamp: (new Date).getTime()
            }]
        }, 1)
    }));
    zaraz.__zcl.visibilityChange = !0;
    zaraz.__zarazMCListeners = {
        "google-analytics_v4_20ac": ["visibilityChange"]
    };
    zaraz._p({
        "e": ["(function(w,d){w.zarazData.executed.push(\"Pageview\");})(window,document)"],
        "f": [
            ["https://stats.g.doubleclick.net/g/collect?t=dc&aip=1&_r=3&v=1&_v=j86&tid=G-SEKJ4E9T4H&cid=43105115-fbfa-426c-9b06-f6b0a43d7de1&_u=KGDAAEADQAAAAC%7E&z=846649554", {}]
        ]
    })
})(window, document);