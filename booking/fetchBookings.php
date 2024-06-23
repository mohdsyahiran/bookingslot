<?php
header('Content-Type: application/json');


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

$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

$bookings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

echo json_encode($bookings);

$conn->close();
?>
