<?php
session_start();
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

    <div class="all-listing-container">
        <?php
        include('process_php/db_connection.php'); 

        // Fetch data from the database
        $sql = "SELECT * FROM listing_details";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            echo '<div class="listing-container">';
            while($row = $result->fetch_assoc()) {

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
            }
        echo '</div>';    
        }        
        else {
            echo "No listings available";
        }

        $conn->close();
        ?>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>
    
</body>

</html>
