<?php

include('sql.php');
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
<div>
    <div class="w3-bar topbar">
        <a href="#home" class="w3-button w3-green w3-bar-item">Home</a>

        <div class="w3-dropdown-hover">
            <button class="w3-button">CraftBack Servers</button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <?php
                    for($i = 0; $i < sizeof($id); $i ++){
                ?>
                <a href="servers.php?fingerprint=<?php echo $fingerprints[$i]; ?>" class="w3-bar-item w3-button dropdown"><?php echo $names[$i]; ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="w3-dropdown-hover">
            <button class="w3-button">Git</button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="https://gitlab.com/gt3ch1/craftback" class="w3-bar-item w3-button dropdown" >CraftBack</a>
                <a href="https://gitlab.com/gt3ch1/craftback-site" class="w3-bar-item w3-button  dropdown" >CraftBack UI</a>
            </div>
        </div>
    </div>
</div>
