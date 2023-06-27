<!DOCTYPE html>
<html lang="en">
<head>
    <title>Website menu 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
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

    <section class="container mx-auto pt-lg-5 mb-lg-5">
        <h1 class="h1 text-right font-weight-bold login-text text-success">Log In</h1>
        <div class="row">
            <img src="images/login-green.jpg" class="w-50">
            <div class="form p-xl-5 w-50">
                <form action="#" method="POST" class="mt-xl-5" action="log.php">
                    <div class="mb-5">
                        <label for="" class="form-label text-dark">Email</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="juandelacruz@gmail.com">
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label text-dark">Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="xxxxxxxxxxxxxx">
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-success w-100" type="submit" name="login" value="Log-In">
                            <a href="http://localhost/folder/UPDATED/project/USER_FI/userforgot.php" >Forgot password?</a><br><br>
                        <div class="mb-3">
                        <p class="text-center m-0 text-dark">Don't have an Account</p>
                        <p class="text-center m-0 text-dark">
                            <a href="http://localhost/folder/UPDATED/project/USER_FI/register.php#">Register</a> here!
                        </p>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
    //CONNECTION
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mycrud";

    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //get form data
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            //authenticate user using prepared statement
            $stmt = mysqli_prepare($conn, "SELECT email,password FROM users WHERE email=? AND password=?");
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $_SESSION['email'] = $email;
                echo '<script>alert("Log-In Successfuly"); window.location.href="dashboard.php";</script>'
                exit;
            } else {
                $error = "Invalid credentials";
            }
            mysqli_stmt_close($stmt);
        }
    }
?>

</body>
</html>
