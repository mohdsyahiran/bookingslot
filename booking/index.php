<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Date Range</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="booking-container">
        <h1>Book a Date Range</h1>
        <form id="bookingForm" method="POST">
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required>
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required>
            <button type="submit" class="book-button">Book</button>
        </form>
        <div id="bookingMessage"></div>
        <h2>Booked Date Ranges</h2>
        <div id="bookedListContainer">
            <ul id="bookedList">
                <!-- Booked dates will be loaded here -->
            </ul>
        </div>
        <a href="../index.php" class="back-link">Back to Calendar</a>
    </div>
    <script src="booking.js"></script>
</body>
</html>
