servers =
{
    "servers" : [
        {
            "fingerprint":"1234567890",
            "hostname":"games01-serv",
            "port":"8080",
            "name":"BungeeCord"
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

function addServersToPage(){
    for (var i = 0; i < servers["servers"].length; i++) {
        document.getElementById("serverDropdownList").innerHTML +=
            '<a href="servers.html?'+servers["servers"][i].fingerprint+
            '" class="w3-bar-item w3-button"> '+servers["servers"][i].name+'</a>';
    }
}
