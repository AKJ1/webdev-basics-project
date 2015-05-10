-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2015 at 03:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: 'photo_album'
--

-- --------------------------------------------------------

--
-- Table structure for table 'albums'
--

CREATE TABLE IF NOT EXISTS albums (
id int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  created_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  created_by int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'comments'
--

CREATE TABLE IF NOT EXISTS comments (
id int(11) NOT NULL,
  title text NOT NULL,
  content text NOT NULL,
  `posted-at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_id int(11) DEFAULT NULL,
  image_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'images'
--

CREATE TABLE IF NOT EXISTS images (
id int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  content mediumblob NOT NULL,
  `type` varchar(30) NOT NULL,
  uploaded_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  uploaded_by int(11) DEFAULT NULL,
  album_id int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'users'
--

CREATE TABLE IF NOT EXISTS users (
id int(11) NOT NULL,
  user_name varchar(255) NOT NULL,
  password_hash varchar(255) NOT NULL,
  is_admin tinyint(1) NOT NULL,
  is_active tinyint(1) NOT NULL,
  created_on datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_on datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  email text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table albums
--
ALTER TABLE albums
 ADD PRIMARY KEY (id), ADD KEY created_by (created_by);

--
-- Indexes for table comments
--
ALTER TABLE comments
 ADD PRIMARY KEY (id), ADD KEY fk_user (user_id), ADD KEY fk_image (image_id);

--
-- Indexes for table images
--
ALTER TABLE images
 ADD PRIMARY KEY (id), ADD KEY images_ibfk_1 (uploaded_by), ADD KEY images_ibfk_2 (album_id);

--
-- Indexes for table users
--
ALTER TABLE users
 ADD PRIMARY KEY (id), ADD UNIQUE KEY user_name (user_name);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table albums
--
ALTER TABLE albums
MODIFY id int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table comments
--
ALTER TABLE comments
MODIFY id int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table images
--
ALTER TABLE images
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table albums
--
ALTER TABLE albums
ADD CONSTRAINT albums_ibfk_1 FOREIGN KEY (created_by) REFERENCES `users` (id);

--
-- Constraints for table comments
--
ALTER TABLE comments
ADD CONSTRAINT fk_image FOREIGN KEY (image_id) REFERENCES images (id),
ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES `users` (id);

--
-- Constraints for table images
--
ALTER TABLE images
ADD CONSTRAINT images_ibfk_1 FOREIGN KEY (uploaded_by) REFERENCES `users` (id) ON UPDATE SET NULL,
ADD CONSTRAINT images_ibfk_2 FOREIGN KEY (album_id) REFERENCES albums (id) ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
