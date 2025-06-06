<?php
session_start();
$SuccessErr = $RequirErr = "";

$link =mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
if($link===false){
   die("Error: COULD NOT CONNECT" . mysqli_connect_error());
}

$sql ="DELETE FROM `votes`";

$result = mysqli_query($link, $sql);

if($result){

    $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
    <strong>Success! </strong> Votes reset successfully
    </div>";
    header('location:../Votes.php');
}else{
    
    $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
    <strong>Error </strong> Votes reset unsccessfully
    </div>";
    header('location:../Votes.php');
}



?>