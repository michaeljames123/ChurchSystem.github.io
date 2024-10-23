<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Freedom of Praise Church</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
            
        }

        /* Background image for the main content */
        main {
            min-height: 100vh;
            background-image: url('fop1.jpg'); /* Path to the background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 20px;
        }

        h3 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 50px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 50px;
            padding: 40px;
        }

        .contact-info, .contact-form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-info h2, .contact-form h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .contact-info p, .contact-form label {
            font-size: 1.1rem;
            color: #555;
        }

        .contact-form input, 
        .contact-form textarea {
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-form button {
            background-color: #4A90E2;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background-color: #3f7fc2;
        }

        .map {
            width: 100%;
            height: 400px;
            margin-top: 50px;
        }

        .map iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 768px) {
            .contact-container {
                grid-template-columns: 1fr;
            }
            .map {
                height: 300px;
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include the header -->

<main>
    <h3>Contact Us</h3>

    <div class="contact-container">
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p>We would love to hear from you! Feel free to reach out to us using the contact form or the details below:</p>
            <p><strong>Phone:</strong> <a href="tel:+1234567890">09632608183</a></p>
            <p><strong>Email:</strong> <a href="mailto:info@fopchurch.com">freedomofpraiseilangchurch@gmail.com</a></p>
            <p><strong>Address:</strong> Ilang, Davao City</p>
        </div>

        <div class="contact-form">
            <h2>Contact Form</h2>
            <form action="contact-form-handler.php" method="POST">
    <label for="name">Your Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Your Email</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Your Phone Number</label>
    <input type="tel" id="phone" name="phone">

    <label for="message">Your Message</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit">Send Message</button>
</form>

        </div>
    </div>

    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.9138594054893!2d-122.0842496846904!3d37.42199977982544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb5b01e1a392b%3A0x8f39cf2bc1c46f84!2sGoogleplex!5e0!3m2!1sen!2sus!4v1630415466183!5m2!1sen!2sus"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>

</main>

</body>
</html>
