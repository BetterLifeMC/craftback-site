
<!DOCTYPE html>
<html lang="en" dir="ltr" style="animation-duration: 1s;">
    <head>
        <meta charset="utf-8">
        <?php include('lib/headers.php'); ?>
        <title>CraftBack</title>
        <script src="js/servers.js"></script>
        <script>
            var serverPorts = ["<?php echo implode('","', $ports); ?>"];
            var serverHostnames = ["<?php echo implode('","', $hostnames) ?>"];
            results = [];
            $( document ).ready(function() {
                console.log( "ready!" );
                setTimeout(loadServerInfo(serverHostnames, serverPorts), 1000);
            });
        </script>
    </head>
    <body>
        <?php include('lib/topnav.php'); ?>
        <div id="bigcontainer">
        <?php
            for($i = 0; $i < sizeof($id); $i++){
                if(($i) % 3 == 0) {
        ?>
            <div id="main" class="w3-row">
                <?php
                    }
                ?>
                <div class="info">
                    <h2><?php echo $names[$i]; ?></h2>
                    <hr>
                    <span class="serverInfo">CraftBack Version: <span style="float:right"><?php echo $versions[$i]; ?></span></span>
                    <br>
                    <br>
                    <span class="serverInfo">Server hostname: <span style="float:right"><?php echo $hostnames[$i]; ?></span></span>
                    <br>
                    <br>
                    <span class="serverInfo">Max players: <span style="float:right"><?php echo $maxplayers[$i]; ?></span></span>
                    <br>
                    <br>
                    <span class="serverInfo">Current players: <span style="float:right" id="currentPlayerCount<?php echo $i ?>"> </span></span>
                    <br>
                    <br>
                </div>
                <?php
                    if(($i + 1) % 3 == 0){
                 ?>
                </div>
            <?php } } ?>
        </div>
    </body>
</html>
