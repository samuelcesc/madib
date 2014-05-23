-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2014 at 06:35 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `madib`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `user1` (`user1`),
  KEY `user2` (`user2`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`c_id`, `user1`, `user2`, `time`) VALUES
(1, 5, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conversation_reply`
--

CREATE TABLE IF NOT EXISTS `conversation_reply` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply` text,
  `user_id_fk` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `c_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`cr_id`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `c_id_fk` (`c_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conversation_reply`
--

INSERT INTO `conversation_reply` (`cr_id`, `reply`, `user_id_fk`, `time`, `c_id_fk`) VALUES
(1, 'I can do all things through christ that strngthens me...', 5, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_title` varchar(10000) NOT NULL,
  `course_code` varchar(10000) NOT NULL,
  `unique_course_id` varchar(200) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `course_code`, `unique_course_id`, `professor_id`, `program_id`) VALUES
(1, 'Software Engineering 2', 'CSC 421', '', 5, 1),
(2, 'Software Engineering 2', 'CSC 421', 'EEOVce83e6', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_taken`
--

CREATE TABLE IF NOT EXISTS `courses_taken` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses_taken`
--

INSERT INTO `courses_taken` (`student_id`, `course_id`) VALUES
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_posts`
--

CREATE TABLE IF NOT EXISTS `course_posts` (
  `course_posts_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` mediumtext NOT NULL,
  `time_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`course_posts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `course_posts`
--

INSERT INTO `course_posts` (`course_posts_id`, `course_id`, `user_id`, `post_content`, `time_posted`) VALUES
(1, 2, 5, 'I know that this platform will provide a way to know more and see the future better', '2014-04-05 18:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `time_started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`user1`, `user2`, `time_started`) VALUES
(3, 5, '2014-04-11 18:56:17'),
(4, 5, '2014-04-14 23:19:36'),
(9, 5, '2014-04-14 23:53:50'),
(5, 9, '2014-04-15 14:58:46'),
(4, 9, '2014-04-15 15:12:01'),
(5, 4, '2014-04-16 10:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE IF NOT EXISTS `following` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `time_started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`user1`, `user2`, `time_started`) VALUES
(5, 3, '2014-04-11 18:56:17'),
(5, 4, '2014-04-14 23:19:36'),
(5, 9, '2014-04-14 23:53:50'),
(9, 5, '2014-04-15 14:58:46'),
(9, 4, '2014-04-15 15:12:01'),
(4, 5, '2014-04-16 10:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` mediumtext NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` longblob NOT NULL,
  `time_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `thread_id`, `sender_id`, `recipient_id`, `message`, `time_sent`) VALUES
(1, '11146', 2, 5, 0x49207365652061206e657720776179206f662067657474696e67206e6f6f646c65732e2e, '2014-04-05 03:34:51'),
(2, '11146', 2, 5, 0x4f4b2c2049206b6e6f7720796f752061726520636f72726563742e2e2e, '2014-04-12 11:34:20'),
(3, '11132', 4, 5, 0x417961212121212121212121212121212121, '2014-04-12 17:04:10'),
(4, '11146', 5, 2, 0x49206b6e6f772074686174206d657373616765732077696c6c20626520746865206e657720776179206f662073656e64696e672064617461206163726f73732074686520656e7469726520756e6976657273652e2e2e2e, '2014-04-11 18:21:36'),
(5, '11146', 5, 2, '', '2014-04-12 12:20:19'),
(6, '11132', 5, 4, 0x4162692e2e492073656520796f75204f21, '2014-04-12 17:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_content` longtext NOT NULL,
  `time_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `time_posted`) VALUES
(1, 5, 'Ok, Jack Sparrow is in the building..Lets Go!', '2014-04-10 01:37:14'),
(2, 5, 'Aya! I cant Aya! I cant  Aya! I cant  Aya! I cant  v Aya! I cant  Aya! I cant  Aya! I cant  Aya! I cant ', '2014-04-10 01:53:45'),
(3, 5, 'OK, Just have to move on to other tasks...Data Communication Networks soon..', '2014-04-10 02:17:33'),
(4, 5, 'Ok, Share as we can...we will move forward...', '2014-04-11 17:25:57'),
(5, 5, 'OK, We are moving Faster...Kinda...', '2014-04-11 19:03:59'),
(6, 5, 'OK, Move on...', '2014-04-12 09:17:08'),
(7, 5, 'Amen!', '2014-04-12 10:32:11'),
(8, 5, '', '2014-04-12 18:17:02'),
(9, 5, '', '2014-04-12 18:17:05'),
(10, 4, 'blaaaaaaaah', '2014-04-14 18:54:01'),
(11, 10, 'OK, I can move up the ladder now...', '2014-04-14 22:07:33'),
(13, 4, 'noo', '2014-04-16 10:05:29'),
(14, 9, '', '2014-04-17 10:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE IF NOT EXISTS `professors` (
  `professor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`professor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`professor_id`, `user_id`, `title_id`, `date_created`) VALUES
(1, 7, 5, '0000-00-00 00:00:00'),
(2, 8, 4, '0000-00-00 00:00:00'),
(3, 9, 5, '0000-00-00 00:00:00'),
(4, 9, 3, '0000-00-00 00:00:00'),
(5, 15, 4, '0000-00-00 00:00:00'),
(6, 3, 3, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profile_pictures`
--

CREATE TABLE IF NOT EXISTS `profile_pictures` (
  `user_id` int(11) NOT NULL,
  `location` mediumtext NOT NULL,
  `time_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_pictures`
--

INSERT INTO `profile_pictures` (`user_id`, `location`, `time_uploaded`, `status`) VALUES
(5, '/KyWFyT88lt/ce50505d3823b3364722c4ea3d89602b.JPG', '2014-04-17 16:51:03', 0),
(4, '/neqlEapaGv/6031cbebc36e604961da7351c4608716.JPG', '2014-04-12 16:09:48', 1),
(6, 'student_default.jpg', '2014-04-14 18:31:00', 0),
(7, 'student_default.jpg', '2014-04-14 18:37:35', 0),
(8, 'student_default.jpg', '2014-04-14 18:42:40', 0),
(9, 'student_default.jpg', '2014-04-14 18:46:59', 0),
(9, '/EQE1DTSHwE/21885382ed20f58f399bea4116154759.JPG', '2014-04-14 18:48:23', 1),
(10, 'student_default.jpg', '2014-04-14 21:39:11', 0),
(5, '/KyWFyT88lt/4c9d98272d833b33f12e6f69961eccd8.png', '2014-04-17 16:51:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` text NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`) VALUES
(1, 'Computer Science'),
(2, 'MIS'),
(3, 'Accounting'),
(4, 'Business Administration'),
(5, 'Architecture'),
(6, 'Building Technology'),
(7, 'Industrial Chemistry'),
(8, 'Bio-Chemistry'),
(9, 'Industrial Physics'),
(10, 'Chemical Engineering\r\n'),
(11, 'Civil Engineering'),
(12, 'Electrical & Information Engineering'),
(13, 'Mechanical Engineering\r\n'),
(14, 'Petroleum Engineering'),
(15, 'Estate Management'),
(16, 'Psychology'),
(17, 'Mass Communication'),
(18, 'Sociology'),
(19, 'Economics'),
(20, 'ICE'),
(21, 'Computer Engineering'),
(22, 'English'),
(23, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `quick_profile`
--

CREATE TABLE IF NOT EXISTS `quick_profile` (
  `user_id` int(11) NOT NULL,
  `followers` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quick_profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `level`, `date_created`) VALUES
(1, 1, 400, '2014-04-14 21:58:08'),
(2, 2, 500, '2014-04-14 21:58:51'),
(3, 4, 400, '0000-00-00 00:00:00'),
(4, 5, 400, '0000-00-00 00:00:00'),
(5, 6, 400, '2014-04-14 18:31:00'),
(6, 7, 300, '2014-04-14 18:37:35'),
(7, 8, 400, '2014-04-14 18:42:40'),
(8, 9, 400, '2014-04-14 18:46:59'),
(9, 10, 500, '2014-04-14 21:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` text NOT NULL,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`title_id`, `title_name`) VALUES
(1, 'Mr'),
(2, 'Miss'),
(3, 'Mrs'),
(4, 'Dr'),
(5, 'Prof');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `program_id` int(11) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `auth_token` varchar(1000) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email_address`, `program_id`, `password`, `auth_token`, `date_created`, `status`) VALUES
(2, 'sama', 'sama', 'samuel.ojumah.11029@covenantuniversity.edu.ng', 1, 'sama', 'AVey6rQHWn', '2014-04-02 23:21:54', 0),
(3, 'sama', 'sds', 'sas@covenantuniversity.edu.ng', 10, 'sas', '1gBi7ekMQF', '2014-04-12 16:01:00', 0),
(4, 'Osagie', 'Richard', 'sage@covenantuniversity.edu.ng', 1, '6aab9eb8f32e566dfa41cbd48f53c80d', 'neqlEapaGv', '2014-04-04 10:06:08', 0),
(5, 'Dayo', 'Ajisebutu', 'dayo.ajisebiutu@covenantuniversity.edu.ng', 1, '5541c7b5a06c39b267a5efae6628e003', 'KyWFyT88lt', '2014-04-07 12:58:32', 0),
(9, 'Samuel', 'Ojumah', 'samuel.ojumah@covenantuniversity.edu.ng', 1, 'f647e02a69ab0e51780373f86f89a12a', 'EQE1DTSHwE', '2014-04-14 18:46:59', 0),
(10, 'mala', 'lama', 'cesc@covenantuniversity.edu.ng', 1, '7c42f80240d018223a59c64bde548d08', 'fE86lAQHfI', '2014-04-14 21:39:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `verified_users`
--

CREATE TABLE IF NOT EXISTS `verified_users` (
  `user_id` int(11) NOT NULL,
  `date_verified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verified_users`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
