<?php
include "db_conect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{3,}$/';
    $passwordRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=<>?]).{8,}$/';
    $name = $_POST['name'];
    $password = $_POST['password'];
    if (preg_match($nameRegex, $name) && preg_match($passwordRegex, $password)) {
        if (mysqli_query($conn, "SELECT * FROM alluserinformation WHERE name ='$name' AND password = '$password'")) {
            session_start();
            $_SESSION['username'] = $name;
            $_SESSION['password'] = $password;
            header("Location: login.php");
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        .carousel-item img {
            height: 400px;
            width: 800px;
        }

        .back {
            background-color: white;
            color: red;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-family: 'Poppins', sans-serif;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="1.png" alt="Image" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="donors list" style="color: red;">See donors list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="Registration" style="color: red;">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="loginButton" style="color: red;">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container-fluid" style="margin-top: 8%;">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="carousel" style="display: flex;justify-content: center;">
                    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
                            <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="image1.jpg" alt="Image 1" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="image2.jpg" alt="Image 2" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="image3.jpg" alt="Image 3" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loginPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2 style="color: red;">Login</h2>
            <form id="loginForm" method="post">
                <div class="mb-3" style="color: red;">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3" style="color: red;">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>
    <div class="container-fluid col-lg-5 col-sm-10 mt-5" style="color: red;font-family: 'Poppins', sans-serif; font-size: larger;">
        1. Saves lives during emergencies and accidents.
        <br>
        2.Supports patients undergoing surgeries and medical treatments.
        <br>
        3.Provides essential blood transfusions for individuals with blood disorders. <br>
        4.Helps cancer patients during chemotherapy and radiation therapy. <br>
        5.Assists individuals with anemia or other blood-related conditions. <br>
        6.Supplies blood for childbirth and pregnancy complications. <br>
        7.Supports patients with severe injuries or trauma. <br>
        8.Treats patients with chronic illnesses requiring regular transfusions. <br>
        9.Ensures a sufficient blood supply for medical emergencies. <br>
        10.Improves the overall healthcare system's efficiency and preparedness. <br>
        11.Promotes community solidarity and compassion. <br>
        12.Raises awareness about the importance of blood donation. <br>
        13.Offers a chance for donors to have a health check-up. <br>
        14.Provides a rewarding experience of directly helping others. <br>
        Builds a strong sense of altruism and empathy in society. <br><br><br>
    </div>

    <script>
        document.getElementById("loginButton").addEventListener("click", function() {
            document.getElementById("loginPopup").style.display = "block";
        });

        document.getElementsByClassName("close")[0].addEventListener("click", function() {
            document.getElementById("loginPopup").style.display = "none";
        });
        document.getElementById("Registration").addEventListener("click", function() {
            window.location.href = "Regestration.php";
        });
        document.getElementById("donors list").addEventListener("click", function() {
            window.location.href = "donnerlist.php";
        });
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            var name = document.getElementById("name").value;
            var password = document.getElementById("password").value;
            const Ur = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{3,}$/;
            const Pas = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=<>?]).{8,}$/;
            if (Ur.test(name) && Pas.test(password)) {


            }
        });
    </script>
</body>

</html>