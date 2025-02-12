<?php require 'Registering_fatch.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/Registering.css">
</head>
<body>
    <div class="Registering_form">
        <h2>Register to vote</h2><a class="close" href="index.php">&times;</a>

        <?php
        if(isset($_SESSION['Status'])){
            echo "<p>".$_SESSION['Status']."</p>";
            unset($_SESSION['Status']);
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="input-box">
                <label>First Name</label>
                <input type="text" name="firstname">
                <span class="error"><?php echo $firstnameErr;?></span>
            </div>

            <div class="input-box">
                <label>Last Name </label>
                <input type="text" name="lastname">
                <span class="error"><?php echo $lastnameErr;?></span>
            </div>

            <div class="input-box">
                <label>ID</label>
                <input type="text" name="idnumber">
                <span class="error"><?php echo $idErr;?></span>
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo $passwordErr;?></span>
            </div>

            <div class="input-file">
                <label>Photo</label>
                <input type="file" name="photo">
            </div>

            <input type="submit" name="Register" value="Register" class="Registerbtn">

            <div class="Registering_link">
                <p>
                    Already have Registered 
                    <a href="Login.php">Login to Vote</a>
                </p>
            </div>
        </form>

    </div>
</body>
</html>