<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOP Homepage</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        /* General page styling */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        main {
            display: flex;
            flex-direction: column;
        }

        /* Section styling */
        .section {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
            overflow: hidden;
            color: white;
        }

        .section h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .section p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        .section button {
            padding: 10px 25px;
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .section button:hover {
            background-color: rgba(255, 255, 255, 1);
            transform: scale(1.05);
        }

        /* Background image sections */
        .section-1 {
            background-image: url('https://scontent.fdvo2-2.fna.fbcdn.net/v/t39.30808-6/307650016_463884832433502_5231845077325149687_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=kTl2gLooNEAQ7kNvgEOzgM3&_nc_ht=scontent.fdvo2-2.fna&_nc_gid=A6mV_bMQjrEQYw-AsE7ok2q&oh=00_AYD4XMHUZOSxfxLXAu0lkB9OytROhOdroOyf57jeztBAbA&oe=670DCD27');
            background-size: cover;
            background-position: center;
        }

        .section-2 {
            background-image: url('https://scontent.fdvo4-1.fna.fbcdn.net/v/t39.30808-6/380830266_135217093006247_8330424378061097634_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeE-IHRS0nNKcEPJphnxaYHsyEPhSS4yRS7IQ-FJLjJFLvvh8HKDetaQkXoLbqldWgHtKEXm5Kh9Svrgj2-lVtOq&_nc_ohc=2r0l2Cj9TZkQ7kNvgHMQgUX&_nc_zt=23&_nc_ht=scontent.fdvo4-1.fna&_nc_gid=AoAz0uwj-aXtQfWwXE2aVKF&oh=00_AYDn8noWZwyry8EYQCWslahh80AIrU05LATeSrPgOxhl-Q&oe=671B6F59');
            background-size: cover;
            background-position: center;
        }

        .section-3 {
            background-image: url('https://scontent.fdvo4-1.fna.fbcdn.net/v/t39.30808-6/412112614_182479781613311_7307312194534918719_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=f727a1&_nc_eui2=AeHvMaW1ichSRbQMCUFMNIK9mSReu3ftaDGZJF67d-1oMbVNpWgcaVEC3cA9NrM36EaGTaEaswTVYrx_kUK1SI84&_nc_ohc=nDL-B3NNuPYQ7kNvgEbN8Gd&_nc_zt=23&_nc_ht=scontent.fdvo4-1.fna&_nc_gid=Aors8m8dvs8hoOnT2lijh__&oh=00_AYAIetiYZv-ggNE-JmY_xIpWNzhlLFr9SAAIQW8rSYuDvQ&oe=671B6CBF');
            background-size: cover;
            background-position: center;
        }

        /* Overlay to improve readability */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
        }

        .content {
            position: relative;
            z-index: 2;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section h2 {
                font-size: 2.5rem;
            }
            .section p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include the header -->

<main>
    <section class="section section-1">
        <div class="overlay"></div>
        <div class="content">
            <h2>Welcome to FOP</h2>
            <p>Discover amazing church activities and programsa, events and services!</p>
            <button onclick="scrollToSection('.section-2')">Learn More</button>
        </div>
    </section>

    <section class="section section-2">
        <div class="overlay"></div>
        <div class="content">
            <h2>Our Programs</h2>
            <p>Explore the various programs we offer</p>
            <button onclick="window.location.href='book.php'">View Programs</button>
        </div>
    </section>

    <section class="section section-3">
        <div class="overlay"></div>
        <div class="content">
            <h2>Join Us</h2>
            <p>Become a part of our growing faith community</p>
            <button onclick="window.location.href='event.php'">Get Started</button>
        </div>
    </section>
</main>

<script>
    function scrollToSection(section) {
        document.querySelector(section).scrollIntoView({ behavior: 'smooth' });
    }
</script>

</body>
</html>
