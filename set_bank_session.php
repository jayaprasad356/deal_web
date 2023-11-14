<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ifsc";
$db = new mysqli($servername, $username, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bank_name"])) {
    // Set the selected bank name in a session variable
    $_SESSION["selected_bank_name"] = $_POST["bank_name"];
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["bank_name"])) {
    $selectedBank = $_GET["bank_name"];
    $query = "SELECT DISTINCT bank_district FROM bank_details WHERE bank_name = '$selectedBank'";
    $result = $db->query($query);

    $districts = array();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $districts[] = $row["bank_district"];
        }
    }

    echo json_encode($districts);
}
?>
