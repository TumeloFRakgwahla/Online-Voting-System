<?php
$RequirErr = $usernameErr = $passwordErr = "";
$Invalid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty($_POST["username"] && ["passsword"])){
    $RequirErr = "<div class='alert' role='alart'> 
    <strong>Error </strong> * required field.
    </div>";
  }else{
    $Invalid = "<div class='alert' role='alart'> 
    <strong>Error </strong> Invalid credentials.
    </div>";
  }

  if (empty($_POST["username"])){
    $usernameErr = "* Username is required";
  } else{
    $username;
  }
  if (empty($_POST["password"])){
    $passwordErr  = "* Password is required";
  } else{
    $password;
  }
  
}

if(isset($_POST['submit']))
{
 $link =mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }

  $username=mysqli_real_escape_string($link, $_REQUEST['username']);
  $password=mysqli_real_escape_string($link,$_REQUEST['password']);


$sql = "SELECT * FROM `admin` WHERE `username` = '$username'";

$result = mysqli_query($link,$sql) ;

if( $result){
$num = mysqli_num_rows($result);
if($num>0){
    $row = mysqli_fetch_assoc($result);
    $verify = password_verify($password, $row['password']);
    if($verify==1){
        $Successfully;
        session_start();
        $_SESSION['username'] = $username;
        header('location:home.php');
    
    }
}else{

    $Invalid;

}
}
}

?>