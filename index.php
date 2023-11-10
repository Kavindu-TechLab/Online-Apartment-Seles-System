<?php
session_start();
include('process_php/db_connection.php');

$sql = "SELECT * FROM feedback_web ORDER BY date DESC";
$result = $conn->query($sql);

// Fetch feedback records and store them in an array
$feedbacks = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_index.css">
    <link rel="stylesheet" type="text/css" href="style/style_all_listings.css">
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
                <p style="color: rgba(84, 61, 33, 1);">SOLUTIONS</p>
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

        <div class="search-container">
            <form action="all_listings.php" method="GET">
                <div class="search-group">
                    <input type="text" id="search-input" name="location" placeholder="Search Location..." required>
                    <button type="submit" id="search-button"><img src="images/search.png" alt="Search"></button>
                </div>
            </form>
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

    <div class="bottom_content">
        <div class="bottom-left-item">
            <div class="rectangle"></div>
            <img class="bottom-img1" src="images/bottomimg1.jpg" alt="">
            <img class="bottom-img2" src="images/bottomimg2.jpg" alt="">
        </div>
        <div class="bottom-right-item">
            <div class="sub-title">
                <img src="images/Arrow1.png" alt="Arrow" class="arrow">
                <p style="color: rgba(84, 61, 33, 1);">OUR VALUE</p>
            </div>
            <div class="bottom-content">
                <p style="color: rgba(84, 61, 33, 1);">Unlocking</p>
                <p style="color: rgba(84, 61, 33, 1);">Real Appraisal</p>
                <p style="color: rgb(242, 138, 10);">Services.</p>
                <div class="content-button-section">
                    <a href="register.php" class="button">Get Start Free</a>
                    <p style="color: rgba(84, 61, 33, 1);">Our experts can provide valuable insights <br>and assist you in identifying properties.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="why-best">
        <div class="sub-title1">
                <p style="color: rgba(84, 61, 33, 1);">Why ApariMint is the <span style="color: rgb(242, 138, 10);"><br>Best?</span></p>
            </div>
        </div>

        <div class="why-allbox">
            <div class="why-box">
                <h3>1 Million +<br>Property Listings</h3>
                <img src="images/checklist.png" alt="">
            </div>
            <div class="why-box">
                <h3>1 Million +<br>Active Users</h3>
                <img src="images/team.png" alt="">
            </div>
            <div class="why-box">
                <h3>26 <br>District Covered</h3>
                <img src="images/country.png" alt="">
            </div>
            <div class="why-box">
                <h3>1 Million +<br>Seles</h3>
                <img src="images/sales.png" alt="">
            </div>
        </div>

        <div class="feedback-view">
            <div class="left-section">
                <h1 style="color: rgba(84, 61, 33, 1);">Our Customers</h1>
                <h1 style="color: rgba(84, 61, 33, 1);">Think We Are</h1>
                <h1 style="color: rgb(242, 138, 10);">The Best</h1>   
            </div>
            <div class="right-section">
                <div class="customer-feedback-container">
                    <?php
                    foreach ($feedbacks as $feedback) {
                    ?>
                        <div class="customer-feedback">
                            <div class="customer-info">
                                <div class="feed-top-left">
                                    <img src="images/language-learning.png" alt="">
                                </div> 
                                <div class="customer-rating">
                                    <!-- Display customer rating stars based on feedback_rating value -->
                                    <?php
                                    $rating = $feedback['feedback_rating'];
                                    echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                                    ?>
                                </div>
                            </div>
                            <div class="customer-date">
                                <?php echo htmlspecialchars($feedback['date']); ?>
                            </div>
                            <div class="customer-heading">
                                <?php echo htmlspecialchars($feedback['feedback_head']); ?>
                            </div>
                            <div class="customer-description">
                                <?php echo htmlspecialchars($feedback['feedback_discription']); ?>
                            </div>
                            <div class="customer-details">
                                <div class="customer-name"><img src="images/user1.png" alt=""><?php echo htmlspecialchars($feedback['feedback_name']); ?></div>
                                <img src="images/check.png" style="width: 25px; height:25px;">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button class="scroll-left">&lt;</button>
                <button class="scroll-right">&gt;</button>
            </div>
        </div>

        
        
        <div class="add-feedback">
            <form action="process_php/process_feebback.php" method="post">
                <div class="feedback-box1">
                    <h4>5.0<br>Excellent <br>Add Your Rating</h4>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" required>
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4" required>
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3" required>
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2" required>
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1" required>
                        <label for="star1"></label>
                    </div>

                    <h3 style="background-color:rgba(242, 138, 10); color: #fff;">Out of 5</h3>
                </div>
                <div class="feedback-box2">   
                    <div class="write-review">
                        <input class="small-input" type="text" name="name" placeholder="We'd love to know your name! 😊" required><br>
                
                        <input class="small-input" type="text" name="heading" placeholder="Sum up your feedback in a headline!" required><br>
                        
                        <textarea class="discription" name="description" placeholder="Your feedback matters! Tell us more in the description." required></textarea><br>
                        
                        <input class="button" type="submit" value="Submit Rating">
                    </div>                        
                </div>
            </form>
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

        document.querySelector('.scroll-left').addEventListener('click', function() {
        document.querySelector('.customer-feedback-container').scrollLeft -= 100; 
        });

        document.querySelector('.scroll-right').addEventListener('click', function() {
        document.querySelector('.customer-feedback-container').scrollLeft += 100;
        });
        
    </script>

</body>
</html>
