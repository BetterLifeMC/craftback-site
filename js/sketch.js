function toggleDarkMode(){
    if(document.cookie == "darkmode"){
        document.getElementsByTagName("body")[0].style.backgroundColor = "#111";
        document.getElementsByTagName("body")[0].style.color = "#ddd";
        var length = document.getElementsByClassName("info").length;
        for (var i = 0; i < length; i++) {
            document.getElementsByClassName("info")[i].style.border = "1px solid #999";
        }
        if(document.getElementsByTagName("input")[0].length != undefined){
            document.getElementsByTagName("input")[0].style.backgroundColor = "#333"
            document.getElementsByTagName("input")[0].style.color = "#aaa";
        }
    }
}
