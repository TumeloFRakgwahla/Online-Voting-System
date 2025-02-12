<?php
require 'Voting_fatch.php';


// submit_vote.php

// Connect to the database
$conn = new mysqli("localhost", "root", "", "online_voting_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the voter ID (this might come from session data or another method)
$voter_id = $ID; // Replace this with the actual voter ID retrieval method

// Prepare to insert votes
$stmt = $conn->prepare("INSERT INTO votes (voters_id, candidate_id, position_id) VALUES (?, ?, ?)");

// Loop through the positions and insert votes
foreach ($_POST as $key => $candidates) {
    if (strpos($key, 'position_') === 0) { // Check if the key starts with 'position_'
        $position_id = str_replace('position_', '', $key);

        // Handle cases where $candidates is an array (multiple votes) or a single value (one vote)
        if (is_array($candidates)) {
            foreach ($candidates as $candidate_id) {
                // Bind parameters and execute the statement for each selected candidate
                $stmt->bind_param("iii", $voter_id, $candidate_id, $position_id);
                if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                }
            }
        } else {
            // If only one candidate is selected
            $candidate_id = $candidates;
            $stmt->bind_param("iii", $voter_id, $candidate_id, $position_id);
            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
            }
        }
        //$SuccessErr;
        $_SESSION['Status'] = "<div class='alertSuccess' role='alart'> 
        <strong>Success </strong> you successfully voted
        </div>";
        header('location: Voting.php');
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
   

?>
