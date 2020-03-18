<?php

session_start();
require_once '../inc/connection.php';

if(isset($_SESSION(['loggedin']) && $_SESSION['loggedin'] === true ){

  
}else {

  die('you have to login');
}
