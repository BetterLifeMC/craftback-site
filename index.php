<?php
    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Servers` ORDER BY name ASC");
    $names = $sqlquery->get_names();
    $hostnames = $sqlquery->get_hostnames();
    $ports = $sqlquery->get_ports();
    $fingerprints = $sqlquery->get_fingerprints();
    $versions = $sqlquery->get_versions();
    $maxplayers = $sqlquery->get_maxplayers();
    $id = $sqlquery->get_id();

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
        <title>CraftBack</title>
        <script src="js/sketch.js"></script>
        <script src="https://kit.fontawesome.com/1be2cd7175.js" crossorigin="anonymous"></script>

    </head>
    <body onload="loadDarkMode();loadServerInfo(<?php echo $ports ?>)">
        <!-- Shamelessly snatched from W3 -->
        <div>
            <div class="w3-bar w3-metro-darken">
                <a href="#home" class="w3-button w3-green w3-bar-item">Home</a>

                <div class="w3-dropdown-hover">
                    <button class="w3-button">CraftBack Servers</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <?php
                            for($i = 0; $i < sizeof($id); $i ++){
                        ?>
                        <a href="servers.php?fingerprint=<?php echo $fingerprints[$i]; ?>" class="w3-bar-item w3-button"><?php echo $names[$i]; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="w3-dropdown-hover">
                    <button class="w3-button">Git</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="https://gitlab.com/gt3ch1/craftback" class="w3-bar-item w3-button" >CraftBack</a>
                        <a href="https://gitlab.com/gt3ch1/craftback-site" class="w3-bar-item w3-button" >CraftBack UI</a>
                    </div>
                </div>
                <button onclick="toggleDarkMode();" class="w3-button" style="float:right;"><i class="fas fa-adjust"></i></button>
            </div>
        </div>
        <?php
            for($i = 0; $i < sizeof($id); $i++){
                if(($i) % 3 == 0) {
        ?>
        <div id="main" class="w3-row">
            <?php
                }
            ?>
            <div class="w3-third w3-container info">
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
            </div>
            <?php
                if(($i + 1) % 3 == 0){
             ?>
            </div>
        <?php } } ?>
        Version - 1.4
    </body>
</html>
