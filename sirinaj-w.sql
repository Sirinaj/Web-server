-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2024 at 09:28 PM
-- Server version: 5.7.33-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sirinaj-w`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `regid` int(4) UNSIGNED ZEROFILL NOT NULL,
  `stu_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `sid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `sgrade` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`regid`, `stu_id`, `sid`, `sgrade`) VALUES
(1001, 002, 101, 'B'),
(1004, 004, 104, 'D'),
(1012, 005, 106, 'A'),
(1013, 002, 104, 'C'),
(1014, 004, 103, 'C'),
(1015, 004, 102, 'B+'),
(1024, 002, 102, 'B'),
(1025, 002, 103, 'A'),
(1026, 002, 105, 'B'),
(1027, 002, 106, 'C+'),
(1028, 002, 107, 'D+'),
(1029, 002, 108, 'A'),
(1030, 015, 106, 'B+'),
(1031, 015, 101, 'A'),
(1032, 015, 104, 'B'),
(1033, 015, 103, 'B+'),
(1034, 015, 102, 'B+'),
(1035, 006, 101, 'B+'),
(1036, 006, 102, 'A'),
(1037, 006, 103, 'A'),
(1038, 004, 101, 'D'),
(1039, 004, 105, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `stu_fname` varchar(30) NOT NULL,
  `stu_lname` varchar(30) NOT NULL,
  `stu_home` varchar(30) NOT NULL,
  `stu_pay` int(5) NOT NULL,
  `gpa` decimal(3,2) NOT NULL,
  `birthday` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_fname`, `stu_lname`, `stu_home`, `stu_pay`, `gpa`, `birthday`) VALUES
(002, 'มีนา', 'ศิระยานนท์', 'กรุงเทพมหานคร', 4500, '3.00', '05032547'),
(004, 'ศิรินาจ', 'วิจิตรบรรจง', 'นครปฐม', 4600, '2.50', '04042547'),
(005, 'ศุภณัฐ', 'เอี่ยมชู', 'กรุงเทพมหานคร', 8400, '4.00', '19062546'),
(006, 'กฤติเดช', 'สุดเลิศ', 'เพชรบุรี', 9000, '3.83', '02052546'),
(014, 'เกรียงศักดิ์', 'พรมโสฬส', 'นนทบุรี', 6500, '0.00', '09052547'),
(015, 'ศุภกานต์', 'คำแหง', 'นนทบุรี', 6578, '3.59', '01122546'),
(016, 'อรรถวุฒิ', 'สายรุ้ง', 'กรุงเทพมหานคร', 25900, '0.00', '28082546');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `sname` varchar(100) NOT NULL,
  `scredit` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sid`, `sname`, `scredit`) VALUES
(101, 'ระบบฐานข้อมูล', 3),
(102, 'วิศวกรรมซอฟต์แวร์', 3),
(103, 'เครือข่ายคอมพิวเตอร์', 3),
(104, 'ปฏิบัติการเครือข่ายคอมพิวเตอร์', 1),
(105, 'ไมโครโพรเซสเซอร์', 3),
(106, 'ปฏิบัติการไมโครโพรเซสเซอร์', 1),
(107, 'อินเทอร์เน็ตของสรรพสิ่ง', 3),
(108, 'สถาปัตยกรรมคอมพิวเตอร์', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`regid`),
  ADD KEY `studentsub` (`sid`),
  ADD KEY `studentid` (`stu_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `regid` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1040;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sid` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `studentid` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentsub` FOREIGN KEY (`sid`) REFERENCES `subject` (`sid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
