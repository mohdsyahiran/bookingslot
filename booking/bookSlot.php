<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$startDate = $input['startDate'];
$endDate = $input['endDate'];

// $servername = "localhost";
// $username = "saybat_bookingslot";
// $password = "Ayam1234";
// $dbname = "saybat_bookingslot";

// $servername = "localhost:3306";
// $username = "root";
// $password = "";
// $dbname = "bookingslot";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Check for overlapping bookings
$sql = "SELECT * FROM bookings WHERE (start_date <= '$endDate' AND end_date >= '$startDate')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Error: The selected date range overlaps with an existing booking.']);
    $conn->close();
    exit();
}

// Insert new booking
$sql = "INSERT INTO bookings (start_date, end_date) VALUES ('$startDate', '$endDate')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Booking successful!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
