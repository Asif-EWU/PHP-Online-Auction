<?php
    session_start();
    require_once('../includes/database.php');

    // $todayDate = date("Y-m-d");
    // $todayDate1 = date("Y-m-d");
    // $year =  explode('-', $todayDate)[0];
    // $month = explode('-', $todayDate)[1];
    // $day = explode('-', $todayDate)[2];
    // echo $todayDate . "<br>";
    // echo $year . "<br>";
    // echo $month-3 . "<br>";
    // echo $day . "<br>";

    // if($todayDate === $todayDate1) echo "same";
    // else echo "not same";

    $query1 = "SELECT * 
        FROM duration NATURAL JOIN product_status 
        WHERE (status='ongoing' AND end_date < '$todayDate')";
    $result = mysqli_query($db, $query1);
?>