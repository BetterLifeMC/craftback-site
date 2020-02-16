<?php
    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Servers`");
    $names = $sqlquery->get_names();
    $ports = $sqlquery->get_ports();
    $fingerprints = $sqlquery->get_fingerprints();
    $versions = $sqlquery->get_versions();
    $id = $sqlquery->get_id();

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>CraftBack</title>
    </head>
    <body>
        <!-- Shamelessly snatched from W3 -->
        <div class="topnav" id="myTopnav">
            <a href="#home" class="active">Home</a>
            <div class="dropdown">
                <button class="dropbtn">CraftBack Servers</button>
                <div class="dropdown-content">
                    <?php
                        for($i = 0; $i < sizeof($id); $i ++){
                    ?>
                    <a href="servers.php?fingerprint=<?php echo $fingerprints[$i]; ?>"><?php echo $names[$i]; ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Git</button>
                <div class="dropdown-content">
                    <a href="https://gitlab.com/gt3ch1/craftback">CraftBack</a>
                    <a href="https://gitlab.com/gt3ch1/craftback-site">CraftBack UI</a>
                </div>
            </div>
        </div>
        <?php
            for($i = 0; $i < sizeof($id); $i++){
                if($i % 3 == 0){
        ?>
        <div id="main" class="w3-row">
            <?php
                }
            ?>
            <div class="w3-third w3-container w3-green">
                <h2><?php echo $names[$i]; ?></h2>
            </div>
            <?php
                if($i % 3 == 0){
             ?>
            </div>
        <?php } } ?>
        </div>
    </body>
</html>
