<?php
$link =mysqli_connect("localhost","root","","online_voting_system");
 if($link===false){
    die("Error: COULD NOT CONNECT" . mysqli_connect_error());
 }

 $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast, voters.firstname AS votfirst, voters.lastname AS votlast FROM votes LEFT JOIN positions ON positions.id=votes.position_id LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN voters ON voters.id=votes.voters_id ORDER BY positions.priority ASC";

 $result = mysqli_query($link, $sql);

?>