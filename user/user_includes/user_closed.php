<?php
    $query = "SELECT * FROM product NATURAL JOIN duration NATURAL JOIN product_status WHERE status='closed' ";
    $result = mysqli_query($db, $query);
    
    if(! mysqli_num_rows($result)) {
        echo "<h4>No Result to show</h4>";
    } 
?>

<div class="product-deck">
    <?php 
    While($row = mysqli_fetch_array($result)) {
        $productId = $row['product_id'];
        $query2 = "SELECT * FROM bid WHERE product_id='$productId' ";
        $result2 = mysqli_query($db, $query2);
        if(mysqli_num_rows($result2) > 0) {
            $row2 = mysqli_fetch_array($result2);
            $winnerBid = $row2['amount'];
        }
        else $winnerBid = $row['base_price'];

        $image = "../uploads/" . $row["image1"];
    ?>
        <div class="product">
            <img src="<?php echo $image ?>" alt="">
            <h4><?php echo $row['product_name'] ?></h4>
            <h6>Base Price $<?php echo $row['base_price'] ?></h6>
            <h6>Winner Bid: $<?php echo $winnerBid ?></h6>
            <p>Closed: <?php echo $row['end_date'] ?></p>
            <button class="btn btn-block btn-primary mt-4" 
                onclick="window.location='user_single_product/user_single_product_closed.php?productId=<?php echo $productId?>'">
                Explore
            </button>
        </div>
    <?php } ?>      
</div>  