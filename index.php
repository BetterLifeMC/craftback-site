<?php
    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Servers`");
    $names = $sqlquery->get_names();
    $ports = $sqlquery->get_ports();
    $fingerprints = $sqlquery->get_fingerprints();
    $id = $sqlquery->get_id();

    for($i = 0; $i < sizeof($id); $i ++){
        echo "<span> Name: ".$names[$i]." -- Port: ".$ports[$i]."</span>";
    }

 ?>
