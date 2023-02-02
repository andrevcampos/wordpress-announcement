// JavaScript Document

function myFunction() {
var x = document.getElementById("status").checked;
if (x == true){
    document.getElementById("announcementplugininformation").style.display = "block";
}else{
    document.getElementById("announcementplugininformation").style.display = "none";
}
console.log(x);
}

function buttonsave() {
    var x = document.getElementById("status").checked;
    var title = document.getElementById("apititle").value;
    var subtitle = document.getElementById("apisubtitle").value;
    var sizesmall = document.getElementById("sizesmall").checked;
    var sizemedium = document.getElementById("sizemedium").checked;
    var sizelarge = document.getElementById("sizelarge").checked;

    var banner01 = document.getElementById("banner01").checked;
    var banner02 = document.getElementById("banner02").checked;
    var banner03 = document.getElementById("banner03").checked;

    var bcolor = document.getElementById("bcolor").checked;
    var bimage = document.getElementById("bimage").checked;
  

    var titlecolor = document.getElementById("apititlecolor").value.substring(1);
    var subtitlecolor = document.getElementById("apisubtitlecolor").value.substring(1);
    var backgroundcolor = document.getElementById("apibackgroundcolor").value.substring(1);
    if (x == true){
        x = "on";
    }else{
        x = "off";
    }
    if (sizesmall == true){
        size = "small";
    }
    if (sizemedium == true){
        size = "medium";
    }
    if (sizelarge == true){
        size = "large";
    }
    if (banner01 == true){
        banner = "banner01";
    }
    if (banner02 == true){
        banner = "banner02";
    }
    if (banner03 == true){
        banner = "banner03";
    }
    if (bcolor == true){
        btype = "color";
    }
    if (bimage == true){
        btype = "image";
    }
    window.location.href='?page=my-menu&status=' + x + '&title=' + title + "&subtitle=" + subtitle + "&size=" + size + "&titlecolor=" + titlecolor + "&subtitlecolor=" + subtitlecolor + "&backgroundcolor=" + backgroundcolor + "&banner=" + banner + "&btype=" + btype;
}