<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Simulate progress
for ($progress = 0; $progress <= 100; $progress += 10) {
    // Simulate some processing time
    sleep(1);

    // Send progress update
    echo "data: $progress\n\n"; // Output progress
    flush(); // Flush output to ensure it's sent immediately
    ob_flush(); // Flush output buffers

    // Delay for a short time to allow the progress to be displayed incrementally
    usleep(50000); // Sleep for 0.05 seconds
}

// Send final message
echo "data: complete\n\n";
flush(); // Flush output to ensure it's sent immediately
ob_flush(); // Flush output buffers
?>
