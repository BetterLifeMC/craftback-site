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
            <script>
                // Snatched from https://happycoding.io/tutorials/java-server/post#polling-with-ajax
                function getChats(){
                    var ajaxRequest = new XMLHttpRequest();
                    ajaxRequest.onreadystatechange = function(){

                        if(ajaxRequest.readyState == 4){
                            //the request is completed, now check its status
                            if(ajaxRequest.status == 200){
                                document.getElementById("chats").innerHTML = ajaxRequest.responseText;
                            }
                            else{
                                console.log("Status error: " + ajaxRequest.status);
                            }
                        }
                        else{
                            console.log("Ignored readyState: " + ajaxRequest.readyState);
                        }
                    }
                    ajaxRequest.open('GET', 'http://games01-serv:<?php echo $ports[0]; ?>/getLog');
                    ajaxRequest.send();

                    //refresh the chats in one second
                    setTimeout(getChats, 1000);
                }
        </script>
    </head>
    <body>
        <!-- Shamelessly snatched from W3 -->
        <div class="topnav" id="myTopnav">
            <a href="/" class="active">Home</a>
        </div>
        <div class="logConsole" id="logConsole"></div>
    </body>
</html>
