<?php require 'Login_fatch.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Login.css">
    <title>Login</title>
</head>
<body>
    <div class="Login_form">
    <h2>Login to Vote</h2><a class="close" href="index.php">&times;</a>

    <p><span class="error"> <?php echo $RequirErr; ?></span></p>
    <p><span class="error"> <?php echo $Invalid; ?></span></p>
    
    <form method="post" action="">
        <div class="input-box">
            <label>RSA ID</label>
            <input type="ID" name="idnumber">
            <span class="error"> <?php echo $idErr;?></span>
        </div>
        <div class="input-box">
            <label>password</label>
            <input type="password" name="password">
            <span class="error"> <?php echo $passwordErr;?></span>
        </div>

        <input type="submit" name="Login" value="Login" class="Loginbtn">
        
        <div class="Registering_link">
            <p>
                Haven't registered yet?
                <a href="Registering.php">Register</a>
            </p>
        </div>
    </form>
        
    </div>
</body>
</html>