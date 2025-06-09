<?php 
require 'Voting_fatch.php';
require 'Voter_submitting.php';
require 'Election_titlefatch.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/voting.css">
    <script type="text/javascript">
       function preventback(){window.history.forward()};
       setTimeout("preventBack()", 0);
       window.onunload=function(){null;}
    </script>
    <title>Voting</title>
</head>
<body>
<header>
    <h1>Voting System</h1>
    <nav class="navmenu">
        <div class="dropdown">
            <button class="dropbtn"> 
                <p class="user-info">
                    <img src='<?php echo $image; ?>' class='user-pic'>
                    <span class="user-name">
                        <?php echo $Firstname; ?> 
                        <?php echo $Lastname; ?>
                    </span>
                </p> 
            </button>
            <button class="logout-btn"> 
                <a href="logout.php">LOGOUT</a>
            </button>
        </div>
    </nav>
</header>

   
<section>
    <div class="main">

        <?php
        if(isset($_SESSION['Status'])){
            echo "<p>".$_SESSION['Status']."</p>";
            unset($_SESSION['Status']);
        }
        ?>

        <h2><?php echo $text ?></h2>
        <?php
			$sql = "SELECT * FROM votes WHERE voters_id = $ID";
			$result = mysqli_query($link,$sql);
			if($result->num_rows >0){
				    ?>
				    <div class="text-center">
					<h3>You have already voted for this election.</h3>

					<div class="container">
                        <input type="checkbox" id="check">
                        <label class="viewbtn" for="check">View Ballot</label>
                        <div class="background" id="background"></div>
                        <div class="alert_box">
                        <span class="close_button" id="closeBtn"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Your Votes</h2>
                        <?php
                                $voter_id = $ID;
                                $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN positions ON positions.id=votes.position_id WHERE voters_id = '$voter_id'  ORDER BY positions.priority ASC";
                                $result = mysqli_query($link,$sql);
                                while($rows = $result->fetch_assoc()){
                                    echo "<div>";
                                    echo "<h3>" . $rows['description'] . "</h3>";
                                    echo "<p> " . $rows['canfirst'] . " " . $rows['canlast'] . "</p>";
                                    echo "</div>";
                                }
                        ?>
                        </div>
                    </div>
					</div>
		<?php
			}else{
				    		?>
        <form id="votingForm" method="POST" action="Voter_submitting.php">
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

                    $sql_candidates = "SELECT id, Logo, Abbr, photo, party_name FROM candidates WHERE position_id=$position_id";
                    $result_candidates = $conn->query($sql_candidates);

                    if ($result_candidates->num_rows > 0) {
                        while($candidate = $result_candidates->fetch_assoc()) {
                            echo "<label class='candidate-label'>";

                            echo "<input type='" . ($max_votes > 1 ? 'checkbox' : 'radio') . "' name='" . $input_name . "' value='" . $candidate['id'] . "'>";

                            if (!empty($candidate['Logo'])) {
                                echo "<img src='admin/php/image/" . $candidate['Logo'] . "' class='candidate-photo' alt='Candidate Photo'>";
                            } else {
                                echo "<img src='admin/php/image/logo.png' class='candidate-photo' alt='Default Logo'>";
                            }

                            echo "<span class='candidate-abbr'>" . $candidate['Abbr'] . "</span>";

                            if (!empty($candidate['photo'])) {
                                echo "<img src='admin/php/image/" . $candidate['photo'] . "' class='candidate-photo' alt='Candidate Photo'>";
                            } else {
                                echo "<img src='admin/php/image/UserProfile.png' class='candidate-photo' alt='Default Logo'>";
                            }

                            echo "<span class='candidate-party'>" . $candidate['party_name'] . "</span>";

                            echo "</label><br>";
                        
                        }
                    }

                    echo "</div>";
                }
            } else {
                echo "No positions available.";
            }
            $conn->close();
            ?>
            <button type="submit" class="votingbtn">Vote</button>
        </form>
        <?php
				    	}

				    ?>
    </div>
</section>

<script src="https://kit.fontawesome.com/097e064a27.js" crossorigin="anonymous"></script>

<script>
       document.getElementById('votingForm').addEventListener('submit', function(event) {
    let positions = document.querySelectorAll('.position');
    let positionVotes = {};

    for (let position of positions) {
        let positionId = position.querySelector('h2').innerText;
        let inputs = position.querySelectorAll('input[type="radio"], input[type="checkbox"]');
        let checked = Array.from(inputs).some(input => input.checked);

        if (!checked) {
            alert('Please select a candidate for all positions.');
            event.preventDefault();
            return false;
        }

        // Count selected votes for each position
        let selected = Array.from(inputs).filter(input => input.checked).length;
        if (!positionVotes[positionId]) {
            positionVotes[positionId] = 0;
        }
        positionVotes[positionId] += selected;

        // Validate max votes
        let maxVotes = parseInt(position.querySelector('.max_votes').innerText, 10);
        if (positionVotes[positionId] > maxVotes) {
            alert(`You can vote for a maximum of ${maxVotes} candidate(s) for the position: ${positionId}`);
            event.preventDefault();
            return false;
        }
    }
});

</script>
<script>
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