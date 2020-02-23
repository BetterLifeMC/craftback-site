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

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}

function addServersToNav(){
    for (var i = 0; i < servers["servers"].length; i++) {
        document.getElementById("serverDropdownList").innerHTML +=
            '<a id="serverDropdown'+i+'" href="servers.html?fingerprint='+servers["servers"][i].fingerprint+
            '" class="w3-bar-item w3-button dropdown"> '+servers["servers"][i].name+'</a>';
            if(servers["servers"][i].fingerprint == $.urlParam("fingerprint")){
                document.getElementById("serverDropdown"+i).classList.remove("dropdown");
                document.getElementById("serverDropdown"+i).classList.add("w3-metro-darken");
            }
    }
}
function addServersToMainPage(){
    element = document.getElementById("bigcontainer");
    for (var i = 0; i < servers["servers"].length; i++) {
        if(i % 3 == 0){
            element.innerHTML += "            <div id='main' class='w3-row'>";
            main = document.getElementById("main");

        }
            main.innerHTML +="            <div class='info'>"+
"                <h2>"+servers["servers"][i].name+"</h2>"+
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
        if((i+1) %3 == 0){
            element.innerHTML += "          </div>";
        }
    }
}

index = serverFingerPrints.indexOf($.urlParam("fingerprint"));
hostname = serverHostnames[index];
port = serverPorts[index];
console.log("Server fingerprint index: " + index);

function getChats(){
    $.get({
        url: 'http://'+hostname+':'+port+'/getLog',
        dataType: 'text',
        type: 'GET',
        async: true,
        statusCode: {
            404: function (response) {
                alert(404);
            },
            200: function (response) {
                document.getElementById("logConsole").innerHTML = response;
            }
        },
        error: function (jqXHR, status, errorThrown) {
        }
    });
    setTimeout(getChats, 1000);
}
$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: 'http://'+hostname+':'+port+'/sendMessage/',
            data: $('form').serialize(),
            success: function () {
                document.getElementById('messageBox').value="";
            }
        });
    });
    document.getElementById('messageBox').value="";
 });

var playerUUIDList;
var playerNameList;
var currentPlayerCount;
var playerArrayUUIDList;
var PlayerArrayNameList;

function getPlayerInfo(){
    $.get({
        url: 'http://'+hostname+':'+port+'/getPlayerUUIDS',
        dataType: 'text',
        type: 'GET',
        async: true,
        statusCode: {
            404: function (response) {
                alert(404);
            },
            200: function (response) {
                playerUUIDList = JSON.parse(response);

                currentPlayerCount = playerUUIDList.length;
                if(currentPlayerCount == undefined){
                    currentPlayerCount = 0;
                }
                document.getElementById("currentPlayerCount").innerHTML = currentPlayerCount;
            }
        },
        error: function (jqXHR, status, errorThrown) {
        }
    });

    $.get({
        url: 'http://'+hostname+':'+port+'/getPlayerNames',
        dataType: 'text',
        type: 'GET',
        async: true,
        statusCode: {
            404: function (response) {
                alert(404);
            },
            200: function (response) {
                playerNameList = JSON.parse(response);

            }
        },
        error: function (jqXHR, status, errorThrown) {
        }
    });

    document.getElementById("allPlayers").innerHTML = "";
    try{
        if(playerUUIDList[0].length > 0){
            for (var i = 0; i < currentPlayerCount; i++) {
                document.getElementById("allPlayers").innerHTML += "<span id='playerHead'>" + playerNameList[i]+"</span><img src='https://minotar.net/avatar/"+playerUUIDList[i]+"/32.png' id='playerHeadImage' alt='Skin head'></img><br><hr>";
            }
        }else{
            currentPlayerCount = 0;
        }
        document.getElementById("currentPlayerCount").innerHTML = currentPlayerCount;

    }catch(TypeError){
        currentPlayerCount = 0;
        document.getElementById("currentPlayerCount").innerHTML = currentPlayerCount;
    }

    setTimeout(getPlayerInfo, 1000);
}
function updateServerInfo(){
    name = servers["servers"][index].name
    document.getElementById("maxPlayers").innerHTML = servers["servers"][index].maxplayers;
    document.getElementById("serverName").innerHTML = name;
    window.document.title = "CraftBack - " + name;
}
