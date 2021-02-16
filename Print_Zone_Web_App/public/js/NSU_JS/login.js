$(document).ready(function () {
    setInterval(function () {
        ctoday += 1000;
    }, 1000);
    startTime();
});

function startTime() {
    var today = new Date(ctoday);
    var montharray = Array("Jan", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ogu", "Sep", "Oct", "Nov", "Des");
    var h = today.getHours();
    var ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12;
    h = h ? h : 12;
    var m = today.getMinutes();
    var s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = "Current Server Time: " + h + ":" + m + ":" + s + " " + ampm;
    setTimeout(startTime, 1000);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }
    return i;
}

function showEmail() {
    document.getElementById("phonemask").style.display = "none";
    document.getElementById("emailmask").style.display = "block";
}

function showPhone() {
    document.getElementById("emailmask").style.display = "none";
    document.getElementById("phonemask").style.display = "block";
}