<?php
// Include the database connection
include('db_connection.php');

// Fetch bookings from all tables
$bookings_query = "SELECT booking_date, 'Baptism' AS service FROM bookings
                   UNION ALL
                   SELECT dedication_date AS booking_date, 'Child Dedication' AS service FROM child_dedication_bookings
                   UNION ALL
                   SELECT service_date AS booking_date, 'Funeral Service' AS service FROM funeral_service_bookings";

$result = $conn->query($bookings_query);

// Organize bookings into an array by date
$booked_data = [];
while ($row = $result->fetch_assoc()) {
    $date = $row['booking_date'];
    $service = $row['service'];

    if (!isset($booked_data[$date])) {
        $booked_data[$date] = [];
    }
    $booked_data[$date][] = $service;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Schedule</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Layout */
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
            color: #fff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .sidebar a {
            font-size: 16px;
            display: block;
            padding: 12px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #fff;
            color: #11cf4d;
            border-top-left-radius: 22px;
            border-bottom-left-radius: 22px;
        }

        /* Main Container */
        .container {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            overflow: hidden;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header h3 {
            margin: 0;
            font-size: 24px;
        }

        .calendar-header button,
        .calendar-header select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #055e21;
            border-radius: 5px;
            background-color: #11cf4d;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .calendar-header button:hover {
            background-color: #0a8c38;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            height: calc(100% - 60px); /* Adjust height to fit container */
            overflow-y: auto;
        }

        .day {
            background-color: #11cf4d;
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s;
        }

        .day.booked {
            background-color: #ff4d4d;
        }

        .day:hover {
            background-color: #0a8c38;
        }

        .service-list {
            margin-top: 5px;
            font-size: 12px;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
    </style>
    <script>
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        function renderCalendar() {
            const monthNames = [
                "January", "February", "March", "April", "May", 
                "June", "July", "August", "September", 
                "October", "November", "December"
            ];

            document.getElementById('month-name').textContent = `${monthNames[currentMonth]} ${currentYear}`;

            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const calendar = document.getElementById('calendar-days');
            calendar.innerHTML = '';

            const bookedData = <?php echo json_encode($booked_data); ?>;

            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const isBooked = bookedData[date] ? 'booked' : '';

                const dayElement = document.createElement('div');
                dayElement.className = `day ${isBooked}`;
                dayElement.innerHTML = `<div>${day}</div>`;

                if (isBooked) {
                    const serviceList = document.createElement('div');
                    serviceList.className = 'service-list';
                    serviceList.textContent = bookedData[date].join(', ');
                    dayElement.appendChild(serviceList);
                }

                dayElement.onclick = () => showDetails(date);
                calendar.appendChild(dayElement);
            }
        }

        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        }

        function changeYear(year) {
            currentYear = parseInt(year);
            renderCalendar();
        }

        function showDetails(date) {
            const details = <?php echo json_encode($booked_data); ?>;
            if (details[date]) {
                alert(`Bookings for ${date}: ${details[date].join(', ')}`);
            } else {
                alert('No bookings for this day.');
            }
        }

        window.onload = renderCalendar;
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="bookings.php">Bookings</a>
        <a href="schedules.php">Schedules</a>
        <a href="users.php">Users</a>
        <a href="log_out.php">Log out</a>
    </div>

    <div class="container">
        <div class="calendar-header">
            <button onclick="prevMonth()">&lt;</button>
            <h3 id="month-name"></h3>
            <button onclick="nextMonth()">&gt;</button>
            <select onchange="changeYear(this.value)">
                <?php for ($year = 2020; $year <= 2030; $year++): ?>
                    <option value="<?php echo $year; ?>" <?php echo $year == date('Y') ? 'selected' : ''; ?>>
                        <?php echo $year; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div id="calendar-days" class="calendar"></div>
        <div class="footer">© 2024 Church Admin</div>
    </div>
</body>
</html>
