<?php
    session_start();
    require_once('../includes/database.php');

    $category = $subCategory = $endDate = $status = "";

    if(isset($_GET['productId'])) $_SESSION['user_single_productId'] = $_GET['productId'];
    $productId = $_SESSION['user_single_productId'];
    
    $query = "SELECT * FROM product NATURAL JOIN product_status NATURAL JOIN user WHERE product_id = '$productId' ";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);

    $userId = $row['user_id'];
    $productName = $row['product_name'];
    $userName = $row['user_name'];
    $basePrice = $row['base_price'];
    $duration = $row['duration'];
    $nowDate = date('Y-m-d H:i:s');

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

    
    if(isset($_GET['reject'])) {
        $query = "DELETE FROM product WHERE product_id='$productId' ";
        mysqli_query($db, $query);
        $status = "<p class='alert alert-warning'>Product is Rejected and Deleted from Product List !!</p>";
        header("Refresh:1; url=admin_auction_requests.php");
    }
    
    if(isset($_POST['accept'])) {
        $category = $_POST['category'];
        $subCategory = $_POST['sub_category'];

        date_default_timezone_set("Asia/Dhaka");
        $endDate = date("Y-m-d H:i:s", strtotime("+{$duration} days"));

        $query1 = "UPDATE product_status SET status='ongoing' WHERE product_id='$productId' ";
        $query2 = "INSERT INTO product_category(product_id, category, sub_category) VALUES ('$productId', '$category', '$subCategory') ";
        $query3 = "INSERT INTO duration(product_id, end_date) VALUES ('$productId', '$endDate') ";
        $query4 = "INSERT INTO bid(product_id, user_id, amount, time) VALUES ('$productId', '$userId', '$basePrice', '$nowDate') ";
        mysqli_query($db, $query1);
        mysqli_query($db, $query2);
        mysqli_query($db, $query3);
        mysqli_query($db, $query4);

        $status = "<p class='alert alert-success'>Product is Accepted to Auction !!</p>";
        header("Refresh:1; url=admin_auction_requests.php");
    }
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
            width: 80px;
            height: 80px;
            margin: 30px 10px;
        }
    </style>
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>
    
    <div class="container d-flex flex-row">
        <div class="image-section col-md-6">
            <div class="display-image">
                <img src=<?php echo '../uploads/' . $displayImage ?> alt="">
            </div>
            <div class="mini-image text-center">
                <a href="<?php echo $_SERVER['PHP_SELF'] . '?productImage1=true' ?>">
                    <img src=<?php echo '../uploads/' . $image1 ?> alt="">
                </a>
                <a href="<?php echo $_SERVER['PHP_SELF'] . '?productImage2=true' ?>">
                    <img src=<?php echo '../uploads/' . $image2 ?> alt="">
                </a>
                <a href="<?php echo $_SERVER['PHP_SELF'] . '?productImage3=true' ?>">
                    <img src=<?php echo '../uploads/' . $image3 ?> alt="">
                </a>
            </div>
        </div>
        <div class="description-section col-md-6">
            <?php echo $status ?>
            <a href="admin_single_product.php?reject=true">
                <button class="btn btn-danger">Reject Request</button>
            </a>

            <h2><?php echo $productName?></h2>
            <p>
                Owned by: <span class="h5"><?php echo $userName?></span> <br>
                Base Price: <span class="h5">$<?php echo $basePrice?></span> <br>
                Duration: <span class="h5"><?php echo $duration . " Days" ?></span>
            </p>
            <hr />

            <p>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row h5">
                        <div class="col-md-6">
                            <label for="category">Category</label>
                            <input class="form-control" type="text" name="category" id="category" value="<?php echo $category ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_category">Sub Category</label>
                            <input class="form-control" type="text" name="sub_category" id="sub_category" value="<?php echo $subCategory ?>" required>
                        </div>
                    </div>
                    <input class="btn btn-success mt-3" type="submit" name="accept" value="Accept Request">
                </form>
            </p>
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