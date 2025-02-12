<?php
session_start();

$link =mysqli_connect("localhost","root","","online_voting_system");
if($link===false){
   die("Error: COULD NOT CONNECT" . mysqli_connect_error());
}

$record_id = $_GET['id'];

$sql ="SELECT * FROM positions WHERE id = '$record_id'  ";

$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0){

   foreach($result as $rows){
    
    $Description = $rows['description'];
    $Max_vote = $rows['max_vote'];  
   }
}

if(isset($_POST['Update'])){

    $description = $_POST['Description'];
    $max_vote = $_POST['Max_vote'];
    
    $sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
	$result = $link->query($sql);
	$row = $result->fetch_assoc();

	$priority = $row['priority'] + 1;

    
    $sql = "UPDATE `positions` SET `description`='$description',
    `max_vote`='$max_vote',`priority`='$priority' WHERE id = $record_id";

    
    $result = mysqli_query($link, $sql);
    
    if ($result=== TRUE) {
        header('location:../Positions.php');
        $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
        <strong>Success! </strong> Position updated successfully
        </div>";
        

    }else{

        $_SESSION['Status'] = "<div class='alertDanger' role='alart'> 
        <strong>Error </strong> Position update unsccessfully
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
    height: 280px;
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
            <h2>Update Posotion</h2>
                <form method="post" action="">
                    <div class="input-box">
                    <label>Desciption</label>
                    <input type="text" name="Description" value="<?php echo $Description; ?>">
                    </div>
    
                    <div class="input-box">
                    <label>Maximum Vote</label>
                    <input type="text" name="Max_vote" value="<?php echo $Max_vote; ?>">
                    </div>
                    
                    <div class=btns>
                    <input type="button" value="Close" class="btn" onclick="window.location.href='../Positions.php';">
                    <input type="submit" name="Update"  value="Save" class="btn">
                    </div>
                    
                    </form>
                
            </div>
        </div>
</body>
</html>