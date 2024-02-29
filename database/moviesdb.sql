-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2022 at 04:07 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`id`, `name`) VALUES
(1, 'Mad Gibs'),
(2, 'Jim Nick'),
(3, 'Jack Drew'),
(4, 'Ron Clark'),
(5, 'Nas Mackenzy'),
(7, 'Steve Lein'),
(9, 'Julian Zhar'),
(10, 'Ryan Rye'),
(12, 'May More'),
(14, 'Alex Robert');

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`id`, `name`) VALUES
(1, 'George Aston'),
(2, 'Jack Pherton'),
(3, 'Kung Bux'),
(4, 'Stanley Fopola');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Sci Fiction'),
(3, 'Action'),
(4, 'Musical'),
(6, 'Horror'),
(7, 'Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `genre_id` int NOT NULL,
  `director_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image`, `year`, `genre_id`, `director_id`) VALUES
(8, 'Tuxc red', 'Such jves icugsd', 'uploaded-img/captaiin.marvel.jpg', 2017, 4, 4),
(9, 'Whitsle orange', 'Sdc diohciousd ', 'uploaded-img/avengers.jpg', 2200, 3, 4),
(10, 'Nuv', 'xcrta ry', 'uploaded-img/guardians.jpg', 2154, 3, 4),
(11, 'Cat\'s day', 'cbsd cidsu', 'uploaded-img/black.jpg', 2001, 3, 4),
(12, 'Friday 14', '1414lncx asx d', 'uploaded-img/spider2.jpg', 2014, 6, 4),
(13, 'May Bay', 'xasv iwoqu', 'uploaded-img/infinity.jpg', 2050, 4, 3),
(14, 'Marble Net', 'uiygd iuew', 'uploaded-img/guardians.jpg', 1999, 1, 4),
(15, 'Air Proof', 'iuhdew uodwfut', 'uploaded-img/deadpool.jpg', 2006, 7, 4),
(16, 'Hitch Hick', 'nobnvt rdxsq', 'uploaded-img/strange.jpg', 2020, 1, 1),
(17, 'Spidercat', 'A cat with 8 legs', 'uploaded-img/spiderman-no-way-home.jpg', 2000, 3, 4),
(18, 'Pandarok', 'Ragna', 'uploaded-img/thor.jpg', 1999, 1, 1),
(19, 'Dark In Here', 'Black dark', 'uploaded-img/thor2.jpg', 2002, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `movies_actors`
--

CREATE TABLE `movies_actors` (
  `id` int NOT NULL,
  `movie_id` int NOT NULL,
  `actor_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movies_actors`
--

INSERT INTO `movies_actors` (`id`, `movie_id`, `actor_id`) VALUES
(7, 12, 4),
(8, 12, 9),
(17, 8, 2),
(18, 8, 12),
(41, 9, 2),
(42, 9, 10),
(48, 11, 5),
(49, 14, 9),
(50, 15, 14),
(51, 16, 3),
(52, 16, 7),
(53, 13, 2),
(54, 13, 7),
(56, 10, 1),
(57, 17, 3),
(58, 17, 4),
(59, 18, 7),
(60, 18, 9),
(61, 19, 5),
(62, 19, 14);

-- --------------------------------------------------------

--
-- Table structure for table `movies_ratings`
--

CREATE TABLE `movies_ratings` (
  `id` int NOT NULL,
  `movie_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` int NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movies_ratings`
--

INSERT INTO `movies_ratings` (`id`, `movie_id`, `user_id`, `rating`, `note`) VALUES
(1, 8, 3, 5, 'jdsj cidsgcids vj'),
(3, 10, 5, 7, 'pers pers'),
(7, 9, 5, 8, 'appor'),
(8, 11, 5, 3, ''),
(9, 16, 5, 10, 'greap'),
(10, 13, 5, 9, ''),
(11, 9, 3, 10, ''),
(12, 14, 3, 1, ''),
(13, 13, 3, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `admin`) VALUES
(1, 'tasos', 'tasos@host.com', '$2y$10$Qx5Jm0qmFSNh.9qF5.Cm.uLDiOevIdPfmboZL.T6noWj2KSlXFtLC', 1),
(3, 'tas1', 'tas1@host.com', '$2y$10$h5aRjjaQlq2ceauhiVE84O/urgYKQvZdF7JmOnJC1Ky47qCgxd5gy', 0),
(5, 'las', 'tas2@host.com', '$2y$10$3DW070xGJCNa37eUby3gL.PIOn08zlY/4/MNfzFmQLWOpM.61EsVi', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `director_id` (`director_id`);

--
-- Indexes for table `movies_actors`
--
ALTER TABLE `movies_actors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `movies_ratings`
--
ALTER TABLE `movies_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `movies_actors`
--
ALTER TABLE `movies_actors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `movies_ratings`
--
ALTER TABLE `movies_ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `directors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `movies_actors`
--
ALTER TABLE `movies_actors`
  ADD CONSTRAINT `movies_actors_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `movies_actors_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `movies_ratings`
--
ALTER TABLE `movies_ratings`
  ADD CONSTRAINT `movies_ratings_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `movies_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
