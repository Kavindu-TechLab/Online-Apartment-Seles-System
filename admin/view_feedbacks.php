<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection file
include('../process_php/db_connection.php');

// Check for a valid database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

// Retrieve search term if provided
$searchTerm = isset($_GET['feedbacks']) ? $_GET['feedbacks'] : '';

// Construct the SQL query with the WHERE clause for searching feedbacks
$sql = "SELECT * FROM feedback_web";

// Add condition based on the provided search term
if (!empty($searchTerm)) {
    $sql .= " WHERE feedback_head LIKE '%$searchTerm%' OR feedback_discription LIKE '%$searchTerm%' OR feedback_name LIKE '%$searchTerm%'";
}

$sql .= " ORDER BY date DESC";
$result = $conn->query($sql);

// Fetch feedback records and store them in an array
$feedbacks = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Feedbacks</title>
        <link rel="stylesheet" type="text/css" href="../style/style_myAccount.css">
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
            <div class="right-section">
                <a class="logo1" href="admin_dashboard.php"><img src="../images/logo.png" alt="Logo"></a>
                <a href="view_feedbacks.php"><h1 class="main-title">Feedbacks</h1></a>
                <hr style="width: 100%; border: 2px #F28A0A solid">

                <!-- Search form -->
                <form action="view_feedbacks.php" method="GET">
                    <div class="search-container">
                        <div class="search-group">
                            <input type="text" id="search-input" name="feedbacks" placeholder="Search Feedbacks..." value="<?php echo $searchTerm; ?>">
                            <button type="submit" id="search-button"><img src="../images/search.png" alt="Search"></button>
                        </div>
                    </div>
                </form>

                <div class="customer-feedback-container">
                    <?php
                    foreach ($feedbacks as $feedback) {
                    ?>
                        <div class="customer-feedback">
                            <div class="customer-info">
                                <div class="feed-top-left">
                                    <img src="../images/language-learning.png" alt="">
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
                                <div class="customer-name"><img src="../images/user1.png" alt=""><?php echo htmlspecialchars($feedback['feedback_name']); ?></div>
                                <img src="../images/check.png" style="width: 25px; height:25px;">
                            </div>
                            <!-- Delete button -->
                            <form action="process_php/delete_feedback.php" method="post">
                                <input type="hidden" name="feedback_web_id" value="<?php echo $feedback['feedback_web_id']; ?>">
                                <button type="submit" class="delete-button">Delete</button>
                            </form>

                        </div>
                    <?php
                    }
                    ?>
                </div>                
            </div>
        </div>
    </body>
</html>


