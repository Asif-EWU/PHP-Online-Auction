<?php
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM product NATURAL JOIN duration NATURAL JOIN win WHERE user_id = '$userId' ";
    $result = mysqli_query($db, $query);
    
    if(! mysqli_num_rows($result)) {
        echo "<p>No Result to show</p>";
    } 
?>

<div class="product-deck">
    <?php 
    While($row = mysqli_fetch_array($result)) {
        $image = "../uploads/" . $row["image1"];
        $productId = $row["product_id"];
    ?>
        <div class="product">
            <img src="<?php echo $image ?>" alt="">
            <h4><?php echo $row['product_name'] ?></h4>
            <h6>Base Price: $<?php echo $row['base_price'] ?></h6>
            <h6>Winner Bid: $<?php echo $row['amount'] ?></h6>
            <p>Closed: <?php echo $row['end_date'] ?></p>
            <button class="btn btn-block btn-primary mt-4" 
                onclick="window.location='user_single_product/user_single_product_win.php?productId=<?php echo $productId?>'">
                Explore
            </button>
        </div>
    <?php } ?>      
</div>  