<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure that code execution stops after the redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            display: flex;
            margin: 10px;
        }

        .left-section {
            flex: 2;
            border: 1px solid #543d21;
            background: #543d21;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            width: 30%;
            font-style: Bold;
            color: white;
            
        }

        .right-section {
            flex: 10;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 10px;
            width: 70%;
            font-size: medium;
        }
        
        .round-image {
            border: 2px solid #ccc;
            border-radius: 50%;
        }
        
        .button {
            margin-top: 10px;
            width: 150px;
            background-color: #ddd;
            border: 3px #F28A0A solid;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 6px 4px;
            cursor: pointer;
            border-radius: 16px;
            color: #F28A0A;
            font-size: 15px;
            font-family: Josefin Sans;
            font-weight: 700;
            text-transform: capitalize;
            line-height: 15px;
            text-transform: capitalize;
        }
        ul{
            list-style: none;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img style="height: 120px; width: 130px; border-radius: 50%;" src="C:\Users\MSii\Pictures\IMG_6523.png" alt="Profile Picture">
            <p style="font-size: 30px;">John Doe</p>
            <p>User ID: 12345</p>
            <ul>
                <li><button class="button">Home</button></li>
                <li><button class="button">Personal Details</button></li>
                <li><button class="button">My Listings</button></li>
                <li><button class="button">Terms & Conditions</button></li>
                <li><button class="button">Privercy & Policy</button></li>
            </ul>
        </div>
        <div class="right-section">
            <h1 style="color: #F28A0A;">My Account</h1>
            <hr style="width: 100%; border: 2px #F28A0A solid">
            <h2>Personal Information</h2>
            <table style="border-spacing: 20px;">
                <tr>
                    <td><label for="first-name">First Name:</label></td>
                    <td><label for="last-name">Last Name:</label><br></td>
                </tr>
                <tr>
                    <td><input type="text" id="first-name" name="first-name" required></td>
                    <td><input type="text" id="last-name" name="last-name" required><br></td>
                </tr>
                <tr>
                    <td><label for="phone-number">Phone Number:</label></td>
                </tr>
                <tr>
                    <td><input type="tel" id="phone-number" name="phone-number" required><br></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                </tr>
                <tr><td><input type="number" id="address" name="address" required><br></td></tr>
                <tr><td><input type="text" id="address" name="address" required><br></td></tr>
                <tr><td><input type="text" id="address" name="address" required><br></td></tr>
                <tr>
                    <td><label for="city" name="city">City</label></td>
                    <td><label for="state" name="state">State</label></td>
                    <td><label for="postcode" name="postcode">Post Code</label></td>
                </tr>
                <tr>
                    <td><input type="text" id="city" name="city" required><br></td>
                    <td><input type="text" id="state" name="state" required><br></td>
                    <td><input type="number" id="postcode" name="postcode" required><br></td>
                </tr>
            </table>
            <button class="button">Submit</button>
            <h3>Change Email</h3>
            <table>
                <tr>
                    <td><label for="new-email">New Email:</label></td>
                    <td><input type="email" id="new-email" name="new-email" required><br></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required><br></td>
                </tr>
                <td><button class="button">Submit Changes</button></td>
            </table>
            <h2>Account Data</h2>
            <h style="font-size: 20px;">Deactivate Account</h>
            <p>By deactivating your account, you will no longer be able to access your account or sign in to Apartments.com.</p>
            <button class="button">Deactivate Account</button>
        </div>
    </div>
</body>
</html>
