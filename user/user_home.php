<?php
    session_start();
    require_once('../includes/database.php');

    $query = "SELECT * FROM product NATURAL JOIN duration NATURAL JOIN product_status WHERE status='ongoing' ";
    $result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <title>Auction</title>
</head>

<style>
    .product-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }
    .product {
        width: 30%;
        margin: 0 15px 20px;
        border: 1px solid lightgrey;
        padding: 10px;
    }
    .product img {
        width: 100%;
        height: 300px;
    }
    
    @media (min-width: 100px) {
        .product {width: 100% }
    }
    @media (min-width: 576px) {
        .product {width: 48% }
    }
    @media (min-width: 768px) {
        .product {width: 30% }
    }
</style>
<body>
    <?php include('../includes/user_navbar.php'); ?>
    <div class="container">
        <div class="product-deck">
            <?php 
            While($row = mysqli_fetch_array($result)) {
                $productId = $row['product_id'];
                $query2 = "SELECT * FROM bid WHERE product_id='$productId' ";
                $result2 = mysqli_query($db, $query2);
                if(mysqli_num_rows($result2) > 0) {
                    $row2 = mysqli_fetch_array($result2);
                    $lastBid = $row2['amount'];
                }
                else $lastBid = $row['base_price'];

                $image = "../uploads/" . $row["image1"];
            ?>
                <div class="product">
                    <img src="<?php echo $image ?>" alt="">
                    <h4><?php echo $row['product_name'] ?></h4>
                    <h6>Base Price $<?php echo $row['base_price'] ?></h6>
                    <h6>Last Bid: $<?php echo $lastBid ?></h6>
                    <p>End Date: <?php echo $row['end_date'] ?></p>
                    <button class="btn btn-block btn-primary" onclick="window.location='user_single_product.php?productId=<?php echo $productId?>'">Explore</button>
                </div>
            <?php } ?>      
        </div>  
    </div>
</body>
</html>