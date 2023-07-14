<?php
session_start();
include "db_conect.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $welcomeMessage = "Welcome, $username";
} else {
    header("Location:login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputField = $_POST['inputField'];
    $password = $_SESSION['password'];
    $username = $_SESSION['username'];
    $datePattern = '/^\d{2}-\d{2}-\d{4}$/';
    if (preg_match($datePattern, $inputField)) {
        $updateQuery = "UPDATE alluserinformation SET LastDonated = '$inputField' WHERE name = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $updateQuery);
        echo '<script>alert("Submitted!");</script>';
    }
}

if (isset($_POST['logout'])) {
    $inputField="";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .container {
            margin-top: 5%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center"><?php echo $welcomeMessage; ?></h3>
        <form method="POST" class="text-center" onsubmit="return validate()">
            <div class="form-group"  method="POST">
                <label for="inputField">Input Field:</label>
                <input type="text" class="form-control" id="inputField" name="inputField" placeholder="Insert Recent donation date (Example : 22-11-2024)">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <form method="POST" class="text-center mt-4" >
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </div>
    <script>
        function validate() {
            const date = /^\d{2}-\d{2}-\d{4}$/;
            var CheckLastDonated = document.forms[0].inputField.value;
            if (!date.test(CheckLastDonated)) {
                alert("Date formate is not correct! Correct date Example:22-02-2023");
                return false;
            }
        }
    </script>
</body>

</html>