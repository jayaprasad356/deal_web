<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ifsc";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBank = $_POST["bank_name"];

    $db = new mysqli($servername, $username, $password, $database);

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $query = "SELECT DISTINCT bank_district FROM bank_details WHERE bank_name = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $selectedBank);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $districts = array();

        while ($row = $result->fetch_assoc()) {
            $districts[] = $row['bank_district'];
        }

        echo '<option value="">Select a District</option>';
        foreach ($districts as $district) {
            echo '<option value="' . $district . '">' . $district . '</option>';
        }
    } else {
        echo '<option value="">No districts found</option>';
    }

    $stmt->close();
    $db->close();
}
?>
