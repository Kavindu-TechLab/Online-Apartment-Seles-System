<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
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

    $uploadedImages = array();
    $targetDirectory = "uploads/listings_photoes/";

    // Check if files were uploaded
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
        // No images were uploaded, handle this case accordingly
        $imagePaths = "";
    }

    include('db_connection.php');

    // Insert data into the database
    $sql = "INSERT INTO listing_details (listing_type, title, property_type, address, city, total_units, bedrooms, bathrooms, price, size, features, kitchen, outdoor_spaces, living_spaces, utilities, li_image, description, f_name, l_name, email, p_no)
            VALUES ('$listingType', '$title', '$propertyType', '$address', '$city', '$totalUnits', '$bedrooms', '$bathrooms', '$price', '$size', '$features', '$kitchens', '$outdoorSpaces', '$livingSpaces', '$utilities', '$imagePaths', '$description', '$firstName', '$lastName', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>