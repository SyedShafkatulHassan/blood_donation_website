<?php
include "db_conect.php";

$sql = "SELECT * FROM alluserinformation";
$result = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['blood_type'])) {
    $searchBloodType = $_GET['blood_type'];
    $sql .= " WHERE Blood_Type = '$searchBloodType'";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 5%;">
        <h3 class="text-center">Donners Information</h3>
        <form class="form-inline justify-content-center mb-3">
            <div class="form-group">
                <label for="bloodTypeSearch">Search by Blood Type:</label>
                <input type="text" class="form-control mx-sm-2" id="bloodTypeSearch" name="blood_type" placeholder="Blood Type" >
                <button type="submit" class="btn btn-danger">Search</button>
            </div>
        </form>
        <div class="table-responsive" style="font-family: 'Poppins', sans-serif; font-size: larger;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Blood Type</th>
                        <th>Location</th>
                        <th>Last Donated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr";
                        echo ">";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['Blood_Type'] . "</td>";
                        echo "<td>" . $row['Location'] . "</td>";
                        echo "<td>" . $row['LastDonated'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
