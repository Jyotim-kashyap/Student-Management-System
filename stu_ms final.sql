-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 04:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stu_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `atn_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `total_class` int(30) NOT NULL,
  `attended` int(30) NOT NULL,
  `perc` float NOT NULL,
  `sem` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`atn_id`, `sub_id`, `s_id`, `total_class`, `attended`, `perc`, `sem`) VALUES
(82, 40, 24, 10, 8, 80, 1),
(83, 41, 24, 10, 10, 100, 1),
(84, 44, 24, 10, 10, 100, 1),
(85, 76, 24, 10, 10, 100, 1),
(86, 6, 26, 231, 220, 95, 2),
(87, 24, 26, 12, 10, 83, 2),
(88, 25, 26, 12, 12, 100, 2),
(89, 21, 28, 45, 10, 22, 4),
(90, 22, 28, 45, 45, 100, 4),
(91, 29, 28, 10, 10, 100, 4),
(92, 30, 28, 10, 10, 100, 4),
(93, 31, 28, 10, 10, 100, 4),
(95, 40, 18, 2, 2, 100, 1),
(96, 41, 18, 2, 2, 100, 1),
(97, 44, 18, 2, 2, 100, 1),
(98, 76, 18, 2, 2, 100, 1),
(99, 4, 27, 10, 10, 100, 1),
(104, 60, 30, 45, 30, 66, 1),
(105, 61, 30, 40, 30, 75, 1),
(106, 63, 30, 30, 25, 83, 1),
(107, 64, 30, 42, 35, 83, 1),
(108, 65, 30, 10, 9, 90, 1);

--
-- Triggers `attendence`
--
DELIMITER $$
CREATE TRIGGER `tri` AFTER INSERT ON `attendence` FOR EACH ROW if EXISTS(SELECT * FROM attendence WHERE s_id=new.s_id and sub_id=new.sub_id)
THEN
	if EXISTS(select * from ncdc WHERE 		s_id=new.s_id AND sem=new.sem)THEN
	UPDATE ncdc SET stat :=(SELECT AVG(perc) from 		attendence WHERE s_id=s_id AND sem=sem),sem:=new.sem;
	ELSE 
    INSERT INTO ncdc (s_id,stat,sem) VALUES (new.s_id,		(SELECT AVG(perc) from attendence where s_id = 		new.s_id),new.sem);

	end if;
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `backlog`
--

CREATE TABLE `backlog` (
  `bk_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backlog`
--

INSERT INTO `backlog` (`bk_id`, `s_id`, `sub_id`, `sem`) VALUES
(282, 30, 60, 1),
(283, 30, 60, 1),
(284, 30, 61, 1),
(285, 30, 60, 1),
(286, 30, 61, 1),
(287, 30, 63, 1),
(288, 30, 60, 1),
(289, 30, 61, 1),
(290, 30, 63, 1),
(291, 30, 64, 1),
(292, 30, 60, 1),
(293, 26, 24, 2),
(294, 30, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cie`
--

CREATE TABLE `cie` (
  `c_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `cie_no` int(11) NOT NULL,
  `cie_mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cie`
--

INSERT INTO `cie` (`c_id`, `sub_id`, `s_id`, `cie_no`, `cie_mark`) VALUES
(303, 6, 26, 1, 23),
(304, 24, 26, 1, 23),
(305, 25, 26, 1, 23),
(307, 40, 18, 1, 23),
(308, 41, 18, 1, 23),
(309, 44, 18, 1, 23),
(310, 76, 18, 1, 23),
(311, 21, 28, 1, 23),
(312, 22, 28, 1, 123),
(313, 29, 28, 1, 123),
(314, 30, 28, 1, 123),
(315, 31, 28, 1, 123),
(316, 40, 24, 1, 12),
(317, 41, 24, 1, 12),
(318, 44, 24, 1, 12),
(319, 76, 24, 1, 12),
(320, 6, 26, 2, 10),
(321, 24, 26, 2, 10),
(322, 25, 26, 2, 10),
(323, 4, 27, 1, 70),
(324, 4, 27, 2, 70),
(329, 21, 28, 2, 1),
(330, 22, 28, 2, 1),
(331, 29, 28, 2, 1),
(332, 30, 28, 2, 1),
(333, 31, 28, 2, 1),
(334, 60, 30, 1, 5),
(335, 61, 30, 1, 20),
(336, 63, 30, 1, 21),
(337, 64, 30, 1, 23),
(338, 65, 30, 1, 2);

--
-- Triggers `cie`
--
DELIMITER $$
CREATE TRIGGER `Internal_mark_add` AFTER INSERT ON `cie` FOR EACH ROW UPDATE st_marks s
set s.st_internal:=(SELECT SUM(cie_mark)/MAX(cie_no)
FROM cie
where s_id=s.s_id and sub_id=s.sub_id),
s.st_total:=(s.st_theory+s.st_internal) 
WHERE sub_id=s.sub_id AND s_id=s.s_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(10) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_established` date NOT NULL,
  `t_sems` int(10) NOT NULL,
  `hod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `d_name`, `d_established`, `t_sems`, `hod`) VALUES
(1, 'MCA', '1991-06-14', 4, 'Sidharth borua'),
(2, 'CIVIL', '1980-05-05', 8, 'ABCSD'),
(3, 'Mechanical  Engineering', '1985-03-20', 6, 'TYUS'),
(4, 'Computer Science Engineering', '1966-10-31', 8, 'OIYTS'),
(5, 'ELECTRICAL ENGINEERING', '1962-10-20', 2, 'EEEE'),
(6, 'Instrumental Engineering', '1956-05-20', 8, 'ASDSW'),
(7, 'aa', '1986-10-20', 8, 'yyy');

-- --------------------------------------------------------

--
-- Table structure for table `ncdc`
--

CREATE TABLE `ncdc` (
  `n_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `stat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ncdc`
--

INSERT INTO `ncdc` (`n_id`, `s_id`, `sem`, `stat`) VALUES
(39, 24, 1, 89.8636),
(40, 26, 1, 89.8636),
(41, 28, 1, 89.8636),
(42, 18, 1, 89.8636),
(43, 27, 1, 89.8636),
(45, 30, 1, 89.8636);

-- --------------------------------------------------------

--
-- Table structure for table `st_marks`
--

CREATE TABLE `st_marks` (
  `st_mark` int(100) NOT NULL,
  `s_id` int(100) NOT NULL,
  `sub_id` int(100) NOT NULL,
  `sem` int(11) NOT NULL,
  `st_theory` int(100) NOT NULL,
  `st_practical` int(100) NOT NULL,
  `st_internal` float NOT NULL,
  `st_total` int(100) NOT NULL,
  `isPassed` tinyint(1) NOT NULL,
  `publish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `st_marks`
--

INSERT INTO `st_marks` (`st_mark`, `s_id`, `sub_id`, `sem`, `st_theory`, `st_practical`, `st_internal`, `st_total`, `isPassed`, `publish`) VALUES
(214, 26, 6, 2, 1, 0, 16, 17, 1, 1),
(215, 26, 24, 2, 10, 0, 16, 26, 0, 1),
(216, 26, 25, 2, 100, 0, 16, 116, 1, 1),
(218, 18, 40, 1, 12, 0, 23, 35, 35, 0),
(219, 18, 41, 1, 12, 0, 23, 35, 35, 0),
(220, 18, 44, 1, 12, 0, 23, 35, 35, 0),
(221, 18, 76, 1, 2, 0, 23, 25, 25, 0),
(222, 28, 21, 4, 100, 0, 12, 112, 1, 0),
(223, 28, 22, 4, 100, 0, 62, 162, 1, 0),
(224, 28, 29, 4, 1, 0, 62, 63, 1, 0),
(225, 28, 30, 4, 100, 0, 62, 162, 1, 0),
(226, 28, 31, 4, 100, 0, 62, 162, 1, 0),
(227, 24, 40, 1, 1, 0, 12, 13, 1, 1),
(228, 24, 41, 1, 23, 0, 12, 35, 1, 1),
(229, 24, 44, 1, 23, 0, 12, 35, 1, 1),
(230, 24, 76, 1, 12, 0, 12, 24, 1, 1),
(231, 27, 4, 1, 45, 0, 70, 115, 115, 0),
(236, 30, 60, 1, 0, 0, 5, 5, 0, 1),
(237, 30, 61, 1, 12, 0, 20, 32, 1, 1),
(238, 30, 63, 1, 20, 0, 21, 41, 1, 1),
(239, 30, 64, 1, 20, 0, 23, 43, 1, 1),
(240, 30, 65, 1, 2, 0, 2, 4, 1, 1);

--
-- Triggers `st_marks`
--
DELIMITER $$
CREATE TRIGGER `as` AFTER UPDATE ON `st_marks` FOR EACH ROW IF EXISTS(SELECT * FROM st_marks WHERE s_id=new.s_id AND sub_id=new.sub_id AND new.isPassed=0) THEN
INSERT INTO backlog (s_id,sub_id,sem)VALUES(new.s_id,new.sub_id,new.sem);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(100) NOT NULL,
  `d_id` int(100) NOT NULL,
  `sub_code` varchar(100) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `sub_sem` int(10) NOT NULL,
  `sub_fmark` int(100) NOT NULL,
  `sub_mtheory` int(10) NOT NULL,
  `sub_minternal` int(10) NOT NULL,
  `isPractical` tinyint(1) NOT NULL,
  `sub_passmrk` int(5) NOT NULL,
  `sub_int_pmark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `d_id`, `sub_code`, `sub_name`, `sub_sem`, `sub_fmark`, `sub_mtheory`, `sub_minternal`, `isPractical`, `sub_passmrk`, `sub_int_pmark`) VALUES
(4, 4, '103', 'Web Technology', 1, 31, 1, 30, 0, 0, 0),
(6, 1, '202', 'Distributed Systems', 2, 100, 70, 30, 1, 0, 12),
(9, 2, '202', 'XYZ civil', 2, 100, 70, 30, 0, 0, 0),
(10, 2, '202', 'ABC CIVIL', 2, 100, 70, 30, 1, 0, 0),
(14, 3, 'asd', 'asdas', 2, 1, 2, 3, 1, 0, 0),
(19, 5, '505', 'asd', 2, 100, 70, 30, 0, 30, 0),
(21, 1, '405', 'CHEKDS', 4, 100, 70, 30, 0, 0, 0),
(22, 1, '407', 'EWSAC', 4, 100, 50, 50, 1, 0, 0),
(24, 1, '111', 'CSE', 2, 100, 70, 30, 0, 30, 0),
(25, 1, '112', 'Operating system', 2, 101, 70, 30, 1, 30, 0),
(29, 1, '505', 'graphy theory', 4, 111, 70, 30, 0, 0, 0),
(30, 1, '506', 'Operating system', 4, 112, 70, 30, 1, 0, 0),
(31, 1, '507', 'AI', 4, 111, 70, 30, 0, 0, 0),
(35, 1, '505', 'ddd', 3, 12, 70, 30, 1, 0, 0),
(36, 1, '302', 'EEE', 3, 123, 70, 30, 1, 0, 0),
(37, 1, '303', 'AI', 3, 123, 70, 30, 1, 0, 0),
(40, 1, '10', 'asda', 1, 44, 23, 21, 0, 0, 0),
(41, 1, '123', 'asdas', 1, 123, 123, 12, 1, 0, 0),
(44, 1, '123', 'sad', 1, 24, 2, 22, 0, 0, 12),
(48, 2, '301', 'graphy theory', 3, 100, 70, 30, 1, 0, 0),
(49, 2, '506', 'EWSAC', 3, 122, 70, 30, 1, 0, 0),
(50, 4, '505', 'AI', 3, 123, 70, 30, 0, 0, 0),
(51, 4, '123', 'dawda', 3, 123, 123, 123, 0, 0, 0),
(52, 5, '123', 'asd', 1, 321, 70, 30, 127, 0, 0),
(55, 5, '12', '12', 1, 12, 12, 12, 0, 0, 0),
(56, 5, '12', 'ASd', 1, 12, 12, 12, 1, 0, 0),
(58, 2, '505', 'TEST OF SUM', 3, 0, 50, 30, 20, 0, 0),
(59, 2, '506', 'TEST OF SUM 2', 3, 0, 70, 30, 0, 0, 0),
(60, 2, '111', 'graphy theory', 1, 27, 9, 9, 9, 9, 9),
(61, 2, '505', 'qweq21e', 1, 158, 12, 23, 123, 0, 0),
(63, 2, '231', 'QWEqwe', 1, 46, 23, 23, 0, 0, 0),
(64, 2, '12', 'QWEDWE', 1, 46, 23, 23, 0, 0, 0),
(65, 2, '12', 'wdqwdq2we', 1, 4, 2, 2, 0, 0, 0),
(68, 4, '1', 'ADdw', 2, 30, 10, 10, 10, 0, 0),
(71, 3, '505', 'graphy theory', 3, 100, 50, 20, 30, 0, 0),
(72, 5, '505', 'graphy theory', 1, 84, 40, 40, 4, 0, 0),
(74, 5, '505', 'graphy theory', 2, 102, 34, 34, 34, 32, 0),
(75, 2, 'd1231da', 'dasdasd', 3, 326, 70, 223, 33, 12, 12),
(76, 1, '321', 'asd', 1, 69, 23, 23, 23, 23, 23),
(77, 3, 'dasd2', '1d2d', 2, 4, 2, 2, 0, 3, 2),
(78, 3, 'd1', 'd12', 2, 3125, 2, 3123, 0, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `s_info`
--

CREATE TABLE `s_info` (
  `s_id` int(255) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_roll` int(100) NOT NULL,
  `d_id` int(255) DEFAULT NULL,
  `admsn_date` date NOT NULL DEFAULT current_timestamp(),
  `dob` date NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `adrs` varchar(255) NOT NULL,
  `pin` int(10) NOT NULL,
  `sem` int(10) NOT NULL,
  `grdnno` int(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `isVarified` tinyint(1) NOT NULL,
  `batch` year(4) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_info`
--

INSERT INTO `s_info` (`s_id`, `u_id`, `s_name`, `s_roll`, `d_id`, `admsn_date`, `dob`, `fname`, `mname`, `adrs`, `pin`, `sem`, `grdnno`, `gender`, `isVarified`, `batch`) VALUES
(18, 'a2', 'Abhi', 1232, 1, '2022-06-22', '2022-06-01', 'aasd', 'asd', 'sdas', 123, 1, 0, '123', 1, 2021),
(24, 'q', 'Abhiss', 1, 1, '2022-06-22', '2022-06-01', 'aassd', 'asd', 'sdas', 123, 3, 0, '123', 1, 2022),
(26, 'ab12', 'Abhishek Das', 57581, 1, '2022-06-22', '1998-10-23', 'Amal Das', 'Seema Das', 'M.M.C.Road,Karimganj', 788710, 2, 1234567890, 'male', 1, 2022),
(27, 'asd', 'ads', 12, 4, '2022-07-05', '2022-06-01', 'qwd', 'asd', 'asd', 123, 1, 123, 'as', 1, 2024),
(28, 'ac2', 'sess', 51232, 1, '2022-07-05', '2022-07-05', 'es', 'sd', 'sd', 231, 4, 1234567890, 'female', 1, 2022),
(30, 'j2', 'jyotim kysap', 534, 2, '2022-07-12', '1999-02-17', 'mr kysap', 'ms kysap', 'guwahati', 780045, 1, 1234567890, 'male', 1, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `t_class`
--

CREATE TABLE `t_class` (
  `atn_clss_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `total_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_class`
--

INSERT INTO `t_class` (`atn_clss_id`, `sub_id`, `total_class`) VALUES
(1, 68, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `no` int(100) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_contact` int(10) NOT NULL,
  `u_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`no`, `u_id`, `u_pass`, `isAdmin`, `u_email`, `u_contact`, `u_name`) VALUES
(1, 'ab', 'asd2', 1, 'das@das', 123344444, 'asdasd'),
(2, 'ab12', '1234', 0, 'dabhishek878@gmail.com', 2147483647, 'Abhishek Das'),
(3, 'a123', '1234', 0, 'homsweethome252@gmail.com', 2147483647, 'rahim'),
(4, 'ac12', '1234', 0, 'homsweethome252@gmail.com', 2147483647, 'Achyuta'),
(5, 'ac2', '1234', 0, 'asd@das', 2147483647, 'Abhishek Das'),
(6, 'j2', '1234', 0, 'abc@gmail.com', 123456789, 'jyotim kaysap');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`atn_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `backlog`
--
ALTER TABLE `backlog`
  ADD PRIMARY KEY (`bk_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `cie`
--
ALTER TABLE `cie`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `ncdc`
--
ALTER TABLE `ncdc`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `ncdc_ibfk_1` (`s_id`);

--
-- Indexes for table `st_marks`
--
ALTER TABLE `st_marks`
  ADD PRIMARY KEY (`st_mark`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `s_info`
--
ALTER TABLE `s_info`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `t_class`
--
ALTER TABLE `t_class`
  ADD PRIMARY KEY (`atn_clss_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `atn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `backlog`
--
ALTER TABLE `backlog`
  MODIFY `bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `cie`
--
ALTER TABLE `cie`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ncdc`
--
ALTER TABLE `ncdc`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `st_marks`
--
ALTER TABLE `st_marks`
  MODIFY `st_mark` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `s_info`
--
ALTER TABLE `s_info`
  MODIFY `s_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_class`
--
ALTER TABLE `t_class`
  MODIFY `atn_clss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `attendence_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendence_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `s_info` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `backlog`
--
ALTER TABLE `backlog`
  ADD CONSTRAINT `backlog_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `backlog_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `s_info` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cie`
--
ALTER TABLE `cie`
  ADD CONSTRAINT `cie_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cie_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `s_info` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncdc`
--
ALTER TABLE `ncdc`
  ADD CONSTRAINT `ncdc_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `s_info` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `st_marks`
--
ALTER TABLE `st_marks`
  ADD CONSTRAINT `st_marks_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `s_info` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `st_marks_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `s_info`
--
ALTER TABLE `s_info`
  ADD CONSTRAINT `s_info_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_class`
--
ALTER TABLE `t_class`
  ADD CONSTRAINT `t_class_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
