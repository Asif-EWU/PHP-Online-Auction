<?php
  require_once("includes/database.php");
  $email = "admin@gmail.com";
  $password = "8624407";
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO admin (email, password) VALUES ('$email', '$hashedPassword')";
  mysqli_query($db, $query);
?>