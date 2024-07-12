<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="../css/feedbackForm.css">
</head>
<body>
    <div class="feedback-container">
        <h2>Give Feedback</h2>
        <form id="feedbackForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="title">How was the service?</label>
            <input type="text" id="title" name="title" required>

            <label for="feedback_text">Give us a comment:</label>
            <textarea id="feedback_text" name="feedback_text" rows="4" required></textarea>

            <label class="rating-label">Rating:</label>
            <div class="emoji-rating">
                <input type="radio" id="emoji1" name="rating" value="1"><label for="emoji1">😞</label>
                <input type="radio" id="emoji2" name="rating" value="2"><label for="emoji2">😕</label>
                <input type="radio" id="emoji3" name="rating" value="3"><label for="emoji3">😐</label>
                <input type="radio" id="emoji4" name="rating" value="4"><label for="emoji4">🙂</label>
                <input type="radio" id="emoji5" name="rating" value="5"><label for="emoji5">😄</label>
            </div>

            <div class="buttons">
                <input type="submit" value="Send">
            </div>
        </form>
        <p id="successMessage" style="text-align: center; display: none; color: green;">Successfully sent! <a href="index.php">See Feedback</a></p>
    </div>

    <script>
        document.getElementById('feedbackForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'submitFeedback.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('successMessage').textContent = "Successfully sent! ";
                    var link = document.createElement("a");
                    link.href = "index.php";
                    link.textContent = "See Feedback";
                    document.getElementById('successMessage').appendChild(link);
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('feedbackForm').reset();
                } else {
                    document.getElementById('successMessage').textContent = 'An error occurred. Please try again.';
                    document.getElementById('successMessage').style.display = 'block';
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
