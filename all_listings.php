<?php
session_start();
include('process_php/db_connection.php');

// Initialize variables for filters
$location = '';
$listingType = '';
$bedrooms = '';
$propertyType = '';
$minPrice = '';
$maxPrice = '';
$propertyCount = 0;

// Check if filter values are provided in the URL
if(isset($_GET['location'])) {
    $location = $_GET['location'];
}
if(isset($_GET['listingType'])) {
    $listingType = $_GET['listingType'];
}
if(isset($_GET['bedrooms'])) {
    $bedrooms = $_GET['bedrooms'];
}
if(isset($_GET['propertyType'])) {
    $propertyType = $_GET['propertyType'];
}
if(isset($_GET['minPrice'])) {
    $minPrice = $_GET['minPrice'];
}
if(isset($_GET['maxPrice'])) {
    $maxPrice = $_GET['maxPrice'];
}

// Construct the SQL query based on filters
$sql = "SELECT * FROM listing_details WHERE 1";

if(!empty($location)) {
    $searchLocation = strtolower($location);
    $sql .= " AND (LOWER(city) LIKE '%$searchLocation%' OR UPPER(city) LIKE '%$searchLocation%')";
}

if(!empty($listingType)) {
    $sql .= " AND listing_type = '$listingType'";
}
if(!empty($bedrooms)) {
    $sql .= " AND bedrooms = '$bedrooms'";
}
if(!empty($propertyType)) {
    $sql .= " AND property_type = '$propertyType'";
}
if(!empty($minPrice)) {
    $sql .= " AND price >= '$minPrice'";
}
if(!empty($maxPrice)) {
    $sql .= " AND price <= '$maxPrice'";
}

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Listings</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_listings.css">
</head>

<body>

    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="search-container">
        <form action="all_listings.php" method="GET">
            <div class="search-group">
                <input type="text" id="search-input" name="location" placeholder="Search Location...">
                <button type="submit" id="search-button"><img src="images/search.png" alt="Search"></button>
            </div>
            <div class="filter-group">
                <select name="listingType">
                    <option value="">Listing Type</option>
                    <option value="Rent">Rent</option>
                    <option value="Sale">Sale</option>
                </select>
                <input type="text" name="bedrooms" placeholder="Bedrooms">
                <select name="propertyType">
                    <option value="">Property Type</option>
                    <option value="Single Family Home">Single Family Home</option>
                    <option value="Room">Room</option>
                    <option value="Apartment">Apartment</option>
                </select>
                <input type="number" name="minPrice" placeholder="Min Price">
                <input type="number" name="maxPrice" placeholder="Max Price">
                <button type="submit" id="filter-button"><img src="images/filter.png" alt="Filter"></button>
            </div>
        </form>
    </div>

    <!-- Display total properties found after search or filter -->
    <?php
    echo '<div class="noOfProperty">';
        if ($result->num_rows > 0) {
            $propertyCount = $result->num_rows;
            echo '<div>Showing ' . $propertyCount . ' Properties</div>';
        } else {
            echo '<div>No properties found</div>';
        }
    echo '</div>';
    ?>

    <div class="all-listing-container">
        <?php
        include('process_php/db_connection.php'); 

        // Fetch data from the database
        $sql = "SELECT * FROM listing_details";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            echo '<div class="listing-container">';
            while($row = $result->fetch_assoc()) {

                echo '<a href="listing_view.php?id=' . $row['id'] . '" class="property-link">';

                    if (
                        (strpos($row['city'], $location) !== false || empty($location)) &&
                        ($row['listing_type'] == $listingType || empty($listingType)) &&
                        ($row['bedrooms'] == $bedrooms || empty($bedrooms)) &&
                        ($row['property_type'] == $propertyType || empty($propertyType)) &&
                        ($row['price'] >= $minPrice || empty($minPrice)) &&
                        ($row['price'] <= $maxPrice || empty($maxPrice))) 
                    {
                        // Split the image paths into an array
                        $imagePaths = explode(',', $row['li_image']);

                        // Get the first image path, you can modify this logic based on your requirements
                        $firstImagePath = isset($imagePaths[0]) ? $imagePaths[0] : '';

                        echo '<div class="listing">';
                            echo '<div class="listing-photo">';
                                if (!empty($firstImagePath)) {
                                    echo '<div><img src="process_php/' . $firstImagePath . '" alt="Listing Photo"></div>';
                                } else {
                                    echo '<div class="listing-photo">No Image Available</div>';
                                }
                                echo '<div class="listing-price">Rs ' . $row['price'] . '.00</div>';
                                echo '<div class="listing-type">' . $row['listing_type'] . '</div>';
                            echo '</div>';
                            echo '<div class="listing-info">';
                                echo '<div class="listing-title">' . $row['title'] . '</div>';
                                echo '<div class="listing-address"><img src="images/placeholder.png" alt="Bed">' . $row['city'] . '</div>';
                                echo '<div class="listing-icons">';
                                echo '<div class="icon-bed"><img src="images/bed.png" alt="Bed">' . $row['bedrooms'] . '</div>';
                                echo '<div class="icon-bath"><img src="images/bath.png" alt="Bath">' . $row['bathrooms'] . '</div>';
                                echo '<div class="icon-size"><img src="images/size.png" alt="Size">' . $row['size'] . ' sqft</div>';
                                echo '</div>';
                                echo '<div class="listing-publish">';
                                    echo '<div class="listing-date"><img src="images/calendar.png" alt="Date">' . date('Y-m-d', strtotime($row['date'])) . '</div>';
                                    echo '<div class="publisher-icon"><img src="images/user.png" alt="Publisher">BY : ' . $row['f_name'] . '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        $propertyCount++; // Increment property count
                    }
                echo '</a>';
            }
            echo '</div>';    
        }        
        else {
            echo "No properties available";
        }

        $conn->close();
        ?>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>
    
</body>

</html>

