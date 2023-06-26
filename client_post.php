<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dbclient';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if create button was clicked
    if (isset($_POST['createBtn'])) {
        // Get form data
        $title = $_POST['title'];
        $skills = $_POST['skills'];
        $selectedScope = $_POST['scope'];
        $budget = $_POST['budget'];
        $description = $_POST['description'];

        // Add the validated inputs to the database
        $sql = "INSERT INTO jobpost (title, skills, scope, budget, description) VALUES ('$title', '$skills', '$selectedScope','$budget', '$description')";
        if (mysqli_query($conn, $sql)) {
            echo "Account created successfully.";
            header("Location: client_dash.php");
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
		<title>JOB POST</title>
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
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a href="#" class="nav-link"> <img src="images/home_icon.png" class="d-block mx-auto" width="30"> Home</a></li>
						<li class="nav-item"><a href="#" class="nav-link"> <img src="images/about_icon.png" class="d-block mx-auto" width="30">About</a></li>
					</ul>
		
				</div>
				</div>
			</nav>
			<!-- END nav -->
		</section>
        <div class="container mt-xl-5 text-dark font-weight-bold">
            <form method="POST">
                <div class="mb-3 row">
                    <label for="inputName" class="col-4 col-form-label">Title for your job post</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="title" id="title" placeholder="e.g Virtual Assistant" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputName" class="col-4 col-form-label">Skills</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="skills" id="skills" placeholder="e.g. Microsoft Doc" required>
                    </div>
                </div>
                <div class="row">
                    <label for="" class="col-4 col-form-label">Scope: </label>
                    <div class="col-8 ml-auto">
                        <div class="form-check form-check-inline mb-3">
                            <input type="radio" name="scope" id="parttime" class="form-check-input" placeholder="" value="Part-Time">
                            <label for="" class="form-check-label text-dark">Part Time</label>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <input type="radio" name="scope" id="fulltime" class="form-check-input" placeholder="" value="Full-Time">
                            <label for="" class="form-check-label text-dark">Full Time</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputName" class="col-4 col-form-label">Budget</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="budget" id="budget" placeholder="Input your budget" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputName" class="col-4 col-form-label">Describe your job</label>
                    <div class="col-8">
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Alreday have a description paste it here!" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="ml-auto col-sm-4">
                        <button type="submit" class="d-block ml-auto btn btn-success w-25" name="createBtn">Post</button>
                    </div>
                </div>
            </form>
        </div>
		
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>

