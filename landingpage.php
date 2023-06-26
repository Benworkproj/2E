<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mycrud';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
//add database and other includes here

//add database and other includes here

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if search button was clicked
    if(isset($_POST['searchBtn'])){
        //get search term
        $searchTerm = $_POST['searchTerm'];

        //perform search query on database
        //display search results in table
        $sql = "SELECT * FROM users WHERE name LIKE '$searchTerm'";
        $result = mysqli_query($conn, $sql);
    
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Landing Page</title>
</head>
<body>
    <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
    <form method="POST" >
    <input type="text" id="searchTerm" name="searchTerm" placeholder="Search...">
    <button type="submit" id="searchBtn" name="searchBtn">Search</button>
    <button>Create</button>
    </form>
    <div id="searchResults"></div>
    <table>
    <tr><th>ID</th><th>Name</th><th>Email</th></tr>
    <?php
        if(isset($result)> 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['email']."</td></tr>";
            }
        }else{
            echo "<tr><td colspan='3'>No results found.</td></tr>";
        }
    ?>
    </table>
</body>
</html>

