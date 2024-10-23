<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not, redirect to the login page
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - Freedom of Praise Church</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
            background-color: black; 
        }

        main {
            padding: 30px 10px;
            margin-top: 80px; /* Prevent overlap with header */
            background-image: url('fop1.jpg');
        }

        h3 {
            text-align: center;
            margin: 30px 0;
            font-size: 3rem;
            color: #333;
        }

        /* Booking Container */
        .booking-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            padding: 10px;
        }

        /* Booking Card Styling */
        .booking-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 90%;
            max-width: 400px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .booking-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .booking-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .booking-content {
            padding: 20px;
        }

        .booking-content h2 {
            font-size: 1.8rem;
            margin: 10px 0;
            color: #333;
        }

        .booking-content p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .booking-button {
            background-color: #4A90E2;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .booking-button:hover {
            background-color: #3f7fc2;
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .booking-container {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-around;
            }
        }

        dialog {
            padding: 2rem;
            background: white;
            max-width: 400px;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        }

        dialog::backdrop {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .close-button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 15px;
        }
        /* General Styling for Forms */
        .booking-modal {
            padding: 2rem;
            background: #fff;
            border-radius: 15px; /* Rounded corners for a softer look */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow for depth */
            max-width: 120%; /* Responsive width */
            animation: fadeIn 0.4s ease-in-out; /* Fade-in animation */
            position: relative; /* Positioning for close button */
        }

        .booking-modal input {
            padding: 12px; /* Padding for inputs */
            font-size: 1rem; /* Maintain font size */
            border: 1px solid #ddd; /* Light gray border */
            border-radius: 5px; /* Slight rounding of inputs */
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
        }
    .booking-form input:focus {
        border-color: #4A90E2;
        box-shadow: 0 0 8px rgba(74, 144, 226, 0.4);
        outline: none;
    }

    .submit-button {
        background-color: #4A90E2;
        color: white;
        font-size: 1.2rem;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .submit-button:hover {
        background-color: #3f7fc2;
        transform: translateY(-3px);
    }

    /* Animations */
    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    dialog {
        padding: 2rem;
        background: white;
        max-width: 400px;
        border-radius: 20px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    dialog::backdrop {
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
    }

    .close-button {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 15px;
        color: #555;
        transition: color 0.3s ease;
    }

    .close-button:hover {
        color: #000;
    }
    .view-bookings-button {
    position: absolute; /* Position relative to the main section */
    top: 150px; /* Distance from the top */
    right: 20px; /* Distance from the right */
    z-index: 1000; /* Ensure it appears above other elements */
}

.view-bookings-button button {
    background-color: #4A90E2; /* Button color (blue) */
    color: white; /* Button text color */
    padding: 10px 20px; /* Button padding */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 1rem; /* Font size */
    transition: background-color 0.3s ease; /* Transition effect */
}

.view-bookings-button button:hover {
    background-color: #3f7fc2; /* Darker blue on hover */
}


        
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include header without changes -->

<main>
    <!-- View Bookings Button -->
    <div class="view-bookings-button">
        <button onclick="window.location.href='view_bookings.php';">View Bookings</button>
    </div>
    

    <h3>Book Now</h3>
    <section class="booking-container">
        <!-- Booking Card 1 -->
        <div class="booking-card">
            <img src="baptism.jpg" alt="Baptism">
            <div class="booking-content">
                <h2>Baptism</h2>
                <p>Baptism symbolizes a new beginning in Christ...</p>
                <button class="booking-button" onclick="document.getElementById('baptismModal').showModal();">Baptise Now!</button>
                <button class="booking-button" onclick="document.getElementById('baptismDetailsModal').showModal();">Details</button>
            </div>
        </div>

        <!-- Booking Card 2 -->
        <div class="booking-card">
            <img src="dedication1.jpeg" alt="Child Dedication">
            <div class="booking-content">
                <h2>Child Dedication</h2>
                <p>Child dedication is a special ceremony...</p>
                <button class="booking-button" onclick="document.getElementById('dedicationModal').showModal();">Reserve Now!</button>
                <button class="booking-button" onclick="document.getElementById('dedicationDetailsModal').showModal();">Details</button>
            </div>
        </div>

        <!-- Booking Card 3 -->
        <div class="booking-card">
            <img src="Fservice.jpg" alt="Funeral Service">
            <div class="booking-content">
                <h2>Funeral Service</h2>
                <p>A funeral service is a time to honor...</p>
                <button class="booking-button" onclick="document.getElementById('funeralModal').showModal();">Get a Service!</button>
                <button class="booking-button" onclick="document.getElementById('funeralDetailsModal').showModal();">Details</button>
            </div>
        </div>
    </section>
    
</main>
<!-- Modals for Booking Forms -->
<dialog id="baptismModal" class="booking-modal">
    <button class="close-button" onclick="this.closest('dialog').close();">&times;</button>
    <h2>Baptism Booking Form { Price : 700}</h2>
    <form action="process_booking.php" method="POST" class="booking-form">
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($_SESSION['username']); ?>">
        <input type="text" name="name" placeholder="Name of Baptized" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="date" name="date" required>
        <input type="hidden" name="type" value="Baptism">
        <button type="submit" class="submit-button">Submit Baptism Booking</button>
    </form>
</dialog>

<dialog id="dedicationModal" class="booking-modal">
    <button class="close-button" onclick="this.closest('dialog').close();">&times;</button>
    <h2>Child Dedication Booking Form { Price : 300}</h2>
    <form action="process_booking.php" method="POST" class="booking-form">
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($_SESSION['username']); ?>">
        <input type="text" name="parent_name" placeholder="Parent's Name" required>
        <input type="email" name="parent_email" placeholder="Parent's Email" required>
        <input type="text" name="child_name" placeholder="Child's Name" required>
        <input type="date" name="dedication_date" required>
        <input type="hidden" name="type" value="Child Dedication">
        <button type="submit" class="submit-button">Submit Dedication Booking</button>
    </form>
</dialog>

<dialog id="funeralModal" class="booking-modal">
    <button class="close-button" onclick="this.closest('dialog').close();">&times;</button>
    <h2>Funeral Service Booking Form { Price : 500}</h2>
    <form action="process_booking.php" method="POST" class="booking-form">
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($_SESSION['username']); ?>">
        <input type="text" name="deceased_name" placeholder="Deceased's Name" required>
        <input type="text" name="contact_person" placeholder="Contact Person -Parents/Guardian" required>
        <input type="email" name="contact_email" placeholder="Contact Email"required>
        <input type="date" name="service_date" required>
        <input type="hidden" name="type" value="Funeral Service">
        <button type="submit" class="submit-button">Submit Funeral Service Booking</button>
    </form>
</dialog>

<!-- Modals for Details -->
<dialog id="baptismDetailsModal">
    <button class="close-button" onclick="this.closest('dialog').close();">&times;</button>
    <h2>Baptism Booking Description</h2>
    <p>Baptism is a sacred act of faith and obedience to Jesus Christ. It symbolizes the believer's identification with Christ's death, burial, and resurrection. Through baptism, individuals publicly declare their faith and commitment to following Jesus.</p>
</dialog>

<dialog id="dedicationDetailsModal">
    <button class="close-button" onclick="this.closest('dialog').close();">&times;</button>
    <h2>Child Dedication Booking Description</h2>
    <p>Child dedication is a special ceremony where parents present their child to God and commit to raising them in a Christian environment. It is a time for the family and church community to come together in prayer and support for the child’s spiritual upbringing.</p>
</dialog>

<dialog id="funeralDetailsModal">
    <button class="close-button" onclick="this.closest('dialog').close();">&times;</button>
    <h2>Funeral Service Booking Description</h2>
    <p>A funeral service is a time to honor and celebrate the life of the deceased. It provides an opportunity for family and friends to gather, share memories, and find comfort in their grief. This service can be personalized to reflect the wishes of the deceased and their family.</p>
</dialog>


