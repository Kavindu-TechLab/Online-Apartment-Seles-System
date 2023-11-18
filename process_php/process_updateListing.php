<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listingId = $_GET['id'];
    $user_id = $_SESSION["user_id"];
    $listingType = $_POST["listingType"];
    $title = $_POST["title"];
    $propertyType = $_POST["propertyType"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $totalUnits = $_POST["totalUnits"];
    $bedrooms = $_POST["bedrooms"];
    $bathrooms = $_POST["bathrooms"];
    $price = $_POST["price"];
    $size = $_POST["size"];
    $description = $_POST["description"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $features = isset($_POST["features"]) ? implode(", ", $_POST["features"]) : "";
    $kitchens = isset($_POST["kitchens"]) ? implode(", ", $_POST["kitchens"]) : "";
    $outdoorSpaces = isset($_POST["outdoor_spaces"]) ? implode(", ", $_POST["outdoor_spaces"]) : "";
    $livingSpaces = isset($_POST["living_spaces"]) ? implode(", ", $_POST["living_spaces"]) : "";
    $utilities = isset($_POST["utilities"]) ? implode(", ", $_POST["utilities"]) : "";

    // Check if files were uploaded
    $uploadedImages = array();
    $targetDirectory = "uploads/listings_photoes/";

    if(isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
        foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
            $temp = $_FILES['image']['tmp_name'][$key];
            $image_name = $_FILES['image']['name'][$key];
            $target = $targetDirectory . $image_name;
            move_uploaded_file($temp, $target);
            $uploadedImages[] = $target;
        }

        // Convert the array of uploaded image paths to a comma-separated string
        $imagePaths = implode(",", $uploadedImages);
    } else {
        // No new images were uploaded, keep existing images
        $existingImages = $_POST['existingImages'];
        $imagePaths = $existingImages;
    }

    // Update data in the database and set approval_status to 'Pending'
    $sql = "UPDATE listing_details 
            SET approval_status='Pending', listing_type='$listingType', title='$title', property_type='$propertyType', address='$address', city='$city', 
            total_units='$totalUnits', bedrooms='$bedrooms', bathrooms='$bathrooms', price='$price', size='$size', 
            features='$features', kitchen='$kitchens', outdoor_spaces='$outdoorSpaces', living_spaces='$livingSpaces', 
            utilities='$utilities', li_image='$imagePaths', description='$description', f_name='$firstName', l_name='$lastName', 
            email='$email', p_no='$phone' 
            WHERE id='$listingId' AND user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the updated listing page or any other page as needed
        header("Location: ../wait_approve.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
