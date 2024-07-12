<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our reviews..</title>
    
    <link rel="stylesheet" href="../css/feedbackPage.css">
</head>
<body>

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

// Pagination settings
$items_per_page = 5;
if (isset($_GET['page'])) {
    $current_page = (int)$_GET['page'];
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $items_per_page;

// Get total number of items
$total_items_sql = "SELECT COUNT(*) FROM feedback";
$total_items_result = $conn->query($total_items_sql);
$total_items_row = $total_items_result->fetch_row();
$total_items = $total_items_row[0];
$total_pages = ceil($total_items / $items_per_page);

$sql = "SELECT * FROM feedback ORDER BY feedback_date DESC LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);

function getEmojiRating($rating) {
    switch ($rating) {
        case 5: return "😄 <span style='font-size: 13px; font-family: monospace;'>Extremely satisfied</span>";
        case 4: return "🙂 <span style='font-size: 13px; font-family: monospace;'>Satisfied</span>";
        case 3: return "😐 <span style='font-size: 13px; font-family: monospace;'>Neutral</span>";
        case 2: return "😕 <span style='font-size: 13px; font-family: monospace;'>Dissatisfied</span>";
        case 1: return "😞 <span style='font-size: 13px; font-family: monospace;'>Very dissatisfied</span>";
        default: return "";
    }
}

function getRandomUserEmoji() {
    $emojis = ['😊', '😃', '😉', '😍', '😎', '😇', '😋', '🙂', '🥰'];
    return $emojis[array_rand($emojis)];
}

if ($result->num_rows > 0) {
    echo "<h2>Our reviews..</h2>";
    echo "<div class='feedback-list'>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='feedback-item'>
                <div class='feedback-header'>
                    <span>Rent • Canon G7X Mark III</span>
                    <span>" . $row["feedback_date"]. "</span>
                </div>
                <div class='emoji-rating'>" . getEmojiRating($row["rating"]). "</div>
                <div class='feedback-comment'>
                    <strong>" . htmlspecialchars($row["title"]) . "</strong><br>
                    " . nl2br(htmlspecialchars($row["feedback_text"])). "
                </div>
                <div class='feedback-user'>
                    <div class='user-emoji'>" . getRandomUserEmoji() . "</div>
                    <div class='user-info'>
                        <span class='user-name'>" . htmlspecialchars($row["name"]). "</span>
                    </div>
                </div>
              </div>";
    }
    echo "</div>";
} else {
    echo "<p>No feedback available.</p>";
}

// Pagination links
if ($total_pages > 1) {
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<a class='active' href='?page=$i'>$i</a>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }
    echo "</div>";
}

$conn->close();
?>

</body>
</html>
