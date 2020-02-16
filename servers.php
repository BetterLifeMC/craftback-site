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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            // Snatched from https://happycoding.io/tutorials/java-server/post#polling-with-ajax
            function getChats(){
                $.get({
                    url: 'http://games01-serv:<?php echo $ports[0]; ?>/getLog',
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
                        alert('error');
                    }
                });
                setTimeout(getChats, 1000);
            }
            $(function () {
                $('form').on('submit', function (e) {
                    e.preventDefault
                    $.ajax({
                        type: 'get',
                        url: 'http://games01-serv:<?php echo $ports[0]; ?>/sendMessage/',
                        data: $('form').serialize(),
                        success: function () {
            		        document.getElementById('messageBox').value="";
                        }
                    });
                });
                document.getElementById('messageBox').value="";
             });
        </script>
    </head>
    <body>
        <!-- Shamelessly snatched from W3 -->
        <div>
            <div class="topnav" id="myTopnav">
                <a href="/" class="active">Home</a>
            </div>
            <pre>
                <div class="logConsole" id="logConsole"></div>
            </pre>
            <div class="messageBox">
                <form>
                    <input id="messageBox" class="messageBox" type="text" name="message" />
                </input>
            </div>
        </div>
    </body>
</html>
