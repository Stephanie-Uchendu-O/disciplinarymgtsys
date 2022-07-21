-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 04:57 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dismgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `invigilator`
--

CREATE TABLE `invigilator` (
  `id` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invigilator`
--

INSERT INTO `invigilator` (`id`, `fullname`, `email`, `phone`, `status`) VALUES
('UAM-1124202156', 'james doe', 'johndoe@unagric.edu.ng', '07033032863', 'yes'),
('UAM-1812202112', 'Titus Zugu', 'zugutitus2015@gmail.com', '08035662922', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `role`, `status`) VALUES
('admin@admin.com', '1111', 'admin', 'yes'),
('committee@admin.com', '1111', 'emc', 'yes'),
('johndoe@unagric.edu.ng', 'johndoe@unagric.edu.ng', 'invigilator', 'yes'),
('UAM/SC/COMP/20/984', 'UAM/SC/COMP/20/984', 'student', 'no'),
('UNIAGRIC/COM/BSC17/987', 'UNIAGRIC/COM/BSC17/987', 'student', 'no'),
('UNIAGRIC/COM/BSC17/988', 'UNIAGRIC/COM/BSC17/988', 'student', 'no'),
('zugutitus2015@gmail.com', 'zugutitus2015@gmail.com', 'invigilator', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `rid` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mat_no` varchar(60) NOT NULL,
  `inv_id` varchar(100) NOT NULL,
  `dept` varchar(500) NOT NULL,
  `faculty` varchar(500) NOT NULL,
  `course` varchar(500) NOT NULL,
  `level` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `exhibit` varchar(500) NOT NULL,
  `inv_comment` varchar(1000) NOT NULL,
  `std_comment` varchar(1000) NOT NULL,
  `emc_findings` varchar(1000) NOT NULL,
  `emc_comment` varchar(1000) NOT NULL,
  `chairman_resolution` varchar(1000) NOT NULL,
  `chm_comment` varchar(1000) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`rid`, `fullname`, `mat_no`, `inv_id`, `dept`, `faculty`, `course`, `level`, `phone`, `email`, `exhibit`, `inv_comment`, `std_comment`, `emc_findings`, `emc_comment`, `chairman_resolution`, `chm_comment`, `status`, `date`) VALUES
('RPT-1134202145', 'shosanya kasimu', 'UNIAGRIC/COM/BSC17/988', 'johndoe@unagric.edu.ng', 'Science Laboratory Science', 'National Science', 'Organic Chemistry  -  CHM201', '200L', '07032642942', 'kasimu@uniagric.edu.ng', 'EXH-05272021113445.jpg', 'Insulting invigilator and exams malpractice', 'this is not true, i request to face a board of inquiry.', 'file-202115584005.docx', 'please find our findings in the attachment', 'file-202116450205.pdf', 'there student is thereby witdrawn, attach herewith is the letter of witdrawal', 'yes', '2021-05-27 11:34:45'),
('RPT-1347202104', 'James Doe', 'UNIAGRIC/COM/BSC17/987', 'johndoe@unagric.edu.ng', 'Computer Science', 'Applied Science', 'MTH101', '100L', '08756675653', 'jamesdoe@gmail.com', 'EXH-05262021134704.jpg', 'The student refuse to agree to be the one who took the exhibit into the hall, but however there are other witnesses that can attest to my claims', '', '', '', '', '', 'no', '2021-05-26 13:47:04'),
('RPT-1827202122', 'Rose Ada', 'UAM/SC/COMP/20/984', 'zugutitus2015@gmail.com', 'Computer Science', 'Applied Science', 'CMP212', '300L', '07033032863', 'roseada@gmail.com', 'EXH-06082021182722.jpg', 'Mr John doe, student was caught with chips.  ', 'i mistakenly took a paper in my pocket that i used in reading before coming to the hall', 'file-202118473506.pdf', 'please find attached summary of findings', 'file-202118540906.pdf', 'find final resolution in the attached file', 'yes', '2021-06-08 18:27:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invigilator`
--
ALTER TABLE `invigilator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`rid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
