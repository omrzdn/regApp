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

              if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
                  $stmt->execute([$username]);

                  if($stmt->rowCount()){

                    die('Username is already taken, please pick up anthor one.');

                  }else {

                    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
                    $stmt->execute([$email]);

                    if($stmt->rowCount()){

                      die('Email is already taken, please pick up anthor one.');

                    }else {

                      $stmt = $pdo->prepare('INSERT INTO users(`username`,`password`,`email`) VALUES (?,?,?)');
                      $stmt->execute([
                        $username,
                        password_hash($password,PASSWORD_DEFAULT,['cost' => 11]),
                        $email
                      ]);

                      if($stmt->rowCount()){

                        echo "Thank you for registration, please go to active your account. ";
                      }
                    }
                  }

              }else{
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
