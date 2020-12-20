<?php 
    session_start();
    require_once('../includes/database.php');

    function filterInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $id = $_SESSION["id"];
    $query = "SELECT * FROM admin where id = '$id' ";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    
    $name = $row["name"];
    $email = $row["email"];
    $address = $row["address"];
    $city = $row["city"];
    $country = $row["country"];
    $countryCode = $row["country_code"];
    $status = "";
    $addressErr = $cityErr = $countryErr = $countryCodeErr = "";

    if(isset($_POST['update'])) {

        $errCount = 0;
        $spaceRegex = "/\s\s+/";
        $countryCodeRegex = "/^\d{1,3}(-\d{3,4})?$/";

        // Address
        $address = filterInput($_POST['address']);
        $address = preg_replace($spaceRegex, ' ', $address);
        if(strlen($address) < 10) {
            $addressErr = "* Incomplete address";
            $errCount++;
        }

        // City
        $city = filterInput($_POST['city']);
        if(strlen($city) < 3) {
            $cityErr = "* Invalid city";
            $errCount++;
        }

        // Country
        $country = filterInput($_POST['country']);
        if(strlen($country) < 3) {
            $countryErr = "* Invalid country";
            $errCount++;
        }

        // Country Code
        $countryCode = filterInput($_POST["countryCode"]);
        if(!preg_match($countryCodeRegex, $countryCode)) {
            $countryCodeErr = "* Invalid country code";
            $errCount++;
        }

        if(! $errCount) {
            $query = "UPDATE admin SET address='$address', city='$city', country='$country', country_code='$countryCode' WHERE id='$id' ";
            if(mysqli_query($db, $query)) {
                $status = "<p class='alert alert-success'>Account updated successfully !!</p>";
                header("Refresh:1; url=admin_profile.php");
            }
            else $status = "<p class='alert alert-danger'>Update Failed !!</p>";
        }        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>

    <style>
        .pink {color: red;}
    </style>
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>

    <div class="container">
        <?php echo $status ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ex: Muhammad Abu Bakar Siddique" value="<?php echo $name; ?>" minlength="5" maxlength="35" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="ex: omar@gmail.com" value="<?php echo $email; ?>" minlength="8" maxlength="35" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address <span class="red">*</span></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="ex: 1234 Main St" value="<?php echo $address; ?>" required>
                <span class="pink"><?php echo $addressErr; ?></span>
                </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="city">City <span class="red">*</span></label>
                    <input type="text" class="form-control" id="city" name="city" maxlength="20" placeholder="ex: Dhaka" value="<?php echo $city; ?>" required>
                    <span class="pink"><?php echo $cityErr; ?></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="country">Country <span class="red">*</span></label>
                    <input type="text" class="form-control" id="country" name="country" maxlength="20" placeholder="ex: Bangladesh" value="<?php echo $country; ?>" required>
                    <span class="pink"><?php echo $countryErr; ?></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="countryCode">Country Code <span class="red">*</span></label>
                    <input type="text" class="form-control" id="countryCode" name="countryCode" maxlength="7" placeholder="ex: 880" value="<?php echo $countryCode; ?>" required>
                    <span class="pink"><?php echo $countryCodeErr; ?></span>
                </div>
            </div>
            <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</body>
</html>