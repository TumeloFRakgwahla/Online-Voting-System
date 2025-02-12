<?php
$link =mysqli_connect("localhost","root","","online_voting_system");
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }

 $sql ="SELECT * FROM `voters`";

 $result = mysqli_query($link, $sql);

?>