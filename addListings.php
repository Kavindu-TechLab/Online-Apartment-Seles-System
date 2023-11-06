<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure that code execution stops after the redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_addListings.css">
    <title>Create A Listings</title>
</head>
<body>
    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="title">
        <div class="header">
            <h1>Create A Listings</h1>
            <p>First, we need some details about your property. That way, we can tailor the property management experience to you.</p>
        </div>
        <hr>
    </div>

    <div class="container">

        <form action="process_php/process_addListing.php" method="post" enctype="multipart/form-data">
                <div class="form-box">
                    <!-- Main Details -->
                    <div class = "main_details">
                        <h2>Main Details</h2>
                        <div class="form-column1">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title">
                            <label for="listingType">Listing Type</label>
                            <select id="listingType" name="listingType">
                                <option value="Sale">Sale</option>
                                <option value="Rent">Rent</option>
                            </select>
                            <label for="propertyType">What type of property is it?</label>
                            <select id="propertyType" name="propertyType">
                                <option value="Single Family Home">Single Family Home</option>
                                <option value="Single Room">Single Room</option>
                                <option value="Apartment">Apartment</option>
                            </select>
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city">
                            <label for="totalUnits">Total number of units</label>
                            <input type="number" id="totalUnits" name="totalUnits">
                            <label for="bedrooms">Number of Bedrooms</label>
                            <input type="number" id="bedrooms" name="bedrooms">
                            <label for="bathrooms">Number of Bathrooms</label>
                            <input type="number" id="bathrooms" name="bathrooms">
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price">
                            <label for="size">Size</label>
                            <input type="number" id="size" name="size">
                        </div>
                    </div>
                </div>

                <div class="form-box">
                    <!-- Property Amenities -->
                    <div class = "property_amenities">
                    <h2>Property Amenities</h2>
                        <!-- Features -->
                        <div class = "features">

                            <h3>Features</h3>
                            <div class="form-column2">
                                <label><input type="checkbox" name="features[]" value="Air Conditioning"> Air Conditioning</label>
                                <label><input type="checkbox" name="features[]" value="Cable Ready"> Cable Ready</label>
                                <label><input type="checkbox" name="features[]" value="Fireplace"> Fireplace</label>
                                <label><input type="checkbox" name="features[]" value="Storage Space"> Storage Space</label>
                                <label><input type="checkbox" name="features[]" value="Washer/Dryer"> Washer/Dryer</label>
                                <label><input type="checkbox" name="features[]" value="Washer/Dryer Hookup"> Washer/Dryer Hookup</label>
                                <label><input type="checkbox" name="features[]" value="Heating"> Heating</label>
                                <label><input type="checkbox" name="features[]" value="Security System"> Security System</label>
                                <label><input type="checkbox" name="features[]" value="Ceiling Fans"> Ceiling Fans</label>
                                <label><input type="checkbox" name="features[]" value="Double Vanities"> Double Vanities</label>
                                <label><input type="checkbox" name="features[]" value="High Speed Internet Access"> High Speed Internet Access</label>
                                <label><input type="checkbox" name="features[]" value="Satellite TV"> Satellite TV</label>
                                <label><input type="checkbox" name="features[]" value="Sprinkler System"> Sprinkler System</label>
                                <label><input type="checkbox" name="features[]" value="Tub/Shower"> Tub/Shower</label>
                                <label><input type="checkbox" name="features[]" value="Surround Sound"> Surround Sound</label>
                                <label><input type="checkbox" name="features[]" value="Wi-Fi"> Wi-Fi</label>
                                <label><input type="checkbox" name="features[]" value="Framed Mirrors"> Framed Mirrors</label>
                                <label><input type="checkbox" name="features[]" value="Handrails"> Handrails</label>
                                <label><input type="checkbox" name="features[]" value="Intercom"> Intercom</label>
                                <label><input type="checkbox" name="features[]" value="Smoke Free"> Smoke Free</label>
                                <label><input type="checkbox" name="features[]" value="Trash Compactor"> Trash Compactor</label>
                                <label><input type="checkbox" name="features[]" value="Vacuum System"> Vacuum System</label>
                                <label><input type="checkbox" name="features[]" value="Wheelchair Accessible"> Wheelchair Accessible (Rooms)</label>
                            </div>
                                                    
                        </div>
                
                        <!-- Kitchens -->
                        <div class = "kitchens">

                            <h3>Kitchens</h3>
                            <div class="form-column2">
                                <label><input type="checkbox" name="kitchens[]" value="Dishwasher"> Dishwasher</label>
                                <label><input type="checkbox" name="kitchens[]" value="Disposal"> Disposal</label>
                                <label><input type="checkbox" name="kitchens[]" value="Microwave"> Microwave</label>
                                <label><input type="checkbox" name="kitchens[]" value="Eat-in Kitchen"> Eat-in Kitchen</label>
                                <label><input type="checkbox" name="kitchens[]" value="Kitchen"> Kitchen</label>
                                <label><input type="checkbox" name="kitchens[]" value="Granite Countertops"> Granite Countertops</label>
                                <label><input type="checkbox" name="kitchens[]" value="Ice Maker"> Ice Maker</label>
                                <label><input type="checkbox" name="kitchens[]" value="Refrigerator"> Refrigerator</label>
                                <label><input type="checkbox" name="kitchens[]" value="Oven"> Oven</label>
                                <label><input type="checkbox" name="kitchens[]" value="Stainless Steel Appliances"> Stainless Steel Appliances</label>
                                <label><input type="checkbox" name="kitchens[]" value="Range"> Range</label>
                                <label><input type="checkbox" name="kitchens[]" value="DishBreakfast Nook"> Breakfast Nook</label>
                                <label><input type="checkbox" name="kitchens[]" value="Coffee System"> Coffee System</label>
                                <label><input type="checkbox" name="kitchens[]" value="Dishwasher"> Dishwasher</label>
                                <label><input type="checkbox" name="kitchens[]" value="Freezer"> Freezer</label>
                                <label><input type="checkbox" name="kitchens[]" value="Instant Hot Water"> Instant Hot Water</label>
                                <label><input type="checkbox" name="kitchens[]" value="Island Kitchen"> Island Kitchen</label>
                                <label><input type="checkbox" name="kitchens[]" value="Pantry"> Pantry</label>
                                <label><input type="checkbox" name="kitchens[]" value="Warming Drawer"> Warming Drawer</label>
                            </div>  
                        </div>

                        <!-- Outdoor Spaces -->
                        <div class = "outdoor_spaces">

                            <h3>Outdoor Spaces</h3> 
                            <div class="form-column2">
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Balcony"> Balcony</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Yard"> Yard</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Grill"> Grill</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Deck"> Deck</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Dock"> Dock</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Garden"> Garden</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Greenhouse"> Greenhouse</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Lawn"> Lawn</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Patio"> Patio</label>
                                <label><input type="checkbox" name="outdoor_spaces[]" value="Porch"> Porch</label>
                            </div>
                        </div>

                        <!-- Living Spaces -->
                        <div class = "living_spaces">

                            <h3>Living Spaces</h3>
                            <div class="form-column2">
                                <label><input type="checkbox" name="living_spaces[]" value="Bay Window"> Bay Window</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Tile Floors"> Tile Floors</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Crown Molding"> Crown Molding</label>
                                <label><input type="checkbox" name="living_spaces[]" value="BungHardwood Floors"> BunHardwood Floors</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Vaulted Ceiling"> Vaulted Ceiling</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Sunroom"> Sunroom</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Views"> Views</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Walk-In Closets"> Walk-In Closets</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Carpeten"> Carpet</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Attic"> Attic</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Basement"> Basement</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Basement"> Basement</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Built-In Bookshelves"> Built-In Bookshelves</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Den"> Den</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Dining Room"> Dining Room</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Double Pane Windows"> Double Pane Windows</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Family Room"> Family Room</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Furnished"> Furnished</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Linen Closet"> Linen Closet</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Loft Layout"> Loft Layout</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Mother-in-law Unit"> Mother-in-law Unit</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Mud Room"> Mud Room</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Office"> Office</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Recreation Room"> Recreation Room</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Skylights"> Skylights</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Vinyl Flooring"> Vinyl Flooring</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Wet Bar"> Wet Bar</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Window Coverings"> Window Coverings</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Workshop"> Workshop</label>
                                <label><input type="checkbox" name="living_spaces[]" value="High Ceilings"> High Ceilings</label>
                                <label><input type="checkbox" name="living_spaces[]" value="Large Bedrooms"> Large Bedrooms</label>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="form-box">
                    <!-- Utilities -->
                    <div class = "utilities">

                        <h2>Utilities</h2>
                        <div class="form-column2">
                            <label><input type="checkbox" name="utilities[]" value="Gas"> Gas</label>
                            <label><input type="checkbox" name="utilities[]" value="Heat"> Heat</label>
                            <label><input type="checkbox" name="utilities[]" value="Cable"> Cable</label>
                            <label><input type="checkbox" name="utilities[]" value="Water"> Water</label>
                            <label><input type="checkbox" name="utilities[]" value="Sewer"> Sewer</label>
                            <label><input type="checkbox" name="utilities[]" value="Air Conditioning"> Air Conditioning</label>
                            <label><input type="checkbox" name="utilities[]" value="Trash Removal"> Trash Removal</label>
                            <label><input type="checkbox" name="utilities[]" value="Electricity"> Electricity</label>
                        </div>
                    </div>
                </div>

                <div class="form-box">
                    <!-- Media -->
                    <div class="media">
                        <h2>Media</h2>
                        <div class="form-column1">
                            <label for="image">Upload Images</label>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple>
                        </div>
                    </div>
                </div>


                <div class="form-box">
                    <!-- Description -->
                    <div class = "description">

                        <h2>Description</h2>
                        <textarea id="description" name="description"></textarea>

                    </div>
                </div>

                <div class="form-box">
                    <!-- Contact Information -->
                    <div class = "contact_information">
                        <h2>Contact Information</h2>
                        <div class="form-column1">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName">

                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName">

                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email">

                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                    </div>
                </div>

                <div class="form-box">
                    <!-- Unit Details -->
                    <div>

                        <h2>Unit Details</h2>
                        <!-- Add fields for unit details (if user wants to add units) -->

                    </div>
                </div>

                <div class = "submit">
                    <input id = "save" type="submit" value="Save">
                    <input id = "publish" type="submit" value="Publish">
                </div>
                
            </form>

    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>
</body>
</html>