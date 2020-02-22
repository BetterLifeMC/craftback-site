function loadDarkMode(){
    if(document.cookie == "darkmode"){
        document.getElementsByTagName("body")[0].style.backgroundColor = "#111";
        document.getElementsByTagName("body")[0].style.color = "#ddd";
        var length = document.getElementsByClassName("info").length;
        for (var i = 0; i < length; i++) {
            document.getElementsByClassName("info")[i].style.border = "1px solid #999";
        }
        if(document.getElementsByTagName("input")[0] != undefined){
            document.getElementsByTagName("input")[0].style.backgroundColor = "#333"
            document.getElementsByTagName("input")[0].style.color = "#aaa";
        }
        length = document.getElementsByTagName("a").length;
        for (var i = 0; i < length; i++) {
            document.getElementsByTagName("a")[i].style.backgroundColor = "#111";
            document.getElementsByTagName("a")[i].style.color = "#aaa";
        }
    }else{
        document.getElementsByTagName("body")[0].style.backgroundColor = "";
        document.getElementsByTagName("body")[0].style.color = "";
        var length = document.getElementsByClassName("info").length;
        for (var i = 0; i < length; i++) {
            document.getElementsByClassName("info")[i].style.border = "1px solid #fff";
        }
        if(document.getElementsByTagName("input")[0] != undefined){
            document.getElementsByTagName("input")[0].style.backgroundColor = "#fff";
            document.getElementsByTagName("input")[0].style.color = "#000";
        }
        length = document.getElementsByTagName("a").length;
        for (var i = 0; i < length; i++) {
            document.getElementsByTagName("a")[i].style.backgroundColor = "#fff";
            document.getElementsByTagName("a")[i].style.color = "#000";
        }
    }
}
function toggleDarkMode(){
    if(document.cookie == "darkmode"){
        document.cookie = "lightmode";
    }else{
        document.cookie = "darkmode";
    }
    loadDarkMode();
}
function loadServerInfo(HostNameArray, PortArray){

    //TODO:  Implement this correctly.  This be bad.
    for (var i = 0; i < HostNameArray.length; i++) {
        $.get({
            url: 'http://'+HostNameArray[i]+':'+PortArray[i]+'/getPlayerNames',
            dataType: 'text',
            type: 'GET',
            async: false,
            statusCode: {
                404: function (response) {
                    alert(404);
                },
                200: function (response) {
                    results.push(JSON.parse(response));
                    console.log(response);
                    console.log(PortArray[i]);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log("Server " + HostNameArray[i]+':'+PortArray[i] + " Failed to respond on time!");
                results.push([0]);
                results[i] = [];
            }
        });
    }
    for (var i = 0; i < results.length; i++) {
        document.getElementById("currentPlayerCount"+i).innerHTML = results[i].length;

    }
}
