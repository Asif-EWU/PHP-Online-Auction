<?php
    session_start();
    require_once('../includes/database.php');

    $todayDate = date('Y-m-d H:i:s');

    $query1 = "SELECT * 
        FROM duration NATURAL JOIN product_status 
        WHERE (status='ongoing' AND end_date < '$todayDate')";
    $result1 = mysqli_query($db, $query1);

    while($row1 = mysqli_fetch_array($result)) {
        $productId = $row1['product_id'];
        $query2 = "UPDATE product_status SET status='closed' WHERE product_id='$productId' ";
        mysqli_query($db, $query2);
    }
?>