<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection file
include('../process_php/db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img class="profile-photo" src="process_php/uploads/profile_photos/<?php echo $_SESSION["admin_profile_photo"]; ?>" alt="Profile Photo">
            <p class="full-name"><?php echo $truncatedName; ?></p>
                <ul>
                <a href="admin_dashboard.php"><li><button class="button">Dashboard</button></li></a>
                <a href="admin_myAccount.php"><li><button class="button">Personal Details</button></li></a>
                <a href="view_pendingListings.php"><li><button class="button">Pending Listings</button></li></a>
                <a href="admin_register.php"><li><button class="button">Register</button></li></a>
                <a href="process_php/process_logout.php"><li><button class="button">Log Out</button></li></a>
            </ul>
        </div>
        <div style="padding:20px;" class="right-section">
        <a class="logo1" href="admin_dashboard.php"><img src="../images/logo.png" alt="Logo"></a>
            <h1 class="main-title">Pending Listings</h1>
            <hr style="width: 100%; border: 2px #F28A0A solid">
            <div class="all-listing-container">
                <?php
                include('process_php/db_connection.php'); 
                // Fetch data from the database for listings with approval_status as 'Pending'
                $sql = "SELECT * FROM listing_details WHERE approval_status = 'Pending' ORDER BY date DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '<div class="listing-container">';
                    while($row = $result->fetch_assoc()) {
                        echo '<a href="admin_listing_view.php?id=' . $row['id'] . '" class="property-link">';
                            
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
                        echo '</div>';
                        echo '</a>';
                    }
                    echo '</div>';    
                }        
                else {
                    echo "<h3 style='color:red;'>No properties available</h3>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>