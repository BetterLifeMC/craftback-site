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
        <?php include('lib/headers.php'); ?>
        <title>CraftBack - <?php echo $names[0]; ?></title>

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
                            playerUUIDList = JSON.parse(response);

                            currentPlayerCount = playerUUIDList.length;
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
        </script>
    </head>
    <body onload="getChats();getPlayerInfo();">
        <?php include('lib/topnav.php'); ?>
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
    <?php
        if($_GET['currentPlayerCount'] == 1){
            return ?><script>document.write(currentPlayerCount);</script><?php ;
        }
    ?>
</html>
