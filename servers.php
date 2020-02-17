<?php
    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Servers` WHERE fingerprint ='".$_GET['fingerprint']."'");
    $names = $sqlquery->get_names();
    $ports = $sqlquery->get_ports();
    $fingerprints = $sqlquery->get_fingerprints();
    $hostnames = $sqlquery->get_hostnames();
    $id = $sqlquery->get_id();
    $maxplayers = $sqlquery->get_maxplayers();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>CraftBack - <?php echo $names[0]; ?></title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            // Snatched from https://happycoding.io/tutorials/java-server/post#polling-with-ajax
            function getChats(){
                $.get({
                    url: 'http://<?php echo $hostnames[0]; ?>:<?php echo $ports[0]; ?>/getLog',
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
                        url: 'http://<?php echo $hostnames[0]; ?>:<?php echo $ports[0]; ?>/sendMessage/',
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
                    url: 'http://<?php echo $hostnames[0]; ?>:<?php echo $ports[0]; ?>/getPlayerUUIDS',
                    dataType: 'text',
                    type: 'GET',
                    async: true,
                    statusCode: {
                        404: function (response) {
                            alert(404);
                        },
                        200: function (response) {
                            playerUUIDList = response;
                            playerUUIDList = playerUUIDList.replace("]","");
                            playerUUIDList = playerUUIDList.replace("[","");
                            playerUUIDList = playerUUIDList.replace("\n","");
                            playerArrayUUIDList = playerUUIDList.split(", ");
                            currentPlayerCount = playerArrayUUIDList.length;
                        }
                    },
                    error: function (jqXHR, status, errorThrown) {
                    }
                });

                $.get({
                    url: 'http://<?php echo $hostnames[0]; ?>:<?php echo $ports[0]; ?>/getPlayerNames',
                    dataType: 'text',
                    type: 'GET',
                    async: true,
                    statusCode: {
                        404: function (response) {
                            alert(404);
                        },
                        200: function (response) {
                            playerNameList = response;
                            playerNameList = playerNameList.replace("]","");
                            playerNameList = playerNameList.replace("[","");
                            playerNameList = playerNameList.replace("\n","");
                            PlayerArrayNameList = playerNameList.split(", ");
                        }
                    },
                    error: function (jqXHR, status, errorThrown) {
                    }
                });

                document.getElementById("allPlayers").innerHTML = "";
                try{
                    if(playerArrayUUIDList[0].length > 0){
                        for (var i = 0; i < currentPlayerCount; i++) {
                            document.getElementById("allPlayers").innerHTML += "<span id='playerHead'>" + PlayerArrayNameList[i]+"</span><img src='https://minotar.net/avatar/"+playerArrayUUIDList[i]+"/32.png' id='playerHeadImage' alt='Skin head'></img><br><hr>";
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
        </script>
    </head>
    <body onload="getChats();getPlayerInfo();">
        <div class="w3-bar w3-metro-darken">
            <a href="./index.php" class="w3-button w3-green w3-bar-item">Home</a>
            <i class='fas fa-adjust'></i>
            <div class="w3-dropdown-hover">
                <button class="w3-button">Git</button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a href="https://gitlab.com/gt3ch1/craftback" class="w3-bar-item w3-button" >CraftBack</a>
                    <a href="https://gitlab.com/gt3ch1/craftback-site" class="w3-bar-item w3-button" >CraftBack UI</a>
                </div>
            </div>
            <button class="w3-button"><i class="fas fa-adjust">
        </div>

        <div id="main" class="w3-row w3-animate-opacity" style="width=300px;">
            <div>
                <div class="messageBox w3-threequarter w3-hover-shadow">
                    <form>
                        <input id="messageBox" class="messageBox " placeholder="Command »" type="text" name="message" />
                    </form>
                </div>
            </div>
            <div class="logConsole w3-threequarter w3-row">
                <div id="logConsole" style="white-space:pre;"></div>
            </div>
            <div class="playerBox w3-quarter w3-container w3-row">
                <span>Server Name: <?php echo $names[0]; ?></span>
                <br>
                <span>Current Players: (<span id="currentPlayerCount"></span>/<?php echo $maxplayers[0]; ?>)</span>
                <hr>
                <div id="allPlayers">
                </div>
            </div>
        </div>

    </body>
</html>
