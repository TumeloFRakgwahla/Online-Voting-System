<?php
session_start();

$link =mysqli_connect("localhost","root","","online_voting_system");
if($link===false){
die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }


if (isset($_GET['id'])) {
  
  $record_id = $_GET['id'];


  $sql = "DELETE FROM voters WHERE id = $record_id"; 


  if (mysqli_query($link, $sql)) {
  
      $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
      <strong>Success! </strong> Voter delete successfully
      </div>";
     
  } else {
      
      $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
      <strong>Error </strong> Voter delete unsccessfully
      </div>";
  }

  header("Location:../Voters.php");
  exit();

}
?>