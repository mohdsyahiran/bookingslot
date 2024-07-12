<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Booking</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="calendar-container">
        <div class="date-display">
            <img src="tower.jpg" alt="TRX" class="background-image">
            <div class="date-info">
                <div class="month-year" id="monthYear"></div>
                <div class="date-number" id="dateNumber"></div>
                <div class="today-button" onclick="goToToday()">Today</div>
            </div>
        </div>
        <div class="calendar">
            <div class="month-navigation">
                <button>&#8592; Prev</button>
                <button>Next &#8594;</button>
            </div>
            <div class="days-of-week">
                <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
            </div>
            <div class="days" id="days">
                <!-- Days will be populated by JavaScript -->
            </div>
        </div>
    </div>
    <footer>
        <p>Created by <b>Syahiran Azizan</b><br><i>Camera Rental : G7X Mark III</i></p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
