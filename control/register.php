<?php

require_once "../inc/connection.php";

if(isset($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['email'])){

  $username         = $_POST['username'];
  $password         = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];
  $email            = $_POST['email'];

  if(preg_match('/^[a-z0-9_.]*$/i',$username)){
    if(strlen($password) >= 8 && strlen($password) <= 32){
      if($password_confirm === $password){
        if (FILTER_VALIDATE_EMAIL($email)) {
            $stmt = $pdo->prepare('INSERT INTO ');
        }else {
          echo 'please provide a valide email';
        }
      }else{

        echo 'password confirmation doesn\'t match';
      }
    }else {
      echo 'your password must be bigger than 8 charcters and smaller than 32';
    }
  }else{

    echo 'please provide a valide username';
  }
}
