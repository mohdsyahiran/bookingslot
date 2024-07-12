<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "bookingslot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$title = $_POST['title'];
$feedback_text = $_POST['feedback_text'];
$rating = $_POST['rating'];

$sql = "INSERT INTO feedback (name, title, feedback_text, rating)
VALUES ('$name', '$title', '$feedback_text', '$rating')";

if ($conn->query($sql) === TRUE) {
    echo "Thank you for your feedback!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
