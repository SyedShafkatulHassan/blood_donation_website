<?php
include "db_conect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $Blood_Type = $_POST['Blood_Type'];
    $Location = $_POST['Location'];
    $LastDonated = $_POST['LastDonated'];

    if (!empty($Blood_Type) && !empty($name) && !empty($password) && !empty($Location) && !empty($LastDonated)) {
        $urPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{3,}$/';
        $pasPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=<>?]).{8,}$/';
        $datePattern = '/^\d{2}-\d{2}-\d{4}$/';
        $bloodTypePattern = '/^(A|B|AB|O)[+-]$/';

        if (preg_match($urPattern, $name) && preg_match($pasPattern, $password) && preg_match($datePattern, $LastDonated) && preg_match($bloodTypePattern, $Blood_Type)) {
            if ($conn) {
                $DuplicateUser = mysqli_query($conn, "SELECT * FROM alluserinformation WHERE name ='$name'");
                if (mysqli_num_rows($DuplicateUser) == 0) {
                    $sql = "INSERT INTO alluserinformation (name, password, Blood_Type, Location, LastDonated) VALUES ('$name', '$password', '$Blood_Type', '$Location', '$LastDonated')";
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    header("Location: test.php");
                } else {
                    mysqli_close($conn);
                }
            }
        } else {
            echo "Invalid input format";
        }
    } else {
        echo "Fill up all the fields";
    }
}
?>


<!DOCTYPE html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

<body>
    <div class="container" style="margin-top: 5%;">
        <div class="row justify-content-center"style="font-family: 'Poppins', sans-serif; color:red">
            <div class="col-lg-6 col-sm-12">
                <h3 class="row justify-content-center">Regestration Form</h3>
                <form method="POST" onsubmit="return validForm()" autocomplete="off">
                    <div class="form-group">
                        <label for="name">User Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Atleast 1 uppercaseletter ,smallcaseletter and number" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Atleast 1 uppercaseletter ,smallcaseletter,number,Sl and 8 length"required>
                    </div>
                    <div class="form-group">
                        <label for="Blood Type">Blood Type:</label>
                        <input type="text" class="form-control" id="Blood_Type" name="Blood_Type" placeholder="Example: A+ or A-" required>
                    </div>
                    <div class="form-group">
                        <label for="Location">Location:</label>
                        <input type="text" class="form-control" id="Location" name="Location" placeholder="Example : Sylhet" required>
                    </div>
                    <div class="form-group">
                        <label for="LastDonated">LastDonated:</label>
                        <input type="text" class="form-control" id="LastDonated" name="LastDonated" placeholder="Example: 02-12-2024" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validForm() {
            var CheckName = document.forms[0].name.value;
            var CheckPassword = document.forms[0].password.value;
            var CheckBloodType= document.forms[0].Blood_Type.value;
            var CheckLocation= document.forms[0].Location.value;
            var CheckLastDonated= document.forms[0].LastDonated.value;
            const ur = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{3,}$/;
            const pas = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=<>?]).{8,}$/;
            const date = /^\d{2}-\d{2}-\d{4}$/;
            const bloodtype = /^(A|B|AB|O)[+-]$/;
            if (!ur.test(CheckName)) {
                alert("User name need to have Atleast 1 uppercaseletter ,smallcaseletter and number");
                return false;
            }
            if (!pas.test(CheckPassword)) {
                alert("Password need to have Atleast 1 uppercaseletter ,smallcaseletter,number,specialcase letter and 8 length");
                return false;
            }
            if (! date.test(CheckLastDonated)) {
                alert("Date formate is not correct!");
                return false;
            }
            if (! bloodtype.test(CheckBloodType)) {
                alert("Blood type is not correct!");
                return false;
            }

        }
    </script>
</body>

</html>