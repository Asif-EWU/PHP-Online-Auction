<?php
    session_start();
    require_once('../includes/database.php');

    $query = "SELECT * FROM product NATURAL JOIN product_status WHERE status='pending' ";
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
        justify-content: space-between;
    }
    .product {
        width: 30%;
        margin-bottom: 30px;
        border: 1px solid lightgrey;
        padding: 10px;
        box-shadow: 10px 10px 25px lightgrey;
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
    <?php
        if(isset($_GET['logout'])) {
            session_destroy();
            if(isset($_COOKIE["logout"])) setcookie("logout", 1, time() + (3600 * 24 * 30), "/");
            header("Refresh:0; url=../index.php");
        }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-around p-0 mb-5">
        <a class="navbar-brand h1" href="admin_home.php">
            <img src="../images/auction1.png" width="150" height="60" class="d-inline-block align-top" alt="">
        </a>
        <div class="navbar-nav h5">
            <a class="nav-item nav-link mr-3" href="admin_home.php"><i class="fas fa-home"></i> Home</a>
            <a class="nav-item nav-link mr-3" href="admin_user_list.php"><i class="fas fa-address-book"></i> User List</a>
            <a class="nav-item nav-link mr-3 active" href="admin_auction_requests.php"><i class="fas fa-satellite-dish"></i> Auction Requests</a>
            <a class="nav-item nav-link mr-3" href="admin_refresh_status.php"><i class="fas fa-sync-alt"></i> Refresh Status</a>
        </div>
        <div class="navbar-nav h5">
            <a class="nav-item nav-link mr-3" href="admin_profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['user_name']?></a>
            <a class="nav-item nav-link" href="<?php echo $_SERVER['PHP_SELF']."?logout=true"?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>
        

    <div class="container">
        <div class="product-deck">
            <?php 
            if(! mysqli_num_rows($result)) echo "<p>No Result to show</p>";

            while($row = mysqli_fetch_array($result)) { 
                $productId = $row["product_id"];   
                $name = $row["product_name"];
                $basePrice = "Base Price: $" . $row["base_price"];
                $image = "../uploads/" . $row["image1"];

                $query1 = "SELECT * FROM product_status NATURAL JOIN user WHERE product_id='$productId' ";
                $result1 = mysqli_query($db, $query1);
                $row1 = mysqli_fetch_array($result1);
                $ownerId = $row1["user_id"];
                $ownerName = $row1["user_name"];
            ?>
                <div class="product">
                    <img src="<?php echo $image ?>" alt="">
                    <h4><?php echo $name ?></h4>
                    <h6><?php echo $basePrice ?></h6>
                    <h6><?php echo "Owner: $ownerName ($ownerId)" ?></h6>
                    <button class="btn btn-block btn-primary mt-4" onclick="window.location='admin_single_product.php?productId=<?php echo $productId?>'">Explore</button>
                </div>
            <?php } ?>
        </div>        
    </div>
</body>
</html>