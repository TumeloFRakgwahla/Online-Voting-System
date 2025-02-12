<?php 
require 'php/homepage_Admin.php';
require 'php/VotesList.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-css/votes.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css">
    <title>Votes</title>
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
        <li class="active"><a href="Votes.php">Votes</a></li>
        <li class="header">MANAGE</li>
        <li class=""><a href="Voters.php">Voters</a></li>
        <li class=""><a href="Positions.php">Positions</a></li>
        <li class=""><a href="Candidates.php">Candidates</a></li>
        <li class="header">SETTINGS</li>
        <li class=""><a href="Ballot Position.php">Ballot Position</a></li>
        <li class=""><a href="Election Title.php">Election Title</a></li>
     </ul>   
    </div>
</section>

<section>
    <div class="main">
        <h2>Votes</h2>

        <?php
        if(isset($_SESSION['Status'])){
            echo "<p>".$_SESSION['Status']."</p>";
            unset($_SESSION['Status']);
        }
        ?>

        <div class="container">
            <input type="checkbox" id="check">
            <label class="restbtn" for="check">Reset</label>
            <div class="background" id="background"></div>
            <div class="alert_box">
                <span class="close_button" id="closeBtn"><i class="fa-solid fa-xmark"></i></span>
                <h2>RESET VOTES</h2>
                <p>This will delete all votes and counting back to 0</p>
                <div class="btns">
                    <label for="check"><a href="php/votes_reset.php">Delete</a></label>
                    <label for="check">Cancel</label>
                </div>
            </div>
        </div>

        <table id="VotesTable">
            <thead>
            <tr>
                <th> Position </th>
                <th> Candidate </th>
                <th> Voter </th>
                <th>Date And Time </th>
            </tr>
            </thead>
            <tbody>
                <?php
                while($rows=$result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $rows['description'];?></td>
                    <td><?php echo $rows['canfirst'] .' '. $rows['canlast'];?></td>
                    <td><?php echo $rows['votfirst'] .' '. $rows['votlast'];?></td>
                    <td><?php echo $rows['DateTime_of_Vote']?></td>
                </tr>
                <?php
                }
                ?>
                
            </tbody>
        </table>
    </div>
</section>

<script src="https://kit.fontawesome.com/097e064a27.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>

<script>
    $(document).ready(function() {
      $('#VotesTable').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
      });
    });
</script>
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

// Close the alert box when the close button is clicked
            document.getElementById('closeBtn').onclick = function() {
            document.getElementById('check').checked = false;
        };

        // Close the alert box when clicking outside of it
        document.getElementById('background').onclick = function() {
            document.getElementById('check').checked = false;
        };
</script>
</body>
</html>