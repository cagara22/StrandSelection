-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 05:46 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_performance`
--

CREATE TABLE `academic_performance` (
  `id` int(11) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `Science` varchar(100) NOT NULL,
  `Math` varchar(100) NOT NULL,
  `English` varchar(100) NOT NULL,
  `Filipino` varchar(100) NOT NULL,
  `ICTRelatedSubject` varchar(100) NOT NULL,
  `HERelatedSubject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactnumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fullname`, `password`, `address`, `contactnumber`) VALUES
(19, 'admin1', 'Vincent Felix S. Cagara', '827ccb0eea8a706c4c34a16891f84e7b', 'Brgy. Bislig Tanauan Leyte', '09286845678');

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `id` int(11) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `CareerGoals` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_category`
--

CREATE TABLE `exam_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `exam_time_in_minutes` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_category`
--

INSERT INTO `exam_category` (`id`, `category`, `topic`, `exam_time_in_minutes`) VALUES
(4, 'ICT-Programming', '', '10'),
(9, 'ABM', '', '20'),
(10, 'STEM', '', '15'),
(11, 'HE', '', '15');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `exam_type` varchar(100) NOT NULL,
  `total_question` varchar(100) NOT NULL,
  `correct_answer` varchar(100) NOT NULL,
  `wrong_answer` varchar(100) NOT NULL,
  `exam_time` varchar(100) NOT NULL,
  `ict_score` int(11) NOT NULL,
  `abm_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `email`, `exam_type`, `total_question`, `correct_answer`, `wrong_answer`, `exam_time`, `ict_score`, `abm_score`) VALUES
(1, 'johnzkie', 'ICT-Programming', '7', '1', '6', '2023-04-16', 0, 0),
(2, 'johnzkie', 'ICT-Programming', '7', '1', '6', '2023-04-16', 0, 0),
(3, 'johnzkie', 'ABM', '1', '0', '1', '2023-04-16', 0, 0),
(4, 'johnzkie', 'ICT-Programming', '7', '1', '6', '2023-04-17', 0, 0),
(5, 'johnzkie', 'ICT-Programming', '7', '0', '7', '2023-04-18', 0, 0),
(6, 'johnzkie', 'ICT-Programming', '7', '0', '7', '2023-04-23', 0, 0),
(7, 'johnzkie', 'ICT-Programming', '7', '1', '6', '2023-04-23', 0, 0),
(8, 'johnzkie', 'ICT-Programming', '7', '2', '5', '2023-04-23', 0, 0),
(9, '', 'ICT-Programming', '9', '1', '8', '2023-04-23', 0, 0),
(11, 'user', '', '', '', '', '', 22, 33);

-- --------------------------------------------------------

--
-- Table structure for table `exam_score`
--

CREATE TABLE `exam_score` (
  `id` int(11) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `abm_score` varchar(100) NOT NULL,
  `he_score` varchar(100) NOT NULL,
  `ict_score` varchar(100) NOT NULL,
  `humms_score` varchar(100) NOT NULL,
  `stem_score` varchar(100) NOT NULL,
  `gas_score` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(11) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `ScienceSub` int(11) NOT NULL,
  `MathSub` int(11) NOT NULL,
  `ArtsandDesign` int(11) NOT NULL,
  `Humanities` int(11) NOT NULL,
  `Entrepreneurship` int(11) NOT NULL,
  `Information` int(11) NOT NULL,
  `Agriculture` int(11) NOT NULL,
  `HomeEconomics` int(11) NOT NULL,
  `IndustrialArts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_no` varchar(10) NOT NULL,
  `question` varchar(500) NOT NULL,
  `opt1` varchar(100) NOT NULL,
  `opt2` varchar(100) NOT NULL,
  `opt3` varchar(100) NOT NULL,
  `opt4` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_no`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `category`) VALUES
(1, '1', 'fi', 'rgh', 'g', 'hl', 'jj', 'jj', 'ICT-Programming'),
(3, '2', 'Hjdk', 'cc', 'dd', 'dd', 'ff', 'ff', 'ICT-Programming'),
(5, '3', '', 'opt_images/53ad155a08ab312869b84825019fc08c', 'opt_images/53ad155a08ab312869b84825019fc08c', 'opt_images/53ad155a08ab312869b84825019fc08c', 'opt_images/53ad155a08ab312869b84825019fc08c', 'opt_images/53ad155a08ab312869b84825019fc08c', 'ICT-Programming'),
(6, '4', '', '', '', '', '', '', 'ICT-Programming'),
(7, '5', '', 'opt_images/8e0a88292974616d817b428fbbcf260cGantt Chart.png', 'opt_images/8e0a88292974616d817b428fbbcf260cScreenshot (16).png', 'opt_images/8e0a88292974616d817b428fbbcf260c', 'opt_images/8e0a88292974616d817b428fbbcf260c', 'opt_images/8e0a88292974616d817b428fbbcf260c', 'ICT-Programming'),
(8, '6', '', 'opt_images/b63cb216ee485a01f877afa3830de8c5', 'opt_images/b63cb216ee485a01f877afa3830de8c5PERT Chart.png', 'opt_images/b63cb216ee485a01f877afa3830de8c5', 'opt_images/b63cb216ee485a01f877afa3830de8c5', 'opt_images/b63cb216ee485a01f877afa3830de8c5', 'ICT-Programming'),
(9, '7', 'Sample again', 'fgf', 'ss', 'dhhh', 'nnnn', 'ss', 'ICT-Programming'),
(11, '1', '2+2', '2', '3', '4', '5', '4', 'Math'),
(12, '1', 'fff', 'tyty', 'ghhh', 'yyuuy', 'vvv', 'tyty', 'ABM'),
(17, '8', 'cxcc', 'opt_images/23536d593e25f69b22df4bd338165a5fConflict Map.png', 'opt_images/23536d593e25f69b22df4bd338165a5fScreenshot (109).png', 'opt_images/23536d593e25f69b22df4bd338165a5fProposed Land Use Map.png', 'opt_images/23536d593e25f69b22df4bd338165a5fPERT Chart.png', 'opt_images/23536d593e25f69b22df4bd338165a5fConflict Map.png', 'ICT-Programming'),
(21, '10', '', '', '', '', '', '', 'ICT-Programming'),
(22, '2', 'Sample', '1', '2', '3', '4', '4', 'ABM'),
(23, '3', 'Sample 2', '4', '5', '6', '7', '5', 'ABM'),
(24, '1', '1', '1', '2', '3', '4', '1', 'STEM'),
(25, '2', '2', '2', '3', '4', '5', '2', 'STEM'),
(26, '1', 'Which is the serving spoon?', 'opt_images/32621311a0be292487f7884e680c3b74athena-sf2_lifestyle_flatware_athena_serving_fork.jpg', 'opt_images/32621311a0be292487f7884e680c3b74ee483e85e07cf1133d3839e9e60209c5.jpg', 'opt_images/32621311a0be292487f7884e680c3b74everlast-2442-3007452-1.jpg', 'opt_images/32621311a0be292487f7884e680c3b74walter-ts_1_.jpg', 'opt_images/32621311a0be292487f7884e680c3b74ee483e85e07cf1133d3839e9e60209c5.jpg', 'HE'),
(27, '2', 'What is the recommended daily intake of water for adults?', '1-2 cups', '4-6 cups', '8-10 cups', '12-14 cups', '8-10 cups', 'HE'),
(28, '3', 'Which of the following cooking methods is best for retaining nutrients in vegetables?', 'Boiling', 'Steaming', 'Frying', 'Baking', 'Steaming', 'HE');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `Mathematicalskills` int(11) NOT NULL,
  `Scientificskills` int(11) NOT NULL,
  `Technicalskills` int(11) NOT NULL,
  `Socialsciences` int(11) NOT NULL,
  `Languageskills` int(11) NOT NULL,
  `Communicationskills` int(11) NOT NULL,
  `Accountingandfinance` int(11) NOT NULL,
  `Businessmanagement` int(11) NOT NULL,
  `Entrepreneurialskills` int(11) NOT NULL,
  `Timemanagement` int(11) NOT NULL,
  `LeadershipSkills` int(11) NOT NULL,
  `Artisticskills` int(11) NOT NULL,
  `Culinaryarts` int(11) NOT NULL,
  `Musicskills` int(11) NOT NULL,
  `Homemanagement` int(11) NOT NULL,
  `Fashionandbeauty` int(11) NOT NULL,
  `ICTskills` int(11) NOT NULL,
  `Multimediaskills` int(11) NOT NULL,
  `Digitalcommunication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `socioeconomic_background`
--

CREATE TABLE `socioeconomic_background` (
  `id` int(11) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `TotalMonthlyIncome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `lrn` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `cpassword` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `approve` varchar(100) NOT NULL,
  `Fname` varchar(100) NOT NULL,
  `Mname` varchar(100) NOT NULL,
  `Lname` varchar(100) NOT NULL,
  `age` varchar(10) NOT NULL,
  `civilstatus` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `strand` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_performance`
--
ALTER TABLE `academic_performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_performance_ibfk_1` (`lrn`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`id`),
  ADD KEY `career_ibfk_1` (`lrn`);

--
-- Indexes for table `exam_category`
--
ALTER TABLE `exam_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_score`
--
ALTER TABLE `exam_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_score_ibfk_1` (`lrn`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interests_ibfk_1` (`lrn`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_ibfk_1` (`lrn`);

--
-- Indexes for table `socioeconomic_background`
--
ALTER TABLE `socioeconomic_background`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socioeconomic_background_ibfk_1` (`lrn`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`lrn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_performance`
--
ALTER TABLE `academic_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_category`
--
ALTER TABLE `exam_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam_score`
--
ALTER TABLE `exam_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socioeconomic_background`
--
ALTER TABLE `socioeconomic_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_performance`
--
ALTER TABLE `academic_performance`
  ADD CONSTRAINT `academic_performance_ibfk_1` FOREIGN KEY (`lrn`) REFERENCES `student` (`lrn`);

--
-- Constraints for table `career`
--
ALTER TABLE `career`
  ADD CONSTRAINT `career_ibfk_1` FOREIGN KEY (`lrn`) REFERENCES `student` (`lrn`);

--
-- Constraints for table `exam_score`
--
ALTER TABLE `exam_score`
  ADD CONSTRAINT `exam_score_ibfk_1` FOREIGN KEY (`lrn`) REFERENCES `student` (`lrn`);

--
-- Constraints for table `interests`
--
ALTER TABLE `interests`
  ADD CONSTRAINT `interests_ibfk_1` FOREIGN KEY (`lrn`) REFERENCES `student` (`lrn`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`lrn`) REFERENCES `student` (`lrn`);

--
-- Constraints for table `socioeconomic_background`
--
ALTER TABLE `socioeconomic_background`
  ADD CONSTRAINT `socioeconomic_background_ibfk_1` FOREIGN KEY (`lrn`) REFERENCES `student` (`lrn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
