<?php
// Database connection
$conn = new mysqli('sql7.freesqldatabase.com', 'sql7783315', 'IzRkQwA8pR', 'sql7783315', 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get vote tally
function getVoteTally($conn) {
    $sql = "
        SELECT 
            candidates.id AS candidate_id, 
            candidates.party_name, 
            candidates.Abbr, 
            candidates.Logo, 
            COUNT(votes.candidate_id) AS vote_count,
            positions.description AS position
        FROM votes
        JOIN candidates ON votes.candidate_id = candidates.id
        JOIN positions ON candidates.position_id = positions.id
        GROUP BY candidates.id, positions.description
        ORDER BY positions.description, vote_count DESC
    ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

$voteTally = getVoteTally($conn);
?>