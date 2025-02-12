<?php
if(isset($_POST['add'])){

    $link =mysqli_connect("localhost","root","","online_voting_system");
    if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
    }
    
    $postion =$_POST['position'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $image = $_FILES['image']['name'];
    $Abbr = $_POST['Abbrivation'];
    $logo = $_FILES['logo']['name'];
    $partyName = $_POST['partyName'];

    if(!empty($image)){
      move_uploaded_file($_FILES['image']['tmp_name'], 'php/image/'.$image);	
    }else{
      echo 'sorry the image was not uploaded' ;
    }

    if(!empty($logo)){
      move_uploaded_file($_FILES['logo']['tmp_name'], 'php/image/'.$logo);	
    }else{
      echo 'sorry the image was not uploaded' ;
    }

    $sql = "INSERT INTO `candidates`(`position_id`, `firstname`, `lastname`, `photo`, `Abbr`, `Logo`, `party_name`) 
    VALUES ('$postion','$firstName','$lastName','$image','$Abbr','$logo','$partyName')";
    
    $result = mysqli_query($link, $sql);

    if ($result=== TRUE) {

        $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
        <strong>Success! </strong> Candidates added successfully
        </div>";
  
      }else{
  
        $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
        <strong>Error </strong> Candidates adding was unsccessfully
        </div>";
  
      }
      
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    
    }
?>