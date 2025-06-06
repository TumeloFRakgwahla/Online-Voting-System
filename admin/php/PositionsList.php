<?php
$link =mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }

 $sql ="SELECT * FROM `positions`";

 $result = mysqli_query($link, $sql);

?>