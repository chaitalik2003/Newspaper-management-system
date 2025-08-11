-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2024 at 05:37 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newspapermanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=501 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'chiu', 'chiu@gmail.com', 'chiu'),
(500, 'Chaitali Kulkarni', 'kchaitali788@gmail.com', 'ck123');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `locationArea` varchar(20) NOT NULL,
  `subscription_start` date NOT NULL,
  `subscription_end` date NOT NULL,
  `newspaper` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `contact`, `address`, `locationArea`, `subscription_start`, `subscription_end`, `newspaper`) VALUES
('C5', 'Chaitali Kulkarni', 'kchaitali788@gmail.com', 'ck', '8623917371', 'pune', '', '2024-08-07', '2024-08-16', 'newspaper5'),
('C500', 'ck', 'mc23095@iims.ac.in', '123', '8623917371', 'pune', '', '2024-10-17', '2024-10-26', 'newspaper10'),
('C101', 'DDDDDD', 'DD@DKM.COM', '456', '852.852852', 'JKDN', '', '2025-01-02', '2026-01-01', 'newspaper1'),
('C1', 'wenaks', 'mkwqld@sjdk.com', 'kmwdas.,', 'kmwdklsa', 'mlkdwms,a', '', '2024-10-03', '2024-10-17', 'newspaper1'),
('C501', 'Divyesh Joshi', 'Div@gmail.com', '123', '7387321324', 'Devpur', 'Devpur', '2024-10-01', '2024-11-01', 'Indian Express'),
('C502', 'qkjeasd', 'jda@gmail.com', 'klqqwdjsn', 'jknd', 'lknfdq', '', '2024-10-10', '2024-10-18', 'Lokmat'),
('C001', 'Rahul Patil', 'rahul.patil@example.com', 'pass1234', '9876543210', 'Wadibhokar Road, Near Datta Mandir', 'Wadibhokar Road', '2024-01-01', '2024-12-31', 'Lokmat'),
('C002', 'Priya Deshmukh', 'priya.deshmukh@example.com', 'pass5678', '9876543220', 'Stadium Colony, Near Main Gate', 'Stadium', '2024-02-15', '2025-02-15', 'Sakal'),
('C003', 'Vikas Jadhav', 'vikas.jadhav@example.com', 'pass7890', '9876543230', 'Datta Mandir, Old Dhule Road', 'Datta Mandir', '2024-03-01', '2024-12-01', 'Indian Express'),
('C004', 'Sonal Pawar', 'sonal.pawar@example.com', 'pass1235', '9876543240', 'Wadibhokar Road, Near Police Station', 'Wadibhokar Road', '2024-01-05', '2024-07-05', 'PunyaNagari'),
('C005', 'Amit Shinde', 'amit.shinde@example.com', 'pass3456', '9876543250', 'Stadium Colony, Behind Gym', 'Stadium', '2024-02-10', '2024-08-10', 'Loksatta'),
('C006', 'Nisha Kale', 'nisha.kale@example.com', 'pass6789', '9876543260', 'Wadibhokar Road, Near School', 'Wadibhokar Road', '2024-03-10', '2025-03-10', 'Divya Marathi'),
('C007', 'Deepak Sawant', 'deepak.sawant@example.com', 'pass2345', '9876543270', 'Near Datta Mandir, Wadibhokar Road', 'Wadibhokar Road', '2024-01-20', '2024-12-20', 'Aapla Maharashtra'),
('C008', 'Sakshi Kulkarni', 'sakshi.kulkarni@example.com', 'pass4567', '9876543280', 'Stadium Road, Near Bus Stand', 'Stadium', '2024-02-12', '2025-02-12', 'Maharashtra Times'),
('C009', 'Ajay More', 'ajay.more@example.com', 'pass7891', '9876543290', 'Wadibhokar Road, Near Hospital', 'Wadibhokar Road', '2024-03-05', '2025-03-05', 'Divya Bhaskar'),
('C010', 'Shivani Rane', 'shivani.rane@example.com', 'pass1236', '9876543300', 'Stadium Colony, Near Garden', 'Stadium', '2024-01-15', '2024-07-15', 'Lokmat'),
('C011', 'Rohit Gawande', 'rohit.gawande@example.com', 'pass2346', '9876543310', 'Wadibhokar Road, Near Petrol Pump', 'Wadibhokar Road', '2024-01-30', '2024-11-30', 'Sakal'),
('C012', 'Neha Rathi', 'neha.rathi@example.com', 'pass3457', '9876543320', 'Datta Mandir, Near Market', 'Datta Mandir', '2024-02-18', '2025-02-18', 'Indian Express'),
('C013', 'Sameer Khedkar', 'sameer.khedkar@example.com', 'pass6780', '9876543330', 'Wadibhokar Road, Near Restaurant', 'Wadibhokar Road', '2024-03-20', '2025-03-20', 'PunyaNagari'),
('C014', 'Vinayak Sawant', 'vinayak.sawant@example.com', 'pass1237', '9876543340', 'Stadium Colony, Near Library', 'Stadium', '2024-01-08', '2024-10-08', 'Loksatta'),
('C015', 'Poonam Nikam', 'poonam.nikam@example.com', 'pass4568', '9876543350', 'Near Datta Mandir, Old Dhule Road', 'Datta Mandir', '2024-02-05', '2025-02-05', 'Divya Marathi'),
('C016', 'Anil Kamat', 'anil.kamat@example.com', 'pass7892', '9876543360', 'Wadibhokar Road, Near School', 'Wadibhokar Road', '2024-01-25', '2024-12-25', 'Aapla Maharashtra'),
('C017', 'Radhika Jadhav', 'radhika.jadhav@example.com', 'pass2347', '9876543370', 'Stadium Road, Near Factory', 'Stadium', '2024-02-20', '2025-02-20', 'Maharashtra Times'),
('C018', 'Kiran More', 'kiran.more@example.com', 'pass6781', '9876543380', 'Wadibhokar Road, Near Market', 'Wadibhokar Road', '2024-03-15', '2025-03-15', 'Divya Bhaskar'),
('C019', 'Komal Shinde', 'komal.shinde@example.com', 'pass1238', '9876543390', 'Near Datta Mandir, Behind School', 'Datta Mandir', '2024-01-12', '2024-06-12', 'Lokmat'),
('C020', 'Nitin Sable', 'nitin.sable@example.com', 'pass4569', '9876543400', 'Stadium Colony, Near College', 'Stadium', '2024-02-15', '2025-02-15', 'Sakal'),
('C021', 'Geeta Suryawanshi', 'geeta.suryawanshi@example.com', 'pass7893', '9876543410', 'Wadibhokar Road, Near Police Chowki', 'Wadibhokar Road', '2024-03-02', '2025-03-02', 'Indian Express'),
('C503', 'dk', 'wqjnn@gm.com', 'wd,', 'd,w', 'dw,', ';wd', '2024-10-09', '2024-10-16', 'Divya Marathi');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `hawker_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `hawker_id` (`hawker_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `customer_id`, `hawker_id`, `date`, `status`) VALUES
(1, 5, 6, '2024-08-22', 'completed'),
(10, 5, 5, '2024-08-05', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(11) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `newspaper` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `pending_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `issue_date`, `due_date`, `newspaper`, `amount`, `pending_amount`) VALUES
(10, '5', '2024-08-05', '2024-08-05', 'Loksatta', '500.00', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_g`
--

CREATE TABLE IF NOT EXISTS `invoices_g` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `newspaper` varchar(100) NOT NULL,
  `rate_per_day` decimal(10,2) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Paid','Unpaid') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `invoices_g`
--

INSERT INTO `invoices_g` (`id`, `customer_id`, `customer_name`, `contact_no`, `address`, `newspaper`, `rate_per_day`, `number_of_days`, `total_amount`, `payment_status`, `created_at`) VALUES
(1, 'C501', 'Divyesh Joshi', '7387321324', 'devpur', 'DivyaBhaskar', '5.00', 29, '145.00', 'Unpaid', '2024-10-18 20:12:35'),
(2, 'C501', 'Divyesh Joshi', '7387321324', 'devpur', 'DivyaBhaskar', '5.00', 29, '145.00', 'Unpaid', '2024-10-18 20:25:12'),
(3, 'C501', 'Divyesh Joshi', '7387321324', 'devpur', 'DivyaBhaskar', '5.00', 29, '145.00', 'Unpaid', '2024-10-18 20:25:51'),
(29, '', '', '', '', '', '0.00', 0, '0.00', '', '2024-10-19 09:23:04'),
(28, 'C001', ' Rahul Patil', '9876543210', 'Wadibhokar Road, Near Datta Mandir', 'Lokmat', '6.00', 31, '186.00', 'Unpaid', '2024-10-19 09:22:13'),
(20, 'C001', ' Rahul Patil', '9876543210', 'Wadibhokar Road, Near Datta Mandir', 'Lokmat', '4.00', 1, '4.00', 'Paid', '2024-10-19 04:35:30'),
(11, 'C001', ' Rahul Patil', '9876543210', 'Wadibhokar Road, Near Datta Mandir', 'Lokmat', '6.00', 31, '186.00', 'Unpaid', '2024-10-19 02:16:15'),
(12, 'C001', ' Rahul Patil', '9876543210', 'Wadibhokar Road, Near Datta Mandir', 'Lokmat', '6.00', 29, '174.00', 'Paid', '2024-10-19 03:35:16'),
(13, 'C001', ' Rahul Patil', '9876543210', 'Wadibhokar Road, Near Datta Mandir', 'Lokmat', '6.00', 29, '174.00', 'Paid', '2024-10-19 03:35:41'),
(10, 'C501', 'Divyesh Joshi', '7387321324', 'pune', 'Indian Express', '7.00', 29, '203.00', 'Unpaid', '2024-10-18 20:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `magzine`
--

CREATE TABLE IF NOT EXISTS `magzine` (
  `id` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` text NOT NULL,
  `magazine_name` text NOT NULL,
  `magazine_type` text NOT NULL,
  `delivery_frequency` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `magzine`
--

INSERT INTO `magzine` (`id`, `customer_name`, `customer_email`, `magazine_name`, `magazine_type`, `delivery_frequency`) VALUES
(100, 'jk', 'jk', 'home', 'fashion', 'monthly');

-- --------------------------------------------------------

--
-- Table structure for table `paperhawkers`
--

CREATE TABLE IF NOT EXISTS `paperhawkers` (
  `id` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `locationArea` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paperhawkers`
--

INSERT INTO `paperhawkers` (`id`, `name`, `email`, `locationArea`, `password`, `contact`) VALUES
('H001', 'Suresh Patil', 'suresh.patil@example.com', 'Wadibhokar Road', 'hawkerpass1', '9876543500'),
('H002', 'Vinayak Jadhav', 'vinayak.jadhav@example.com', 'Stadium', 'hawkerpass2', '9876543510'),
('H003', 'Aarti Deshmukh', 'aarti.deshmukh@example.com', 'Datta Mandir', 'hawkerpass3', '9876543520');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_date` date NOT NULL,
  `total_deliveries` int(11) NOT NULL,
  `successful_deliveries` int(11) NOT NULL,
  `missed_deliveries` int(11) NOT NULL,
  `delays` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report_date`, `total_deliveries`, `successful_deliveries`, `missed_deliveries`, `delays`) VALUES
(1, '2024-08-14', 250, 250, 0, 15),
(2, '2024-08-14', 250, 250, 0, 15),
(10, '2024-08-15', 1500, 1500, 150, 100);
