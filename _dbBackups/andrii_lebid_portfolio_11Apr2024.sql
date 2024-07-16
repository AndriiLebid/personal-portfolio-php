-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 11:13 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andrii_lebid_portfolio`
--
CREATE DATABASE IF NOT EXISTS `andrii_lebid_portfolio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `andrii_lebid_portfolio`;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `post` text NOT NULL,
  `userId` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `technology` int NOT NULL,
  `skillsId` int NOT NULL,
  `imageId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `technology` (`technology`),
  KEY `userId` (`userId`),
  KEY `skillsId` (`skillsId`),
  KEY `blog_image` (`imageId`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `post`, `userId`, `date`, `technology`, `skillsId`, `imageId`) VALUES
(4, 'Insecure Protocols', 'A protocol that introduces security concerns due to the lack of controls over confidentiality. These security concerns include protocols that transmit data or authentication credentials in clear text over the Internet. Examples of insecure services include but are not limited to FTP, Telnet, POP3, IMAP, and SNMP v1 and v2.', 1, '2024-02-20 18:20:35', 16, 2, 22),
(5, 'TCP vs UDP', 'The main difference between TCP (transmission control protocol) and UDP (user datagram protocol) is that TCP is a connection-based protocol and UDP is connectionless. While TCP is more reliable, it transfers data more slowly. UDP is less reliable but works more quickly.\r\nTCP creates a secure communication line to ensure the reliable transmission of all data. Once a message is sent, the receipt is verified to make sure all the data was transferred.\r\n\r\nUDP does not establish a connection when sending data. It sends data without confirming receipt or checking for errors. That means some or all of the data may be lost during transmission.\r\n\r\n\r\nReferals link: https://www.avast.com/c-tcp-vs-udp-difference#:~:text=The%20main%20difference%20between%20TCP,reliable%20but%20works%20more%20quickly.\r\n', 1, '2024-02-20 18:20:35', 16, 2, 23),
(6, 'WebAssembly, that is it?', 'WebAssembly, often abbreviated as Wasm, is a binary instruction format designed to be executed within a web browser. It is a low-level, assembly-like language that allows developers to run high-performance code on the web.\r\n\r\nWebAssembly is a portable and efficient compilation target for programming languages like C, C++, and Rust. It serves as an alternative to JavaScript, enabling web applications to execute computationally intensive tasks and provide near-native performance.\r\n\r\nOne of the main advantages of WebAssembly is its ability to be executed quickly, as it is designed to be compiled ahead of time. This means that the code runs at near-native speed, making it suitable for tasks that require high performance, such as games, image and video processing, and complex simulations.\r\n\r\nAdditionally, WebAssembly has a compact binary format, which results in smaller file sizes compared to equivalent JavaScript code. This leads to faster load times for web applications, improving the overall user experience.\r\n\r\nWebAssembly is supported by all major web browsers, including Google Chrome, Mozilla Firefox, Microsoft Edge, and Apple Safari. This widespread support enables developers to create web applications that leverage the capabilities of WebAssembly across different platforms.\r\n\r\nIn summary, WebAssembly is a versatile technology that enhances web development by providing a high-performance execution environment for computationally intensive tasks and reducing file sizes for faster loading times.\r\n', 1, '2024-02-20 18:20:35', 10, 1, 25),
(11, 'TCP/IP stack', 'The TCP/IP stack is organized into four layers, each with specific protocols and functions:\r\n\r\nApplication Layer: This layer is where applications (like web browsers or email clients) operate. It includes protocols like HTTP, FTP, and SMTP.\r\nTransport Layer: This layer is responsible for end-to-end communication between devices. It includes protocols such as TCP (Transmission Control Protocol) for reliable, full-duplex communication, and UDP (User Datagram Protocol) for connectionless communication.\r\nInternet Layer: This layer is responsible for packet routing and delivery. It includes protocols like IP (Internet Protocol) for addressing and packet forwarding, and ICMP (Internet Control Message Protocol) for error reporting and diagnostics.\r\nLink Layer: Also known as the Network Interface Layer, this layer is responsible for the physical transmission of data over the network. It includes protocols like Ethernet for wired networks and Wi-Fi for wireless networks ', 1, '2024-02-21 22:28:29', 16, 2, 18),
(12, 'Java Enterprise', 'Java Platform, Enterprise Edition (Java EE), now known as Jakarta EE, is a set of specifications for developing and deploying enterprise applications. It extends Java SE (Standard Edition) with specifications for enterprise features such as distributed computing and web services.\r\n\r\nJava EE is developed by the Java Community Process, with contributions from industry experts, commercial and open source organizations, Java User Groups, and many individuals. Each release integrates new features that align with industry needs, improves application portability, and increases developer productivity.\r\n\r\nThe specifications define APIs (Application Programming Interfaces) and their interactions. Providers must meet certain conformance requirements to declare their products as Jakarta EE compliant. Some key specifications include:\r\n\r\nJakarta Contexts and Dependency Injection (CDI): Provides a dependency injection container.\r\nJakarta Enterprise Beans (EJB): Defines lightweight APIs for transactions, remote procedure calls, concurrency control, dependency injection, and access control for business objects.\r\nJakarta Persistence (JPA): Specifies object-relational mapping between relational database tables and Java classes.\r\nJakarta Transactions (JTA): Contains interfaces and annotations for transaction support.\r\nJakarta Messaging (JMS): Provides a common way for Java programs to create, send, receive, and read an enterprise messaging system\'s messages.\r\nJakarta EE applications are run on reference runtimes, which can be microservices or application servers, handling transactions, security, scalability, concurrency, and management of the components they are deploying.\r\n\r\nWhen a company requires Java EE experience, they are looking for experience using the technologies that make up Java EE, which can include a subset of the Java EE technologies', 1, '2024-02-21 22:30:53', 9, 2, 26),
(27, 'The 7 Layers of the OSI Model', 'The physical layer, It deals with raw bits\' electrical or optical transmission over a network.\r\nData link layer:  date transferer between nodes, the data is packaged into frames.\r\nThe network layer receives data from the data link layer and delivers it to destinations.\r\nThe transport layer controls the delivery of data packets and error checking. One of the most common examples of a transport layer is TCP.\r\nThe session layer manages the dialogue between different computers.\r\nPresentation level. The presentation layer formats or transforms data for the application layer.\r\nApplication level. The end user and application layer interact directly with the software application in this layer.', 1, '2024-03-03 22:05:16', 16, 2, 9),
(28, 'What is it Blazor for C#?', 'Blazor is a modern front-end web framework that allows the building of web applications using C# and HTML. It is part of the ASP.NET Core web app framework and is developed by Microsoft. Blazor enables the creation of web user interfaces (UI) based on components, which can be used to create single-page, mobile, or server-rendered applications using .NET technologies. It supports building web apps using reusable components that can run from both the client and the server, facilitating the delivery of rich web experiences. Blazor applications can be hosted in any web browser, server-side in ASP.NET Core, or native client apps. Blazor components can be used on the web and in hybrid native apps for mobile & desktop, making it a versatile framework for web development.', 1, '2024-03-22 09:51:00', 10, 1, 7),
(29, 'Thymeleaf', 'Thymeleaf is a server-side Java template engine designed for web and standalone environments. Its primary goal is facilitating the development workflow by enabling natural templates and HTML files to be correctly displayed in browsers and serve as static prototypes. Thymeleaf is well-suited for HTML5 JVM web development, offering extensive integration with the Spring Framework. It supports natural templates, meaning HTML templates written in Thymeleaf, allowing them to be used as helpful design artifacts. Thymeleaf is open-source and licensed under Apache License 2.0. Thymeleaf\'s integration with Spring MVC is managed by the Thymeleaf project, offering a seamless transition for developers looking to replace JSPs with Thymeleaf.\r\nIn conclusion, Thymeleaf is a powerful and flexible template engine that supports natural templates, especially those using the Spring Framework.', 1, '2024-03-22 10:11:25', 9, 1, 25),
(34, 'Why flutter is used so often in development now?', 'Flutter\'s combination of cross-platform development capabilities, reduced development time and costs, native-like performance, and strong community support make it a popular choice for developers looking to create high-quality applications efficiently.', 1, '2024-04-01 10:43:26', 18, 3, 24);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `AltText` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `link`, `AltText`) VALUES
(7, 'blazor-webassembly.png', 'gallery/blazor-webassembly.png', 'blazor-webassembly'),
(8, 'download.png', 'gallery/download.png', 'download'),
(9, 'model.png', 'gallery/model.png', 'model'),
(18, 'stack.png', 'gallery/stack.png', 'stack'),
(22, 'Frame 28.png', 'gallery/Frame 28.png', 'Frame 28'),
(23, 'Frame 29.png', 'gallery/Frame 29.png', 'Frame 29'),
(24, 'Frame 31.png', 'gallery/Frame 31.png', 'Frame 31'),
(25, 'Frame 32.png', 'gallery/Frame 32.png', 'Frame 32'),
(26, 'Frame 33.png', 'gallery/Frame 33.png', 'Frame 33'),
(27, 'card_1.png', 'gallery/card_1.png', 'card_1'),
(28, 'card_2.png', 'gallery/card_2.png', 'card_2'),
(29, 'card_3.png', 'gallery/card_3.png', 'card_3'),
(30, 'chess_1.png', 'gallery/chess_1.png', 'chess_1'),
(31, 'chess_2.png', 'gallery/chess_2.png', 'chess_2'),
(32, 'chess_3.png', 'gallery/chess_3.png', 'chess_3'),
(33, 'chess_4.png', 'gallery/chess_4.png', 'chess_4'),
(34, 'chess_5.png', 'gallery/chess_5.png', 'chess_5'),
(35, 'chess_6.png', 'gallery/chess_6.png', 'chess_6'),
(36, 'diary_1.png', 'gallery/diary_1.png', 'diary_1'),
(37, 'diary_2.png', 'gallery/diary_2.png', 'diary_2'),
(38, 'diary_3.png', 'gallery/diary_3.png', 'diary_3'),
(39, 'hotel_1.png', 'gallery/hotel_1.png', 'hotel_1'),
(40, 'hotel_2.png', 'gallery/hotel_2.png', 'hotel_2'),
(41, 'hotel_3.png', 'gallery/hotel_3.png', 'hotel_3'),
(42, 'hotel_4.png', 'gallery/hotel_4.png', 'hotel_4'),
(43, 'realestate_1.png', 'gallery/realestate_1.png', 'realestate_1'),
(44, 'realestate_2.png', 'gallery/realestate_2.png', 'realestate_2'),
(45, 'realestate_3.png', 'gallery/realestate_3.png', 'realestate_3'),
(46, 'realestate_4.png', 'gallery/realestate_4.png', 'realestate_4');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `skills` int NOT NULL,
  `technologies` int NOT NULL,
  `userId` int NOT NULL,
  `images` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `technologies` (`technologies`),
  KEY `userId` (`userId`),
  KEY `skills` (`skills`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `skills`, `technologies`, `userId`, `images`) VALUES
(6, 'Four Card Project', 'This was my first project in which I used object-oriented programming, objects, and the relation between them. I realized that the interface and logic needed to be separated during the development process.', 1, 8, 1, 'gallery/card_1.png, gallery/card_2.png, gallery/card_3.png'),
(8, 'Chess Opening', 'In this project, I created a data-driven Windows Forms desktop application that created, manipulated, searched, and viewed records in an SQL Server database.', 1, 14, 1, 'gallery/chess_1.png, gallery/chess_2.png, gallery/chess_3.png, gallery/chess_4.png, gallery/chess_5.png, gallery/chess_6.png'),
(9, 'Hotel Project', 'In this project, I was required to build an N-tier application iteratively using the skills they had learned throughout the N-tier course. Also, in this project, we used stored procedures and parameterized queries for the first time.', 1, 8, 1, 'gallery/hotel_1.png, gallery/hotel_2.png, gallery/hotel_3.png, gallery/hotel_4.png'),
(10, 'Real Estate Web Aplication', 'This project was also teamwork. We created a web application to manage the data of a real estate company. We use ASP.NET and the Model-Controller-View software design pattern.', 4, 17, 1, 'gallery/realestate_1.png, gallery/realestate_2.png, gallery/realestate_3.png, gallery/realestate_4.png'),
(11, 'Diary Flatter', 'This was my first mobile application developed using Flutter. We worked as a team of three and decided to make a simple notebook that would store phone numbers and user notes; we used a database to store the data and protect our application with login and password.', 3, 18, 1, 'gallery/diary_1.png, gallery/diary_2.png, gallery/diary_3.png');

-- --------------------------------------------------------

--
-- Table structure for table `skillset`
--

DROP TABLE IF EXISTS `skillset`;
CREATE TABLE IF NOT EXISTS `skillset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skillset`
--

INSERT INTO `skillset` (`id`, `name`) VALUES
(1, 'FrontEnd'),
(2, 'BackEnd'),
(3, 'Mobile'),
(4, 'FullStack');

-- --------------------------------------------------------

--
-- Table structure for table `technology`
--

DROP TABLE IF EXISTS `technology`;
CREATE TABLE IF NOT EXISTS `technology` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `technology`
--

INSERT INTO `technology` (`id`, `name`) VALUES
(8, 'C#'),
(9, 'Java'),
(10, 'WebAssembler'),
(11, 'HTML/CSS'),
(12, 'JavaScript'),
(13, 'Angular'),
(14, 'DataBase'),
(15, 'Securety'),
(16, 'Networking'),
(17, 'ASP.NET'),
(18, 'Flatter'),
(19, 'Android'),
(20, 'iOs');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `userName`, `password`, `email`) VALUES
(1, 'Andrii', 'Lebid', 'alebid', '$2y$12$iBU//fBu5pcN8Nrow4ED4eh6JlNwCeet.V3MMPY5D49bSHgDBegcO', 'andrii@lebid.ca'),
(2, 'Delon', 'Van de Venter', 'delon', '$2y$12$BQfcSNQyg//eAsxJQ2ti4OsloLmiRahIDBnS2.Cb1GETtliswuA/2', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`technology`) REFERENCES `technology` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `blog_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `blog_ibfk_4` FOREIGN KEY (`skillsId`) REFERENCES `skillset` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `blog_image` FOREIGN KEY (`imageId`) REFERENCES `image` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`technologies`) REFERENCES `technology` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_ibfk_4` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_ibfk_5` FOREIGN KEY (`skills`) REFERENCES `skillset` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
