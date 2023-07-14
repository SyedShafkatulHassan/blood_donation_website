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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>

</style>

<body>
    <div class="container" style="margin-top: 5%; font-size :10px">
        <h3 class="text-center">Donners Information</h3>
        <form class="form-inline justify-content-center mb-3">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="bloodTypeSearch" name="blood_type" placeholder="Search by Blood Type">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-danger button">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive col-sm-12" style="font-family: 'Poppins', sans-serif;font-size:17px">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>UserName</th>
                        <th>BloodType</th>
                        <th>Location</th>
                        <th>LastDonated</th>
                        <th>Phonenumber</th>
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
                        echo "<td>" . $row['Phonenumber'] . "</td>";
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