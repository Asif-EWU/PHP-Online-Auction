<?php 
    require_once("../includes/database.php");

    $ownerId = $_SESSION["id"];
    $errCount = 0;
    $name = $basePrice = $description1 = $description2 = $description3 = $description4 = $description5 = $imageName1 = $imageName2 = $imageName3 = "";
    $image1Err = $image2Err = $image3Err = $status = "";

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $basePrice = $_POST['price'];
        $description1 = $_POST['description1'];
        $description2 = $_POST['description2']; 
        $description3 = $_POST['description3'];
        $description4 = $_POST['description4'];
        $description5 = $_POST['description5']; 
        $imageName1 = $_FILES["image1"]["name"];
        $imageName2 = $_FILES["image2"]["name"];
        $imageName3 = $_FILES["image3"]["name"];
        
        // for image handling
        $targetDir = "../uploads/";
        $temp1 = explode(".", $imageName1);
        $temp2 = explode(".", $imageName2);
        $temp3 = explode(".", $imageName3);
        $newImageName1 = round(microtime(true)) . 'a.' . end($temp1);
        $newImageName2 = round(microtime(true)) . 'b.' . end($temp2);
        $newImageName3 = round(microtime(true)) . 'c.' . end($temp3);
        $targetFile1 = $targetDir . $newImageName1;
        $targetFile2 = $targetDir . $newImageName2;
        $targetFile3 = $targetDir . $newImageName3;

        if(! $check1 = getimagesize($_FILES["image1"]["tmp_name"]) ) {
            $image1Err = "File is not an image";
            $errCount++;
        }
        if(! $check2 = getimagesize($_FILES["image2"]["tmp_name"]) ) {
            $image2Err = "File is not an image";
            $errCount++;
        }
        if(! $check3 = getimagesize($_FILES["image3"]["tmp_name"]) ) {
            $image3Err = "File is not an image";
            $errCount++;
        }

        if(! $errCount) {
            $query = "INSERT INTO product(owner_id, name, base_price, image1, image2, image3, description1, description2, description3, description4, description5) 
            VALUES ('$ownerId', '$name', '$basePrice', '$newImageName1', '$newImageName2', '$newImageName3', '$description1', '$description2', '$description3', '$description4', '$description5')";
            if(mysqli_query($db, $query)) {
                $status = "<p class='alert alert-success'>Request Sent !!</p>";
                move_uploaded_file($_FILES["image1"]["tmp_name"], $targetFile1);
                move_uploaded_file($_FILES["image2"]["tmp_name"], $targetFile2);
                move_uploaded_file($_FILES["image3"]["tmp_name"], $targetFile3);
                header("Refresh: 1");
            }
            else {
                $status = "<p class='alert alert-success'>Request Failed !!</p>";
                echo("Error description: " . mysqli_error($db));
            }
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
</head>
<style>
    .pink {color: red;}
</style>
<body>
    <?php include('../includes/admin_navbar.php'); ?>    

    <div class="container mt-5">
        <?php echo $status; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Product Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter Product Name" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="base_price" class="col-sm-3 col-form-label">Base Price</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="base_price" min="0" step=".01" pattern="^\d*(\.\d{0,2})?$" name="price" value="<?php echo $basePrice; ?>" placeholder="Enter Base Price up to 2 decimal points" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description1" class="col-sm-3 col-form-label">Description 1</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="description1" name="description1" value="<?php echo $description1; ?>" placeholder="Enter Description of Product" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description2" class="col-sm-3 col-form-label">Description 2</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="description2" name="description2" value="<?php echo $description2; ?>" placeholder="Enter Description of Product" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description3" class="col-sm-3 col-form-label">Description 3</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="description3" name="description3" value="<?php echo $description3; ?>" placeholder="Enter Description of Product" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description4" class="col-sm-3 col-form-label">Description 4</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="description4" name="description4" value="<?php echo $description4; ?>" placeholder="Enter Description of Product" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description5" class="col-sm-3 col-form-label">Description 5</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="description5" name="description5" value="<?php echo $description5; ?>" placeholder="Enter Description of Product" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="image1" class="col-sm-3 col-form-label">Image 1 (Display Image)</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control-file" name="image1" id="image1" required>
                    <span class="pink"><?php echo $image1Err; ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="image2" class="col-sm-3 col-form-label">Image 2</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control-file" name="image2" id="image2" required>
                    <span class="pink"><?php echo $image2Err; ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="image3" class="col-sm-3 col-form-label">Image 3</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control-file" name="image3" id="image3" required>
                    <span class="pink"><?php echo $image3Err; ?></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-9">
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>