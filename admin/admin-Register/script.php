<?php

$RequiredErr = $UserErr = $SuccessErr = $RequirErr = $usernameErr = $passwordErr = $firstnameErr = $lastnameErr = "";
$username = $password = $firstname = $lastname ="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
  if (empty($_POST["username"])){
    $usernameErr = "* Username is required";
  } else{
    $username = test_input($_POST["username"]);
  } 

  if (empty($_POST["password"])){
    $passwordErr  = "* Password is requied";
  } else{
    $password = test_input($_POST["password"]);
    $number = preg_match('@[0-9]@', $password);
 
    if(strlen($password) < 4 ) {
    $passwordErr = "Password must be at least 8 characters";
   }
  }

  if (empty($_POST["firstname"])){
    $firstnameErr = " * firstname is required";
  } else{
    $firstname = test_input($_POST["firstname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
    $firstnameErr = "Only letters and white space allowed";}
  }

  if (empty($_POST["lastname"])){
    $lastnameErr = "* lastname is required";
  } else{
    $lastname = test_input($_POST["lastname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
    $lastnameErr = "Only letters and white space allowed";}
  }
  
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if(isset($_POST['submit']))
    {
     $link =mysqli_connect("localhost","root","","online_voting_system");
     if($link===false){
        die("Error: COULD NOT CONNECT" . mysqli_connect_error());
     }
 
      $username=mysqli_real_escape_string($link,$_REQUEST["username"]);
      $password=mysqli_real_escape_string($link,$_REQUEST['password']);
      $firstname=mysqli_real_escape_string($link,$_REQUEST['firstname']);
      $lastname=mysqli_real_escape_string($link,$_REQUEST['lastname']);
      $image = $_FILES['image']['name'];

      
   
      $enc_password = password_hash($password, PASSWORD_DEFAULT);

      if(!empty($image)){
        move_uploaded_file($_FILES['image']['tmp_name'], '../php/image/'.$image);	
      }else{
        echo 'sorry the image was not uploaded' ;
      }
      
      $sql = "SELECT * FROM `admin` WHERE username = '$username'  and password = '$password'";
      
      $result = mysqli_query($link,$sql);
      if($result){
        $num=mysqli_num_rows($result);
        if($num>0){

          //$UserErr;
          $UserErr = "<div class='alertDanger' role='alart'> 
          <strong>Oh Sorry  </strong> User already exist.
          </div>";
          
        }else{

        if($usernameErr == "" && $passwordErr == "" && $firstnameErr == "" && $lastnameErr == ""){

           $sql="INSERT INTO `admin` (`username`, `password`, `firstname`, `lastname`, `photo` )
                                 VALUES('$username','$enc_password','$firstname','$lastname', '$image' )";

        
        $result = mysqli_query($link,$sql);
      if($result){

           //$SuccessErr;
           $SuccessErr = "<div class='alertSuccess' role='alart'> 
          <strong>Success </strong> You are successfully signed up
          </div>";
        }else{

          die(mysqli_error($link));
          echo "<h3> <b>You didn't filled up the form correctly.</b> </h3>";
       }
        }else{

          //$RequirErr;
          $RequirErr = "<div class='alertDanger' role='alart'> 
          <strong>Error </strong> * required field.
          </div>";

       
        }
        }
      }
}

if(isset($_POST['load'])){

  // Database connection details
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";     // Replace with your MySQL password
$dbname = "online_voting_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  $sql = "SELECT `id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on` FROM `admin`";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<div>";
          if(!empty($row['photo'])){
            echo "<img src='../php/image/".$row['photo']. "'  style='max-width:200px;'>";
          }else{
            echo "<img src='../php/image/UserProfile.png'  style='max-width:200px;'>";
          }     
          echo "</div>";
      }
  } else {
      echo "No images found.";
  }
}
?>