<?php

try {

  $pdo = new PDO('mysql:host=localhost;dbname=regApp','root','');

} catch (PDOException $e) {

  die($e->getmessage());
}
