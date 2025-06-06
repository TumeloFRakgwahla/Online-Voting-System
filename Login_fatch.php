<?php
$RequirErr = "";
$Invalid = "";
$idErr = "";
$passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty($_POST["idnumber"] && ["passsword"])){
    $RequirErr = "<div class='alert' role='alart'> 
    <strong>Error </strong> * required field.
    </div>";
  }else{
    $Invalid = "<div class='alert' role='alart'> 
    <strong>Error </strong> Invalid credentials.
    </div>";
  }

  if (empty($_POST["idnumber"])){
    $idErr = "* ID is required";
  } else{
    $id;
  }
  if (empty($_POST["password"])){
    $passwordErr  = "* Password is required";
  } else{
    $password;
  }
 
}


if(isset($_POST['Login']))
{
 $link =mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }

  $id=mysqli_real_escape_string($link, $_REQUEST['idnumber']);
  $password=mysqli_real_escape_string($link,$_REQUEST['password']);


$sql = "SELECT * FROM voters WHERE `Idnumber` = '$id'";

$result = mysqli_query($link,$sql);

if( $result){
$num = mysqli_num_rows($result);
if($num>0){
    $row = mysqli_fetch_assoc($result);
    $verify = password_verify($password, $row['password']);
    if($verify==1){
        $Successfully;
        session_start();
        $_SESSION['idunmber'] = $id;
        header('location: Voting.php');
    
    }
}else{

    $Invalid;

}
}
}

?>