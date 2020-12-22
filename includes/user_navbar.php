<?php
    if(isset($_GET['logout'])) {
        session_destroy();
        if(isset($_COOKIE["logout"])) setcookie("logout", 1, time() + (3600 * 24 * 30), "/");
        header("Refresh:0; url=../index.php");
    }
?>


<!-- <ul>
    <li><a href="user_home.php">Home</a></li>
    <li><a href="user_request_auction.php">Request Auction</a></li>
    <li><a href="#">Messages</a></li>
    <li><a href="user_profile.php">Profile</a></li>
    <li><a href="user_home.php?logout=true">Logout</a></li>
    </li> 
</ul> -->


<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-around p-0 mb-5">
    <a class="navbar-brand h1" href="#">
        <img src="../images/auction1.png" width="150" height="60" class="d-inline-block align-top" alt="">
    </a>
    <div class="navbar-nav h4">
        <a class="nav-item nav-link mr-3 active" href="user_home.php"><i class="fas fa-home"></i> Home</a>
        <a class="nav-item nav-link mr-3" href="user_request_auction.php"><i class="fas fa-satellite-dish"></i> Request Auction</a>
        <a class="nav-item nav-link mr-3" href="#"><i class="fas fa-layer-group"></i> Arrangements</a>
        <a class="nav-item nav-link mr-3" href="#"><i class="far fa-chart-bar"></i> Participations</a>
        <a class="nav-item nav-link mr-3" href="#"><i class="fas fa-trophy"></i> Wins</a>
    </div>
    <div class="navbar-nav h4">
        <a class="nav-item nav-link" href="user_profile.php"><i class="fas fa-user"></i> Profile</a>
        <a class="nav-item nav-link" href="user_home.php?logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</nav>

<!-- <nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand">Navbar</a>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav> -->