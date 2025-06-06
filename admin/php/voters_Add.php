<?php
session_start();

if(isset($_POST['add'])){

    $link = mysqli_connect('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
    if($link === false){
        die("Error: COULD NOT CONNECT" . mysqli_connect_error());
    }
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $idNumber = $_POST['idNumber'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];
    $enc_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the voter already exists in the database
    $sql = "SELECT * FROM voters WHERE Idnumber = '$idNumber'";
    $result = mysqli_query($link, $sql);

    if(mysqli_num_rows($result) > 0) {
        // Voter already exists
        $_SESSION['Status'] = "<div class='alertDanger' role='alert'> 
        <strong>Error: </strong> Voter with this ID Number already exists.
        </div>";
    } else {
        // Proceed with adding the voter
        if(!empty($image)){
            move_uploaded_file($_FILES['image']['tmp_name'], 'php/images/'.$image);	
        } else {
            echo 'Sorry, the image was not uploaded.';
        }

        $sql = "INSERT INTO `voters`(`firstname`, `lastname`, `Idnumber`, `password`, `photo`) 
        VALUES ('$firstName','$lastName','$idNumber','$enc_password','$image')";
        
        $result = mysqli_query($link, $sql);
        
        if ($result === TRUE) {
            $_SESSION['Status'] = "<div class='alertSuccess' role='alert'> 
            <strong>Success! </strong> Voter added successfully.
            </div>";
        } else {
            $_SESSION['Status'] = "<div class='alertDanger' role='alert'> 
            <strong>Error: </strong> Voter adding was unsuccessful.
            </div>";
        }
    }
    
    
}
?>
