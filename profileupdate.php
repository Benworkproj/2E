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

// Retrieve the user details from the form
$fullName = $_POST["fullName"];
$address = $_POST["address"];
$phoneNumber = $_POST["phoneNumber"];
$industry = $_POST["industry"];
$graduationYear = $_POST["graduationYear"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$gender = $_POST["gender"];
$birthday = $_POST["birthday"];

// Update the user profile in the database
$conn = new mysqli('localhost', 'root', '', 'AlumniSphere');
if ($conn->connect_error) {
  echo "$conn->connect_error";
  die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE signup2 SET fullName=?, address=?, phoneNumber=?, industry=?, graduationYear=?, gender=?, birthday=? WHERE id=?");
$stmt->bind_param("ssssissi", $fullName, $address, $phoneNumber, $industry, $graduationYear, $gender, $birthday, $user_id);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("UPDATE signup1 SET username=?, email=?, password=? WHERE user_id=?");
$stmt->bind_param("sssi", $username, $email, $password, $user_id);
$stmt->execute();
$stmt->close();

$conn->close();

// Redirect to the settings page with a success message
header("Location: settings.php?success=1");
exit();
?>
