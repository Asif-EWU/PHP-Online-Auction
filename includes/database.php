<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'cse480';

    $conn = mysqli_connect($host, $user, $password, $db);
    if(!$conn) {
        die("Error: Could not connect database !!");
    }
?>