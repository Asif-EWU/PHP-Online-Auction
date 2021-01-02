<?php
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM product NATURAL JOIN product_status WHERE (status='pending' AND user_id='$userId') ";
    $result = mysqli_query($db, $query);
    
    if(! mysqli_num_rows($result)) {
        echo "<p>No Result to show</p>";
    } 
?>

<div class="product-deck">
    <?php 
    While($row = mysqli_fetch_array($result)) {
        $productId = $row['product_id'];
        $image = "../uploads/" . $row["image1"];
    ?>
        <div class="product">
            <img src="<?php echo $image ?>" alt="">
            <h4><?php echo $row['product_name'] ?></h4>
            <h6>Base Price: $<?php echo $row['base_price'] ?></h6>
            <button class="btn btn-block btn-primary mt-4" 
                onclick="window.location='user_single_product/user_single_product_arrangement_pending.php?productId=<?php echo $productId?>'">
                Explore
            </button>
        </div>
    <?php } ?>      
</div>  