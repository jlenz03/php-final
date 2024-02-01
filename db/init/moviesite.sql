-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220331.b9ddf0b305
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2024 at 10:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviesite`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL DEFAULT '',
  `movie_type` tinyint(2) NOT NULL DEFAULT 0,
  `movie_year` int(4) NOT NULL DEFAULT 0,
  `movie_leadactor` int(11) NOT NULL DEFAULT 0,
  `movie_director` int(11) NOT NULL DEFAULT 0,
  `movie_running_time` int(11) DEFAULT NULL,
  `movie_cost` int(11) DEFAULT NULL,
  `movie_takings` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci PACK_KEYS=0;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_id`, `movie_name`, `movie_type`, `movie_year`, `movie_leadactor`, `movie_director`, `movie_running_time`, `movie_cost`, `movie_takings`) VALUES
(1, 'Bruce Almighty', 5, 2003, 1, 2, 102, 10, 15),
(3, 'Grand Canyon', 2, 1991, 4, 3, 134, 15, 10),
(2, 'Office Space', 5, 1999, 5, 6, 90, 3, 90);

-- --------------------------------------------------------

--
-- Table structure for table `movietype`
--

CREATE TABLE `movietype` (
  `movietype_id` int(11) NOT NULL,
  `movietype_label` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `movietype`
--

INSERT INTO `movietype` (`movietype_id`, `movietype_label`) VALUES
(1, 'Sci-Fi'),
(2, 'Drama'),
(3, 'Adventure'),
(4, 'War'),
(5, 'Comedy'),
(6, 'Horror'),
(7, 'Action'),
(8, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `people_id` int(11) NOT NULL,
  `people_fullname` varchar(255) NOT NULL DEFAULT '',
  `people_isactor` tinyint(1) NOT NULL DEFAULT 0,
  `people_isdirector` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci PACK_KEYS=0;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`people_id`, `people_fullname`, `people_isactor`, `people_isdirector`) VALUES
(1, 'Jim Carrey', 1, 0),
(2, 'Tom Shadyac', 0, 1),
(3, 'Lawrence Kasdan', 0, 0),
(4, 'Kevin Kline', 1, 0),
(5, 'Ron Livingston', 0, 0),
(6, 'Mike Judge', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_movie_id` int(11) NOT NULL,
  `review_date` date NOT NULL,
  `review_name` varchar(255) NOT NULL,
  `review_reviewer_name` varchar(255) NOT NULL,
  `review_comment` varchar(255) NOT NULL,
  `review_rating` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_movie_id`, `review_date`, `review_name`, `review_reviewer_name`, `review_comment`, `review_rating`) VALUES
(1, '2003-08-02', 'This movie rocks!', 'John Doe', 'I thought this was a great movie even though \n     my girlfriend made me see it against my will.', 4),
(1, '2003-08-01', 'An okay movie', 'Billy Bob', 'This was an okay movie. I liked Eraserhead \n     better.', 2),
(1, '2003-08-10', 'Woo hoo!', 'Peppermint Patty', 'Wish I\'d have seen it sooner!', 5),
(2, '2003-08-01', 'My favorite movie', 'Marvin Marian', 'I didn\'t wear my flair to the movie but \n     I loved it anyway.', 5),
(3, '2003-08-01', 'An awesome time', 'George B.', 'I liked this movie, even though I thought it \n     was an informational video from our travel agent.', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `movie_type` (`movie_type`,`movie_year`);
ALTER TABLE `movie` ADD FULLTEXT KEY `movie_name` (`movie_name`);

--
-- Indexes for table `movietype`
--
ALTER TABLE `movietype`
  ADD PRIMARY KEY (`movietype_id`);
ALTER TABLE `movietype` ADD FULLTEXT KEY `movietype_label` (`movietype_label`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`people_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `review_movie_id` (`review_movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movietype`
--
ALTER TABLE `movietype`
  MODIFY `movietype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `people_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
