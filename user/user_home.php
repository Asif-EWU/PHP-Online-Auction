<?php
    session_start();
    require_once('../includes/database.php');
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
        <a class="navbar-brand h1" href="user_home.php">
            <img src="../images/auction1.png" width="150" height="60" class="d-inline-block align-top" alt="">
        </a>
        <div class="navbar-nav h5">
            <a class="nav-item nav-link mr-3 active" href="user_home.php"><i class="fas fa-home"></i> Home</a>
            <a class="nav-item nav-link mr-3" href="user_request_auction.php"><i class="fas fa-satellite-dish"></i> Request Auction</a>
            <a class="nav-item nav-link mr-3" href="user_arrangement.php"><i class="fas fa-layer-group"></i> Arrangements</a>
            <a class="nav-item nav-link mr-3" href="user_participation.php"><i class="far fa-chart-bar"></i> Participations</a>
            <a class="nav-item nav-link mr-3" href="user_win.php"><i class="fas fa-trophy"></i> Wins</a>
        </div>
        <div class="navbar-nav h5">
            <a class="nav-item nav-link mr-3" href="user_profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['user_name']?></a>
            <a class="nav-item nav-link" href="<?php echo $_SERVER['PHP_SELF']."?logout=true"?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>


    <div class="container">
        <?php include('user_includes/user_ongoing.php'); ?>    
    </div>
</body>
</html>