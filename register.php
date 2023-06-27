<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['txt'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost','root','','AlumniSphere');

    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    }

    // Check if username already exists in the database
    $checkQuery = "SELECT * FROM signup1 WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo '<script>alert("Username already taken. Please input a unique one."); window.history.back();</script>';
        exit();
    }

     // Check if username already exists in the database
     $checkQuery = "SELECT * FROM signup1 WHERE email = '$email'";
     $checkResult = $conn->query($checkQuery);
 
     if ($checkResult->num_rows > 0) {
         echo '<script>alert("Email already taken. Please input a unique one."); window.history.back();</script>';
         exit();
     }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO signup1 (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Thank You For Your Registration! To Continue Please Complete Your Personal Information."); window.location.href = "personalinfo.html";</script>';
    } else {
        echo '<script>alert("Error storing data.");</script>';
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $conn->close();
}
?>
