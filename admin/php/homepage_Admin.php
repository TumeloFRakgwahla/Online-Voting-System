<?php
session_start();
if(!isset($_SESSION['username'])){
	header ('location: index.php');
}

$user = $_SESSION['username'];

$link =mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }


$sql ="SELECT * FROM `admin` WHERE username ='$user'";

$result = mysqli_query($link, $sql);

if($result->num_rows >0){
    while($row = $result->fetch_assoc()){
        $Firstname = $row['firstname'];
        $Lastname = $row['lastname'];
        if(!empty($row['photo'])){
            $image = "php/image/".$row['photo']; 
        }else{
            $image ='php/image/UserProfile.png';
        }
        $created = $row['created_on'];
    }
   }

?>