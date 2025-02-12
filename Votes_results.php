<?php 
require 'admin/php/Tally_votes.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="css/Votes_results.css">
</head>
<body>
    <section>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="Votes_results.php">Results</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>

                <a href="Registering.php" class="registeringbtn">Register</a>

        </nav>
    </section>
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
                    echo "<img src='admin/php/image/". $row['Logo'] . "' class='user-pic'>"; 
                    }else{
                    echo "<img src='admin/php/image/logo.png' class='user-pic'>" ;
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

    <footer>
        
    </footer>
</body>
</html>