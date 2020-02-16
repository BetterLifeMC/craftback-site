<?php
    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Servers` WHERE fingerprint ='".$_GET['fingerprint']."'");
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
        <title>craftback</title>
    </head>
    <body>
        <!-- Shamelessly snatched from W3 -->
        <div class="topnav" id="myTopnav">
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
        <iframe class="logConsole" src="http://games01-serv:<?php echo $ports[0]; ?>/getLog"></iframe>
    </body>
</html>
