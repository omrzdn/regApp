<?php

session_start();
require_once '../inc/connection.php';

<<<<<<< HEAD
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ){
=======
// if(isset($_SESSION(['loggedin']) && $_SESSION['loggedin'] === true ))
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true )

{
>>>>>>> 02d653fc783f474d2f1afbb7cfa65540eb93a8c4

  if(isset($_POST['email'], $_POST['password']) && !empty($_POST['password']) && !empty($_POST['email'])){

    if(strlen($_POST['password']) >= 8 && !strlen($_POST['password']) <= 32){

      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute([

          ':username' => $_SESSION['username']
        ]);
        if($stmt->rowCount()){

          foreach ($stmt->fetchAll() as $value) {

            if(password_verify($_POST['password'], $value['password'])) {
              $stmt = $pdo->prepare('SELECT * FROM users WHERE email =:email');
              $stmt->execute([

                ':email' => $_POST['email']

              ]);

              if ($stmt->rowCount()) {

                echo "email is already taken, please pick up another one";
              }else {


                $stmt = $pdo->prepare('UPDATE users SET email =:email WHERE username =:username AND id =:id');
                $stmt->execute([
                  ':email'    => $_POST['email'],
                  ':username' => $_SESSION['username'],
                  ':id'       => $_SESSION['id']
                ]);

                if ($stmt->rowCount()) {

                  echo "your email has been changed";
                }

              }

            }else {

              echo "password incorrect";
            }
          }

        }else {

          echo "user is not activated";
        }

      }else {

        echo "Please Provide us a valid email";
      }

    }else {
      echo 'Password is weak.';
    }

  }else {

    echo 'Please fill up your form.';
  }

}else {

  die('you have to login');
}
