document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    fetch('bookSlot.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ startDate, endDate })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('bookingMessage').innerText = data.message;
        if (data.success) {
            // Reload booked dates
            loadBookedDates();
        }
    });
});

function loadBookedDates() {
    fetch('fetchBookings.php')
        .then(response => response.json())
        .then(data => {
            const bookedList = document.getElementById('bookedList');
            bookedList.innerHTML = ''; // Clear existing list
            data.forEach(booking => {
                const listItem = document.createElement('li');
                listItem.classList.add('booked-list-item');
                listItem.innerHTML = `<span>${booking.start_date} to ${booking.end_date}</span> <button class='delete-button' data-id='${booking.id}'>Delete</button>`;
                bookedList.appendChild(listItem);
            });
            addDeleteListeners();
        });
}

function addDeleteListeners() {
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-id');
            fetch('deleteBooking.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: bookingId })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('bookingMessage').innerText = data.message;
                if (data.success) {
                    loadBookedDates();
                }
            });
        });
    });
}

// Initial load
loadBookedDates();
