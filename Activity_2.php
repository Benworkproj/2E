<?php

// Connect to database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mycrud';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get form data
    if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //authenticate user
    $sql = "SELECT name,password FROM users WHERE name='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        if($username == $row['name'] && $password == $row['password']){
            $_SESSION['username'] = $username;
            header("Location: landingpage.php");
          
        }
    }
    $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if(isset($error)) echo $error; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>