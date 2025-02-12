<?php 
require 'php/homepage_Admin.php';
require 'php/home_conn.php';
require 'php/Tally_votes.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-css/home.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <title>Home</title>
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
        <li class="active"><a href="home.php">Dashboard</a></li>
        <li class=""><a href="Votes.php">Votes</a></li>
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
        <h2>Dashboard</h2>
        <div class="totle-container">
        <div class="project">
        <div class="inner">
              <?php
                $sql = "SELECT * FROM positions";
                $result = mysqli_query($link, $sql);

                echo "<h3>".$result->num_rows."</h3>";
              ?>

              <p>No. of Positions</p>
            </div> 
            <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>

        <div class="project">
        <div class="inner">
              <?php
                $sql = "SELECT * FROM candidates";
                $result = mysqli_query($link, $sql);

                echo "<h3>".$result->num_rows."</h3>";
              ?>
          
              <p>No. of Candidates</p>
            </div>
            <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>

        <div class="project">
        <div class="inner">
              <?php
                $sql = "SELECT * FROM voters";
                $result = mysqli_query($link, $sql);

                echo "<h3>".$result->num_rows."</h3>";
              ?>
             
              <p>Total Voters</p>
            </div>
            <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>

        <div class="project">
        <div class="inner">
            <?php
                $sql = "SELECT * FROM votes GROUP BY voters_id";
                $result = mysqli_query($link, $sql);

                echo "<h3>".$result->num_rows."</h3>";
              ?>

              <p>Voters Voted</p>
            </div>
            <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <div class="tally">
        <h2>Vote Tally Results</h2>

        <?php if (!empty($voteTally)): ?>
            <?php 
            $currentPosition = '';
            foreach ($voteTally as $row): 
                if ($currentPosition !== $row['position']):
                    if ($currentPosition !== ''):
                        echo "</ul>";
                    endif;
                    $currentPosition = $row['position'];
                    echo "<h3>$currentPosition</h3><ul>";
                endif;
            ?>
                <li>
                    <span><?php if(!empty($row['Logo'])){
                    echo "<img src='php/image/". $row['Logo'] . "' class='user-pic'>"; 
                    }else{
                    echo "<img src='php/image/logo.png' class='user-pic'>" ;
                    }?></span>
                    <span><?php echo $row['Abbr']; ?></span>
                    <span><?php echo $row['party_name']; ?></span>
                    <span><?php echo $row['vote_count']; ?> votes</span>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No votes have been cast yet.</p>
        <?php endif; ?>

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