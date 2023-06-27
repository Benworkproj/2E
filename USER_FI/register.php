<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mycrud';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if create button was clicked
    if (isset($_POST['createBtn'])) {
        // Get form data
        $name = $_POST['name'];
        $nationality = $_POST['nationality'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birthday = $_POST['birthday'];
        $address = $_POST['address'];
        $education = $_POST['education'];
        $profile= $_POST['profile'];
        $skills = $_POST['skills'];

        // Add the validated inputs to the database
        $sql = "INSERT INTO users (name, nationality, email, password,birthday, address, education, profile, skills) VALUES ('$name', '$nationality', '$email', '$password','$birthday', '$address', '$education', '$profile', '$skills')";
        if (mysqli_query($conn, $sql)) {
            echo "Account created successfully.";
            header("Location: log.php");
            exit();
        } else {
            echo "Error creating account: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Creation Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">

    <script>
    function validateSignUp() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const name = document.getElementById('name').value;

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    const nameRegex = /^[a-zA-Z ]*$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (password === '') {
        alert('Password is required!');
        return false;
    }

    if (!passwordRegex.test(password)) {
        alert('Invalid password. Password must contain at least 8 characters, including at least 1 uppercase letter, 1 lowercase letter, and 1 numeric digit.');
        return false;
    }

    if (name === '') {
        alert('Name is required.');
        return false;
    }

    if (!nameRegex.test(name)) {
        alert('Invalid name! Name should only contain letters and spaces.');
        return false;
    }

    if (email === '') {
        alert('Email is required!');
        return false;
    }

    if (!emailRegex.test(email)) {
        alert('Invalid email address.');
        return false;
    }

    if (!email.includes('@')) {
        alert('Email should contain the "@" special character.');
        return false;
    }

    const validEmailDomains = ['gmail.com', 'yahoo.com'];
    const domain = email.split('@')[1];
    if (!validEmailDomains.includes(domain)) {
        alert('Invalid email address. Please use a valid email.');
        return false;
    }


    return true;
}

    </script>
</head>
<body>
<section class="">
    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-success" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="images/logo.png" width="90" height="90" alt="" srcset=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="firstpage.php" class="nav-link"> <img src="images/home_icon.png" class="d-block mx-auto" width="30"> Home</a></li>
				<li class="nav-item"><a href="about.php" class="nav-link"> <img src="images/about_icon.png" class="d-block mx-auto" width="30">About</a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- END nav -->
</section>
<section class="container mx-auto mb-lg-5">
    <h1 class="h1 font-weight-bold text-success ml-xl-5 mt-xl-5">Sign Up</h1>
    <div class="row">
        <img src="images/SIGN UP (USER PART 1 )-green.jpg" class="w-50 my-auto">
        <div class="form p-3 w-50">
            <!--Form--->
            <form method="POST" onsubmit="return validateSignUp()">
                <div class="mb-3">
                    <label for="" class="form-label text-dark">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark">Nationality</label>
                    <input type="text" id="nationality" name="nationality" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                        <label for="" class="form-label text-dark">Birthday</label>
                        <input type="date" name="birthday" id="" class="form-control" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-dark">Address</label>
                            <input type="text" name="address" id="" class="form-control" placeholder="Imus Cavite" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-dark">Educational Attainment</label>
                            <input type="text" name="education" id="" class="form-control" placeholder="Associate" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-dark">Profile Description</label>
                            <input type="text" name="profile" id="" class="form-control" placeholder="Write something here or put your object" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-dark">Top Skills</label>
                            <input type="text" name="skills" id="" class="form-control" placeholder="Microsoft Exel" required>
                        </div>         
                <div class="mb-3">
                    <button class="btn btn-success w-100" type="submit" id="createBtn" name="createBtn">Register</button>
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
