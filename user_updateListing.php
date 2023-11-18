<?php
session_start();
include('process_php/db_connection.php');

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure that code execution stops after the redirect
}

// Check if listing ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $listingId = $_GET['id'];

    // Fetch existing listing data based on listing ID
    $sql = "SELECT * FROM listing_details WHERE id = $listingId AND user_id = {$_SESSION['user_id']}";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Store fetched data into variables
        $title = $row['title'];
        $listingType = $row['listing_type'];
        $propertyType = $row['property_type'];
        $address = $row['address'];
        $city = $row['city'];
        $totalUnits = $row['total_units'];
        $bedrooms = $row['bedrooms'];
        $bathrooms = $row['bathrooms'];
        $price = $row['price'];
        $size = $row['size'];
        $features = explode(', ', $row['features']);
        $kitchens = explode(', ', $row['kitchen']);
        $outdoorSpaces = explode(', ', $row['outdoor_spaces']);
        $livingSpaces = explode(', ', $row['living_spaces']);
        $utilities = explode(', ', $row['utilities']);
        $description = $row['description'];
        $firstName = $row['f_name'];
        $lastName = $row['l_name'];
        $email = $row['email'];
        $phone = $row['p_no'];
        $existingImages = $row['li_image'];

    } else {
        // Listing not found, handle this case accordingly
        echo "Listing not found";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_addListings.css">
    <title>Update Listing</title>
</head>
<body>
    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="title">
        <div class="header">
            <h1>Update Listing</h1>
            <p>Edit the details of your property listing.</p>
        </div>
        <hr>
    </div>

    <div class="container">
        <form action="process_php/process_updateListing.php?id=<?php echo $listingId; ?>" method="post" enctype="multipart/form-data">
            <!-- Add this hidden input to include existing images -->
            <input type="hidden" name="existingImages" value="<?php echo $existingImages; ?>">
            <!-- Main Details -->
            <div class="form-box">
                <div class="main_details">
                    <h2>Main Details</h2>
                    <div class="form-column1">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="<?php echo $title; ?>">
                        <label for="listingType">Listing Type</label>
                        <select id="listingType" name="listingType">
                            <option value="Sale" <?php if($listingType == 'Sale') echo 'selected'; ?>>Sale</option>
                            <option value="Rent" <?php if($listingType == 'Rent') echo 'selected'; ?>>Rent</option>
                        </select>
                        <label for="propertyType">Property Type</label>
                        <select id="propertyType" name="propertyType">
                            <option value="Single Family Home" <?php if($propertyType == 'Single Family Home') echo 'selected'; ?>>Single Family Home</option>
                            <option value="Single Room" <?php if($propertyType == 'Single Room') echo 'selected'; ?>>Single Room</option>
                            <option value="Apartment" <?php if($propertyType == 'Apartment') echo 'selected'; ?>>Apartment</option>
                        </select>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="<?php echo $address; ?>">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" value="<?php echo $city; ?>">
                        <label for="totalUnits">Total number of units</label>
                        <input type="number" id="totalUnits" name="totalUnits" value="<?php echo $totalUnits; ?>">
                        <label for="bedrooms">Number of Bedrooms</label>
                        <input type="number" id="bedrooms" name="bedrooms" value="<?php echo $bedrooms; ?>">
                        <label for="bathrooms">Number of Bathrooms</label>
                        <input type="number" id="bathrooms" name="bathrooms" value="<?php echo $bathrooms; ?>">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" value="<?php echo $price; ?>">
                        <label for="size">Size</label>
                        <input type="number" id="size" name="size" value="<?php echo $size; ?>">
                    </div>
                </div>
            </div>

            <!-- Property Amenities -->
            <div class="form-box">
                <div class="property_amenities">
                    <!-- Features -->
                        <div class = "features">

                            <h3>Features</h3>
                            <div class="form-column2">
                                <?php
                                $featuresArray = explode(", ", $row['features']); // Convert comma-separated string to an array
                                $allFeatures = ["Air Conditioning", "Cable Ready", "Fireplace", "Storage Space", "Washer/Dryer", "Washer/Dryer Hookup", "Heating", "Security System", "Ceiling Fans", "Double Vanities", "High Speed Internet Access", "Satellite TV", "Sprinkler System", "Tub/Shower", "Surround Sound", "Wi-Fi", "Framed Mirrors", "Handrails", "Intercom", "Smoke Free", "Trash Compactor", "Vacuum System", "Wheelchair Accessible (Rooms)"];

                                foreach ($allFeatures as $feature) {
                                    $isChecked = in_array($feature, $featuresArray) ? 'checked' : '';
                                    echo "<label><input type='checkbox' name='features[]' value='$feature' $isChecked> $feature</label>";
                                }
                                ?>
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
                                <?php
                                $kitchensArray = explode(", ", $row['kitchen']); // Convert comma-separated string to an array
                                $allKitchens = ["Dishwasher", "Disposal", "Microwave", "Eat-in Kitchen", "Kitchen", "Granite Countertops", "Ice Maker", "Refrigerator", "Oven", "Stainless Steel Appliances", "Range", "Breakfast Nook", "Coffee System", "Dishwasher", "Freezer", "Instant Hot Water", "Island Kitchen", "Pantry", "Warming Drawer"];

                                foreach ($allKitchens as $kitchen) {
                                    $isChecked = in_array($kitchen, $kitchensArray) ? 'checked' : '';
                                    echo "<label><input type='checkbox' name='kitchens[]' value='$kitchen' $isChecked> $kitchen</label>";
                                }
                                ?>
                                
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
                                <?php
                                $outdoorSpacesArray = explode(", ", $row['outdoor_spaces']); // Convert comma-separated string to an array
                                $allOutdoorSpaces = ["Balcony", "Yard", "Grill", "Deck", "Dock", "Garden", "Greenhouse", "Lawn", "Patio", "Porch"];

                                foreach ($allOutdoorSpaces as $outdoorSpace) {
                                    $isChecked = in_array($outdoorSpace, $outdoorSpacesArray) ? 'checked' : '';
                                    echo "<label><input type='checkbox' name='outdoor_spaces[]' value='$outdoorSpace' $isChecked> $outdoorSpace</label>";
                                }
                                ?>
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
                                <?php
                                $livingSpacesArray = explode(", ", $row['living_spaces']); // Convert comma-separated string to an array
                                $allLivingSpaces = ["Bay Window", "Tile Floors", "Crown Molding", "BunHardwood Floors", "Vaulted Ceiling", "Sunroom", "Views", "Walk-In Closets", "Carpet", "Attic", "Basement", "Built-In Bookshelves", "Den", "Dining Room", "Double Pane Windows", "Family Room", "Furnished", "Linen Closet", "Loft Layout", "Mother-in-law Unit", "Mud Room", "Office", "Recreation Room", "Skylights", "Vinyl Flooring", "Wet Bar", "Window Coverings", "Workshop", "High Ceilings", "Large Bedrooms"];

                                foreach ($allLivingSpaces as $livingSpace) {
                                    $isChecked = in_array($livingSpace, $livingSpacesArray) ? 'checked' : '';
                                    echo "<label><input type='checkbox' name='living_spaces[]' value='$livingSpace' $isChecked> $livingSpace</label>";
                                }
                                ?>
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

            <!-- Add this code inside your form to display existing images -->
            <div class="form-box">
                <!-- Media -->
                <div class="media">
                    <h2>Media</h2>
                    <div class="form-column1">
                        <label for="image">Upload Images</label>
                        <input type="file" id="image" name="image[]" accept="image/*"  multiple>
                        <input type="file" id="image" name="image[]" accept="image/*"  multiple>
                        <input type="file" id="image" name="image[]" accept="image/*"  multiple>
                        <input type="file" id="image" name="image[]" accept="image/*"  multiple>
                        <input type="file" id="image" name="image[]" accept="image/*"  multiple>
                        <input type="file" id="image" name="image[]" accept="image/*"  multiple>   
                        <input type="file" id="image" name="image[]" accept="image/*"  multiple>   
                    </div>
                </div>
            </div>


            <!-- Description -->
            <div class="form-box">
                <div class="description">
                    <h2>Description</h2>
                    <textarea id="description" name="description"><?php echo $description; ?></textarea>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="form-box">
                <div class="contact_information">
                    <h2>Contact Information</h2>
                    <div class="form-column1">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div>
            </div>
            <div class="submit-button">
                <button class="button1" type="submit">Update & Publish Listings</button>
            </div>
            
        </form>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>
</body>
</html>


