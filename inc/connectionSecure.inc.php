<?php
  function db_connect() {
    static $connection;
    if (!isset($connection)) {
      // Load configuration as an array. Use the actual location of your configuration file
      $config = parse_ini_file('./inc/config.ini'); 
      $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
    }
    // If connection was not successful, handle the error
    if ($connection === false) {
        return mysqli_connect_error(); 
    }
    return $connection;
  }
?>