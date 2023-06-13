-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2023 at 03:50 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myhmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE IF NOT EXISTS `admintb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`username`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointmenttb`
--

CREATE TABLE IF NOT EXISTS `appointmenttb` (
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `docFees` int(5) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `userStatus` int(5) NOT NULL,
  `doctorStatus` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `appointmenttb`
--

INSERT INTO `appointmenttb` (`pid`, `ID`, `fname`, `lname`, `gender`, `email`, `contact`, `doctor`, `docFees`, `appdate`, `apptime`, `userStatus`, `doctorStatus`) VALUES
(4, 1, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Ganesh', 550, '2020-02-14', '10:00:00', 1, 1),
(4, 2, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Dinesh', 700, '2020-02-28', '10:00:00', 1, 1),
(4, 3, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Amit', 1000, '2020-02-19', '03:00:00', 1, 1),
(11, 4, 'Shraddha', 'Kapoor', 'Female', 'shraddha@gmail.com', '9768946252', 'ashok', 500, '2020-02-29', '20:00:00', 0, 0),
(4, 6, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Ganesh', 550, '2020-02-26', '15:00:00', 0, 0),
(2, 8, 'Alia', 'Bhatt', 'Female', 'alia@gmail.com', '8976897689', 'Kumar', 550, '2020-03-21', '10:00:00', 2, 2),
(5, 9, 'Gautam', 'Shankararam', 'Male', 'gautam@gmail.com', '9070897653', 'Ganesh', 550, '2020-03-19', '20:00:00', 0, 0),
(4, 11, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Dinesh', 700, '2020-03-27', '15:00:00', 2, 2),
(9, 12, 'William', 'Blake', 'Male', 'william@gmail.com', '8683619153', 'Kumar', 800, '2020-03-26', '12:00:00', 2, 2),
(4, 30, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'ashok', 500, '2023-05-28', '13:10:00', 1, 1),
(4, 43, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Amit', 1000, '2023-04-29', '20:16:00', 0, 1),
(9, 40, 'William', 'Blake', 'Male', 'william@gmail.com', '8683619153', 'Amit', 1000, '2023-03-24', '17:51:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(10) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `contact`, `message`) VALUES
('Anu', 'anu@gmail.com', '7896677554', 'Hey Admin'),
(' Viki', 'viki@gmail.com', '9899778865', 'Good Job, Pal'),
('Ananya', 'ananya@gmail.com', '9997888879', 'How can I reach you?'),
('Aakash', 'aakash@gmail.com', '8788979967', 'Love your site'),
('Mani', 'mani@gmail.com', '8977768978', 'Want some coffee?'),
('Karthick', 'karthi@gmail.com', '9898989898', 'Good service'),
('Abbis', 'abbis@gmail.com', '8979776868', 'Love your service'),
('Asiq', 'asiq@gmail.com', '9087897564', 'Love your service. Thank you!'),
('Jane', 'jane@gmail.com', '7869869757', 'I love your service!');

-- --------------------------------------------------------

--
-- Table structure for table `doctb`
--

CREATE TABLE IF NOT EXISTS `doctb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `docFees` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctb`
--

INSERT INTO `doctb` (`username`, `password`, `email`, `spec`, `docFees`) VALUES
('ashok', 'ashok123', 'ashok@gmail.com', 'General', 500),
('arun', 'arun123', 'arun@gmail.com', 'Cardiologist', 600),
('Dinesh', 'dinesh123', 'dinesh@gmail.com', 'General', 700),
('Ganesh', 'ganesh123', 'ganesh@gmail.com', 'Pediatrician', 550),
('Kumar', 'kumar123', 'kumar@gmail.com', 'Pediatrician', 800),
('Amit', 'amit123', 'amit@gmail.com', 'Cardiologist', 1000),
('Abbis', 'abbis123', 'abbis@gmail.com', 'Neurologist', 1500),
('Tiwary', 'tiwary123', 'tiwary@gmail.com', 'Pediatrician', 450);

-- --------------------------------------------------------

--
-- Table structure for table `patreg`
--

CREATE TABLE IF NOT EXISTS `patreg` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `patreg`
--

INSERT INTO `patreg` (`pid`, `fname`, `lname`, `gender`, `email`, `contact`, `password`, `cpassword`) VALUES
(1, 'Ram', 'Kumar', 'Male', 'ram@gmail.com', '9876543210', 'ram123', 'ram123'),
(2, 'Alia', 'Bhatt', 'Female', 'alia@gmail.com', '8976897689', 'alia123', 'alia123'),
(3, 'Shahrukh', 'khan', 'Male', 'shahrukh@gmail.com', '8976898463', 'shahrukh123', 'shahrukh123'),
(4, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'kishan123', 'kishan123'),
(5, 'Gautam', 'Shankararam', 'Male', 'gautam@gmail.com', '9070897653', 'gautam123', 'gautam123'),
(6, 'Sushant', 'Singh', 'Male', 'sushant@gmail.com', '9059986865', 'sushant123', 'sushant123'),
(7, 'Nancy', 'Deborah', 'Female', 'nancy@gmail.com', '9128972454', 'nancy123', 'nancy123'),
(8, 'Kenny', 'Sebastian', 'Male', 'kenny@gmail.com', '9809879868', 'kenny123', 'kenny123'),
(9, 'William', 'Blake', 'Male', 'william@gmail.com', '8683619153', 'william123', 'william123'),
(10, 'Peter', 'Norvig', 'Male', 'peter@gmail.com', '9609362815', 'peter123', 'peter123'),
(11, 'Shraddha', 'Kapoor', 'Female', 'shraddha@gmail.com', '9768946252', 'shraddha123', 'shraddha123');

-- --------------------------------------------------------

--
-- Table structure for table `prestb`
--

CREATE TABLE IF NOT EXISTS `prestb` (
  `doctor` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `disease` varchar(250) NOT NULL,
  `allergy` varchar(250) NOT NULL,
  `prescription` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestb`
--

INSERT INTO `prestb` (`doctor`, `pid`, `ID`, `fname`, `lname`, `appdate`, `apptime`, `disease`, `allergy`, `prescription`) VALUES
('Dinesh', 4, 11, 'Kishan', 'Lal', '2020-03-27', '15:00:00', 'Cough', 'Nothing', 'Just take a teaspoon of Benadryl every night'),
('Ganesh', 2, 8, 'Alia', 'Bhatt', '2020-03-21', '10:00:00', 'Severe Fever', 'Nothing', 'Take bed rest'),
('Kumar', 9, 12, 'William', 'Blake', '2020-03-26', '12:00:00', 'Sever fever', 'nothing', 'Paracetamol -> 1 every morning and night');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
