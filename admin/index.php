<?php require 'php/AdminLogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>
</head>
<body>

<div class="Admin_form">
<h2>Admin</h2>
<form method="post" action="">
<p><span class="error"> <?php echo $RequirErr; ?></span></p>
<p><span class="error"> <?php echo $Invalid; ?></span></p>
    <div class="input-box">
        <label>Username</label>
        <input type="text" name="username" id="">
        <span class="error"> <?php echo $usernameErr;?></span>
    </div>
    <div class="input-box">
        <label>Password</label>
        <input type="password" name="password" id="">
        <span class="error"> <?php echo $passwordErr;?></span>
    </div>

    <input type="submit" name="submit" value="Sign In" class="SignInbtn">

    </form>
</div>
    
</body>
</html>