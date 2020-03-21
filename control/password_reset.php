<?PHP

session_start();
require_once '../inc/connection.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

  if (isset($_POST['email'],$_POST['submit']) && !empty($_POST['email'])) {

    if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {

      $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
      $stmt->execute([

        ':email' => $_POST['email']
      ]);

      if ($stmt->rowCount()) {

        $stmt = $pdo->prepare('UPDATE users SET reset_token = :reset_token WHERE email =:email');
        $stmt->execute([

          ':email'       => $_POST['email'],
          ':reset_token' => sha1(uniqid('',true)) . sha1(date('Y-m-d H:i'))
        ]);
        if ($stmt->rowCount()) {

          $stmt = $pdo->prepare('SELECT email,reset_token FROM users WHERE email = :email ');
          $stmt->execute([

            ':email' => $_POST['email']
          ]);
          if ($stmt->rowCount()) {

            foreach ($stmt->fetchAll() as $value) {

              ?>
              <a href="password_recovery.php?email=<?=$value['email'];?> &reset_token=<?=$value['reset_token'];?>">click here to reset your password</a>
              <?php
            }
          }
        }
      }else {

        echo "email does not exist";
      }
    }else {

      echo "Please provide us a valid email";

    }
  }else {

    echo "Please fill up your form";
  }

}else {

  echo "you have to login";
}
