<?php
    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Servers` WHERE fingerprint ='".$_GET['fingerprint']."'");
    $names = $sqlquery->get_names();
    $ports = $sqlquery->get_ports();
    $fingerprints = $sqlquery->get_fingerprints();
    $hostnames = $sqlquery->get_hostnames();
    $id = $sqlquery->get_id();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>craftback</title>
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
                document.getElementById("currentPlayerCount").innerHTML = currentPlayerCount;
                if(playerArrayUUIDList[0].length > 0){
                    for (var i = 0; i < currentPlayerCount; i++) {
                        document.getElementById("allPlayers").innerHTML += "<span id='playerHead'>" +
                         PlayerArrayNameList[i]+"</span><img src='https://minotar.net/avatar/"+playerArrayUUIDList[i]+"/32.png' id='playerHeadImage' alt='Skin head'></img><br><hr>";
                    }
                }
                // setTimeout(getPlayerInfo, 5000);
            }
        </script>
    </head>
    <body onload="getChats();getPlayerInfo();">
        <!-- Shamelessly snatched from W3 -->
        <div>
            <div class="topnav" id="myTopnav">
                <a href="/craftback-site" class="active">Home</a>
            </div>
            <pre>
                <div class="logConsole" id="logConsole"></div>
            </pre>
            <div class="playerBox">
                <span>Current Players: (<span id="currentPlayerCount"></span>)</span>
                <div id="allPlayers">
                </div>
            </div>
            <div class="messageBox">
                <form>
                    <input id="messageBox" class="messageBox" type="text" name="message" />
                </form>
            </div>
        </div>
    </body>
</html>
