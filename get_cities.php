<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ifsc";
$db = new mysqli($servername, $username, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["district"])) {
    $selectedDistrict = $_GET["district"];
    $selectedBank = $_GET["bank_name"];
    $query = "SELECT DISTINCT bank_city FROM bank_details WHERE bank_name = '$selectedBank' AND bank_district = '$selectedDistrict'";
    $result = $db->query($query);

    $cities = array();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $cities[] = $row["bank_city"];
        }
    }

    echo json_encode($cities);
}
?>
