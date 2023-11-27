-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 10:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartmint`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(200) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `profile_photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `first_name`, `last_name`, `birthdate`, `email`, `password`, `profile_photo`) VALUES
(2, 'Apartmint', 'Group(PVT)', '2022-10-05', 'admin@gmail.com', '$2y$10$NgIkwbEgA0WIxRURoICJZO6i4uT/k95/TB7hLfegPSAHuEGBsN.8.', 'a1a619c2150ec218f34221eb9b1a0422.jpg'),
(10, 'Shashimal', 'Jayasekara', '2000-06-20', 'admin1@gmail.com', '$2y$10$l41yoxeqnr1e4cIu0OJeqeC7.rTiNm4xvM.eSU0PzCaKCsL7xdt7e', 'cute-7441224_640.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_web`
--

CREATE TABLE `feedback_web` (
  `feedback_web_id` int(100) NOT NULL,
  `feedback_rating` int(100) NOT NULL,
  `feedback_name` varchar(1000) NOT NULL,
  `feedback_head` varchar(1500) NOT NULL,
  `feedback_discription` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_web`
--

INSERT INTO `feedback_web` (`feedback_web_id`, `feedback_rating`, `feedback_name`, `feedback_head`, `feedback_discription`, `date`) VALUES
(23, 4, 'Kavindu Thennakoon', 'Excellent Experience', 'Nulla facilisi. Integer vestibulum bibendum turpis, nec convallis risus vestibulum id. Fusce eget tempus ex.', '2023-11-05'),
(24, 5, 'Shasimal Jayarathna', 'Highly Recommend', 'Phasellus et nunc at ligula semper congue. In hac habitasse platea dictumst. Nam euismod viverra ligula nec tincidunt.', '2023-11-05'),
(28, 4, 'Ashan Hasendra', 'Seamless Experience with ApartMint!', 'I recently used ApartMint to find my dream apartment, and the experience was incredibly smooth. The platform\'s user-friendly interface made browsing listings a breeze, and the detailed property information helped me make an informed decision. The integrated chat feature also allowed me to communicate with sellers effortlessly. Overall, ApartMint provided a seamless and efficient apartment hunting experience.', '2023-11-27'),
(29, 5, 'Chamoth Gunaarathana', 'Exceptional Customer Support on ApartMint', 'ApartMint boasts an extensive range of apartment listings, catering to various preferences and budgets. The platform\'s diverse options made it easy for me to explore different neighborhoods and find the perfect home. The filtering options are robust, ensuring I could narrow down my search efficiently.', '2023-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `listing_details`
--

CREATE TABLE `listing_details` (
  `id` int(50) NOT NULL,
  `user_id` int(100) NOT NULL,
  `listing_type` varchar(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `property_type` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(100) NOT NULL,
  `total_units` int(11) NOT NULL,
  `bedrooms` int(20) NOT NULL,
  `bathrooms` int(20) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `size` int(20) NOT NULL,
  `features` text NOT NULL,
  `kitchen` text NOT NULL,
  `outdoor_spaces` text NOT NULL,
  `living_spaces` text NOT NULL,
  `utilities` text NOT NULL,
  `li_image` varchar(1800) NOT NULL,
  `description` text NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `p_no` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `approval_status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listing_details`
--

INSERT INTO `listing_details` (`id`, `user_id`, `listing_type`, `title`, `property_type`, `address`, `city`, `total_units`, `bedrooms`, `bathrooms`, `price`, `size`, `features`, `kitchen`, `outdoor_spaces`, `living_spaces`, `utilities`, `li_image`, `description`, `f_name`, `l_name`, `email`, `p_no`, `date`, `approval_status`) VALUES
(52, 14, 'Sale', 'ELEMINT SUITES - GAMPAHA', 'Single Family Home', 'No 86, Hettiyawatta Rd, Gampaha', 'Gampaha', 2, 4, 3, 26400000, 2200, 'Air Conditioning, Cable Ready, Storage Space, Washer/Dryer, Heating, Security System, Ceiling Fans, Double Vanities, High Speed Internet Access, Satellite TV, Tub/Shower, Surround Sound, Wi-Fi, Smoke Free', 'Dishwasher, Disposal, Microwave, Eat-in Kitchen, Oven, Stainless Steel Appliances, Coffee System, Dishwasher, Freezer, Pantry', 'Balcony, Yard, Grill, Garden, Patio, Porch', 'Bay Window, Tile Floors, Crown Molding, Sunroom, Views, Dining Room, Double Pane Windows, Family Room, Furnished, Loft Layout, Office, Wet Bar, Large Bedrooms', '', 'uploads/listings_photoes/230714200709Lake_View.jpg,uploads/listings_photoes/230714200719Type_A.jpg,uploads/listings_photoes/230714200730Type_B.jpg,uploads/listings_photoes/230714200700Type_C.jpg,uploads/listings_photoes/230714200710Type_D.jpg,uploads/listings_photoes/230714200719Type_E.jpg,uploads/listings_photoes/230714200705Type_G.jpg', 'Welcome to Elemint Suites by Prime Lands an exquisite housing project nestled in the heart of Gampaha. With a captivating scenic lake view. Our project offers a collection of six types of individual houses ranging from single-story to two-story designed to cater to your every need. Choose from our 2 or 3-bedroom houses each thoughtfully crafted to provide a comfortable and modern living experience, with sizes ranging from 855 square feet to 1974 square feet.\r\n\r\n\r\n\r\nImmerse yourself in the following amenities\r\n\r\n\r\n\r\nScenic Lake View\r\nOpen Gym\r\nJogging Track \r\nVibrant Kids Play Area\r\n\r\n\r\nConvenience is at the core of Elemint Suites\r\n\r\n\r\n\r\nLocated facing the Gampaha-Colombo main road\r\nJust 1KM away from the Colombo-Kandy main road\r\nEnsuring easy access to major transportation routes\r\nClose to leading schools in Gampaha\r\n\r\n\r\nElemint Suites is conveniently located near Gampaha secretarial office, hospitals, and railway station. Enjoy urban living with easy access to supermarkets and banks. Future connectivity through a proposed highway entrance.\r\n\r\nDiscover a harmonious blend of comfort, convenience, and natural beauty at Verdant Suites. Your dream home awaits, where every moment is filled with serenity and joy', 'Chethiya', 'Bandaranayake', 'user1@gmail.com', '0776921655', '2023-11-26 09:27:11', 'Approved'),
(53, 14, 'Sale', 'Luxury house for sale in Sri Lanka', 'Single Family Home', 'No 26, Pepiliyana Mawatha, Colombo, Sri Lanka', 'Colombo', 2, 6, 5, 170000000, 7100, 'Air Conditioning, Cable Ready, Fireplace, Storage Space, Washer/Dryer, Washer/Dryer Hookup, Double Vanities, High Speed Internet Access, Satellite TV, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi, Framed Mirrors, Handrails', 'Disposal, Microwave, Eat-in Kitchen, Refrigerator, Oven, Coffee System, Freezer, Pantry, Warming Drawer', 'Balcony, Yard, Grill, Deck, Dock, Garden, Patio, Porch', 'Bay Window, Tile Floors, Crown Molding, Sunroom, Views, Basement, Furnished, Linen Closet, Office, Skylights, Wet Bar, High Ceilings', '', 'uploads/listings_photoes/Capture.JPG,uploads/listings_photoes/Capture1.JPG,uploads/listings_photoes/Capture2.JPG,uploads/listings_photoes/Capture3.JPG,uploads/listings_photoes/Capture4.JPG,uploads/listings_photoes/Capture6.JPG,uploads/listings_photoes/Capture7.JPG', 'HIGHLY RESIDENTIAL AREA\r\n\r\nFace to 20 Feet Road. \r\n\r\n \r\n\r\n walking distance to neugegoda rathmalana bus road \r\n\r\n \r\n\r\n👉 6 BEDROOMS WITH A/C\r\n\r\n👉 5 BATHROOMS WITH HOT WATER\r\n\r\n👉 27 PERCHES\r\n\r\n👉 7100 SQF\r\n\r\n \r\n\r\nGROUND FLOOR \r\n\r\n************\r\n\r\n1 bedroom\r\n\r\n1 bathroom\r\n\r\nLarge Spacious Living area with sofa set. \r\n\r\nDining Area with a dining table\r\n\r\nSitting Area\r\n\r\npantry with granite top fited cupboard 4 burner cooker hood an important dinnig table and chairs\r\n\r\nseparate wet kitchen \r\n\r\nmaids room and drivers quarters\r\n\r\nGarage  \r\n\r\nLandscape Gardens Front And Back. \r\n\r\n \r\n\r\n1 st FLOOR\r\n\r\n********** \r\n\r\n4 bedrooms (2 master bedrooms)\r\n\r\n3 attachched bathroom and commen bathroom\r\n\r\nLarge Spacious Living area.\r\n\r\nTv loby with 2 sofa sets\r\n\r\nSpacious Living area \r\n\r\nBalconies \r\n\r\n \r\n\r\n2nd floor\r\n\r\n*********\r\n\r\n1 bedroom\r\n\r\n1 bathroom\r\n\r\nlarge roof terance\r\n\r\nseparete balcony\r\n\r\n \r\n\r\ntimber used for doors\r\n\r\n10 more vehicle parking space\r\n\r\n \r\n\r\n14 CCTV CAMERAS\r\n\r\n25 KV SOLAR PANEL\r\n\r\nGENARATOR (SOUND PROOF 12KVA)\r\n\r\nSLT LANDLINE\r\n\r\nVIDEOCON DISH TV\r\n\r\nBRICK WALLS\r\n\r\nOVERHEAD 2 WATER TANK\r\n\r\nELECTRICITY\r\n\r\nROLLAR SHUTTER\r\n\r\nWICKET GATE\r\n\r\nTAP LINE WATER\r\n\r\nLANDSCAPE GARDEN\r\n\r\nLAUNDRY AREA\r\n\r\nCOMMON BATHROOM\r\n\r\n \r\n\r\nFURNITURE\r\n\r\n**********\r\n\r\n3 imported sofa sets\r\n\r\n2 imported dinnig sets\r\n\r\n3 refrigeratorrs\r\n\r\n2 televisions\r\n\r\ndryers\r\n\r\nbeds and cupboards\r\n\r\n \r\n\r\nClose to - cargils Food city,Supermarket, Government and International Bank & School. \r\n\r\n \r\n\r\nPrice\r\n\r\n170 Million\r\n\r\n(1700 lakhs) \r\n\r\nNegotiable \r\n\r\nCall for Seen on appointments Genuine Buyers Only.\r\n\r\nNO BROKERS', 'Chethiya', 'Bandaranayake', 'user1@gmail.com', '0776921655', '2023-11-26 19:38:00', 'Approved'),
(54, 14, 'Rent', 'Luxury apartment for rent in Sri Lanka', 'Apartment', 'No 96,Battaramulla,Colombo.', 'Colombo', 1, 3, 2, 170000, 1350, 'Air Conditioning, Storage Space, Heating, Security System, Double Vanities, Satellite TV, Tub/Shower, Wi-Fi, Framed Mirrors, Handrails, Smoke Free, Vacuum System, Wheelchair Accessible', 'Dishwasher, Disposal, Microwave, Eat-in Kitchen, DishBreakfast Nook, Coffee System, Freezer, Instant Hot Water, Pantry', 'Balcony, Yard, Grill, Deck, Dock, Porch', 'Bay Window, Tile Floors, Sunroom, Carpeten, Built-In Bookshelves, Dining Room, Family Room, Furnished, Office, Skylights, High Ceilings, Large Bedrooms', 'Gas, Cable, Water, Air Conditioning, Electricity', 'uploads/listings_photoes/Capture11.JPG,uploads/listings_photoes/Capture14.JPG,uploads/listings_photoes/Capture8.JPG,uploads/listings_photoes/Capture9.JPG,uploads/listings_photoes/Capture12.JPG,uploads/listings_photoes/Capture10.JPG,uploads/listings_photoes/Capture13.JPG', 'Prime Libra - 3 Rooms Furnished Apartment for Rent\r\n\r\n\r\n- Denzil Kobbekaduwa Mawatha\r\n- Prime Libra\r\n- 3 Bedrooms\r\n- 2 Bathrooms\r\n- Maids room / bathroom\r\n- Higher Floor\r\n- 1,350 Sq.ft\r\n- Furnished\r\n- Gym / Pool\r\n- City View\r\n\r\n- Rent Rs: 170,000/- (negotiable)', 'Chethiya', 'Bandaranayake', 'user1@gmail.com', '0776921655', '2023-11-27 08:00:28', 'Approved'),
(55, 14, 'Sale', '04 Bedroom House for Sale in Moratuwa', 'Single Family Home', '500/2/1, Lake Rd, Moratuwa', 'Moratuwa', 2, 4, 2, 430000000, 2860, 'Air Conditioning, Fireplace, Washer/Dryer, Heating, Ceiling Fans, High Speed Internet Access, Surround Sound, Framed Mirrors, Trash Compactor', '', 'Balcony, Grill, Garden, Lawn, Patio', 'Sunroom, Attic, Den, Dining Room, Double Pane Windows, Family Room, Furnished, Linen Closet, Loft Layout, Office, Wet Bar', 'Gas, Heat, Water, Electricity', 'uploads/listings_photoes/Capture20.JPG,uploads/listings_photoes/Capture15.JPG,uploads/listings_photoes/Capture16.JPG,uploads/listings_photoes/Capture17.JPG,uploads/listings_photoes/Capture18.JPG,uploads/listings_photoes/Capture19.JPG,uploads/listings_photoes/Capture21.JPG', '04 Bedroom House for Sale in Moratuwa \r\n\r\n- Moratuwa \r\n- Demal Road\r\n- 10.5 Perches\r\n- 2860 Sq. ft\r\n- 2 Stories\r\n- 4 Bedrooms\r\n- 2 Washrooms\r\n- Furnished\r\n- Air-conditioned\r\n- 3 Parking spaces\r\n\r\n- Price Rs: 43 million (negotiable)\r\n\r\n- Property Code: HL27491', 'Chethiya', 'Bandaranayake', 'user1@gmail.com', '0776921655', '2023-11-27 09:34:59', 'Approved'),
(56, 15, 'Sale', 'මනරම් පරිසරයක පිහිටි ලස්සන අලුත් දෙමහල් නිවසක් විකිණීමට තලවතුගොඩ', 'Single Family Home', '60/3/2, Talawatugoda, Colombo', 'Colombo', 2, 5, 4, 195000000, 7000, 'Air Conditioning, Cable Ready, Storage Space, Ceiling Fans, Double Vanities, Satellite TV, Surround Sound, Framed Mirrors, Handrails, Smoke Free, Vacuum System', 'Disposal, Microwave, Eat-in Kitchen, Oven, Range, Coffee System, Freezer, Pantry', 'Balcony, Yard, Grill, Garden', 'Bay Window, Vaulted Ceiling, Sunroom, Carpeten, Furnished, Loft Layout, Mud Room, Office', 'Gas, Water, Air Conditioning, Electricity', 'uploads/listings_photoes/75212.PNG,uploads/listings_photoes/Capture.PNG,uploads/listings_photoes/Capture545452.PNG,uploads/listings_photoes/4545454.PNG,uploads/listings_photoes/Capture6464.PNG,uploads/listings_photoes/Capture4646.PNG,uploads/listings_photoes/e20ee48e4d9f45ff8c3cd57479992449 (1).jpg', 'Brand New Super Luxury Modern House for Sale Talawatugoda\r\n\r\n20 Perches Large Land & 7000 SQ Ft\r\n\r\n15 Ft Road\r\n\r\n100 M to Hokandar Road\r\n\r\n1 Km to Hokandara Junction\r\n\r\n1.8 Km To Talawatugoda\r\n\r\n5 Bedrooms (All Rooms Attached Bathrooms With A/ C & Fully Furnished )\r\n\r\n5 Bathrooms( With Solar Hot Water )\r\n\r\nServant Room & Bathroom\r\n\r\nModern Pantry\r\n\r\nSpacious Living / Dining\r\n\r\nSwimming Pool\r\n\r\nRoof Top\r\n\r\nCCTV\r\n\r\nGenerator \r\n\r\nOverhead Water Tank\r\n\r\nPipe Born Water\r\n\r\nElectricity\r\n\r\nRemote Roller Shutter & Wicket Gate\r\n\r\nClose to : Koswatta , Battaramulla , Rajagiriya', 'Hashini', 'Weerasinghe', 'user2@gmail.com', '0788249018', '2023-11-27 13:05:31', 'Pending'),
(57, 15, 'Rent', 'Single Room for rent in Colombo', 'Single Room', '500/2/1,Grenview,Rathkarawwa,Maspotha.', 'Colombo', 1, 1, 1, 15000, 300, 'Air Conditioning, Cable Ready, High Speed Internet Access, Satellite TV, Sprinkler System', 'Microwave, Refrigerator, Oven, Range, DishBreakfast Nook', 'Balcony, Yard, Dock, Garden, Patio, Porch', 'Basement, Den, Dining Room, Double Pane Windows', 'Gas, Water, Electricity', 'uploads/listings_photoes/fitted (33).jpg,uploads/listings_photoes/fitted (32).jpg,uploads/listings_photoes/fitted (34).jpg,uploads/listings_photoes/fitted (31).jpg,uploads/listings_photoes/fitted (14).jpg,uploads/listings_photoes/fitted (8).jpg,uploads/listings_photoes/fitted.jpg', '- Denzil Kobbekaduwa Mawatha\r\n\r\n- Prime Libra\r\n\r\n- 3 Bedrooms\r\n\r\n- 2 Bathrooms\r\n\r\n- Maids room / bathroom\r\n\r\n- Higher Floor\r\n\r\n- 1,350 Sq.ft\r\n\r\n- Furnished\r\n\r\n- Gym / Pool\r\n\r\n- City View', 'Hashini', 'Weerasinghe', 'user2@gmail.com', '0788249018', '2023-11-27 13:17:45', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `birthdate`, `email`, `password`, `profile_photo`) VALUES
(14, 'Chethiya', 'Bandaranayaka', '2001-03-30', 'user1@gmail.com', '$2y$10$eXZ.FM02ifCo8H9Ki94T3e3Jh93PBFVzT2w4wKFOcY2EbHY/BblMK', 'c81808e76c6546a757525a642a1b3023.jpg'),
(15, 'Hashini', 'Wekkramsinhe', '2004-06-17', 'user2@gmail.com', '$2y$10$282jAY33jgYdTGOxSPyeQeuI/7./5GYn7ScE1o2HyB/LJsuQdOhMS', 'images152154545.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `feedback_web`
--
ALTER TABLE `feedback_web`
  ADD PRIMARY KEY (`feedback_web_id`);

--
-- Indexes for table `listing_details`
--
ALTER TABLE `listing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id & listing_detail_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback_web`
--
ALTER TABLE `feedback_web`
  MODIFY `feedback_web_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `listing_details`
--
ALTER TABLE `listing_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listing_details`
--
ALTER TABLE `listing_details`
  ADD CONSTRAINT `user_id & listing_detail_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
