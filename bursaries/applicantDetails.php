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
        
        /* Added styling for error messages */
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        /* Styles for valid/invalid input borders (from your original code) */
        input:invalid {
            border-color: red;
        }
        input:valid {
            border-color: green;
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
        <form action="submit_applicant.php" method="POST" onsubmit="return validateForm()">
            <h4>Enter your personal Details</h4>
            <div class="form-container">
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="surname" placeholder="e.g. Muthoni" required>
                    <span id="surname-error" class="error-message"></span>
                </div>
                
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" placeholder="e.g. Wanjiru" required>
                    <span id="firstName-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="otherNames">Other Names:</label>
                    <input type="text" id="otherNames" name="otherNames" placeholder="e.g. Nyokabi">
                    <span id="otherNames-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                    <span id="dob-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <span id="gender-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="idNumber">Birth Cert/ID Number:</label>
                    <input type="text" id="idNumber" name="idNumber" 
                           placeholder="e.g. 12345678" 
                           pattern="[0-9]{8}" 
                           title="8-digit ID number" required>
                    <span id="idNumber-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" 
                           placeholder="e.g. example@domain.com" required>
                    <span id="email-error" class="error-message"></span>
                </div>
                
                <div class="form-group">
                    <label for="postalAddress">Postal Address:</label>
                    <input type="text" id="postalAddress" name="postalAddress" 
                            placeholder="e.g. P.O. Box 123" required>
                    <span id="postalAddress-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="postalCode">Postal Code:</label>
                    <input type="text" id="postalCode" name="postalCode" 
                            placeholder="e.g. 90100" 
                            pattern="[0-9]{5}" 
                            title="5-digit postal code" required>
                    <span id="postalCode-error" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="subCounty">Sub-County:</label>
                    <input type="text" id="subCounty" name="subCounty" 
                            placeholder="e.g. Makueni" required>
                    <span id="subCounty-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="ward">Ward:</label>
                    <select id="ward" name="ward" required>
                        <option value="">Select Ward</option>
                        <option value="Emali/Mulala">Emali/Mulala</option>
                        <option value="Makindu">Makindu</option>
                        <option value="Kikumbulyu North">Kikumbulyu North</option>
                        <option value="Kikumbulyu South">Kikumbulyu South</option>
                        <option value="Nguumo">Nguumo</option>
                        <option value="Nguu/Masumba">Nguu/Masumba</option>
                    </select>
                    <span id="ward-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" 
                            placeholder="e.g. Kibwezi" required>
                    <span id="location-error" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="subLocation">Sub-location:</label>
                    <input type="text" id="subLocation" name="subLocation" 
                            placeholder="e.g. Kibwezi East" required>
                    <span id="subLocation-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="village">Village:</label>
                    <input type="text" id="village" name="village" 
                            placeholder="e.g. Mwanyani" required>
                    <span id="village-error" class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="pollingStation">Polling Station:</label>
                    <input type="text" id="pollingStation" name="pollingStation" 
                            placeholder="e.g. Mwanyani Primary School" required>
                    <span id="pollingStation-error" class="error-message"></span>
                </div>
            </div>
            <button type="submit" class="submit-btn">Save</button>
            
            <h2><a href="#" class="next-btn" onclick="loadContent('institutionDetails.php')">Next > Institution Details</a></h2>
        </form>
        
    </div>

    <script>
        // Function to validate surname
        function validateSurname() {
            const surnameInput = document.getElementById('surname');
            const surnameError = document.getElementById('surname-error');
            const surname = surnameInput.value.trim();

            if (surname === '') {
                surnameError.textContent = 'Surname is required.';
                surnameInput.setCustomValidity('Surname is required.'); // For native HTML5 validation
                return false;
            } else if (!/^[a-zA-Z\s]+$/.test(surname)) { // Only allows letters and spaces
                surnameError.textContent = 'Surname can only contain letters and spaces.';
                surnameInput.setCustomValidity('Surname can only contain letters and spaces.'); // For native HTML5 validation
                return false;
            } else {
                surnameError.textContent = ''; // Clear error if valid
                surnameInput.setCustomValidity(''); // Clear custom validity
                return true;
            }
        }

        // Function to validate First Name
        function validateFirstName() {
            const firstNameInput = document.getElementById('firstName');
            const firstNameError = document.getElementById('firstName-error');
            const firstName = firstNameInput.value.trim();

            if (firstName === '') {
                firstNameError.textContent = 'First Name is required.';
                firstNameInput.setCustomValidity('First Name is required.');
                return false;
            } else if (!/^[a-zA-Z\s]+$/.test(firstName)) { // Only allows letters and spaces
                firstNameError.textContent = 'First Name can only contain letters and spaces.';
                firstNameInput.setCustomValidity('First Name can only contain letters and spaces.');
                return false;
            } else {
                firstNameError.textContent = '';
                firstNameInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Other Names (optional, basic check for now)
        function validateOtherNames() {
            const otherNamesInput = document.getElementById('otherNames');
            const otherNamesError = document.getElementById('otherNames-error');
            const otherNames = otherNamesInput.value.trim();

            // Only validate if not empty
            if (otherNames !== '' && !/^[a-zA-Z\s]*$/.test(otherNames)) {
                otherNamesError.textContent = 'Other Names can only contain letters and spaces.';
                otherNamesInput.setCustomValidity('Other Names can only contain letters and spaces.');
                return false;
            } else {
                otherNamesError.textContent = '';
                otherNamesInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Date of Birth
        function validateDob() {
            const dobInput = document.getElementById('dob');
            const dobError = document.getElementById('dob-error');
            const dob = new Date(dobInput.value);
            const today = new Date();
            const minAge = 18; // Example: Minimum age requirement
            const minDate = new Date();
            minDate.setFullYear(today.getFullYear() - minAge);

            if (dobInput.value === '') { // Check if input is empty
                dobError.textContent = 'Date of Birth is required.';
                dobInput.setCustomValidity('Date of Birth is required.');
                return false;
            } else if (isNaN(dob.getTime())) { // Check for invalid date (e.g., malformed input)
                dobError.textContent = 'Please enter a valid date.';
                dobInput.setCustomValidity('Please enter a valid date.');
                return false;
            } else if (dob > today) {
                dobError.textContent = 'Date of Birth cannot be in the future.';
                dobInput.setCustomValidity('Date of Birth cannot be in the future.');
                return false;
            } else if (dob > minDate) { // Check for minimum age
                dobError.textContent = `You must be at least ${minAge} years old.`;
                dobInput.setCustomValidity(`You must be at least ${minAge} years old.`);
                return false;
            }
            else {
                dobError.textContent = '';
                dobInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Gender
        function validateGender() {
            const genderInput = document.getElementById('gender');
            const genderError = document.getElementById('gender-error');
            const gender = genderInput.value;

            if (gender === '') {
                genderError.textContent = 'Gender is required.';
                genderInput.setCustomValidity('Gender is required.');
                return false;
            } else {
                genderError.textContent = '';
                genderInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate ID Number
        function validateIdNumber() {
            const idNumberInput = document.getElementById('idNumber');
            const idNumberError = document.getElementById('idNumber-error');
            const idNumber = idNumberInput.value.trim();

            if (idNumber === '') {
                idNumberError.textContent = 'ID Number is required.';
                idNumberInput.setCustomValidity('ID Number is required.');
                return false;
            } else if (!/^[0-9]{8}$/.test(idNumber)) { // Strictly 8 digits
                idNumberError.textContent = 'ID Number must be an 8-digit number.';
                idNumberInput.setCustomValidity('ID Number must be an 8-digit number.');
                return false;
            } else {
                idNumberError.textContent = '';
                idNumberInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Email Address
        function validateEmail() {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const email = emailInput.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Standard email regex

            if (email === '') {
                emailError.textContent = 'Email address is required.';
                emailInput.setCustomValidity('Email address is required.');
                return false;
            } else if (!emailPattern.test(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                emailInput.setCustomValidity('Please enter a valid email address.');
                return false;
            } else {
                emailError.textContent = '';
                emailInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Postal Address
        function validatePostalAddress() {
            const postalAddressInput = document.getElementById('postalAddress');
            const postalAddressError = document.getElementById('postalAddress-error');
            const postalAddress = postalAddressInput.value.trim();

            if (postalAddress === '') {
                postalAddressError.textContent = 'Postal Address is required.';
                postalAddressInput.setCustomValidity('Postal Address is required.');
                return false;
            } else {
                postalAddressError.textContent = '';
                postalAddressInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Postal Code
        function validatePostalCode() {
            const postalCodeInput = document.getElementById('postalCode');
            const postalCodeError = document.getElementById('postalCode-error');
            const postalCode = postalCodeInput.value.trim();

            if (postalCode === '') {
                postalCodeError.textContent = 'Postal Code is required.';
                postalCodeInput.setCustomValidity('Postal Code is required.');
                return false;
            } else if (!/^[0-9]{5}$/.test(postalCode)) {
                postalCodeError.textContent = 'Postal Code must be 5 digits.';
                postalCodeInput.setCustomValidity('Postal Code must be 5 digits.');
                return false;
            } else {
                postalCodeError.textContent = '';
                postalCodeInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Sub-County
        function validateSubCounty() {
            const subCountyInput = document.getElementById('subCounty');
            const subCountyError = document.getElementById('subCounty-error');
            const subCounty = subCountyInput.value.trim();

            if (subCounty === '') {
                subCountyError.textContent = 'Sub-County is required.';
                subCountyInput.setCustomValidity('Sub-County is required.');
                return false;
            } else if (!/^[a-zA-Z\s]+$/.test(subCounty)) {
                subCountyError.textContent = 'Sub-County can only contain letters and spaces.';
                subCountyInput.setCustomValidity('Sub-County can only contain letters and spaces.');
                return false;
            } else {
                subCountyError.textContent = '';
                subCountyInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Ward
        function validateWard() {
            const wardInput = document.getElementById('ward');
            const wardError = document.getElementById('ward-error');
            const ward = wardInput.value;

            if (ward === '') {
                wardError.textContent = 'Ward is required.';
                wardInput.setCustomValidity('Ward is required.');
                return false;
            } else {
                wardError.textContent = '';
                wardInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Location
        function validateLocation() {
            const locationInput = document.getElementById('location');
            const locationError = document.getElementById('location-error');
            const location = locationInput.value.trim();

            if (location === '') {
                locationError.textContent = 'Location is required.';
                locationInput.setCustomValidity('Location is required.');
                return false;
            } else if (!/^[a-zA-Z0-9\s,.]+$/.test(location)) { // Allow letters, numbers, spaces, commas, periods
                locationError.textContent = 'Location contains invalid characters.';
                locationInput.setCustomValidity('Location contains invalid characters.');
                return false;
            } else {
                locationError.textContent = '';
                locationInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Sub-location
        function validateSubLocation() {
            const subLocationInput = document.getElementById('subLocation');
            const subLocationError = document.getElementById('subLocation-error');
            const subLocation = subLocationInput.value.trim();

            if (subLocation === '') {
                subLocationError.textContent = 'Sub-location is required.';
                subLocationInput.setCustomValidity('Sub-location is required.');
                return false;
            } else if (!/^[a-zA-Z0-9\s,.]+$/.test(subLocation)) {
                subLocationError.textContent = 'Sub-location contains invalid characters.';
                subLocationInput.setCustomValidity('Sub-location contains invalid characters.');
                return false;
            } else {
                subLocationError.textContent = '';
                subLocationInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Village
        function validateVillage() {
            const villageInput = document.getElementById('village');
            const villageError = document.getElementById('village-error');
            const village = villageInput.value.trim();

            if (village === '') {
                villageError.textContent = 'Village is required.';
                villageInput.setCustomValidity('Village is required.');
                return false;
            } else if (!/^[a-zA-Z0-9\s,.]+$/.test(village)) {
                villageError.textContent = 'Village contains invalid characters.';
                villageInput.setCustomValidity('Village contains invalid characters.');
                return false;
            } else {
                villageError.textContent = '';
                villageInput.setCustomValidity('');
                return true;
            }
        }

        // Function to validate Polling Station
        function validatePollingStation() {
            const pollingStationInput = document.getElementById('pollingStation');
            const pollingStationError = document.getElementById('pollingStation-error');
            const pollingStation = pollingStationInput.value.trim();

            if (pollingStation === '') {
                pollingStationError.textContent = 'Polling Station is required.';
                pollingStationInput.setCustomValidity('Polling Station is required.');
                return false;
            } else {
                pollingStationError.textContent = '';
                pollingStationInput.setCustomValidity('');
                return true;
            }
        }


        // Add event listeners for real-time validation
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('surname').addEventListener('input', validateSurname);
            document.getElementById('firstName').addEventListener('input', validateFirstName);
            document.getElementById('otherNames').addEventListener('input', validateOtherNames);
            document.getElementById('dob').addEventListener('change', validateDob);
            document.getElementById('gender').addEventListener('change', validateGender);
            document.getElementById('idNumber').addEventListener('input', validateIdNumber);
            document.getElementById('email').addEventListener('input', validateEmail);
            document.getElementById('postalAddress').addEventListener('input', validatePostalAddress);
            document.getElementById('postalCode').addEventListener('input', validatePostalCode);
            document.getElementById('subCounty').addEventListener('input', validateSubCounty);
            document.getElementById('ward').addEventListener('change', validateWard);
            document.getElementById('location').addEventListener('input', validateLocation);
            document.getElementById('subLocation').addEventListener('input', validateSubLocation);
            document.getElementById('village').addEventListener('input', validateVillage);
            document.getElementById('pollingStation').addEventListener('input', validatePollingStation);
        });

        // Overall form validation before submission
        function validateForm() {
            let isValid = true;

            // Call all individual validation functions.
            // Run them all first to display all errors at once.
            const surnameValid = validateSurname();
            const firstNameValid = validateFirstName();
            const otherNamesValid = validateOtherNames();
            const dobValid = validateDob();
            const genderValid = validateGender();
            const idNumberValid = validateIdNumber();
            const emailValid = validateEmail();
            const postalAddressValid = validatePostalAddress();
            const postalCodeValid = validatePostalCode();
            const subCountyValid = validateSubCounty();
            const wardValid = validateWard();
            const locationValid = validateLocation();
            const subLocationValid = validateSubLocation();
            const villageValid = validateVillage();
            const pollingStationValid = validatePollingStation();

            // Combine results to determine overall form validity
            isValid = surnameValid && firstNameValid && otherNamesValid && dobValid && genderValid &&
                      idNumberValid && emailValid && postalAddressValid && postalCodeValid &&
                      subCountyValid && wardValid && locationValid && subLocationValid &&
                      villageValid && pollingStationValid;

            return isValid; // Prevent form submission if any validation fails
        }

        // Function to load content (from your existing code)
        function loadContent(page) {
            // This function would typically fetch and display content from the specified page
            // For now, we'll just navigate
            window.location.href = page;
        }
    </script>
</body>
</html>