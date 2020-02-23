servers =
{
    "servers" : [
        {
            "fingerprint":"1234567890",
            "hostname":"games01-serv",
            "port":"8083",
            "name":"BungeeCord",
            "maxplayers":"-1"
        }
    ]
}

var serverPorts = [];
var serverHostnames = [];
var serverFingerPrints = [];

for (var i = 0; i < servers["servers"].length; i++) {
    serverPorts.push(servers["servers"][i].port);
    serverHostnames.push(servers["servers"][i].hostname);
    serverFingerPrints.push(servers["servers"][i].fingerprint);
}

function addServersToNav(){
    for (var i = 0; i < servers["servers"].length; i++) {
        document.getElementById("serverDropdownList").innerHTML +=
            '<a href="servers.html?'+servers["servers"][i].fingerprint+
            '" class="w3-bar-item w3-button"> '+servers["servers"][i].name+'</a>';
    }
}
function addServersToMainPage(){
    element = document.getElementById("bigcontainer");
    for (var i = 0; i < servers["servers"].length; i++) {
        if(i % 3 == 0){
            element.innerHTML +="            <div class='info'>"+
"                <h2>CHANGEME</h2>"+
"                <hr>"+
"                <span class='serverInfo'>Server hostname: <span style='float:right'>"+serverHostnames[i]+"</span></span>"+
"                <br>"+
"                <br>"+
"                <span class='serverInfo'>Max players: <span style='float:right'>"+servers["servers"][i].maxplayers+"</span></span>"+
"                <br>"+
"                <br>"+
"                <span class='serverInfo'>Current players: <span style='float:right' id='currentPlayerCount"+i+"'> </span></span>"+
"                <br>"+
"                <br>"+
"            </div>";
        }
    }
}
