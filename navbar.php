<nav class="navbar">
    <div class="navbar-left">
        <a href="index.php"><img src="images/logo1.png" alt="Logo"></a>
    </div>
    <div class="navbar-right">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="all_listings.php">Property Listings</a></li>
            <?php
            // Check if the user is logged in
            if(isset($_SESSION["user_id"])) {
                // If logged in, show user's name and profile photo with dropdown menu
                echo '<li class="dropdown">';
                $userName = $_SESSION["user_name"];
                $truncatedName = (strlen($userName) > 15) ? substr($userName, 0, 15) . '...' : $userName;
                echo '<span class="dropbtn"><img class="profile_photo" src="process_php/uploads/profile_photos/' . $_SESSION["user_profile_photo"] . '" alt="Profile Photo">' . $truncatedName . '</span>';
                echo '<div class="dropdown-content">';
                echo '<a href="myAccount.php">My Account</a>';
                echo '<a href="process_php/process_logout.php">Logout</a>';
                echo '</div>';
                echo '</li>';
            } else {
                // If not logged in, show login and "Get Started Free" button
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php" class="button">Get Started Free</a></li>';
            }
            ?>
            <li><a href="addListings.php" class="button">Add Property</a></li>
            <!-- Add more navigation links as needed -->
        </ul>
    </div>
</nav>
