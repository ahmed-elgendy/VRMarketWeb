-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2018 at 06:11 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id4848627_fprodata`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `country_id`) VALUES
(1, '6 october', 1),
(2, 'cairo', 1),
(4, 'Giza', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comments_id` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comments_date` date NOT NULL,
  `vr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comments_id`, `comments`, `status`, `comments_date`, `vr_id`, `user_id`) VALUES
(0, 'this hall is amazing ', 0, '2018-06-12', 37, 9);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'egypt'),
(2, 'malaysia'),
(3, 'kuwait'),
(4, 'china'),
(5, 'spain'),
(6, 'egypt'),
(7, 'malaysia'),
(8, 'kuwait'),
(9, 'china'),
(10, 'spain');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `favourite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`favourite_id`, `user_id`, `img_id`) VALUES
(68, 51, 1),
(69, 51, 1),
(70, 51, 1),
(71, 51, 1),
(72, 51, 1),
(73, 51, 1),
(74, 51, 2),
(75, 51, 1),
(76, 51, 1),
(77, 51, 1),
(81, 51, 1),
(82, 51, 1),
(83, 51, 1),
(84, 51, 1),
(85, 51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `email`, `message`) VALUES
(1, 'ahmedredadev@gmail.c', 'ahmed reda'),
(2, 'ahmedredadev@gmail.c', 'Fuck the project '),
(3, 'ahmedredadev@gmail.c', '   '),
(4, 'rotaq10@gmail.com', 'i am mohamed tarek'),
(5, 'ahmedtariq186@gmail.', 'done work !!!!!');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `normal_img_url` varchar(2000) NOT NULL,
  `single_img_url` varchar(2000) NOT NULL,
  `multi_img_url` varchar(2000) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `city_id` int(11) NOT NULL,
  `stars` int(1) NOT NULL,
  `price` int(100) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`img_id`, `img_name`, `normal_img_url`, `single_img_url`, `multi_img_url`, `description`, `city_id`, `stars`, `price`, `parent`) VALUES
(1, 'Dar El-Qamar', 'https://scontent-cai1-1.xx.fbcdn.net/v/t31.0-8/10848918_442742075879524_6851582210560850238_o.jpg?_nc_cat=0&oh=3cbf6060832e662218d6b66c7649fd78&oe=5BBBCB5D', 'https://rotq4all.000webhostapp.com/vtour2/vtour/tour.html', 'https://rotq4all.000webhostapp.com/vr%20sections/wedding-hall4/vtour/tour.html', 'The address : El Mokhtar Village - Mahor Services 5th & 6th District - Beside October Traffic.\r\nTelephone: 0120 789 1818', 1, 4, 2000, 0),
(2, 'Lavie & Farhaty', 'https://scontent-cai1-1.xx.fbcdn.net/v/t1.0-9/14523255_1058729660905171_1643298031661139225_n.jpg?_nc_cat=0&oh=7de1e4f098d9e8b77522c26aaebbc1fe&oe=5B88C1D3', 'https://rotq4all.000webhostapp.com/vtour2/vtour/tour.html', 'https://rotq4all.000webhostapp.com/vr%20sections/wedding-hall4/vtour/tour.html', 'The address: El Adweya st. El Khalafawy St. Off Corniche El Nil El Nasr Club For Import , Cairo.\r\nTelephone: 01010695037\r\n', 4, 4, 2100, 0),
(6, 'Dar El-Qamar', 'https://scontent-cai1-1.xx.fbcdn.net/v/t31.0-8/10848918_442742075879524_6851582210560850238_o.jpg?_nc_cat=0&oh=3cbf6060832e662218d6b66c7649fd78&oe=5BBBCB5D', 'https://rotq4all.000webhostapp.com/vtour2/vtour/tour.html', 'https://rotq4all.000webhostapp.com/vr%20sections/wedding-hall4/vtour/tour.html', 'The address : El Mokhtar Village - Mahor Services 5th & 6th District - Beside October Traffic.\r\nTelephone: 0120 789 1818', 4, 4, 2100, 0),
(8, 'Dar El-Qamar', 'https://scontent-cai1-1.xx.fbcdn.net/v/t31.0-8/10848918_442742075879524_6851582210560850238_o.jpg?_nc_cat=0&oh=3cbf6060832e662218d6b66c7649fd78&oe=5BBBCB5D', 'https://rotq4all.000webhostapp.com/vtour2/vtour/tour.html', 'https://rotq4all.000webhostapp.com/vr%20sections/wedding-hall4/vtour/tour.html', 'The address : El Mokhtar Village - Mahor Services 5th & 6th District - Beside October Traffic.\r\nTelephone: 0120 789 1818', 4, 4, 22100, 0),
(9, 'Lavie & Farhaty', 'https://scontent-cai1-1.xx.fbcdn.net/v/t1.0-9/14523255_1058729660905171_1643298031661139225_n.jpg?_nc_cat=0&oh=7de1e4f098d9e8b77522c26aaebbc1fe&oe=5B88C1D3', 'https://rotq4all.000webhostapp.com/vtour2/vtour/tour.html', 'https://rotq4all.000webhostapp.com/vr%20sections/wedding-hall4/vtour/tour.html', 'The address: El Adweya st. El Khalafawy St. Off Corniche El Nil El Nasr Club For Import , Cairo.\r\nTelephone: 01010695037\r\n', 4, 4, 332100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `Loc_ID` int(11) NOT NULL,
  `Loc_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Loc_ID`, `Loc_Name`) VALUES
(4, 'Cairo'),
(6, 'Alex'),
(8, 'Giza');

-- --------------------------------------------------------

--
-- Table structure for table `Music_band`
--

CREATE TABLE `Music_band` (
  `music_band_id` int(11) NOT NULL,
  `singer_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `music_band_img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `music_band_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Music_band`
--

INSERT INTO `Music_band` (`music_band_id`, `singer_name`, `music_band_img`, `music_band_description`) VALUES
(1, 'oka w ortiga', 'http://3.bp.blogspot.com/-xgKmCRmKUyg/VIA70KAucyI/AAAAAAAABa0/-SnEQilwGeg/s1600/39.jpg', 'Our music package : https://www.dndnha.com/singer/27-%D8%A7%D8%BA%D8%A7%D9%86%D9%89-%D8%A7%D9%88%D9%83%D8%A7-%D9%88%D8%A7%D9%88%D8%B1%D8%AA%D9%8A%D8%AC%D8%A7.html\r\nContact us : 01119104244'),
(2, 'oka w ortiga', 'http://3.bp.blogspot.com/-xgKmCRmKUyg/VIA70KAucyI/AAAAAAAABa0/-SnEQilwGeg/s1600/39.jpg', 'Our music package : https://www.dndnha.com/singer/27-%D8%A7%D8%BA%D8%A7%D9%86%D9%89-%D8%A7%D9%88%D9%83%D8%A7-%D9%88%D8%A7%D9%88%D8%B1%D8%AA%D9%8A%D8%AC%D8%A7.html\r\nContact us : 01119104244'),
(3, 'Tamer hosny', 'https://img.youm7.com/ArticleImgs/2017/5/19/30476-%D8%AD%D9%81%D9%84-%D8%AA%D8%A7%D9%85%D8%B1-%D8%AD%D8%B3%D9%86%D9%89-%D9%81%D9%89-%D9%85%D9%87%D8%B1%D8%AC%D8%A7%D9%86-%D9%85%D9%88%D8%A7%D8%B2%D9%8A%D9%86-(17).jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `Photographer`
--

CREATE TABLE `Photographer` (
  `photographer_id` int(11) NOT NULL,
  `photographer_name` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `photographer_img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `photographer_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Photographer`
--

INSERT INTO `Photographer` (`photographer_id`, `photographer_name`, `photographer_img`, `photographer_description`) VALUES
(1, 'Mekky Photo', 'https://ejadjob.com/uploads/img/job/%D9%85%D8%B7%D9%84%D9%88%D8%A8-%D9%85%D8%B5%D9%88%D8%B1-%D9%84%D9%84%D8%B9%D9%85%D9%84-%D9%85%D8%B9-%D9%85%D9%86%D8%B8%D9%85%D8%A9.jpeg', 'Our Gallery : https://www.pinterest.com/blott17223/photo-wall-gallery/\r\nContact us : 01119104567');

-- --------------------------------------------------------

--
-- Table structure for table `star`
--

CREATE TABLE `star` (
  `star_id` int(11) NOT NULL,
  `num_stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `star`
--

INSERT INTO `star` (`star_id`, `num_stars`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `VR_ID` int(11) NOT NULL,
  `VR` varchar(1000) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`VR_ID`, `VR`, `Name`, `Address`, `loc_id`, `parent`) VALUES
(30, '<iframe class=\"thumb-img\"  src=\"app-files/index.html\" frameborder=\"0\" allowfullscreen data-token=\"Ns9kvu\"></iframe>', 'Marriott Mena House', 'محور 26 يوليو، محمد مظهر، الزمالك، الجيزة', 8, 0),
(31, '<iframe class=\"thumb-img\"  src=\"app-files/index.html\" frameborder=\"0\" allowfullscreen data-token=\"Ns9kvu\"></iframe>', 'Marriott Mena House sub1', 'محور 26 يوليو، محمد مظهر، الزمالك، الجيزة', 8, 30),
(32, '<iframe class=\"thumb-img\"  src=\"app-files/index.html\" frameborder=\"0\" allowfullscreen data-token=\"Ns9kvu\"></iframe>', 'Marriott Mena House sub2', 'محور 26 يوليو، محمد مظهر، الزمالك، الجيزة', 8, 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `token` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `RegStatus` binary(1) NOT NULL DEFAULT '\0',
  `Date` date NOT NULL,
  `GroupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `UserName`, `Password`, `Email`, `token`, `RegStatus`, `Date`, `GroupID`) VALUES
(50, 'eslam', 'essam', '', 'eslamessam555222@gmail.com', '', 0x00, '0000-00-00', 0),
(51, 'احمد رضا احمد', 'احمد', 'ahmedreda', 'ahmedredadev@gmail.com', '', 0x31, '0000-00-00', 0),
(54, 'marwaadel.cs ', 'marwaadel', '', 'marwaadel.cs@gmail.com', '', 0x31, '0000-00-00', 0),
(55, 'قييييي', 'رلبببب', '', 'eslamvjjrfnkiesc@gddff.com', '', 0x00, '0000-00-00', 0),
(56, 'ahmed sakr', 'ahmed', '', 'ahmed@gmail.com', '', 0x00, '0000-00-00', 0),
(58, 'ahmed', 'ahmed', '123456789A', 'atariq140296@gmail.com', '', 0x31, '0000-00-00', 0),
(59, 'nklnk', 'cccccc', '', 'ahmedtariq186@yahoo.com', '', 0x00, '0000-00-00', 0),
(60, 'cghh', 'fvbbbb', '', 'cbbb@yahoo.com', '', 0x00, '0000-00-00', 0),
(67, 'ahmed elgendy ', 'ahmed', 'king12345', 'aasakr123@gmail.com', 'vhmp78r6et', 0x31, '0000-00-00', 0),
(86, 'mohamed tarek', 'rotaq', '12345678Am', 'rotaq10@gmail.com', '', 0x31, '2018-06-30', 0),
(87, 'ahmed tarek', 'hero96', '123456789', 'ahmedtariq186@gmail.com', '', 0x31, '2018-06-30', 0),
(91, 'gggfddfghh', 'ggfffd', 'ggffddfgggfdd', 'vcbvncv@yahoo.com', 'rkm7c9hnbu', 0x30, '2018-06-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Wedding_car`
--

CREATE TABLE `Wedding_car` (
  `car_id` int(11) NOT NULL,
  `car_model` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `car_img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `car_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Wedding_car`
--

INSERT INTO `Wedding_car` (`car_id`, `car_model`, `car_img`, `car_description`) VALUES
(1, 'Mercedes', 'http://1.bp.blogspot.com/--ulT6IjMyGM/T70vtBCOVvI/AAAAAAAAA4M/MqQm9OtDFZM/s1600/DSCF0740.JPG', 'عربية مرسيدس \r\nالوان : احمر و ازرق \r\nالساعه : 300 جنيه\r\nملحوظة : سوف تمضي ع وصل امانة بتمن العربية \r\nللتواصل : 01119104243'),
(3, 'Mercedes', 'http://1.bp.blogspot.com/--ulT6IjMyGM/T70vtBCOVvI/AAAAAAAAA4M/MqQm9OtDFZM/s1600/DSCF0740.JPG', 'mercedes mercedes mercedes'),
(4, 'Mercedes', 'http://1.bp.blogspot.com/--ulT6IjMyGM/T70vtBCOVvI/AAAAAAAAA4M/MqQm9OtDFZM/s1600/DSCF0740.JPG', 'mercedes mercedes full');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`favourite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `multi_img_id` (`img_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `stars` (`stars`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`Loc_ID`);

--
-- Indexes for table `Music_band`
--
ALTER TABLE `Music_band`
  ADD PRIMARY KEY (`music_band_id`);

--
-- Indexes for table `Photographer`
--
ALTER TABLE `Photographer`
  ADD PRIMARY KEY (`photographer_id`);

--
-- Indexes for table `star`
--
ALTER TABLE `star`
  ADD PRIMARY KEY (`star_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`VR_ID`),
  ADD KEY `vr_loc` (`loc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`FullName`);

--
-- Indexes for table `Wedding_car`
--
ALTER TABLE `Wedding_car`
  ADD PRIMARY KEY (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `favourite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `Loc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Music_band`
--
ALTER TABLE `Music_band`
  MODIFY `music_band_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Photographer`
--
ALTER TABLE `Photographer`
  MODIFY `photographer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `star`
--
ALTER TABLE `star`
  MODIFY `star_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `VR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `Wedding_car`
--
ALTER TABLE `Wedding_car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`img_id`) REFERENCES `image` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `image_ibfk_2` FOREIGN KEY (`stars`) REFERENCES `star` (`star_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `vr_loc` FOREIGN KEY (`loc_id`) REFERENCES `location` (`Loc_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
