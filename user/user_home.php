<?php
    session_start();
    require_once('../includes/database.php');

    $query = "SELECT * FROM product";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    $name = $row["name"];
    $basePrice = "Base Price: $ " . $row["base_price"];
    $lastBid = "Last Bid: $ 98.29";
    $image = "../uploads/" . $row["image1"];
    $endDate = "End Date: Dec 20, 2020";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Auction</title>
</head>

<style>
    .product-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .product {
        width: 30%;
        margin-bottom: 30px;
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
    @media (min-width: 992px) {
        .product {width: 22% }
    }
</style>
<body>
    <?php include('../includes/user_navbar.php'); ?>
    <div class="container">
        <div class="product-deck">
            <div class="product">
                <img src="<?php echo $image ?>" alt="">
                <h3><?php echo $name ?></h3>
                <h5><?php echo $basePrice ?></h5>
                <h5><?php echo $lastBid ?></h5>
                <p><?php echo $endDate ?></p>
                <button class="btn btn-block btn-primary" onclick="window.location='user_single_product.php?id=<?php echo $name?>'">Explore</button>
            </div>
        </div>        
    </div>
</body>
</html>