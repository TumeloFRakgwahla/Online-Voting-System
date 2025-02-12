<?php

if(isset($_POST['add'])){

    $link =mysqli_connect("localhost","root","","online_voting_system");
    if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
    }
    

    $description = $_POST['Description'];
    $max_vote = $_POST['Max_vote'];
    
    $sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
	$result = $link->query($sql);
	$row = $result->fetch_assoc();

	$priority = $row['priority'] + 1;
    
    $sql = "INSERT INTO `positions`(`description`, `max_vote`, `priority`) 
    VALUES ('$description','$max_vote','$priority')";
    
    $result = mysqli_query($link, $sql);
    
    if ($result) {

        $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
        <strong>Success! </strong> Votes reset successfully
        </div>";
    }else{

        $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
        <strong>Error </strong> Votes adding was unsuccessfully
        </div>";
    
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    }

?>