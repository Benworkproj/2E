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
        $birthday = $_POST['birthday'];
        $address = $_POST['address'];
        $education = $_POST['education'];
        $profile= $_POST['profile'];
        $skills = $_POST['skills'];

        // Add the validated inputs to the database
        $sql = "INSERT INTO users (birthday, address, education, profile, skills) VALUES ('$birthday', '$address', '$education', '$profile', '$skills')";
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
<html lang="en">
	<head>
		<title>Sign-Up</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/custom.css">

	</head>
	<body>
		<section class="">
			<!-- nav -->
			<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-success" id="ftco-navbar">
				<div class="container">
				<a class="navbar-brand" href="index.html"><img src="images/logo.png" width="90" height="90" alt="" srcset=""></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span> Menu
				</button>

				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a href="#" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="#" class="nav-link">About</a></li>
					</ul>
				</div>
				</div>
			</nav>
			<!-- END nav -->
		</section>
        <section class="container mx-auto mb-lg-5">
            <h1 class="h1 font-weight-bold text-success ml-xl-5 mt-xl-5">Basic Information</h1>
            <div class="row">
                <img src="images/SIGN UP (USER PART 1 )-green.jpg" class="w-50 my-auto">
                <div class="form p-3 w-50">
                    <form action="#" method="POST" class="mt-xl-5">
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
                            <button class="btn btn-success w-100 pull-right" type="submit" id="createBtn" name="createBtn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>

