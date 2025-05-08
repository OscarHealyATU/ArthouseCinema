-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2025 at 11:16 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18
create database if not EXISTS silverstrand_screen;
use silverstrand_screen;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silverstrand_screen`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `article_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `film_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `director` varchar(100) DEFAULT NULL,
  `release_year` int DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `description` text,
  `film_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`film_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`film_id`, `title`, `director`, `release_year`, `genre`, `description`, `film_url`) VALUES
(1, 'Persona', 'Ingmar Bergman', 1966, 'Drama', 'A nurse is put in charge of a mute actress and finds that their personalities are melding together in disturbing ways.', 'Persona'),
(2, 'The Seventh Seal', 'Ingmar Bergman', 1957, 'Fantasy', 'A knight returning from the Crusades seeks answers about life, death, and the existence of God as he plays chess with Death itself.', 'The%20Seventh%20Seal'),
(3, 'Stalker', 'Andrei Tarkovsky', 1979, 'Sci-Fi', 'A guide leads two men through a mysterious Zone to find a room that grants their deepest desires.', 'Stalker'),
(4, 'Breathless', 'Jean-Luc Godard', 1960, 'Crime/Drama', 'A young car thief kills a policeman and tries to persuade a girl to run away with him to Italy.', 'Breathless'),
(5, 'The Mirror', 'Andrei Tarkovsky', 1975, 'Drama/Autobiographical', 'A fragmented reflection of a man\'s memories, dreams, and poetry throughout his life, blending personal and historical events.', 'The%20Mirror'),
(6, 'Blue Velvet', 'David Lynch', 1986, 'Mystery/Thriller', 'A college student discovers a severed ear in a field and uncovers a sinister mystery involving a beautiful nightclub singer and a psychopathic criminal.', 'Blue%20Velvet'),
(7, 'The Grand Budapest Hotel', 'Wes Anderson', 2014, 'Comedy/Drama', 'The adventures of a legendary concierge and his protégé as they become embroiled in a theft, a murder, and a pursuit through Europe.', 'The%20Grand%20Budapest%20Hotel'),
(8, 'Eraserhead', 'David Lynch', 1977, 'Horror', 'A surreal and nightmarish look at a man grappling with fatherhood, alienation, and a deeply unsettling environment.', 'Eraserhead'),
(9, 'La Dolce Vita', 'Federico Fellini', 1960, 'Drama', 'A journalist navigates the opulence and depravity of Rome\'s elite while questioning the meaning of his life.', 'La%20Dolce%20Vita'),
(10, 'Chungking Express', 'Wong Kar-wai', 1994, 'Romance/Drama', 'Two melancholic Hong Kong policemen cross paths with enigmatic women who alter their lives in profound ways.', 'Chungking%20Express'),
(11, 'The Lobster', 'Yorgos Lanthimos', 2015, 'Romance/Sci-Fi', 'In a dystopian society, single people are turned into animals if they fail to find a partner within 45 days.', 'The%20Lobster'),
(12, 'Amélie', 'Jean-Pierre Jeunet', 2001, 'Romance/Comedy', 'A shy Parisian waitress decides to change the lives of those around her while grappling with her own loneliness.', 'Am%C3%A9lie'),
(13, 'Moonlight', 'Barry Jenkins', 2016, 'Drama', 'A chronicle of a young African-American man’s struggle with his identity and sexuality in a rough Miami neighborhood.', 'Moonlight'),
(14, 'Parasite', 'Bong Joon-ho', 2019, 'Thriller/Drama', 'A poor family schemes to become employed by a wealthy household by infiltrating their lives through deceit.', 'Parasite'),
(15, 'A Ghost Story', 'David Lowery', 2017, 'Drama/Fantasy', 'A spectral figure observes the lives of his loved ones and the passing of time after his untimely death.', 'A%20Ghost%20Story');

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

DROP TABLE IF EXISTS `merchandise`;
CREATE TABLE IF NOT EXISTS `merchandise` (
  `merchandise_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`merchandise_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`merchandise_id`, `name`, `description`, `price`, `stock`, `image_url`, `created_at`) VALUES
(1, 'Small Popcorn', 'Freshly popped small-sized popcorn.', 3.50, 100, 'small_popcorn.jpg', '2024-12-09 17:04:41'),
(2, 'Large Popcorn', 'Freshly popped large-sized popcorn.', 5.50, 100, 'large_popcorn.jpg', '2024-12-09 17:04:41'),
(3, 'Pick and Mix', 'A mix of your favorite sweets.', 4.00, 50, 'pick_and_mix.jpg', '2024-12-09 17:04:41'),
(4, 'Soft Drink', 'A 500ml bottle of soft drink.', 2.50, 100, 'soft_drink.jpg', '2024-12-09 17:04:41'),
(5, 'Christmas Movie Popcorn Bucket', 'A festive-themed popcorn bucket featuring snowflakes and Christmas trees.', 10.00, 30, 'christmas_popcorn_bucket.jpg', '2024-12-09 17:04:41'),
(6, 'Jurassic Park Popcorn Bucket', 'A dinosaur-themed popcorn bucket featuring Jurassic Park branding.', 12.00, 25, 'jurassic_popcorn_bucket.jpg', '2024-12-09 17:04:41'),
(7, 'Christmas Movie Poster', 'Poster for the holiday classic \"A Christmas Carol\".', 5.00, 50, 'christmas_movie_poster.jpg', '2024-12-09 17:04:41'),
(8, 'Jurassic Park Poster', 'Iconic Jurassic Park movie poster.', 7.50, 40, 'jurassic_park_poster.jpg', '2024-12-09 17:04:41'),
(9, 'Movie Branded T-Shirt', 'A comfortable t-shirt featuring movie branding.', 15.00, 20, 'movie_tshirt.jpg', '2024-12-09 17:04:41'),
(10, 'Movie Branded Hoodie', 'A cozy hoodie featuring iconic movie branding.', 30.00, 15, 'movie_hoodie.jpg', '2024-12-09 17:04:41'),
(11, 'Classic Movie Mug', 'A ceramic mug featuring a classic movie design.', 8.00, 40, 'movie_mug.jpg', '2024-12-09 17:04:41'),
(12, 'Limited Edition Christmas Ornament', 'A collectible Christmas ornament featuring a movie design.', 12.00, 30, 'christmas_ornament.jpg', '2024-12-09 17:04:41'),
(13, 'Cinema Gift Card - $20', 'A $20 gift card redeemable at the cinema.', 20.00, 100, 'gift_card_20.jpg', '2024-12-09 17:04:41'),
(14, 'Cinema Gift Card - $50', 'A $50 gift card redeemable at the cinema.', 50.00, 50, 'gift_card_50.jpg', '2024-12-09 17:04:41'),
(15, '3D Glasses', 'Reusable 3D glasses for watching 3D movies.', 3.00, 150, '3d_glasses.jpg', '2024-12-09 17:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `merchandise_comments`
--

DROP TABLE IF EXISTS `merchandise_comments`;
CREATE TABLE IF NOT EXISTS `merchandise_comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `merchandise_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `merchandise_id` (`merchandise_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_articles`
--

DROP TABLE IF EXISTS `news_articles`;
CREATE TABLE IF NOT EXISTS `news_articles` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int NOT NULL,
  `published_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screenings`
--

DROP TABLE IF EXISTS `screenings`;
CREATE TABLE IF NOT EXISTS `screenings` (
  `screening_id` int NOT NULL AUTO_INCREMENT,
  `film_id` int NOT NULL,
  `screening_date` datetime NOT NULL,
  `location` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`screening_id`),
  KEY `film_id` (`film_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `screenings`
--

INSERT INTO `screenings` (`screening_id`, `film_id`, `screening_date`, `location`, `price`) VALUES
(1, 1, '2024-12-05 18:00:00', 'Screen1', 12.50),
(2, 1, '2024-12-06 20:30:00', 'Screen2', 12.50),
(3, 2, '2024-12-05 16:00:00', 'Screen1', 10.00),
(4, 2, '2024-12-07 19:00:00', 'Screen3', 10.00),
(5, 3, '2024-12-05 19:30:00', 'Screen2', 14.00),
(6, 3, '2024-12-06 21:00:00', 'Screen2', 14.00),
(7, 4, '2024-12-06 15:00:00', 'Screen1', 8.00),
(8, 5, '2024-12-07 14:00:00', 'Screen3', 9.50),
(9, 5, '2024-12-08 18:00:00', 'Screen1', 9.50),
(10, 6, '2024-12-05 20:00:00', 'Screen2', 11.00),
(11, 6, '2024-12-07 22:00:00', 'Screen3', 11.00),
(12, 7, '2024-12-08 19:30:00', 'Screen1', 15.00),
(13, 8, '2024-12-07 23:30:00', 'Screen2', 13.00),
(14, 9, '2024-12-06 17:30:00', 'Screen1', 10.00),
(15, 9, '2024-12-07 20:00:00', 'Screen3', 10.00),
(16, 10, '2024-12-05 14:30:00', 'Screen1', 12.00),
(17, 10, '2024-12-08 17:30:00', 'Screen2', 12.00),
(18, 11, '2024-12-08 16:00:00', 'Screen3', 14.00),
(19, 12, '2024-12-05 18:30:00', 'Screen2', 12.00),
(20, 13, '2024-12-07 21:00:00', 'Screen3', 14.50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(27, 'Oscar', 'oscar.healy101@gmail.com', '123', '2025-02-12 10:31:16'),
(28, 'SquareP', 'Square@mail.com', '$2y$10$if1xhjv1boAA9oxc01K7s.wb9dySzc1tH4PEfEY9UAvd4Y2pGFLNS', '2025-04-29 08:19:35'),
(29, 'John', 'milk@mail.com', '$2y$10$ZkX9xe5kf9VChEWoK5j/N.yuxlL0Q8FbwPUicwpVcLd5fx3kPp2eW', '2025-04-30 02:30:59'),
(30, 'test', 'test@emial.com', '$2y$10$O/lk3xS7eQtPV8cNQHtXre2i.1QkO8yJIi.5TSSF7Fbn7nh3LHIzK', '2025-04-30 02:31:46'),
(31, 'Aaron2', 'aaron2@email.com', '$2y$10$yyNA7yH3d48DePtmKK2p2.iDuVHmN1.CTjnBuA7U9pVhqwZRBOCLm', '2025-04-30 08:16:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
