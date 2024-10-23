<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Freedom of Praise Church</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        main {
    width: 100%;
    padding: 20px;
    background-color:gray; /* Set background color to blue */
    color: white; /* Change text color to white for better contrast */
}


        h3 {
            text-align: center;
            font-size: 3rem;
            margin-top: 200px;
            color: #333;
        }

        /* Full-Width Banner */
        .banner {
            width: 100%;
            height: 60vh;
            background: url('banner.jpg') center center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .banner h3 {
            font-size: 4rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color:white;
        }

        /* Section Styling */
        .section {
            width: 100%;
            max-width: 1200px;
            margin: 50px auto;
            text-align: center;
        }

        .section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: white;

        }

        .section p {
            font-size: 1.2rem;
            color: white;
            margin-bottom: 40px;
        }

        .cta-button {
            padding: 15px 30px;
            background-color: #4A90E2;
            color: white;
            text-transform: uppercase;
            text-decoration: none;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #3f7fc2;
        }

        /* Image Section */
        .image-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 30px;
            max-width: 1200px;
            margin: 50px auto;
        }

        .image-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(33% - 30px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .image-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .image-box h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 10px;
        }

        .image-box p {
            font-size: 1rem;
            color: #666;
        }

        .image-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include the header -->

<main>
    <!-- Full-width banner -->
    <section class="banner">
        <h3>About Freedom of Praise Church</h3>
    </section>

    <!-- Mission Section -->
    <section class="section">
        <h2>Our Mission</h2>
        <p>At Freedom of Praise Church, our mission is to inspire and uplift individuals through faith, community, and worship. We are dedicated to spreading the word of God and providing a supportive environment where everyone can grow spiritually.</p>
        <a href="Event.php" class="cta-button">Join Us Today</a>
    </section>

    <!-- Image Section -->
    <section class="image-section">
        <!-- Image 1 -->
        <div class="image-box">
            <img src="images1/oldchurch.jpg" alt="Image 1">
            <h2>Old Freedom of Praise Church</h2>
            <p>It's all started in this Church. It is just a ordinary house but still it is a church for us.</p>
        </div>

        <!-- Image 2 -->
        <div class="image-box">
            <img src="images/image2.jpg" alt="Image 2">
            <h2>Worship Together</h2>
            <p>Our worship services are designed to be inclusive and uplifting, with something for everyone to connect with spiritually.</p>
        </div>

        <!-- Image 3 -->
        <div class="image-box">
            <img src="images1/oldmusican.jpg" alt="Image 3">
            <h2>Musicians</h2>
            <p>Our beloved musicians!</p>
        </div>
    </section>

</main>

</body>
</html>
