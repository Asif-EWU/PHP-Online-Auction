<?php
    $category = $categoryCheck = "";
    if(isset($_GET['category'])) {
        $category = $_GET['category'];
        $categoryCheck = " AND category='" . $category . "'";
    }

    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM product NATURAL JOIN duration NATURAL JOIN product_status NATURAL JOIN product_category WHERE status='closed' AND user_id='$userId' " . $categoryCheck;
    $result = mysqli_query($db, $query);
    
    $count = 0;
?>

<div class="product-deck">
    <?php 
    While($row = mysqli_fetch_array($result)) {
        $productId = $row['product_id'];
        $query2 = "SELECT * FROM bid WHERE product_id='$productId' ORDER BY time DESC";
        $result2 = mysqli_query($db, $query2);
        $row2 = mysqli_fetch_array($result2);
        $winnerBid = $row2['amount'];

        if(isset($_POST['filter'])) {
            $minPrice = $_POST['min-price'];
            $maxPrice = $_POST['max-price'];
            if($winnerBid < $minPrice || $winnerBid > $maxPrice) continue;
        }
        $count++;

        $image = "../uploads/" . $row["image1"];
    ?>
        <div class="product">
            <img src="<?php echo $image ?>" alt="">
            <h4><?php echo $row['product_name'] ?></h4>
            <h6>Base Price: $<?php echo $row['base_price'] ?></h6>
            <h6>Winner Bid: $<?php echo $winnerBid ?></h6>
            <p>Closed: <?php echo $row['end_date'] ?></p>
            <button class="btn btn-block btn-primary mt-4" 
                onclick="window.location='user_single_product/user_single_product_arrangement_closed.php?productId=<?php echo $productId?>'">
                Explore
            </button>
        </div>
        <?php }

        if(! $count) echo "<p>No Result to show</p>";
        ?>      
</div>  