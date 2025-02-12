<?php
session_start();

$link =mysqli_connect("localhost","root","","online_voting_system");
if($link===false){
   die("Error: COULD NOT CONNECT" . mysqli_connect_error());
}

$record_id = $_GET['id'];

$sql ="SELECT * FROM voters WHERE id = '$record_id'  ";

$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0){

   foreach($result as $rows){
    
    $FirstName = $rows['firstname'];
    $LastName = $rows['lastname'];
    $IdNumber = $rows['Idnumber'];
    $Password = $rows['password'];   
   }
}

if(isset($_POST['Update'])){

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $idNumber = $_POST['idNumber'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];
    $enc_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if a new password is provided
     if (!empty($_POST['password'])) {
        $Password = $_POST['password'];
        $enc_password = password_hash($Password, PASSWORD_DEFAULT);
      } else {
        $enc_password = $password;  // Use the current password if no new password is entered
      }

      if(!empty($image)){
        move_uploaded_file($_FILES['image']['tmp_name'], 'image/'.$image);	
      }else{
        echo 'sorry the image was not uploaded' ;
      }
    
    $sql = "UPDATE `voters` SET`firstname`='$firstName',`lastname`='$lastName',
    `Idnumber`='$idNumber',`password`='$enc_password',`photo`='$image' WHERE id = $record_id";

    
    $result = mysqli_query($link, $sql);
    
    if ($result=== TRUE) {
        header('location:../Voters.php');
        $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
        <strong>Success! </strong> Voter updated successfully
        </div>";
        

    }else{

        $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
        <strong>Error </strong> Voter update unsccessfully
        </div>";
       

    }
            
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
*{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}

body{
    background-color: #555;
}
.alert_box label{
    display:inline-block;
    width: 140px;
    text-align: right;
}

.alert_box input{
    padding: 10px 10px;
    margin: 10px 50px;
    width: 50%;
}

.btn{
  display: inline-flex;
  height: 50px;
  font-size: 17px;
  font-weight: 400;
  cursor: pointer;
  outline: none;
  border: none;
  color: #fff;
  background-color: #555;
  transition: all 0.3s ease;
}  

.container{
  padding: 10px 0;
}

.alert_box{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50% , -50%);
}

.alert_box{
    padding: 20px;
    background: grey;
    flex-direction: column;
    align-items: center;
    text-align: center;
    max-width: 600px;
    width: 100%;
    height: 450px;
    transform: translate(-50% , -50%) scale(0.97);
    transition: all 0.3s ease;
}

.btns{
    display: flex;
}

</style>
<body>
<div class="container">
            <div class="alert_box">
                <h2>Update Voter</h2>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="input-box">
                    <label>Firstname</label>
                    <input type="text" name="firstName" value="<?php echo $FirstName; ?>">
                    </div>
    
                    <div class="input-box">
                    <label>Lastname</label>
                    <input type="text" name="lastName" value="<?php echo $LastName; ?>" >
                    </div>

                    <div class="input-box">
                    <label>ID</label>
                    <input type="text" name="idNumber" value="<?php echo $IdNumber; ?>">
                    </div>

                    <div class="input-box">
                    <label>Password</label>
                    <input type="password" name="password" value="">
                    </div>

                    <div class="input-box">
                    <label>Photo</label>
                    <input type="File" name="image">
                    </div>
                    
                    <div class=btns>
                    <input type="button" value="Close" class="btn" onclick="window.location.href='../Voters.php';">
                    <input type="submit" name="Update"  value="Save" class="btn">
                    </div>
                    
                    </form>
                
            </div>
        </div>
</body>
</html>