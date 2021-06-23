var styleSets = function styleSets() {
    var vh = window.innerHeight * 0.01;
    var vw = window.innerWidth * 0.01;
    document.documentElement.style.setProperty("--vh", `${vh}px`);
    document.documentElement.style.setProperty("--vw", `${vw}px`);

    if (window.innerWidth > 888.888) {
        var scpad = (window.innerWidth - 800) / 2;
    } else if (window.innerWidth > 438 && window.innerWidth < 630) {
        var scpad = (window.innerWidth - 394) / 2;
    }
    else {
        var scpad = 5 * vw;
    }
    document.documentElement.style.setProperty("--scpad", `${scpad}px`);

    if (window.innerWidth > 1300) {
        var mcpad = (window.innerWidth - 1170) / 2;
    } else {
        var mcpad = 5 * vw;
    }
    document.documentElement.style.setProperty("--mcpad", `${mcpad}px`);
    
    var lcpad = 5 * vw;
    document.documentElement.style.setProperty("--lcpad", `${lcpad}px`);
}

window.addEventListener("load", styleSets, false);
window.addEventListener("resize", styleSets, false);