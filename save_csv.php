<?php
// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['subject'];
$message = $_POST['message'];
$timestamp = date("Y-m-d H:i:s");  // Current date and time

$file = "data.csv";
$fileExists = file_exists($file);

// Open CSV file for appending
$handle = fopen($file, "a");

// Add header row if file doesn't exist or is empty
if (!$fileExists || filesize($file) == 0) {
    fputcsv($handle, ["Name", "Email", "Subject", "Message", "Timestamp"]);
}

// Write form data as CSV row
fputcsv($handle, [$name, $email, $subject, $message, $timestamp]);

fclose($handle);

echo "Data saved successfully!";
?>
