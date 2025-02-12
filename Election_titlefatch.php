<?php
$file = 'admin/Election title.txt'; // File to save the text
$text= '';

 if (file_exists($file)) {
    $handle = fopen($file, 'r');

    // Read the contents of the file
    $text = fread($handle, filesize($file));

    // Close the file
    fclose($handle);

    // Display the text
    echo "Text retrieved from file: " . $text;
} else {
    echo "File does not exist.";
}
?>