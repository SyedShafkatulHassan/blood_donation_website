<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $welcomeMessage = "Welcome, $username!";
} else {
    header("Location: login.php");
    exit();
}

include "db_conect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputField = $_POST['inputField'];
    $password = $_SESSION['password'];
    $username = $_SESSION['username'];    
    $updateQuery = "UPDATE alluserinformation SET LastDonated = '$inputField' WHERE name = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $updateQuery);
    
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: test.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 5%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center"><?php echo $welcomeMessage; ?></h3>
        <form method="POST" class="text-center">
            <div class="form-group">
                <label for="inputField">Input Field:</label>
                <input type="text" class="form-control" id="inputField" name="inputField" placeholder="Insert Recent donation date">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <form method="POST" class="text-center">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </div>

</body>
</html>
