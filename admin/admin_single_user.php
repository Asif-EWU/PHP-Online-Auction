<?php
    session_start();
    include("../includes/database.php");

    $status = "";
    if(isset($_GET['id'])) $_SESSION['single_user_id'] = $_GET['id'];
    $id = $_SESSION['single_user_id']; 

    if(isset($_POST['delete']))
    {
        $query = "DELETE FROM user WHERE id = '$id' ";
        if(mysqli_query($db, $query))
        {
            $status = "<p class='alert alert-success'>User Deleted Successfully !!</p>";
            header("refresh:0; url=admin_user_list.php");
        }
        else header("refresh:0;");
    }

    $query = "SELECT * FROM user WHERE id = '$id' ";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>
    <div class="container">
        <h1 class="display-4 text-center my-4">User Details</h1>

        <ul class="list-group">
            <li class="list-group-item">ID           : <?php echo $row['id'] ?> </li>
            <li class="list-group-item">Name         : <?php echo $row['name'] ?> </li>
            <li class="list-group-item">Email        : <?php echo $row['email'] ?> </li>
            <li class="list-group-item">Address      : <?php echo $row['address'] ?> </li>
            <li class="list-group-item">City         : <?php echo $row['city'] ?> </li>
            <li class="list-group-item">Country      : <?php echo $row['country'] ?> </li>
            <li class="list-group-item">Country Code : <?php echo $row['country_code'] ?> </li>
            <li class="list-group-item">Gender       : <?php echo $row['gender'] ?> </li>
            <li class="list-group-item">Date of Birth: <?php echo $row['dob'] ?> </li>
            <li class="list-group-item">Age          : <?php echo $row['age'] ?> </li>
       </ul>
       <br>
    
       <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
           <button class="btn btn-danger" name="delete">Delete User</button>
       </form>
    </div>

    <div style="margin-top:200px;"></div>
</body>
</html>
