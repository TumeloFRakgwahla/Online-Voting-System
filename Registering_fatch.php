<?php

$firstnameErr = $lastnameErr = $idErr = $passwordErr = "";
$firstname = $lastname = $image = $id = $password ="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
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

  

  if (empty($_POST["password"])){
    $passwordErr  = "* Password is requied";
  } else{
    $password = test_input($_POST["password"]);
    $number = preg_match('@[0-9]@', $password);
 
    if(strlen($password) < 4 ) {
    $passwordErr = "Password must be at least 4 characters";
   }
  }
  
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if(isset($_POST['Register']))
    {
     $link =mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
     if($link===false){
        die("Error: COULD NOT CONNECT" . mysqli_connect_error());
     }
 
      $firstname=mysqli_real_escape_string($link,$_REQUEST['firstname']);
      $lastname=mysqli_real_escape_string($link,$_REQUEST['lastname']);
      $id=mysqli_real_escape_string($link,$_REQUEST["idnumber"]);
      $password=mysqli_real_escape_string($link,$_REQUEST['password']);
      $image = $_FILES['photo']['name'];

      if(!empty($image)){
        move_uploaded_file($_FILES['photo']['tmp_name'], 'admin/php/image/'.$image);	
      }else{
        //echo 'sorry the image was not uploaded' ;
      }
   

      $enc_password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "SELECT * FROM `voters` WHERE Idnumber = '$id'";
      
      $result = mysqli_query($link,$sql);
      if($result){
        $num=mysqli_num_rows($result);
        if($num>0){

          //$UserErr;
          $_SESSION['Status'] = "<div class='alertDanger' role='alert'> 
          <strong>Error: </strong> Voter with this ID Number already exists.
          </div>";
          
        }else{

        if($idErr == "" && $passwordErr == "" && $firstnameErr == "" && $lastnameErr == ""){

           $sql="INSERT INTO `voters`(`firstname`, `lastname`, `Idnumber`, `password`, `photo`)
                                 VALUES('$firstname','$lastname','$id','$enc_password','$image')";
if (empty($_POST["idnumber"])) {
    $idErr = "* ID is required";
  } else {
    $id = test_input($_POST["idnumber"]);

    // Assuming the ID number format is YYMMDDxxxxxx (first 6 digits are birth date)
    $dob = substr($id, 0, 6);  // Extract the birth date from ID
    $birthYear = substr($dob, 0, 2);  // YY
    $birthMonth = substr($dob, 2, 2);  // MM
    $birthDay = substr($dob, 4, 2);  // DD

    // Convert YY to full year based on whether it's in the 1900s or 2000s
    $currentYear = date("Y");
    $currentCentury = substr($currentYear, 0, 2);
    $birthYearFull = ($birthYear > date("y")) ? ($currentCentury - 1) . $birthYear : $currentCentury . $birthYear;

    $birthDate = $birthYearFull . "-" . $birthMonth . "-" . $birthDay;  // YYYY-MM-DD format
    $age = (date("Y") - $birthYearFull) - ((date("md") < $birthMonth . $birthDay) ? 1 : 0);

    if ($age < 18) {
      $idErr = "You must be 18 or older to register.";
    }
  }
        
        $result = mysqli_query($link,$sql);
      if($result){

           //$SuccessErr;
           $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
          <strong>Success </strong> Registertion was successfully 
          </div>";
        }else{

          die(mysqli_error($link));
          echo "<h3> <b>You didn't filled up the form correctly.</b> </h3>";
       }
        }else{

          //$RequirErr;
          $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
          <strong>Error </strong> * required field.
          </div>";

       
        }
        }
      }
}