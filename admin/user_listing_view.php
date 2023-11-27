<?php
session_start();
include('process_php/db_connection.php');

// Check if the current page is view_pendingListings.php
$isViewPendingListingsPage = basename($_SERVER['PHP_SELF']) === 'view_pendingListings.php';

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

        // Features, Kitchen, Outdoor Spaces, Living Spaces, and Utilities from the database
        $features = explode(', ', $row['features']);
        $kitchens = explode(', ', $row['kitchen']);
        $outdoorSpaces = explode(', ', $row['outdoor_spaces']);
        $livingSpaces = explode(', ', $row['living_spaces']);
        $utilities = explode(', ', $row['utilities']);
        $descriptionLines = explode("\n", $row['description']);

?>

    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Listing View</title>
            <link rel="stylesheet" type="text/css" href="../style/style_listingView.css">
            <style>
                .approve_reject {
                    display: inline-flexbox;
                    margin-bottom: 30px;
                    text-align: center;
                }

                .approve_reject form {
                    margin-left: 5%;
                    margin-right: 5%;
                    display: flex;
                    text-align: center;
                    width: 90%;
                }

                .approve_reject button {
                    margin-left: 10px;
                    margin-right: 10px;
                    margin-bottom: 10px;
                    text-align: center;
                    display: inline;
                    width: 100%;
                    padding: 10px;
                    border-radius: 20px;
                    font-size: 25px;
                    text-transform: uppercase;
                    font-family: Josefin sans-serif;
                    color: #fff;
                    border: none;
                }
            </style>
        </head>

        <body>

            <!-- Banner Photo -->
            <div class="banner-photo">
                <div class="left-banner">
                <?php
                    echo '<a href="../process_php/' . $bannerPhotoLeft . '" target="_blank">';
                    echo '<img src="../process_php/' . $bannerPhotoLeft . '" alt="Left Side Banner Photo">';
                    echo '</a>';
                ?>
                </div>

                <div class="right-banner">
                    <div class="row">
                    <?php
                        foreach ($additionalPhotosRight as $photoPath) {
                            echo '<a href="../process_php/' . $photoPath . '" target="_blank">';
                            echo '<img src="' . '../process_php/' . $photoPath . '" alt="Right Side Banner Photo">';
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
                        echo '<a href="../process_php/' . $photoPath . '" target="_blank">';
                        echo '<img src="../process_php/' . $photoPath . '" alt="Additional Photo">';
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

                    <hr class="hrLine">
                    
                    <div class="property-amenities">

                        <div class="listingDetails-sub-title">
                            <h2>Property Amenities</h2>
                        </div>
                        <!-- Features -->
                        <div class="column-container">
                            <div class="column-container-title">
                                <p>Features:</p>
                            </div>
                            <div class="column-items">
                                <div class="column-column">
                                    <ul>
                                        <?php
                                        // Assuming $features is an array containing the features data
                                        $totalFeatures = count($features);
                                        $featuresPerColumn = ceil($totalFeatures / 3);

                                        // Loop through the features and divide them into columns
                                        $featureCounter = 0;
                                        foreach ($features as $feature) {
                                            echo '<li class="column-item">' . $feature . '</li>';
                                            $featureCounter++;

                                            // Start a new column after a certain number of features
                                            if ($featureCounter % $featuresPerColumn === 0 && $featureCounter !== $totalFeatures) {
                                                echo '</ul></div><div class="column-column"><ul>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Kitchen -->
                        <div class="column-container">
                            <div class="column-container-title">
                                <p>Kitchen:</p>
                            </div>
                            <div class="column-items">
                                <div class="column-column">
                                    <ul>
                                        <?php
                                        // Assuming $features is an array containing the features data
                                        $totalKitchens = count($kitchens);
                                        $kitchensPerColumn = ceil($totalKitchens / 3);

                                        // Loop through the features and divide them into columns
                                        $kitchensCounter = 0;
                                        foreach ($kitchens as $kitchen) {
                                            echo '<li class="column-item">' . $kitchen . '</li>';
                                            $kitchensCounter++;

                                            // Start a new column after a certain number of features
                                            if ($kitchensCounter % $kitchensPerColumn === 0 && $kitchensCounter !== $totalKitchens) {
                                                echo '</ul></div><div class="column-column"><ul>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Outdoor Spaces -->
                        <div class="column-container">
                            <div class="column-container-title">
                                <p>Outdoor Spaces:</p>
                            </div>
                            <div class="column-items">
                                <div class="column-column">
                                    <ul>
                                        <?php
                                        // Assuming $features is an array containing the features data
                                        $totalOutdoorSpaces = count($outdoorSpaces);
                                        $outdoorSpacesPerColumn = ceil($totalOutdoorSpaces / 3);

                                        // Loop through the features and divide them into columns
                                        $outdoorSpacesCounter = 0;
                                        foreach ($outdoorSpaces as $outdoorSpace) {
                                            echo '<li class="column-item">' . $outdoorSpace . '</li>';
                                            $outdoorSpacesCounter++;

                                            // Start a new column after a certain number of features
                                            if ($outdoorSpacesCounter % $outdoorSpacesPerColumn === 0 && $outdoorSpacesCounter !== $totalOutdoorSpaces) {
                                                echo '</ul></div><div class="column-column"><ul>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Living Spaces -->
                        <div class="column-container">
                            <div class="column-container-title">
                                <p>Living Spaces:</p>
                            </div>
                            <div class="column-items">
                                <div class="column-column">
                                    <ul>
                                        <?php
                                        // Assuming $features is an array containing the features data
                                        $totalLivingSpaces = count($livingSpaces);
                                        $livingSpacesPerColumn = ceil($totalLivingSpaces / 3);

                                        // Loop through the features and divide them into columns
                                        $livingSpacesCounter = 0;
                                        foreach ($livingSpaces as $livingSpace) {
                                            echo '<li class="column-item">' . $livingSpace . '</li>';
                                            $livingSpacesCounter++;

                                            // Start a new column after a certain number of features
                                            if ($livingSpacesCounter % $livingSpacesPerColumn === 0 && $livingSpacesCounter !== $totalLivingSpaces) {
                                                echo '</ul></div><div class="column-column"><ul>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <!-- Utilities -->
                        <div class="column-container">
                            <div class="column-container-title">
                                <p>Utilities:</p>
                            </div>
                            <div class="column-items">
                                <div class="column-column">
                                    <ul>
                                        <?php
                                        // Assuming $features is an array containing the features data
                                        $totalUtilities = count($utilities);
                                        $utilitiesPerColumn = ceil($totalUtilities / 3);

                                        // Loop through the features and divide them into columns
                                        $utilitiesCounter = 0;
                                        foreach ($utilities as $utilitie) {
                                            echo '<li class="column-item">' . $utilitie . '</li>';
                                            $utilitiesCounter++;

                                            // Start a new column after a certain number of features
                                            if ($utilitiesCounter % $utilitiesPerColumn === 0 && $utilitiesCounter !== $totalUtilities) {
                                                echo '</ul></div><div class="column-column"><ul>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="description">
                        <div class="listingDetails-sub-title">
                            <h2>Description:</h2>
                        </div>
                        <ul>
                            <?php
                            foreach ($descriptionLines as $line) {
                                echo '<p class="description-details">' . $line . '</p>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="right-details">
                    <div class="contact-information">
                        <h3>Contact This Property</h3>
                        <p><?php echo $row['f_name'] . ' ' . $row['l_name']; ?></p>
                        <p><?php echo $row['email']; ?></p>
                        <p id="pNo"><?php echo $row['p_no']; ?></p>
                    </div>
                </div>
            </div>
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

