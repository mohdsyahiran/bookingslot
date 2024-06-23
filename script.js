document.addEventListener('DOMContentLoaded', function() {
    const monthYear = document.getElementById('monthYear');
    const dateNumber = document.getElementById('dateNumber');
    const daysContainer = document.getElementById('days');
    const todayButton = document.querySelector('.today-button');

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function renderCalendar(month, year) {
        daysContainer.innerHTML = '';
        const monthYearText = `${new Date(year, month).toLocaleDateString('en-US', { month: 'long', year: 'numeric' })}`;
        monthYear.textContent = monthYearText;

        const firstDayIndex = new Date(year, month, 1).getDay();
        const lastDay = new Date(year, month + 1, 0).getDate();

        // Add empty divs for the first day index
        for (let i = 0; i < firstDayIndex; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.classList.add('empty-day');
            daysContainer.appendChild(emptyDiv);
        }

        for (let day = 1; day <= lastDay; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.textContent = day;
            dayDiv.classList.add('day');
            dayDiv.classList.add('current-month');
            dayDiv.setAttribute('data-date', `${year}-${month + 1}-${day}`);
            daysContainer.appendChild(dayDiv);
        }

        fetchBookedDates();
    }

    function fetchBookedDates() {
        fetch('booking/fetchBookings.php')
            .then(response => response.json())
            .then(data => {
                const bookedDates = data;
                bookedDates.forEach(booking => {
                    const startDate = new Date(booking.start_date);
                    const endDate = new Date(booking.end_date);
                    markBookedDates(startDate, endDate);
                });
            });
    }

    function markBookedDates(startDate, endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);

        while (start <= end) {
            const dateString = `${start.getFullYear()}-${start.getMonth() + 1}-${start.getDate()}`;
            const dayElement = document.querySelector(`.day.current-month[data-date="${dateString}"]`);
            if (dayElement) {
                dayElement.classList.add('booked');
                // dayElement.innerHTML = `${start.getDate()} ❌`;
            }
            start.setDate(start.getDate() + 1);
        }
    }

    function goToToday() {
        currentDate = new Date();
        renderCalendar(currentDate.getMonth(), currentDate.getFullYear());
    }

    document.querySelector('.month-navigation button:nth-child(1)').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate.getMonth(), currentDate.getFullYear());
    });

    document.querySelector('.month-navigation button:nth-child(2)').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate.getMonth(), currentDate.getFullYear());
    });

    todayButton.addEventListener('click', goToToday);

    renderCalendar(currentDate.getMonth(), currentDate.getFullYear());
});
