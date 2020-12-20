<?php
    session_start();
    require_once("../includes/database.php");

    $index = 1;
    $query = "SELECT * from user";
    $result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>    
    
    <div class="container">
        <h1 class="display-4 text-center my-4">Users List</h1>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>

            <?php while($row = mysqli_fetch_array($result)) { ?>
                <tr style="cursor: pointer;" onclick="window.location='admin_single_user.php?id=<?php echo $row['id']?>'">
                    <th scope="row"><?php echo $index++; ?></th>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
        </div>

    <div style="margin-top:200px;"></div>
</body>
</html>