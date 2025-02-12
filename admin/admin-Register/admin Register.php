<?php require 'script.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="Admin_form">
<h2>Admin Register</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <p><span class="error"> <?php echo $RequirErr ; ?></span></p>
    <p><span class="error"> <?php echo $UserErr; ?></span></p>
    <p><span class="error"> <?php echo $SuccessErr; ?></span></p>

    <div class="input-box">
        <label>Username</label>
        <input type="text" name="username">
        <br>
        <span class="error"><?php echo $usernameErr;?></span>
    </div>
    <div class="input-box">
        <label>Password</label>
        <input type="password" name="password">
        <br>
        <span class="error"><?php echo $passwordErr;?></span>
    </div>

    <div class="input-box">
        <label>firstname</label>
        <input type="firstname" name="firstname">
        <br>
        <span class="error"><?php echo $firstnameErr;?></span>
    </div>

    <div class="input-box">
        <label>lastname</label>
        <input type="lastname" name="lastname">
        <br>
        <span class="error"><?php echo $lastnameErr;?></span>
    </div>

    <div class="input-file">
        <label>Photo</label>
        <input type="file" name="image">
    </div>

    <input type="submit" name="submit" value="Sign In" class="SignInbtn">

    </form>
</div>

<?php
 
?>
</body>
</html>