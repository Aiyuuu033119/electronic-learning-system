-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2020 at 10:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_learnhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `accID` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `year` varchar(11) NOT NULL,
  `month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`accID`, `user`, `pass`, `year`, `month`) VALUES
(100, 'yanny', '$2y$10$oe0upF5BaQKuPBnelABLVOwlxjeyAXlB/ythqQOUi/ccIhQFXvfLS', '2020', 1),
(101, 'mics123', '$2y$10$wzJQR2dR6BeszJpJY/YNS.5giZ8kASzpImj0X/mCxmsrIwg.15FwC', '2020', 2),
(109, 'black_widow101', '$2y$10$sAGCbjNYQsWgIskUMxireOogG6gS6esug4MK0UoC7kRT7Gfe/a5dG', '2020', 3),
(110, 'Captain@merica101', '$2y$10$yLbM7qJIgeFGtX8hJG9zlettmVOdxfs/5owmWDv91WoqCfIi7Xqba', '2020', 1),
(111, 'IronMan99', '$2y$10$/Sk49DYoM/SNO8kpTX5AL.DCh8Yz/F84bskGps70AxfXaBqP9c.kO', '2020', 2),
(116, 'antm@n', '$2y$10$.JCyAoEV0Imfn24HVsY.uuZs/DpWcbeG6EZUC1QmzQURfc8OaP/C.', '2020', 4),
(117, 'THOR', '$2y$10$tuWVN5X.1pBRAbEz6pyEtOhSEbyNFALfTWIhGB6IGHSSeJov.Sj6W', '2020', 4),
(123, 'ian101', '$2y$10$iHmx.FtS3g5SSb5ZnpryWO1ceCLu9sZtN1RQO/.XyG8VJBsM.bHlK', '2020', 4),
(124, 'aiyuuu', '$2y$10$zCCH7nKiVhOvHUiu4BByj.494ucs7kBIlxG7vkZfUjrLA5wNO0Xgy', '2020', 4),
(125, 'q', '$2y$10$74m5MyzF0iMAIfckyNuSIuwFoeQUjAT9T1K/VthynBn6N9WDFN9Le', '2020', 4),
(126, 'w', '$2y$10$6waR1gN1IbRoDDjaSQH4BeCnLuJHRfRKlonp5zvjU9kSSsOb97ryW', '2020', 4),
(127, 'e', '$2y$10$UHrpst0dBQNWhaZ0pJHdSuAASemDxF7bWMZZN2T1wNYcAlyLuiqkq', '2020', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acctype`
--

CREATE TABLE `tbl_acctype` (
  `typeID` int(11) NOT NULL,
  `accType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_acctype`
--

INSERT INTO `tbl_acctype` (`typeID`, `accType`) VALUES
(1, 'student'),
(2, 'teacher'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_info`
--

CREATE TABLE `tbl_add_info` (
  `ID` int(11) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `bday` varchar(30) NOT NULL,
  `city` varchar(300) NOT NULL,
  `school` varchar(300) NOT NULL,
  `accID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_add_info`
--

INSERT INTO `tbl_add_info` (`ID`, `gender`, `bday`, `city`, `school`, `accID`) VALUES
(5, 'Male', '16 June, 2000', 'Las Pinas City', 'Cavite State University - Bacoor Campus', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_info`
--

CREATE TABLE `tbl_admin_info` (
  `ID` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `accID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_info`
--

INSERT INTO `tbl_admin_info` (`ID`, `gender`, `contact`, `accID`) VALUES
(1, 'Male', '09263665735', 123),
(2, 'Female', '09263665735', 124),
(3, 'q', 'q', 125),
(4, 'w', 'w', 126),
(5, 'e', 'e', 127);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `ID` int(11) NOT NULL,
  `dates` varchar(50) NOT NULL,
  `studentID` int(11) NOT NULL,
  `stdStatus` varchar(50) NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`ID`, `dates`, `studentID`, `stdStatus`, `classID`) VALUES
(74, '14/04/2020', 109, 'Present', 114),
(75, '15/04/2020', 110, 'Present', 114),
(76, '15/04/2020', 109, 'Present', 114),
(77, '16/04/2020', 110, 'Present', 114),
(78, '16/04/2020', 109, 'Present', 114),
(79, '16/04/2020', 111, 'Present', 114),
(80, '21/04/2020', 110, 'Present', 114),
(81, '21/04/2020', 109, 'Present', 114),
(82, '21/04/2020', 111, 'Present', 114),
(83, '22/04/2020', 117, 'Present', 114),
(84, '22/04/2020', 116, 'Present', 114),
(85, '22/04/2020', 110, 'Present', 114),
(86, '22/04/2020', 109, 'Present', 114),
(87, '22/04/2020', 111, 'Present', 114),
(88, '23/04/2020', 117, 'Present', 114),
(89, '23/04/2020', 116, 'Present', 114),
(90, '23/04/2020', 110, 'Present', 114),
(91, '23/04/2020', 109, 'Present', 114),
(92, '23/04/2020', 111, 'Present', 114);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `classID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `subjects` varchar(65) NOT NULL,
  `g_s` varchar(40) NOT NULL,
  `code` varchar(10) NOT NULL,
  `classStatus` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`classID`, `teacherID`, `subjects`, `g_s`, `code`, `classStatus`) VALUES
(114, 100, 'Object Oriented Programming 101', 'BSIT 2-1', 'YC6GU', 'Open'),
(115, 100, 'SQL', 'BSIT 2-1', 'AD406', 'Close'),
(116, 101, 'Java', 'BSIT 2-1', 'GH6NZ', 'Close');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_code`
--

CREATE TABLE `tbl_code` (
  `ID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `codeID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_code`
--

INSERT INTO `tbl_code` (`ID`, `studentID`, `codeID`) VALUES
(51, 109, 114),
(52, 110, 114),
(53, 111, 114),
(56, 116, 114),
(57, 117, 114);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_date`
--

CREATE TABLE `tbl_date` (
  `ID` int(11) NOT NULL,
  `Month` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_date`
--

INSERT INTO `tbl_date` (`ID`, `Month`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `fileID` int(11) NOT NULL,
  `fileNames` varchar(150) NOT NULL,
  `fileLoc` varchar(350) NOT NULL,
  `names` varchar(300) NOT NULL,
  `fileType` varchar(50) NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`fileID`, `fileNames`, `fileLoc`, `names`, `fileType`, `classID`) VALUES
(59, 'PDF', 'files/document/2020-04-12_08_57_31.0213.pdf', '0213.pdf', 'PDF', 114),
(61, 'PHP', 'files/image/2020-04-12_08_47_06.Picture1.png', 'Picture1.png', 'image/png', 114),
(62, 'Pub', 'files/document/2020-04-12_08_55_27.Publication1.pub', 'Publication1.pub', 'Publisher', 114);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_friends`
--

CREATE TABLE `tbl_friends` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `friendsID` int(11) NOT NULL,
  `friendStatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_friends`
--

INSERT INTO `tbl_friends` (`ID`, `userID`, `friendsID`, `friendStatus`) VALUES
(33, 110, 109, 'FRIENDS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson`
--

CREATE TABLE `tbl_lesson` (
  `lessonID` int(11) NOT NULL,
  `lessonTitle` text NOT NULL,
  `topic` text NOT NULL,
  `content` text NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lesson`
--

INSERT INTO `tbl_lesson` (`lessonID`, `lessonTitle`, `topic`, `content`, `classID`) VALUES
(187, 'Java Object Oriented Programming System (OOPs) Concepts', ' Object Oriented Programming ', '- Is a methodology or paradigm to design aprogram using classes and objects.<br>\n- It simplifies software development andmaintenance by providing some concepts.<br>\n- The main aim is to implement real-world entities.<br>\n- Popular object-oriented languages:<br>\n Java, C#, PHP, Python, C++', 114),
(188, 'Java Object Oriented Programming System (OOPs) Concepts', ' Simula ', ' – is considered the first object-orientedprogramming language. The programming paradigm where everything is represented as an object is known as a truly object-oriented programming language', 114),
(189, 'Java Object Oriented Programming System (OOPs) Concepts', ' Smalltalk ', '– is considered the first truly object-oriented programming language', 114),
(190, 'Java Object Oriented Programming System (OOPs) Concepts', ' OOPs Concepts: ', '- Objects<br>\n- Classes<br>\n- Inheritance<br>\n- Polymorphism<br>\n- Abstraction<br>\n- Encapsulation', 114),
(191, 'Java Object Oriented Programming System (OOPs) Concepts', ' Object ', '- Any entity that has state and behavior.<br>\n- It can be physical or logical.<br>\n- Can be defined as an instance of class.<br>\n- Has states and behaviors.<br>\nExample: A dog is an object because it has states like color, name, breed, etc., as well as behaviors like wagging the tail, barking, eating, etc.', 114),
(192, 'Java Object Oriented Programming System (OOPs) Concepts', ' Class ', '- It is a logical entity.<br>\n- A blueprint from which you can create an individual object.<br>\n- Defined as collection of objects.', 114),
(193, 'Java Object Oriented Programming System (OOPs) Concepts', ' Inheritance ', '- Provides code reusability.<br>\n- When one object acquires all the properties and behaviors of a parent object.', 114),
(194, 'Java Object Oriented Programming System (OOPs) Concepts', ' Polymorphism ', '- If one task is performed in different ways.<br>\nExample: To command an animal to speak, the cat meows, the dog barks, the duck quacks, etc.', 114),
(195, 'Java Object Oriented Programming System (OOPs) Concepts', 'Abstraction', '- Hiding internal details and showing functionality.', 114),
(196, 'Java Object Oriented Programming System (OOPs) Concepts', ' Encapsulation ', '- Binding (or wrapping) code and data together into a single unit.', 114),
(197, 'Java Object Oriented Programming System (OOPs) Concepts', ' Advantage of OOPs ', '1. Makes development and maintenance easier.<br>\n2. Provides data hiding.<br>\n3. Provides the ability to simulate real-world event much more effectively.', 114),
(199, 'more', 'more', 'more', 114);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_multiplechoice`
--

CREATE TABLE `tbl_multiplechoice` (
  `ID` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `question` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_multiplechoice`
--

INSERT INTO `tbl_multiplechoice` (`ID`, `quizID`, `question`, `a`, `b`, `c`, `d`, `answer`) VALUES
(49, 41, 'What is OOP?', 'Object Oriented Programming ', 'Object Orientation Program', 'Oriental Object Program', 'None of the above', 'Object Oriented Programming '),
(50, 41, 'It is considered the first object-oriented programming language. ', 'Smalltalk', 'Simula', 'Object', 'Class', 'Simula'),
(51, 41, 'What is Object?', 'One task is performed in different ways', 'Provides code reusability', 'It is a logical entity.', ' Any entity that has state and behavior.', ' Any entity that has state and behavior.'),
(52, 41, 'Smalltalk', 'Has states and behaviors.', 'The programming paradigm where everything is represented as an object is known as a truly object-oriented programming language', 'Is considered the first truly object-oriented programming language', 'Defined as collection of objects.', 'Is considered the first truly object-oriented programming language'),
(53, 41, 'What is Class?', 'A blueprint from which you can create an individual object.', 'It can be physical or logical', 'Provides code reusability', 'Defined as collection of objects.', 'A blueprint from which you can create an individual object.'),
(54, 41, 'What is Inheritance?', 'Provides code reusability', 'A blueprint from which you can create an individual object', ' Makes development and maintenance easier.', 'Provides data hiding.', 'Provides code reusability'),
(55, 41, 'What is Polymorphism?', 'Binding (or wrapping) code and data together into a single unit.', 'One task is performed in different ways.', 'Hiding internal details and showing functionality.', 'Can be defined as an instance of class', 'One task is performed in different ways.'),
(56, 41, 'What is Abstraction?', 'If one task is performed in different ways.', 'A blueprint from which you can create an individual object', 'Binding (or wrapping) code and data together into a single unit', 'Hiding internal details and showing functionality.', 'Hiding internal details and showing functionality.'),
(57, 41, 'What is Encapsulation ?', 'A blueprint from which you can create an individual object', 'If one task is performed in different ways.', 'Binding (or wrapping) code and data together into a single unit', 'Hiding internal details and showing functionality.', 'Binding (or wrapping) code and data together into a single unit'),
(58, 41, 'Which is not belong of adavantages of OOP', 'Makes development and maintenance easier.', 'Provides data hiding.', 'Binding (or wrapping) code and data together into a single unit.', 'Provides the ability to simulate real-world event much more effectively.', 'Binding (or wrapping) code and data together into a single unit.'),
(59, 44, 'q', 'a', 'a', 'a', 'a', 'a'),
(60, 47, 's', 's', 's', 's', 's', 's');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile_pic`
--

CREATE TABLE `tbl_profile_pic` (
  `ID` int(11) NOT NULL,
  `img` varchar(300) NOT NULL,
  `userID` int(11) NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_profile_pic`
--

INSERT INTO `tbl_profile_pic` (`ID`, `img`, `userID`, `category`) VALUES
(44, 'files/profile_pic/2020-04-12_09_06_09.balck widow.jpg', 109, 'dp'),
(45, 'files/profile_pic/2020-04-15_12_22_06.hulk.jpg', 109, 'wall'),
(47, 'files/profile_pic/2020-04-15_04_33_28.IMG_20190617_155209.jpg', 100, 'dp'),
(48, 'files/profile_pic/2020-04-15_04_55_50.BeautyPlus_20190617165951243_save.jpg', 100, 'wall'),
(49, 'files/profile_pic/2020-04-16_06_59_08.iron-man.jpg', 111, 'dp'),
(50, 'files/profile_pic/2020-04-16_06_59_41.internet-3116062_1280.jpg', 111, 'wall'),
(52, 'files/profile_pic/2020-04-21_02_04_53.images (2).jpeg', 123, 'wall'),
(53, 'files/profile_pic/2020-04-21_02_11_08.hawkeye.jpg', 123, 'dp'),
(54, 'files/profile_pic/2020-04-22_05_27_23.hawkeye.jpg', 109, 'wall');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE `tbl_quiz` (
  `quizID` int(11) NOT NULL,
  `quizTitle` varchar(300) NOT NULL,
  `classID` int(11) NOT NULL,
  `typeQuiz` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`quizID`, `quizTitle`, `classID`, `typeQuiz`) VALUES
(41, 'OOP: Topic 1 (Part 1)', 114, 'Multiple Choice'),
(43, 'OOP: Topic 1 (Part 2)', 114, 'True/False'),
(44, 'q', 114, 'Multiple Choice'),
(45, 'w', 114, 'True/False'),
(46, 'a', 114, 'True/False'),
(47, 's', 114, 'Multiple Choice');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_score`
--

CREATE TABLE `tbl_score` (
  `ID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `quizNum` varchar(20) NOT NULL,
  `quizID` int(11) NOT NULL,
  `a` varchar(11) NOT NULL,
  `b` varchar(11) NOT NULL,
  `c` varchar(11) NOT NULL,
  `d` varchar(11) NOT NULL,
  `e` varchar(11) NOT NULL,
  `f` varchar(11) NOT NULL,
  `g` varchar(11) NOT NULL,
  `h` varchar(11) NOT NULL,
  `i` varchar(11) NOT NULL,
  `j` varchar(11) NOT NULL,
  `average` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_score`
--

INSERT INTO `tbl_score` (`ID`, `studentID`, `quizNum`, `quizID`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `average`) VALUES
(52, 109, 'Quiz 1', 41, 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 100),
(53, 109, 'Quiz 2', 43, 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(54, 109, 'Quiz 3', 44, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(55, 109, 'Quiz 4', 45, 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 0),
(56, 109, 'Quiz 5', 46, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(57, 109, 'Quiz 6', 47, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(58, 110, 'Quiz 1', 41, 'Wrong', 'Correct', 'Correct', 'Wrong', 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Correct', 40),
(59, 110, 'Quiz 2', 43, 'Correct', 'Correct', 'Correct', 'Correct', 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(60, 110, 'Quiz 3', 44, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(61, 110, 'Quiz 4', 45, 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 0),
(62, 110, 'Quiz 5', 46, 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 0),
(63, 110, 'Quiz 6', 47, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(65, 111, 'Quiz 1', 41, 'Correct', 'Wrong', 'Correct', 'Correct', 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 40),
(66, 111, 'Quiz 2', 43, 'Correct', 'Correct', 'Wrong', 'Correct', 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 80),
(67, 111, 'Quiz 3', 44, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(68, 111, 'Quiz 4', 45, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(69, 111, 'Quiz 6', 47, 'Correct', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 100),
(70, 111, 'Quiz 5', 46, 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 'Wrong', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_true_false`
--

CREATE TABLE `tbl_true_false` (
  `ID` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_true_false`
--

INSERT INTO `tbl_true_false` (`ID`, `quizID`, `question`, `answer`) VALUES
(31, 43, 'Simula is considered the first object-oriented programming language', 'True'),
(32, 43, 'Simula is considered the first truly object-oriented programming language', 'False'),
(33, 43, 'Class is a methodology or paradigm to design aprogram using classes and objects.', 'False'),
(34, 43, 'OOP - Object Oriented Programming', 'True'),
(35, 43, 'Inheritance provides code reusability.', 'True'),
(36, 45, 'w', 'True'),
(37, 46, 'a', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `userID` int(11) NOT NULL,
  `fn` varchar(40) NOT NULL,
  `ln` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `accID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`userID`, `fn`, `ln`, `email`, `accID`, `typeID`) VALUES
(61, 'Ian', 'Destura', 'idestura35@gmail.com', 100, 2),
(62, 'Mica', 'Mediado', 'mica@gmail.com', 101, 2),
(70, 'Natasha', 'Romanoff', 'natasharomanoff@gmail.com', 109, 1),
(71, 'Steve', 'Roger', 'SteveRoger101@gmail.com', 110, 1),
(72, 'Tony', 'Stark', 'TonyStark99@gmail.com', 111, 1),
(75, 'Hank', 'Pym', 'HankPym@gmail.com', 116, 1),
(76, 'Thor', 'Odinson', 'thorOdinson@gmail.com', 117, 1),
(77, 'Ian', 'Destura', 'idestura35@gmail.com', 123, 3),
(78, 'Mica', 'Mediado', 'Mics123@gmail.com', 124, 3),
(79, 'q', 'q', 'q', 125, 3),
(80, 'w', 'w', 'w', 126, 3),
(81, 'e', 'e', 'e', 127, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`accID`),
  ADD KEY `month` (`month`);

--
-- Indexes for table `tbl_acctype`
--
ALTER TABLE `tbl_acctype`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `tbl_add_info`
--
ALTER TABLE `tbl_add_info`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `accID` (`accID`);

--
-- Indexes for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `classID` (`classID`),
  ADD KEY `tbl_attendance_ibfk_2` (`studentID`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`classID`),
  ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `tbl_code`
--
ALTER TABLE `tbl_code`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `tbl_code_ibfk_2` (`codeID`);

--
-- Indexes for table `tbl_date`
--
ALTER TABLE `tbl_date`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`fileID`),
  ADD KEY `tbl_file_ibfk_1` (`classID`);

--
-- Indexes for table `tbl_friends`
--
ALTER TABLE `tbl_friends`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `friendsID` (`friendsID`);

--
-- Indexes for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  ADD PRIMARY KEY (`lessonID`),
  ADD KEY `classID` (`classID`);

--
-- Indexes for table `tbl_multiplechoice`
--
ALTER TABLE `tbl_multiplechoice`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `quizID` (`quizID`);

--
-- Indexes for table `tbl_profile_pic`
--
ALTER TABLE `tbl_profile_pic`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD PRIMARY KEY (`quizID`),
  ADD KEY `classID` (`classID`);

--
-- Indexes for table `tbl_score`
--
ALTER TABLE `tbl_score`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `quizID` (`quizID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `tbl_true_false`
--
ALTER TABLE `tbl_true_false`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `quizID` (`quizID`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `accID` (`accID`),
  ADD KEY `typeID` (`typeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `accID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tbl_acctype`
--
ALTER TABLE `tbl_acctype`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_add_info`
--
ALTER TABLE `tbl_add_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_code`
--
ALTER TABLE `tbl_code`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_date`
--
ALTER TABLE `tbl_date`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_friends`
--
ALTER TABLE `tbl_friends`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  MODIFY `lessonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `tbl_multiplechoice`
--
ALTER TABLE `tbl_multiplechoice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_profile_pic`
--
ALTER TABLE `tbl_profile_pic`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  MODIFY `quizID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_score`
--
ALTER TABLE `tbl_score`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_true_false`
--
ALTER TABLE `tbl_true_false`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD CONSTRAINT `tbl_account_ibfk_1` FOREIGN KEY (`month`) REFERENCES `tbl_date` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_add_info`
--
ALTER TABLE `tbl_add_info`
  ADD CONSTRAINT `tbl_add_info_ibfk_1` FOREIGN KEY (`accID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD CONSTRAINT `tbl_attendance_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `tbl_class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_attendance_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD CONSTRAINT `tbl_class_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_code`
--
ALTER TABLE `tbl_code`
  ADD CONSTRAINT `tbl_code_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_code_ibfk_2` FOREIGN KEY (`codeID`) REFERENCES `tbl_class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD CONSTRAINT `tbl_file_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `tbl_class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_friends`
--
ALTER TABLE `tbl_friends`
  ADD CONSTRAINT `tbl_friends_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_friends_ibfk_2` FOREIGN KEY (`friendsID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  ADD CONSTRAINT `tbl_lesson_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `tbl_class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_multiplechoice`
--
ALTER TABLE `tbl_multiplechoice`
  ADD CONSTRAINT `tbl_multiplechoice_ibfk_1` FOREIGN KEY (`quizID`) REFERENCES `tbl_quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_profile_pic`
--
ALTER TABLE `tbl_profile_pic`
  ADD CONSTRAINT `tbl_profile_pic_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbl_account` (`accID`);

--
-- Constraints for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD CONSTRAINT `tbl_quiz_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `tbl_class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_score`
--
ALTER TABLE `tbl_score`
  ADD CONSTRAINT `tbl_score_ibfk_1` FOREIGN KEY (`quizID`) REFERENCES `tbl_quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_score_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_true_false`
--
ALTER TABLE `tbl_true_false`
  ADD CONSTRAINT `tbl_true_false_ibfk_1` FOREIGN KEY (`quizID`) REFERENCES `tbl_quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD CONSTRAINT `tbl_user_info_ibfk_1` FOREIGN KEY (`accID`) REFERENCES `tbl_account` (`accID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_user_info_ibfk_2` FOREIGN KEY (`typeID`) REFERENCES `tbl_acctype` (`typeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
