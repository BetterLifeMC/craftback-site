<?php
/*
    How to use:

    include('lib/sql.php');
    $sqlquery = new doSQL();
    $sqlquery->doSQLStuff("SELECT * FROM `Games`");
    $games = $sqlquery->get_names();
    $services = $sqlquery->get_sns();
    $directories = $sqlquery->get_dirs();
    $id = $sqlquery->get_id();

*/
  class doSQL{
    var $names = array();
    var $ports = array();
    var $fingerprint = array();
    var $hostnames = array();
    var $maxplayers = array();
    var $versions = array();
    var $id = array();
    function set_names($a){
      $this->names = $a;
    }
    function set_id($d){
      $this->id = $d;
    }
    function set_ports($e){
      $this->ports = $e;
    }
    function set_fingerprints($b){
      $this->fingerprint = $b;
    }
    function set_hostnames($c){
        $this->hostnames = $c;
    }
    function set_maxplayers($f){
        $this->maxplayers = $f;
    }
    function set_versions($g){
        $this->versions = $g;
    }

    function get_id(){
      return $this->id;
    }
    function get_names(){
      return $this->names;
    }
    function get_ports(){
      return $this->ports;
    }
    function get_fingerprints(){
      return $this->fingerprint;
    }
    function get_maxplayers(){
        return $this->maxplayers;
    }
    function get_hostnames(){
        return $this->hostnames;
    }
    function get_versions(){
        return $this->versions;
    }
    function querySQL($query){
      $servername = "localhost";
      $username = "craftback";
      $password = "AHOiXK8nOh7M9xN8";
      $dbname = "Minecraft";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      mysqli_query($conn, $query);
    }
    function doSQLStuff($query){
      $a = 0;
      $servername = "localhost";
      $username = "craftback";
      $password = "AHOiXK8nOh7M9xN8";
      $dbname = "Minecraft";
      $conn   = mysqli_connect($servername, $username, $password, $dbname);
      $result = mysqli_query($conn, $query);
      $newNames = array();
      $newPorts = array();
      $newFingerPrints = array();
      $newHostNames = array();
      $newMaxPlayers = array();
      $newVersions = array();
      $id = array();
      while($row = mysqli_fetch_array($result)){
        array_push($newNames, $row['name']);
        array_push($newPorts, $row['port']);
        array_push($newFingerPrints, $row['fingerprint']);
        array_push($newHostNames, $row['hostname']);
        array_push($newMaxPlayers, $row['maxplayers']);
        array_push($newVersions, $row['version']);
        array_push($id, $row['id']);
      }

      $this->set_hostnames($newHostNames);
      $this->set_names($newNames);
      $this->set_ports($newPorts);
      $this->set_fingerprints($newFingerPrints);
      $this->set_maxplayers($newMaxPlayers);
      $this->set_versions($newVersions);
      $this->set_id($id);
    }
  }
 ?>
