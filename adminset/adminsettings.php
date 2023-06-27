<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Retrieve the user ID from the session
$user_id = $_SESSION["user_id"];

// Retrieve the user details from the database based on the user ID
$conn = new mysqli("localhost", "root", "", "AlumniSphere");
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM signup2 WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result(
    $id,
    $fullName,
    $address,
    $phoneNumber,
    $industry,
    $graduationYear,
    $gender,
    $birthday
);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare(
    "SELECT username, email, password FROM signup1 WHERE user_id = ?"
);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $password);
$stmt->fetch();
$stmt->close();
$conn->close();

// Redirect to the settings page with a success message
if (isset($_GET["success"]) && $_GET["success"] == 1) {
    echo "<script>alert('Profile Updated!');</script>";
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="../adminset/adminsettings.css">
    <link rel="stylesheet"
        href="../adminset/adminsettingsbox.css">
    <title>AlumniSphere</title>
</head>

<body>
    <!-- Header -->
    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand"> <a
                        href="../admin-dashboard.html">
                        <h1><span>A</span>lumni
                            <span>S</span>phere
                        </h1>
                    </a> </div>
                <div class="nav-list">
                    <div
                        class="hamburger">
                        <div
                            class="bar">
                        </div>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="../admin-dashboard.html"
                                    data-after="Home">Home</a>
                            </li>
                            <li><a href="#Connection"
                                    data-after="Connection">Connection</a>
                            </li>
                            <li><a href="#Management"
                                    data-after="Management">Management</a>
                            </li>
                            <li><a href="settings.php"
                                    data-after="Setting">Settings</a>
                            </li>
                            <li><a href="../VCP/login.html"
                                    data-after="Logout">Logout</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section> <!-- End Header -->

    <!-- Rectangle BG -->
    <div class="cardrec">
        <form action="../adminset/adminprofileupdate.php"
            method="post"
            enctype="multipart/form-data">


            <div class="row">
                <!-- Name -->
                <div
                    class="settingsbox">
                    <input
                        required="required"
                        type="text"
                        name="fullName"
                        value="<?php echo $fullName; ?>">
                    <span>Full
                        Name</span>
                    <i></i> </div>

                <!-- Address -->
                <div
                    class="settingsbox">
                    <input
                        required="required"
                        type="text"
                        name="address"
                        value="<?php echo $address; ?>">
                    <span>Address</span>
                    <i></i> </div>
            </div>


            <div class="row">
                <!-- Phone Number -->
                <div
                    class="settingsbox">
                    <input
                        required="required"
                        type="text"
                        name="phoneNumber"
                        value="<?php echo $phoneNumber; ?>">
                    <span>Phone
                        Number</span>
                    <i></i> </div>

                <!-- Industry -->
                <div
                    class="settingsbox">
                    <input
                        required="required"
                        type="text"
                        name="industry"
                        value="<?php echo $industry; ?>">
                    <span>Industry</span>
                    <i></i> </div>
            </div>


            <div class="row">
                <!-- Graduation Year -->
                <div
                    class="settingsbox">
                    <input
                        required="required"
                        type="text"
                        name="graduationYear"
                        value="<?php echo $graduationYear; ?>">
                    <span>Graduation
                        Year</span>
                    <i></i> </div>

                <!-- Email -->
            <div class="settingsbox">
                <input required="required" type="text" name="email" value="<?php echo $email; ?>">
                <span>Email</span>
                <i></i>
            </div>

            </div>

            <div class="row">
                <!-- Username -->
            <div class="settingsbox">
                <input required="required" type="text" name="username" value="<?php echo $username; ?>">
                <span>Username</span>
                <i></i>
            </div>

                <!-- Password -->
                <div class="settingsbox">
                    <input required="required" type="password" name="password" value="<?php echo $password; ?>">
                    <span>Password</span>
                    <i></i>
                </div>
            </div> 


            <script>
                //FullName
                document.querySelector('form').addEventListener('submit', function(event) {
                  var fullNameInput = document.getElementsByName("fullName")[0];
                  var fullName = fullNameInput.value.trim();
                  var regex = /^[A-Za-z\s]+$/;
                
                  if (!regex.test(fullName)) {
                    event.preventDefault(); // Prevent form submission
                    alert("Names should have no numeric characters and should only contain letters and spaces. Please correct it.");
                    fullNameInput.value = "";
                  }

                  //PhoneNumber
                  var phoneNumberInput = document.getElementsByName("phoneNumber")[0];
                  var phoneNumber = phoneNumberInput.value.trim();
                
                  if (phoneNumber.length !== 11 || !phoneNumber.startsWith("09")) {
                    alert("Phone Number should only contain 11 numbers and start with 09 (Philippines). Please correct it.");
                    phoneNumberInput.value = ""; // Clear the input value
                    event.preventDefault(); // Prevent form submission
                  }
                
                  //Industry
                  var industryInput = document.getElementsByName("industry")[0];
                  var industry = industryInput.value.trim();
                  var regex = /^[A-Za-z\s]+$/;
                
                  if (!regex.test(industry)) {
                    event.preventDefault(); // Prevent form submission
                    alert("The Industry should have no numeric characters and should only contain letters and spaces. Please correct it.");
                    industryInput.value = "";
                  }
                
                  //GraduationYear
                  var graduationYearInput = document.getElementsByName("graduationYear")[0];
                  var graduationYear = graduationYearInput.value.trim();
                  var regex = /^\d{4}$/;
                  var currentYear = new Date().getFullYear();
                
                  if (!regex.test(graduationYear) || parseInt(graduationYear) > currentYear) {
                    event.preventDefault(); // Prevent form submission
                    alert("Graduation Year should have 4 digits and must not exceed the current year.");
                    graduationYearInput.value = "";
                  }
                });
            </script>

            <div
                style="justify-content: center; justify-items: center; margin-left: 10%;">

               <!-- Gender -->
                <div class="radio-input" style="margin-left: 30.2%;">
                    <label>
                        <input type="radio" id="value-1" name="gender" value="Male" <?php echo $gender ===
                        "Male"
                            ? "checked"
                            : ""; ?>>
                        <span>Male</span>
                    </label>
                    <label>
                        <input type="radio" id="value-2" name="gender" value="Female" <?php echo $gender ===
                        "Female"
                            ? "checked"
                            : ""; ?>>
                        <span>Female</span>
                    </label>
                    <label>
                        <input type="radio" id="value-3" name="gender" value="Other" <?php echo $gender ===
                        "Other"
                            ? "checked"
                            : ""; ?>>
                        <span>Other</span>
                    </label>
                    <span class="selection"></span>
                </div>
                <script>
                    function validateForm(event) {
                    var genderInputs = document.getElementsByName("gender");
                    var isGenderSelected = false;
                    for (var i = 0; i < genderInputs.length; i++) {
                    if (genderInputs[i].checked) {
                        isGenderSelected = true;
                        break;
                    }
                    }
                    if (!isGenderSelected) {
                    event.preventDefault(); // Prevent form submission
                    alert("Please select your gender.");
                    }
                    }
                    
                    // Add event listener to the form submission
                    var form = document.querySelector("form");
                    form.addEventListener("submit", validateForm);
                </script>
                <!-- Birthday -->
                <div
                    class="input-container">
                    <label
                        for="birthday"
                        class="birthday-label" style="color: #5e32ff; font-size: 140%; margin-top: 7%;">Birthday</label>
                    <label for="Gender"
                        class="Gender" style="color: #5e32ff; font-size: 140%; margin-top: -45%;">Gender</label>
                    <input type="date"
                        id="birthday"
                        name="birthday"  value="<?php echo $birthday; ?>"
                        class="violet-date">
                    <span
                        class="date-selector"></span>
                </div>
                <script>
                    function validateForm(event) {
                    var birthdayInput = document.getElementById("birthday");
                    if (!birthdayInput.value) {
                    event.preventDefault(); // Prevent form submission
                    alert("Please enter your birthday.");
                    }
                    }
                    
                    // Add event listener to the form submission
                    var form = document.querySelector("form");
                    form.addEventListener("submit", validateForm);
                </script>
                <!-- Register -->
                <button
                    type="submit">Update Profile</button>
        </form>


        
    </div>
    </div>
    <style>
        .violet-date::-webkit-calendar-picker-indicator {
        filter: invert(1);
        }
        .input-container {
        position: relative;
        margin-top: 7%;
        margin-left: 31%;
        width: 196px;
        }
        .birthday-label {
        position: absolute;
        margin-top: 7%;
        top: -20px;
        left: 0;
        color: #ffffff;
        font-size: 0.8em;
        }
        .Gender {
        position: absolute;
        margin-top: -42%;
        top: -20px;
        left: 0;
        color: #ffffff;
        font-size: 0.8em;
        }
        .violet-date {
        margin-top: 7%;
        margin-left: -1%;
        width: 100%;
        padding: 10px;
        background-color: #6d45ff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        }
    </style>
    <style>
        button {
        margin-top: 8%;
        margin-left: 37%;
        text-decoration: none;
        position: relative;
        border: none;
        font-size: 14px;
        font-family: inherit;
        color: #fff;
        width: 9em;
        height: 3em;
        line-height: 2em;
        text-align: center;
        background: linear-gradient(90deg,#03a9f4,#f441a5,#ffeb3b,#03a9f4);
        background-size: 300%;
        border-radius: 30px;
        z-index: 1;
        }
        button:hover {
        animation: ani 8s linear infinite;
        border: none;
        }
        @keyframes ani {
        0% {
        background-position: 0%;
        }
        100% {
        background-position: 400%;
        }
        }
        button:before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        z-index: -1;
        background: linear-gradient(90deg,#5e32ff,#f441a5,#ffeb3b,#6a2aff);
        background-size: 400%;
        border-radius: 35px;
        transition: 1s;
        }
        button:hover::before {
        filter: blur(20px);
        }
        button:active {
        background: linear-gradient(32deg,#03a9f4,#f441a5,#ffeb3b,#03a9f4);
        }
    </style>
    </div>
    </form>
    </div>
    <script src="./settings.js">
    </script>
</body>

</html>


<script>
    // JavaScript validation
    document.querySelector('form').addEventListener('submit', function(event) {
        // Retrieve the username input element
        var usernameInput = document.getElementsByName("username")[0];

        // Retrieve the value from the username input
        var username = usernameInput.value;

        // Check for whitespaces
        if (/\s/.test(username)) {
            alert('Username should not have any whitespaces.');
            event.preventDefault(); // Prevent form submission
            return false;
        }

        // Check for lowercase
        if (username !== username.toLowerCase()) {
            alert('Username should be in all lowercase.');
            event.preventDefault(); // Prevent form submission
            return false;
        }

        // Retrieve the email input element
        var emailInput = document.getElementsByName("email")[0];

        // Retrieve the value from the email input
        var email = emailInput.value;

        // Check for the "@" symbol
        if (email.indexOf('@') === -1) {
            alert('Email should contain the "@" symbol.');
            event.preventDefault(); // Prevent form submission
            return false;
        }

        // Check for whitespaces
        if (/\s/.test(email)) {
            alert('Email should not have any whitespaces.');
            event.preventDefault(); // Prevent form submission
            return false;
        }

        // Check for valid email format
        if (!/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/.test(email)) {
            alert('Email should have a valid extension name (e.g., @gmail.com, @yahoo.com).');
            event.preventDefault(); // Prevent form submission
            return false;
        }

        // Retrieve the password input element
        var passwordInput = document.getElementsByName("password")[0];

        // Retrieve the value from the password input
        var password = passwordInput.value;

        // Password validation
        if (password.length < 8) {
            alert('Password should contain at least 8 characters.');
            event.preventDefault(); // Prevent form submission
            return false;
        }
        if (!/[A-Z]/.test(password)) {
            alert('Password should contain at least 1 uppercase character.');
            event.preventDefault(); // Prevent form submission
            return false;
        }
        if (!/[a-z]/.test(password)) {
            alert('Password should contain at least 1 lowercase character.');
            event.preventDefault(); // Prevent form submission
            return false;
        }
        if (!/\d/.test(password)) {
            alert('Password should contain at least 1 numeric character.');
            event.preventDefault(); // Prevent form submission
            return false;
        }

        // Add more validation logic if needed

        // Continue with form submission if all validations pass
        return true;
    });
</script>

<script src="./settings.js"></script>
</body>

</html>
