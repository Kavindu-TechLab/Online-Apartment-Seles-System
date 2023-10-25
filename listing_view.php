<?php
session_start();
include('process_php/db_connection.php');

// Check if listing ID is provided in the URL
if (isset($_GET['id'])) {
    $listingId = $_GET['id'];

    // Retrieve listing details from the database based on the listing ID
    $sql = "SELECT * FROM listing_details WHERE id = '$listingId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bannerPhotoLeft = explode(',', $row['li_image'])[0];
        $additionalPhotosRight = array_slice(explode(',', $row['li_image']), 1, 4);
        $allPhotos = array_slice(explode(',', $row['li_image']), 0, 7);

        // Include the navigation bar
        include('navbar.php');
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Listing View</title>
            <link rel="stylesheet" type="text/css" href="style/style.css">
            <link rel="stylesheet" type="text/css" href="style/style_listingView.css">
        </head>

        <body>

            <!-- Banner Photo -->
            <div class="banner-photo">
                <div class="left-banner">
                <?php
                    echo '<a href="process_php/' . $bannerPhotoLeft . '" target="_blank">';
                    echo '<img src="process_php/' . $bannerPhotoLeft . '" alt="Left Side Banner Photo">';
                    echo '</a>';
                ?>
                </div>

                <div class="right-banner">
                    <div class="row">
                    <?php
                        foreach ($additionalPhotosRight as $photoPath) {
                            echo '<a href="process_php/' . $photoPath . '" target="_blank">';
                            echo '<img src="' . 'process_php/' . $photoPath . '" alt="Right Side Banner Photo">';
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="additional-photos">
                <div class="photo-gallery">
                    <?php
                    foreach ($allPhotos as $index => $photoPath) {
                        echo '<a href="process_php/' . $photoPath . '" target="_blank">';
                        echo '<img src="process_php/' . $photoPath . '" alt="Additional Photo">';
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>

            <div class="listing-details">
                <div class="left-details">
                    <h1><?php echo $row['title']; ?></h1>
                    <p><?php echo $row['address']; ?></p>
                    
                    <!-- Details Box -->
                    <div class="details-box">
                        <div class="detail-item"><?php echo $row['city']; ?></div>
                        <div class="detail-item"><?php echo $row['bedrooms']; ?> Bed</div>
                        <div class="detail-item"><?php echo $row['bathrooms']; ?> Bath</div>
                        <div class="detail-item"><?php echo $row['size']; ?> sqft</div>
                    </div>
                </div>

                <div class="right-details">
                    <div class="contact-information">
                        <h3>Contact Information</h3>
                        <p>Name: <?php echo $row['f_name'] . ' ' . $row['l_name']; ?></p>
                        <p>Email: <?php echo $row['email']; ?></p>
                        <p>Phone: <?php echo $row['p_no']; ?></p>
                    </div>
                </div>
            </div>


            <!-- Include the footer -->
            <?php include('footer.php'); ?>

        </body>

        </html>

<?php

    } else {
        echo "Listing not found";
    }
} else {
    echo "Invalid listing ID";
}

?>
