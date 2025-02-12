<?php
$file = 'Election title.txt'; // File to save the text
$text= '';

 // Open the file in read mode
 if (file_exists($file)) {
    $handle = fopen($file, 'r');

    // Read the contents of the file
    $text = fread($handle, filesize($file));

    // Close the file
    fclose($handle);

    // Display the text
    $text;
} else {
    echo "File does not exist.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['save'])) {
        // Get the user input
        $text = $_POST['Election_title'];

        // Open the file in write mode
        $handle = fopen($file, 'w');

        // Write the text to the file
        fwrite($handle, $text);

        // Close the file
        fclose($handle);

        echo "Text saved to file.";
    }

    
}
?>