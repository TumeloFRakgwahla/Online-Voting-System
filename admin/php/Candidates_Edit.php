<?php
 session_start();
$link =mysqli_connect("localhost","root","","online_voting_system");
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }

 $sql ="SELECT * FROM `positions`";

 $result = mysqli_query($link, $sql);

$link =mysqli_connect("localhost","root","","online_voting_system");
if($link===false){
   die("Error: COULD NOT CONNECT" . mysqli_connect_error());
}

$record_id = $_GET['id'];

$sql ="SELECT * FROM candidates WHERE id = '$record_id' ";

$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0){

   foreach($result as $rows){
    
    $Position_id = $rows['position_id'];
    $Firstname  = $rows['firstname']; 
    $Lastname =$rows['lastname'];
    $Abbr = $rows['Abbr'];
    $Party_Name = $rows['party_name'];
   }
}

if(isset($_POST['Update'])){

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

    $sql = "UPDATE `candidates` SET `position_id`='$postion',`firstname`='$firstName',
    `lastname`='$lastName',`photo`='$image',`Abbr`='$Abbr',`Logo`='$logo',
    `party_name`='$partyName' WHERE id = $record_id";

    
    $result = mysqli_query($link, $sql);
    
    if ($result=== TRUE) {
        header('location:../Candidates.php');
        $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
        <strong>Success! </strong> Candidates updated successfully
        </div>";
        

    }else{

        $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
        <strong>Error </strong> Candidates update unsccessfully
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

.option{
    padding: 10px 10px;
    margin: 10px 50px;
    width: 50%;
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
    height: 550px;
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
            <h2>Update Candidate</h2>
            <form method="post" action="" enctype="multipart/form-data">
                    <div class="input-box">
                    <label>Firstname</label>
                    <input type="text" name="firstName" value="<?php echo $Firstname; ?>">
                    </div>
    
                    <div class="input-box">
                    <label>Lastname</label>
                    <input type="text" name="lastName" value="<?php echo $Lastname; ?>">
                    </div>

                    <div class="input-box">
                    <label>Positions</label>
                    <select name="position"  class="option">
                        <option> -Select-</option>
                    <?php
                        // Step 5: Generate the HTML Options
                        $sql = "SELECT `id` , `description` FROM positions ";
                        $result = mysqli_query($link, $sql);
                         if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                           echo "<option value='" . $row['id'] . "'>" . $row['description'] . "</option>";
                          }
                          } else {
                          echo "<option>No data found</option>";
                          }
                    ?>
                    </select>
                    </div>

                    <div class="input-box">
                    <label>Photo</label>
                    <input type="File" name="image" value="<?php echo $Photo; ?>">
                    </div>

                    <div class="input-box">
                    <label>Abbr</label>
                    <input type="text" name="Abbrivation" value="<?php echo $Abbr; ?>">
                    </div>

                    <div class="input-box">
                    <label>Logo</label>
                    <input type="File" name="logo" value="<?php echo $Logo; ?>">
                    </div>

                    <div class="input-box">
                    <label>Party Name</label>
                    <input type="text" name="partyName" value="<?php echo $Party_Name; ?>">
                    </div>
                    
                    <div class=btns>
                    <input type="button" value="Close" class="btn" onclick="window.location.href='../Candidates.php';">
                    <input type="submit" name="Update"  value="Update" class="btn">
                    </div>
                    
                    </form>
                
            </div>
        </div>
</body>
</html>