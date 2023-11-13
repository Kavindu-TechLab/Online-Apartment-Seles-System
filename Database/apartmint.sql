-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 06:10 AM
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
(2, 'Apartmint', 'Group(PVT)', '2022-10-05', 'admin@gmail.com', '$2y$10$NgIkwbEgA0WIxRURoICJZO6i4uT/k95/TB7hLfegPSAHuEGBsN.8.', 'WhatsApp Image 2023-11-08 at 20.06.12_0691dae7.jpg');

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
(24, 5, 'Shasimal Jayarathna', 'Highly Recommend', 'Phasellus et nunc at ligula semper congue. In hac habitasse platea dictumst. Nam euismod viverra ligula nec tincidunt.', '2023-11-05');

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
(35, 9, 'Sale', 'Smart Controlled Super Luxury New Beautiful House', 'Single Family Home', '500/2/1,Grenview,Rathkarawwa,Maspotha.', 'Kurunegala', 1, 2, 2, 86500000, 3000, 'Air Conditioning, Cable Ready, Fireplace, Storage Space, Washer/Dryer, Washer/Dryer Hookup, Heating, Security System, Ceiling Fans, Double Vanities, High Speed Internet Access, Satellite TV, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi, Framed Mirrors, Handrails, Intercom, Smoke Free, Trash Compactor, Vacuum System', 'Dishwasher, Disposal, Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Refrigerator, Oven, Stainless Steel Appliances, Range, Coffee System, Dishwasher, Freezer, Instant Hot Water, Island Kitchen, Pantry, Warming Drawer', 'Balcony, Yard, Grill, Deck, Dock, Garden, Greenhouse, Lawn, Patio, Porch', 'Bay Window, Tile Floors, Crown Molding, Vaulted Ceiling, Sunroom, Views, Walk-In Closets, Attic, Basement, Built-In Bookshelves, Den, Dining Room, Double Pane Windows, Family Room, Furnished, Linen Closet, Loft Layout, Mother-in-law Unit, Mud Room, Office, Recreation Room, Skylights, Vinyl Flooring, Wet Bar, Window Coverings, Workshop, High Ceilings, Large Bedrooms', '', 'uploads/listings_photoes/user (3).png,uploads/listings_photoes/profile-user.png,uploads/listings_photoes/user (2).png,uploads/listings_photoes/filter.png,uploads/listings_photoes/user (1).png,uploads/listings_photoes/,uploads/listings_photoes/', 'Super Luxury Smart Controlled House For Sale In Nugegoda Mirihana\r\n\r\nLocated in a Serene, Secure and a Highly Residential Environment in Nugegoda Mirihana area, which is ideal for Exemplary Living.\r\n\r\nProperty Features:-\r\n\r\n5 Spacious Bedrooms with A/C.\r\n\r\n3 Fully Equipped Bathrooms with Solar Hot Water.\r\n\r\nFloor Area - 3,000+ Sqft.\r\n\r\nLand Extent - 11.5 Perches.\r\n\r\nFully Air-Conditioned house with Solar Electricity & Solar Hot-Water.\r\n\r\nSpacious Living area with Double Height Open to 1st Floor with mirror.\r\n\r\nEntire house is solar operated with 20 panels. \r\n\r\nSmart operated house - Light Switches (Inside/Outside) & All the Air-Conditioned units (Entire house with 6 AC Units).\r\n\r\nCCTV is also smart operated. (Mobile Phone)\r\n\r\nFinished Black Granite flooring & dining.\r\n\r\nModern pantry kitchen - With Double Door side by Side Fridge, BOSCH Oven, BOSCH Dish Washer, SHARP Microwave Oven, BOSCH 4 Burner Hob, Cooker Hood, German BLANCO Sink.\r\n\r\nServant room with bathroom.\r\n\r\nLaundry room.\r\n\r\nMaster bedroom with Attached bathroom and Kumbuk flooring.\r\n\r\nEntire house with Sun Bird Solar hot water.\r\n\r\nSolid house with 9 inch brick walls & entire house with Jack Wood Doors /Windows/ Frames.\r\n\r\n Kumbuk staircase.\r\n\r\n Thick curtains installed. \r\n\r\n This Area has NO POWER CUTS. \r\n\r\n\r\n\r\nDon’t miss this valuable chance. ', 'Susantha', 'Jayasekara', 'susantha1234@gmail.com', '0788249018', '2023-10-23 17:53:54', 'Rejected'),
(36, 5, 'Sale', 'Luxury 02 Storey House', 'Single Family Home', 'No 86, Mahakeliya,Mhakeliya', 'Kurunegala', 5, 4, 2, 95000000, 5200, 'Air Conditioning, Cable Ready, Fireplace, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi, Intercom, Smoke Free, Vacuum System, Wheelchair Accessible', 'Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Stainless Steel Appliances, DishBreakfast Nook, Coffee System, Dishwasher, Instant Hot Water', 'Balcony, Yard, Grill, Garden, Lawn, Patio, Porch', 'Tile Floors, Crown Molding, BungHardwood Floors, Vaulted Ceiling, Sunroom, Views, Walk-In Closets, Double Pane Windows, Family Room, Furnished, Linen Closet, Loft Layout, Window Coverings, Workshop, High Ceilings', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Trash Removal, Electricity', 'uploads/listings_photoes/fitted (8).jpg,uploads/listings_photoes/fitted (14).jpg,uploads/listings_ph', 'HIGHLY RESIDENTIAL AREA\r\n\r\nFace to 20 Feet Road. \r\n\r\n-4 BEDROOMS \r\n\r\n-4 BATHROOMS WITH HOT WATER\r\n\r\n-10 PERCHES\r\n\r\n-3000 SQFT\r\n\r\n=================================\r\n\r\nMeticulously maintained luxury house conveniently located only 100 meters away from the Nawala Road, within close proximity to all modern day conveniences. The house offers extensAive living space along with four bedrooms and four bathrooms.\r\n\r\nThe house is currently fully furnished and can be offered for sale with or without the high quality furniture & fittings.\r\n\r\nFeatures include a spacious living & dining area, TV lounge, separate pantry and wet kitchen, outdoor terrace and landscaped garden. The master bedroom sits on the 1st floor, thoughtfully designed with a walk-in closet along and a spacious master bathroom. A well configured, beautifully designed family house in a quiet residential neighborhood.\r\n\r\n- Fully furnished, offered for sale with or without furniture & fittings.\r\n\r\n- Four spacious bedrooms. All bedrooms equipped with A/C.\r\n\r\n- Four bathrooms equipped with solar powered hot water.\r\n\r\n- Separate pantry and wet kitchen both equipped with fitted cupboards & built-in cooker.\r\n\r\n- Upstairs TV lounge. Separate utility / office room & prayer room.\r\n\r\n- Landscaped rear garden.\r\n\r\n- Separate maids bedroom & bathroom with service entrance.\r\n\r\n- Electric roller garage door with two covered parking spaces.\r\n\r\n- Solar powered electricity generation system.\r\n\r\nViewings can be arranged by prior appointment only.\r\n\r\nPrincipal buyers only. No agents please.\r\n\r\n950lks', 'Chamod', 'Weerasinghe', 'kavindu200109@gmail.com', '0776921655', '2023-10-23 18:16:02', 'Approved'),
(37, 5, 'Rent', 'Super Luxury Brand New 4 BR All Completed House', 'Single Family Home', 'No 96, Parakumba Rd, Kurunegala.', 'Kurunegala', 5, 3, 1, 65000, 4500, 'Wi-Fi', 'Dishwasher, Disposal, Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Refrigerator, Oven, Stainless Steel Appliances, Range, Breakfast Nook, Coffee System, Dishwasher, Freezer, Instant Hot Water, Island Kitchen, Pantry, Warming Drawer, Dishwasher, Disposal, Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Refrigerator, Oven, Stainless Steel Appliances, Range, DishBreakfast Nook, Coffee System, Dishwasher, Freezer, Instant Hot Water, Island Kitchen, Pantry, Warming Drawer', 'Balcony, Yard, Grill, Deck, Dock, Garden, Greenhouse, Lawn, Patio, Porch', 'Bay Window, Tile Floors, Crown Molding, Vaulted Ceiling, Attic, Basement, Built-In Bookshelves, Den, Dining Room, Double Pane Windows, Loft Layout, Mud Room', '', 'uploads/listings_photoes/Capture6464.PNG,uploads/listings_photoes/Capture4646.PNG,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/', 'Brand New Luxury Single Story Fully Completed House For Sale \r\n\r\n------------------------------\r\n\r\n# 150M to Negombo - Divulapitiya (242) Bus Route\r\n\r\n# 250M to Negombo - Mirigama (251) Bus Route\r\n\r\n# 3Km to Negombo - Colombo Road ( A3 Putlam highway)\r\n\r\n# 3.5Km To Negombo Town\r\n\r\n# 10km High-Way Entrance Katunayake & Air Port\r\n\r\n# 12.5 Perches Land\r\n\r\n# Parapet Wall & Remote Roller Gate\r\n\r\n# Finishing Spot Roof, And Fully Tilled House, Double Height Wall House\r\n\r\n# 4 Bed Rooms\r\n\r\n# 2 Bath Rooms\r\n\r\n# Living Hall\r\n\r\n# Dinning Area\r\n\r\n# Kitchen With Luxury Pantry Cupboards  (With 4 Burners & Exhaust)\r\n\r\n# Wet Kitchen\r\n\r\n# Verandha    \r\n\r\n# Car Parking Space\r\n\r\n# Landscaped Garden\r\n\r\n# CCTV Camera, 4 Burners, Cooker Hood, Curtains, Bath Room Cubicles\r\n\r\n# Good Residential Area\r\n\r\n# Bank Loan Eligible\r\n\r\n# Clear Deeds & Documentation\r\n', 'Kavindu', 'Weera', 'kavindu200@gmail.com', '077692', '2023-10-23 18:39:00', 'Approved'),
(40, 5, 'Sale', '3 Bedroom Apartment for Rent in Wattala', 'Single Family Home', 'No 45, Nawala Rd, Wattala', 'Colombo', 2, 3, 1, 80000, 800, 'Washer/Dryer, Washer/Dryer Hookup, Heating, Security System, Surround Sound, Wi-Fi, Framed Mirrors, Handrails, Intercom, Trash Compactor, Vacuum System, Wheelchair Accessible', 'Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Oven, Range, DishBreakfast Nook, Instant Hot Water, Island Kitchen, Pantry', 'Balcony, Yard, Grill, Deck, Garden, Greenhouse, Lawn', 'BungHardwood Floors, Vaulted Ceiling, Views, Den, Dining Room, Double Pane Windows, Family Room, Furnished, Vinyl Flooring, Wet Bar, Window Coverings', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Trash Removal, Electricity', 'uploads/listings_photoes/Capture.PNG,uploads/listings_photoes/75212.PNG,uploads/listings_photoes/Capture6464.PNG,uploads/listings_photoes/Capture545452.PNG,uploads/listings_photoes/Capture4646.PNG,uploads/listings_photoes/4545454.PNG,uploads/listings_photoes/273b2acc8db22f91ad16e5d484d71125.jpg', 'Description\r\n• 3 Bedrooms (Master + 2)\r\n\r\n• 2 Bathrooms (1 en-suite + 1 common)\r\n\r\n• Monthly Maintenance fee excluded in the rent \r\n\r\n• 1265 Sq Ft.\r\n\r\n• Unfurnished \r\n\r\n• 2nd Floor\r\n\r\n• Hot water\r\n\r\n• 1 parking slot\r\n\r\n•  bathware and light fittings\r\n\r\n• SLT Fibre Optic connection \r\n\r\n \r\n\r\nApartment Facilities:\r\n\r\n \r\n\r\n• 24-hour Security\r\n\r\n• Large Rooftop Area with eye catching views of the Colombo skyline \r\n\r\n• Gym \r\n\r\n• Only 16 units in the apartment block \r\n\r\nSerene surroundings \r\n\r\nClose proximity to Schools, Hospitals and Supermarkets \r\n\r\n5 min drive, 20 min walk to Lyceum Wattala \r\n\r\n20 min drive to St Joseph’s College \r\n\r\n25 min drive to St Bridget’s Convent \r\n\r\n25 min drive to Royal College \r\n\r\n20 min drive to Fort/Kollupitiya  \r\n\r\n7 min drive to Hemas Hospital \r\n\r\n15 min drive to Kerawalapitiya Interchange ', 'Kavindu', 'Thennakoon', 'chamoth1245@gmail.com', '075212452', '2023-10-25 13:01:43', 'Approved'),
(45, 9, 'Sale', 'dffg', 'Single Family Home', '9', 'Kurunegala', 5, 6, 7, 4, 32323, 'Sprinkler System, Tub/Shower, Surround Sound', 'Stainless Steel Appliances, Range, DishBreakfast Nook', '', 'Den, Dining Room, Double Pane Windows', 'Water, Sewer, Air Conditioning', 'uploads/listings_photoes/property.png,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/', 'zjxj', 'Kavindu', 'Jayarathna', 'kavi86227@gmail.com', '0776921655', '2023-11-12 10:40:29', 'Pending'),
(47, 9, 'Sale', 'lcokflfkfl', 'Single Family Home', '9', 'Kurunegala', 5, 6, 7, 4, 32323, 'Sprinkler System, Tub/Shower, Surround Sound', 'Stainless Steel Appliances, Range, DishBreakfast Nook', '', 'Den, Dining Room, Double Pane Windows', 'Water, Sewer, Air Conditioning', 'uploads/listings_photoes/adjustment.png,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/', 'zjxj', 'Kavindu', 'Jayarathna', 'kavi86227@gmail.com', '0776921655', '2023-11-12 10:41:26', 'Pending'),
(49, 9, 'Sale', 'lcokflfkflxskjsikdjwidjwjijnbmnmnm', 'Single Family Home', '9', 'Kurunegala', 5, 6, 7, 4, 32323, 'Sprinkler System, Tub/Shower, Surround Sound', 'Stainless Steel Appliances, Range, DishBreakfast Nook', '', 'Den, Dining Room, Double Pane Windows', 'Water, Sewer, Air Conditioning', 'uploads/listings_photoes/calendar.png,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/,uploads/listings_photoes/', 'zjxj', 'Kavindu', 'Jayarathna', 'kavi86227@gmail.com', '0776921655', '2023-11-12 10:42:21', 'Pending');

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
(5, 'Chamoth', 'Jayarathna', '2004-06-22', 'kavindu200109@gmail.com', '$2y$10$Vmono9BmtAuUZIZzG0yTU.SUybolNzSQLGXOgjHcQrb5cevxPVWjW', 'download (3).jpeg'),
(7, 'Shasimali_Weerasinghe', 'Jayarathna', '2004-05-07', 'kavindu20010330@gmail.com', '$2y$10$GQfM9xxcVholBDgcwwBaoeMSB45pDoGgNcPyVLBjrXsfUvMfED33a', 'images (2).jpeg'),
(8, 'Chathurika', 'Yapa', '1972-03-13', 'chathurika1234@gmail.com', '$2y$10$BlxU4/6WW/.Rd7SliGG4T.OU0WU4vp7/V6iQtir3Fwwloa6K2hZda', 'images (2).jpeg'),
(9, 'Susantha', 'Jayasekara', '1988-10-18', 'susantha1234@gmail.com', '$2y$10$pVWuxGLYb8kqjumQjCLk8O09aXZZYOkQ.QncWcRvTs8Juk48s9JKy', 'download (2).jpeg');

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
  MODIFY `admin_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback_web`
--
ALTER TABLE `feedback_web`
  MODIFY `feedback_web_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `listing_details`
--
ALTER TABLE `listing_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
