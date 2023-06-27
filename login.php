<?php

include 'config.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {

}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Retrieve the form data
  $usernameOrEmail = $_POST["username_email"];
  $password = $_POST["password"];

  // Check if the user exists in the database
  $conn = new mysqli('localhost', 'root', '', 'AlumniSphere');
  if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
  }

  // Prepare the query to check for email or username
  $stmt = $conn->prepare("SELECT * FROM signup1 WHERE (email = ? OR username = ?) AND password = ?");
  $stmt->bind_param("sss", $usernameOrEmail, $usernameOrEmail, $password);
  $stmt->execute();

  // Bind the result columns to variables
  $stmt->bind_result($id, $email, $username, $password);

  // Fetch the results
  if ($stmt->fetch()) {
    // The user exists, so log them in
    $_SESSION["user_id"] = $id;
    if ($id == 1) {
      // The user is an admin, so redirect to the admin dashboard
      echo '<script>alert("Login Successfully!"); window.location.href = "admin-dashboard.html";</script>';
    } else {
      // The user is a regular user, so redirect to the user dashboard
      echo '<script>alert("Login Successfully!"); window.location.href = "user-dashboard.html";</script>';
    }
    exit();
  } else {
    // The user does not exist, so display an error message
    echo '<script>alert("Invalid username/email or password."); window.location.href = "login.html";</script>';
  }

  $stmt->close();
  $conn->close();
}
?>