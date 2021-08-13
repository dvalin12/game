-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 09:52 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acc`
--

CREATE TABLE `tbl_acc` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `acc_type` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `reset_link_token` varchar(500) NOT NULL,
  `exp_date` datetime DEFAULT NULL,
  `active_acc` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_acc`
--

INSERT INTO `tbl_acc` (`id`, `username`, `password`, `email`, `acc_type`, `fname`, `mname`, `lname`, `phone`, `reset_link_token`, `exp_date`, `active_acc`, `active`) VALUES
(1, 'may ', 'finner', 'jandave361@gw2w2w2wmail.com', 1, 'May', 'S', 'Santiago', '09996918379', '0', NULL, 1, 1),
(2, 'dib', 'finner', 'jandave361@gmail.commmm', 2, 'Jan Dave', 'H', 'Santos', '09996918379', '0', NULL, 1, 1),
(3, 'daryl', 'finner', 'darylp995@gmaily.com', 2, 'Daryl ', 'J', 'Parker', '09996918379', '0', '0000-00-00 00:00:00', 1, 1),
(4, 'carol', 'finner', 'jandave.santos@tup.2ww2w2w.ph', 2, 'Carol', 'M. ', 'Luna', '09996918379', '0', '0000-00-00 00:00:00', 1, 1),
(5, 'darius', 'finner', 'darylp995@gmailll.com', 2, 'Mark', 'G. ', 'Villanueva', '09996918379', '0', '0000-00-00 00:00:00', 1, 1),
(6, 'caitlyn', 'finner', 'jandave361@gmail.com', 2, 'Caitlyn', 'F. ', 'Faustino ', '09996918379', '0', '0000-00-00 00:00:00', 0, 0),
(7, 'caitlyn', 'finner', 'darylp995@gmail.cccccom', 2, 'Caitlyn', 'S.', 'Faustino', '09996918379', '0', '0000-00-00 00:00:00', 1, 1),
(8, 'edea', 'finner', 'jandave361@gmail.com', 2, 'Edea', 'T.', 'Oblige', '09996918379', '0', '0000-00-00 00:00:00', 0, 0),
(9, 'edea', 'finner', 'darylswswswswp995@gmail.com', 2, 'Edea Lee', 'G.', 'Oblige', '09996918379', '0', '0000-00-00 00:00:00', 1, 1),
(10, 'renz', 'finner', 'jandave.santos@tup.edu.ph', 2, 'Renz', 'R. ', 'Tanjuan', '09996918379', '0', '0000-00-00 00:00:00', 0, 0),
(11, 'renz', 'finner', 'jandave.santos@tup.edu.ph', 2, 'Renz', 'R.', 'Tanjuan', '09996918379', '0', '0000-00-00 00:00:00', 0, 0),
(13, 'dave', 'finner', 'jandave361@gmail.com', 1, 'Jan Dave', 'H', 'Santos', '09996918379', '0', '0000-00-00 00:00:00', 1, 1),
(15, 'mary', 'finner', 'jandave.santos@tup.edu.ph', 2, 'Mary rose ', 'G.', 'Doe', '09996918379', '0', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acc_student`
--

CREATE TABLE `tbl_acc_student` (
  `id` int(11) NOT NULL,
  `age` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `section` int(50) NOT NULL,
  `teacher` int(50) NOT NULL,
  `e_verified` int(11) NOT NULL,
  `pending` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_acc_student`
--

INSERT INTO `tbl_acc_student` (`id`, `age`, `gender`, `section`, `teacher`, `e_verified`, `pending`) VALUES
(2, '21', 'Male', 1, 1, 1, 0),
(3, '13', 'Male', 1, 1, 1, 0),
(4, '14', 'Female', 1, 1, 1, 0),
(5, '13', 'Male', 1, 1, 1, 0),
(6, '13', 'Female', 1, 1, 0, 0),
(7, '12', 'Female', 1, 1, 1, 0),
(8, '18', 'Female', 1, 1, 0, 0),
(9, '18', 'Female', 1, 1, 1, 0),
(10, '17', 'Male', 1, 1, 0, 0),
(11, '12', 'Male', 1, 1, 1, 0),
(15, '12', 'Female', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acc_teacher`
--

CREATE TABLE `tbl_acc_teacher` (
  `id` int(11) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `school` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_acc_teacher`
--

INSERT INTO `tbl_acc_teacher` (`id`, `subject`, `school`) VALUES
(1, 'science', 'bulsu'),
(13, 'science', 'bulsu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acc_type`
--

CREATE TABLE `tbl_acc_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_acc_type`
--

INSERT INTO `tbl_acc_type` (`id`, `type`) VALUES
(1, 'teacher'),
(2, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_code`
--

CREATE TABLE `tbl_code` (
  `id` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `times_allowed` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `gen_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_code`
--

INSERT INTO `tbl_code` (`id`, `teacher`, `code`, `times_allowed`, `section`, `gen_on`) VALUES
(1, 1, 'A2VP1', 22, 1, '2021-08-01 18:43:16'),
(3, 1, '8MWFC', 33, 2, '2021-08-04 17:09:56'),
(5, 1, 'VSN3X', 23, 4, '2021-08-05 16:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_games`
--

CREATE TABLE `tbl_games` (
  `id` int(11) NOT NULL,
  `game` varchar(300) NOT NULL,
  `link` varchar(300) NOT NULL,
  `active_sessions` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_games`
--

INSERT INTO `tbl_games` (`id`, `game`, `link`, `active_sessions`, `active`) VALUES
(0, 'None ', 'None', 0, 0),
(1, 'game1', 'https://drive.google.com/file/d/1-SuoDZA9M5X-HLlSB46cZbHG5EMDxp3K/view?usp=sharing', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  `assigned` varchar(300) NOT NULL,
  `completed` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `section`, `total`, `teacher`, `assigned`, `completed`, `active`) VALUES
(1, 'JUPITER-VII', 7, 1, 'None ', 8, 1),
(2, 'MARS-VII', 0, 1, 'None ', 0, 0),
(4, 'SATURN-VII', 0, 1, 'None ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE `tbl_session` (
  `id` int(11) NOT NULL,
  `game` int(11) NOT NULL,
  `attempts` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `start` datetime NOT NULL DEFAULT current_timestamp(),
  `end` datetime NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`id`, `game`, `attempts`, `teacher`, `section`, `start`, `end`, `active`) VALUES
(1, 1, 1, 1, 1, '2021-08-05 00:28:51', '2021-08-26 03:31:00', 0),
(2, 1, 3, 1, 4, '2021-08-10 13:47:10', '2021-08-10 13:52:00', 0),
(3, 1, 2, 1, 1, '2021-08-10 13:50:01', '2021-08-10 18:49:00', 0),
(4, 1, 1, 1, 1, '2021-08-10 13:53:52', '2021-08-10 15:53:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acc`
--
ALTER TABLE `tbl_acc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_type` (`acc_type`);

--
-- Indexes for table `tbl_acc_student`
--
ALTER TABLE `tbl_acc_student`
  ADD KEY `id` (`id`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `tbl_acc_teacher`
--
ALTER TABLE `tbl_acc_teacher`
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_acc_type`
--
ALTER TABLE `tbl_acc_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_code`
--
ALTER TABLE `tbl_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `tbl_games`
--
ALTER TABLE `tbl_games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `game` (`game`);

--
-- Indexes for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `assigned` (`assigned`),
  ADD KEY `assigned_2` (`assigned`);

--
-- Indexes for table `tbl_session`
--
ALTER TABLE `tbl_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game` (`game`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `section` (`section`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acc`
--
ALTER TABLE `tbl_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_acc_type`
--
ALTER TABLE `tbl_acc_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_code`
--
ALTER TABLE `tbl_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_games`
--
ALTER TABLE `tbl_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_session`
--
ALTER TABLE `tbl_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_acc`
--
ALTER TABLE `tbl_acc`
  ADD CONSTRAINT `tbl_acc_ibfk_1` FOREIGN KEY (`acc_type`) REFERENCES `tbl_acc_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_acc_student`
--
ALTER TABLE `tbl_acc_student`
  ADD CONSTRAINT `tbl_acc_student_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_acc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_acc_student_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `tbl_acc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_acc_student_ibfk_3` FOREIGN KEY (`section`) REFERENCES `tbl_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_acc_teacher`
--
ALTER TABLE `tbl_acc_teacher`
  ADD CONSTRAINT `tbl_acc_teacher_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_acc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_code`
--
ALTER TABLE `tbl_code`
  ADD CONSTRAINT `tbl_code_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `tbl_acc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_code_ibfk_2` FOREIGN KEY (`section`) REFERENCES `tbl_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD CONSTRAINT `tbl_section_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `tbl_acc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_section_ibfk_2` FOREIGN KEY (`assigned`) REFERENCES `tbl_games` (`game`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_session`
--
ALTER TABLE `tbl_session`
  ADD CONSTRAINT `tbl_session_ibfk_1` FOREIGN KEY (`game`) REFERENCES `tbl_games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_session_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `tbl_acc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_session_ibfk_3` FOREIGN KEY (`section`) REFERENCES `tbl_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `disable_session_1` ON SCHEDULE AT '2021-08-10 13:42:49' ON COMPLETION PRESERVE DISABLE DO BEGIN

                                UPDATE tbl_session SET active = 0 WHERE id = 1;

                                UPDATE tbl_games SET active_sessions = active_sessions - 1 WHERE id = 1;

                                UPDATE tbl_section SET assigned = (SELECT game FROM tbl_games WHERE id = 0) WHERE id = 1;

                                UPDATE tbl_section SET completed = completed + 1 WHERE id = 1;

                                END$$

CREATE DEFINER=`root`@`localhost` EVENT `disable_session_2` ON SCHEDULE AT '2021-08-10 13:49:11' ON COMPLETION PRESERVE DISABLE DO BEGIN

                                UPDATE tbl_session SET active = 0 WHERE id = 2;

                                UPDATE tbl_games SET active_sessions = active_sessions - 1 WHERE id = 1;

                                UPDATE tbl_section SET assigned = (SELECT game FROM tbl_games WHERE id = 0) WHERE id = 4;

                                UPDATE tbl_section SET completed = completed + 1 WHERE id = 4;

                                END$$

CREATE DEFINER=`root`@`localhost` EVENT `disable_session_3` ON SCHEDULE AT '2021-08-10 13:50:10' ON COMPLETION PRESERVE DISABLE DO BEGIN

                                UPDATE tbl_session SET active = 0 WHERE id = 3;

                                UPDATE tbl_games SET active_sessions = active_sessions - 1 WHERE id = 1;

                                UPDATE tbl_section SET assigned = (SELECT game FROM tbl_games WHERE id = 0) WHERE id = 1;

                                UPDATE tbl_section SET completed = completed + 1 WHERE id = 1;

                                END$$

CREATE DEFINER=`root`@`localhost` EVENT `disable_session_4` ON SCHEDULE AT '2021-08-10 13:54:10' ON COMPLETION PRESERVE DISABLE DO BEGIN

                                UPDATE tbl_session SET active = 0 WHERE id = 4;

                                UPDATE tbl_games SET active_sessions = active_sessions - 1 WHERE id = 1;

                                UPDATE tbl_section SET assigned = (SELECT game FROM tbl_games WHERE id = 0) WHERE id = 1;

                                UPDATE tbl_section SET completed = completed + 1 WHERE id = 1;

                                END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
