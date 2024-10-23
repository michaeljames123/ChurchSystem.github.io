-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 06:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `create_at`) VALUES
(9, 'Michael', '$2y$10$Lj5tTTMc6KPPWCmwLWAGg.Oy9Q8xa0vZX0z1sli9ss3GnbwS24xB2', '2024-10-06 06:05:38'),
(10, 'artixweapon', '$2y$10$wSL91MQwXZlfReIDTueXhuaSU8U3Cvu1oDpvyBJlRozCDvUNH2Qrq', '2024-10-06 06:11:06'),
(12, 'Nadz', '$2y$10$ONp5h7pwMlxvo5ajNb6y/.kHP9V0h6rl8AxQjc4sOju.LRMZT3Qu2', '2024-10-06 06:11:39'),
(13, 'Rosmar', '$2y$10$i1OEiazmjHgC234SQ1YlRue6XL/edMh7AfxN7X6u2Vn4nh67K4qA6', '2024-10-06 06:12:02'),
(14, 'asdas223', '$2y$10$/6UrO.ElFqEM2HbMGtKG.uaHE/P6noMDEu0RYcWhfMWs2doe6xxRe', '2024-10-06 06:14:41'),
(15, 'michaeljames.nazareno@hcdc.edu.ph', '$2y$10$lypSVs1JJDBfy1TG1xT7Oe0pFdL2yBinM/e76UUMXcxJ5.MaSSZF6', '2024-10-06 06:35:08'),
(16, 'asd', '$2y$10$KCbR29ktkHcKD.XOc2Z8COMCRl.H6HhvB1nNkA8kZQAQ01SFhYZtu', '2024-10-06 06:35:16'),
(17, 'michael1', '$2y$10$Vc8eNwsDOZZg9xbWBSEt8e.mAKOX8T0yU4VB2/XU0RMyMs3lX/gUi', '2024-10-06 06:46:47'),
(18, 'dddd123', '$2y$10$u5qa65oSq3kJAguMyJFbfOudWYAp.FgEKL5VP7AFRQqA0LdxviyZK', '2024-10-06 06:47:01'),
(19, 'Mark2134', '$2y$10$ObGAVa5JhJlwSMAo9.dHGuRpT4QMXp9aXV/J7wdHpT8lYFMrNJW9e', '2024-10-06 06:56:45'),
(20, 'lokok', '$2y$10$DXjTFXumnmi7bFAEiwGdNekqkEUL7QZ7ODvzt7CFJHnlUWQXfLZk2', '2024-10-06 06:56:58'),
(21, 'you', '$2y$10$afUzIRiax.d0uWPws9UiqullsMTUTcHWDYfsT2O3A89my0B3wr9C6', '2024-10-06 06:57:37'),
(22, 'tao', '$2y$10$S.Z8CFXqnOOVBd/mGzHTwe05jLoEvqZiDSg.ehmda04krEy8z98GW', '2024-10-06 08:25:35'),
(25, 'Veejay123', '$2y$10$VkbgSbviT.paxGZNDkz.BehYKkEru9okIPEYKvr1QTJBFXUacMJbu', '2024-10-19 13:16:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;






-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 06:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookings`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `booking_date` date NOT NULL,
  `service_type` enum('Baptism','Child Dedication','Funeral Service') NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `booking_date`, `service_type`, `username`) VALUES
(2, 'Michaeljamesnazareno', 'michaeljames.nazareno@hcdc.edu.ph', '2024-10-09', 'Baptism', ''),
(7, 'michaelangelo', 'you@gmail.com', '2024-10-30', 'Baptism', 'you'),
(8, 'Mislangtot', 'Vej@gmail.com', '2024-10-31', 'Baptism', 'Veejay123'),
(9, 'test', 'test@gmail.com', '2024-11-09', 'Baptism', 'you'),
(10, 'test', 'test@gmail.com', '2024-12-06', 'Baptism', 'you');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 06:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookings`
--

-- --------------------------------------------------------

--
-- Table structure for table `child_dedication_bookings`
--

CREATE TABLE `child_dedication_bookings` (
  `id` int(11) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `dedication_date` date NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child_dedication_bookings`
--

INSERT INTO `child_dedication_bookings` (`id`, `parent_name`, `parent_email`, `child_name`, `dedication_date`, `username`) VALUES
(7, 'geoly', 'geoly@gmail.com', 'Grendo', '2024-10-31', 'you'),
(8, 'Mark', 'mark123@gmail.com', 'sdojsdo', '2024-11-01', 'you'),
(9, 'muammy', 'muammy@gmail.com', 'Veerafd', '2024-10-29', 'Veejay123'),
(10, 'daddy', 'Dsds@gmail.com', 'Meo', '2024-10-29', 'you');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child_dedication_bookings`
--
ALTER TABLE `child_dedication_bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child_dedication_bookings`
--
ALTER TABLE `child_dedication_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 06:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookings`
--

-- --------------------------------------------------------

--
-- Table structure for table `funeral_service_bookings`
--

CREATE TABLE `funeral_service_bookings` (
  `id` int(11) NOT NULL,
  `deceased_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `service_date` date NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funeral_service_bookings`
--

INSERT INTO `funeral_service_bookings` (`id`, `deceased_name`, `contact_person`, `contact_email`, `service_date`, `username`) VALUES
(1, 'iangam', '09462658753', 'ianfamily@gmail.com', '2024-10-31', ''),
(3, 'melai', '09462658753', 'ianfamily@gmail.com', '2024-10-23', 'you'),
(4, 'rafaela', '09412651512', 'rafaelafam@gmail.com', '2024-10-31', 'Veejay123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `funeral_service_bookings`
--
ALTER TABLE `funeral_service_bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `funeral_service_bookings`
--
ALTER TABLE `funeral_service_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 06:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `church_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `submitted_at`) VALUES
(1, 'Michaeljamesnazareno', 'michaeljames.nazareno@hcdc.edu.ph', '09462658753', 'HI it is very beautiful', '2024-10-17 17:03:34'),
(2, 'test', 'michael@gmail.com', '09462658753', 'dasdasdasdasdasd', '2024-10-19 20:31:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

