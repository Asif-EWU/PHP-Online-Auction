<?php
    function filterInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = $email = $password = $password2 = $address = $city = $country = $countryCode = $gender = "";
    $nameErr = $emailErr = $passwordErr = $addressErr = $cityErr = $countryErr = $countryCodeErr = $ageErr = "";
    $spaceRegex = "/\s\s+/";
    $nameRegex = "/^[a-zA-Z'\. ]*$/";
    $emailRegex = "/^[a-z\d\._-]+@([a-z\d-]+\.)+[a-z]{2,6}$/i";
    $countryCodeRegex = "/^\d{1-3}(-\d{3-4})?$/";

    if(isset($_POST["submit"])) {
        // Name
        $name = filterInput($_POST["name"]);
        $name = ucwords($name);
        $name = preg_replace($spaceRegex, ' ', $name);

        if(!preg_match($nameRegex, $name)) {
            $nameErr = "* Invalid name";
        }

        // Email
        $email = filterInput($_POST['email']);
        if(!preg_match($emailRegex, $email)) {
            $emailErr = "* Invalid email";
        }

        // Password
        $password = $_POST['password1'];
        $password2 = $_POST['password2']; 
        if($password !== $password2) $passwordErr = "* Passwords don't match";

        // Address
        $address = filterInput($_POST['address']);
        $address = preg_replace($spaceRegex, ' ', $address);
        if(strlen($address) < 10) $addressErr = "* Incomplete address";

        // City
        $city = filterInput($_POST['city']);
        if(!strlen($city)) $cityErr = "* Invalid city";

        // Country
        $country = filterInput($_POST['country']);
        if(!strlen($country)) $countryErr = "* Invalid country";

        // Country Code
        $countryCode = $_POST["countryCode"];
        if(!preg_match($countryCodeRegex, $countryCode)) $countryCodeErr = "* Invalid country code";

        // Date of Birth
        $dob = $_POST['dob'];
        $todayDate = date("Y-m-d");
        $birthYear = explode('-', $dob)[0];
        $thisYear = explode('-', $todayDate)[0];
        $age = $thisYear - $birthYear;
        if($age < 18) $ageErr ="* Too young to register";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/register.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Auction - Registration</title>
</head>
<body>
    <img class="bg-image" src="images/judge.jpg" alt="">
    <div class="dark-overlay"></div>

    <div class="container">
        <div class="log-in">
            <div class="text-center">
                <img src="images/auction.png" alt="">
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Full Name <span class="red">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Muhammad Abu Bakar Siddique" value="<?php echo $name; ?>" minlength="5" maxlength="35" required>
                        <span class="pink"><?php echo $nameErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email <span class="red">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" maxlength="35" required>
                        <span class="pink"><?php echo $emailErr; ?></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password1">Password <span class="red">*</span></label>
                        <input type="password" class="form-control" id="password1" name="password1" minlength="6" maxlength="20" placeholder="Password" value="<?php echo $password; ?>" required>
                        <span class="pink"><?php echo $passwordErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password2">Confirm Password <span class="red">*</span></label>
                        <input type="password" class="form-control" id="password2" name="password2" minlength="6" maxlength="20" placeholder="Confirm Password" value="<?php echo $password2; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address <span class="red">*</span></label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo $address; ?>" required>
                    <span class="pink"><?php echo $addressErr; ?></span>
                    </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="city">City <span class="red">*</span></label>
                        <input type="text" class="form-control" id="city" name="city" maxlength="20" placeholder="City" value="<?php echo $city; ?>" required>
                        <span class="pink"><?php echo $cityErr; ?></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="country">Country <span class="red">*</span></label>
                        <input type="text" class="form-control" id="country" name="country" maxlength="20" placeholder="Country" value="<?php echo $country; ?>" required>
                        <span class="pink"><?php echo $countryErr; ?></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="countryCode">Country Code <span class="red">*</span></label>
                        <input type="text" class="form-control" id="countryCode" name="countryCode" maxlength="7" placeholder="Country Code" value="<?php echo $countryCode; ?>" required>
                        <span class="pink"><?php echo $countryCodeErr; ?></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dob">Date of Birth <span class="red">*</span></label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>" required>
                        <span class="pink"><?php echo $ageErr; ?></span>
                    </div>
                </div>
                <div class="form-check h5">
                    <input class="form-check-input" type="checkbox" id="allow" required>
                    <label class="form-check-label" for="allow">
                        I agree to allow cookies to this website
                    </label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Sign Up</button>
            </form>

            <p class="login-instead text-center">Already have an account? <a href="index.php">Login Instead</a></p>
        </div>
    </div>
</body>
</html>