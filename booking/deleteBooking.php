<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$bookingId = $input['id'];

// $servername = "localhost";
// $username = "saybat_bookingslot";
// $password = "Ayam1234";
// $dbname = "saybat_bookingslot";

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "bookingslot";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$sql = "DELETE FROM bookings WHERE id='$bookingId'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Booking deleted successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
