<?php
    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Servers`");
    $names = $sqlquery->get_names();
    $ports = $sqlquery->get_ports();
    $fingerprints = $sqlquery->get_fingerprints();
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
                <button class="dropbtn">Dropdown
                </button>
                <div class="dropdown-content">
                    <?php
                        for($i = 0; $i < sizeof($id); $i ++){
                    ?>
                    <a href="servers.php?fingerprint=<?php echo $fingerprints[$i]; ?>"><?php echo $names[$i]; ?></a>
                    <?php } ?>
                </div>
            </div>
            <a href="#about">About</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </body>
</html>
