<?php
    $category = $categoryCheck = "";
    if(isset($_GET['category'])) {
        $category = $_GET['category'];
        $categoryCheck = " AND category=" . $category;
    }

    $query = "SELECT * FROM product NATURAL JOIN duration NATURAL JOIN product_status NATURAL JOIN product_category WHERE status='ongoing' " . $categoryCheck;
    $result = mysqli_query($db, $query);
    
    if(! mysqli_num_rows($result)) {
        echo "<p>No Result to show</p>";
    } 
?>

<div class="product-deck">
    <?php 
    While($row = mysqli_fetch_array($result)) {
        $productId = $row['product_id'];
        $query2 = "SELECT * FROM bid WHERE product_id='$productId' ORDER BY time DESC";
        $result2 = mysqli_query($db, $query2);
        $row2 = mysqli_fetch_array($result2);
        $lastBid = $row2['amount'];

        $image = "../uploads/" . $row["image1"];
    ?>
        <div class="product">
            <img src="<?php echo $image ?>" alt="">
            <h4><?php echo $row['product_name'] ?></h4>
            <h6>Base Price: $<?php echo $row['base_price'] ?></h6>
            <h6>Last Bid: $<?php echo $lastBid ?></h6>
            <p>Closes: <?php echo $row['end_date'] ?></p>
            <button class="btn btn-block btn-primary mt-4" 
                onclick="window.location='user_single_product/user_single_product_home.php?productId=<?php echo $productId?>'">
                Explore
            </button>
        </div>
    <?php } ?>      
</div>  