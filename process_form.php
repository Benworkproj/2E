<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $fullName = isset($_POST["fullName"]) ? $_POST["fullName"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $phoneNumber = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : "";
    $industry = isset($_POST["industry"]) ? $_POST["industry"] : "";
    $graduationYear = isset($_POST["graduationYear"]) ? $_POST["graduationYear"] : "";
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $birthday = isset($_POST["birthday"]) ? $_POST["birthday"] : "";

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'AlumniSphere');

    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO signup2 (fullName, address, phoneNumber, industry, graduationYear, gender, birthday) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullName, $address, $phoneNumber, $industry, $graduationYear, $gender, $birthday);

    // Execute the statement
    if ($stmt->execute()) {
        // Display an alert message
        echo '<script>
            alert("Successfully Registered. Please Login to Your Account.");
            window.location.href = "login.html";
        </script>';
        exit();
    } else {
    echo "Error: " . $stmt->error;
}

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>