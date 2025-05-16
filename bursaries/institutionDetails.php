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
    <title>Institution Details</title>
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
    width: 100%; /* Ensures it is always full-width on small devices */
}

.next-btn:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .form-group {
        flex: 1 1 100%; /* Stack items on smaller screens */
    }
    .container {
        width: 120%; /* Ensure the container takes full width */
    }
    .next-btn {
        padding: 12px 15px;
        font-size: 18px;
        display: block;
        margin-top: 20px;
        text-align: center; /* Ensure button text is centered */
    }
}

    </style>
</head>
<body>
 
        <form action="submit_institution_details.php" method="POST">
            <h4>Enter Your Institutional Details</h4>
            <div class="form-container">
                <div class="form-group">
                    <label for="institutionName">Institution Name:</label>
                    <input type="text" name="institutionName" required>
                </div>
                <div class="form-group">
                    <label for="course">Course Name:</label>
                    <input type="text" name="course" required>
                </div>
                <div class="form-group">
                    <label for="registrationNumber">Registration Number:</label>
                    <input type="text" name="registrationNumber" required>
                </div>
                <div class="form-group">
                    <label for="yearOfStudy">Year of Study:</label>
                    <select name="yearOfStudy" required>
                        <option value="" disabled selected>Select Year of Study</option>
                        <option value="1">Year 1</option>
                        <option value="2">Year 2</option>
                        <option value="3">Year 3</option>
                        <option value="4">Year 4</option>
                        <option value="5">Year 5</option>
                        <option value="6">Year 6</option>
                        <!-- Add more options if necessary -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="institutionAddress">Institution Address:</label>
                    <input type="text" name="institutionAddress" required>
                </div>
                <div class="form-group">
                    <label for="institutionPhone">Institution Phone:</label>
                    <input type="text" name="institutionPhone" required>
                </div>
                <div class="form-group">
                    <label for="institutionEmail">Institution Email:</label>
                    <input type="email" name="institutionEmail" required>
                </div>
                <div class="form-group">
                    <label for="dateOfAdmission">Date of Admission:</label>
                    <input type="date" name="dateOfAdmission" required>
                </div>
                <div class="form-group">
                    <label for="courseDuration">Course Duration:</label>
                    <input type="text" name="courseDuration" required>
                </div>
            </div>
            <button type="submit" class="submit-btn">Save</button>
            <h2><a href="#" class="next-btn" onclick="loadContent('attachments.php')">Next >Attachments</a></h2>
        </form>        
    </div>
</body>
</html>
