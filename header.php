<?php
session_start(); // Ensure session is started
?>

<header>
    <div class="logo-title">
        <img src="fop2.PNG" alt="Freedom of Praise Church Logo">
        <h1>Freedom of Praise Church</h1>
    </div>
    <nav>
        <a href="home.php">Home</a>
        <a href="event.php">Event</a>
        <a href="book.php">Book Now</a>
        <a href="contact.php">Contact Us</a>
        <?php if (isset($_SESSION['username'])): ?>
            <span>Hello, <?= htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="logout-button">Log out</a>
        <?php else: ?>
            <a href="index.php" class="signin-button">Sign Up</a>
        <?php endif; ?>
    </nav>
</header>

