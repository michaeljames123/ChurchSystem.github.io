<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOP Events</title>
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
            padding: 40px 20px 20px; /* Increased top padding for more space */
            background-color: #4A90E2; /* Soft blue background */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .slideshow-section {
            width: 100%;
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px;
            box-sizing: border-box;
            background-color: #fff; /* White background for the content */
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px; /* Space between slideshow components */
            transition: all 0.5s ease;
        }

        .slideshow-section:first-of-type {
            margin-top: 60px; /* Adjust this value to increase space above the first component */
        }

        .slideshow-text {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            animation: fadeIn 1s ease-out;
        }

        .slideshow-text h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .slideshow-text p {
            font-size: 1.5rem;
            color: #555;
            margin-bottom: 8px;
        }

        .slideshow-text .date {
            font-size: 1.2rem;
            color: #888;
        }

        .slideshow {
            flex: 1;
            position: relative;
            height: 400px; /* Fixed height for uniformity */
            overflow: hidden;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow */
        }

        .slideshow img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .slideshow img.active {
            display: block;
            opacity: 1;
        }

        /* Navigation buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            padding: 16px;
            margin-top: -22px;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%; /* Circular buttons */
        }

        .next {
            right: 10px; /* Adjusted position */
        }

        .prev {
            left: 10px; /* Adjusted position */
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include the header -->

<main>
    <!-- First slideshow component -->
    <section class="slideshow-section">
        <div class="slideshow-text">
            <h2>VBS DAY2
            "KINGDOM QUEST"</h2>
            <p>This is a program often organized by churches during the summer months to engage children in learning about the Bible and Christian values in a fun, interactive environment</p>
            <p class="date">Date: August 3, 2023</p>
        </div>
        <div class="slideshow">
            <img src="vbs1.jpg" class="active"> <!-- First image -->
            <img src="vbs2.jpg"> <!-- Second image -->
            <img src="vbs3.jpg"> <!-- Third image -->
            <img src="vbs4.jpg"> <!-- 4hird image -->
            <a class="prev" onclick="plusSlides(this, -1)">&#10094;</a>
            <a class="next" onclick="plusSlides(this, 1)">&#10095;</a>
        </div>
    </section>

    <!-- Second slideshow component -->
    <section class="slideshow-section">
        <div class="slideshow-text">
            <h2>GOLDEN WOMEN DEPARTMENT</h2>
            <p>The Golden Women Department in a church typically refers to a ministry or group that focuses on women, particularly those who are older or considered mature in their faith and life experiences. This department often aims to provide support, fellowship, and spiritual growth opportunities for women in the church community.</p>
            <p class="date">Date: February 1, 2023</p>
        </div>
        <div class="slideshow">
            <img src="w1.jpg" class="active"> <!-- First image -->
            <img src="w2.jpg"> <!-- Second image -->
            <img src="w3.jpg"> <!-- Third image -->
            <a class="prev" onclick="plusSlides(this, -1)">&#10094;</a>
            <a class="next" onclick="plusSlides(this, 1)">&#10095;</a>
        </div>
    </section>

    <!-- Third slideshow component -->
    <section class="slideshow-section">
        <div class="slideshow-text">
            <h2>PAW Team Retreat</h2>
            <p>A PAW Team Retreat typically refers to a gathering for the Prayer, Advocacy, and Worship (PAW) team within a church or religious organization. This retreat serves as an opportunity for team members to come together, reflect, strengthen their spiritual practices, and plan for future initiatives. Here are some key components of a PAW Team Retreat:</p>
            <p class="date">Date: July 3, 2023</p>
        </div>
        <div class="slideshow">
            <img src="paw1.jpg" class="active"> <!-- First image -->
            <img src="paw2.jpg"> <!-- Second image -->
            <img src="paw3.jpg"> <!-- Third image -->
            <a class="prev" onclick="plusSlides(this, -1)">&#10094;</a>
            <a class="next" onclick="plusSlides(this, 1)">&#10095;</a>
        </div>
    </section>
</main>

<script>
    // Function to handle slide navigation
    function plusSlides(button, n) {
        const slideshow = button.parentNode;
        const images = slideshow.querySelectorAll('img');
        let activeIndex = Array.from(images).findIndex(img => img.classList.contains('active'));

        images[activeIndex].classList.remove('active');
        activeIndex = (activeIndex + n + images.length) % images.length;
        images[activeIndex].classList.add('active');
    }
</script>

</body>
</html>
