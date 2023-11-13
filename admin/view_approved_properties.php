<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('../process_php/db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if listing_id is set
    if (isset($_POST['listing_id'])) {
        $listing_id = $_POST['listing_id'];

        // Perform the delete operation
        $sql = "DELETE FROM listing_details WHERE id = $listing_id";
        if ($conn->query($sql) === TRUE) {
            // Redirect to the page with the listings after successful deletion
            header("Location: view_approved_properties.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Initialize variables for filters
$location = '';
$listingType = '';
$bedrooms = '';
$propertyType = '';
$minPrice = '';
$maxPrice = '';

// Retrieve admin data from the "admins" table based on admin_id
$admin_id = $_SESSION["admin_id"];
$sql = "SELECT * FROM admins WHERE admin_id = $admin_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminName = $_SESSION["admin_name"];
    $truncatedName = (strlen($adminName) > 21) ? substr($adminName, 0, 21) . '...' : $adminName;
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $birthdate = $row["birthdate"];
    $email = $row["email"];
    $password = $row["password"];
} else {
    echo "admin not found";
}

// Initialize variables for filters
$location = '';
$listingType = '';
$bedrooms = '';
$propertyType = '';
$minPrice = '';
$maxPrice = '';

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
    $sql .= " AND (LOWER(city) LIKE '%$searchLocation%')";
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" type="text/css" href="../style/style_myAccount.css">
        <link rel="stylesheet" type="text/css" href="../style/style_all_listings.css">
        <link rel="stylesheet" type="text/css" href="style/style_view_approved_properties.css">
    </head>
    <body>
        <div class="container">
            <div class="left-section">
                <img class="profile-photo" src="process_php/uploads/profile_photos/<?php echo $_SESSION["admin_profile_photo"]; ?>" alt="Profile Photo">
                <p class="full-name"><?php echo $truncatedName; ?></p>
                    <ul>
                    <a href="admin_dashboard.php"><li><button class="button">Dashboard</button></li></a>
                    <a href="admin_myAccount.php"><li><button class="button">My Account</button></li></a>
                    <a href="admin_pendingListings.php"><li><button class="button">Pending Listings</button></li></a>
                    <a href="admin_register.php"><li><button class="button">Register</button></li></a>
                    <a href="process_php/process_logout.php"><li><button class="button">Log Out</button></li></a>
                </ul>
            </div>
            <div style="padding:20px;" class="right-section">
                <a class="logo1" href="admin_dashboard.php"><img src="../images/logo.png" alt="Logo"></a>
                <a href="view_approved_properties.php"><h1 class="main-title">Approved Listings</h1></a>
                <hr style="width: 100%; border: 2px #F28A0A solid">

                <div class="search-container">
                    <form action="view_approved_properties.php" method="GET">
                        <div class="search-group">
                            <input type="text" id="search-input" name="location" placeholder="Search Location...">
                            <button type="submit" id="search-button"><img src="../images/search.png" alt="Search"></button>
                        </div>
                        <div class="filter-group" style="font-family: Josefin sans-serif;">
                            <select name="listingType">
                                <option value="">Listing Type</option>
                                <option value="Rent">Rent</option>
                                <option value="Sale">Sale</option>
                            </select>
                            <input style="margin-top: 10px;" type="text" name="bedrooms" placeholder="Bedrooms">
                            <select name="propertyType">
                                <option value="">Property Type</option>
                                <option value="Single Family Home">Single Family Home</option>
                                <option value="Room">Room</option>
                                <option value="Apartment">Apartment</option>
                            </select>
                            <input type="number" name="minPrice" placeholder="Min Price">
                            <input type="number" name="maxPrice" placeholder="Max Price">
                            <button type="submit" id="filter-button"><img src="../images/filter.png" alt="Filter"></button>
                        </div>
                    </form>
                </div>

                <div class="all-listing-container">
                    <?php
                    include('process_php/db_connection.php'); 
                    // Fetch data from the database for listings with approval_status as 'Approved'
                    $sql = "SELECT * FROM listing_details WHERE approval_status = 'Approved' ORDER BY date DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo '<div class="listing-container">';
                        while($row = $result->fetch_assoc()) {
                            echo '<a href="admin_listing_view.php?id=' . $row['id'] . '" class="property-link">';

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
                                echo'<div class="listing">';
                                    echo '<div class="listing-photo">';
                                        if (!empty($firstImagePath)) {
                                            echo '<div><img src="../process_php/' . $firstImagePath . '" alt="Listing Photo"></div>';
                                        } else {
                                            echo '<div class="listing-photo">No Image Available</div>';
                                        }
                                        echo '<div class="listing-price">Rs ' . $row['price'] . '.00</div>';
                                        echo '<div class="listing-type">' . $row['listing_type'] . '</div>';
                                    echo '</div>';
                                    echo '<div class="listing-info">';
                                        $shortenedTitle = (strlen($row['title']) > 45) ? substr($row['title'], 0, 45) . '...' : $row['title'];
                                        echo '<div class="listing-title">' . $shortenedTitle . '</div>';
                                        echo '<div class="listing-address"><img src="../images/placeholder.png" alt="Bed">' . $row['city'] . '</div>';
                                        echo '<div class="listing-icons">';
                                        echo '<div class="icon-bed"><img src="../images/bed.png" alt="Bed">' . $row['bedrooms'] . '</div>';
                                        echo '<div class="icon-bath"><img src="../images/bath.png" alt="Bath">' . $row['bathrooms'] . '</div>';
                                        echo '<div class="icon-size"><img src="../images/size.png" alt="Size">' . $row['size'] . ' sqft</div>';
                                        echo '</div>';
                                        echo '<div class="listing-publish">';
                                            echo '<div class="listing-date"><img src="../images/calendar.png" alt="Date">' . date('Y-m-d', strtotime($row['date'])) . '</div>';
                                            echo '<div class="publisher-icon"><img src="../images/user.png" alt="Publisher">BY : ' . $row['f_name'] . '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<!-- Delete button -->';
                                    echo '<form action="process_php/delete_approvedListing.php" method="post">';
                                    echo '<input type="hidden" name="listing_id" value="' . $row['id'] . '">';
                                    echo '<button type="submit" class="delete-button">Delete</button>';
                                    echo '</form>';
                                echo '</div>';
                            }
                            echo '</a>';
                        }
                        echo '</div>';    
                    } else {
                        echo "<h3 style='color:red;'>No properties available</h3>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
