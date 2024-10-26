-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 10:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `judul`, `kategori`, `deskripsi`, `jumlah`, `pdf`, `cover`, `created_at`, `user_id`) VALUES
(284, 'Harry Potter and the Chamber of Secrets', 'Mystery', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 6, NULL, 'https://covers.openlibrary.org/b/id/14333263-L.jpg', '2024-08-10 18:23:55', NULL),
(285, 'The Catcher in the Rye', 'Fiction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 3, NULL, 'https://covers.openlibrary.org/b/id/8427258-L.jpg', '2024-08-10 18:23:55', NULL),
(286, 'Twilight', 'Fiction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 3, NULL, 'https://covers.openlibrary.org/b/id/12642040-L.jpg', '2024-08-10 18:23:55', NULL),
(287, 'A Brief History of Time', 'Fiction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 13, NULL, 'https://covers.openlibrary.org/b/id/14589690-L.jpg', '2024-08-10 18:23:55', NULL),
(288, 'To Kill a Mockingbird', 'fiction', 'USA/CAN', 1, NULL, 'https://covers.openlibrary.org/b/id/14351032-L.jpg', '2024-08-10 18:23:55', NULL),
(289, 'The Grapes of Wrath', 'Fantasy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 9, NULL, 'https://covers.openlibrary.org/b/id/111512-L.jpg', '2024-08-10 18:23:55', NULL),
(290, 'A Tale of Two Cities', 'Fantasy', 'Includes bibliographical references (p. xli-xlvii).\r\nIncludes updated editorial material, revised Dickens Chronology and new appendix.\r\nReprint\r\nUK/CAN/US', 8, NULL, 'https://covers.openlibrary.org/b/id/8493695-L.jpg', '2024-08-10 18:23:55', NULL),
(291, 'The Da Vinci Code', 'Mystery', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 10, NULL, 'https://covers.openlibrary.org/b/id/12748129-L.jpg', '2024-08-10 18:23:55', NULL),
(292, 'The Stranger', 'Mystery', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/13151259-L.jpg', '2024-08-10 18:23:55', NULL),
(293, 'Nineteen Eighty-Four', 'Romance', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/12054527-L.jpg', '2024-08-10 18:23:55', NULL),
(294, 'Things Fall Apart', 'Romance', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/14595726-L.jpg', '2024-08-10 18:23:55', NULL),
(295, 'The Power of Habit', 'Thriller', 'Includes bibliographical references and index.', 1, NULL, 'https://covers.openlibrary.org/b/id/10830791-L.jpg', '2024-08-10 18:23:55', NULL),
(296, 'Ulysses', 'History', 'Series statement from jacket.', 5, NULL, 'https://covers.openlibrary.org/b/id/11416772-L.jpg', '2024-08-10 18:23:55', NULL),
(297, 'Gone Girl', 'Education', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 8, NULL, 'https://covers.openlibrary.org/b/id/12498395-L.jpg', '2024-08-10 18:23:55', NULL),
(298, 'Fear and loathing in Las Vegas', 'History', 'Reprint. Originally published: New York : Random House, 1976.', 1, NULL, 'https://covers.openlibrary.org/b/id/14637487-L.jpg', '2024-08-10 18:23:55', NULL),
(299, 'Gates of fire', 'History', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/241632-L.jpg', '2024-08-10 18:23:55', NULL),
(300, 'I, Robot', 'Science', 'No Description', 1, NULL, 'https://covers.openlibrary.org/b/id/11395675-L.jpg', '2024-08-10 18:23:55', NULL),
(301, 'Between the World and Me', 'History', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/14428832-L.jpg', '2024-08-10 18:23:55', NULL),
(302, 'Outliers', 'Science', 'Includes bibliographical references and index.', 1, NULL, 'https://covers.openlibrary.org/b/id/6581522-L.jpg', '2024-08-10 18:23:55', NULL),
(303, 'Beloved', 'Education', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/10653442-L.jpg', '2024-08-10 18:23:55', NULL),
(304, 'The magicians', 'Mystery', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/6294573-L.jpg', '2024-08-10 18:23:55', NULL),
(305, 'How Book Reading Affects Student Performance?', 'Fiction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 3, NULL, 'https://covers.openlibrary.org/b/id/14642846-L.jpg', '2024-08-10 18:23:55', NULL),
(306, 'The Hobbit And The Lord Of The Rings The Hobbit The Fellowship Of The Ring The Two Towers The Return Of The King', 'Non-Fiction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 3, NULL, 'https://covers.openlibrary.org/b/id/7657446-L.jpg', '2024-08-10 18:23:55', NULL),
(307, 'The Hobbit', 'Thriller', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/394001-L.jpg', '2024-08-10 18:23:55', NULL),
(308, 'Good Omens', 'Romance', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/10482245-L.jpg', '2024-08-10 18:23:55', NULL),
(309, 'The Little Prince', 'Fantasy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 7, NULL, 'https://covers.openlibrary.org/b/id/7268667-L.jpg', '2024-08-10 18:23:55', NULL),
(310, 'The Lion, the Witch and the Wardrobe', 'Thriller', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/9255461-L.jpg', '2024-08-10 18:23:55', NULL),
(311, 'The Book Thief', 'Thriller', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/8310846-L.jpg', '2024-08-10 18:23:55', NULL),
(312, 'The giving tree', 'Fiction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/11769478-L.jpg', '2024-08-10 18:23:55', NULL),
(313, 'Green Eggs and Ham (1988)', 'History', 'Reprint. Originally published: New York : Beginner Books, 1960.\r\n\r\n&amp;quot;B-16&amp;quot;--Spine.', 1, NULL, 'https://covers.openlibrary.org/b/id/6507741-L.jpg', '2024-08-10 18:23:55', NULL),
(314, 'Where the Wild Things Are', 'Mystery', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/9276325-L.jpg', '2024-08-10 18:23:55', NULL),
(315, 'The Great Gatsby', 'Romance', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/14314120-L.jpg', '2024-08-10 18:23:55', NULL),
(316, 'How to Win Friends &amp;amp; Influence People', 'Romance', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/14548353-L.jpg', '2024-08-10 18:23:55', NULL),
(317, 'World order', 'Technology', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/7311877-L.jpg', '2024-08-10 18:23:55', NULL),
(318, 'The Hobbit And The Lord Of The Rings The Hobbit The Fellowship Of The Ring The Two Towers The Return Of The King', 'Fiction', 'No Description', 1, NULL, 'https://covers.openlibrary.org/b/id/7657446-L.jpg', '2024-08-10 18:23:55', NULL),
(319, 'Sapiens: A Brief History of Humankind', 'Technology', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/11237094-L.jpg', '2024-08-10 18:23:55', NULL),
(320, 'And Then There Were None', 'Mystery', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/12854241-L.jpg', '2024-08-10 18:23:55', NULL),
(321, 'The Da Vinci Code', 'History', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/6301424-L.jpg', '2024-08-10 18:23:55', NULL),
(322, 'The Moon Is A Harsh Mistress', 'Mystery', '&amp;quot;A Tom Doherty Associates book.&amp;quot;\r\n\r\nPrometheus Hall of Fame Award, 1983.\r\n\r\nHugo Award for Best Novel, 1967.', 1, NULL, 'https://covers.openlibrary.org/b/id/14630743-L.jpg', '2024-08-10 18:23:55', NULL),
(323, 'A Brief History of Time', 'History', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 1, NULL, 'https://covers.openlibrary.org/b/id/14589690-L.jpg', '2024-08-10 18:23:55', NULL),
(324, 'Do androids dream of electric sheep?', 'Technology', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque soluta animi ratione neque placeat magni, dignissimos doloribus! Amet, animi iure quas laborum totam aut nam illum doloribus natus nisi nemo', 17, NULL, 'https://covers.openlibrary.org/b/id/6917227-L.jpg', '2024-08-10 18:23:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'History', '2024-08-11 18:27:59', '2024-08-11 18:27:59'),
(2, 'Fiction', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(3, 'Non-Fiction', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(4, 'Fantasy', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(5, 'Romance', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(6, 'Mystery', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(7, 'Thriller', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(8, 'Science', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(9, 'Technology', '2024-08-11 18:35:45', '2024-08-11 18:35:45'),
(10, 'Education', '2024-08-11 18:35:45', '2024-08-11 18:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`) VALUES
(1, 'amrylil', 'ulilamry432@gmail.com', '$2y$10$4tZx8pynU22pgeBIMDH/J.Ap37/8Vja7CpzzKXA/Bl5gUVQ498TYO', 'Ulil Amry Al Qadri'),
(2, 'tiaku', 'tiaku432@gmail.com', '$2y$10$R.O.yEe9h7F2uC.uLV8cve9r/6HpgjFT83SJsebqPPPNWg/9cf.t.', 'Artia'),
(3, 'anana', 'abc@gmail.com', '$2y$10$gWv5SB5Bgr4gWlTEHohOwuhXMBlVbcGkc0U3FmFlBdEFMGwM3Cr6m', 'rohimah'),
(4, 'anuku', 'mhhmedunyil@gmail.com', '$2y$10$fw/SX/L5ACh6LFp2Z5jpx.9eU1JqTFHRgq9YI9wJfZZSMoIrPjbEy', 'anuanuanu'),
(5, 'hamba123', 'abc@gmail.com', '$2y$10$6/ipwc9ax4Yf6gxucC1bYeNbZCI3JQR32.2jg89iaRnHAvSO4T1fe', 'hamba allah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
