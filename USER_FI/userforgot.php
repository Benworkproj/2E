<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Forgot Password</title>
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
        <section class="container mx-auto pt-lg-5 mb-lg-5">
            <h1 class="h1 font-weight-bold text-success text-lg-center mb-3">Forgot Password</h1>
            <div class="row">
                <img src="images/forgot-pass-green.jpg" class="w-50">
                <div class="form p-xl-5 w-50">
                    <form action="userforgot.php" method="POST" class="mt-xl-5">
                        <div class="mb-5">
                            <label for="" class="form-label text-dark">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="juandelacruz@gmail.com" required>
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label text-dark">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="xxxxxxxxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success w-100" type="submit" id="createBtn" name="createBtn">Update</button>
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

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mycrud";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['createBtn'])) {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "ss", $pass, $email);

    if (mysqli_stmt_execute($stmt)) {
        echo "Change password successfully";
        header("Location: log.php");
    } else {
        echo "Change password unsuccessfully";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
