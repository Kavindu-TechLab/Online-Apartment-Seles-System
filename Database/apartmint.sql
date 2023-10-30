-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 05:56 PM
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
  `li_image` varchar(800) NOT NULL,
  `description` text NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `p_no` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listing_details`
--

INSERT INTO `listing_details` (`id`, `user_id`, `listing_type`, `title`, `property_type`, `address`, `city`, `total_units`, `bedrooms`, `bathrooms`, `price`, `size`, `features`, `kitchen`, `outdoor_spaces`, `living_spaces`, `utilities`, `li_image`, `description`, `f_name`, `l_name`, `email`, `p_no`, `date`) VALUES
(35, 9, 'Sale', 'Smart Controlled Super Luxury New House', 'Single Family Home', '500/2/1,Grenview,Rathkarawwa,Maspotha.', 'Kurunegala', 1, 5, 2, 86500000, 3000, 'Air Conditioning, Cable Ready, Fireplace, Storage Space, Washer/Dryer, Washer/Dryer Hookup, Heating, Security System, Ceiling Fans, Double Vanities, High Speed Internet Access, Satellite TV, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi, Framed Mirrors, Handrails, Intercom, Smoke Free, Trash Compactor, Vacuum System, Wheelchair Accessible', 'Dishwasher, Disposal, Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Refrigerator, Oven, Stainless Steel Appliances, Range, DishBreakfast Nook, Coffee System, Dishwasher, Freezer, Instant Hot Water, Island Kitchen, Pantry, Warming Drawer', 'Balcony, Yard, Grill, Deck, Dock, Garden, Greenhouse, Lawn, Patio, Porch', 'Bay Window, Tile Floors, Crown Molding, BungHardwood Floors, Vaulted Ceiling, Sunroom, Views, Walk-In Closets, Carpeten, Attic, Basement, Basement, Built-In Bookshelves, Den, Dining Room, Double Pane Windows, Family Room, Furnished, Linen Closet, Loft Layout, Mother-in-law Unit, Mud Room, Office, Recreation Room, Skylights, Vinyl Flooring, Wet Bar, Window Coverings, Workshop, High Ceilings, Large Bedrooms', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Trash Removal, Electricity', 'uploads/listings_photoes/fitted.jpg,uploads/listings_photoes/fitted (1).jpg,uploads/listings_photoes', 'Super Luxury Smart Controlled House For Sale In Nugegoda Mirihana\n\nLocated in a Serene, Secure and a Highly Residential Environment in Nugegoda Mirihana area, which is ideal for Exemplary Living.\n\nProperty Features:-\n\n5 Spacious Bedrooms with A/C.\n\n3 Fully Equipped Bathrooms with Solar Hot Water.\n\nFloor Area - 3,000+ Sqft.\n\nLand Extent - 11.5 Perches.\n\nFully Air-Conditioned house with Solar Electricity & Solar Hot-Water.\n\nSpacious Living area with Double Height Open to 1st Floor with mirror.\n\nEntire house is solar operated with 20 panels. \n\nSmart operated house - Light Switches (Inside/Outside) & All the Air-Conditioned units (Entire house with 6 AC Units).\n\nCCTV is also smart operated. (Mobile Phone)\n\nFinished Black Granite flooring & dining.\n\nModern pantry kitchen - With Double Door side by Side Fridge, BOSCH Oven, BOSCH Dish Washer, SHARP Microwave Oven, BOSCH 4 Burner Hob, Cooker Hood, German BLANCO Sink.\n\nServant room with bathroom.\n\nLaundry room.\n\nMaster bedroom with Attached bathroom and Kumbuk flooring.\n\nEntire house with Sun Bird Solar hot water.\n\nSolid house with 9 inch brick walls & entire house with Jack Wood Doors /Windows/ Frames.\n\n Kumbuk staircase.\n\n Thick curtains installed. \n\n This Area has NO POWER CUTS. \n\n\n\nDon’t miss this valuable chance. ', 'Susantha', 'Jayasekara', 'susantha1234@gmail.com', '0788249018', '2023-10-23 17:53:54'),
(36, 5, 'Sale', 'Luxury 02 Storey House', 'Single Family Home', 'No 86, Mahakeliya,Mhakeliya', 'Kurunegala', 5, 4, 2, 95000000, 5200, 'Air Conditioning, Cable Ready, Fireplace, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi, Intercom, Smoke Free, Vacuum System, Wheelchair Accessible', 'Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Stainless Steel Appliances, DishBreakfast Nook, Coffee System, Dishwasher, Instant Hot Water', 'Balcony, Yard, Grill, Garden, Lawn, Patio, Porch', 'Tile Floors, Crown Molding, BungHardwood Floors, Vaulted Ceiling, Sunroom, Views, Walk-In Closets, Double Pane Windows, Family Room, Furnished, Linen Closet, Loft Layout, Window Coverings, Workshop, High Ceilings', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Trash Removal, Electricity', 'uploads/listings_photoes/fitted (8).jpg,uploads/listings_photoes/fitted (14).jpg,uploads/listings_ph', 'HIGHLY RESIDENTIAL AREA\r\n\r\nFace to 20 Feet Road. \r\n\r\n-4 BEDROOMS \r\n\r\n-4 BATHROOMS WITH HOT WATER\r\n\r\n-10 PERCHES\r\n\r\n-3000 SQFT\r\n\r\n=================================\r\n\r\nMeticulously maintained luxury house conveniently located only 100 meters away from the Nawala Road, within close proximity to all modern day conveniences. The house offers extensAive living space along with four bedrooms and four bathrooms.\r\n\r\nThe house is currently fully furnished and can be offered for sale with or without the high quality furniture & fittings.\r\n\r\nFeatures include a spacious living & dining area, TV lounge, separate pantry and wet kitchen, outdoor terrace and landscaped garden. The master bedroom sits on the 1st floor, thoughtfully designed with a walk-in closet along and a spacious master bathroom. A well configured, beautifully designed family house in a quiet residential neighborhood.\r\n\r\n- Fully furnished, offered for sale with or without furniture & fittings.\r\n\r\n- Four spacious bedrooms. All bedrooms equipped with A/C.\r\n\r\n- Four bathrooms equipped with solar powered hot water.\r\n\r\n- Separate pantry and wet kitchen both equipped with fitted cupboards & built-in cooker.\r\n\r\n- Upstairs TV lounge. Separate utility / office room & prayer room.\r\n\r\n- Landscaped rear garden.\r\n\r\n- Separate maids bedroom & bathroom with service entrance.\r\n\r\n- Electric roller garage door with two covered parking spaces.\r\n\r\n- Solar powered electricity generation system.\r\n\r\nViewings can be arranged by prior appointment only.\r\n\r\nPrincipal buyers only. No agents please.\r\n\r\n950lks', 'Chamod', 'Weerasinghe', 'kavindu200109@gmail.com', '0776921655', '2023-10-23 18:16:02'),
(37, 5, 'Rent', 'Super Luxury Brand New 4 BR All Completed House', 'Single Family Home', 'No 96, Parakumba Rd, Kurunegala.', 'Kurunegala', 5, 3, 1, 65000, 4500, 'Air Conditioning, Cable Ready, Heating, Security System, Ceiling Fans, Double Vanities, High Speed Internet Access, Satellite TV, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi', 'Dishwasher, Disposal, Microwave, Eat-in Kitchen, Kitchen, Oven, Stainless Steel Appliances, Range, DishBreakfast Nook', 'Balcony, Yard, Grill, Deck, Dock, Garden, Greenhouse, Lawn, Patio, Porch', 'Bay Window, Tile Floors, Crown Molding, BungHardwood Floors, Vaulted Ceiling, Carpeten, Attic, Basement, Built-In Bookshelves, Den, Dining Room, Double Pane Windows, Loft Layout, Mud Room', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Trash Removal, Electricity', 'uploads/listings_photoes/fitted (15).jpg,uploads/listings_photoes/cropped (1).jpg,uploads/listings_p', 'Brand New Luxury Single Story Fully Completed House For Sale \r\n\r\n------------------------------\r\n\r\n# 150M to Negombo - Divulapitiya (242) Bus Route\r\n\r\n# 250M to Negombo - Mirigama (251) Bus Route\r\n\r\n# 3Km to Negombo - Colombo Road ( A3 Putlam highway)\r\n\r\n# 3.5Km To Negombo Town\r\n\r\n# 10km High-Way Entrance Katunayake & Air Port\r\n\r\n# 12.5 Perches Land\r\n\r\n# Parapet Wall & Remote Roller Gate\r\n\r\n# Finishing Spot Roof, And Fully Tilled House, Double Height Wall House\r\n\r\n# 4 Bed Rooms\r\n\r\n# 2 Bath Rooms\r\n\r\n# Living Hall\r\n\r\n# Dinning Area\r\n\r\n# Kitchen With Luxury Pantry Cupboards  (With 4 Burners & Exhaust)\r\n\r\n# Wet Kitchen\r\n\r\n# Verandha    \r\n\r\n# Car Parking Space\r\n\r\n# Landscaped Garden\r\n\r\n# CCTV Camera, 4 Burners, Cooker Hood, Curtains, Bath Room Cubicles\r\n\r\n# Good Residential Area\r\n\r\n# Bank Loan Eligible\r\n\r\n# Clear Deeds & Documentation\r\n\r\n# serious Buyers Welcome\r\n\r\n# Inspection Only With Prior Approvals', 'Chamod', 'Weerasinghe', 'kavindu200109@gmail.com', '0776921655', '2023-10-23 18:39:00'),
(38, 4, 'Rent', '04 Storied Brand New Luxury House', 'Apartment', 'No 96,Battaramulla,Colombo o5.', 'Colombo', 0, 4, 4, 200000, 5000, 'Air Conditioning, Cable Ready, Fireplace, Storage Space, Washer/Dryer, Washer/Dryer Hookup, Heating, Satellite TV, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi', 'Dishwasher, Disposal, Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Refrigerator, Oven, Stainless Steel Appliances, Range, DishBreakfast Nook, Coffee System, Instant Hot Water, Island Kitchen, Pantry', 'Balcony, Yard, Grill, Deck, Dock, Garden, Greenhouse, Lawn, Patio, Porch', 'Bay Window, Tile Floors, Crown Molding, BungHardwood Floors, Family Room, Furnished, Skylights, Wet Bar, Window Coverings, Workshop', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Trash Removal, Electricity', 'uploads/listings_photoes/fitted (21).jpg,uploads/listings_photoes/fitted (23).jpg,uploads/listings_p', 'Four Storied Luxury House for Sale at Welegoda, Matara. House built on 8 Perches of Land and  2178 Sq.Ft floor area. Located about 100 meters from Sujatha Vidyalaya and Rahula Vidyalaya. Quick access to Matara Supermarket, Main Bus Stand, and Railway Station. The house consists of 6 bedrooms and 4 bathrooms.\r\n\r\nමාතර නගරයේ  වෙලේගොඩ, සුඛෝපභෝගී නිවසක් විකිණීමට ඇත. පර්චස් 8 ක ඉඩම සහ ආසන්න වශයෙන් ඉදිකරන ලද නිවස. වර්ග අඩි 2178 බිම් ප්‍රමාණයකින් සමන්විත වේ. සුජාතා විද්‍යාලයට සහ රාහුල විද්‍යාලයට මීටර් 100 පමණ දුරින් පිහිටා ඇත. මාතර සුපිරි වෙළඳසැල, ප්‍රදාන බස් නැවතුම්පොළ සහ දුම්රිය ස්ථානයට කඩිනමින් පිවිසිය හැක.මෙම නිවස නිදන කාමර 6 කින් සහ නාන කාමර 4 කින් සමන්විත වේ.\r\n\r\nExpose rafter ceiling (finishing ceiling). රැෆ්ටර් සිවිලිමෙන් නිරාවරණය කර ඇත .\r\n\r\nFully tiled floors. මහල් සියල්ලම සම්පුර්ණයෙන්ම ටයිල් කර ඇත.\r\n\r\nWell treated and seasoned jack tree timber doors & windows. ජනෙල් දොරවල් කොස් ලී වලින් සාදා නිම කර ඇත.\r\n\r\nTreated and seasoned jack tree timber pantry. පැන්ට්‍ර්ය සදහා කොස් ලී බාවිතා කර ඇත.\r\n\r\nRemote control roller door and secondary access (steel wicket gate). දුරස්ථ පාලක රෝලර් දොර සහ ද්විතීයික ප්‍රවේශය\r\n\r\nIndoor waterfall. ගෘහස්ථ දියඇල්ල.\r\n\r\nExtra car park space at the back. පිටුපස අමතර වාහන නැවැත්වීමේ ඉඩක් ඇත.\r\n\r\n100 points Marks for Rahula and Sujatha School admisions.\r\n\r\nරාහුල සුජාතා පාසලට පුවේශයේදී ලකුණූ 100 ක්  .\r\n\r\nTelephone - දුරකථන\r\n\r\nElectricity - විදුලිය\r\n\r\nTapline water and other necessary facilities are available -  නළ ජලය ඇතුලු සියලු පහසුකම් සහිතයි', 'Kavindu', 'Thennakoon', 'kavi86227@gmail.com', '0788529652', '2023-10-23 18:47:52'),
(39, 4, 'Sale', 'Mount Clifford Range Apartment', 'Single Family Home', 'No 56, Subuthi Rd, Koswaththa.', 'Koswaththa', 4, 2, 1, 15000000, 650, 'Air Conditioning, Cable Ready, Fireplace, Satellite TV, Sprinkler System, Tub/Shower, Surround Sound, Wi-Fi, Trash Compactor, Vacuum System', 'Dishwasher, Disposal, Oven, Stainless Steel Appliances, Range, DishBreakfast Nook, Coffee System, Dishwasher', 'Yard, Grill, Dock, Garden, Greenhouse, Porch', 'Tile Floors, Crown Molding, BungHardwood Floors, Vaulted Ceiling, Sunroom, Views, Dining Room, Family Room, Furnished, Vinyl Flooring, Wet Bar, Window Coverings, Workshop, High Ceilings, Large Bedrooms', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Electricity', 'uploads/listings_photoes/fitted (28).jpg,uploads/listings_photoes/fitted (30).jpg,uploads/listings_photoes/fitted (31).jpg,uploads/listings_photoes/fitted (32).jpg,uploads/listings_photoes/fitted (33).jpg,uploads/listings_photoes/fitted (34).jpg,uploads/listings_photoes/fitted (29).jpg', 'Mount Clifford Range Apartment - Property ID A1643\r\n\r\nA 2-bedroom furnished apartment with a gym, swimming pool and parking is available for sale in Homagama.\r\n\r\nThe apartment is located in a convenient location with easy access to banks, bus stations, clothing stores, supermarkets, hospitals, restaurants, hotels, religious places, government and international schools, and universities.\r\n\r\nThe apartment itself has two bedrooms, one bathroom, a furnished living area, a kitchen, and a balcony. It also has a gym, swimming pool and parking space.\r\n\r\nHere are some additional details about the apartment:\r\n\r\nThe apartment is located in a quiet neighborhood with a lot of greenery.\r\n\r\nThe building has 24-hour security.\r\n\r\nThe swimming pool is open from 6am to 10pm.\r\n\r\nThe gym is open from 6am to 10pm.\r\n\r\nThe parking space is allocated to the tenant.\r\n\r\nPlease contact us before 8.00 P.M if you need further information.\r\n\r\nPlease mention the property ID.Booking appointments are preferred.', 'Kavindu', 'Thennakoon', 'kavindu1234@gmail.com', '0788529652', '2023-10-25 10:29:26'),
(40, 5, 'Sale', '3 Bedroom Apartment for Rent in Wattala', 'Single Family Home', 'No 45, Nawala Rd, Wattala', 'Colombo', 2, 3, 1, 80000, 800, 'Washer/Dryer, Washer/Dryer Hookup, Heating, Security System, Surround Sound, Wi-Fi, Framed Mirrors, Handrails, Intercom, Trash Compactor, Vacuum System, Wheelchair Accessible', 'Microwave, Eat-in Kitchen, Kitchen, Granite Countertops, Ice Maker, Oven, Range, DishBreakfast Nook, Instant Hot Water, Island Kitchen, Pantry', 'Balcony, Yard, Grill, Deck, Garden, Greenhouse, Lawn', 'BungHardwood Floors, Vaulted Ceiling, Views, Den, Dining Room, Double Pane Windows, Family Room, Furnished, Vinyl Flooring, Wet Bar, Window Coverings', 'Gas, Heat, Cable, Water, Sewer, Air Conditioning, Trash Removal, Electricity', 'uploads/listings_photoes/Capture.PNG,uploads/listings_photoes/75212.PNG,uploads/listings_photoes/Capture6464.PNG,uploads/listings_photoes/Capture545452.PNG,uploads/listings_photoes/Capture4646.PNG,uploads/listings_photoes/4545454.PNG,uploads/listings_photoes/273b2acc8db22f91ad16e5d484d71125.jpg', 'Description\r\n• 3 Bedrooms (Master + 2)\r\n\r\n• 2 Bathrooms (1 en-suite + 1 common)\r\n\r\n• Monthly Maintenance fee excluded in the rent \r\n\r\n• 1265 Sq Ft.\r\n\r\n• Unfurnished \r\n\r\n• 2nd Floor\r\n\r\n• Hot water\r\n\r\n• 1 parking slot\r\n\r\n•  bathware and light fittings\r\n\r\n• SLT Fibre Optic connection \r\n\r\n \r\n\r\nApartment Facilities:\r\n\r\n \r\n\r\n• 24-hour Security\r\n\r\n• Large Rooftop Area with eye catching views of the Colombo skyline \r\n\r\n• Gym \r\n\r\n• Only 16 units in the apartment block \r\n\r\nSerene surroundings \r\n\r\nClose proximity to Schools, Hospitals and Supermarkets \r\n\r\n5 min drive, 20 min walk to Lyceum Wattala \r\n\r\n20 min drive to St Joseph’s College \r\n\r\n25 min drive to St Bridget’s Convent \r\n\r\n25 min drive to Royal College \r\n\r\n20 min drive to Fort/Kollupitiya  \r\n\r\n7 min drive to Hemas Hospital \r\n\r\n15 min drive to Kerawalapitiya Interchange ', 'Kavindu', 'Thennakoon', 'chamoth1245@gmail.com', '075212452', '2023-10-25 13:01:43');

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
(4, 'Kavindu', 'Thennakoon', '2001-03-30', 'kavi86227@gmail.com', '$2y$10$EcI1JbBtKkL5xEeLCyhHdO3Ar3Rot9.fFGxS/.KmT8x0X9f8dthxq', 'images.jpeg'),
(5, 'Chamoth', 'Jayarathna', '2004-06-22', 'kavindu200109@gmail.com', '$2y$10$Vmono9BmtAuUZIZzG0yTU.SUybolNzSQLGXOgjHcQrb5cevxPVWjW', 'download (3).jpeg'),
(7, 'Shasimali_Weerasinghe', 'Jayarathna', '2004-05-07', 'kavindu20010330@gmail.com', '$2y$10$GQfM9xxcVholBDgcwwBaoeMSB45pDoGgNcPyVLBjrXsfUvMfED33a', 'images (2).jpeg'),
(8, 'Chathurika', 'Yapa', '1972-03-13', 'chathurika1234@gmail.com', '$2y$10$BlxU4/6WW/.Rd7SliGG4T.OU0WU4vp7/V6iQtir3Fwwloa6K2hZda', 'images (2).jpeg'),
(9, 'Susantha', 'Jayasekara', '1988-10-18', 'susantha1234@gmail.com', '$2y$10$pVWuxGLYb8kqjumQjCLk8O09aXZZYOkQ.QncWcRvTs8Juk48s9JKy', 'download (2).jpeg');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `listing_details`
--
ALTER TABLE `listing_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
