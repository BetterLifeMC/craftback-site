<?php

$sqlquery->doSQLStuff("SELECT * FROM `Servers` ORDER BY name ASC");
$navNames = $sqlquery->get_names();
$navFingerprints = $sqlquery->get_fingerprints();

?>
<div>
    <div class="w3-bar topbar">
        <a href="./index.php" class="w3-button w3-green w3-bar-item">Home</a>

        <div class="w3-dropdown-hover">
            <button class="w3-button">CraftBack Servers</button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <?php
                    for($i = 0; $i < sizeof($navNames); $i ++){
                ?>
                <a href="servers.php?fingerprint=<?php echo $navFingerprints[$i]; ?>" class="w3-bar-item w3-button <?php
                echo (($_GET['fingerprint'] == $navFingerprints[$i]) ?
                "w3-metro-darken" : "dropdown"); ?>"><?php echo $navNames[$i]; ?></a>
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
