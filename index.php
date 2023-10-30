<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_index.css">
    <link rel="stylesheet" type="text/css" href="style/style_listings.css">
</head>
<body>
    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="banner">
        <img src="images/banner.png" alt="Banner Photo">
        <div class="banner-content">
            <div class="left-content">
                <h1 style="color: rgb(242, 138, 10);">Welcome to</h1>
                <h1 style="color: rgba(84, 61, 33, 1);">Sri Lanka's Premier</h1>
                <h1 style="color: rgba(84, 61, 33, 1);">Apartment Sales</h1>
                <h1 style="color: rgba(84, 61, 33, 1);">and Renting Hub</h1>
                <p style="color: rgba(84, 61, 33, 1);">Discover your dream living space amidst the lush landscapes and stunning cityscapes of Sri Lanka. Our website is your gateway to a world of luxurious, comfortable, and affordable apartments for sale and rent across this beautiful island nation.</p>
                <a href="all_listings.php" class="main-button">Look Apartments</a>
            </div>
        </div>
        <div class="right-content">
            <img src="images/small-banner.jpg" alt="Apartment Photo">
        </div>
    </div>

    <div class="top_content">
        <div class="left-item">
            <div class="sub-title">
                <img src="images/Arrow1.png" alt="Arrow" class="arrow">
                <p>SOLUTIONS</p>
            </div>
            <div class="content">
                <p style="color: rgba(84, 61, 33, 1);">We Assist Buyers</p>
                <p style="color: rgba(84, 61, 33, 1);">In Finding their</p>
                <p style="color: rgb(242, 138, 10);">Dream Homes.</p>
                <div class="content-button-section">
                    <a href="register.php" class="button">Get Start Free</a>
                    <p style="color: rgba(84, 61, 33, 1);">Our agents will guide you Through the <br>brentire buying process from property.</p>
                </div>
            </div>
        </div>
        <div class="right-item">
            <div class="slideshow-container">
                <?php
                $images = glob('images/slide-show/*.jpg');
                foreach ($images as $index => $image) {
                    if (is_readable($image)) {
                        echo '<div class="mySlides';
                        if ($index === 0) {
                            echo ' active';
                        }
                        echo '">';
                        echo '<img src="' . $image . '" alt="Slideshow Image">';
                        echo '</div>';
                    } 
                }
                ?>
            </div>
        </div>
    </div>

    <div class="least-post">
        <div class="sub-title1">
            <p style="color: rgba(84, 61, 33, 1);">Find Your <span style="color: rgb(242, 138, 10);">Dream</span> <br>Apartment here</p>
        </div>  
        
        <div class="all-listing-container">
            <?php
            include('process_php/db_connection.php'); 

            $sql = "SELECT * FROM listing_details ORDER BY date DESC LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="listing-container">';
                $propertyCount = 0;
                while($row = $result->fetch_assoc()) {

                    echo '<a href="listing_view.php?id=' . $row['id'] . '" class="property-link">';

                        $imagePaths = explode(',', $row['li_image']);
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

                        $propertyCount++;

                        if ($propertyCount >= 4) {
                            break;
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

        <div class="view-more">
            <a href="all_listings.php" class="button">View More</a>
        </div>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>

    <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000);
        }
    </script>

</body>
</html>
