<?php 
require 'php/homepage_Admin.php';
require 'php/Ballot_Positison_fetch.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-css/ballot_Position.css">
    <title>Ballot Positions</title>
</head>
<body>
<header>
    <h1>Voting System</h1>
    <nav class="navmenu">
    <div class="dropdown">
    <button class="dropbtn"> 
        <p class="user-info">
            <span class="user-name">
                <?php echo $Firstname;  ?> 
                <?php echo $Lastname;  ?>
            </span>

            <img src='<?php echo $image;  ?>'  class='user-pic'> 
        </p> 
    </button>
    <div class="dropdown-content">
        <ul>
            <li class="user-header">
            <img src='<?php echo $image;  ?>'  class='image-circle'>
            <p><?php echo $Firstname;  ?> <?php echo $Lastname;  ?></p>
            <small>Member since <?php echo date('M. Y', strtotime($created)) ;?></small>  
            </li>
            <li class="user-footer">
                <button><a href="php/Admin_Edit.php">Update</a></button>
                <button><a href="logout.php">Sign out</a></button>
            </li>
        </ul>
    </div>
    </div>
    </nav>
</header>
<section>
    <div class="sidenav">
     <ul>
        <li class="header">REPORTS</li>
        <li class=""><a href="home.php">Dashboard</a></li>
        <li class=""><a href="Votes.php">Votes</a></li>
        <li class="header">MANAGE</li>
        <li class=""><a href="Voters.php">Voters</a></li>
        <li class=""><a href="Positions.php">Positions</a></li>
        <li class=""><a href="Candidates.php">Candidates</a></li>
        <li class="header">SETTINGS</li>
        <li class="active"><a href="Ballot Position.php">Ballot Position</a></li>
        <li class=""><a href="Election Title.php">Election Title</a></li>
     </ul>   
    </div>
</section>

<section>
    <div class="main">
        <h2>Ballot Position</h2>
    
        <?php
            // Fetch positions and candidates from the database
        
            $conn = new mysqli("localhost", "root", "", "online_voting_system");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, description, max_vote FROM positions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='position'>";
                    echo "<h2>" . $row['description'] . "</h2>";

                    $position_id = $row['id'];
                    $max_votes = $row['max_vote'];

                    // Change the name to an array if max_votes > 1
                    $input_name = ($max_votes > 1) ? "position_$position_id" . "[]" : "position_$position_id";

                    $sql_candidates = "SELECT id, Logo, photo, Abbr, party_name FROM candidates WHERE position_id=$position_id";
                    $result_candidates = $conn->query($sql_candidates);

                    if ($result_candidates->num_rows > 0) {
                        while($candidate = $result_candidates->fetch_assoc()) {
                            echo "<label class='candidate-label'>";

                            echo "<input type='" . ($max_votes > 1 ? 'checkbox' : 'radio') . "' name='" . $input_name . "' value='" . $candidate['id'] . "'>";

                            if (!empty($candidate['Logo'])) {
                                echo "<img src='php/image/" . $candidate['Logo'] . "' class='candidate-photo' alt='Candidate Photo'>";
                            } else {
                                echo "<img src='php/image/logo.png' class='candidate-photo' alt='Default Logo'>";
                            }

                            echo "<span class='candidate-abbr'>" . $candidate['Abbr'] . "</span>";

                            if (!empty($candidate['photo'])) {
                                echo "<img src='php/image/" . $candidate['photo'] . "' class='candidate-photo' alt='Candidate Photo'>";
                            } else {
                                echo "<img src='php/image/UserProfile.png' class='candidate-photo' alt='Default Logo'>";
                            }

                            echo "<span class='candidate-party'>" . $candidate['party_name'] . "</span>";

                            echo "</label><br>";
                        
                        }
                    }

                    echo "</div>";
                }
            } else {
                
            }
            $conn->close();
            ?>

    </div>
</section>

<script>
        // Toggle dropdown visibility when the button is clicked
document.querySelector('.dropbtn').addEventListener('click', function() {
    document.querySelector('.dropdown-content').classList.toggle('show');
});

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn') && !event.target.matches('.dropbtn *')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}


</script>
</body>
</html>