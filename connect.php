<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "healthylivinghub");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and sanitize form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Debug: Print the received values
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Basic validation
if ($name && $email && $subject && $message) {
    // Prepared statement (safe and reliable)
    $stmt = $conn->prepare("INSERT INTO customersofhlh (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "✅ Record inserted successfully!";
    } else {
        echo "❌ Error inserting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❗ Please fill all form fields.";
}

$conn->close();
?>
