<?php
session_start();
if(!isset($_SESSION['idunmber'])){
	header ('location: index.php');
}

$id = $_SESSION['idunmber'];

$link =mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }


$sql ="SELECT * FROM `voters` WHERE Idnumber ='$id'";

$result = mysqli_query($link, $sql);

if($result->num_rows >0){
    while($row = $result->fetch_assoc()){
        $ID = $row['id'];
        $Firstname = $row['firstname'];
        $Lastname = $row['lastname'];
        if(!empty($row['photo'])){
            $image = "admin/php/image/".$row['photo']; 
        }else{
            $image ='admin/php/image/UserProfile.png';
        }
    }
   }

   

?>