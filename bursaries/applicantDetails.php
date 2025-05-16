<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        /* Form Styles */
        form {
            width: 100%;
            max-width: 900px; /* Max width for large screens */
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border: 2px solid #ccc; /* Border around the form */
            border-radius: 8px; /* Optional, to give the form a rounded edge */
            position: relative;
            z-index: 100; /* Ensure the form is on top */
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form container for larger screens */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
            padding: 10px;
            position: relative; /* Ensure the form-container has a stacking context */
        }

        .form-group {
            flex: 1 1 calc(33.333% - 20px);
            min-width: 250px;
            background: #f4f4f4;
            padding: 10px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            border: 1px solid #ccc; /* Border around each form group */
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, select {
            padding: 8px;
            border: 1px solid #ccc; /* Border around input fields */
            border-radius: 5px;
            width: 100%; /* Ensure inputs fill available space */
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            border: 1px solid #ccc; /* Border around the submit button */
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        /* Next Button */
        .next-btn {
            display: inline-block;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            cursor: pointer;
        }

        .next-btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .form-group {
                flex: 1 1 100%; /* Stack items on smaller screens */
            }
            .container{
                width:120%;
            }
            }
        
    </style>
</head>
<body>
    <div class="container">
        <form action="submit_applicant.php" method="POST">
            <h4>Enter your personal Details</h4>
            <div class="form-container">
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" name="surname" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="otherNames">Other Names:</label>
                    <input type="text" name="otherNames" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="idNumber">Birth Cert/ID Number:</label>
                    <input type="text" name="idNumber" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="postalAddress">Postal Address:</label>
                    <input type="text" name="postalAddress" required>
                </div>
                <div class="form-group">
                    <label for="postalCode">Postal Code:</label>
                    <input type="text" name="postalCode" required>
                </div>
                <div class="form-group">
                    <label for="subCounty">Sub-County:</label>
                    <input type="text" name="subCounty" required>
                </div>
                <div class="form-group">
                    <label for="ward">Ward:</label>
                    <input type="text" name="ward" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" required>
                </div>
                <div class="form-group">
                    <label for="subLocation">Sub-location:</label>
                    <input type="text" name="subLocation" required>
                </div>
                <div class="form-group">
                    <label for="village">Village:</label>
                    <input type="text" name="village" required>
                </div>
                <div class="form-group">
                    <label for="pollingStation">Polling Station:</label>
                    <input type="text" name="pollingStation" required>
                </div>
            </div>
            <button type="submit" class="submit-btn">Save</button>
            <h2><a href="#" class="next-btn" onclick="loadContent('institutionDetails.php')">Next > Institution Details</a></h2>
        </form>
        
    </div>
</body>
</html>
