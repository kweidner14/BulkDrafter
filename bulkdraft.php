<?php
// Include WordPress core
require('wp-load.php');

// Number of URLs to process in one chunk
$urls_per_chunk = 50;

// Get the current chunk number from the URL parameter; default to 1 if not set
$current_chunk = isset($_GET['chunk']) ? intval($_GET['chunk']) : 1;

// Calculate the starting line and ending line based on the current chunk
$start_line = ($current_chunk - 1) * $urls_per_chunk;
$end_line = $start_line + $urls_per_chunk;

// Open CSV file
$file = fopen('bulk-draft-urls.csv', 'r');

// Counter to keep track of the current line number
$line_number = 0;

while (($line = fgetcsv($file)) !== FALSE) {
    // If the current line number is within the chunk's range, process the URL
    if ($line_number >= $start_line && $line_number < $end_line) {
        // Assuming each line in CSV file contains a URL
        $url = $line[0];

        // Convert the URL to a post ID
        $post_id = url_to_postid($url);

        if ($post_id) {
            // Change post status to 'draft'
            wp_update_post(array(
                'ID' => $post_id,
                'post_status' => 'draft'
            ));
            // Uncomment the lines below if you want to log the process
//            error_log("The URL is: " . $url . " . \n And the Post ID is: " . $post_id);
//            error_log("The line count is: " . $line_number);
        }
    }

    // If the current line number exceeds the chunk's range, break out of the loop
    if ($line_number >= $end_line) {
        break;
    }

    $line_number++;
}

fclose($file);
echo "Processed chunk {$current_chunk}.";
