<?php

session_start();

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

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email'); //check if username & password are in Database
    $stmt->execute([':username' => $username, ':email' => $username]);

    if($stmt->rowCount()){

      $stmt = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :email) AND activated = 1'); //check if username & password are in Database
      $stmt->execute([':username' => $username, ':email' => $username]);

      if($stmt->rowCount()){

        foreach ($stmt->fetchAll() as $value) {

          if(password_verify($password, $value['password'])){

            echo 'wellcome user';

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $value['username'];
            $_SESSION['email']    = $value['email'];
            $_SESSION['id']       = $value['id'];

          }else {

            echo 'email/username or password is incorrect';
          }

        }

      }else {

          echo "User is not activated";
      }

    }else {

      echo "username or password is incorrect";
    }
  }
}
