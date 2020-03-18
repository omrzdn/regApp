<?php

require_once '../inc/connection.php';

if(isset($_POST['username'], $_POST['password'])){  // check if username and password are written

  $username = $_POST['username'];  //sign username in variable
  $password = $_POST['password'];  //sign passwoed in variable


  if(!preg_match('/^[a-z0-9_.]*$/i',$username)){  //check username validation

    die('please, provide a valid usename');

  }

  if(!strlen($password) >= 8 && !strlen($password) <= 32){   //check password validation

    die('please, provide a valid password');

  }else {

    $stmt = $pdo->prepare('SELECT FORM users WHERE username = :username AND password = :password'); //check if username & password are in Database
    $stmt->execute(['username' => $username, 'password' => $password]);

    if($stmt->rowCount()){

      echo 'hello ' . $username;
      
    }else {
      echo "user not foound";
    }
  }
}
