<?php
    session_start();
    require_once('../includes/database.php');

    if(isset($_GET['productId'])) $_SESSION['user_single_productId'] = $_GET['productId'];
    $productId = $_SESSION['user_single_productId'];
    
    $query = "SELECT * FROM product NATURAL JOIN product_owner NATURAL JOIN user WHERE product_id = '$productId' ";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);

    $userId = $row['user_id'];
    $productName = $row['product_name'];
    $userName = $row['user_name'];
    $basePrice = $row['base_price'];
    $lastBid = 34.98;
    $startDate = "21 Dec, 2020";
    $endDate = "21 Dec, 2020";
    $image1 = $row['image1'];
    $image2 = $row['image2']; 
    $image3 = $row['image3'];
    $description1 = $row['description1'];
    $description2 = $row['description2'];
    $description3 = $row['description3'];
    $description4 = $row['description4'];
    $description5 = $row['description5'];

    $displayImage = $image1;
    if(isset($_GET['productImage1'])) $displayImage = $image1;
    if(isset($_GET['productImage2'])) $displayImage = $image2;
    if(isset($_GET['productImage3'])) $displayImage = $image3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>

    <style>
        .display-image img {
            width: 100%;
            height: 500px;
        }
        .mini-image img {
            width: 10%;
            margin: 30px 10px;
        }
    </style>
</head>
<body>
    <?php include('../includes/user_navbar.php'); ?>
    
    <div class="container d-flex flex-row">
        <div class="image-section col-md-6">
            <div class="display-image">
                <img src=<?php echo '../uploads/' . $displayImage ?> alt="">
            </div>
            <div class="mini-image text-center">
                <a href="user_single_product.php?productImage1=true">
                    <img src=<?php echo '../uploads/' . $image1 ?> alt="">
                </a>
                <a href="user_single_product.php?productImage2=true">
                    <img src=<?php echo '../uploads/' . $image2 ?> alt="">
                </a>
                <a href="user_single_product.php?productImage3=true">
                    <img src=<?php echo '../uploads/' . $image3 ?> alt="">
                </a>
            </div>
        </div>
        <div class="description-section col-md-6">
            <h2><?php echo $productName?></h2>
            <p>Owned by: <?php echo $userName?></p>
            <hr />

            <p>
                Start Date: <?php echo $startDate?>
                <br />
                End Date: <?php echo $endDate?>
            </p>
            <div class="bid-section d-flex flex-row align-items-center">
                <div class="price col-md-5 h4 pl-0">
                    Base Price: $<?php echo $basePrice?> 
                    <br />
                    Last Bid: $<?php echo $lastBid?>
                </div>
                <div class="bid col-md-7">
                    <form action="">
                        <label for="bid-price">Place Your Bid (higher than last bid)</label>
                        <input type="number" class="form-control" id="bid-price" min="0" step=".01" pattern="^\d*(\.\d{0,2})?$" name="price" value="<?php echo $lastBid+1; ?>" placeholder="Max 2 decimal points" required>
                        <input class="btn btn-primary mt-2" type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
            <hr />

            <ul>
                <li><?php echo $description1?></li>
                <li><?php echo $description2?></li>
                <li><?php echo $description3?></li>
                <li><?php echo $description4?></li>
                <li><?php echo $description5?></li>
            </ul>
        </div>
    </div>
</body>
</html>