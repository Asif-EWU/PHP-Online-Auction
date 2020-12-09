<?php
    if(isset($_POST["submit"])) {
        
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
    <div class="bg-image">
        <div class="overlay">
            <div class="container">
                <div class="log-in">
                    <div class="text-center">
                        <img src="images/auction.png" alt=""> 
                        <h1>Registration Form</h1>
                    </div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">First Name <span class="red">*</span></label>
                                <input type="text" class="form-control" id="fname" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lname">Last Name <span class="red">*</span></label>
                                <input type="text" class="form-control" id="lname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone <span class="red">*</span></label>
                                <input type="text" class="form-control" id="phone" placeholder="Phone" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email <span class="red">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address <span class="red">*</span></label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password1">Password <span class="red">*</span></label>
                                <input type="password" class="form-control" id="password1" placeholder="Password" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password2">Confirm Password <span class="red">*</span></label>
                                <input type="password" class="form-control" id="password2" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="city">City <span class="red">*</span></label>
                                <input type="text" class="form-control" id="city" placeholder="City" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="country">Country <span class="red">*</span></label>
                                <input type="text" class="form-control" id="country" placeholder="Country" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="zip">Zip <span class="red">*</span></label>
                                <input type="text" class="form-control" id="zip" placeholder="Zip" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="allow" required>
                                <label class="form-check-label" for="allow">
                                    I aggree to allow cookies to this website
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                    </form>

                    <p class="login-instead text-right">Already have an account? <a href="index.php">Login Instead</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>