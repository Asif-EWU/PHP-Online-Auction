<?php
    if(isset($_GET['logout'])) {
        session_destroy();
        if(isset($_COOKIE["logout"])) setcookie("logout", 1, time() + (3600 * 24 * 30), "/");
        header("Refresh:0; url=../index.php");
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-around p-0 mb-5">
    <a class="navbar-brand h1" href="#">
        <img src="../images/auction1.png" width="150" height="60" class="d-inline-block align-top" alt="">
    </a>
    <div class="navbar-nav h5">
        <a class="nav-item nav-link mr-3 active" href="admin_home.php"><i class="fas fa-home"></i> Home</a>
        <a class="nav-item nav-link mr-3" href="admin_user_list.php"><i class="fas fa-address-book"></i> User List</a>
        <a class="nav-item nav-link mr-3" href="admin_auction_requests.php"><i class="fas fa-satellite-dish"></i> Auction Requests</a>
        <a class="nav-item nav-link mr-3" href="admin_refresh_status.php"><i class="fas fa-sync-alt"></i> Refresh Status</a>
    </div>
    <div class="navbar-nav h5">
        <a class="nav-item nav-link" href="user_profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['user_name']?></a>
        <a class="nav-item nav-link" href="<?php echo $_SERVER['PHP_SELF']."?logout=true"?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</nav>
